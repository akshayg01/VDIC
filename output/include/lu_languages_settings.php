<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_languages = array();
	$tdatalu_languages[".NumberOfChars"] = 80; 
	$tdatalu_languages[".ShortName"] = "lu_languages";
	$tdatalu_languages[".OwnerID"] = "";
	$tdatalu_languages[".OriginalTable"] = "lu_languages";

//	field labels
$fieldLabelslu_languages = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_languages["English"] = array();
	$fieldToolTipslu_languages["English"] = array();
	$fieldLabelslu_languages["English"]["language"] = "Language";
	$fieldToolTipslu_languages["English"]["language"] = "";
	$fieldLabelslu_languages["English"]["LanguageId"] = "Language Id";
	$fieldToolTipslu_languages["English"]["LanguageId"] = "";
	if (count($fieldToolTipslu_languages["English"]))
		$tdatalu_languages[".isUseToolTips"] = true;
}
	
	
	$tdatalu_languages[".NCSearch"] = true;



$tdatalu_languages[".shortTableName"] = "lu_languages";
$tdatalu_languages[".nSecOptions"] = 0;
$tdatalu_languages[".recsPerRowList"] = 1;
$tdatalu_languages[".mainTableOwnerID"] = "";
$tdatalu_languages[".moveNext"] = 1;
$tdatalu_languages[".nType"] = 0;

$tdatalu_languages[".strOriginalTableName"] = "lu_languages";




$tdatalu_languages[".showAddInPopup"] = true;

$tdatalu_languages[".showEditInPopup"] = true;

$tdatalu_languages[".showViewInPopup"] = true;

$tdatalu_languages[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_languages[".listAjax"] = true;
else 
	$tdatalu_languages[".listAjax"] = false;

	$tdatalu_languages[".audit"] = true;

	$tdatalu_languages[".locking"] = false;

$tdatalu_languages[".listIcons"] = true;
$tdatalu_languages[".edit"] = true;
$tdatalu_languages[".inlineEdit"] = true;
$tdatalu_languages[".inlineAdd"] = true;
$tdatalu_languages[".copy"] = true;
$tdatalu_languages[".view"] = true;

$tdatalu_languages[".exportTo"] = true;

$tdatalu_languages[".printFriendly"] = true;

$tdatalu_languages[".delete"] = true;

$tdatalu_languages[".showSimpleSearchOptions"] = true;

$tdatalu_languages[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_languages[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_languages[".isUseAjaxSuggest"] = true;

$tdatalu_languages[".rowHighlite"] = true;

// button handlers file names

$tdatalu_languages[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_languages[".isUseTimeForSearch"] = false;




$tdatalu_languages[".allSearchFields"] = array();

$tdatalu_languages[".allSearchFields"][] = "LanguageId";
$tdatalu_languages[".allSearchFields"][] = "language";

$tdatalu_languages[".googleLikeFields"][] = "LanguageId";
$tdatalu_languages[".googleLikeFields"][] = "language";


$tdatalu_languages[".advSearchFields"][] = "LanguageId";
$tdatalu_languages[".advSearchFields"][] = "language";

$tdatalu_languages[".isTableType"] = "list";

	


$tdatalu_languages[".isResizeColumns"] = true;

// Access doesn't support subqueries from the same table as main



$tdatalu_languages[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_languages[".strOrderBy"] = $tstrOrderBy;

$tdatalu_languages[".orderindexes"] = array();

$tdatalu_languages[".sqlHead"] = "SELECT LanguageId,   `Language`";
$tdatalu_languages[".sqlFrom"] = "FROM lu_languages";
$tdatalu_languages[".sqlWhereExpr"] = "";
$tdatalu_languages[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_languages[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_languages[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_languages = array();
$tableKeyslu_languages[] = "LanguageId";
$tdatalu_languages[".Keys"] = $tableKeyslu_languages;

$tdatalu_languages[".listFields"] = array();
$tdatalu_languages[".listFields"][] = "LanguageId";
$tdatalu_languages[".listFields"][] = "language";

$tdatalu_languages[".viewFields"] = array();
$tdatalu_languages[".viewFields"][] = "LanguageId";
$tdatalu_languages[".viewFields"][] = "language";

$tdatalu_languages[".addFields"] = array();
$tdatalu_languages[".addFields"][] = "language";

$tdatalu_languages[".inlineAddFields"] = array();
$tdatalu_languages[".inlineAddFields"][] = "LanguageId";
$tdatalu_languages[".inlineAddFields"][] = "language";

$tdatalu_languages[".editFields"] = array();
$tdatalu_languages[".editFields"][] = "LanguageId";
$tdatalu_languages[".editFields"][] = "language";

$tdatalu_languages[".inlineEditFields"] = array();
$tdatalu_languages[".inlineEditFields"][] = "LanguageId";
$tdatalu_languages[".inlineEditFields"][] = "language";

$tdatalu_languages[".exportFields"] = array();
$tdatalu_languages[".exportFields"][] = "LanguageId";
$tdatalu_languages[".exportFields"][] = "language";

$tdatalu_languages[".printFields"] = array();
$tdatalu_languages[".printFields"][] = "LanguageId";
$tdatalu_languages[".printFields"][] = "language";

//	LanguageId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "LanguageId";
	$fdata["GoodName"] = "LanguageId";
	$fdata["ownerTable"] = "lu_languages";
	$fdata["Label"] = "Language Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
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
	
		
		
	$tdatalu_languages["LanguageId"] = $fdata;
//	language
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "language";
	$fdata["GoodName"] = "language";
	$fdata["ownerTable"] = "lu_languages";
	$fdata["Label"] = "Language"; 
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
	
		$fdata["strField"] = "Language"; 
		$fdata["FullName"] = "`Language`";
	
		
		
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
	
		
		
	$tdatalu_languages["language"] = $fdata;

	
$tables_data["lu_languages"]=&$tdatalu_languages;
$field_labels["lu_languages"] = &$fieldLabelslu_languages;
$fieldToolTips["lu_languages"] = &$fieldToolTipslu_languages;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_languages"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_languages"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_languages()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "LanguageId,   `Language`";
$proto0["m_strFrom"] = "FROM lu_languages";
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
	"m_strName" => "LanguageId",
	"m_strTable" => "lu_languages"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Language",
	"m_strTable" => "lu_languages"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_languages";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "LanguageId";
$proto10["m_columns"][] = "Language";
$obj = new SQLTable($proto10);

$proto9["m_table"] = $obj;
$proto9["m_alias"] = "";
$proto11=array();
$proto11["m_sql"] = "";
$proto11["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto11["m_column"]=$obj;
$proto11["m_contained"] = array();
$proto11["m_strCase"] = "";
$proto11["m_havingmode"] = "0";
$proto11["m_inBrackets"] = "0";
$proto11["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto11);

$proto9["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto9);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_lu_languages = createSqlQuery_lu_languages();
		$tdatalu_languages[".sqlquery"] = $queryData_lu_languages;
	
if(isset($tdatalu_languages["field2"])){
	$tdatalu_languages["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_languages["field2"]["LookupOrderBy"] = "name";
	$tdatalu_languages["field2"]["LookupType"] = 4;
	$tdatalu_languages["field2"]["LinkField"] = "email";
	$tdatalu_languages["field2"]["DisplayField"] = "name";
	$tdatalu_languages[".hasCustomViewField"] = true;
}

$tableEvents["lu_languages"] = new eventsBase;
$tdatalu_languages[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_languages");

?>