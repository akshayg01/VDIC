<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("classes/searchclause.php");

add_nocache_headers();

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

$layout = new TLayout("print","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"printgrid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "empty";
$layout->blocks["center"][] = "grid";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";$page_layouts["vw_Devotee_full_print"] = $layout;


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
$arr['fName'] = "address_AddressLine1";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_AddressLine1");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_AddressLine2";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_AddressLine2");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_City";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_City");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_State";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_State");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_Country";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_Country");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_Pincode";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_Pincode");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_IsVerified";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_IsVerified");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_IsWrong";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_IsWrong");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "address_AddressTypeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("address_AddressTypeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Occupational_DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Occupational_DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Occupational_Education";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Occupational_Education");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Occupational_Occupation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Occupational_Occupation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Occupational_Designation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Occupational_Designation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Occupational_AwardsOrMerits";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Occupational_AwardsOrMerits");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "occupational_SkillsOrExperiences";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("occupational_SkillsOrExperiences");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "occupational_CurrentCompanyId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("occupational_CurrentCompanyId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "organization_OrgId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("organization_OrgId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "organization_OrgName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("organization_OrgName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "organization_OrgOwnerId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("organization_OrgOwnerId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "organization_OrgLeaderId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("organization_OrgLeaderId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "organization_Location";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("organization_Location");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_SpiritulLifeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_SpiritulLifeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "SpiritualLife_DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("SpiritualLife_DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_DateOfHarinamInitiation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_DateOfHarinamInitiation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_DateOfBrahmanInitiation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_DateOfBrahmanInitiation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_SpiritualMasterDevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_SpiritualMasterDevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_PreviousReligion";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_PreviousReligion");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_Chanting16RoundsSince";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_Chanting16RoundsSince");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_IntroducedBy";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_IntroducedBy");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_YearOfIntroduction";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_YearOfIntroduction");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_IntroducedInCenter";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_IntroducedInCenter");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_PreferedServices";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_PreferedServices");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "spirituallife_SericesRendered";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("spirituallife_SericesRendered");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteeaddress_DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteeaddress_DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteeaddress_AddressId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteeaddress_AddressId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteelang_DevoteeLanguageId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteelang_DevoteeLanguageId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteelang_DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteelang_DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteelang_LanguageId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteelang_LanguageId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteelang_SpeakingLevel";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteelang_SpeakingLevel");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteelang_ReadingLevel";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteelang_ReadingLevel");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteelang_WritingLevel";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteelang_WritingLevel");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "addresstypes_AddressType";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("addresstypes_AddressType");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "addresstypes_AddressTypeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("addresstypes_AddressTypeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "devoteeaddress_devoteeaddressId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("devoteeaddress_devoteeaddressId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Address_AddressId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Address_AddressId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "occupational_DevoteeOccupationalId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("occupational_DevoteeOccupationalId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DevoteeOrg_DevoteeOrgId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeOrg_DevoteeOrgId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DevoteeOrg_OrgId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeOrg_OrgId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DevoteeOrg_DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeOrg_DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DevoteeOrg_FromDate";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeOrg_FromDate");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DevoteeOrg_ToDate";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeOrg_ToDate");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "company_CompanyId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("company_CompanyId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "company_CompanyName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("company_CompanyName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "company_AddressId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("company_AddressId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "company_Remark";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("company_Remark");
$fieldsArr[] = $arr;
$pageObject->setGoogleMapsParams($fieldsArr);

$colsonpage=1;
if($colsonpage>$recordsonpage)
	$colsonpage=$recordsonpage;
if($colsonpage<1)
	$colsonpage=1;


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
			$recno++;
			$records++;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));

//	DevoteeId - 
			$record["DevoteeId_value"] = $pageObject->showDBValue("DevoteeId", $data, $keylink);
			$record["DevoteeId_class"] = $pageObject->fieldClass("DevoteeId");
//	Address_AddressId - 
			$record["Address_AddressId_value"] = $pageObject->showDBValue("Address_AddressId", $data, $keylink);
			$record["Address_AddressId_class"] = $pageObject->fieldClass("Address_AddressId");
//	address_AddressLine1 - 
			$record["address_AddressLine1_value"] = $pageObject->showDBValue("address_AddressLine1", $data, $keylink);
			$record["address_AddressLine1_class"] = $pageObject->fieldClass("address_AddressLine1");
//	address_AddressLine2 - 
			$record["address_AddressLine2_value"] = $pageObject->showDBValue("address_AddressLine2", $data, $keylink);
			$record["address_AddressLine2_class"] = $pageObject->fieldClass("address_AddressLine2");
//	address_City - 
			$record["address_City_value"] = $pageObject->showDBValue("address_City", $data, $keylink);
			$record["address_City_class"] = $pageObject->fieldClass("address_City");
//	address_State - 
			$record["address_State_value"] = $pageObject->showDBValue("address_State", $data, $keylink);
			$record["address_State_class"] = $pageObject->fieldClass("address_State");
//	address_Pincode - 
			$record["address_Pincode_value"] = $pageObject->showDBValue("address_Pincode", $data, $keylink);
			$record["address_Pincode_class"] = $pageObject->fieldClass("address_Pincode");
//	address_Country - 
			$record["address_Country_value"] = $pageObject->showDBValue("address_Country", $data, $keylink);
			$record["address_Country_class"] = $pageObject->fieldClass("address_Country");
//	address_IsVerified - 
			$record["address_IsVerified_value"] = $pageObject->showDBValue("address_IsVerified", $data, $keylink);
			$record["address_IsVerified_class"] = $pageObject->fieldClass("address_IsVerified");
//	address_IsWrong - 
			$record["address_IsWrong_value"] = $pageObject->showDBValue("address_IsWrong", $data, $keylink);
			$record["address_IsWrong_class"] = $pageObject->fieldClass("address_IsWrong");
//	address_AddressTypeId - 
			$record["address_AddressTypeId_value"] = $pageObject->showDBValue("address_AddressTypeId", $data, $keylink);
			$record["address_AddressTypeId_class"] = $pageObject->fieldClass("address_AddressTypeId");
//	organization_OrgName - 
			$record["organization_OrgName_value"] = $pageObject->showDBValue("organization_OrgName", $data, $keylink);
			$record["organization_OrgName_class"] = $pageObject->fieldClass("organization_OrgName");
//	organization_OrgId - 
			$record["organization_OrgId_value"] = $pageObject->showDBValue("organization_OrgId", $data, $keylink);
			$record["organization_OrgId_class"] = $pageObject->fieldClass("organization_OrgId");
//	organization_OrgLeaderId - 
			$record["organization_OrgLeaderId_value"] = $pageObject->showDBValue("organization_OrgLeaderId", $data, $keylink);
			$record["organization_OrgLeaderId_class"] = $pageObject->fieldClass("organization_OrgLeaderId");
//	organization_OrgOwnerId - 
			$record["organization_OrgOwnerId_value"] = $pageObject->showDBValue("organization_OrgOwnerId", $data, $keylink);
			$record["organization_OrgOwnerId_class"] = $pageObject->fieldClass("organization_OrgOwnerId");
//	organization_Location - 
			$record["organization_Location_value"] = $pageObject->showDBValue("organization_Location", $data, $keylink);
			$record["organization_Location_class"] = $pageObject->fieldClass("organization_Location");
//	spirituallife_SericesRendered - 
			$record["spirituallife_SericesRendered_value"] = $pageObject->showDBValue("spirituallife_SericesRendered", $data, $keylink);
			$record["spirituallife_SericesRendered_class"] = $pageObject->fieldClass("spirituallife_SericesRendered");
//	SpiritualLife_DevoteeId - 
			$record["SpiritualLife_DevoteeId_value"] = $pageObject->showDBValue("SpiritualLife_DevoteeId", $data, $keylink);
			$record["SpiritualLife_DevoteeId_class"] = $pageObject->fieldClass("SpiritualLife_DevoteeId");
//	spirituallife_PreferedServices - 
			$record["spirituallife_PreferedServices_value"] = $pageObject->showDBValue("spirituallife_PreferedServices", $data, $keylink);
			$record["spirituallife_PreferedServices_class"] = $pageObject->fieldClass("spirituallife_PreferedServices");
//	spirituallife_Chanting16RoundsSince - Short Date
			$record["spirituallife_Chanting16RoundsSince_value"] = $pageObject->showDBValue("spirituallife_Chanting16RoundsSince", $data, $keylink);
			$record["spirituallife_Chanting16RoundsSince_class"] = $pageObject->fieldClass("spirituallife_Chanting16RoundsSince");
//	spirituallife_IntroducedInCenter - 
			$record["spirituallife_IntroducedInCenter_value"] = $pageObject->showDBValue("spirituallife_IntroducedInCenter", $data, $keylink);
			$record["spirituallife_IntroducedInCenter_class"] = $pageObject->fieldClass("spirituallife_IntroducedInCenter");
//	spirituallife_YearOfIntroduction - 
			$record["spirituallife_YearOfIntroduction_value"] = $pageObject->showDBValue("spirituallife_YearOfIntroduction", $data, $keylink);
			$record["spirituallife_YearOfIntroduction_class"] = $pageObject->fieldClass("spirituallife_YearOfIntroduction");
//	spirituallife_PreviousReligion - 
			$record["spirituallife_PreviousReligion_value"] = $pageObject->showDBValue("spirituallife_PreviousReligion", $data, $keylink);
			$record["spirituallife_PreviousReligion_class"] = $pageObject->fieldClass("spirituallife_PreviousReligion");
//	spirituallife_SpiritualMasterDevoteeId - 
			$record["spirituallife_SpiritualMasterDevoteeId_value"] = $pageObject->showDBValue("spirituallife_SpiritualMasterDevoteeId", $data, $keylink);
			$record["spirituallife_SpiritualMasterDevoteeId_class"] = $pageObject->fieldClass("spirituallife_SpiritualMasterDevoteeId");
//	spirituallife_DateOfBrahmanInitiation - Short Date
			$record["spirituallife_DateOfBrahmanInitiation_value"] = $pageObject->showDBValue("spirituallife_DateOfBrahmanInitiation", $data, $keylink);
			$record["spirituallife_DateOfBrahmanInitiation_class"] = $pageObject->fieldClass("spirituallife_DateOfBrahmanInitiation");
//	spirituallife_DateOfHarinamInitiation - Short Date
			$record["spirituallife_DateOfHarinamInitiation_value"] = $pageObject->showDBValue("spirituallife_DateOfHarinamInitiation", $data, $keylink);
			$record["spirituallife_DateOfHarinamInitiation_class"] = $pageObject->fieldClass("spirituallife_DateOfHarinamInitiation");
//	spirituallife_SpiritulLifeId - 
			$record["spirituallife_SpiritulLifeId_value"] = $pageObject->showDBValue("spirituallife_SpiritulLifeId", $data, $keylink);
			$record["spirituallife_SpiritulLifeId_class"] = $pageObject->fieldClass("spirituallife_SpiritulLifeId");
//	spirituallife_IntroducedBy - 
			$record["spirituallife_IntroducedBy_value"] = $pageObject->showDBValue("spirituallife_IntroducedBy", $data, $keylink);
			$record["spirituallife_IntroducedBy_class"] = $pageObject->fieldClass("spirituallife_IntroducedBy");
//	company_CompanyId - 
			$record["company_CompanyId_value"] = $pageObject->showDBValue("company_CompanyId", $data, $keylink);
			$record["company_CompanyId_class"] = $pageObject->fieldClass("company_CompanyId");
//	company_CompanyName - 
			$record["company_CompanyName_value"] = $pageObject->showDBValue("company_CompanyName", $data, $keylink);
			$record["company_CompanyName_class"] = $pageObject->fieldClass("company_CompanyName");
//	company_AddressId - 
			$record["company_AddressId_value"] = $pageObject->showDBValue("company_AddressId", $data, $keylink);
			$record["company_AddressId_class"] = $pageObject->fieldClass("company_AddressId");
//	company_Remark - 
			$record["company_Remark_value"] = $pageObject->showDBValue("company_Remark", $data, $keylink);
			$record["company_Remark_class"] = $pageObject->fieldClass("company_Remark");
//	devoteelang_DevoteeLanguageId - 
			$record["devoteelang_DevoteeLanguageId_value"] = $pageObject->showDBValue("devoteelang_DevoteeLanguageId", $data, $keylink);
			$record["devoteelang_DevoteeLanguageId_class"] = $pageObject->fieldClass("devoteelang_DevoteeLanguageId");
//	devoteelang_WritingLevel - 
			$record["devoteelang_WritingLevel_value"] = $pageObject->showDBValue("devoteelang_WritingLevel", $data, $keylink);
			$record["devoteelang_WritingLevel_class"] = $pageObject->fieldClass("devoteelang_WritingLevel");
//	devoteelang_DevoteeId - 
			$record["devoteelang_DevoteeId_value"] = $pageObject->showDBValue("devoteelang_DevoteeId", $data, $keylink);
			$record["devoteelang_DevoteeId_class"] = $pageObject->fieldClass("devoteelang_DevoteeId");
//	devoteelang_LanguageId - 
			$record["devoteelang_LanguageId_value"] = $pageObject->showDBValue("devoteelang_LanguageId", $data, $keylink);
			$record["devoteelang_LanguageId_class"] = $pageObject->fieldClass("devoteelang_LanguageId");
//	devoteelang_SpeakingLevel - 
			$record["devoteelang_SpeakingLevel_value"] = $pageObject->showDBValue("devoteelang_SpeakingLevel", $data, $keylink);
			$record["devoteelang_SpeakingLevel_class"] = $pageObject->fieldClass("devoteelang_SpeakingLevel");
//	devoteelang_ReadingLevel - 
			$record["devoteelang_ReadingLevel_value"] = $pageObject->showDBValue("devoteelang_ReadingLevel", $data, $keylink);
			$record["devoteelang_ReadingLevel_class"] = $pageObject->fieldClass("devoteelang_ReadingLevel");
//	occupational_DevoteeOccupationalId - 
			$record["occupational_DevoteeOccupationalId_value"] = $pageObject->showDBValue("occupational_DevoteeOccupationalId", $data, $keylink);
			$record["occupational_DevoteeOccupationalId_class"] = $pageObject->fieldClass("occupational_DevoteeOccupationalId");
//	Occupational_DevoteeId - 
			$record["Occupational_DevoteeId_value"] = $pageObject->showDBValue("Occupational_DevoteeId", $data, $keylink);
			$record["Occupational_DevoteeId_class"] = $pageObject->fieldClass("Occupational_DevoteeId");
//	Occupational_Education - 
			$record["Occupational_Education_value"] = $pageObject->showDBValue("Occupational_Education", $data, $keylink);
			$record["Occupational_Education_class"] = $pageObject->fieldClass("Occupational_Education");
//	Occupational_Occupation - 
			$record["Occupational_Occupation_value"] = $pageObject->showDBValue("Occupational_Occupation", $data, $keylink);
			$record["Occupational_Occupation_class"] = $pageObject->fieldClass("Occupational_Occupation");
//	Occupational_Designation - 
			$record["Occupational_Designation_value"] = $pageObject->showDBValue("Occupational_Designation", $data, $keylink);
			$record["Occupational_Designation_class"] = $pageObject->fieldClass("Occupational_Designation");
//	Occupational_AwardsOrMerits - 
			$record["Occupational_AwardsOrMerits_value"] = $pageObject->showDBValue("Occupational_AwardsOrMerits", $data, $keylink);
			$record["Occupational_AwardsOrMerits_class"] = $pageObject->fieldClass("Occupational_AwardsOrMerits");
//	occupational_SkillsOrExperiences - 
			$record["occupational_SkillsOrExperiences_value"] = $pageObject->showDBValue("occupational_SkillsOrExperiences", $data, $keylink);
			$record["occupational_SkillsOrExperiences_class"] = $pageObject->fieldClass("occupational_SkillsOrExperiences");
//	occupational_CurrentCompanyId - 
			$record["occupational_CurrentCompanyId_value"] = $pageObject->showDBValue("occupational_CurrentCompanyId", $data, $keylink);
			$record["occupational_CurrentCompanyId_class"] = $pageObject->fieldClass("occupational_CurrentCompanyId");
//	addresstypes_AddressType - 
			$record["addresstypes_AddressType_value"] = $pageObject->showDBValue("addresstypes_AddressType", $data, $keylink);
			$record["addresstypes_AddressType_class"] = $pageObject->fieldClass("addresstypes_AddressType");
//	addresstypes_AddressTypeId - 
			$record["addresstypes_AddressTypeId_value"] = $pageObject->showDBValue("addresstypes_AddressTypeId", $data, $keylink);
			$record["addresstypes_AddressTypeId_class"] = $pageObject->fieldClass("addresstypes_AddressTypeId");
//	DevoteeOrg_DevoteeOrgId - 
			$record["DevoteeOrg_DevoteeOrgId_value"] = $pageObject->showDBValue("DevoteeOrg_DevoteeOrgId", $data, $keylink);
			$record["DevoteeOrg_DevoteeOrgId_class"] = $pageObject->fieldClass("DevoteeOrg_DevoteeOrgId");
//	DevoteeOrg_DevoteeId - 
			$record["DevoteeOrg_DevoteeId_value"] = $pageObject->showDBValue("DevoteeOrg_DevoteeId", $data, $keylink);
			$record["DevoteeOrg_DevoteeId_class"] = $pageObject->fieldClass("DevoteeOrg_DevoteeId");
//	DevoteeOrg_FromDate - Short Date
			$record["DevoteeOrg_FromDate_value"] = $pageObject->showDBValue("DevoteeOrg_FromDate", $data, $keylink);
			$record["DevoteeOrg_FromDate_class"] = $pageObject->fieldClass("DevoteeOrg_FromDate");
//	DevoteeOrg_ToDate - Short Date
			$record["DevoteeOrg_ToDate_value"] = $pageObject->showDBValue("DevoteeOrg_ToDate", $data, $keylink);
			$record["DevoteeOrg_ToDate_class"] = $pageObject->fieldClass("DevoteeOrg_ToDate");
//	DevoteeOrg_OrgId - 
			$record["DevoteeOrg_OrgId_value"] = $pageObject->showDBValue("DevoteeOrg_OrgId", $data, $keylink);
			$record["DevoteeOrg_OrgId_class"] = $pageObject->fieldClass("DevoteeOrg_OrgId");
//	devoteeaddress_devoteeaddressId - 
			$record["devoteeaddress_devoteeaddressId_value"] = $pageObject->showDBValue("devoteeaddress_devoteeaddressId", $data, $keylink);
			$record["devoteeaddress_devoteeaddressId_class"] = $pageObject->fieldClass("devoteeaddress_devoteeaddressId");
//	devoteeaddress_AddressId - 
			$record["devoteeaddress_AddressId_value"] = $pageObject->showDBValue("devoteeaddress_AddressId", $data, $keylink);
			$record["devoteeaddress_AddressId_class"] = $pageObject->fieldClass("devoteeaddress_AddressId");
//	devoteeaddress_DevoteeId - 
			$record["devoteeaddress_DevoteeId_value"] = $pageObject->showDBValue("devoteeaddress_DevoteeId", $data, $keylink);
			$record["devoteeaddress_DevoteeId_class"] = $pageObject->fieldClass("devoteeaddress_DevoteeId");
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
$xt->assign("Address_AddressId_fieldheadercolumn",true);
$xt->assign("Address_AddressId_fieldheader",true);
$xt->assign("Address_AddressId_fieldcolumn",true);
$xt->assign("Address_AddressId_fieldfootercolumn",true);
$xt->assign("address_AddressLine1_fieldheadercolumn",true);
$xt->assign("address_AddressLine1_fieldheader",true);
$xt->assign("address_AddressLine1_fieldcolumn",true);
$xt->assign("address_AddressLine1_fieldfootercolumn",true);
$xt->assign("address_AddressLine2_fieldheadercolumn",true);
$xt->assign("address_AddressLine2_fieldheader",true);
$xt->assign("address_AddressLine2_fieldcolumn",true);
$xt->assign("address_AddressLine2_fieldfootercolumn",true);
$xt->assign("address_City_fieldheadercolumn",true);
$xt->assign("address_City_fieldheader",true);
$xt->assign("address_City_fieldcolumn",true);
$xt->assign("address_City_fieldfootercolumn",true);
$xt->assign("address_State_fieldheadercolumn",true);
$xt->assign("address_State_fieldheader",true);
$xt->assign("address_State_fieldcolumn",true);
$xt->assign("address_State_fieldfootercolumn",true);
$xt->assign("address_Pincode_fieldheadercolumn",true);
$xt->assign("address_Pincode_fieldheader",true);
$xt->assign("address_Pincode_fieldcolumn",true);
$xt->assign("address_Pincode_fieldfootercolumn",true);
$xt->assign("address_Country_fieldheadercolumn",true);
$xt->assign("address_Country_fieldheader",true);
$xt->assign("address_Country_fieldcolumn",true);
$xt->assign("address_Country_fieldfootercolumn",true);
$xt->assign("address_IsVerified_fieldheadercolumn",true);
$xt->assign("address_IsVerified_fieldheader",true);
$xt->assign("address_IsVerified_fieldcolumn",true);
$xt->assign("address_IsVerified_fieldfootercolumn",true);
$xt->assign("address_IsWrong_fieldheadercolumn",true);
$xt->assign("address_IsWrong_fieldheader",true);
$xt->assign("address_IsWrong_fieldcolumn",true);
$xt->assign("address_IsWrong_fieldfootercolumn",true);
$xt->assign("address_AddressTypeId_fieldheadercolumn",true);
$xt->assign("address_AddressTypeId_fieldheader",true);
$xt->assign("address_AddressTypeId_fieldcolumn",true);
$xt->assign("address_AddressTypeId_fieldfootercolumn",true);
$xt->assign("organization_OrgName_fieldheadercolumn",true);
$xt->assign("organization_OrgName_fieldheader",true);
$xt->assign("organization_OrgName_fieldcolumn",true);
$xt->assign("organization_OrgName_fieldfootercolumn",true);
$xt->assign("organization_OrgId_fieldheadercolumn",true);
$xt->assign("organization_OrgId_fieldheader",true);
$xt->assign("organization_OrgId_fieldcolumn",true);
$xt->assign("organization_OrgId_fieldfootercolumn",true);
$xt->assign("organization_OrgLeaderId_fieldheadercolumn",true);
$xt->assign("organization_OrgLeaderId_fieldheader",true);
$xt->assign("organization_OrgLeaderId_fieldcolumn",true);
$xt->assign("organization_OrgLeaderId_fieldfootercolumn",true);
$xt->assign("organization_OrgOwnerId_fieldheadercolumn",true);
$xt->assign("organization_OrgOwnerId_fieldheader",true);
$xt->assign("organization_OrgOwnerId_fieldcolumn",true);
$xt->assign("organization_OrgOwnerId_fieldfootercolumn",true);
$xt->assign("organization_Location_fieldheadercolumn",true);
$xt->assign("organization_Location_fieldheader",true);
$xt->assign("organization_Location_fieldcolumn",true);
$xt->assign("organization_Location_fieldfootercolumn",true);
$xt->assign("spirituallife_SericesRendered_fieldheadercolumn",true);
$xt->assign("spirituallife_SericesRendered_fieldheader",true);
$xt->assign("spirituallife_SericesRendered_fieldcolumn",true);
$xt->assign("spirituallife_SericesRendered_fieldfootercolumn",true);
$xt->assign("SpiritualLife_DevoteeId_fieldheadercolumn",true);
$xt->assign("SpiritualLife_DevoteeId_fieldheader",true);
$xt->assign("SpiritualLife_DevoteeId_fieldcolumn",true);
$xt->assign("SpiritualLife_DevoteeId_fieldfootercolumn",true);
$xt->assign("spirituallife_PreferedServices_fieldheadercolumn",true);
$xt->assign("spirituallife_PreferedServices_fieldheader",true);
$xt->assign("spirituallife_PreferedServices_fieldcolumn",true);
$xt->assign("spirituallife_PreferedServices_fieldfootercolumn",true);
$xt->assign("spirituallife_Chanting16RoundsSince_fieldheadercolumn",true);
$xt->assign("spirituallife_Chanting16RoundsSince_fieldheader",true);
$xt->assign("spirituallife_Chanting16RoundsSince_fieldcolumn",true);
$xt->assign("spirituallife_Chanting16RoundsSince_fieldfootercolumn",true);
$xt->assign("spirituallife_IntroducedInCenter_fieldheadercolumn",true);
$xt->assign("spirituallife_IntroducedInCenter_fieldheader",true);
$xt->assign("spirituallife_IntroducedInCenter_fieldcolumn",true);
$xt->assign("spirituallife_IntroducedInCenter_fieldfootercolumn",true);
$xt->assign("spirituallife_YearOfIntroduction_fieldheadercolumn",true);
$xt->assign("spirituallife_YearOfIntroduction_fieldheader",true);
$xt->assign("spirituallife_YearOfIntroduction_fieldcolumn",true);
$xt->assign("spirituallife_YearOfIntroduction_fieldfootercolumn",true);
$xt->assign("spirituallife_PreviousReligion_fieldheadercolumn",true);
$xt->assign("spirituallife_PreviousReligion_fieldheader",true);
$xt->assign("spirituallife_PreviousReligion_fieldcolumn",true);
$xt->assign("spirituallife_PreviousReligion_fieldfootercolumn",true);
$xt->assign("spirituallife_SpiritualMasterDevoteeId_fieldheadercolumn",true);
$xt->assign("spirituallife_SpiritualMasterDevoteeId_fieldheader",true);
$xt->assign("spirituallife_SpiritualMasterDevoteeId_fieldcolumn",true);
$xt->assign("spirituallife_SpiritualMasterDevoteeId_fieldfootercolumn",true);
$xt->assign("spirituallife_DateOfBrahmanInitiation_fieldheadercolumn",true);
$xt->assign("spirituallife_DateOfBrahmanInitiation_fieldheader",true);
$xt->assign("spirituallife_DateOfBrahmanInitiation_fieldcolumn",true);
$xt->assign("spirituallife_DateOfBrahmanInitiation_fieldfootercolumn",true);
$xt->assign("spirituallife_DateOfHarinamInitiation_fieldheadercolumn",true);
$xt->assign("spirituallife_DateOfHarinamInitiation_fieldheader",true);
$xt->assign("spirituallife_DateOfHarinamInitiation_fieldcolumn",true);
$xt->assign("spirituallife_DateOfHarinamInitiation_fieldfootercolumn",true);
$xt->assign("spirituallife_SpiritulLifeId_fieldheadercolumn",true);
$xt->assign("spirituallife_SpiritulLifeId_fieldheader",true);
$xt->assign("spirituallife_SpiritulLifeId_fieldcolumn",true);
$xt->assign("spirituallife_SpiritulLifeId_fieldfootercolumn",true);
$xt->assign("spirituallife_IntroducedBy_fieldheadercolumn",true);
$xt->assign("spirituallife_IntroducedBy_fieldheader",true);
$xt->assign("spirituallife_IntroducedBy_fieldcolumn",true);
$xt->assign("spirituallife_IntroducedBy_fieldfootercolumn",true);
$xt->assign("company_CompanyId_fieldheadercolumn",true);
$xt->assign("company_CompanyId_fieldheader",true);
$xt->assign("company_CompanyId_fieldcolumn",true);
$xt->assign("company_CompanyId_fieldfootercolumn",true);
$xt->assign("company_CompanyName_fieldheadercolumn",true);
$xt->assign("company_CompanyName_fieldheader",true);
$xt->assign("company_CompanyName_fieldcolumn",true);
$xt->assign("company_CompanyName_fieldfootercolumn",true);
$xt->assign("company_AddressId_fieldheadercolumn",true);
$xt->assign("company_AddressId_fieldheader",true);
$xt->assign("company_AddressId_fieldcolumn",true);
$xt->assign("company_AddressId_fieldfootercolumn",true);
$xt->assign("company_Remark_fieldheadercolumn",true);
$xt->assign("company_Remark_fieldheader",true);
$xt->assign("company_Remark_fieldcolumn",true);
$xt->assign("company_Remark_fieldfootercolumn",true);
$xt->assign("devoteelang_DevoteeLanguageId_fieldheadercolumn",true);
$xt->assign("devoteelang_DevoteeLanguageId_fieldheader",true);
$xt->assign("devoteelang_DevoteeLanguageId_fieldcolumn",true);
$xt->assign("devoteelang_DevoteeLanguageId_fieldfootercolumn",true);
$xt->assign("devoteelang_WritingLevel_fieldheadercolumn",true);
$xt->assign("devoteelang_WritingLevel_fieldheader",true);
$xt->assign("devoteelang_WritingLevel_fieldcolumn",true);
$xt->assign("devoteelang_WritingLevel_fieldfootercolumn",true);
$xt->assign("devoteelang_DevoteeId_fieldheadercolumn",true);
$xt->assign("devoteelang_DevoteeId_fieldheader",true);
$xt->assign("devoteelang_DevoteeId_fieldcolumn",true);
$xt->assign("devoteelang_DevoteeId_fieldfootercolumn",true);
$xt->assign("devoteelang_LanguageId_fieldheadercolumn",true);
$xt->assign("devoteelang_LanguageId_fieldheader",true);
$xt->assign("devoteelang_LanguageId_fieldcolumn",true);
$xt->assign("devoteelang_LanguageId_fieldfootercolumn",true);
$xt->assign("devoteelang_SpeakingLevel_fieldheadercolumn",true);
$xt->assign("devoteelang_SpeakingLevel_fieldheader",true);
$xt->assign("devoteelang_SpeakingLevel_fieldcolumn",true);
$xt->assign("devoteelang_SpeakingLevel_fieldfootercolumn",true);
$xt->assign("devoteelang_ReadingLevel_fieldheadercolumn",true);
$xt->assign("devoteelang_ReadingLevel_fieldheader",true);
$xt->assign("devoteelang_ReadingLevel_fieldcolumn",true);
$xt->assign("devoteelang_ReadingLevel_fieldfootercolumn",true);
$xt->assign("occupational_DevoteeOccupationalId_fieldheadercolumn",true);
$xt->assign("occupational_DevoteeOccupationalId_fieldheader",true);
$xt->assign("occupational_DevoteeOccupationalId_fieldcolumn",true);
$xt->assign("occupational_DevoteeOccupationalId_fieldfootercolumn",true);
$xt->assign("Occupational_DevoteeId_fieldheadercolumn",true);
$xt->assign("Occupational_DevoteeId_fieldheader",true);
$xt->assign("Occupational_DevoteeId_fieldcolumn",true);
$xt->assign("Occupational_DevoteeId_fieldfootercolumn",true);
$xt->assign("Occupational_Education_fieldheadercolumn",true);
$xt->assign("Occupational_Education_fieldheader",true);
$xt->assign("Occupational_Education_fieldcolumn",true);
$xt->assign("Occupational_Education_fieldfootercolumn",true);
$xt->assign("Occupational_Occupation_fieldheadercolumn",true);
$xt->assign("Occupational_Occupation_fieldheader",true);
$xt->assign("Occupational_Occupation_fieldcolumn",true);
$xt->assign("Occupational_Occupation_fieldfootercolumn",true);
$xt->assign("Occupational_Designation_fieldheadercolumn",true);
$xt->assign("Occupational_Designation_fieldheader",true);
$xt->assign("Occupational_Designation_fieldcolumn",true);
$xt->assign("Occupational_Designation_fieldfootercolumn",true);
$xt->assign("Occupational_AwardsOrMerits_fieldheadercolumn",true);
$xt->assign("Occupational_AwardsOrMerits_fieldheader",true);
$xt->assign("Occupational_AwardsOrMerits_fieldcolumn",true);
$xt->assign("Occupational_AwardsOrMerits_fieldfootercolumn",true);
$xt->assign("occupational_SkillsOrExperiences_fieldheadercolumn",true);
$xt->assign("occupational_SkillsOrExperiences_fieldheader",true);
$xt->assign("occupational_SkillsOrExperiences_fieldcolumn",true);
$xt->assign("occupational_SkillsOrExperiences_fieldfootercolumn",true);
$xt->assign("occupational_CurrentCompanyId_fieldheadercolumn",true);
$xt->assign("occupational_CurrentCompanyId_fieldheader",true);
$xt->assign("occupational_CurrentCompanyId_fieldcolumn",true);
$xt->assign("occupational_CurrentCompanyId_fieldfootercolumn",true);
$xt->assign("addresstypes_AddressType_fieldheadercolumn",true);
$xt->assign("addresstypes_AddressType_fieldheader",true);
$xt->assign("addresstypes_AddressType_fieldcolumn",true);
$xt->assign("addresstypes_AddressType_fieldfootercolumn",true);
$xt->assign("addresstypes_AddressTypeId_fieldheadercolumn",true);
$xt->assign("addresstypes_AddressTypeId_fieldheader",true);
$xt->assign("addresstypes_AddressTypeId_fieldcolumn",true);
$xt->assign("addresstypes_AddressTypeId_fieldfootercolumn",true);
$xt->assign("DevoteeOrg_DevoteeOrgId_fieldheadercolumn",true);
$xt->assign("DevoteeOrg_DevoteeOrgId_fieldheader",true);
$xt->assign("DevoteeOrg_DevoteeOrgId_fieldcolumn",true);
$xt->assign("DevoteeOrg_DevoteeOrgId_fieldfootercolumn",true);
$xt->assign("DevoteeOrg_DevoteeId_fieldheadercolumn",true);
$xt->assign("DevoteeOrg_DevoteeId_fieldheader",true);
$xt->assign("DevoteeOrg_DevoteeId_fieldcolumn",true);
$xt->assign("DevoteeOrg_DevoteeId_fieldfootercolumn",true);
$xt->assign("DevoteeOrg_FromDate_fieldheadercolumn",true);
$xt->assign("DevoteeOrg_FromDate_fieldheader",true);
$xt->assign("DevoteeOrg_FromDate_fieldcolumn",true);
$xt->assign("DevoteeOrg_FromDate_fieldfootercolumn",true);
$xt->assign("DevoteeOrg_ToDate_fieldheadercolumn",true);
$xt->assign("DevoteeOrg_ToDate_fieldheader",true);
$xt->assign("DevoteeOrg_ToDate_fieldcolumn",true);
$xt->assign("DevoteeOrg_ToDate_fieldfootercolumn",true);
$xt->assign("DevoteeOrg_OrgId_fieldheadercolumn",true);
$xt->assign("DevoteeOrg_OrgId_fieldheader",true);
$xt->assign("DevoteeOrg_OrgId_fieldcolumn",true);
$xt->assign("DevoteeOrg_OrgId_fieldfootercolumn",true);
$xt->assign("devoteeaddress_devoteeaddressId_fieldheadercolumn",true);
$xt->assign("devoteeaddress_devoteeaddressId_fieldheader",true);
$xt->assign("devoteeaddress_devoteeaddressId_fieldcolumn",true);
$xt->assign("devoteeaddress_devoteeaddressId_fieldfootercolumn",true);
$xt->assign("devoteeaddress_AddressId_fieldheadercolumn",true);
$xt->assign("devoteeaddress_AddressId_fieldheader",true);
$xt->assign("devoteeaddress_AddressId_fieldcolumn",true);
$xt->assign("devoteeaddress_AddressId_fieldfootercolumn",true);
$xt->assign("devoteeaddress_DevoteeId_fieldheadercolumn",true);
$xt->assign("devoteeaddress_DevoteeId_fieldheader",true);
$xt->assign("devoteeaddress_DevoteeId_fieldcolumn",true);
$xt->assign("devoteeaddress_DevoteeId_fieldfootercolumn",true);

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
