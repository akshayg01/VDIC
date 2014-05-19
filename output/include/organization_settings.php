<?php
require_once(getabspath("classes/cipherer.php"));
$tdataorganization = array();
	$tdataorganization[".NumberOfChars"] = 80; 
	$tdataorganization[".ShortName"] = "organization";
	$tdataorganization[".OwnerID"] = "";
	$tdataorganization[".OriginalTable"] = "organization";

//	field labels
$fieldLabelsorganization = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsorganization["English"] = array();
	$fieldToolTipsorganization["English"] = array();
	$fieldLabelsorganization["English"]["Location"] = "Location";
	$fieldToolTipsorganization["English"]["Location"] = "";
	$fieldLabelsorganization["English"]["OrgId"] = "Org Id";
	$fieldToolTipsorganization["English"]["OrgId"] = "";
	$fieldLabelsorganization["English"]["OrgName"] = "Org Name";
	$fieldToolTipsorganization["English"]["OrgName"] = "";
	$fieldLabelsorganization["English"]["OrgOwnerId"] = "Org Owner Id";
	$fieldToolTipsorganization["English"]["OrgOwnerId"] = "";
	if (count($fieldToolTipsorganization["English"]))
		$tdataorganization[".isUseToolTips"] = true;
}
	
	
	$tdataorganization[".NCSearch"] = true;



$tdataorganization[".shortTableName"] = "organization";
$tdataorganization[".nSecOptions"] = 0;
$tdataorganization[".recsPerRowList"] = 1;
$tdataorganization[".mainTableOwnerID"] = "";
$tdataorganization[".moveNext"] = 1;
$tdataorganization[".nType"] = 0;

$tdataorganization[".strOriginalTableName"] = "organization";




$tdataorganization[".showAddInPopup"] = true;

$tdataorganization[".showEditInPopup"] = true;

$tdataorganization[".showViewInPopup"] = true;

