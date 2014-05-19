<?php
require_once(getabspath("classes/cipherer.php"));
$tdatadevotee_address = array();
	$tdatadevotee_address[".NumberOfChars"] = 80; 
	$tdatadevotee_address[".ShortName"] = "devotee_address";
	$tdatadevotee_address[".OwnerID"] = "AddressId";
	$tdatadevotee_address[".OriginalTable"] = "devotee_address";

//	field labels
$fieldLabelsdevotee_address = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsdevotee_address["English"] = array();
	$fieldToolTipsdevotee_address["English"] = array();
	$fieldLabelsdevotee_address["English"]["City"] = "City";
	$fieldToolTipsdevotee_address["English"]["City"] = "";
	$fieldLabelsdevotee_address["English"]["State"] = "State";
	$fieldToolTipsdevotee_address["English"]["State"] = "";
	$fieldLabelsdevotee_address["English"]["country"] = "Country";
	$fieldToolTipsdevotee_address["English"]["country"] = "";
	$fieldLabelsdevotee_address["English"]["pincode"] = "Pincode";
	$fieldToolTipsdevotee_address["English"]["pincode"] = "";
	$fieldLabelsdevotee_address["English"]["IsVerified"] = "Is Verified";
	$fieldToolTipsdevotee_address["English"]["IsVerified"] = "";
	$fieldLabelsdevotee_address["English"]["IsWrong"] = "Is Wrong";
	$fieldToolTipsdevotee_address["English"]["IsWrong"] = "";
	$fieldLabelsdevotee_address["English"]["AddressTypeID"] = "Address Type ID";
	$fieldToolTipsdevotee_address["English"]["AddressTypeID"] = "";
	$fieldLabelsdevotee_address["English"]["AddressLine1"] = "Address Line1";
	$fieldToolTipsdevotee_address["English"]["AddressLine1"] = "";
	$fieldLabelsdevotee_address["English"]["AddressLine2"] = "Address Line2";
	$fieldToolTipsdevotee_address["English"]["AddressLine2"] = "";
	$fieldLabelsdevotee_address["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsdevotee_address["English"]["DevoteeId"] = "";
	if (count($fieldToolTipsdevotee_address["English"]))
		$tdatadevotee_address[".isUseToolTips"] = true;
}
	
	
	$tdatadevotee_address[".NCSearch"] = true;



$tdatadevotee_address[".shortTableName"] = "devotee_address";
$tdatadevotee_address[".nSecOptions"] = 1;
$tdatadevotee_address[".recsPerRowList"] = 1;
$tdatadevotee_address[".mainTableOwnerID"] = "AddressId";
$tdatadevotee_address[".moveNext"] = 1;
$tdatadevotee_address[".nType"] = 0;

$tdatadevotee_address[".strOriginalTableName"] = "devotee_address";




$tdatadevotee_address[".showAddInPopup"] = true;

$tdatadevotee_address[".showEditInPopup"] = true;

$tdatadevotee_address[".showViewInPopup"] = true;

