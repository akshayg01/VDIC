<?php
require_once(getabspath("classes/cipherer.php"));
$tdataadmin_users = array();
	$tdataadmin_users[".NumberOfChars"] = 80; 
	$tdataadmin_users[".ShortName"] = "admin_users";
	$tdataadmin_users[".OwnerID"] = "DevoteeId";
	$tdataadmin_users[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsadmin_users = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsadmin_users["English"] = array();
	$fieldToolTipsadmin_users["English"] = array();
	$fieldLabelsadmin_users["English"]["Photo"] = "Photo";
	$fieldToolTipsadmin_users["English"]["Photo"] = "";
	$fieldLabelsadmin_users["English"]["Gender"] = "Gender";
	$fieldToolTipsadmin_users["English"]["Gender"] = "";
	$fieldLabelsadmin_users["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsadmin_users["English"]["DevoteeId"] = "";
	$fieldLabelsadmin_users["English"]["TitleId"] = "Title Id";
	$fieldToolTipsadmin_users["English"]["TitleId"] = "";
	$fieldLabelsadmin_users["English"]["FirstName"] = "First Name";
	$fieldToolTipsadmin_users["English"]["FirstName"] = "";
	$fieldLabelsadmin_users["English"]["LastName"] = "Last Name";
	$fieldToolTipsadmin_users["English"]["LastName"] = "";
	$fieldLabelsadmin_users["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsadmin_users["English"]["MiddleName"] = "";
	$fieldLabelsadmin_users["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsadmin_users["English"]["DateOfBirth"] = "";
	$fieldLabelsadmin_users["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsadmin_users["English"]["MaritalStatusId"] = "";
	$fieldLabelsadmin_users["English"]["DateofMarriage"] = "Dateof Marriage";
	$fieldToolTipsadmin_users["English"]["DateofMarriage"] = "";
	$fieldLabelsadmin_users["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsadmin_users["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsadmin_users["English"]["MobilePhone"] = "Mobile Phone";
	$fieldToolTipsadmin_users["English"]["MobilePhone"] = "";
	$fieldLabelsadmin_users["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsadmin_users["English"]["WorkPhone"] = "";
	$fieldLabelsadmin_users["English"]["EmailPrimary"] = "Email Primary";
	$fieldToolTipsadmin_users["English"]["EmailPrimary"] = "";
	$fieldLabelsadmin_users["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsadmin_users["English"]["EmailSecondary"] = "";
	$fieldLabelsadmin_users["English"]["Password"] = "Password";
	$fieldToolTipsadmin_users["English"]["Password"] = "";
	if (count($fieldToolTipsadmin_users["English"]))
		$tdataadmin_users[".isUseToolTips"] = true;
}
	
	
	$tdataadmin_users[".NCSearch"] = true;



$tdataadmin_users[".shortTableName"] = "admin_users";
$tdataadmin_users[".nSecOptions"] = 1;
$tdataadmin_users[".recsPerRowList"] = 1;
$tdataadmin_users[".mainTableOwnerID"] = "DevoteeId";
$tdataadmin_users[".moveNext"] = 1;
$tdataadmin_users[".nType"] = 1;

$tdataadmin_users[".strOriginalTableName"] = "devotee";

$tdataadmin_users[".hasEncryptedFields"] = true;



$tdataadmin_users[".showAddInPopup"] = true;

$tdataadmin_users[".showEditInPopup"] = true;

$tdataadmin_users[".showViewInPopup"] = true;

$tdataadmin_users[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdataadmin_users[".listAjax"] = true;
else 
	$tdataadmin_users[".listAjax"] = false;

	$tdataadmin_users[".audit"] = true;

	$tdataadmin_users[".locking"] = false;

$tdataadmin_users[".listIcons"] = true;
$tdataadmin_users[".inlineEdit"] = true;
$tdataadmin_users[".inlineAdd"] = true;

$tdataadmin_users[".exportTo"] = true;

$tdataadmin_users[".printFriendly"] = true;

$tdataadmin_users[".delete"] = true;

$tdataadmin_users[".showSimpleSearchOptions"] = true;

$tdataadmin_users[".showSearchPanel"] = true;

if (isMobile())
	$tdataadmin_users[".isUseAjaxSuggest"] = false;
else 
	$tdataadmin_users[".isUseAjaxSuggest"] = true;

$tdataadmin_users[".rowHighlite"] = true;

// button handlers file names

$tdataadmin_users[".addPageEvents"] = false;

// use timepicker for search panel
$tdataadmin_users[".isUseTimeForSearch"] = false;




$tdataadmin_users[".allSearchFields"] = array();

$tdataadmin_users[".allSearchFields"][] = "DevoteeId";
$tdataadmin_users[".allSearchFields"][] = "TitleId";
$tdataadmin_users[".allSearchFields"][] = "FirstName";
$tdataadmin_users[".allSearchFields"][] = "LastName";
$tdataadmin_users[".allSearchFields"][] = "MiddleName";
$tdataadmin_users[".allSearchFields"][] = "Gender";
$tdataadmin_users[".allSearchFields"][] = "DateOfBirth";
$tdataadmin_users[".allSearchFields"][] = "MaritalStatusId";
$tdataadmin_users[".allSearchFields"][] = "DateofMarriage";
$tdataadmin_users[".allSearchFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".allSearchFields"][] = "MobilePhone";
$tdataadmin_users[".allSearchFields"][] = "WorkPhone";
$tdataadmin_users[".allSearchFields"][] = "EmailPrimary";
$tdataadmin_users[".allSearchFields"][] = "EmailSecondary";
$tdataadmin_users[".allSearchFields"][] = "Password";

$tdataadmin_users[".googleLikeFields"][] = "DevoteeId";
$tdataadmin_users[".googleLikeFields"][] = "TitleId";
$tdataadmin_users[".googleLikeFields"][] = "FirstName";
$tdataadmin_users[".googleLikeFields"][] = "LastName";
$tdataadmin_users[".googleLikeFields"][] = "MiddleName";
$tdataadmin_users[".googleLikeFields"][] = "Gender";
$tdataadmin_users[".googleLikeFields"][] = "DateOfBirth";
$tdataadmin_users[".googleLikeFields"][] = "MaritalStatusId";
$tdataadmin_users[".googleLikeFields"][] = "DateofMarriage";
$tdataadmin_users[".googleLikeFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".googleLikeFields"][] = "MobilePhone";
$tdataadmin_users[".googleLikeFields"][] = "WorkPhone";
$tdataadmin_users[".googleLikeFields"][] = "EmailPrimary";
$tdataadmin_users[".googleLikeFields"][] = "EmailSecondary";
$tdataadmin_users[".googleLikeFields"][] = "Password";


$tdataadmin_users[".advSearchFields"][] = "DevoteeId";
$tdataadmin_users[".advSearchFields"][] = "TitleId";
$tdataadmin_users[".advSearchFields"][] = "FirstName";
$tdataadmin_users[".advSearchFields"][] = "LastName";
$tdataadmin_users[".advSearchFields"][] = "MiddleName";
$tdataadmin_users[".advSearchFields"][] = "Gender";
$tdataadmin_users[".advSearchFields"][] = "DateOfBirth";
$tdataadmin_users[".advSearchFields"][] = "MaritalStatusId";
$tdataadmin_users[".advSearchFields"][] = "DateofMarriage";
$tdataadmin_users[".advSearchFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".advSearchFields"][] = "MobilePhone";
$tdataadmin_users[".advSearchFields"][] = "WorkPhone";
$tdataadmin_users[".advSearchFields"][] = "EmailPrimary";
$tdataadmin_users[".advSearchFields"][] = "EmailSecondary";
$tdataadmin_users[".advSearchFields"][] = "Password";

$tdataadmin_users[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main


$tdataadmin_users[".totalsFields"][] = array(
	"fName" => "DevoteeId", 
	"numRows" => 0,
	"totalsType" => "COUNT",
	"viewFormat" => '');

$tdataadmin_users[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdataadmin_users[".strOrderBy"] = $tstrOrderBy;

$tdataadmin_users[".orderindexes"] = array();

$tdataadmin_users[".sqlHead"] = "SELECT DevoteeId,  TitleId,  Photo,  FirstName,  LastName,  MiddleName,  Gender,  DateOfBirth,  MaritalStatusId,  DateofMarriage,  SpouseDevoteeId,  MobilePhone,  WorkPhone,  EmailPrimary,  EmailSecondary,  Password";
$tdataadmin_users[".sqlFrom"] = "FROM devotee";
$tdataadmin_users[".sqlWhereExpr"] = "";
$tdataadmin_users[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataadmin_users[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataadmin_users[".arrGroupsPerPage"] = $arrGPP;

$tableKeysadmin_users = array();
$tableKeysadmin_users[] = "DevoteeId";
$tdataadmin_users[".Keys"] = $tableKeysadmin_users;

$tdataadmin_users[".listFields"] = array();
$tdataadmin_users[".listFields"][] = "Password";
$tdataadmin_users[".listFields"][] = "DevoteeId";
$tdataadmin_users[".listFields"][] = "TitleId";
$tdataadmin_users[".listFields"][] = "Photo";
$tdataadmin_users[".listFields"][] = "FirstName";
$tdataadmin_users[".listFields"][] = "LastName";
$tdataadmin_users[".listFields"][] = "MiddleName";
$tdataadmin_users[".listFields"][] = "Gender";
$tdataadmin_users[".listFields"][] = "DateOfBirth";
$tdataadmin_users[".listFields"][] = "MaritalStatusId";
$tdataadmin_users[".listFields"][] = "DateofMarriage";
$tdataadmin_users[".listFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".listFields"][] = "MobilePhone";
$tdataadmin_users[".listFields"][] = "WorkPhone";
$tdataadmin_users[".listFields"][] = "EmailPrimary";
$tdataadmin_users[".listFields"][] = "EmailSecondary";

$tdataadmin_users[".viewFields"] = array();

$tdataadmin_users[".addFields"] = array();

$tdataadmin_users[".inlineAddFields"] = array();
$tdataadmin_users[".inlineAddFields"][] = "Password";
$tdataadmin_users[".inlineAddFields"][] = "TitleId";
$tdataadmin_users[".inlineAddFields"][] = "Photo";
$tdataadmin_users[".inlineAddFields"][] = "FirstName";
$tdataadmin_users[".inlineAddFields"][] = "LastName";
$tdataadmin_users[".inlineAddFields"][] = "MiddleName";
$tdataadmin_users[".inlineAddFields"][] = "Gender";
$tdataadmin_users[".inlineAddFields"][] = "DateOfBirth";
$tdataadmin_users[".inlineAddFields"][] = "MaritalStatusId";
$tdataadmin_users[".inlineAddFields"][] = "DateofMarriage";
$tdataadmin_users[".inlineAddFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".inlineAddFields"][] = "MobilePhone";
$tdataadmin_users[".inlineAddFields"][] = "WorkPhone";
$tdataadmin_users[".inlineAddFields"][] = "EmailPrimary";
$tdataadmin_users[".inlineAddFields"][] = "EmailSecondary";

$tdataadmin_users[".editFields"] = array();

$tdataadmin_users[".inlineEditFields"] = array();
$tdataadmin_users[".inlineEditFields"][] = "Password";
$tdataadmin_users[".inlineEditFields"][] = "TitleId";
$tdataadmin_users[".inlineEditFields"][] = "Photo";
$tdataadmin_users[".inlineEditFields"][] = "FirstName";
$tdataadmin_users[".inlineEditFields"][] = "LastName";
$tdataadmin_users[".inlineEditFields"][] = "MiddleName";
$tdataadmin_users[".inlineEditFields"][] = "Gender";
$tdataadmin_users[".inlineEditFields"][] = "DateOfBirth";
$tdataadmin_users[".inlineEditFields"][] = "MaritalStatusId";
$tdataadmin_users[".inlineEditFields"][] = "DateofMarriage";
$tdataadmin_users[".inlineEditFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".inlineEditFields"][] = "MobilePhone";
$tdataadmin_users[".inlineEditFields"][] = "WorkPhone";
$tdataadmin_users[".inlineEditFields"][] = "EmailPrimary";
$tdataadmin_users[".inlineEditFields"][] = "EmailSecondary";

$tdataadmin_users[".exportFields"] = array();
$tdataadmin_users[".exportFields"][] = "DevoteeId";
$tdataadmin_users[".exportFields"][] = "TitleId";
$tdataadmin_users[".exportFields"][] = "Photo";
$tdataadmin_users[".exportFields"][] = "FirstName";
$tdataadmin_users[".exportFields"][] = "LastName";
$tdataadmin_users[".exportFields"][] = "MiddleName";
$tdataadmin_users[".exportFields"][] = "Gender";
$tdataadmin_users[".exportFields"][] = "DateOfBirth";
$tdataadmin_users[".exportFields"][] = "MaritalStatusId";
$tdataadmin_users[".exportFields"][] = "DateofMarriage";
$tdataadmin_users[".exportFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".exportFields"][] = "MobilePhone";
$tdataadmin_users[".exportFields"][] = "WorkPhone";
$tdataadmin_users[".exportFields"][] = "EmailPrimary";
$tdataadmin_users[".exportFields"][] = "EmailSecondary";
$tdataadmin_users[".exportFields"][] = "Password";

$tdataadmin_users[".printFields"] = array();
$tdataadmin_users[".printFields"][] = "DevoteeId";
$tdataadmin_users[".printFields"][] = "TitleId";
$tdataadmin_users[".printFields"][] = "Photo";
$tdataadmin_users[".printFields"][] = "FirstName";
$tdataadmin_users[".printFields"][] = "LastName";
$tdataadmin_users[".printFields"][] = "MiddleName";
$tdataadmin_users[".printFields"][] = "Gender";
$tdataadmin_users[".printFields"][] = "DateOfBirth";
$tdataadmin_users[".printFields"][] = "MaritalStatusId";
$tdataadmin_users[".printFields"][] = "DateofMarriage";
$tdataadmin_users[".printFields"][] = "SpouseDevoteeId";
$tdataadmin_users[".printFields"][] = "MobilePhone";
$tdataadmin_users[".printFields"][] = "WorkPhone";
$tdataadmin_users[".printFields"][] = "EmailPrimary";
$tdataadmin_users[".printFields"][] = "EmailSecondary";
$tdataadmin_users[".printFields"][] = "Password";

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
	
		
		
	$tdataadmin_users["DevoteeId"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["TitleId"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
		
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
	
		
		
	$tdataadmin_users["Photo"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["FirstName"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["LastName"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["MiddleName"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["Gender"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["DateOfBirth"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["MaritalStatusId"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["DateofMarriage"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["SpouseDevoteeId"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["MobilePhone"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["WorkPhone"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["EmailPrimary"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["EmailSecondary"] = $fdata;
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
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		
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
	
		
		
	$tdataadmin_users["Password"] = $fdata;

	
$tables_data["admin_users"]=&$tdataadmin_users;
$field_labels["admin_users"] = &$fieldLabelsadmin_users;
$fieldToolTips["admin_users"] = &$fieldToolTipsadmin_users;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["admin_users"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["admin_users"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_admin_users()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DevoteeId,  TitleId,  Photo,  FirstName,  LastName,  MiddleName,  Gender,  DateOfBirth,  MaritalStatusId,  DateofMarriage,  SpouseDevoteeId,  MobilePhone,  WorkPhone,  EmailPrimary,  EmailSecondary,  Password";
$proto0["m_strFrom"] = "FROM devotee";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("admin_users");
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
$queryData_admin_users = createSqlQuery_admin_users();
																		 $queryData_admin_users->m_fieldlist[15]->m_isEncrypted = true;
$tdataadmin_users[".sqlquery"] = $queryData_admin_users;
	
if(isset($tdataadmin_users["field2"])){
	$tdataadmin_users["field2"]["LookupTable"] = "carscars_view";
	$tdataadmin_users["field2"]["LookupOrderBy"] = "name";
	$tdataadmin_users["field2"]["LookupType"] = 4;
	$tdataadmin_users["field2"]["LinkField"] = "email";
	$tdataadmin_users["field2"]["DisplayField"] = "name";
	$tdataadmin_users[".hasCustomViewField"] = true;
}

$tableEvents["admin_users"] = new eventsBase;
$tdataadmin_users[".hasEvents"] = false;

$cipherer = new RunnerCipherer("admin_users");

?>