<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_initiating_gurus = array();
	$tdatalu_initiating_gurus[".NumberOfChars"] = 80; 
	$tdatalu_initiating_gurus[".ShortName"] = "lu_initiating_gurus";
	$tdatalu_initiating_gurus[".OwnerID"] = "";
	$tdatalu_initiating_gurus[".OriginalTable"] = "lu_initiating_gurus";

//	field labels
$fieldLabelslu_initiating_gurus = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_initiating_gurus["English"] = array();
	$fieldToolTipslu_initiating_gurus["English"] = array();
	$fieldLabelslu_initiating_gurus["English"]["Name"] = "Name";
	$fieldToolTipslu_initiating_gurus["English"]["Name"] = "";
	$fieldLabelslu_initiating_gurus["English"]["GurumaharajId"] = "Gurumaharaj Id";
	$fieldToolTipslu_initiating_gurus["English"]["GurumaharajId"] = "";
	if (count($fieldToolTipslu_initiating_gurus["English"]))
		$tdatalu_initiating_gurus[".isUseToolTips"] = true;
}
	
	
	$tdatalu_initiating_gurus[".NCSearch"] = true;



$tdatalu_initiating_gurus[".shortTableName"] = "lu_initiating_gurus";
$tdatalu_initiating_gurus[".nSecOptions"] = 0;
$tdatalu_initiating_gurus[".recsPerRowList"] = 1;
$tdatalu_initiating_gurus[".mainTableOwnerID"] = "";
$tdatalu_initiating_gurus[".moveNext"] = 1;
$tdatalu_initiating_gurus[".nType"] = 0;

$tdatalu_initiating_gurus[".strOriginalTableName"] = "lu_initiating_gurus";




$tdatalu_initiating_gurus[".showAddInPopup"] = true;

$tdatalu_initiating_gurus[".showEditInPopup"] = true;

$tdatalu_initiating_gurus[".showViewInPopup"] = true;

