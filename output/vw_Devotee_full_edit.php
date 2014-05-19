<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/vw_Devotee_full_variables.php");
include('include/xtempl.php');
include('classes/editpage.php');
include("classes/searchclause.php");

add_nocache_headers();

global $globalEvents;

//	check if logged in
if(!isLogged() || CheckPermissionsEvent($strTableName, 'E') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired");
	return;
}

$layout = new TLayout("edit2","RoundedAqua1","MobileAqua1");
$layout->blocks["top"] = array();
$layout->containers["edit"] = array();

$layout->containers["edit"][] = array("name"=>"editheader","block"=>"","substyle"=>2);


$layout->containers["edit"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->containers["edit"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"editfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"legend","block"=>"legend","substyle"=>3);


$layout->containers["fields"][] = array("name"=>"editbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["edit"] = "1";
$layout->blocks["top"][] = "edit";
$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["vw_Devotee_full_edit"] = $layout;


$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_edit_Basic_Info1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_edit_Address1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_edit_Organization1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_edit_Spiritual_Life1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_edit_Company1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_edit_Language1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_edit_Occupational1"] = $layout;



if ((sizeof($_POST)==0) && (postvalue('ferror')) && (!postvalue("editid1"))){
	$returnJSON['success'] = false;
	$returnJSON['message'] = "Error occurred";
	$returnJSON['fatalError'] = true;
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
}
else if ((sizeof($_POST)==0) && (postvalue('ferror')) && (postvalue("editid1"))){
	if (postvalue('fly')){
		echo -1;
		exit();
	}
	else {
		$_SESSION["message_edit"] = "<< "."Error occurred"." >>";
	}
}
/////////////////////////////////////////////////////////////
//init variables
/////////////////////////////////////////////////////////////
if(postvalue("editType")=="inline")
	$inlineedit = EDIT_INLINE;
elseif(postvalue("editType")==EDIT_POPUP)
	$inlineedit = EDIT_POPUP;
else
	$inlineedit = EDIT_SIMPLE;

$id = postvalue("id");
if(intval($id)==0)
	$id = 1;

$flyId = $id+1;
$xt = new Xtempl();

// assign an id
$xt->assign("id",$id);

$templatefile = "vw_Devotee_full_edit.htm";

//array of params for classes
$params = array("pageType" => PAGE_EDIT,"id" => $id);


$params['tName'] = $strTableName;
$params['xt'] = &$xt;
$params['mode'] = $inlineedit;
$params['includes_js'] = $includes_js;
$params['includes_jsreq'] = $includes_jsreq;
$params['includes_css'] = $includes_css;
$params['locale_info'] = $locale_info;
$params['templatefile'] = $templatefile;
$params['pageEditLikeInline'] = ($inlineedit == EDIT_INLINE);
//Get array of tabs for edit page
$params['useTabsOnEdit'] = $gSettings->useTabsOnEdit();
if($params['useTabsOnEdit'])
	$params['arrEditTabs'] = $gSettings->getEditTabs();

$pageObject = new EditPage($params);

//	For ajax request 
if($_REQUEST["action"]!="")
{
	if($pageObject->lockingObj)
	{
		$arrkeys = explode("&",refine($_REQUEST["keys"]));
		foreach($arrkeys as $ind=>$val)
			$arrkeys[$ind]=urldecode($val);
		
		if($_REQUEST["action"]=="unlock")
		{
			$pageObject->lockingObj->UnlockRecord($strTableName,$arrkeys,$_REQUEST["sid"]);
			exit();	
		}
		else if($_REQUEST["action"]=="lockadmin" && (IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP))
		{
			$pageObject->lockingObj->UnlockAdmin($strTableName,$arrkeys,$_REQUEST["startEdit"]=="yes");
			if($_REQUEST["startEdit"]=="no")
				echo "unlock";
			else if($_REQUEST["startEdit"]=="yes")
				echo "lock";
			exit();	
		}
		else if($_REQUEST["action"]=="confirm")
		{
			if(!$pageObject->lockingObj->ConfirmLock($strTableName,$arrkeys,$message));
				echo $message;
			exit();	
		}
	}
	else
		exit();
}

$filename = $status = $message = $mesClass = $usermessage = $strWhereClause = $bodyonload = "";
$showValues = $showRawValues = $showFields = $showDetailKeys = $key = $next = $prev = array();
$HaveData = $enableCtrlsForEditing = true;
$error_happened = $readevalues = $IsSaved = false;

$auditObj = GetAuditObject($strTableName);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

//Get detail table keys	
$detailKeys = $pageObject->detailKeysByM;


if($pageObject->lockingObj)
{
	$system_attrs = "style='display:none;'";
	$system_message = "";
}

if ($inlineedit!=EDIT_INLINE)
{
	// add button events if exist
	$pageObject->addButtonHandlers();
}

$url_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

//	Before Process event
if($eventObj->exists("BeforeProcessEdit"))
	$eventObj->BeforeProcessEdit($conn, $pageObject);

$keys = array();
$skeys = "";
$savedKeys = array();
$keys["DevoteeId"] = urldecode(postvalue("editid1"));
$savedKeys["DevoteeId"] = urldecode(postvalue("editid1"));
$skeys.= rawurlencode(postvalue("editid1"))."&";

$pageObject->setKeys($keys);

if($skeys!="")
	$skeys = substr($skeys,0,-1);

//For show detail tables on master page edit
if($inlineedit!=EDIT_INLINE)
{
	$dpParams = array();
	if($pageObject->isShowDetailTables && !isMobile())
	{
		$ids = $id;
		$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
	}
}
/////////////////////////////////////////////////////////////
//	process entered data, read and save
/////////////////////////////////////////////////////////////

// proccess captcha
if ($inlineedit!=EDIT_INLINE)
	if($pageObject->captchaExists())
		$pageObject->doCaptchaCode();

if(@$_POST["a"] == "edited")
{
	$strWhereClause = whereAdd($strWhereClause,KeyWhere($keys));
		//	select only owned records
	$strWhereClause = whereAdd($strWhereClause,SecuritySQL("Edit"));
	$oldValuesRead = false;	
	if($eventObj->exists("AfterEdit") || $eventObj->exists("BeforeEdit") || $auditObj || isTableGeoUpdatable($pageObject->cipherer->pSet)
		|| $globalEvents->exists("IsRecordEditable", $strTableName))
	{
		//	read old values
		$rsold = db_query($gQuery->gSQLWhere($strWhereClause), $conn);
		$dataold = $pageObject->cipherer->DecryptFetchedArray($rsold);
		$oldValuesRead = true;
	}
	if($globalEvents->exists("IsRecordEditable", $strTableName))
	{
		if(!$globalEvents->IsRecordEditable($dataold, true, $strTableName))
			return SecurityRedirect($inlineedit);
	}
	$evalues = $efilename_values = $blobfields = array();
	

//	processing TitleId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_TitleId = $pageObject->getControl("TitleId", $id);
		$control_TitleId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing TitleId - end
//	processing Photo - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Photo = $pageObject->getControl("Photo", $id);
		$control_Photo->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Photo - end
//	processing FirstName - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_FirstName = $pageObject->getControl("FirstName", $id);
		$control_FirstName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing FirstName - end
//	processing LastName - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_LastName = $pageObject->getControl("LastName", $id);
		$control_LastName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing LastName - end
//	processing MiddleName - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_MiddleName = $pageObject->getControl("MiddleName", $id);
		$control_MiddleName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing MiddleName - end
//	processing Gender - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Gender = $pageObject->getControl("Gender", $id);
		$control_Gender->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Gender - end
//	processing DateOfBirth - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DateOfBirth = $pageObject->getControl("DateOfBirth", $id);
		$control_DateOfBirth->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DateOfBirth - end
//	processing MaritalStatusId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_MaritalStatusId = $pageObject->getControl("MaritalStatusId", $id);
		$control_MaritalStatusId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing MaritalStatusId - end
//	processing DateofMarriage - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DateofMarriage = $pageObject->getControl("DateofMarriage", $id);
		$control_DateofMarriage->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DateofMarriage - end
//	processing SpouseDevoteeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_SpouseDevoteeId = $pageObject->getControl("SpouseDevoteeId", $id);
		$control_SpouseDevoteeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing SpouseDevoteeId - end
//	processing MobilePhone - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_MobilePhone = $pageObject->getControl("MobilePhone", $id);
		$control_MobilePhone->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing MobilePhone - end
//	processing WorkPhone - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_WorkPhone = $pageObject->getControl("WorkPhone", $id);
		$control_WorkPhone->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing WorkPhone - end
//	processing EmailPrimary - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_EmailPrimary = $pageObject->getControl("EmailPrimary", $id);
		$control_EmailPrimary->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing EmailPrimary - end
//	processing EmailSecondary - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_EmailSecondary = $pageObject->getControl("EmailSecondary", $id);
		$control_EmailSecondary->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing EmailSecondary - end
//	processing Password - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Password = $pageObject->getControl("Password", $id);
		$control_Password->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Password - end
//	processing address_AddressLine1 - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_AddressLine1 = $pageObject->getControl("address_AddressLine1", $id);
		$control_address_AddressLine1->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_AddressLine1 - end
//	processing address_AddressLine2 - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_AddressLine2 = $pageObject->getControl("address_AddressLine2", $id);
		$control_address_AddressLine2->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_AddressLine2 - end
//	processing address_City - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_City = $pageObject->getControl("address_City", $id);
		$control_address_City->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_City - end
//	processing address_State - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_State = $pageObject->getControl("address_State", $id);
		$control_address_State->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_State - end
//	processing address_Country - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_Country = $pageObject->getControl("address_Country", $id);
		$control_address_Country->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_Country - end
//	processing address_Pincode - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_Pincode = $pageObject->getControl("address_Pincode", $id);
		$control_address_Pincode->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_Pincode - end
//	processing address_IsVerified - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_IsVerified = $pageObject->getControl("address_IsVerified", $id);
		$control_address_IsVerified->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_IsVerified - end
//	processing address_IsWrong - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_IsWrong = $pageObject->getControl("address_IsWrong", $id);
		$control_address_IsWrong->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_IsWrong - end
//	processing address_AddressTypeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_address_AddressTypeId = $pageObject->getControl("address_AddressTypeId", $id);
		$control_address_AddressTypeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing address_AddressTypeId - end
//	processing Occupational_DevoteeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Occupational_DevoteeId = $pageObject->getControl("Occupational_DevoteeId", $id);
		$control_Occupational_DevoteeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Occupational_DevoteeId - end
//	processing Occupational_Education - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Occupational_Education = $pageObject->getControl("Occupational_Education", $id);
		$control_Occupational_Education->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Occupational_Education - end
//	processing Occupational_Occupation - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Occupational_Occupation = $pageObject->getControl("Occupational_Occupation", $id);
		$control_Occupational_Occupation->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Occupational_Occupation - end
//	processing Occupational_Designation - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Occupational_Designation = $pageObject->getControl("Occupational_Designation", $id);
		$control_Occupational_Designation->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Occupational_Designation - end
//	processing Occupational_AwardsOrMerits - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Occupational_AwardsOrMerits = $pageObject->getControl("Occupational_AwardsOrMerits", $id);
		$control_Occupational_AwardsOrMerits->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Occupational_AwardsOrMerits - end
//	processing occupational_SkillsOrExperiences - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_occupational_SkillsOrExperiences = $pageObject->getControl("occupational_SkillsOrExperiences", $id);
		$control_occupational_SkillsOrExperiences->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing occupational_SkillsOrExperiences - end
//	processing occupational_CurrentCompanyId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_occupational_CurrentCompanyId = $pageObject->getControl("occupational_CurrentCompanyId", $id);
		$control_occupational_CurrentCompanyId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing occupational_CurrentCompanyId - end
//	processing organization_Location - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_organization_Location = $pageObject->getControl("organization_Location", $id);
		$control_organization_Location->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing organization_Location - end
//	processing SpiritualLife_DevoteeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_SpiritualLife_DevoteeId = $pageObject->getControl("SpiritualLife_DevoteeId", $id);
		$control_SpiritualLife_DevoteeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing SpiritualLife_DevoteeId - end
//	processing devoteeaddress_DevoteeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteeaddress_DevoteeId = $pageObject->getControl("devoteeaddress_DevoteeId", $id);
		$control_devoteeaddress_DevoteeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteeaddress_DevoteeId - end
//	processing devoteeaddress_AddressId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteeaddress_AddressId = $pageObject->getControl("devoteeaddress_AddressId", $id);
		$control_devoteeaddress_AddressId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteeaddress_AddressId - end
//	processing devoteelang_DevoteeLanguageId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteelang_DevoteeLanguageId = $pageObject->getControl("devoteelang_DevoteeLanguageId", $id);
		$control_devoteelang_DevoteeLanguageId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteelang_DevoteeLanguageId - end
//	processing devoteelang_DevoteeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteelang_DevoteeId = $pageObject->getControl("devoteelang_DevoteeId", $id);
		$control_devoteelang_DevoteeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteelang_DevoteeId - end
//	processing devoteelang_LanguageId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteelang_LanguageId = $pageObject->getControl("devoteelang_LanguageId", $id);
		$control_devoteelang_LanguageId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteelang_LanguageId - end
//	processing devoteelang_SpeakingLevel - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteelang_SpeakingLevel = $pageObject->getControl("devoteelang_SpeakingLevel", $id);
		$control_devoteelang_SpeakingLevel->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteelang_SpeakingLevel - end
//	processing devoteelang_ReadingLevel - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteelang_ReadingLevel = $pageObject->getControl("devoteelang_ReadingLevel", $id);
		$control_devoteelang_ReadingLevel->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteelang_ReadingLevel - end
//	processing devoteelang_WritingLevel - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteelang_WritingLevel = $pageObject->getControl("devoteelang_WritingLevel", $id);
		$control_devoteelang_WritingLevel->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteelang_WritingLevel - end
//	processing addresstypes_AddressType - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_addresstypes_AddressType = $pageObject->getControl("addresstypes_AddressType", $id);
		$control_addresstypes_AddressType->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing addresstypes_AddressType - end
//	processing addresstypes_AddressTypeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_addresstypes_AddressTypeId = $pageObject->getControl("addresstypes_AddressTypeId", $id);
		$control_addresstypes_AddressTypeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing addresstypes_AddressTypeId - end
//	processing devoteeaddress_devoteeaddressId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_devoteeaddress_devoteeaddressId = $pageObject->getControl("devoteeaddress_devoteeaddressId", $id);
		$control_devoteeaddress_devoteeaddressId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing devoteeaddress_devoteeaddressId - end
//	processing Address_AddressId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_Address_AddressId = $pageObject->getControl("Address_AddressId", $id);
		$control_Address_AddressId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Address_AddressId - end
//	processing occupational_DevoteeOccupationalId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_occupational_DevoteeOccupationalId = $pageObject->getControl("occupational_DevoteeOccupationalId", $id);
		$control_occupational_DevoteeOccupationalId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing occupational_DevoteeOccupationalId - end
//	processing DevoteeOrg_DevoteeOrgId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DevoteeOrg_DevoteeOrgId = $pageObject->getControl("DevoteeOrg_DevoteeOrgId", $id);
		$control_DevoteeOrg_DevoteeOrgId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeOrg_DevoteeOrgId - end
//	processing DevoteeOrg_OrgId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DevoteeOrg_OrgId = $pageObject->getControl("DevoteeOrg_OrgId", $id);
		$control_DevoteeOrg_OrgId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeOrg_OrgId - end
//	processing DevoteeOrg_DevoteeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DevoteeOrg_DevoteeId = $pageObject->getControl("DevoteeOrg_DevoteeId", $id);
		$control_DevoteeOrg_DevoteeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeOrg_DevoteeId - end
//	processing DevoteeOrg_FromDate - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DevoteeOrg_FromDate = $pageObject->getControl("DevoteeOrg_FromDate", $id);
		$control_DevoteeOrg_FromDate->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeOrg_FromDate - end
//	processing DevoteeOrg_ToDate - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DevoteeOrg_ToDate = $pageObject->getControl("DevoteeOrg_ToDate", $id);
		$control_DevoteeOrg_ToDate->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeOrg_ToDate - end
//	processing DevoteeId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_DevoteeId = $pageObject->getControl("DevoteeId", $id);
		$control_DevoteeId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		//	update key value
		if($control_DevoteeId->getWebValue()!==false)
			$keys["DevoteeId"] = $control_DevoteeId->getWebValue();
	}
//	processing DevoteeId - end
//	processing company_CompanyId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_company_CompanyId = $pageObject->getControl("company_CompanyId", $id);
		$control_company_CompanyId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing company_CompanyId - end
//	processing company_CompanyName - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_company_CompanyName = $pageObject->getControl("company_CompanyName", $id);
		$control_company_CompanyName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing company_CompanyName - end
//	processing company_AddressId - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_company_AddressId = $pageObject->getControl("company_AddressId", $id);
		$control_company_AddressId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing company_AddressId - end
//	processing company_Remark - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$control_company_Remark = $pageObject->getControl("company_Remark", $id);
		$control_company_Remark->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing company_Remark - end

	foreach($efilename_values as $ekey=>$value)
		$evalues[$ekey] = $value;
		
	if($pageObject->lockingObj)
	{
		$lockmessage = "";
		if(!$pageObject->lockingObj->ConfirmLock($strTableName,$savedKeys,$lockmessage))
		{
			$enableCtrlsForEditing = false;
			$system_attrs = "style='display:block;'";
			if($inlineedit == EDIT_INLINE)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$lockmessage = $pageObject->lockingObj->GetLockInfo($strTableName,$savedKeys,false,$id);
				
				$returnJSON['success'] = false;
				$returnJSON['message'] = $lockmessage;
				$returnJSON['enableCtrls'] = $enableCtrlsForEditing;
				$returnJSON['confirmTime'] = $pageObject->lockingObj->ConfirmTime;
				echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
				exit();
			}
			else
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$system_message = $pageObject->lockingObj->GetLockInfo($strTableName,$savedKeys,true,$id);
				else
					$system_message = $lockmessage;
			}
			$status = "DECLINED";
			$readevalues = true;
		}
	}
	
	if($readevalues==false)
	{
	//	do event
		$retval = true;
		if($eventObj->exists("BeforeEdit"))
			$retval=$eventObj->BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$usermessage,(bool)$inlineedit, $pageObject);
	
		if($retval && $pageObject->isCaptchaOk)
		{		
			if($inlineedit!=EDIT_INLINE)
				$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
		
			//set updated lat-lng values for all map fileds with 'UpdateLatLng' ticked	
            if(isTableGeoUpdatable($pageObject->cipherer->pSet)) {			
				setUpdatedLatLng($evalues, $pageObject->cipherer->pSet, $dataold);
			}	
			
			if(DoUpdateRecord($strOriginalTableName,$evalues,$blobfields,$strWhereClause,$id,$pageObject, $pageObject->cipherer))
			{
				$IsSaved = true;

			// Give possibility to all edit controls to clean their data				
			//	processing TitleId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_TitleId->afterSuccessfulSave();
				}
	//	processing TitleId - end
			//	processing Photo - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Photo->afterSuccessfulSave();
				}
	//	processing Photo - end
			//	processing FirstName - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_FirstName->afterSuccessfulSave();
				}
	//	processing FirstName - end
			//	processing LastName - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_LastName->afterSuccessfulSave();
				}
	//	processing LastName - end
			//	processing MiddleName - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_MiddleName->afterSuccessfulSave();
				}
	//	processing MiddleName - end
			//	processing Gender - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Gender->afterSuccessfulSave();
				}
	//	processing Gender - end
			//	processing DateOfBirth - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DateOfBirth->afterSuccessfulSave();
				}
	//	processing DateOfBirth - end
			//	processing MaritalStatusId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_MaritalStatusId->afterSuccessfulSave();
				}
	//	processing MaritalStatusId - end
			//	processing DateofMarriage - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DateofMarriage->afterSuccessfulSave();
				}
	//	processing DateofMarriage - end
			//	processing SpouseDevoteeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_SpouseDevoteeId->afterSuccessfulSave();
				}
	//	processing SpouseDevoteeId - end
			//	processing MobilePhone - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_MobilePhone->afterSuccessfulSave();
				}
	//	processing MobilePhone - end
			//	processing WorkPhone - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_WorkPhone->afterSuccessfulSave();
				}
	//	processing WorkPhone - end
			//	processing EmailPrimary - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_EmailPrimary->afterSuccessfulSave();
				}
	//	processing EmailPrimary - end
			//	processing EmailSecondary - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_EmailSecondary->afterSuccessfulSave();
				}
	//	processing EmailSecondary - end
			//	processing Password - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Password->afterSuccessfulSave();
				}
	//	processing Password - end
			//	processing address_AddressLine1 - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_AddressLine1->afterSuccessfulSave();
				}
	//	processing address_AddressLine1 - end
			//	processing address_AddressLine2 - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_AddressLine2->afterSuccessfulSave();
				}
	//	processing address_AddressLine2 - end
			//	processing address_City - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_City->afterSuccessfulSave();
				}
	//	processing address_City - end
			//	processing address_State - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_State->afterSuccessfulSave();
				}
	//	processing address_State - end
			//	processing address_Country - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_Country->afterSuccessfulSave();
				}
	//	processing address_Country - end
			//	processing address_Pincode - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_Pincode->afterSuccessfulSave();
				}
	//	processing address_Pincode - end
			//	processing address_IsVerified - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_IsVerified->afterSuccessfulSave();
				}
	//	processing address_IsVerified - end
			//	processing address_IsWrong - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_IsWrong->afterSuccessfulSave();
				}
	//	processing address_IsWrong - end
			//	processing address_AddressTypeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_address_AddressTypeId->afterSuccessfulSave();
				}
	//	processing address_AddressTypeId - end
			//	processing Occupational_DevoteeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Occupational_DevoteeId->afterSuccessfulSave();
				}
	//	processing Occupational_DevoteeId - end
			//	processing Occupational_Education - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Occupational_Education->afterSuccessfulSave();
				}
	//	processing Occupational_Education - end
			//	processing Occupational_Occupation - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Occupational_Occupation->afterSuccessfulSave();
				}
	//	processing Occupational_Occupation - end
			//	processing Occupational_Designation - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Occupational_Designation->afterSuccessfulSave();
				}
	//	processing Occupational_Designation - end
			//	processing Occupational_AwardsOrMerits - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Occupational_AwardsOrMerits->afterSuccessfulSave();
				}
	//	processing Occupational_AwardsOrMerits - end
			//	processing occupational_SkillsOrExperiences - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_occupational_SkillsOrExperiences->afterSuccessfulSave();
				}
	//	processing occupational_SkillsOrExperiences - end
			//	processing occupational_CurrentCompanyId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_occupational_CurrentCompanyId->afterSuccessfulSave();
				}
	//	processing occupational_CurrentCompanyId - end
			//	processing organization_Location - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_organization_Location->afterSuccessfulSave();
				}
	//	processing organization_Location - end
			//	processing SpiritualLife_DevoteeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_SpiritualLife_DevoteeId->afterSuccessfulSave();
				}
	//	processing SpiritualLife_DevoteeId - end
			//	processing devoteeaddress_DevoteeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteeaddress_DevoteeId->afterSuccessfulSave();
				}
	//	processing devoteeaddress_DevoteeId - end
			//	processing devoteeaddress_AddressId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteeaddress_AddressId->afterSuccessfulSave();
				}
	//	processing devoteeaddress_AddressId - end
			//	processing devoteelang_DevoteeLanguageId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteelang_DevoteeLanguageId->afterSuccessfulSave();
				}
	//	processing devoteelang_DevoteeLanguageId - end
			//	processing devoteelang_DevoteeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteelang_DevoteeId->afterSuccessfulSave();
				}
	//	processing devoteelang_DevoteeId - end
			//	processing devoteelang_LanguageId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteelang_LanguageId->afterSuccessfulSave();
				}
	//	processing devoteelang_LanguageId - end
			//	processing devoteelang_SpeakingLevel - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteelang_SpeakingLevel->afterSuccessfulSave();
				}
	//	processing devoteelang_SpeakingLevel - end
			//	processing devoteelang_ReadingLevel - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteelang_ReadingLevel->afterSuccessfulSave();
				}
	//	processing devoteelang_ReadingLevel - end
			//	processing devoteelang_WritingLevel - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteelang_WritingLevel->afterSuccessfulSave();
				}
	//	processing devoteelang_WritingLevel - end
			//	processing addresstypes_AddressType - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_addresstypes_AddressType->afterSuccessfulSave();
				}
	//	processing addresstypes_AddressType - end
			//	processing addresstypes_AddressTypeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_addresstypes_AddressTypeId->afterSuccessfulSave();
				}
	//	processing addresstypes_AddressTypeId - end
			//	processing devoteeaddress_devoteeaddressId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_devoteeaddress_devoteeaddressId->afterSuccessfulSave();
				}
	//	processing devoteeaddress_devoteeaddressId - end
			//	processing Address_AddressId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_Address_AddressId->afterSuccessfulSave();
				}
	//	processing Address_AddressId - end
			//	processing occupational_DevoteeOccupationalId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_occupational_DevoteeOccupationalId->afterSuccessfulSave();
				}
	//	processing occupational_DevoteeOccupationalId - end
			//	processing DevoteeOrg_DevoteeOrgId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DevoteeOrg_DevoteeOrgId->afterSuccessfulSave();
				}
	//	processing DevoteeOrg_DevoteeOrgId - end
			//	processing DevoteeOrg_OrgId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DevoteeOrg_OrgId->afterSuccessfulSave();
				}
	//	processing DevoteeOrg_OrgId - end
			//	processing DevoteeOrg_DevoteeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DevoteeOrg_DevoteeId->afterSuccessfulSave();
				}
	//	processing DevoteeOrg_DevoteeId - end
			//	processing DevoteeOrg_FromDate - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DevoteeOrg_FromDate->afterSuccessfulSave();
				}
	//	processing DevoteeOrg_FromDate - end
			//	processing DevoteeOrg_ToDate - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DevoteeOrg_ToDate->afterSuccessfulSave();
				}
	//	processing DevoteeOrg_ToDate - end
			//	processing DevoteeId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_DevoteeId->afterSuccessfulSave();
				}
	//	processing DevoteeId - end
			//	processing company_CompanyId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_company_CompanyId->afterSuccessfulSave();
				}
	//	processing company_CompanyId - end
			//	processing company_CompanyName - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_company_CompanyName->afterSuccessfulSave();
				}
	//	processing company_CompanyName - end
			//	processing company_AddressId - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_company_AddressId->afterSuccessfulSave();
				}
	//	processing company_AddressId - end
			//	processing company_Remark - begin
							$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode
			
				if($condition)
				{
					$control_company_Remark->afterSuccessfulSave();
				}
	//	processing company_Remark - end
				
				//	after edit event
				if($pageObject->lockingObj && $inlineedit == EDIT_INLINE)
					$pageObject->lockingObj->UnlockRecord($strTableName,$savedKeys,"");
				if($auditObj || $eventObj->exists("AfterEdit"))
				{
					foreach($dataold as $idx=>$val)
					{
						if(!array_key_exists($idx,$evalues))
							$evalues[$idx] = $val;
					}
				}

				if($auditObj)
					$auditObj->LogEdit($strTableName,$evalues,$dataold,$keys);
				if($eventObj->exists("AfterEdit"))
					$eventObj->AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,(bool)$inlineedit, $pageObject);
							
				$mesClass = "mes_ok";
			}
			elseif($inlineedit!=EDIT_INLINE)
				$mesClass = "mes_not";	
		}
		else
		{
			$message = $usermessage;
			$readevalues = true;
			$status = "DECLINED";
		}
	}
	if($readevalues)
		$keys = $savedKeys;
}
//else
{
	/////////////////////////
	//Locking recors
	/////////////////////////

	if($pageObject->lockingObj)
	{
		$enableCtrlsForEditing = $pageObject->lockingObj->LockRecord($strTableName,$keys);
		if(!$enableCtrlsForEditing)
		{
			if($inlineedit == EDIT_INLINE)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$lockmessage = $pageObject->lockingObj->GetLockInfo($strTableName,$keys,false,$id);
				else
					$lockmessage = $pageObject->lockingObj->LockUser;
				$returnJSON['success'] = false;
				$returnJSON['message'] = $lockmessage;
				$returnJSON['enableCtrls'] = $enableCtrlsForEditing;
				$returnJSON['confirmTime'] = $pageObject->lockingObj->ConfirmTime;
				echo my_json_encode($returnJSON);
				exit();
			}
			
			$system_attrs = "style='display:block;'";
			$system_message = $pageObject->lockingObj->LockUser;
			
			if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
			{
				$rb = $pageObject->lockingObj->GetLockInfo($strTableName,$keys,true,$id);
				if($rb!="")
					$system_message = $rb;
			}
		}
	}
}

