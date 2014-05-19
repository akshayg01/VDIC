<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("classes/searchclause.php");

add_nocache_headers();

include("include/devotee_variables.php");

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
$layout->blocks["top"][] = "pdf";$page_layouts["devotee_print"] = $layout;


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
	$strSQL = $gQuery->gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strHavingClause=@$_SESSION[$strTableName."_having"];
	$strSearchCriteria=@$_SESSION[$strTableName."_criteria"];
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
$arr['fName'] = "CounsellorDevoteeID";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CounsellorDevoteeID");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "NativeCity";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("NativeCity");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "NativeState";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("NativeState");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "BloodGroup";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("BloodGroup");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfHarinamInitiation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfHarinamInitiation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfBrahmanInitiation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfBrahmanInitiation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "SpiritualMasterId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("SpiritualMasterId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "PreviousReligion";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("PreviousReligion");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Chanting16RoundsSince";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Chanting16RoundsSince");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "IntroducedBy";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("IntroducedBy");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "YearOfIntroduction";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("YearOfIntroduction");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "IntroducedInCenter";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("IntroducedInCenter");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "PreferedServices";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("PreferedServices");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "ServicesRendered";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("ServicesRendered");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "InitiatedName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("InitiatedName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "FullName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("FullName");
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
//	FullName - 
			$record["FullName_value"] = $pageObject->showDBValue("FullName", $data, $keylink);
			$record["FullName_class"] = $pageObject->fieldClass("FullName");
//	Photo - Database Image
			$record["Photo_value"] = $pageObject->showDBValue("Photo", $data, $keylink);
			$record["Photo_class"] = $pageObject->fieldClass("Photo");
//	TitleId - 
			$record["TitleId_value"] = $pageObject->showDBValue("TitleId", $data, $keylink);
			$record["TitleId_class"] = $pageObject->fieldClass("TitleId");
//	FirstName - 
			$record["FirstName_value"] = $pageObject->showDBValue("FirstName", $data, $keylink);
			$record["FirstName_class"] = $pageObject->fieldClass("FirstName");
//	LastName - 
			$record["LastName_value"] = $pageObject->showDBValue("LastName", $data, $keylink);
			$record["LastName_class"] = $pageObject->fieldClass("LastName");
//	MiddleName - 
			$record["MiddleName_value"] = $pageObject->showDBValue("MiddleName", $data, $keylink);
			$record["MiddleName_class"] = $pageObject->fieldClass("MiddleName");
//	InitiatedName - 
			$record["InitiatedName_value"] = $pageObject->showDBValue("InitiatedName", $data, $keylink);
			$record["InitiatedName_class"] = $pageObject->fieldClass("InitiatedName");
//	DateOfBirth - Short Date
			$record["DateOfBirth_value"] = $pageObject->showDBValue("DateOfBirth", $data, $keylink);
			$record["DateOfBirth_class"] = $pageObject->fieldClass("DateOfBirth");
//	Gender - Checkbox
			$record["Gender_value"] = $pageObject->showDBValue("Gender", $data, $keylink);
			$record["Gender_class"] = $pageObject->fieldClass("Gender");
//	CounsellorDevoteeID - 
			$record["CounsellorDevoteeID_value"] = $pageObject->showDBValue("CounsellorDevoteeID", $data, $keylink);
			$record["CounsellorDevoteeID_class"] = $pageObject->fieldClass("CounsellorDevoteeID");
//	EmailPrimary - 
			$record["EmailPrimary_value"] = $pageObject->showDBValue("EmailPrimary", $data, $keylink);
			$record["EmailPrimary_class"] = $pageObject->fieldClass("EmailPrimary");
//	EmailSecondary - 
			$record["EmailSecondary_value"] = $pageObject->showDBValue("EmailSecondary", $data, $keylink);
			$record["EmailSecondary_class"] = $pageObject->fieldClass("EmailSecondary");
//	MobilePhone - 
			$record["MobilePhone_value"] = $pageObject->showDBValue("MobilePhone", $data, $keylink);
			$record["MobilePhone_class"] = $pageObject->fieldClass("MobilePhone");
//	WorkPhone - 
			$record["WorkPhone_value"] = $pageObject->showDBValue("WorkPhone", $data, $keylink);
			$record["WorkPhone_class"] = $pageObject->fieldClass("WorkPhone");
//	MaritalStatusId - 
			$record["MaritalStatusId_value"] = $pageObject->showDBValue("MaritalStatusId", $data, $keylink);
			$record["MaritalStatusId_class"] = $pageObject->fieldClass("MaritalStatusId");
//	DateofMarriage - Short Date
			$record["DateofMarriage_value"] = $pageObject->showDBValue("DateofMarriage", $data, $keylink);
			$record["DateofMarriage_class"] = $pageObject->fieldClass("DateofMarriage");
//	SpouseDevoteeId - 
			$record["SpouseDevoteeId_value"] = $pageObject->showDBValue("SpouseDevoteeId", $data, $keylink);
			$record["SpouseDevoteeId_class"] = $pageObject->fieldClass("SpouseDevoteeId");
//	NativeCity - 
			$record["NativeCity_value"] = $pageObject->showDBValue("NativeCity", $data, $keylink);
			$record["NativeCity_class"] = $pageObject->fieldClass("NativeCity");
//	NativeState - 
			$record["NativeState_value"] = $pageObject->showDBValue("NativeState", $data, $keylink);
			$record["NativeState_class"] = $pageObject->fieldClass("NativeState");
//	BloodGroup - 
			$record["BloodGroup_value"] = $pageObject->showDBValue("BloodGroup", $data, $keylink);
			$record["BloodGroup_class"] = $pageObject->fieldClass("BloodGroup");
//	YearOfIntroduction - 
			$record["YearOfIntroduction_value"] = $pageObject->showDBValue("YearOfIntroduction", $data, $keylink);
			$record["YearOfIntroduction_class"] = $pageObject->fieldClass("YearOfIntroduction");
//	IntroducedBy - 
			$record["IntroducedBy_value"] = $pageObject->showDBValue("IntroducedBy", $data, $keylink);
			$record["IntroducedBy_class"] = $pageObject->fieldClass("IntroducedBy");
//	IntroducedInCenter - 
			$record["IntroducedInCenter_value"] = $pageObject->showDBValue("IntroducedInCenter", $data, $keylink);
			$record["IntroducedInCenter_class"] = $pageObject->fieldClass("IntroducedInCenter");
//	Chanting16RoundsSince - Short Date
			$record["Chanting16RoundsSince_value"] = $pageObject->showDBValue("Chanting16RoundsSince", $data, $keylink);
			$record["Chanting16RoundsSince_class"] = $pageObject->fieldClass("Chanting16RoundsSince");
//	SpiritualMasterId - 
			$record["SpiritualMasterId_value"] = $pageObject->showDBValue("SpiritualMasterId", $data, $keylink);
			$record["SpiritualMasterId_class"] = $pageObject->fieldClass("SpiritualMasterId");
//	DateOfHarinamInitiation - Short Date
			$record["DateOfHarinamInitiation_value"] = $pageObject->showDBValue("DateOfHarinamInitiation", $data, $keylink);
			$record["DateOfHarinamInitiation_class"] = $pageObject->fieldClass("DateOfHarinamInitiation");
//	DateOfBrahmanInitiation - Short Date
			$record["DateOfBrahmanInitiation_value"] = $pageObject->showDBValue("DateOfBrahmanInitiation", $data, $keylink);
			$record["DateOfBrahmanInitiation_class"] = $pageObject->fieldClass("DateOfBrahmanInitiation");
//	PreviousReligion - 
			$record["PreviousReligion_value"] = $pageObject->showDBValue("PreviousReligion", $data, $keylink);
			$record["PreviousReligion_class"] = $pageObject->fieldClass("PreviousReligion");
//	PreferedServices - 
			$record["PreferedServices_value"] = $pageObject->showDBValue("PreferedServices", $data, $keylink);
			$record["PreferedServices_class"] = $pageObject->fieldClass("PreferedServices");
//	ServicesRendered - 
			$record["ServicesRendered_value"] = $pageObject->showDBValue("ServicesRendered", $data, $keylink);
			$record["ServicesRendered_class"] = $pageObject->fieldClass("ServicesRendered");
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
$xt->assign("FullName_fieldheadercolumn",true);
$xt->assign("FullName_fieldheader",true);
$xt->assign("FullName_fieldcolumn",true);
$xt->assign("FullName_fieldfootercolumn",true);
$xt->assign("Photo_fieldheadercolumn",true);
$xt->assign("Photo_fieldheader",true);
$xt->assign("Photo_fieldcolumn",true);
$xt->assign("Photo_fieldfootercolumn",true);
$xt->assign("TitleId_fieldheadercolumn",true);
$xt->assign("TitleId_fieldheader",true);
$xt->assign("TitleId_fieldcolumn",true);
$xt->assign("TitleId_fieldfootercolumn",true);
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
$xt->assign("InitiatedName_fieldheadercolumn",true);
$xt->assign("InitiatedName_fieldheader",true);
$xt->assign("InitiatedName_fieldcolumn",true);
$xt->assign("InitiatedName_fieldfootercolumn",true);
$xt->assign("DateOfBirth_fieldheadercolumn",true);
$xt->assign("DateOfBirth_fieldheader",true);
$xt->assign("DateOfBirth_fieldcolumn",true);
$xt->assign("DateOfBirth_fieldfootercolumn",true);
$xt->assign("Gender_fieldheadercolumn",true);
$xt->assign("Gender_fieldheader",true);
$xt->assign("Gender_fieldcolumn",true);
$xt->assign("Gender_fieldfootercolumn",true);
$xt->assign("CounsellorDevoteeID_fieldheadercolumn",true);
$xt->assign("CounsellorDevoteeID_fieldheader",true);
$xt->assign("CounsellorDevoteeID_fieldcolumn",true);
$xt->assign("CounsellorDevoteeID_fieldfootercolumn",true);
$xt->assign("EmailPrimary_fieldheadercolumn",true);
$xt->assign("EmailPrimary_fieldheader",true);
$xt->assign("EmailPrimary_fieldcolumn",true);
$xt->assign("EmailPrimary_fieldfootercolumn",true);
$xt->assign("EmailSecondary_fieldheadercolumn",true);
$xt->assign("EmailSecondary_fieldheader",true);
$xt->assign("EmailSecondary_fieldcolumn",true);
$xt->assign("EmailSecondary_fieldfootercolumn",true);
$xt->assign("MobilePhone_fieldheadercolumn",true);
$xt->assign("MobilePhone_fieldheader",true);
$xt->assign("MobilePhone_fieldcolumn",true);
$xt->assign("MobilePhone_fieldfootercolumn",true);
$xt->assign("WorkPhone_fieldheadercolumn",true);
$xt->assign("WorkPhone_fieldheader",true);
$xt->assign("WorkPhone_fieldcolumn",true);
$xt->assign("WorkPhone_fieldfootercolumn",true);
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
$xt->assign("NativeCity_fieldheadercolumn",true);
$xt->assign("NativeCity_fieldheader",true);
$xt->assign("NativeCity_fieldcolumn",true);
$xt->assign("NativeCity_fieldfootercolumn",true);
$xt->assign("NativeState_fieldheadercolumn",true);
$xt->assign("NativeState_fieldheader",true);
$xt->assign("NativeState_fieldcolumn",true);
$xt->assign("NativeState_fieldfootercolumn",true);
$xt->assign("BloodGroup_fieldheadercolumn",true);
$xt->assign("BloodGroup_fieldheader",true);
$xt->assign("BloodGroup_fieldcolumn",true);
$xt->assign("BloodGroup_fieldfootercolumn",true);
$xt->assign("YearOfIntroduction_fieldheadercolumn",true);
$xt->assign("YearOfIntroduction_fieldheader",true);
$xt->assign("YearOfIntroduction_fieldcolumn",true);
$xt->assign("YearOfIntroduction_fieldfootercolumn",true);
$xt->assign("IntroducedBy_fieldheadercolumn",true);
$xt->assign("IntroducedBy_fieldheader",true);
$xt->assign("IntroducedBy_fieldcolumn",true);
$xt->assign("IntroducedBy_fieldfootercolumn",true);
$xt->assign("IntroducedInCenter_fieldheadercolumn",true);
$xt->assign("IntroducedInCenter_fieldheader",true);
$xt->assign("IntroducedInCenter_fieldcolumn",true);
$xt->assign("IntroducedInCenter_fieldfootercolumn",true);
$xt->assign("Chanting16RoundsSince_fieldheadercolumn",true);
$xt->assign("Chanting16RoundsSince_fieldheader",true);
$xt->assign("Chanting16RoundsSince_fieldcolumn",true);
$xt->assign("Chanting16RoundsSince_fieldfootercolumn",true);
$xt->assign("SpiritualMasterId_fieldheadercolumn",true);
$xt->assign("SpiritualMasterId_fieldheader",true);
$xt->assign("SpiritualMasterId_fieldcolumn",true);
$xt->assign("SpiritualMasterId_fieldfootercolumn",true);
$xt->assign("DateOfHarinamInitiation_fieldheadercolumn",true);
$xt->assign("DateOfHarinamInitiation_fieldheader",true);
$xt->assign("DateOfHarinamInitiation_fieldcolumn",true);
$xt->assign("DateOfHarinamInitiation_fieldfootercolumn",true);
$xt->assign("DateOfBrahmanInitiation_fieldheadercolumn",true);
$xt->assign("DateOfBrahmanInitiation_fieldheader",true);
$xt->assign("DateOfBrahmanInitiation_fieldcolumn",true);
$xt->assign("DateOfBrahmanInitiation_fieldfootercolumn",true);
$xt->assign("PreviousReligion_fieldheadercolumn",true);
$xt->assign("PreviousReligion_fieldheader",true);
$xt->assign("PreviousReligion_fieldcolumn",true);
$xt->assign("PreviousReligion_fieldfootercolumn",true);
$xt->assign("PreferedServices_fieldheadercolumn",true);
$xt->assign("PreferedServices_fieldheader",true);
$xt->assign("PreferedServices_fieldcolumn",true);
$xt->assign("PreferedServices_fieldfootercolumn",true);
$xt->assign("ServicesRendered_fieldheadercolumn",true);
$xt->assign("ServicesRendered_fieldheader",true);
$xt->assign("ServicesRendered_fieldcolumn",true);
$xt->assign("ServicesRendered_fieldfootercolumn",true);

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
