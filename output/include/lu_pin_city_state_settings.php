<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_pin_city_state = array();
	$tdatalu_pin_city_state[".NumberOfChars"] = 80; 
	$tdatalu_pin_city_state[".ShortName"] = "lu_pin_city_state";
	$tdatalu_pin_city_state[".OwnerID"] = "";
	$tdatalu_pin_city_state[".OriginalTable"] = "lu_pin_city_state";

//	field labels
$fieldLabelslu_pin_city_state = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_pin_city_state["English"] = array();
	$fieldToolTipslu_pin_city_state["English"] = array();
	$fieldLabelslu_pin_city_state["English"]["State"] = "State";
	$fieldToolTipslu_pin_city_state["English"]["State"] = "";
	$fieldLabelslu_pin_city_state["English"]["CountryCode"] = "Country Code";
	$fieldToolTipslu_pin_city_state["English"]["CountryCode"] = "";
	$fieldLabelslu_pin_city_state["English"]["PINcode"] = "PINcode";
	$fieldToolTipslu_pin_city_state["English"]["PINcode"] = "";
	$fieldLabelslu_pin_city_state["English"]["Locality"] = "Locality";
	$fieldToolTipslu_pin_city_state["English"]["Locality"] = "";
	$fieldLabelslu_pin_city_state["English"]["City"] = "City";
	$fieldToolTipslu_pin_city_state["English"]["City"] = "";
	$fieldLabelslu_pin_city_state["English"]["Latitude"] = "Latitude";
	$fieldToolTipslu_pin_city_state["English"]["Latitude"] = "";
	$fieldLabelslu_pin_city_state["English"]["Longitude"] = "Longitude";
	$fieldToolTipslu_pin_city_state["English"]["Longitude"] = "";
	$fieldLabelslu_pin_city_state["English"]["Accuracy"] = "Accuracy";
	$fieldToolTipslu_pin_city_state["English"]["Accuracy"] = "";
	$fieldLabelslu_pin_city_state["English"]["PIN_Code"] = "PIN Code";
	$fieldToolTipslu_pin_city_state["English"]["PIN Code"] = "";
	if (count($fieldToolTipslu_pin_city_state["English"]))
		$tdatalu_pin_city_state[".isUseToolTips"] = true;
}
	
	
	$tdatalu_pin_city_state[".NCSearch"] = true;



$tdatalu_pin_city_state[".shortTableName"] = "lu_pin_city_state";
$tdatalu_pin_city_state[".nSecOptions"] = 0;
$tdatalu_pin_city_state[".recsPerRowList"] = 1;
$tdatalu_pin_city_state[".mainTableOwnerID"] = "";
$tdatalu_pin_city_state[".moveNext"] = 1;
$tdatalu_pin_city_state[".nType"] = 0;

$tdatalu_pin_city_state[".strOriginalTableName"] = "lu_pin_city_state";




$tdatalu_pin_city_state[".showAddInPopup"] = false;

$tdatalu_pin_city_state[".showEditInPopup"] = false;

$tdatalu_pin_city_state[".showViewInPopup"] = false;

$tdatalu_pin_city_state[".fieldsForRegister"] = array();
	
$tdatalu_pin_city_state[".listAjax"] = false;

	$tdatalu_pin_city_state[".audit"] = false;

	$tdatalu_pin_city_state[".locking"] = false;

$tdatalu_pin_city_state[".listIcons"] = true;




$tdatalu_pin_city_state[".showSimpleSearchOptions"] = false;

