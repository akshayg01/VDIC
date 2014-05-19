<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_message_types = array();
	$tdatalu_message_types[".NumberOfChars"] = 80; 
	$tdatalu_message_types[".ShortName"] = "lu_message_types";
	$tdatalu_message_types[".OwnerID"] = "";
	$tdatalu_message_types[".OriginalTable"] = "lu_message_types";

//	field labels
$fieldLabelslu_message_types = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_message_types["English"] = array();
	$fieldToolTipslu_message_types["English"] = array();
	$fieldLabelslu_message_types["English"]["MessageTypeId"] = "Message Type Id";
	$fieldToolTipslu_message_types["English"]["MessageTypeId"] = "";
	$fieldLabelslu_message_types["English"]["MessageType"] = "Message Type";
	$fieldToolTipslu_message_types["English"]["MessageType"] = "";
	if (count($fieldToolTipslu_message_types["English"]))
		$tdatalu_message_types[".isUseToolTips"] = true;
}
	
	
	$tdatalu_message_types[".NCSearch"] = true;



$tdatalu_message_types[".shortTableName"] = "lu_message_types";
$tdatalu_message_types[".nSecOptions"] = 0;
$tdatalu_message_types[".recsPerRowList"] = 1;
$tdatalu_message_types[".mainTableOwnerID"] = "";
$tdatalu_message_types[".moveNext"] = 1;
$tdatalu_message_types[".nType"] = 0;

$tdatalu_message_types[".strOriginalTableName"] = "lu_message_types";




$tdatalu_message_types[".showAddInPopup"] = true;

$tdatalu_message_types[".showEditInPopup"] = true;

$tdatalu_message_types[".showViewInPopup"] = true;

