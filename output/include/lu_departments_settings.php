<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_departments = array();
	$tdatalu_departments[".NumberOfChars"] = 80; 
	$tdatalu_departments[".ShortName"] = "lu_departments";
	$tdatalu_departments[".OwnerID"] = "";
	$tdatalu_departments[".OriginalTable"] = "lu_departments";

//	field labels
$fieldLabelslu_departments = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_departments["English"] = array();
	$fieldToolTipslu_departments["English"] = array();
	$fieldLabelslu_departments["English"]["DepartmentName"] = "Department Name";
	$fieldToolTipslu_departments["English"]["DepartmentName"] = "";
	$fieldLabelslu_departments["English"]["DepartmentInCharge"] = "Department In Charge";
	$fieldToolTipslu_departments["English"]["DepartmentInCharge"] = "";
	$fieldLabelslu_departments["English"]["DepartmentId"] = "Department Id";
	$fieldToolTipslu_departments["English"]["DepartmentId"] = "";
	if (count($fieldToolTipslu_departments["English"]))
		$tdatalu_departments[".isUseToolTips"] = true;
}
	
	
	$tdatalu_departments[".NCSearch"] = true;



$tdatalu_departments[".shortTableName"] = "lu_departments";
$tdatalu_departments[".nSecOptions"] = 0;
$tdatalu_departments[".recsPerRowList"] = 1;
$tdatalu_departments[".mainTableOwnerID"] = "";
$tdatalu_departments[".moveNext"] = 1;
$tdatalu_departments[".nType"] = 0;

$tdatalu_departments[".strOriginalTableName"] = "lu_departments";




$tdatalu_departments[".showAddInPopup"] = true;

$tdatalu_departments[".showEditInPopup"] = true;

$tdatalu_departments[".showViewInPopup"] = true;

