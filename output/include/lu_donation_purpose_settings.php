<?php
require_once(getabspath("classes/cipherer.php"));
$tdatalu_donation_purpose = array();
	$tdatalu_donation_purpose[".NumberOfChars"] = 80; 
	$tdatalu_donation_purpose[".ShortName"] = "lu_donation_purpose";
	$tdatalu_donation_purpose[".OwnerID"] = "";
	$tdatalu_donation_purpose[".OriginalTable"] = "lu_donation_purpose";

//	field labels
$fieldLabelslu_donation_purpose = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelslu_donation_purpose["English"] = array();
	$fieldToolTipslu_donation_purpose["English"] = array();
	$fieldLabelslu_donation_purpose["English"]["DonationPurposeId"] = "Donation Purpose Id";
	$fieldToolTipslu_donation_purpose["English"]["DonationPurposeId"] = "";
	$fieldLabelslu_donation_purpose["English"]["PurposeTitle"] = "Purpose Title";
	$fieldToolTipslu_donation_purpose["English"]["PurposeTitle"] = "";
	if (count($fieldToolTipslu_donation_purpose["English"]))
		$tdatalu_donation_purpose[".isUseToolTips"] = true;
}
	
	
	$tdatalu_donation_purpose[".NCSearch"] = true;



$tdatalu_donation_purpose[".shortTableName"] = "lu_donation_purpose";
$tdatalu_donation_purpose[".nSecOptions"] = 0;
$tdatalu_donation_purpose[".recsPerRowList"] = 1;
$tdatalu_donation_purpose[".mainTableOwnerID"] = "";
$tdatalu_donation_purpose[".moveNext"] = 1;
$tdatalu_donation_purpose[".nType"] = 0;

$tdatalu_donation_purpose[".strOriginalTableName"] = "lu_donation_purpose";




$tdatalu_donation_purpose[".showAddInPopup"] = true;

$tdatalu_donation_purpose[".showEditInPopup"] = true;

$tdatalu_donation_purpose[".showViewInPopup"] = true;

