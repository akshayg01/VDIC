<?php
require_once(getabspath("classes/cipherer.php"));
$tdatacounsellor_counsellee = array();
	$tdatacounsellor_counsellee[".NumberOfChars"] = 80; 
	$tdatacounsellor_counsellee[".ShortName"] = "counsellor_counsellee";
	$tdatacounsellor_counsellee[".OwnerID"] = "";
	$tdatacounsellor_counsellee[".OriginalTable"] = "counsellor_counsellee";

//	field labels
$fieldLabelscounsellor_counsellee = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelscounsellor_counsellee["English"] = array();
	$fieldToolTipscounsellor_counsellee["English"] = array();
	$fieldLabelscounsellor_counsellee["English"]["CounsellorCounselleeID"] = "Counsellor Counsellee ID";
	$fieldToolTipscounsellor_counsellee["English"]["CounsellorCounselleeID"] = "";
	$fieldLabelscounsellor_counsellee["English"]["CounsellorDevoteeID"] = "Counsellor Devotee ID";
	$fieldToolTipscounsellor_counsellee["English"]["CounsellorDevoteeID"] = "";
	$fieldLabelscounsellor_counsellee["English"]["CounselleeDevoteeID"] = "Counsellee Devotee ID";
	$fieldToolTipscounsellor_counsellee["English"]["CounselleeDevoteeID"] = "";
	if (count($fieldToolTipscounsellor_counsellee["English"]))
		$tdatacounsellor_counsellee[".isUseToolTips"] = true;
}
	
	
	$tdatacounsellor_counsellee[".NCSearch"] = true;



$tdatacounsellor_counsellee[".shortTableName"] = "counsellor_counsellee";
$tdatacounsellor_counsellee[".nSecOptions"] = 0;
$tdatacounsellor_counsellee[".recsPerRowList"] = 1;
$tdatacounsellor_counsellee[".mainTableOwnerID"] = "";
$tdatacounsellor_counsellee[".moveNext"] = 1;
$tdatacounsellor_counsellee[".nType"] = 0;

$tdatacounsellor_counsellee[".strOriginalTableName"] = "counsellor_counsellee";




$tdatacounsellor_counsellee[".showAddInPopup"] = false;

$tdatacounsellor_counsellee[".showEditInPopup"] = false;

$tdatacounsellor_counsellee[".showViewInPopup"] = false;

$tdatacounsellor_counsellee[".fieldsForRegister"] = array();
	
$tdatacounsellor_counsellee[".listAjax"] = false;

	$tdatacounsellor_counsellee[".audit"] = false;

	$tdatacounsellor_counsellee[".locking"] = false;

$tdatacounsellor_counsellee[".listIcons"] = true;
$tdatacounsellor_counsellee[".edit"] = true;
$tdatacounsellor_counsellee[".inlineEdit"] = true;
$tdatacounsellor_counsellee[".inlineAdd"] = true;
$tdatacounsellor_counsellee[".view"] = true;

$tdatacounsellor_counsellee[".exportTo"] = true;

$tdatacounsellor_counsellee[".printFriendly"] = true;

$tdatacounsellor_counsellee[".delete"] = true;

$tdatacounsellor_counsellee[".showSimpleSearchOptions"] = false;

$tdatacounsellor_counsellee[".showSearchPanel"] = true;

if (isMobile())
	$tdatacounsellor_counsellee[".isUseAjaxSuggest"] = false;
else 
	$tdatacounsellor_counsellee[".isUseAjaxSuggest"] = true;

$tdatacounsellor_counsellee[".rowHighlite"] = true;

// button handlers file names

$tdatacounsellor_counsellee[".addPageEvents"] = false;

// use timepicker for search panel
$tdatacounsellor_counsellee[".isUseTimeForSearch"] = false;




$tdatacounsellor_counsellee[".allSearchFields"] = array();

