<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

add_nocache_headers();
include("include/vw_Devotee_full_variables.php");
include('include/xtempl.php');
include('classes/addpage.php');

global $globalEvents;

//	check if logged in
if(@$_SESSION["UserID"] && IsAdmin() && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{
	echo "<p>"."You don't have permissions to access this table"."<br>Proceed to <a href=\"admin.php\">Admin Area</a> to set up user permissions</p>";
	return;
}
if(!isLogged() || CheckPermissionsEvent($strTableName, 'A') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	
	header("Location: login.php?message=expired"); 
	return;
}

if ((sizeof($_POST)==0) && (postvalue('ferror'))){
	if (postvalue("inline")){
		$returnJSON['success'] = false;
		$returnJSON['message'] = "Error occurred";
		$returnJSON['fatalError'] = true;
		echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
		exit();
	}
	else if (postvalue("fly")){
		echo -1;
		exit();
	}
	else {
		$_SESSION["message_add"] = "<< "."Error occurred"." >>";
	}
}

$layout = new TLayout("add2","RoundedAqua1","MobileAqua1");
$layout->blocks["top"] = array();
$layout->containers["add"] = array();

$layout->containers["add"][] = array("name"=>"addheader","block"=>"","substyle"=>2);


$layout->containers["add"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->containers["add"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"addfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"legend","block"=>"legend","substyle"=>3);


$layout->containers["fields"][] = array("name"=>"addbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["add"] = "1";
$layout->blocks["top"][] = "add";
$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["vw_Devotee_full_add"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_add_Basic_Info1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_add_Address1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_add_Organization1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_add_Spiritual_Life1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_add_Company1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_add_Language1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["vw_Devotee_full_add_Occupational1"] = $layout;



$filename = "";
$status = "";
$message = "";
$mesClass = "";
$usermessage = "";
$error_happened = false;
$readavalues = false;

$keys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
$popUpSave = false;

$sessionPrefix = $strTableName;

$onFly = false;
if(postvalue("onFly"))
	$onFly = true;

if(@$_REQUEST["editType"]=="inline")
	$inlineadd = ADD_INLINE;
elseif(@$_REQUEST["editType"]==ADD_POPUP)
{
	$inlineadd = ADD_POPUP;
	if(@$_POST["a"]=="added" && postvalue("field")=="" && postvalue("category")=="")
		$popUpSave = true;	
}
elseif(@$_REQUEST["editType"]==ADD_MASTER)
	$inlineadd = ADD_MASTER;
elseif($onFly)
{
	$inlineadd = ADD_ONTHEFLY;
	$sessionPrefix = $strTableName."_add";
}
else
	$inlineadd = ADD_SIMPLE;

if($inlineadd == ADD_INLINE)
	$templatefile = "vw_Devotee_full_inline_add.htm";
else
	$templatefile = "vw_Devotee_full_add.htm";

$id = postvalue("id");
if(intval($id)==0)
	$id = 1;

//If undefined session value for mastet table, but exist post value master table, than take second
//It may be happen only when use dpInline mode on page add
if(!@$_SESSION[$sessionPrefix."_mastertable"] && postvalue("mastertable"))
	$_SESSION[$sessionPrefix."_mastertable"] = postvalue("mastertable");
	
$xt = new Xtempl();
	
// assign an id
$xt->assign("id",$id);
	
$auditObj = GetAuditObject($strTableName);

//array of params for classes
$params = array("pageType" => PAGE_ADD,"id" => $id,"mode" => $inlineadd);


$params['xt'] = &$xt;
$params['tName'] = $strTableName;
$params['includes_js'] = $includes_js;
$params['locale_info'] = $locale_info;
$params['includes_css'] = $includes_css;
$params['useTabsOnAdd'] = $gSettings->useTabsOnAdd();
$params['templatefile'] = $templatefile;
$params['includes_jsreq'] = $includes_jsreq;
$params['pageAddLikeInline'] = ($inlineadd==ADD_INLINE);
$params['needSearchClauseObj'] = false;
$params['strOriginalTableName'] = $strOriginalTableName;

if($params['useTabsOnAdd'])
	$params['arrAddTabs'] = $gSettings->getAddTabs();
	
$pageObject = new AddPage($params);

if(isset($_REQUEST['afteradd'])){
		header('Location: vw_Devotee_full_add.php');
	if($eventObj->exists("AfterAdd") && isset($_SESSION['after_add_data'][$_REQUEST['afteradd']])){
	
		$data = $_SESSION['after_add_data'][$_REQUEST['afteradd']];
		$eventObj->AfterAdd($data['avalues'], $data['keys'],$data['inlineadd'], $pageObject);
	
	}
	unset($_SESSION['after_add_data'][$_REQUEST['afteradd']]);
	
	foreach (is_array($_SESSION['after_add_data']) ? $_SESSION['after_add_data'] : array() as $k=>$v){
		if (!is_array($v) or !array_key_exists('time',$v)) {
			unset($_SESSION['after_add_data'][$k]);
			continue;
		}
		if ($v['time'] < time() - 3600){
			unset($_SESSION['after_add_data'][$k]);
		}
	}
		exit;
}

//Get detail table keys	
$detailKeys = $pageObject->detailKeysByM;

//Array of fields, which appear on add page
$addFields = $pageObject->getFieldsByPageType();

// add button events if exist
if ($inlineadd==ADD_SIMPLE)
	$pageObject->addButtonHandlers();

$url_page=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

//For show detail tables on master page add
if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{
	$dpParams = array();
	if($pageObject->isShowDetailTables  && !isMobile())
	{
		$ids = $id;
		$countDetailsIsShow = 0;
		$pageObject->jsSettings['tableSettings'][$strTableName]['isShowDetails'] = $countDetailsIsShow > 0 ? true : false;
		$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
	}
}

//	Before Process event
if($eventObj->exists("BeforeProcessAdd"))
	$eventObj->BeforeProcessAdd($conn, $pageObject);

// proccess captcha
if ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
	if($pageObject->captchaExists())
		$pageObject->doCaptchaCode();
	
// insert new record if we have to
if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$blobfields=array();
//	processing DevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DevoteeId = $pageObject->getControl("DevoteeId", $id);
		$control_DevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DevoteeId - end
//	processing Photo - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Photo = $pageObject->getControl("Photo", $id);
		$control_Photo->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Photo - end
//	processing Gender - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Gender = $pageObject->getControl("Gender", $id);
		$control_Gender->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Gender - end
//	processing TitleId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_TitleId = $pageObject->getControl("TitleId", $id);
		$control_TitleId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing TitleId - end
//	processing FirstName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_FirstName = $pageObject->getControl("FirstName", $id);
		$control_FirstName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing FirstName - end
//	processing LastName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_LastName = $pageObject->getControl("LastName", $id);
		$control_LastName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing LastName - end
//	processing MiddleName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_MiddleName = $pageObject->getControl("MiddleName", $id);
		$control_MiddleName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing MiddleName - end
//	processing DateOfBirth - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DateOfBirth = $pageObject->getControl("DateOfBirth", $id);
		$control_DateOfBirth->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DateOfBirth - end
//	processing MaritalStatusId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_MaritalStatusId = $pageObject->getControl("MaritalStatusId", $id);
		$control_MaritalStatusId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing MaritalStatusId - end
//	processing DateofMarriage - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DateofMarriage = $pageObject->getControl("DateofMarriage", $id);
		$control_DateofMarriage->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DateofMarriage - end
//	processing SpouseDevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_SpouseDevoteeId = $pageObject->getControl("SpouseDevoteeId", $id);
		$control_SpouseDevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing SpouseDevoteeId - end
//	processing MobilePhone - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_MobilePhone = $pageObject->getControl("MobilePhone", $id);
		$control_MobilePhone->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing MobilePhone - end
//	processing WorkPhone - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_WorkPhone = $pageObject->getControl("WorkPhone", $id);
		$control_WorkPhone->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing WorkPhone - end
//	processing EmailPrimary - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_EmailPrimary = $pageObject->getControl("EmailPrimary", $id);
		$control_EmailPrimary->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing EmailPrimary - end
//	processing EmailSecondary - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_EmailSecondary = $pageObject->getControl("EmailSecondary", $id);
		$control_EmailSecondary->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing EmailSecondary - end
//	processing Password - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Password = $pageObject->getControl("Password", $id);
		$control_Password->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Password - end
//	processing Address_AddressId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Address_AddressId = $pageObject->getControl("Address_AddressId", $id);
		$control_Address_AddressId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Address_AddressId - end
//	processing address_AddressLine1 - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_AddressLine1 = $pageObject->getControl("address_AddressLine1", $id);
		$control_address_AddressLine1->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_AddressLine1 - end
//	processing address_AddressLine2 - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_AddressLine2 = $pageObject->getControl("address_AddressLine2", $id);
		$control_address_AddressLine2->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_AddressLine2 - end
//	processing address_City - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_City = $pageObject->getControl("address_City", $id);
		$control_address_City->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_City - end
//	processing address_State - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_State = $pageObject->getControl("address_State", $id);
		$control_address_State->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_State - end
//	processing address_Pincode - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_Pincode = $pageObject->getControl("address_Pincode", $id);
		$control_address_Pincode->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_Pincode - end
//	processing address_Country - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_Country = $pageObject->getControl("address_Country", $id);
		$control_address_Country->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_Country - end
//	processing address_IsVerified - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_IsVerified = $pageObject->getControl("address_IsVerified", $id);
		$control_address_IsVerified->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_IsVerified - end
//	processing address_IsWrong - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_IsWrong = $pageObject->getControl("address_IsWrong", $id);
		$control_address_IsWrong->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_IsWrong - end
//	processing address_AddressTypeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_address_AddressTypeId = $pageObject->getControl("address_AddressTypeId", $id);
		$control_address_AddressTypeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing address_AddressTypeId - end
//	processing organization_OrgName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_organization_OrgName = $pageObject->getControl("organization_OrgName", $id);
		$control_organization_OrgName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing organization_OrgName - end
//	processing organization_OrgId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_organization_OrgId = $pageObject->getControl("organization_OrgId", $id);
		$control_organization_OrgId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing organization_OrgId - end
//	processing organization_OrgLeaderId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_organization_OrgLeaderId = $pageObject->getControl("organization_OrgLeaderId", $id);
		$control_organization_OrgLeaderId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing organization_OrgLeaderId - end
//	processing organization_OrgOwnerId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_organization_OrgOwnerId = $pageObject->getControl("organization_OrgOwnerId", $id);
		$control_organization_OrgOwnerId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing organization_OrgOwnerId - end
//	processing organization_Location - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_organization_Location = $pageObject->getControl("organization_Location", $id);
		$control_organization_Location->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing organization_Location - end
//	processing spirituallife_SericesRendered - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_SericesRendered = $pageObject->getControl("spirituallife_SericesRendered", $id);
		$control_spirituallife_SericesRendered->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_SericesRendered - end
//	processing SpiritualLife_DevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_SpiritualLife_DevoteeId = $pageObject->getControl("SpiritualLife_DevoteeId", $id);
		$control_SpiritualLife_DevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing SpiritualLife_DevoteeId - end
//	processing spirituallife_PreferedServices - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_PreferedServices = $pageObject->getControl("spirituallife_PreferedServices", $id);
		$control_spirituallife_PreferedServices->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_PreferedServices - end
//	processing spirituallife_Chanting16RoundsSince - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_Chanting16RoundsSince = $pageObject->getControl("spirituallife_Chanting16RoundsSince", $id);
		$control_spirituallife_Chanting16RoundsSince->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_Chanting16RoundsSince - end
//	processing spirituallife_IntroducedInCenter - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_IntroducedInCenter = $pageObject->getControl("spirituallife_IntroducedInCenter", $id);
		$control_spirituallife_IntroducedInCenter->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_IntroducedInCenter - end
//	processing spirituallife_YearOfIntroduction - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_YearOfIntroduction = $pageObject->getControl("spirituallife_YearOfIntroduction", $id);
		$control_spirituallife_YearOfIntroduction->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_YearOfIntroduction - end
//	processing spirituallife_PreviousReligion - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_PreviousReligion = $pageObject->getControl("spirituallife_PreviousReligion", $id);
		$control_spirituallife_PreviousReligion->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_PreviousReligion - end
//	processing spirituallife_SpiritualMasterDevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_SpiritualMasterDevoteeId = $pageObject->getControl("spirituallife_SpiritualMasterDevoteeId", $id);
		$control_spirituallife_SpiritualMasterDevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_SpiritualMasterDevoteeId - end
//	processing spirituallife_DateOfBrahmanInitiation - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_DateOfBrahmanInitiation = $pageObject->getControl("spirituallife_DateOfBrahmanInitiation", $id);
		$control_spirituallife_DateOfBrahmanInitiation->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_DateOfBrahmanInitiation - end
//	processing spirituallife_DateOfHarinamInitiation - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_DateOfHarinamInitiation = $pageObject->getControl("spirituallife_DateOfHarinamInitiation", $id);
		$control_spirituallife_DateOfHarinamInitiation->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_DateOfHarinamInitiation - end
//	processing spirituallife_SpiritulLifeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_SpiritulLifeId = $pageObject->getControl("spirituallife_SpiritulLifeId", $id);
		$control_spirituallife_SpiritulLifeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_SpiritulLifeId - end
//	processing spirituallife_IntroducedBy - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_spirituallife_IntroducedBy = $pageObject->getControl("spirituallife_IntroducedBy", $id);
		$control_spirituallife_IntroducedBy->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing spirituallife_IntroducedBy - end
//	processing company_CompanyId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_company_CompanyId = $pageObject->getControl("company_CompanyId", $id);
		$control_company_CompanyId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing company_CompanyId - end
//	processing company_CompanyName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_company_CompanyName = $pageObject->getControl("company_CompanyName", $id);
		$control_company_CompanyName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing company_CompanyName - end
//	processing company_AddressId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_company_AddressId = $pageObject->getControl("company_AddressId", $id);
		$control_company_AddressId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing company_AddressId - end
//	processing company_Remark - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_company_Remark = $pageObject->getControl("company_Remark", $id);
		$control_company_Remark->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing company_Remark - end
//	processing devoteelang_DevoteeLanguageId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteelang_DevoteeLanguageId = $pageObject->getControl("devoteelang_DevoteeLanguageId", $id);
		$control_devoteelang_DevoteeLanguageId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteelang_DevoteeLanguageId - end
//	processing devoteelang_WritingLevel - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteelang_WritingLevel = $pageObject->getControl("devoteelang_WritingLevel", $id);
		$control_devoteelang_WritingLevel->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteelang_WritingLevel - end
//	processing devoteelang_DevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteelang_DevoteeId = $pageObject->getControl("devoteelang_DevoteeId", $id);
		$control_devoteelang_DevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteelang_DevoteeId - end
//	processing devoteelang_LanguageId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteelang_LanguageId = $pageObject->getControl("devoteelang_LanguageId", $id);
		$control_devoteelang_LanguageId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteelang_LanguageId - end
//	processing devoteelang_SpeakingLevel - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteelang_SpeakingLevel = $pageObject->getControl("devoteelang_SpeakingLevel", $id);
		$control_devoteelang_SpeakingLevel->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteelang_SpeakingLevel - end
//	processing devoteelang_ReadingLevel - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteelang_ReadingLevel = $pageObject->getControl("devoteelang_ReadingLevel", $id);
		$control_devoteelang_ReadingLevel->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteelang_ReadingLevel - end
//	processing occupational_DevoteeOccupationalId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_occupational_DevoteeOccupationalId = $pageObject->getControl("occupational_DevoteeOccupationalId", $id);
		$control_occupational_DevoteeOccupationalId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing occupational_DevoteeOccupationalId - end
//	processing Occupational_DevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Occupational_DevoteeId = $pageObject->getControl("Occupational_DevoteeId", $id);
		$control_Occupational_DevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Occupational_DevoteeId - end
//	processing Occupational_Education - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Occupational_Education = $pageObject->getControl("Occupational_Education", $id);
		$control_Occupational_Education->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Occupational_Education - end
//	processing Occupational_Occupation - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Occupational_Occupation = $pageObject->getControl("Occupational_Occupation", $id);
		$control_Occupational_Occupation->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Occupational_Occupation - end
//	processing Occupational_Designation - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Occupational_Designation = $pageObject->getControl("Occupational_Designation", $id);
		$control_Occupational_Designation->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Occupational_Designation - end
//	processing Occupational_AwardsOrMerits - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Occupational_AwardsOrMerits = $pageObject->getControl("Occupational_AwardsOrMerits", $id);
		$control_Occupational_AwardsOrMerits->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Occupational_AwardsOrMerits - end
//	processing occupational_SkillsOrExperiences - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_occupational_SkillsOrExperiences = $pageObject->getControl("occupational_SkillsOrExperiences", $id);
		$control_occupational_SkillsOrExperiences->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing occupational_SkillsOrExperiences - end
//	processing occupational_CurrentCompanyId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_occupational_CurrentCompanyId = $pageObject->getControl("occupational_CurrentCompanyId", $id);
		$control_occupational_CurrentCompanyId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing occupational_CurrentCompanyId - end
//	processing addresstypes_AddressType - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_addresstypes_AddressType = $pageObject->getControl("addresstypes_AddressType", $id);
		$control_addresstypes_AddressType->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing addresstypes_AddressType - end
//	processing addresstypes_AddressTypeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_addresstypes_AddressTypeId = $pageObject->getControl("addresstypes_AddressTypeId", $id);
		$control_addresstypes_AddressTypeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing addresstypes_AddressTypeId - end
//	processing DevoteeOrg_DevoteeOrgId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DevoteeOrg_DevoteeOrgId = $pageObject->getControl("DevoteeOrg_DevoteeOrgId", $id);
		$control_DevoteeOrg_DevoteeOrgId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DevoteeOrg_DevoteeOrgId - end
//	processing DevoteeOrg_DevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DevoteeOrg_DevoteeId = $pageObject->getControl("DevoteeOrg_DevoteeId", $id);
		$control_DevoteeOrg_DevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DevoteeOrg_DevoteeId - end
//	processing DevoteeOrg_FromDate - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DevoteeOrg_FromDate = $pageObject->getControl("DevoteeOrg_FromDate", $id);
		$control_DevoteeOrg_FromDate->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DevoteeOrg_FromDate - end
//	processing DevoteeOrg_ToDate - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DevoteeOrg_ToDate = $pageObject->getControl("DevoteeOrg_ToDate", $id);
		$control_DevoteeOrg_ToDate->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DevoteeOrg_ToDate - end
//	processing DevoteeOrg_OrgId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DevoteeOrg_OrgId = $pageObject->getControl("DevoteeOrg_OrgId", $id);
		$control_DevoteeOrg_OrgId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DevoteeOrg_OrgId - end
//	processing devoteeaddress_devoteeaddressId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteeaddress_devoteeaddressId = $pageObject->getControl("devoteeaddress_devoteeaddressId", $id);
		$control_devoteeaddress_devoteeaddressId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteeaddress_devoteeaddressId - end
//	processing devoteeaddress_AddressId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteeaddress_AddressId = $pageObject->getControl("devoteeaddress_AddressId", $id);
		$control_devoteeaddress_AddressId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteeaddress_AddressId - end
//	processing devoteeaddress_DevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_devoteeaddress_DevoteeId = $pageObject->getControl("devoteeaddress_DevoteeId", $id);
		$control_devoteeaddress_DevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing devoteeaddress_DevoteeId - end

//	insert ownerid value if exists
	if($strOriginalTableName == $pageObject->pSet->getOwnerTable("DevoteeId"))
		$avalues["DevoteeId"] = prepare_for_db("DevoteeId",$_SESSION["_".$strTableName."_OwnerID"]);



	$failed_inline_add=false;
//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
	
//	before Add event
	$retval = true;
	if($eventObj->exists("BeforeAdd"))
		$retval = $eventObj->BeforeAdd($avalues,$usermessage,(bool)$inlineadd, $pageObject);
	if($retval && $pageObject->isCaptchaOk)
	{
		//add or set updated lat-lng values for all map fileds with 'UpdateLatLng' ticked
		setUpdatedLatLng($avalues, $pageObject->cipherer->pSet);
		
		$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
		if(DoInsertRecord($strOriginalTableName,$avalues,$blobfields,$id,$pageObject, $pageObject->cipherer))
		{
			$IsSaved=true;
//	after edit event
			if($auditObj || $eventObj->exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
			}
			
			if($auditObj)
				$auditObj->LogAdd($strTableName,$avalues,$keys);
				
// Give possibility to all edit controls to clean their data				
//	processing DevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DevoteeId->afterSuccessfulSave();
			}
//	processing DevoteeId - end
//	processing Photo - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Photo->afterSuccessfulSave();
			}
//	processing Photo - end
//	processing Gender - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Gender->afterSuccessfulSave();
			}
//	processing Gender - end
//	processing TitleId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_TitleId->afterSuccessfulSave();
			}
//	processing TitleId - end
//	processing FirstName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_FirstName->afterSuccessfulSave();
			}
//	processing FirstName - end
//	processing LastName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_LastName->afterSuccessfulSave();
			}
//	processing LastName - end
//	processing MiddleName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_MiddleName->afterSuccessfulSave();
			}
