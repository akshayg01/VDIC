<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/vw_counsellee_variables.php");
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
$layout->blocks["top"][] = "details";$page_layouts["vw_counsellee_edit"] = $layout;




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

$templatefile = ($inlineedit == EDIT_INLINE) ? "vw_counsellee_inline_edit.htm" : "vw_counsellee_edit.htm";

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
	$condition = 1;

	if($condition)
	{
		$control_TitleId = $pageObject->getControl("TitleId", $id);
		$control_TitleId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing TitleId - end
//	processing Photo - begin
	$condition = 1;

	if($condition)
	{
		$control_Photo = $pageObject->getControl("Photo", $id);
		$control_Photo->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing Photo - end
//	processing FirstName - begin
	$condition = 1;

	if($condition)
	{
		$control_FirstName = $pageObject->getControl("FirstName", $id);
		$control_FirstName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing FirstName - end
//	processing LastName - begin
	$condition = 1;

	if($condition)
	{
		$control_LastName = $pageObject->getControl("LastName", $id);
		$control_LastName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing LastName - end
//	processing MiddleName - begin
	$condition = 1;

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
	$condition = 1;

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
	$condition = 1;

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
//	processing CounsellorDevoteeID - begin
	$condition = 1;

	if($condition)
	{
		$control_CounsellorDevoteeID = $pageObject->getControl("CounsellorDevoteeID", $id);
		$control_CounsellorDevoteeID->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing CounsellorDevoteeID - end
//	processing DevoteeExtraInfoId - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_DevoteeExtraInfoId = $pageObject->getControl("DevoteeExtraInfoId", $id);
		$control_DevoteeExtraInfoId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeExtraInfoId - end
//	processing DevoteeId1 - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_DevoteeId1 = $pageObject->getControl("DevoteeId1", $id);
		$control_DevoteeId1->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeId1 - end
//	processing NativeCity - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_NativeCity = $pageObject->getControl("NativeCity", $id);
		$control_NativeCity->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing NativeCity - end
//	processing NativeState - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_NativeState = $pageObject->getControl("NativeState", $id);
		$control_NativeState->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing NativeState - end
//	processing BloodGroup - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_BloodGroup = $pageObject->getControl("BloodGroup", $id);
		$control_BloodGroup->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing BloodGroup - end
//	processing FatherName - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_FatherName = $pageObject->getControl("FatherName", $id);
		$control_FatherName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing FatherName - end
//	processing MotherName - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_MotherName = $pageObject->getControl("MotherName", $id);
		$control_MotherName->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing MotherName - end
//	processing DevoteeLanguageId - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_DevoteeLanguageId = $pageObject->getControl("DevoteeLanguageId", $id);
		$control_DevoteeLanguageId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeLanguageId - end
//	processing DevoteeId2 - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_DevoteeId2 = $pageObject->getControl("DevoteeId2", $id);
		$control_DevoteeId2->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing DevoteeId2 - end
//	processing SpeakingLevel - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_SpeakingLevel = $pageObject->getControl("SpeakingLevel", $id);
		$control_SpeakingLevel->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing SpeakingLevel - end
//	processing ReadingLevel - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_ReadingLevel = $pageObject->getControl("ReadingLevel", $id);
		$control_ReadingLevel->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing ReadingLevel - end
//	processing WritingLevel - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_WritingLevel = $pageObject->getControl("WritingLevel", $id);
		$control_WritingLevel->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing WritingLevel - end
//	processing LanguageId - begin
	$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode

	if($condition)
	{
		$control_LanguageId = $pageObject->getControl("LanguageId", $id);
		$control_LanguageId->readWebValue($evalues, $blobfields, $strWhereClause, $oldValuesRead, $efilename_values);

		}
//	processing LanguageId - end

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
							$condition = 1;
			
				if($condition)
				{
					$control_TitleId->afterSuccessfulSave();
				}
	//	processing TitleId - end
			//	processing Photo - begin
							$condition = 1;
			
				if($condition)
				{
					$control_Photo->afterSuccessfulSave();
				}
	//	processing Photo - end
			//	processing FirstName - begin
							$condition = 1;
			
				if($condition)
				{
					$control_FirstName->afterSuccessfulSave();
				}
	//	processing FirstName - end
			//	processing LastName - begin
							$condition = 1;
			
				if($condition)
				{
					$control_LastName->afterSuccessfulSave();
				}
	//	processing LastName - end
			//	processing MiddleName - begin
							$condition = 1;
			
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
							$condition = 1;
			
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
							$condition = 1;
			
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
			//	processing CounsellorDevoteeID - begin
							$condition = 1;
			
				if($condition)
				{
					$control_CounsellorDevoteeID->afterSuccessfulSave();
				}
	//	processing CounsellorDevoteeID - end
			//	processing DevoteeExtraInfoId - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_DevoteeExtraInfoId->afterSuccessfulSave();
				}
	//	processing DevoteeExtraInfoId - end
			//	processing DevoteeId1 - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_DevoteeId1->afterSuccessfulSave();
				}
	//	processing DevoteeId1 - end
			//	processing NativeCity - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_NativeCity->afterSuccessfulSave();
				}
	//	processing NativeCity - end
			//	processing NativeState - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_NativeState->afterSuccessfulSave();
				}
	//	processing NativeState - end
			//	processing BloodGroup - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_BloodGroup->afterSuccessfulSave();
				}
	//	processing BloodGroup - end
			//	processing FatherName - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_FatherName->afterSuccessfulSave();
				}
	//	processing FatherName - end
			//	processing MotherName - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_MotherName->afterSuccessfulSave();
				}
	//	processing MotherName - end
			//	processing DevoteeLanguageId - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_DevoteeLanguageId->afterSuccessfulSave();
				}
	//	processing DevoteeLanguageId - end
			//	processing DevoteeId2 - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_DevoteeId2->afterSuccessfulSave();
				}
	//	processing DevoteeId2 - end
			//	processing SpeakingLevel - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_SpeakingLevel->afterSuccessfulSave();
				}
	//	processing SpeakingLevel - end
			//	processing ReadingLevel - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_ReadingLevel->afterSuccessfulSave();
				}
	//	processing ReadingLevel - end
			//	processing WritingLevel - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_WritingLevel->afterSuccessfulSave();
				}
	//	processing WritingLevel - end
			//	processing LanguageId - begin
							$condition = $inlineedit==EDIT_INLINE;//($inlineedit) inline mode
			
				if($condition)
				{
					$control_LanguageId->afterSuccessfulSave();
				}
	//	processing LanguageId - end
				
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
	header("Location: vw_counsellee_".$pageObject->getPageType().".php?".$keyGetQ);
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
		header("Location: vw_counsellee_list.php?a=return");
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
	$pageObject->readOnlyFields["CounsellorDevoteeID"] = htmlspecialchars($pageObject->showDBValue("CounsellorDevoteeID", $data));

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
	$data["DevoteeExtraInfoId"] = $evalues["DevoteeExtraInfoId"];
	$data["DevoteeId1"] = $evalues["DevoteeId1"];
	$data["NativeCity"] = $evalues["NativeCity"];
	$data["NativeState"] = $evalues["NativeState"];
	$data["BloodGroup"] = $evalues["BloodGroup"];
	$data["FatherName"] = $evalues["FatherName"];
	$data["MotherName"] = $evalues["MotherName"];
	$data["DevoteeLanguageId"] = $evalues["DevoteeLanguageId"];
	$data["DevoteeId2"] = $evalues["DevoteeId2"];
	$data["SpeakingLevel"] = $evalues["SpeakingLevel"];
	$data["ReadingLevel"] = $evalues["ReadingLevel"];
	$data["WritingLevel"] = $evalues["WritingLevel"];
	$data["LanguageId"] = $evalues["LanguageId"];
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
		
	if(!$pageObject->isAppearOnTabs("CounsellorDevoteeID"))
		$xt->assign("CounsellorDevoteeID_fieldblock",true);
	else
		$xt->assign("CounsellorDevoteeID_tabfieldblock",true);
	$xt->assign("CounsellorDevoteeID_label",true);
	if(isEnableSection508())
		$xt->assign_section("CounsellorDevoteeID_label","<label for=\"".GetInputElementId("CounsellorDevoteeID", $id, PAGE_EDIT)."\">","</label>");
		

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


