<?php
require_once(getabspath("classes/cipherer.php"));
$tdatacompany = array();
	$tdatacompany[".NumberOfChars"] = 80; 
	$tdatacompany[".ShortName"] = "company";
	$tdatacompany[".OwnerID"] = "";
	$tdatacompany[".OriginalTable"] = "company";

//	field labels
$fieldLabelscompany = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelscompany["English"] = array();
	$fieldToolTipscompany["English"] = array();
	$fieldLabelscompany["English"]["Remark"] = "Remark";
	$fieldToolTipscompany["English"]["Remark"] = "";
	$fieldLabelscompany["English"]["CompanyId"] = "Company";
	$fieldToolTipscompany["English"]["CompanyId"] = "";
	$fieldLabelscompany["English"]["CompanyName"] = "Company Name";
	$fieldToolTipscompany["English"]["CompanyName"] = "";
	$fieldLabelscompany["English"]["Address_Line1"] = "Address Line1";
	$fieldToolTipscompany["English"]["Address Line1"] = "";
	$fieldLabelscompany["English"]["Address_Line2"] = "Address Line2";
	$fieldToolTipscompany["English"]["Address Line2"] = "";
	$fieldLabelscompany["English"]["City"] = "City";
	$fieldToolTipscompany["English"]["City"] = "";
	$fieldLabelscompany["English"]["PIN_Code"] = "PIN Code";
	$fieldToolTipscompany["English"]["PIN Code"] = "";
	$fieldLabelscompany["English"]["State"] = "State";
	$fieldToolTipscompany["English"]["State"] = "";
	$fieldLabelscompany["English"]["Country"] = "Country";
	$fieldToolTipscompany["English"]["Country"] = "";
	if (count($fieldToolTipscompany["English"]))
		$tdatacompany[".isUseToolTips"] = true;
}
	
	
	$tdatacompany[".NCSearch"] = true;



$tdatacompany[".shortTableName"] = "company";
$tdatacompany[".nSecOptions"] = 0;
$tdatacompany[".recsPerRowList"] = 1;
$tdatacompany[".mainTableOwnerID"] = "";
$tdatacompany[".moveNext"] = 1;
$tdatacompany[".nType"] = 0;

$tdatacompany[".strOriginalTableName"] = "company";




$tdatacompany[".showAddInPopup"] = true;

$tdatacompany[".showEditInPopup"] = true;

$tdatacompany[".showViewInPopup"] = true;