$tdatalu_message_types[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_message_types[".listAjax"] = true;
else 
	$tdatalu_message_types[".listAjax"] = false;

	$tdatalu_message_types[".audit"] = true;

	$tdatalu_message_types[".locking"] = false;

$tdatalu_message_types[".listIcons"] = true;
$tdatalu_message_types[".edit"] = true;
$tdatalu_message_types[".inlineEdit"] = true;
$tdatalu_message_types[".inlineAdd"] = true;
$tdatalu_message_types[".copy"] = true;
$tdatalu_message_types[".view"] = true;

$tdatalu_message_types[".exportTo"] = true;

$tdatalu_message_types[".printFriendly"] = true;

$tdatalu_message_types[".delete"] = true;

$tdatalu_message_types[".showSimpleSearchOptions"] = true;

$tdatalu_message_types[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_message_types[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_message_types[".isUseAjaxSuggest"] = true;

$tdatalu_message_types[".rowHighlite"] = true;

// button handlers file names

$tdatalu_message_types[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_message_types[".isUseTimeForSearch"] = false;




$tdatalu_message_types[".allSearchFields"] = array();

$tdatalu_message_types[".allSearchFields"][] = "MessageTypeId";
$tdatalu_message_types[".allSearchFields"][] = "MessageType";

$tdatalu_message_types[".googleLikeFields"][] = "MessageTypeId";
$tdatalu_message_types[".googleLikeFields"][] = "MessageType";


$tdatalu_message_types[".advSearchFields"][] = "MessageTypeId";
$tdatalu_message_types[".advSearchFields"][] = "MessageType";

$tdatalu_message_types[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_message_types[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_message_types[".strOrderBy"] = $tstrOrderBy;

$tdatalu_message_types[".orderindexes"] = array();

$tdatalu_message_types[".sqlHead"] = "SELECT MessageTypeId,   MessageType";
$tdatalu_message_types[".sqlFrom"] = "FROM lu_message_types";
$tdatalu_message_types[".sqlWhereExpr"] = "";
$tdatalu_message_types[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_message_types[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_message_types[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_message_types = array();
$tableKeyslu_message_types[] = "MessageTypeId";
$tdatalu_message_types[".Keys"] = $tableKeyslu_message_types;

$tdatalu_message_types[".listFields"] = array();
$tdatalu_message_types[".listFields"][] = "MessageTypeId";
$tdatalu_message_types[".listFields"][] = "MessageType";

$tdatalu_message_types[".viewFields"] = array();
$tdatalu_message_types[".viewFields"][] = "MessageTypeId";
$tdatalu_message_types[".viewFields"][] = "MessageType";

$tdatalu_message_types[".addFields"] = array();
$tdatalu_message_types[".addFields"][] = "MessageTypeId";
$tdatalu_message_types[".addFields"][] = "MessageType";

$tdatalu_message_types[".inlineAddFields"] = array();
$tdatalu_message_types[".inlineAddFields"][] = "MessageTypeId";
$tdatalu_message_types[".inlineAddFields"][] = "MessageType";

$tdatalu_message_types[".editFields"] = array();
$tdatalu_message_types[".editFields"][] = "MessageTypeId";
$tdatalu_message_types[".editFields"][] = "MessageType";

$tdatalu_message_types[".inlineEditFields"] = array();
$tdatalu_message_types[".inlineEditFields"][] = "MessageTypeId";
$tdatalu_message_types[".inlineEditFields"][] = "MessageType";

$tdatalu_message_types[".exportFields"] = array();
$tdatalu_message_types[".exportFields"][] = "MessageTypeId";
$tdatalu_message_types[".exportFields"][] = "MessageType";

$tdatalu_message_types[".printFields"] = array();
$tdatalu_message_types[".printFields"][] = "MessageTypeId";
$tdatalu_message_types[".printFields"][] = "MessageType";

//	MessageTypeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "MessageTypeId";
	$fdata["GoodName"] = "MessageTypeId";
	$fdata["ownerTable"] = "lu_message_types";
	$fdata["Label"] = "Message Type Id"; 
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
	
		$fdata["strField"] = "MessageTypeId"; 
		$fdata["FullName"] = "MessageTypeId";
	
		
		
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
	
		
		
	$tdatalu_message_types["MessageTypeId"] = $fdata;
//	MessageType
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "MessageType";
	$fdata["GoodName"] = "MessageType";
	$fdata["ownerTable"] = "lu_message_types";
	$fdata["Label"] = "Message Type"; 
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
	
		$fdata["strField"] = "MessageType"; 
		$fdata["FullName"] = "MessageType";
	
		
		
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
	
		
		
	$tdatalu_message_types["MessageType"] = $fdata;

	
$tables_data["lu_message_types"]=&$tdatalu_message_types;
$field_labels["lu_message_types"] = &$fieldLabelslu_message_types;
$fieldToolTips["lu_message_types"] = &$fieldToolTipslu_message_types;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_message_types"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_message_types"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_message_types()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "MessageTypeId,   MessageType";
$proto0["m_strFrom"] = "FROM lu_message_types";
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
	"m_strName" => "MessageTypeId",
	"m_strTable" => "lu_message_types"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "MessageType",
	"m_strTable" => "lu_message_types"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_message_types";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "MessageTypeId";
$proto10["m_columns"][] = "MessageType";
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
$queryData_lu_message_types = createSqlQuery_lu_message_types();
		$tdatalu_message_types[".sqlquery"] = $queryData_lu_message_types;
	
if(isset($tdatalu_message_types["field2"])){
	$tdatalu_message_types["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_message_types["field2"]["LookupOrderBy"] = "name";
	$tdatalu_message_types["field2"]["LookupType"] = 4;
	$tdatalu_message_types["field2"]["LinkField"] = "email";
	$tdatalu_message_types["field2"]["DisplayField"] = "name";
	$tdatalu_message_types[".hasCustomViewField"] = true;
}

$tableEvents["lu_message_types"] = new eventsBase;
$tdatalu_message_types[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_message_types");

?>