$tdatalu_initiating_gurus[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_initiating_gurus[".listAjax"] = true;
else 
	$tdatalu_initiating_gurus[".listAjax"] = false;

	$tdatalu_initiating_gurus[".audit"] = true;

	$tdatalu_initiating_gurus[".locking"] = false;

$tdatalu_initiating_gurus[".listIcons"] = true;
$tdatalu_initiating_gurus[".edit"] = true;
$tdatalu_initiating_gurus[".inlineEdit"] = true;
$tdatalu_initiating_gurus[".inlineAdd"] = true;
$tdatalu_initiating_gurus[".copy"] = true;
$tdatalu_initiating_gurus[".view"] = true;

$tdatalu_initiating_gurus[".exportTo"] = true;

$tdatalu_initiating_gurus[".printFriendly"] = true;

$tdatalu_initiating_gurus[".delete"] = true;

$tdatalu_initiating_gurus[".showSimpleSearchOptions"] = true;

$tdatalu_initiating_gurus[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_initiating_gurus[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_initiating_gurus[".isUseAjaxSuggest"] = true;

$tdatalu_initiating_gurus[".rowHighlite"] = true;

// button handlers file names

$tdatalu_initiating_gurus[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_initiating_gurus[".isUseTimeForSearch"] = false;




$tdatalu_initiating_gurus[".allSearchFields"] = array();

$tdatalu_initiating_gurus[".allSearchFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".allSearchFields"][] = "Name";

$tdatalu_initiating_gurus[".googleLikeFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".googleLikeFields"][] = "Name";


$tdatalu_initiating_gurus[".advSearchFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".advSearchFields"][] = "Name";

$tdatalu_initiating_gurus[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_initiating_gurus[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_initiating_gurus[".strOrderBy"] = $tstrOrderBy;

$tdatalu_initiating_gurus[".orderindexes"] = array();

$tdatalu_initiating_gurus[".sqlHead"] = "SELECT GurumaharajId,   Name";
$tdatalu_initiating_gurus[".sqlFrom"] = "FROM lu_initiating_gurus";
$tdatalu_initiating_gurus[".sqlWhereExpr"] = "";
$tdatalu_initiating_gurus[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_initiating_gurus[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_initiating_gurus[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_initiating_gurus = array();
$tableKeyslu_initiating_gurus[] = "GurumaharajId";
$tdatalu_initiating_gurus[".Keys"] = $tableKeyslu_initiating_gurus;

$tdatalu_initiating_gurus[".listFields"] = array();
$tdatalu_initiating_gurus[".listFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".listFields"][] = "Name";

$tdatalu_initiating_gurus[".viewFields"] = array();
$tdatalu_initiating_gurus[".viewFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".viewFields"][] = "Name";

$tdatalu_initiating_gurus[".addFields"] = array();
$tdatalu_initiating_gurus[".addFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".addFields"][] = "Name";

$tdatalu_initiating_gurus[".inlineAddFields"] = array();
$tdatalu_initiating_gurus[".inlineAddFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".inlineAddFields"][] = "Name";

$tdatalu_initiating_gurus[".editFields"] = array();
$tdatalu_initiating_gurus[".editFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".editFields"][] = "Name";

$tdatalu_initiating_gurus[".inlineEditFields"] = array();
$tdatalu_initiating_gurus[".inlineEditFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".inlineEditFields"][] = "Name";

$tdatalu_initiating_gurus[".exportFields"] = array();
$tdatalu_initiating_gurus[".exportFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".exportFields"][] = "Name";

$tdatalu_initiating_gurus[".printFields"] = array();
$tdatalu_initiating_gurus[".printFields"][] = "GurumaharajId";
$tdatalu_initiating_gurus[".printFields"][] = "Name";

//	GurumaharajId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "GurumaharajId";
	$fdata["GoodName"] = "GurumaharajId";
	$fdata["ownerTable"] = "lu_initiating_gurus";
	$fdata["Label"] = "Gurumaharaj Id"; 
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
	
		$fdata["strField"] = "GurumaharajId"; 
		$fdata["FullName"] = "GurumaharajId";
	
		
		
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
	
		
		
	$tdatalu_initiating_gurus["GurumaharajId"] = $fdata;
//	Name
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Name";
	$fdata["GoodName"] = "Name";
	$fdata["ownerTable"] = "lu_initiating_gurus";
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
	
		
		
	$tdatalu_initiating_gurus["Name"] = $fdata;

	
$tables_data["lu_initiating_gurus"]=&$tdatalu_initiating_gurus;
$field_labels["lu_initiating_gurus"] = &$fieldLabelslu_initiating_gurus;
$fieldToolTips["lu_initiating_gurus"] = &$fieldToolTipslu_initiating_gurus;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_initiating_gurus"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_initiating_gurus"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_initiating_gurus()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "GurumaharajId,   Name";
$proto0["m_strFrom"] = "FROM lu_initiating_gurus";
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
	"m_strName" => "GurumaharajId",
	"m_strTable" => "lu_initiating_gurus"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Name",
	"m_strTable" => "lu_initiating_gurus"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_initiating_gurus";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "GurumaharajId";
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
$queryData_lu_initiating_gurus = createSqlQuery_lu_initiating_gurus();
		$tdatalu_initiating_gurus[".sqlquery"] = $queryData_lu_initiating_gurus;
	
if(isset($tdatalu_initiating_gurus["field2"])){
	$tdatalu_initiating_gurus["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_initiating_gurus["field2"]["LookupOrderBy"] = "name";
	$tdatalu_initiating_gurus["field2"]["LookupType"] = 4;
	$tdatalu_initiating_gurus["field2"]["LinkField"] = "email";
	$tdatalu_initiating_gurus["field2"]["DisplayField"] = "name";
	$tdatalu_initiating_gurus[".hasCustomViewField"] = true;
}

$tableEvents["lu_initiating_gurus"] = new eventsBase;
$tdatalu_initiating_gurus[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_initiating_gurus");

?>