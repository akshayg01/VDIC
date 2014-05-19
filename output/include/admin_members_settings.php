<?php
require_once(getabspath("classes/cipherer.php"));
$tdataadmin_members = array();
	$tdataadmin_members[".NumberOfChars"] = 80; 
	$tdataadmin_members[".ShortName"] = "admin_members";
	$tdataadmin_members[".OwnerID"] = "DevoteeId";
	$tdataadmin_members[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsadmin_members = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsadmin_members["English"] = array();
	$fieldToolTipsadmin_members["English"] = array();
	$fieldLabelsadmin_members["English"]["Photo"] = "Photo";
	$fieldToolTipsadmin_members["English"]["Photo"] = "";
	$fieldLabelsadmin_members["English"]["Gender"] = "Gender";
	$fieldToolTipsadmin_members["English"]["Gender"] = "";
	$fieldLabelsadmin_members["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsadmin_members["English"]["DevoteeId"] = "";
	$fieldLabelsadmin_members["English"]["TitleId"] = "Title Id";
	$fieldToolTipsadmin_members["English"]["TitleId"] = "";
	$fieldLabelsadmin_members["English"]["FirstName"] = "First Name";
	$fieldToolTipsadmin_members["English"]["FirstName"] = "";
	$fieldLabelsadmin_members["English"]["LastName"] = "Last Name";
	$fieldToolTipsadmin_members["English"]["LastName"] = "";
	$fieldLabelsadmin_members["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsadmin_members["English"]["MiddleName"] = "";
	$fieldLabelsadmin_members["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsadmin_members["English"]["DateOfBirth"] = "";
	$fieldLabelsadmin_members["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsadmin_members["English"]["MaritalStatusId"] = "";
	$fieldLabelsadmin_members["English"]["DateofMarriage"] = "Dateof Marriage";
	$fieldToolTipsadmin_members["English"]["DateofMarriage"] = "";
	$fieldLabelsadmin_members["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsadmin_members["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsadmin_members["English"]["MobilePhone"] = "Mobile Phone";
	$fieldToolTipsadmin_members["English"]["MobilePhone"] = "";
	$fieldLabelsadmin_members["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsadmin_members["English"]["WorkPhone"] = "";
	$fieldLabelsadmin_members["English"]["EmailPrimary"] = "Email Primary";
	$fieldToolTipsadmin_members["English"]["EmailPrimary"] = "";
	$fieldLabelsadmin_members["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsadmin_members["English"]["EmailSecondary"] = "";
	$fieldLabelsadmin_members["English"]["Password"] = "Password";
	$fieldToolTipsadmin_members["English"]["Password"] = "";
	if (count($fieldToolTipsadmin_members["English"]))
		$tdataadmin_members[".isUseToolTips"] = true;
}
	
	
	$tdataadmin_members[".NCSearch"] = true;



$tdataadmin_members[".shortTableName"] = "admin_members";
$tdataadmin_members[".nSecOptions"] = 1;
$tdataadmin_members[".recsPerRowList"] = 1;
$tdataadmin_members[".mainTableOwnerID"] = "DevoteeId";
$tdataadmin_members[".moveNext"] = 1;
$tdataadmin_members[".nType"] = 1;

$tdataadmin_members[".strOriginalTableName"] = "devotee";

$tdataadmin_members[".hasEncryptedFields"] = true;



$tdataadmin_members[".showAddInPopup"] = false;

$tdataadmin_members[".showEditInPopup"] = false;

$tdataadmin_members[".showViewInPopup"] = false;

$tdataadmin_members[".fieldsForRegister"] = array();
	
$tdataadmin_members[".listAjax"] = false;

	$tdataadmin_members[".audit"] = true;

	$tdataadmin_members[".locking"] = false;

$tdataadmin_members[".listIcons"] = true;




$tdataadmin_members[".showSimpleSearchOptions"] = true;

$tdataadmin_members[".showSearchPanel"] = true;

if (isMobile())
	$tdataadmin_members[".isUseAjaxSuggest"] = false;
else 
	$tdataadmin_members[".isUseAjaxSuggest"] = true;

$tdataadmin_members[".rowHighlite"] = true;

// button handlers file names

$tdataadmin_members[".addPageEvents"] = false;

// use timepicker for search panel
$tdataadmin_members[".isUseTimeForSearch"] = false;




$tdataadmin_members[".allSearchFields"] = array();

$tdataadmin_members[".allSearchFields"][] = "DevoteeId";
$tdataadmin_members[".allSearchFields"][] = "TitleId";
$tdataadmin_members[".allSearchFields"][] = "FirstName";
$tdataadmin_members[".allSearchFields"][] = "LastName";
$tdataadmin_members[".allSearchFields"][] = "MiddleName";
$tdataadmin_members[".allSearchFields"][] = "Gender";
$tdataadmin_members[".allSearchFields"][] = "DateOfBirth";
$tdataadmin_members[".allSearchFields"][] = "MaritalStatusId";
$tdataadmin_members[".allSearchFields"][] = "DateofMarriage";
$tdataadmin_members[".allSearchFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".allSearchFields"][] = "MobilePhone";
$tdataadmin_members[".allSearchFields"][] = "WorkPhone";
$tdataadmin_members[".allSearchFields"][] = "EmailPrimary";
$tdataadmin_members[".allSearchFields"][] = "EmailSecondary";
$tdataadmin_members[".allSearchFields"][] = "Password";

$tdataadmin_members[".googleLikeFields"][] = "DevoteeId";
$tdataadmin_members[".googleLikeFields"][] = "TitleId";
$tdataadmin_members[".googleLikeFields"][] = "FirstName";
$tdataadmin_members[".googleLikeFields"][] = "LastName";
$tdataadmin_members[".googleLikeFields"][] = "MiddleName";
$tdataadmin_members[".googleLikeFields"][] = "Gender";
$tdataadmin_members[".googleLikeFields"][] = "DateOfBirth";
$tdataadmin_members[".googleLikeFields"][] = "MaritalStatusId";
$tdataadmin_members[".googleLikeFields"][] = "DateofMarriage";
$tdataadmin_members[".googleLikeFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".googleLikeFields"][] = "MobilePhone";
$tdataadmin_members[".googleLikeFields"][] = "WorkPhone";
$tdataadmin_members[".googleLikeFields"][] = "EmailPrimary";
$tdataadmin_members[".googleLikeFields"][] = "EmailSecondary";
$tdataadmin_members[".googleLikeFields"][] = "Password";


$tdataadmin_members[".advSearchFields"][] = "DevoteeId";
$tdataadmin_members[".advSearchFields"][] = "TitleId";
$tdataadmin_members[".advSearchFields"][] = "FirstName";
$tdataadmin_members[".advSearchFields"][] = "LastName";
$tdataadmin_members[".advSearchFields"][] = "MiddleName";
$tdataadmin_members[".advSearchFields"][] = "Gender";
$tdataadmin_members[".advSearchFields"][] = "DateOfBirth";
$tdataadmin_members[".advSearchFields"][] = "MaritalStatusId";
$tdataadmin_members[".advSearchFields"][] = "DateofMarriage";
$tdataadmin_members[".advSearchFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".advSearchFields"][] = "MobilePhone";
$tdataadmin_members[".advSearchFields"][] = "WorkPhone";
$tdataadmin_members[".advSearchFields"][] = "EmailPrimary";
$tdataadmin_members[".advSearchFields"][] = "EmailSecondary";
$tdataadmin_members[".advSearchFields"][] = "Password";

$tdataadmin_members[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main


$tdataadmin_members[".totalsFields"][] = array(
	"fName" => "DevoteeId", 
	"numRows" => 0,
	"totalsType" => "COUNT",
	"viewFormat" => '');

$tdataadmin_members[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdataadmin_members[".strOrderBy"] = $tstrOrderBy;

$tdataadmin_members[".orderindexes"] = array();

$tdataadmin_members[".sqlHead"] = "SELECT DevoteeId,   TitleId,   Photo,   FirstName,   LastName,   MiddleName,   Gender,   DateOfBirth,   MaritalStatusId,   DateofMarriage,   SpouseDevoteeId,   MobilePhone,   WorkPhone,   EmailPrimary,   EmailSecondary,   Password";
$tdataadmin_members[".sqlFrom"] = "FROM devotee";
$tdataadmin_members[".sqlWhereExpr"] = "";
$tdataadmin_members[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataadmin_members[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataadmin_members[".arrGroupsPerPage"] = $arrGPP;

$tableKeysadmin_members = array();
$tableKeysadmin_members[] = "DevoteeId";
$tdataadmin_members[".Keys"] = $tableKeysadmin_members;

$tdataadmin_members[".listFields"] = array();
$tdataadmin_members[".listFields"][] = "Password";
$tdataadmin_members[".listFields"][] = "DevoteeId";
$tdataadmin_members[".listFields"][] = "TitleId";
$tdataadmin_members[".listFields"][] = "Photo";
$tdataadmin_members[".listFields"][] = "FirstName";
$tdataadmin_members[".listFields"][] = "LastName";
$tdataadmin_members[".listFields"][] = "MiddleName";
$tdataadmin_members[".listFields"][] = "Gender";
$tdataadmin_members[".listFields"][] = "DateOfBirth";
$tdataadmin_members[".listFields"][] = "MaritalStatusId";
$tdataadmin_members[".listFields"][] = "DateofMarriage";
$tdataadmin_members[".listFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".listFields"][] = "MobilePhone";
$tdataadmin_members[".listFields"][] = "WorkPhone";
$tdataadmin_members[".listFields"][] = "EmailPrimary";
$tdataadmin_members[".listFields"][] = "EmailSecondary";

$tdataadmin_members[".viewFields"] = array();
$tdataadmin_members[".viewFields"][] = "DevoteeId";
$tdataadmin_members[".viewFields"][] = "TitleId";
$tdataadmin_members[".viewFields"][] = "Photo";
$tdataadmin_members[".viewFields"][] = "FirstName";
$tdataadmin_members[".viewFields"][] = "LastName";
$tdataadmin_members[".viewFields"][] = "MiddleName";
$tdataadmin_members[".viewFields"][] = "Gender";
$tdataadmin_members[".viewFields"][] = "DateOfBirth";
$tdataadmin_members[".viewFields"][] = "MaritalStatusId";
$tdataadmin_members[".viewFields"][] = "DateofMarriage";
$tdataadmin_members[".viewFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".viewFields"][] = "MobilePhone";
$tdataadmin_members[".viewFields"][] = "WorkPhone";
$tdataadmin_members[".viewFields"][] = "EmailPrimary";
$tdataadmin_members[".viewFields"][] = "EmailSecondary";
$tdataadmin_members[".viewFields"][] = "Password";

$tdataadmin_members[".addFields"] = array();
$tdataadmin_members[".addFields"][] = "TitleId";
$tdataadmin_members[".addFields"][] = "Photo";
$tdataadmin_members[".addFields"][] = "FirstName";
$tdataadmin_members[".addFields"][] = "LastName";
$tdataadmin_members[".addFields"][] = "MiddleName";
$tdataadmin_members[".addFields"][] = "Gender";
$tdataadmin_members[".addFields"][] = "DateOfBirth";
$tdataadmin_members[".addFields"][] = "MaritalStatusId";
$tdataadmin_members[".addFields"][] = "DateofMarriage";
$tdataadmin_members[".addFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".addFields"][] = "MobilePhone";
$tdataadmin_members[".addFields"][] = "WorkPhone";
$tdataadmin_members[".addFields"][] = "EmailPrimary";
$tdataadmin_members[".addFields"][] = "EmailSecondary";
$tdataadmin_members[".addFields"][] = "Password";

$tdataadmin_members[".inlineAddFields"] = array();
$tdataadmin_members[".inlineAddFields"][] = "Password";
$tdataadmin_members[".inlineAddFields"][] = "TitleId";
$tdataadmin_members[".inlineAddFields"][] = "Photo";
$tdataadmin_members[".inlineAddFields"][] = "FirstName";
$tdataadmin_members[".inlineAddFields"][] = "LastName";
$tdataadmin_members[".inlineAddFields"][] = "MiddleName";
$tdataadmin_members[".inlineAddFields"][] = "Gender";
$tdataadmin_members[".inlineAddFields"][] = "DateOfBirth";
$tdataadmin_members[".inlineAddFields"][] = "MaritalStatusId";
$tdataadmin_members[".inlineAddFields"][] = "DateofMarriage";
$tdataadmin_members[".inlineAddFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".inlineAddFields"][] = "MobilePhone";
$tdataadmin_members[".inlineAddFields"][] = "WorkPhone";
$tdataadmin_members[".inlineAddFields"][] = "EmailPrimary";
$tdataadmin_members[".inlineAddFields"][] = "EmailSecondary";

$tdataadmin_members[".editFields"] = array();
$tdataadmin_members[".editFields"][] = "DevoteeId";
$tdataadmin_members[".editFields"][] = "TitleId";
$tdataadmin_members[".editFields"][] = "Photo";
$tdataadmin_members[".editFields"][] = "FirstName";
$tdataadmin_members[".editFields"][] = "LastName";
$tdataadmin_members[".editFields"][] = "MiddleName";
$tdataadmin_members[".editFields"][] = "Gender";
$tdataadmin_members[".editFields"][] = "DateOfBirth";
$tdataadmin_members[".editFields"][] = "MaritalStatusId";
$tdataadmin_members[".editFields"][] = "DateofMarriage";
$tdataadmin_members[".editFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".editFields"][] = "MobilePhone";
$tdataadmin_members[".editFields"][] = "WorkPhone";
$tdataadmin_members[".editFields"][] = "EmailPrimary";
$tdataadmin_members[".editFields"][] = "EmailSecondary";
$tdataadmin_members[".editFields"][] = "Password";

$tdataadmin_members[".inlineEditFields"] = array();
$tdataadmin_members[".inlineEditFields"][] = "Password";
$tdataadmin_members[".inlineEditFields"][] = "DevoteeId";
$tdataadmin_members[".inlineEditFields"][] = "TitleId";
$tdataadmin_members[".inlineEditFields"][] = "Photo";
$tdataadmin_members[".inlineEditFields"][] = "FirstName";
$tdataadmin_members[".inlineEditFields"][] = "LastName";
$tdataadmin_members[".inlineEditFields"][] = "MiddleName";
$tdataadmin_members[".inlineEditFields"][] = "Gender";
$tdataadmin_members[".inlineEditFields"][] = "DateOfBirth";
$tdataadmin_members[".inlineEditFields"][] = "MaritalStatusId";
$tdataadmin_members[".inlineEditFields"][] = "DateofMarriage";
$tdataadmin_members[".inlineEditFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".inlineEditFields"][] = "MobilePhone";
$tdataadmin_members[".inlineEditFields"][] = "WorkPhone";
$tdataadmin_members[".inlineEditFields"][] = "EmailPrimary";
$tdataadmin_members[".inlineEditFields"][] = "EmailSecondary";

$tdataadmin_members[".exportFields"] = array();
$tdataadmin_members[".exportFields"][] = "DevoteeId";
$tdataadmin_members[".exportFields"][] = "TitleId";
$tdataadmin_members[".exportFields"][] = "Photo";
$tdataadmin_members[".exportFields"][] = "FirstName";
$tdataadmin_members[".exportFields"][] = "LastName";
$tdataadmin_members[".exportFields"][] = "MiddleName";
$tdataadmin_members[".exportFields"][] = "Gender";
$tdataadmin_members[".exportFields"][] = "DateOfBirth";
$tdataadmin_members[".exportFields"][] = "MaritalStatusId";
$tdataadmin_members[".exportFields"][] = "DateofMarriage";
$tdataadmin_members[".exportFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".exportFields"][] = "MobilePhone";
$tdataadmin_members[".exportFields"][] = "WorkPhone";
$tdataadmin_members[".exportFields"][] = "EmailPrimary";
$tdataadmin_members[".exportFields"][] = "EmailSecondary";
$tdataadmin_members[".exportFields"][] = "Password";

$tdataadmin_members[".printFields"] = array();
$tdataadmin_members[".printFields"][] = "DevoteeId";
$tdataadmin_members[".printFields"][] = "TitleId";
$tdataadmin_members[".printFields"][] = "Photo";
$tdataadmin_members[".printFields"][] = "FirstName";
$tdataadmin_members[".printFields"][] = "LastName";
$tdataadmin_members[".printFields"][] = "MiddleName";
$tdataadmin_members[".printFields"][] = "Gender";
$tdataadmin_members[".printFields"][] = "DateOfBirth";
$tdataadmin_members[".printFields"][] = "MaritalStatusId";
$tdataadmin_members[".printFields"][] = "DateofMarriage";
$tdataadmin_members[".printFields"][] = "SpouseDevoteeId";
$tdataadmin_members[".printFields"][] = "MobilePhone";
$tdataadmin_members[".printFields"][] = "WorkPhone";
$tdataadmin_members[".printFields"][] = "EmailPrimary";
$tdataadmin_members[".printFields"][] = "EmailSecondary";
$tdataadmin_members[".printFields"][] = "Password";

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
	
		
		
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "DevoteeId";
	
		
		
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
	
		
		
	$tdataadmin_members["DevoteeId"] = $fdata;
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
		$fdata["FullName"] = "TitleId";
	
		
		
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
	
		
		
	$tdataadmin_members["TitleId"] = $fdata;
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
		$fdata["FullName"] = "Photo";
	
		
		
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
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataadmin_members["Photo"] = $fdata;
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
		$fdata["FullName"] = "FirstName";
	
		
		
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
	
		
		
	$tdataadmin_members["FirstName"] = $fdata;
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
		$fdata["FullName"] = "LastName";
	
		
		
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
	
		
		
	$tdataadmin_members["LastName"] = $fdata;
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
		$fdata["FullName"] = "MiddleName";
	
		
		
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
	
		
		
	$tdataadmin_members["MiddleName"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Gender"; 
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
	
		$fdata["strField"] = "Gender"; 
		$fdata["FullName"] = "Gender";
	
		
		
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
			$edata["EditParams"].= " maxlength=200";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataadmin_members["Gender"] = $fdata;
//	DateOfBirth
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "DateOfBirth";
	$fdata["GoodName"] = "DateOfBirth";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Birth"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DateOfBirth"; 
		$fdata["FullName"] = "DateOfBirth";
	
		
		
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
	
		
		
	$tdataadmin_members["DateOfBirth"] = $fdata;
//	MaritalStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "MaritalStatusId";
	$fdata["GoodName"] = "MaritalStatusId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Marital Status Id"; 
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
	
		$fdata["strField"] = "MaritalStatusId"; 
		$fdata["FullName"] = "MaritalStatusId";
	
		
		
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
	
		
		
	$tdataadmin_members["MaritalStatusId"] = $fdata;
//	DateofMarriage
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "DateofMarriage";
	$fdata["GoodName"] = "DateofMarriage";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Dateof Marriage"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DateofMarriage"; 
		$fdata["FullName"] = "DateofMarriage";
	
		
		
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
	
		
		
	$tdataadmin_members["DateofMarriage"] = $fdata;
//	SpouseDevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "SpouseDevoteeId";
	$fdata["GoodName"] = "SpouseDevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Spouse Devotee Id"; 
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
	
		$fdata["strField"] = "SpouseDevoteeId"; 
		$fdata["FullName"] = "SpouseDevoteeId";
	
		
		
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
	
		
		
	$tdataadmin_members["SpouseDevoteeId"] = $fdata;
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
		$fdata["FullName"] = "MobilePhone";
	
		
		
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
	
		
		
	$tdataadmin_members["MobilePhone"] = $fdata;
//	WorkPhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "WorkPhone";
	$fdata["GoodName"] = "WorkPhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Work Phone"; 
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
	
		$fdata["strField"] = "WorkPhone"; 
		$fdata["FullName"] = "WorkPhone";
	
		
		
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
	
		
		
	$tdataadmin_members["WorkPhone"] = $fdata;
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
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "EmailPrimary"; 
		$fdata["FullName"] = "EmailPrimary";
	
		
		
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
	
		
		
	$tdataadmin_members["EmailPrimary"] = $fdata;
//	EmailSecondary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "EmailSecondary";
	$fdata["GoodName"] = "EmailSecondary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Secondary"; 
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
	
		$fdata["strField"] = "EmailSecondary"; 
		$fdata["FullName"] = "EmailSecondary";
	
		
		
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
	
		
		
	$tdataadmin_members["EmailSecondary"] = $fdata;
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
	
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Password"; 
		$fdata["FullName"] = "Password";
	
		
		
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
	
		
		
	$tdataadmin_members["Password"] = $fdata;

	
$tables_data["admin_members"]=&$tdataadmin_members;
$field_labels["admin_members"] = &$fieldLabelsadmin_members;
$fieldToolTips["admin_members"] = &$fieldToolTipsadmin_members;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["admin_members"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["admin_members"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_admin_members()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DevoteeId,   TitleId,   Photo,   FirstName,   LastName,   MiddleName,   Gender,   DateOfBirth,   MaritalStatusId,   DateofMarriage,   SpouseDevoteeId,   MobilePhone,   WorkPhone,   EmailPrimary,   EmailSecondary,   Password";
$proto0["m_strFrom"] = "FROM devotee";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("admin_members");
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
			$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "devotee"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Photo",
	"m_strTable" => "devotee"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "FirstName",
	"m_strTable" => "devotee"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "LastName",
	"m_strTable" => "devotee"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "MiddleName",
	"m_strTable" => "devotee"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Gender",
	"m_strTable" => "devotee"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "DateOfBirth",
	"m_strTable" => "devotee"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "MaritalStatusId",
	"m_strTable" => "devotee"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "DateofMarriage",
	"m_strTable" => "devotee"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "SpouseDevoteeId",
	"m_strTable" => "devotee"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "MobilePhone",
	"m_strTable" => "devotee"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "WorkPhone",
	"m_strTable" => "devotee"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailPrimary",
	"m_strTable" => "devotee"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailSecondary",
	"m_strTable" => "devotee"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "Password",
	"m_strTable" => "devotee"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto37=array();
$proto37["m_link"] = "SQLL_MAIN";
			$proto38=array();
$proto38["m_strName"] = "devotee";
$proto38["m_columns"] = array();
$proto38["m_columns"][] = "DevoteeId";
$proto38["m_columns"][] = "TitleId";
$proto38["m_columns"][] = "Photo";
$proto38["m_columns"][] = "FirstName";
$proto38["m_columns"][] = "LastName";
$proto38["m_columns"][] = "MiddleName";
$proto38["m_columns"][] = "Gender";
$proto38["m_columns"][] = "DateOfBirth";
$proto38["m_columns"][] = "MaritalStatusId";
$proto38["m_columns"][] = "DateofMarriage";
$proto38["m_columns"][] = "SpouseDevoteeId";
$proto38["m_columns"][] = "MobilePhone";
$proto38["m_columns"][] = "WorkPhone";
$proto38["m_columns"][] = "EmailPrimary";
$proto38["m_columns"][] = "EmailSecondary";
$proto38["m_columns"][] = "Password";
$proto38["m_columns"][] = "active";
$proto38["m_columns"][] = "CounsellorDevoteeID";
$proto38["m_columns"][] = "IsCounsellor";
$proto38["m_columns"][] = "NativeCity";
$proto38["m_columns"][] = "NativeState";
$proto38["m_columns"][] = "BloodGroup";
$proto38["m_columns"][] = "DateOfHarinamInitiation";
$proto38["m_columns"][] = "DateOfBrahmanInitiation";
$proto38["m_columns"][] = "SpiritualMasterId";
$proto38["m_columns"][] = "PreviousReligion";
$proto38["m_columns"][] = "Chanting16RoundsSince";
$proto38["m_columns"][] = "IntroducedBy";
$proto38["m_columns"][] = "YearOfIntroduction";
$proto38["m_columns"][] = "IntroducedInCenter";
$proto38["m_columns"][] = "PreferedServices";
$proto38["m_columns"][] = "ServicesRendered";
$proto38["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto38);

$proto37["m_table"] = $obj;
$proto37["m_alias"] = "";
$proto39=array();
$proto39["m_sql"] = "";
$proto39["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto39["m_column"]=$obj;
$proto39["m_contained"] = array();
$proto39["m_strCase"] = "";
$proto39["m_havingmode"] = "0";
$proto39["m_inBrackets"] = "0";
$proto39["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto39);

$proto37["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto37);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_admin_members = createSqlQuery_admin_members();
																		 $queryData_admin_members->m_fieldlist[15]->m_isEncrypted = true;
$tdataadmin_members[".sqlquery"] = $queryData_admin_members;
	
if(isset($tdataadmin_members["field2"])){
	$tdataadmin_members["field2"]["LookupTable"] = "carscars_view";
	$tdataadmin_members["field2"]["LookupOrderBy"] = "name";
	$tdataadmin_members["field2"]["LookupType"] = 4;
	$tdataadmin_members["field2"]["LinkField"] = "email";
	$tdataadmin_members["field2"]["DisplayField"] = "name";
	$tdataadmin_members[".hasCustomViewField"] = true;
}

$tableEvents["admin_members"] = new eventsBase;
$tdataadmin_members[".hasEvents"] = false;

$cipherer = new RunnerCipherer("admin_members");

?>