$tdatalu_donation_purpose[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatalu_donation_purpose[".listAjax"] = true;
else 
	$tdatalu_donation_purpose[".listAjax"] = false;

	$tdatalu_donation_purpose[".audit"] = false;

	$tdatalu_donation_purpose[".locking"] = false;

$tdatalu_donation_purpose[".listIcons"] = true;
$tdatalu_donation_purpose[".edit"] = true;
$tdatalu_donation_purpose[".inlineEdit"] = true;
$tdatalu_donation_purpose[".inlineAdd"] = true;
$tdatalu_donation_purpose[".copy"] = true;
$tdatalu_donation_purpose[".view"] = true;

$tdatalu_donation_purpose[".exportTo"] = true;

$tdatalu_donation_purpose[".printFriendly"] = true;

$tdatalu_donation_purpose[".delete"] = true;

$tdatalu_donation_purpose[".showSimpleSearchOptions"] = true;

$tdatalu_donation_purpose[".showSearchPanel"] = true;

if (isMobile())
	$tdatalu_donation_purpose[".isUseAjaxSuggest"] = false;
else 
	$tdatalu_donation_purpose[".isUseAjaxSuggest"] = true;

$tdatalu_donation_purpose[".rowHighlite"] = true;

// button handlers file names

$tdatalu_donation_purpose[".addPageEvents"] = false;

// use timepicker for search panel
$tdatalu_donation_purpose[".isUseTimeForSearch"] = false;




$tdatalu_donation_purpose[".allSearchFields"] = array();

$tdatalu_donation_purpose[".allSearchFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".allSearchFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".googleLikeFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".googleLikeFields"][] = "PurposeTitle";


$tdatalu_donation_purpose[".advSearchFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".advSearchFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatalu_donation_purpose[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatalu_donation_purpose[".strOrderBy"] = $tstrOrderBy;

$tdatalu_donation_purpose[".orderindexes"] = array();

$tdatalu_donation_purpose[".sqlHead"] = "SELECT DonationPurposeId,   PurposeTitle";
$tdatalu_donation_purpose[".sqlFrom"] = "FROM lu_donation_purpose";
$tdatalu_donation_purpose[".sqlWhereExpr"] = "";
$tdatalu_donation_purpose[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatalu_donation_purpose[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatalu_donation_purpose[".arrGroupsPerPage"] = $arrGPP;

$tableKeyslu_donation_purpose = array();
$tableKeyslu_donation_purpose[] = "DonationPurposeId";
$tdatalu_donation_purpose[".Keys"] = $tableKeyslu_donation_purpose;

$tdatalu_donation_purpose[".listFields"] = array();
$tdatalu_donation_purpose[".listFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".listFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".viewFields"] = array();
$tdatalu_donation_purpose[".viewFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".viewFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".addFields"] = array();
$tdatalu_donation_purpose[".addFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".addFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".inlineAddFields"] = array();
$tdatalu_donation_purpose[".inlineAddFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".inlineAddFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".editFields"] = array();
$tdatalu_donation_purpose[".editFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".editFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".inlineEditFields"] = array();
$tdatalu_donation_purpose[".inlineEditFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".inlineEditFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".exportFields"] = array();
$tdatalu_donation_purpose[".exportFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".exportFields"][] = "PurposeTitle";

$tdatalu_donation_purpose[".printFields"] = array();
$tdatalu_donation_purpose[".printFields"][] = "DonationPurposeId";
$tdatalu_donation_purpose[".printFields"][] = "PurposeTitle";

//	DonationPurposeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DonationPurposeId";
	$fdata["GoodName"] = "DonationPurposeId";
	$fdata["ownerTable"] = "lu_donation_purpose";
	$fdata["Label"] = "Donation Purpose Id"; 
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
	
		$fdata["strField"] = "DonationPurposeId"; 
		$fdata["FullName"] = "DonationPurposeId";
	
		
		
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
	
		
		
	$tdatalu_donation_purpose["DonationPurposeId"] = $fdata;
//	PurposeTitle
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "PurposeTitle";
	$fdata["GoodName"] = "PurposeTitle";
	$fdata["ownerTable"] = "lu_donation_purpose";
	$fdata["Label"] = "Purpose Title"; 
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
	
		$fdata["strField"] = "PurposeTitle"; 
		$fdata["FullName"] = "PurposeTitle";
	
		
		
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
	
		
		
	$tdatalu_donation_purpose["PurposeTitle"] = $fdata;

	
$tables_data["lu_donation_purpose"]=&$tdatalu_donation_purpose;
$field_labels["lu_donation_purpose"] = &$fieldLabelslu_donation_purpose;
$fieldToolTips["lu_donation_purpose"] = &$fieldToolTipslu_donation_purpose;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["lu_donation_purpose"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["lu_donation_purpose"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_lu_donation_purpose()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DonationPurposeId,   PurposeTitle";
$proto0["m_strFrom"] = "FROM lu_donation_purpose";
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
	"m_strName" => "DonationPurposeId",
	"m_strTable" => "lu_donation_purpose"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "PurposeTitle",
	"m_strTable" => "lu_donation_purpose"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "lu_donation_purpose";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "DonationPurposeId";
$proto10["m_columns"][] = "PurposeTitle";
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
$queryData_lu_donation_purpose = createSqlQuery_lu_donation_purpose();
		$tdatalu_donation_purpose[".sqlquery"] = $queryData_lu_donation_purpose;
	
if(isset($tdatalu_donation_purpose["field2"])){
	$tdatalu_donation_purpose["field2"]["LookupTable"] = "carscars_view";
	$tdatalu_donation_purpose["field2"]["LookupOrderBy"] = "name";
	$tdatalu_donation_purpose["field2"]["LookupType"] = 4;
	$tdatalu_donation_purpose["field2"]["LinkField"] = "email";
	$tdatalu_donation_purpose["field2"]["DisplayField"] = "name";
	$tdatalu_donation_purpose[".hasCustomViewField"] = true;
}

$tableEvents["lu_donation_purpose"] = new eventsBase;
$tdatalu_donation_purpose[".hasEvents"] = false;

$cipherer = new RunnerCipherer("lu_donation_purpose");

?>