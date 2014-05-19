<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_payment_modes = array();
	$tdatalu_payment_modes[".NumberOfChars"] = 80; 
	$tdatalu_payment_modes[".ShortName"] = "lu_payment_modes";
	$tdatalu_payment_modes[".OwnerID"] = "";
	$tdatalu_payment_modes[".OriginalTable"] = "lu_payment_modes";

//	field labels
$fieldLabelslu_payment_modes = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_payment_modes["English"] = array();
	$fieldToolTipslu_payment_modes["English"] = array();
	$fieldLabelslu_payment_modes["English"]["PaymentModeId"] = "Payment Mode Id";
	$fieldToolTipslu_payment_modes["English"]["PaymentModeId"] = "";
	$fieldLabelslu_payment_modes["English"]["Mode"] = "Mode";
	$fieldToolTipslu_payment_modes["English"]["Mode"] = "";
	if (count($fieldToolTipslu_payment_modes["English"]))
		$tdatalu_payment_modes[".isUseToolTips"] = true;
}
	
	
	$tdatalu_payment_modes[".NCSearch"] = true;



$tdatalu_payment_modes[".shortTableName"] = "lu_payment_modes";
$tdatalu_payment_modes[".nSecOptions"] = 0;
$tdatalu_payment_modes[".recsPerRowList"] = 1;
$tdatalu_payment_modes[".mainTableOwnerID"] = "";
$tdatalu_payment_modes[".moveNext"] = 1;
$tdatalu_payment_modes[".nType"] = 0;

$tdatalu_payment_modes[".strOriginalTableName"] = "lu_payment_modes";




$tdatalu_payment_modes[".showAddInPopup"] = true;

$tdatalu_payment_modes[".showEditInPopup"] = true;

$tdatalu_payment_modes[".showViewInPopup"] = true;

$tdatalu_payment_modes[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_payment_modes[".listAjax"] = true;
else 
	$tdatalu_payment_modes[".listAjax"] = false;

	$tdatalu_payment_modes[".audit"] = false;

	$tdatalu_payment_modes[".locking"] = false;

$tdatalu_payment_modes[".listIcons"] = true;
$tdatalu_payment_modes[".edit"] = true;
$tdatalu_payment_modes[".inlineEdit"] = true;
$tdatalu_payment_modes[".inlineAdd"] = true;
$tdatalu_payment_modes[".copy"] = true;
$tdatalu_payment_modes[".view"] = true;

$tdatalu_payment_modes[".exportTo"] = true;

$tdatalu_payment_modes[".printFriendly"] = true;

$tdatalu_payment_modes[".delete"] = true;

$tdatalu_payment_modes[".showSimpleSearchOptions"] = true;

$tdatalu_payment_modes[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_payment_modes[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_payment_modes[".isUseAjaxSuggest"] = true;

$tdatalu_payment_modes[".rowHighlite"] = true;

// button handlers file names

$tdatalu_payment_modes[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_payment_modes[".isUseTimeForSearch"] = false;




$tdatalu_payment_modes[".allSearchFields"] = array();

$tdatalu_payment_modes[".allSearchFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".allSearchFields"][] = "Mode";

$tdatalu_payment_modes[".googleLikeFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".googleLikeFields"][] = "Mode";


$tdatalu_payment_modes[".advSearchFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".advSearchFields"][] = "Mode";

$tdatalu_payment_modes[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_payment_modes[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_payment_modes[".strOrderBy"] = $tstrOrderBy;

$tdatalu_payment_modes[".orderindexes"] = array();

$tdatalu_payment_modes[".sqlHead"] = "SELECT PaymentModeId,   `Mode`";
$tdatalu_payment_modes[".sqlFrom"] = "FROM lu_payment_modes";
$tdatalu_payment_modes[".sqlWhereExpr"] = "";
$tdatalu_payment_modes[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_payment_modes[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_payment_modes[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_payment_modes = array();
$tableKeyslu_payment_modes[] = "PaymentModeId";
$tdatalu_payment_modes[".Keys"] = $tableKeyslu_payment_modes;

$tdatalu_payment_modes[".listFields"] = array();
$tdatalu_payment_modes[".listFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".listFields"][] = "Mode";

$tdatalu_payment_modes[".viewFields"] = array();
$tdatalu_payment_modes[".viewFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".viewFields"][] = "Mode";

$tdatalu_payment_modes[".addFields"] = array();
$tdatalu_payment_modes[".addFields"][] = "Mode";

$tdatalu_payment_modes[".inlineAddFields"] = array();
$tdatalu_payment_modes[".inlineAddFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".inlineAddFields"][] = "Mode";

$tdatalu_payment_modes[".editFields"] = array();
$tdatalu_payment_modes[".editFields"][] = "Mode";

$tdatalu_payment_modes[".inlineEditFields"] = array();
$tdatalu_payment_modes[".inlineEditFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".inlineEditFields"][] = "Mode";

$tdatalu_payment_modes[".exportFields"] = array();
$tdatalu_payment_modes[".exportFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".exportFields"][] = "Mode";

$tdatalu_payment_modes[".printFields"] = array();
$tdatalu_payment_modes[".printFields"][] = "PaymentModeId";
$tdatalu_payment_modes[".printFields"][] = "Mode";

//	PaymentModeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "PaymentModeId";
	$fdata["GoodName"] = "PaymentModeId";
	$fdata["ownerTable"] = "lu_payment_modes";
	$fdata["Label"] = "Payment Mode Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "PaymentModeId"; 
		$fdata["FullName"] = "PaymentModeId";
	
		
		
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

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatalu_payment_modes["PaymentModeId"] = $fdata;
//	Mode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Mode";
	$fdata["GoodName"] = "Mode";
	$fdata["ownerTable"] = "lu_payment_modes";
	$fdata["Label"] = "Mode"; 
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
	
		$fdata["strField"] = "Mode"; 
		$fdata["FullName"] = "`Mode`";
	
		
		
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
	
		
		
	$tdatalu_payment_modes["Mode"] = $fdata;

	
$tables_data["lu_payment_modes"]=&$tdatalu_payment_modes;
$field_labels["lu_payment_modes"] = &$fieldLabelslu_payment_modes;
$fieldToolTips["lu_payment_modes"] = &$fieldToolTipslu_payment_modes;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_payment_modes"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_payment_modes"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_payment_modes()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "PaymentModeId,   `Mode`";
$proto0["m_strFrom"] = "FROM lu_payment_modes";
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
	"m_strName" => "PaymentModeId",
	"m_strTable" => "lu_payment_modes"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Mode",
	"m_strTable" => "lu_payment_modes"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_payment_modes";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "PaymentModeId";
$proto10["m_columns"][] = "Mode";
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
$queryData_lu_payment_modes = createSqlQuery_lu_payment_modes();
		$tdatalu_payment_modes[".sqlquery"] = $queryData_lu_payment_modes;
	
if(isset($tdatalu_payment_modes["field2"])){
	$tdatalu_payment_modes["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_payment_modes["field2"]["LookupOrderBy"] = "name";
	$tdatalu_payment_modes["field2"]["LookupType"] = 4;
	$tdatalu_payment_modes["field2"]["LinkField"] = "email";
	$tdatalu_payment_modes["field2"]["DisplayField"] = "name";
	$tdatalu_payment_modes[".hasCustomViewField"] = true;
}

$tableEvents["lu_payment_modes"] = new eventsBase;
$tdatalu_payment_modes[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_payment_modes");

?>