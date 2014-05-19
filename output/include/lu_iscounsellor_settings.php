<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_iscounsellor = array();
	$tdatalu_iscounsellor[".NumberOfChars"] = 80; 
	$tdatalu_iscounsellor[".ShortName"] = "lu_iscounsellor";
	$tdatalu_iscounsellor[".OwnerID"] = "";
	$tdatalu_iscounsellor[".OriginalTable"] = "lu_iscounsellor";

//	field labels
$fieldLabelslu_iscounsellor = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_iscounsellor["English"] = array();
	$fieldToolTipslu_iscounsellor["English"] = array();
	$fieldLabelslu_iscounsellor["English"]["IsCounsellorId"] = "Is Counsellor Id";
	$fieldToolTipslu_iscounsellor["English"]["IsCounsellorId"] = "";
	$fieldLabelslu_iscounsellor["English"]["IsCounsellor"] = "Is Counsellor";
	$fieldToolTipslu_iscounsellor["English"]["IsCounsellor"] = "";
	if (count($fieldToolTipslu_iscounsellor["English"]))
		$tdatalu_iscounsellor[".isUseToolTips"] = true;
}
	
	
	$tdatalu_iscounsellor[".NCSearch"] = true;



$tdatalu_iscounsellor[".shortTableName"] = "lu_iscounsellor";
$tdatalu_iscounsellor[".nSecOptions"] = 0;
$tdatalu_iscounsellor[".recsPerRowList"] = 1;
$tdatalu_iscounsellor[".mainTableOwnerID"] = "";
$tdatalu_iscounsellor[".moveNext"] = 1;
$tdatalu_iscounsellor[".nType"] = 0;

$tdatalu_iscounsellor[".strOriginalTableName"] = "lu_iscounsellor";




$tdatalu_iscounsellor[".showAddInPopup"] = false;

$tdatalu_iscounsellor[".showEditInPopup"] = false;

$tdatalu_iscounsellor[".showViewInPopup"] = false;

$tdatalu_iscounsellor[".fieldsForRegister"] = array();
	
$tdatalu_iscounsellor[".listAjax"] = false;

	$tdatalu_iscounsellor[".audit"] = false;

	$tdatalu_iscounsellor[".locking"] = false;

$tdatalu_iscounsellor[".listIcons"] = true;
$tdatalu_iscounsellor[".edit"] = true;
$tdatalu_iscounsellor[".inlineEdit"] = true;
$tdatalu_iscounsellor[".inlineAdd"] = true;
$tdatalu_iscounsellor[".view"] = true;

$tdatalu_iscounsellor[".exportTo"] = true;

$tdatalu_iscounsellor[".printFriendly"] = true;

$tdatalu_iscounsellor[".delete"] = true;

$tdatalu_iscounsellor[".showSimpleSearchOptions"] = false;