//	processing MiddleName - end
//	processing DateOfBirth - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DateOfBirth->afterSuccessfulSave();
			}
//	processing DateOfBirth - end
//	processing MaritalStatusId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_MaritalStatusId->afterSuccessfulSave();
			}
//	processing MaritalStatusId - end
//	processing DateofMarriage - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DateofMarriage->afterSuccessfulSave();
			}
//	processing DateofMarriage - end
//	processing SpouseDevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_SpouseDevoteeId->afterSuccessfulSave();
			}
//	processing SpouseDevoteeId - end
//	processing MobilePhone - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_MobilePhone->afterSuccessfulSave();
			}
//	processing MobilePhone - end
//	processing WorkPhone - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_WorkPhone->afterSuccessfulSave();
			}
//	processing WorkPhone - end
//	processing EmailPrimary - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_EmailPrimary->afterSuccessfulSave();
			}
//	processing EmailPrimary - end
//	processing EmailSecondary - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_EmailSecondary->afterSuccessfulSave();
			}
//	processing EmailSecondary - end
//	processing Password - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Password->afterSuccessfulSave();
			}
//	processing Password - end
//	processing Address_AddressId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Address_AddressId->afterSuccessfulSave();
			}
//	processing Address_AddressId - end
//	processing address_AddressLine1 - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_AddressLine1->afterSuccessfulSave();
			}
//	processing address_AddressLine1 - end
//	processing address_AddressLine2 - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_AddressLine2->afterSuccessfulSave();
			}
//	processing address_AddressLine2 - end
//	processing address_City - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_City->afterSuccessfulSave();
			}
//	processing address_City - end
//	processing address_State - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_State->afterSuccessfulSave();
			}
//	processing address_State - end
//	processing address_Pincode - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_Pincode->afterSuccessfulSave();
			}
//	processing address_Pincode - end
//	processing address_Country - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_Country->afterSuccessfulSave();
			}
//	processing address_Country - end
//	processing address_IsVerified - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_IsVerified->afterSuccessfulSave();
			}
//	processing address_IsVerified - end
//	processing address_IsWrong - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_IsWrong->afterSuccessfulSave();
			}
//	processing address_IsWrong - end
//	processing address_AddressTypeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_address_AddressTypeId->afterSuccessfulSave();
			}
//	processing address_AddressTypeId - end
//	processing organization_OrgName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_organization_OrgName->afterSuccessfulSave();
			}
//	processing organization_OrgName - end
//	processing organization_OrgId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_organization_OrgId->afterSuccessfulSave();
			}
//	processing organization_OrgId - end
//	processing organization_OrgLeaderId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_organization_OrgLeaderId->afterSuccessfulSave();
			}
//	processing organization_OrgLeaderId - end
//	processing organization_OrgOwnerId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_organization_OrgOwnerId->afterSuccessfulSave();
			}
//	processing organization_OrgOwnerId - end
//	processing organization_Location - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_organization_Location->afterSuccessfulSave();
			}
//	processing organization_Location - end
//	processing spirituallife_SericesRendered - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_SericesRendered->afterSuccessfulSave();
			}
//	processing spirituallife_SericesRendered - end
//	processing SpiritualLife_DevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_SpiritualLife_DevoteeId->afterSuccessfulSave();
			}
//	processing SpiritualLife_DevoteeId - end
//	processing spirituallife_PreferedServices - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_PreferedServices->afterSuccessfulSave();
			}
//	processing spirituallife_PreferedServices - end
//	processing spirituallife_Chanting16RoundsSince - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_Chanting16RoundsSince->afterSuccessfulSave();
			}
//	processing spirituallife_Chanting16RoundsSince - end
//	processing spirituallife_IntroducedInCenter - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_IntroducedInCenter->afterSuccessfulSave();
			}
//	processing spirituallife_IntroducedInCenter - end
//	processing spirituallife_YearOfIntroduction - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_YearOfIntroduction->afterSuccessfulSave();
			}
//	processing spirituallife_YearOfIntroduction - end
//	processing spirituallife_PreviousReligion - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_PreviousReligion->afterSuccessfulSave();
			}