$tdatacompany[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatacompany[".listAjax"] = true;
else 
	$tdatacompany[".listAjax"] = false;

	$tdatacompany[".audit"] = true;

	$tdatacompany[".locking"] = false;

$tdatacompany[".listIcons"] = true;
$tdatacompany[".edit"] = true;
$tdatacompany[".inlineEdit"] = true;
$tdatacompany[".inlineAdd"] = true;
$tdatacompany[".copy"] = true;
$tdatacompany[".view"] = true;

$tdatacompany[".exportTo"] = true;

$tdatacompany[".printFriendly"] = true;

$tdatacompany[".delete"] = true;

$tdatacompany[".showSimpleSearchOptions"] = true;

$tdatacompany[".showSearchPanel"] = true;

if (isMobile())
	$tdatacompany[".isUseAjaxSuggest"] = false;
else 
	$tdatacompany[".isUseAjaxSuggest"] = true;

$tdatacompany[".rowHighlite"] = true;

// button handlers file names

$tdatacompany[".addPageEvents"] = false;

// use timepicker for search panel
$tdatacompany[".isUseTimeForSearch"] = false;




$tdatacompany[".allSearchFields"] = array();

$tdatacompany[".allSearchFields"][] = "CompanyId";
$tdatacompany[".allSearchFields"][] = "CompanyName";
$tdatacompany[".allSearchFields"][] = "Address Line1";
$tdatacompany[".allSearchFields"][] = "Address Line2";
$tdatacompany[".allSearchFields"][] = "City";
$tdatacompany[".allSearchFields"][] = "State";
$tdatacompany[".allSearchFields"][] = "PIN Code";
$tdatacompany[".allSearchFields"][] = "Country";
$tdatacompany[".allSearchFields"][] = "Remark";

$tdatacompany[".googleLikeFields"][] = "CompanyId";
$tdatacompany[".googleLikeFields"][] = "CompanyName";
$tdatacompany[".googleLikeFields"][] = "Remark";
$tdatacompany[".googleLikeFields"][] = "Address Line1";
$tdatacompany[".googleLikeFields"][] = "Address Line2";
$tdatacompany[".googleLikeFields"][] = "City";
$tdatacompany[".googleLikeFields"][] = "PIN Code";
$tdatacompany[".googleLikeFields"][] = "State";
$tdatacompany[".googleLikeFields"][] = "Country";


$tdatacompany[".advSearchFields"][] = "CompanyId";
$tdatacompany[".advSearchFields"][] = "CompanyName";
$tdatacompany[".advSearchFields"][] = "Address Line1";
$tdatacompany[".advSearchFields"][] = "Address Line2";
$tdatacompany[".advSearchFields"][] = "City";
$tdatacompany[".advSearchFields"][] = "State";
$tdatacompany[".advSearchFields"][] = "PIN Code";
$tdatacompany[".advSearchFields"][] = "Country";
$tdatacompany[".advSearchFields"][] = "Remark";

$tdatacompany[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatacompany[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatacompany[".strOrderBy"] = $tstrOrderBy;

$tdatacompany[".orderindexes"] = array();

$tdatacompany[".sqlHead"] = "SELECT CompanyId,  CompanyName,  Remark,  `Address Line1`,  `Address Line2`,  City,  `PIN Code`,  `State`,  Country";
$tdatacompany[".sqlFrom"] = "FROM company";
$tdatacompany[".sqlWhereExpr"] = "";
$tdatacompany[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatacompany[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatacompany[".arrGroupsPerPage"] = $arrGPP;

$tableKeyscompany = array();
$tableKeyscompany[] = "CompanyId";
$tdatacompany[".Keys"] = $tableKeyscompany;

$tdatacompany[".listFields"] = array();
$tdatacompany[".listFields"][] = "CompanyName";
$tdatacompany[".listFields"][] = "Address Line1";
$tdatacompany[".listFields"][] = "Address Line2";
$tdatacompany[".listFields"][] = "City";
$tdatacompany[".listFields"][] = "State";
$tdatacompany[".listFields"][] = "PIN Code";
$tdatacompany[".listFields"][] = "Country";
$tdatacompany[".listFields"][] = "Remark";

$tdatacompany[".viewFields"] = array();
$tdatacompany[".viewFields"][] = "CompanyName";
$tdatacompany[".viewFields"][] = "Address Line1";
$tdatacompany[".viewFields"][] = "Address Line2";
$tdatacompany[".viewFields"][] = "City";
$tdatacompany[".viewFields"][] = "State";
$tdatacompany[".viewFields"][] = "PIN Code";
$tdatacompany[".viewFields"][] = "Country";
$tdatacompany[".viewFields"][] = "Remark";

$tdatacompany[".addFields"] = array();
$tdatacompany[".addFields"][] = "CompanyName";
$tdatacompany[".addFields"][] = "Address Line1";
$tdatacompany[".addFields"][] = "Address Line2";
$tdatacompany[".addFields"][] = "State";
$tdatacompany[".addFields"][] = "City";
$tdatacompany[".addFields"][] = "PIN Code";
$tdatacompany[".addFields"][] = "Country";
$tdatacompany[".addFields"][] = "Remark";

$tdatacompany[".inlineAddFields"] = array();
$tdatacompany[".inlineAddFields"][] = "CompanyName";
$tdatacompany[".inlineAddFields"][] = "Address Line1";
$tdatacompany[".inlineAddFields"][] = "Address Line2";
$tdatacompany[".inlineAddFields"][] = "City";
$tdatacompany[".inlineAddFields"][] = "State";
$tdatacompany[".inlineAddFields"][] = "PIN Code";
$tdatacompany[".inlineAddFields"][] = "Country";
$tdatacompany[".inlineAddFields"][] = "Remark";

$tdatacompany[".editFields"] = array();
$tdatacompany[".editFields"][] = "CompanyName";
$tdatacompany[".editFields"][] = "Address Line1";
$tdatacompany[".editFields"][] = "Address Line2";
$tdatacompany[".editFields"][] = "City";
$tdatacompany[".editFields"][] = "State";
$tdatacompany[".editFields"][] = "PIN Code";
$tdatacompany[".editFields"][] = "Country";
$tdatacompany[".editFields"][] = "Remark";

$tdatacompany[".inlineEditFields"] = array();
$tdatacompany[".inlineEditFields"][] = "CompanyName";
$tdatacompany[".inlineEditFields"][] = "Address Line1";
$tdatacompany[".inlineEditFields"][] = "Address Line2";
$tdatacompany[".inlineEditFields"][] = "City";
$tdatacompany[".inlineEditFields"][] = "State";
$tdatacompany[".inlineEditFields"][] = "PIN Code";
$tdatacompany[".inlineEditFields"][] = "Country";
$tdatacompany[".inlineEditFields"][] = "Remark";

$tdatacompany[".exportFields"] = array();
$tdatacompany[".exportFields"][] = "CompanyName";
$tdatacompany[".exportFields"][] = "Address Line1";
$tdatacompany[".exportFields"][] = "Address Line2";
$tdatacompany[".exportFields"][] = "City";
$tdatacompany[".exportFields"][] = "State";
$tdatacompany[".exportFields"][] = "PIN Code";
$tdatacompany[".exportFields"][] = "Country";
$tdatacompany[".exportFields"][] = "Remark";

$tdatacompany[".printFields"] = array();
$tdatacompany[".printFields"][] = "CompanyName";
$tdatacompany[".printFields"][] = "Address Line1";
$tdatacompany[".printFields"][] = "Address Line2";
$tdatacompany[".printFields"][] = "City";
$tdatacompany[".printFields"][] = "State";
$tdatacompany[".printFields"][] = "PIN Code";
$tdatacompany[".printFields"][] = "Country";
$tdatacompany[".printFields"][] = "Remark";

//	CompanyId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "CompanyId";
	$fdata["GoodName"] = "CompanyId";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "Company"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "CompanyId"; 
		$fdata["FullName"] = "CompanyId";
	
		
		
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
				if(strpos(GetUserPermissions("company"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "CompanyId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "CompanyName";
	
		
	$edata["LookupTable"] = "company";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
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
	
		
		
	$tdatacompany["CompanyId"] = $fdata;
//	CompanyName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "CompanyName";
	$fdata["GoodName"] = "CompanyName";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "Company Name"; 
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
	
		$fdata["strField"] = "CompanyName"; 
		$fdata["FullName"] = "CompanyName";
	
		
		
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
	
		
		
	$tdatacompany["CompanyName"] = $fdata;
//	Remark
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Remark";
	$fdata["GoodName"] = "Remark";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "Remark"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Remark"; 
		$fdata["FullName"] = "Remark";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatacompany["Remark"] = $fdata;
//	Address Line1
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "Address Line1";
	$fdata["GoodName"] = "Address_Line1";
	$fdata["ownerTable"] = "company";
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
	
		$fdata["strField"] = "Address Line1"; 
		$fdata["FullName"] = "`Address Line1`";
	
		
		
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
	
		
		
	$tdatacompany["Address Line1"] = $fdata;
//	Address Line2
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "Address Line2";
	$fdata["GoodName"] = "Address_Line2";
	$fdata["ownerTable"] = "company";
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
	
		$fdata["strField"] = "Address Line2"; 
		$fdata["FullName"] = "`Address Line2`";
	
		
		
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
	
		
		
	$tdatacompany["Address Line2"] = $fdata;
//	City
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "City";
	$fdata["GoodName"] = "City";
	$fdata["ownerTable"] = "company";
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
	
		
		
	$tdatacompany["City"] = $fdata;
//	PIN Code
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "PIN Code";
	$fdata["GoodName"] = "PIN_Code";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "PIN Code"; 
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
	
		$fdata["strField"] = "PIN Code"; 
		$fdata["FullName"] = "`PIN Code`";
	
		
		
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
	
		
		
	$tdatacompany["PIN Code"] = $fdata;
//	State
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "State";
	$fdata["GoodName"] = "State";
	$fdata["ownerTable"] = "company";
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
	
		
		
	$tdatacompany["State"] = $fdata;
//	Country
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "Country";
	$fdata["GoodName"] = "Country";
	$fdata["ownerTable"] = "company";
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatacompany["Country"] = $fdata;

	
$tables_data["company"]=&$tdatacompany;
$field_labels["company"] = &$fieldLabelscompany;
$fieldToolTips["company"] = &$fieldToolTipscompany;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["company"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["company"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_company()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "CompanyId,  CompanyName,  Remark,  `Address Line1`,  `Address Line2`,  City,  `PIN Code`,  `State`,  Country";
$proto0["m_strFrom"] = "FROM company";
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
	"m_strName" => "CompanyId",
	"m_strTable" => "company"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "CompanyName",
	"m_strTable" => "company"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Remark",
	"m_strTable" => "company"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Address Line1",
	"m_strTable" => "company"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "Address Line2",
	"m_strTable" => "company"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "City",
	"m_strTable" => "company"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "PIN Code",
	"m_strTable" => "company"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "State",
	"m_strTable" => "company"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "Country",
	"m_strTable" => "company"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto23=array();
$proto23["m_link"] = "SQLL_MAIN";
			$proto24=array();
$proto24["m_strName"] = "company";
$proto24["m_columns"] = array();
$proto24["m_columns"][] = "CompanyId";
$proto24["m_columns"][] = "CompanyName";
$proto24["m_columns"][] = "Address Line1";
$proto24["m_columns"][] = "Address Line2";
$proto24["m_columns"][] = "City";
$proto24["m_columns"][] = "PIN Code";
$proto24["m_columns"][] = "State";
$proto24["m_columns"][] = "Country";
$proto24["m_columns"][] = "Remark";
$obj = new SQLTable($proto24);

$proto23["m_table"] = $obj;
$proto23["m_alias"] = "";
$proto25=array();
$proto25["m_sql"] = "";
$proto25["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto25["m_column"]=$obj;
$proto25["m_contained"] = array();
$proto25["m_strCase"] = "";
$proto25["m_havingmode"] = "0";
$proto25["m_inBrackets"] = "0";
$proto25["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto25);

$proto23["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto23);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_company = createSqlQuery_company();
									$tdatacompany[".sqlquery"] = $queryData_company;
	
if(isset($tdatacompany["field2"])){
	$tdatacompany["field2"]["LookupTable"] = "carscars_view";
	$tdatacompany["field2"]["LookupOrderBy"] = "name";
	$tdatacompany["field2"]["LookupType"] = 4;
	$tdatacompany["field2"]["LinkField"] = "email";
	$tdatacompany["field2"]["DisplayField"] = "name";
	$tdatacompany[".hasCustomViewField"] = true;
}

$tableEvents["company"] = new eventsBase;
$tdatacompany[".hasEvents"] = false;

$cipherer = new RunnerCipherer("company");

?>