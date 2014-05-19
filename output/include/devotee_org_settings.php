<?php
require_once(getabspath("classes/cipherer.php"));
$tdatadevotee_org = array();
	$tdatadevotee_org[".NumberOfChars"] = 80; 
	$tdatadevotee_org[".ShortName"] = "devotee_org";
	$tdatadevotee_org[".OwnerID"] = "";
	$tdatadevotee_org[".OriginalTable"] = "devotee_org";

//	field labels
$fieldLabelsdevotee_org = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsdevotee_org["English"] = array();
	$fieldToolTipsdevotee_org["English"] = array();
	$fieldLabelsdevotee_org["English"]["DevoteeOrgId"] = "Devotee Org Id";
	$fieldToolTipsdevotee_org["English"]["DevoteeOrgId"] = "";
	$fieldLabelsdevotee_org["English"]["OrgId"] = "Org Id";
	$fieldToolTipsdevotee_org["English"]["OrgId"] = "";
	$fieldLabelsdevotee_org["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsdevotee_org["English"]["DevoteeId"] = "";
	$fieldLabelsdevotee_org["English"]["FromDate"] = "From Date";
	$fieldToolTipsdevotee_org["English"]["FromDate"] = "";
	$fieldLabelsdevotee_org["English"]["ToDate"] = "To Date";
	$fieldToolTipsdevotee_org["English"]["ToDate"] = "";
	$fieldLabelsdevotee_org["English"]["Role"] = "Role";
	$fieldToolTipsdevotee_org["English"]["Role"] = "";
	if (count($fieldToolTipsdevotee_org["English"]))
		$tdatadevotee_org[".isUseToolTips"] = true;
}
	
	
	$tdatadevotee_org[".NCSearch"] = true;



$tdatadevotee_org[".shortTableName"] = "devotee_org";
$tdatadevotee_org[".nSecOptions"] = 0;
$tdatadevotee_org[".recsPerRowList"] = 1;
$tdatadevotee_org[".mainTableOwnerID"] = "";
$tdatadevotee_org[".moveNext"] = 1;
$tdatadevotee_org[".nType"] = 0;

$tdatadevotee_org[".strOriginalTableName"] = "devotee_org";




$tdatadevotee_org[".showAddInPopup"] = true;

$tdatadevotee_org[".showEditInPopup"] = true;

$tdatadevotee_org[".showViewInPopup"] = true;