//	processing spirituallife_PreviousReligion - end
//	processing spirituallife_SpiritualMasterDevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_SpiritualMasterDevoteeId->afterSuccessfulSave();
			}
//	processing spirituallife_SpiritualMasterDevoteeId - end
//	processing spirituallife_DateOfBrahmanInitiation - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_DateOfBrahmanInitiation->afterSuccessfulSave();
			}
//	processing spirituallife_DateOfBrahmanInitiation - end
//	processing spirituallife_DateOfHarinamInitiation - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_DateOfHarinamInitiation->afterSuccessfulSave();
			}
//	processing spirituallife_DateOfHarinamInitiation - end
//	processing spirituallife_SpiritulLifeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_SpiritulLifeId->afterSuccessfulSave();
			}
//	processing spirituallife_SpiritulLifeId - end
//	processing spirituallife_IntroducedBy - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_spirituallife_IntroducedBy->afterSuccessfulSave();
			}
//	processing spirituallife_IntroducedBy - end
//	processing company_CompanyId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_company_CompanyId->afterSuccessfulSave();
			}
//	processing company_CompanyId - end
//	processing company_CompanyName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_company_CompanyName->afterSuccessfulSave();
			}
//	processing company_CompanyName - end
//	processing company_AddressId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_company_AddressId->afterSuccessfulSave();
			}
//	processing company_AddressId - end
//	processing company_Remark - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_company_Remark->afterSuccessfulSave();
			}
//	processing company_Remark - end
//	processing devoteelang_DevoteeLanguageId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteelang_DevoteeLanguageId->afterSuccessfulSave();
			}
//	processing devoteelang_DevoteeLanguageId - end
//	processing devoteelang_WritingLevel - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteelang_WritingLevel->afterSuccessfulSave();
			}
//	processing devoteelang_WritingLevel - end
//	processing devoteelang_DevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteelang_DevoteeId->afterSuccessfulSave();
			}
//	processing devoteelang_DevoteeId - end
//	processing devoteelang_LanguageId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteelang_LanguageId->afterSuccessfulSave();
			}
//	processing devoteelang_LanguageId - end
//	processing devoteelang_SpeakingLevel - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteelang_SpeakingLevel->afterSuccessfulSave();
			}
//	processing devoteelang_SpeakingLevel - end
//	processing devoteelang_ReadingLevel - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteelang_ReadingLevel->afterSuccessfulSave();
			}
//	processing devoteelang_ReadingLevel - end
//	processing occupational_DevoteeOccupationalId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_occupational_DevoteeOccupationalId->afterSuccessfulSave();
			}
//	processing occupational_DevoteeOccupationalId - end
//	processing Occupational_DevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Occupational_DevoteeId->afterSuccessfulSave();
			}
//	processing Occupational_DevoteeId - end
//	processing Occupational_Education - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Occupational_Education->afterSuccessfulSave();
			}
//	processing Occupational_Education - end
//	processing Occupational_Occupation - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Occupational_Occupation->afterSuccessfulSave();
			}
//	processing Occupational_Occupation - end
//	processing Occupational_Designation - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Occupational_Designation->afterSuccessfulSave();
			}
//	processing Occupational_Designation - end
//	processing Occupational_AwardsOrMerits - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Occupational_AwardsOrMerits->afterSuccessfulSave();
			}
//	processing Occupational_AwardsOrMerits - end
//	processing occupational_SkillsOrExperiences - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_occupational_SkillsOrExperiences->afterSuccessfulSave();
			}
//	processing occupational_SkillsOrExperiences - end
//	processing occupational_CurrentCompanyId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_occupational_CurrentCompanyId->afterSuccessfulSave();
			}
//	processing occupational_CurrentCompanyId - end
//	processing addresstypes_AddressType - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_addresstypes_AddressType->afterSuccessfulSave();
			}
//	processing addresstypes_AddressType - end
//	processing addresstypes_AddressTypeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_addresstypes_AddressTypeId->afterSuccessfulSave();
			}
//	processing addresstypes_AddressTypeId - end
//	processing DevoteeOrg_DevoteeOrgId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DevoteeOrg_DevoteeOrgId->afterSuccessfulSave();
			}
//	processing DevoteeOrg_DevoteeOrgId - end
//	processing DevoteeOrg_DevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DevoteeOrg_DevoteeId->afterSuccessfulSave();
			}
//	processing DevoteeOrg_DevoteeId - end
//	processing DevoteeOrg_FromDate - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DevoteeOrg_FromDate->afterSuccessfulSave();
			}
//	processing DevoteeOrg_FromDate - end
//	processing DevoteeOrg_ToDate - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DevoteeOrg_ToDate->afterSuccessfulSave();
			}
//	processing DevoteeOrg_ToDate - end
//	processing DevoteeOrg_OrgId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DevoteeOrg_OrgId->afterSuccessfulSave();
			}
//	processing DevoteeOrg_OrgId - end
//	processing devoteeaddress_devoteeaddressId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteeaddress_devoteeaddressId->afterSuccessfulSave();
			}
//	processing devoteeaddress_devoteeaddressId - end
//	processing devoteeaddress_AddressId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteeaddress_AddressId->afterSuccessfulSave();
			}
//	processing devoteeaddress_AddressId - end
//	processing devoteeaddress_DevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_devoteeaddress_DevoteeId->afterSuccessfulSave();
			}
//	processing devoteeaddress_DevoteeId - end

			$afterAdd_id = '';	
			if($eventObj->exists("AfterAdd") && $inlineadd!=ADD_MASTER){
				$eventObj->AfterAdd($avalues,$keys,(bool)$inlineadd, $pageObject);
			} else if ($eventObj->exists("AfterAdd") && $inlineadd==ADD_MASTER){
				if($onFly)
					$eventObj->AfterAdd($avalues,$keys,(bool)$inlineadd, $pageObject);
				else{
					$afterAdd_id = generatePassword(20);	
				
					$_SESSION['after_add_data'][$afterAdd_id] = array(
						'avalues'=>$avalues,
						'keys'=>$keys,
						'inlineadd'=>(bool)$inlineadd,
						'time' => time()
					);	
				}
			}
				
			if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
			{
				$permis = array();
				$keylink = "";$k = 0;
				foreach($keys as $idx=>$val)
				{
					if($k!=0)
						$keylink .="&";
					$keylink .="editid".(++$k)."=".htmlspecialchars(rawurlencode(@$val));
				}
				$permis = $pageObject->getPermissions();				
				if (count($keys))
				{
					$message .="</br>";
					if($pageObject->pSet->hasEditPage() && $permis['edit'])
						$message .='&nbsp;<a href=\'vw_Devotee_full_edit.php?'.$keylink.'\'>'."Edit".'</a>&nbsp;';
					if($pageObject->pSet->hasViewPage() && $permis['search'])
						$message .='&nbsp;<a href=\'vw_Devotee_full_view.php?'.$keylink.'\'>'."View".'</a>&nbsp;';
				}
				$mesClass = "mes_ok";	
			}
		}
		elseif($inlineadd!=ADD_INLINE)
			$mesClass = "mes_not";	
	}
	else
	{
		$message = $usermessage;
		$status = "DECLINED";
		$readavalues = true;
	}
}
if($message)
	$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if (no_output_done() && $inlineadd==ADD_SIMPLE && $IsSaved)
{
	// saving message
	$_SESSION["message_add"] = ($message ? $message : "");
	// redirect
	header("Location: vw_Devotee_full_".$pageObject->getPageType().".php");
	// turned on output buffering, so we need to stop script
	exit();
}

if($inlineadd==ADD_MASTER && $IsSaved)
	$_SESSION["message_add"] = ($message ? $message : "");
	
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if($inlineadd==ADD_SIMPLE && isset($_SESSION["message_add"]))
{
	$message = $_SESSION["message_add"];
	unset($_SESSION["message_add"]);
}

$defvalues=array();

