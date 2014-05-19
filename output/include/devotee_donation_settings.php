<?php
require_once(getabspath("classes/cipherer.php"));
$tdatadevotee_donation = array();
	$tdatadevotee_donation[".NumberOfChars"] = 80; 
	$tdatadevotee_donation[".ShortName"] = "devotee_donation";
	$tdatadevotee_donation[".OwnerID"] = "";
	$tdatadevotee_donation[".OriginalTable"] = "devotee_donation";

//	field labels
$fieldLabelsdevotee_donation = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsdevotee_donation["English"] = array();
	$fieldToolTipsdevotee_donation["English"] = array();
	$fieldLabelsdevotee_donation["English"]["Amount"] = "Amount";
	$fieldToolTipsdevotee_donation["English"]["Amount"] = "";
	$fieldLabelsdevotee_donation["English"]["DonationId"] = "Donation Id";
	$fieldToolTipsdevotee_donation["English"]["DonationId"] = "";
	$fieldLabelsdevotee_donation["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsdevotee_donation["English"]["DevoteeId"] = "";
	$fieldLabelsdevotee_donation["English"]["DonationDate"] = "Donation Date";
	$fieldToolTipsdevotee_donation["English"]["DonationDate"] = "";
	$fieldLabelsdevotee_donation["English"]["DonationOnName"] = "Donation On Name";
	$fieldToolTipsdevotee_donation["English"]["DonationOnName"] = "";
	$fieldLabelsdevotee_donation["English"]["DonationOnNamePanNumber"] = "Donation On Name Pan Number";
	$fieldToolTipsdevotee_donation["English"]["DonationOnNamePanNumber"] = "";
	$fieldLabelsdevotee_donation["English"]["DonationPurposeId"] = "Donation Purpose Id";
	$fieldToolTipsdevotee_donation["English"]["DonationPurposeId"] = "";
	$fieldLabelsdevotee_donation["English"]["ReceiptNumber"] = "Receipt Number";
	$fieldToolTipsdevotee_donation["English"]["ReceiptNumber"] = "";
	$fieldLabelsdevotee_donation["English"]["DonationMode"] = "Donation Mode";
	$fieldToolTipsdevotee_donation["English"]["DonationMode"] = "";
	$fieldLabelsdevotee_donation["English"]["CheckNumber"] = "Check Number";
	$fieldToolTipsdevotee_donation["English"]["CheckNumber"] = "";
	$fieldLabelsdevotee_donation["English"]["CheckBank"] = "Check Bank";
	$fieldToolTipsdevotee_donation["English"]["CheckBank"] = "";
	$fieldLabelsdevotee_donation["English"]["CheckBranch"] = "Check Branch";
	$fieldToolTipsdevotee_donation["English"]["CheckBranch"] = "";
	$fieldLabelsdevotee_donation["English"]["CheckCleared"] = "Check Cleared";
	$fieldToolTipsdevotee_donation["English"]["CheckCleared"] = "";
	$fieldLabelsdevotee_donation["English"]["CheckClearedDate"] = "Check Cleared Date";
	$fieldToolTipsdevotee_donation["English"]["CheckClearedDate"] = "";
	if (count($fieldToolTipsdevotee_donation["English"]))
		$tdatadevotee_donation[".isUseToolTips"] = true;
}
	
	
	$tdatadevotee_donation[".NCSearch"] = true;



$tdatadevotee_donation[".shortTableName"] = "devotee_donation";
$tdatadevotee_donation[".nSecOptions"] = 0;
$tdatadevotee_donation[".recsPerRowList"] = 1;
$tdatadevotee_donation[".mainTableOwnerID"] = "";
$tdatadevotee_donation[".moveNext"] = 1;
$tdatadevotee_donation[".nType"] = 0;

$tdatadevotee_donation[".strOriginalTableName"] = "devotee_donation";




$tdatadevotee_donation[".showAddInPopup"] = true;

$tdatadevotee_donation[".showEditInPopup"] = true;

$tdatadevotee_donation[".showViewInPopup"] = true;

