<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

include("include/vw_Devotee_full_variables.php");

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
$layout->blocks["top"][] = "export";$page_layouts["vw_Devotee_full_export"] = $layout;


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

$xt->display("vw_Devotee_full_export.htm");

function ExportToExcel_old($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=vw_Devotee_full.xls");

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
	header("Content-Disposition: attachment;Filename=vw_Devotee_full.doc");

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
	header("Content-Disposition: attachment;Filename=vw_Devotee_full.xml");
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
			$values["Photo"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["Gender"] = $pageObject->showDBValue("Gender", $row);
			$values["TitleId"] = $pageObject->showDBValue("TitleId", $row);
			$values["FirstName"] = $pageObject->showDBValue("FirstName", $row);
			$values["LastName"] = $pageObject->showDBValue("LastName", $row);
			$values["MiddleName"] = $pageObject->showDBValue("MiddleName", $row);
			$values["DateOfBirth"] = $pageObject->showDBValue("DateOfBirth", $row);
			$values["MaritalStatusId"] = $pageObject->showDBValue("MaritalStatusId", $row);
			$values["DateofMarriage"] = $pageObject->showDBValue("DateofMarriage", $row);
			$values["SpouseDevoteeId"] = $pageObject->showDBValue("SpouseDevoteeId", $row);
			$values["MobilePhone"] = $pageObject->showDBValue("MobilePhone", $row);
			$values["WorkPhone"] = $pageObject->showDBValue("WorkPhone", $row);
			$values["EmailPrimary"] = $pageObject->showDBValue("EmailPrimary", $row);
			$values["EmailSecondary"] = $pageObject->showDBValue("EmailSecondary", $row);
			$values["Password"] = $pageObject->showDBValue("Password", $row);
			$values["Address_AddressId"] = $pageObject->showDBValue("Address_AddressId", $row);
			$values["address_AddressLine1"] = $pageObject->showDBValue("address_AddressLine1", $row);
			$values["address_AddressLine2"] = $pageObject->showDBValue("address_AddressLine2", $row);
			$values["address_City"] = $pageObject->showDBValue("address_City", $row);
			$values["address_State"] = $pageObject->showDBValue("address_State", $row);
			$values["address_Pincode"] = $pageObject->showDBValue("address_Pincode", $row);
			$values["address_Country"] = $pageObject->showDBValue("address_Country", $row);
			$values["address_IsVerified"] = $pageObject->showDBValue("address_IsVerified", $row);
			$values["address_IsWrong"] = $pageObject->showDBValue("address_IsWrong", $row);
			$values["address_AddressTypeId"] = $pageObject->showDBValue("address_AddressTypeId", $row);
			$values["organization_OrgName"] = $pageObject->showDBValue("organization_OrgName", $row);
			$values["organization_OrgId"] = $pageObject->showDBValue("organization_OrgId", $row);
			$values["organization_OrgLeaderId"] = $pageObject->showDBValue("organization_OrgLeaderId", $row);
			$values["organization_OrgOwnerId"] = $pageObject->showDBValue("organization_OrgOwnerId", $row);
			$values["organization_Location"] = $pageObject->showDBValue("organization_Location", $row);
			$values["spirituallife_SericesRendered"] = $pageObject->showDBValue("spirituallife_SericesRendered", $row);
			$values["SpiritualLife_DevoteeId"] = $pageObject->showDBValue("SpiritualLife_DevoteeId", $row);
			$values["spirituallife_PreferedServices"] = $pageObject->showDBValue("spirituallife_PreferedServices", $row);
			$values["spirituallife_Chanting16RoundsSince"] = $pageObject->showDBValue("spirituallife_Chanting16RoundsSince", $row);
			$values["spirituallife_IntroducedInCenter"] = $pageObject->showDBValue("spirituallife_IntroducedInCenter", $row);
			$values["spirituallife_YearOfIntroduction"] = $pageObject->showDBValue("spirituallife_YearOfIntroduction", $row);
			$values["spirituallife_PreviousReligion"] = $pageObject->showDBValue("spirituallife_PreviousReligion", $row);
			$values["spirituallife_SpiritualMasterDevoteeId"] = $pageObject->showDBValue("spirituallife_SpiritualMasterDevoteeId", $row);
			$values["spirituallife_DateOfBrahmanInitiation"] = $pageObject->showDBValue("spirituallife_DateOfBrahmanInitiation", $row);
			$values["spirituallife_DateOfHarinamInitiation"] = $pageObject->showDBValue("spirituallife_DateOfHarinamInitiation", $row);
			$values["spirituallife_SpiritulLifeId"] = $pageObject->showDBValue("spirituallife_SpiritulLifeId", $row);
			$values["spirituallife_IntroducedBy"] = $pageObject->showDBValue("spirituallife_IntroducedBy", $row);
			$values["company_CompanyId"] = $pageObject->showDBValue("company_CompanyId", $row);
			$values["company_CompanyName"] = $pageObject->showDBValue("company_CompanyName", $row);
			$values["company_AddressId"] = $pageObject->showDBValue("company_AddressId", $row);
			$values["company_Remark"] = $pageObject->showDBValue("company_Remark", $row);
			$values["devoteelang_DevoteeLanguageId"] = $pageObject->showDBValue("devoteelang_DevoteeLanguageId", $row);
			$values["devoteelang_WritingLevel"] = $pageObject->showDBValue("devoteelang_WritingLevel", $row);
			$values["devoteelang_DevoteeId"] = $pageObject->showDBValue("devoteelang_DevoteeId", $row);
			$values["devoteelang_LanguageId"] = $pageObject->showDBValue("devoteelang_LanguageId", $row);
			$values["devoteelang_SpeakingLevel"] = $pageObject->showDBValue("devoteelang_SpeakingLevel", $row);
			$values["devoteelang_ReadingLevel"] = $pageObject->showDBValue("devoteelang_ReadingLevel", $row);
			$values["occupational_DevoteeOccupationalId"] = $pageObject->showDBValue("occupational_DevoteeOccupationalId", $row);
			$values["Occupational_DevoteeId"] = $pageObject->showDBValue("Occupational_DevoteeId", $row);
			$values["Occupational_Education"] = $pageObject->showDBValue("Occupational_Education", $row);
			$values["Occupational_Occupation"] = $pageObject->showDBValue("Occupational_Occupation", $row);
			$values["Occupational_Designation"] = $pageObject->showDBValue("Occupational_Designation", $row);
			$values["Occupational_AwardsOrMerits"] = $pageObject->showDBValue("Occupational_AwardsOrMerits", $row);
			$values["occupational_SkillsOrExperiences"] = $pageObject->showDBValue("occupational_SkillsOrExperiences", $row);
			$values["occupational_CurrentCompanyId"] = $pageObject->showDBValue("occupational_CurrentCompanyId", $row);
			$values["addresstypes_AddressType"] = $pageObject->showDBValue("addresstypes_AddressType", $row);
			$values["addresstypes_AddressTypeId"] = $pageObject->showDBValue("addresstypes_AddressTypeId", $row);
			$values["DevoteeOrg_DevoteeOrgId"] = $pageObject->showDBValue("DevoteeOrg_DevoteeOrgId", $row);
			$values["DevoteeOrg_DevoteeId"] = $pageObject->showDBValue("DevoteeOrg_DevoteeId", $row);
			$values["DevoteeOrg_FromDate"] = $pageObject->showDBValue("DevoteeOrg_FromDate", $row);
			$values["DevoteeOrg_ToDate"] = $pageObject->showDBValue("DevoteeOrg_ToDate", $row);
			$values["DevoteeOrg_OrgId"] = $pageObject->showDBValue("DevoteeOrg_OrgId", $row);
			$values["devoteeaddress_devoteeaddressId"] = $pageObject->showDBValue("devoteeaddress_devoteeaddressId", $row);
			$values["devoteeaddress_AddressId"] = $pageObject->showDBValue("devoteeaddress_AddressId", $row);
			$values["devoteeaddress_DevoteeId"] = $pageObject->showDBValue("devoteeaddress_DevoteeId", $row);
		
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
	header("Content-Disposition: attachment;Filename=vw_Devotee_full.csv");
	
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
	$outstr.= "\"Photo\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Gender\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"TitleId\"";
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
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Address_AddressId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_AddressLine1\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_AddressLine2\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_City\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_State\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_Pincode\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_Country\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_IsVerified\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_IsWrong\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"address_AddressTypeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"organization_OrgName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"organization_OrgId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"organization_OrgLeaderId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"organization_OrgOwnerId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"organization_Location\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_SericesRendered\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"SpiritualLife_DevoteeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_PreferedServices\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_Chanting16RoundsSince\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_IntroducedInCenter\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_YearOfIntroduction\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_PreviousReligion\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_SpiritualMasterDevoteeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_DateOfBrahmanInitiation\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_DateOfHarinamInitiation\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_SpiritulLifeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"spirituallife_IntroducedBy\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"company_CompanyId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"company_CompanyName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"company_AddressId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"company_Remark\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteelang_DevoteeLanguageId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteelang_WritingLevel\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteelang_DevoteeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteelang_LanguageId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteelang_SpeakingLevel\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteelang_ReadingLevel\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"occupational_DevoteeOccupationalId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Occupational_DevoteeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Occupational_Education\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Occupational_Occupation\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Occupational_Designation\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Occupational_AwardsOrMerits\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"occupational_SkillsOrExperiences\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"occupational_CurrentCompanyId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"addresstypes_AddressType\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"addresstypes_AddressTypeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DevoteeOrg_DevoteeOrgId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DevoteeOrg_DevoteeId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DevoteeOrg_FromDate\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DevoteeOrg_ToDate\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"DevoteeOrg_OrgId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteeaddress_devoteeaddressId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteeaddress_AddressId\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"devoteeaddress_DevoteeId\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "csv";
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$values["DevoteeId"] = $pageObject->getViewControl("DevoteeId")->showDBValue($row, "");
		$values["Photo"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["Gender"] = $pageObject->getViewControl("Gender")->showDBValue($row, "");
			$values["TitleId"] = $pageObject->getViewControl("TitleId")->showDBValue($row, "");
			$values["FirstName"] = $pageObject->getViewControl("FirstName")->showDBValue($row, "");
			$values["LastName"] = $pageObject->getViewControl("LastName")->showDBValue($row, "");
			$values["MiddleName"] = $pageObject->getViewControl("MiddleName")->showDBValue($row, "");
			$values["DateOfBirth"] = $pageObject->getViewControl("DateOfBirth")->showDBValue($row, "");
			$values["MaritalStatusId"] = $pageObject->getViewControl("MaritalStatusId")->showDBValue($row, "");
			$values["DateofMarriage"] = $pageObject->getViewControl("DateofMarriage")->showDBValue($row, "");
			$values["SpouseDevoteeId"] = $pageObject->getViewControl("SpouseDevoteeId")->showDBValue($row, "");
			$values["MobilePhone"] = $pageObject->getViewControl("MobilePhone")->showDBValue($row, "");
			$values["WorkPhone"] = $pageObject->getViewControl("WorkPhone")->showDBValue($row, "");
			$values["EmailPrimary"] = $pageObject->getViewControl("EmailPrimary")->showDBValue($row, "");
			$values["EmailSecondary"] = $pageObject->getViewControl("EmailSecondary")->showDBValue($row, "");
			$values["Password"] = $pageObject->getViewControl("Password")->showDBValue($row, "");
			$values["Address_AddressId"] = $pageObject->getViewControl("Address_AddressId")->showDBValue($row, "");
			$values["address_AddressLine1"] = $pageObject->getViewControl("address_AddressLine1")->showDBValue($row, "");
			$values["address_AddressLine2"] = $pageObject->getViewControl("address_AddressLine2")->showDBValue($row, "");
			$values["address_City"] = $pageObject->getViewControl("address_City")->showDBValue($row, "");
			$values["address_State"] = $pageObject->getViewControl("address_State")->showDBValue($row, "");
			$values["address_Pincode"] = $pageObject->getViewControl("address_Pincode")->showDBValue($row, "");
			$values["address_Country"] = $pageObject->getViewControl("address_Country")->showDBValue($row, "");
			$values["address_IsVerified"] = $pageObject->getViewControl("address_IsVerified")->showDBValue($row, "");
			$values["address_IsWrong"] = $pageObject->getViewControl("address_IsWrong")->showDBValue($row, "");
			$values["address_AddressTypeId"] = $pageObject->getViewControl("address_AddressTypeId")->showDBValue($row, "");
			$values["organization_OrgName"] = $pageObject->getViewControl("organization_OrgName")->showDBValue($row, "");
			$values["organization_OrgId"] = $pageObject->getViewControl("organization_OrgId")->showDBValue($row, "");
			$values["organization_OrgLeaderId"] = $pageObject->getViewControl("organization_OrgLeaderId")->showDBValue($row, "");
			$values["organization_OrgOwnerId"] = $pageObject->getViewControl("organization_OrgOwnerId")->showDBValue($row, "");
			$values["organization_Location"] = $pageObject->getViewControl("organization_Location")->showDBValue($row, "");
			$values["spirituallife_SericesRendered"] = $pageObject->getViewControl("spirituallife_SericesRendered")->showDBValue($row, "");
			$values["SpiritualLife_DevoteeId"] = $pageObject->getViewControl("SpiritualLife_DevoteeId")->showDBValue($row, "");
			$values["spirituallife_PreferedServices"] = $pageObject->getViewControl("spirituallife_PreferedServices")->showDBValue($row, "");
			$values["spirituallife_Chanting16RoundsSince"] = $pageObject->getViewControl("spirituallife_Chanting16RoundsSince")->showDBValue($row, "");
			$values["spirituallife_IntroducedInCenter"] = $pageObject->getViewControl("spirituallife_IntroducedInCenter")->showDBValue($row, "");
			$values["spirituallife_YearOfIntroduction"] = $pageObject->getViewControl("spirituallife_YearOfIntroduction")->showDBValue($row, "");
			$values["spirituallife_PreviousReligion"] = $pageObject->getViewControl("spirituallife_PreviousReligion")->showDBValue($row, "");
			$values["spirituallife_SpiritualMasterDevoteeId"] = $pageObject->getViewControl("spirituallife_SpiritualMasterDevoteeId")->showDBValue($row, "");
			$values["spirituallife_DateOfBrahmanInitiation"] = $pageObject->getViewControl("spirituallife_DateOfBrahmanInitiation")->showDBValue($row, "");
			$values["spirituallife_DateOfHarinamInitiation"] = $pageObject->getViewControl("spirituallife_DateOfHarinamInitiation")->showDBValue($row, "");
			$values["spirituallife_SpiritulLifeId"] = $pageObject->getViewControl("spirituallife_SpiritulLifeId")->showDBValue($row, "");
			$values["spirituallife_IntroducedBy"] = $pageObject->getViewControl("spirituallife_IntroducedBy")->showDBValue($row, "");
			$values["company_CompanyId"] = $pageObject->getViewControl("company_CompanyId")->showDBValue($row, "");
			$values["company_CompanyName"] = $pageObject->getViewControl("company_CompanyName")->showDBValue($row, "");
			$values["company_AddressId"] = $pageObject->getViewControl("company_AddressId")->showDBValue($row, "");
			$values["company_Remark"] = $pageObject->getViewControl("company_Remark")->showDBValue($row, "");
			$values["devoteelang_DevoteeLanguageId"] = $pageObject->getViewControl("devoteelang_DevoteeLanguageId")->showDBValue($row, "");
			$values["devoteelang_WritingLevel"] = $pageObject->getViewControl("devoteelang_WritingLevel")->showDBValue($row, "");
			$values["devoteelang_DevoteeId"] = $pageObject->getViewControl("devoteelang_DevoteeId")->showDBValue($row, "");
			$values["devoteelang_LanguageId"] = $pageObject->getViewControl("devoteelang_LanguageId")->showDBValue($row, "");
			$values["devoteelang_SpeakingLevel"] = $pageObject->getViewControl("devoteelang_SpeakingLevel")->showDBValue($row, "");
			$values["devoteelang_ReadingLevel"] = $pageObject->getViewControl("devoteelang_ReadingLevel")->showDBValue($row, "");
			$values["occupational_DevoteeOccupationalId"] = $pageObject->getViewControl("occupational_DevoteeOccupationalId")->showDBValue($row, "");
			$values["Occupational_DevoteeId"] = $pageObject->getViewControl("Occupational_DevoteeId")->showDBValue($row, "");
			$values["Occupational_Education"] = $pageObject->getViewControl("Occupational_Education")->showDBValue($row, "");
			$values["Occupational_Occupation"] = $pageObject->getViewControl("Occupational_Occupation")->showDBValue($row, "");
			$values["Occupational_Designation"] = $pageObject->getViewControl("Occupational_Designation")->showDBValue($row, "");
			$values["Occupational_AwardsOrMerits"] = $pageObject->getViewControl("Occupational_AwardsOrMerits")->showDBValue($row, "");
			$values["occupational_SkillsOrExperiences"] = $pageObject->getViewControl("occupational_SkillsOrExperiences")->showDBValue($row, "");
			$values["occupational_CurrentCompanyId"] = $pageObject->getViewControl("occupational_CurrentCompanyId")->showDBValue($row, "");
			$values["addresstypes_AddressType"] = $pageObject->getViewControl("addresstypes_AddressType")->showDBValue($row, "");
			$values["addresstypes_AddressTypeId"] = $pageObject->getViewControl("addresstypes_AddressTypeId")->showDBValue($row, "");
			$values["DevoteeOrg_DevoteeOrgId"] = $pageObject->getViewControl("DevoteeOrg_DevoteeOrgId")->showDBValue($row, "");
			$values["DevoteeOrg_DevoteeId"] = $pageObject->getViewControl("DevoteeOrg_DevoteeId")->showDBValue($row, "");
			$values["DevoteeOrg_FromDate"] = $pageObject->getViewControl("DevoteeOrg_FromDate")->showDBValue($row, "");
			$values["DevoteeOrg_ToDate"] = $pageObject->getViewControl("DevoteeOrg_ToDate")->showDBValue($row, "");
			$values["DevoteeOrg_OrgId"] = $pageObject->getViewControl("DevoteeOrg_OrgId")->showDBValue($row, "");
			$values["devoteeaddress_devoteeaddressId"] = $pageObject->getViewControl("devoteeaddress_devoteeaddressId")->showDBValue($row, "");
			$values["devoteeaddress_AddressId"] = $pageObject->getViewControl("devoteeaddress_AddressId")->showDBValue($row, "");
			$values["devoteeaddress_DevoteeId"] = $pageObject->getViewControl("devoteeaddress_DevoteeId")->showDBValue($row, "");

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
			$outstr.='"'.str_replace('"', '""', $values["Photo"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Gender"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["TitleId"]).'"';
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
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Address_AddressId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_AddressLine1"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_AddressLine2"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_City"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_State"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_Pincode"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_Country"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_IsVerified"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_IsWrong"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["address_AddressTypeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["organization_OrgName"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["organization_OrgId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["organization_OrgLeaderId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["organization_OrgOwnerId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["organization_Location"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_SericesRendered"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["SpiritualLife_DevoteeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_PreferedServices"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_Chanting16RoundsSince"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_IntroducedInCenter"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_YearOfIntroduction"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_PreviousReligion"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_SpiritualMasterDevoteeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_DateOfBrahmanInitiation"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_DateOfHarinamInitiation"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_SpiritulLifeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["spirituallife_IntroducedBy"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["company_CompanyId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["company_CompanyName"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["company_AddressId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["company_Remark"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteelang_DevoteeLanguageId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteelang_WritingLevel"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteelang_DevoteeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteelang_LanguageId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteelang_SpeakingLevel"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteelang_ReadingLevel"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["occupational_DevoteeOccupationalId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Occupational_DevoteeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Occupational_Education"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Occupational_Occupation"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Occupational_Designation"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Occupational_AwardsOrMerits"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["occupational_SkillsOrExperiences"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["occupational_CurrentCompanyId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["addresstypes_AddressType"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["addresstypes_AddressTypeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DevoteeOrg_DevoteeOrgId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DevoteeOrg_DevoteeId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DevoteeOrg_FromDate"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DevoteeOrg_ToDate"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["DevoteeOrg_OrgId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteeaddress_devoteeaddressId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteeaddress_AddressId"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["devoteeaddress_DevoteeId"]).'"';
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
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Photo").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Gender").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Title Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("First Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Last Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Middle Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Date Of Birth").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Marital Status Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Date of Marriage").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Spouse Devotee Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Mobile Phone").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Work Phone").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Email Primary").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Email Secondary").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Password").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Address Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Address Line1").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Address Line2").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("City").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("State").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Pincode").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Country").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("IsVerified").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("IsWrong").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Address Type Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Org Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("OrgId").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("OrgLeaderId").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("OrgOwnerId").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Location").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Serices Rendered").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Prefered Services").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Chanting 16 Rounds Since").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Introduced In Center").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Year Of Introduction").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Previous Religion").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Spiritual Master Devotee Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Date Of Brahman Initiation").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Date Of Harinam Initiation").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Spiritul Life Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Introduced By").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Company Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Company Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Address Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Remark").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Language Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Writing Level").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Language Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Speaking Level").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Reading Level").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Occupational Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("DevoteeId").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Education").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Occupation").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Designation").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Awards Or Merits").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Skills Or Experiences").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Current Company Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Address Type").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("AddressTypeId").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Org Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("From Date").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("To Date").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Org Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Devotee Address Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("AddressId").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("DevoteeId").'</td>';	
	}
	else
	{
		echo "<td>"."Devotee Id"."</td>";
		echo "<td>"."Photo"."</td>";
		echo "<td>"."Gender"."</td>";
		echo "<td>"."Title Id"."</td>";
		echo "<td>"."First Name"."</td>";
		echo "<td>"."Last Name"."</td>";
		echo "<td>"."Middle Name"."</td>";
		echo "<td>"."Date Of Birth"."</td>";
		echo "<td>"."Marital Status Id"."</td>";
		echo "<td>"."Date of Marriage"."</td>";
		echo "<td>"."Spouse Devotee Id"."</td>";
		echo "<td>"."Mobile Phone"."</td>";
		echo "<td>"."Work Phone"."</td>";
		echo "<td>"."Email Primary"."</td>";
		echo "<td>"."Email Secondary"."</td>";
		echo "<td>"."Password"."</td>";
		echo "<td>"."Address Id"."</td>";
		echo "<td>"."Address Line1"."</td>";
		echo "<td>"."Address Line2"."</td>";
		echo "<td>"."City"."</td>";
		echo "<td>"."State"."</td>";
		echo "<td>"."Pincode"."</td>";
		echo "<td>"."Country"."</td>";
		echo "<td>"."IsVerified"."</td>";
		echo "<td>"."IsWrong"."</td>";
		echo "<td>"."Address Type Id"."</td>";
		echo "<td>"."Org Name"."</td>";
		echo "<td>"."OrgId"."</td>";
		echo "<td>"."OrgLeaderId"."</td>";
		echo "<td>"."OrgOwnerId"."</td>";
		echo "<td>"."Location"."</td>";
		echo "<td>"."Serices Rendered"."</td>";
		echo "<td>"."Devotee Id"."</td>";
		echo "<td>"."Prefered Services"."</td>";
		echo "<td>"."Chanting 16 Rounds Since"."</td>";
		echo "<td>"."Introduced In Center"."</td>";
		echo "<td>"."Year Of Introduction"."</td>";
		echo "<td>"."Previous Religion"."</td>";
		echo "<td>"."Spiritual Master Devotee Id"."</td>";
		echo "<td>"."Date Of Brahman Initiation"."</td>";
		echo "<td>"."Date Of Harinam Initiation"."</td>";
		echo "<td>"."Spiritul Life Id"."</td>";
		echo "<td>"."Introduced By"."</td>";
		echo "<td>"."Company Id"."</td>";
		echo "<td>"."Company Name"."</td>";
		echo "<td>"."Address Id"."</td>";
		echo "<td>"."Remark"."</td>";
		echo "<td>"."Devotee Language Id"."</td>";
		echo "<td>"."Writing Level"."</td>";
		echo "<td>"."Devotee Id"."</td>";
		echo "<td>"."Language Id"."</td>";
		echo "<td>"."Speaking Level"."</td>";
		echo "<td>"."Reading Level"."</td>";
		echo "<td>"."Devotee Occupational Id"."</td>";
		echo "<td>"."DevoteeId"."</td>";
		echo "<td>"."Education"."</td>";
		echo "<td>"."Occupation"."</td>";
		echo "<td>"."Designation"."</td>";
		echo "<td>"."Awards Or Merits"."</td>";
		echo "<td>"."Skills Or Experiences"."</td>";
		echo "<td>"."Current Company Id"."</td>";
		echo "<td>"."Address Type"."</td>";
		echo "<td>"."AddressTypeId"."</td>";
		echo "<td>"."Devotee Org Id"."</td>";
		echo "<td>"."Devotee Id"."</td>";
		echo "<td>"."From Date"."</td>";
		echo "<td>"."To Date"."</td>";
		echo "<td>"."Org Id"."</td>";
		echo "<td>"."Devotee Address Id"."</td>";
		echo "<td>"."AddressId"."</td>";
		echo "<td>"."DevoteeId"."</td>";
	}
	echo "</tr>";
	
// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "export";
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					$values["DevoteeId"] = $pageObject->getViewControl("DevoteeId")->showDBValue($row, "");
					$values["Photo"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
					$values["Gender"] = $pageObject->getViewControl("Gender")->showDBValue($row, "");
					$values["TitleId"] = $pageObject->getViewControl("TitleId")->showDBValue($row, "");
					$values["FirstName"] = $pageObject->getViewControl("FirstName")->showDBValue($row, "");
					$values["LastName"] = $pageObject->getViewControl("LastName")->showDBValue($row, "");
					$values["MiddleName"] = $pageObject->getViewControl("MiddleName")->showDBValue($row, "");
					$values["DateOfBirth"] = $pageObject->getViewControl("DateOfBirth")->showDBValue($row, "");
					$values["MaritalStatusId"] = $pageObject->getViewControl("MaritalStatusId")->showDBValue($row, "");
					$values["DateofMarriage"] = $pageObject->getViewControl("DateofMarriage")->showDBValue($row, "");
					$values["SpouseDevoteeId"] = $pageObject->getViewControl("SpouseDevoteeId")->showDBValue($row, "");
					$values["MobilePhone"] = $pageObject->getViewControl("MobilePhone")->showDBValue($row, "");
					$values["WorkPhone"] = $pageObject->getViewControl("WorkPhone")->showDBValue($row, "");
					$values["EmailPrimary"] = $pageObject->getViewControl("EmailPrimary")->showDBValue($row, "");
					$values["EmailSecondary"] = $pageObject->getViewControl("EmailSecondary")->showDBValue($row, "");
					$values["Password"] = $pageObject->getViewControl("Password")->showDBValue($row, "");
					$values["Address_AddressId"] = $pageObject->getViewControl("Address_AddressId")->showDBValue($row, "");
					$values["address_AddressLine1"] = $pageObject->getViewControl("address_AddressLine1")->showDBValue($row, "");
					$values["address_AddressLine2"] = $pageObject->getViewControl("address_AddressLine2")->showDBValue($row, "");
					$values["address_City"] = $pageObject->getViewControl("address_City")->showDBValue($row, "");
					$values["address_State"] = $pageObject->getViewControl("address_State")->showDBValue($row, "");
					$values["address_Pincode"] = $pageObject->getViewControl("address_Pincode")->showDBValue($row, "");
					$values["address_Country"] = $pageObject->getViewControl("address_Country")->showDBValue($row, "");
					$values["address_IsVerified"] = $pageObject->getViewControl("address_IsVerified")->showDBValue($row, "");
					$values["address_IsWrong"] = $pageObject->getViewControl("address_IsWrong")->showDBValue($row, "");
					$values["address_AddressTypeId"] = $pageObject->getViewControl("address_AddressTypeId")->showDBValue($row, "");
					$values["organization_OrgName"] = $pageObject->getViewControl("organization_OrgName")->showDBValue($row, "");
					$values["organization_OrgId"] = $pageObject->getViewControl("organization_OrgId")->showDBValue($row, "");
					$values["organization_OrgLeaderId"] = $pageObject->getViewControl("organization_OrgLeaderId")->showDBValue($row, "");
					$values["organization_OrgOwnerId"] = $pageObject->getViewControl("organization_OrgOwnerId")->showDBValue($row, "");
					$values["organization_Location"] = $pageObject->getViewControl("organization_Location")->showDBValue($row, "");
					$values["spirituallife_SericesRendered"] = $pageObject->getViewControl("spirituallife_SericesRendered")->showDBValue($row, "");
					$values["SpiritualLife_DevoteeId"] = $pageObject->getViewControl("SpiritualLife_DevoteeId")->showDBValue($row, "");
					$values["spirituallife_PreferedServices"] = $pageObject->getViewControl("spirituallife_PreferedServices")->showDBValue($row, "");
					$values["spirituallife_Chanting16RoundsSince"] = $pageObject->getViewControl("spirituallife_Chanting16RoundsSince")->showDBValue($row, "");
					$values["spirituallife_IntroducedInCenter"] = $pageObject->getViewControl("spirituallife_IntroducedInCenter")->showDBValue($row, "");
					$values["spirituallife_YearOfIntroduction"] = $pageObject->getViewControl("spirituallife_YearOfIntroduction")->showDBValue($row, "");
					$values["spirituallife_PreviousReligion"] = $pageObject->getViewControl("spirituallife_PreviousReligion")->showDBValue($row, "");
					$values["spirituallife_SpiritualMasterDevoteeId"] = $pageObject->getViewControl("spirituallife_SpiritualMasterDevoteeId")->showDBValue($row, "");
					$values["spirituallife_DateOfBrahmanInitiation"] = $pageObject->getViewControl("spirituallife_DateOfBrahmanInitiation")->showDBValue($row, "");
					$values["spirituallife_DateOfHarinamInitiation"] = $pageObject->getViewControl("spirituallife_DateOfHarinamInitiation")->showDBValue($row, "");
					$values["spirituallife_SpiritulLifeId"] = $pageObject->getViewControl("spirituallife_SpiritulLifeId")->showDBValue($row, "");
					$values["spirituallife_IntroducedBy"] = $pageObject->getViewControl("spirituallife_IntroducedBy")->showDBValue($row, "");
					$values["company_CompanyId"] = $pageObject->getViewControl("company_CompanyId")->showDBValue($row, "");
					$values["company_CompanyName"] = $pageObject->getViewControl("company_CompanyName")->showDBValue($row, "");
					$values["company_AddressId"] = $pageObject->getViewControl("company_AddressId")->showDBValue($row, "");
					$values["company_Remark"] = $pageObject->getViewControl("company_Remark")->showDBValue($row, "");
					$values["devoteelang_DevoteeLanguageId"] = $pageObject->getViewControl("devoteelang_DevoteeLanguageId")->showDBValue($row, "");
					$values["devoteelang_WritingLevel"] = $pageObject->getViewControl("devoteelang_WritingLevel")->showDBValue($row, "");
					$values["devoteelang_DevoteeId"] = $pageObject->getViewControl("devoteelang_DevoteeId")->showDBValue($row, "");
					$values["devoteelang_LanguageId"] = $pageObject->getViewControl("devoteelang_LanguageId")->showDBValue($row, "");
					$values["devoteelang_SpeakingLevel"] = $pageObject->getViewControl("devoteelang_SpeakingLevel")->showDBValue($row, "");
					$values["devoteelang_ReadingLevel"] = $pageObject->getViewControl("devoteelang_ReadingLevel")->showDBValue($row, "");
					$values["occupational_DevoteeOccupationalId"] = $pageObject->getViewControl("occupational_DevoteeOccupationalId")->showDBValue($row, "");
					$values["Occupational_DevoteeId"] = $pageObject->getViewControl("Occupational_DevoteeId")->showDBValue($row, "");
					$values["Occupational_Education"] = $pageObject->getViewControl("Occupational_Education")->showDBValue($row, "");
					$values["Occupational_Occupation"] = $pageObject->getViewControl("Occupational_Occupation")->showDBValue($row, "");
					$values["Occupational_Designation"] = $pageObject->getViewControl("Occupational_Designation")->showDBValue($row, "");
					$values["Occupational_AwardsOrMerits"] = $pageObject->getViewControl("Occupational_AwardsOrMerits")->showDBValue($row, "");
					$values["occupational_SkillsOrExperiences"] = $pageObject->getViewControl("occupational_SkillsOrExperiences")->showDBValue($row, "");
					$values["occupational_CurrentCompanyId"] = $pageObject->getViewControl("occupational_CurrentCompanyId")->showDBValue($row, "");
					$values["addresstypes_AddressType"] = $pageObject->getViewControl("addresstypes_AddressType")->showDBValue($row, "");
					$values["addresstypes_AddressTypeId"] = $pageObject->getViewControl("addresstypes_AddressTypeId")->showDBValue($row, "");
					$values["DevoteeOrg_DevoteeOrgId"] = $pageObject->getViewControl("DevoteeOrg_DevoteeOrgId")->showDBValue($row, "");
					$values["DevoteeOrg_DevoteeId"] = $pageObject->getViewControl("DevoteeOrg_DevoteeId")->showDBValue($row, "");
					$values["DevoteeOrg_FromDate"] = $pageObject->getViewControl("DevoteeOrg_FromDate")->showDBValue($row, "");
					$values["DevoteeOrg_ToDate"] = $pageObject->getViewControl("DevoteeOrg_ToDate")->showDBValue($row, "");
					$values["DevoteeOrg_OrgId"] = $pageObject->getViewControl("DevoteeOrg_OrgId")->showDBValue($row, "");
					$values["devoteeaddress_devoteeaddressId"] = $pageObject->getViewControl("devoteeaddress_devoteeaddressId")->showDBValue($row, "");
					$values["devoteeaddress_AddressId"] = $pageObject->getViewControl("devoteeaddress_AddressId")->showDBValue($row, "");
					$values["devoteeaddress_DevoteeId"] = $pageObject->getViewControl("devoteeaddress_DevoteeId")->showDBValue($row, "");
		
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
			
				echo $values["Photo"];
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
					echo PrepareForExcel($values["TitleId"]);
				else
					echo $values["TitleId"];//echo htmlspecialchars($values["TitleId"]); commented for bug #6823
					
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
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DateOfBirth"]);
					else
						echo $values["DateOfBirth"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["MaritalStatusId"]);
					else
						echo $values["MaritalStatusId"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DateofMarriage"]);
					else
						echo $values["DateofMarriage"];
			echo '</td>';
							echo '<td>';
			
				
								if($_REQUEST["type"]=="excel")
					echo PrepareForExcel($values["SpouseDevoteeId"]);
				else
					echo $values["SpouseDevoteeId"];//echo htmlspecialchars($values["SpouseDevoteeId"]); commented for bug #6823
					
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
							echo '<td>';
			
									echo $values["Address_AddressId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_AddressLine1"]);
					else
						echo $values["address_AddressLine1"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_AddressLine2"]);
					else
						echo $values["address_AddressLine2"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_City"]);
					else
						echo $values["address_City"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_State"]);
					else
						echo $values["address_State"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_Pincode"]);
					else
						echo $values["address_Pincode"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_Country"]);
					else
						echo $values["address_Country"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_IsVerified"]);
					else
						echo $values["address_IsVerified"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["address_IsWrong"]);
					else
						echo $values["address_IsWrong"];
			echo '</td>';
							echo '<td>';
			
									echo $values["address_AddressTypeId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["organization_OrgName"]);
					else
						echo $values["organization_OrgName"];
			echo '</td>';
							echo '<td>';
			
									echo $values["organization_OrgId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["organization_OrgLeaderId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["organization_OrgOwnerId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["organization_Location"]);
					else
						echo $values["organization_Location"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_SericesRendered"]);
					else
						echo $values["spirituallife_SericesRendered"];
			echo '</td>';
							echo '<td>';
			
									echo $values["SpiritualLife_DevoteeId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_PreferedServices"]);
					else
						echo $values["spirituallife_PreferedServices"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_Chanting16RoundsSince"]);
					else
						echo $values["spirituallife_Chanting16RoundsSince"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_IntroducedInCenter"]);
					else
						echo $values["spirituallife_IntroducedInCenter"];
			echo '</td>';
							echo '<td>';
			
									echo $values["spirituallife_YearOfIntroduction"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_PreviousReligion"]);
					else
						echo $values["spirituallife_PreviousReligion"];
			echo '</td>';
							echo '<td>';
			
									echo $values["spirituallife_SpiritualMasterDevoteeId"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_DateOfBrahmanInitiation"]);
					else
						echo $values["spirituallife_DateOfBrahmanInitiation"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_DateOfHarinamInitiation"]);
					else
						echo $values["spirituallife_DateOfHarinamInitiation"];
			echo '</td>';
							echo '<td>';
			
									echo $values["spirituallife_SpiritulLifeId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["spirituallife_IntroducedBy"]);
					else
						echo $values["spirituallife_IntroducedBy"];
			echo '</td>';
							echo '<td>';
			
									echo $values["company_CompanyId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["company_CompanyName"]);
					else
						echo $values["company_CompanyName"];
			echo '</td>';
							echo '<td>';
			
									echo $values["company_AddressId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["company_Remark"]);
					else
						echo $values["company_Remark"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteelang_DevoteeLanguageId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteelang_WritingLevel"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteelang_DevoteeId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteelang_LanguageId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteelang_SpeakingLevel"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteelang_ReadingLevel"];
			echo '</td>';
							echo '<td>';
			
									echo $values["occupational_DevoteeOccupationalId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["Occupational_DevoteeId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Occupational_Education"]);
					else
						echo $values["Occupational_Education"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Occupational_Occupation"]);
					else
						echo $values["Occupational_Occupation"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Occupational_Designation"]);
					else
						echo $values["Occupational_Designation"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Occupational_AwardsOrMerits"]);
					else
						echo $values["Occupational_AwardsOrMerits"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["occupational_SkillsOrExperiences"]);
					else
						echo $values["occupational_SkillsOrExperiences"];
			echo '</td>';
							echo '<td>';
			
									echo $values["occupational_CurrentCompanyId"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["addresstypes_AddressType"]);
					else
						echo $values["addresstypes_AddressType"];
			echo '</td>';
							echo '<td>';
			
									echo $values["addresstypes_AddressTypeId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["DevoteeOrg_DevoteeOrgId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["DevoteeOrg_DevoteeId"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DevoteeOrg_FromDate"]);
					else
						echo $values["DevoteeOrg_FromDate"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["DevoteeOrg_ToDate"]);
					else
						echo $values["DevoteeOrg_ToDate"];
			echo '</td>';
							echo '<td>';
			
									echo $values["DevoteeOrg_OrgId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteeaddress_devoteeaddressId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteeaddress_AddressId"];
			echo '</td>';
							echo '<td>';
			
									echo $values["devoteeaddress_DevoteeId"];
			echo '</td>';
			echo "</tr>";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
	}
	
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