$tdatacounsellor_counsellee[".allSearchFields"][] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".allSearchFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".allSearchFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".googleLikeFields"][] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".googleLikeFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".googleLikeFields"][] = "CounselleeDevoteeID";


$tdatacounsellor_counsellee[".advSearchFields"][] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".advSearchFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".advSearchFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatacounsellor_counsellee[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatacounsellor_counsellee[".strOrderBy"] = $tstrOrderBy;

$tdatacounsellor_counsellee[".orderindexes"] = array();

$tdatacounsellor_counsellee[".sqlHead"] = "SELECT CounsellorCounselleeID,   CounsellorDevoteeID,   CounselleeDevoteeID";
$tdatacounsellor_counsellee[".sqlFrom"] = "FROM counsellor_counsellee";
$tdatacounsellor_counsellee[".sqlWhereExpr"] = "";
$tdatacounsellor_counsellee[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatacounsellor_counsellee[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatacounsellor_counsellee[".arrGroupsPerPage"] = $arrGPP;

$tableKeyscounsellor_counsellee = array();
$tableKeyscounsellor_counsellee[] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".Keys"] = $tableKeyscounsellor_counsellee;

$tdatacounsellor_counsellee[".listFields"] = array();
$tdatacounsellor_counsellee[".listFields"][] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".listFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".listFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".viewFields"] = array();
$tdatacounsellor_counsellee[".viewFields"][] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".viewFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".viewFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".addFields"] = array();
$tdatacounsellor_counsellee[".addFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".addFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".inlineAddFields"] = array();
$tdatacounsellor_counsellee[".inlineAddFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".inlineAddFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".editFields"] = array();
$tdatacounsellor_counsellee[".editFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".editFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".inlineEditFields"] = array();
$tdatacounsellor_counsellee[".inlineEditFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".inlineEditFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".exportFields"] = array();
$tdatacounsellor_counsellee[".exportFields"][] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".exportFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".exportFields"][] = "CounselleeDevoteeID";

$tdatacounsellor_counsellee[".printFields"] = array();
$tdatacounsellor_counsellee[".printFields"][] = "CounsellorCounselleeID";
$tdatacounsellor_counsellee[".printFields"][] = "CounsellorDevoteeID";
$tdatacounsellor_counsellee[".printFields"][] = "CounselleeDevoteeID";

//	CounsellorCounselleeID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "CounsellorCounselleeID";
	$fdata["GoodName"] = "CounsellorCounselleeID";
	$fdata["ownerTable"] = "counsellor_counsellee";
	$fdata["Label"] = "Counsellor Counsellee ID"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "CounsellorCounselleeID"; 
		$fdata["FullName"] = "CounsellorCounselleeID";
	
		
		
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
	
		
		
	$tdatacounsellor_counsellee["CounsellorCounselleeID"] = $fdata;