$tdatalu_iscounsellor[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_iscounsellor[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_iscounsellor[".isUseAjaxSuggest"] = true;

$tdatalu_iscounsellor[".rowHighlite"] = true;

// button handlers file names

$tdatalu_iscounsellor[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_iscounsellor[".isUseTimeForSearch"] = false;




$tdatalu_iscounsellor[".allSearchFields"] = array();

$tdatalu_iscounsellor[".allSearchFields"][] = "IsCounsellorId";
$tdatalu_iscounsellor[".allSearchFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".googleLikeFields"][] = "IsCounsellorId";
$tdatalu_iscounsellor[".googleLikeFields"][] = "IsCounsellor";


$tdatalu_iscounsellor[".advSearchFields"][] = "IsCounsellorId";
$tdatalu_iscounsellor[".advSearchFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_iscounsellor[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_iscounsellor[".strOrderBy"] = $tstrOrderBy;

$tdatalu_iscounsellor[".orderindexes"] = array();

$tdatalu_iscounsellor[".sqlHead"] = "SELECT IsCounsellorId,   IsCounsellor";
$tdatalu_iscounsellor[".sqlFrom"] = "FROM lu_iscounsellor";
$tdatalu_iscounsellor[".sqlWhereExpr"] = "";
$tdatalu_iscounsellor[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_iscounsellor[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_iscounsellor[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_iscounsellor = array();
$tableKeyslu_iscounsellor[] = "IsCounsellorId";
$tdatalu_iscounsellor[".Keys"] = $tableKeyslu_iscounsellor;

$tdatalu_iscounsellor[".listFields"] = array();
$tdatalu_iscounsellor[".listFields"][] = "IsCounsellorId";
$tdatalu_iscounsellor[".listFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".viewFields"] = array();
$tdatalu_iscounsellor[".viewFields"][] = "IsCounsellorId";
$tdatalu_iscounsellor[".viewFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".addFields"] = array();
$tdatalu_iscounsellor[".addFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".inlineAddFields"] = array();
$tdatalu_iscounsellor[".inlineAddFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".editFields"] = array();
$tdatalu_iscounsellor[".editFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".inlineEditFields"] = array();
$tdatalu_iscounsellor[".inlineEditFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".exportFields"] = array();
$tdatalu_iscounsellor[".exportFields"][] = "IsCounsellorId";
$tdatalu_iscounsellor[".exportFields"][] = "IsCounsellor";

$tdatalu_iscounsellor[".printFields"] = array();
$tdatalu_iscounsellor[".printFields"][] = "IsCounsellorId";
$tdatalu_iscounsellor[".printFields"][] = "IsCounsellor";

//	IsCounsellorId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "IsCounsellorId";
	$fdata["GoodName"] = "IsCounsellorId";
	$fdata["ownerTable"] = "lu_iscounsellor";
	$fdata["Label"] = "Is Counsellor Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "IsCounsellorId"; 
		$fdata["FullName"] = "IsCounsellorId";
	
		
		
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
	
		
		
	$tdatalu_iscounsellor["IsCounsellorId"] = $fdata;
//	IsCounsellor
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "IsCounsellor";
	$fdata["GoodName"] = "IsCounsellor";
	$fdata["ownerTable"] = "lu_iscounsellor";
	$fdata["Label"] = "Is Counsellor"; 
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
	
		$fdata["strField"] = "IsCounsellor"; 
		$fdata["FullName"] = "IsCounsellor";
	
		
		
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
	
		
		
	$tdatalu_iscounsellor["IsCounsellor"] = $fdata;

	
$tables_data["lu_iscounsellor"]=&$tdatalu_iscounsellor;
$field_labels["lu_iscounsellor"] = &$fieldLabelslu_iscounsellor;
$fieldToolTips["lu_iscounsellor"] = &$fieldToolTipslu_iscounsellor;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_iscounsellor"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_iscounsellor"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_iscounsellor()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "IsCounsellorId,   IsCounsellor";
$proto0["m_strFrom"] = "FROM lu_iscounsellor";
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
	"m_strName" => "IsCounsellorId",
	"m_strTable" => "lu_iscounsellor"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "IsCounsellor",
	"m_strTable" => "lu_iscounsellor"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_iscounsellor";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "IsCounsellorId";
$proto10["m_columns"][] = "IsCounsellor";
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
$queryData_lu_iscounsellor = createSqlQuery_lu_iscounsellor();
		$tdatalu_iscounsellor[".sqlquery"] = $queryData_lu_iscounsellor;
	
if(isset($tdatalu_iscounsellor["field2"])){
	$tdatalu_iscounsellor["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_iscounsellor["field2"]["LookupOrderBy"] = "name";
	$tdatalu_iscounsellor["field2"]["LookupType"] = 4;
	$tdatalu_iscounsellor["field2"]["LinkField"] = "email";
	$tdatalu_iscounsellor["field2"]["DisplayField"] = "name";
	$tdatalu_iscounsellor[".hasCustomViewField"] = true;
}

$tableEvents["lu_iscounsellor"] = new eventsBase;
$tdatalu_iscounsellor[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_iscounsellor");

?>