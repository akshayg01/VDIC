<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_request_types = array();
	$tdatalu_request_types[".NumberOfChars"] = 80; 
	$tdatalu_request_types[".ShortName"] = "lu_request_types";
	$tdatalu_request_types[".OwnerID"] = "";
	$tdatalu_request_types[".OriginalTable"] = "lu_request_types";

//	field labels
$fieldLabelslu_request_types = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_request_types["English"] = array();
	$fieldToolTipslu_request_types["English"] = array();
	$fieldLabelslu_request_types["English"]["RequestTypeId"] = "Request Type Id";
	$fieldToolTipslu_request_types["English"]["RequestTypeId"] = "";
	$fieldLabelslu_request_types["English"]["RequestType"] = "Request Type";
	$fieldToolTipslu_request_types["English"]["RequestType"] = "";
	if (count($fieldToolTipslu_request_types["English"]))
		$tdatalu_request_types[".isUseToolTips"] = true;
}
	
	
	$tdatalu_request_types[".NCSearch"] = true;



$tdatalu_request_types[".shortTableName"] = "lu_request_types";
$tdatalu_request_types[".nSecOptions"] = 0;
$tdatalu_request_types[".recsPerRowList"] = 1;
$tdatalu_request_types[".mainTableOwnerID"] = "";
$tdatalu_request_types[".moveNext"] = 1;
$tdatalu_request_types[".nType"] = 0;

$tdatalu_request_types[".strOriginalTableName"] = "lu_request_types";




$tdatalu_request_types[".showAddInPopup"] = true;

$tdatalu_request_types[".showEditInPopup"] = true;

$tdatalu_request_types[".showViewInPopup"] = true;

$tdatalu_request_types[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_request_types[".listAjax"] = true;
else 
	$tdatalu_request_types[".listAjax"] = false;

	$tdatalu_request_types[".audit"] = true;

	$tdatalu_request_types[".locking"] = false;

$tdatalu_request_types[".listIcons"] = true;
$tdatalu_request_types[".edit"] = true;
$tdatalu_request_types[".inlineEdit"] = true;
$tdatalu_request_types[".inlineAdd"] = true;
$tdatalu_request_types[".copy"] = true;
$tdatalu_request_types[".view"] = true;

$tdatalu_request_types[".exportTo"] = true;

$tdatalu_request_types[".printFriendly"] = true;

$tdatalu_request_types[".delete"] = true;

$tdatalu_request_types[".showSimpleSearchOptions"] = true;

$tdatalu_request_types[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_request_types[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_request_types[".isUseAjaxSuggest"] = true;

$tdatalu_request_types[".rowHighlite"] = true;

// button handlers file names

$tdatalu_request_types[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_request_types[".isUseTimeForSearch"] = false;




$tdatalu_request_types[".allSearchFields"] = array();

$tdatalu_request_types[".allSearchFields"][] = "RequestTypeId";
$tdatalu_request_types[".allSearchFields"][] = "RequestType";

$tdatalu_request_types[".googleLikeFields"][] = "RequestTypeId";
$tdatalu_request_types[".googleLikeFields"][] = "RequestType";


$tdatalu_request_types[".advSearchFields"][] = "RequestTypeId";
$tdatalu_request_types[".advSearchFields"][] = "RequestType";

$tdatalu_request_types[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_request_types[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_request_types[".strOrderBy"] = $tstrOrderBy;

$tdatalu_request_types[".orderindexes"] = array();

$tdatalu_request_types[".sqlHead"] = "SELECT RequestTypeId,   RequestType";
$tdatalu_request_types[".sqlFrom"] = "FROM lu_request_types";
$tdatalu_request_types[".sqlWhereExpr"] = "";
$tdatalu_request_types[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_request_types[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_request_types[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_request_types = array();
$tableKeyslu_request_types[] = "RequestTypeId";
$tdatalu_request_types[".Keys"] = $tableKeyslu_request_types;

$tdatalu_request_types[".listFields"] = array();
$tdatalu_request_types[".listFields"][] = "RequestTypeId";
$tdatalu_request_types[".listFields"][] = "RequestType";

$tdatalu_request_types[".viewFields"] = array();
$tdatalu_request_types[".viewFields"][] = "RequestTypeId";
$tdatalu_request_types[".viewFields"][] = "RequestType";

$tdatalu_request_types[".addFields"] = array();
$tdatalu_request_types[".addFields"][] = "RequestTypeId";
$tdatalu_request_types[".addFields"][] = "RequestType";

$tdatalu_request_types[".inlineAddFields"] = array();
$tdatalu_request_types[".inlineAddFields"][] = "RequestTypeId";
$tdatalu_request_types[".inlineAddFields"][] = "RequestType";

$tdatalu_request_types[".editFields"] = array();
$tdatalu_request_types[".editFields"][] = "RequestTypeId";
$tdatalu_request_types[".editFields"][] = "RequestType";

$tdatalu_request_types[".inlineEditFields"] = array();
$tdatalu_request_types[".inlineEditFields"][] = "RequestTypeId";
$tdatalu_request_types[".inlineEditFields"][] = "RequestType";

$tdatalu_request_types[".exportFields"] = array();
$tdatalu_request_types[".exportFields"][] = "RequestTypeId";
$tdatalu_request_types[".exportFields"][] = "RequestType";

$tdatalu_request_types[".printFields"] = array();
$tdatalu_request_types[".printFields"][] = "RequestTypeId";
$tdatalu_request_types[".printFields"][] = "RequestType";

//	RequestTypeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "RequestTypeId";
	$fdata["GoodName"] = "RequestTypeId";
	$fdata["ownerTable"] = "lu_request_types";
	$fdata["Label"] = "Request Type Id"; 
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
	
		$fdata["strField"] = "RequestTypeId"; 
		$fdata["FullName"] = "RequestTypeId";
	
		
		
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
	
		
		
	$tdatalu_request_types["RequestTypeId"] = $fdata;
//	RequestType
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "RequestType";
	$fdata["GoodName"] = "RequestType";
	$fdata["ownerTable"] = "lu_request_types";
	$fdata["Label"] = "Request Type"; 
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
	
		$fdata["strField"] = "RequestType"; 
		$fdata["FullName"] = "RequestType";
	
		
		
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
	
		
		
	$tdatalu_request_types["RequestType"] = $fdata;

	
$tables_data["lu_request_types"]=&$tdatalu_request_types;
$field_labels["lu_request_types"] = &$fieldLabelslu_request_types;
$fieldToolTips["lu_request_types"] = &$fieldToolTipslu_request_types;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_request_types"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_request_types"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_request_types()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "RequestTypeId,   RequestType";
$proto0["m_strFrom"] = "FROM lu_request_types";
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
	"m_strName" => "RequestTypeId",
	"m_strTable" => "lu_request_types"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "RequestType",
	"m_strTable" => "lu_request_types"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_request_types";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "RequestTypeId";
$proto10["m_columns"][] = "RequestType";
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
$queryData_lu_request_types = createSqlQuery_lu_request_types();
		$tdatalu_request_types[".sqlquery"] = $queryData_lu_request_types;
	
if(isset($tdatalu_request_types["field2"])){
	$tdatalu_request_types["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_request_types["field2"]["LookupOrderBy"] = "name";
	$tdatalu_request_types["field2"]["LookupType"] = 4;
	$tdatalu_request_types["field2"]["LinkField"] = "email";
	$tdatalu_request_types["field2"]["DisplayField"] = "name";
	$tdatalu_request_types[".hasCustomViewField"] = true;
}

$tableEvents["lu_request_types"] = new eventsBase;
$tdatalu_request_types[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_request_types");

?>