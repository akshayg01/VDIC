<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_life_membership_status = array();
	$tdatalu_life_membership_status[".NumberOfChars"] = 80; 
	$tdatalu_life_membership_status[".ShortName"] = "lu_life_membership_status";
	$tdatalu_life_membership_status[".OwnerID"] = "";
	$tdatalu_life_membership_status[".OriginalTable"] = "lu_life_membership_status";

//	field labels
$fieldLabelslu_life_membership_status = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_life_membership_status["English"] = array();
	$fieldToolTipslu_life_membership_status["English"] = array();
	$fieldLabelslu_life_membership_status["English"]["status"] = "Status";
	$fieldToolTipslu_life_membership_status["English"]["status"] = "";
	$fieldLabelslu_life_membership_status["English"]["LifeMembershipStatusId"] = "Life Membership Status Id";
	$fieldToolTipslu_life_membership_status["English"]["LifeMembershipStatusId"] = "";
	if (count($fieldToolTipslu_life_membership_status["English"]))
		$tdatalu_life_membership_status[".isUseToolTips"] = true;
}
	
	
	$tdatalu_life_membership_status[".NCSearch"] = true;



$tdatalu_life_membership_status[".shortTableName"] = "lu_life_membership_status";
$tdatalu_life_membership_status[".nSecOptions"] = 0;
$tdatalu_life_membership_status[".recsPerRowList"] = 1;
$tdatalu_life_membership_status[".mainTableOwnerID"] = "";
$tdatalu_life_membership_status[".moveNext"] = 1;
$tdatalu_life_membership_status[".nType"] = 0;

$tdatalu_life_membership_status[".strOriginalTableName"] = "lu_life_membership_status";




$tdatalu_life_membership_status[".showAddInPopup"] = true;

$tdatalu_life_membership_status[".showEditInPopup"] = true;

$tdatalu_life_membership_status[".showViewInPopup"] = true;

