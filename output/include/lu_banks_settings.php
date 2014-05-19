<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_banks = array();
	$tdatalu_banks[".NumberOfChars"] = 80; 
	$tdatalu_banks[".ShortName"] = "lu_banks";
	$tdatalu_banks[".OwnerID"] = "";
	$tdatalu_banks[".OriginalTable"] = "lu_banks";

//	field labels
$fieldLabelslu_banks = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_banks["English"] = array();
	$fieldToolTipslu_banks["English"] = array();
	$fieldLabelslu_banks["English"]["Name"] = "Name";
	$fieldToolTipslu_banks["English"]["Name"] = "";
	$fieldLabelslu_banks["English"]["BankId"] = "Bank Id";
	$fieldToolTipslu_banks["English"]["BankId"] = "";
	if (count($fieldToolTipslu_banks["English"]))
		$tdatalu_banks[".isUseToolTips"] = true;
}
	
	
	$tdatalu_banks[".NCSearch"] = true;



$tdatalu_banks[".shortTableName"] = "lu_banks";
$tdatalu_banks[".nSecOptions"] = 0;
$tdatalu_banks[".recsPerRowList"] = 1;
$tdatalu_banks[".mainTableOwnerID"] = "";
$tdatalu_banks[".moveNext"] = 1;
$tdatalu_banks[".nType"] = 0;

$tdatalu_banks[".strOriginalTableName"] = "lu_banks";




$tdatalu_banks[".showAddInPopup"] = true;

$tdatalu_banks[".showEditInPopup"] = true;

$tdatalu_banks[".showViewInPopup"] = true;

$tdatalu_banks[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_banks[".listAjax"] = true;
else 
	$tdatalu_banks[".listAjax"] = false;

	$tdatalu_banks[".audit"] = true;

	$tdatalu_banks[".locking"] = false;

$tdatalu_banks[".listIcons"] = true;
$tdatalu_banks[".edit"] = true;
$tdatalu_banks[".inlineEdit"] = true;
$tdatalu_banks[".inlineAdd"] = true;
$tdatalu_banks[".copy"] = true;
$tdatalu_banks[".view"] = true;

$tdatalu_banks[".exportTo"] = true;

$tdatalu_banks[".printFriendly"] = true;

$tdatalu_banks[".delete"] = true;

$tdatalu_banks[".showSimpleSearchOptions"] = true;

$tdatalu_banks[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_banks[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_banks[".isUseAjaxSuggest"] = true;

$tdatalu_banks[".rowHighlite"] = true;

// button handlers file names

$tdatalu_banks[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_banks[".isUseTimeForSearch"] = false;




$tdatalu_banks[".allSearchFields"] = array();

$tdatalu_banks[".allSearchFields"][] = "BankId";
$tdatalu_banks[".allSearchFields"][] = "Name";

$tdatalu_banks[".googleLikeFields"][] = "BankId";
$tdatalu_banks[".googleLikeFields"][] = "Name";


$tdatalu_banks[".advSearchFields"][] = "BankId";
$tdatalu_banks[".advSearchFields"][] = "Name";

$tdatalu_banks[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_banks[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_banks[".strOrderBy"] = $tstrOrderBy;

$tdatalu_banks[".orderindexes"] = array();

$tdatalu_banks[".sqlHead"] = "SELECT BankId,   Name";
$tdatalu_banks[".sqlFrom"] = "FROM lu_banks";
$tdatalu_banks[".sqlWhereExpr"] = "";
$tdatalu_banks[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_banks[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_banks[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_banks = array();
$tableKeyslu_banks[] = "BankId";
$tdatalu_banks[".Keys"] = $tableKeyslu_banks;

$tdatalu_banks[".listFields"] = array();
$tdatalu_banks[".listFields"][] = "BankId";
$tdatalu_banks[".listFields"][] = "Name";

$tdatalu_banks[".viewFields"] = array();
$tdatalu_banks[".viewFields"][] = "BankId";
$tdatalu_banks[".viewFields"][] = "Name";

$tdatalu_banks[".addFields"] = array();
$tdatalu_banks[".addFields"][] = "BankId";
$tdatalu_banks[".addFields"][] = "Name";

$tdatalu_banks[".inlineAddFields"] = array();
$tdatalu_banks[".inlineAddFields"][] = "BankId";
$tdatalu_banks[".inlineAddFields"][] = "Name";

$tdatalu_banks[".editFields"] = array();
$tdatalu_banks[".editFields"][] = "BankId";
$tdatalu_banks[".editFields"][] = "Name";

$tdatalu_banks[".inlineEditFields"] = array();
$tdatalu_banks[".inlineEditFields"][] = "BankId";
$tdatalu_banks[".inlineEditFields"][] = "Name";

$tdatalu_banks[".exportFields"] = array();
$tdatalu_banks[".exportFields"][] = "BankId";
$tdatalu_banks[".exportFields"][] = "Name";

$tdatalu_banks[".printFields"] = array();
$tdatalu_banks[".printFields"][] = "BankId";
$tdatalu_banks[".printFields"][] = "Name";

//	BankId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "BankId";
	$fdata["GoodName"] = "BankId";
	$fdata["ownerTable"] = "lu_banks";
	$fdata["Label"] = "Bank Id"; 
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
	
		$fdata["strField"] = "BankId"; 
		$fdata["FullName"] = "BankId";
	
		
		
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
	
		
		
	$tdatalu_banks["BankId"] = $fdata;
//	Name
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Name";
	$fdata["GoodName"] = "Name";
	$fdata["ownerTable"] = "lu_banks";
	$fdata["Label"] = "Name"; 
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
	
		$fdata["strField"] = "Name"; 
		$fdata["FullName"] = "Name";
	
		
		
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
	
		
		
	$tdatalu_banks["Name"] = $fdata;

	
$tables_data["lu_banks"]=&$tdatalu_banks;
$field_labels["lu_banks"] = &$fieldLabelslu_banks;
$fieldToolTips["lu_banks"] = &$fieldToolTipslu_banks;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_banks"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_banks"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_banks()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "BankId,   Name";
$proto0["m_strFrom"] = "FROM lu_banks";
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
	"m_strName" => "BankId",
	"m_strTable" => "lu_banks"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Name",
	"m_strTable" => "lu_banks"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_banks";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "BankId";
$proto10["m_columns"][] = "Name";
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
$queryData_lu_banks = createSqlQuery_lu_banks();
		$tdatalu_banks[".sqlquery"] = $queryData_lu_banks;
	
if(isset($tdatalu_banks["field2"])){
	$tdatalu_banks["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_banks["field2"]["LookupOrderBy"] = "name";
	$tdatalu_banks["field2"]["LookupType"] = 4;
	$tdatalu_banks["field2"]["LinkField"] = "email";
	$tdatalu_banks["field2"]["DisplayField"] = "name";
	$tdatalu_banks[".hasCustomViewField"] = true;
}

$tableEvents["lu_banks"] = new eventsBase;
$tdatalu_banks[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_banks");

?>