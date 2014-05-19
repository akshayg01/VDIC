<?php
require_once(getabspath("classes/cipherer.php"));
$tdataspiritualmaster = array();
	$tdataspiritualmaster[".NumberOfChars"] = 80; 
	$tdataspiritualmaster[".ShortName"] = "spiritualmaster";
	$tdataspiritualmaster[".OwnerID"] = "";
	$tdataspiritualmaster[".OriginalTable"] = "spiritualmaster";

//	field labels
$fieldLabelsspiritualmaster = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsspiritualmaster["English"] = array();
	$fieldToolTipsspiritualmaster["English"] = array();
	$fieldLabelsspiritualmaster["English"]["SpiritualMasterId"] = "Spiritual Master Id";
	$fieldToolTipsspiritualmaster["English"]["SpiritualMasterId"] = "";
	$fieldLabelsspiritualmaster["English"]["Name"] = "Name";
	$fieldToolTipsspiritualmaster["English"]["Name"] = "";
	if (count($fieldToolTipsspiritualmaster["English"]))
		$tdataspiritualmaster[".isUseToolTips"] = true;
}
	
	
	$tdataspiritualmaster[".NCSearch"] = true;



$tdataspiritualmaster[".shortTableName"] = "spiritualmaster";
$tdataspiritualmaster[".nSecOptions"] = 0;
$tdataspiritualmaster[".recsPerRowList"] = 1;
$tdataspiritualmaster[".mainTableOwnerID"] = "";
$tdataspiritualmaster[".moveNext"] = 1;
$tdataspiritualmaster[".nType"] = 0;

$tdataspiritualmaster[".strOriginalTableName"] = "spiritualmaster";




$tdataspiritualmaster[".showAddInPopup"] = false;

$tdataspiritualmaster[".showEditInPopup"] = false;

$tdataspiritualmaster[".showViewInPopup"] = false;

$tdataspiritualmaster[".fieldsForRegister"] = array();
	
$tdataspiritualmaster[".listAjax"] = false;

	$tdataspiritualmaster[".audit"] = false;

	$tdataspiritualmaster[".locking"] = false;

$tdataspiritualmaster[".listIcons"] = true;




$tdataspiritualmaster[".showSimpleSearchOptions"] = false;

$tdataspiritualmaster[".showSearchPanel"] = true;

if (isMobile())
	$tdataspiritualmaster[".isUseAjaxSuggest"] = false;
else 
	$tdataspiritualmaster[".isUseAjaxSuggest"] = true;

$tdataspiritualmaster[".rowHighlite"] = true;

// button handlers file names

$tdataspiritualmaster[".addPageEvents"] = false;

// use timepicker for search panel
$tdataspiritualmaster[".isUseTimeForSearch"] = false;




$tdataspiritualmaster[".allSearchFields"] = array();

$tdataspiritualmaster[".allSearchFields"][] = "SpiritualMasterId";
$tdataspiritualmaster[".allSearchFields"][] = "Name";

$tdataspiritualmaster[".googleLikeFields"][] = "SpiritualMasterId";
$tdataspiritualmaster[".googleLikeFields"][] = "Name";


$tdataspiritualmaster[".advSearchFields"][] = "SpiritualMasterId";
$tdataspiritualmaster[".advSearchFields"][] = "Name";

$tdataspiritualmaster[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdataspiritualmaster[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdataspiritualmaster[".strOrderBy"] = $tstrOrderBy;

$tdataspiritualmaster[".orderindexes"] = array();

$tdataspiritualmaster[".sqlHead"] = "SELECT SpiritualMasterId,   Name";
$tdataspiritualmaster[".sqlFrom"] = "FROM spiritualmaster";
$tdataspiritualmaster[".sqlWhereExpr"] = "";
$tdataspiritualmaster[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataspiritualmaster[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataspiritualmaster[".arrGroupsPerPage"] = $arrGPP;

$tableKeysspiritualmaster = array();
$tableKeysspiritualmaster[] = "SpiritualMasterId";
$tdataspiritualmaster[".Keys"] = $tableKeysspiritualmaster;

$tdataspiritualmaster[".listFields"] = array();
$tdataspiritualmaster[".listFields"][] = "SpiritualMasterId";
$tdataspiritualmaster[".listFields"][] = "Name";

$tdataspiritualmaster[".viewFields"] = array();
$tdataspiritualmaster[".viewFields"][] = "SpiritualMasterId";
$tdataspiritualmaster[".viewFields"][] = "Name";

$tdataspiritualmaster[".addFields"] = array();
$tdataspiritualmaster[".addFields"][] = "Name";

$tdataspiritualmaster[".inlineAddFields"] = array();
$tdataspiritualmaster[".inlineAddFields"][] = "Name";

$tdataspiritualmaster[".editFields"] = array();
$tdataspiritualmaster[".editFields"][] = "Name";

$tdataspiritualmaster[".inlineEditFields"] = array();
$tdataspiritualmaster[".inlineEditFields"][] = "Name";

$tdataspiritualmaster[".exportFields"] = array();
$tdataspiritualmaster[".exportFields"][] = "SpiritualMasterId";
$tdataspiritualmaster[".exportFields"][] = "Name";

$tdataspiritualmaster[".printFields"] = array();
$tdataspiritualmaster[".printFields"][] = "SpiritualMasterId";
$tdataspiritualmaster[".printFields"][] = "Name";

//	SpiritualMasterId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "SpiritualMasterId";
	$fdata["GoodName"] = "SpiritualMasterId";
	$fdata["ownerTable"] = "spiritualmaster";
	$fdata["Label"] = "Spiritual Master Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SpiritualMasterId"; 
		$fdata["FullName"] = "SpiritualMasterId";
	
		
		
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
	
		
		
	$tdataspiritualmaster["SpiritualMasterId"] = $fdata;
//	Name
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Name";
	$fdata["GoodName"] = "Name";
	$fdata["ownerTable"] = "spiritualmaster";
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
			$edata["EditParams"].= " maxlength=200";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdataspiritualmaster["Name"] = $fdata;

	
$tables_data["spiritualmaster"]=&$tdataspiritualmaster;
$field_labels["spiritualmaster"] = &$fieldLabelsspiritualmaster;
$fieldToolTips["spiritualmaster"] = &$fieldToolTipsspiritualmaster;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["spiritualmaster"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["spiritualmaster"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_spiritualmaster()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "SpiritualMasterId,   Name";
$proto0["m_strFrom"] = "FROM spiritualmaster";
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
	"m_strName" => "SpiritualMasterId",
	"m_strTable" => "spiritualmaster"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Name",
	"m_strTable" => "spiritualmaster"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "spiritualmaster";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "SpiritualMasterId";
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
$queryData_spiritualmaster = createSqlQuery_spiritualmaster();
		$tdataspiritualmaster[".sqlquery"] = $queryData_spiritualmaster;
	
if(isset($tdataspiritualmaster["field2"])){
	$tdataspiritualmaster["field2"]["LookupTable"] = "carscars_view";
	$tdataspiritualmaster["field2"]["LookupOrderBy"] = "name";
	$tdataspiritualmaster["field2"]["LookupType"] = 4;
	$tdataspiritualmaster["field2"]["LinkField"] = "email";
	$tdataspiritualmaster["field2"]["DisplayField"] = "name";
	$tdataspiritualmaster[".hasCustomViewField"] = true;
}

$tableEvents["spiritualmaster"] = new eventsBase;
$tdataspiritualmaster[".hasEvents"] = false;

$cipherer = new RunnerCipherer("spiritualmaster");

?>