$tdatalu_life_membership_status[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_life_membership_status[".listAjax"] = true;
else 
	$tdatalu_life_membership_status[".listAjax"] = false;

	$tdatalu_life_membership_status[".audit"] = true;

	$tdatalu_life_membership_status[".locking"] = false;

$tdatalu_life_membership_status[".listIcons"] = true;
$tdatalu_life_membership_status[".edit"] = true;
$tdatalu_life_membership_status[".inlineEdit"] = true;
$tdatalu_life_membership_status[".inlineAdd"] = true;
$tdatalu_life_membership_status[".copy"] = true;
$tdatalu_life_membership_status[".view"] = true;

$tdatalu_life_membership_status[".exportTo"] = true;

$tdatalu_life_membership_status[".printFriendly"] = true;

$tdatalu_life_membership_status[".delete"] = true;

$tdatalu_life_membership_status[".showSimpleSearchOptions"] = true;

$tdatalu_life_membership_status[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_life_membership_status[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_life_membership_status[".isUseAjaxSuggest"] = true;

$tdatalu_life_membership_status[".rowHighlite"] = true;

// button handlers file names

$tdatalu_life_membership_status[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_life_membership_status[".isUseTimeForSearch"] = false;




$tdatalu_life_membership_status[".allSearchFields"] = array();

$tdatalu_life_membership_status[".allSearchFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".allSearchFields"][] = "status";

$tdatalu_life_membership_status[".googleLikeFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".googleLikeFields"][] = "status";


$tdatalu_life_membership_status[".advSearchFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".advSearchFields"][] = "status";

$tdatalu_life_membership_status[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_life_membership_status[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_life_membership_status[".strOrderBy"] = $tstrOrderBy;

$tdatalu_life_membership_status[".orderindexes"] = array();

$tdatalu_life_membership_status[".sqlHead"] = "SELECT LifeMembershipStatusId,   Status";
$tdatalu_life_membership_status[".sqlFrom"] = "FROM lu_life_membership_status";
$tdatalu_life_membership_status[".sqlWhereExpr"] = "";
$tdatalu_life_membership_status[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_life_membership_status[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_life_membership_status[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_life_membership_status = array();
$tableKeyslu_life_membership_status[] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".Keys"] = $tableKeyslu_life_membership_status;

$tdatalu_life_membership_status[".listFields"] = array();
$tdatalu_life_membership_status[".listFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".listFields"][] = "status";

$tdatalu_life_membership_status[".viewFields"] = array();
$tdatalu_life_membership_status[".viewFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".viewFields"][] = "status";

$tdatalu_life_membership_status[".addFields"] = array();
$tdatalu_life_membership_status[".addFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".addFields"][] = "status";

$tdatalu_life_membership_status[".inlineAddFields"] = array();
$tdatalu_life_membership_status[".inlineAddFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".inlineAddFields"][] = "status";

$tdatalu_life_membership_status[".editFields"] = array();
$tdatalu_life_membership_status[".editFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".editFields"][] = "status";

$tdatalu_life_membership_status[".inlineEditFields"] = array();
$tdatalu_life_membership_status[".inlineEditFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".inlineEditFields"][] = "status";

$tdatalu_life_membership_status[".exportFields"] = array();
$tdatalu_life_membership_status[".exportFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".exportFields"][] = "status";

$tdatalu_life_membership_status[".printFields"] = array();
$tdatalu_life_membership_status[".printFields"][] = "LifeMembershipStatusId";
$tdatalu_life_membership_status[".printFields"][] = "status";

//	LifeMembershipStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "LifeMembershipStatusId";
	$fdata["GoodName"] = "LifeMembershipStatusId";
	$fdata["ownerTable"] = "lu_life_membership_status";
	$fdata["Label"] = "Life Membership Status Id"; 
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
	
		$fdata["strField"] = "LifeMembershipStatusId"; 
		$fdata["FullName"] = "LifeMembershipStatusId";
	
		
		
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
	
		
		
	$tdatalu_life_membership_status["LifeMembershipStatusId"] = $fdata;
//	status
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "status";
	$fdata["GoodName"] = "status";
	$fdata["ownerTable"] = "lu_life_membership_status";
	$fdata["Label"] = "Status"; 
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
	
		$fdata["strField"] = "Status"; 
		$fdata["FullName"] = "Status";
	
		
		
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
	
		
		
	$tdatalu_life_membership_status["status"] = $fdata;

	
$tables_data["lu_life_membership_status"]=&$tdatalu_life_membership_status;
$field_labels["lu_life_membership_status"] = &$fieldLabelslu_life_membership_status;
$fieldToolTips["lu_life_membership_status"] = &$fieldToolTipslu_life_membership_status;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_life_membership_status"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_life_membership_status"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_life_membership_status()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "LifeMembershipStatusId,   Status";
$proto0["m_strFrom"] = "FROM lu_life_membership_status";
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
	"m_strName" => "LifeMembershipStatusId",
	"m_strTable" => "lu_life_membership_status"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Status",
	"m_strTable" => "lu_life_membership_status"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_life_membership_status";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "LifeMembershipStatusId";
$proto10["m_columns"][] = "Status";
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
$queryData_lu_life_membership_status = createSqlQuery_lu_life_membership_status();
		$tdatalu_life_membership_status[".sqlquery"] = $queryData_lu_life_membership_status;
	
if(isset($tdatalu_life_membership_status["field2"])){
	$tdatalu_life_membership_status["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_life_membership_status["field2"]["LookupOrderBy"] = "name";
	$tdatalu_life_membership_status["field2"]["LookupType"] = 4;
	$tdatalu_life_membership_status["field2"]["LinkField"] = "email";
	$tdatalu_life_membership_status["field2"]["DisplayField"] = "name";
	$tdatalu_life_membership_status[".hasCustomViewField"] = true;
}

$tableEvents["lu_life_membership_status"] = new eventsBase;
$tdatalu_life_membership_status[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_life_membership_status");

?>