$tdatalu_departments[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_departments[".listAjax"] = true;
else 
	$tdatalu_departments[".listAjax"] = false;

	$tdatalu_departments[".audit"] = true;

	$tdatalu_departments[".locking"] = false;

$tdatalu_departments[".listIcons"] = true;
$tdatalu_departments[".edit"] = true;
$tdatalu_departments[".inlineEdit"] = true;
$tdatalu_departments[".inlineAdd"] = true;
$tdatalu_departments[".copy"] = true;
$tdatalu_departments[".view"] = true;

$tdatalu_departments[".exportTo"] = true;

$tdatalu_departments[".printFriendly"] = true;

$tdatalu_departments[".delete"] = true;

$tdatalu_departments[".showSimpleSearchOptions"] = true;

$tdatalu_departments[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_departments[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_departments[".isUseAjaxSuggest"] = true;

$tdatalu_departments[".rowHighlite"] = true;

// button handlers file names

$tdatalu_departments[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_departments[".isUseTimeForSearch"] = false;




$tdatalu_departments[".allSearchFields"] = array();

$tdatalu_departments[".allSearchFields"][] = "DepartmentId";
$tdatalu_departments[".allSearchFields"][] = "DepartmentName";
$tdatalu_departments[".allSearchFields"][] = "DepartmentInCharge";

$tdatalu_departments[".googleLikeFields"][] = "DepartmentId";
$tdatalu_departments[".googleLikeFields"][] = "DepartmentName";
$tdatalu_departments[".googleLikeFields"][] = "DepartmentInCharge";


$tdatalu_departments[".advSearchFields"][] = "DepartmentId";
$tdatalu_departments[".advSearchFields"][] = "DepartmentName";
$tdatalu_departments[".advSearchFields"][] = "DepartmentInCharge";

$tdatalu_departments[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_departments[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_departments[".strOrderBy"] = $tstrOrderBy;

$tdatalu_departments[".orderindexes"] = array();

$tdatalu_departments[".sqlHead"] = "SELECT DepartmentId,   DepartmentName,   DepartmentInCharge";
$tdatalu_departments[".sqlFrom"] = "FROM lu_departments";
$tdatalu_departments[".sqlWhereExpr"] = "";
$tdatalu_departments[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_departments[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_departments[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_departments = array();
$tableKeyslu_departments[] = "DepartmentId";
$tdatalu_departments[".Keys"] = $tableKeyslu_departments;

$tdatalu_departments[".listFields"] = array();
$tdatalu_departments[".listFields"][] = "DepartmentId";
$tdatalu_departments[".listFields"][] = "DepartmentName";
$tdatalu_departments[".listFields"][] = "DepartmentInCharge";

$tdatalu_departments[".viewFields"] = array();
$tdatalu_departments[".viewFields"][] = "DepartmentId";
$tdatalu_departments[".viewFields"][] = "DepartmentName";
$tdatalu_departments[".viewFields"][] = "DepartmentInCharge";

$tdatalu_departments[".addFields"] = array();
$tdatalu_departments[".addFields"][] = "DepartmentId";
$tdatalu_departments[".addFields"][] = "DepartmentName";
$tdatalu_departments[".addFields"][] = "DepartmentInCharge";

$tdatalu_departments[".inlineAddFields"] = array();
$tdatalu_departments[".inlineAddFields"][] = "DepartmentId";
$tdatalu_departments[".inlineAddFields"][] = "DepartmentName";
$tdatalu_departments[".inlineAddFields"][] = "DepartmentInCharge";

$tdatalu_departments[".editFields"] = array();
$tdatalu_departments[".editFields"][] = "DepartmentId";
$tdatalu_departments[".editFields"][] = "DepartmentName";
$tdatalu_departments[".editFields"][] = "DepartmentInCharge";

$tdatalu_departments[".inlineEditFields"] = array();
$tdatalu_departments[".inlineEditFields"][] = "DepartmentId";
$tdatalu_departments[".inlineEditFields"][] = "DepartmentName";
$tdatalu_departments[".inlineEditFields"][] = "DepartmentInCharge";

$tdatalu_departments[".exportFields"] = array();
$tdatalu_departments[".exportFields"][] = "DepartmentId";
$tdatalu_departments[".exportFields"][] = "DepartmentName";
$tdatalu_departments[".exportFields"][] = "DepartmentInCharge";

$tdatalu_departments[".printFields"] = array();
$tdatalu_departments[".printFields"][] = "DepartmentId";
$tdatalu_departments[".printFields"][] = "DepartmentName";
$tdatalu_departments[".printFields"][] = "DepartmentInCharge";

//	DepartmentId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DepartmentId";
	$fdata["GoodName"] = "DepartmentId";
	$fdata["ownerTable"] = "lu_departments";
	$fdata["Label"] = "Department Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DepartmentId"; 
		$fdata["FullName"] = "DepartmentId";
	
		
		
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
	
		
		
	$tdatalu_departments["DepartmentId"] = $fdata;
//	DepartmentName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "DepartmentName";
	$fdata["GoodName"] = "DepartmentName";
	$fdata["ownerTable"] = "lu_departments";
	$fdata["Label"] = "Department Name"; 
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
	
		$fdata["strField"] = "DepartmentName"; 
		$fdata["FullName"] = "DepartmentName";
	
		
		
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
	
		
		
	$tdatalu_departments["DepartmentName"] = $fdata;
//	DepartmentInCharge
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "DepartmentInCharge";
	$fdata["GoodName"] = "DepartmentInCharge";
	$fdata["ownerTable"] = "lu_departments";
	$fdata["Label"] = "Department In Charge"; 
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
	
		$fdata["strField"] = "DepartmentInCharge"; 
		$fdata["FullName"] = "DepartmentInCharge";
	
		
		
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
	
		
		
	$tdatalu_departments["DepartmentInCharge"] = $fdata;

	
$tables_data["lu_departments"]=&$tdatalu_departments;
$field_labels["lu_departments"] = &$fieldLabelslu_departments;
$fieldToolTips["lu_departments"] = &$fieldToolTipslu_departments;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_departments"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_departments"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_departments()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DepartmentId,   DepartmentName,   DepartmentInCharge";
$proto0["m_strFrom"] = "FROM lu_departments";
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
	"m_strName" => "DepartmentId",
	"m_strTable" => "lu_departments"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "DepartmentName",
	"m_strTable" => "lu_departments"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "DepartmentInCharge",
	"m_strTable" => "lu_departments"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto11=array();
$proto11["m_link"] = "SQLL_MAIN";
			$proto12=array();
$proto12["m_strName"] = "lu_departments";
$proto12["m_columns"] = array();
$proto12["m_columns"][] = "DepartmentId";
$proto12["m_columns"][] = "DepartmentName";
$proto12["m_columns"][] = "DepartmentInCharge";
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
$queryData_lu_departments = createSqlQuery_lu_departments();
			$tdatalu_departments[".sqlquery"] = $queryData_lu_departments;
	
if(isset($tdatalu_departments["field2"])){
	$tdatalu_departments["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_departments["field2"]["LookupOrderBy"] = "name";
	$tdatalu_departments["field2"]["LookupType"] = 4;
	$tdatalu_departments["field2"]["LinkField"] = "email";
	$tdatalu_departments["field2"]["DisplayField"] = "name";
	$tdatalu_departments[".hasCustomViewField"] = true;
}

$tableEvents["lu_departments"] = new eventsBase;
$tdatalu_departments[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_departments");

?>