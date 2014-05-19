<?php
require_once(getabspath("classes/cipherer.php"));
$tdatadevotee_company = array();
	$tdatadevotee_company[".NumberOfChars"] = 80; 
	$tdatadevotee_company[".ShortName"] = "devotee_company";
	$tdatadevotee_company[".OwnerID"] = "";
	$tdatadevotee_company[".OriginalTable"] = "devotee_company";

//	field labels
$fieldLabelsdevotee_company = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsdevotee_company["English"] = array();
	$fieldToolTipsdevotee_company["English"] = array();
	$fieldLabelsdevotee_company["English"]["DevoteeCompanyId"] = "Devotee Company Id";
	$fieldToolTipsdevotee_company["English"]["DevoteeCompanyId"] = "";
	$fieldLabelsdevotee_company["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsdevotee_company["English"]["DevoteeId"] = "";
	$fieldLabelsdevotee_company["English"]["CompanyId"] = "Company";
	$fieldToolTipsdevotee_company["English"]["CompanyId"] = "";
	$fieldLabelsdevotee_company["English"]["FromDate"] = "From Date";
	$fieldToolTipsdevotee_company["English"]["FromDate"] = "";
	$fieldLabelsdevotee_company["English"]["ToDate"] = "To Date";
	$fieldToolTipsdevotee_company["English"]["ToDate"] = "";
	$fieldLabelsdevotee_company["English"]["Designation"] = "Designation";
	$fieldToolTipsdevotee_company["English"]["Designation"] = "";
	if (count($fieldToolTipsdevotee_company["English"]))
		$tdatadevotee_company[".isUseToolTips"] = true;
}
	
	
	$tdatadevotee_company[".NCSearch"] = true;



$tdatadevotee_company[".shortTableName"] = "devotee_company";
$tdatadevotee_company[".nSecOptions"] = 0;
$tdatadevotee_company[".recsPerRowList"] = 1;
$tdatadevotee_company[".mainTableOwnerID"] = "";
$tdatadevotee_company[".moveNext"] = 1;
$tdatadevotee_company[".nType"] = 0;

$tdatadevotee_company[".strOriginalTableName"] = "devotee_company";




$tdatadevotee_company[".showAddInPopup"] = true;

$tdatadevotee_company[".showEditInPopup"] = true;

$tdatadevotee_company[".showViewInPopup"] = true;

