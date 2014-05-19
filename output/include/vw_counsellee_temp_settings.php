<?php
require_once(getabspath("classes/cipherer.php"));
$tdatavw_counsellee_temp = array();
	$tdatavw_counsellee_temp[".NumberOfChars"] = 80; 
	$tdatavw_counsellee_temp[".ShortName"] = "vw_counsellee_temp";
	$tdatavw_counsellee_temp[".OwnerID"] = "CounsellorDevoteeID";
	$tdatavw_counsellee_temp[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsvw_counsellee_temp = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_counsellee_temp["English"] = array();
	$fieldToolTipsvw_counsellee_temp["English"] = array();
	$fieldLabelsvw_counsellee_temp["English"]["Photo"] = "Photo";
	$fieldToolTipsvw_counsellee_temp["English"]["Photo"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["Gender"] = "Gender";
	$fieldToolTipsvw_counsellee_temp["English"]["Gender"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_counsellee_temp["English"]["DevoteeId"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["TitleId"] = "Title Id";
	$fieldToolTipsvw_counsellee_temp["English"]["TitleId"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["FirstName"] = "First Name";
	$fieldToolTipsvw_counsellee_temp["English"]["FirstName"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["LastName"] = "Last Name";
	$fieldToolTipsvw_counsellee_temp["English"]["LastName"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsvw_counsellee_temp["English"]["MiddleName"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsvw_counsellee_temp["English"]["DateOfBirth"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsvw_counsellee_temp["English"]["MaritalStatusId"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["DateofMarriage"] = "Dateof Marriage";
	$fieldToolTipsvw_counsellee_temp["English"]["DateofMarriage"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsvw_counsellee_temp["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["MobilePhone"] = "Mobile Phone";
	$fieldToolTipsvw_counsellee_temp["English"]["MobilePhone"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsvw_counsellee_temp["English"]["WorkPhone"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["EmailPrimary"] = "Email Primary";
	$fieldToolTipsvw_counsellee_temp["English"]["EmailPrimary"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsvw_counsellee_temp["English"]["EmailSecondary"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["Password"] = "Password";
	$fieldToolTipsvw_counsellee_temp["English"]["Password"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["active"] = "Active";
	$fieldToolTipsvw_counsellee_temp["English"]["active"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["CounsellorDevoteeID"] = "Counsellor Devotee ID";
	$fieldToolTipsvw_counsellee_temp["English"]["CounsellorDevoteeID"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["IsCounsellor"] = "Is Counsellor";
	$fieldToolTipsvw_counsellee_temp["English"]["IsCounsellor"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["DevoteeId1"] = "Devotee Id1";
	$fieldToolTipsvw_counsellee_temp["English"]["DevoteeId1"] = "";
	$fieldLabelsvw_counsellee_temp["English"]["DateOfHarinamInitiation"] = "Date Of Harinam Initiation";
	$fieldToolTipsvw_counsellee_temp["English"]["DateOfHarinamInitiation"] = "";
	if (count($fieldToolTipsvw_counsellee_temp["English"]))
		$tdatavw_counsellee_temp[".isUseToolTips"] = true;
}
	
	
	$tdatavw_counsellee_temp[".NCSearch"] = true;



$tdatavw_counsellee_temp[".shortTableName"] = "vw_counsellee_temp";
$tdatavw_counsellee_temp[".nSecOptions"] = 1;
$tdatavw_counsellee_temp[".recsPerRowList"] = 1;
$tdatavw_counsellee_temp[".mainTableOwnerID"] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".moveNext"] = 1;
$tdatavw_counsellee_temp[".nType"] = 1;

$tdatavw_counsellee_temp[".strOriginalTableName"] = "devotee";

$tdatavw_counsellee_temp[".hasEncryptedFields"] = true;



$tdatavw_counsellee_temp[".showAddInPopup"] = true;

$tdatavw_counsellee_temp[".showEditInPopup"] = true;

$tdatavw_counsellee_temp[".showViewInPopup"] = true;

$tdatavw_counsellee_temp[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatavw_counsellee_temp[".listAjax"] = true;
else 
	$tdatavw_counsellee_temp[".listAjax"] = false;

	$tdatavw_counsellee_temp[".audit"] = true;

	$tdatavw_counsellee_temp[".locking"] = false;

$tdatavw_counsellee_temp[".listIcons"] = true;
$tdatavw_counsellee_temp[".edit"] = true;
$tdatavw_counsellee_temp[".inlineEdit"] = true;
$tdatavw_counsellee_temp[".inlineAdd"] = true;
$tdatavw_counsellee_temp[".copy"] = true;
$tdatavw_counsellee_temp[".view"] = true;

$tdatavw_counsellee_temp[".exportTo"] = true;

$tdatavw_counsellee_temp[".printFriendly"] = true;

$tdatavw_counsellee_temp[".delete"] = true;

$tdatavw_counsellee_temp[".showSimpleSearchOptions"] = true;

$tdatavw_counsellee_temp[".showSearchPanel"] = true;

if (isMobile())
	$tdatavw_counsellee_temp[".isUseAjaxSuggest"] = false;
else 
	$tdatavw_counsellee_temp[".isUseAjaxSuggest"] = true;

$tdatavw_counsellee_temp[".rowHighlite"] = true;

// button handlers file names

$tdatavw_counsellee_temp[".addPageEvents"] = true;

// use timepicker for search panel
$tdatavw_counsellee_temp[".isUseTimeForSearch"] = false;




$tdatavw_counsellee_temp[".allSearchFields"] = array();

$tdatavw_counsellee_temp[".allSearchFields"][] = "DevoteeId";
$tdatavw_counsellee_temp[".allSearchFields"][] = "TitleId";
$tdatavw_counsellee_temp[".allSearchFields"][] = "FirstName";
$tdatavw_counsellee_temp[".allSearchFields"][] = "LastName";
$tdatavw_counsellee_temp[".allSearchFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".allSearchFields"][] = "Gender";
$tdatavw_counsellee_temp[".allSearchFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".allSearchFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".allSearchFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".allSearchFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".allSearchFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".allSearchFields"][] = "WorkPhone";
$tdatavw_counsellee_temp[".allSearchFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".allSearchFields"][] = "EmailSecondary";
$tdatavw_counsellee_temp[".allSearchFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".allSearchFields"][] = "IsCounsellor";
$tdatavw_counsellee_temp[".allSearchFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".allSearchFields"][] = "DateOfHarinamInitiation";

$tdatavw_counsellee_temp[".googleLikeFields"][] = "DevoteeId";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "TitleId";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "FirstName";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "LastName";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "Gender";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "WorkPhone";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "EmailSecondary";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "Password";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "active";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "IsCounsellor";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".googleLikeFields"][] = "DateOfHarinamInitiation";


$tdatavw_counsellee_temp[".advSearchFields"][] = "DevoteeId";
$tdatavw_counsellee_temp[".advSearchFields"][] = "TitleId";
$tdatavw_counsellee_temp[".advSearchFields"][] = "FirstName";
$tdatavw_counsellee_temp[".advSearchFields"][] = "LastName";
$tdatavw_counsellee_temp[".advSearchFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".advSearchFields"][] = "Gender";
$tdatavw_counsellee_temp[".advSearchFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".advSearchFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".advSearchFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".advSearchFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".advSearchFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".advSearchFields"][] = "WorkPhone";
$tdatavw_counsellee_temp[".advSearchFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".advSearchFields"][] = "EmailSecondary";
$tdatavw_counsellee_temp[".advSearchFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".advSearchFields"][] = "IsCounsellor";
$tdatavw_counsellee_temp[".advSearchFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".advSearchFields"][] = "DateOfHarinamInitiation";

$tdatavw_counsellee_temp[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main


$tdatavw_counsellee_temp[".totalsFields"][] = array(
	"fName" => "DevoteeId", 
	"numRows" => 0,
	"totalsType" => "COUNT",
	"viewFormat" => '');

$tdatavw_counsellee_temp[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatavw_counsellee_temp[".strOrderBy"] = $tstrOrderBy;

$tdatavw_counsellee_temp[".orderindexes"] = array();

$tdatavw_counsellee_temp[".sqlHead"] = "SELECT devotee.DevoteeId,  devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID,  devotee.IsCounsellor,  spiritual_life.DevoteeId AS DevoteeId1,  spiritual_life.DateOfHarinamInitiation";
$tdatavw_counsellee_temp[".sqlFrom"] = "FROM devotee  , spiritual_life";
$tdatavw_counsellee_temp[".sqlWhereExpr"] = "";
$tdatavw_counsellee_temp[".sqlTail"] = "";


//fill array of tabs for add page
$arrAddTabs = array();
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'New_tab1',
					  'tabName'=>"New tab",
					  'nType'=>'0',
					  'nOrder'=>18,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
$tdatavw_counsellee_temp[".arrAddTabs"] = $arrAddTabs;


//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_counsellee_temp[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_counsellee_temp[".arrGroupsPerPage"] = $arrGPP;

$tableKeysvw_counsellee_temp = array();
$tableKeysvw_counsellee_temp[] = "DevoteeId";
$tdatavw_counsellee_temp[".Keys"] = $tableKeysvw_counsellee_temp;

$tdatavw_counsellee_temp[".listFields"] = array();
$tdatavw_counsellee_temp[".listFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".listFields"][] = "DateOfHarinamInitiation";
$tdatavw_counsellee_temp[".listFields"][] = "DevoteeId";
$tdatavw_counsellee_temp[".listFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".listFields"][] = "TitleId";
$tdatavw_counsellee_temp[".listFields"][] = "Photo";
$tdatavw_counsellee_temp[".listFields"][] = "FirstName";
$tdatavw_counsellee_temp[".listFields"][] = "LastName";
$tdatavw_counsellee_temp[".listFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".listFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".listFields"][] = "EmailPrimary";

$tdatavw_counsellee_temp[".viewFields"] = array();
$tdatavw_counsellee_temp[".viewFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".viewFields"][] = "DateOfHarinamInitiation";
$tdatavw_counsellee_temp[".viewFields"][] = "TitleId";
$tdatavw_counsellee_temp[".viewFields"][] = "Photo";
$tdatavw_counsellee_temp[".viewFields"][] = "FirstName";
$tdatavw_counsellee_temp[".viewFields"][] = "LastName";
$tdatavw_counsellee_temp[".viewFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".viewFields"][] = "Gender";
$tdatavw_counsellee_temp[".viewFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".viewFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".viewFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".viewFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".viewFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".viewFields"][] = "WorkPhone";
$tdatavw_counsellee_temp[".viewFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".viewFields"][] = "EmailSecondary";
$tdatavw_counsellee_temp[".viewFields"][] = "CounsellorDevoteeID";

$tdatavw_counsellee_temp[".addFields"] = array();
$tdatavw_counsellee_temp[".addFields"][] = "Photo";
$tdatavw_counsellee_temp[".addFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".addFields"][] = "IsCounsellor";
$tdatavw_counsellee_temp[".addFields"][] = "TitleId";
$tdatavw_counsellee_temp[".addFields"][] = "Gender";
$tdatavw_counsellee_temp[".addFields"][] = "FirstName";
$tdatavw_counsellee_temp[".addFields"][] = "LastName";
$tdatavw_counsellee_temp[".addFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".addFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".addFields"][] = "Password";
$tdatavw_counsellee_temp[".addFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".addFields"][] = "EmailSecondary";
$tdatavw_counsellee_temp[".addFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".addFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".addFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".addFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".addFields"][] = "WorkPhone";

$tdatavw_counsellee_temp[".inlineAddFields"] = array();
$tdatavw_counsellee_temp[".inlineAddFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".inlineAddFields"][] = "DateOfHarinamInitiation";
$tdatavw_counsellee_temp[".inlineAddFields"][] = "TitleId";
$tdatavw_counsellee_temp[".inlineAddFields"][] = "Photo";
$tdatavw_counsellee_temp[".inlineAddFields"][] = "FirstName";
$tdatavw_counsellee_temp[".inlineAddFields"][] = "LastName";
$tdatavw_counsellee_temp[".inlineAddFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".inlineAddFields"][] = "MobilePhone";

$tdatavw_counsellee_temp[".editFields"] = array();
$tdatavw_counsellee_temp[".editFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".editFields"][] = "TitleId";
$tdatavw_counsellee_temp[".editFields"][] = "Photo";
$tdatavw_counsellee_temp[".editFields"][] = "FirstName";
$tdatavw_counsellee_temp[".editFields"][] = "LastName";
$tdatavw_counsellee_temp[".editFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".editFields"][] = "Gender";
$tdatavw_counsellee_temp[".editFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".editFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".editFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".editFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".editFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".editFields"][] = "WorkPhone";
$tdatavw_counsellee_temp[".editFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".editFields"][] = "EmailSecondary";

$tdatavw_counsellee_temp[".inlineEditFields"] = array();
$tdatavw_counsellee_temp[".inlineEditFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "DateOfHarinamInitiation";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "TitleId";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "Photo";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "FirstName";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "LastName";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".inlineEditFields"][] = "EmailPrimary";

$tdatavw_counsellee_temp[".exportFields"] = array();
$tdatavw_counsellee_temp[".exportFields"][] = "DevoteeId";
$tdatavw_counsellee_temp[".exportFields"][] = "TitleId";
$tdatavw_counsellee_temp[".exportFields"][] = "Photo";
$tdatavw_counsellee_temp[".exportFields"][] = "FirstName";
$tdatavw_counsellee_temp[".exportFields"][] = "LastName";
$tdatavw_counsellee_temp[".exportFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".exportFields"][] = "Gender";
$tdatavw_counsellee_temp[".exportFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".exportFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".exportFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".exportFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".exportFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".exportFields"][] = "WorkPhone";
$tdatavw_counsellee_temp[".exportFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".exportFields"][] = "EmailSecondary";
$tdatavw_counsellee_temp[".exportFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".exportFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".exportFields"][] = "DateOfHarinamInitiation";

$tdatavw_counsellee_temp[".printFields"] = array();
$tdatavw_counsellee_temp[".printFields"][] = "DevoteeId";
$tdatavw_counsellee_temp[".printFields"][] = "TitleId";
$tdatavw_counsellee_temp[".printFields"][] = "Photo";
$tdatavw_counsellee_temp[".printFields"][] = "FirstName";
$tdatavw_counsellee_temp[".printFields"][] = "LastName";
$tdatavw_counsellee_temp[".printFields"][] = "MiddleName";
$tdatavw_counsellee_temp[".printFields"][] = "Gender";
$tdatavw_counsellee_temp[".printFields"][] = "DateOfBirth";
$tdatavw_counsellee_temp[".printFields"][] = "MaritalStatusId";
$tdatavw_counsellee_temp[".printFields"][] = "DateofMarriage";
$tdatavw_counsellee_temp[".printFields"][] = "SpouseDevoteeId";
$tdatavw_counsellee_temp[".printFields"][] = "MobilePhone";
$tdatavw_counsellee_temp[".printFields"][] = "WorkPhone";
$tdatavw_counsellee_temp[".printFields"][] = "EmailPrimary";
$tdatavw_counsellee_temp[".printFields"][] = "EmailSecondary";
$tdatavw_counsellee_temp[".printFields"][] = "CounsellorDevoteeID";
$tdatavw_counsellee_temp[".printFields"][] = "DevoteeId1";
$tdatavw_counsellee_temp[".printFields"][] = "DateOfHarinamInitiation";

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
	
		
		
	$tdatavw_counsellee_temp["DevoteeId"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["TitleId"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["Photo"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["FirstName"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["LastName"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["MiddleName"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["Gender"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["DateOfBirth"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["MaritalStatusId"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["DateofMarriage"] = $fdata;
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
				if(strpos(GetUserPermissions("vw_counsellee_temp"), 'S') !== false)
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
	
		
		
	$tdatavw_counsellee_temp["SpouseDevoteeId"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["MobilePhone"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["WorkPhone"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["EmailPrimary"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["EmailSecondary"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["Password"] = $fdata;
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
	
		
		
	$tdatavw_counsellee_temp["active"] = $fdata;
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
	
		$fdata["bAddPage"] = true; 
	
		
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
	
		
		
	$tdatavw_counsellee_temp["CounsellorDevoteeID"] = $fdata;
//	IsCounsellor
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "IsCounsellor";
	$fdata["GoodName"] = "IsCounsellor";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Is Counsellor"; 
	$fdata["FieldType"] = 16;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "IsCounsellor"; 
		$fdata["FullName"] = "devotee.IsCounsellor";
	
		
		
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
	
		
		
	$tdatavw_counsellee_temp["IsCounsellor"] = $fdata;
//	DevoteeId1
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "DevoteeId1";
	$fdata["GoodName"] = "DevoteeId1";
	$fdata["ownerTable"] = "spiritual_life";
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
		$fdata["FullName"] = "spiritual_life.DevoteeId";
	
		
		
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
	
		
		
	$tdatavw_counsellee_temp["DevoteeId1"] = $fdata;
//	DateOfHarinamInitiation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "DateOfHarinamInitiation";
	$fdata["GoodName"] = "DateOfHarinamInitiation";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Date Of Harinam Initiation"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DateOfHarinamInitiation"; 
		$fdata["FullName"] = "spiritual_life.DateOfHarinamInitiation";
	
		
		
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
	
		
		
	$tdatavw_counsellee_temp["DateOfHarinamInitiation"] = $fdata;

	
$tables_data["vw_counsellee_temp"]=&$tdatavw_counsellee_temp;
$field_labels["vw_counsellee_temp"] = &$fieldLabelsvw_counsellee_temp;
$fieldToolTips["vw_counsellee_temp"] = &$fieldToolTipsvw_counsellee_temp;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_counsellee_temp"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["vw_counsellee_temp"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_vw_counsellee_temp()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "devotee.DevoteeId,  devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID,  devotee.IsCounsellor,  spiritual_life.DevoteeId AS DevoteeId1,  spiritual_life.DateOfHarinamInitiation";
$proto0["m_strFrom"] = "FROM devotee  , spiritual_life";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("vw_counsellee_temp");
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
	"m_sql" => "spiritual_life.DevoteeId"
));

$proto43["m_expr"]=$obj;
$proto43["m_alias"] = "DevoteeId1";
$obj = new SQLFieldListItem($proto43);

$proto0["m_fieldlist"][]=$obj;
						$proto45=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.DateOfHarinamInitiation"
));

$proto45["m_expr"]=$obj;
$proto45["m_alias"] = "";
$obj = new SQLFieldListItem($proto45);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto47=array();
$proto47["m_link"] = "SQLL_MAIN";
			$proto48=array();
$proto48["m_strName"] = "devotee";
$proto48["m_columns"] = array();
$proto48["m_columns"][] = "DevoteeId";
$proto48["m_columns"][] = "TitleId";
$proto48["m_columns"][] = "Photo";
$proto48["m_columns"][] = "FirstName";
$proto48["m_columns"][] = "LastName";
$proto48["m_columns"][] = "MiddleName";
$proto48["m_columns"][] = "Gender";
$proto48["m_columns"][] = "DateOfBirth";
$proto48["m_columns"][] = "MaritalStatusId";
$proto48["m_columns"][] = "DateofMarriage";
$proto48["m_columns"][] = "SpouseDevoteeId";
$proto48["m_columns"][] = "MobilePhone";
$proto48["m_columns"][] = "WorkPhone";
$proto48["m_columns"][] = "EmailPrimary";
$proto48["m_columns"][] = "EmailSecondary";
$proto48["m_columns"][] = "Password";
$proto48["m_columns"][] = "active";
$proto48["m_columns"][] = "CounsellorDevoteeID";
$proto48["m_columns"][] = "IsCounsellor";
$proto48["m_columns"][] = "NativeCity";
$proto48["m_columns"][] = "NativeState";
$proto48["m_columns"][] = "BloodGroup";
$proto48["m_columns"][] = "DateOfHarinamInitiation";
$proto48["m_columns"][] = "DateOfBrahmanInitiation";
$proto48["m_columns"][] = "SpiritualMasterId";
$proto48["m_columns"][] = "PreviousReligion";
$proto48["m_columns"][] = "Chanting16RoundsSince";
$proto48["m_columns"][] = "IntroducedBy";
$proto48["m_columns"][] = "YearOfIntroduction";
$proto48["m_columns"][] = "IntroducedInCenter";
$proto48["m_columns"][] = "PreferedServices";
$proto48["m_columns"][] = "ServicesRendered";
$proto48["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto48);

$proto47["m_table"] = $obj;
$proto47["m_alias"] = "";
$proto49=array();
$proto49["m_sql"] = "";
$proto49["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto49["m_column"]=$obj;
$proto49["m_contained"] = array();
$proto49["m_strCase"] = "";
$proto49["m_havingmode"] = "0";
$proto49["m_inBrackets"] = "0";
$proto49["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto49);

$proto47["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto47);

$proto0["m_fromlist"][]=$obj;
												$proto51=array();
$proto51["m_link"] = "SQLL_MAIN";
			$proto52=array();
$proto52["m_strName"] = "spiritual_life";
$proto52["m_columns"] = array();
$obj = new SQLTable($proto52);

$proto51["m_table"] = $obj;
$proto51["m_alias"] = "";
$proto53=array();
$proto53["m_sql"] = "";
$proto53["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto53["m_column"]=$obj;
$proto53["m_contained"] = array();
$proto53["m_strCase"] = "";
$proto53["m_havingmode"] = "0";
$proto53["m_inBrackets"] = "0";
$proto53["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto53);

$proto51["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto51);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_vw_counsellee_temp = createSqlQuery_vw_counsellee_temp();
																		 $queryData_vw_counsellee_temp->m_fieldlist[15]->m_isEncrypted = true;
					$tdatavw_counsellee_temp[".sqlquery"] = $queryData_vw_counsellee_temp;
	
if(isset($tdatavw_counsellee_temp["field2"])){
	$tdatavw_counsellee_temp["field2"]["LookupTable"] = "carscars_view";
	$tdatavw_counsellee_temp["field2"]["LookupOrderBy"] = "name";
	$tdatavw_counsellee_temp["field2"]["LookupType"] = 4;
	$tdatavw_counsellee_temp["field2"]["LinkField"] = "email";
	$tdatavw_counsellee_temp["field2"]["DisplayField"] = "name";
	$tdatavw_counsellee_temp[".hasCustomViewField"] = true;
}

include_once(getabspath("include/vw_counsellee_temp_events.php"));
$tableEvents["vw_counsellee_temp"] = new eventclass_vw_counsellee_temp;
$tdatavw_counsellee_temp[".hasEvents"] = true;

$cipherer = new RunnerCipherer("vw_counsellee_temp");

?>