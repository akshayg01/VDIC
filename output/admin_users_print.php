<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("classes/searchclause.php");

add_nocache_headers();

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

$layout = new TLayout("print","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"printgrid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "empty";
$layout->blocks["center"][] = "grid";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";$page_layouts["admin_users_print"] = $layout;


include('include/xtempl.php');
include('classes/runnerpage.php');

$cipherer = new RunnerCipherer($strTableName);

$xt = new Xtempl();
$id = postvalue("id") != "" ? postvalue("id") : 1;
$all = postvalue("all");
$pageName = "print.php";

//array of params for classes
$params = array("id" => $id,
				"tName" => $strTableName,
				"pageType" => PAGE_PRINT);
$params["xt"] = &$xt;
			
$pageObject = new RunnerPage($params);

// add button events if exist
$pageObject->addButtonHandlers();

// Modify query: remove blob fields from fieldlist.
// Blob fields on a print page are shown using imager.php (for example).
// They don't need to be selected from DB in print.php itself.
$noBlobReplace = false;
// Photo
$noBlobReplace = true;
if(!postvalue("pdf") && !$noBlobReplace)
	$gQuery->ReplaceFieldsWithDummies($pageObject->pSet->getBinaryFieldsIndices());

//	Before Process event
if($eventObj->exists("BeforeProcessPrint"))
	$eventObj->BeforeProcessPrint($conn, $pageObject);

$strWhereClause="";
$strHavingClause="";
$strSearchCriteria="and";

$selected_recs=array();
if (@$_REQUEST["a"]!="") 
{
	$sWhere = "1=0";	
	
//	process selection
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["DevoteeId"]=refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
			$selected_recs[]=$keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=explode("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys=array();
			$keys["DevoteeId"]=urldecode($arr[0]);
			$selected_recs[]=$keys;
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
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strHavingClause=@$_SESSION[$strTableName."_having"];
	$strSearchCriteria=@$_SESSION[$strTableName."_criteria"];
	if(!$strWhereClause)
		$strWhereClause = whereAdd($strWhereClause,SecuritySQL("Search"));
	$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
}
if(postvalue("pdf"))
	$strWhereClause = @$_SESSION[$strTableName."_pdfwhere"];

$_SESSION[$strTableName."_pdfwhere"] = $strWhereClause;


$strOrderBy = $_SESSION[$strTableName."_order"];
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;
$strSQL.=" ".trim($strOrderBy);

$strSQLbak = $strSQL;
if($eventObj->exists("BeforeQueryPrint"))
	$eventObj->BeforeQueryPrint($strSQL,$strWhereClause,$strOrderBy, $pageObject);

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
			$masterKeysReq[]=$_SESSION[$strTableName."_masterkey".($i + 1)];
			$rowcount=$eventObj->ListGetRowCount($pageObject->searchClauseObj,$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs, $pageObject);
	}
	if($rowcount!==false)
		$numrows=$rowcount;
	else
	{
		$numrows = $gQuery->gSQLRowCount($strWhereClause, $strHavingClause, $strSearchCriteria);
	}
}

LogInfo($strSQL);

$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize = $pageObject->pSet->getInitialPageSize();

if($PageSize<0)
	$all = 1;	
	
$recno = 1;
$records = 0;	
$maxpages = 1;
$pageindex = 1;
$pageno=1;

// build arrays for sort (to support old code in user-defined events)
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
}

if(!$all)
{	
	if($numrows)
	{
		$maxRecords = $numrows;
		$maxpages = ceil($maxRecords/$PageSize);
					
		if($mypage > $maxpages)
			$mypage = $maxpages;
		
		if($mypage < 1) 
			$mypage = 1;
		
		$maxrecs = $PageSize;
	}
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort, 
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $PageSize, $mypage, $pageObject);
	if($listarray!==false)
		$rs = $listarray;
	else
	{
			if($numrows)
		{
			$strSQL.=" limit ".(($mypage-1)*$PageSize).",".$PageSize;
		}
		$rs = db_query($strSQL,$conn);
	}
	
	//	hide colunm headers if needed
	$recordsonpage = $numrows-($mypage-1)*$PageSize;
	if($recordsonpage>$PageSize)
		$recordsonpage = $PageSize;
		
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
	$xt->assign("pageno",$mypage);
}
else
{
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray=$eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort,
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $PageSize, $mypage, $pageObject);
	if($listarray!==false)
		$rs = $listarray;
	else
		$rs = db_query($strSQL,$conn);
	$recordsonpage = $numrows;
	$maxpages = ceil($recordsonpage/30);
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
}