$tdatalu_pin_city_state[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_pin_city_state[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_pin_city_state[".isUseAjaxSuggest"] = true;

$tdatalu_pin_city_state[".rowHighlite"] = true;

// button handlers file names

$tdatalu_pin_city_state[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_pin_city_state[".isUseTimeForSearch"] = false;




$tdatalu_pin_city_state[".allSearchFields"] = array();


$tdatalu_pin_city_state[".googleLikeFields"][] = "CountryCode";
$tdatalu_pin_city_state[".googleLikeFields"][] = "PINcode";
$tdatalu_pin_city_state[".googleLikeFields"][] = "Locality";
$tdatalu_pin_city_state[".googleLikeFields"][] = "State";
$tdatalu_pin_city_state[".googleLikeFields"][] = "City";
$tdatalu_pin_city_state[".googleLikeFields"][] = "Latitude";
$tdatalu_pin_city_state[".googleLikeFields"][] = "Longitude";
$tdatalu_pin_city_state[".googleLikeFields"][] = "Accuracy";


$tdatalu_pin_city_state[".advSearchFields"][] = "CountryCode";
$tdatalu_pin_city_state[".advSearchFields"][] = "PINcode";
$tdatalu_pin_city_state[".advSearchFields"][] = "Locality";
$tdatalu_pin_city_state[".advSearchFields"][] = "State";
$tdatalu_pin_city_state[".advSearchFields"][] = "City";
$tdatalu_pin_city_state[".advSearchFields"][] = "Latitude";
$tdatalu_pin_city_state[".advSearchFields"][] = "Longitude";
$tdatalu_pin_city_state[".advSearchFields"][] = "Accuracy";

$tdatalu_pin_city_state[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_pin_city_state[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_pin_city_state[".strOrderBy"] = $tstrOrderBy;

$tdatalu_pin_city_state[".orderindexes"] = array();

$tdatalu_pin_city_state[".sqlHead"] = "SELECT CountryCode,   PINcode,   Locality,   `State`,   City,   Latitude,   Longitude,   Accuracy";
$tdatalu_pin_city_state[".sqlFrom"] = "FROM lu_pin_city_state";
$tdatalu_pin_city_state[".sqlWhereExpr"] = "";
$tdatalu_pin_city_state[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_pin_city_state[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_pin_city_state[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_pin_city_state = array();
$tdatalu_pin_city_state[".Keys"] = $tableKeyslu_pin_city_state;

$tdatalu_pin_city_state[".listFields"] = array();
$tdatalu_pin_city_state[".listFields"][] = "CountryCode";
$tdatalu_pin_city_state[".listFields"][] = "PINcode";
$tdatalu_pin_city_state[".listFields"][] = "Locality";
$tdatalu_pin_city_state[".listFields"][] = "State";
$tdatalu_pin_city_state[".listFields"][] = "City";
$tdatalu_pin_city_state[".listFields"][] = "Latitude";
$tdatalu_pin_city_state[".listFields"][] = "Longitude";
$tdatalu_pin_city_state[".listFields"][] = "Accuracy";

$tdatalu_pin_city_state[".viewFields"] = array();
$tdatalu_pin_city_state[".viewFields"][] = "CountryCode";
$tdatalu_pin_city_state[".viewFields"][] = "PINcode";
$tdatalu_pin_city_state[".viewFields"][] = "Locality";
$tdatalu_pin_city_state[".viewFields"][] = "State";
$tdatalu_pin_city_state[".viewFields"][] = "City";
$tdatalu_pin_city_state[".viewFields"][] = "Latitude";
$tdatalu_pin_city_state[".viewFields"][] = "Longitude";
$tdatalu_pin_city_state[".viewFields"][] = "Accuracy";

$tdatalu_pin_city_state[".addFields"] = array();
$tdatalu_pin_city_state[".addFields"][] = "CountryCode";
$tdatalu_pin_city_state[".addFields"][] = "PINcode";
$tdatalu_pin_city_state[".addFields"][] = "Locality";
$tdatalu_pin_city_state[".addFields"][] = "State";
$tdatalu_pin_city_state[".addFields"][] = "City";
$tdatalu_pin_city_state[".addFields"][] = "Latitude";
$tdatalu_pin_city_state[".addFields"][] = "Longitude";
$tdatalu_pin_city_state[".addFields"][] = "Accuracy";

$tdatalu_pin_city_state[".inlineAddFields"] = array();
$tdatalu_pin_city_state[".inlineAddFields"][] = "CountryCode";
$tdatalu_pin_city_state[".inlineAddFields"][] = "PINcode";
$tdatalu_pin_city_state[".inlineAddFields"][] = "Locality";
$tdatalu_pin_city_state[".inlineAddFields"][] = "State";
$tdatalu_pin_city_state[".inlineAddFields"][] = "City";
$tdatalu_pin_city_state[".inlineAddFields"][] = "Latitude";
$tdatalu_pin_city_state[".inlineAddFields"][] = "Longitude";
$tdatalu_pin_city_state[".inlineAddFields"][] = "Accuracy";

$tdatalu_pin_city_state[".editFields"] = array();
$tdatalu_pin_city_state[".editFields"][] = "CountryCode";
$tdatalu_pin_city_state[".editFields"][] = "PINcode";
$tdatalu_pin_city_state[".editFields"][] = "Locality";
$tdatalu_pin_city_state[".editFields"][] = "State";
$tdatalu_pin_city_state[".editFields"][] = "City";
$tdatalu_pin_city_state[".editFields"][] = "Latitude";
$tdatalu_pin_city_state[".editFields"][] = "Longitude";
$tdatalu_pin_city_state[".editFields"][] = "Accuracy";

$tdatalu_pin_city_state[".inlineEditFields"] = array();
$tdatalu_pin_city_state[".inlineEditFields"][] = "CountryCode";
$tdatalu_pin_city_state[".inlineEditFields"][] = "PINcode";
$tdatalu_pin_city_state[".inlineEditFields"][] = "Locality";
$tdatalu_pin_city_state[".inlineEditFields"][] = "State";
$tdatalu_pin_city_state[".inlineEditFields"][] = "City";
$tdatalu_pin_city_state[".inlineEditFields"][] = "Latitude";
$tdatalu_pin_city_state[".inlineEditFields"][] = "Longitude";
$tdatalu_pin_city_state[".inlineEditFields"][] = "Accuracy";

$tdatalu_pin_city_state[".exportFields"] = array();
$tdatalu_pin_city_state[".exportFields"][] = "CountryCode";
$tdatalu_pin_city_state[".exportFields"][] = "PINcode";
$tdatalu_pin_city_state[".exportFields"][] = "Locality";
$tdatalu_pin_city_state[".exportFields"][] = "State";
$tdatalu_pin_city_state[".exportFields"][] = "City";
$tdatalu_pin_city_state[".exportFields"][] = "Latitude";
$tdatalu_pin_city_state[".exportFields"][] = "Longitude";
$tdatalu_pin_city_state[".exportFields"][] = "Accuracy";

$tdatalu_pin_city_state[".printFields"] = array();
$tdatalu_pin_city_state[".printFields"][] = "CountryCode";
$tdatalu_pin_city_state[".printFields"][] = "PINcode";
$tdatalu_pin_city_state[".printFields"][] = "Locality";
$tdatalu_pin_city_state[".printFields"][] = "State";
$tdatalu_pin_city_state[".printFields"][] = "City";
$tdatalu_pin_city_state[".printFields"][] = "Latitude";
$tdatalu_pin_city_state[".printFields"][] = "Longitude";
$tdatalu_pin_city_state[".printFields"][] = "Accuracy";

//	CountryCode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "CountryCode";
	$fdata["GoodName"] = "CountryCode";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "Country Code"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "CountryCode"; 
		$fdata["FullName"] = "CountryCode";
	
		
		
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
			$edata["EditParams"].= " maxlength=2";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["CountryCode"] = $fdata;
//	PINcode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "PINcode";
	$fdata["GoodName"] = "PINcode";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "PINcode"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "PINcode"; 
		$fdata["FullName"] = "PINcode";
	
		
		
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
			$edata["EditParams"].= " maxlength=20";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["PINcode"] = $fdata;
//	Locality
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Locality";
	$fdata["GoodName"] = "Locality";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "Locality"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Locality"; 
		$fdata["FullName"] = "Locality";
	
		
		
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
			$edata["EditParams"].= " maxlength=180";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["Locality"] = $fdata;
//	State
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "State";
	$fdata["GoodName"] = "State";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "State"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
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
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["State"] = $fdata;
//	City
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "City";
	$fdata["GoodName"] = "City";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "City"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
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
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["City"] = $fdata;
//	Latitude
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Latitude";
	$fdata["GoodName"] = "Latitude";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "Latitude"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Latitude"; 
		$fdata["FullName"] = "Latitude";
	
		
		
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
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["Latitude"] = $fdata;
//	Longitude
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Longitude";
	$fdata["GoodName"] = "Longitude";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "Longitude"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Longitude"; 
		$fdata["FullName"] = "Longitude";
	
		
		
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
			$edata["EditParams"].= " maxlength=100";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["Longitude"] = $fdata;
//	Accuracy
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "Accuracy";
	$fdata["GoodName"] = "Accuracy";
	$fdata["ownerTable"] = "lu_pin_city_state";
	$fdata["Label"] = "Accuracy"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Accuracy"; 
		$fdata["FullName"] = "Accuracy";
	
		
		
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
			$edata["EditParams"].= " maxlength=1";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_pin_city_state["Accuracy"] = $fdata;

	
$tables_data["lu_pin_city_state"]=&$tdatalu_pin_city_state;
$field_labels["lu_pin_city_state"] = &$fieldLabelslu_pin_city_state;
$fieldToolTips["lu_pin_city_state"] = &$fieldToolTipslu_pin_city_state;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_pin_city_state"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_pin_city_state"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_pin_city_state()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "CountryCode,   PINcode,   Locality,   `State`,   City,   Latitude,   Longitude,   Accuracy";
$proto0["m_strFrom"] = "FROM lu_pin_city_state";
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
	"m_strName" => "CountryCode",
	"m_strTable" => "lu_pin_city_state"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "PINcode",
	"m_strTable" => "lu_pin_city_state"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Locality",
	"m_strTable" => "lu_pin_city_state"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "State",
	"m_strTable" => "lu_pin_city_state"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "City",
	"m_strTable" => "lu_pin_city_state"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Latitude",
	"m_strTable" => "lu_pin_city_state"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Longitude",
	"m_strTable" => "lu_pin_city_state"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "Accuracy",
	"m_strTable" => "lu_pin_city_state"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto21=array();
$proto21["m_link"] = "SQLL_MAIN";
			$proto22=array();
$proto22["m_strName"] = "lu_pin_city_state";
$proto22["m_columns"] = array();
$proto22["m_columns"][] = "CountryCode";
$proto22["m_columns"][] = "PINcode";
$proto22["m_columns"][] = "Locality";
$proto22["m_columns"][] = "State";
$proto22["m_columns"][] = "City";
$proto22["m_columns"][] = "Latitude";
$proto22["m_columns"][] = "Longitude";
$proto22["m_columns"][] = "Accuracy";
$obj = new SQLTable($proto22);

$proto21["m_table"] = $obj;
$proto21["m_alias"] = "";
$proto23=array();
$proto23["m_sql"] = "";
$proto23["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto23["m_column"]=$obj;
$proto23["m_contained"] = array();
$proto23["m_strCase"] = "";
$proto23["m_havingmode"] = "0";
$proto23["m_inBrackets"] = "0";
$proto23["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto23);

$proto21["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto21);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_lu_pin_city_state = createSqlQuery_lu_pin_city_state();
								$tdatalu_pin_city_state[".sqlquery"] = $queryData_lu_pin_city_state;
	
if(isset($tdatalu_pin_city_state["field2"])){
	$tdatalu_pin_city_state["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_pin_city_state["field2"]["LookupOrderBy"] = "name";
	$tdatalu_pin_city_state["field2"]["LookupType"] = 4;
	$tdatalu_pin_city_state["field2"]["LinkField"] = "email";
	$tdatalu_pin_city_state["field2"]["DisplayField"] = "name";
	$tdatalu_pin_city_state[".hasCustomViewField"] = true;
}

$tableEvents["lu_pin_city_state"] = new eventsBase;
$tdatalu_pin_city_state[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_pin_city_state");

?>