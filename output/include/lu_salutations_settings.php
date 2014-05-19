<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_salutations = array();
	$tdatalu_salutations[".NumberOfChars"] = 80; 
	$tdatalu_salutations[".ShortName"] = "lu_salutations";
	$tdatalu_salutations[".OwnerID"] = "";
	$tdatalu_salutations[".OriginalTable"] = "lu_salutations";

//	field labels
$fieldLabelslu_salutations = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_salutations["English"] = array();
	$fieldToolTipslu_salutations["English"] = array();
	$fieldLabelslu_salutations["English"]["salutation"] = "Salutation";
	$fieldToolTipslu_salutations["English"]["salutation"] = "";
	$fieldLabelslu_salutations["English"]["SalutationId"] = "Salutation Id";
	$fieldToolTipslu_salutations["English"]["SalutationId"] = "";
	$fieldLabelslu_salutations["English"]["TitleId"] = "Title Id";
	$fieldToolTipslu_salutations["English"]["TitleId"] = "";
	$fieldLabelslu_salutations["English"]["Gender"] = "Gender";
	$fieldToolTipslu_salutations["English"]["Gender"] = "";
	if (count($fieldToolTipslu_salutations["English"]))
		$tdatalu_salutations[".isUseToolTips"] = true;
}
	
	
	$tdatalu_salutations[".NCSearch"] = true;



$tdatalu_salutations[".shortTableName"] = "lu_salutations";
$tdatalu_salutations[".nSecOptions"] = 0;
$tdatalu_salutations[".recsPerRowList"] = 1;
$tdatalu_salutations[".mainTableOwnerID"] = "";
$tdatalu_salutations[".moveNext"] = 1;
$tdatalu_salutations[".nType"] = 0;

$tdatalu_salutations[".strOriginalTableName"] = "lu_salutations";




$tdatalu_salutations[".showAddInPopup"] = true;

$tdatalu_salutations[".showEditInPopup"] = true;

$tdatalu_salutations[".showViewInPopup"] = true;

