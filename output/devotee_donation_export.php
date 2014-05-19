<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

include("include/devotee_donation_variables.php");

if(!isLogged())
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(CheckPermissionsEvent($strTableName, 'P') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Export"))
{
	echo "<p>"."You don't have permissions to access this table"."<a href=\"login.php\">"."Back to login page"."</a></p>";
	return;
}

$layout = new TLayout("export2","RoundedAqua1","MobileAqua1");
$layout->blocks["top"] = array();
$layout->containers["export"] = array();

$layout->containers["export"][] = array("name"=>"exportheader","block"=>"","substyle"=>2);


$layout->containers["export"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"range");


$layout->containers["range"] = array();

$layout->containers["range"][] = array("name"=>"exprange_header","block"=>"rangeheader_block","substyle"=>1);


$layout->containers["range"][] = array("name"=>"exprange","block"=>"range_block","substyle"=>1);


$layout->skins["range"] = "fields";

$layout->containers["export"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"expoutput_header","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"expoutput","block"=>"","substyle"=>1);


$layout->skins["fields"] = "fields";

$layout->containers["export"][] = array("name"=>"expbuttons","block"=>"","substyle"=>2);


$layout->skins["export"] = "1";
$layout->blocks["top"][] = "export";$page_layouts["devotee_donation_export"] = $layout;


// Modify query: remove blob fields from fieldlist.
// Blob fields on an export page are shown using imager.php (for example).
// They don't need to be selected from DB in export.php itself.
//$gQuery->ReplaceFieldsWithDummies(GetBinaryFieldsIndices());

$cipherer = new RunnerCipherer($strTableName);

$strWhereClause = "";
$strHavingClause = "";
$strSearchCriteria = "and";
$selected_recs = array();
$options = "1";

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();
$id = postvalue("id") != "" ? postvalue("id") : 1;

$phpVersion = (int)substr(phpversion(), 0, 1); 
if($phpVersion > 4)
{
	include("include/export_functions.php");
	$xt->assign("groupExcel", true);
}
else
	$xt->assign("excel", true);

//array of params for classes
$params = array("pageType" => PAGE_EXPORT, "id" => $id, "tName" => $strTableName);
$params["xt"] = &$xt;
if(!$eventObj->exists("ListGetRowCount") && !$eventObj->exists("ListQuery"))
	$params["needSearchClauseObj"] = false;
$pageObject = new RunnerPage($params);

//	Before Process event
if($eventObj->exists("BeforeProcessExport"))
	$eventObj->BeforeProcessExport($conn, $pageObject);

if (@$_REQUEST["a"]!="")
{
	$options = "";
	$sWhere = "1=0";	

//	process selection
	$selected_recs = array();
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["DonationId"] = refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
			$selected_recs[] = $keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=explode("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys = array();
			$keys["DonationId"] = urldecode($arr[0]);
			$selected_recs[] = $keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}


	$strSQL = $gQuery->gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
	
	$_SESSION[$strTableName."_SelectedSQL"] = $strSQL;
	$_SESSION[$strTableName."_SelectedWhere"] = $sWhere;
	$_SESSION[$strTableName."_SelectedRecords"] = $selected_recs;
}

if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
{
	$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
	$strWhereClause = @$_SESSION[$strTableName."_SelectedWhere"];
	$selected_recs = $_SESSION[$strTableName."_SelectedRecords"];
}
else
{
	$strWhereClause = @$_SESSION[$strTableName."_where"];
	$strHavingClause = @$_SESSION[$strTableName."_having"];
	$strSearchCriteria = @$_SESSION[$strTableName."_criteria"];
	$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
}

$mypage = 1;
if(@$_REQUEST["type"])
{
//	order by
	$strOrderBy = $_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy = $gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);

	$strSQLbak = $strSQL;
	if($eventObj->exists("BeforeQueryExport"))
		$eventObj->BeforeQueryExport($strSQL,$strWhereClause,$strOrderBy, $pageObject);
//	Rebuild SQL if needed
	if($strSQL!=$strSQLbak)
	{
//	changed $strSQL - old style	
		$numrows=GetRowCount($strSQL);
	}
	else
	{
		$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
		$strSQL.=" ".trim($strOrderBy);
		$rowcount=false;
		if($eventObj->exists("ListGetRowCount"))
		{
			$masterKeysReq=array();
			for($i = 0; $i < count($pageObject->detailKeysByM); $i ++)
				$masterKeysReq[] = $_SESSION[$strTableName."_masterkey".($i + 1)];
			$rowcount = $eventObj->ListGetRowCount($pageObject->searchClauseObj,$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs, $pageObject);
		}
		if($rowcount !== false)
			$numrows = $rowcount;
		else
			$numrows = $gQuery->gSQLRowCount($strWhereClause,$strHavingClause,$strSearchCriteria);
	}
	LogInfo($strSQL);

//	 Pagination:

	$nPageSize = 0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage = (integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize = (integer)@$_SESSION[$strTableName."_pagesize"];
		
		if(!$nPageSize)
			$nPageSize = $gSettings->getInitialPageSize();
				
		if($nPageSize<0)
			$nPageSize = 0;
			
		if($nPageSize>0)
		{
			if($numrows<=($mypage-1)*$nPageSize)
				$mypage = ceil($numrows/$nPageSize);
		
			if(!$mypage)
				$mypage = 1;
			
					$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
		}
	}
	$listarray = false;
	if($eventObj->exists("ListQuery"))
	{
		$arrFieldForSort = array();
		$arrHowFieldSort = array();
		require_once getabspath('classes/orderclause.php');
		$fieldList = unserialize($_SESSION[$strTableName."_orderFieldsList"]);
		for($i = 0; $i < count($fieldList); $i++)
		{
			$arrFieldForSort[] = $fieldList[$i]->fieldIndex; 
			$arrHowFieldSort[] = $fieldList[$i]->orderDirection; 
		}
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort,
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $nPageSize, $mypage, $pageObject);
	}
	if($listarray!==false)
		$rs = $listarray;
	elseif($nPageSize>0)
	{
					$rs = db_query($strSQL,$conn);
	}
	else
		$rs = db_query($strSQL,$conn);

	if(!ini_get("safe_mode"))
		set_time_limit(300);
	
	if(substr(@$_REQUEST["type"],0,5)=="excel")
	{
//	remove grouping
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SMONGROUPING"]="0";
				if($phpVersion > 4)
			ExportToExcel($cipherer, $pageObject);
		else
			ExportToExcel_old($cipherer);
	}
	else if(@$_REQUEST["type"]=="word")
	{
		ExportToWord($cipherer);
	}
	else if(@$_REQUEST["type"]=="xml")
	{
		ExportToXML($cipherer);
	}
	else if(@$_REQUEST["type"]=="csv")
	{
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SDECIMAL"]=".";
		$locale_info["LOCALE_SMONGROUPING"]="0";
		$locale_info["LOCALE_SMONDECIMALSEP"]=".";
		ExportToCSV($cipherer);
	}
	db_close($conn);
	return;
}