$tdatadevotee_address[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatadevotee_address[".listAjax"] = true;
else 
	$tdatadevotee_address[".listAjax"] = false;

	$tdatadevotee_address[".audit"] = true;

	$tdatadevotee_address[".locking"] = false;

$tdatadevotee_address[".listIcons"] = true;
$tdatadevotee_address[".inlineAdd"] = true;

$tdatadevotee_address[".exportTo"] = true;

$tdatadevotee_address[".printFriendly"] = true;


$tdatadevotee_address[".showSimpleSearchOptions"] = true;

$tdatadevotee_address[".showSearchPanel"] = true;

if (isMobile())
	$tdatadevotee_address[".isUseAjaxSuggest"] = false;
else 
	$tdatadevotee_address[".isUseAjaxSuggest"] = true;

$tdatadevotee_address[".rowHighlite"] = true;

// button handlers file names

$tdatadevotee_address[".addPageEvents"] = false;

// use timepicker for search panel
$tdatadevotee_address[".isUseTimeForSearch"] = false;




$tdatadevotee_address[".allSearchFields"] = array();

$tdatadevotee_address[".allSearchFields"][] = "AddressLine1";
$tdatadevotee_address[".allSearchFields"][] = "AddressLine2";
$tdatadevotee_address[".allSearchFields"][] = "State";
$tdatadevotee_address[".allSearchFields"][] = "City";
$tdatadevotee_address[".allSearchFields"][] = "country";
$tdatadevotee_address[".allSearchFields"][] = "pincode";

$tdatadevotee_address[".googleLikeFields"][] = "AddressLine1";
$tdatadevotee_address[".googleLikeFields"][] = "AddressLine2";
$tdatadevotee_address[".googleLikeFields"][] = "City";
$tdatadevotee_address[".googleLikeFields"][] = "State";
$tdatadevotee_address[".googleLikeFields"][] = "country";
$tdatadevotee_address[".googleLikeFields"][] = "pincode";
$tdatadevotee_address[".googleLikeFields"][] = "IsVerified";
$tdatadevotee_address[".googleLikeFields"][] = "IsWrong";
$tdatadevotee_address[".googleLikeFields"][] = "AddressTypeID";
$tdatadevotee_address[".googleLikeFields"][] = "DevoteeId";


$tdatadevotee_address[".advSearchFields"][] = "AddressLine1";
$tdatadevotee_address[".advSearchFields"][] = "AddressLine2";
$tdatadevotee_address[".advSearchFields"][] = "State";
$tdatadevotee_address[".advSearchFields"][] = "City";
$tdatadevotee_address[".advSearchFields"][] = "country";
$tdatadevotee_address[".advSearchFields"][] = "pincode";

$tdatadevotee_address[".isTableType"] = "list";

	
$tdatadevotee_address[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main



$tdatadevotee_address[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatadevotee_address[".strOrderBy"] = $tstrOrderBy;

$tdatadevotee_address[".orderindexes"] = array();

$tdatadevotee_address[".sqlHead"] = "SELECT AddressLine1,  AddressLine2,  City,  `State`,  Country,  Pincode,  IsVerified,  IsWrong,  AddressTypeId,  DevoteeId";
$tdatadevotee_address[".sqlFrom"] = "FROM devotee_address";
$tdatadevotee_address[".sqlWhereExpr"] = "";
$tdatadevotee_address[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadevotee_address[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadevotee_address[".arrGroupsPerPage"] = $arrGPP;

$tableKeysdevotee_address = array();
$tdatadevotee_address[".Keys"] = $tableKeysdevotee_address;

$tdatadevotee_address[".listFields"] = array();
$tdatadevotee_address[".listFields"][] = "AddressLine1";
$tdatadevotee_address[".listFields"][] = "AddressLine2";
$tdatadevotee_address[".listFields"][] = "State";
$tdatadevotee_address[".listFields"][] = "City";
$tdatadevotee_address[".listFields"][] = "country";
$tdatadevotee_address[".listFields"][] = "pincode";
$tdatadevotee_address[".listFields"][] = "AddressTypeID";

$tdatadevotee_address[".viewFields"] = array();
$tdatadevotee_address[".viewFields"][] = "AddressLine1";
$tdatadevotee_address[".viewFields"][] = "AddressLine2";
$tdatadevotee_address[".viewFields"][] = "State";
$tdatadevotee_address[".viewFields"][] = "City";
$tdatadevotee_address[".viewFields"][] = "country";
$tdatadevotee_address[".viewFields"][] = "pincode";
$tdatadevotee_address[".viewFields"][] = "AddressTypeID";

$tdatadevotee_address[".addFields"] = array();
$tdatadevotee_address[".addFields"][] = "AddressLine1";
$tdatadevotee_address[".addFields"][] = "AddressLine2";
$tdatadevotee_address[".addFields"][] = "State";
$tdatadevotee_address[".addFields"][] = "City";
$tdatadevotee_address[".addFields"][] = "country";
$tdatadevotee_address[".addFields"][] = "pincode";
$tdatadevotee_address[".addFields"][] = "AddressTypeID";

$tdatadevotee_address[".inlineAddFields"] = array();
$tdatadevotee_address[".inlineAddFields"][] = "AddressLine1";
$tdatadevotee_address[".inlineAddFields"][] = "AddressLine2";
$tdatadevotee_address[".inlineAddFields"][] = "State";
$tdatadevotee_address[".inlineAddFields"][] = "City";
$tdatadevotee_address[".inlineAddFields"][] = "country";
$tdatadevotee_address[".inlineAddFields"][] = "pincode";
$tdatadevotee_address[".inlineAddFields"][] = "AddressTypeID";

$tdatadevotee_address[".editFields"] = array();
$tdatadevotee_address[".editFields"][] = "AddressLine1";
$tdatadevotee_address[".editFields"][] = "AddressLine2";
$tdatadevotee_address[".editFields"][] = "State";
$tdatadevotee_address[".editFields"][] = "City";
$tdatadevotee_address[".editFields"][] = "country";
$tdatadevotee_address[".editFields"][] = "pincode";
$tdatadevotee_address[".editFields"][] = "AddressTypeID";

$tdatadevotee_address[".inlineEditFields"] = array();
$tdatadevotee_address[".inlineEditFields"][] = "AddressLine1";
$tdatadevotee_address[".inlineEditFields"][] = "AddressLine2";
$tdatadevotee_address[".inlineEditFields"][] = "State";
$tdatadevotee_address[".inlineEditFields"][] = "City";
$tdatadevotee_address[".inlineEditFields"][] = "country";
$tdatadevotee_address[".inlineEditFields"][] = "pincode";
$tdatadevotee_address[".inlineEditFields"][] = "AddressTypeID";

$tdatadevotee_address[".exportFields"] = array();
$tdatadevotee_address[".exportFields"][] = "AddressLine1";
$tdatadevotee_address[".exportFields"][] = "AddressLine2";
$tdatadevotee_address[".exportFields"][] = "State";
$tdatadevotee_address[".exportFields"][] = "City";
$tdatadevotee_address[".exportFields"][] = "country";
$tdatadevotee_address[".exportFields"][] = "pincode";
$tdatadevotee_address[".exportFields"][] = "AddressTypeID";
$tdatadevotee_address[".exportFields"][] = "IsVerified";

$tdatadevotee_address[".printFields"] = array();
$tdatadevotee_address[".printFields"][] = "AddressLine1";
$tdatadevotee_address[".printFields"][] = "AddressLine2";
$tdatadevotee_address[".printFields"][] = "State";
$tdatadevotee_address[".printFields"][] = "City";
$tdatadevotee_address[".printFields"][] = "country";
$tdatadevotee_address[".printFields"][] = "pincode";
$tdatadevotee_address[".printFields"][] = "AddressTypeID";

//	AddressLine1
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "AddressLine1";
	$fdata["GoodName"] = "AddressLine1";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Address Line1"; 
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
	
		$fdata["strField"] = "AddressLine1"; 
		$fdata["FullName"] = "AddressLine1";
	
		
		
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
	
		
		
	$tdatadevotee_address["AddressLine1"] = $fdata;
//	AddressLine2
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "AddressLine2";
	$fdata["GoodName"] = "AddressLine2";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Address Line2"; 
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
	
		$fdata["strField"] = "AddressLine2"; 
		$fdata["FullName"] = "AddressLine2";
	
		
		
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
	
		
		
	$tdatadevotee_address["AddressLine2"] = $fdata;
//	City
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "City";
	$fdata["GoodName"] = "City";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "City"; 
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
	
		$fdata["strField"] = "City"; 
		$fdata["FullName"] = "City";
	
		
		
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
	$edata["freeInput"] = 1;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				$edata["LCType"] = 1;
			
		
			$edata["LookupUnique"] = true;
	
	$edata["LinkField"] = "City";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "City";
	
		
	$edata["LookupTable"] = "lu_pin_city_state";
	$edata["LookupOrderBy"] = "";
	
		
		
		$edata["UseCategory"] = true; 
	$edata["CategoryControl"] = "State"; 
	$edata["CategoryFilter"] = "State"; 
	
		$edata["FastType"] = true; 
	
		
				
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_address["City"] = $fdata;
//	State
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "State";
	$fdata["GoodName"] = "State";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "State"; 
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
	
		$fdata["strField"] = "State"; 
		$fdata["FullName"] = "`State`";
	
		
		
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
	$edata["freeInput"] = 1;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				$edata["LCType"] = 1;
			
		
			$edata["LookupUnique"] = true;
	
	$edata["LinkField"] = "State";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "State";
	
		
	$edata["LookupTable"] = "lu_pin_city_state";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		$edata["FastType"] = true; 
	
		
				
			//	dependent dropdowns	
	$edata["DependentLookups"] = array();
	$edata["DependentLookups"][] = "City";
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_address["State"] = $fdata;
//	country
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "country";
	$fdata["GoodName"] = "country";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Country"; 
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
	
		$fdata["strField"] = "Country"; 
		$fdata["FullName"] = "Country";
	
		
		
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
	
		
		
	$tdatadevotee_address["country"] = $fdata;
//	pincode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "pincode";
	$fdata["GoodName"] = "pincode";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Pincode"; 
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
	
		$fdata["strField"] = "Pincode"; 
		$fdata["FullName"] = "Pincode";
	
		
		
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
	
		
		
	$tdatadevotee_address["pincode"] = $fdata;
//	IsVerified
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "IsVerified";
	$fdata["GoodName"] = "IsVerified";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Is Verified"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		
		
		
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "IsVerified"; 
		$fdata["FullName"] = "IsVerified";
	
		
		
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
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				$edata["LCType"] = 4;
			
		$edata["HorizontalLookup"] = true;
	
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = " Yes";
	$edata["LookupValues"][] = "No";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_address["IsVerified"] = $fdata;
//	IsWrong
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "IsWrong";
	$fdata["GoodName"] = "IsWrong";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Is Wrong"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "IsWrong"; 
		$fdata["FullName"] = "IsWrong";
	
		
		
				
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
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				$edata["LCType"] = 4;
			
		$edata["HorizontalLookup"] = true;
	
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "No";
	$edata["LookupValues"][] = "Yes";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_address["IsWrong"] = $fdata;
//	AddressTypeID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "AddressTypeID";
	$fdata["GoodName"] = "AddressTypeID";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Address Type ID"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressTypeId"; 
		$fdata["FullName"] = "AddressTypeId";
	
		
		
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
								$edata["LookupType"] = 1;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				$edata["LCType"] = 4;
			
		$edata["HorizontalLookup"] = true;
	
			
	$edata["LinkField"] = "AddressTypeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "AddressType";
	
		
	$edata["LookupTable"] = "lu_address_types";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
		$edata["SimpleAdd"] = true;
			
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_address["AddressTypeID"] = $fdata;
//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "DevoteeId";
	
		
		
				
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
	
		
		
	$tdatadevotee_address["DevoteeId"] = $fdata;

	
$tables_data["devotee_address"]=&$tdatadevotee_address;
$field_labels["devotee_address"] = &$fieldLabelsdevotee_address;
$fieldToolTips["devotee_address"] = &$fieldToolTipsdevotee_address;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["devotee_address"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["devotee_address"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="devotee";
	$masterParams["mDataSourceTable"]="devotee";
	$masterParams["mOriginalTable"]= $strOriginalDetailsTable;
	$masterParams["mShortTable"]= "devotee";
	$masterParams["masterKeys"]= array();
	$masterParams["detailKeys"]= array();
	$masterParams["dispChildCount"]= "1";
	$masterParams["hideChild"]= "0";
	$masterParams["dispInfo"]= "0";
	$masterParams["previewOnList"]= 1;
	$masterParams["previewOnAdd"]= 1;
	$masterParams["previewOnEdit"]= 1;
	$masterParams["previewOnView"]= 1;
	$masterTablesData["devotee_address"][$mIndex] = $masterParams;	
		$masterTablesData["devotee_address"][$mIndex]["masterKeys"][]="DevoteeId";
		$masterTablesData["devotee_address"][$mIndex]["detailKeys"][]="DevoteeId";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_devotee_address()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "AddressLine1,  AddressLine2,  City,  `State`,  Country,  Pincode,  IsVerified,  IsWrong,  AddressTypeId,  DevoteeId";
$proto0["m_strFrom"] = "FROM devotee_address";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = null;
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
	"m_strName" => "AddressLine1",
	"m_strTable" => "devotee_address"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "AddressLine2",
	"m_strTable" => "devotee_address"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "City",
	"m_strTable" => "devotee_address"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "State",
	"m_strTable" => "devotee_address"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "Country",
	"m_strTable" => "devotee_address"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Pincode",
	"m_strTable" => "devotee_address"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "IsVerified",
	"m_strTable" => "devotee_address"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "IsWrong",
	"m_strTable" => "devotee_address"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "AddressTypeId",
	"m_strTable" => "devotee_address"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee_address"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto25=array();
$proto25["m_link"] = "SQLL_MAIN";
			$proto26=array();
$proto26["m_strName"] = "devotee_address";
$proto26["m_columns"] = array();
$proto26["m_columns"][] = "AddressId";
$proto26["m_columns"][] = "AddressLine1";
$proto26["m_columns"][] = "AddressLine2";
$proto26["m_columns"][] = "City";
$proto26["m_columns"][] = "State";
$proto26["m_columns"][] = "Country";
$proto26["m_columns"][] = "Pincode";
$proto26["m_columns"][] = "IsVerified";
$proto26["m_columns"][] = "IsWrong";
$proto26["m_columns"][] = "AddressTypeId";
$proto26["m_columns"][] = "DevoteeId";
$obj = new SQLTable($proto26);

$proto25["m_table"] = $obj;
$proto25["m_alias"] = "";
$proto27=array();
$proto27["m_sql"] = "";
$proto27["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto27["m_column"]=$obj;
$proto27["m_contained"] = array();
$proto27["m_strCase"] = "";
$proto27["m_havingmode"] = "0";
$proto27["m_inBrackets"] = "0";
$proto27["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto27);

$proto25["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto25);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_devotee_address = createSqlQuery_devotee_address();
										$tdatadevotee_address[".sqlquery"] = $queryData_devotee_address;
	
if(isset($tdatadevotee_address["field2"])){
	$tdatadevotee_address["field2"]["LookupTable"] = "carscars_view";
	$tdatadevotee_address["field2"]["LookupOrderBy"] = "name";
	$tdatadevotee_address["field2"]["LookupType"] = 4;
	$tdatadevotee_address["field2"]["LinkField"] = "email";
	$tdatadevotee_address["field2"]["DisplayField"] = "name";
	$tdatadevotee_address[".hasCustomViewField"] = true;
}

$tableEvents["devotee_address"] = new eventsBase;
$tdatadevotee_address[".hasEvents"] = false;

$cipherer = new RunnerCipherer("devotee_address");

?>