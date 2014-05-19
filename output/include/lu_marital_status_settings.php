<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_marital_status = array();
	$tdatalu_marital_status[".NumberOfChars"] = 80; 
	$tdatalu_marital_status[".ShortName"] = "lu_marital_status";
	$tdatalu_marital_status[".OwnerID"] = "";
	$tdatalu_marital_status[".OriginalTable"] = "lu_marital_status";

//	field labels
$fieldLabelslu_marital_status = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_marital_status["English"] = array();
	$fieldToolTipslu_marital_status["English"] = array();
	$fieldLabelslu_marital_status["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipslu_marital_status["English"]["MaritalStatusId"] = "";
	$fieldLabelslu_marital_status["English"]["MaritalStatus"] = "Marital Status";
	$fieldToolTipslu_marital_status["English"]["MaritalStatus"] = "";
	if (count($fieldToolTipslu_marital_status["English"]))
		$tdatalu_marital_status[".isUseToolTips"] = true;
}
	
	
	$tdatalu_marital_status[".NCSearch"] = true;



$tdatalu_marital_status[".shortTableName"] = "lu_marital_status";
$tdatalu_marital_status[".nSecOptions"] = 0;
$tdatalu_marital_status[".recsPerRowList"] = 1;
$tdatalu_marital_status[".mainTableOwnerID"] = "";
$tdatalu_marital_status[".moveNext"] = 1;
$tdatalu_marital_status[".nType"] = 0;

$tdatalu_marital_status[".strOriginalTableName"] = "lu_marital_status";




$tdatalu_marital_status[".showAddInPopup"] = true;

$tdatalu_marital_status[".showEditInPopup"] = true;

$tdatalu_marital_status[".showViewInPopup"] = true;

$tdatalu_marital_status[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_marital_status[".listAjax"] = true;
else 
	$tdatalu_marital_status[".listAjax"] = false;

	$tdatalu_marital_status[".audit"] = true;

	$tdatalu_marital_status[".locking"] = false;

$tdatalu_marital_status[".listIcons"] = true;
$tdatalu_marital_status[".edit"] = true;
$tdatalu_marital_status[".inlineEdit"] = true;
$tdatalu_marital_status[".inlineAdd"] = true;
$tdatalu_marital_status[".copy"] = true;
$tdatalu_marital_status[".view"] = true;

$tdatalu_marital_status[".exportTo"] = true;

$tdatalu_marital_status[".printFriendly"] = true;

$tdatalu_marital_status[".delete"] = true;

$tdatalu_marital_status[".showSimpleSearchOptions"] = true;

$tdatalu_marital_status[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_marital_status[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_marital_status[".isUseAjaxSuggest"] = true;

$tdatalu_marital_status[".rowHighlite"] = true;

// button handlers file names

$tdatalu_marital_status[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_marital_status[".isUseTimeForSearch"] = false;




$tdatalu_marital_status[".allSearchFields"] = array();

$tdatalu_marital_status[".allSearchFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".allSearchFields"][] = "MaritalStatus";

$tdatalu_marital_status[".googleLikeFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".googleLikeFields"][] = "MaritalStatus";


$tdatalu_marital_status[".advSearchFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".advSearchFields"][] = "MaritalStatus";

$tdatalu_marital_status[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_marital_status[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_marital_status[".strOrderBy"] = $tstrOrderBy;

$tdatalu_marital_status[".orderindexes"] = array();

$tdatalu_marital_status[".sqlHead"] = "SELECT MaritalStatusId,   MaritalStatus";
$tdatalu_marital_status[".sqlFrom"] = "FROM lu_marital_status";
$tdatalu_marital_status[".sqlWhereExpr"] = "";
$tdatalu_marital_status[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_marital_status[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_marital_status[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_marital_status = array();
$tableKeyslu_marital_status[] = "MaritalStatusId";
$tdatalu_marital_status[".Keys"] = $tableKeyslu_marital_status;

$tdatalu_marital_status[".listFields"] = array();
$tdatalu_marital_status[".listFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".listFields"][] = "MaritalStatus";

$tdatalu_marital_status[".viewFields"] = array();
$tdatalu_marital_status[".viewFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".viewFields"][] = "MaritalStatus";

$tdatalu_marital_status[".addFields"] = array();
$tdatalu_marital_status[".addFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".addFields"][] = "MaritalStatus";

$tdatalu_marital_status[".inlineAddFields"] = array();
$tdatalu_marital_status[".inlineAddFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".inlineAddFields"][] = "MaritalStatus";

$tdatalu_marital_status[".editFields"] = array();
$tdatalu_marital_status[".editFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".editFields"][] = "MaritalStatus";

$tdatalu_marital_status[".inlineEditFields"] = array();
$tdatalu_marital_status[".inlineEditFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".inlineEditFields"][] = "MaritalStatus";

$tdatalu_marital_status[".exportFields"] = array();
$tdatalu_marital_status[".exportFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".exportFields"][] = "MaritalStatus";

$tdatalu_marital_status[".printFields"] = array();
$tdatalu_marital_status[".printFields"][] = "MaritalStatusId";
$tdatalu_marital_status[".printFields"][] = "MaritalStatus";

//	MaritalStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "MaritalStatusId";
	$fdata["GoodName"] = "MaritalStatusId";
	$fdata["ownerTable"] = "lu_marital_status";
	$fdata["Label"] = "Marital Status Id"; 
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
	
		
		
	$tdatalu_marital_status["MaritalStatusId"] = $fdata;
//	MaritalStatus
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "MaritalStatus";
	$fdata["GoodName"] = "MaritalStatus";
	$fdata["ownerTable"] = "lu_marital_status";
	$fdata["Label"] = "Marital Status"; 
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
	
		$fdata["strField"] = "MaritalStatus"; 
		$fdata["FullName"] = "MaritalStatus";
	
		
		
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
	
		
		
	$tdatalu_marital_status["MaritalStatus"] = $fdata;

	
$tables_data["lu_marital_status"]=&$tdatalu_marital_status;
$field_labels["lu_marital_status"] = &$fieldLabelslu_marital_status;
$fieldToolTips["lu_marital_status"] = &$fieldToolTipslu_marital_status;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_marital_status"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_marital_status"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_marital_status()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "MaritalStatusId,   MaritalStatus";
$proto0["m_strFrom"] = "FROM lu_marital_status";
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
	"m_strName" => "MaritalStatusId",
	"m_strTable" => "lu_marital_status"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "MaritalStatus",
	"m_strTable" => "lu_marital_status"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_marital_status";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "MaritalStatusId";
$proto10["m_columns"][] = "MaritalStatus";
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
$queryData_lu_marital_status = createSqlQuery_lu_marital_status();
		$tdatalu_marital_status[".sqlquery"] = $queryData_lu_marital_status;
	
if(isset($tdatalu_marital_status["field2"])){
	$tdatalu_marital_status["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_marital_status["field2"]["LookupOrderBy"] = "name";
	$tdatalu_marital_status["field2"]["LookupType"] = 4;
	$tdatalu_marital_status["field2"]["LinkField"] = "email";
	$tdatalu_marital_status["field2"]["DisplayField"] = "name";
	$tdatalu_marital_status[".hasCustomViewField"] = true;
}

$tableEvents["lu_marital_status"] = new eventsBase;
$tdatalu_marital_status[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_marital_status");

?>