// add button events if exist
$pageObject->addButtonHandlers();

if($options)
{
	$xt->assign("rangeheader_block",true);
	$xt->assign("range_block",true);
}

$xt->assign("exportlink_attrs", 'id="saveButton'.$pageObject->id.'"');

$pageObject->body["begin"] .="<script type=\"text/javascript\" src=\"include/loadfirst.js\"></script>\r\n";
$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";

$pageObject->fillSetCntrlMaps();
$pageObject->body['end'] .= '<script>';
$pageObject->body['end'] .= "window.controlsMap = ".my_json_encode($pageObject->controlsHTMLMap).";";
$pageObject->body['end'] .= "window.viewControlsMap = ".my_json_encode($pageObject->viewControlsHTMLMap).";";
$pageObject->body['end'] .= "window.settings = ".my_json_encode($pageObject->jsSettings).";";
$pageObject->body['end'] .= '</script>';
$pageObject->body["end"] .= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerAll.js\"></script>\r\n";
$pageObject->addCommonJs();

$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";
$xt->assignbyref("body",$pageObject->body);

$xt->display("devotee_donation_export.htm");

function ExportToExcel_old($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=devotee_donation.xls");

	echo "<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData($cipherer);

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=devotee_donation.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData($cipherer);

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML($cipherer)
{
	global $nPageSize,$rs,$strTableName,$conn,$eventObj, $pageObject;
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment;Filename=devotee_donation.xml");
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);	
	//if(!$row)
	//	return;
		
	global $cCharset;
	
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i = 0;
	$pageObject->viewControls->forExport = "xml";
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		$values = array();
			$values["DevoteeId"] = $pageObject->showDBValue("DevoteeId", $row);
			$values["DonationDate"] = $pageObject->showDBValue("DonationDate", $row);
			$values["DonationOnName"] = $pageObject->showDBValue("DonationOnName", $row);
			$values["DonationOnNamePanNumber"] = $pageObject->showDBValue("DonationOnNamePanNumber", $row);
			$values["DonationPurposeId"] = $pageObject->showDBValue("DonationPurposeId", $row);
			$values["Amount"] = $pageObject->showDBValue("Amount", $row);
			$values["ReceiptNumber"] = $pageObject->showDBValue("ReceiptNumber", $row);
			$values["DonationMode"] = $pageObject->showDBValue("DonationMode", $row);
			$values["CheckNumber"] = $pageObject->showDBValue("CheckNumber", $row);
			$values["CheckBank"] = $pageObject->showDBValue("CheckBank", $row);
			$values["CheckBranch"] = $pageObject->showDBValue("CheckBranch", $row);
			$values["CheckCleared"] = $pageObject->showDBValue("CheckCleared", $row);
			$values["CheckClearedDate"] = $pageObject->showDBValue("CheckClearedDate", $row);
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
			$eventRes = $eventObj->BeforeOut($row, $values, $pageObject);
		
		if ($eventRes)
		{
			$i++;
			echo "<row>\r\n";
			foreach ($values as $fName => $val)
			{
				$field = htmlspecialchars(XMLNameEncode($fName));
				echo "<".$field.">";
				echo $values[$fName];
				echo "</".$field.">\r\n";
			}
			echo "</row>\r\n";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
	}
	echo "</table>\r\n";
}