if($pageObject->lockingObj && $inlineedit!=EDIT_INLINE)
	$pageObject->body["begin"] .='<div class="runner-locking" '.$system_attrs.'>'.$system_message.'</div>';

if($message)
	$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if ($IsSaved && no_output_done() && $inlineedit == EDIT_SIMPLE)
{
	// saving message
	$_SESSION["message_edit"] = ($message ? $message : "");
	// key get query
	$keyGetQ = "";
		$keyGetQ.="editid1=".rawurldecode($keys["DevoteeId"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: vw_Devotee_full_".$pageObject->getPageType().".php?".$keyGetQ);
	// turned on output buffering, so we need to stop script
	exit();
}
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if ($inlineedit == EDIT_SIMPLE && isset($_SESSION["message_edit"]))
{
	$message = $_SESSION["message_edit"];
	unset($_SESSION["message_edit"]);
}


$pageObject->setKeys($keys);
$pageObject->readEditValues = $readevalues;
if($readevalues)
	$pageObject->editValues = $evalues;

//	read current values from the database
$data = $pageObject->getCurrentRecordInternal();
if(!$data)
{
	if($inlineedit == EDIT_SIMPLE)
	{
		header("Location: vw_Devotee_full_list.php?a=return");
		exit();
	}
	else
		$data = array();
}

if($globalEvents->exists("IsRecordEditable", $strTableName))
{
	if(!$globalEvents->IsRecordEditable($data, true, $strTableName) && $inlineedit != EDIT_INLINE)
	{
		return SecurityRedirect($inlineedit);
	}
}


//global variable use in BuildEditControl function
//	show readonly fields
	$pageObject->readOnlyFields["Gender"] = htmlspecialchars($pageObject->showDBValue("Gender", $data));

if($readevalues)
{
	$data["TitleId"] = $evalues["TitleId"];
	$data["FirstName"] = $evalues["FirstName"];
	$data["LastName"] = $evalues["LastName"];
	$data["MiddleName"] = $evalues["MiddleName"];
	$data["DateOfBirth"] = $evalues["DateOfBirth"];
	$data["MaritalStatusId"] = $evalues["MaritalStatusId"];
	$data["DateofMarriage"] = $evalues["DateofMarriage"];
	$data["SpouseDevoteeId"] = $evalues["SpouseDevoteeId"];
	$data["MobilePhone"] = $evalues["MobilePhone"];
	$data["WorkPhone"] = $evalues["WorkPhone"];
	$data["EmailPrimary"] = $evalues["EmailPrimary"];
	$data["EmailSecondary"] = $evalues["EmailSecondary"];
	$data["Password"] = $evalues["Password"];
	$data["address_AddressLine1"] = $evalues["address_AddressLine1"];
	$data["address_AddressLine2"] = $evalues["address_AddressLine2"];
	$data["address_City"] = $evalues["address_City"];
	$data["address_State"] = $evalues["address_State"];
	$data["address_Country"] = $evalues["address_Country"];
	$data["address_Pincode"] = $evalues["address_Pincode"];
	$data["address_IsVerified"] = $evalues["address_IsVerified"];
	$data["address_IsWrong"] = $evalues["address_IsWrong"];
	$data["address_AddressTypeId"] = $evalues["address_AddressTypeId"];
	$data["Occupational_DevoteeId"] = $evalues["Occupational_DevoteeId"];
	$data["Occupational_Education"] = $evalues["Occupational_Education"];
	$data["Occupational_Occupation"] = $evalues["Occupational_Occupation"];
	$data["Occupational_Designation"] = $evalues["Occupational_Designation"];
	$data["Occupational_AwardsOrMerits"] = $evalues["Occupational_AwardsOrMerits"];
	$data["occupational_SkillsOrExperiences"] = $evalues["occupational_SkillsOrExperiences"];
	$data["occupational_CurrentCompanyId"] = $evalues["occupational_CurrentCompanyId"];
	$data["organization_Location"] = $evalues["organization_Location"];
	$data["SpiritualLife_DevoteeId"] = $evalues["SpiritualLife_DevoteeId"];
	$data["devoteeaddress_DevoteeId"] = $evalues["devoteeaddress_DevoteeId"];
	$data["devoteeaddress_AddressId"] = $evalues["devoteeaddress_AddressId"];
	$data["devoteelang_DevoteeLanguageId"] = $evalues["devoteelang_DevoteeLanguageId"];
	$data["devoteelang_DevoteeId"] = $evalues["devoteelang_DevoteeId"];
	$data["devoteelang_LanguageId"] = $evalues["devoteelang_LanguageId"];
	$data["devoteelang_SpeakingLevel"] = $evalues["devoteelang_SpeakingLevel"];
	$data["devoteelang_ReadingLevel"] = $evalues["devoteelang_ReadingLevel"];
	$data["devoteelang_WritingLevel"] = $evalues["devoteelang_WritingLevel"];
	$data["addresstypes_AddressType"] = $evalues["addresstypes_AddressType"];
	$data["addresstypes_AddressTypeId"] = $evalues["addresstypes_AddressTypeId"];
	$data["devoteeaddress_devoteeaddressId"] = $evalues["devoteeaddress_devoteeaddressId"];
	$data["Address_AddressId"] = $evalues["Address_AddressId"];
	$data["occupational_DevoteeOccupationalId"] = $evalues["occupational_DevoteeOccupationalId"];
	$data["DevoteeOrg_DevoteeOrgId"] = $evalues["DevoteeOrg_DevoteeOrgId"];
	$data["DevoteeOrg_OrgId"] = $evalues["DevoteeOrg_OrgId"];
	$data["DevoteeOrg_DevoteeId"] = $evalues["DevoteeOrg_DevoteeId"];
	$data["DevoteeOrg_FromDate"] = $evalues["DevoteeOrg_FromDate"];
	$data["DevoteeOrg_ToDate"] = $evalues["DevoteeOrg_ToDate"];
	$data["DevoteeId"] = $evalues["DevoteeId"];
	$data["company_CompanyId"] = $evalues["company_CompanyId"];
	$data["company_CompanyName"] = $evalues["company_CompanyName"];
	$data["company_AddressId"] = $evalues["company_AddressId"];
	$data["company_Remark"] = $evalues["company_Remark"];
}

/////////////////////////////////////////////////////////////
//	assign values to $xt class, prepare page for displaying
/////////////////////////////////////////////////////////////
//Basic includes js files
$includes = "";
//javascript code
	
if($inlineedit != EDIT_INLINE)
{
	if($inlineedit == EDIT_SIMPLE)
	{
		$includes.= "<script language=\"JavaScript\" src=\"include/loadfirst.js\"></script>\r\n";
				$includes.="<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";
		
		if (!isMobile())
			$includes.= "<div id=\"search_suggest".$id."\"></div>\r\n";
			
		$pageObject->body["begin"].= $includes;
	}	

	if(!$pageObject->isAppearOnTabs("TitleId"))
		$xt->assign("TitleId_fieldblock",true);
	else
		$xt->assign("TitleId_tabfieldblock",true);
	$xt->assign("TitleId_label",true);
	if(isEnableSection508())
		$xt->assign_section("TitleId_label","<label for=\"".GetInputElementId("TitleId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Photo"))
		$xt->assign("Photo_fieldblock",true);
	else
		$xt->assign("Photo_tabfieldblock",true);
	$xt->assign("Photo_label",true);
	if(isEnableSection508())
		$xt->assign_section("Photo_label","<label for=\"".GetInputElementId("Photo", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("FirstName"))
		$xt->assign("FirstName_fieldblock",true);
	else
		$xt->assign("FirstName_tabfieldblock",true);
	$xt->assign("FirstName_label",true);
	if(isEnableSection508())
		$xt->assign_section("FirstName_label","<label for=\"".GetInputElementId("FirstName", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("LastName"))
		$xt->assign("LastName_fieldblock",true);
	else
		$xt->assign("LastName_tabfieldblock",true);
	$xt->assign("LastName_label",true);
	if(isEnableSection508())
		$xt->assign_section("LastName_label","<label for=\"".GetInputElementId("LastName", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("MiddleName"))
		$xt->assign("MiddleName_fieldblock",true);
	else
		$xt->assign("MiddleName_tabfieldblock",true);
	$xt->assign("MiddleName_label",true);
	if(isEnableSection508())
		$xt->assign_section("MiddleName_label","<label for=\"".GetInputElementId("MiddleName", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Gender"))
		$xt->assign("Gender_fieldblock",true);
	else
		$xt->assign("Gender_tabfieldblock",true);
	$xt->assign("Gender_label",true);
	if(isEnableSection508())
		$xt->assign_section("Gender_label","<label for=\"".GetInputElementId("Gender", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DateOfBirth"))
		$xt->assign("DateOfBirth_fieldblock",true);
	else
		$xt->assign("DateOfBirth_tabfieldblock",true);
	$xt->assign("DateOfBirth_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateOfBirth_label","<label for=\"".GetInputElementId("DateOfBirth", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("MaritalStatusId"))
		$xt->assign("MaritalStatusId_fieldblock",true);
	else
		$xt->assign("MaritalStatusId_tabfieldblock",true);
	$xt->assign("MaritalStatusId_label",true);
	if(isEnableSection508())
		$xt->assign_section("MaritalStatusId_label","<label for=\"".GetInputElementId("MaritalStatusId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DateofMarriage"))
		$xt->assign("DateofMarriage_fieldblock",true);
	else
		$xt->assign("DateofMarriage_tabfieldblock",true);
	$xt->assign("DateofMarriage_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateofMarriage_label","<label for=\"".GetInputElementId("DateofMarriage", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("SpouseDevoteeId"))
		$xt->assign("SpouseDevoteeId_fieldblock",true);
	else
		$xt->assign("SpouseDevoteeId_tabfieldblock",true);
	$xt->assign("SpouseDevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpouseDevoteeId_label","<label for=\"".GetInputElementId("SpouseDevoteeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("MobilePhone"))
		$xt->assign("MobilePhone_fieldblock",true);
	else
		$xt->assign("MobilePhone_tabfieldblock",true);
	$xt->assign("MobilePhone_label",true);
	if(isEnableSection508())
		$xt->assign_section("MobilePhone_label","<label for=\"".GetInputElementId("MobilePhone", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("WorkPhone"))
		$xt->assign("WorkPhone_fieldblock",true);
	else
		$xt->assign("WorkPhone_tabfieldblock",true);
	$xt->assign("WorkPhone_label",true);
	if(isEnableSection508())
		$xt->assign_section("WorkPhone_label","<label for=\"".GetInputElementId("WorkPhone", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("EmailPrimary"))
		$xt->assign("EmailPrimary_fieldblock",true);
	else
		$xt->assign("EmailPrimary_tabfieldblock",true);
	$xt->assign("EmailPrimary_label",true);
	if(isEnableSection508())
		$xt->assign_section("EmailPrimary_label","<label for=\"".GetInputElementId("EmailPrimary", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("EmailSecondary"))
		$xt->assign("EmailSecondary_fieldblock",true);
	else
		$xt->assign("EmailSecondary_tabfieldblock",true);
	$xt->assign("EmailSecondary_label",true);
	if(isEnableSection508())
		$xt->assign_section("EmailSecondary_label","<label for=\"".GetInputElementId("EmailSecondary", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Password"))
		$xt->assign("Password_fieldblock",true);
	else
		$xt->assign("Password_tabfieldblock",true);
	$xt->assign("Password_label",true);
	if(isEnableSection508())
		$xt->assign_section("Password_label","<label for=\"".GetInputElementId("Password", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_AddressLine1"))
		$xt->assign("address_AddressLine1_fieldblock",true);
	else
		$xt->assign("address_AddressLine1_tabfieldblock",true);
	$xt->assign("address_AddressLine1_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_AddressLine1_label","<label for=\"".GetInputElementId("address_AddressLine1", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_AddressLine2"))
		$xt->assign("address_AddressLine2_fieldblock",true);
	else
		$xt->assign("address_AddressLine2_tabfieldblock",true);
	$xt->assign("address_AddressLine2_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_AddressLine2_label","<label for=\"".GetInputElementId("address_AddressLine2", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_City"))
		$xt->assign("address_City_fieldblock",true);
	else
		$xt->assign("address_City_tabfieldblock",true);
	$xt->assign("address_City_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_City_label","<label for=\"".GetInputElementId("address_City", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_State"))
		$xt->assign("address_State_fieldblock",true);
	else
		$xt->assign("address_State_tabfieldblock",true);
	$xt->assign("address_State_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_State_label","<label for=\"".GetInputElementId("address_State", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_Country"))
		$xt->assign("address_Country_fieldblock",true);
	else
		$xt->assign("address_Country_tabfieldblock",true);
	$xt->assign("address_Country_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_Country_label","<label for=\"".GetInputElementId("address_Country", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_Pincode"))
		$xt->assign("address_Pincode_fieldblock",true);
	else
		$xt->assign("address_Pincode_tabfieldblock",true);
	$xt->assign("address_Pincode_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_Pincode_label","<label for=\"".GetInputElementId("address_Pincode", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_IsVerified"))
		$xt->assign("address_IsVerified_fieldblock",true);
	else
		$xt->assign("address_IsVerified_tabfieldblock",true);
	$xt->assign("address_IsVerified_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_IsVerified_label","<label for=\"".GetInputElementId("address_IsVerified", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_IsWrong"))
		$xt->assign("address_IsWrong_fieldblock",true);
	else
		$xt->assign("address_IsWrong_tabfieldblock",true);
	$xt->assign("address_IsWrong_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_IsWrong_label","<label for=\"".GetInputElementId("address_IsWrong", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("address_AddressTypeId"))
		$xt->assign("address_AddressTypeId_fieldblock",true);
	else
		$xt->assign("address_AddressTypeId_tabfieldblock",true);
	$xt->assign("address_AddressTypeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_AddressTypeId_label","<label for=\"".GetInputElementId("address_AddressTypeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Occupational_DevoteeId"))
		$xt->assign("Occupational_DevoteeId_fieldblock",true);
	else
		$xt->assign("Occupational_DevoteeId_tabfieldblock",true);
	$xt->assign("Occupational_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_DevoteeId_label","<label for=\"".GetInputElementId("Occupational_DevoteeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Occupational_Education"))
		$xt->assign("Occupational_Education_fieldblock",true);
	else
		$xt->assign("Occupational_Education_tabfieldblock",true);
	$xt->assign("Occupational_Education_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_Education_label","<label for=\"".GetInputElementId("Occupational_Education", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Occupational_Occupation"))
		$xt->assign("Occupational_Occupation_fieldblock",true);
	else
		$xt->assign("Occupational_Occupation_tabfieldblock",true);
	$xt->assign("Occupational_Occupation_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_Occupation_label","<label for=\"".GetInputElementId("Occupational_Occupation", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Occupational_Designation"))
		$xt->assign("Occupational_Designation_fieldblock",true);
	else
		$xt->assign("Occupational_Designation_tabfieldblock",true);
	$xt->assign("Occupational_Designation_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_Designation_label","<label for=\"".GetInputElementId("Occupational_Designation", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Occupational_AwardsOrMerits"))
		$xt->assign("Occupational_AwardsOrMerits_fieldblock",true);
	else
		$xt->assign("Occupational_AwardsOrMerits_tabfieldblock",true);
	$xt->assign("Occupational_AwardsOrMerits_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_AwardsOrMerits_label","<label for=\"".GetInputElementId("Occupational_AwardsOrMerits", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("occupational_SkillsOrExperiences"))
		$xt->assign("occupational_SkillsOrExperiences_fieldblock",true);
	else
		$xt->assign("occupational_SkillsOrExperiences_tabfieldblock",true);
	$xt->assign("occupational_SkillsOrExperiences_label",true);
	if(isEnableSection508())
		$xt->assign_section("occupational_SkillsOrExperiences_label","<label for=\"".GetInputElementId("occupational_SkillsOrExperiences", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("occupational_CurrentCompanyId"))
		$xt->assign("occupational_CurrentCompanyId_fieldblock",true);
	else
		$xt->assign("occupational_CurrentCompanyId_tabfieldblock",true);
	$xt->assign("occupational_CurrentCompanyId_label",true);
	if(isEnableSection508())
		$xt->assign_section("occupational_CurrentCompanyId_label","<label for=\"".GetInputElementId("occupational_CurrentCompanyId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("organization_Location"))
		$xt->assign("organization_Location_fieldblock",true);
	else
		$xt->assign("organization_Location_tabfieldblock",true);
	$xt->assign("organization_Location_label",true);
	if(isEnableSection508())
		$xt->assign_section("organization_Location_label","<label for=\"".GetInputElementId("organization_Location", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("SpiritualLife_DevoteeId"))
		$xt->assign("SpiritualLife_DevoteeId_fieldblock",true);
	else
		$xt->assign("SpiritualLife_DevoteeId_tabfieldblock",true);
	$xt->assign("SpiritualLife_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpiritualLife_DevoteeId_label","<label for=\"".GetInputElementId("SpiritualLife_DevoteeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteeaddress_DevoteeId"))
		$xt->assign("devoteeaddress_DevoteeId_fieldblock",true);
	else
		$xt->assign("devoteeaddress_DevoteeId_tabfieldblock",true);
	$xt->assign("devoteeaddress_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_DevoteeId_label","<label for=\"".GetInputElementId("devoteeaddress_DevoteeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteeaddress_AddressId"))
		$xt->assign("devoteeaddress_AddressId_fieldblock",true);
	else
		$xt->assign("devoteeaddress_AddressId_tabfieldblock",true);
	$xt->assign("devoteeaddress_AddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_AddressId_label","<label for=\"".GetInputElementId("devoteeaddress_AddressId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteelang_DevoteeLanguageId"))
		$xt->assign("devoteelang_DevoteeLanguageId_fieldblock",true);
	else
		$xt->assign("devoteelang_DevoteeLanguageId_tabfieldblock",true);
	$xt->assign("devoteelang_DevoteeLanguageId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_DevoteeLanguageId_label","<label for=\"".GetInputElementId("devoteelang_DevoteeLanguageId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteelang_DevoteeId"))
		$xt->assign("devoteelang_DevoteeId_fieldblock",true);
	else
		$xt->assign("devoteelang_DevoteeId_tabfieldblock",true);
	$xt->assign("devoteelang_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_DevoteeId_label","<label for=\"".GetInputElementId("devoteelang_DevoteeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteelang_LanguageId"))
		$xt->assign("devoteelang_LanguageId_fieldblock",true);
	else
		$xt->assign("devoteelang_LanguageId_tabfieldblock",true);
	$xt->assign("devoteelang_LanguageId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_LanguageId_label","<label for=\"".GetInputElementId("devoteelang_LanguageId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteelang_SpeakingLevel"))
		$xt->assign("devoteelang_SpeakingLevel_fieldblock",true);
	else
		$xt->assign("devoteelang_SpeakingLevel_tabfieldblock",true);
	$xt->assign("devoteelang_SpeakingLevel_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_SpeakingLevel_label","<label for=\"".GetInputElementId("devoteelang_SpeakingLevel", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteelang_ReadingLevel"))
		$xt->assign("devoteelang_ReadingLevel_fieldblock",true);
	else
		$xt->assign("devoteelang_ReadingLevel_tabfieldblock",true);
	$xt->assign("devoteelang_ReadingLevel_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_ReadingLevel_label","<label for=\"".GetInputElementId("devoteelang_ReadingLevel", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteelang_WritingLevel"))
		$xt->assign("devoteelang_WritingLevel_fieldblock",true);
	else
		$xt->assign("devoteelang_WritingLevel_tabfieldblock",true);
	$xt->assign("devoteelang_WritingLevel_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_WritingLevel_label","<label for=\"".GetInputElementId("devoteelang_WritingLevel", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("addresstypes_AddressType"))
		$xt->assign("addresstypes_AddressType_fieldblock",true);
	else
		$xt->assign("addresstypes_AddressType_tabfieldblock",true);
	$xt->assign("addresstypes_AddressType_label",true);
	if(isEnableSection508())
		$xt->assign_section("addresstypes_AddressType_label","<label for=\"".GetInputElementId("addresstypes_AddressType", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("addresstypes_AddressTypeId"))
		$xt->assign("addresstypes_AddressTypeId_fieldblock",true);
	else
		$xt->assign("addresstypes_AddressTypeId_tabfieldblock",true);
	$xt->assign("addresstypes_AddressTypeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("addresstypes_AddressTypeId_label","<label for=\"".GetInputElementId("addresstypes_AddressTypeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("devoteeaddress_devoteeaddressId"))
		$xt->assign("devoteeaddress_devoteeaddressId_fieldblock",true);
	else
		$xt->assign("devoteeaddress_devoteeaddressId_tabfieldblock",true);
	$xt->assign("devoteeaddress_devoteeaddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_devoteeaddressId_label","<label for=\"".GetInputElementId("devoteeaddress_devoteeaddressId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("Address_AddressId"))
		$xt->assign("Address_AddressId_fieldblock",true);
	else
		$xt->assign("Address_AddressId_tabfieldblock",true);
	$xt->assign("Address_AddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("Address_AddressId_label","<label for=\"".GetInputElementId("Address_AddressId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("occupational_DevoteeOccupationalId"))
		$xt->assign("occupational_DevoteeOccupationalId_fieldblock",true);
	else
		$xt->assign("occupational_DevoteeOccupationalId_tabfieldblock",true);
	$xt->assign("occupational_DevoteeOccupationalId_label",true);
	if(isEnableSection508())
		$xt->assign_section("occupational_DevoteeOccupationalId_label","<label for=\"".GetInputElementId("occupational_DevoteeOccupationalId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_DevoteeOrgId"))
		$xt->assign("DevoteeOrg_DevoteeOrgId_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_DevoteeOrgId_tabfieldblock",true);
	$xt->assign("DevoteeOrg_DevoteeOrgId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_DevoteeOrgId_label","<label for=\"".GetInputElementId("DevoteeOrg_DevoteeOrgId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_OrgId"))
		$xt->assign("DevoteeOrg_OrgId_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_OrgId_tabfieldblock",true);
	$xt->assign("DevoteeOrg_OrgId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_OrgId_label","<label for=\"".GetInputElementId("DevoteeOrg_OrgId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_DevoteeId"))
		$xt->assign("DevoteeOrg_DevoteeId_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_DevoteeId_tabfieldblock",true);
	$xt->assign("DevoteeOrg_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_DevoteeId_label","<label for=\"".GetInputElementId("DevoteeOrg_DevoteeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_FromDate"))
		$xt->assign("DevoteeOrg_FromDate_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_FromDate_tabfieldblock",true);
	$xt->assign("DevoteeOrg_FromDate_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_FromDate_label","<label for=\"".GetInputElementId("DevoteeOrg_FromDate", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_ToDate"))
		$xt->assign("DevoteeOrg_ToDate_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_ToDate_tabfieldblock",true);
	$xt->assign("DevoteeOrg_ToDate_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_ToDate_label","<label for=\"".GetInputElementId("DevoteeOrg_ToDate", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("DevoteeId"))
		$xt->assign("DevoteeId_fieldblock",true);
	else
		$xt->assign("DevoteeId_tabfieldblock",true);
	$xt->assign("DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeId_label","<label for=\"".GetInputElementId("DevoteeId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("company_CompanyId"))
		$xt->assign("company_CompanyId_fieldblock",true);
	else
		$xt->assign("company_CompanyId_tabfieldblock",true);
	$xt->assign("company_CompanyId_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_CompanyId_label","<label for=\"".GetInputElementId("company_CompanyId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("company_CompanyName"))
		$xt->assign("company_CompanyName_fieldblock",true);
	else
		$xt->assign("company_CompanyName_tabfieldblock",true);
	$xt->assign("company_CompanyName_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_CompanyName_label","<label for=\"".GetInputElementId("company_CompanyName", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("company_AddressId"))
		$xt->assign("company_AddressId_fieldblock",true);
	else
		$xt->assign("company_AddressId_tabfieldblock",true);
	$xt->assign("company_AddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_AddressId_label","<label for=\"".GetInputElementId("company_AddressId", $id, PAGE_EDIT)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("company_Remark"))
		$xt->assign("company_Remark_fieldblock",true);
	else
		$xt->assign("company_Remark_tabfieldblock",true);
	$xt->assign("company_Remark_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_Remark_label","<label for=\"".GetInputElementId("company_Remark", $id, PAGE_EDIT)."\">","</label>");
		

	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("DevoteeId", $data)));
	//$xt->assign('editForm',true);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	if(!@$_SESSION[$strTableName."_noNextPrev"] && $inlineedit == EDIT_SIMPLE)
	{
		$next = array();
		$prev = array();
		$pageObject->getNextPrevRecordKeys($data,"Edit",$next,$prev);
	}
	$nextlink = $prevlink = "";
	if(count($next))
	{
		$xt->assign("next_button",true);
				$nextlink.= "editid1=".htmlspecialchars(rawurlencode($next[1-1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\" align=\"absmiddle\"");
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink.= "editid1=".htmlspecialchars(rawurlencode($prev[1-1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\" align=\"absmiddle\"");
	}
	else 
		$xt->assign("prev_button",false);
	$xt->assign("resetbutton_attrs",'id="resetButton'.$id.'"');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	if($inlineedit == EDIT_SIMPLE)
	{
		$xt->assign("back_button",true);
		$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
	}
	// onmouseover event, for changing focus. Needed to proper submit form
	//$onmouseover = "this.focus();";
	//$onmouseover = 'onmouseover="'.$onmouseover.'"';
	
	$xt->assign("save_button",true);
	if(!$enableCtrlsForEditing)
		$xt->assign("savebutton_attrs", "id=\"saveButton".$id."\" type=\"disabled\" ");
	else
		$xt->assign("savebutton_attrs", "id=\"saveButton".$id."\"");
		
	$xt->assign("reset_button",true);

}

$xt->assign("message_block",true);
$xt->assign("message",$message);
if(!strlen($message))
{
	$xt->displayBrickHidden("message");
}
/////////////////////////////////////////////////////////////
//process readonly and auto-update fields
/////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////
//	return new data to the List page or report an error
/////////////////////////////////////////////////////////////
if (postvalue("a")=="edited" && ($inlineedit == EDIT_INLINE || $inlineedit == EDIT_POPUP))
{
	if(!$data)
	{
		$data = $evalues;
		$HaveData = false;
	}
	//Preparation   view values

//	detail tables

	$keylink = "";
	$keylink.= "&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));


//	TitleId - 
	$value = $pageObject->showDBValue("TitleId", $data, $keylink);
	$showValues["TitleId"] = $value;
	$showFields[] = "TitleId";
		$showRawValues["TitleId"] = substr($data["TitleId"],0,100);

//	Photo - Database Image
	$value = $pageObject->showDBValue("Photo", $data, $keylink);
	$showValues["Photo"] = $value;
	$showFields[] = "Photo";
		$showRawValues["Photo"] = "";

//	FirstName - 
	$value = $pageObject->showDBValue("FirstName", $data, $keylink);
	$showValues["FirstName"] = $value;
	$showFields[] = "FirstName";
		$showRawValues["FirstName"] = substr($data["FirstName"],0,100);

//	LastName - 
	$value = $pageObject->showDBValue("LastName", $data, $keylink);
	$showValues["LastName"] = $value;
	$showFields[] = "LastName";
		$showRawValues["LastName"] = substr($data["LastName"],0,100);

//	MiddleName - 
	$value = $pageObject->showDBValue("MiddleName", $data, $keylink);
	$showValues["MiddleName"] = $value;
	$showFields[] = "MiddleName";
		$showRawValues["MiddleName"] = substr($data["MiddleName"],0,100);

//	Gender - 
	$value = $pageObject->showDBValue("Gender", $data, $keylink);
	$showValues["Gender"] = $value;
	$showFields[] = "Gender";
		$showRawValues["Gender"] = substr($data["Gender"],0,100);

//	DateOfBirth - Short Date
	$value = $pageObject->showDBValue("DateOfBirth", $data, $keylink);
	$showValues["DateOfBirth"] = $value;
	$showFields[] = "DateOfBirth";
		$showRawValues["DateOfBirth"] = substr($data["DateOfBirth"],0,100);

//	MaritalStatusId - 
	$value = $pageObject->showDBValue("MaritalStatusId", $data, $keylink);
	$showValues["MaritalStatusId"] = $value;
	$showFields[] = "MaritalStatusId";
		$showRawValues["MaritalStatusId"] = substr($data["MaritalStatusId"],0,100);

//	DateofMarriage - Short Date
	$value = $pageObject->showDBValue("DateofMarriage", $data, $keylink);
	$showValues["DateofMarriage"] = $value;
	$showFields[] = "DateofMarriage";
		$showRawValues["DateofMarriage"] = substr($data["DateofMarriage"],0,100);

//	SpouseDevoteeId - 
	$value = $pageObject->showDBValue("SpouseDevoteeId", $data, $keylink);
	$showValues["SpouseDevoteeId"] = $value;
	$showFields[] = "SpouseDevoteeId";
		$showRawValues["SpouseDevoteeId"] = substr($data["SpouseDevoteeId"],0,100);

//	MobilePhone - 
	$value = $pageObject->showDBValue("MobilePhone", $data, $keylink);
	$showValues["MobilePhone"] = $value;
	$showFields[] = "MobilePhone";
		$showRawValues["MobilePhone"] = substr($data["MobilePhone"],0,100);

//	WorkPhone - 
	$value = $pageObject->showDBValue("WorkPhone", $data, $keylink);
	$showValues["WorkPhone"] = $value;
	$showFields[] = "WorkPhone";
		$showRawValues["WorkPhone"] = substr($data["WorkPhone"],0,100);

//	EmailPrimary - 
	$value = $pageObject->showDBValue("EmailPrimary", $data, $keylink);
	$showValues["EmailPrimary"] = $value;
	$showFields[] = "EmailPrimary";
		$showRawValues["EmailPrimary"] = substr($data["EmailPrimary"],0,100);

//	EmailSecondary - 
	$value = $pageObject->showDBValue("EmailSecondary", $data, $keylink);
	$showValues["EmailSecondary"] = $value;
	$showFields[] = "EmailSecondary";
		$showRawValues["EmailSecondary"] = substr($data["EmailSecondary"],0,100);

//	Password - 
	$value = $pageObject->showDBValue("Password", $data, $keylink);
	$showValues["Password"] = $value;
	$showFields[] = "Password";
		$showRawValues["Password"] = substr($data["Password"],0,100);

//	address_AddressLine1 - 
	$value = $pageObject->showDBValue("address_AddressLine1", $data, $keylink);
	$showValues["address_AddressLine1"] = $value;
	$showFields[] = "address_AddressLine1";
		$showRawValues["address_AddressLine1"] = substr($data["address_AddressLine1"],0,100);

//	address_AddressLine2 - 
	$value = $pageObject->showDBValue("address_AddressLine2", $data, $keylink);
	$showValues["address_AddressLine2"] = $value;
	$showFields[] = "address_AddressLine2";
		$showRawValues["address_AddressLine2"] = substr($data["address_AddressLine2"],0,100);

//	address_City - 
	$value = $pageObject->showDBValue("address_City", $data, $keylink);
	$showValues["address_City"] = $value;
	$showFields[] = "address_City";
		$showRawValues["address_City"] = substr($data["address_City"],0,100);

//	address_State - 
	$value = $pageObject->showDBValue("address_State", $data, $keylink);
	$showValues["address_State"] = $value;
	$showFields[] = "address_State";
		$showRawValues["address_State"] = substr($data["address_State"],0,100);

//	address_Country - 
	$value = $pageObject->showDBValue("address_Country", $data, $keylink);
	$showValues["address_Country"] = $value;
	$showFields[] = "address_Country";
		$showRawValues["address_Country"] = substr($data["address_Country"],0,100);

//	address_Pincode - 
	$value = $pageObject->showDBValue("address_Pincode", $data, $keylink);
	$showValues["address_Pincode"] = $value;
	$showFields[] = "address_Pincode";
		$showRawValues["address_Pincode"] = substr($data["address_Pincode"],0,100);

//	address_IsVerified - 
	$value = $pageObject->showDBValue("address_IsVerified", $data, $keylink);
	$showValues["address_IsVerified"] = $value;
	$showFields[] = "address_IsVerified";
		$showRawValues["address_IsVerified"] = substr($data["address_IsVerified"],0,100);

//	address_IsWrong - 
	$value = $pageObject->showDBValue("address_IsWrong", $data, $keylink);
	$showValues["address_IsWrong"] = $value;
	$showFields[] = "address_IsWrong";
		$showRawValues["address_IsWrong"] = substr($data["address_IsWrong"],0,100);

//	address_AddressTypeId - 
	$value = $pageObject->showDBValue("address_AddressTypeId", $data, $keylink);
	$showValues["address_AddressTypeId"] = $value;
	$showFields[] = "address_AddressTypeId";
		$showRawValues["address_AddressTypeId"] = substr($data["address_AddressTypeId"],0,100);

//	Occupational_DevoteeId - 
	$value = $pageObject->showDBValue("Occupational_DevoteeId", $data, $keylink);
	$showValues["Occupational_DevoteeId"] = $value;
	$showFields[] = "Occupational_DevoteeId";
		$showRawValues["Occupational_DevoteeId"] = substr($data["Occupational_DevoteeId"],0,100);

//	Occupational_Education - 
	$value = $pageObject->showDBValue("Occupational_Education", $data, $keylink);
	$showValues["Occupational_Education"] = $value;
	$showFields[] = "Occupational_Education";
		$showRawValues["Occupational_Education"] = substr($data["Occupational_Education"],0,100);

//	Occupational_Occupation - 
	$value = $pageObject->showDBValue("Occupational_Occupation", $data, $keylink);
	$showValues["Occupational_Occupation"] = $value;
	$showFields[] = "Occupational_Occupation";
		$showRawValues["Occupational_Occupation"] = substr($data["Occupational_Occupation"],0,100);

//	Occupational_Designation - 
	$value = $pageObject->showDBValue("Occupational_Designation", $data, $keylink);
	$showValues["Occupational_Designation"] = $value;
	$showFields[] = "Occupational_Designation";
		$showRawValues["Occupational_Designation"] = substr($data["Occupational_Designation"],0,100);

//	Occupational_AwardsOrMerits - 
	$value = $pageObject->showDBValue("Occupational_AwardsOrMerits", $data, $keylink);
	$showValues["Occupational_AwardsOrMerits"] = $value;
	$showFields[] = "Occupational_AwardsOrMerits";
		$showRawValues["Occupational_AwardsOrMerits"] = substr($data["Occupational_AwardsOrMerits"],0,100);

//	occupational_SkillsOrExperiences - 
	$value = $pageObject->showDBValue("occupational_SkillsOrExperiences", $data, $keylink);
	$showValues["occupational_SkillsOrExperiences"] = $value;
	$showFields[] = "occupational_SkillsOrExperiences";
		$showRawValues["occupational_SkillsOrExperiences"] = substr($data["occupational_SkillsOrExperiences"],0,100);

//	occupational_CurrentCompanyId - 
	$value = $pageObject->showDBValue("occupational_CurrentCompanyId", $data, $keylink);
	$showValues["occupational_CurrentCompanyId"] = $value;
	$showFields[] = "occupational_CurrentCompanyId";
		$showRawValues["occupational_CurrentCompanyId"] = substr($data["occupational_CurrentCompanyId"],0,100);

//	organization_OrgId - 
	$value = $pageObject->showDBValue("organization_OrgId", $data, $keylink);
	$showValues["organization_OrgId"] = $value;
	$showFields[] = "organization_OrgId";
		$showRawValues["organization_OrgId"] = substr($data["organization_OrgId"],0,100);

//	organization_OrgName - 
	$value = $pageObject->showDBValue("organization_OrgName", $data, $keylink);
	$showValues["organization_OrgName"] = $value;
	$showFields[] = "organization_OrgName";
		$showRawValues["organization_OrgName"] = substr($data["organization_OrgName"],0,100);

//	organization_OrgOwnerId - 
	$value = $pageObject->showDBValue("organization_OrgOwnerId", $data, $keylink);
	$showValues["organization_OrgOwnerId"] = $value;
	$showFields[] = "organization_OrgOwnerId";
		$showRawValues["organization_OrgOwnerId"] = substr($data["organization_OrgOwnerId"],0,100);

//	organization_OrgLeaderId - 
	$value = $pageObject->showDBValue("organization_OrgLeaderId", $data, $keylink);
	$showValues["organization_OrgLeaderId"] = $value;
	$showFields[] = "organization_OrgLeaderId";
		$showRawValues["organization_OrgLeaderId"] = substr($data["organization_OrgLeaderId"],0,100);

//	organization_Location - 
	$value = $pageObject->showDBValue("organization_Location", $data, $keylink);
	$showValues["organization_Location"] = $value;
	$showFields[] = "organization_Location";
		$showRawValues["organization_Location"] = substr($data["organization_Location"],0,100);

//	spirituallife_SpiritulLifeId - 
	$value = $pageObject->showDBValue("spirituallife_SpiritulLifeId", $data, $keylink);
	$showValues["spirituallife_SpiritulLifeId"] = $value;
	$showFields[] = "spirituallife_SpiritulLifeId";
		$showRawValues["spirituallife_SpiritulLifeId"] = substr($data["spirituallife_SpiritulLifeId"],0,100);

//	SpiritualLife_DevoteeId - 
	$value = $pageObject->showDBValue("SpiritualLife_DevoteeId", $data, $keylink);
	$showValues["SpiritualLife_DevoteeId"] = $value;
	$showFields[] = "SpiritualLife_DevoteeId";
		$showRawValues["SpiritualLife_DevoteeId"] = substr($data["SpiritualLife_DevoteeId"],0,100);

//	spirituallife_DateOfHarinamInitiation - Short Date
	$value = $pageObject->showDBValue("spirituallife_DateOfHarinamInitiation", $data, $keylink);
	$showValues["spirituallife_DateOfHarinamInitiation"] = $value;
	$showFields[] = "spirituallife_DateOfHarinamInitiation";
		$showRawValues["spirituallife_DateOfHarinamInitiation"] = substr($data["spirituallife_DateOfHarinamInitiation"],0,100);

//	spirituallife_DateOfBrahmanInitiation - Short Date
	$value = $pageObject->showDBValue("spirituallife_DateOfBrahmanInitiation", $data, $keylink);
	$showValues["spirituallife_DateOfBrahmanInitiation"] = $value;
	$showFields[] = "spirituallife_DateOfBrahmanInitiation";
		$showRawValues["spirituallife_DateOfBrahmanInitiation"] = substr($data["spirituallife_DateOfBrahmanInitiation"],0,100);

//	spirituallife_SpiritualMasterDevoteeId - 
	$value = $pageObject->showDBValue("spirituallife_SpiritualMasterDevoteeId", $data, $keylink);
	$showValues["spirituallife_SpiritualMasterDevoteeId"] = $value;
	$showFields[] = "spirituallife_SpiritualMasterDevoteeId";
		$showRawValues["spirituallife_SpiritualMasterDevoteeId"] = substr($data["spirituallife_SpiritualMasterDevoteeId"],0,100);

//	spirituallife_PreviousReligion - 
	$value = $pageObject->showDBValue("spirituallife_PreviousReligion", $data, $keylink);
	$showValues["spirituallife_PreviousReligion"] = $value;
	$showFields[] = "spirituallife_PreviousReligion";
		$showRawValues["spirituallife_PreviousReligion"] = substr($data["spirituallife_PreviousReligion"],0,100);

//	spirituallife_Chanting16RoundsSince - Short Date
	$value = $pageObject->showDBValue("spirituallife_Chanting16RoundsSince", $data, $keylink);
	$showValues["spirituallife_Chanting16RoundsSince"] = $value;
	$showFields[] = "spirituallife_Chanting16RoundsSince";
		$showRawValues["spirituallife_Chanting16RoundsSince"] = substr($data["spirituallife_Chanting16RoundsSince"],0,100);

//	spirituallife_IntroducedBy - 
	$value = $pageObject->showDBValue("spirituallife_IntroducedBy", $data, $keylink);
	$showValues["spirituallife_IntroducedBy"] = $value;
	$showFields[] = "spirituallife_IntroducedBy";
		$showRawValues["spirituallife_IntroducedBy"] = substr($data["spirituallife_IntroducedBy"],0,100);

//	spirituallife_YearOfIntroduction - 
	$value = $pageObject->showDBValue("spirituallife_YearOfIntroduction", $data, $keylink);
	$showValues["spirituallife_YearOfIntroduction"] = $value;
	$showFields[] = "spirituallife_YearOfIntroduction";
		$showRawValues["spirituallife_YearOfIntroduction"] = substr($data["spirituallife_YearOfIntroduction"],0,100);

//	spirituallife_IntroducedInCenter - 
	$value = $pageObject->showDBValue("spirituallife_IntroducedInCenter", $data, $keylink);
	$showValues["spirituallife_IntroducedInCenter"] = $value;
	$showFields[] = "spirituallife_IntroducedInCenter";
		$showRawValues["spirituallife_IntroducedInCenter"] = substr($data["spirituallife_IntroducedInCenter"],0,100);

//	spirituallife_PreferedServices - 
	$value = $pageObject->showDBValue("spirituallife_PreferedServices", $data, $keylink);
	$showValues["spirituallife_PreferedServices"] = $value;
	$showFields[] = "spirituallife_PreferedServices";
		$showRawValues["spirituallife_PreferedServices"] = substr($data["spirituallife_PreferedServices"],0,100);

//	spirituallife_SericesRendered - 
	$value = $pageObject->showDBValue("spirituallife_SericesRendered", $data, $keylink);
	$showValues["spirituallife_SericesRendered"] = $value;
	$showFields[] = "spirituallife_SericesRendered";
		$showRawValues["spirituallife_SericesRendered"] = substr($data["spirituallife_SericesRendered"],0,100);

//	devoteeaddress_DevoteeId - 
	$value = $pageObject->showDBValue("devoteeaddress_DevoteeId", $data, $keylink);
	$showValues["devoteeaddress_DevoteeId"] = $value;
	$showFields[] = "devoteeaddress_DevoteeId";
		$showRawValues["devoteeaddress_DevoteeId"] = substr($data["devoteeaddress_DevoteeId"],0,100);

//	devoteeaddress_AddressId - 
	$value = $pageObject->showDBValue("devoteeaddress_AddressId", $data, $keylink);
	$showValues["devoteeaddress_AddressId"] = $value;
	$showFields[] = "devoteeaddress_AddressId";
		$showRawValues["devoteeaddress_AddressId"] = substr($data["devoteeaddress_AddressId"],0,100);

//	devoteelang_DevoteeLanguageId - 
	$value = $pageObject->showDBValue("devoteelang_DevoteeLanguageId", $data, $keylink);
	$showValues["devoteelang_DevoteeLanguageId"] = $value;
	$showFields[] = "devoteelang_DevoteeLanguageId";
		$showRawValues["devoteelang_DevoteeLanguageId"] = substr($data["devoteelang_DevoteeLanguageId"],0,100);

//	devoteelang_DevoteeId - 
	$value = $pageObject->showDBValue("devoteelang_DevoteeId", $data, $keylink);
	$showValues["devoteelang_DevoteeId"] = $value;
	$showFields[] = "devoteelang_DevoteeId";
		$showRawValues["devoteelang_DevoteeId"] = substr($data["devoteelang_DevoteeId"],0,100);

//	devoteelang_LanguageId - 
	$value = $pageObject->showDBValue("devoteelang_LanguageId", $data, $keylink);
	$showValues["devoteelang_LanguageId"] = $value;
	$showFields[] = "devoteelang_LanguageId";
		$showRawValues["devoteelang_LanguageId"] = substr($data["devoteelang_LanguageId"],0,100);

//	devoteelang_SpeakingLevel - 
	$value = $pageObject->showDBValue("devoteelang_SpeakingLevel", $data, $keylink);
	$showValues["devoteelang_SpeakingLevel"] = $value;
	$showFields[] = "devoteelang_SpeakingLevel";
		$showRawValues["devoteelang_SpeakingLevel"] = substr($data["devoteelang_SpeakingLevel"],0,100);

//	devoteelang_ReadingLevel - 
	$value = $pageObject->showDBValue("devoteelang_ReadingLevel", $data, $keylink);
	$showValues["devoteelang_ReadingLevel"] = $value;
	$showFields[] = "devoteelang_ReadingLevel";
		$showRawValues["devoteelang_ReadingLevel"] = substr($data["devoteelang_ReadingLevel"],0,100);

//	devoteelang_WritingLevel - 
	$value = $pageObject->showDBValue("devoteelang_WritingLevel", $data, $keylink);
	$showValues["devoteelang_WritingLevel"] = $value;
	$showFields[] = "devoteelang_WritingLevel";
		$showRawValues["devoteelang_WritingLevel"] = substr($data["devoteelang_WritingLevel"],0,100);

//	addresstypes_AddressType - 
	$value = $pageObject->showDBValue("addresstypes_AddressType", $data, $keylink);
	$showValues["addresstypes_AddressType"] = $value;
	$showFields[] = "addresstypes_AddressType";
		$showRawValues["addresstypes_AddressType"] = substr($data["addresstypes_AddressType"],0,100);

//	addresstypes_AddressTypeId - 
	$value = $pageObject->showDBValue("addresstypes_AddressTypeId", $data, $keylink);
	$showValues["addresstypes_AddressTypeId"] = $value;
	$showFields[] = "addresstypes_AddressTypeId";
		$showRawValues["addresstypes_AddressTypeId"] = substr($data["addresstypes_AddressTypeId"],0,100);

//	devoteeaddress_devoteeaddressId - 
	$value = $pageObject->showDBValue("devoteeaddress_devoteeaddressId", $data, $keylink);
	$showValues["devoteeaddress_devoteeaddressId"] = $value;
	$showFields[] = "devoteeaddress_devoteeaddressId";
		$showRawValues["devoteeaddress_devoteeaddressId"] = substr($data["devoteeaddress_devoteeaddressId"],0,100);

//	Address_AddressId - 
	$value = $pageObject->showDBValue("Address_AddressId", $data, $keylink);
	$showValues["Address_AddressId"] = $value;
	$showFields[] = "Address_AddressId";
		$showRawValues["Address_AddressId"] = substr($data["Address_AddressId"],0,100);

//	occupational_DevoteeOccupationalId - 
	$value = $pageObject->showDBValue("occupational_DevoteeOccupationalId", $data, $keylink);
	$showValues["occupational_DevoteeOccupationalId"] = $value;
	$showFields[] = "occupational_DevoteeOccupationalId";
		$showRawValues["occupational_DevoteeOccupationalId"] = substr($data["occupational_DevoteeOccupationalId"],0,100);

//	DevoteeOrg_DevoteeOrgId - 
	$value = $pageObject->showDBValue("DevoteeOrg_DevoteeOrgId", $data, $keylink);
	$showValues["DevoteeOrg_DevoteeOrgId"] = $value;
	$showFields[] = "DevoteeOrg_DevoteeOrgId";
		$showRawValues["DevoteeOrg_DevoteeOrgId"] = substr($data["DevoteeOrg_DevoteeOrgId"],0,100);

//	DevoteeOrg_OrgId - 
	$value = $pageObject->showDBValue("DevoteeOrg_OrgId", $data, $keylink);
	$showValues["DevoteeOrg_OrgId"] = $value;
	$showFields[] = "DevoteeOrg_OrgId";
		$showRawValues["DevoteeOrg_OrgId"] = substr($data["DevoteeOrg_OrgId"],0,100);

//	DevoteeOrg_DevoteeId - 
	$value = $pageObject->showDBValue("DevoteeOrg_DevoteeId", $data, $keylink);
	$showValues["DevoteeOrg_DevoteeId"] = $value;
	$showFields[] = "DevoteeOrg_DevoteeId";
		$showRawValues["DevoteeOrg_DevoteeId"] = substr($data["DevoteeOrg_DevoteeId"],0,100);

//	DevoteeOrg_FromDate - Short Date
	$value = $pageObject->showDBValue("DevoteeOrg_FromDate", $data, $keylink);
	$showValues["DevoteeOrg_FromDate"] = $value;
	$showFields[] = "DevoteeOrg_FromDate";
		$showRawValues["DevoteeOrg_FromDate"] = substr($data["DevoteeOrg_FromDate"],0,100);

//	DevoteeOrg_ToDate - Short Date
	$value = $pageObject->showDBValue("DevoteeOrg_ToDate", $data, $keylink);
	$showValues["DevoteeOrg_ToDate"] = $value;
	$showFields[] = "DevoteeOrg_ToDate";
		$showRawValues["DevoteeOrg_ToDate"] = substr($data["DevoteeOrg_ToDate"],0,100);

//	DevoteeId - 
	$value = $pageObject->showDBValue("DevoteeId", $data, $keylink);
	$showValues["DevoteeId"] = $value;
	$showFields[] = "DevoteeId";
		$showRawValues["DevoteeId"] = substr($data["DevoteeId"],0,100);

//	company_CompanyId - 
	$value = $pageObject->showDBValue("company_CompanyId", $data, $keylink);
	$showValues["company_CompanyId"] = $value;
	$showFields[] = "company_CompanyId";
		$showRawValues["company_CompanyId"] = substr($data["company_CompanyId"],0,100);

//	company_CompanyName - 
	$value = $pageObject->showDBValue("company_CompanyName", $data, $keylink);
	$showValues["company_CompanyName"] = $value;
	$showFields[] = "company_CompanyName";
		$showRawValues["company_CompanyName"] = substr($data["company_CompanyName"],0,100);

//	company_AddressId - 
	$value = $pageObject->showDBValue("company_AddressId", $data, $keylink);
	$showValues["company_AddressId"] = $value;
	$showFields[] = "company_AddressId";
		$showRawValues["company_AddressId"] = substr($data["company_AddressId"],0,100);

//	company_Remark - 
	$value = $pageObject->showDBValue("company_Remark", $data, $keylink);
	$showValues["company_Remark"] = $value;
	$showFields[] = "company_Remark";
		$showRawValues["company_Remark"] = substr($data["company_Remark"],0,100);
/////////////////////////////////////////////////////////////
//	start inline output
/////////////////////////////////////////////////////////////
	
	if($IsSaved)
	{
		if($pageObject->lockingObj)
			$pageObject->lockingObj->UnlockRecord($strTableName,$keys,"");
		
		$returnJSON['success'] = true;
		$returnJSON['keys'] = $pageObject->jsKeys;
		$returnJSON['keyFields'] = $pageObject->keyFields;
		$returnJSON['vals'] = $showValues;
		$returnJSON['fields'] = $showFields;
		$returnJSON['rawVals'] = $showRawValues;
		$returnJSON['detKeys'] = $showDetailKeys;
		$returnJSON['userMess'] = $usermessage;
		$returnJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
		
		if($inlineedit==EDIT_POPUP && isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
			$returnJSON['hideCaptcha'] = true;
			
		if($globalEvents->exists("IsRecordEditable", $strTableName))
		{
			if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
				$returnJSON['nonEditable'] = true;
		}
	}
	else
	{
		$returnJSON['success'] = false;
		$returnJSON['message'] = $message;
		
		if($pageObject->lockingObj)
			$returnJSON['lockMessage'] = $system_message;
		
		if($inlineedit == EDIT_POPUP && !$pageObject->isCaptchaOk)
			$returnJSON['captcha'] = false;
	}
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
} 
/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////
//	validation stuff
$regex = '';
$regexmessage = '';
$regextype = '';
$control = array();

foreach($pageObject->editFields as $fName)
{
	$gfName = GoodFieldName($fName);
	$controls = array('controls'=>array());
	if (!$detailKeys || !in_array($fName, $detailKeys))
	{
		$control[$gfName] = array();
		$control[$gfName]["func"]="xt_buildeditcontrol";
		$control[$gfName]["params"] = array();
		$control[$gfName]["params"]["id"] = $id;
		$control[$gfName]["params"]["ptype"] = PAGE_EDIT;
		$control[$gfName]["params"]["field"] = $fName;
		if(!IsNumberType($pageObject->pSet->getFieldType($fName)) || is_null(@$data[$fName]))
			$control[$gfName]["params"]["value"] = @$data[$fName];
		else
		{
			$control[$gfName]["params"]["value"] = str_replace(".",$locale_info["LOCALE_SDECIMAL"],@$data[$fName]);
		}
		$control[$gfName]["params"]["pageObj"] = $pageObject;
		
		//	Begin Add validation
		$arrValidate = $pageObject->pSet->getValidation($fName);
		$control[$gfName]["params"]["validate"] = $arrValidate;
		//	End Add validation	
		$additionalCtrlParams = array();
		$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
		$control[$gfName]["params"]["additionalCtrlParams"] = $additionalCtrlParams;
	}
	$controls["controls"]['ctrlInd'] = 0;
	$controls["controls"]['id'] = $id;
	$controls["controls"]['fieldName'] = $fName;
	
	if($inlineedit == EDIT_INLINE)
	{
		if(!$detailKeys || !in_array($fName, $detailKeys))
			$control[$gfName]["params"]["mode"]="inline_edit";
		$controls["controls"]['mode'] = "inline_edit";
	}
	else{
			if (!$detailKeys || !in_array($fName, $detailKeys))
				$control[$gfName]["params"]["mode"] = "edit";
			$controls["controls"]['mode'] = "edit";
		}
																																																									
	if(!$detailKeys || !in_array($fName, $detailKeys))
		$xt->assignbyref($gfName."_editcontrol",$control[$gfName]);
	elseif($detailKeys && in_array($fName, $detailKeys))
		$controls["controls"]['value'] = @$data[$fName];
		
	// category control field
	$strCategoryControl = $pageObject->isDependOnField($fName);
	
	if($strCategoryControl!==false && in_array($strCategoryControl, $pageObject->editFields))
		$vals = array($fName => @$data[$fName],$strCategoryControl => @$data[$strCategoryControl]);
	else
		$vals = array($fName => @$data[$fName]);
		
	$preload = $pageObject->fillPreload($fName, $vals);
	if($preload!==false)
		$controls["controls"]['preloadData'] = $preload;
	
	$pageObject->fillControlsMap($controls);
	
	//fill field tool tips
	$pageObject->fillFieldToolTips($fName);
	
	// fill special settings for timepicker
	if($pageObject->pSet->getEditFormat($fName) == 'Time')	
		$pageObject->fillTimePickSettings($fName, $data[$fName]);
	
	if($pageObject->pSet->getViewFormat($fName) == FORMAT_MAP)	
		$pageObject->googleMapCfg['isUseGoogleMap'] = true;
		
	if($detailKeys && in_array($fName, $detailKeys) && array_key_exists($fName, $data))
	{
		$value = $pageObject->showDBValue($fName, $data);
		
		$xt->assign($gfName."_editcontrol",$value);
	}
}
//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $pageObject->jsKeys;
$pageObject->jsSettings['tableSettings'][$strTableName]['keyFields'] = $pageObject->keyFields;
$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
if($pageObject->lockingObj)
{
	$pageObject->jsSettings['tableSettings'][$strTableName]["sKeys"] = $skeys;
	$pageObject->jsSettings['tableSettings'][$strTableName]["enableCtrls"] = $enableCtrlsForEditing;
	$pageObject->jsSettings['tableSettings'][$strTableName]["confirmTime"] = $pageObject->lockingObj->ConfirmTime;
}

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && $inlineedit!=EDIT_INLINE && !isMobile())
{
	if(count($dpParams['ids']))
	{
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
		$xt->assign("detail_tables",true);	
	}
	
	$dControlsMap = array();
	$dViewControlsMap = array();
	$flyId = $ids+1;
	
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$options = array();
		//array of params for classes
		$options["mode"] = LIST_DETAILS;
		$options["pageType"] = PAGE_LIST;
		$options["masterPageType"] = PAGE_EDIT;
		$options["mainMasterPageType"] = PAGE_EDIT;
		$options['masterTable'] = "vw_Devotee_full";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")){
			$strTableName = "vw_Devotee_full";
			continue;
		}
		
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		
		$layout = GetPageLayout(GoodFieldName($strTableName), PAGE_LIST);
		if($layout)
		{
			$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
			$xt->cssFiles[] = array("stylepath" => "styles/".$layout->style.'/style'.$rtl.".css"
				, "pagestylepath" => "pagestyles/".$layout->name.$rtl.".css");
			$xt->IEcssFiles[] = array("stylepathIE" => "styles/".$layout->style.'/styleIE'.".css");
		}	
		
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $flyId++;
		$masterKeys = array();
		$mkr = 1;
		
		foreach($mKeys[$strTableName] as $mk){
			$options['masterKeysReq'][$mkr] = $data[$mk];
			$masterKeys['masterKey'.$mkr] = $data[$mk];
			$mkr++;
		}
		
		$listPageObject = ListPage::createListPage($strTableName, $options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		
		// show page
		if($listPageObject->isDispGrid())
		{
			//set page events
			foreach($listPageObject->eventsObject->events as $event => $name)
				$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
			
			//add detail settings to master settings
			$listPageObject->addControlsJSAndCSS();
			$listPageObject->fillSetCntrlMaps();
			
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];
			
			foreach($listPageObject->jsSettings["global"]["shortTNames"] as $tName => $shortTName){
				$pageObject->settingsMap["globalSettings"]["shortTNames"][$tName] = $shortTName;
			}
			
			$dControlsMap[$strTableName] = $listPageObject->controlsMap;
			$dControlsMap[$strTableName]['masterKeys'] = $masterKeys;
			$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
			
			$xtParams = array("method"=>'showPage', "params"=> false);
			$xtParams['object'] = $listPageObject;
			$xt->assign("displayDetailTable_".GoodFieldName($listPageObject->tName), $xtParams);
			
			$pageObject->controlsMap['dpTablesParams'][] = array('tName'=>$strTableName, 'id'=>$options['id']);
		}
		$flyId = $listPageObject->recId+1;
	}
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap; 
	$strTableName = "vw_Devotee_full";
}
/////////////////////////////////////////////////////////////
//fill jsSettings and ControlsHTMLMap
$pageObject->flyId = $flyId;
$pageObject->fillSetCntrlMaps();

$pageObject->addCommonJs();

//For mobile version in apple device

if($inlineedit == EDIT_SIMPLE)
{
	// assign body end
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	$xt->assign("body", $pageObject->body);
	$xt->assign("flybody",true);
}

if($inlineedit == EDIT_POPUP){
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("body",$pageObject->body);
}

$xt->assign("style_block",true);

$pageObject->xt->assign("legend", true);

$viewlink = "";
$viewkeys = array();
	$viewkeys["editid1"] = postvalue("editid1");
foreach($viewkeys as $key => $val)
{
	if($viewlink)
		$viewlink.="&";
	$viewlink.=$key."=".$val;
}
$xt->assign("viewlink_attrs","id=\"viewButton".$id."\" name=\"viewButton".$id."\" onclick=\"window.location.href='vw_Devotee_full_view.php?".$viewlink."'\"");
if(CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && $inlineedit == EDIT_SIMPLE)
	$xt->assign("view_button",true);
else
	$xt->assign("view_button",false);

/////////////////////////////////////////////////////////////
//display the page
/////////////////////////////////////////////////////////////
if($eventObj->exists("BeforeShowEdit"))
	$eventObj->BeforeShowEdit($xt,$templatefile,$data, $pageObject);

if($inlineedit != EDIT_SIMPLE)
{
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;	
}
	
if($inlineedit == EDIT_POPUP || $inlineedit == EDIT_INLINE)
{
	if($globalEvents->exists("IsRecordEditable", $strTableName))
	{
		if(!$globalEvents->IsRecordEditable($data, true, $strTableName))
			return SecurityRedirect($inlineedit);
	}
}
if($inlineedit == EDIT_POPUP)
{
	$xt->load_template($templatefile);
	$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
	if(count($pageObject->includes_css))
		$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
	if(count($pageObject->includes_cssIE))
		$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON['idStartFrom'] = $flyId + 1;
	echo (my_json_encode($returnJSON)); 
}
elseif($inlineedit == EDIT_INLINE)
{
	$xt->load_template($templatefile);
	$returnJSON["html"] = array();
	foreach($pageObject->editFields as $fName)
	{
		if($detailKeys && in_array($fName, $detailKeys))
			continue;
		$returnJSON["html"][$fName] = $xt->fetchVar(GoodFieldName($fName)."_editcontrol");
	}
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON["additionalCSS"] = $pageObject->grabAllCSSFiles();
	echo (my_json_encode($returnJSON)); 
}
else
	$xt->display($templatefile);
	
function SecurityRedirect($inlineedit)
{
	if($inlineedit == EDIT_INLINE)
	{
		echo my_json_encode(array("success" => false, "message" => "The record is not editable"));
		return;
	}
	
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: menu.php?message=expired");	
}
?>