//	copy record
if(array_key_exists("copyid1",$_REQUEST) || array_key_exists("editid1",$_REQUEST))
{
	$copykeys=array();
	if(array_key_exists("copyid1",$_REQUEST))
	{
		$copykeys["DevoteeId"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["DevoteeId"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strWhere=whereAdd($strWhere,SecuritySQL("Search"));
	$strSQL = $gQuery->gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs = db_query($strSQL,$conn);
	$defvalues = $pageObject->cipherer->DecryptFetchedArray($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["DevoteeId"]="";
//call CopyOnLoad event
	if($eventObj->exists("CopyOnLoad"))
		$eventObj->CopyOnLoad($defvalues,$strWhere, $pageObject);
}
else
{
}

//	insert default ownerid value if exists
	if($strOriginalTableName == $pageObject->pSet->getOwnerTable("DevoteeId"))
		$defvalues["DevoteeId"] = prepare_for_db("DevoteeId",$_SESSION["_".$strTableName."_OwnerID"]);


if($readavalues)
{
	$defvalues["TitleId"]=@$avalues["TitleId"];
	$defvalues["FirstName"]=@$avalues["FirstName"];
	$defvalues["LastName"]=@$avalues["LastName"];
	$defvalues["MiddleName"]=@$avalues["MiddleName"];
	$defvalues["Gender"]=@$avalues["Gender"];
	$defvalues["DateOfBirth"]=@$avalues["DateOfBirth"];
	$defvalues["MaritalStatusId"]=@$avalues["MaritalStatusId"];
	$defvalues["DateofMarriage"]=@$avalues["DateofMarriage"];
	$defvalues["SpouseDevoteeId"]=@$avalues["SpouseDevoteeId"];
	$defvalues["MobilePhone"]=@$avalues["MobilePhone"];
	$defvalues["WorkPhone"]=@$avalues["WorkPhone"];
	$defvalues["EmailPrimary"]=@$avalues["EmailPrimary"];
	$defvalues["EmailSecondary"]=@$avalues["EmailSecondary"];
	$defvalues["Password"]=@$avalues["Password"];
	$defvalues["address_AddressLine1"]=@$avalues["address_AddressLine1"];
	$defvalues["address_AddressLine2"]=@$avalues["address_AddressLine2"];
	$defvalues["address_City"]=@$avalues["address_City"];
	$defvalues["address_State"]=@$avalues["address_State"];
	$defvalues["address_Country"]=@$avalues["address_Country"];
	$defvalues["address_Pincode"]=@$avalues["address_Pincode"];
	$defvalues["address_IsVerified"]=@$avalues["address_IsVerified"];
	$defvalues["address_IsWrong"]=@$avalues["address_IsWrong"];
	$defvalues["address_AddressTypeId"]=@$avalues["address_AddressTypeId"];
	$defvalues["Occupational_DevoteeId"]=@$avalues["Occupational_DevoteeId"];
	$defvalues["Occupational_Education"]=@$avalues["Occupational_Education"];
	$defvalues["Occupational_Occupation"]=@$avalues["Occupational_Occupation"];
	$defvalues["Occupational_Designation"]=@$avalues["Occupational_Designation"];
	$defvalues["Occupational_AwardsOrMerits"]=@$avalues["Occupational_AwardsOrMerits"];
	$defvalues["occupational_SkillsOrExperiences"]=@$avalues["occupational_SkillsOrExperiences"];
	$defvalues["occupational_CurrentCompanyId"]=@$avalues["occupational_CurrentCompanyId"];
	$defvalues["organization_OrgId"]=@$avalues["organization_OrgId"];
	$defvalues["organization_OrgName"]=@$avalues["organization_OrgName"];
	$defvalues["organization_OrgOwnerId"]=@$avalues["organization_OrgOwnerId"];
	$defvalues["organization_OrgLeaderId"]=@$avalues["organization_OrgLeaderId"];
	$defvalues["organization_Location"]=@$avalues["organization_Location"];
	$defvalues["spirituallife_SpiritulLifeId"]=@$avalues["spirituallife_SpiritulLifeId"];
	$defvalues["SpiritualLife_DevoteeId"]=@$avalues["SpiritualLife_DevoteeId"];
	$defvalues["spirituallife_DateOfHarinamInitiation"]=@$avalues["spirituallife_DateOfHarinamInitiation"];
	$defvalues["spirituallife_DateOfBrahmanInitiation"]=@$avalues["spirituallife_DateOfBrahmanInitiation"];
	$defvalues["spirituallife_SpiritualMasterDevoteeId"]=@$avalues["spirituallife_SpiritualMasterDevoteeId"];
	$defvalues["spirituallife_PreviousReligion"]=@$avalues["spirituallife_PreviousReligion"];
	$defvalues["spirituallife_Chanting16RoundsSince"]=@$avalues["spirituallife_Chanting16RoundsSince"];
	$defvalues["spirituallife_IntroducedBy"]=@$avalues["spirituallife_IntroducedBy"];
	$defvalues["spirituallife_YearOfIntroduction"]=@$avalues["spirituallife_YearOfIntroduction"];
	$defvalues["spirituallife_IntroducedInCenter"]=@$avalues["spirituallife_IntroducedInCenter"];
	$defvalues["spirituallife_PreferedServices"]=@$avalues["spirituallife_PreferedServices"];
	$defvalues["spirituallife_SericesRendered"]=@$avalues["spirituallife_SericesRendered"];
	$defvalues["devoteeaddress_DevoteeId"]=@$avalues["devoteeaddress_DevoteeId"];
	$defvalues["devoteeaddress_AddressId"]=@$avalues["devoteeaddress_AddressId"];
	$defvalues["devoteelang_DevoteeLanguageId"]=@$avalues["devoteelang_DevoteeLanguageId"];
	$defvalues["devoteelang_DevoteeId"]=@$avalues["devoteelang_DevoteeId"];
	$defvalues["devoteelang_LanguageId"]=@$avalues["devoteelang_LanguageId"];
	$defvalues["devoteelang_SpeakingLevel"]=@$avalues["devoteelang_SpeakingLevel"];
	$defvalues["devoteelang_ReadingLevel"]=@$avalues["devoteelang_ReadingLevel"];
	$defvalues["devoteelang_WritingLevel"]=@$avalues["devoteelang_WritingLevel"];
	$defvalues["addresstypes_AddressType"]=@$avalues["addresstypes_AddressType"];
	$defvalues["addresstypes_AddressTypeId"]=@$avalues["addresstypes_AddressTypeId"];
	$defvalues["devoteeaddress_devoteeaddressId"]=@$avalues["devoteeaddress_devoteeaddressId"];
	$defvalues["Address_AddressId"]=@$avalues["Address_AddressId"];
	$defvalues["occupational_DevoteeOccupationalId"]=@$avalues["occupational_DevoteeOccupationalId"];
	$defvalues["DevoteeOrg_DevoteeOrgId"]=@$avalues["DevoteeOrg_DevoteeOrgId"];
	$defvalues["DevoteeOrg_OrgId"]=@$avalues["DevoteeOrg_OrgId"];
	$defvalues["DevoteeOrg_DevoteeId"]=@$avalues["DevoteeOrg_DevoteeId"];
	$defvalues["DevoteeOrg_FromDate"]=@$avalues["DevoteeOrg_FromDate"];
	$defvalues["DevoteeOrg_ToDate"]=@$avalues["DevoteeOrg_ToDate"];
	$defvalues["DevoteeId"]=@$avalues["DevoteeId"];
	$defvalues["company_CompanyId"]=@$avalues["company_CompanyId"];
	$defvalues["company_CompanyName"]=@$avalues["company_CompanyName"];
	$defvalues["company_AddressId"]=@$avalues["company_AddressId"];
	$defvalues["company_Remark"]=@$avalues["company_Remark"];
}

if($eventObj->exists("ProcessValuesAdd"))
	$eventObj->ProcessValuesAdd($defvalues, $pageObject);


//for basic files
$includes="";

if($inlineadd!=ADD_INLINE)
{
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$includes .="<script language=\"JavaScript\" src=\"include/loadfirst.js\"></script>\r\n";
				$includes.="<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";
		if (!isMobile())
			$includes.="<div id=\"search_suggest\"></div>\r\n";
	}
	
	if(!$pageObject->isAppearOnTabs("TitleId"))
		$xt->assign("TitleId_fieldblock",true);
	else
		$xt->assign("TitleId_tabfieldblock",true);
	$xt->assign("TitleId_label",true);
	if(isEnableSection508())
		$xt->assign_section("TitleId_label","<label for=\"".GetInputElementId("TitleId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Photo"))
		$xt->assign("Photo_fieldblock",true);
	else
		$xt->assign("Photo_tabfieldblock",true);
	$xt->assign("Photo_label",true);
	if(isEnableSection508())
		$xt->assign_section("Photo_label","<label for=\"".GetInputElementId("Photo", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("FirstName"))
		$xt->assign("FirstName_fieldblock",true);
	else
		$xt->assign("FirstName_tabfieldblock",true);
	$xt->assign("FirstName_label",true);
	if(isEnableSection508())
		$xt->assign_section("FirstName_label","<label for=\"".GetInputElementId("FirstName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("LastName"))
		$xt->assign("LastName_fieldblock",true);
	else
		$xt->assign("LastName_tabfieldblock",true);
	$xt->assign("LastName_label",true);
	if(isEnableSection508())
		$xt->assign_section("LastName_label","<label for=\"".GetInputElementId("LastName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("MiddleName"))
		$xt->assign("MiddleName_fieldblock",true);
	else
		$xt->assign("MiddleName_tabfieldblock",true);
	$xt->assign("MiddleName_label",true);
	if(isEnableSection508())
		$xt->assign_section("MiddleName_label","<label for=\"".GetInputElementId("MiddleName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Gender"))
		$xt->assign("Gender_fieldblock",true);
	else
		$xt->assign("Gender_tabfieldblock",true);
	$xt->assign("Gender_label",true);
	if(isEnableSection508())
		$xt->assign_section("Gender_label","<label for=\"".GetInputElementId("Gender", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DateOfBirth"))
		$xt->assign("DateOfBirth_fieldblock",true);
	else
		$xt->assign("DateOfBirth_tabfieldblock",true);
	$xt->assign("DateOfBirth_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateOfBirth_label","<label for=\"".GetInputElementId("DateOfBirth", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("MaritalStatusId"))
		$xt->assign("MaritalStatusId_fieldblock",true);
	else
		$xt->assign("MaritalStatusId_tabfieldblock",true);
	$xt->assign("MaritalStatusId_label",true);
	if(isEnableSection508())
		$xt->assign_section("MaritalStatusId_label","<label for=\"".GetInputElementId("MaritalStatusId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DateofMarriage"))
		$xt->assign("DateofMarriage_fieldblock",true);
	else
		$xt->assign("DateofMarriage_tabfieldblock",true);
	$xt->assign("DateofMarriage_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateofMarriage_label","<label for=\"".GetInputElementId("DateofMarriage", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("SpouseDevoteeId"))
		$xt->assign("SpouseDevoteeId_fieldblock",true);
	else
		$xt->assign("SpouseDevoteeId_tabfieldblock",true);
	$xt->assign("SpouseDevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpouseDevoteeId_label","<label for=\"".GetInputElementId("SpouseDevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("MobilePhone"))
		$xt->assign("MobilePhone_fieldblock",true);
	else
		$xt->assign("MobilePhone_tabfieldblock",true);
	$xt->assign("MobilePhone_label",true);
	if(isEnableSection508())
		$xt->assign_section("MobilePhone_label","<label for=\"".GetInputElementId("MobilePhone", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("WorkPhone"))
		$xt->assign("WorkPhone_fieldblock",true);
	else
		$xt->assign("WorkPhone_tabfieldblock",true);
	$xt->assign("WorkPhone_label",true);
	if(isEnableSection508())
		$xt->assign_section("WorkPhone_label","<label for=\"".GetInputElementId("WorkPhone", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("EmailPrimary"))
		$xt->assign("EmailPrimary_fieldblock",true);
	else
		$xt->assign("EmailPrimary_tabfieldblock",true);
	$xt->assign("EmailPrimary_label",true);
	if(isEnableSection508())
		$xt->assign_section("EmailPrimary_label","<label for=\"".GetInputElementId("EmailPrimary", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("EmailSecondary"))
		$xt->assign("EmailSecondary_fieldblock",true);
	else
		$xt->assign("EmailSecondary_tabfieldblock",true);
	$xt->assign("EmailSecondary_label",true);
	if(isEnableSection508())
		$xt->assign_section("EmailSecondary_label","<label for=\"".GetInputElementId("EmailSecondary", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Password"))
		$xt->assign("Password_fieldblock",true);
	else
		$xt->assign("Password_tabfieldblock",true);
	$xt->assign("Password_label",true);
	if(isEnableSection508())
		$xt->assign_section("Password_label","<label for=\"".GetInputElementId("Password", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_AddressLine1"))
		$xt->assign("address_AddressLine1_fieldblock",true);
	else
		$xt->assign("address_AddressLine1_tabfieldblock",true);
	$xt->assign("address_AddressLine1_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_AddressLine1_label","<label for=\"".GetInputElementId("address_AddressLine1", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_AddressLine2"))
		$xt->assign("address_AddressLine2_fieldblock",true);
	else
		$xt->assign("address_AddressLine2_tabfieldblock",true);
	$xt->assign("address_AddressLine2_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_AddressLine2_label","<label for=\"".GetInputElementId("address_AddressLine2", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_City"))
		$xt->assign("address_City_fieldblock",true);
	else
		$xt->assign("address_City_tabfieldblock",true);
	$xt->assign("address_City_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_City_label","<label for=\"".GetInputElementId("address_City", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_State"))
		$xt->assign("address_State_fieldblock",true);
	else
		$xt->assign("address_State_tabfieldblock",true);
	$xt->assign("address_State_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_State_label","<label for=\"".GetInputElementId("address_State", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_Country"))
		$xt->assign("address_Country_fieldblock",true);
	else
		$xt->assign("address_Country_tabfieldblock",true);
	$xt->assign("address_Country_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_Country_label","<label for=\"".GetInputElementId("address_Country", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_Pincode"))
		$xt->assign("address_Pincode_fieldblock",true);
	else
		$xt->assign("address_Pincode_tabfieldblock",true);
	$xt->assign("address_Pincode_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_Pincode_label","<label for=\"".GetInputElementId("address_Pincode", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_IsVerified"))
		$xt->assign("address_IsVerified_fieldblock",true);
	else
		$xt->assign("address_IsVerified_tabfieldblock",true);
	$xt->assign("address_IsVerified_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_IsVerified_label","<label for=\"".GetInputElementId("address_IsVerified", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_IsWrong"))
		$xt->assign("address_IsWrong_fieldblock",true);
	else
		$xt->assign("address_IsWrong_tabfieldblock",true);
	$xt->assign("address_IsWrong_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_IsWrong_label","<label for=\"".GetInputElementId("address_IsWrong", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("address_AddressTypeId"))
		$xt->assign("address_AddressTypeId_fieldblock",true);
	else
		$xt->assign("address_AddressTypeId_tabfieldblock",true);
	$xt->assign("address_AddressTypeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("address_AddressTypeId_label","<label for=\"".GetInputElementId("address_AddressTypeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Occupational_DevoteeId"))
		$xt->assign("Occupational_DevoteeId_fieldblock",true);
	else
		$xt->assign("Occupational_DevoteeId_tabfieldblock",true);
	$xt->assign("Occupational_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_DevoteeId_label","<label for=\"".GetInputElementId("Occupational_DevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Occupational_Education"))
		$xt->assign("Occupational_Education_fieldblock",true);
	else
		$xt->assign("Occupational_Education_tabfieldblock",true);
	$xt->assign("Occupational_Education_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_Education_label","<label for=\"".GetInputElementId("Occupational_Education", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Occupational_Occupation"))
		$xt->assign("Occupational_Occupation_fieldblock",true);
	else
		$xt->assign("Occupational_Occupation_tabfieldblock",true);
	$xt->assign("Occupational_Occupation_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_Occupation_label","<label for=\"".GetInputElementId("Occupational_Occupation", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Occupational_Designation"))
		$xt->assign("Occupational_Designation_fieldblock",true);
	else
		$xt->assign("Occupational_Designation_tabfieldblock",true);
	$xt->assign("Occupational_Designation_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_Designation_label","<label for=\"".GetInputElementId("Occupational_Designation", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Occupational_AwardsOrMerits"))
		$xt->assign("Occupational_AwardsOrMerits_fieldblock",true);
	else
		$xt->assign("Occupational_AwardsOrMerits_tabfieldblock",true);
	$xt->assign("Occupational_AwardsOrMerits_label",true);
	if(isEnableSection508())
		$xt->assign_section("Occupational_AwardsOrMerits_label","<label for=\"".GetInputElementId("Occupational_AwardsOrMerits", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("occupational_SkillsOrExperiences"))
		$xt->assign("occupational_SkillsOrExperiences_fieldblock",true);
	else
		$xt->assign("occupational_SkillsOrExperiences_tabfieldblock",true);
	$xt->assign("occupational_SkillsOrExperiences_label",true);
	if(isEnableSection508())
		$xt->assign_section("occupational_SkillsOrExperiences_label","<label for=\"".GetInputElementId("occupational_SkillsOrExperiences", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("occupational_CurrentCompanyId"))
		$xt->assign("occupational_CurrentCompanyId_fieldblock",true);
	else
		$xt->assign("occupational_CurrentCompanyId_tabfieldblock",true);
	$xt->assign("occupational_CurrentCompanyId_label",true);
	if(isEnableSection508())
		$xt->assign_section("occupational_CurrentCompanyId_label","<label for=\"".GetInputElementId("occupational_CurrentCompanyId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("organization_OrgId"))
		$xt->assign("organization_OrgId_fieldblock",true);
	else
		$xt->assign("organization_OrgId_tabfieldblock",true);
	$xt->assign("organization_OrgId_label",true);
	if(isEnableSection508())
		$xt->assign_section("organization_OrgId_label","<label for=\"".GetInputElementId("organization_OrgId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("organization_OrgName"))
		$xt->assign("organization_OrgName_fieldblock",true);
	else
		$xt->assign("organization_OrgName_tabfieldblock",true);
	$xt->assign("organization_OrgName_label",true);
	if(isEnableSection508())
		$xt->assign_section("organization_OrgName_label","<label for=\"".GetInputElementId("organization_OrgName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("organization_OrgOwnerId"))
		$xt->assign("organization_OrgOwnerId_fieldblock",true);
	else
		$xt->assign("organization_OrgOwnerId_tabfieldblock",true);
	$xt->assign("organization_OrgOwnerId_label",true);
	if(isEnableSection508())
		$xt->assign_section("organization_OrgOwnerId_label","<label for=\"".GetInputElementId("organization_OrgOwnerId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("organization_OrgLeaderId"))
		$xt->assign("organization_OrgLeaderId_fieldblock",true);
	else
		$xt->assign("organization_OrgLeaderId_tabfieldblock",true);
	$xt->assign("organization_OrgLeaderId_label",true);
	if(isEnableSection508())
		$xt->assign_section("organization_OrgLeaderId_label","<label for=\"".GetInputElementId("organization_OrgLeaderId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("organization_Location"))
		$xt->assign("organization_Location_fieldblock",true);
	else
		$xt->assign("organization_Location_tabfieldblock",true);
	$xt->assign("organization_Location_label",true);
	if(isEnableSection508())
		$xt->assign_section("organization_Location_label","<label for=\"".GetInputElementId("organization_Location", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_SpiritulLifeId"))
		$xt->assign("spirituallife_SpiritulLifeId_fieldblock",true);
	else
		$xt->assign("spirituallife_SpiritulLifeId_tabfieldblock",true);
	$xt->assign("spirituallife_SpiritulLifeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_SpiritulLifeId_label","<label for=\"".GetInputElementId("spirituallife_SpiritulLifeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("SpiritualLife_DevoteeId"))
		$xt->assign("SpiritualLife_DevoteeId_fieldblock",true);
	else
		$xt->assign("SpiritualLife_DevoteeId_tabfieldblock",true);
	$xt->assign("SpiritualLife_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpiritualLife_DevoteeId_label","<label for=\"".GetInputElementId("SpiritualLife_DevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_DateOfHarinamInitiation"))
		$xt->assign("spirituallife_DateOfHarinamInitiation_fieldblock",true);
	else
		$xt->assign("spirituallife_DateOfHarinamInitiation_tabfieldblock",true);
	$xt->assign("spirituallife_DateOfHarinamInitiation_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_DateOfHarinamInitiation_label","<label for=\"".GetInputElementId("spirituallife_DateOfHarinamInitiation", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_DateOfBrahmanInitiation"))
		$xt->assign("spirituallife_DateOfBrahmanInitiation_fieldblock",true);
	else
		$xt->assign("spirituallife_DateOfBrahmanInitiation_tabfieldblock",true);
	$xt->assign("spirituallife_DateOfBrahmanInitiation_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_DateOfBrahmanInitiation_label","<label for=\"".GetInputElementId("spirituallife_DateOfBrahmanInitiation", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_SpiritualMasterDevoteeId"))
		$xt->assign("spirituallife_SpiritualMasterDevoteeId_fieldblock",true);
	else
		$xt->assign("spirituallife_SpiritualMasterDevoteeId_tabfieldblock",true);
	$xt->assign("spirituallife_SpiritualMasterDevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_SpiritualMasterDevoteeId_label","<label for=\"".GetInputElementId("spirituallife_SpiritualMasterDevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_PreviousReligion"))
		$xt->assign("spirituallife_PreviousReligion_fieldblock",true);
	else
		$xt->assign("spirituallife_PreviousReligion_tabfieldblock",true);
	$xt->assign("spirituallife_PreviousReligion_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_PreviousReligion_label","<label for=\"".GetInputElementId("spirituallife_PreviousReligion", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_Chanting16RoundsSince"))
		$xt->assign("spirituallife_Chanting16RoundsSince_fieldblock",true);
	else
		$xt->assign("spirituallife_Chanting16RoundsSince_tabfieldblock",true);
	$xt->assign("spirituallife_Chanting16RoundsSince_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_Chanting16RoundsSince_label","<label for=\"".GetInputElementId("spirituallife_Chanting16RoundsSince", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_IntroducedBy"))
		$xt->assign("spirituallife_IntroducedBy_fieldblock",true);
	else
		$xt->assign("spirituallife_IntroducedBy_tabfieldblock",true);
	$xt->assign("spirituallife_IntroducedBy_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_IntroducedBy_label","<label for=\"".GetInputElementId("spirituallife_IntroducedBy", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_YearOfIntroduction"))
		$xt->assign("spirituallife_YearOfIntroduction_fieldblock",true);
	else
		$xt->assign("spirituallife_YearOfIntroduction_tabfieldblock",true);
	$xt->assign("spirituallife_YearOfIntroduction_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_YearOfIntroduction_label","<label for=\"".GetInputElementId("spirituallife_YearOfIntroduction", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_IntroducedInCenter"))
		$xt->assign("spirituallife_IntroducedInCenter_fieldblock",true);
	else
		$xt->assign("spirituallife_IntroducedInCenter_tabfieldblock",true);
	$xt->assign("spirituallife_IntroducedInCenter_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_IntroducedInCenter_label","<label for=\"".GetInputElementId("spirituallife_IntroducedInCenter", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_PreferedServices"))
		$xt->assign("spirituallife_PreferedServices_fieldblock",true);
	else
		$xt->assign("spirituallife_PreferedServices_tabfieldblock",true);
	$xt->assign("spirituallife_PreferedServices_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_PreferedServices_label","<label for=\"".GetInputElementId("spirituallife_PreferedServices", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("spirituallife_SericesRendered"))
		$xt->assign("spirituallife_SericesRendered_fieldblock",true);
	else
		$xt->assign("spirituallife_SericesRendered_tabfieldblock",true);
	$xt->assign("spirituallife_SericesRendered_label",true);
	if(isEnableSection508())
		$xt->assign_section("spirituallife_SericesRendered_label","<label for=\"".GetInputElementId("spirituallife_SericesRendered", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteeaddress_DevoteeId"))
		$xt->assign("devoteeaddress_DevoteeId_fieldblock",true);
	else
		$xt->assign("devoteeaddress_DevoteeId_tabfieldblock",true);
	$xt->assign("devoteeaddress_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_DevoteeId_label","<label for=\"".GetInputElementId("devoteeaddress_DevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteeaddress_AddressId"))
		$xt->assign("devoteeaddress_AddressId_fieldblock",true);
	else
		$xt->assign("devoteeaddress_AddressId_tabfieldblock",true);
	$xt->assign("devoteeaddress_AddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_AddressId_label","<label for=\"".GetInputElementId("devoteeaddress_AddressId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteelang_DevoteeLanguageId"))
		$xt->assign("devoteelang_DevoteeLanguageId_fieldblock",true);
	else
		$xt->assign("devoteelang_DevoteeLanguageId_tabfieldblock",true);
	$xt->assign("devoteelang_DevoteeLanguageId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_DevoteeLanguageId_label","<label for=\"".GetInputElementId("devoteelang_DevoteeLanguageId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteelang_DevoteeId"))
		$xt->assign("devoteelang_DevoteeId_fieldblock",true);
	else
		$xt->assign("devoteelang_DevoteeId_tabfieldblock",true);
	$xt->assign("devoteelang_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_DevoteeId_label","<label for=\"".GetInputElementId("devoteelang_DevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteelang_LanguageId"))
		$xt->assign("devoteelang_LanguageId_fieldblock",true);
	else
		$xt->assign("devoteelang_LanguageId_tabfieldblock",true);
	$xt->assign("devoteelang_LanguageId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_LanguageId_label","<label for=\"".GetInputElementId("devoteelang_LanguageId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteelang_SpeakingLevel"))
		$xt->assign("devoteelang_SpeakingLevel_fieldblock",true);
	else
		$xt->assign("devoteelang_SpeakingLevel_tabfieldblock",true);
	$xt->assign("devoteelang_SpeakingLevel_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_SpeakingLevel_label","<label for=\"".GetInputElementId("devoteelang_SpeakingLevel", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteelang_ReadingLevel"))
		$xt->assign("devoteelang_ReadingLevel_fieldblock",true);
	else
		$xt->assign("devoteelang_ReadingLevel_tabfieldblock",true);
	$xt->assign("devoteelang_ReadingLevel_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_ReadingLevel_label","<label for=\"".GetInputElementId("devoteelang_ReadingLevel", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteelang_WritingLevel"))
		$xt->assign("devoteelang_WritingLevel_fieldblock",true);
	else
		$xt->assign("devoteelang_WritingLevel_tabfieldblock",true);
	$xt->assign("devoteelang_WritingLevel_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteelang_WritingLevel_label","<label for=\"".GetInputElementId("devoteelang_WritingLevel", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("addresstypes_AddressType"))
		$xt->assign("addresstypes_AddressType_fieldblock",true);
	else
		$xt->assign("addresstypes_AddressType_tabfieldblock",true);
	$xt->assign("addresstypes_AddressType_label",true);
	if(isEnableSection508())
		$xt->assign_section("addresstypes_AddressType_label","<label for=\"".GetInputElementId("addresstypes_AddressType", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("addresstypes_AddressTypeId"))
		$xt->assign("addresstypes_AddressTypeId_fieldblock",true);
	else
		$xt->assign("addresstypes_AddressTypeId_tabfieldblock",true);
	$xt->assign("addresstypes_AddressTypeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("addresstypes_AddressTypeId_label","<label for=\"".GetInputElementId("addresstypes_AddressTypeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("devoteeaddress_devoteeaddressId"))
		$xt->assign("devoteeaddress_devoteeaddressId_fieldblock",true);
	else
		$xt->assign("devoteeaddress_devoteeaddressId_tabfieldblock",true);
	$xt->assign("devoteeaddress_devoteeaddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_devoteeaddressId_label","<label for=\"".GetInputElementId("devoteeaddress_devoteeaddressId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Address_AddressId"))
		$xt->assign("Address_AddressId_fieldblock",true);
	else
		$xt->assign("Address_AddressId_tabfieldblock",true);
	$xt->assign("Address_AddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("Address_AddressId_label","<label for=\"".GetInputElementId("Address_AddressId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("occupational_DevoteeOccupationalId"))
		$xt->assign("occupational_DevoteeOccupationalId_fieldblock",true);
	else
		$xt->assign("occupational_DevoteeOccupationalId_tabfieldblock",true);
	$xt->assign("occupational_DevoteeOccupationalId_label",true);
	if(isEnableSection508())
		$xt->assign_section("occupational_DevoteeOccupationalId_label","<label for=\"".GetInputElementId("occupational_DevoteeOccupationalId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_DevoteeOrgId"))
		$xt->assign("DevoteeOrg_DevoteeOrgId_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_DevoteeOrgId_tabfieldblock",true);
	$xt->assign("DevoteeOrg_DevoteeOrgId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_DevoteeOrgId_label","<label for=\"".GetInputElementId("DevoteeOrg_DevoteeOrgId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_OrgId"))
		$xt->assign("DevoteeOrg_OrgId_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_OrgId_tabfieldblock",true);
	$xt->assign("DevoteeOrg_OrgId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_OrgId_label","<label for=\"".GetInputElementId("DevoteeOrg_OrgId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_DevoteeId"))
		$xt->assign("DevoteeOrg_DevoteeId_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_DevoteeId_tabfieldblock",true);
	$xt->assign("DevoteeOrg_DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_DevoteeId_label","<label for=\"".GetInputElementId("DevoteeOrg_DevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_FromDate"))
		$xt->assign("DevoteeOrg_FromDate_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_FromDate_tabfieldblock",true);
	$xt->assign("DevoteeOrg_FromDate_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_FromDate_label","<label for=\"".GetInputElementId("DevoteeOrg_FromDate", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DevoteeOrg_ToDate"))
		$xt->assign("DevoteeOrg_ToDate_fieldblock",true);
	else
		$xt->assign("DevoteeOrg_ToDate_tabfieldblock",true);
	$xt->assign("DevoteeOrg_ToDate_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_ToDate_label","<label for=\"".GetInputElementId("DevoteeOrg_ToDate", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DevoteeId"))
		$xt->assign("DevoteeId_fieldblock",true);
	else
		$xt->assign("DevoteeId_tabfieldblock",true);
	$xt->assign("DevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("DevoteeId_label","<label for=\"".GetInputElementId("DevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("company_CompanyId"))
		$xt->assign("company_CompanyId_fieldblock",true);
	else
		$xt->assign("company_CompanyId_tabfieldblock",true);
	$xt->assign("company_CompanyId_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_CompanyId_label","<label for=\"".GetInputElementId("company_CompanyId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("company_CompanyName"))
		$xt->assign("company_CompanyName_fieldblock",true);
	else
		$xt->assign("company_CompanyName_tabfieldblock",true);
	$xt->assign("company_CompanyName_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_CompanyName_label","<label for=\"".GetInputElementId("company_CompanyName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("company_AddressId"))
		$xt->assign("company_AddressId_fieldblock",true);
	else
		$xt->assign("company_AddressId_tabfieldblock",true);
	$xt->assign("company_AddressId_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_AddressId_label","<label for=\"".GetInputElementId("company_AddressId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("company_Remark"))
		$xt->assign("company_Remark_fieldblock",true);
	else
		$xt->assign("company_Remark_tabfieldblock",true);
	$xt->assign("company_Remark_label",true);
	if(isEnableSection508())
		$xt->assign_section("company_Remark_label","<label for=\"".GetInputElementId("company_Remark", $id, PAGE_ADD)."\">","</label>");
	
	
	
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$pageObject->body["begin"] .= $includes;
				$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
		$xt->assign("back_button",true);
	}
	else
	{		
		$xt->assign("cancelbutton_attrs", "id=\"cancelButton".$id."\"");
		$xt->assign("cancel_button",true);
		$xt->assign("header","");
	}
	$xt->assign("save_button",true);
}
$xt->assign("savebutton_attrs","id=\"saveButton".$id."\"");
$xt->assign("message_block",true);
$xt->assign("message",$message);
if(!strlen($message))
{
	$xt->displayBrickHidden("message");
}

//	show readonly fields
	$pageObject->readOnlyFields["Gender"] = htmlspecialchars($pageObject->showDBValue("Gender", $defvalues));
$linkdata="";

$i = 0;
$jsKeys = array();
$keyFields = array();
foreach($keys as $field=>$value)
{
	$keyFields[$i] = $field;
	$jsKeys[$i++] = $value;
}

if(@$_POST["a"]=="added" && $inlineadd==ADD_ONTHEFLY)
{
	if( !$error_happened && $status!="DECLINED")
	{
		$addedData = GetAddedDataLookupQuery($pageObject, $keys, false);
		$data =& $addedData[0];	
		
		if($data)
		{
			$respData = array($addedData[1]["linkField"] => @$data[$addedData[1]["linkFieldIndex"]], $addedData[1]["displayField"] => @$data[$addedData[1]["displayFieldIndex"]]);
		}
		else
		{
			$respData = array($addedData[1]["linkField"] => @$avalues[$addedData[1]["linkField"]], $addedData[1]["displayField"] => @$avalues[$addedData[1]["displayField"]]);
		}		
		$returnJSON['success'] = true;
		$returnJSON['keys'] = $jsKeys;
		$returnJSON['keyFields'] = $keyFields;
		$returnJSON['vals'] = $respData;
		$returnJSON['fields'] = $showFields;
	}
	else
	{
		$returnJSON['success'] = false;
		$returnJSON['message'] = $message;
	}
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
}

if(@$_POST["a"]=="added" && ($inlineadd == ADD_INLINE || $inlineadd == ADD_MASTER || $inlineadd==ADD_POPUP)) 
{
	//Preparation   view values
	//	get current values and show edit controls
	$dispFieldAlias = "";
	$data=0;
	$linkAndDispVals = array();
	if(count($keys))
	{
		$where=KeyWhere($keys);
		//	select only owned records
		$where=whereAdd($where,SecuritySQL("Search"));
		
		$forLookup = postvalue('forLookup');
		if ($forLookup)
		{
			$addedData = GetAddedDataLookupQuery($pageObject, $keys, true);
			$data =& $addedData[0];
			$linkAndDispVals = array('linkField' => $addedData[0][$addedData[1]["linkField"]], 'displayField' => $addedData[0][$addedData[1]["displayField"]]);
		}
		else
		{
			$strSQL = $gQuery->gSQLWhere_having_fromQuery('', $where, '');		
		
			LogInfo($strSQL);
			$rs=db_query($strSQL,$conn);
			$data = $pageObject->cipherer->DecryptFetchedArray($rs);
		}
	}
	if(!$data)
	{
		$data=$avalues;
		$HaveData=false;
	}
	//check if correct values added

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));
	
////////////////////////////////////////////
//	TitleId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("TitleId", $data, $keylink);
		$showValues["TitleId"] = $value;
		$showFields[] = "TitleId";
	}	
//	Photo
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Photo", $data, $keylink);
		$showValues["Photo"] = $value;
		$showFields[] = "Photo";
	}	
//	FirstName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("FirstName", $data, $keylink);
		$showValues["FirstName"] = $value;
		$showFields[] = "FirstName";
	}	
//	LastName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("LastName", $data, $keylink);
		$showValues["LastName"] = $value;
		$showFields[] = "LastName";
	}	
//	MiddleName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("MiddleName", $data, $keylink);
		$showValues["MiddleName"] = $value;
		$showFields[] = "MiddleName";
	}	
//	Gender
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Gender", $data, $keylink);
		$showValues["Gender"] = $value;
		$showFields[] = "Gender";
	}	
//	DateOfBirth
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DateOfBirth", $data, $keylink);
		$showValues["DateOfBirth"] = $value;
		$showFields[] = "DateOfBirth";
	}	
//	MaritalStatusId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("MaritalStatusId", $data, $keylink);
		$showValues["MaritalStatusId"] = $value;
		$showFields[] = "MaritalStatusId";
	}	
//	DateofMarriage
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DateofMarriage", $data, $keylink);
		$showValues["DateofMarriage"] = $value;
		$showFields[] = "DateofMarriage";
	}	
//	SpouseDevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("SpouseDevoteeId", $data, $keylink);
		$showValues["SpouseDevoteeId"] = $value;
		$showFields[] = "SpouseDevoteeId";
	}	
//	MobilePhone
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("MobilePhone", $data, $keylink);
		$showValues["MobilePhone"] = $value;
		$showFields[] = "MobilePhone";
	}	
//	WorkPhone
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("WorkPhone", $data, $keylink);
		$showValues["WorkPhone"] = $value;
		$showFields[] = "WorkPhone";
	}	
//	EmailPrimary
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("EmailPrimary", $data, $keylink);
		$showValues["EmailPrimary"] = $value;
		$showFields[] = "EmailPrimary";
	}	
//	EmailSecondary
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("EmailSecondary", $data, $keylink);
		$showValues["EmailSecondary"] = $value;
		$showFields[] = "EmailSecondary";
	}	
//	Password
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Password", $data, $keylink);
		$showValues["Password"] = $value;
		$showFields[] = "Password";
	}	
//	address_AddressLine1
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_AddressLine1", $data, $keylink);
		$showValues["address_AddressLine1"] = $value;
		$showFields[] = "address_AddressLine1";
	}	
//	address_AddressLine2
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_AddressLine2", $data, $keylink);
		$showValues["address_AddressLine2"] = $value;
		$showFields[] = "address_AddressLine2";
	}	
//	address_City
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_City", $data, $keylink);
		$showValues["address_City"] = $value;
		$showFields[] = "address_City";
	}	
//	address_State
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_State", $data, $keylink);
		$showValues["address_State"] = $value;
		$showFields[] = "address_State";
	}	
//	address_Country
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_Country", $data, $keylink);
		$showValues["address_Country"] = $value;
		$showFields[] = "address_Country";
	}	
//	address_Pincode
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_Pincode", $data, $keylink);
		$showValues["address_Pincode"] = $value;
		$showFields[] = "address_Pincode";
	}	
//	address_IsVerified
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_IsVerified", $data, $keylink);
		$showValues["address_IsVerified"] = $value;
		$showFields[] = "address_IsVerified";
	}	
//	address_IsWrong
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_IsWrong", $data, $keylink);
		$showValues["address_IsWrong"] = $value;
		$showFields[] = "address_IsWrong";
	}	
//	address_AddressTypeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("address_AddressTypeId", $data, $keylink);
		$showValues["address_AddressTypeId"] = $value;
		$showFields[] = "address_AddressTypeId";
	}	
//	Occupational_DevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Occupational_DevoteeId", $data, $keylink);
		$showValues["Occupational_DevoteeId"] = $value;
		$showFields[] = "Occupational_DevoteeId";
	}	
//	Occupational_Education
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Occupational_Education", $data, $keylink);
		$showValues["Occupational_Education"] = $value;
		$showFields[] = "Occupational_Education";
	}	
//	Occupational_Occupation
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Occupational_Occupation", $data, $keylink);
		$showValues["Occupational_Occupation"] = $value;
		$showFields[] = "Occupational_Occupation";
	}	
//	Occupational_Designation
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Occupational_Designation", $data, $keylink);
		$showValues["Occupational_Designation"] = $value;
		$showFields[] = "Occupational_Designation";
	}	
//	Occupational_AwardsOrMerits
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Occupational_AwardsOrMerits", $data, $keylink);
		$showValues["Occupational_AwardsOrMerits"] = $value;
		$showFields[] = "Occupational_AwardsOrMerits";
	}	
//	occupational_SkillsOrExperiences
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("occupational_SkillsOrExperiences", $data, $keylink);
		$showValues["occupational_SkillsOrExperiences"] = $value;
		$showFields[] = "occupational_SkillsOrExperiences";
	}	
//	occupational_CurrentCompanyId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("occupational_CurrentCompanyId", $data, $keylink);
		$showValues["occupational_CurrentCompanyId"] = $value;
		$showFields[] = "occupational_CurrentCompanyId";
	}	
//	organization_OrgId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("organization_OrgId", $data, $keylink);
		$showValues["organization_OrgId"] = $value;
		$showFields[] = "organization_OrgId";
	}	
//	organization_OrgName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("organization_OrgName", $data, $keylink);
		$showValues["organization_OrgName"] = $value;
		$showFields[] = "organization_OrgName";
	}	
//	organization_OrgOwnerId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("organization_OrgOwnerId", $data, $keylink);
		$showValues["organization_OrgOwnerId"] = $value;
		$showFields[] = "organization_OrgOwnerId";
	}	
//	organization_OrgLeaderId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("organization_OrgLeaderId", $data, $keylink);
		$showValues["organization_OrgLeaderId"] = $value;
		$showFields[] = "organization_OrgLeaderId";
	}	
//	organization_Location
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("organization_Location", $data, $keylink);
		$showValues["organization_Location"] = $value;
		$showFields[] = "organization_Location";
	}	
//	spirituallife_SpiritulLifeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_SpiritulLifeId", $data, $keylink);
		$showValues["spirituallife_SpiritulLifeId"] = $value;
		$showFields[] = "spirituallife_SpiritulLifeId";
	}	
//	SpiritualLife_DevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("SpiritualLife_DevoteeId", $data, $keylink);
		$showValues["SpiritualLife_DevoteeId"] = $value;
		$showFields[] = "SpiritualLife_DevoteeId";
	}	
//	spirituallife_DateOfHarinamInitiation
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_DateOfHarinamInitiation", $data, $keylink);
		$showValues["spirituallife_DateOfHarinamInitiation"] = $value;
		$showFields[] = "spirituallife_DateOfHarinamInitiation";
	}	
//	spirituallife_DateOfBrahmanInitiation
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_DateOfBrahmanInitiation", $data, $keylink);
		$showValues["spirituallife_DateOfBrahmanInitiation"] = $value;
		$showFields[] = "spirituallife_DateOfBrahmanInitiation";
	}	
//	spirituallife_SpiritualMasterDevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_SpiritualMasterDevoteeId", $data, $keylink);
		$showValues["spirituallife_SpiritualMasterDevoteeId"] = $value;
		$showFields[] = "spirituallife_SpiritualMasterDevoteeId";
	}	
//	spirituallife_PreviousReligion
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_PreviousReligion", $data, $keylink);
		$showValues["spirituallife_PreviousReligion"] = $value;
		$showFields[] = "spirituallife_PreviousReligion";
	}	
//	spirituallife_Chanting16RoundsSince
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_Chanting16RoundsSince", $data, $keylink);
		$showValues["spirituallife_Chanting16RoundsSince"] = $value;
		$showFields[] = "spirituallife_Chanting16RoundsSince";
	}	
//	spirituallife_IntroducedBy
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_IntroducedBy", $data, $keylink);
		$showValues["spirituallife_IntroducedBy"] = $value;
		$showFields[] = "spirituallife_IntroducedBy";
	}	
//	spirituallife_YearOfIntroduction
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_YearOfIntroduction", $data, $keylink);
		$showValues["spirituallife_YearOfIntroduction"] = $value;
		$showFields[] = "spirituallife_YearOfIntroduction";
	}	
//	spirituallife_IntroducedInCenter
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_IntroducedInCenter", $data, $keylink);
		$showValues["spirituallife_IntroducedInCenter"] = $value;
		$showFields[] = "spirituallife_IntroducedInCenter";
	}	
//	spirituallife_PreferedServices
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_PreferedServices", $data, $keylink);
		$showValues["spirituallife_PreferedServices"] = $value;
		$showFields[] = "spirituallife_PreferedServices";
	}	
//	spirituallife_SericesRendered
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("spirituallife_SericesRendered", $data, $keylink);
		$showValues["spirituallife_SericesRendered"] = $value;
		$showFields[] = "spirituallife_SericesRendered";
	}	
//	devoteeaddress_DevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteeaddress_DevoteeId", $data, $keylink);
		$showValues["devoteeaddress_DevoteeId"] = $value;
		$showFields[] = "devoteeaddress_DevoteeId";
	}	
//	devoteeaddress_AddressId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteeaddress_AddressId", $data, $keylink);
		$showValues["devoteeaddress_AddressId"] = $value;
		$showFields[] = "devoteeaddress_AddressId";
	}	
//	devoteelang_DevoteeLanguageId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteelang_DevoteeLanguageId", $data, $keylink);
		$showValues["devoteelang_DevoteeLanguageId"] = $value;
		$showFields[] = "devoteelang_DevoteeLanguageId";
	}	
//	devoteelang_DevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteelang_DevoteeId", $data, $keylink);
		$showValues["devoteelang_DevoteeId"] = $value;
		$showFields[] = "devoteelang_DevoteeId";
	}	
//	devoteelang_LanguageId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteelang_LanguageId", $data, $keylink);
		$showValues["devoteelang_LanguageId"] = $value;
		$showFields[] = "devoteelang_LanguageId";
	}	
//	devoteelang_SpeakingLevel
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteelang_SpeakingLevel", $data, $keylink);
		$showValues["devoteelang_SpeakingLevel"] = $value;
		$showFields[] = "devoteelang_SpeakingLevel";
	}	
//	devoteelang_ReadingLevel
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteelang_ReadingLevel", $data, $keylink);
		$showValues["devoteelang_ReadingLevel"] = $value;
		$showFields[] = "devoteelang_ReadingLevel";
	}	
//	devoteelang_WritingLevel
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteelang_WritingLevel", $data, $keylink);
		$showValues["devoteelang_WritingLevel"] = $value;
		$showFields[] = "devoteelang_WritingLevel";
	}	
//	addresstypes_AddressType
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("addresstypes_AddressType", $data, $keylink);
		$showValues["addresstypes_AddressType"] = $value;
		$showFields[] = "addresstypes_AddressType";
	}	
//	addresstypes_AddressTypeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("addresstypes_AddressTypeId", $data, $keylink);
		$showValues["addresstypes_AddressTypeId"] = $value;
		$showFields[] = "addresstypes_AddressTypeId";
	}	
//	devoteeaddress_devoteeaddressId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("devoteeaddress_devoteeaddressId", $data, $keylink);
		$showValues["devoteeaddress_devoteeaddressId"] = $value;
		$showFields[] = "devoteeaddress_devoteeaddressId";
	}	
//	Address_AddressId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Address_AddressId", $data, $keylink);
		$showValues["Address_AddressId"] = $value;
		$showFields[] = "Address_AddressId";
	}	
//	occupational_DevoteeOccupationalId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("occupational_DevoteeOccupationalId", $data, $keylink);
		$showValues["occupational_DevoteeOccupationalId"] = $value;
		$showFields[] = "occupational_DevoteeOccupationalId";
	}	
//	DevoteeOrg_DevoteeOrgId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DevoteeOrg_DevoteeOrgId", $data, $keylink);
		$showValues["DevoteeOrg_DevoteeOrgId"] = $value;
		$showFields[] = "DevoteeOrg_DevoteeOrgId";
	}	
//	DevoteeOrg_OrgId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DevoteeOrg_OrgId", $data, $keylink);
		$showValues["DevoteeOrg_OrgId"] = $value;
		$showFields[] = "DevoteeOrg_OrgId";
	}	
//	DevoteeOrg_DevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DevoteeOrg_DevoteeId", $data, $keylink);
		$showValues["DevoteeOrg_DevoteeId"] = $value;
		$showFields[] = "DevoteeOrg_DevoteeId";
	}	
//	DevoteeOrg_FromDate
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DevoteeOrg_FromDate", $data, $keylink);
		$showValues["DevoteeOrg_FromDate"] = $value;
		$showFields[] = "DevoteeOrg_FromDate";
	}	
//	DevoteeOrg_ToDate
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DevoteeOrg_ToDate", $data, $keylink);
		$showValues["DevoteeOrg_ToDate"] = $value;
		$showFields[] = "DevoteeOrg_ToDate";
	}	
//	DevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DevoteeId", $data, $keylink);
		$showValues["DevoteeId"] = $value;
		$showFields[] = "DevoteeId";
	}	
//	company_CompanyId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("company_CompanyId", $data, $keylink);
		$showValues["company_CompanyId"] = $value;
		$showFields[] = "company_CompanyId";
	}	
//	company_CompanyName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("company_CompanyName", $data, $keylink);
		$showValues["company_CompanyName"] = $value;
		$showFields[] = "company_CompanyName";
	}	
//	company_AddressId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("company_AddressId", $data, $keylink);
		$showValues["company_AddressId"] = $value;
		$showFields[] = "company_AddressId";
	}	
//	company_Remark
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("company_Remark", $data, $keylink);
		$showValues["company_Remark"] = $value;
		$showFields[] = "company_Remark";
	}	
		$showRawValues["TitleId"] = substr($data["TitleId"],0,100);
		$showRawValues["Photo"] = "";
		$showRawValues["FirstName"] = substr($data["FirstName"],0,100);
		$showRawValues["LastName"] = substr($data["LastName"],0,100);
		$showRawValues["MiddleName"] = substr($data["MiddleName"],0,100);
		$showRawValues["Gender"] = substr($data["Gender"],0,100);
		$showRawValues["DateOfBirth"] = substr($data["DateOfBirth"],0,100);
		$showRawValues["MaritalStatusId"] = substr($data["MaritalStatusId"],0,100);
		$showRawValues["DateofMarriage"] = substr($data["DateofMarriage"],0,100);
		$showRawValues["SpouseDevoteeId"] = substr($data["SpouseDevoteeId"],0,100);
		$showRawValues["MobilePhone"] = substr($data["MobilePhone"],0,100);
		$showRawValues["WorkPhone"] = substr($data["WorkPhone"],0,100);
		$showRawValues["EmailPrimary"] = substr($data["EmailPrimary"],0,100);
		$showRawValues["EmailSecondary"] = substr($data["EmailSecondary"],0,100);
		$showRawValues["Password"] = substr($data["Password"],0,100);
		$showRawValues["address_AddressLine1"] = substr($data["address_AddressLine1"],0,100);
		$showRawValues["address_AddressLine2"] = substr($data["address_AddressLine2"],0,100);
		$showRawValues["address_City"] = substr($data["address_City"],0,100);
		$showRawValues["address_State"] = substr($data["address_State"],0,100);
		$showRawValues["address_Country"] = substr($data["address_Country"],0,100);
		$showRawValues["address_Pincode"] = substr($data["address_Pincode"],0,100);
		$showRawValues["address_IsVerified"] = substr($data["address_IsVerified"],0,100);
		$showRawValues["address_IsWrong"] = substr($data["address_IsWrong"],0,100);
		$showRawValues["address_AddressTypeId"] = substr($data["address_AddressTypeId"],0,100);
		$showRawValues["Occupational_DevoteeId"] = substr($data["Occupational_DevoteeId"],0,100);
		$showRawValues["Occupational_Education"] = substr($data["Occupational_Education"],0,100);
		$showRawValues["Occupational_Occupation"] = substr($data["Occupational_Occupation"],0,100);
		$showRawValues["Occupational_Designation"] = substr($data["Occupational_Designation"],0,100);
		$showRawValues["Occupational_AwardsOrMerits"] = substr($data["Occupational_AwardsOrMerits"],0,100);
		$showRawValues["occupational_SkillsOrExperiences"] = substr($data["occupational_SkillsOrExperiences"],0,100);
		$showRawValues["occupational_CurrentCompanyId"] = substr($data["occupational_CurrentCompanyId"],0,100);
		$showRawValues["organization_OrgId"] = substr($data["organization_OrgId"],0,100);
		$showRawValues["organization_OrgName"] = substr($data["organization_OrgName"],0,100);
		$showRawValues["organization_OrgOwnerId"] = substr($data["organization_OrgOwnerId"],0,100);
		$showRawValues["organization_OrgLeaderId"] = substr($data["organization_OrgLeaderId"],0,100);
		$showRawValues["organization_Location"] = substr($data["organization_Location"],0,100);
		$showRawValues["spirituallife_SpiritulLifeId"] = substr($data["spirituallife_SpiritulLifeId"],0,100);
		$showRawValues["SpiritualLife_DevoteeId"] = substr($data["SpiritualLife_DevoteeId"],0,100);
		$showRawValues["spirituallife_DateOfHarinamInitiation"] = substr($data["spirituallife_DateOfHarinamInitiation"],0,100);
		$showRawValues["spirituallife_DateOfBrahmanInitiation"] = substr($data["spirituallife_DateOfBrahmanInitiation"],0,100);
		$showRawValues["spirituallife_SpiritualMasterDevoteeId"] = substr($data["spirituallife_SpiritualMasterDevoteeId"],0,100);
		$showRawValues["spirituallife_PreviousReligion"] = substr($data["spirituallife_PreviousReligion"],0,100);
		$showRawValues["spirituallife_Chanting16RoundsSince"] = substr($data["spirituallife_Chanting16RoundsSince"],0,100);
		$showRawValues["spirituallife_IntroducedBy"] = substr($data["spirituallife_IntroducedBy"],0,100);
		$showRawValues["spirituallife_YearOfIntroduction"] = substr($data["spirituallife_YearOfIntroduction"],0,100);
		$showRawValues["spirituallife_IntroducedInCenter"] = substr($data["spirituallife_IntroducedInCenter"],0,100);
		$showRawValues["spirituallife_PreferedServices"] = substr($data["spirituallife_PreferedServices"],0,100);
		$showRawValues["spirituallife_SericesRendered"] = substr($data["spirituallife_SericesRendered"],0,100);
		$showRawValues["devoteeaddress_DevoteeId"] = substr($data["devoteeaddress_DevoteeId"],0,100);
		$showRawValues["devoteeaddress_AddressId"] = substr($data["devoteeaddress_AddressId"],0,100);
		$showRawValues["devoteelang_DevoteeLanguageId"] = substr($data["devoteelang_DevoteeLanguageId"],0,100);
		$showRawValues["devoteelang_DevoteeId"] = substr($data["devoteelang_DevoteeId"],0,100);
		$showRawValues["devoteelang_LanguageId"] = substr($data["devoteelang_LanguageId"],0,100);
		$showRawValues["devoteelang_SpeakingLevel"] = substr($data["devoteelang_SpeakingLevel"],0,100);
		$showRawValues["devoteelang_ReadingLevel"] = substr($data["devoteelang_ReadingLevel"],0,100);
		$showRawValues["devoteelang_WritingLevel"] = substr($data["devoteelang_WritingLevel"],0,100);
		$showRawValues["addresstypes_AddressType"] = substr($data["addresstypes_AddressType"],0,100);
		$showRawValues["addresstypes_AddressTypeId"] = substr($data["addresstypes_AddressTypeId"],0,100);
		$showRawValues["devoteeaddress_devoteeaddressId"] = substr($data["devoteeaddress_devoteeaddressId"],0,100);
		$showRawValues["Address_AddressId"] = substr($data["Address_AddressId"],0,100);
		$showRawValues["occupational_DevoteeOccupationalId"] = substr($data["occupational_DevoteeOccupationalId"],0,100);
		$showRawValues["DevoteeOrg_DevoteeOrgId"] = substr($data["DevoteeOrg_DevoteeOrgId"],0,100);
		$showRawValues["DevoteeOrg_OrgId"] = substr($data["DevoteeOrg_OrgId"],0,100);
		$showRawValues["DevoteeOrg_DevoteeId"] = substr($data["DevoteeOrg_DevoteeId"],0,100);
		$showRawValues["DevoteeOrg_FromDate"] = substr($data["DevoteeOrg_FromDate"],0,100);
		$showRawValues["DevoteeOrg_ToDate"] = substr($data["DevoteeOrg_ToDate"],0,100);
		$showRawValues["DevoteeId"] = substr($data["DevoteeId"],0,100);
		$showRawValues["company_CompanyId"] = substr($data["company_CompanyId"],0,100);
		$showRawValues["company_CompanyName"] = substr($data["company_CompanyName"],0,100);
		$showRawValues["company_AddressId"] = substr($data["company_AddressId"],0,100);
		$showRawValues["company_Remark"] = substr($data["company_Remark"],0,100);
	
	// for custom expression for display field
	if ($dispFieldAlias)
	{
		$showValues[] = $data[$dispFieldAlias];	
		$showFields[] = $dispFieldAlias;
		$showRawValues[] = substr($data[$dispFieldAlias],0,100);
	}
	
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_POPUP)
	{	
		if($IsSaved && count($showValues))
		{
			$returnJSON['success'] = true;
			if($HaveData){
				$returnJSON['noKeys'] = false;
			}else{
				$returnJSON['noKeys'] = true;
			}
			
			$returnJSON['keys'] = $jsKeys;
			$returnJSON['keyFields'] = $keyFields;
			$returnJSON['vals'] = $showValues;
			$returnJSON['fields'] = $showFields;
			$returnJSON['rawVals'] = $showRawValues;
			$returnJSON['detKeys'] = $showDetailKeys;
			$returnJSON['userMess'] = $usermessage;
			$returnJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
			// add link and display value if list page is lookup with search
			if(array_key_exists('linkField', $linkAndDispVals))
			{
				$returnJSON['linkValue'] = $linkAndDispVals['linkField'];
				$returnJSON['displayValue'] = $linkAndDispVals['displayField'];
			}
			if($globalEvents->exists("IsRecordEditable", $strTableName))
			{ 
				if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
					$returnJSON['nonEditable'] = true;
			}
			
			if($inlineadd==ADD_POPUP && isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
				$returnJSON['hideCaptcha'] = true;
		}
		else
		{
			$returnJSON['success'] = false;
			$returnJSON['message'] = $message;
			if(!$pageObject->isCaptchaOk)
				$returnJSON['captcha'] = false;
		}
		echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
		exit();
	}
} 

/////////////////////////////////////////////////////////////
if($inlineadd==ADD_MASTER)
{
	$respJSON = array();
	if(($_POST["a"]=="added" && $IsSaved))
	{
		$respJSON['afterAddId'] = $afterAdd_id;
		$respJSON['success'] = true;
		$respJSON['fields'] = $showFields;
		$respJSON['vals'] = $showValues;
		if($onFly){
			if($HaveData)
				$respJSON['noKeys'] = false;
			else
				$respJSON['noKeys'] = true;
			$respJSON['keys'] = $jsKeys;
			$respJSON['keyFields'] = $keyFields;
			$respJSON['rawVals'] = $showRawValues;
			$respJSON['detKeys'] = $showDetailKeys;
			$respJSON['userMess'] = $usermessage;
			$respJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
			if($globalEvents->exists("IsRecordEditable", $strTableName))
			{
				if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
					$respJSON['nonEditable'] = true;
			}
		}
		$respJSON['mKeys'] = array();
		for($i=0;$i<count($dpParams['ids']);$i++)
		{
			$data=0;
			if(count($keys))
			{
				$where=KeyWhere($keys);
							//	select only owned records
				$where=whereAdd($where,SecuritySQL("Search"));
				$strSQL = $gQuery->gSQLWhere($where);
				LogInfo($strSQL);
				$rs = db_query($strSQL,$conn);
				$data = $pageObject->cipherer->DecryptFetchedArray($rs);
			}
			if(!$data)
				$data=$avalues;
			
			$mKeyId = 1;
			foreach($mKeys[$dpParams['strTableNames'][$i]] as $mk)
			{
				if($data[$mk])
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = $data[$mk];
				else
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = '';
			}
		}
		if(isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
			$respJSON['hidecaptcha'] = true;
	}
	else{
			$respJSON['success'] = false;
			if(!$pageObject->isCaptchaOk)
				$respJSON['captcha'] = false;
			else
				$respJSON['error'] = $message;
			if($onFly)
				$respJSON['message'] = $message;
		}
	echo "<textarea>".htmlspecialchars(my_json_encode($respJSON))."</textarea>";
	exit();
}

/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////

//	validation stuff
$regex='';
$regexmessage='';
$regextype = '';
$control = array();

foreach($addFields as $fName)
{
	$gfName = GoodFieldName($fName);
	$controls = array('controls'=>array());
	if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))
	{
		$control[$gfName] = array();
		$control[$gfName]["func"] = "xt_buildeditcontrol";
		$control[$gfName]["params"] = array();
		$control[$gfName]["params"]["id"] = $id;
		$control[$gfName]["params"]["ptype"] = PAGE_ADD;
		$control[$gfName]["params"]["field"] = $fName;
		$control[$gfName]["params"]["value"] = @$defvalues[$fName];
		$control[$gfName]["params"]["pageObj"] = $pageObject;
		if($pageObject->pSet->isUseRTE($fName))
			$_SESSION[$strTableName."_".$fName."_rte"] = @$defvalues[$fName];
		
		//	Begin Add validation
		$arrValidate = $pageObject->pSet->getValidation($fName);
		$control[$gfName]["params"]["validate"] = $arrValidate;
		//	End Add validation
	}
	$controls["controls"]['ctrlInd'] = 0;
	$controls["controls"]['id'] = $id;
	$controls["controls"]['fieldName'] = $fName;
	//if richEditor for field
	if($pageObject->pSet->isUseRTE($fName))
	{
		if(!$detailKeys || !in_array($fName, $detailKeys))
			$control[$gfName]["params"]["mode"]="add";
		$controls["controls"]['mode'] = "add";
	}
	else
	{
		if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="inline_add";
			$controls["controls"]['mode'] = "inline_add";
		}
		else
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="add";
			$controls["controls"]['mode'] = "add";
		}
	}
	
	if(!$detailKeys || !in_array($fName, $detailKeys))
		$xt->assignbyref($gfName."_editcontrol",$control[$gfName]);
	elseif($detailKeys && in_array($fName, $detailKeys))
		$controls["controls"]['value'] = @$defvalues[$fName];
	
	// category control field
	$strCategoryControl = $pageObject->isDependOnField($fName);
	
	if($strCategoryControl!==false && in_array($strCategoryControl, $addFields))
		$vals = array($fName => @$defvalues[$fName], $strCategoryControl => @$defvalues[$strCategoryControl]);
	else
		$vals = array($fName => @$defvalues[$fName]);
	
	$preload = $pageObject->fillPreload($fName, $vals);
	if($preload!==false)
	{
		$controls["controls"]['preloadData'] = $preload;
		if(!@$defvalues[$fName] && count($preload["vals"])>0)
			$defvalues[$fName] = $preload["vals"][0];
	}
	$pageObject->fillControlsMap($controls);
	
	//fill field tool tips
	$pageObject->fillFieldToolTips($fName);
	
	// fill special settings for timepicker
	if($pageObject->pSet->getEditFormat($fName) == 'Time')
		$pageObject->fillTimePickSettings($fName, @$defvalues[$fName]);
	
	if((($detailKeys && in_array($fName, $detailKeys)) || $fName == postvalue("category")) && array_key_exists($fName, $defvalues))
	{
		$value = $pageObject->showDBValue($fName, $defvalues);
		
		$xt->assign($gfName."_editcontrol", $value);
	}
}

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_POPUP) && !isMobile())
{
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
		include("classes/searchclause.php");
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
		$options["masterPageType"] = PAGE_ADD;
		$options["mainMasterPageType"] = PAGE_ADD;
		$options['masterTable'] = "vw_Devotee_full";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
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
		$mkr = 1;
		
		foreach($mKeys[$strTableName] as $mk)
		{
			if($defvalues[$mk])
				$options['masterKeysReq'][$mkr++] = $defvalues[$mk];
			else
				$options['masterKeysReq'][$mkr++] = '';
		}
		$listPageObject = ListPage::createListPage($strTableName,$options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		$flyId = $listPageObject->recId+1;
		
		//set page events
		foreach($listPageObject->eventsObject->events as $event => $name)
			$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
		
		//add detail settings to master settings
		$listPageObject->addControlsJSAndCSS();
		$listPageObject->fillSetCntrlMaps();
		$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];

		$dControlsMap[$strTableName] = $listPageObject->controlsMap;
		$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
		
		foreach($listPageObject->jsSettings["global"]["shortTNames"] as $tName => $shortTName){
			$pageObject->settingsMap["globalSettings"]["shortTNames"][$tName] = $shortTName;
		}
		
		//Add detail's js files to master's files
		$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
		
		//Add detail's css files to master's files
		$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
		
		$xtParams = array("method"=>'showPage', "params"=> false);
		$xtParams['object'] = $listPageObject;
		$xt->assign("displayDetailTable_".GoodFieldName($listPageObject->tName), $xtParams);
		$pageObject->controlsMap['dpTablesParams'][] = array('tName'=>$strTableName, 'id'=>$options['id']);
	}
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap;
	$strTableName = "vw_Devotee_full";
}
/////////////////////////////////////////////////////////////
//fill jsSettings and ControlsHTMLMap
$pageObject->fillSetCntrlMaps();

$pageObject->addCommonJs();

//For mobile version in apple device

if($inlineadd == ADD_SIMPLE)
{
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	$xt->assign("body", $pageObject->body);
	$xt->assign("flybody",true);
}

if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{ 
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("flybody", $pageObject->body);
	$xt->assign("body",true);
}	

$xt->assign("style_block",true);
$pageObject->xt->assign("legend", true);

if($eventObj->exists("BeforeShowAdd"))
	$eventObj->BeforeShowAdd($xt, $templatefile, $pageObject);
	
if($inlineadd != ADD_SIMPLE)
{
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;	
}

if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
{
	$xt->load_template($templatefile);
	$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
	if(count($pageObject->includes_css))
		$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
	if(count($pageObject->includes_cssIE))
		$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON['idStartFrom'] = $id+1;	
	echo (my_json_encode($returnJSON)); 
}
elseif ($inlineadd == ADD_INLINE)
{
	$xt->load_template($templatefile);
	$returnJSON["html"] = array();
	foreach($addFields as $fName)
	{
		$returnJSON["html"][$fName] = $xt->fetchVar(GoodFieldName($fName)."_editcontrol");	
	}	
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON["additionalCSS"] = $pageObject->grabAllCSSFiles();
	echo (my_json_encode($returnJSON)); 
}
else
	$xt->display($templatefile);

function GetAddedDataLookupQuery($pageObject, $keys, $forLookup)
{
	global $conn, $strTableName, $strOriginalTableName;
	
	$LookupSQL = "";
	$linkfield = "";
	$dispfield = "";
	$noBlobReplace = false;
	$lookupFieldName = "";
	
	if($LookupSQL && $nLookupType != LT_QUERY)
		$LookupSQL.=" from ".AddTableWrappers($strOriginalTableName);
		
	$data = 0;
	$lookupIndexes = array("linkFieldIndex" => 0, "displayFieldIndex" => 0);
	if(count($keys))
	{
		$where = KeyWhere($keys);
		if($nLookupType == LT_QUERY){
			$LookupSQL = $lookupQueryObj->toSql(whereAdd($lookupQueryObj->m_where->toSql($lookupQueryObj), $where));
		}else 
			$LookupSQL.=" where ".$where;
		$lookupIndexes = GetLookupFieldsIndexes($lookupPSet, $lookupFieldName);
		LogInfo($LookupSQL);
		if($forLookup){
			$rs=db_query($LookupSQL,$conn);
			$data = $pageObject->cipherer->DecryptFetchedArray($rs);
		}else if($LookupSQL)
		{
			$rs = db_query($LookupSQL,$conn);
			$data = db_fetch_numarray($rs);
			$data[$lookupIndexes["linkFieldIndex"]] = $pageObject->cipherer->DecryptField($linkFieldName, $data[$lookupIndexes["linkFieldIndex"]]);
			if($nLookupType == LT_QUERY)
				$data[$lookupIndexes["displayFieldIndex"]] = $pageObject->cipherer->DecryptField($dispfield, $data[$lookupIndexes["displayFieldIndex"]]);		
		}
	}

	return array($data, array("linkField" => $linkFieldName, "displayField" => $dispfield
		, "linkFieldIndex" => $lookupIndexes["linkFieldIndex"], "displayFieldIndex" => $lookupIndexes["displayFieldIndex"]));
}	
	
?>