$fieldsArr = array();
$arr = array();
$arr['fName'] = "DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "TitleId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("TitleId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Photo";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Photo");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "FirstName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("FirstName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "LastName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("LastName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "MiddleName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("MiddleName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Gender";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Gender");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfBirth";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfBirth");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "MaritalStatusId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("MaritalStatusId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateofMarriage";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateofMarriage");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "SpouseDevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("SpouseDevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "MobilePhone";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("MobilePhone");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "WorkPhone";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("WorkPhone");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "EmailPrimary";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("EmailPrimary");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "EmailSecondary";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("EmailSecondary");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Password";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Password");
$fieldsArr[] = $arr;
$pageObject->setGoogleMapsParams($fieldsArr);

$colsonpage=1;
if($colsonpage>$recordsonpage)
	$colsonpage=$recordsonpage;
if($colsonpage<1)
	$colsonpage=1;

	$totals = array();
	$totals["DevoteeId"] = array("value" => 0, "numRows" => 0);

//	fill $rowinfo array
	$pages = array();
	$rowinfo = array();
	$rowinfo["data"] = array();
	if($eventObj->exists("ListFetchArray"))
		$data = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$data = $cipherer->DecryptFetchedArray($rs);

	while($data)
	{
		if($eventObj->exists("BeforeProcessRowPrint"))
		{
			if(!$eventObj->BeforeProcessRowPrint($data, $pageObject))
			{
				if($eventObj->exists("ListFetchArray"))
					$data = $eventObj->ListFetchArray($rs, $pageObject);
				else
					$data = $cipherer->DecryptFetchedArray($rs);
				continue;
			}
		}
		break;
	}
	
	while($data && ($all || $recno<=$PageSize))
	{
		$row = array();
		$row["grid_record"] = array();
		$row["grid_record"]["data"] = array();
		for($col=1;$data && ($all || $recno<=$PageSize) && $col<=1;$col++)
		{
			$record = array();
						$totals["DevoteeId"]["value"] += ($data["DevoteeId"]!="");
						$recno++;
			$records++;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));

//	DevoteeId - 
			$record["DevoteeId_value"] = $pageObject->showDBValue("DevoteeId", $data, $keylink);
			$record["DevoteeId_class"] = $pageObject->fieldClass("DevoteeId");
//	TitleId - 
			$record["TitleId_value"] = $pageObject->showDBValue("TitleId", $data, $keylink);
			$record["TitleId_class"] = $pageObject->fieldClass("TitleId");
//	Photo - Database Image
			$record["Photo_value"] = $pageObject->showDBValue("Photo", $data, $keylink);
			$record["Photo_class"] = $pageObject->fieldClass("Photo");
//	FirstName - 
			$record["FirstName_value"] = $pageObject->showDBValue("FirstName", $data, $keylink);
			$record["FirstName_class"] = $pageObject->fieldClass("FirstName");
//	LastName - 
			$record["LastName_value"] = $pageObject->showDBValue("LastName", $data, $keylink);
			$record["LastName_class"] = $pageObject->fieldClass("LastName");
//	MiddleName - 
			$record["MiddleName_value"] = $pageObject->showDBValue("MiddleName", $data, $keylink);
			$record["MiddleName_class"] = $pageObject->fieldClass("MiddleName");
//	Gender - 
			$record["Gender_value"] = $pageObject->showDBValue("Gender", $data, $keylink);
			$record["Gender_class"] = $pageObject->fieldClass("Gender");
//	DateOfBirth - Short Date
			$record["DateOfBirth_value"] = $pageObject->showDBValue("DateOfBirth", $data, $keylink);
			$record["DateOfBirth_class"] = $pageObject->fieldClass("DateOfBirth");
//	MaritalStatusId - 
			$record["MaritalStatusId_value"] = $pageObject->showDBValue("MaritalStatusId", $data, $keylink);
			$record["MaritalStatusId_class"] = $pageObject->fieldClass("MaritalStatusId");
//	DateofMarriage - Short Date
			$record["DateofMarriage_value"] = $pageObject->showDBValue("DateofMarriage", $data, $keylink);
			$record["DateofMarriage_class"] = $pageObject->fieldClass("DateofMarriage");
//	SpouseDevoteeId - 
			$record["SpouseDevoteeId_value"] = $pageObject->showDBValue("SpouseDevoteeId", $data, $keylink);
			$record["SpouseDevoteeId_class"] = $pageObject->fieldClass("SpouseDevoteeId");
//	MobilePhone - 
			$record["MobilePhone_value"] = $pageObject->showDBValue("MobilePhone", $data, $keylink);
			$record["MobilePhone_class"] = $pageObject->fieldClass("MobilePhone");
//	WorkPhone - 
			$record["WorkPhone_value"] = $pageObject->showDBValue("WorkPhone", $data, $keylink);
			$record["WorkPhone_class"] = $pageObject->fieldClass("WorkPhone");
//	EmailPrimary - 
			$record["EmailPrimary_value"] = $pageObject->showDBValue("EmailPrimary", $data, $keylink);
			$record["EmailPrimary_class"] = $pageObject->fieldClass("EmailPrimary");
//	EmailSecondary - 
			$record["EmailSecondary_value"] = $pageObject->showDBValue("EmailSecondary", $data, $keylink);
			$record["EmailSecondary_class"] = $pageObject->fieldClass("EmailSecondary");
//	Password - 
			$record["Password_value"] = $pageObject->showDBValue("Password", $data, $keylink);
			$record["Password_class"] = $pageObject->fieldClass("Password");
			if($col<$colsonpage)
				$record["endrecord_block"] = true;
			$record["grid_recordheader"] = true;
			$record["grid_vrecord"] = true;
			
			if($eventObj->exists("BeforeMoveNextPrint"))
				$eventObj->BeforeMoveNextPrint($data,$row,$record, $pageObject);
				
			$row["grid_record"]["data"][] = $record;
			
			if($eventObj->exists("ListFetchArray"))
				$data = $eventObj->ListFetchArray($rs, $pageObject);
			else
				$data = $cipherer->DecryptFetchedArray($rs);
				
			while($data)
			{
				if($eventObj->exists("BeforeProcessRowPrint"))
				{
					if(!$eventObj->BeforeProcessRowPrint($data, $pageObject))
					{
						if($eventObj->exists("ListFetchArray"))
							$data = $eventObj->ListFetchArray($rs, $pageObject);
						else
							$data = $cipherer->DecryptFetchedArray($rs);
						continue;
					}
				}
				break;
			}
		}
		if($col <= $colsonpage)
		{
			$row["grid_record"]["data"][count($row["grid_record"]["data"])-1]["endrecord_block"] = false;
		}
		$row["grid_rowspace"]=true;
		$row["grid_recordspace"] = array("data"=>array());
		for($i=0;$i<$colsonpage*2-1;$i++)
			$row["grid_recordspace"]["data"][]=true;
		
		$rowinfo["data"][]=$row;
		
		if($all && $records>=30)
		{
			$page=array("grid_row" =>$rowinfo);
			$page["pageno"]=$pageindex;
			$pageindex++;
			$pages[] = $page;
			$records=0;
			$rowinfo=array();
		}
		
	}
	if(count($rowinfo))
	{
		$page=array("grid_row" =>$rowinfo);
		if($all)
			$page["pageno"]=$pageindex;
		$pages[] = $page;
	}
	
	for($i=0;$i<count($pages);$i++)
	{
	 	if($i<count($pages)-1)
			$pages[$i]["begin"]="<div name=page class=printpage>";
		else
		    $pages[$i]["begin"]="<div name=page>";
			
		$pages[$i]["end"]="</div>";
	}

	$page = array();
	$page["data"] = &$pages;
	$xt->assignbyref("page",$page);

//	show totals
//	process totals
	$record = array();
	$total = GetTotals("DevoteeId", $totals["DevoteeId"]["value"], "COUNT", $totals["DevoteeId"]["numRows"], "", PAGE_PRINT);
	$record["DevoteeId_total"] = $total;
	$record["DevoteeId_showtotal"] = true;
	$xt->assign("totals_record",true);
	if(count($pages))
	{
		$pages[count($pages)-1]["totals_row"]=array("data"=>array(0=>$record));
	}
	
	

$strSQL = $_SESSION[$strTableName."_sql"];

$isPdfView = false;
$hasEvents = false;
if ($pageObject->pSet->isUsebuttonHandlers() || $isPdfView || $hasEvents)
{
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
}


if ($pageObject->pSet->isUsebuttonHandlers() || $isPdfView || $hasEvents)
	$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";

$xt->assignbyref("body",$pageObject->body);
$xt->assign("grid_block",true);

$xt->assign("DevoteeId_fieldheadercolumn",true);
$xt->assign("DevoteeId_fieldheader",true);
$xt->assign("DevoteeId_fieldcolumn",true);
$xt->assign("DevoteeId_fieldfootercolumn",true);
$xt->assign("TitleId_fieldheadercolumn",true);
$xt->assign("TitleId_fieldheader",true);
$xt->assign("TitleId_fieldcolumn",true);
$xt->assign("TitleId_fieldfootercolumn",true);
$xt->assign("Photo_fieldheadercolumn",true);
$xt->assign("Photo_fieldheader",true);
$xt->assign("Photo_fieldcolumn",true);
$xt->assign("Photo_fieldfootercolumn",true);
$xt->assign("FirstName_fieldheadercolumn",true);
$xt->assign("FirstName_fieldheader",true);
$xt->assign("FirstName_fieldcolumn",true);
$xt->assign("FirstName_fieldfootercolumn",true);
$xt->assign("LastName_fieldheadercolumn",true);
$xt->assign("LastName_fieldheader",true);
$xt->assign("LastName_fieldcolumn",true);
$xt->assign("LastName_fieldfootercolumn",true);
$xt->assign("MiddleName_fieldheadercolumn",true);
$xt->assign("MiddleName_fieldheader",true);
$xt->assign("MiddleName_fieldcolumn",true);
$xt->assign("MiddleName_fieldfootercolumn",true);
$xt->assign("Gender_fieldheadercolumn",true);
$xt->assign("Gender_fieldheader",true);
$xt->assign("Gender_fieldcolumn",true);
$xt->assign("Gender_fieldfootercolumn",true);
$xt->assign("DateOfBirth_fieldheadercolumn",true);
$xt->assign("DateOfBirth_fieldheader",true);
$xt->assign("DateOfBirth_fieldcolumn",true);
$xt->assign("DateOfBirth_fieldfootercolumn",true);
$xt->assign("MaritalStatusId_fieldheadercolumn",true);
$xt->assign("MaritalStatusId_fieldheader",true);
$xt->assign("MaritalStatusId_fieldcolumn",true);
$xt->assign("MaritalStatusId_fieldfootercolumn",true);
$xt->assign("DateofMarriage_fieldheadercolumn",true);
$xt->assign("DateofMarriage_fieldheader",true);
$xt->assign("DateofMarriage_fieldcolumn",true);
$xt->assign("DateofMarriage_fieldfootercolumn",true);
$xt->assign("SpouseDevoteeId_fieldheadercolumn",true);
$xt->assign("SpouseDevoteeId_fieldheader",true);
$xt->assign("SpouseDevoteeId_fieldcolumn",true);
$xt->assign("SpouseDevoteeId_fieldfootercolumn",true);
$xt->assign("MobilePhone_fieldheadercolumn",true);
$xt->assign("MobilePhone_fieldheader",true);
$xt->assign("MobilePhone_fieldcolumn",true);
$xt->assign("MobilePhone_fieldfootercolumn",true);
$xt->assign("WorkPhone_fieldheadercolumn",true);
$xt->assign("WorkPhone_fieldheader",true);
$xt->assign("WorkPhone_fieldcolumn",true);
$xt->assign("WorkPhone_fieldfootercolumn",true);
$xt->assign("EmailPrimary_fieldheadercolumn",true);
$xt->assign("EmailPrimary_fieldheader",true);
$xt->assign("EmailPrimary_fieldcolumn",true);
$xt->assign("EmailPrimary_fieldfootercolumn",true);
$xt->assign("EmailSecondary_fieldheadercolumn",true);
$xt->assign("EmailSecondary_fieldheader",true);
$xt->assign("EmailSecondary_fieldcolumn",true);
$xt->assign("EmailSecondary_fieldfootercolumn",true);
$xt->assign("Password_fieldheadercolumn",true);
$xt->assign("Password_fieldheader",true);
$xt->assign("Password_fieldcolumn",true);
$xt->assign("Password_fieldfootercolumn",true);

	$record_header=array("data"=>array());
	$record_footer=array("data"=>array());
	for($i=0;$i<$colsonpage;$i++)
	{
		$rheader=array();
		$rfooter=array();
		if($i<$colsonpage-1)
		{
			$rheader["endrecordheader_block"]=true;
			$rfooter["endrecordheader_block"]=true;
		}
		$record_header["data"][]=$rheader;
		$record_footer["data"][]=$rfooter;
	}
	$xt->assignbyref("record_header",$record_header);
	$xt->assignbyref("record_footer",$record_footer);
	$xt->assign("grid_header",true);
	$xt->assign("grid_footer",true);

if($eventObj->exists("BeforeShowPrint"))
	$eventObj->BeforeShowPrint($xt,$pageObject->templatefile, $pageObject);

if(!postvalue("pdf"))
	$xt->display($pageObject->templatefile);
else
{
	$xt->load_template($pageObject->templatefile);
	$page = $xt->fetch_loaded();
	$pagewidth=postvalue("width")*1.05;
	$pageheight=postvalue("height")*1.05;
	$landscape=false;
		if($pagewidth>$pageheight)
		{
			$landscape=true;
			if($pagewidth/$pageheight<297/210)
				$pagewidth = 297/210*$pageheight;
		}
		else
		{
			if($pagewidth/$pageheight<210/297)
				$pagewidth = 210/297*$pageheight;
		}
}
?>
