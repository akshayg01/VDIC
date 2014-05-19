<?php
require_once(getabspath("classes/cipherer.php"));
$tdatadevotee = array();
	$tdatadevotee[".NumberOfChars"] = 80; 
	$tdatadevotee[".ShortName"] = "devotee";
	$tdatadevotee[".OwnerID"] = "";
	$tdatadevotee[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsdevotee = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsdevotee["English"] = array();
	$fieldToolTipsdevotee["English"] = array();
	$fieldLabelsdevotee["English"]["Photo"] = "Photo";
	$fieldToolTipsdevotee["English"]["Photo"] = "";
	$fieldLabelsdevotee["English"]["Gender"] = "Gender";
	$fieldToolTipsdevotee["English"]["Gender"] = "";
	$fieldLabelsdevotee["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsdevotee["English"]["DevoteeId"] = "";
	$fieldLabelsdevotee["English"]["TitleId"] = "Mr / Mrs / Miss";
	$fieldToolTipsdevotee["English"]["TitleId"] = "";
	$fieldLabelsdevotee["English"]["FirstName"] = "First Name";
	$fieldToolTipsdevotee["English"]["FirstName"] = "";
	$fieldLabelsdevotee["English"]["LastName"] = "Last Name";
	$fieldToolTipsdevotee["English"]["LastName"] = "";
	$fieldLabelsdevotee["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsdevotee["English"]["MiddleName"] = "";
	$fieldLabelsdevotee["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsdevotee["English"]["DateOfBirth"] = "";
	$fieldLabelsdevotee["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsdevotee["English"]["MaritalStatusId"] = "";
	$fieldLabelsdevotee["English"]["DateofMarriage"] = "Dateof Marriage";
	$fieldToolTipsdevotee["English"]["DateofMarriage"] = "";
	$fieldLabelsdevotee["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsdevotee["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsdevotee["English"]["MobilePhone"] = "Mobile Number";
	$fieldToolTipsdevotee["English"]["MobilePhone"] = "";
	$fieldLabelsdevotee["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsdevotee["English"]["WorkPhone"] = "";
	$fieldLabelsdevotee["English"]["EmailPrimary"] = "Email";
	$fieldToolTipsdevotee["English"]["EmailPrimary"] = "";
	$fieldLabelsdevotee["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsdevotee["English"]["EmailSecondary"] = "";
	$fieldLabelsdevotee["English"]["Password"] = "Password";
	$fieldToolTipsdevotee["English"]["Password"] = "";
	$fieldLabelsdevotee["English"]["active"] = "Active";
	$fieldToolTipsdevotee["English"]["active"] = "";
	$fieldLabelsdevotee["English"]["CounsellorDevoteeID"] = "Counsellor";
	$fieldToolTipsdevotee["English"]["CounsellorDevoteeID"] = "";
	$fieldLabelsdevotee["English"]["IsCounsellor"] = "Himself/Herself is a Counsellor?";
	$fieldToolTipsdevotee["English"]["IsCounsellor"] = "";
	$fieldLabelsdevotee["English"]["NativeCity"] = "Native City";
	$fieldToolTipsdevotee["English"]["NativeCity"] = "";
	$fieldLabelsdevotee["English"]["NativeState"] = "Native State";
	$fieldToolTipsdevotee["English"]["NativeState"] = "";
	$fieldLabelsdevotee["English"]["BloodGroup"] = "Blood Group";
	$fieldToolTipsdevotee["English"]["BloodGroup"] = "";
	$fieldLabelsdevotee["English"]["DateOfHarinamInitiation"] = "Date Of Harinam Initiation";
	$fieldToolTipsdevotee["English"]["DateOfHarinamInitiation"] = "";
	$fieldLabelsdevotee["English"]["DateOfBrahmanInitiation"] = "Date Of Brahman Initiation";
	$fieldToolTipsdevotee["English"]["DateOfBrahmanInitiation"] = "";
	$fieldLabelsdevotee["English"]["SpiritualMasterId"] = "Spiritual Master Id";
	$fieldToolTipsdevotee["English"]["SpiritualMasterId"] = "";
	$fieldLabelsdevotee["English"]["PreviousReligion"] = "Previous Religion";
	$fieldToolTipsdevotee["English"]["PreviousReligion"] = "";
	$fieldLabelsdevotee["English"]["Chanting16RoundsSince"] = "Chanting16Rounds Since";
	$fieldToolTipsdevotee["English"]["Chanting16RoundsSince"] = "";
	$fieldLabelsdevotee["English"]["IntroducedBy"] = "Introduced By";
	$fieldToolTipsdevotee["English"]["IntroducedBy"] = "";
	$fieldLabelsdevotee["English"]["YearOfIntroduction"] = "Year Of Introduction";
	$fieldToolTipsdevotee["English"]["YearOfIntroduction"] = "";
	$fieldLabelsdevotee["English"]["IntroducedInCenter"] = "Introduced In Center";
	$fieldToolTipsdevotee["English"]["IntroducedInCenter"] = "";
	$fieldLabelsdevotee["English"]["PreferedServices"] = "Prefered Services";
	$fieldToolTipsdevotee["English"]["PreferedServices"] = "";
	$fieldLabelsdevotee["English"]["ServicesRendered"] = "Services Rendered";
	$fieldToolTipsdevotee["English"]["ServicesRendered"] = "";
	$fieldLabelsdevotee["English"]["InitiatedName"] = "Initiated Name";
	$fieldToolTipsdevotee["English"]["InitiatedName"] = "";
	$fieldLabelsdevotee["English"]["FullName"] = "Name";
	$fieldToolTipsdevotee["English"]["FullName"] = "";
	if (count($fieldToolTipsdevotee["English"]))
		$tdatadevotee[".isUseToolTips"] = true;
}
	
	
	$tdatadevotee[".NCSearch"] = true;



$tdatadevotee[".shortTableName"] = "devotee";
$tdatadevotee[".nSecOptions"] = 0;
$tdatadevotee[".recsPerRowList"] = 3;
$tdatadevotee[".mainTableOwnerID"] = "";
$tdatadevotee[".moveNext"] = 1;
$tdatadevotee[".nType"] = 0;

$tdatadevotee[".strOriginalTableName"] = "devotee";

$tdatadevotee[".hasEncryptedFields"] = true;



$tdatadevotee[".showAddInPopup"] = true;

$tdatadevotee[".showEditInPopup"] = true;

$tdatadevotee[".showViewInPopup"] = true;

$tdatadevotee[".fieldsForRegister"] = array();
	//Begin register settings
$tdatadevotee[".fieldsForRegister"][] = "EmailPrimary";
$tdatadevotee[".fieldsForRegister"][] = "";
$tdatadevotee[".fieldsForRegister"][] = "Password";
$tdatadevotee[".fieldsForRegister"][] = "FirstName";
$tdatadevotee[".fieldsForRegister"][] = "LastName";
/*
$tdatadevotee[".PasswordField"] = "Password";
$tdatadevotee[".UserNameField"] = "EmailPrimary";	
*/
//End register settings	

if (!isMobile())
	$tdatadevotee[".listAjax"] = true;
else 
	$tdatadevotee[".listAjax"] = false;

	$tdatadevotee[".audit"] = true;

	$tdatadevotee[".locking"] = false;

$tdatadevotee[".listIcons"] = true;
$tdatadevotee[".edit"] = true;
$tdatadevotee[".view"] = true;


$tdatadevotee[".printFriendly"] = true;


$tdatadevotee[".showSimpleSearchOptions"] = true;

$tdatadevotee[".showSearchPanel"] = true;

if (isMobile())
	$tdatadevotee[".isUseAjaxSuggest"] = false;
else 
	$tdatadevotee[".isUseAjaxSuggest"] = true;

$tdatadevotee[".rowHighlite"] = true;

// button handlers file names

$tdatadevotee[".addPageEvents"] = false;

// use timepicker for search panel
$tdatadevotee[".isUseTimeForSearch"] = false;



$tdatadevotee[".useDetailsPreview"] = true;

$tdatadevotee[".allSearchFields"] = array();

$tdatadevotee[".allSearchFields"][] = "DevoteeId";
$tdatadevotee[".allSearchFields"][] = "FullName";
$tdatadevotee[".allSearchFields"][] = "TitleId";
$tdatadevotee[".allSearchFields"][] = "FirstName";
$tdatadevotee[".allSearchFields"][] = "LastName";
$tdatadevotee[".allSearchFields"][] = "MiddleName";
$tdatadevotee[".allSearchFields"][] = "InitiatedName";
$tdatadevotee[".allSearchFields"][] = "DateOfBirth";
$tdatadevotee[".allSearchFields"][] = "Gender";
$tdatadevotee[".allSearchFields"][] = "CounsellorDevoteeID";
$tdatadevotee[".allSearchFields"][] = "IsCounsellor";
$tdatadevotee[".allSearchFields"][] = "EmailPrimary";
$tdatadevotee[".allSearchFields"][] = "EmailSecondary";
$tdatadevotee[".allSearchFields"][] = "MobilePhone";
$tdatadevotee[".allSearchFields"][] = "WorkPhone";
$tdatadevotee[".allSearchFields"][] = "MaritalStatusId";
$tdatadevotee[".allSearchFields"][] = "DateofMarriage";
$tdatadevotee[".allSearchFields"][] = "SpouseDevoteeId";
$tdatadevotee[".allSearchFields"][] = "NativeCity";
$tdatadevotee[".allSearchFields"][] = "NativeState";
$tdatadevotee[".allSearchFields"][] = "BloodGroup";
$tdatadevotee[".allSearchFields"][] = "YearOfIntroduction";
$tdatadevotee[".allSearchFields"][] = "IntroducedBy";
$tdatadevotee[".allSearchFields"][] = "IntroducedInCenter";
$tdatadevotee[".allSearchFields"][] = "Chanting16RoundsSince";
$tdatadevotee[".allSearchFields"][] = "SpiritualMasterId";
$tdatadevotee[".allSearchFields"][] = "DateOfHarinamInitiation";
$tdatadevotee[".allSearchFields"][] = "DateOfBrahmanInitiation";
$tdatadevotee[".allSearchFields"][] = "PreviousReligion";
$tdatadevotee[".allSearchFields"][] = "PreferedServices";
$tdatadevotee[".allSearchFields"][] = "ServicesRendered";
$tdatadevotee[".allSearchFields"][] = "active";
$tdatadevotee[".allSearchFields"][] = "Password";

$tdatadevotee[".googleLikeFields"][] = "FirstName";
$tdatadevotee[".googleLikeFields"][] = "LastName";
$tdatadevotee[".googleLikeFields"][] = "MiddleName";
$tdatadevotee[".googleLikeFields"][] = "MobilePhone";
$tdatadevotee[".googleLikeFields"][] = "EmailPrimary";


$tdatadevotee[".advSearchFields"][] = "FirstName";
$tdatadevotee[".advSearchFields"][] = "LastName";
$tdatadevotee[".advSearchFields"][] = "MiddleName";
$tdatadevotee[".advSearchFields"][] = "EmailPrimary";
$tdatadevotee[".advSearchFields"][] = "MobilePhone";

$tdatadevotee[".isTableType"] = "list";

	
$tdatadevotee[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main
							


$tdatadevotee[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatadevotee[".strOrderBy"] = $tstrOrderBy;

$tdatadevotee[".orderindexes"] = array();

$tdatadevotee[".sqlHead"] = "SELECT devotee.DevoteeId,  devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID,  devotee.IsCounsellor,  devotee.NativeCity,  devotee.NativeState,  devotee.BloodGroup,  devotee.DateOfHarinamInitiation,  devotee.DateOfBrahmanInitiation,  devotee.SpiritualMasterId,  devotee.PreviousReligion,  devotee.Chanting16RoundsSince,  devotee.IntroducedBy,  devotee.YearOfIntroduction,  devotee.IntroducedInCenter,  devotee.PreferedServices,  devotee.ServicesRendered,  devotee.InitiatedName,  trim(concat(salutations.Salutation,' ',devotee.FirstName,' ',devotee.MiddleName,' ',devotee.LastName)) AS FullName";
$tdatadevotee[".sqlFrom"] = "FROM devotee  LEFT OUTER JOIN lu_salutations AS salutations ON devotee.TitleId = salutations.SalutationId";
$tdatadevotee[".sqlWhereExpr"] = "";
$tdatadevotee[".sqlTail"] = "";

//fill array of tabs for edit page
$arrEditTabs = array();
	$tabFields = array();
	$tabFields[] = "Photo";
	$tabFields[] = "TitleId";
	$tabFields[] = "FirstName";
	$tabFields[] = "LastName";
	$tabFields[] = "MiddleName";
	$tabFields[] = "InitiatedName";
	$tabFields[] = "DateOfBirth";
	$tabFields[] = "Gender";
	$tabFields[] = "CounsellorDevoteeID";
	$tabFields[] = "IsCounsellor";
$arrEditTabs[] = array('tabId'=>'Primary_Info1',
					   'tabName'=>"Primary Info",
					   'nType'=>'0',
					   'nOrder'=>1,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "EmailPrimary";
	$tabFields[] = "EmailSecondary";
	$tabFields[] = "MobilePhone";
	$tabFields[] = "WorkPhone";
$arrEditTabs[] = array('tabId'=>'Phone1',
					   'tabName'=>"Contact Info",
					   'nType'=>'0',
					   'nOrder'=>12,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Address1',
					   'tabName'=>"Address",
					   'nType'=>'0',
					   'nOrder'=>17,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "MaritalStatusId";
	$tabFields[] = "DateofMarriage";
	$tabFields[] = "SpouseDevoteeId";
$arrEditTabs[] = array('tabId'=>'Marital_Status1',
					   'tabName'=>"Marital Status",
					   'nType'=>'0',
					   'nOrder'=>19,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "NativeCity";
	$tabFields[] = "NativeState";
	$tabFields[] = "BloodGroup";
$arrEditTabs[] = array('tabId'=>'Extra_Info1',
					   'tabName'=>"Extra Info",
					   'nType'=>'0',
					   'nOrder'=>23,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Work_Experience1',
					   'tabName'=>"Professional Info",
					   'nType'=>'0',
					   'nOrder'=>27,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "YearOfIntroduction";
	$tabFields[] = "IntroducedBy";
	$tabFields[] = "IntroducedInCenter";
	$tabFields[] = "Chanting16RoundsSince";
	$tabFields[] = "SpiritualMasterId";
	$tabFields[] = "DateOfHarinamInitiation";
	$tabFields[] = "DateOfBrahmanInitiation";
	$tabFields[] = "PreviousReligion";
	$tabFields[] = "PreferedServices";
	$tabFields[] = "ServicesRendered";
$arrEditTabs[] = array('tabId'=>'Spiritual_Life1',
					   'tabName'=>"Spiritual Life",
					   'nType'=>'0',
					   'nOrder'=>29,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Family_Members1',
					   'tabName'=>"Family Members",
					   'nType'=>'0',
					   'nOrder'=>40,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Devotee_Donation1',
					   'tabName'=>"Donations",
					   'nType'=>'0',
					   'nOrder'=>42,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Language1',
					   'tabName'=>"Language",
					   'nType'=>'0',
					   'nOrder'=>44,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrEditTabs[] = array('tabId'=>'Organization1',
					   'tabName'=>"Organization",
					   'nType'=>'0',
					   'nOrder'=>46,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "active";
	$tabFields[] = "Password";
$arrEditTabs[] = array('tabId'=>'Login_Access1',
					   'tabName'=>"Login Access",
					   'nType'=>'0',
					   'nOrder'=>48,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
$tdatadevotee[".arrEditTabs"] = $arrEditTabs;

//fill array of tabs for add page
$arrAddTabs = array();
	$tabFields = array();
	$tabFields[] = "Photo";
	$tabFields[] = "TitleId";
	$tabFields[] = "FirstName";
	$tabFields[] = "LastName";
	$tabFields[] = "MiddleName";
	$tabFields[] = "InitiatedName";
	$tabFields[] = "DateOfBirth";
	$tabFields[] = "Gender";
	$tabFields[] = "CounsellorDevoteeID";
$arrAddTabs[] = array('tabId'=>'Primary_Info1',
					  'tabName'=>"Primary Info",
					  'nType'=>'0',
					  'nOrder'=>1,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "EmailPrimary";
	$tabFields[] = "EmailSecondary";
	$tabFields[] = "MobilePhone";
	$tabFields[] = "WorkPhone";
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
	$tabFields[] = "MaritalStatusId";
	$tabFields[] = "DateofMarriage";
	$tabFields[] = "SpouseDevoteeId";
$arrAddTabs[] = array('tabId'=>'Marital_Status1',
					  'tabName'=>"Marital Status",
					  'nType'=>'0',
					  'nOrder'=>18,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "NativeCity";
	$tabFields[] = "NativeState";
	$tabFields[] = "BloodGroup";
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
	$tabFields[] = "YearOfIntroduction";
	$tabFields[] = "IntroducedBy";
	$tabFields[] = "IntroducedInCenter";
	$tabFields[] = "Chanting16RoundsSince";
	$tabFields[] = "SpiritualMasterId";
	$tabFields[] = "DateOfHarinamInitiation";
	$tabFields[] = "DateOfBrahmanInitiation";
	$tabFields[] = "PreviousReligion";
	$tabFields[] = "PreferedServices";
	$tabFields[] = "ServicesRendered";
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
	$tabFields[] = "active";
	$tabFields[] = "Password";
$arrAddTabs[] = array('tabId'=>'Login_Access1',
					  'tabName'=>"Login Access",
					  'nType'=>'0',
					  'nOrder'=>47,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
$tdatadevotee[".arrAddTabs"] = $arrAddTabs;

//fill array of tabs for view page
$arrViewTabs = array();
	$tabFields = array();
	$tabFields[] = "Photo";
	$tabFields[] = "TitleId";
	$tabFields[] = "FirstName";
	$tabFields[] = "LastName";
	$tabFields[] = "MiddleName";
	$tabFields[] = "InitiatedName";
	$tabFields[] = "DateOfBirth";
	$tabFields[] = "Gender";
	$tabFields[] = "CounsellorDevoteeID";
$arrViewTabs[] = array('tabId'=>'Primary_Info1',
					   'tabName'=>"Primary Info",
					   'nType'=>'0',
					   'nOrder'=>2,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "EmailPrimary";
	$tabFields[] = "EmailSecondary";
	$tabFields[] = "MobilePhone";
	$tabFields[] = "WorkPhone";
$arrViewTabs[] = array('tabId'=>'Phone1',
					   'tabName'=>"Contact Info",
					   'nType'=>'0',
					   'nOrder'=>12,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Address1',
					   'tabName'=>"Address",
					   'nType'=>'0',
					   'nOrder'=>17,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "MaritalStatusId";
	$tabFields[] = "DateofMarriage";
	$tabFields[] = "SpouseDevoteeId";
$arrViewTabs[] = array('tabId'=>'Marital_Status1',
					   'tabName'=>"Marital Status",
					   'nType'=>'0',
					   'nOrder'=>18,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "NativeCity";
	$tabFields[] = "NativeState";
	$tabFields[] = "BloodGroup";
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
	$tabFields[] = "YearOfIntroduction";
	$tabFields[] = "IntroducedBy";
	$tabFields[] = "IntroducedInCenter";
	$tabFields[] = "Chanting16RoundsSince";
	$tabFields[] = "SpiritualMasterId";
	$tabFields[] = "DateOfHarinamInitiation";
	$tabFields[] = "DateOfBrahmanInitiation";
	$tabFields[] = "PreviousReligion";
	$tabFields[] = "PreferedServices";
	$tabFields[] = "ServicesRendered";
$arrViewTabs[] = array('tabId'=>'Spiritual_Life1',
					   'tabName'=>"Spiritual Life",
					   'nType'=>'0',
					   'nOrder'=>27,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Family_Members1',
					   'tabName'=>"Family Members",
					   'nType'=>'0',
					   'nOrder'=>38,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Devotee_Donation1',
					   'tabName'=>"Donations",
					   'nType'=>'0',
					   'nOrder'=>39,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Language1',
					   'tabName'=>"Language",
					   'nType'=>'0',
					   'nOrder'=>40,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
$arrViewTabs[] = array('tabId'=>'Organization1',
					   'tabName'=>"Organization",
					   'nType'=>'0',
					   'nOrder'=>41,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
$tdatadevotee[".arrViewTabs"] = $arrViewTabs;

//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadevotee[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadevotee[".arrGroupsPerPage"] = $arrGPP;

$tableKeysdevotee = array();
$tableKeysdevotee[] = "DevoteeId";
$tdatadevotee[".Keys"] = $tableKeysdevotee;

$tdatadevotee[".listFields"] = array();
$tdatadevotee[".listFields"][] = "FullName";
$tdatadevotee[".listFields"][] = "Photo";
$tdatadevotee[".listFields"][] = "InitiatedName";
$tdatadevotee[".listFields"][] = "EmailPrimary";
$tdatadevotee[".listFields"][] = "MobilePhone";

$tdatadevotee[".viewFields"] = array();
$tdatadevotee[".viewFields"][] = "FullName";
$tdatadevotee[".viewFields"][] = "Photo";
$tdatadevotee[".viewFields"][] = "TitleId";
$tdatadevotee[".viewFields"][] = "FirstName";
$tdatadevotee[".viewFields"][] = "LastName";
$tdatadevotee[".viewFields"][] = "MiddleName";
$tdatadevotee[".viewFields"][] = "InitiatedName";
$tdatadevotee[".viewFields"][] = "DateOfBirth";
$tdatadevotee[".viewFields"][] = "Gender";
$tdatadevotee[".viewFields"][] = "CounsellorDevoteeID";
$tdatadevotee[".viewFields"][] = "EmailPrimary";
$tdatadevotee[".viewFields"][] = "EmailSecondary";
$tdatadevotee[".viewFields"][] = "MobilePhone";
$tdatadevotee[".viewFields"][] = "WorkPhone";
$tdatadevotee[".viewFields"][] = "MaritalStatusId";
$tdatadevotee[".viewFields"][] = "DateofMarriage";
$tdatadevotee[".viewFields"][] = "SpouseDevoteeId";
$tdatadevotee[".viewFields"][] = "NativeCity";
$tdatadevotee[".viewFields"][] = "NativeState";
$tdatadevotee[".viewFields"][] = "BloodGroup";
$tdatadevotee[".viewFields"][] = "YearOfIntroduction";
$tdatadevotee[".viewFields"][] = "IntroducedBy";
$tdatadevotee[".viewFields"][] = "IntroducedInCenter";
$tdatadevotee[".viewFields"][] = "Chanting16RoundsSince";
$tdatadevotee[".viewFields"][] = "SpiritualMasterId";
$tdatadevotee[".viewFields"][] = "DateOfHarinamInitiation";
$tdatadevotee[".viewFields"][] = "DateOfBrahmanInitiation";
$tdatadevotee[".viewFields"][] = "PreviousReligion";
$tdatadevotee[".viewFields"][] = "PreferedServices";
$tdatadevotee[".viewFields"][] = "ServicesRendered";

$tdatadevotee[".addFields"] = array();
$tdatadevotee[".addFields"][] = "Photo";
$tdatadevotee[".addFields"][] = "TitleId";
$tdatadevotee[".addFields"][] = "FirstName";
$tdatadevotee[".addFields"][] = "LastName";
$tdatadevotee[".addFields"][] = "MiddleName";
$tdatadevotee[".addFields"][] = "InitiatedName";
$tdatadevotee[".addFields"][] = "DateOfBirth";
$tdatadevotee[".addFields"][] = "Gender";
$tdatadevotee[".addFields"][] = "CounsellorDevoteeID";
$tdatadevotee[".addFields"][] = "EmailPrimary";
$tdatadevotee[".addFields"][] = "EmailSecondary";
$tdatadevotee[".addFields"][] = "MobilePhone";
$tdatadevotee[".addFields"][] = "WorkPhone";
$tdatadevotee[".addFields"][] = "MaritalStatusId";
$tdatadevotee[".addFields"][] = "DateofMarriage";
$tdatadevotee[".addFields"][] = "SpouseDevoteeId";
$tdatadevotee[".addFields"][] = "NativeCity";
$tdatadevotee[".addFields"][] = "NativeState";
$tdatadevotee[".addFields"][] = "BloodGroup";
$tdatadevotee[".addFields"][] = "YearOfIntroduction";
$tdatadevotee[".addFields"][] = "IntroducedBy";
$tdatadevotee[".addFields"][] = "IntroducedInCenter";
$tdatadevotee[".addFields"][] = "Chanting16RoundsSince";
$tdatadevotee[".addFields"][] = "SpiritualMasterId";
$tdatadevotee[".addFields"][] = "DateOfHarinamInitiation";
$tdatadevotee[".addFields"][] = "DateOfBrahmanInitiation";
$tdatadevotee[".addFields"][] = "PreviousReligion";
$tdatadevotee[".addFields"][] = "PreferedServices";
$tdatadevotee[".addFields"][] = "ServicesRendered";
$tdatadevotee[".addFields"][] = "active";
$tdatadevotee[".addFields"][] = "Password";

$tdatadevotee[".inlineAddFields"] = array();

$tdatadevotee[".editFields"] = array();
$tdatadevotee[".editFields"][] = "Photo";
$tdatadevotee[".editFields"][] = "TitleId";
$tdatadevotee[".editFields"][] = "FirstName";
$tdatadevotee[".editFields"][] = "LastName";
$tdatadevotee[".editFields"][] = "MiddleName";
$tdatadevotee[".editFields"][] = "InitiatedName";
$tdatadevotee[".editFields"][] = "DateOfBirth";
$tdatadevotee[".editFields"][] = "Gender";
$tdatadevotee[".editFields"][] = "CounsellorDevoteeID";
$tdatadevotee[".editFields"][] = "EmailPrimary";
$tdatadevotee[".editFields"][] = "EmailSecondary";
$tdatadevotee[".editFields"][] = "MobilePhone";
$tdatadevotee[".editFields"][] = "WorkPhone";
$tdatadevotee[".editFields"][] = "MaritalStatusId";
$tdatadevotee[".editFields"][] = "DateofMarriage";
$tdatadevotee[".editFields"][] = "SpouseDevoteeId";
$tdatadevotee[".editFields"][] = "NativeCity";
$tdatadevotee[".editFields"][] = "NativeState";
$tdatadevotee[".editFields"][] = "BloodGroup";
$tdatadevotee[".editFields"][] = "YearOfIntroduction";
$tdatadevotee[".editFields"][] = "IntroducedBy";
$tdatadevotee[".editFields"][] = "IntroducedInCenter";
$tdatadevotee[".editFields"][] = "Chanting16RoundsSince";
$tdatadevotee[".editFields"][] = "SpiritualMasterId";
$tdatadevotee[".editFields"][] = "DateOfHarinamInitiation";
$tdatadevotee[".editFields"][] = "DateOfBrahmanInitiation";
$tdatadevotee[".editFields"][] = "PreviousReligion";
$tdatadevotee[".editFields"][] = "PreferedServices";
$tdatadevotee[".editFields"][] = "ServicesRendered";
$tdatadevotee[".editFields"][] = "active";
$tdatadevotee[".editFields"][] = "Password";

$tdatadevotee[".inlineEditFields"] = array();

$tdatadevotee[".exportFields"] = array();

$tdatadevotee[".printFields"] = array();
$tdatadevotee[".printFields"][] = "DevoteeId";
$tdatadevotee[".printFields"][] = "FullName";
$tdatadevotee[".printFields"][] = "Photo";
$tdatadevotee[".printFields"][] = "TitleId";
$tdatadevotee[".printFields"][] = "FirstName";
$tdatadevotee[".printFields"][] = "LastName";
$tdatadevotee[".printFields"][] = "MiddleName";
$tdatadevotee[".printFields"][] = "InitiatedName";
$tdatadevotee[".printFields"][] = "DateOfBirth";
$tdatadevotee[".printFields"][] = "Gender";
$tdatadevotee[".printFields"][] = "CounsellorDevoteeID";
$tdatadevotee[".printFields"][] = "EmailPrimary";
$tdatadevotee[".printFields"][] = "EmailSecondary";
$tdatadevotee[".printFields"][] = "MobilePhone";
$tdatadevotee[".printFields"][] = "WorkPhone";
$tdatadevotee[".printFields"][] = "MaritalStatusId";
$tdatadevotee[".printFields"][] = "DateofMarriage";
$tdatadevotee[".printFields"][] = "SpouseDevoteeId";
$tdatadevotee[".printFields"][] = "NativeCity";
$tdatadevotee[".printFields"][] = "NativeState";
$tdatadevotee[".printFields"][] = "BloodGroup";
$tdatadevotee[".printFields"][] = "YearOfIntroduction";
$tdatadevotee[".printFields"][] = "IntroducedBy";
$tdatadevotee[".printFields"][] = "IntroducedInCenter";
$tdatadevotee[".printFields"][] = "Chanting16RoundsSince";
$tdatadevotee[".printFields"][] = "SpiritualMasterId";
$tdatadevotee[".printFields"][] = "DateOfHarinamInitiation";
$tdatadevotee[".printFields"][] = "DateOfBrahmanInitiation";
$tdatadevotee[".printFields"][] = "PreviousReligion";
$tdatadevotee[".printFields"][] = "PreferedServices";
$tdatadevotee[".printFields"][] = "ServicesRendered";

//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee.DevoteeId";
	
		
		
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
	
		
		
	$tdatadevotee["DevoteeId"] = $fdata;
//	TitleId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "TitleId";
	$fdata["GoodName"] = "TitleId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Mr / Mrs / Miss"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "TitleId"; 
		$fdata["FullName"] = "devotee.TitleId";
	
		
		
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
				
		
			
	$edata["LinkField"] = "SalutationId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "salutation";
	
		
	$edata["LookupTable"] = "lu_salutations";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		$edata["AllowToAdd"] = true; 
	
				
	
	
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
									//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["TitleId"] = $fdata;
//	Photo
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Photo";
	$fdata["GoodName"] = "Photo";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Photo"; 
	$fdata["FieldType"] = 128;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "Photo"; 
		$fdata["FullName"] = "devotee.Photo";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Database Image");
	
		
		
				$vdata["ImageWidth"] = 0;
	$vdata["ImageHeight"] = 0;
	
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Database image");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
									//	End validation
	
		
				$edata["ResizeImage"] = true;
				$edata["NewSize"] = 100;
	
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["Photo"] = $fdata;
//	FirstName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "FirstName";
	$fdata["GoodName"] = "FirstName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "First Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "FirstName"; 
		$fdata["FullName"] = "devotee.FirstName";
	
		
		
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
	
		
		
	$tdatadevotee["FirstName"] = $fdata;
//	LastName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "LastName";
	$fdata["GoodName"] = "LastName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Last Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "LastName"; 
		$fdata["FullName"] = "devotee.LastName";
	
		
		
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
	
		
		
	$tdatadevotee["LastName"] = $fdata;
//	MiddleName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "MiddleName";
	$fdata["GoodName"] = "MiddleName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Middle Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "MiddleName"; 
		$fdata["FullName"] = "devotee.MiddleName";
	
		
		
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
	
		
		
	$tdatadevotee["MiddleName"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Gender"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "Gender"; 
		$fdata["FullName"] = "devotee.Gender";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Checkbox");
	
		
		
		
			
		
		
		
		
		
		
		
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
	$edata["LookupValues"][] = "Male";
	$edata["LookupValues"][] = "Female";

	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
									//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["Gender"] = $fdata;
//	DateOfBirth
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "DateOfBirth";
	$fdata["GoodName"] = "DateOfBirth";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Birth"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "DateOfBirth"; 
		$fdata["FullName"] = "devotee.DateOfBirth";
	
		
		
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
	
		
		
	$tdatadevotee["DateOfBirth"] = $fdata;
//	MaritalStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "MaritalStatusId";
	$fdata["GoodName"] = "MaritalStatusId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Marital Status Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "MaritalStatusId"; 
		$fdata["FullName"] = "devotee.MaritalStatusId";
	
		
		
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
				
		
			
	$edata["LinkField"] = "MaritalStatusId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "MaritalStatus";
	
		
	$edata["LookupTable"] = "lu_marital_status";
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
	
		
		
	$tdatadevotee["MaritalStatusId"] = $fdata;
//	DateofMarriage
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "DateofMarriage";
	$fdata["GoodName"] = "DateofMarriage";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Dateof Marriage"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "DateofMarriage"; 
		$fdata["FullName"] = "devotee.DateofMarriage";
	
		
		
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
	
		
		
	$tdatadevotee["DateofMarriage"] = $fdata;
//	SpouseDevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "SpouseDevoteeId";
	$fdata["GoodName"] = "SpouseDevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Spouse Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "SpouseDevoteeId"; 
		$fdata["FullName"] = "devotee.SpouseDevoteeId";
	
		
		
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
				if(strpos(GetUserPermissions("devotee"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "DevoteeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "FullName";
	
		
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
	
		
		
	$tdatadevotee["SpouseDevoteeId"] = $fdata;
//	MobilePhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "MobilePhone";
	$fdata["GoodName"] = "MobilePhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Mobile Number"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "MobilePhone"; 
		$fdata["FullName"] = "devotee.MobilePhone";
	
		
		
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
	
		
		
		$edata["strEditMask"] = "9999999999"; 

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
	
		
		
	$tdatadevotee["MobilePhone"] = $fdata;
//	WorkPhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "WorkPhone";
	$fdata["GoodName"] = "WorkPhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Work Phone"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "WorkPhone"; 
		$fdata["FullName"] = "devotee.WorkPhone";
	
		
		
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
	
		
		
	$tdatadevotee["WorkPhone"] = $fdata;
//	EmailPrimary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "EmailPrimary";
	$fdata["GoodName"] = "EmailPrimary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "EmailPrimary"; 
		$fdata["FullName"] = "devotee.EmailPrimary";
	
		
		
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
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Email");	
						
							if(count($edata["validateAs"]) && !in_array('IsRequired', $edata["validateAs"]['basicValidate']))
		$edata["validateAs"]['basicValidate'][] = 'IsRequired';
				if(count($edata["validateAs"]) && !in_array('IsEmail', $edata["validateAs"]['basicValidate']))
		$edata["validateAs"]['basicValidate'][] = 'IsEmail';
//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["EmailPrimary"] = $fdata;
//	EmailSecondary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "EmailSecondary";
	$fdata["GoodName"] = "EmailSecondary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Secondary"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "EmailSecondary"; 
		$fdata["FullName"] = "devotee.EmailSecondary";
	
		
		
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
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Email");	
						
									//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["EmailSecondary"] = $fdata;
//	Password
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "Password";
	$fdata["GoodName"] = "Password";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Password"; 
	$fdata["FieldType"] = 200;
	
		
		$fdata["bIsEncrypted"] = true; 
	
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Password"; 
		$fdata["FullName"] = "devotee.Password";
	
		
		
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
		
							if(count($edata["validateAs"]) && !in_array('IsRequired', $edata["validateAs"]['basicValidate']))
		$edata["validateAs"]['basicValidate'][] = 'IsRequired';
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["Password"] = $fdata;
//	active
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "active";
	$fdata["GoodName"] = "active";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Active"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "active"; 
		$fdata["FullName"] = "devotee.active";
	
		
		
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Checkbox");
	
		
		
		
			
		
		
		
		
		
		
		
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Checkbox");
	
		
		$edata["AutoUpdate"] = true; 
	
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
									//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["active"] = $fdata;
//	CounsellorDevoteeID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "CounsellorDevoteeID";
	$fdata["GoodName"] = "CounsellorDevoteeID";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Counsellor"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "CounsellorDevoteeID"; 
		$fdata["FullName"] = "devotee.CounsellorDevoteeID";
	
		
		
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
				
		
			
	$edata["LinkField"] = "DevoteeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "InitiatedName";
	
		
	$edata["LookupTable"] = "vw_counsellors";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
				
	
	
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
									//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["CounsellorDevoteeID"] = $fdata;
//	IsCounsellor
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "IsCounsellor";
	$fdata["GoodName"] = "IsCounsellor";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Himself/Herself is a Counsellor?"; 
	$fdata["FieldType"] = 16;
	
		
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "IsCounsellor"; 
		$fdata["FullName"] = "devotee.IsCounsellor";
	
		
		
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
				$edata["LCType"] = 4;
			
		$edata["HorizontalLookup"] = true;
	
			
	$edata["LinkField"] = "IsCounsellorId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "IsCounsellor";
	
		
	$edata["LookupTable"] = "lu_iscounsellor";
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
	
		
		
	$tdatadevotee["IsCounsellor"] = $fdata;
//	NativeCity
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "NativeCity";
	$fdata["GoodName"] = "NativeCity";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Native City"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "NativeCity"; 
		$fdata["FullName"] = "devotee.NativeCity";
	
		
		
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
	
		
		
	$tdatadevotee["NativeCity"] = $fdata;
//	NativeState
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "NativeState";
	$fdata["GoodName"] = "NativeState";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Native State"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "NativeState"; 
		$fdata["FullName"] = "devotee.NativeState";
	
		
		
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
	
		
		
	$tdatadevotee["NativeState"] = $fdata;
//	BloodGroup
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 22;
	$fdata["strName"] = "BloodGroup";
	$fdata["GoodName"] = "BloodGroup";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Blood Group"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "BloodGroup"; 
		$fdata["FullName"] = "devotee.BloodGroup";
	
		
		
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
	
		
		
	$tdatadevotee["BloodGroup"] = $fdata;
//	DateOfHarinamInitiation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 23;
	$fdata["strName"] = "DateOfHarinamInitiation";
	$fdata["GoodName"] = "DateOfHarinamInitiation";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Harinam Initiation"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "DateOfHarinamInitiation"; 
		$fdata["FullName"] = "devotee.DateOfHarinamInitiation";
	
		
		
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
	
		
		
	$tdatadevotee["DateOfHarinamInitiation"] = $fdata;
//	DateOfBrahmanInitiation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 24;
	$fdata["strName"] = "DateOfBrahmanInitiation";
	$fdata["GoodName"] = "DateOfBrahmanInitiation";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Brahman Initiation"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "DateOfBrahmanInitiation"; 
		$fdata["FullName"] = "devotee.DateOfBrahmanInitiation";
	
		
		
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
	
		
		
	$tdatadevotee["DateOfBrahmanInitiation"] = $fdata;
//	SpiritualMasterId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 25;
	$fdata["strName"] = "SpiritualMasterId";
	$fdata["GoodName"] = "SpiritualMasterId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Spiritual Master Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "SpiritualMasterId"; 
		$fdata["FullName"] = "devotee.SpiritualMasterId";
	
		
		
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
				if(strpos(GetUserPermissions("devotee"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "SpiritualMasterId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "Name";
	
		
	$edata["LookupTable"] = "spiritualmaster";
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
	
		
		
	$tdatadevotee["SpiritualMasterId"] = $fdata;
//	PreviousReligion
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 26;
	$fdata["strName"] = "PreviousReligion";
	$fdata["GoodName"] = "PreviousReligion";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Previous Religion"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "PreviousReligion"; 
		$fdata["FullName"] = "devotee.PreviousReligion";
	
		
		
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
	
		
		
	$tdatadevotee["PreviousReligion"] = $fdata;
//	Chanting16RoundsSince
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 27;
	$fdata["strName"] = "Chanting16RoundsSince";
	$fdata["GoodName"] = "Chanting16RoundsSince";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Chanting16Rounds Since"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "Chanting16RoundsSince"; 
		$fdata["FullName"] = "devotee.Chanting16RoundsSince";
	
		
		
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
	
		
		
	$tdatadevotee["Chanting16RoundsSince"] = $fdata;
//	IntroducedBy
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 28;
	$fdata["strName"] = "IntroducedBy";
	$fdata["GoodName"] = "IntroducedBy";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Introduced By"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "IntroducedBy"; 
		$fdata["FullName"] = "devotee.IntroducedBy";
	
		
		
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
	
		
		
	$tdatadevotee["IntroducedBy"] = $fdata;
//	YearOfIntroduction
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 29;
	$fdata["strName"] = "YearOfIntroduction";
	$fdata["GoodName"] = "YearOfIntroduction";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Year Of Introduction"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "YearOfIntroduction"; 
		$fdata["FullName"] = "devotee.YearOfIntroduction";
	
		
		
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
	
		
		
	$tdatadevotee["YearOfIntroduction"] = $fdata;
//	IntroducedInCenter
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 30;
	$fdata["strName"] = "IntroducedInCenter";
	$fdata["GoodName"] = "IntroducedInCenter";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Introduced In Center"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "IntroducedInCenter"; 
		$fdata["FullName"] = "devotee.IntroducedInCenter";
	
		
		
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
	
		
		
	$tdatadevotee["IntroducedInCenter"] = $fdata;
//	PreferedServices
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 31;
	$fdata["strName"] = "PreferedServices";
	$fdata["GoodName"] = "PreferedServices";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Prefered Services"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "PreferedServices"; 
		$fdata["FullName"] = "devotee.PreferedServices";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
									//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["PreferedServices"] = $fdata;
//	ServicesRendered
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 32;
	$fdata["strName"] = "ServicesRendered";
	$fdata["GoodName"] = "ServicesRendered";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Services Rendered"; 
	$fdata["FieldType"] = 201;
	
		
		
		
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "ServicesRendered"; 
		$fdata["FullName"] = "devotee.ServicesRendered";
	
		
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 100;
			$edata["nCols"] = 200;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
									//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee["ServicesRendered"] = $fdata;
//	InitiatedName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 33;
	$fdata["strName"] = "InitiatedName";
	$fdata["GoodName"] = "InitiatedName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Initiated Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "InitiatedName"; 
		$fdata["FullName"] = "devotee.InitiatedName";
	
		
		
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
	
		
		
	$tdatadevotee["InitiatedName"] = $fdata;
//	FullName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 34;
	$fdata["strName"] = "FullName";
	$fdata["GoodName"] = "FullName";
	$fdata["ownerTable"] = "";
	$fdata["Label"] = "Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		
		$fdata["strField"] = "FullName"; 
		$fdata["FullName"] = "trim(concat(salutations.Salutation,' ',devotee.FirstName,' ',devotee.MiddleName,' ',devotee.LastName))";
	
		
		
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
	
		
		
	$tdatadevotee["FullName"] = $fdata;

	
$tables_data["devotee"]=&$tdatadevotee;
$field_labels["devotee"] = &$fieldLabelsdevotee;
$fieldToolTips["devotee"] = &$fieldToolTipsdevotee;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["devotee"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="devotee_address";
	$detailsParam["dDataSourceTable"]="devotee_address";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="devotee_address";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="0";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 1;
	$detailsParam["previewOnEdit"]= 1;
	$detailsParam["previewOnView"]= 1;
		
	$detailsTablesData["devotee"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["devotee"][$dIndex]["masterKeys"][]="DevoteeId";
		$detailsTablesData["devotee"][$dIndex]["detailKeys"][]="DevoteeId";

$dIndex = 2-1;
			$strOriginalDetailsTable="devotee_donation";
	$detailsParam["dDataSourceTable"]="devotee_donation";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="devotee_donation";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="1";
	$detailsParam["previewOnList"]= 0;
	$detailsParam["previewOnAdd"]= 1;
	$detailsParam["previewOnEdit"]= 1;
	$detailsParam["previewOnView"]= 1;
		
	$detailsTablesData["devotee"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["devotee"][$dIndex]["masterKeys"][]="DevoteeId";
		$detailsTablesData["devotee"][$dIndex]["detailKeys"][]="DevoteeId";

$dIndex = 3-1;
			$strOriginalDetailsTable="devotee_language";
	$detailsParam["dDataSourceTable"]="devotee_language";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="devotee_language";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="1";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 1;
	$detailsParam["previewOnEdit"]= 1;
	$detailsParam["previewOnView"]= 1;
		
	$detailsTablesData["devotee"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["devotee"][$dIndex]["masterKeys"][]="DevoteeId";
		$detailsTablesData["devotee"][$dIndex]["detailKeys"][]="DevoteeId";

$dIndex = 4-1;
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
		
	$detailsTablesData["devotee"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["devotee"][$dIndex]["masterKeys"][]="DevoteeId";
		$detailsTablesData["devotee"][$dIndex]["detailKeys"][]="DevoteeId";

$dIndex = 5-1;
			$strOriginalDetailsTable="devotee_family_member";
	$detailsParam["dDataSourceTable"]="devotee_family_member";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="devotee_family_member";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="0";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 1;
	$detailsParam["previewOnEdit"]= 1;
	$detailsParam["previewOnView"]= 1;
		
	$detailsTablesData["devotee"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["devotee"][$dIndex]["masterKeys"][]="DevoteeId";
		$detailsTablesData["devotee"][$dIndex]["detailKeys"][]="DevoteeIdFamilyOwner";

$dIndex = 6-1;
			$strOriginalDetailsTable="devotee_company";
	$detailsParam["dDataSourceTable"]="devotee_company";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="devotee_company";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="0";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 1;
	$detailsParam["previewOnEdit"]= 1;
	$detailsParam["previewOnView"]= 1;
		
	$detailsTablesData["devotee"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["devotee"][$dIndex]["masterKeys"][]="DevoteeId";
		$detailsTablesData["devotee"][$dIndex]["detailKeys"][]="DevoteeId";

$dIndex = 7-1;
			$strOriginalDetailsTable="counsellor_counsellee";
	$detailsParam["dDataSourceTable"]="counsellor_counsellee";
	$detailsParam["dOriginalTable"]=$strOriginalDetailsTable;
	$detailsParam["dShortTable"]="counsellor_counsellee";
	$detailsParam["masterKeys"]=array();
	$detailsParam["detailKeys"]=array();
	$detailsParam["dispChildCount"]= "1";
	$detailsParam["hideChild"]="1";
	$detailsParam["previewOnList"]= 1;
	$detailsParam["previewOnAdd"]= 0;
	$detailsParam["previewOnEdit"]= 0;
	$detailsParam["previewOnView"]= 0;
		
	$detailsTablesData["devotee"][$dIndex] = $detailsParam;
	
		
		$detailsTablesData["devotee"][$dIndex]["masterKeys"][]="DevoteeId";
		$detailsTablesData["devotee"][$dIndex]["detailKeys"][]="CounsellorDevoteeID";

	
// tables which are master tables for current table (detail)
$masterTablesData["devotee"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_devotee()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "devotee.DevoteeId,  devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID,  devotee.IsCounsellor,  devotee.NativeCity,  devotee.NativeState,  devotee.BloodGroup,  devotee.DateOfHarinamInitiation,  devotee.DateOfBrahmanInitiation,  devotee.SpiritualMasterId,  devotee.PreviousReligion,  devotee.Chanting16RoundsSince,  devotee.IntroducedBy,  devotee.YearOfIntroduction,  devotee.IntroducedInCenter,  devotee.PreferedServices,  devotee.ServicesRendered,  devotee.InitiatedName,  trim(concat(salutations.Salutation,' ',devotee.FirstName,' ',devotee.MiddleName,' ',devotee.LastName)) AS FullName";
$proto0["m_strFrom"] = "FROM devotee  LEFT OUTER JOIN lu_salutations AS salutations ON devotee.TitleId = salutations.SalutationId";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("devotee");
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
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "devotee"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Photo",
	"m_strTable" => "devotee"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "FirstName",
	"m_strTable" => "devotee"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "LastName",
	"m_strTable" => "devotee"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "MiddleName",
	"m_strTable" => "devotee"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Gender",
	"m_strTable" => "devotee"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "DateOfBirth",
	"m_strTable" => "devotee"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "MaritalStatusId",
	"m_strTable" => "devotee"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "DateofMarriage",
	"m_strTable" => "devotee"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "SpouseDevoteeId",
	"m_strTable" => "devotee"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "MobilePhone",
	"m_strTable" => "devotee"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "WorkPhone",
	"m_strTable" => "devotee"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailPrimary",
	"m_strTable" => "devotee"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailSecondary",
	"m_strTable" => "devotee"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "Password",
	"m_strTable" => "devotee"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
			$obj = new SQLField(array(
	"m_strName" => "active",
	"m_strTable" => "devotee"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
			$obj = new SQLField(array(
	"m_strName" => "CounsellorDevoteeID",
	"m_strTable" => "devotee"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
						$proto41=array();
			$obj = new SQLField(array(
	"m_strName" => "IsCounsellor",
	"m_strTable" => "devotee"
));

$proto41["m_expr"]=$obj;
$proto41["m_alias"] = "";
$obj = new SQLFieldListItem($proto41);

$proto0["m_fieldlist"][]=$obj;
						$proto43=array();
			$obj = new SQLField(array(
	"m_strName" => "NativeCity",
	"m_strTable" => "devotee"
));

$proto43["m_expr"]=$obj;
$proto43["m_alias"] = "";
$obj = new SQLFieldListItem($proto43);

$proto0["m_fieldlist"][]=$obj;
						$proto45=array();
			$obj = new SQLField(array(
	"m_strName" => "NativeState",
	"m_strTable" => "devotee"
));

$proto45["m_expr"]=$obj;
$proto45["m_alias"] = "";
$obj = new SQLFieldListItem($proto45);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
			$obj = new SQLField(array(
	"m_strName" => "BloodGroup",
	"m_strTable" => "devotee"
));

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
						$proto49=array();
			$obj = new SQLField(array(
	"m_strName" => "DateOfHarinamInitiation",
	"m_strTable" => "devotee"
));

$proto49["m_expr"]=$obj;
$proto49["m_alias"] = "";
$obj = new SQLFieldListItem($proto49);

$proto0["m_fieldlist"][]=$obj;
						$proto51=array();
			$obj = new SQLField(array(
	"m_strName" => "DateOfBrahmanInitiation",
	"m_strTable" => "devotee"
));

$proto51["m_expr"]=$obj;
$proto51["m_alias"] = "";
$obj = new SQLFieldListItem($proto51);

$proto0["m_fieldlist"][]=$obj;
						$proto53=array();
			$obj = new SQLField(array(
	"m_strName" => "SpiritualMasterId",
	"m_strTable" => "devotee"
));

$proto53["m_expr"]=$obj;
$proto53["m_alias"] = "";
$obj = new SQLFieldListItem($proto53);

$proto0["m_fieldlist"][]=$obj;
						$proto55=array();
			$obj = new SQLField(array(
	"m_strName" => "PreviousReligion",
	"m_strTable" => "devotee"
));

$proto55["m_expr"]=$obj;
$proto55["m_alias"] = "";
$obj = new SQLFieldListItem($proto55);

$proto0["m_fieldlist"][]=$obj;
						$proto57=array();
			$obj = new SQLField(array(
	"m_strName" => "Chanting16RoundsSince",
	"m_strTable" => "devotee"
));

$proto57["m_expr"]=$obj;
$proto57["m_alias"] = "";
$obj = new SQLFieldListItem($proto57);

$proto0["m_fieldlist"][]=$obj;
						$proto59=array();
			$obj = new SQLField(array(
	"m_strName" => "IntroducedBy",
	"m_strTable" => "devotee"
));

$proto59["m_expr"]=$obj;
$proto59["m_alias"] = "";
$obj = new SQLFieldListItem($proto59);

$proto0["m_fieldlist"][]=$obj;
						$proto61=array();
			$obj = new SQLField(array(
	"m_strName" => "YearOfIntroduction",
	"m_strTable" => "devotee"
));

$proto61["m_expr"]=$obj;
$proto61["m_alias"] = "";
$obj = new SQLFieldListItem($proto61);

$proto0["m_fieldlist"][]=$obj;
						$proto63=array();
			$obj = new SQLField(array(
	"m_strName" => "IntroducedInCenter",
	"m_strTable" => "devotee"
));

$proto63["m_expr"]=$obj;
$proto63["m_alias"] = "";
$obj = new SQLFieldListItem($proto63);

$proto0["m_fieldlist"][]=$obj;
						$proto65=array();
			$obj = new SQLField(array(
	"m_strName" => "PreferedServices",
	"m_strTable" => "devotee"
));

$proto65["m_expr"]=$obj;
$proto65["m_alias"] = "";
$obj = new SQLFieldListItem($proto65);

$proto0["m_fieldlist"][]=$obj;
						$proto67=array();
			$obj = new SQLField(array(
	"m_strName" => "ServicesRendered",
	"m_strTable" => "devotee"
));

$proto67["m_expr"]=$obj;
$proto67["m_alias"] = "";
$obj = new SQLFieldListItem($proto67);

$proto0["m_fieldlist"][]=$obj;
						$proto69=array();
			$obj = new SQLField(array(
	"m_strName" => "InitiatedName",
	"m_strTable" => "devotee"
));

$proto69["m_expr"]=$obj;
$proto69["m_alias"] = "";
$obj = new SQLFieldListItem($proto69);

$proto0["m_fieldlist"][]=$obj;
						$proto71=array();
			$proto72=array();
$proto72["m_functiontype"] = "SQLF_CUSTOM";
$proto72["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "concat(salutations.Salutation,' ',devotee.FirstName,' ',devotee.MiddleName,' ',devotee.LastName)"
));

$proto72["m_arguments"][]=$obj;
$proto72["m_strFunctionName"] = "trim";
$obj = new SQLFunctionCall($proto72);

$proto71["m_expr"]=$obj;
$proto71["m_alias"] = "FullName";
$obj = new SQLFieldListItem($proto71);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto74=array();
$proto74["m_link"] = "SQLL_MAIN";
			$proto75=array();
$proto75["m_strName"] = "devotee";
$proto75["m_columns"] = array();
$proto75["m_columns"][] = "DevoteeId";
$proto75["m_columns"][] = "TitleId";
$proto75["m_columns"][] = "Photo";
$proto75["m_columns"][] = "FirstName";
$proto75["m_columns"][] = "LastName";
$proto75["m_columns"][] = "MiddleName";
$proto75["m_columns"][] = "Gender";
$proto75["m_columns"][] = "DateOfBirth";
$proto75["m_columns"][] = "MaritalStatusId";
$proto75["m_columns"][] = "DateofMarriage";
$proto75["m_columns"][] = "SpouseDevoteeId";
$proto75["m_columns"][] = "MobilePhone";
$proto75["m_columns"][] = "WorkPhone";
$proto75["m_columns"][] = "EmailPrimary";
$proto75["m_columns"][] = "EmailSecondary";
$proto75["m_columns"][] = "Password";
$proto75["m_columns"][] = "active";
$proto75["m_columns"][] = "CounsellorDevoteeID";
$proto75["m_columns"][] = "IsCounsellor";
$proto75["m_columns"][] = "NativeCity";
$proto75["m_columns"][] = "NativeState";
$proto75["m_columns"][] = "BloodGroup";
$proto75["m_columns"][] = "DateOfHarinamInitiation";
$proto75["m_columns"][] = "DateOfBrahmanInitiation";
$proto75["m_columns"][] = "SpiritualMasterId";
$proto75["m_columns"][] = "PreviousReligion";
$proto75["m_columns"][] = "Chanting16RoundsSince";
$proto75["m_columns"][] = "IntroducedBy";
$proto75["m_columns"][] = "YearOfIntroduction";
$proto75["m_columns"][] = "IntroducedInCenter";
$proto75["m_columns"][] = "PreferedServices";
$proto75["m_columns"][] = "ServicesRendered";
$proto75["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto75);

$proto74["m_table"] = $obj;
$proto74["m_alias"] = "";
$proto76=array();
$proto76["m_sql"] = "";
$proto76["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto76["m_column"]=$obj;
$proto76["m_contained"] = array();
$proto76["m_strCase"] = "";
$proto76["m_havingmode"] = "0";
$proto76["m_inBrackets"] = "0";
$proto76["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto76);

$proto74["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto74);

$proto0["m_fromlist"][]=$obj;
												$proto78=array();
$proto78["m_link"] = "SQLL_LEFTJOIN";
			$proto79=array();
$proto79["m_strName"] = "lu_salutations";
$proto79["m_columns"] = array();
$proto79["m_columns"][] = "SalutationId";
$proto79["m_columns"][] = "Salutation";
$proto79["m_columns"][] = "Gender";
$obj = new SQLTable($proto79);

$proto78["m_table"] = $obj;
$proto78["m_alias"] = "salutations";
$proto80=array();
$proto80["m_sql"] = "devotee.TitleId = salutations.SalutationId";
$proto80["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "devotee"
));

$proto80["m_column"]=$obj;
$proto80["m_contained"] = array();
$proto80["m_strCase"] = "= salutations.SalutationId";
$proto80["m_havingmode"] = "0";
$proto80["m_inBrackets"] = "0";
$proto80["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto80);

$proto78["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto78);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_devotee = createSqlQuery_devotee();
																		 $queryData_devotee->m_fieldlist[15]->m_isEncrypted = true;
																		$tdatadevotee[".sqlquery"] = $queryData_devotee;
	
if(isset($tdatadevotee["field2"])){
	$tdatadevotee["field2"]["LookupTable"] = "carscars_view";
	$tdatadevotee["field2"]["LookupOrderBy"] = "name";
	$tdatadevotee["field2"]["LookupType"] = 4;
	$tdatadevotee["field2"]["LinkField"] = "email";
	$tdatadevotee["field2"]["DisplayField"] = "name";
	$tdatadevotee[".hasCustomViewField"] = true;
}

include_once(getabspath("include/devotee_events.php"));
$tableEvents["devotee"] = new eventclass_devotee;
$tdatadevotee[".hasEvents"] = true;

$cipherer = new RunnerCipherer("devotee");

?>