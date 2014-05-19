<?php
require_once(getabspath("classes/cipherer.php"));
$tdatadevotee_language = array();
	$tdatadevotee_language[".NumberOfChars"] = 80; 
	$tdatadevotee_language[".ShortName"] = "devotee_language";
	$tdatadevotee_language[".OwnerID"] = "";
	$tdatadevotee_language[".OriginalTable"] = "devotee_language";

//	field labels
$fieldLabelsdevotee_language = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsdevotee_language["English"] = array();
	$fieldToolTipsdevotee_language["English"] = array();
	$fieldLabelsdevotee_language["English"]["DevoteeLanguageId"] = "Devotee Language Id";
	$fieldToolTipsdevotee_language["English"]["DevoteeLanguageId"] = "";
	$fieldLabelsdevotee_language["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsdevotee_language["English"]["DevoteeId"] = "";
	$fieldLabelsdevotee_language["English"]["LanguageId"] = "Language";
	$fieldToolTipsdevotee_language["English"]["LanguageId"] = "";
	$fieldLabelsdevotee_language["English"]["SpeakingLevel"] = "Speaking Level";
	$fieldToolTipsdevotee_language["English"]["SpeakingLevel"] = "";
	$fieldLabelsdevotee_language["English"]["ReadingLevel"] = "Reading Level";
	$fieldToolTipsdevotee_language["English"]["ReadingLevel"] = "";
	$fieldLabelsdevotee_language["English"]["WritingLevel"] = "Writing Level";
	$fieldToolTipsdevotee_language["English"]["WritingLevel"] = "";
	if (count($fieldToolTipsdevotee_language["English"]))
		$tdatadevotee_language[".isUseToolTips"] = true;
}
	
	
	$tdatadevotee_language[".NCSearch"] = true;



$tdatadevotee_language[".shortTableName"] = "devotee_language";
$tdatadevotee_language[".nSecOptions"] = 0;
$tdatadevotee_language[".recsPerRowList"] = 1;
$tdatadevotee_language[".mainTableOwnerID"] = "";
$tdatadevotee_language[".moveNext"] = 1;
$tdatadevotee_language[".nType"] = 0;

$tdatadevotee_language[".strOriginalTableName"] = "devotee_language";




$tdatadevotee_language[".showAddInPopup"] = true;

$tdatadevotee_language[".showEditInPopup"] = true;

$tdatadevotee_language[".showViewInPopup"] = true;