$tdatadevotee_org[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatadevotee_org[".listAjax"] = true;
else 
	$tdatadevotee_org[".listAjax"] = false;

	$tdatadevotee_org[".audit"] = true;

	$tdatadevotee_org[".locking"] = false;

$tdatadevotee_org[".listIcons"] = true;
$tdatadevotee_org[".edit"] = true;
$tdatadevotee_org[".inlineEdit"] = true;
$tdatadevotee_org[".inlineAdd"] = true;
$tdatadevotee_org[".copy"] = true;
$tdatadevotee_org[".view"] = true;

$tdatadevotee_org[".exportTo"] = true;

$tdatadevotee_org[".printFriendly"] = true;

$tdatadevotee_org[".delete"] = true;

$tdatadevotee_org[".showSimpleSearchOptions"] = true;

$tdatadevotee_org[".showSearchPanel"] = true;

if (isMobile())
	$tdatadevotee_org[".isUseAjaxSuggest"] = false;
else 
	$tdatadevotee_org[".isUseAjaxSuggest"] = true;

$tdatadevotee_org[".rowHighlite"] = true;

// button handlers file names

$tdatadevotee_org[".addPageEvents"] = false;

// use timepicker for search panel
$tdatadevotee_org[".isUseTimeForSearch"] = false;




$tdatadevotee_org[".allSearchFields"] = array();

$tdatadevotee_org[".allSearchFields"][] = "OrgId";
$tdatadevotee_org[".allSearchFields"][] = "FromDate";
$tdatadevotee_org[".allSearchFields"][] = "ToDate";
$tdatadevotee_org[".allSearchFields"][] = "Role";

$tdatadevotee_org[".googleLikeFields"][] = "DevoteeOrgId";
$tdatadevotee_org[".googleLikeFields"][] = "OrgId";
$tdatadevotee_org[".googleLikeFields"][] = "DevoteeId";
$tdatadevotee_org[".googleLikeFields"][] = "FromDate";
$tdatadevotee_org[".googleLikeFields"][] = "ToDate";
$tdatadevotee_org[".googleLikeFields"][] = "Role";

$tdatadevotee_org[".panelSearchFields"][] = "DevoteeOrgId";
$tdatadevotee_org[".panelSearchFields"][] = "OrgId";
$tdatadevotee_org[".panelSearchFields"][] = "DevoteeId";
$tdatadevotee_org[".panelSearchFields"][] = "FromDate";
$tdatadevotee_org[".panelSearchFields"][] = "ToDate";

$tdatadevotee_org[".advSearchFields"][] = "OrgId";
$tdatadevotee_org[".advSearchFields"][] = "FromDate";
$tdatadevotee_org[".advSearchFields"][] = "ToDate";
$tdatadevotee_org[".advSearchFields"][] = "Role";

$tdatadevotee_org[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatadevotee_org[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatadevotee_org[".strOrderBy"] = $tstrOrderBy;

$tdatadevotee_org[".orderindexes"] = array();

$tdatadevotee_org[".sqlHead"] = "SELECT DevoteeOrgId,   OrgId,   DevoteeId,   FromDate,   ToDate,   `Role`";
$tdatadevotee_org[".sqlFrom"] = "FROM devotee_org";
$tdatadevotee_org[".sqlWhereExpr"] = "";
$tdatadevotee_org[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadevotee_org[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadevotee_org[".arrGroupsPerPage"] = $arrGPP;

$tableKeysdevotee_org = array();
$tableKeysdevotee_org[] = "DevoteeOrgId";
$tdatadevotee_org[".Keys"] = $tableKeysdevotee_org;

$tdatadevotee_org[".listFields"] = array();
$tdatadevotee_org[".listFields"][] = "Role";
$tdatadevotee_org[".listFields"][] = "OrgId";
$tdatadevotee_org[".listFields"][] = "FromDate";
$tdatadevotee_org[".listFields"][] = "ToDate";

$tdatadevotee_org[".viewFields"] = array();
$tdatadevotee_org[".viewFields"][] = "OrgId";
$tdatadevotee_org[".viewFields"][] = "FromDate";
$tdatadevotee_org[".viewFields"][] = "ToDate";
$tdatadevotee_org[".viewFields"][] = "Role";

$tdatadevotee_org[".addFields"] = array();
$tdatadevotee_org[".addFields"][] = "OrgId";
$tdatadevotee_org[".addFields"][] = "FromDate";
$tdatadevotee_org[".addFields"][] = "ToDate";
$tdatadevotee_org[".addFields"][] = "Role";

$tdatadevotee_org[".inlineAddFields"] = array();
$tdatadevotee_org[".inlineAddFields"][] = "Role";
$tdatadevotee_org[".inlineAddFields"][] = "OrgId";
$tdatadevotee_org[".inlineAddFields"][] = "FromDate";
$tdatadevotee_org[".inlineAddFields"][] = "ToDate";

$tdatadevotee_org[".editFields"] = array();
$tdatadevotee_org[".editFields"][] = "OrgId";
$tdatadevotee_org[".editFields"][] = "FromDate";
$tdatadevotee_org[".editFields"][] = "ToDate";
$tdatadevotee_org[".editFields"][] = "Role";

$tdatadevotee_org[".inlineEditFields"] = array();
$tdatadevotee_org[".inlineEditFields"][] = "Role";
$tdatadevotee_org[".inlineEditFields"][] = "OrgId";
$tdatadevotee_org[".inlineEditFields"][] = "FromDate";
$tdatadevotee_org[".inlineEditFields"][] = "ToDate";

$tdatadevotee_org[".exportFields"] = array();
$tdatadevotee_org[".exportFields"][] = "OrgId";
$tdatadevotee_org[".exportFields"][] = "FromDate";
$tdatadevotee_org[".exportFields"][] = "ToDate";
$tdatadevotee_org[".exportFields"][] = "Role";

$tdatadevotee_org[".printFields"] = array();
$tdatadevotee_org[".printFields"][] = "OrgId";
$tdatadevotee_org[".printFields"][] = "FromDate";
$tdatadevotee_org[".printFields"][] = "ToDate";
$tdatadevotee_org[".printFields"][] = "Role";

//	DevoteeOrgId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DevoteeOrgId";
	$fdata["GoodName"] = "DevoteeOrgId";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "Devotee Org Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DevoteeOrgId"; 
		$fdata["FullName"] = "DevoteeOrgId";
	
		
		
				
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
	
		
		
	$tdatadevotee_org["DevoteeOrgId"] = $fdata;
//	OrgId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "OrgId";
	$fdata["GoodName"] = "OrgId";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "Org Id"; 
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
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 2;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
			
	$edata["LinkField"] = "OrgId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "OrgName";
	
		
	$edata["LookupTable"] = "organization";
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
	
		
		
	$tdatadevotee_org["OrgId"] = $fdata;
//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "DevoteeId";
	
		
		
				
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
	
		
		
	$tdatadevotee_org["DevoteeId"] = $fdata;
//	FromDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "FromDate";
	$fdata["GoodName"] = "FromDate";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "From Date"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "FromDate"; 
		$fdata["FullName"] = "FromDate";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_org["FromDate"] = $fdata;
//	ToDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "ToDate";
	$fdata["GoodName"] = "ToDate";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "To Date"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ToDate"; 
		$fdata["FullName"] = "ToDate";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_org["ToDate"] = $fdata;
//	Role
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Role";
	$fdata["GoodName"] = "Role";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "Role"; 
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
	
		$fdata["strField"] = "Role"; 
		$fdata["FullName"] = "`Role`";
	
		
		
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
					$edata["LookupType"] = 0;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				$edata["LCType"] = 4;
			
		$edata["HorizontalLookup"] = true;
	
		
		$edata["LookupValues"] = array();
	$edata["LookupValues"][] = "Leader";
	$edata["LookupValues"][] = "Member";

	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_org["Role"] = $fdata;

	
$tables_data["devotee_org"]=&$tdatadevotee_org;
$field_labels["devotee_org"] = &$fieldLabelsdevotee_org;
$fieldToolTips["devotee_org"] = &$fieldToolTipsdevotee_org;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["devotee_org"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["devotee_org"] = array();

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
	$masterParams["previewOnAdd"]= 1;
	$masterParams["previewOnEdit"]= 1;
	$masterParams["previewOnView"]= 1;
	$masterTablesData["devotee_org"][$mIndex] = $masterParams;	
		$masterTablesData["devotee_org"][$mIndex]["masterKeys"][]="DevoteeId";
		$masterTablesData["devotee_org"][$mIndex]["detailKeys"][]="DevoteeId";

$mIndex = 2-1;
			$strOriginalDetailsTable="organization";
	$masterParams["mDataSourceTable"]="organization";
	$masterParams["mOriginalTable"]= $strOriginalDetailsTable;
	$masterParams["mShortTable"]= "organization";
	$masterParams["masterKeys"]= array();
	$masterParams["detailKeys"]= array();
	$masterParams["dispChildCount"]= "1";
	$masterParams["hideChild"]= "1";
	$masterParams["dispInfo"]= "0";
	$masterParams["previewOnList"]= 1;
	$masterParams["previewOnAdd"]= 1;
	$masterParams["previewOnEdit"]= 1;
	$masterParams["previewOnView"]= 1;
	$masterTablesData["devotee_org"][$mIndex] = $masterParams;	
		$masterTablesData["devotee_org"][$mIndex]["masterKeys"][]="OrgId";
		$masterTablesData["devotee_org"][$mIndex]["detailKeys"][]="OrgId";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_devotee_org()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DevoteeOrgId,   OrgId,   DevoteeId,   FromDate,   ToDate,   `Role`";
$proto0["m_strFrom"] = "FROM devotee_org";
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
	"m_strName" => "DevoteeOrgId",
	"m_strTable" => "devotee_org"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "OrgId",
	"m_strTable" => "devotee_org"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee_org"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "FromDate",
	"m_strTable" => "devotee_org"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "ToDate",
	"m_strTable" => "devotee_org"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Role",
	"m_strTable" => "devotee_org"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto17=array();
$proto17["m_link"] = "SQLL_MAIN";
			$proto18=array();
$proto18["m_strName"] = "devotee_org";
$proto18["m_columns"] = array();
$proto18["m_columns"][] = "DevoteeOrgId";
$proto18["m_columns"][] = "OrgId";
$proto18["m_columns"][] = "DevoteeId";
$proto18["m_columns"][] = "FromDate";
$proto18["m_columns"][] = "ToDate";
$proto18["m_columns"][] = "Role";
$obj = new SQLTable($proto18);

$proto17["m_table"] = $obj;
$proto17["m_alias"] = "";
$proto19=array();
$proto19["m_sql"] = "";
$proto19["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto19["m_column"]=$obj;
$proto19["m_contained"] = array();
$proto19["m_strCase"] = "";
$proto19["m_havingmode"] = "0";
$proto19["m_inBrackets"] = "0";
$proto19["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto19);

$proto17["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto17);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_devotee_org = createSqlQuery_devotee_org();
						$tdatadevotee_org[".sqlquery"] = $queryData_devotee_org;
	
if(isset($tdatadevotee_org["field2"])){
	$tdatadevotee_org["field2"]["LookupTable"] = "carscars_view";
	$tdatadevotee_org["field2"]["LookupOrderBy"] = "name";
	$tdatadevotee_org["field2"]["LookupType"] = 4;
	$tdatadevotee_org["field2"]["LinkField"] = "email";
	$tdatadevotee_org["field2"]["DisplayField"] = "name";
	$tdatadevotee_org[".hasCustomViewField"] = true;
}

$tableEvents["devotee_org"] = new eventsBase;
$tdatadevotee_org[".hasEvents"] = false;

$cipherer = new RunnerCipherer("devotee_org");

?>