$tdatadevotee_donation[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatadevotee_donation[".listAjax"] = true;
else 
	$tdatadevotee_donation[".listAjax"] = false;

	$tdatadevotee_donation[".audit"] = true;

	$tdatadevotee_donation[".locking"] = false;

$tdatadevotee_donation[".listIcons"] = true;
$tdatadevotee_donation[".edit"] = true;
$tdatadevotee_donation[".inlineEdit"] = true;
$tdatadevotee_donation[".inlineAdd"] = true;
$tdatadevotee_donation[".copy"] = true;
$tdatadevotee_donation[".view"] = true;

$tdatadevotee_donation[".exportTo"] = true;

$tdatadevotee_donation[".printFriendly"] = true;

$tdatadevotee_donation[".delete"] = true;

$tdatadevotee_donation[".showSimpleSearchOptions"] = true;

$tdatadevotee_donation[".showSearchPanel"] = true;

if (isMobile())
	$tdatadevotee_donation[".isUseAjaxSuggest"] = false;
else 
	$tdatadevotee_donation[".isUseAjaxSuggest"] = true;

$tdatadevotee_donation[".rowHighlite"] = true;

// button handlers file names

$tdatadevotee_donation[".addPageEvents"] = false;

// use timepicker for search panel
$tdatadevotee_donation[".isUseTimeForSearch"] = false;




$tdatadevotee_donation[".allSearchFields"] = array();

$tdatadevotee_donation[".allSearchFields"][] = "DevoteeId";
$tdatadevotee_donation[".allSearchFields"][] = "DonationDate";
$tdatadevotee_donation[".allSearchFields"][] = "DonationOnName";
$tdatadevotee_donation[".allSearchFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".allSearchFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".allSearchFields"][] = "Amount";
$tdatadevotee_donation[".allSearchFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".allSearchFields"][] = "DonationMode";
$tdatadevotee_donation[".allSearchFields"][] = "CheckNumber";
$tdatadevotee_donation[".allSearchFields"][] = "CheckBank";
$tdatadevotee_donation[".allSearchFields"][] = "CheckBranch";
$tdatadevotee_donation[".allSearchFields"][] = "CheckCleared";
$tdatadevotee_donation[".allSearchFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".googleLikeFields"][] = "DonationId";
$tdatadevotee_donation[".googleLikeFields"][] = "DevoteeId";
$tdatadevotee_donation[".googleLikeFields"][] = "DonationDate";
$tdatadevotee_donation[".googleLikeFields"][] = "DonationOnName";
$tdatadevotee_donation[".googleLikeFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".googleLikeFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".googleLikeFields"][] = "Amount";
$tdatadevotee_donation[".googleLikeFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".googleLikeFields"][] = "DonationMode";
$tdatadevotee_donation[".googleLikeFields"][] = "CheckNumber";
$tdatadevotee_donation[".googleLikeFields"][] = "CheckBank";
$tdatadevotee_donation[".googleLikeFields"][] = "CheckBranch";
$tdatadevotee_donation[".googleLikeFields"][] = "CheckCleared";
$tdatadevotee_donation[".googleLikeFields"][] = "CheckClearedDate";


$tdatadevotee_donation[".advSearchFields"][] = "DevoteeId";
$tdatadevotee_donation[".advSearchFields"][] = "DonationDate";
$tdatadevotee_donation[".advSearchFields"][] = "DonationOnName";
$tdatadevotee_donation[".advSearchFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".advSearchFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".advSearchFields"][] = "Amount";
$tdatadevotee_donation[".advSearchFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".advSearchFields"][] = "DonationMode";
$tdatadevotee_donation[".advSearchFields"][] = "CheckNumber";
$tdatadevotee_donation[".advSearchFields"][] = "CheckBank";
$tdatadevotee_donation[".advSearchFields"][] = "CheckBranch";
$tdatadevotee_donation[".advSearchFields"][] = "CheckCleared";
$tdatadevotee_donation[".advSearchFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".isTableType"] = "list";

	
$tdatadevotee_donation[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main


$tdatadevotee_donation[".totalsFields"][] = array(
	"fName" => "Amount", 
	"numRows" => 0,
	"totalsType" => "TOTAL",
	"viewFormat" => '');

$tdatadevotee_donation[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatadevotee_donation[".strOrderBy"] = $tstrOrderBy;

$tdatadevotee_donation[".orderindexes"] = array();

$tdatadevotee_donation[".sqlHead"] = "SELECT DonationId,   DevoteeId,   DonationDate,   DonationOnName,   DonationOnNamePanNumber,   DonationPurposeId,   Amount,   ReceiptNumber,   DonationMode,   CheckNumber,   CheckBank,   CheckBranch,   CheckCleared,   CheckClearedDate";
$tdatadevotee_donation[".sqlFrom"] = "FROM devotee_donation";
$tdatadevotee_donation[".sqlWhereExpr"] = "";
$tdatadevotee_donation[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadevotee_donation[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadevotee_donation[".arrGroupsPerPage"] = $arrGPP;

$tableKeysdevotee_donation = array();
$tableKeysdevotee_donation[] = "DonationId";
$tdatadevotee_donation[".Keys"] = $tableKeysdevotee_donation;

$tdatadevotee_donation[".listFields"] = array();
$tdatadevotee_donation[".listFields"][] = "DonationDate";
$tdatadevotee_donation[".listFields"][] = "DonationOnName";
$tdatadevotee_donation[".listFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".listFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".listFields"][] = "Amount";
$tdatadevotee_donation[".listFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".listFields"][] = "DonationMode";
$tdatadevotee_donation[".listFields"][] = "CheckNumber";
$tdatadevotee_donation[".listFields"][] = "CheckBank";
$tdatadevotee_donation[".listFields"][] = "CheckBranch";
$tdatadevotee_donation[".listFields"][] = "CheckCleared";
$tdatadevotee_donation[".listFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".viewFields"] = array();
$tdatadevotee_donation[".viewFields"][] = "DevoteeId";
$tdatadevotee_donation[".viewFields"][] = "DonationDate";
$tdatadevotee_donation[".viewFields"][] = "DonationOnName";
$tdatadevotee_donation[".viewFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".viewFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".viewFields"][] = "Amount";
$tdatadevotee_donation[".viewFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".viewFields"][] = "DonationMode";
$tdatadevotee_donation[".viewFields"][] = "CheckNumber";
$tdatadevotee_donation[".viewFields"][] = "CheckBank";
$tdatadevotee_donation[".viewFields"][] = "CheckBranch";
$tdatadevotee_donation[".viewFields"][] = "CheckCleared";
$tdatadevotee_donation[".viewFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".addFields"] = array();
$tdatadevotee_donation[".addFields"][] = "DonationDate";
$tdatadevotee_donation[".addFields"][] = "DonationOnName";
$tdatadevotee_donation[".addFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".addFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".addFields"][] = "Amount";
$tdatadevotee_donation[".addFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".addFields"][] = "DonationMode";
$tdatadevotee_donation[".addFields"][] = "CheckNumber";
$tdatadevotee_donation[".addFields"][] = "CheckBank";
$tdatadevotee_donation[".addFields"][] = "CheckBranch";
$tdatadevotee_donation[".addFields"][] = "CheckCleared";
$tdatadevotee_donation[".addFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".inlineAddFields"] = array();
$tdatadevotee_donation[".inlineAddFields"][] = "DonationDate";
$tdatadevotee_donation[".inlineAddFields"][] = "DonationOnName";
$tdatadevotee_donation[".inlineAddFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".inlineAddFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".inlineAddFields"][] = "Amount";
$tdatadevotee_donation[".inlineAddFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".inlineAddFields"][] = "DonationMode";
$tdatadevotee_donation[".inlineAddFields"][] = "CheckNumber";
$tdatadevotee_donation[".inlineAddFields"][] = "CheckBank";
$tdatadevotee_donation[".inlineAddFields"][] = "CheckBranch";
$tdatadevotee_donation[".inlineAddFields"][] = "CheckCleared";
$tdatadevotee_donation[".inlineAddFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".editFields"] = array();
$tdatadevotee_donation[".editFields"][] = "DonationDate";
$tdatadevotee_donation[".editFields"][] = "DonationOnName";
$tdatadevotee_donation[".editFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".editFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".editFields"][] = "Amount";
$tdatadevotee_donation[".editFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".editFields"][] = "DonationMode";
$tdatadevotee_donation[".editFields"][] = "CheckNumber";
$tdatadevotee_donation[".editFields"][] = "CheckBank";
$tdatadevotee_donation[".editFields"][] = "CheckBranch";
$tdatadevotee_donation[".editFields"][] = "CheckCleared";
$tdatadevotee_donation[".editFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".inlineEditFields"] = array();
$tdatadevotee_donation[".inlineEditFields"][] = "DonationDate";
$tdatadevotee_donation[".inlineEditFields"][] = "DonationOnName";
$tdatadevotee_donation[".inlineEditFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".inlineEditFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".inlineEditFields"][] = "Amount";
$tdatadevotee_donation[".inlineEditFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".inlineEditFields"][] = "DonationMode";
$tdatadevotee_donation[".inlineEditFields"][] = "CheckNumber";
$tdatadevotee_donation[".inlineEditFields"][] = "CheckBank";
$tdatadevotee_donation[".inlineEditFields"][] = "CheckBranch";
$tdatadevotee_donation[".inlineEditFields"][] = "CheckCleared";
$tdatadevotee_donation[".inlineEditFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".exportFields"] = array();
$tdatadevotee_donation[".exportFields"][] = "DevoteeId";
$tdatadevotee_donation[".exportFields"][] = "DonationDate";
$tdatadevotee_donation[".exportFields"][] = "DonationOnName";
$tdatadevotee_donation[".exportFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".exportFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".exportFields"][] = "Amount";
$tdatadevotee_donation[".exportFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".exportFields"][] = "DonationMode";
$tdatadevotee_donation[".exportFields"][] = "CheckNumber";
$tdatadevotee_donation[".exportFields"][] = "CheckBank";
$tdatadevotee_donation[".exportFields"][] = "CheckBranch";
$tdatadevotee_donation[".exportFields"][] = "CheckCleared";
$tdatadevotee_donation[".exportFields"][] = "CheckClearedDate";

$tdatadevotee_donation[".printFields"] = array();
$tdatadevotee_donation[".printFields"][] = "DevoteeId";
$tdatadevotee_donation[".printFields"][] = "DonationDate";
$tdatadevotee_donation[".printFields"][] = "DonationOnName";
$tdatadevotee_donation[".printFields"][] = "DonationOnNamePanNumber";
$tdatadevotee_donation[".printFields"][] = "DonationPurposeId";
$tdatadevotee_donation[".printFields"][] = "Amount";
$tdatadevotee_donation[".printFields"][] = "ReceiptNumber";
$tdatadevotee_donation[".printFields"][] = "DonationMode";
$tdatadevotee_donation[".printFields"][] = "CheckNumber";
$tdatadevotee_donation[".printFields"][] = "CheckBank";
$tdatadevotee_donation[".printFields"][] = "CheckBranch";
$tdatadevotee_donation[".printFields"][] = "CheckCleared";
$tdatadevotee_donation[".printFields"][] = "CheckClearedDate";

//	DonationId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DonationId";
	$fdata["GoodName"] = "DonationId";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Donation Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DonationId"; 
		$fdata["FullName"] = "DonationId";
	
		
		
				
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
	
		
		
	$tdatadevotee_donation["DonationId"] = $fdata;
//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
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
	
		
		
	$tdatadevotee_donation["DevoteeId"] = $fdata;
//	DonationDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "DonationDate";
	$fdata["GoodName"] = "DonationDate";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Donation Date"; 
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
	
		$fdata["strField"] = "DonationDate"; 
		$fdata["FullName"] = "DonationDate";
	
		
		
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
	
		
		
	$tdatadevotee_donation["DonationDate"] = $fdata;
//	DonationOnName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "DonationOnName";
	$fdata["GoodName"] = "DonationOnName";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Donation On Name"; 
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
	
		$fdata["strField"] = "DonationOnName"; 
		$fdata["FullName"] = "DonationOnName";
	
		
		
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
	
		
		
	$tdatadevotee_donation["DonationOnName"] = $fdata;
//	DonationOnNamePanNumber
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "DonationOnNamePanNumber";
	$fdata["GoodName"] = "DonationOnNamePanNumber";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Donation On Name Pan Number"; 
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
	
		$fdata["strField"] = "DonationOnNamePanNumber"; 
		$fdata["FullName"] = "DonationOnNamePanNumber";
	
		
		
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
	
		
		
	$tdatadevotee_donation["DonationOnNamePanNumber"] = $fdata;
//	DonationPurposeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "DonationPurposeId";
	$fdata["GoodName"] = "DonationPurposeId";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Donation Purpose Id"; 
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
	
		$fdata["strField"] = "DonationPurposeId"; 
		$fdata["FullName"] = "DonationPurposeId";
	
		
		
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
				
		
			
	$edata["LinkField"] = "DonationPurposeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "PurposeTitle";
	
		
	$edata["LookupTable"] = "lu_donation_purpose";
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
	
		
		
	$tdatadevotee_donation["DonationPurposeId"] = $fdata;
//	Amount
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Amount";
	$fdata["GoodName"] = "Amount";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Amount"; 
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
	
		$fdata["strField"] = "Amount"; 
		$fdata["FullName"] = "Amount";
	
		
		
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
	
		
		
	$tdatadevotee_donation["Amount"] = $fdata;
//	ReceiptNumber
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "ReceiptNumber";
	$fdata["GoodName"] = "ReceiptNumber";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Receipt Number"; 
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
	
		$fdata["strField"] = "ReceiptNumber"; 
		$fdata["FullName"] = "ReceiptNumber";
	
		
		
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
	
		
		
	$tdatadevotee_donation["ReceiptNumber"] = $fdata;
//	DonationMode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "DonationMode";
	$fdata["GoodName"] = "DonationMode";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Donation Mode"; 
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
	
		$fdata["strField"] = "DonationMode"; 
		$fdata["FullName"] = "DonationMode";
	
		
		
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
				
		
			
	$edata["LinkField"] = "PaymentModeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "Mode";
	
		
	$edata["LookupTable"] = "lu_payment_modes";
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
	
		
		
	$tdatadevotee_donation["DonationMode"] = $fdata;
//	CheckNumber
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "CheckNumber";
	$fdata["GoodName"] = "CheckNumber";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Check Number"; 
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
	
		$fdata["strField"] = "CheckNumber"; 
		$fdata["FullName"] = "CheckNumber";
	
		
		
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
	
		
		
	$tdatadevotee_donation["CheckNumber"] = $fdata;
//	CheckBank
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "CheckBank";
	$fdata["GoodName"] = "CheckBank";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Check Bank"; 
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
	
		$fdata["strField"] = "CheckBank"; 
		$fdata["FullName"] = "CheckBank";
	
		
		
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
	
		
		
	$tdatadevotee_donation["CheckBank"] = $fdata;
//	CheckBranch
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "CheckBranch";
	$fdata["GoodName"] = "CheckBranch";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Check Branch"; 
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
	
		$fdata["strField"] = "CheckBranch"; 
		$fdata["FullName"] = "CheckBranch";
	
		
		
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
	
		
		
	$tdatadevotee_donation["CheckBranch"] = $fdata;
//	CheckCleared
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "CheckCleared";
	$fdata["GoodName"] = "CheckCleared";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Check Cleared"; 
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
	
		$fdata["strField"] = "CheckCleared"; 
		$fdata["FullName"] = "CheckCleared";
	
		
		
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
	
		
		
	$tdatadevotee_donation["CheckCleared"] = $fdata;
//	CheckClearedDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "CheckClearedDate";
	$fdata["GoodName"] = "CheckClearedDate";
	$fdata["ownerTable"] = "devotee_donation";
	$fdata["Label"] = "Check Cleared Date"; 
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
	
		$fdata["strField"] = "CheckClearedDate"; 
		$fdata["FullName"] = "CheckClearedDate";
	
		
		
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
	
		
		
	$tdatadevotee_donation["CheckClearedDate"] = $fdata;

	
$tables_data["devotee_donation"]=&$tdatadevotee_donation;
$field_labels["devotee_donation"] = &$fieldLabelsdevotee_donation;
$fieldToolTips["devotee_donation"] = &$fieldToolTipsdevotee_donation;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["devotee_donation"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["devotee_donation"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="devotee";
	$masterParams["mDataSourceTable"]="devotee";
	$masterParams["mOriginalTable"]= $strOriginalDetailsTable;
	$masterParams["mShortTable"]= "devotee";
	$masterParams["masterKeys"]= array();
	$masterParams["detailKeys"]= array();
	$masterParams["dispChildCount"]= "1";
	$masterParams["hideChild"]= "1";
	$masterParams["dispInfo"]= "1";
	$masterParams["previewOnList"]= 0;
	$masterParams["previewOnAdd"]= 1;
	$masterParams["previewOnEdit"]= 1;
	$masterParams["previewOnView"]= 1;
	$masterTablesData["devotee_donation"][$mIndex] = $masterParams;	
		$masterTablesData["devotee_donation"][$mIndex]["masterKeys"][]="DevoteeId";
		$masterTablesData["devotee_donation"][$mIndex]["detailKeys"][]="DevoteeId";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_devotee_donation()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DonationId,   DevoteeId,   DonationDate,   DonationOnName,   DonationOnNamePanNumber,   DonationPurposeId,   Amount,   ReceiptNumber,   DonationMode,   CheckNumber,   CheckBank,   CheckBranch,   CheckCleared,   CheckClearedDate";
$proto0["m_strFrom"] = "FROM devotee_donation";
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
	"m_strName" => "DonationId",
	"m_strTable" => "devotee_donation"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee_donation"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "DonationDate",
	"m_strTable" => "devotee_donation"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "DonationOnName",
	"m_strTable" => "devotee_donation"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "DonationOnNamePanNumber",
	"m_strTable" => "devotee_donation"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "DonationPurposeId",
	"m_strTable" => "devotee_donation"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Amount",
	"m_strTable" => "devotee_donation"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "ReceiptNumber",
	"m_strTable" => "devotee_donation"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "DonationMode",
	"m_strTable" => "devotee_donation"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "CheckNumber",
	"m_strTable" => "devotee_donation"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "CheckBank",
	"m_strTable" => "devotee_donation"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "CheckBranch",
	"m_strTable" => "devotee_donation"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "CheckCleared",
	"m_strTable" => "devotee_donation"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "CheckClearedDate",
	"m_strTable" => "devotee_donation"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto33=array();
$proto33["m_link"] = "SQLL_MAIN";
			$proto34=array();
$proto34["m_strName"] = "devotee_donation";
$proto34["m_columns"] = array();
$proto34["m_columns"][] = "DonationId";
$proto34["m_columns"][] = "DevoteeId";
$proto34["m_columns"][] = "DonationDate";
$proto34["m_columns"][] = "DonationOnName";
$proto34["m_columns"][] = "DonationOnNamePanNumber";
$proto34["m_columns"][] = "DonationPurposeId";
$proto34["m_columns"][] = "Amount";
$proto34["m_columns"][] = "ReceiptNumber";
$proto34["m_columns"][] = "DonationMode";
$proto34["m_columns"][] = "CheckNumber";
$proto34["m_columns"][] = "CheckBank";
$proto34["m_columns"][] = "CheckBranch";
$proto34["m_columns"][] = "CheckCleared";
$proto34["m_columns"][] = "CheckClearedDate";
$obj = new SQLTable($proto34);

$proto33["m_table"] = $obj;
$proto33["m_alias"] = "";
$proto35=array();
$proto35["m_sql"] = "";
$proto35["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto35["m_column"]=$obj;
$proto35["m_contained"] = array();
$proto35["m_strCase"] = "";
$proto35["m_havingmode"] = "0";
$proto35["m_inBrackets"] = "0";
$proto35["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto35);

$proto33["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto33);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_devotee_donation = createSqlQuery_devotee_donation();
														$tdatadevotee_donation[".sqlquery"] = $queryData_devotee_donation;
	
if(isset($tdatadevotee_donation["field2"])){
	$tdatadevotee_donation["field2"]["LookupTable"] = "carscars_view";
	$tdatadevotee_donation["field2"]["LookupOrderBy"] = "name";
	$tdatadevotee_donation["field2"]["LookupType"] = 4;
	$tdatadevotee_donation["field2"]["LinkField"] = "email";
	$tdatadevotee_donation["field2"]["DisplayField"] = "name";
	$tdatadevotee_donation[".hasCustomViewField"] = true;
}

$tableEvents["devotee_donation"] = new eventsBase;
$tdatadevotee_donation[".hasEvents"] = false;

$cipherer = new RunnerCipherer("devotee_donation");

?>