//	CounsellorDevoteeID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "CounsellorDevoteeID";
	$fdata["GoodName"] = "CounsellorDevoteeID";
	$fdata["ownerTable"] = "counsellor_counsellee";
	$fdata["Label"] = "Counsellor Devotee ID"; 
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
	
		$fdata["strField"] = "CounsellorDevoteeID"; 
		$fdata["FullName"] = "CounsellorDevoteeID";
	
		
		
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
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 2;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				if(strpos(GetUserPermissions("counsellor_counsellee"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "DevoteeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "FirstName";
	
		
	$edata["LookupTable"] = "devotee";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
				
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatacounsellor_counsellee["CounsellorDevoteeID"] = $fdata;
//	CounselleeDevoteeID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "CounselleeDevoteeID";
	$fdata["GoodName"] = "CounselleeDevoteeID";
	$fdata["ownerTable"] = "counsellor_counsellee";
	$fdata["Label"] = "Counsellee Devotee ID"; 
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
	
		$fdata["strField"] = "CounselleeDevoteeID"; 
		$fdata["FullName"] = "CounselleeDevoteeID";
	
		
		
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
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 2;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				if(strpos(GetUserPermissions("counsellor_counsellee"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "DevoteeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "FirstName";
	
		
	$edata["LookupTable"] = "devotee";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
				
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatacounsellor_counsellee["CounselleeDevoteeID"] = $fdata;

	
$tables_data["counsellor_counsellee"]=&$tdatacounsellor_counsellee;
$field_labels["counsellor_counsellee"] = &$fieldLabelscounsellor_counsellee;
$fieldToolTips["counsellor_counsellee"] = &$fieldToolTipscounsellor_counsellee;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["counsellor_counsellee"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["counsellor_counsellee"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="devotee";
	$masterParams["mDataSourceTable"]="devotee";
	$masterParams["mOriginalTable"]= $strOriginalDetailsTable;
	$masterParams["mShortTable"]= "devotee";
	$masterParams["masterKeys"]= array();
	$masterParams["detailKeys"]= array();
	$masterParams["dispChildCount"]= "1";
	$masterParams["hideChild"]= "1";
	$masterParams["dispInfo"]= "0";
	$masterParams["previewOnList"]= 1;
	$masterParams["previewOnAdd"]= 0;
	$masterParams["previewOnEdit"]= 0;
	$masterParams["previewOnView"]= 0;
	$masterTablesData["counsellor_counsellee"][$mIndex] = $masterParams;	
		$masterTablesData["counsellor_counsellee"][$mIndex]["masterKeys"][]="DevoteeId";
		$masterTablesData["counsellor_counsellee"][$mIndex]["detailKeys"][]="CounsellorDevoteeID";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_counsellor_counsellee()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "CounsellorCounselleeID,   CounsellorDevoteeID,   CounselleeDevoteeID";
$proto0["m_strFrom"] = "FROM counsellor_counsellee";
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
	"m_strName" => "CounsellorCounselleeID",
	"m_strTable" => "counsellor_counsellee"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "CounsellorDevoteeID",
	"m_strTable" => "counsellor_counsellee"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "CounselleeDevoteeID",
	"m_strTable" => "counsellor_counsellee"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto11=array();
$proto11["m_link"] = "SQLL_MAIN";
			$proto12=array();
$proto12["m_strName"] = "counsellor_counsellee";
$proto12["m_columns"] = array();
$proto12["m_columns"][] = "CounsellorCounselleeID";
$proto12["m_columns"][] = "CounsellorDevoteeID";
$proto12["m_columns"][] = "CounselleeDevoteeID";
$obj = new SQLTable($proto12);

$proto11["m_table"] = $obj;
$proto11["m_alias"] = "";
$proto13=array();
$proto13["m_sql"] = "";
$proto13["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto13["m_column"]=$obj;
$proto13["m_contained"] = array();
$proto13["m_strCase"] = "";
$proto13["m_havingmode"] = "0";
$proto13["m_inBrackets"] = "0";
$proto13["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto13);

$proto11["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto11);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_counsellor_counsellee = createSqlQuery_counsellor_counsellee();
			$tdatacounsellor_counsellee[".sqlquery"] = $queryData_counsellor_counsellee;
	
if(isset($tdatacounsellor_counsellee["field2"])){
	$tdatacounsellor_counsellee["field2"]["LookupTable"] = "carscars_view";
	$tdatacounsellor_counsellee["field2"]["LookupOrderBy"] = "name";
	$tdatacounsellor_counsellee["field2"]["LookupType"] = 4;
	$tdatacounsellor_counsellee["field2"]["LinkField"] = "email";
	$tdatacounsellor_counsellee["field2"]["DisplayField"] = "name";
	$tdatacounsellor_counsellee[".hasCustomViewField"] = true;
}

$tableEvents["counsellor_counsellee"] = new eventsBase;
$tdatacounsellor_counsellee[".hasEvents"] = false;

$cipherer = new RunnerCipherer("counsellor_counsellee");

?>