$tdataorganization[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdataorganization[".listAjax"] = true;
else 
	$tdataorganization[".listAjax"] = false;

	$tdataorganization[".audit"] = true;

	$tdataorganization[".locking"] = false;

$tdataorganization[".listIcons"] = true;
$tdataorganization[".edit"] = true;
$tdataorganization[".inlineEdit"] = true;
$tdataorganization[".inlineAdd"] = true;
$tdataorganization[".copy"] = true;
$tdataorganization[".view"] = true;

$tdataorganization[".exportTo"] = true;

$tdataorganization[".printFriendly"] = true;

$tdataorganization[".delete"] = true;

$tdataorganization[".showSimpleSearchOptions"] = true;

$tdataorganization[".showSearchPanel"] = true;

if (isMobile())
	$tdataorganization[".isUseAjaxSuggest"] = false;
else 
	$tdataorganization[".isUseAjaxSuggest"] = true;

$tdataorganization[".rowHighlite"] = true;

// button handlers file names

$tdataorganization[".addPageEvents"] = false;

// use timepicker for search panel
$tdataorganization[".isUseTimeForSearch"] = false;



$tdataorganization[".useDetailsPreview"] = true;

$tdataorganization[".allSearchFields"] = array();

$tdataorganization[".allSearchFields"][] = "OrgId";
$tdataorganization[".allSearchFields"][] = "OrgName";
$tdataorganization[".allSearchFields"][] = "OrgOwnerId";
$tdataorganization[".allSearchFields"][] = "Location";

$tdataorganization[".googleLikeFields"][] = "OrgId";
$tdataorganization[".googleLikeFields"][] = "OrgName";
$tdataorganization[".googleLikeFields"][] = "OrgOwnerId";
$tdataorganization[".googleLikeFields"][] = "Location";


$tdataorganization[".advSearchFields"][] = "OrgId";
$tdataorganization[".advSearchFields"][] = "OrgName";
$tdataorganization[".advSearchFields"][] = "OrgOwnerId";
$tdataorganization[".advSearchFields"][] = "Location";

$tdataorganization[".isTableType"] = "list";

	
$tdataorganization[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main
	


$tdataorganization[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdataorganization[".strOrderBy"] = $tstrOrderBy;

$tdataorganization[".orderindexes"] = array();

$tdataorganization[".sqlHead"] = "SELECT OrgId,   OrgName,   OrgOwnerId,   Location";
$tdataorganization[".sqlFrom"] = "FROM `organization`";
$tdataorganization[".sqlWhereExpr"] = "";
$tdataorganization[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataorganization[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataorganization[".arrGroupsPerPage"] = $arrGPP;

$tableKeysorganization = array();
$tableKeysorganization[] = "OrgId";
$tdataorganization[".Keys"] = $tableKeysorganization;

$tdataorganization[".listFields"] = array();
$tdataorganization[".listFields"][] = "OrgId";
$tdataorganization[".listFields"][] = "OrgName";
$tdataorganization[".listFields"][] = "OrgOwnerId";
$tdataorganization[".listFields"][] = "Location";

$tdataorganization[".viewFields"] = array();
$tdataorganization[".viewFields"][] = "OrgId";
$tdataorganization[".viewFields"][] = "OrgName";
$tdataorganization[".viewFields"][] = "OrgOwnerId";
$tdataorganization[".viewFields"][] = "Location";

$tdataorganization[".addFields"] = array();
$tdataorganization[".addFields"][] = "OrgId";
$tdataorganization[".addFields"][] = "OrgName";
$tdataorganization[".addFields"][] = "OrgOwnerId";
$tdataorganization[".addFields"][] = "Location";

$tdataorganization[".inlineAddFields"] = array();
$tdataorganization[".inlineAddFields"][] = "OrgId";
$tdataorganization[".inlineAddFields"][] = "OrgName";
$tdataorganization[".inlineAddFields"][] = "OrgOwnerId";
$tdataorganization[".inlineAddFields"][] = "Location";

$tdataorganization[".editFields"] = array();
$tdataorganization[".editFields"][] = "OrgId";
$tdataorganization[".editFields"][] = "OrgName";
$tdataorganization[".editFields"][] = "OrgOwnerId";
$tdataorganization[".editFields"][] = "Location";

$tdataorganization[".inlineEditFields"] = array();
$tdataorganization[".inlineEditFields"][] = "OrgId";
$tdataorganization[".inlineEditFields"][] = "OrgName";
$tdataorganization[".inlineEditFields"][] = "OrgOwnerId";
$tdataorganization[".inlineEditFields"][] = "Location";

$tdataorganization[".exportFields"] = array();
$tdataorganization[".exportFields"][] = "OrgId";
$tdataorganization[".exportFields"][] = "OrgName";
$tdataorganization[".exportFields"][] = "OrgOwnerId";
$tdataorganization[".exportFields"][] = "Location";

$tdataorganization[".printFields"] = array();
$tdataorganization[".printFields"][] = "OrgId";
$tdataorganization[".printFields"][] = "OrgName";
$tdataorganization[".printFields"][] = "OrgOwnerId";
$tdataorganization[".printFields"][] = "Location";

//	OrgId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "OrgId";
	$fdata["GoodName"] = "OrgId";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "Org Id"; 
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
	
		$fdata["strField"] = "OrgId"; 
		$fdata["FullName"] = "OrgId";
	
		
		
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
	
		
		
	$tdataorganization["OrgId"] = $fdata;
//	OrgName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "OrgName";
	$fdata["GoodName"] = "OrgName";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "Org Name"; 
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
	
		$fdata["strField"] = "OrgName"; 
		$fdata["FullName"] = "OrgName";
	
		
		
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
	
		
		
	$tdataorganization["OrgName"] = $fdata;
//	OrgOwnerId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "OrgOwnerId";
	$fdata["GoodName"] = "OrgOwnerId";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "Org Owner Id"; 
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
	
		$fdata["strField"] = "OrgOwnerId"; 
		$fdata["FullName"] = "OrgOwnerId";
	
		
		
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
				if(strpos(GetUserPermissions("organization"), 'S') !== false)
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
	
		
		
	$tdataorganization["OrgOwnerId"] = $fdata;
//	Location
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "Location";
	$fdata["GoodName"] = "Location";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "Location"; 
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
	
		$fdata["strField"] = "Location"; 
		$fdata["FullName"] = "Location";
	
		
		
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
	
		
		
	$tdataorganization["Location"] = $fdata;

	
$tables_data["organization"]=&$tdataorganization;
$field_labels["organization"] = &$fieldLabelsorganization;
$fieldToolTips["organization"] = &$fieldToolTipsorganization;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["organization"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="devotee_org";
	$detailsParam["dDataSourceTable"]="devotee_org";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="devotee_org";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="1";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 1;
	$detailsParam["previewOnEdit"]= 1;
	$detailsParam["previewOnView"]= 1;
		
	$detailsTablesData["organization"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["organization"][$dIndex]["masterKeys"][]="OrgId";
		$detailsTablesData["organization"][$dIndex]["detailKeys"][]="OrgId";

	
// tables which are master tables for current table (detail)
$masterTablesData["organization"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_organization()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "OrgId,   OrgName,   OrgOwnerId,   Location";
$proto0["m_strFrom"] = "FROM `organization`";
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
	"m_strName" => "OrgId",
	"m_strTable" => "organization"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "OrgName",
	"m_strTable" => "organization"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "OrgOwnerId",
	"m_strTable" => "organization"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Location",
	"m_strTable" => "organization"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto13=array();
$proto13["m_link"] = "SQLL_MAIN";
			$proto14=array();
$proto14["m_strName"] = "organization";
$proto14["m_columns"] = array();
$proto14["m_columns"][] = "OrgId";
$proto14["m_columns"][] = "OrgName";
$proto14["m_columns"][] = "OrgOwnerId";
$proto14["m_columns"][] = "Location";
$obj = new SQLTable($proto14);

$proto13["m_table"] = $obj;
$proto13["m_alias"] = "";
$proto15=array();
$proto15["m_sql"] = "";
$proto15["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto15["m_column"]=$obj;
$proto15["m_contained"] = array();
$proto15["m_strCase"] = "";
$proto15["m_havingmode"] = "0";
$proto15["m_inBrackets"] = "0";
$proto15["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto15);

$proto13["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto13);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_organization = createSqlQuery_organization();
				$tdataorganization[".sqlquery"] = $queryData_organization;
	
if(isset($tdataorganization["field2"])){
	$tdataorganization["field2"]["LookupTable"] = "carscars_view";
	$tdataorganization["field2"]["LookupOrderBy"] = "name";
	$tdataorganization["field2"]["LookupType"] = 4;
	$tdataorganization["field2"]["LinkField"] = "email";
	$tdataorganization["field2"]["DisplayField"] = "name";
	$tdataorganization[".hasCustomViewField"] = true;
}

$tableEvents["organization"] = new eventsBase;
$tdataorganization[".hasEvents"] = false;

$cipherer = new RunnerCipherer("organization");

?>