//	DevoteeId - 
	$value = $pageObject->showDBValue("DevoteeId", $data, $keylink);
	$showValues["DevoteeId"] = $value;
	$showFields[] = "DevoteeId";
		$showRawValues["DevoteeId"] = substr($data["DevoteeId"],0,100);

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

//	active - 
	$value = $pageObject->showDBValue("active", $data, $keylink);
	$showValues["active"] = $value;
	$showFields[] = "active";
		$showRawValues["active"] = substr($data["active"],0,100);

//	CounsellorDevoteeID - 
	$value = $pageObject->showDBValue("CounsellorDevoteeID", $data, $keylink);
	$showValues["CounsellorDevoteeID"] = $value;
	$showFields[] = "CounsellorDevoteeID";
		$showRawValues["CounsellorDevoteeID"] = substr($data["CounsellorDevoteeID"],0,100);

//	IsCounsellor - 
	$value = $pageObject->showDBValue("IsCounsellor", $data, $keylink);
	$showValues["IsCounsellor"] = $value;
	$showFields[] = "IsCounsellor";
		$showRawValues["IsCounsellor"] = substr($data["IsCounsellor"],0,100);

//	DevoteeExtraInfoId - 
	$value = $pageObject->showDBValue("DevoteeExtraInfoId", $data, $keylink);
	$showValues["DevoteeExtraInfoId"] = $value;
	$showFields[] = "DevoteeExtraInfoId";
		$showRawValues["DevoteeExtraInfoId"] = substr($data["DevoteeExtraInfoId"],0,100);

