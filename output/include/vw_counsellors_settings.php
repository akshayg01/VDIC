<?php
require_once(getabspath("classes/cipherer.php"));
$tdatavw_counsellors = array();
	$tdatavw_counsellors[".NumberOfChars"] = 80; 
	$tdatavw_counsellors[".ShortName"] = "vw_counsellors";
	$tdatavw_counsellors[".OwnerID"] = "";
	$tdatavw_counsellors[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsvw_counsellors = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_counsellors["English"] = array();
	$fieldToolTipsvw_counsellors["English"] = array();
	$fieldLabelsvw_counsellors["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_counsellors["English"]["DevoteeId"] = "";
	$fieldLabelsvw_counsellors["English"]["InitiatedName"] = "Initiated Name";
	$fieldToolTipsvw_counsellors["English"]["InitiatedName"] = "";
	$fieldLabelsvw_counsellors["English"]["CounsellorDevoteeID"] = "Counsellor Devotee ID";
	$fieldToolTipsvw_counsellors["English"]["CounsellorDevoteeID"] = "";
	if (count($fieldToolTipsvw_counsellors["English"]))
		$tdatavw_counsellors[".isUseToolTips"] = true;
}
	
	
	$tdatavw_counsellors[".NCSearch"] = true;



$tdatavw_counsellors[".shortTableName"] = "vw_counsellors";
$tdatavw_counsellors[".nSecOptions"] = 0;
$tdatavw_counsellors[".recsPerRowList"] = 1;
$tdatavw_counsellors[".mainTableOwnerID"] = "";
$tdatavw_counsellors[".moveNext"] = 1;
$tdatavw_counsellors[".nType"] = 1;

$tdatavw_counsellors[".strOriginalTableName"] = "devotee";




$tdatavw_counsellors[".showAddInPopup"] = true;

$tdatavw_counsellors[".showEditInPopup"] = true;

$tdatavw_counsellors[".showViewInPopup"] = true;

$tdatavw_counsellors[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatavw_counsellors[".listAjax"] = true;
else 
	$tdatavw_counsellors[".listAjax"] = false;

	$tdatavw_counsellors[".audit"] = true;

	$tdatavw_counsellors[".locking"] = false;

$tdatavw_counsellors[".listIcons"] = true;




$tdatavw_counsellors[".showSimpleSearchOptions"] = true;

$tdatavw_counsellors[".showSearchPanel"] = true;

if (isMobile())
	$tdatavw_counsellors[".isUseAjaxSuggest"] = false;
else 
	$tdatavw_counsellors[".isUseAjaxSuggest"] = true;

$tdatavw_counsellors[".rowHighlite"] = true;

// button handlers file names

$tdatavw_counsellors[".addPageEvents"] = false;

// use timepicker for search panel
$tdatavw_counsellors[".isUseTimeForSearch"] = false;




$tdatavw_counsellors[".allSearchFields"] = array();


$tdatavw_counsellors[".googleLikeFields"][] = "InitiatedName";
$tdatavw_counsellors[".googleLikeFields"][] = "DevoteeId";



$tdatavw_counsellors[".isTableType"] = "list";

	
$tdatavw_counsellors[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main



$tdatavw_counsellors[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatavw_counsellors[".strOrderBy"] = $tstrOrderBy;

$tdatavw_counsellors[".orderindexes"] = array();

$tdatavw_counsellors[".sqlHead"] = "SELECT InitiatedName,  DevoteeId";
$tdatavw_counsellors[".sqlFrom"] = "FROM devotee";
$tdatavw_counsellors[".sqlWhereExpr"] = "(IsCounsellor = True)";
$tdatavw_counsellors[".sqlTail"] = "";

//fill array of tabs for edit page
$arrEditTabs = array();
	$tabFields = array();
	$tabFields[] = "InitiatedName";
$arrEditTabs[] = array('tabId'=>'Primary_Info1',
					   'tabName'=>"Primary Info",
					   'nType'=>'0',
					   'nOrder'=>1,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Phone1',
					   'tabName'=>"Contact Info",
					   'nType'=>'0',
					   'nOrder'=>11,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Address1',
					   'tabName'=>"Address",
					   'nType'=>'0',
					   'nOrder'=>16,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Marital_Status1',
					   'tabName'=>"Marital Status",
					   'nType'=>'0',
					   'nOrder'=>17,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Extra_Info1',
					   'tabName'=>"Extra Info",
					   'nType'=>'0',
					   'nOrder'=>21,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Work_Experience1',
					   'tabName'=>"Professional Info",
					   'nType'=>'0',
					   'nOrder'=>25,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Spiritual_Life1',
					   'tabName'=>"Spiritual Life",
					   'nType'=>'0',
					   'nOrder'=>26,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Family_Members1',
					   'tabName'=>"Family Members",
					   'nType'=>'0',
					   'nOrder'=>37,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Devotee_Donation1',
					   'tabName'=>"Donations",
					   'nType'=>'0',
					   'nOrder'=>38,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Language1',
					   'tabName'=>"Language",
					   'nType'=>'0',
					   'nOrder'=>39,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Organization1',
					   'tabName'=>"Organization",
					   'nType'=>'0',
					   'nOrder'=>40,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Login_Access1',
					   'tabName'=>"Login Access",
					   'nType'=>'0',
					   'nOrder'=>41,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
$tdatavw_counsellors[".arrEditTabs"] = $arrEditTabs;

//fill array of tabs for add page
$arrAddTabs = array();
	$tabFields = array();
	$tabFields[] = "InitiatedName";
$arrAddTabs[] = array('tabId'=>'Primary_Info1',
					  'tabName'=>"Primary Info",
					  'nType'=>'0',
					  'nOrder'=>1,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Phone1',
					  'tabName'=>"Contact Info",
					  'nType'=>'0',
					  'nOrder'=>11,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Address1',
					  'tabName'=>"Address",
					  'nType'=>'0',
					  'nOrder'=>16,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Marital_Status1',
					  'tabName'=>"Marital Status",
					  'nType'=>'0',
					  'nOrder'=>18,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Extra_Info1',
					  'tabName'=>"Extra Info",
					  'nType'=>'0',
					  'nOrder'=>22,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Work_Experience1',
					  'tabName'=>"Professional Info",
					  'nType'=>'0',
					  'nOrder'=>26,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Spiritual_Life1',
					  'tabName'=>"Spiritual Life",
					  'nType'=>'0',
					  'nOrder'=>28,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Family_Members1',
					  'tabName'=>"Family Members",
					  'nType'=>'0',
					  'nOrder'=>39,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Devotee_Donation1',
					  'tabName'=>"Donations",
					  'nType'=>'0',
					  'nOrder'=>41,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Language1',
					  'tabName'=>"Language",
					  'nType'=>'0',
					  'nOrder'=>43,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Organization1',
					  'tabName'=>"Organization",
					  'nType'=>'0',
					  'nOrder'=>45,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
$arrAddTabs[] = array('tabId'=>'Login_Access1',
					  'tabName'=>"Login Access",
					  'nType'=>'0',
					  'nOrder'=>47,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
$tdatavw_counsellors[".arrAddTabs"] = $arrAddTabs;

//fill array of tabs for view page
$arrViewTabs = array();
	$tabFields = array();
	$tabFields[] = "InitiatedName";
$arrViewTabs[] = array('tabId'=>'Primary_Info1',
					   'tabName'=>"Primary Info",
					   'nType'=>'0',
					   'nOrder'=>1,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Phone1',
					   'tabName'=>"Contact Info",
					   'nType'=>'0',
					   'nOrder'=>11,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Address1',
					   'tabName'=>"Address",
					   'nType'=>'0',
					   'nOrder'=>16,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Marital_Status1',
					   'tabName'=>"Marital Status",
					   'nType'=>'0',
					   'nOrder'=>18,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Extra_Info1',
					   'tabName'=>"Extra Info",
					   'nType'=>'0',
					   'nOrder'=>22,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Work_Experience1',
					   'tabName'=>"Professional Info",
					   'nType'=>'0',
					   'nOrder'=>26,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Spiritual_Life1',
					   'tabName'=>"Spiritual Life",
					   'nType'=>'0',
					   'nOrder'=>28,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Family_Members1',
					   'tabName'=>"Family Members",
					   'nType'=>'0',
					   'nOrder'=>39,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Devotee_Donation1',
					   'tabName'=>"Donations",
					   'nType'=>'0',
					   'nOrder'=>41,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Language1',
					   'tabName'=>"Language",
					   'nType'=>'0',
					   'nOrder'=>43,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Organization1',
					   'tabName'=>"Organization",
					   'nType'=>'0',
					   'nOrder'=>45,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Login_Access1',
					   'tabName'=>"Login Access",
					   'nType'=>'0',
					   'nOrder'=>47,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
$tdatavw_counsellors[".arrViewTabs"] = $arrViewTabs;

//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_counsellors[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_counsellors[".arrGroupsPerPage"] = $arrGPP;

$tableKeysvw_counsellors = array();
$tableKeysvw_counsellors[] = "DevoteeId";
$tdatavw_counsellors[".Keys"] = $tableKeysvw_counsellors;

$tdatavw_counsellors[".listFields"] = array();
$tdatavw_counsellors[".listFields"][] = "InitiatedName";

$tdatavw_counsellors[".viewFields"] = array();

$tdatavw_counsellors[".addFields"] = array();

$tdatavw_counsellors[".inlineAddFields"] = array();

$tdatavw_counsellors[".editFields"] = array();

$tdatavw_counsellors[".inlineEditFields"] = array();

$tdatavw_counsellors[".exportFields"] = array();

$tdatavw_counsellors[".printFields"] = array();

//	InitiatedName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "InitiatedName";
	$fdata["GoodName"] = "InitiatedName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Initiated Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		
		
		
		$fdata["strField"] = "InitiatedName"; 
		$fdata["FullName"] = "InitiatedName";
	
		
		
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
	
		
		
	$tdatavw_counsellors["InitiatedName"] = $fdata;
//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		
		
		
		
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
	
		
		
	$tdatavw_counsellors["DevoteeId"] = $fdata;

	
$tables_data["vw_counsellors"]=&$tdatavw_counsellors;
$field_labels["vw_counsellors"] = &$fieldLabelsvw_counsellors;
$fieldToolTips["vw_counsellors"] = &$fieldToolTipsvw_counsellors;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_counsellors"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["vw_counsellors"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_vw_counsellors()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "InitiatedName,  DevoteeId";
$proto0["m_strFrom"] = "FROM devotee";
$proto0["m_strWhere"] = "(IsCounsellor = True)";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = null;
$proto1=array();
$proto1["m_sql"] = "IsCounsellor = True";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "IsCounsellor",
	"m_strTable" => "devotee"
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "= True";
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
	"m_strName" => "InitiatedName",
	"m_strTable" => "devotee"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "devotee";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "DevoteeId";
$proto10["m_columns"][] = "TitleId";
$proto10["m_columns"][] = "Photo";
$proto10["m_columns"][] = "FirstName";
$proto10["m_columns"][] = "LastName";
$proto10["m_columns"][] = "MiddleName";
$proto10["m_columns"][] = "Gender";
$proto10["m_columns"][] = "DateOfBirth";
$proto10["m_columns"][] = "MaritalStatusId";
$proto10["m_columns"][] = "DateofMarriage";
$proto10["m_columns"][] = "SpouseDevoteeId";
$proto10["m_columns"][] = "MobilePhone";
$proto10["m_columns"][] = "WorkPhone";
$proto10["m_columns"][] = "EmailPrimary";
$proto10["m_columns"][] = "EmailSecondary";
$proto10["m_columns"][] = "Password";
$proto10["m_columns"][] = "active";
$proto10["m_columns"][] = "CounsellorDevoteeID";
$proto10["m_columns"][] = "IsCounsellor";
$proto10["m_columns"][] = "NativeCity";
$proto10["m_columns"][] = "NativeState";
$proto10["m_columns"][] = "BloodGroup";
$proto10["m_columns"][] = "DateOfHarinamInitiation";
$proto10["m_columns"][] = "DateOfBrahmanInitiation";
$proto10["m_columns"][] = "SpiritualMasterId";
$proto10["m_columns"][] = "PreviousReligion";
$proto10["m_columns"][] = "Chanting16RoundsSince";
$proto10["m_columns"][] = "IntroducedBy";
$proto10["m_columns"][] = "YearOfIntroduction";
$proto10["m_columns"][] = "IntroducedInCenter";
$proto10["m_columns"][] = "PreferedServices";
$proto10["m_columns"][] = "ServicesRendered";
$proto10["m_columns"][] = "InitiatedName";
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
$queryData_vw_counsellors = createSqlQuery_vw_counsellors();
		$tdatavw_counsellors[".sqlquery"] = $queryData_vw_counsellors;
	
if(isset($tdatavw_counsellors["field2"])){
	$tdatavw_counsellors["field2"]["LookupTable"] = "carscars_view";
	$tdatavw_counsellors["field2"]["LookupOrderBy"] = "name";
	$tdatavw_counsellors["field2"]["LookupType"] = 4;
	$tdatavw_counsellors["field2"]["LinkField"] = "email";
	$tdatavw_counsellors["field2"]["DisplayField"] = "name";
	$tdatavw_counsellors[".hasCustomViewField"] = true;
}

include_once(getabspath("include/vw_counsellors_events.php"));
$tableEvents["vw_counsellors"] = new eventclass_vw_counsellors;
$tdatavw_counsellors[".hasEvents"] = true;

$cipherer = new RunnerCipherer("vw_counsellors");

?>