$tdatadevotee_company[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatadevotee_company[".listAjax"] = true;
else 
	$tdatadevotee_company[".listAjax"] = false;

	$tdatadevotee_company[".audit"] = false;

	$tdatadevotee_company[".locking"] = false;

$tdatadevotee_company[".listIcons"] = true;
$tdatadevotee_company[".edit"] = true;
$tdatadevotee_company[".inlineEdit"] = true;
$tdatadevotee_company[".inlineAdd"] = true;
$tdatadevotee_company[".copy"] = true;
$tdatadevotee_company[".view"] = true;

$tdatadevotee_company[".exportTo"] = true;

$tdatadevotee_company[".printFriendly"] = true;

$tdatadevotee_company[".delete"] = true;

$tdatadevotee_company[".showSimpleSearchOptions"] = true;

$tdatadevotee_company[".showSearchPanel"] = true;

if (isMobile())
	$tdatadevotee_company[".isUseAjaxSuggest"] = false;
else 
	$tdatadevotee_company[".isUseAjaxSuggest"] = true;

$tdatadevotee_company[".rowHighlite"] = true;

// button handlers file names

$tdatadevotee_company[".addPageEvents"] = false;

// use timepicker for search panel
$tdatadevotee_company[".isUseTimeForSearch"] = false;




$tdatadevotee_company[".allSearchFields"] = array();

$tdatadevotee_company[".allSearchFields"][] = "DevoteeId";
$tdatadevotee_company[".allSearchFields"][] = "CompanyId";
$tdatadevotee_company[".allSearchFields"][] = "FromDate";
$tdatadevotee_company[".allSearchFields"][] = "ToDate";
$tdatadevotee_company[".allSearchFields"][] = "Designation";

$tdatadevotee_company[".googleLikeFields"][] = "DevoteeCompanyId";
$tdatadevotee_company[".googleLikeFields"][] = "DevoteeId";
$tdatadevotee_company[".googleLikeFields"][] = "CompanyId";
$tdatadevotee_company[".googleLikeFields"][] = "FromDate";
$tdatadevotee_company[".googleLikeFields"][] = "ToDate";
$tdatadevotee_company[".googleLikeFields"][] = "Designation";


$tdatadevotee_company[".advSearchFields"][] = "DevoteeId";
$tdatadevotee_company[".advSearchFields"][] = "CompanyId";
$tdatadevotee_company[".advSearchFields"][] = "FromDate";
$tdatadevotee_company[".advSearchFields"][] = "ToDate";
$tdatadevotee_company[".advSearchFields"][] = "Designation";

$tdatadevotee_company[".isTableType"] = "list";

	
$tdatadevotee_company[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main



$tdatadevotee_company[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatadevotee_company[".strOrderBy"] = $tstrOrderBy;

$tdatadevotee_company[".orderindexes"] = array();

$tdatadevotee_company[".sqlHead"] = "SELECT DevoteeCompanyId,  DevoteeId,  CompanyId,  FromDate,  ToDate,  Designation";
$tdatadevotee_company[".sqlFrom"] = "FROM devotee_company";
$tdatadevotee_company[".sqlWhereExpr"] = "";
$tdatadevotee_company[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadevotee_company[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadevotee_company[".arrGroupsPerPage"] = $arrGPP;

$tableKeysdevotee_company = array();
$tableKeysdevotee_company[] = "DevoteeCompanyId";
$tdatadevotee_company[".Keys"] = $tableKeysdevotee_company;

$tdatadevotee_company[".listFields"] = array();
$tdatadevotee_company[".listFields"][] = "CompanyId";
$tdatadevotee_company[".listFields"][] = "FromDate";
$tdatadevotee_company[".listFields"][] = "ToDate";
$tdatadevotee_company[".listFields"][] = "Designation";

$tdatadevotee_company[".viewFields"] = array();
$tdatadevotee_company[".viewFields"][] = "DevoteeCompanyId";
$tdatadevotee_company[".viewFields"][] = "DevoteeId";
$tdatadevotee_company[".viewFields"][] = "CompanyId";
$tdatadevotee_company[".viewFields"][] = "FromDate";
$tdatadevotee_company[".viewFields"][] = "ToDate";
$tdatadevotee_company[".viewFields"][] = "Designation";

$tdatadevotee_company[".addFields"] = array();
$tdatadevotee_company[".addFields"][] = "CompanyId";
$tdatadevotee_company[".addFields"][] = "FromDate";
$tdatadevotee_company[".addFields"][] = "ToDate";
$tdatadevotee_company[".addFields"][] = "Designation";

$tdatadevotee_company[".inlineAddFields"] = array();
$tdatadevotee_company[".inlineAddFields"][] = "CompanyId";
$tdatadevotee_company[".inlineAddFields"][] = "FromDate";
$tdatadevotee_company[".inlineAddFields"][] = "ToDate";
$tdatadevotee_company[".inlineAddFields"][] = "Designation";

$tdatadevotee_company[".editFields"] = array();
$tdatadevotee_company[".editFields"][] = "CompanyId";
$tdatadevotee_company[".editFields"][] = "FromDate";
$tdatadevotee_company[".editFields"][] = "ToDate";
$tdatadevotee_company[".editFields"][] = "Designation";

$tdatadevotee_company[".inlineEditFields"] = array();
$tdatadevotee_company[".inlineEditFields"][] = "CompanyId";
$tdatadevotee_company[".inlineEditFields"][] = "FromDate";
$tdatadevotee_company[".inlineEditFields"][] = "ToDate";
$tdatadevotee_company[".inlineEditFields"][] = "Designation";

$tdatadevotee_company[".exportFields"] = array();
$tdatadevotee_company[".exportFields"][] = "CompanyId";
$tdatadevotee_company[".exportFields"][] = "FromDate";
$tdatadevotee_company[".exportFields"][] = "ToDate";
$tdatadevotee_company[".exportFields"][] = "Designation";

$tdatadevotee_company[".printFields"] = array();
$tdatadevotee_company[".printFields"][] = "CompanyId";
$tdatadevotee_company[".printFields"][] = "FromDate";
$tdatadevotee_company[".printFields"][] = "ToDate";
$tdatadevotee_company[".printFields"][] = "Designation";

//	DevoteeCompanyId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DevoteeCompanyId";
	$fdata["GoodName"] = "DevoteeCompanyId";
	$fdata["ownerTable"] = "devotee_company";
	$fdata["Label"] = "Devotee Company Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		
		
		$fdata["strField"] = "DevoteeCompanyId"; 
		$fdata["FullName"] = "DevoteeCompanyId";
	
		
		
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
	
		
		
	$tdatadevotee_company["DevoteeCompanyId"] = $fdata;
//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee_company";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "DevoteeId";
	
		
		
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
	
		
		
	$tdatadevotee_company["DevoteeId"] = $fdata;
//	CompanyId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "CompanyId";
	$fdata["GoodName"] = "CompanyId";
	$fdata["ownerTable"] = "devotee_company";
	$fdata["Label"] = "Company"; 
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
	
		$fdata["strField"] = "CompanyId"; 
		$fdata["FullName"] = "CompanyId";
	
		
		
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
	$edata["autoCompleteFields"][] = array('masterF'=>"Location", 'lookupF'=>"CompanyLocation");
				if(strpos(GetUserPermissions("devotee_company"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "CompanyId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "CompanyName";
	
		
	$edata["LookupTable"] = "company";
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
	
		
		
	$tdatadevotee_company["CompanyId"] = $fdata;
//	FromDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "FromDate";
	$fdata["GoodName"] = "FromDate";
	$fdata["ownerTable"] = "devotee_company";
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
	
		
		
	$tdatadevotee_company["FromDate"] = $fdata;
//	ToDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "ToDate";
	$fdata["GoodName"] = "ToDate";
	$fdata["ownerTable"] = "devotee_company";
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
	
		
		
	$tdatadevotee_company["ToDate"] = $fdata;
//	Designation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Designation";
	$fdata["GoodName"] = "Designation";
	$fdata["ownerTable"] = "devotee_company";
	$fdata["Label"] = "Designation"; 
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
	
		$fdata["strField"] = "Designation"; 
		$fdata["FullName"] = "Designation";
	
		
		
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
	
		
		
	$tdatadevotee_company["Designation"] = $fdata;

	
$tables_data["devotee_company"]=&$tdatadevotee_company;
$field_labels["devotee_company"] = &$fieldLabelsdevotee_company;
$fieldToolTips["devotee_company"] = &$fieldToolTipsdevotee_company;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["devotee_company"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["devotee_company"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="devotee";
	$masterParams["mDataSourceTable"]="devotee";
	$masterParams["mOriginalTable"]= $strOriginalDetailsTable;
	$masterParams["mShortTable"]= "devotee";
	$masterParams["masterKeys"]= array();
	$masterParams["detailKeys"]= array();
	$masterParams["dispChildCount"]= "1";
	$masterParams["hideChild"]= "0";
	$masterParams["dispInfo"]= "1";
	$masterParams["previewOnList"]= 1;
	$masterParams["previewOnAdd"]= 1;
	$masterParams["previewOnEdit"]= 1;
	$masterParams["previewOnView"]= 1;
	$masterTablesData["devotee_company"][$mIndex] = $masterParams;	
		$masterTablesData["devotee_company"][$mIndex]["masterKeys"][]="DevoteeId";
		$masterTablesData["devotee_company"][$mIndex]["detailKeys"][]="DevoteeId";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_devotee_company()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "DevoteeCompanyId,  DevoteeId,  CompanyId,  FromDate,  ToDate,  Designation";
$proto0["m_strFrom"] = "FROM devotee_company";
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
	"m_strName" => "DevoteeCompanyId",
	"m_strTable" => "devotee_company"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee_company"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "CompanyId",
	"m_strTable" => "devotee_company"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "FromDate",
	"m_strTable" => "devotee_company"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "ToDate",
	"m_strTable" => "devotee_company"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Designation",
	"m_strTable" => "devotee_company"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto17=array();
$proto17["m_link"] = "SQLL_MAIN";
			$proto18=array();
$proto18["m_strName"] = "devotee_company";
$proto18["m_columns"] = array();
$proto18["m_columns"][] = "DevoteeCompanyId";
$proto18["m_columns"][] = "DevoteeId";
$proto18["m_columns"][] = "CompanyId";
$proto18["m_columns"][] = "FromDate";
$proto18["m_columns"][] = "ToDate";
$proto18["m_columns"][] = "Designation";
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
$queryData_devotee_company = createSqlQuery_devotee_company();
						$tdatadevotee_company[".sqlquery"] = $queryData_devotee_company;
	
if(isset($tdatadevotee_company["field2"])){
	$tdatadevotee_company["field2"]["LookupTable"] = "carscars_view";
	$tdatadevotee_company["field2"]["LookupOrderBy"] = "name";
	$tdatadevotee_company["field2"]["LookupType"] = 4;
	$tdatadevotee_company["field2"]["LinkField"] = "email";
	$tdatadevotee_company["field2"]["DisplayField"] = "name";
	$tdatadevotee_company[".hasCustomViewField"] = true;
}

$tableEvents["devotee_company"] = new eventsBase;
$tdatadevotee_company[".hasEvents"] = false;

$cipherer = new RunnerCipherer("devotee_company");

?>