$tdatalu_salutations[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_salutations[".listAjax"] = true;
else 
	$tdatalu_salutations[".listAjax"] = false;

	$tdatalu_salutations[".audit"] = true;

	$tdatalu_salutations[".locking"] = false;

$tdatalu_salutations[".listIcons"] = true;
$tdatalu_salutations[".edit"] = true;
$tdatalu_salutations[".inlineEdit"] = true;
$tdatalu_salutations[".inlineAdd"] = true;
$tdatalu_salutations[".copy"] = true;
$tdatalu_salutations[".view"] = true;

$tdatalu_salutations[".exportTo"] = true;

$tdatalu_salutations[".printFriendly"] = true;

$tdatalu_salutations[".delete"] = true;

$tdatalu_salutations[".showSimpleSearchOptions"] = true;

$tdatalu_salutations[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_salutations[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_salutations[".isUseAjaxSuggest"] = true;

$tdatalu_salutations[".rowHighlite"] = true;

// button handlers file names

$tdatalu_salutations[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_salutations[".isUseTimeForSearch"] = false;




$tdatalu_salutations[".allSearchFields"] = array();

$tdatalu_salutations[".allSearchFields"][] = "Gender";
$tdatalu_salutations[".allSearchFields"][] = "SalutationId";
$tdatalu_salutations[".allSearchFields"][] = "salutation";

$tdatalu_salutations[".googleLikeFields"][] = "SalutationId";
$tdatalu_salutations[".googleLikeFields"][] = "salutation";
$tdatalu_salutations[".googleLikeFields"][] = "Gender";


$tdatalu_salutations[".advSearchFields"][] = "Gender";
$tdatalu_salutations[".advSearchFields"][] = "SalutationId";
$tdatalu_salutations[".advSearchFields"][] = "salutation";

$tdatalu_salutations[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_salutations[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_salutations[".strOrderBy"] = $tstrOrderBy;

$tdatalu_salutations[".orderindexes"] = array();

$tdatalu_salutations[".sqlHead"] = "SELECT SalutationId,   Salutation,   Gender";
$tdatalu_salutations[".sqlFrom"] = "FROM lu_salutations";
$tdatalu_salutations[".sqlWhereExpr"] = "";
$tdatalu_salutations[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_salutations[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_salutations[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_salutations = array();
$tableKeyslu_salutations[] = "SalutationId";
$tdatalu_salutations[".Keys"] = $tableKeyslu_salutations;

$tdatalu_salutations[".listFields"] = array();
$tdatalu_salutations[".listFields"][] = "salutation";
$tdatalu_salutations[".listFields"][] = "Gender";
$tdatalu_salutations[".listFields"][] = "SalutationId";

$tdatalu_salutations[".viewFields"] = array();
$tdatalu_salutations[".viewFields"][] = "Gender";
$tdatalu_salutations[".viewFields"][] = "SalutationId";
$tdatalu_salutations[".viewFields"][] = "salutation";

$tdatalu_salutations[".addFields"] = array();
$tdatalu_salutations[".addFields"][] = "salutation";
$tdatalu_salutations[".addFields"][] = "Gender";

$tdatalu_salutations[".inlineAddFields"] = array();
$tdatalu_salutations[".inlineAddFields"][] = "salutation";
$tdatalu_salutations[".inlineAddFields"][] = "Gender";

$tdatalu_salutations[".editFields"] = array();
$tdatalu_salutations[".editFields"][] = "Gender";
$tdatalu_salutations[".editFields"][] = "salutation";

$tdatalu_salutations[".inlineEditFields"] = array();
$tdatalu_salutations[".inlineEditFields"][] = "salutation";
$tdatalu_salutations[".inlineEditFields"][] = "Gender";

$tdatalu_salutations[".exportFields"] = array();
$tdatalu_salutations[".exportFields"][] = "Gender";
$tdatalu_salutations[".exportFields"][] = "SalutationId";
$tdatalu_salutations[".exportFields"][] = "salutation";

$tdatalu_salutations[".printFields"] = array();
$tdatalu_salutations[".printFields"][] = "Gender";
$tdatalu_salutations[".printFields"][] = "SalutationId";
$tdatalu_salutations[".printFields"][] = "salutation";

//	SalutationId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "SalutationId";
	$fdata["GoodName"] = "SalutationId";
	$fdata["ownerTable"] = "lu_salutations";
	$fdata["Label"] = "Salutation Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SalutationId"; 
		$fdata["FullName"] = "SalutationId";
	
		
		
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
	
		
		
	$tdatalu_salutations["SalutationId"] = $fdata;
//	salutation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "salutation";
	$fdata["GoodName"] = "salutation";
	$fdata["ownerTable"] = "lu_salutations";
	$fdata["Label"] = "Salutation"; 
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
	
		$fdata["strField"] = "Salutation"; 
		$fdata["FullName"] = "Salutation";
	
		
		
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
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_salutations["salutation"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "lu_salutations";
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_salutations["Gender"] = $fdata;

	
$tables_data["lu_salutations"]=&$tdatalu_salutations;
$field_labels["lu_salutations"] = &$fieldLabelslu_salutations;
$fieldToolTips["lu_salutations"] = &$fieldToolTipslu_salutations;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_salutations"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_salutations"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_salutations()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "SalutationId,   Salutation,   Gender";
$proto0["m_strFrom"] = "FROM lu_salutations";
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
	"m_strName" => "SalutationId",
	"m_strTable" => "lu_salutations"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Salutation",
	"m_strTable" => "lu_salutations"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Gender",
	"m_strTable" => "lu_salutations"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto11=array();
$proto11["m_link"] = "SQLL_MAIN";
			$proto12=array();
$proto12["m_strName"] = "lu_salutations";
$proto12["m_columns"] = array();
$proto12["m_columns"][] = "SalutationId";
$proto12["m_columns"][] = "Salutation";
$proto12["m_columns"][] = "Gender";
$obj = new SQLTable($proto12);

$proto11["m_table"] = $obj;
$proto11["m_alias"] = "";
$proto13=array();
$proto13["m_sql"] = "";
$proto13["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto13["m_column"]=$obj;
$proto13["m_contained"] = array();
$proto13["m_strCase"] = "";
$proto13["m_havingmode"] = "0";
$proto13["m_inBrackets"] = "0";
$proto13["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto13);

$proto11["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto11);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_lu_salutations = createSqlQuery_lu_salutations();
			$tdatalu_salutations[".sqlquery"] = $queryData_lu_salutations;
	
if(isset($tdatalu_salutations["field2"])){
	$tdatalu_salutations["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_salutations["field2"]["LookupOrderBy"] = "name";
	$tdatalu_salutations["field2"]["LookupType"] = 4;
	$tdatalu_salutations["field2"]["LinkField"] = "email";
	$tdatalu_salutations["field2"]["DisplayField"] = "name";
	$tdatalu_salutations[".hasCustomViewField"] = true;
}

$tableEvents["lu_salutations"] = new eventsBase;
$tdatalu_salutations[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_salutations");

?>