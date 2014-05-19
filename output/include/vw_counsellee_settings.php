<?php
require_once(getabspath("classes/cipherer.php"));
$tdatavw_counsellee = array();
	$tdatavw_counsellee[".NumberOfChars"] = 80; 
	$tdatavw_counsellee[".ShortName"] = "vw_counsellee";
	$tdatavw_counsellee[".OwnerID"] = "CounsellorDevoteeID";
	$tdatavw_counsellee[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsvw_counsellee = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_counsellee["English"] = array();
	$fieldToolTipsvw_counsellee["English"] = array();
	$fieldLabelsvw_counsellee["English"]["Photo"] = "Photo";
	$fieldToolTipsvw_counsellee["English"]["Photo"] = "";
	$fieldLabelsvw_counsellee["English"]["Gender"] = "Gender";
	$fieldToolTipsvw_counsellee["English"]["Gender"] = "";
	$fieldLabelsvw_counsellee["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_counsellee["English"]["DevoteeId"] = "";
	$fieldLabelsvw_counsellee["English"]["TitleId"] = "Title Id";
	$fieldToolTipsvw_counsellee["English"]["TitleId"] = "";
	$fieldLabelsvw_counsellee["English"]["FirstName"] = "First Name";
	$fieldToolTipsvw_counsellee["English"]["FirstName"] = "";
	$fieldLabelsvw_counsellee["English"]["LastName"] = "Last Name";
	$fieldToolTipsvw_counsellee["English"]["LastName"] = "";
	$fieldLabelsvw_counsellee["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsvw_counsellee["English"]["MiddleName"] = "";
	$fieldLabelsvw_counsellee["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsvw_counsellee["English"]["DateOfBirth"] = "";
	$fieldLabelsvw_counsellee["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsvw_counsellee["English"]["MaritalStatusId"] = "";
	$fieldLabelsvw_counsellee["English"]["DateofMarriage"] = "Dateof Marriage";
	$fieldToolTipsvw_counsellee["English"]["DateofMarriage"] = "";
	$fieldLabelsvw_counsellee["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsvw_counsellee["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsvw_counsellee["English"]["MobilePhone"] = "Mobile Phone";
	$fieldToolTipsvw_counsellee["English"]["MobilePhone"] = "";
	$fieldLabelsvw_counsellee["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsvw_counsellee["English"]["WorkPhone"] = "";
	$fieldLabelsvw_counsellee["English"]["EmailPrimary"] = "Email Primary";
	$fieldToolTipsvw_counsellee["English"]["EmailPrimary"] = "";
	$fieldLabelsvw_counsellee["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsvw_counsellee["English"]["EmailSecondary"] = "";
	$fieldLabelsvw_counsellee["English"]["Password"] = "Password";
	$fieldToolTipsvw_counsellee["English"]["Password"] = "";
	$fieldLabelsvw_counsellee["English"]["active"] = "Active";
	$fieldToolTipsvw_counsellee["English"]["active"] = "";
	$fieldLabelsvw_counsellee["English"]["CounsellorDevoteeID"] = "Counsellor Devotee ID";
	$fieldToolTipsvw_counsellee["English"]["CounsellorDevoteeID"] = "";
	$fieldLabelsvw_counsellee["English"]["IsCounsellor"] = "Is Counsellor";
	$fieldToolTipsvw_counsellee["English"]["IsCounsellor"] = "";
	$fieldLabelsvw_counsellee["English"]["DevoteeExtraInfoId"] = "Devotee Extra Info Id";
	$fieldToolTipsvw_counsellee["English"]["DevoteeExtraInfoId"] = "";
	$fieldLabelsvw_counsellee["English"]["DevoteeId1"] = "Devotee Id1";
	$fieldToolTipsvw_counsellee["English"]["DevoteeId1"] = "";
	$fieldLabelsvw_counsellee["English"]["NativeCity"] = "Native City";
	$fieldToolTipsvw_counsellee["English"]["NativeCity"] = "";
	$fieldLabelsvw_counsellee["English"]["NativeState"] = "Native State";
	$fieldToolTipsvw_counsellee["English"]["NativeState"] = "";
	$fieldLabelsvw_counsellee["English"]["BloodGroup"] = "Blood Group";
	$fieldToolTipsvw_counsellee["English"]["BloodGroup"] = "";
	$fieldLabelsvw_counsellee["English"]["FatherName"] = "Father Name";
	$fieldToolTipsvw_counsellee["English"]["FatherName"] = "";
	$fieldLabelsvw_counsellee["English"]["MotherName"] = "Mother Name";
	$fieldToolTipsvw_counsellee["English"]["MotherName"] = "";
	$fieldLabelsvw_counsellee["English"]["DevoteeLanguageId"] = "Devotee Language Id";
	$fieldToolTipsvw_counsellee["English"]["DevoteeLanguageId"] = "";
	$fieldLabelsvw_counsellee["English"]["DevoteeId2"] = "Devotee Id2";
	$fieldToolTipsvw_counsellee["English"]["DevoteeId2"] = "";
	$fieldLabelsvw_counsellee["English"]["SpeakingLevel"] = "Speaking Level";
	$fieldToolTipsvw_counsellee["English"]["SpeakingLevel"] = "";
	$fieldLabelsvw_counsellee["English"]["ReadingLevel"] = "Reading Level";
	$fieldToolTipsvw_counsellee["English"]["ReadingLevel"] = "";
	$fieldLabelsvw_counsellee["English"]["WritingLevel"] = "Writing Level";
	$fieldToolTipsvw_counsellee["English"]["WritingLevel"] = "";
	$fieldLabelsvw_counsellee["English"]["LanguageId"] = "Language Id";
	$fieldToolTipsvw_counsellee["English"]["LanguageId"] = "";
	if (count($fieldToolTipsvw_counsellee["English"]))
		$tdatavw_counsellee[".isUseToolTips"] = true;
}
	
	
	$tdatavw_counsellee[".NCSearch"] = true;



$tdatavw_counsellee[".shortTableName"] = "vw_counsellee";
$tdatavw_counsellee[".nSecOptions"] = 1;
$tdatavw_counsellee[".recsPerRowList"] = 1;
$tdatavw_counsellee[".mainTableOwnerID"] = "CounsellorDevoteeID";
$tdatavw_counsellee[".moveNext"] = 1;
$tdatavw_counsellee[".nType"] = 1;

$tdatavw_counsellee[".strOriginalTableName"] = "devotee";

$tdatavw_counsellee[".hasEncryptedFields"] = true;



$tdatavw_counsellee[".showAddInPopup"] = true;

$tdatavw_counsellee[".showEditInPopup"] = true;

$tdatavw_counsellee[".showViewInPopup"] = true;

$tdatavw_counsellee[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatavw_counsellee[".listAjax"] = true;
else 
	$tdatavw_counsellee[".listAjax"] = false;

	$tdatavw_counsellee[".audit"] = true;

	$tdatavw_counsellee[".locking"] = false;

$tdatavw_counsellee[".listIcons"] = true;
$tdatavw_counsellee[".edit"] = true;
$tdatavw_counsellee[".inlineEdit"] = true;
$tdatavw_counsellee[".inlineAdd"] = true;
$tdatavw_counsellee[".copy"] = true;
$tdatavw_counsellee[".view"] = true;

$tdatavw_counsellee[".exportTo"] = true;

$tdatavw_counsellee[".printFriendly"] = true;

$tdatavw_counsellee[".delete"] = true;

$tdatavw_counsellee[".showSimpleSearchOptions"] = true;

$tdatavw_counsellee[".showSearchPanel"] = true;

if (isMobile())
	$tdatavw_counsellee[".isUseAjaxSuggest"] = false;
else 
	$tdatavw_counsellee[".isUseAjaxSuggest"] = true;

$tdatavw_counsellee[".rowHighlite"] = true;

// button handlers file names

$tdatavw_counsellee[".addPageEvents"] = true;

// use timepicker for search panel
$tdatavw_counsellee[".isUseTimeForSearch"] = false;




$tdatavw_counsellee[".allSearchFields"] = array();

$tdatavw_counsellee[".allSearchFields"][] = "DevoteeId";
$tdatavw_counsellee[".allSearchFields"][] = "TitleId";
$tdatavw_counsellee[".allSearchFields"][] = "FirstName";
$tdatavw_counsellee[".allSearchFields"][] = "LastName";
$tdatavw_counsellee[".allSearchFields"][] = "MiddleName";
$tdatavw_counsellee[".allSearchFields"][] = "Gender";
$tdatavw_counsellee[".allSearchFields"][] = "DateOfBirth";
$tdatavw_counsellee[".allSearchFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".allSearchFields"][] = "DateofMarriage";
$tdatavw_counsellee[".allSearchFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".allSearchFields"][] = "MobilePhone";
$tdatavw_counsellee[".allSearchFields"][] = "WorkPhone";
$tdatavw_counsellee[".allSearchFields"][] = "EmailPrimary";
$tdatavw_counsellee[".allSearchFields"][] = "EmailSecondary";
$tdatavw_counsellee[".allSearchFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".allSearchFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".allSearchFields"][] = "DevoteeId1";
$tdatavw_counsellee[".allSearchFields"][] = "NativeCity";
$tdatavw_counsellee[".allSearchFields"][] = "NativeState";
$tdatavw_counsellee[".allSearchFields"][] = "BloodGroup";
$tdatavw_counsellee[".allSearchFields"][] = "FatherName";
$tdatavw_counsellee[".allSearchFields"][] = "MotherName";
$tdatavw_counsellee[".allSearchFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".allSearchFields"][] = "DevoteeId2";
$tdatavw_counsellee[".allSearchFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".allSearchFields"][] = "ReadingLevel";
$tdatavw_counsellee[".allSearchFields"][] = "WritingLevel";
$tdatavw_counsellee[".allSearchFields"][] = "LanguageId";

$tdatavw_counsellee[".googleLikeFields"][] = "DevoteeId";
$tdatavw_counsellee[".googleLikeFields"][] = "TitleId";
$tdatavw_counsellee[".googleLikeFields"][] = "FirstName";
$tdatavw_counsellee[".googleLikeFields"][] = "LastName";
$tdatavw_counsellee[".googleLikeFields"][] = "MiddleName";
$tdatavw_counsellee[".googleLikeFields"][] = "Gender";
$tdatavw_counsellee[".googleLikeFields"][] = "DateOfBirth";
$tdatavw_counsellee[".googleLikeFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".googleLikeFields"][] = "DateofMarriage";
$tdatavw_counsellee[".googleLikeFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".googleLikeFields"][] = "MobilePhone";
$tdatavw_counsellee[".googleLikeFields"][] = "WorkPhone";
$tdatavw_counsellee[".googleLikeFields"][] = "EmailPrimary";
$tdatavw_counsellee[".googleLikeFields"][] = "EmailSecondary";
$tdatavw_counsellee[".googleLikeFields"][] = "Password";
$tdatavw_counsellee[".googleLikeFields"][] = "active";
$tdatavw_counsellee[".googleLikeFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".googleLikeFields"][] = "IsCounsellor";
$tdatavw_counsellee[".googleLikeFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".googleLikeFields"][] = "DevoteeId1";
$tdatavw_counsellee[".googleLikeFields"][] = "NativeCity";
$tdatavw_counsellee[".googleLikeFields"][] = "NativeState";
$tdatavw_counsellee[".googleLikeFields"][] = "BloodGroup";
$tdatavw_counsellee[".googleLikeFields"][] = "FatherName";
$tdatavw_counsellee[".googleLikeFields"][] = "MotherName";
$tdatavw_counsellee[".googleLikeFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".googleLikeFields"][] = "DevoteeId2";
$tdatavw_counsellee[".googleLikeFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".googleLikeFields"][] = "ReadingLevel";
$tdatavw_counsellee[".googleLikeFields"][] = "WritingLevel";
$tdatavw_counsellee[".googleLikeFields"][] = "LanguageId";


$tdatavw_counsellee[".advSearchFields"][] = "DevoteeId";
$tdatavw_counsellee[".advSearchFields"][] = "TitleId";
$tdatavw_counsellee[".advSearchFields"][] = "FirstName";
$tdatavw_counsellee[".advSearchFields"][] = "LastName";
$tdatavw_counsellee[".advSearchFields"][] = "MiddleName";
$tdatavw_counsellee[".advSearchFields"][] = "Gender";
$tdatavw_counsellee[".advSearchFields"][] = "DateOfBirth";
$tdatavw_counsellee[".advSearchFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".advSearchFields"][] = "DateofMarriage";
$tdatavw_counsellee[".advSearchFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".advSearchFields"][] = "MobilePhone";
$tdatavw_counsellee[".advSearchFields"][] = "WorkPhone";
$tdatavw_counsellee[".advSearchFields"][] = "EmailPrimary";
$tdatavw_counsellee[".advSearchFields"][] = "EmailSecondary";
$tdatavw_counsellee[".advSearchFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".advSearchFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".advSearchFields"][] = "DevoteeId1";
$tdatavw_counsellee[".advSearchFields"][] = "NativeCity";
$tdatavw_counsellee[".advSearchFields"][] = "NativeState";
$tdatavw_counsellee[".advSearchFields"][] = "BloodGroup";
$tdatavw_counsellee[".advSearchFields"][] = "FatherName";
$tdatavw_counsellee[".advSearchFields"][] = "MotherName";
$tdatavw_counsellee[".advSearchFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".advSearchFields"][] = "DevoteeId2";
$tdatavw_counsellee[".advSearchFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".advSearchFields"][] = "ReadingLevel";
$tdatavw_counsellee[".advSearchFields"][] = "WritingLevel";
$tdatavw_counsellee[".advSearchFields"][] = "LanguageId";

$tdatavw_counsellee[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main


$tdatavw_counsellee[".totalsFields"][] = array(
	"fName" => "DevoteeId", 
	"numRows" => 0,
	"totalsType" => "COUNT",
	"viewFormat" => '');

$tdatavw_counsellee[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatavw_counsellee[".strOrderBy"] = $tstrOrderBy;

$tdatavw_counsellee[".orderindexes"] = array();

$tdatavw_counsellee[".sqlHead"] = "SELECT devotee.DevoteeId,  devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID,  devotee.IsCounsellor,  devotee_extra_info.DevoteeExtraInfoId,  devotee_extra_info.DevoteeId AS DevoteeId1,  devotee_extra_info.NativeCity,  devotee_extra_info.NativeState,  devotee_extra_info.BloodGroup,  devotee_extra_info.FatherName,  devotee_extra_info.MotherName,  devotee_language.DevoteeLanguageId,  devotee_language.DevoteeId AS DevoteeId2,  devotee_language.SpeakingLevel,  devotee_language.ReadingLevel,  devotee_language.WritingLevel,  devotee_language.LanguageId";
$tdatavw_counsellee[".sqlFrom"] = "FROM devotee  LEFT OUTER JOIN devotee_extra_info ON devotee.DevoteeId = devotee_extra_info.DevoteeId  LEFT OUTER JOIN devotee_language ON devotee.DevoteeId = devotee_language.DevoteeId";
$tdatavw_counsellee[".sqlWhereExpr"] = "";
$tdatavw_counsellee[".sqlTail"] = "";


//fill array of tabs for add page
$arrAddTabs = array();
	$tabFields = array();
	$tabFields[] = "EmailPrimary";
	$tabFields[] = "EmailSecondary";
$arrAddTabs[] = array('tabId'=>'Email1',
					  'tabName'=>"Email",
					  'nType'=>'1',
					  'nOrder'=>9,
					  'tabGroup'=>0,
					  'arrFields'=> $tabFields,
					  'expandSec'=>1);
	$tabFields = array();
	$tabFields[] = "MaritalStatusId";
	$tabFields[] = "DateofMarriage";
	$tabFields[] = "SpouseDevoteeId";
$arrAddTabs[] = array('tabId'=>'Marital1',
					  'tabName'=>"Marital",
					  'nType'=>'1',
					  'nOrder'=>12,
					  'tabGroup'=>0,
					  'arrFields'=> $tabFields,
					  'expandSec'=>1);
	$tabFields = array();
	$tabFields[] = "MobilePhone";
	$tabFields[] = "WorkPhone";
$arrAddTabs[] = array('tabId'=>'Phone1',
					  'tabName'=>"Phone",
					  'nType'=>'1',
					  'nOrder'=>16,
					  'tabGroup'=>0,
					  'arrFields'=> $tabFields,
					  'expandSec'=>1);
	$tabFields = array();
	$tabFields[] = "SpeakingLevel";
	$tabFields[] = "ReadingLevel";
	$tabFields[] = "WritingLevel";
$arrAddTabs[] = array('tabId'=>'tab21',
					  'tabName'=>"Language",
					  'nType'=>'0',
					  'nOrder'=>19,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "NativeCity";
	$tabFields[] = "NativeState";
	$tabFields[] = "MotherName";
	$tabFields[] = "FatherName";
	$tabFields[] = "BloodGroup";
$arrAddTabs[] = array('tabId'=>'tab31',
					  'tabName'=>"Other Info",
					  'nType'=>'0',
					  'nOrder'=>23,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
$tdatavw_counsellee[".arrAddTabs"] = $arrAddTabs;


//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_counsellee[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_counsellee[".arrGroupsPerPage"] = $arrGPP;

$tableKeysvw_counsellee = array();
$tableKeysvw_counsellee[] = "DevoteeId";
$tdatavw_counsellee[".Keys"] = $tableKeysvw_counsellee;

$tdatavw_counsellee[".listFields"] = array();
$tdatavw_counsellee[".listFields"][] = "LanguageId";
$tdatavw_counsellee[".listFields"][] = "DevoteeId";
$tdatavw_counsellee[".listFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".listFields"][] = "DevoteeId1";
$tdatavw_counsellee[".listFields"][] = "NativeCity";
$tdatavw_counsellee[".listFields"][] = "NativeState";
$tdatavw_counsellee[".listFields"][] = "BloodGroup";
$tdatavw_counsellee[".listFields"][] = "FatherName";
$tdatavw_counsellee[".listFields"][] = "MotherName";
$tdatavw_counsellee[".listFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".listFields"][] = "DevoteeId2";
$tdatavw_counsellee[".listFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".listFields"][] = "ReadingLevel";
$tdatavw_counsellee[".listFields"][] = "WritingLevel";
$tdatavw_counsellee[".listFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".listFields"][] = "TitleId";
$tdatavw_counsellee[".listFields"][] = "Photo";
$tdatavw_counsellee[".listFields"][] = "FirstName";
$tdatavw_counsellee[".listFields"][] = "LastName";
$tdatavw_counsellee[".listFields"][] = "MiddleName";
$tdatavw_counsellee[".listFields"][] = "MobilePhone";
$tdatavw_counsellee[".listFields"][] = "EmailPrimary";

$tdatavw_counsellee[".viewFields"] = array();
$tdatavw_counsellee[".viewFields"][] = "LanguageId";
$tdatavw_counsellee[".viewFields"][] = "WritingLevel";
$tdatavw_counsellee[".viewFields"][] = "ReadingLevel";
$tdatavw_counsellee[".viewFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".viewFields"][] = "DevoteeId2";
$tdatavw_counsellee[".viewFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".viewFields"][] = "MotherName";
$tdatavw_counsellee[".viewFields"][] = "FatherName";
$tdatavw_counsellee[".viewFields"][] = "BloodGroup";
$tdatavw_counsellee[".viewFields"][] = "NativeState";
$tdatavw_counsellee[".viewFields"][] = "NativeCity";
$tdatavw_counsellee[".viewFields"][] = "DevoteeId1";
$tdatavw_counsellee[".viewFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".viewFields"][] = "TitleId";
$tdatavw_counsellee[".viewFields"][] = "Photo";
$tdatavw_counsellee[".viewFields"][] = "FirstName";
$tdatavw_counsellee[".viewFields"][] = "LastName";
$tdatavw_counsellee[".viewFields"][] = "MiddleName";
$tdatavw_counsellee[".viewFields"][] = "Gender";
$tdatavw_counsellee[".viewFields"][] = "DateOfBirth";
$tdatavw_counsellee[".viewFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".viewFields"][] = "DateofMarriage";
$tdatavw_counsellee[".viewFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".viewFields"][] = "MobilePhone";
$tdatavw_counsellee[".viewFields"][] = "WorkPhone";
$tdatavw_counsellee[".viewFields"][] = "EmailPrimary";
$tdatavw_counsellee[".viewFields"][] = "EmailSecondary";
$tdatavw_counsellee[".viewFields"][] = "CounsellorDevoteeID";

$tdatavw_counsellee[".addFields"] = array();
$tdatavw_counsellee[".addFields"][] = "Photo";
$tdatavw_counsellee[".addFields"][] = "TitleId";
$tdatavw_counsellee[".addFields"][] = "Gender";
$tdatavw_counsellee[".addFields"][] = "FirstName";
$tdatavw_counsellee[".addFields"][] = "LastName";
$tdatavw_counsellee[".addFields"][] = "MiddleName";
$tdatavw_counsellee[".addFields"][] = "DateOfBirth";
$tdatavw_counsellee[".addFields"][] = "Password";
$tdatavw_counsellee[".addFields"][] = "EmailPrimary";
$tdatavw_counsellee[".addFields"][] = "EmailSecondary";
$tdatavw_counsellee[".addFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".addFields"][] = "DateofMarriage";
$tdatavw_counsellee[".addFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".addFields"][] = "MobilePhone";
$tdatavw_counsellee[".addFields"][] = "WorkPhone";
$tdatavw_counsellee[".addFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".addFields"][] = "ReadingLevel";
$tdatavw_counsellee[".addFields"][] = "WritingLevel";
$tdatavw_counsellee[".addFields"][] = "NativeCity";
$tdatavw_counsellee[".addFields"][] = "NativeState";
$tdatavw_counsellee[".addFields"][] = "MotherName";
$tdatavw_counsellee[".addFields"][] = "FatherName";
$tdatavw_counsellee[".addFields"][] = "BloodGroup";

$tdatavw_counsellee[".inlineAddFields"] = array();
$tdatavw_counsellee[".inlineAddFields"][] = "LanguageId";
$tdatavw_counsellee[".inlineAddFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".inlineAddFields"][] = "DevoteeId1";
$tdatavw_counsellee[".inlineAddFields"][] = "NativeCity";
$tdatavw_counsellee[".inlineAddFields"][] = "NativeState";
$tdatavw_counsellee[".inlineAddFields"][] = "BloodGroup";
$tdatavw_counsellee[".inlineAddFields"][] = "FatherName";
$tdatavw_counsellee[".inlineAddFields"][] = "MotherName";
$tdatavw_counsellee[".inlineAddFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".inlineAddFields"][] = "DevoteeId2";
$tdatavw_counsellee[".inlineAddFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".inlineAddFields"][] = "ReadingLevel";
$tdatavw_counsellee[".inlineAddFields"][] = "WritingLevel";
$tdatavw_counsellee[".inlineAddFields"][] = "TitleId";
$tdatavw_counsellee[".inlineAddFields"][] = "Photo";
$tdatavw_counsellee[".inlineAddFields"][] = "FirstName";
$tdatavw_counsellee[".inlineAddFields"][] = "LastName";
$tdatavw_counsellee[".inlineAddFields"][] = "MiddleName";
$tdatavw_counsellee[".inlineAddFields"][] = "MobilePhone";

$tdatavw_counsellee[".editFields"] = array();
$tdatavw_counsellee[".editFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".editFields"][] = "TitleId";
$tdatavw_counsellee[".editFields"][] = "Photo";
$tdatavw_counsellee[".editFields"][] = "FirstName";
$tdatavw_counsellee[".editFields"][] = "LastName";
$tdatavw_counsellee[".editFields"][] = "MiddleName";
$tdatavw_counsellee[".editFields"][] = "Gender";
$tdatavw_counsellee[".editFields"][] = "DateOfBirth";
$tdatavw_counsellee[".editFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".editFields"][] = "DateofMarriage";
$tdatavw_counsellee[".editFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".editFields"][] = "MobilePhone";
$tdatavw_counsellee[".editFields"][] = "WorkPhone";
$tdatavw_counsellee[".editFields"][] = "EmailPrimary";
$tdatavw_counsellee[".editFields"][] = "EmailSecondary";

$tdatavw_counsellee[".inlineEditFields"] = array();
$tdatavw_counsellee[".inlineEditFields"][] = "LanguageId";
$tdatavw_counsellee[".inlineEditFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".inlineEditFields"][] = "DevoteeId1";
$tdatavw_counsellee[".inlineEditFields"][] = "NativeCity";
$tdatavw_counsellee[".inlineEditFields"][] = "NativeState";
$tdatavw_counsellee[".inlineEditFields"][] = "BloodGroup";
$tdatavw_counsellee[".inlineEditFields"][] = "FatherName";
$tdatavw_counsellee[".inlineEditFields"][] = "MotherName";
$tdatavw_counsellee[".inlineEditFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".inlineEditFields"][] = "DevoteeId2";
$tdatavw_counsellee[".inlineEditFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".inlineEditFields"][] = "ReadingLevel";
$tdatavw_counsellee[".inlineEditFields"][] = "WritingLevel";
$tdatavw_counsellee[".inlineEditFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".inlineEditFields"][] = "TitleId";
$tdatavw_counsellee[".inlineEditFields"][] = "Photo";
$tdatavw_counsellee[".inlineEditFields"][] = "FirstName";
$tdatavw_counsellee[".inlineEditFields"][] = "LastName";
$tdatavw_counsellee[".inlineEditFields"][] = "MiddleName";
$tdatavw_counsellee[".inlineEditFields"][] = "MobilePhone";
$tdatavw_counsellee[".inlineEditFields"][] = "EmailPrimary";

$tdatavw_counsellee[".exportFields"] = array();
$tdatavw_counsellee[".exportFields"][] = "DevoteeId";
$tdatavw_counsellee[".exportFields"][] = "TitleId";
$tdatavw_counsellee[".exportFields"][] = "Photo";
$tdatavw_counsellee[".exportFields"][] = "FirstName";
$tdatavw_counsellee[".exportFields"][] = "LastName";
$tdatavw_counsellee[".exportFields"][] = "MiddleName";
$tdatavw_counsellee[".exportFields"][] = "Gender";
$tdatavw_counsellee[".exportFields"][] = "DateOfBirth";
$tdatavw_counsellee[".exportFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".exportFields"][] = "DateofMarriage";
$tdatavw_counsellee[".exportFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".exportFields"][] = "MobilePhone";
$tdatavw_counsellee[".exportFields"][] = "WorkPhone";
$tdatavw_counsellee[".exportFields"][] = "EmailPrimary";
$tdatavw_counsellee[".exportFields"][] = "EmailSecondary";
$tdatavw_counsellee[".exportFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".exportFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".exportFields"][] = "DevoteeId1";
$tdatavw_counsellee[".exportFields"][] = "NativeCity";
$tdatavw_counsellee[".exportFields"][] = "NativeState";
$tdatavw_counsellee[".exportFields"][] = "BloodGroup";
$tdatavw_counsellee[".exportFields"][] = "FatherName";
$tdatavw_counsellee[".exportFields"][] = "MotherName";
$tdatavw_counsellee[".exportFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".exportFields"][] = "DevoteeId2";
$tdatavw_counsellee[".exportFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".exportFields"][] = "ReadingLevel";
$tdatavw_counsellee[".exportFields"][] = "WritingLevel";
$tdatavw_counsellee[".exportFields"][] = "LanguageId";

$tdatavw_counsellee[".printFields"] = array();
$tdatavw_counsellee[".printFields"][] = "DevoteeId";
$tdatavw_counsellee[".printFields"][] = "TitleId";
$tdatavw_counsellee[".printFields"][] = "Photo";
$tdatavw_counsellee[".printFields"][] = "FirstName";
$tdatavw_counsellee[".printFields"][] = "LastName";
$tdatavw_counsellee[".printFields"][] = "MiddleName";
$tdatavw_counsellee[".printFields"][] = "Gender";
$tdatavw_counsellee[".printFields"][] = "DateOfBirth";
$tdatavw_counsellee[".printFields"][] = "MaritalStatusId";
$tdatavw_counsellee[".printFields"][] = "DateofMarriage";
$tdatavw_counsellee[".printFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee[".printFields"][] = "MobilePhone";
$tdatavw_counsellee[".printFields"][] = "WorkPhone";
$tdatavw_counsellee[".printFields"][] = "EmailPrimary";
$tdatavw_counsellee[".printFields"][] = "EmailSecondary";
$tdatavw_counsellee[".printFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee[".printFields"][] = "DevoteeExtraInfoId";
$tdatavw_counsellee[".printFields"][] = "DevoteeId1";
$tdatavw_counsellee[".printFields"][] = "NativeCity";
$tdatavw_counsellee[".printFields"][] = "NativeState";
$tdatavw_counsellee[".printFields"][] = "BloodGroup";
$tdatavw_counsellee[".printFields"][] = "FatherName";
$tdatavw_counsellee[".printFields"][] = "MotherName";
$tdatavw_counsellee[".printFields"][] = "DevoteeLanguageId";
$tdatavw_counsellee[".printFields"][] = "DevoteeId2";
$tdatavw_counsellee[".printFields"][] = "SpeakingLevel";
$tdatavw_counsellee[".printFields"][] = "ReadingLevel";
$tdatavw_counsellee[".printFields"][] = "WritingLevel";
$tdatavw_counsellee[".printFields"][] = "LanguageId";

//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee.DevoteeId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["DevoteeId"] = $fdata;
//	TitleId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "TitleId";
	$fdata["GoodName"] = "TitleId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Title Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "TitleId"; 
		$fdata["FullName"] = "devotee.TitleId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 2;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
	$edata["autoCompleteFields"][] = array('masterF'=>"Gender", 'lookupF'=>"Gender");
				
		
			
	$edata["LinkField"] = "SalutationId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "salutation";
	
		
	$edata["LookupTable"] = "lu_salutations";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		$edata["AllowToAdd"] = true; 
	
				
	
	
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["TitleId"] = $fdata;
//	Photo
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Photo";
	$fdata["GoodName"] = "Photo";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Photo"; 
	$fdata["FieldType"] = 128;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Photo"; 
		$fdata["FullName"] = "devotee.Photo";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Database Image");
	
		
		
				$vdata["ImageWidth"] = 0;
	$vdata["ImageHeight"] = 0;
	
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Database image");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				$edata["ResizeImage"] = true;
				$edata["NewSize"] = 100;
	
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["Photo"] = $fdata;
//	FirstName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "FirstName";
	$fdata["GoodName"] = "FirstName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "First Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "FirstName"; 
		$fdata["FullName"] = "devotee.FirstName";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["FirstName"] = $fdata;
//	LastName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "LastName";
	$fdata["GoodName"] = "LastName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Last Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "LastName"; 
		$fdata["FullName"] = "devotee.LastName";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["LastName"] = $fdata;
//	MiddleName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "MiddleName";
	$fdata["GoodName"] = "MiddleName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Middle Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "MiddleName"; 
		$fdata["FullName"] = "devotee.MiddleName";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["MiddleName"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Gender"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Gender"; 
		$fdata["FullName"] = "devotee.Gender";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Readonly");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["Gender"] = $fdata;
//	DateOfBirth
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "DateOfBirth";
	$fdata["GoodName"] = "DateOfBirth";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Birth"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DateOfBirth"; 
		$fdata["FullName"] = "devotee.DateOfBirth";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["DateOfBirth"] = $fdata;
//	MaritalStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "MaritalStatusId";
	$fdata["GoodName"] = "MaritalStatusId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Marital Status Id"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "MaritalStatusId"; 
		$fdata["FullName"] = "devotee.MaritalStatusId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 2;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
			
	$edata["LinkField"] = "MaritalStatusId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "MaritalStatus";
	
		
	$edata["LookupTable"] = "lu_marital_status";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
				
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["MaritalStatusId"] = $fdata;
//	DateofMarriage
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "DateofMarriage";
	$fdata["GoodName"] = "DateofMarriage";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Dateof Marriage"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DateofMarriage"; 
		$fdata["FullName"] = "devotee.DateofMarriage";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["DateofMarriage"] = $fdata;
//	SpouseDevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "SpouseDevoteeId";
	$fdata["GoodName"] = "SpouseDevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Spouse Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SpouseDevoteeId"; 
		$fdata["FullName"] = "devotee.SpouseDevoteeId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 2;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				if(strpos(GetUserPermissions("vw_counsellee"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "DevoteeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "FirstName";
	
		
	$edata["LookupTable"] = "vw_all_devotee";
	$edata["LookupOrderBy"] = "FirstName";
	
		
		
		
		
		$edata["AllowToAdd"] = true; 
	
				
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["SpouseDevoteeId"] = $fdata;
//	MobilePhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "MobilePhone";
	$fdata["GoodName"] = "MobilePhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Mobile Phone"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "MobilePhone"; 
		$fdata["FullName"] = "devotee.MobilePhone";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
		$edata["strEditMask"] = "9999999999"; 

//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["MobilePhone"] = $fdata;
//	WorkPhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "WorkPhone";
	$fdata["GoodName"] = "WorkPhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Work Phone"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "WorkPhone"; 
		$fdata["FullName"] = "devotee.WorkPhone";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["WorkPhone"] = $fdata;
//	EmailPrimary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "EmailPrimary";
	$fdata["GoodName"] = "EmailPrimary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Primary"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "EmailPrimary"; 
		$fdata["FullName"] = "devotee.EmailPrimary";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Email");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["EmailPrimary"] = $fdata;
//	EmailSecondary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "EmailSecondary";
	$fdata["GoodName"] = "EmailSecondary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Secondary"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "EmailSecondary"; 
		$fdata["FullName"] = "devotee.EmailSecondary";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Email");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["EmailSecondary"] = $fdata;
//	Password
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "Password";
	$fdata["GoodName"] = "Password";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Password"; 
	$fdata["FieldType"] = 200;
	
		
		$fdata["bIsEncrypted"] = true; 
	
		
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		
		
		
		$fdata["strField"] = "Password"; 
		$fdata["FullName"] = "devotee.Password";
	
		
		
				
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["Password"] = $fdata;
//	active
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "active";
	$fdata["GoodName"] = "active";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Active"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "active"; 
		$fdata["FullName"] = "devotee.active";
	
		
		
				
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["active"] = $fdata;
//	CounsellorDevoteeID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "CounsellorDevoteeID";
	$fdata["GoodName"] = "CounsellorDevoteeID";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Counsellor Devotee ID"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "CounsellorDevoteeID"; 
		$fdata["FullName"] = "devotee.CounsellorDevoteeID";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Readonly");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["CounsellorDevoteeID"] = $fdata;
//	IsCounsellor
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "IsCounsellor";
	$fdata["GoodName"] = "IsCounsellor";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Is Counsellor"; 
	$fdata["FieldType"] = 16;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "IsCounsellor"; 
		$fdata["FullName"] = "devotee.IsCounsellor";
	
		
		
				
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Readonly");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["IsCounsellor"] = $fdata;
//	DevoteeExtraInfoId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "DevoteeExtraInfoId";
	$fdata["GoodName"] = "DevoteeExtraInfoId";
	$fdata["ownerTable"] = "devotee_extra_info";
	$fdata["Label"] = "Devotee Extra Info Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeExtraInfoId"; 
		$fdata["FullName"] = "devotee_extra_info.DevoteeExtraInfoId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["DevoteeExtraInfoId"] = $fdata;
//	DevoteeId1
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "DevoteeId1";
	$fdata["GoodName"] = "DevoteeId1";
	$fdata["ownerTable"] = "devotee_extra_info";
	$fdata["Label"] = "Devotee Id1"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee_extra_info.DevoteeId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["DevoteeId1"] = $fdata;
//	NativeCity
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 22;
	$fdata["strName"] = "NativeCity";
	$fdata["GoodName"] = "NativeCity";
	$fdata["ownerTable"] = "devotee_extra_info";
	$fdata["Label"] = "Native City"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "NativeCity"; 
		$fdata["FullName"] = "devotee_extra_info.NativeCity";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["NativeCity"] = $fdata;
//	NativeState
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 23;
	$fdata["strName"] = "NativeState";
	$fdata["GoodName"] = "NativeState";
	$fdata["ownerTable"] = "devotee_extra_info";
	$fdata["Label"] = "Native State"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "NativeState"; 
		$fdata["FullName"] = "devotee_extra_info.NativeState";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["NativeState"] = $fdata;
//	BloodGroup
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 24;
	$fdata["strName"] = "BloodGroup";
	$fdata["GoodName"] = "BloodGroup";
	$fdata["ownerTable"] = "devotee_extra_info";
	$fdata["Label"] = "Blood Group"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "BloodGroup"; 
		$fdata["FullName"] = "devotee_extra_info.BloodGroup";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["BloodGroup"] = $fdata;
//	FatherName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 25;
	$fdata["strName"] = "FatherName";
	$fdata["GoodName"] = "FatherName";
	$fdata["ownerTable"] = "devotee_extra_info";
	$fdata["Label"] = "Father Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "FatherName"; 
		$fdata["FullName"] = "devotee_extra_info.FatherName";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["FatherName"] = $fdata;
//	MotherName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 26;
	$fdata["strName"] = "MotherName";
	$fdata["GoodName"] = "MotherName";
	$fdata["ownerTable"] = "devotee_extra_info";
	$fdata["Label"] = "Mother Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "MotherName"; 
		$fdata["FullName"] = "devotee_extra_info.MotherName";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["MotherName"] = $fdata;
//	DevoteeLanguageId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 27;
	$fdata["strName"] = "DevoteeLanguageId";
	$fdata["GoodName"] = "DevoteeLanguageId";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Devotee Language Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeLanguageId"; 
		$fdata["FullName"] = "devotee_language.DevoteeLanguageId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["DevoteeLanguageId"] = $fdata;
//	DevoteeId2
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 28;
	$fdata["strName"] = "DevoteeId2";
	$fdata["GoodName"] = "DevoteeId2";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Devotee Id2"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee_language.DevoteeId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["DevoteeId2"] = $fdata;
//	SpeakingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 29;
	$fdata["strName"] = "SpeakingLevel";
	$fdata["GoodName"] = "SpeakingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Speaking Level"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SpeakingLevel"; 
		$fdata["FullName"] = "devotee_language.SpeakingLevel";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["SpeakingLevel"] = $fdata;
//	ReadingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 30;
	$fdata["strName"] = "ReadingLevel";
	$fdata["GoodName"] = "ReadingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Reading Level"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ReadingLevel"; 
		$fdata["FullName"] = "devotee_language.ReadingLevel";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["ReadingLevel"] = $fdata;
//	WritingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 31;
	$fdata["strName"] = "WritingLevel";
	$fdata["GoodName"] = "WritingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Writing Level"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "WritingLevel"; 
		$fdata["FullName"] = "devotee_language.WritingLevel";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["WritingLevel"] = $fdata;
//	LanguageId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 32;
	$fdata["strName"] = "LanguageId";
	$fdata["GoodName"] = "LanguageId";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Language Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "LanguageId"; 
		$fdata["FullName"] = "devotee_language.LanguageId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_counsellee["LanguageId"] = $fdata;

	
$tables_data["vw_counsellee"]=&$tdatavw_counsellee;
$field_labels["vw_counsellee"] = &$fieldLabelsvw_counsellee;
$fieldToolTips["vw_counsellee"] = &$fieldToolTipsvw_counsellee;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_counsellee"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["vw_counsellee"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_vw_counsellee()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "devotee.DevoteeId,  devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID,  devotee.IsCounsellor,  devotee_extra_info.DevoteeExtraInfoId,  devotee_extra_info.DevoteeId AS DevoteeId1,  devotee_extra_info.NativeCity,  devotee_extra_info.NativeState,  devotee_extra_info.BloodGroup,  devotee_extra_info.FatherName,  devotee_extra_info.MotherName,  devotee_language.DevoteeLanguageId,  devotee_language.DevoteeId AS DevoteeId2,  devotee_language.SpeakingLevel,  devotee_language.ReadingLevel,  devotee_language.WritingLevel,  devotee_language.LanguageId";
$proto0["m_strFrom"] = "FROM devotee  LEFT OUTER JOIN devotee_extra_info ON devotee.DevoteeId = devotee_extra_info.DevoteeId  LEFT OUTER JOIN devotee_language ON devotee.DevoteeId = devotee_language.DevoteeId";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("vw_counsellee");
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.DevoteeId"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.TitleId"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.Photo"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.FirstName"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.LastName"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.MiddleName"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.Gender"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.DateOfBirth"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.MaritalStatusId"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.DateofMarriage"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.SpouseDevoteeId"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.MobilePhone"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.WorkPhone"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.EmailPrimary"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.EmailSecondary"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.Password"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.active"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.CounsellorDevoteeID"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
						$proto41=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.IsCounsellor"
));

$proto41["m_expr"]=$obj;
$proto41["m_alias"] = "";
$obj = new SQLFieldListItem($proto41);

$proto0["m_fieldlist"][]=$obj;
						$proto43=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_extra_info.DevoteeExtraInfoId"
));

$proto43["m_expr"]=$obj;
$proto43["m_alias"] = "";
$obj = new SQLFieldListItem($proto43);

$proto0["m_fieldlist"][]=$obj;
						$proto45=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_extra_info.DevoteeId"
));

$proto45["m_expr"]=$obj;
$proto45["m_alias"] = "DevoteeId1";
$obj = new SQLFieldListItem($proto45);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_extra_info.NativeCity"
));

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
						$proto49=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_extra_info.NativeState"
));

$proto49["m_expr"]=$obj;
$proto49["m_alias"] = "";
$obj = new SQLFieldListItem($proto49);

$proto0["m_fieldlist"][]=$obj;
						$proto51=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_extra_info.BloodGroup"
));

$proto51["m_expr"]=$obj;
$proto51["m_alias"] = "";
$obj = new SQLFieldListItem($proto51);

$proto0["m_fieldlist"][]=$obj;
						$proto53=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_extra_info.FatherName"
));

$proto53["m_expr"]=$obj;
$proto53["m_alias"] = "";
$obj = new SQLFieldListItem($proto53);

$proto0["m_fieldlist"][]=$obj;
						$proto55=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_extra_info.MotherName"
));

$proto55["m_expr"]=$obj;
$proto55["m_alias"] = "";
$obj = new SQLFieldListItem($proto55);

$proto0["m_fieldlist"][]=$obj;
						$proto57=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.DevoteeLanguageId"
));

$proto57["m_expr"]=$obj;
$proto57["m_alias"] = "";
$obj = new SQLFieldListItem($proto57);

$proto0["m_fieldlist"][]=$obj;
						$proto59=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.DevoteeId"
));

$proto59["m_expr"]=$obj;
$proto59["m_alias"] = "DevoteeId2";
$obj = new SQLFieldListItem($proto59);

$proto0["m_fieldlist"][]=$obj;
						$proto61=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.SpeakingLevel"
));

$proto61["m_expr"]=$obj;
$proto61["m_alias"] = "";
$obj = new SQLFieldListItem($proto61);

$proto0["m_fieldlist"][]=$obj;
						$proto63=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.ReadingLevel"
));

$proto63["m_expr"]=$obj;
$proto63["m_alias"] = "";
$obj = new SQLFieldListItem($proto63);

$proto0["m_fieldlist"][]=$obj;
						$proto65=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.WritingLevel"
));

$proto65["m_expr"]=$obj;
$proto65["m_alias"] = "";
$obj = new SQLFieldListItem($proto65);

$proto0["m_fieldlist"][]=$obj;
						$proto67=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.LanguageId"
));

$proto67["m_expr"]=$obj;
$proto67["m_alias"] = "";
$obj = new SQLFieldListItem($proto67);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto69=array();
$proto69["m_link"] = "SQLL_MAIN";
			$proto70=array();
$proto70["m_strName"] = "devotee";
$proto70["m_columns"] = array();
$proto70["m_columns"][] = "DevoteeId";
$proto70["m_columns"][] = "TitleId";
$proto70["m_columns"][] = "Photo";
$proto70["m_columns"][] = "FirstName";
$proto70["m_columns"][] = "LastName";
$proto70["m_columns"][] = "MiddleName";
$proto70["m_columns"][] = "Gender";
$proto70["m_columns"][] = "DateOfBirth";
$proto70["m_columns"][] = "MaritalStatusId";
$proto70["m_columns"][] = "DateofMarriage";
$proto70["m_columns"][] = "SpouseDevoteeId";
$proto70["m_columns"][] = "MobilePhone";
$proto70["m_columns"][] = "WorkPhone";
$proto70["m_columns"][] = "EmailPrimary";
$proto70["m_columns"][] = "EmailSecondary";
$proto70["m_columns"][] = "Password";
$proto70["m_columns"][] = "active";
$proto70["m_columns"][] = "CounsellorDevoteeID";
$proto70["m_columns"][] = "IsCounsellor";
$proto70["m_columns"][] = "NativeCity";
$proto70["m_columns"][] = "NativeState";
$proto70["m_columns"][] = "BloodGroup";
$proto70["m_columns"][] = "DateOfHarinamInitiation";
$proto70["m_columns"][] = "DateOfBrahmanInitiation";
$proto70["m_columns"][] = "SpiritualMasterId";
$proto70["m_columns"][] = "PreviousReligion";
$proto70["m_columns"][] = "Chanting16RoundsSince";
$proto70["m_columns"][] = "IntroducedBy";
$proto70["m_columns"][] = "YearOfIntroduction";
$proto70["m_columns"][] = "IntroducedInCenter";
$proto70["m_columns"][] = "PreferedServices";
$proto70["m_columns"][] = "ServicesRendered";
$proto70["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto70);

$proto69["m_table"] = $obj;
$proto69["m_alias"] = "";
$proto71=array();
$proto71["m_sql"] = "";
$proto71["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto71["m_column"]=$obj;
$proto71["m_contained"] = array();
$proto71["m_strCase"] = "";
$proto71["m_havingmode"] = "0";
$proto71["m_inBrackets"] = "0";
$proto71["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto71);

$proto69["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto69);

$proto0["m_fromlist"][]=$obj;
												$proto73=array();
$proto73["m_link"] = "SQLL_MAIN";
			$proto74=array();
$proto74["m_strName"] = "devotee_extra_info";
$proto74["m_columns"] = array();
$obj = new SQLTable($proto74);

$proto73["m_table"] = $obj;
$proto73["m_alias"] = "";
$proto75=array();
$proto75["m_sql"] = "";
$proto75["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto75["m_column"]=$obj;
$proto75["m_contained"] = array();
$proto75["m_strCase"] = "";
$proto75["m_havingmode"] = "0";
$proto75["m_inBrackets"] = "0";
$proto75["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto75);

$proto73["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto73);

$proto0["m_fromlist"][]=$obj;
												$proto77=array();
$proto77["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN devotee_language ON devotee.DevoteeId = devotee_language.DevoteeId"
));

$proto77["m_table"] = $obj;
$proto77["m_alias"] = "";
$proto79=array();
$proto79["m_sql"] = "";
$proto79["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto79["m_column"]=$obj;
$proto79["m_contained"] = array();
$proto79["m_strCase"] = "";
$proto79["m_havingmode"] = "0";
$proto79["m_inBrackets"] = "0";
$proto79["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto79);

$proto77["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto77);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_vw_counsellee = createSqlQuery_vw_counsellee();
																		 $queryData_vw_counsellee->m_fieldlist[15]->m_isEncrypted = true;
																$tdatavw_counsellee[".sqlquery"] = $queryData_vw_counsellee;
	
if(isset($tdatavw_counsellee["field2"])){
	$tdatavw_counsellee["field2"]["LookupTable"] = "carscars_view";
	$tdatavw_counsellee["field2"]["LookupOrderBy"] = "name";
	$tdatavw_counsellee["field2"]["LookupType"] = 4;
	$tdatavw_counsellee["field2"]["LinkField"] = "email";
	$tdatavw_counsellee["field2"]["DisplayField"] = "name";
	$tdatavw_counsellee[".hasCustomViewField"] = true;
}

include_once(getabspath("include/vw_counsellee_events.php"));
$tableEvents["vw_counsellee"] = new eventclass_vw_counsellee;
$tdatavw_counsellee[".hasEvents"] = true;

$cipherer = new RunnerCipherer("vw_counsellee");

?>