function ExportToCSV($cipherer)
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj, $pageObject;
	header("Content-Type: application/csv");
	header("Content-Disposition: attachment;Filename=devotee_donation.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DevoteeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DonationDate\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DonationOnName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DonationOnNamePanNumber\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DonationPurposeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Amount\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"ReceiptNumber\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DonationMode\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"CheckNumber\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"CheckBank\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"CheckBranch\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"CheckCleared\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"CheckClearedDate\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "csv";
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$values["DevoteeId"] = $pageObject->getViewControl("DevoteeId")->showDBValue($row, "");
			$values["DonationDate"] = $pageObject->getViewControl("DonationDate")->showDBValue($row, "");
			$values["DonationOnName"] = $pageObject->getViewControl("DonationOnName")->showDBValue($row, "");
			$values["DonationOnNamePanNumber"] = $pageObject->getViewControl("DonationOnNamePanNumber")->showDBValue($row, "");
			$values["DonationPurposeId"] = $pageObject->getViewControl("DonationPurposeId")->showDBValue($row, "");
			$values["Amount"] = $pageObject->getViewControl("Amount")->showDBValue($row, "");
			$values["ReceiptNumber"] = $pageObject->getViewControl("ReceiptNumber")->showDBValue($row, "");
			$values["DonationMode"] = $pageObject->getViewControl("DonationMode")->showDBValue($row, "");
			$values["CheckNumber"] = $pageObject->getViewControl("CheckNumber")->showDBValue($row, "");
			$values["CheckBank"] = $pageObject->getViewControl("CheckBank")->showDBValue($row, "");
			$values["CheckBranch"] = $pageObject->getViewControl("CheckBranch")->showDBValue($row, "");
			$values["CheckCleared"] = $pageObject->getViewControl("CheckCleared")->showDBValue($row, "");
			$values["CheckClearedDate"] = $pageObject->getViewControl("CheckClearedDate")->showDBValue($row, "");

		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row,$values, $pageObject);
		}
		if ($eventRes)
		{
			$outstr="";
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DevoteeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DonationDate"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DonationOnName"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DonationOnNamePanNumber"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DonationPurposeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Amount"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["ReceiptNumber"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DonationMode"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["CheckNumber"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["CheckBank"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["CheckBranch"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["CheckCleared"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["CheckClearedDate"]).'"';
			echo $outstr;
		}
		
		$iNumberOfRows++;
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
			
		if(((!$nPageSize || $iNumberOfRows<$nPageSize) && $row) && $eventRes)
			echo "\r\n";
	}
}

function WriteTableData($cipherer)
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj, $pageObject;
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);
//	if(!$row)
//		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Donation Date").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Donation On Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Donation On Name Pan Number").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Donation Purpose Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Amount").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Receipt Number").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Donation Mode").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Check Number").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Check Bank").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Check Branch").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Check Cleared").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Check Cleared Date").'</td>';	
	}
	else
	{
		echo "<td>"."Devotee Id"."</td>";
		echo "<td>"."Donation Date"."</td>";
		echo "<td>"."Donation On Name"."</td>";
		echo "<td>"."Donation On Name Pan Number"."</td>";
		echo "<td>"."Donation Purpose Id"."</td>";
		echo "<td>"."Amount"."</td>";
		echo "<td>"."Receipt Number"."</td>";
		echo "<td>"."Donation Mode"."</td>";
		echo "<td>"."Check Number"."</td>";
		echo "<td>"."Check Bank"."</td>";
		echo "<td>"."Check Branch"."</td>";
		echo "<td>"."Check Cleared"."</td>";
		echo "<td>"."Check Cleared Date"."</td>";
	}
	echo "</tr>";
			$totals = array();
		$totals["Amount"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"Amount", 'totalsType'=>'TOTAL', 'viewFormat'=>"");
	
// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "export";
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					$values["DevoteeId"] = $pageObject->getViewControl("DevoteeId")->showDBValue($row, "");
					$values["DonationDate"] = $pageObject->getViewControl("DonationDate")->showDBValue($row, "");
					$values["DonationOnName"] = $pageObject->getViewControl("DonationOnName")->showDBValue($row, "");
					$values["DonationOnNamePanNumber"] = $pageObject->getViewControl("DonationOnNamePanNumber")->showDBValue($row, "");
					$values["DonationPurposeId"] = $pageObject->getViewControl("DonationPurposeId")->showDBValue($row, "");
					$values["Amount"] = $pageObject->getViewControl("Amount")->showDBValue($row, "");
					$values["ReceiptNumber"] = $pageObject->getViewControl("ReceiptNumber")->showDBValue($row, "");
					$values["DonationMode"] = $pageObject->getViewControl("DonationMode")->showDBValue($row, "");
					$values["CheckNumber"] = $pageObject->getViewControl("CheckNumber")->showDBValue($row, "");
					$values["CheckBank"] = $pageObject->getViewControl("CheckBank")->showDBValue($row, "");
					$values["CheckBranch"] = $pageObject->getViewControl("CheckBranch")->showDBValue($row, "");
					$values["CheckCleared"] = $pageObject->getViewControl("CheckCleared")->showDBValue($row, "");
					$values["CheckClearedDate"] = $pageObject->getViewControl("CheckClearedDate")->showDBValue($row, "");
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row, $values, $pageObject);
		}
		if ($eventRes)
		{
			$iNumberOfRows++;
			echo "<tr>";
		
							echo '<td>';
			
									echo $values["DevoteeId"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DonationDate"]);
					else
						echo $values["DonationDate"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DonationOnName"]);
					else
						echo $values["DonationOnName"];
			echo '</td>';
							echo '<td>';
			
									echo $values["DonationOnNamePanNumber"];
			echo '</td>';
							echo '<td>';
			
				
								if($_REQUEST["type"]=="excel")
					echo PrepareForExcel($values["DonationPurposeId"]);
				else
					echo $values["DonationPurposeId"];//echo htmlspecialchars($values["DonationPurposeId"]); commented for bug #6823
					
			echo '</td>';
							echo '<td>';
			
									echo $values["Amount"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["ReceiptNumber"]);
					else
						echo $values["ReceiptNumber"];
			echo '</td>';
							echo '<td>';
			
				
								if($_REQUEST["type"]=="excel")
					echo PrepareForExcel($values["DonationMode"]);
				else
					echo $values["DonationMode"];//echo htmlspecialchars($values["DonationMode"]); commented for bug #6823
					
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["CheckNumber"]);
					else
						echo $values["CheckNumber"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["CheckBank"]);
					else
						echo $values["CheckBank"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["CheckBranch"]);
					else
						echo $values["CheckBranch"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["CheckCleared"]);
					else
						echo $values["CheckCleared"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["CheckClearedDate"]);
					else
						echo $values["CheckClearedDate"];
			echo '</td>';
			echo "</tr>";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
	}
	
	echo "<tr>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
						echo "Total".": ";
	echo htmlspecialchars(GetTotals("Amount", $totals["Amount"]["value"], "TOTAL", $totals["Amount"]["numRows"], "", PAGE_EXPORT));
	echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "<td>";
		echo "</td>";
	echo "</tr>";
}

function XMLNameEncode($strValue)
{
	$search = array(" ","#","'","/","\\","(",")",",","[");
	$ret = str_replace($search,"",$strValue);
	$search = array("]","+","\"","-","_","|","}","{","=");
	$ret = str_replace($search,"",$ret);
	return $ret;
}

function PrepareForExcel($ret)
{
	//$ret = htmlspecialchars($str); commented for bug #6823
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}

function countTotals(&$totals, $totalsFields, $data)
{
	for($i = 0; $i < count($totalsFields); $i ++) 
	{
		if($totalsFields[$i]['totalsType'] == 'COUNT') 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]!= "");
		else if($totalsFields[$i]['viewFormat'] == "Time") 
		{
			$time = GetTotalsForTime($data[$totalsFields[$i]['fName']]);
			$totals[$totalsFields[$i]['fName']]["value"] += $time[2]+$time[1]*60 + $time[0]*3600;
		} 
		else 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]+ 0);
		
		if($totalsFields[$i]['totalsType'] == 'AVERAGE')
		{
			if(!is_null($data[$totalsFields[$i]['fName']]) && $data[$totalsFields[$i]['fName']]!=="")
				$totals[$totalsFields[$i]['fName']]['numRows']++;
		}
	}
}
?>
