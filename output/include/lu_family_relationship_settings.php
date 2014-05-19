<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_family_relationship = array();
	$tdatalu_family_relationship[".NumberOfChars"] = 80; 
	$tdatalu_family_relationship[".ShortName"] = "lu_family_relationship";
	$tdatalu_family_relationship[".OwnerID"] = "";
	$tdatalu_family_relationship[".OriginalTable"] = "lu_family_relationship";

//	field labels
$fieldLabelslu_family_relationship = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_family_relationship["English"] = array();
	$fieldToolTipslu_family_relationship["English"] = array();
	$fieldLabelslu_family_relationship["English"]["RelationshipId"] = "Relationship Id";
	$fieldToolTipslu_family_relationship["English"]["RelationshipId"] = "";
	$fieldLabelslu_family_relationship["English"]["RelationshipName"] = "Relationship Name";
	$fieldToolTipslu_family_relationship["English"]["RelationshipName"] = "";
	if (count($fieldToolTipslu_family_relationship["English"]))
		$tdatalu_family_relationship[".isUseToolTips"] = true;
}
	
	
	$tdatalu_family_relationship[".NCSearch"] = true;



$tdatalu_family_relationship[".shortTableName"] = "lu_family_relationship";
$tdatalu_family_relationship[".nSecOptions"] = 0;
$tdatalu_family_relationship[".recsPerRowList"] = 1;
$tdatalu_family_relationship[".mainTableOwnerID"] = "";
$tdatalu_family_relationship[".moveNext"] = 1;
$tdatalu_family_relationship[".nType"] = 0;

$tdatalu_family_relationship[".strOriginalTableName"] = "lu_family_relationship";




$tdatalu_family_relationship[".showAddInPopup"] = true;

$tdatalu_family_relationship[".showEditInPopup"] = true;

$tdatalu_family_relationship[".showViewInPopup"] = true;

