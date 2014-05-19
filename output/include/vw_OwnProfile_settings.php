<?php
require_once(getabspath("classes/cipherer.php"));
$tdatavw_OwnProfile = array();
	$tdatavw_OwnProfile[".NumberOfChars"] = 80; 
	$tdatavw_OwnProfile[".ShortName"] = "vw_OwnProfile";
	$tdatavw_OwnProfile[".OwnerID"] = "DevoteeId";
	$tdatavw_OwnProfile[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsvw_OwnProfile = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_OwnProfile["English"] = array();
	$fieldToolTipsvw_OwnProfile["English"] = array();
	$fieldLabelsvw_OwnProfile["English"]["Photo"] = "Photo";
	$fieldToolTipsvw_OwnProfile["English"]["Photo"] = "";
	$fieldLabelsvw_OwnProfile["English"]["Gender"] = "Gender";
	$fieldToolTipsvw_OwnProfile["English"]["Gender"] = "";
	$fieldLabelsvw_OwnProfile["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_OwnProfile["English"]["DevoteeId"] = "";
	$fieldLabelsvw_OwnProfile["English"]["TitleId"] = "Title Id";
	$fieldToolTipsvw_OwnProfile["English"]["TitleId"] = "";
	$fieldLabelsvw_OwnProfile["English"]["FirstName"] = "First Name";
	$fieldToolTipsvw_OwnProfile["English"]["FirstName"] = "";
	$fieldLabelsvw_OwnProfile["English"]["LastName"] = "Last Name";
	$fieldToolTipsvw_OwnProfile["English"]["LastName"] = "";
	$fieldLabelsvw_OwnProfile["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsvw_OwnProfile["English"]["MiddleName"] = "";
	$fieldLabelsvw_OwnProfile["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsvw_OwnProfile["English"]["DateOfBirth"] = "";
	$fieldLabelsvw_OwnProfile["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsvw_OwnProfile["English"]["MaritalStatusId"] = "";
	$fieldLabelsvw_OwnProfile["English"]["DateofMarriage"] = "Dateof Marriage";
	$fieldToolTipsvw_OwnProfile["English"]["DateofMarriage"] = "";
	$fieldLabelsvw_OwnProfile["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsvw_OwnProfile["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsvw_OwnProfile["English"]["MobilePhone"] = "Mobile Phone";
	$fieldToolTipsvw_OwnProfile["English"]["MobilePhone"] = "";
	$fieldLabelsvw_OwnProfile["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsvw_OwnProfile["English"]["WorkPhone"] = "";
	$fieldLabelsvw_OwnProfile["English"]["EmailPrimary"] = "Email Primary";
	$fieldToolTipsvw_OwnProfile["English"]["EmailPrimary"] = "";
	$fieldLabelsvw_OwnProfile["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsvw_OwnProfile["English"]["EmailSecondary"] = "";
	$fieldLabelsvw_OwnProfile["English"]["Password"] = "Password";
	$fieldToolTipsvw_OwnProfile["English"]["Password"] = "";
	$fieldLabelsvw_OwnProfile["English"]["CounsellorName"] = "Counsellor Name";
	$fieldToolTipsvw_OwnProfile["English"]["CounsellorName"] = "";
	$fieldLabelsvw_OwnProfile["English"]["MaritalStatus"] = "Marital Status";
	$fieldToolTipsvw_OwnProfile["English"]["MaritalStatus"] = "";
	$fieldLabelsvw_OwnProfile["English"]["Title"] = "Title";
	$fieldToolTipsvw_OwnProfile["English"]["Title"] = "";
	$fieldLabelsvw_OwnProfile["English"]["FullName"] = "Full Name";
	$fieldToolTipsvw_OwnProfile["English"]["FullName"] = "";
	$fieldLabelsvw_OwnProfile["English"]["SpouseName"] = "Spouse Name";
	$fieldToolTipsvw_OwnProfile["English"]["SpouseName"] = "";
	if (count($fieldToolTipsvw_OwnProfile["English"]))
		$tdatavw_OwnProfile[".isUseToolTips"] = true;
}
	
	
	$tdatavw_OwnProfile[".NCSearch"] = true;



$tdatavw_OwnProfile[".shortTableName"] = "vw_OwnProfile";
$tdatavw_OwnProfile[".nSecOptions"] = 1;
$tdatavw_OwnProfile[".recsPerRowList"] = 1;
$tdatavw_OwnProfile[".mainTableOwnerID"] = "DevoteeId";
$tdatavw_OwnProfile[".moveNext"] = 1;
$tdatavw_OwnProfile[".nType"] = 1;

$tdatavw_OwnProfile[".strOriginalTableName"] = "devotee";

$tdatavw_OwnProfile[".hasEncryptedFields"] = true;



$tdatavw_OwnProfile[".showAddInPopup"] = true;

$tdatavw_OwnProfile[".showEditInPopup"] = true;

$tdatavw_OwnProfile[".showViewInPopup"] = true;

$tdatavw_OwnProfile[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatavw_OwnProfile[".listAjax"] = true;
else 
	$tdatavw_OwnProfile[".listAjax"] = false;

	$tdatavw_OwnProfile[".audit"] = true;

	$tdatavw_OwnProfile[".locking"] = false;

$tdatavw_OwnProfile[".listIcons"] = true;
$tdatavw_OwnProfile[".edit"] = true;
$tdatavw_OwnProfile[".view"] = true;


$tdatavw_OwnProfile[".printFriendly"] = true;


$tdatavw_OwnProfile[".showSimpleSearchOptions"] = true;

$tdatavw_OwnProfile[".showSearchPanel"] = true;

if (isMobile())
	$tdatavw_OwnProfile[".isUseAjaxSuggest"] = false;
else 
	$tdatavw_OwnProfile[".isUseAjaxSuggest"] = true;

$tdatavw_OwnProfile[".rowHighlite"] = true;

// button handlers file names

$tdatavw_OwnProfile[".addPageEvents"] = false;

// use timepicker for search panel
$tdatavw_OwnProfile[".isUseTimeForSearch"] = false;




$tdatavw_OwnProfile[".allSearchFields"] = array();

$tdatavw_OwnProfile[".allSearchFields"][] = "SpouseName";

$tdatavw_OwnProfile[".googleLikeFields"][] = "DevoteeId";
$tdatavw_OwnProfile[".googleLikeFields"][] = "TitleId";
$tdatavw_OwnProfile[".googleLikeFields"][] = "Title";
$tdatavw_OwnProfile[".googleLikeFields"][] = "FirstName";
$tdatavw_OwnProfile[".googleLikeFields"][] = "LastName";
$tdatavw_OwnProfile[".googleLikeFields"][] = "MiddleName";
$tdatavw_OwnProfile[".googleLikeFields"][] = "Gender";
$tdatavw_OwnProfile[".googleLikeFields"][] = "DateOfBirth";
$tdatavw_OwnProfile[".googleLikeFields"][] = "MaritalStatusId";
$tdatavw_OwnProfile[".googleLikeFields"][] = "MaritalStatus";
$tdatavw_OwnProfile[".googleLikeFields"][] = "DateofMarriage";
$tdatavw_OwnProfile[".googleLikeFields"][] = "SpouseDevoteeId";
$tdatavw_OwnProfile[".googleLikeFields"][] = "SpouseName";
$tdatavw_OwnProfile[".googleLikeFields"][] = "MobilePhone";
$tdatavw_OwnProfile[".googleLikeFields"][] = "WorkPhone";
$tdatavw_OwnProfile[".googleLikeFields"][] = "EmailPrimary";
$tdatavw_OwnProfile[".googleLikeFields"][] = "EmailSecondary";
$tdatavw_OwnProfile[".googleLikeFields"][] = "Password";
$tdatavw_OwnProfile[".googleLikeFields"][] = "CounsellorName";
$tdatavw_OwnProfile[".googleLikeFields"][] = "FullName";


$tdatavw_OwnProfile[".advSearchFields"][] = "SpouseName";

$tdatavw_OwnProfile[".isTableType"] = "list";

	
$tdatavw_OwnProfile[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main



$tdatavw_OwnProfile[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatavw_OwnProfile[".strOrderBy"] = $tstrOrderBy;

$tdatavw_OwnProfile[".orderindexes"] = array();

$tdatavw_OwnProfile[".sqlHead"] = "SELECT devotee.DevoteeId,  devotee.TitleId,  lu_salutations.Salutation AS Title,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  lu_marital_status.MaritalStatus,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  Trim(concat(spouse.FirstName, ' ' , spouse.MiddleName , ' ', spouse.LastName)) AS SpouseName,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  TRIM(Concat(Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName)) AS CounsellorName,  Trim(concat(devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName)) AS FullName";
$tdatavw_OwnProfile[".sqlFrom"] = "FROM devotee  LEFT OUTER JOIN devotee AS Counsellor ON devotee.CounsellorDevoteeID = Counsellor.DevoteeId  LEFT OUTER JOIN lu_marital_status ON devotee.MaritalStatusId = lu_marital_status.MaritalStatusId AND devotee.TitleId = lu_marital_status.MaritalStatusId  LEFT OUTER JOIN lu_salutations ON devotee.TitleId = lu_salutations.SalutationId  LEFT OUTER JOIN devotee AS spouse ON devotee.SpouseDevoteeId = spouse.DevoteeId";
$tdatavw_OwnProfile[".sqlWhereExpr"] = "";
$tdatavw_OwnProfile[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_OwnProfile[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_OwnProfile[".arrGroupsPerPage"] = $arrGPP;

$tableKeysvw_OwnProfile = array();
$tableKeysvw_OwnProfile[] = "DevoteeId";
$tdatavw_OwnProfile[".Keys"] = $tableKeysvw_OwnProfile;

$tdatavw_OwnProfile[".listFields"] = array();
$tdatavw_OwnProfile[".listFields"][] = "SpouseName";
$tdatavw_OwnProfile[".listFields"][] = "Title";
$tdatavw_OwnProfile[".listFields"][] = "FirstName";
$tdatavw_OwnProfile[".listFields"][] = "MiddleName";
$tdatavw_OwnProfile[".listFields"][] = "LastName";
$tdatavw_OwnProfile[".listFields"][] = "MobilePhone";
$tdatavw_OwnProfile[".listFields"][] = "EmailPrimary";

$tdatavw_OwnProfile[".viewFields"] = array();
$tdatavw_OwnProfile[".viewFields"][] = "Title";
$tdatavw_OwnProfile[".viewFields"][] = "FullName";
$tdatavw_OwnProfile[".viewFields"][] = "DateOfBirth";
$tdatavw_OwnProfile[".viewFields"][] = "MaritalStatus";
$tdatavw_OwnProfile[".viewFields"][] = "DateofMarriage";
$tdatavw_OwnProfile[".viewFields"][] = "SpouseName";
$tdatavw_OwnProfile[".viewFields"][] = "MobilePhone";
$tdatavw_OwnProfile[".viewFields"][] = "WorkPhone";
$tdatavw_OwnProfile[".viewFields"][] = "EmailPrimary";
$tdatavw_OwnProfile[".viewFields"][] = "EmailSecondary";
$tdatavw_OwnProfile[".viewFields"][] = "CounsellorName";

$tdatavw_OwnProfile[".addFields"] = array();
$tdatavw_OwnProfile[".addFields"][] = "Photo";
$tdatavw_OwnProfile[".addFields"][] = "Gender";
$tdatavw_OwnProfile[".addFields"][] = "TitleId";
$tdatavw_OwnProfile[".addFields"][] = "FirstName";
$tdatavw_OwnProfile[".addFields"][] = "LastName";
$tdatavw_OwnProfile[".addFields"][] = "MiddleName";
$tdatavw_OwnProfile[".addFields"][] = "DateOfBirth";
$tdatavw_OwnProfile[".addFields"][] = "MaritalStatusId";
$tdatavw_OwnProfile[".addFields"][] = "DateofMarriage";
$tdatavw_OwnProfile[".addFields"][] = "SpouseDevoteeId";
$tdatavw_OwnProfile[".addFields"][] = "MobilePhone";
$tdatavw_OwnProfile[".addFields"][] = "WorkPhone";
$tdatavw_OwnProfile[".addFields"][] = "EmailSecondary";

$tdatavw_OwnProfile[".inlineAddFields"] = array();

$tdatavw_OwnProfile[".editFields"] = array();
$tdatavw_OwnProfile[".editFields"][] = "SpouseName";
$tdatavw_OwnProfile[".editFields"][] = "MaritalStatus";
$tdatavw_OwnProfile[".editFields"][] = "TitleId";
$tdatavw_OwnProfile[".editFields"][] = "Photo";
$tdatavw_OwnProfile[".editFields"][] = "FirstName";
$tdatavw_OwnProfile[".editFields"][] = "LastName";
$tdatavw_OwnProfile[".editFields"][] = "MiddleName";
$tdatavw_OwnProfile[".editFields"][] = "Gender";
$tdatavw_OwnProfile[".editFields"][] = "DateOfBirth";
$tdatavw_OwnProfile[".editFields"][] = "MaritalStatusId";
$tdatavw_OwnProfile[".editFields"][] = "DateofMarriage";
$tdatavw_OwnProfile[".editFields"][] = "SpouseDevoteeId";
$tdatavw_OwnProfile[".editFields"][] = "MobilePhone";
$tdatavw_OwnProfile[".editFields"][] = "WorkPhone";
$tdatavw_OwnProfile[".editFields"][] = "EmailPrimary";
$tdatavw_OwnProfile[".editFields"][] = "EmailSecondary";

$tdatavw_OwnProfile[".inlineEditFields"] = array();

$tdatavw_OwnProfile[".exportFields"] = array();

$tdatavw_OwnProfile[".printFields"] = array();
$tdatavw_OwnProfile[".printFields"][] = "Title";
$tdatavw_OwnProfile[".printFields"][] = "Gender";
$tdatavw_OwnProfile[".printFields"][] = "DateOfBirth";
$tdatavw_OwnProfile[".printFields"][] = "MaritalStatus";
$tdatavw_OwnProfile[".printFields"][] = "DateofMarriage";
$tdatavw_OwnProfile[".printFields"][] = "SpouseName";
$tdatavw_OwnProfile[".printFields"][] = "MobilePhone";
$tdatavw_OwnProfile[".printFields"][] = "WorkPhone";
$tdatavw_OwnProfile[".printFields"][] = "EmailPrimary";
$tdatavw_OwnProfile[".printFields"][] = "EmailSecondary";
$tdatavw_OwnProfile[".printFields"][] = "CounsellorName";
$tdatavw_OwnProfile[".printFields"][] = "FullName";

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
	
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee.DevoteeId";
	
		
		
				
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
	
		
		
	$tdatavw_OwnProfile["DevoteeId"] = $fdata;
//	TitleId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "TitleId";
	$fdata["GoodName"] = "TitleId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Title Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		
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
	$edata["autoCompleteFieldsOnEdit"] = 1;
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
	
		
		
	$tdatavw_OwnProfile["TitleId"] = $fdata;
//	Title
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Title";
	$fdata["GoodName"] = "Title";
	$fdata["ownerTable"] = "lu_salutations";
	$fdata["Label"] = "Title"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "Salutation"; 
		$fdata["FullName"] = "lu_salutations.Salutation";
	
		
		
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
	
		
		
	$tdatavw_OwnProfile["Title"] = $fdata;
//	Photo
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "Photo";
	$fdata["GoodName"] = "Photo";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Photo"; 
	$fdata["FieldType"] = 128;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		
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
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_OwnProfile["Photo"] = $fdata;
//	FirstName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "FirstName";
	$fdata["GoodName"] = "FirstName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "First Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		
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

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_OwnProfile["FirstName"] = $fdata;
//	LastName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "LastName";
	$fdata["GoodName"] = "LastName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Last Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		
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

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_OwnProfile["LastName"] = $fdata;
//	MiddleName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "MiddleName";
	$fdata["GoodName"] = "MiddleName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Middle Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		
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
	
		
		
	$tdatavw_OwnProfile["MiddleName"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Gender"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		$fdata["bPrinterPage"] = true; 
	
		
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
	
		
		
	$tdatavw_OwnProfile["Gender"] = $fdata;
//	DateOfBirth
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "DateOfBirth";
	$fdata["GoodName"] = "DateOfBirth";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Birth"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
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
	
		
		
	$tdatavw_OwnProfile["DateOfBirth"] = $fdata;
//	MaritalStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "MaritalStatusId";
	$fdata["GoodName"] = "MaritalStatusId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Marital Status Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		
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
	
		
		
	$tdatavw_OwnProfile["MaritalStatusId"] = $fdata;
//	MaritalStatus
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "MaritalStatus";
	$fdata["GoodName"] = "MaritalStatus";
	$fdata["ownerTable"] = "lu_marital_status";
	$fdata["Label"] = "Marital Status"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "MaritalStatus"; 
		$fdata["FullName"] = "lu_marital_status.MaritalStatus";
	
		
		
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
	
		
		
	$tdatavw_OwnProfile["MaritalStatus"] = $fdata;
//	DateofMarriage
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "DateofMarriage";
	$fdata["GoodName"] = "DateofMarriage";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Dateof Marriage"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
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
	
		
		
	$tdatavw_OwnProfile["DateofMarriage"] = $fdata;
//	SpouseDevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "SpouseDevoteeId";
	$fdata["GoodName"] = "SpouseDevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Spouse Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		
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
				if(strpos(GetUserPermissions("vw_OwnProfile"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "DevoteeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "DevoteeId";
	
		
	$edata["LookupTable"] = "devotee";
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
	
		
		
	$tdatavw_OwnProfile["SpouseDevoteeId"] = $fdata;
//	SpouseName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "SpouseName";
	$fdata["GoodName"] = "SpouseName";
	$fdata["ownerTable"] = "";
	$fdata["Label"] = "Spouse Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "SpouseName"; 
		$fdata["FullName"] = "Trim(concat(spouse.FirstName, ' ' , spouse.MiddleName , ' ', spouse.LastName))";
	
		
		
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
	
		
		
	$tdatavw_OwnProfile["SpouseName"] = $fdata;
//	MobilePhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "MobilePhone";
	$fdata["GoodName"] = "MobilePhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Mobile Phone"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
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
	
		
		
	$tdatavw_OwnProfile["MobilePhone"] = $fdata;
//	WorkPhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "WorkPhone";
	$fdata["GoodName"] = "WorkPhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Work Phone"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
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
	
		
		
	$tdatavw_OwnProfile["WorkPhone"] = $fdata;
//	EmailPrimary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "EmailPrimary";
	$fdata["GoodName"] = "EmailPrimary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Primary"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
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
	
		
		
	$tdatavw_OwnProfile["EmailPrimary"] = $fdata;
//	EmailSecondary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "EmailSecondary";
	$fdata["GoodName"] = "EmailSecondary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Secondary"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
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
	
		
		
	$tdatavw_OwnProfile["EmailSecondary"] = $fdata;
//	Password
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "Password";
	$fdata["GoodName"] = "Password";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Password"; 
	$fdata["FieldType"] = 200;
	
		
		$fdata["bIsEncrypted"] = true; 
	
		
		
		
		
		
		
		
		
		
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
	
		
		
	$tdatavw_OwnProfile["Password"] = $fdata;
//	CounsellorName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "CounsellorName";
	$fdata["GoodName"] = "CounsellorName";
	$fdata["ownerTable"] = "";
	$fdata["Label"] = "Counsellor Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "CounsellorName"; 
		$fdata["FullName"] = "TRIM(Concat(Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName))";
	
		
		
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
	
		
		
	$tdatavw_OwnProfile["CounsellorName"] = $fdata;
//	FullName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "FullName";
	$fdata["GoodName"] = "FullName";
	$fdata["ownerTable"] = "";
	$fdata["Label"] = "Full Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "FullName"; 
		$fdata["FullName"] = "Trim(concat(devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName))";
	
		
		
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
	
		
		
	$tdatavw_OwnProfile["FullName"] = $fdata;

	
$tables_data["vw_OwnProfile"]=&$tdatavw_OwnProfile;
$field_labels["vw_OwnProfile"] = &$fieldLabelsvw_OwnProfile;
$fieldToolTips["vw_OwnProfile"] = &$fieldToolTipsvw_OwnProfile;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_OwnProfile"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["vw_OwnProfile"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_vw_OwnProfile()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "devotee.DevoteeId,  devotee.TitleId,  lu_salutations.Salutation AS Title,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  lu_marital_status.MaritalStatus,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  Trim(concat(spouse.FirstName, ' ' , spouse.MiddleName , ' ', spouse.LastName)) AS SpouseName,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  TRIM(Concat(Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName)) AS CounsellorName,  Trim(concat(devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName)) AS FullName";
$proto0["m_strFrom"] = "FROM devotee  LEFT OUTER JOIN devotee AS Counsellor ON devotee.CounsellorDevoteeID = Counsellor.DevoteeId  LEFT OUTER JOIN lu_marital_status ON devotee.MaritalStatusId = lu_marital_status.MaritalStatusId AND devotee.TitleId = lu_marital_status.MaritalStatusId  LEFT OUTER JOIN lu_salutations ON devotee.TitleId = lu_salutations.SalutationId  LEFT OUTER JOIN devotee AS spouse ON devotee.SpouseDevoteeId = spouse.DevoteeId";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("vw_OwnProfile");
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
	"m_strName" => "Salutation",
	"m_strTable" => "lu_salutations"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "Title";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Photo",
	"m_strTable" => "devotee"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "FirstName",
	"m_strTable" => "devotee"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "LastName",
	"m_strTable" => "devotee"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "MiddleName",
	"m_strTable" => "devotee"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "Gender",
	"m_strTable" => "devotee"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "DateOfBirth",
	"m_strTable" => "devotee"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "MaritalStatusId",
	"m_strTable" => "devotee"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "MaritalStatus",
	"m_strTable" => "lu_marital_status"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "DateofMarriage",
	"m_strTable" => "devotee"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "SpouseDevoteeId",
	"m_strTable" => "devotee"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$proto32=array();
$proto32["m_functiontype"] = "SQLF_CUSTOM";
$proto32["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "concat(spouse.FirstName, ' ' , spouse.MiddleName , ' ', spouse.LastName)"
));

$proto32["m_arguments"][]=$obj;
$proto32["m_strFunctionName"] = "Trim";
$obj = new SQLFunctionCall($proto32);

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "SpouseName";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto34=array();
			$obj = new SQLField(array(
	"m_strName" => "MobilePhone",
	"m_strTable" => "devotee"
));

$proto34["m_expr"]=$obj;
$proto34["m_alias"] = "";
$obj = new SQLFieldListItem($proto34);

$proto0["m_fieldlist"][]=$obj;
						$proto36=array();
			$obj = new SQLField(array(
	"m_strName" => "WorkPhone",
	"m_strTable" => "devotee"
));

$proto36["m_expr"]=$obj;
$proto36["m_alias"] = "";
$obj = new SQLFieldListItem($proto36);

$proto0["m_fieldlist"][]=$obj;
						$proto38=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailPrimary",
	"m_strTable" => "devotee"
));

$proto38["m_expr"]=$obj;
$proto38["m_alias"] = "";
$obj = new SQLFieldListItem($proto38);

$proto0["m_fieldlist"][]=$obj;
						$proto40=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailSecondary",
	"m_strTable" => "devotee"
));

$proto40["m_expr"]=$obj;
$proto40["m_alias"] = "";
$obj = new SQLFieldListItem($proto40);

$proto0["m_fieldlist"][]=$obj;
						$proto42=array();
			$obj = new SQLField(array(
	"m_strName" => "Password",
	"m_strTable" => "devotee"
));

$proto42["m_expr"]=$obj;
$proto42["m_alias"] = "";
$obj = new SQLFieldListItem($proto42);

$proto0["m_fieldlist"][]=$obj;
						$proto44=array();
			$proto45=array();
$proto45["m_functiontype"] = "SQLF_CUSTOM";
$proto45["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "Concat(Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName)"
));

$proto45["m_arguments"][]=$obj;
$proto45["m_strFunctionName"] = "TRIM";
$obj = new SQLFunctionCall($proto45);

$proto44["m_expr"]=$obj;
$proto44["m_alias"] = "CounsellorName";
$obj = new SQLFieldListItem($proto44);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
			$proto48=array();
$proto48["m_functiontype"] = "SQLF_CUSTOM";
$proto48["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "concat(devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName)"
));

$proto48["m_arguments"][]=$obj;
$proto48["m_strFunctionName"] = "Trim";
$obj = new SQLFunctionCall($proto48);

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "FullName";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto50=array();
$proto50["m_link"] = "SQLL_MAIN";
			$proto51=array();
$proto51["m_strName"] = "devotee";
$proto51["m_columns"] = array();
$proto51["m_columns"][] = "DevoteeId";
$proto51["m_columns"][] = "TitleId";
$proto51["m_columns"][] = "Photo";
$proto51["m_columns"][] = "FirstName";
$proto51["m_columns"][] = "LastName";
$proto51["m_columns"][] = "MiddleName";
$proto51["m_columns"][] = "Gender";
$proto51["m_columns"][] = "DateOfBirth";
$proto51["m_columns"][] = "MaritalStatusId";
$proto51["m_columns"][] = "DateofMarriage";
$proto51["m_columns"][] = "SpouseDevoteeId";
$proto51["m_columns"][] = "MobilePhone";
$proto51["m_columns"][] = "WorkPhone";
$proto51["m_columns"][] = "EmailPrimary";
$proto51["m_columns"][] = "EmailSecondary";
$proto51["m_columns"][] = "Password";
$proto51["m_columns"][] = "active";
$proto51["m_columns"][] = "CounsellorDevoteeID";
$proto51["m_columns"][] = "IsCounsellor";
$proto51["m_columns"][] = "NativeCity";
$proto51["m_columns"][] = "NativeState";
$proto51["m_columns"][] = "BloodGroup";
$proto51["m_columns"][] = "DateOfHarinamInitiation";
$proto51["m_columns"][] = "DateOfBrahmanInitiation";
$proto51["m_columns"][] = "SpiritualMasterId";
$proto51["m_columns"][] = "PreviousReligion";
$proto51["m_columns"][] = "Chanting16RoundsSince";
$proto51["m_columns"][] = "IntroducedBy";
$proto51["m_columns"][] = "YearOfIntroduction";
$proto51["m_columns"][] = "IntroducedInCenter";
$proto51["m_columns"][] = "PreferedServices";
$proto51["m_columns"][] = "ServicesRendered";
$proto51["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto51);

$proto50["m_table"] = $obj;
$proto50["m_alias"] = "";
$proto52=array();
$proto52["m_sql"] = "";
$proto52["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto52["m_column"]=$obj;
$proto52["m_contained"] = array();
$proto52["m_strCase"] = "";
$proto52["m_havingmode"] = "0";
$proto52["m_inBrackets"] = "0";
$proto52["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto52);

$proto50["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto50);

$proto0["m_fromlist"][]=$obj;
												$proto54=array();
$proto54["m_link"] = "SQLL_LEFTJOIN";
			$proto55=array();
$proto55["m_strName"] = "devotee";
$proto55["m_columns"] = array();
$proto55["m_columns"][] = "DevoteeId";
$proto55["m_columns"][] = "TitleId";
$proto55["m_columns"][] = "Photo";
$proto55["m_columns"][] = "FirstName";
$proto55["m_columns"][] = "LastName";
$proto55["m_columns"][] = "MiddleName";
$proto55["m_columns"][] = "Gender";
$proto55["m_columns"][] = "DateOfBirth";
$proto55["m_columns"][] = "MaritalStatusId";
$proto55["m_columns"][] = "DateofMarriage";
$proto55["m_columns"][] = "SpouseDevoteeId";
$proto55["m_columns"][] = "MobilePhone";
$proto55["m_columns"][] = "WorkPhone";
$proto55["m_columns"][] = "EmailPrimary";
$proto55["m_columns"][] = "EmailSecondary";
$proto55["m_columns"][] = "Password";
$proto55["m_columns"][] = "active";
$proto55["m_columns"][] = "CounsellorDevoteeID";
$proto55["m_columns"][] = "IsCounsellor";
$proto55["m_columns"][] = "NativeCity";
$proto55["m_columns"][] = "NativeState";
$proto55["m_columns"][] = "BloodGroup";
$proto55["m_columns"][] = "DateOfHarinamInitiation";
$proto55["m_columns"][] = "DateOfBrahmanInitiation";
$proto55["m_columns"][] = "SpiritualMasterId";
$proto55["m_columns"][] = "PreviousReligion";
$proto55["m_columns"][] = "Chanting16RoundsSince";
$proto55["m_columns"][] = "IntroducedBy";
$proto55["m_columns"][] = "YearOfIntroduction";
$proto55["m_columns"][] = "IntroducedInCenter";
$proto55["m_columns"][] = "PreferedServices";
$proto55["m_columns"][] = "ServicesRendered";
$proto55["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto55);

$proto54["m_table"] = $obj;
$proto54["m_alias"] = "Counsellor";
$proto56=array();
$proto56["m_sql"] = "devotee.CounsellorDevoteeID = Counsellor.DevoteeId";
$proto56["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "CounsellorDevoteeID",
	"m_strTable" => "devotee"
));

$proto56["m_column"]=$obj;
$proto56["m_contained"] = array();
$proto56["m_strCase"] = "= Counsellor.DevoteeId";
$proto56["m_havingmode"] = "0";
$proto56["m_inBrackets"] = "0";
$proto56["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto56);

$proto54["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto54);

$proto0["m_fromlist"][]=$obj;
												$proto58=array();
$proto58["m_link"] = "SQLL_LEFTJOIN";
			$proto59=array();
$proto59["m_strName"] = "lu_marital_status";
$proto59["m_columns"] = array();
$proto59["m_columns"][] = "MaritalStatusId";
$proto59["m_columns"][] = "MaritalStatus";
$obj = new SQLTable($proto59);

$proto58["m_table"] = $obj;
$proto58["m_alias"] = "";
$proto60=array();
$proto60["m_sql"] = "devotee.MaritalStatusId = lu_marital_status.MaritalStatusId AND devotee.TitleId = lu_marital_status.MaritalStatusId";
$proto60["m_uniontype"] = "SQLL_AND";
	$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.MaritalStatusId = lu_marital_status.MaritalStatusId AND devotee.TitleId = lu_marital_status.MaritalStatusId"
));

$proto60["m_column"]=$obj;
$proto60["m_contained"] = array();
						$proto62=array();
$proto62["m_sql"] = "devotee.MaritalStatusId = lu_marital_status.MaritalStatusId";
$proto62["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "MaritalStatusId",
	"m_strTable" => "devotee"
));

$proto62["m_column"]=$obj;
$proto62["m_contained"] = array();
$proto62["m_strCase"] = "= lu_marital_status.MaritalStatusId";
$proto62["m_havingmode"] = "0";
$proto62["m_inBrackets"] = "0";
$proto62["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto62);

			$proto60["m_contained"][]=$obj;
						$proto64=array();
$proto64["m_sql"] = "devotee.TitleId = lu_marital_status.MaritalStatusId";
$proto64["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "devotee"
));

$proto64["m_column"]=$obj;
$proto64["m_contained"] = array();
$proto64["m_strCase"] = "= lu_marital_status.MaritalStatusId";
$proto64["m_havingmode"] = "0";
$proto64["m_inBrackets"] = "0";
$proto64["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto64);

			$proto60["m_contained"][]=$obj;
$proto60["m_strCase"] = "";
$proto60["m_havingmode"] = "0";
$proto60["m_inBrackets"] = "0";
$proto60["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto60);

$proto58["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto58);

$proto0["m_fromlist"][]=$obj;
												$proto66=array();
$proto66["m_link"] = "SQLL_LEFTJOIN";
			$proto67=array();
$proto67["m_strName"] = "lu_salutations";
$proto67["m_columns"] = array();
$proto67["m_columns"][] = "SalutationId";
$proto67["m_columns"][] = "Salutation";
$proto67["m_columns"][] = "Gender";
$obj = new SQLTable($proto67);

$proto66["m_table"] = $obj;
$proto66["m_alias"] = "";
$proto68=array();
$proto68["m_sql"] = "devotee.TitleId = lu_salutations.SalutationId";
$proto68["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "devotee"
));

$proto68["m_column"]=$obj;
$proto68["m_contained"] = array();
$proto68["m_strCase"] = "= lu_salutations.SalutationId";
$proto68["m_havingmode"] = "0";
$proto68["m_inBrackets"] = "0";
$proto68["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto68);

$proto66["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto66);

$proto0["m_fromlist"][]=$obj;
												$proto70=array();
$proto70["m_link"] = "SQLL_LEFTJOIN";
			$proto71=array();
$proto71["m_strName"] = "devotee";
$proto71["m_columns"] = array();
$proto71["m_columns"][] = "DevoteeId";
$proto71["m_columns"][] = "TitleId";
$proto71["m_columns"][] = "Photo";
$proto71["m_columns"][] = "FirstName";
$proto71["m_columns"][] = "LastName";
$proto71["m_columns"][] = "MiddleName";
$proto71["m_columns"][] = "Gender";
$proto71["m_columns"][] = "DateOfBirth";
$proto71["m_columns"][] = "MaritalStatusId";
$proto71["m_columns"][] = "DateofMarriage";
$proto71["m_columns"][] = "SpouseDevoteeId";
$proto71["m_columns"][] = "MobilePhone";
$proto71["m_columns"][] = "WorkPhone";
$proto71["m_columns"][] = "EmailPrimary";
$proto71["m_columns"][] = "EmailSecondary";
$proto71["m_columns"][] = "Password";
$proto71["m_columns"][] = "active";
$proto71["m_columns"][] = "CounsellorDevoteeID";
$proto71["m_columns"][] = "IsCounsellor";
$proto71["m_columns"][] = "NativeCity";
$proto71["m_columns"][] = "NativeState";
$proto71["m_columns"][] = "BloodGroup";
$proto71["m_columns"][] = "DateOfHarinamInitiation";
$proto71["m_columns"][] = "DateOfBrahmanInitiation";
$proto71["m_columns"][] = "SpiritualMasterId";
$proto71["m_columns"][] = "PreviousReligion";
$proto71["m_columns"][] = "Chanting16RoundsSince";
$proto71["m_columns"][] = "IntroducedBy";
$proto71["m_columns"][] = "YearOfIntroduction";
$proto71["m_columns"][] = "IntroducedInCenter";
$proto71["m_columns"][] = "PreferedServices";
$proto71["m_columns"][] = "ServicesRendered";
$proto71["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto71);

$proto70["m_table"] = $obj;
$proto70["m_alias"] = "spouse";
$proto72=array();
$proto72["m_sql"] = "devotee.SpouseDevoteeId = spouse.DevoteeId";
$proto72["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "SpouseDevoteeId",
	"m_strTable" => "devotee"
));

$proto72["m_column"]=$obj;
$proto72["m_contained"] = array();
$proto72["m_strCase"] = "= spouse.DevoteeId";
$proto72["m_havingmode"] = "0";
$proto72["m_inBrackets"] = "0";
$proto72["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto72);

$proto70["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto70);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_vw_OwnProfile = createSqlQuery_vw_OwnProfile();
																					 $queryData_vw_OwnProfile->m_fieldlist[18]->m_isEncrypted = true;
		$tdatavw_OwnProfile[".sqlquery"] = $queryData_vw_OwnProfile;
	
if(isset($tdatavw_OwnProfile["field2"])){
	$tdatavw_OwnProfile["field2"]["LookupTable"] = "carscars_view";
	$tdatavw_OwnProfile["field2"]["LookupOrderBy"] = "name";
	$tdatavw_OwnProfile["field2"]["LookupType"] = 4;
	$tdatavw_OwnProfile["field2"]["LinkField"] = "email";
	$tdatavw_OwnProfile["field2"]["DisplayField"] = "name";
	$tdatavw_OwnProfile[".hasCustomViewField"] = true;
}

$tableEvents["vw_OwnProfile"] = new eventsBase;
$tdatavw_OwnProfile[".hasEvents"] = false;

$cipherer = new RunnerCipherer("vw_OwnProfile");

?>