//	DevoteeId1 - 
	$value = $pageObject->showDBValue("DevoteeId1", $data, $keylink);
	$showValues["DevoteeId1"] = $value;
	$showFields[] = "DevoteeId1";
		$showRawValues["DevoteeId1"] = substr($data["DevoteeId1"],0,100);

//	NativeCity - 
	$value = $pageObject->showDBValue("NativeCity", $data, $keylink);
	$showValues["NativeCity"] = $value;
	$showFields[] = "NativeCity";
		$showRawValues["NativeCity"] = substr($data["NativeCity"],0,100);

//	NativeState - 
	$value = $pageObject->showDBValue("NativeState", $data, $keylink);
	$showValues["NativeState"] = $value;
	$showFields[] = "NativeState";
		$showRawValues["NativeState"] = substr($data["NativeState"],0,100);

//	BloodGroup - 
	$value = $pageObject->showDBValue("BloodGroup", $data, $keylink);
	$showValues["BloodGroup"] = $value;
	$showFields[] = "BloodGroup";
		$showRawValues["BloodGroup"] = substr($data["BloodGroup"],0,100);

//	FatherName - 
	$value = $pageObject->showDBValue("FatherName", $data, $keylink);
	$showValues["FatherName"] = $value;
	$showFields[] = "FatherName";
		$showRawValues["FatherName"] = substr($data["FatherName"],0,100);

//	MotherName - 
	$value = $pageObject->showDBValue("MotherName", $data, $keylink);
	$showValues["MotherName"] = $value;
	$showFields[] = "MotherName";
		$showRawValues["MotherName"] = substr($data["MotherName"],0,100);

//	DevoteeLanguageId - 
	$value = $pageObject->showDBValue("DevoteeLanguageId", $data, $keylink);
	$showValues["DevoteeLanguageId"] = $value;
	$showFields[] = "DevoteeLanguageId";
		$showRawValues["DevoteeLanguageId"] = substr($data["DevoteeLanguageId"],0,100);

//	DevoteeId2 - 
	$value = $pageObject->showDBValue("DevoteeId2", $data, $keylink);
	$showValues["DevoteeId2"] = $value;
	$showFields[] = "DevoteeId2";
		$showRawValues["DevoteeId2"] = substr($data["DevoteeId2"],0,100);

//	SpeakingLevel - 
	$value = $pageObject->showDBValue("SpeakingLevel", $data, $keylink);
	$showValues["SpeakingLevel"] = $value;
	$showFields[] = "SpeakingLevel";
		$showRawValues["SpeakingLevel"] = substr($data["SpeakingLevel"],0,100);

//	ReadingLevel - 
	$value = $pageObject->showDBValue("ReadingLevel", $data, $keylink);
	$showValues["ReadingLevel"] = $value;
	$showFields[] = "ReadingLevel";
		$showRawValues["ReadingLevel"] = substr($data["ReadingLevel"],0,100);

//	WritingLevel - 
	$value = $pageObject->showDBValue("WritingLevel", $data, $keylink);
	$showValues["WritingLevel"] = $value;
	$showFields[] = "WritingLevel";
		$showRawValues["WritingLevel"] = substr($data["WritingLevel"],0,100);

//	LanguageId - 
	$value = $pageObject->showDBValue("LanguageId", $data, $keylink);
	$showValues["LanguageId"] = $value;
	$showFields[] = "LanguageId";
		$showRawValues["LanguageId"] = substr($data["LanguageId"],0,100);
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
		$options['masterTable'] = "vw_counsellee";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")){
			$strTableName = "vw_counsellee";
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
	$strTableName = "vw_counsellee";
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
$xt->assign("viewlink_attrs","id=\"viewButton".$id."\" name=\"viewButton".$id."\" onclick=\"window.location.href='vw_counsellee_view.php?".$viewlink."'\"");
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