$tdatalu_family_relationship[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_family_relationship[".listAjax"] = true;
else 
	$tdatalu_family_relationship[".listAjax"] = false;

	$tdatalu_family_relationship[".audit"] = true;

	$tdatalu_family_relationship[".locking"] = false;

$tdatalu_family_relationship[".listIcons"] = true;
$tdatalu_family_relationship[".edit"] = true;
$tdatalu_family_relationship[".inlineEdit"] = true;
$tdatalu_family_relationship[".inlineAdd"] = true;
$tdatalu_family_relationship[".copy"] = true;
$tdatalu_family_relationship[".view"] = true;

$tdatalu_family_relationship[".exportTo"] = true;

$tdatalu_family_relationship[".printFriendly"] = true;

$tdatalu_family_relationship[".delete"] = true;

$tdatalu_family_relationship[".showSimpleSearchOptions"] = true;

$tdatalu_family_relationship[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_family_relationship[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_family_relationship[".isUseAjaxSuggest"] = true;

$tdatalu_family_relationship[".rowHighlite"] = true;

// button handlers file names

$tdatalu_family_relationship[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_family_relationship[".isUseTimeForSearch"] = false;




$tdatalu_family_relationship[".allSearchFields"] = array();

$tdatalu_family_relationship[".allSearchFields"][] = "RelationshipId";
$tdatalu_family_relationship[".allSearchFields"][] = "RelationshipName";

$tdatalu_family_relationship[".googleLikeFields"][] = "RelationshipId";
$tdatalu_family_relationship[".googleLikeFields"][] = "RelationshipName";


$tdatalu_family_relationship[".advSearchFields"][] = "RelationshipId";
$tdatalu_family_relationship[".advSearchFields"][] = "RelationshipName";

$tdatalu_family_relationship[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_family_relationship[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_family_relationship[".strOrderBy"] = $tstrOrderBy;

$tdatalu_family_relationship[".orderindexes"] = array();

$tdatalu_family_relationship[".sqlHead"] = "SELECT RelationshipId,   RelationshipName";
$tdatalu_family_relationship[".sqlFrom"] = "FROM lu_family_relationship";
$tdatalu_family_relationship[".sqlWhereExpr"] = "";
$tdatalu_family_relationship[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_family_relationship[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_family_relationship[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_family_relationship = array();
$tableKeyslu_family_relationship[] = "RelationshipId";
$tdatalu_family_relationship[".Keys"] = $tableKeyslu_family_relationship;

$tdatalu_family_relationship[".listFields"] = array();
$tdatalu_family_relationship[".listFields"][] = "RelationshipId";
$tdatalu_family_relationship[".listFields"][] = "RelationshipName";

$tdatalu_family_relationship[".viewFields"] = array();
$tdatalu_family_relationship[".viewFields"][] = "RelationshipId";
$tdatalu_family_relationship[".viewFields"][] = "RelationshipName";

$tdatalu_family_relationship[".addFields"] = array();
$tdatalu_family_relationship[".addFields"][] = "RelationshipId";
$tdatalu_family_relationship[".addFields"][] = "RelationshipName";

$tdatalu_family_relationship[".inlineAddFields"] = array();
$tdatalu_family_relationship[".inlineAddFields"][] = "RelationshipId";
$tdatalu_family_relationship[".inlineAddFields"][] = "RelationshipName";

$tdatalu_family_relationship[".editFields"] = array();
$tdatalu_family_relationship[".editFields"][] = "RelationshipId";
$tdatalu_family_relationship[".editFields"][] = "RelationshipName";

$tdatalu_family_relationship[".inlineEditFields"] = array();
$tdatalu_family_relationship[".inlineEditFields"][] = "RelationshipId";
$tdatalu_family_relationship[".inlineEditFields"][] = "RelationshipName";

$tdatalu_family_relationship[".exportFields"] = array();
$tdatalu_family_relationship[".exportFields"][] = "RelationshipId";
$tdatalu_family_relationship[".exportFields"][] = "RelationshipName";

$tdatalu_family_relationship[".printFields"] = array();
$tdatalu_family_relationship[".printFields"][] = "RelationshipId";
$tdatalu_family_relationship[".printFields"][] = "RelationshipName";

//	RelationshipId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "RelationshipId";
	$fdata["GoodName"] = "RelationshipId";
	$fdata["ownerTable"] = "lu_family_relationship";
	$fdata["Label"] = "Relationship Id"; 
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
	
		$fdata["strField"] = "RelationshipId"; 
		$fdata["FullName"] = "RelationshipId";
	
		
		
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
	
		
		
	$tdatalu_family_relationship["RelationshipId"] = $fdata;
//	RelationshipName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "RelationshipName";
	$fdata["GoodName"] = "RelationshipName";
	$fdata["ownerTable"] = "lu_family_relationship";
	$fdata["Label"] = "Relationship Name"; 
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
	
		$fdata["strField"] = "RelationshipName"; 
		$fdata["FullName"] = "RelationshipName";
	
		
		
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
	
		
		
	$tdatalu_family_relationship["RelationshipName"] = $fdata;

	
$tables_data["lu_family_relationship"]=&$tdatalu_family_relationship;
$field_labels["lu_family_relationship"] = &$fieldLabelslu_family_relationship;
$fieldToolTips["lu_family_relationship"] = &$fieldToolTipslu_family_relationship;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_family_relationship"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_family_relationship"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_family_relationship()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "RelationshipId,   RelationshipName";
$proto0["m_strFrom"] = "FROM lu_family_relationship";
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
	"m_strName" => "RelationshipId",
	"m_strTable" => "lu_family_relationship"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "RelationshipName",
	"m_strTable" => "lu_family_relationship"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_family_relationship";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "RelationshipId";
$proto10["m_columns"][] = "RelationshipName";
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
$queryData_lu_family_relationship = createSqlQuery_lu_family_relationship();
		$tdatalu_family_relationship[".sqlquery"] = $queryData_lu_family_relationship;
	
if(isset($tdatalu_family_relationship["field2"])){
	$tdatalu_family_relationship["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_family_relationship["field2"]["LookupOrderBy"] = "name";
	$tdatalu_family_relationship["field2"]["LookupType"] = 4;
	$tdatalu_family_relationship["field2"]["LinkField"] = "email";
	$tdatalu_family_relationship["field2"]["DisplayField"] = "name";
	$tdatalu_family_relationship[".hasCustomViewField"] = true;
}

$tableEvents["lu_family_relationship"] = new eventsBase;
$tdatalu_family_relationship[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_family_relationship");

?>