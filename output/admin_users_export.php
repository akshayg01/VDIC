<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

include("include/admin_users_variables.php");

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
$layout->blocks["top"][] = "export";$page_layouts["admin_users_export"] = $layout;


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
			$keys["DevoteeId"] = refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
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
			$keys["DevoteeId"] = urldecode($arr[0]);
			$selected_recs[] = $keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}

	$sWhere = whereAdd($sWhere,SecuritySQL("Search"));

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
	if($strWhereClause == "")
		$strWhereClause = whereAdd($strWhereClause,SecuritySQL("Search"));
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

$xt->display("admin_users_export.htm");

function ExportToExcel_old($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=admin_users.xls");

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
	header("Content-Disposition: attachment;Filename=admin_users.doc");

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
	header("Content-Disposition: attachment;Filename=admin_users.xml");
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
			$values["TitleId"] = $pageObject->showDBValue("TitleId", $row);
			$values["Photo"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["FirstName"] = $pageObject->showDBValue("FirstName", $row);
			$values["LastName"] = $pageObject->showDBValue("LastName", $row);
			$values["MiddleName"] = $pageObject->showDBValue("MiddleName", $row);
			$values["Gender"] = $pageObject->showDBValue("Gender", $row);
			$values["DateOfBirth"] = $pageObject->showDBValue("DateOfBirth", $row);
			$values["MaritalStatusId"] = $pageObject->showDBValue("MaritalStatusId", $row);
			$values["DateofMarriage"] = $pageObject->showDBValue("DateofMarriage", $row);
			$values["SpouseDevoteeId"] = $pageObject->showDBValue("SpouseDevoteeId", $row);
			$values["MobilePhone"] = $pageObject->showDBValue("MobilePhone", $row);
			$values["WorkPhone"] = $pageObject->showDBValue("WorkPhone", $row);
			$values["EmailPrimary"] = $pageObject->showDBValue("EmailPrimary", $row);
			$values["EmailSecondary"] = $pageObject->showDBValue("EmailSecondary", $row);
			$values["Password"] = $pageObject->showDBValue("Password", $row);
		
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
	header("Content-Disposition: attachment;Filename=admin_users.csv");
	
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
	$outstr.= "\"TitleId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Photo\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"FirstName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"LastName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"MiddleName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Gender\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DateOfBirth\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"MaritalStatusId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DateofMarriage\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"SpouseDevoteeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"MobilePhone\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"WorkPhone\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"EmailPrimary\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"EmailSecondary\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Password\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "csv";
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$values["DevoteeId"] = $pageObject->getViewControl("DevoteeId")->showDBValue($row, "");
			$values["TitleId"] = $pageObject->getViewControl("TitleId")->showDBValue($row, "");
		$values["Photo"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["FirstName"] = $pageObject->getViewControl("FirstName")->showDBValue($row, "");
			$values["LastName"] = $pageObject->getViewControl("LastName")->showDBValue($row, "");
			$values["MiddleName"] = $pageObject->getViewControl("MiddleName")->showDBValue($row, "");
			$values["Gender"] = $pageObject->getViewControl("Gender")->showDBValue($row, "");
			$values["DateOfBirth"] = $pageObject->getViewControl("DateOfBirth")->showDBValue($row, "");
			$values["MaritalStatusId"] = $pageObject->getViewControl("MaritalStatusId")->showDBValue($row, "");
			$values["DateofMarriage"] = $pageObject->getViewControl("DateofMarriage")->showDBValue($row, "");
			$values["SpouseDevoteeId"] = $pageObject->getViewControl("SpouseDevoteeId")->showDBValue($row, "");
			$values["MobilePhone"] = $pageObject->getViewControl("MobilePhone")->showDBValue($row, "");
			$values["WorkPhone"] = $pageObject->getViewControl("WorkPhone")->showDBValue($row, "");
			$values["EmailPrimary"] = $pageObject->getViewControl("EmailPrimary")->showDBValue($row, "");
			$values["EmailSecondary"] = $pageObject->getViewControl("EmailSecondary")->showDBValue($row, "");
			$values["Password"] = $pageObject->getViewControl("Password")->showDBValue($row, "");

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
			$outstr.='"'.str_replace('"', '""', $values["TitleId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Photo"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["FirstName"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["LastName"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["MiddleName"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Gender"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DateOfBirth"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["MaritalStatusId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DateofMarriage"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["SpouseDevoteeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["MobilePhone"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["WorkPhone"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["EmailPrimary"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["EmailSecondary"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Password"]).'"';
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
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Title Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Photo").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("First Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Last Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Middle Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Gender").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Date Of Birth").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Marital Status Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Dateof Marriage").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Spouse Devotee Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Mobile Phone").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Work Phone").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Email Primary").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Email Secondary").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Password").'</td>';	
	}
	else
	{
		echo "<td>"."Devotee Id"."</td>";
		echo "<td>"."Title Id"."</td>";
		echo "<td>"."Photo"."</td>";
		echo "<td>"."First Name"."</td>";
		echo "<td>"."Last Name"."</td>";
		echo "<td>"."Middle Name"."</td>";
		echo "<td>"."Gender"."</td>";
		echo "<td>"."Date Of Birth"."</td>";
		echo "<td>"."Marital Status Id"."</td>";
		echo "<td>"."Dateof Marriage"."</td>";
		echo "<td>"."Spouse Devotee Id"."</td>";
		echo "<td>"."Mobile Phone"."</td>";
		echo "<td>"."Work Phone"."</td>";
		echo "<td>"."Email Primary"."</td>";
		echo "<td>"."Email Secondary"."</td>";
		echo "<td>"."Password"."</td>";
	}
	echo "</tr>";
			$totals = array();
		$totals["DevoteeId"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"DevoteeId", 'totalsType'=>'COUNT', 'viewFormat'=>"");
	
// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "export";
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					$values["DevoteeId"] = $pageObject->getViewControl("DevoteeId")->showDBValue($row, "");
					$values["TitleId"] = $pageObject->getViewControl("TitleId")->showDBValue($row, "");
					$values["Photo"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
					$values["FirstName"] = $pageObject->getViewControl("FirstName")->showDBValue($row, "");
					$values["LastName"] = $pageObject->getViewControl("LastName")->showDBValue($row, "");
					$values["MiddleName"] = $pageObject->getViewControl("MiddleName")->showDBValue($row, "");
					$values["Gender"] = $pageObject->getViewControl("Gender")->showDBValue($row, "");
					$values["DateOfBirth"] = $pageObject->getViewControl("DateOfBirth")->showDBValue($row, "");
					$values["MaritalStatusId"] = $pageObject->getViewControl("MaritalStatusId")->showDBValue($row, "");
					$values["DateofMarriage"] = $pageObject->getViewControl("DateofMarriage")->showDBValue($row, "");
					$values["SpouseDevoteeId"] = $pageObject->getViewControl("SpouseDevoteeId")->showDBValue($row, "");
					$values["MobilePhone"] = $pageObject->getViewControl("MobilePhone")->showDBValue($row, "");
					$values["WorkPhone"] = $pageObject->getViewControl("WorkPhone")->showDBValue($row, "");
					$values["EmailPrimary"] = $pageObject->getViewControl("EmailPrimary")->showDBValue($row, "");
					$values["EmailSecondary"] = $pageObject->getViewControl("EmailSecondary")->showDBValue($row, "");
					$values["Password"] = $pageObject->getViewControl("Password")->showDBValue($row, "");
		
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
			
									echo $values["TitleId"];
			echo '</td>';
							echo '<td>';
			
				echo $values["Photo"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["FirstName"]);
					else
						echo $values["FirstName"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["LastName"]);
					else
						echo $values["LastName"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["MiddleName"]);
					else
						echo $values["MiddleName"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Gender"]);
					else
						echo $values["Gender"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DateOfBirth"]);
					else
						echo $values["DateOfBirth"];
			echo '</td>';
							echo '<td>';
			
									echo $values["MaritalStatusId"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DateofMarriage"]);
					else
						echo $values["DateofMarriage"];
			echo '</td>';
							echo '<td>';
			
									echo $values["SpouseDevoteeId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["MobilePhone"];
			echo '</td>';
							echo '<td>';
			
									echo $values["WorkPhone"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["EmailPrimary"]);
					else
						echo $values["EmailPrimary"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["EmailSecondary"]);
					else
						echo $values["EmailSecondary"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Password"]);
					else
						echo $values["Password"];
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
						echo "Count".": ";
	echo htmlspecialchars(GetTotals("DevoteeId", $totals["DevoteeId"]["value"], "COUNT", $totals["DevoteeId"]["numRows"], "", PAGE_EXPORT));
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