$tdatadevotee_language[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatadevotee_language[".listAjax"] = true;
else 
	$tdatadevotee_language[".listAjax"] = false;

	$tdatadevotee_language[".audit"] = true;

	$tdatadevotee_language[".locking"] = false;

$tdatadevotee_language[".listIcons"] = true;
$tdatadevotee_language[".edit"] = true;
$tdatadevotee_language[".inlineEdit"] = true;
$tdatadevotee_language[".inlineAdd"] = true;
$tdatadevotee_language[".copy"] = true;
$tdatadevotee_language[".view"] = true;

$tdatadevotee_language[".exportTo"] = true;

$tdatadevotee_language[".printFriendly"] = true;

$tdatadevotee_language[".delete"] = true;

$tdatadevotee_language[".showSimpleSearchOptions"] = true;

$tdatadevotee_language[".showSearchPanel"] = true;

if (isMobile())
	$tdatadevotee_language[".isUseAjaxSuggest"] = false;
else 
	$tdatadevotee_language[".isUseAjaxSuggest"] = true;

$tdatadevotee_language[".rowHighlite"] = true;

// button handlers file names

$tdatadevotee_language[".addPageEvents"] = false;

// use timepicker for search panel
$tdatadevotee_language[".isUseTimeForSearch"] = false;




$tdatadevotee_language[".allSearchFields"] = array();

$tdatadevotee_language[".allSearchFields"][] = "LanguageId";
$tdatadevotee_language[".allSearchFields"][] = "SpeakingLevel";
$tdatadevotee_language[".allSearchFields"][] = "ReadingLevel";
$tdatadevotee_language[".allSearchFields"][] = "WritingLevel";

$tdatadevotee_language[".googleLikeFields"][] = "DevoteeLanguageId";
$tdatadevotee_language[".googleLikeFields"][] = "DevoteeId";
$tdatadevotee_language[".googleLikeFields"][] = "LanguageId";
$tdatadevotee_language[".googleLikeFields"][] = "SpeakingLevel";
$tdatadevotee_language[".googleLikeFields"][] = "ReadingLevel";
$tdatadevotee_language[".googleLikeFields"][] = "WritingLevel";


$tdatadevotee_language[".advSearchFields"][] = "LanguageId";
$tdatadevotee_language[".advSearchFields"][] = "SpeakingLevel";
$tdatadevotee_language[".advSearchFields"][] = "ReadingLevel";
$tdatadevotee_language[".advSearchFields"][] = "WritingLevel";

$tdatadevotee_language[".isTableType"] = "list";

	
$tdatadevotee_language[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main



$tdatadevotee_language[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatadevotee_language[".strOrderBy"] = $tstrOrderBy;

$tdatadevotee_language[".orderindexes"] = array();

$tdatadevotee_language[".sqlHead"] = "SELECT DevoteeLanguageId,   DevoteeId,   LanguageId,   SpeakingLevel,   ReadingLevel,   WritingLevel";
$tdatadevotee_language[".sqlFrom"] = "FROM devotee_language";
$tdatadevotee_language[".sqlWhereExpr"] = "";
$tdatadevotee_language[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadevotee_language[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadevotee_language[".arrGroupsPerPage"] = $arrGPP;

$tableKeysdevotee_language = array();
$tableKeysdevotee_language[] = "DevoteeLanguageId";
$tdatadevotee_language[".Keys"] = $tableKeysdevotee_language;

$tdatadevotee_language[".listFields"] = array();
$tdatadevotee_language[".listFields"][] = "LanguageId";
$tdatadevotee_language[".listFields"][] = "SpeakingLevel";
$tdatadevotee_language[".listFields"][] = "ReadingLevel";
$tdatadevotee_language[".listFields"][] = "WritingLevel";

$tdatadevotee_language[".viewFields"] = array();
$tdatadevotee_language[".viewFields"][] = "LanguageId";
$tdatadevotee_language[".viewFields"][] = "SpeakingLevel";
$tdatadevotee_language[".viewFields"][] = "ReadingLevel";
$tdatadevotee_language[".viewFields"][] = "WritingLevel";

$tdatadevotee_language[".addFields"] = array();
$tdatadevotee_language[".addFields"][] = "LanguageId";
$tdatadevotee_language[".addFields"][] = "SpeakingLevel";
$tdatadevotee_language[".addFields"][] = "ReadingLevel";
$tdatadevotee_language[".addFields"][] = "WritingLevel";

$tdatadevotee_language[".inlineAddFields"] = array();
$tdatadevotee_language[".inlineAddFields"][] = "LanguageId";
$tdatadevotee_language[".inlineAddFields"][] = "SpeakingLevel";
$tdatadevotee_language[".inlineAddFields"][] = "ReadingLevel";
$tdatadevotee_language[".inlineAddFields"][] = "WritingLevel";

$tdatadevotee_language[".editFields"] = array();
$tdatadevotee_language[".editFields"][] = "LanguageId";
$tdatadevotee_language[".editFields"][] = "SpeakingLevel";
$tdatadevotee_language[".editFields"][] = "ReadingLevel";
$tdatadevotee_language[".editFields"][] = "WritingLevel";

$tdatadevotee_language[".inlineEditFields"] = array();
$tdatadevotee_language[".inlineEditFields"][] = "LanguageId";
$tdatadevotee_language[".inlineEditFields"][] = "SpeakingLevel";
$tdatadevotee_language[".inlineEditFields"][] = "ReadingLevel";
$tdatadevotee_language[".inlineEditFields"][] = "WritingLevel";

$tdatadevotee_language[".exportFields"] = array();
$tdatadevotee_language[".exportFields"][] = "LanguageId";
$tdatadevotee_language[".exportFields"][] = "SpeakingLevel";
$tdatadevotee_language[".exportFields"][] = "ReadingLevel";
$tdatadevotee_language[".exportFields"][] = "WritingLevel";

$tdatadevotee_language[".printFields"] = array();
$tdatadevotee_language[".printFields"][] = "LanguageId";
$tdatadevotee_language[".printFields"][] = "SpeakingLevel";
$tdatadevotee_language[".printFields"][] = "ReadingLevel";
$tdatadevotee_language[".printFields"][] = "WritingLevel";

//	DevoteeLanguageId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DevoteeLanguageId";
	$fdata["GoodName"] = "DevoteeLanguageId";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Devotee Language Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DevoteeLanguageId"; 
		$fdata["FullName"] = "DevoteeLanguageId";
	
		
		
				
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
	
		
		
	$tdatadevotee_language["DevoteeLanguageId"] = $fdata;
//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee_language";
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
	
		
		
	$tdatadevotee_language["DevoteeId"] = $fdata;
//	LanguageId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "LanguageId";
	$fdata["GoodName"] = "LanguageId";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Language"; 
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
	
		$fdata["strField"] = "LanguageId"; 
		$fdata["FullName"] = "LanguageId";
	
		
		
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
				
		
			$edata["LookupUnique"] = true;
	
	$edata["LinkField"] = "LanguageId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "language";
	
		
	$edata["LookupTable"] = "lu_languages";
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
	
		
		
	$tdatadevotee_language["LanguageId"] = $fdata;
//	SpeakingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "SpeakingLevel";
	$fdata["GoodName"] = "SpeakingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Speaking Level"; 
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
	
		$fdata["strField"] = "SpeakingLevel"; 
		$fdata["FullName"] = "SpeakingLevel";
	
		
		
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
	$edata["LookupValues"][] = "1";
	$edata["LookupValues"][] = "2";
	$edata["LookupValues"][] = "3";
	$edata["LookupValues"][] = "4";
	$edata["LookupValues"][] = "5";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_language["SpeakingLevel"] = $fdata;
//	ReadingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "ReadingLevel";
	$fdata["GoodName"] = "ReadingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Reading Level"; 
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
	
		$fdata["strField"] = "ReadingLevel"; 
		$fdata["FullName"] = "ReadingLevel";
	
		
		
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
	$edata["LookupValues"][] = "1";
	$edata["LookupValues"][] = "2";
	$edata["LookupValues"][] = "3";
	$edata["LookupValues"][] = "4";
	$edata["LookupValues"][] = "5";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_language["ReadingLevel"] = $fdata;
//	WritingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "WritingLevel";
	$fdata["GoodName"] = "WritingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Writing Level"; 
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
	
		$fdata["strField"] = "WritingLevel"; 
		$fdata["FullName"] = "WritingLevel";
	
		
		
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
	$edata["LookupValues"][] = "1";
	$edata["LookupValues"][] = "2";
	$edata["LookupValues"][] = "3";
	$edata["LookupValues"][] = "4";
	$edata["LookupValues"][] = "5";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_language["WritingLevel"] = $fdata;

	
$tables_data["devotee_language"]=&$tdatadevotee_language;
$field_labels["devotee_language"] = &$fieldLabelsdevotee_language;
$fieldToolTips["devotee_language"] = &$fieldToolTipsdevotee_language;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["devotee_language"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["devotee_language"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="devotee";
	$masterParams["mDataSourceTable"]="devotee";
	$masterParams["mOriginalTable"]= $strOriginalDetailsTable;
	$masterParams["mShortTable"]= "devotee";
	$masterParams["masterKeys"]= array();
	$masterParams["detailKeys"]= array();
	$masterParams["dispChildCount"]= "1";
	$masterParams["hideChild"]= "1";
	$masterParams["dispInfo"]= "0";
	$masterParams["previewOnList"]= 1;
	$masterParams["previewOnAdd"]= 1;
	$masterParams["previewOnEdit"]= 1;
	$masterParams["previewOnView"]= 1;
	$masterTablesData["devotee_language"][$mIndex] = $masterParams;	
		$masterTablesData["devotee_language"][$mIndex]["masterKeys"][]="DevoteeId";
		$masterTablesData["devotee_language"][$mIndex]["detailKeys"][]="DevoteeId";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_devotee_language()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DevoteeLanguageId,   DevoteeId,   LanguageId,   SpeakingLevel,   ReadingLevel,   WritingLevel";
$proto0["m_strFrom"] = "FROM devotee_language";
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
	"m_strName" => "DevoteeLanguageId",
	"m_strTable" => "devotee_language"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee_language"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "LanguageId",
	"m_strTable" => "devotee_language"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "SpeakingLevel",
	"m_strTable" => "devotee_language"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "ReadingLevel",
	"m_strTable" => "devotee_language"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "WritingLevel",
	"m_strTable" => "devotee_language"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto17=array();
$proto17["m_link"] = "SQLL_MAIN";
			$proto18=array();
$proto18["m_strName"] = "devotee_language";
$proto18["m_columns"] = array();
$proto18["m_columns"][] = "DevoteeLanguageId";
$proto18["m_columns"][] = "DevoteeId";
$proto18["m_columns"][] = "LanguageId";
$proto18["m_columns"][] = "SpeakingLevel";
$proto18["m_columns"][] = "ReadingLevel";
$proto18["m_columns"][] = "WritingLevel";
$obj = new SQLTable($proto18);

$proto17["m_table"] = $obj;
$proto17["m_alias"] = "";
$proto19=array();
$proto19["m_sql"] = "";
$proto19["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto19["m_column"]=$obj;
$proto19["m_contained"] = array();
$proto19["m_strCase"] = "";
$proto19["m_havingmode"] = "0";
$proto19["m_inBrackets"] = "0";
$proto19["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto19);

$proto17["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto17);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_devotee_language = createSqlQuery_devotee_language();
						$tdatadevotee_language[".sqlquery"] = $queryData_devotee_language;
	
if(isset($tdatadevotee_language["field2"])){
	$tdatadevotee_language["field2"]["LookupTable"] = "carscars_view";
	$tdatadevotee_language["field2"]["LookupOrderBy"] = "name";
	$tdatadevotee_language["field2"]["LookupType"] = 4;
	$tdatadevotee_language["field2"]["LinkField"] = "email";
	$tdatadevotee_language["field2"]["DisplayField"] = "name";
	$tdatadevotee_language[".hasCustomViewField"] = true;
}

$tableEvents["devotee_language"] = new eventsBase;
$tdatadevotee_language[".hasEvents"] = false;

$cipherer = new RunnerCipherer("devotee_language");

?>