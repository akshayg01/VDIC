<?php
require_once(getabspath("classes/cipherer.php"));
$tdatavw_Devotee_full = array();
	$tdatavw_Devotee_full[".NumberOfChars"] = 80; 
	$tdatavw_Devotee_full[".ShortName"] = "vw_Devotee_full";
	$tdatavw_Devotee_full[".OwnerID"] = "DevoteeId";
	$tdatavw_Devotee_full[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsvw_Devotee_full = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_Devotee_full["English"] = array();
	$fieldToolTipsvw_Devotee_full["English"] = array();
	$fieldLabelsvw_Devotee_full["English"]["Photo"] = "Photo";
	$fieldToolTipsvw_Devotee_full["English"]["Photo"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Gender"] = "Gender";
	$fieldToolTipsvw_Devotee_full["English"]["Gender"] = "";
	$fieldLabelsvw_Devotee_full["English"]["TitleId"] = "Title Id";
	$fieldToolTipsvw_Devotee_full["English"]["TitleId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["FirstName"] = "First Name";
	$fieldToolTipsvw_Devotee_full["English"]["FirstName"] = "";
	$fieldLabelsvw_Devotee_full["English"]["LastName"] = "Last Name";
	$fieldToolTipsvw_Devotee_full["English"]["LastName"] = "";
	$fieldLabelsvw_Devotee_full["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsvw_Devotee_full["English"]["MiddleName"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsvw_Devotee_full["English"]["DateOfBirth"] = "";
	$fieldLabelsvw_Devotee_full["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsvw_Devotee_full["English"]["MaritalStatusId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DateofMarriage"] = "Date of Marriage";
	$fieldToolTipsvw_Devotee_full["English"]["DateofMarriage"] = "";
	$fieldLabelsvw_Devotee_full["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsvw_Devotee_full["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["MobilePhone"] = "Mobile Phone";
	$fieldToolTipsvw_Devotee_full["English"]["MobilePhone"] = "";
	$fieldLabelsvw_Devotee_full["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsvw_Devotee_full["English"]["WorkPhone"] = "";
	$fieldLabelsvw_Devotee_full["English"]["EmailPrimary"] = "Email Primary";
	$fieldToolTipsvw_Devotee_full["English"]["EmailPrimary"] = "";
	$fieldLabelsvw_Devotee_full["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsvw_Devotee_full["English"]["EmailSecondary"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Password"] = "Password";
	$fieldToolTipsvw_Devotee_full["English"]["Password"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_Devotee_full["English"]["DevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Occupational_DevoteeId"] = "DevoteeId";
	$fieldToolTipsvw_Devotee_full["English"]["Occupational_DevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Occupational_Education"] = "Education";
	$fieldToolTipsvw_Devotee_full["English"]["Occupational_Education"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Occupational_Occupation"] = "Occupation";
	$fieldToolTipsvw_Devotee_full["English"]["Occupational_Occupation"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Occupational_Designation"] = "Designation";
	$fieldToolTipsvw_Devotee_full["English"]["Occupational_Designation"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Occupational_AwardsOrMerits"] = "Awards Or Merits";
	$fieldToolTipsvw_Devotee_full["English"]["Occupational_AwardsOrMerits"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DevoteeOrg_DevoteeOrgId"] = "Devotee Org Id";
	$fieldToolTipsvw_Devotee_full["English"]["DevoteeOrg_DevoteeOrgId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DevoteeOrg_OrgId"] = "Org Id";
	$fieldToolTipsvw_Devotee_full["English"]["DevoteeOrg_OrgId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DevoteeOrg_DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_Devotee_full["English"]["DevoteeOrg_DevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DevoteeOrg_FromDate"] = "From Date";
	$fieldToolTipsvw_Devotee_full["English"]["DevoteeOrg_FromDate"] = "";
	$fieldLabelsvw_Devotee_full["English"]["DevoteeOrg_ToDate"] = "To Date";
	$fieldToolTipsvw_Devotee_full["English"]["DevoteeOrg_ToDate"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_AddressLine1"] = "Address Line1";
	$fieldToolTipsvw_Devotee_full["English"]["address_AddressLine1"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_AddressLine2"] = "Address Line2";
	$fieldToolTipsvw_Devotee_full["English"]["address_AddressLine2"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_City"] = "City";
	$fieldToolTipsvw_Devotee_full["English"]["address_City"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_State"] = "State";
	$fieldToolTipsvw_Devotee_full["English"]["address_State"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_Country"] = "Country";
	$fieldToolTipsvw_Devotee_full["English"]["address_Country"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_Pincode"] = "Pincode";
	$fieldToolTipsvw_Devotee_full["English"]["address_Pincode"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_IsVerified"] = "IsVerified";
	$fieldToolTipsvw_Devotee_full["English"]["address_IsVerified"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_IsWrong"] = "IsWrong";
	$fieldToolTipsvw_Devotee_full["English"]["address_IsWrong"] = "";
	$fieldLabelsvw_Devotee_full["English"]["address_AddressTypeId"] = "Address Type Id";
	$fieldToolTipsvw_Devotee_full["English"]["address_AddressTypeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["occupational_SkillsOrExperiences"] = "Skills Or Experiences";
	$fieldToolTipsvw_Devotee_full["English"]["occupational_SkillsOrExperiences"] = "";
	$fieldLabelsvw_Devotee_full["English"]["occupational_CurrentCompanyId"] = "Current Company Id";
	$fieldToolTipsvw_Devotee_full["English"]["occupational_CurrentCompanyId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["organization_Location"] = "Location";
	$fieldToolTipsvw_Devotee_full["English"]["organization_Location"] = "";
	$fieldLabelsvw_Devotee_full["English"]["SpiritualLife_DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_Devotee_full["English"]["SpiritualLife_DevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteeaddress_DevoteeId"] = "DevoteeId";
	$fieldToolTipsvw_Devotee_full["English"]["devoteeaddress_DevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteeaddress_AddressId"] = "AddressId";
	$fieldToolTipsvw_Devotee_full["English"]["devoteeaddress_AddressId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteelang_DevoteeLanguageId"] = "Devotee Language Id";
	$fieldToolTipsvw_Devotee_full["English"]["devoteelang_DevoteeLanguageId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteelang_DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_Devotee_full["English"]["devoteelang_DevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteelang_LanguageId"] = "Language Id";
	$fieldToolTipsvw_Devotee_full["English"]["devoteelang_LanguageId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteelang_SpeakingLevel"] = "Speaking Level";
	$fieldToolTipsvw_Devotee_full["English"]["devoteelang_SpeakingLevel"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteelang_ReadingLevel"] = "Reading Level";
	$fieldToolTipsvw_Devotee_full["English"]["devoteelang_ReadingLevel"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteelang_WritingLevel"] = "Writing Level";
	$fieldToolTipsvw_Devotee_full["English"]["devoteelang_WritingLevel"] = "";
	$fieldLabelsvw_Devotee_full["English"]["addresstypes_AddressType"] = "Address Type";
	$fieldToolTipsvw_Devotee_full["English"]["addresstypes_AddressType"] = "";
	$fieldLabelsvw_Devotee_full["English"]["addresstypes_AddressTypeId"] = "AddressTypeId";
	$fieldToolTipsvw_Devotee_full["English"]["addresstypes_AddressTypeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["devoteeaddress_devoteeaddressId"] = "Devotee Address Id";
	$fieldToolTipsvw_Devotee_full["English"]["devoteeaddress_devoteeaddressId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["Address_AddressId"] = "Address Id";
	$fieldToolTipsvw_Devotee_full["English"]["Address_AddressId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["occupational_DevoteeOccupationalId"] = "Devotee Occupational Id";
	$fieldToolTipsvw_Devotee_full["English"]["occupational_DevoteeOccupationalId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["company_CompanyId"] = "Company Id";
	$fieldToolTipsvw_Devotee_full["English"]["company_CompanyId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["company_CompanyName"] = "Company Name";
	$fieldToolTipsvw_Devotee_full["English"]["company_CompanyName"] = "";
	$fieldLabelsvw_Devotee_full["English"]["company_AddressId"] = "Address Id";
	$fieldToolTipsvw_Devotee_full["English"]["company_AddressId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["company_Remark"] = "Remark";
	$fieldToolTipsvw_Devotee_full["English"]["company_Remark"] = "";
	$fieldLabelsvw_Devotee_full["English"]["organization_OrgId"] = "OrgId";
	$fieldToolTipsvw_Devotee_full["English"]["organization_OrgId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["organization_OrgName"] = "Org Name";
	$fieldToolTipsvw_Devotee_full["English"]["organization_OrgName"] = "";
	$fieldLabelsvw_Devotee_full["English"]["organization_OrgOwnerId"] = "OrgOwnerId";
	$fieldToolTipsvw_Devotee_full["English"]["organization_OrgOwnerId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["organization_OrgLeaderId"] = "OrgLeaderId";
	$fieldToolTipsvw_Devotee_full["English"]["organization_OrgLeaderId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_SpiritulLifeId"] = "Spiritul Life Id";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_SpiritulLifeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_DateOfHarinamInitiation"] = "Date Of Harinam Initiation";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_DateOfHarinamInitiation"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_DateOfBrahmanInitiation"] = "Date Of Brahman Initiation";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_DateOfBrahmanInitiation"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_SpiritualMasterDevoteeId"] = "Spiritual Master Devotee Id";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_SpiritualMasterDevoteeId"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_PreviousReligion"] = "Previous Religion";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_PreviousReligion"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_Chanting16RoundsSince"] = "Chanting 16 Rounds Since";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_Chanting16RoundsSince"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_IntroducedBy"] = "Introduced By";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_IntroducedBy"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_YearOfIntroduction"] = "Year Of Introduction";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_YearOfIntroduction"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_IntroducedInCenter"] = "Introduced In Center";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_IntroducedInCenter"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_PreferedServices"] = "Prefered Services";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_PreferedServices"] = "";
	$fieldLabelsvw_Devotee_full["English"]["spirituallife_SericesRendered"] = "Serices Rendered";
	$fieldToolTipsvw_Devotee_full["English"]["spirituallife_SericesRendered"] = "";
	if (count($fieldToolTipsvw_Devotee_full["English"]))
		$tdatavw_Devotee_full[".isUseToolTips"] = true;
}
	
	
	$tdatavw_Devotee_full[".NCSearch"] = true;



$tdatavw_Devotee_full[".shortTableName"] = "vw_Devotee_full";
$tdatavw_Devotee_full[".nSecOptions"] = 1;
$tdatavw_Devotee_full[".recsPerRowList"] = 1;
$tdatavw_Devotee_full[".mainTableOwnerID"] = "DevoteeId";
$tdatavw_Devotee_full[".moveNext"] = 1;
$tdatavw_Devotee_full[".nType"] = 1;

$tdatavw_Devotee_full[".strOriginalTableName"] = "devotee";

$tdatavw_Devotee_full[".hasEncryptedFields"] = true;



$tdatavw_Devotee_full[".showAddInPopup"] = true;

$tdatavw_Devotee_full[".showEditInPopup"] = true;

$tdatavw_Devotee_full[".showViewInPopup"] = true;

$tdatavw_Devotee_full[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatavw_Devotee_full[".listAjax"] = true;
else 
	$tdatavw_Devotee_full[".listAjax"] = false;

	$tdatavw_Devotee_full[".audit"] = true;

	$tdatavw_Devotee_full[".locking"] = false;

$tdatavw_Devotee_full[".listIcons"] = true;
$tdatavw_Devotee_full[".edit"] = true;

$tdatavw_Devotee_full[".exportTo"] = true;

$tdatavw_Devotee_full[".printFriendly"] = true;


$tdatavw_Devotee_full[".showSimpleSearchOptions"] = true;

$tdatavw_Devotee_full[".showSearchPanel"] = true;

if (isMobile())
	$tdatavw_Devotee_full[".isUseAjaxSuggest"] = false;
else 
	$tdatavw_Devotee_full[".isUseAjaxSuggest"] = true;

$tdatavw_Devotee_full[".rowHighlite"] = true;

// button handlers file names

$tdatavw_Devotee_full[".addPageEvents"] = false;

// use timepicker for search panel
$tdatavw_Devotee_full[".isUseTimeForSearch"] = false;




$tdatavw_Devotee_full[".allSearchFields"] = array();

$tdatavw_Devotee_full[".allSearchFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "Gender";
$tdatavw_Devotee_full[".allSearchFields"][] = "TitleId";
$tdatavw_Devotee_full[".allSearchFields"][] = "FirstName";
$tdatavw_Devotee_full[".allSearchFields"][] = "LastName";
$tdatavw_Devotee_full[".allSearchFields"][] = "MiddleName";
$tdatavw_Devotee_full[".allSearchFields"][] = "DateOfBirth";
$tdatavw_Devotee_full[".allSearchFields"][] = "MaritalStatusId";
$tdatavw_Devotee_full[".allSearchFields"][] = "DateofMarriage";
$tdatavw_Devotee_full[".allSearchFields"][] = "SpouseDevoteeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "MobilePhone";
$tdatavw_Devotee_full[".allSearchFields"][] = "WorkPhone";
$tdatavw_Devotee_full[".allSearchFields"][] = "EmailPrimary";
$tdatavw_Devotee_full[".allSearchFields"][] = "EmailSecondary";
$tdatavw_Devotee_full[".allSearchFields"][] = "Password";
$tdatavw_Devotee_full[".allSearchFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_City";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_State";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_Country";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".allSearchFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "organization_OrgName";
$tdatavw_Devotee_full[".allSearchFields"][] = "organization_OrgId";
$tdatavw_Devotee_full[".allSearchFields"][] = "organization_OrgLeaderId";
$tdatavw_Devotee_full[".allSearchFields"][] = "organization_OrgOwnerId";
$tdatavw_Devotee_full[".allSearchFields"][] = "organization_Location";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_SericesRendered";
$tdatavw_Devotee_full[".allSearchFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_PreferedServices";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_Chanting16RoundsSince";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_IntroducedInCenter";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_YearOfIntroduction";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_PreviousReligion";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_SpiritualMasterDevoteeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_DateOfBrahmanInitiation";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_DateOfHarinamInitiation";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_SpiritulLifeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "spirituallife_IntroducedBy";
$tdatavw_Devotee_full[".allSearchFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".allSearchFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".allSearchFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".allSearchFields"][] = "company_Remark";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".allSearchFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".allSearchFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".allSearchFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".allSearchFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".allSearchFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".allSearchFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".allSearchFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".allSearchFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".allSearchFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".allSearchFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".allSearchFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".allSearchFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".allSearchFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".allSearchFields"][] = "devoteeaddress_DevoteeId";

$tdatavw_Devotee_full[".googleLikeFields"][] = "TitleId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "FirstName";
$tdatavw_Devotee_full[".googleLikeFields"][] = "LastName";
$tdatavw_Devotee_full[".googleLikeFields"][] = "MiddleName";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Gender";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DateOfBirth";
$tdatavw_Devotee_full[".googleLikeFields"][] = "MaritalStatusId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DateofMarriage";
$tdatavw_Devotee_full[".googleLikeFields"][] = "SpouseDevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "MobilePhone";
$tdatavw_Devotee_full[".googleLikeFields"][] = "WorkPhone";
$tdatavw_Devotee_full[".googleLikeFields"][] = "EmailPrimary";
$tdatavw_Devotee_full[".googleLikeFields"][] = "EmailSecondary";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Password";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_City";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_State";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_Country";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".googleLikeFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".googleLikeFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".googleLikeFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "organization_OrgId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "organization_OrgName";
$tdatavw_Devotee_full[".googleLikeFields"][] = "organization_OrgOwnerId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "organization_OrgLeaderId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "organization_Location";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_SpiritulLifeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_DateOfHarinamInitiation";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_DateOfBrahmanInitiation";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_SpiritualMasterDevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_PreviousReligion";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_Chanting16RoundsSince";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_IntroducedBy";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_YearOfIntroduction";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_IntroducedInCenter";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_PreferedServices";
$tdatavw_Devotee_full[".googleLikeFields"][] = "spirituallife_SericesRendered";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteeaddress_DevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".googleLikeFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".googleLikeFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".googleLikeFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".googleLikeFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".googleLikeFields"][] = "company_Remark";


$tdatavw_Devotee_full[".advSearchFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "Gender";
$tdatavw_Devotee_full[".advSearchFields"][] = "TitleId";
$tdatavw_Devotee_full[".advSearchFields"][] = "FirstName";
$tdatavw_Devotee_full[".advSearchFields"][] = "LastName";
$tdatavw_Devotee_full[".advSearchFields"][] = "MiddleName";
$tdatavw_Devotee_full[".advSearchFields"][] = "DateOfBirth";
$tdatavw_Devotee_full[".advSearchFields"][] = "MaritalStatusId";
$tdatavw_Devotee_full[".advSearchFields"][] = "DateofMarriage";
$tdatavw_Devotee_full[".advSearchFields"][] = "SpouseDevoteeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "MobilePhone";
$tdatavw_Devotee_full[".advSearchFields"][] = "WorkPhone";
$tdatavw_Devotee_full[".advSearchFields"][] = "EmailPrimary";
$tdatavw_Devotee_full[".advSearchFields"][] = "EmailSecondary";
$tdatavw_Devotee_full[".advSearchFields"][] = "Password";
$tdatavw_Devotee_full[".advSearchFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_City";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_State";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_Country";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".advSearchFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "organization_OrgName";
$tdatavw_Devotee_full[".advSearchFields"][] = "organization_OrgId";
$tdatavw_Devotee_full[".advSearchFields"][] = "organization_OrgLeaderId";
$tdatavw_Devotee_full[".advSearchFields"][] = "organization_OrgOwnerId";
$tdatavw_Devotee_full[".advSearchFields"][] = "organization_Location";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_SericesRendered";
$tdatavw_Devotee_full[".advSearchFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_PreferedServices";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_Chanting16RoundsSince";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_IntroducedInCenter";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_YearOfIntroduction";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_PreviousReligion";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_SpiritualMasterDevoteeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_DateOfBrahmanInitiation";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_DateOfHarinamInitiation";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_SpiritulLifeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "spirituallife_IntroducedBy";
$tdatavw_Devotee_full[".advSearchFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".advSearchFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".advSearchFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".advSearchFields"][] = "company_Remark";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".advSearchFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".advSearchFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".advSearchFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".advSearchFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".advSearchFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".advSearchFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".advSearchFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".advSearchFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".advSearchFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".advSearchFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".advSearchFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".advSearchFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".advSearchFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".advSearchFields"][] = "devoteeaddress_DevoteeId";

$tdatavw_Devotee_full[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main



$tdatavw_Devotee_full[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatavw_Devotee_full[".strOrderBy"] = $tstrOrderBy;

$tdatavw_Devotee_full[".orderindexes"] = array();

$tdatavw_Devotee_full[".sqlHead"] = "SELECT devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  address.AddressLine1 AS address_AddressLine1,  address.AddressLine2 AS address_AddressLine2,  address.City AS address_City,  address.`State` AS address_State,  address.Country AS address_Country,  address.Pincode AS address_Pincode,  address.IsVerified AS address_IsVerified,  address.IsWrong AS address_IsWrong,  address.AddressTypeId AS address_AddressTypeId,  occupational.DevoteeId AS occupational_DevoteeId,  occupational.Education AS occupational_Education,  occupational.Occupation AS occupational_Occupation,  occupational.Designation AS occupational_Designation,  occupational.AwardsOrMerits AS occupational_AwardsOrMerits,  occupational.SkillsOrJobExperiences AS occupational_SkillsOrExperiences,  occupational.CurrentCompnayId AS occupational_CurrentCompanyId,  `organization`.OrgId AS organization_OrgId,  `organization`.OrgName AS organization_OrgName,  `organization`.OrgOwnerId AS organization_OrgOwnerId,  `organization`.OrgLeaderId AS organization_OrgLeaderId,  `organization`.Location AS organization_Location,  spiritual_life.SpiritualLifeId AS spirituallife_SpiritulLifeId,  spiritual_life.DevoteeId AS spirituallife_DevoteeId,  spiritual_life.DateOfHarinamInitiation AS spirituallife_DateOfHarinamInitiation,  spiritual_life.DateOfBrahmanInitiation AS spirituallife_DateOfBrahmanInitiation,  spiritual_life.SpiritualMasterDevoteeId AS spirituallife_SpiritualMasterDevoteeId,  spiritual_life.PreviousReligion AS spirituallife_PreviousReligion,  spiritual_life.Chanting16RoundsSince AS spirituallife_Chanting16RoundsSince,  spiritual_life.IntroducedBy AS spirituallife_IntroducedBy,  spiritual_life.YearOfIntroduction AS spirituallife_YearOfIntroduction,  spiritual_life.IntroducedInCenter AS spirituallife_IntroducedInCenter,  spiritual_life.PreferedServices AS spirituallife_PreferedServices,  spiritual_life.ServicesRendered AS spirituallife_SericesRendered,  devotee_address.DevoteeId AS devoteeaddress_DevoteeId,  devotee_address.AddressId AS devoteeaddress_AddressId,  devotee_language.DevoteeLanguageId AS devoteelang_DevoteeLanguageId,  devotee_language.DevoteeId AS devoteelang_DevoteeId,  devotee_language.LanguageId AS devoteelang_LanguageId,  devotee_language.SpeakingLevel AS devoteelang_SpeakingLevel,  devotee_language.ReadingLevel AS devoteelang_ReadingLevel,  devotee_language.WritingLevel AS devoteelang_WritingLevel,  address_types.AddressType AS addresstypes_AddressType,  address_types.AddressTypeId AS addresstypes_AddressTypeId,  devotee_address.DevoteeAddressId AS devoteeaddress_devoteeaddressId,  address.AddressId AS Address_AddressId,  occupational.DevoteeOccupationalId AS occupational_DevoteeOccupationalId,  devotee_org.DevoteeOrgId AS devoteeorg_DevoteeOrgId,  devotee_org.OrgId AS devoteeorg_OrgId,  devotee_org.DevoteeId AS devoteeorg_DevoteeId,  devotee_org.FromDate AS devoteeorg_FromDate,  devotee_org.ToDate AS devoteeorg_ToDate,  devotee.DevoteeId,  company.CompanyId AS company_CompanyId,  company.CompanyName AS company_CompanyName,  company.AddressId AS company_AddressId,  company.Remark AS company_Remark";
$tdatavw_Devotee_full[".sqlFrom"] = "FROM devotee  LEFT OUTER JOIN devotee_address ON devotee.DevoteeId = devotee_address.DevoteeId  LEFT OUTER JOIN address ON devotee_address.AddressId = address.AddressId  LEFT OUTER JOIN occupational ON devotee.DevoteeId = occupational.DevoteeId  LEFT OUTER JOIN devotee_org ON devotee.DevoteeId = devotee_org.DevoteeId  LEFT OUTER JOIN `organization` ON devotee_org.OrgId = `organization`.OrgId  LEFT OUTER JOIN spiritual_life ON devotee.DevoteeId = spiritual_life.DevoteeId  LEFT OUTER JOIN devotee_language ON devotee.DevoteeId = devotee_language.DevoteeId  LEFT OUTER JOIN address_types ON address.AddressTypeId = address_types.AddressTypeId  LEFT OUTER JOIN company ON occupational.CurrentCompnayId = company.CompanyId";
$tdatavw_Devotee_full[".sqlWhereExpr"] = "";
$tdatavw_Devotee_full[".sqlTail"] = "";

//fill array of tabs for edit page
$arrEditTabs = array();
	$tabFields = array();
	$tabFields[] = "DevoteeId";
	$tabFields[] = "Photo";
	$tabFields[] = "Gender";
	$tabFields[] = "TitleId";
	$tabFields[] = "FirstName";
	$tabFields[] = "LastName";
	$tabFields[] = "MiddleName";
	$tabFields[] = "DateOfBirth";
	$tabFields[] = "MaritalStatusId";
	$tabFields[] = "DateofMarriage";
	$tabFields[] = "SpouseDevoteeId";
	$tabFields[] = "MobilePhone";
	$tabFields[] = "WorkPhone";
	$tabFields[] = "EmailPrimary";
	$tabFields[] = "EmailSecondary";
	$tabFields[] = "Password";
$arrEditTabs[] = array('tabId'=>'Basic_Info1',
					   'tabName'=>"Basic Info",
					   'nType'=>'0',
					   'nOrder'=>1,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "Address_AddressId";
	$tabFields[] = "address_AddressLine1";
	$tabFields[] = "address_AddressLine2";
	$tabFields[] = "address_City";
	$tabFields[] = "address_State";
	$tabFields[] = "address_Pincode";
	$tabFields[] = "address_Country";
	$tabFields[] = "address_IsVerified";
	$tabFields[] = "address_IsWrong";
	$tabFields[] = "address_AddressTypeId";
$arrEditTabs[] = array('tabId'=>'Address1',
					   'tabName'=>"Address",
					   'nType'=>'0',
					   'nOrder'=>18,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "organization_Location";
$arrEditTabs[] = array('tabId'=>'Organization1',
					   'tabName'=>"Organization",
					   'nType'=>'0',
					   'nOrder'=>29,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "SpiritualLife_DevoteeId";
$arrEditTabs[] = array('tabId'=>'Spiritual_Life1',
					   'tabName'=>"Spiritual Life",
					   'nType'=>'0',
					   'nOrder'=>31,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "company_CompanyId";
	$tabFields[] = "company_CompanyName";
	$tabFields[] = "company_AddressId";
	$tabFields[] = "company_Remark";
$arrEditTabs[] = array('tabId'=>'Company1',
					   'tabName'=>"Company",
					   'nType'=>'0',
					   'nOrder'=>33,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "devoteelang_DevoteeLanguageId";
	$tabFields[] = "devoteelang_WritingLevel";
	$tabFields[] = "devoteelang_DevoteeId";
	$tabFields[] = "devoteelang_LanguageId";
	$tabFields[] = "devoteelang_SpeakingLevel";
	$tabFields[] = "devoteelang_ReadingLevel";
$arrEditTabs[] = array('tabId'=>'Language1',
					   'tabName'=>"Language",
					   'nType'=>'0',
					   'nOrder'=>38,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "occupational_DevoteeOccupationalId";
	$tabFields[] = "Occupational_DevoteeId";
	$tabFields[] = "Occupational_Education";
	$tabFields[] = "Occupational_Occupation";
	$tabFields[] = "Occupational_Designation";
	$tabFields[] = "Occupational_AwardsOrMerits";
	$tabFields[] = "occupational_SkillsOrExperiences";
	$tabFields[] = "occupational_CurrentCompanyId";
$arrEditTabs[] = array('tabId'=>'Occupational1',
					   'tabName'=>"Occupational",
					   'nType'=>'0',
					   'nOrder'=>45,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
$tdatavw_Devotee_full[".arrEditTabs"] = $arrEditTabs;

//fill array of tabs for add page
$arrAddTabs = array();
	$tabFields = array();
	$tabFields[] = "DevoteeId";
	$tabFields[] = "Photo";
	$tabFields[] = "Gender";
	$tabFields[] = "TitleId";
	$tabFields[] = "FirstName";
	$tabFields[] = "LastName";
	$tabFields[] = "MiddleName";
	$tabFields[] = "DateOfBirth";
	$tabFields[] = "MaritalStatusId";
	$tabFields[] = "DateofMarriage";
	$tabFields[] = "SpouseDevoteeId";
	$tabFields[] = "MobilePhone";
	$tabFields[] = "WorkPhone";
	$tabFields[] = "EmailPrimary";
	$tabFields[] = "EmailSecondary";
	$tabFields[] = "Password";
$arrAddTabs[] = array('tabId'=>'Basic_Info1',
					  'tabName'=>"Basic Info",
					  'nType'=>'0',
					  'nOrder'=>1,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "Address_AddressId";
	$tabFields[] = "address_AddressLine1";
	$tabFields[] = "address_AddressLine2";
	$tabFields[] = "address_City";
	$tabFields[] = "address_State";
	$tabFields[] = "address_Pincode";
	$tabFields[] = "address_Country";
	$tabFields[] = "address_IsVerified";
	$tabFields[] = "address_IsWrong";
	$tabFields[] = "address_AddressTypeId";
$arrAddTabs[] = array('tabId'=>'Address1',
					  'tabName'=>"Address",
					  'nType'=>'0',
					  'nOrder'=>18,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "organization_OrgName";
	$tabFields[] = "organization_OrgId";
	$tabFields[] = "organization_OrgLeaderId";
	$tabFields[] = "organization_OrgOwnerId";
	$tabFields[] = "organization_Location";
$arrAddTabs[] = array('tabId'=>'Organization1',
					  'tabName'=>"Organization",
					  'nType'=>'0',
					  'nOrder'=>29,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "spirituallife_SericesRendered";
	$tabFields[] = "SpiritualLife_DevoteeId";
	$tabFields[] = "spirituallife_PreferedServices";
	$tabFields[] = "spirituallife_Chanting16RoundsSince";
	$tabFields[] = "spirituallife_IntroducedInCenter";
	$tabFields[] = "spirituallife_YearOfIntroduction";
	$tabFields[] = "spirituallife_PreviousReligion";
	$tabFields[] = "spirituallife_SpiritualMasterDevoteeId";
	$tabFields[] = "spirituallife_DateOfBrahmanInitiation";
	$tabFields[] = "spirituallife_DateOfHarinamInitiation";
	$tabFields[] = "spirituallife_SpiritulLifeId";
	$tabFields[] = "spirituallife_IntroducedBy";
$arrAddTabs[] = array('tabId'=>'Spiritual_Life1',
					  'tabName'=>"Spiritual Life",
					  'nType'=>'0',
					  'nOrder'=>35,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "company_CompanyId";
	$tabFields[] = "company_CompanyName";
	$tabFields[] = "company_AddressId";
	$tabFields[] = "company_Remark";
$arrAddTabs[] = array('tabId'=>'Company1',
					  'tabName'=>"Company",
					  'nType'=>'0',
					  'nOrder'=>48,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "devoteelang_DevoteeLanguageId";
	$tabFields[] = "devoteelang_WritingLevel";
	$tabFields[] = "devoteelang_DevoteeId";
	$tabFields[] = "devoteelang_LanguageId";
	$tabFields[] = "devoteelang_SpeakingLevel";
	$tabFields[] = "devoteelang_ReadingLevel";
$arrAddTabs[] = array('tabId'=>'Language1',
					  'tabName'=>"Language",
					  'nType'=>'0',
					  'nOrder'=>53,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "occupational_DevoteeOccupationalId";
	$tabFields[] = "Occupational_DevoteeId";
	$tabFields[] = "Occupational_Education";
	$tabFields[] = "Occupational_Occupation";
	$tabFields[] = "Occupational_Designation";
	$tabFields[] = "Occupational_AwardsOrMerits";
	$tabFields[] = "occupational_SkillsOrExperiences";
	$tabFields[] = "occupational_CurrentCompanyId";
$arrAddTabs[] = array('tabId'=>'Occupational1',
					  'tabName'=>"Occupational",
					  'nType'=>'0',
					  'nOrder'=>60,
					  'tabGroup'=>1,
					  'arrFields'=> $tabFields,
					  'expandSec'=>0);
$tdatavw_Devotee_full[".arrAddTabs"] = $arrAddTabs;

//fill array of tabs for view page
$arrViewTabs = array();
	$tabFields = array();
	$tabFields[] = "DevoteeId";
	$tabFields[] = "Photo";
	$tabFields[] = "Gender";
	$tabFields[] = "TitleId";
	$tabFields[] = "FirstName";
	$tabFields[] = "LastName";
	$tabFields[] = "MiddleName";
	$tabFields[] = "DateOfBirth";
	$tabFields[] = "MaritalStatusId";
	$tabFields[] = "DateofMarriage";
	$tabFields[] = "SpouseDevoteeId";
	$tabFields[] = "MobilePhone";
	$tabFields[] = "WorkPhone";
	$tabFields[] = "EmailPrimary";
	$tabFields[] = "EmailSecondary";
	$tabFields[] = "Password";
$arrViewTabs[] = array('tabId'=>'Basic_Info1',
					   'tabName'=>"Basic Info",
					   'nType'=>'0',
					   'nOrder'=>1,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "Address_AddressId";
	$tabFields[] = "address_AddressLine1";
	$tabFields[] = "address_AddressLine2";
	$tabFields[] = "address_City";
	$tabFields[] = "address_State";
	$tabFields[] = "address_Pincode";
	$tabFields[] = "address_Country";
	$tabFields[] = "address_IsVerified";
	$tabFields[] = "address_IsWrong";
	$tabFields[] = "address_AddressTypeId";
$arrViewTabs[] = array('tabId'=>'Address1',
					   'tabName'=>"Address",
					   'nType'=>'0',
					   'nOrder'=>18,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "organization_OrgName";
	$tabFields[] = "organization_OrgId";
	$tabFields[] = "organization_OrgLeaderId";
	$tabFields[] = "organization_OrgOwnerId";
	$tabFields[] = "organization_Location";
$arrViewTabs[] = array('tabId'=>'Organization1',
					   'tabName'=>"Organization",
					   'nType'=>'0',
					   'nOrder'=>29,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "spirituallife_SericesRendered";
	$tabFields[] = "SpiritualLife_DevoteeId";
	$tabFields[] = "spirituallife_PreferedServices";
	$tabFields[] = "spirituallife_Chanting16RoundsSince";
	$tabFields[] = "spirituallife_IntroducedInCenter";
	$tabFields[] = "spirituallife_YearOfIntroduction";
	$tabFields[] = "spirituallife_PreviousReligion";
	$tabFields[] = "spirituallife_SpiritualMasterDevoteeId";
	$tabFields[] = "spirituallife_DateOfBrahmanInitiation";
	$tabFields[] = "spirituallife_DateOfHarinamInitiation";
	$tabFields[] = "spirituallife_SpiritulLifeId";
	$tabFields[] = "spirituallife_IntroducedBy";
$arrViewTabs[] = array('tabId'=>'Spiritual_Life1',
					   'tabName'=>"Spiritual Life",
					   'nType'=>'0',
					   'nOrder'=>35,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "company_CompanyId";
	$tabFields[] = "company_CompanyName";
	$tabFields[] = "company_AddressId";
	$tabFields[] = "company_Remark";
$arrViewTabs[] = array('tabId'=>'Company1',
					   'tabName'=>"Company",
					   'nType'=>'0',
					   'nOrder'=>48,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "devoteelang_DevoteeLanguageId";
	$tabFields[] = "devoteelang_WritingLevel";
	$tabFields[] = "devoteelang_DevoteeId";
	$tabFields[] = "devoteelang_LanguageId";
	$tabFields[] = "devoteelang_SpeakingLevel";
	$tabFields[] = "devoteelang_ReadingLevel";
$arrViewTabs[] = array('tabId'=>'Language1',
					   'tabName'=>"Language",
					   'nType'=>'0',
					   'nOrder'=>53,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
	$tabFields = array();
	$tabFields[] = "occupational_DevoteeOccupationalId";
	$tabFields[] = "Occupational_DevoteeId";
	$tabFields[] = "Occupational_Education";
	$tabFields[] = "Occupational_Occupation";
	$tabFields[] = "Occupational_Designation";
	$tabFields[] = "Occupational_AwardsOrMerits";
	$tabFields[] = "occupational_SkillsOrExperiences";
	$tabFields[] = "occupational_CurrentCompanyId";
$arrViewTabs[] = array('tabId'=>'Occupational1',
					   'tabName'=>"Occupational",
					   'nType'=>'0',
					   'nOrder'=>60,
					   'tabGroup'=>1,
					   'arrFields'=> $tabFields,
					   'expandSec'=>0);
$tdatavw_Devotee_full[".arrViewTabs"] = $arrViewTabs;

//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_Devotee_full[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_Devotee_full[".arrGroupsPerPage"] = $arrGPP;

$tableKeysvw_Devotee_full = array();
$tableKeysvw_Devotee_full[] = "DevoteeId";
$tdatavw_Devotee_full[".Keys"] = $tableKeysvw_Devotee_full;

$tdatavw_Devotee_full[".listFields"] = array();
$tdatavw_Devotee_full[".listFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".listFields"][] = "Photo";
$tdatavw_Devotee_full[".listFields"][] = "Gender";
$tdatavw_Devotee_full[".listFields"][] = "TitleId";
$tdatavw_Devotee_full[".listFields"][] = "FirstName";
$tdatavw_Devotee_full[".listFields"][] = "LastName";
$tdatavw_Devotee_full[".listFields"][] = "MiddleName";
$tdatavw_Devotee_full[".listFields"][] = "DateOfBirth";
$tdatavw_Devotee_full[".listFields"][] = "MaritalStatusId";
$tdatavw_Devotee_full[".listFields"][] = "DateofMarriage";
$tdatavw_Devotee_full[".listFields"][] = "SpouseDevoteeId";
$tdatavw_Devotee_full[".listFields"][] = "MobilePhone";
$tdatavw_Devotee_full[".listFields"][] = "WorkPhone";
$tdatavw_Devotee_full[".listFields"][] = "EmailPrimary";
$tdatavw_Devotee_full[".listFields"][] = "EmailSecondary";
$tdatavw_Devotee_full[".listFields"][] = "Password";
$tdatavw_Devotee_full[".listFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".listFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".listFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".listFields"][] = "address_City";
$tdatavw_Devotee_full[".listFields"][] = "address_State";
$tdatavw_Devotee_full[".listFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".listFields"][] = "address_Country";
$tdatavw_Devotee_full[".listFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".listFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".listFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".listFields"][] = "organization_OrgName";
$tdatavw_Devotee_full[".listFields"][] = "organization_OrgId";
$tdatavw_Devotee_full[".listFields"][] = "organization_OrgLeaderId";
$tdatavw_Devotee_full[".listFields"][] = "organization_OrgOwnerId";
$tdatavw_Devotee_full[".listFields"][] = "organization_Location";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_SericesRendered";
$tdatavw_Devotee_full[".listFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_PreferedServices";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_Chanting16RoundsSince";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_IntroducedInCenter";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_YearOfIntroduction";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_PreviousReligion";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_SpiritualMasterDevoteeId";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_DateOfBrahmanInitiation";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_DateOfHarinamInitiation";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_SpiritulLifeId";
$tdatavw_Devotee_full[".listFields"][] = "spirituallife_IntroducedBy";
$tdatavw_Devotee_full[".listFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".listFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".listFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".listFields"][] = "company_Remark";
$tdatavw_Devotee_full[".listFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".listFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".listFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".listFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".listFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".listFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".listFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".listFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".listFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".listFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".listFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".listFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".listFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".listFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".listFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".listFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".listFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".listFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".listFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".listFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".listFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".listFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".listFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".listFields"][] = "devoteeaddress_DevoteeId";

$tdatavw_Devotee_full[".viewFields"] = array();

$tdatavw_Devotee_full[".addFields"] = array();
$tdatavw_Devotee_full[".addFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".addFields"][] = "Photo";
$tdatavw_Devotee_full[".addFields"][] = "Gender";
$tdatavw_Devotee_full[".addFields"][] = "TitleId";
$tdatavw_Devotee_full[".addFields"][] = "FirstName";
$tdatavw_Devotee_full[".addFields"][] = "LastName";
$tdatavw_Devotee_full[".addFields"][] = "MiddleName";
$tdatavw_Devotee_full[".addFields"][] = "DateOfBirth";
$tdatavw_Devotee_full[".addFields"][] = "MaritalStatusId";
$tdatavw_Devotee_full[".addFields"][] = "DateofMarriage";
$tdatavw_Devotee_full[".addFields"][] = "SpouseDevoteeId";
$tdatavw_Devotee_full[".addFields"][] = "MobilePhone";
$tdatavw_Devotee_full[".addFields"][] = "WorkPhone";
$tdatavw_Devotee_full[".addFields"][] = "EmailPrimary";
$tdatavw_Devotee_full[".addFields"][] = "EmailSecondary";
$tdatavw_Devotee_full[".addFields"][] = "Password";
$tdatavw_Devotee_full[".addFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".addFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".addFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".addFields"][] = "address_City";
$tdatavw_Devotee_full[".addFields"][] = "address_State";
$tdatavw_Devotee_full[".addFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".addFields"][] = "address_Country";
$tdatavw_Devotee_full[".addFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".addFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".addFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".addFields"][] = "organization_OrgName";
$tdatavw_Devotee_full[".addFields"][] = "organization_OrgId";
$tdatavw_Devotee_full[".addFields"][] = "organization_OrgLeaderId";
$tdatavw_Devotee_full[".addFields"][] = "organization_OrgOwnerId";
$tdatavw_Devotee_full[".addFields"][] = "organization_Location";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_SericesRendered";
$tdatavw_Devotee_full[".addFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_PreferedServices";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_Chanting16RoundsSince";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_IntroducedInCenter";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_YearOfIntroduction";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_PreviousReligion";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_SpiritualMasterDevoteeId";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_DateOfBrahmanInitiation";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_DateOfHarinamInitiation";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_SpiritulLifeId";
$tdatavw_Devotee_full[".addFields"][] = "spirituallife_IntroducedBy";
$tdatavw_Devotee_full[".addFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".addFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".addFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".addFields"][] = "company_Remark";
$tdatavw_Devotee_full[".addFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".addFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".addFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".addFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".addFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".addFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".addFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".addFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".addFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".addFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".addFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".addFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".addFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".addFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".addFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".addFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".addFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".addFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".addFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".addFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".addFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".addFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".addFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".addFields"][] = "devoteeaddress_DevoteeId";

$tdatavw_Devotee_full[".inlineAddFields"] = array();

$tdatavw_Devotee_full[".editFields"] = array();
$tdatavw_Devotee_full[".editFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".editFields"][] = "Photo";
$tdatavw_Devotee_full[".editFields"][] = "Gender";
$tdatavw_Devotee_full[".editFields"][] = "TitleId";
$tdatavw_Devotee_full[".editFields"][] = "FirstName";
$tdatavw_Devotee_full[".editFields"][] = "LastName";
$tdatavw_Devotee_full[".editFields"][] = "MiddleName";
$tdatavw_Devotee_full[".editFields"][] = "DateOfBirth";
$tdatavw_Devotee_full[".editFields"][] = "MaritalStatusId";
$tdatavw_Devotee_full[".editFields"][] = "DateofMarriage";
$tdatavw_Devotee_full[".editFields"][] = "SpouseDevoteeId";
$tdatavw_Devotee_full[".editFields"][] = "MobilePhone";
$tdatavw_Devotee_full[".editFields"][] = "WorkPhone";
$tdatavw_Devotee_full[".editFields"][] = "EmailPrimary";
$tdatavw_Devotee_full[".editFields"][] = "EmailSecondary";
$tdatavw_Devotee_full[".editFields"][] = "Password";
$tdatavw_Devotee_full[".editFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".editFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".editFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".editFields"][] = "address_City";
$tdatavw_Devotee_full[".editFields"][] = "address_State";
$tdatavw_Devotee_full[".editFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".editFields"][] = "address_Country";
$tdatavw_Devotee_full[".editFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".editFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".editFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".editFields"][] = "organization_Location";
$tdatavw_Devotee_full[".editFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".editFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".editFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".editFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".editFields"][] = "company_Remark";
$tdatavw_Devotee_full[".editFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".editFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".editFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".editFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".editFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".editFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".editFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".editFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".editFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".editFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".editFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".editFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".editFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".editFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".editFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".editFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".editFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".editFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".editFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".editFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".editFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".editFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".editFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".editFields"][] = "devoteeaddress_DevoteeId";

$tdatavw_Devotee_full[".inlineEditFields"] = array();

$tdatavw_Devotee_full[".exportFields"] = array();
$tdatavw_Devotee_full[".exportFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".exportFields"][] = "Photo";
$tdatavw_Devotee_full[".exportFields"][] = "Gender";
$tdatavw_Devotee_full[".exportFields"][] = "TitleId";
$tdatavw_Devotee_full[".exportFields"][] = "FirstName";
$tdatavw_Devotee_full[".exportFields"][] = "LastName";
$tdatavw_Devotee_full[".exportFields"][] = "MiddleName";
$tdatavw_Devotee_full[".exportFields"][] = "DateOfBirth";
$tdatavw_Devotee_full[".exportFields"][] = "MaritalStatusId";
$tdatavw_Devotee_full[".exportFields"][] = "DateofMarriage";
$tdatavw_Devotee_full[".exportFields"][] = "SpouseDevoteeId";
$tdatavw_Devotee_full[".exportFields"][] = "MobilePhone";
$tdatavw_Devotee_full[".exportFields"][] = "WorkPhone";
$tdatavw_Devotee_full[".exportFields"][] = "EmailPrimary";
$tdatavw_Devotee_full[".exportFields"][] = "EmailSecondary";
$tdatavw_Devotee_full[".exportFields"][] = "Password";
$tdatavw_Devotee_full[".exportFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".exportFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".exportFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".exportFields"][] = "address_City";
$tdatavw_Devotee_full[".exportFields"][] = "address_State";
$tdatavw_Devotee_full[".exportFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".exportFields"][] = "address_Country";
$tdatavw_Devotee_full[".exportFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".exportFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".exportFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".exportFields"][] = "organization_OrgName";
$tdatavw_Devotee_full[".exportFields"][] = "organization_OrgId";
$tdatavw_Devotee_full[".exportFields"][] = "organization_OrgLeaderId";
$tdatavw_Devotee_full[".exportFields"][] = "organization_OrgOwnerId";
$tdatavw_Devotee_full[".exportFields"][] = "organization_Location";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_SericesRendered";
$tdatavw_Devotee_full[".exportFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_PreferedServices";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_Chanting16RoundsSince";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_IntroducedInCenter";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_YearOfIntroduction";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_PreviousReligion";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_SpiritualMasterDevoteeId";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_DateOfBrahmanInitiation";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_DateOfHarinamInitiation";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_SpiritulLifeId";
$tdatavw_Devotee_full[".exportFields"][] = "spirituallife_IntroducedBy";
$tdatavw_Devotee_full[".exportFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".exportFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".exportFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".exportFields"][] = "company_Remark";
$tdatavw_Devotee_full[".exportFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".exportFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".exportFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".exportFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".exportFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".exportFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".exportFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".exportFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".exportFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".exportFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".exportFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".exportFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".exportFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".exportFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".exportFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".exportFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".exportFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".exportFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".exportFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".exportFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".exportFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".exportFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".exportFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".exportFields"][] = "devoteeaddress_DevoteeId";

$tdatavw_Devotee_full[".printFields"] = array();
$tdatavw_Devotee_full[".printFields"][] = "DevoteeId";
$tdatavw_Devotee_full[".printFields"][] = "Address_AddressId";
$tdatavw_Devotee_full[".printFields"][] = "address_AddressLine1";
$tdatavw_Devotee_full[".printFields"][] = "address_AddressLine2";
$tdatavw_Devotee_full[".printFields"][] = "address_City";
$tdatavw_Devotee_full[".printFields"][] = "address_State";
$tdatavw_Devotee_full[".printFields"][] = "address_Pincode";
$tdatavw_Devotee_full[".printFields"][] = "address_Country";
$tdatavw_Devotee_full[".printFields"][] = "address_IsVerified";
$tdatavw_Devotee_full[".printFields"][] = "address_IsWrong";
$tdatavw_Devotee_full[".printFields"][] = "address_AddressTypeId";
$tdatavw_Devotee_full[".printFields"][] = "organization_OrgName";
$tdatavw_Devotee_full[".printFields"][] = "organization_OrgId";
$tdatavw_Devotee_full[".printFields"][] = "organization_OrgLeaderId";
$tdatavw_Devotee_full[".printFields"][] = "organization_OrgOwnerId";
$tdatavw_Devotee_full[".printFields"][] = "organization_Location";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_SericesRendered";
$tdatavw_Devotee_full[".printFields"][] = "SpiritualLife_DevoteeId";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_PreferedServices";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_Chanting16RoundsSince";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_IntroducedInCenter";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_YearOfIntroduction";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_PreviousReligion";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_SpiritualMasterDevoteeId";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_DateOfBrahmanInitiation";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_DateOfHarinamInitiation";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_SpiritulLifeId";
$tdatavw_Devotee_full[".printFields"][] = "spirituallife_IntroducedBy";
$tdatavw_Devotee_full[".printFields"][] = "company_CompanyId";
$tdatavw_Devotee_full[".printFields"][] = "company_CompanyName";
$tdatavw_Devotee_full[".printFields"][] = "company_AddressId";
$tdatavw_Devotee_full[".printFields"][] = "company_Remark";
$tdatavw_Devotee_full[".printFields"][] = "devoteelang_DevoteeLanguageId";
$tdatavw_Devotee_full[".printFields"][] = "devoteelang_WritingLevel";
$tdatavw_Devotee_full[".printFields"][] = "devoteelang_DevoteeId";
$tdatavw_Devotee_full[".printFields"][] = "devoteelang_LanguageId";
$tdatavw_Devotee_full[".printFields"][] = "devoteelang_SpeakingLevel";
$tdatavw_Devotee_full[".printFields"][] = "devoteelang_ReadingLevel";
$tdatavw_Devotee_full[".printFields"][] = "occupational_DevoteeOccupationalId";
$tdatavw_Devotee_full[".printFields"][] = "Occupational_DevoteeId";
$tdatavw_Devotee_full[".printFields"][] = "Occupational_Education";
$tdatavw_Devotee_full[".printFields"][] = "Occupational_Occupation";
$tdatavw_Devotee_full[".printFields"][] = "Occupational_Designation";
$tdatavw_Devotee_full[".printFields"][] = "Occupational_AwardsOrMerits";
$tdatavw_Devotee_full[".printFields"][] = "occupational_SkillsOrExperiences";
$tdatavw_Devotee_full[".printFields"][] = "occupational_CurrentCompanyId";
$tdatavw_Devotee_full[".printFields"][] = "addresstypes_AddressType";
$tdatavw_Devotee_full[".printFields"][] = "addresstypes_AddressTypeId";
$tdatavw_Devotee_full[".printFields"][] = "DevoteeOrg_DevoteeOrgId";
$tdatavw_Devotee_full[".printFields"][] = "DevoteeOrg_DevoteeId";
$tdatavw_Devotee_full[".printFields"][] = "DevoteeOrg_FromDate";
$tdatavw_Devotee_full[".printFields"][] = "DevoteeOrg_ToDate";
$tdatavw_Devotee_full[".printFields"][] = "DevoteeOrg_OrgId";
$tdatavw_Devotee_full[".printFields"][] = "devoteeaddress_devoteeaddressId";
$tdatavw_Devotee_full[".printFields"][] = "devoteeaddress_AddressId";
$tdatavw_Devotee_full[".printFields"][] = "devoteeaddress_DevoteeId";

//	TitleId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "TitleId";
	$fdata["GoodName"] = "TitleId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Title Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	$edata["autoCompleteFieldsOnEdit"] = 1;
	$edata["autoCompleteFields"] = array();
	$edata["autoCompleteFields"][] = array('masterF'=>"Gender", 'lookupF'=>"Gender");
				
		
			
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
	
		
		
	$tdatavw_Devotee_full["TitleId"] = $fdata;
//	Photo
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Photo";
	$fdata["GoodName"] = "Photo";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Photo"; 
	$fdata["FieldType"] = 128;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		
		
		$fdata["bExportPage"] = true; 
	
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
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_Devotee_full["Photo"] = $fdata;
//	FirstName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "FirstName";
	$fdata["GoodName"] = "FirstName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "First Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["FirstName"] = $fdata;
//	LastName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "LastName";
	$fdata["GoodName"] = "LastName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Last Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["LastName"] = $fdata;
//	MiddleName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "MiddleName";
	$fdata["GoodName"] = "MiddleName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Middle Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["MiddleName"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Gender"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Gender"; 
		$fdata["FullName"] = "devotee.Gender";
	
		
		
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
	
	$edata = array("EditFormat" => "Readonly");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_Devotee_full["Gender"] = $fdata;
//	DateOfBirth
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "DateOfBirth";
	$fdata["GoodName"] = "DateOfBirth";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Birth"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["DateOfBirth"] = $fdata;
//	MaritalStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "MaritalStatusId";
	$fdata["GoodName"] = "MaritalStatusId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Marital Status Id"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["MaritalStatusId"] = $fdata;
//	DateofMarriage
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "DateofMarriage";
	$fdata["GoodName"] = "DateofMarriage";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date of Marriage"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["DateofMarriage"] = $fdata;
//	SpouseDevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "SpouseDevoteeId";
	$fdata["GoodName"] = "SpouseDevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Spouse Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
				if(strpos(GetUserPermissions("vw_Devotee_full"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "DevoteeId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "DevoteeId";
	
		
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
	
		
		
	$tdatavw_Devotee_full["SpouseDevoteeId"] = $fdata;
//	MobilePhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "MobilePhone";
	$fdata["GoodName"] = "MobilePhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Mobile Phone"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["MobilePhone"] = $fdata;
//	WorkPhone
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "WorkPhone";
	$fdata["GoodName"] = "WorkPhone";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Work Phone"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["WorkPhone"] = $fdata;
//	EmailPrimary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "EmailPrimary";
	$fdata["GoodName"] = "EmailPrimary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Primary"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_Devotee_full["EmailPrimary"] = $fdata;
//	EmailSecondary
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "EmailSecondary";
	$fdata["GoodName"] = "EmailSecondary";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Email Secondary"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["EmailSecondary"] = $fdata;
//	Password
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "Password";
	$fdata["GoodName"] = "Password";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Password"; 
	$fdata["FieldType"] = 200;
	
		
		$fdata["bIsEncrypted"] = true; 
	
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		$fdata["bExportPage"] = true; 
	
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
		
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_Devotee_full["Password"] = $fdata;
//	address_AddressLine1
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "address_AddressLine1";
	$fdata["GoodName"] = "address_AddressLine1";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "Address Line1"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressLine1"; 
		$fdata["FullName"] = "address.AddressLine1";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_AddressLine1"] = $fdata;
//	address_AddressLine2
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "address_AddressLine2";
	$fdata["GoodName"] = "address_AddressLine2";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "Address Line2"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressLine2"; 
		$fdata["FullName"] = "address.AddressLine2";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_AddressLine2"] = $fdata;
//	address_City
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "address_City";
	$fdata["GoodName"] = "address_City";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "City"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "City"; 
		$fdata["FullName"] = "address.City";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_City"] = $fdata;
//	address_State
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "address_State";
	$fdata["GoodName"] = "address_State";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "State"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "State"; 
		$fdata["FullName"] = "address.`State`";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_State"] = $fdata;
//	address_Country
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "address_Country";
	$fdata["GoodName"] = "address_Country";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "Country"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Country"; 
		$fdata["FullName"] = "address.Country";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_Country"] = $fdata;
//	address_Pincode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "address_Pincode";
	$fdata["GoodName"] = "address_Pincode";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "Pincode"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Pincode"; 
		$fdata["FullName"] = "address.Pincode";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_Pincode"] = $fdata;
//	address_IsVerified
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 22;
	$fdata["strName"] = "address_IsVerified";
	$fdata["GoodName"] = "address_IsVerified";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "IsVerified"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "IsVerified"; 
		$fdata["FullName"] = "address.IsVerified";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_IsVerified"] = $fdata;
//	address_IsWrong
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 23;
	$fdata["strName"] = "address_IsWrong";
	$fdata["GoodName"] = "address_IsWrong";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "IsWrong"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "IsWrong"; 
		$fdata["FullName"] = "address.IsWrong";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_IsWrong"] = $fdata;
//	address_AddressTypeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 24;
	$fdata["strName"] = "address_AddressTypeId";
	$fdata["GoodName"] = "address_AddressTypeId";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "Address Type Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressTypeId"; 
		$fdata["FullName"] = "address.AddressTypeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["address_AddressTypeId"] = $fdata;
//	Occupational_DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 25;
	$fdata["strName"] = "Occupational_DevoteeId";
	$fdata["GoodName"] = "Occupational_DevoteeId";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "DevoteeId"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "occupational.DevoteeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["Occupational_DevoteeId"] = $fdata;
//	Occupational_Education
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 26;
	$fdata["strName"] = "Occupational_Education";
	$fdata["GoodName"] = "Occupational_Education";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "Education"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Education"; 
		$fdata["FullName"] = "occupational.Education";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["Occupational_Education"] = $fdata;
//	Occupational_Occupation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 27;
	$fdata["strName"] = "Occupational_Occupation";
	$fdata["GoodName"] = "Occupational_Occupation";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "Occupation"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Occupation"; 
		$fdata["FullName"] = "occupational.Occupation";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["Occupational_Occupation"] = $fdata;
//	Occupational_Designation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 28;
	$fdata["strName"] = "Occupational_Designation";
	$fdata["GoodName"] = "Occupational_Designation";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "Designation"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Designation"; 
		$fdata["FullName"] = "occupational.Designation";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["Occupational_Designation"] = $fdata;
//	Occupational_AwardsOrMerits
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 29;
	$fdata["strName"] = "Occupational_AwardsOrMerits";
	$fdata["GoodName"] = "Occupational_AwardsOrMerits";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "Awards Or Merits"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AwardsOrMerits"; 
		$fdata["FullName"] = "occupational.AwardsOrMerits";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["Occupational_AwardsOrMerits"] = $fdata;
//	occupational_SkillsOrExperiences
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 30;
	$fdata["strName"] = "occupational_SkillsOrExperiences";
	$fdata["GoodName"] = "occupational_SkillsOrExperiences";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "Skills Or Experiences"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SkillsOrJobExperiences"; 
		$fdata["FullName"] = "occupational.SkillsOrJobExperiences";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["occupational_SkillsOrExperiences"] = $fdata;
//	occupational_CurrentCompanyId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 31;
	$fdata["strName"] = "occupational_CurrentCompanyId";
	$fdata["GoodName"] = "occupational_CurrentCompanyId";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "Current Company Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "CurrentCompnayId"; 
		$fdata["FullName"] = "occupational.CurrentCompnayId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["occupational_CurrentCompanyId"] = $fdata;
//	organization_OrgId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 32;
	$fdata["strName"] = "organization_OrgId";
	$fdata["GoodName"] = "organization_OrgId";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "OrgId"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "OrgId"; 
		$fdata["FullName"] = "`organization`.OrgId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["organization_OrgId"] = $fdata;
//	organization_OrgName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 33;
	$fdata["strName"] = "organization_OrgName";
	$fdata["GoodName"] = "organization_OrgName";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "Org Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "OrgName"; 
		$fdata["FullName"] = "`organization`.OrgName";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["organization_OrgName"] = $fdata;
//	organization_OrgOwnerId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 34;
	$fdata["strName"] = "organization_OrgOwnerId";
	$fdata["GoodName"] = "organization_OrgOwnerId";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "OrgOwnerId"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "OrgOwnerId"; 
		$fdata["FullName"] = "`organization`.OrgOwnerId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["organization_OrgOwnerId"] = $fdata;
//	organization_OrgLeaderId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 35;
	$fdata["strName"] = "organization_OrgLeaderId";
	$fdata["GoodName"] = "organization_OrgLeaderId";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "OrgLeaderId"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "OrgLeaderId"; 
		$fdata["FullName"] = "`organization`.OrgLeaderId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["organization_OrgLeaderId"] = $fdata;
//	organization_Location
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 36;
	$fdata["strName"] = "organization_Location";
	$fdata["GoodName"] = "organization_Location";
	$fdata["ownerTable"] = "organization";
	$fdata["Label"] = "Location"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Location"; 
		$fdata["FullName"] = "`organization`.Location";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["organization_Location"] = $fdata;
//	spirituallife_SpiritulLifeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 37;
	$fdata["strName"] = "spirituallife_SpiritulLifeId";
	$fdata["GoodName"] = "spirituallife_SpiritulLifeId";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Spiritul Life Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SpiritualLifeId"; 
		$fdata["FullName"] = "spiritual_life.SpiritualLifeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_SpiritulLifeId"] = $fdata;
//	SpiritualLife_DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 38;
	$fdata["strName"] = "SpiritualLife_DevoteeId";
	$fdata["GoodName"] = "SpiritualLife_DevoteeId";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "spiritual_life.DevoteeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["SpiritualLife_DevoteeId"] = $fdata;
//	spirituallife_DateOfHarinamInitiation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 39;
	$fdata["strName"] = "spirituallife_DateOfHarinamInitiation";
	$fdata["GoodName"] = "spirituallife_DateOfHarinamInitiation";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Date Of Harinam Initiation"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DateOfHarinamInitiation"; 
		$fdata["FullName"] = "spiritual_life.DateOfHarinamInitiation";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_DateOfHarinamInitiation"] = $fdata;
//	spirituallife_DateOfBrahmanInitiation
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 40;
	$fdata["strName"] = "spirituallife_DateOfBrahmanInitiation";
	$fdata["GoodName"] = "spirituallife_DateOfBrahmanInitiation";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Date Of Brahman Initiation"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DateOfBrahmanInitiation"; 
		$fdata["FullName"] = "spiritual_life.DateOfBrahmanInitiation";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_DateOfBrahmanInitiation"] = $fdata;
//	spirituallife_SpiritualMasterDevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 41;
	$fdata["strName"] = "spirituallife_SpiritualMasterDevoteeId";
	$fdata["GoodName"] = "spirituallife_SpiritualMasterDevoteeId";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Spiritual Master Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SpiritualMasterDevoteeId"; 
		$fdata["FullName"] = "spiritual_life.SpiritualMasterDevoteeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_SpiritualMasterDevoteeId"] = $fdata;
//	spirituallife_PreviousReligion
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 42;
	$fdata["strName"] = "spirituallife_PreviousReligion";
	$fdata["GoodName"] = "spirituallife_PreviousReligion";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Previous Religion"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "PreviousReligion"; 
		$fdata["FullName"] = "spiritual_life.PreviousReligion";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_PreviousReligion"] = $fdata;
//	spirituallife_Chanting16RoundsSince
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 43;
	$fdata["strName"] = "spirituallife_Chanting16RoundsSince";
	$fdata["GoodName"] = "spirituallife_Chanting16RoundsSince";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Chanting 16 Rounds Since"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Chanting16RoundsSince"; 
		$fdata["FullName"] = "spiritual_life.Chanting16RoundsSince";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_Chanting16RoundsSince"] = $fdata;
//	spirituallife_IntroducedBy
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 44;
	$fdata["strName"] = "spirituallife_IntroducedBy";
	$fdata["GoodName"] = "spirituallife_IntroducedBy";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Introduced By"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "IntroducedBy"; 
		$fdata["FullName"] = "spiritual_life.IntroducedBy";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_IntroducedBy"] = $fdata;
//	spirituallife_YearOfIntroduction
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 45;
	$fdata["strName"] = "spirituallife_YearOfIntroduction";
	$fdata["GoodName"] = "spirituallife_YearOfIntroduction";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Year Of Introduction"; 
	$fdata["FieldType"] = 13;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "YearOfIntroduction"; 
		$fdata["FullName"] = "spiritual_life.YearOfIntroduction";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_YearOfIntroduction"] = $fdata;
//	spirituallife_IntroducedInCenter
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 46;
	$fdata["strName"] = "spirituallife_IntroducedInCenter";
	$fdata["GoodName"] = "spirituallife_IntroducedInCenter";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Introduced In Center"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "IntroducedInCenter"; 
		$fdata["FullName"] = "spiritual_life.IntroducedInCenter";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_IntroducedInCenter"] = $fdata;
//	spirituallife_PreferedServices
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 47;
	$fdata["strName"] = "spirituallife_PreferedServices";
	$fdata["GoodName"] = "spirituallife_PreferedServices";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Prefered Services"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "PreferedServices"; 
		$fdata["FullName"] = "spiritual_life.PreferedServices";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_PreferedServices"] = $fdata;
//	spirituallife_SericesRendered
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 48;
	$fdata["strName"] = "spirituallife_SericesRendered";
	$fdata["GoodName"] = "spirituallife_SericesRendered";
	$fdata["ownerTable"] = "spiritual_life";
	$fdata["Label"] = "Serices Rendered"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ServicesRendered"; 
		$fdata["FullName"] = "spiritual_life.ServicesRendered";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["spirituallife_SericesRendered"] = $fdata;
//	devoteeaddress_DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 49;
	$fdata["strName"] = "devoteeaddress_DevoteeId";
	$fdata["GoodName"] = "devoteeaddress_DevoteeId";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "DevoteeId"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee_address.DevoteeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteeaddress_DevoteeId"] = $fdata;
//	devoteeaddress_AddressId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 50;
	$fdata["strName"] = "devoteeaddress_AddressId";
	$fdata["GoodName"] = "devoteeaddress_AddressId";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "AddressId"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressId"; 
		$fdata["FullName"] = "devotee_address.AddressId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteeaddress_AddressId"] = $fdata;
//	devoteelang_DevoteeLanguageId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 51;
	$fdata["strName"] = "devoteelang_DevoteeLanguageId";
	$fdata["GoodName"] = "devoteelang_DevoteeLanguageId";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Devotee Language Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeLanguageId"; 
		$fdata["FullName"] = "devotee_language.DevoteeLanguageId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteelang_DevoteeLanguageId"] = $fdata;
//	devoteelang_DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 52;
	$fdata["strName"] = "devoteelang_DevoteeId";
	$fdata["GoodName"] = "devoteelang_DevoteeId";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee_language.DevoteeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteelang_DevoteeId"] = $fdata;
//	devoteelang_LanguageId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 53;
	$fdata["strName"] = "devoteelang_LanguageId";
	$fdata["GoodName"] = "devoteelang_LanguageId";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Language Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "LanguageId"; 
		$fdata["FullName"] = "devotee_language.LanguageId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteelang_LanguageId"] = $fdata;
//	devoteelang_SpeakingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 54;
	$fdata["strName"] = "devoteelang_SpeakingLevel";
	$fdata["GoodName"] = "devoteelang_SpeakingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Speaking Level"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "SpeakingLevel"; 
		$fdata["FullName"] = "devotee_language.SpeakingLevel";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteelang_SpeakingLevel"] = $fdata;
//	devoteelang_ReadingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 55;
	$fdata["strName"] = "devoteelang_ReadingLevel";
	$fdata["GoodName"] = "devoteelang_ReadingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Reading Level"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ReadingLevel"; 
		$fdata["FullName"] = "devotee_language.ReadingLevel";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteelang_ReadingLevel"] = $fdata;
//	devoteelang_WritingLevel
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 56;
	$fdata["strName"] = "devoteelang_WritingLevel";
	$fdata["GoodName"] = "devoteelang_WritingLevel";
	$fdata["ownerTable"] = "devotee_language";
	$fdata["Label"] = "Writing Level"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "WritingLevel"; 
		$fdata["FullName"] = "devotee_language.WritingLevel";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteelang_WritingLevel"] = $fdata;
//	addresstypes_AddressType
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 57;
	$fdata["strName"] = "addresstypes_AddressType";
	$fdata["GoodName"] = "addresstypes_AddressType";
	$fdata["ownerTable"] = "address_types";
	$fdata["Label"] = "Address Type"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressType"; 
		$fdata["FullName"] = "address_types.AddressType";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["addresstypes_AddressType"] = $fdata;
//	addresstypes_AddressTypeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 58;
	$fdata["strName"] = "addresstypes_AddressTypeId";
	$fdata["GoodName"] = "addresstypes_AddressTypeId";
	$fdata["ownerTable"] = "address_types";
	$fdata["Label"] = "AddressTypeId"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressTypeId"; 
		$fdata["FullName"] = "address_types.AddressTypeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["addresstypes_AddressTypeId"] = $fdata;
//	devoteeaddress_devoteeaddressId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 59;
	$fdata["strName"] = "devoteeaddress_devoteeaddressId";
	$fdata["GoodName"] = "devoteeaddress_devoteeaddressId";
	$fdata["ownerTable"] = "devotee_address";
	$fdata["Label"] = "Devotee Address Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeAddressId"; 
		$fdata["FullName"] = "devotee_address.DevoteeAddressId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["devoteeaddress_devoteeaddressId"] = $fdata;
//	Address_AddressId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 60;
	$fdata["strName"] = "Address_AddressId";
	$fdata["GoodName"] = "Address_AddressId";
	$fdata["ownerTable"] = "address";
	$fdata["Label"] = "Address Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressId"; 
		$fdata["FullName"] = "address.AddressId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["Address_AddressId"] = $fdata;
//	occupational_DevoteeOccupationalId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 61;
	$fdata["strName"] = "occupational_DevoteeOccupationalId";
	$fdata["GoodName"] = "occupational_DevoteeOccupationalId";
	$fdata["ownerTable"] = "occupational";
	$fdata["Label"] = "Devotee Occupational Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeOccupationalId"; 
		$fdata["FullName"] = "occupational.DevoteeOccupationalId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["occupational_DevoteeOccupationalId"] = $fdata;
//	DevoteeOrg_DevoteeOrgId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 62;
	$fdata["strName"] = "DevoteeOrg_DevoteeOrgId";
	$fdata["GoodName"] = "DevoteeOrg_DevoteeOrgId";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "Devotee Org Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeOrgId"; 
		$fdata["FullName"] = "devotee_org.DevoteeOrgId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["DevoteeOrg_DevoteeOrgId"] = $fdata;
//	DevoteeOrg_OrgId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 63;
	$fdata["strName"] = "DevoteeOrg_OrgId";
	$fdata["GoodName"] = "DevoteeOrg_OrgId";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "Org Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "OrgId"; 
		$fdata["FullName"] = "devotee_org.OrgId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["DevoteeOrg_OrgId"] = $fdata;
//	DevoteeOrg_DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 64;
	$fdata["strName"] = "DevoteeOrg_DevoteeId";
	$fdata["GoodName"] = "DevoteeOrg_DevoteeId";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "DevoteeId"; 
		$fdata["FullName"] = "devotee_org.DevoteeId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["DevoteeOrg_DevoteeId"] = $fdata;
//	DevoteeOrg_FromDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 65;
	$fdata["strName"] = "DevoteeOrg_FromDate";
	$fdata["GoodName"] = "DevoteeOrg_FromDate";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "From Date"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "FromDate"; 
		$fdata["FullName"] = "devotee_org.FromDate";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["DevoteeOrg_FromDate"] = $fdata;
//	DevoteeOrg_ToDate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 66;
	$fdata["strName"] = "DevoteeOrg_ToDate";
	$fdata["GoodName"] = "DevoteeOrg_ToDate";
	$fdata["ownerTable"] = "devotee_org";
	$fdata["Label"] = "To Date"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ToDate"; 
		$fdata["FullName"] = "devotee_org.ToDate";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["DevoteeOrg_ToDate"] = $fdata;
//	DevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 67;
	$fdata["strName"] = "DevoteeId";
	$fdata["GoodName"] = "DevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
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
	
		
		
	$tdatavw_Devotee_full["DevoteeId"] = $fdata;
//	company_CompanyId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 68;
	$fdata["strName"] = "company_CompanyId";
	$fdata["GoodName"] = "company_CompanyId";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "Company Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "CompanyId"; 
		$fdata["FullName"] = "company.CompanyId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["company_CompanyId"] = $fdata;
//	company_CompanyName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 69;
	$fdata["strName"] = "company_CompanyName";
	$fdata["GoodName"] = "company_CompanyName";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "Company Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "CompanyName"; 
		$fdata["FullName"] = "company.CompanyName";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["company_CompanyName"] = $fdata;
//	company_AddressId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 70;
	$fdata["strName"] = "company_AddressId";
	$fdata["GoodName"] = "company_AddressId";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "Address Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "AddressId"; 
		$fdata["FullName"] = "company.AddressId";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["company_AddressId"] = $fdata;
//	company_Remark
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 71;
	$fdata["strName"] = "company_Remark";
	$fdata["GoodName"] = "company_Remark";
	$fdata["ownerTable"] = "company";
	$fdata["Label"] = "Remark"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		
		$fdata["bEditPage"] = true; 
	
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Remark"; 
		$fdata["FullName"] = "company.Remark";
	
		
		
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
	
		
		
	$tdatavw_Devotee_full["company_Remark"] = $fdata;

	
$tables_data["vw_Devotee_full"]=&$tdatavw_Devotee_full;
$field_labels["vw_Devotee_full"] = &$fieldLabelsvw_Devotee_full;
$fieldToolTips["vw_Devotee_full"] = &$fieldToolTipsvw_Devotee_full;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_Devotee_full"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["vw_Devotee_full"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_vw_Devotee_full()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  address.AddressLine1 AS address_AddressLine1,  address.AddressLine2 AS address_AddressLine2,  address.City AS address_City,  address.`State` AS address_State,  address.Country AS address_Country,  address.Pincode AS address_Pincode,  address.IsVerified AS address_IsVerified,  address.IsWrong AS address_IsWrong,  address.AddressTypeId AS address_AddressTypeId,  occupational.DevoteeId AS occupational_DevoteeId,  occupational.Education AS occupational_Education,  occupational.Occupation AS occupational_Occupation,  occupational.Designation AS occupational_Designation,  occupational.AwardsOrMerits AS occupational_AwardsOrMerits,  occupational.SkillsOrJobExperiences AS occupational_SkillsOrExperiences,  occupational.CurrentCompnayId AS occupational_CurrentCompanyId,  `organization`.OrgId AS organization_OrgId,  `organization`.OrgName AS organization_OrgName,  `organization`.OrgOwnerId AS organization_OrgOwnerId,  `organization`.OrgLeaderId AS organization_OrgLeaderId,  `organization`.Location AS organization_Location,  spiritual_life.SpiritualLifeId AS spirituallife_SpiritulLifeId,  spiritual_life.DevoteeId AS spirituallife_DevoteeId,  spiritual_life.DateOfHarinamInitiation AS spirituallife_DateOfHarinamInitiation,  spiritual_life.DateOfBrahmanInitiation AS spirituallife_DateOfBrahmanInitiation,  spiritual_life.SpiritualMasterDevoteeId AS spirituallife_SpiritualMasterDevoteeId,  spiritual_life.PreviousReligion AS spirituallife_PreviousReligion,  spiritual_life.Chanting16RoundsSince AS spirituallife_Chanting16RoundsSince,  spiritual_life.IntroducedBy AS spirituallife_IntroducedBy,  spiritual_life.YearOfIntroduction AS spirituallife_YearOfIntroduction,  spiritual_life.IntroducedInCenter AS spirituallife_IntroducedInCenter,  spiritual_life.PreferedServices AS spirituallife_PreferedServices,  spiritual_life.ServicesRendered AS spirituallife_SericesRendered,  devotee_address.DevoteeId AS devoteeaddress_DevoteeId,  devotee_address.AddressId AS devoteeaddress_AddressId,  devotee_language.DevoteeLanguageId AS devoteelang_DevoteeLanguageId,  devotee_language.DevoteeId AS devoteelang_DevoteeId,  devotee_language.LanguageId AS devoteelang_LanguageId,  devotee_language.SpeakingLevel AS devoteelang_SpeakingLevel,  devotee_language.ReadingLevel AS devoteelang_ReadingLevel,  devotee_language.WritingLevel AS devoteelang_WritingLevel,  address_types.AddressType AS addresstypes_AddressType,  address_types.AddressTypeId AS addresstypes_AddressTypeId,  devotee_address.DevoteeAddressId AS devoteeaddress_devoteeaddressId,  address.AddressId AS Address_AddressId,  occupational.DevoteeOccupationalId AS occupational_DevoteeOccupationalId,  devotee_org.DevoteeOrgId AS devoteeorg_DevoteeOrgId,  devotee_org.OrgId AS devoteeorg_OrgId,  devotee_org.DevoteeId AS devoteeorg_DevoteeId,  devotee_org.FromDate AS devoteeorg_FromDate,  devotee_org.ToDate AS devoteeorg_ToDate,  devotee.DevoteeId,  company.CompanyId AS company_CompanyId,  company.CompanyName AS company_CompanyName,  company.AddressId AS company_AddressId,  company.Remark AS company_Remark";
$proto0["m_strFrom"] = "FROM devotee  LEFT OUTER JOIN devotee_address ON devotee.DevoteeId = devotee_address.DevoteeId  LEFT OUTER JOIN address ON devotee_address.AddressId = address.AddressId  LEFT OUTER JOIN occupational ON devotee.DevoteeId = occupational.DevoteeId  LEFT OUTER JOIN devotee_org ON devotee.DevoteeId = devotee_org.DevoteeId  LEFT OUTER JOIN `organization` ON devotee_org.OrgId = `organization`.OrgId  LEFT OUTER JOIN spiritual_life ON devotee.DevoteeId = spiritual_life.DevoteeId  LEFT OUTER JOIN devotee_language ON devotee.DevoteeId = devotee_language.DevoteeId  LEFT OUTER JOIN address_types ON address.AddressTypeId = address_types.AddressTypeId  LEFT OUTER JOIN company ON occupational.CurrentCompnayId = company.CompanyId";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("vw_Devotee_full");
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
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.TitleId"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.Photo"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.FirstName"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.LastName"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.MiddleName"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.Gender"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.DateOfBirth"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.MaritalStatusId"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.DateofMarriage"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.SpouseDevoteeId"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.MobilePhone"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.WorkPhone"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.EmailPrimary"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.EmailSecondary"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.Password"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.AddressLine1"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "address_AddressLine1";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.AddressLine2"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "address_AddressLine2";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.City"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "address_City";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
						$proto41=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.`State`"
));

$proto41["m_expr"]=$obj;
$proto41["m_alias"] = "address_State";
$obj = new SQLFieldListItem($proto41);

$proto0["m_fieldlist"][]=$obj;
						$proto43=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.Country"
));

$proto43["m_expr"]=$obj;
$proto43["m_alias"] = "address_Country";
$obj = new SQLFieldListItem($proto43);

$proto0["m_fieldlist"][]=$obj;
						$proto45=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.Pincode"
));

$proto45["m_expr"]=$obj;
$proto45["m_alias"] = "address_Pincode";
$obj = new SQLFieldListItem($proto45);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.IsVerified"
));

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "address_IsVerified";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
						$proto49=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.IsWrong"
));

$proto49["m_expr"]=$obj;
$proto49["m_alias"] = "address_IsWrong";
$obj = new SQLFieldListItem($proto49);

$proto0["m_fieldlist"][]=$obj;
						$proto51=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.AddressTypeId"
));

$proto51["m_expr"]=$obj;
$proto51["m_alias"] = "address_AddressTypeId";
$obj = new SQLFieldListItem($proto51);

$proto0["m_fieldlist"][]=$obj;
						$proto53=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.DevoteeId"
));

$proto53["m_expr"]=$obj;
$proto53["m_alias"] = "occupational_DevoteeId";
$obj = new SQLFieldListItem($proto53);

$proto0["m_fieldlist"][]=$obj;
						$proto55=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.Education"
));

$proto55["m_expr"]=$obj;
$proto55["m_alias"] = "occupational_Education";
$obj = new SQLFieldListItem($proto55);

$proto0["m_fieldlist"][]=$obj;
						$proto57=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.Occupation"
));

$proto57["m_expr"]=$obj;
$proto57["m_alias"] = "occupational_Occupation";
$obj = new SQLFieldListItem($proto57);

$proto0["m_fieldlist"][]=$obj;
						$proto59=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.Designation"
));

$proto59["m_expr"]=$obj;
$proto59["m_alias"] = "occupational_Designation";
$obj = new SQLFieldListItem($proto59);

$proto0["m_fieldlist"][]=$obj;
						$proto61=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.AwardsOrMerits"
));

$proto61["m_expr"]=$obj;
$proto61["m_alias"] = "occupational_AwardsOrMerits";
$obj = new SQLFieldListItem($proto61);

$proto0["m_fieldlist"][]=$obj;
						$proto63=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.SkillsOrJobExperiences"
));

$proto63["m_expr"]=$obj;
$proto63["m_alias"] = "occupational_SkillsOrExperiences";
$obj = new SQLFieldListItem($proto63);

$proto0["m_fieldlist"][]=$obj;
						$proto65=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.CurrentCompnayId"
));

$proto65["m_expr"]=$obj;
$proto65["m_alias"] = "occupational_CurrentCompanyId";
$obj = new SQLFieldListItem($proto65);

$proto0["m_fieldlist"][]=$obj;
						$proto67=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "`organization`.OrgId"
));

$proto67["m_expr"]=$obj;
$proto67["m_alias"] = "organization_OrgId";
$obj = new SQLFieldListItem($proto67);

$proto0["m_fieldlist"][]=$obj;
						$proto69=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "`organization`.OrgName"
));

$proto69["m_expr"]=$obj;
$proto69["m_alias"] = "organization_OrgName";
$obj = new SQLFieldListItem($proto69);

$proto0["m_fieldlist"][]=$obj;
						$proto71=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "`organization`.OrgOwnerId"
));

$proto71["m_expr"]=$obj;
$proto71["m_alias"] = "organization_OrgOwnerId";
$obj = new SQLFieldListItem($proto71);

$proto0["m_fieldlist"][]=$obj;
						$proto73=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "`organization`.OrgLeaderId"
));

$proto73["m_expr"]=$obj;
$proto73["m_alias"] = "organization_OrgLeaderId";
$obj = new SQLFieldListItem($proto73);

$proto0["m_fieldlist"][]=$obj;
						$proto75=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "`organization`.Location"
));

$proto75["m_expr"]=$obj;
$proto75["m_alias"] = "organization_Location";
$obj = new SQLFieldListItem($proto75);

$proto0["m_fieldlist"][]=$obj;
						$proto77=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.SpiritualLifeId"
));

$proto77["m_expr"]=$obj;
$proto77["m_alias"] = "spirituallife_SpiritulLifeId";
$obj = new SQLFieldListItem($proto77);

$proto0["m_fieldlist"][]=$obj;
						$proto79=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.DevoteeId"
));

$proto79["m_expr"]=$obj;
$proto79["m_alias"] = "spirituallife_DevoteeId";
$obj = new SQLFieldListItem($proto79);

$proto0["m_fieldlist"][]=$obj;
						$proto81=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.DateOfHarinamInitiation"
));

$proto81["m_expr"]=$obj;
$proto81["m_alias"] = "spirituallife_DateOfHarinamInitiation";
$obj = new SQLFieldListItem($proto81);

$proto0["m_fieldlist"][]=$obj;
						$proto83=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.DateOfBrahmanInitiation"
));

$proto83["m_expr"]=$obj;
$proto83["m_alias"] = "spirituallife_DateOfBrahmanInitiation";
$obj = new SQLFieldListItem($proto83);

$proto0["m_fieldlist"][]=$obj;
						$proto85=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.SpiritualMasterDevoteeId"
));

$proto85["m_expr"]=$obj;
$proto85["m_alias"] = "spirituallife_SpiritualMasterDevoteeId";
$obj = new SQLFieldListItem($proto85);

$proto0["m_fieldlist"][]=$obj;
						$proto87=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.PreviousReligion"
));

$proto87["m_expr"]=$obj;
$proto87["m_alias"] = "spirituallife_PreviousReligion";
$obj = new SQLFieldListItem($proto87);

$proto0["m_fieldlist"][]=$obj;
						$proto89=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.Chanting16RoundsSince"
));

$proto89["m_expr"]=$obj;
$proto89["m_alias"] = "spirituallife_Chanting16RoundsSince";
$obj = new SQLFieldListItem($proto89);

$proto0["m_fieldlist"][]=$obj;
						$proto91=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.IntroducedBy"
));

$proto91["m_expr"]=$obj;
$proto91["m_alias"] = "spirituallife_IntroducedBy";
$obj = new SQLFieldListItem($proto91);

$proto0["m_fieldlist"][]=$obj;
						$proto93=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.YearOfIntroduction"
));

$proto93["m_expr"]=$obj;
$proto93["m_alias"] = "spirituallife_YearOfIntroduction";
$obj = new SQLFieldListItem($proto93);

$proto0["m_fieldlist"][]=$obj;
						$proto95=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.IntroducedInCenter"
));

$proto95["m_expr"]=$obj;
$proto95["m_alias"] = "spirituallife_IntroducedInCenter";
$obj = new SQLFieldListItem($proto95);

$proto0["m_fieldlist"][]=$obj;
						$proto97=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.PreferedServices"
));

$proto97["m_expr"]=$obj;
$proto97["m_alias"] = "spirituallife_PreferedServices";
$obj = new SQLFieldListItem($proto97);

$proto0["m_fieldlist"][]=$obj;
						$proto99=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "spiritual_life.ServicesRendered"
));

$proto99["m_expr"]=$obj;
$proto99["m_alias"] = "spirituallife_SericesRendered";
$obj = new SQLFieldListItem($proto99);

$proto0["m_fieldlist"][]=$obj;
						$proto101=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_address.DevoteeId"
));

$proto101["m_expr"]=$obj;
$proto101["m_alias"] = "devoteeaddress_DevoteeId";
$obj = new SQLFieldListItem($proto101);

$proto0["m_fieldlist"][]=$obj;
						$proto103=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_address.AddressId"
));

$proto103["m_expr"]=$obj;
$proto103["m_alias"] = "devoteeaddress_AddressId";
$obj = new SQLFieldListItem($proto103);

$proto0["m_fieldlist"][]=$obj;
						$proto105=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.DevoteeLanguageId"
));

$proto105["m_expr"]=$obj;
$proto105["m_alias"] = "devoteelang_DevoteeLanguageId";
$obj = new SQLFieldListItem($proto105);

$proto0["m_fieldlist"][]=$obj;
						$proto107=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.DevoteeId"
));

$proto107["m_expr"]=$obj;
$proto107["m_alias"] = "devoteelang_DevoteeId";
$obj = new SQLFieldListItem($proto107);

$proto0["m_fieldlist"][]=$obj;
						$proto109=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.LanguageId"
));

$proto109["m_expr"]=$obj;
$proto109["m_alias"] = "devoteelang_LanguageId";
$obj = new SQLFieldListItem($proto109);

$proto0["m_fieldlist"][]=$obj;
						$proto111=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.SpeakingLevel"
));

$proto111["m_expr"]=$obj;
$proto111["m_alias"] = "devoteelang_SpeakingLevel";
$obj = new SQLFieldListItem($proto111);

$proto0["m_fieldlist"][]=$obj;
						$proto113=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.ReadingLevel"
));

$proto113["m_expr"]=$obj;
$proto113["m_alias"] = "devoteelang_ReadingLevel";
$obj = new SQLFieldListItem($proto113);

$proto0["m_fieldlist"][]=$obj;
						$proto115=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_language.WritingLevel"
));

$proto115["m_expr"]=$obj;
$proto115["m_alias"] = "devoteelang_WritingLevel";
$obj = new SQLFieldListItem($proto115);

$proto0["m_fieldlist"][]=$obj;
						$proto117=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address_types.AddressType"
));

$proto117["m_expr"]=$obj;
$proto117["m_alias"] = "addresstypes_AddressType";
$obj = new SQLFieldListItem($proto117);

$proto0["m_fieldlist"][]=$obj;
						$proto119=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address_types.AddressTypeId"
));

$proto119["m_expr"]=$obj;
$proto119["m_alias"] = "addresstypes_AddressTypeId";
$obj = new SQLFieldListItem($proto119);

$proto0["m_fieldlist"][]=$obj;
						$proto121=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_address.DevoteeAddressId"
));

$proto121["m_expr"]=$obj;
$proto121["m_alias"] = "devoteeaddress_devoteeaddressId";
$obj = new SQLFieldListItem($proto121);

$proto0["m_fieldlist"][]=$obj;
						$proto123=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "address.AddressId"
));

$proto123["m_expr"]=$obj;
$proto123["m_alias"] = "Address_AddressId";
$obj = new SQLFieldListItem($proto123);

$proto0["m_fieldlist"][]=$obj;
						$proto125=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "occupational.DevoteeOccupationalId"
));

$proto125["m_expr"]=$obj;
$proto125["m_alias"] = "occupational_DevoteeOccupationalId";
$obj = new SQLFieldListItem($proto125);

$proto0["m_fieldlist"][]=$obj;
						$proto127=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_org.DevoteeOrgId"
));

$proto127["m_expr"]=$obj;
$proto127["m_alias"] = "devoteeorg_DevoteeOrgId";
$obj = new SQLFieldListItem($proto127);

$proto0["m_fieldlist"][]=$obj;
						$proto129=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_org.OrgId"
));

$proto129["m_expr"]=$obj;
$proto129["m_alias"] = "devoteeorg_OrgId";
$obj = new SQLFieldListItem($proto129);

$proto0["m_fieldlist"][]=$obj;
						$proto131=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_org.DevoteeId"
));

$proto131["m_expr"]=$obj;
$proto131["m_alias"] = "devoteeorg_DevoteeId";
$obj = new SQLFieldListItem($proto131);

$proto0["m_fieldlist"][]=$obj;
						$proto133=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_org.FromDate"
));

$proto133["m_expr"]=$obj;
$proto133["m_alias"] = "devoteeorg_FromDate";
$obj = new SQLFieldListItem($proto133);

$proto0["m_fieldlist"][]=$obj;
						$proto135=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee_org.ToDate"
));

$proto135["m_expr"]=$obj;
$proto135["m_alias"] = "devoteeorg_ToDate";
$obj = new SQLFieldListItem($proto135);

$proto0["m_fieldlist"][]=$obj;
						$proto137=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "devotee.DevoteeId"
));

$proto137["m_expr"]=$obj;
$proto137["m_alias"] = "";
$obj = new SQLFieldListItem($proto137);

$proto0["m_fieldlist"][]=$obj;
						$proto139=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "company.CompanyId"
));

$proto139["m_expr"]=$obj;
$proto139["m_alias"] = "company_CompanyId";
$obj = new SQLFieldListItem($proto139);

$proto0["m_fieldlist"][]=$obj;
						$proto141=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "company.CompanyName"
));

$proto141["m_expr"]=$obj;
$proto141["m_alias"] = "company_CompanyName";
$obj = new SQLFieldListItem($proto141);

$proto0["m_fieldlist"][]=$obj;
						$proto143=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "company.AddressId"
));

$proto143["m_expr"]=$obj;
$proto143["m_alias"] = "company_AddressId";
$obj = new SQLFieldListItem($proto143);

$proto0["m_fieldlist"][]=$obj;
						$proto145=array();
$obj = new SQLNonParsed(array(
	"m_sql" => "company.Remark"
));

$proto145["m_expr"]=$obj;
$proto145["m_alias"] = "company_Remark";
$obj = new SQLFieldListItem($proto145);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto147=array();
$proto147["m_link"] = "SQLL_MAIN";
			$proto148=array();
$proto148["m_strName"] = "devotee";
$proto148["m_columns"] = array();
$proto148["m_columns"][] = "DevoteeId";
$proto148["m_columns"][] = "TitleId";
$proto148["m_columns"][] = "Photo";
$proto148["m_columns"][] = "FirstName";
$proto148["m_columns"][] = "LastName";
$proto148["m_columns"][] = "MiddleName";
$proto148["m_columns"][] = "Gender";
$proto148["m_columns"][] = "DateOfBirth";
$proto148["m_columns"][] = "MaritalStatusId";
$proto148["m_columns"][] = "DateofMarriage";
$proto148["m_columns"][] = "SpouseDevoteeId";
$proto148["m_columns"][] = "MobilePhone";
$proto148["m_columns"][] = "WorkPhone";
$proto148["m_columns"][] = "EmailPrimary";
$proto148["m_columns"][] = "EmailSecondary";
$proto148["m_columns"][] = "Password";
$proto148["m_columns"][] = "active";
$proto148["m_columns"][] = "CounsellorDevoteeID";
$proto148["m_columns"][] = "IsCounsellor";
$proto148["m_columns"][] = "NativeCity";
$proto148["m_columns"][] = "NativeState";
$proto148["m_columns"][] = "BloodGroup";
$proto148["m_columns"][] = "DateOfHarinamInitiation";
$proto148["m_columns"][] = "DateOfBrahmanInitiation";
$proto148["m_columns"][] = "SpiritualMasterId";
$proto148["m_columns"][] = "PreviousReligion";
$proto148["m_columns"][] = "Chanting16RoundsSince";
$proto148["m_columns"][] = "IntroducedBy";
$proto148["m_columns"][] = "YearOfIntroduction";
$proto148["m_columns"][] = "IntroducedInCenter";
$proto148["m_columns"][] = "PreferedServices";
$proto148["m_columns"][] = "ServicesRendered";
$proto148["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto148);

$proto147["m_table"] = $obj;
$proto147["m_alias"] = "";
$proto149=array();
$proto149["m_sql"] = "";
$proto149["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto149["m_column"]=$obj;
$proto149["m_contained"] = array();
$proto149["m_strCase"] = "";
$proto149["m_havingmode"] = "0";
$proto149["m_inBrackets"] = "0";
$proto149["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto149);

$proto147["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto147);

$proto0["m_fromlist"][]=$obj;
												$proto151=array();
$proto151["m_link"] = "SQLL_LEFTJOIN";
			$proto152=array();
$proto152["m_strName"] = "devotee_address";
$proto152["m_columns"] = array();
$proto152["m_columns"][] = "AddressId";
$proto152["m_columns"][] = "AddressLine1";
$proto152["m_columns"][] = "AddressLine2";
$proto152["m_columns"][] = "City";
$proto152["m_columns"][] = "State";
$proto152["m_columns"][] = "Country";
$proto152["m_columns"][] = "Pincode";
$proto152["m_columns"][] = "IsVerified";
$proto152["m_columns"][] = "IsWrong";
$proto152["m_columns"][] = "AddressTypeId";
$proto152["m_columns"][] = "DevoteeId";
$obj = new SQLTable($proto152);

$proto151["m_table"] = $obj;
$proto151["m_alias"] = "";
$proto153=array();
$proto153["m_sql"] = "devotee.DevoteeId = devotee_address.DevoteeId";
$proto153["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "DevoteeId",
	"m_strTable" => "devotee"
));

$proto153["m_column"]=$obj;
$proto153["m_contained"] = array();
$proto153["m_strCase"] = "= devotee_address.DevoteeId";
$proto153["m_havingmode"] = "0";
$proto153["m_inBrackets"] = "0";
$proto153["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto153);

$proto151["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto151);

$proto0["m_fromlist"][]=$obj;
												$proto155=array();
$proto155["m_link"] = "SQLL_MAIN";
			$proto156=array();
$proto156["m_strName"] = "address";
$proto156["m_columns"] = array();
$obj = new SQLTable($proto156);

$proto155["m_table"] = $obj;
$proto155["m_alias"] = "";
$proto157=array();
$proto157["m_sql"] = "";
$proto157["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto157["m_column"]=$obj;
$proto157["m_contained"] = array();
$proto157["m_strCase"] = "";
$proto157["m_havingmode"] = "0";
$proto157["m_inBrackets"] = "0";
$proto157["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto157);

$proto155["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto155);

$proto0["m_fromlist"][]=$obj;
												$proto159=array();
$proto159["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN occupational ON devotee.DevoteeId = occupational.DevoteeId"
));

$proto159["m_table"] = $obj;
$proto159["m_alias"] = "";
$proto161=array();
$proto161["m_sql"] = "";
$proto161["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto161["m_column"]=$obj;
$proto161["m_contained"] = array();
$proto161["m_strCase"] = "";
$proto161["m_havingmode"] = "0";
$proto161["m_inBrackets"] = "0";
$proto161["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto161);

$proto159["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto159);

$proto0["m_fromlist"][]=$obj;
												$proto163=array();
$proto163["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN devotee_org ON devotee.DevoteeId = devotee_org.DevoteeId"
));

$proto163["m_table"] = $obj;
$proto163["m_alias"] = "";
$proto165=array();
$proto165["m_sql"] = "";
$proto165["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto165["m_column"]=$obj;
$proto165["m_contained"] = array();
$proto165["m_strCase"] = "";
$proto165["m_havingmode"] = "0";
$proto165["m_inBrackets"] = "0";
$proto165["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto165);

$proto163["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto163);

$proto0["m_fromlist"][]=$obj;
												$proto167=array();
$proto167["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN `organization` ON devotee_org.OrgId = `organization`.OrgId"
));

$proto167["m_table"] = $obj;
$proto167["m_alias"] = "";
$proto169=array();
$proto169["m_sql"] = "";
$proto169["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto169["m_column"]=$obj;
$proto169["m_contained"] = array();
$proto169["m_strCase"] = "";
$proto169["m_havingmode"] = "0";
$proto169["m_inBrackets"] = "0";
$proto169["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto169);

$proto167["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto167);

$proto0["m_fromlist"][]=$obj;
												$proto171=array();
$proto171["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN spiritual_life ON devotee.DevoteeId = spiritual_life.DevoteeId"
));

$proto171["m_table"] = $obj;
$proto171["m_alias"] = "";
$proto173=array();
$proto173["m_sql"] = "";
$proto173["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto173["m_column"]=$obj;
$proto173["m_contained"] = array();
$proto173["m_strCase"] = "";
$proto173["m_havingmode"] = "0";
$proto173["m_inBrackets"] = "0";
$proto173["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto173);

$proto171["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto171);

$proto0["m_fromlist"][]=$obj;
												$proto175=array();
$proto175["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN devotee_language ON devotee.DevoteeId = devotee_language.DevoteeId"
));

$proto175["m_table"] = $obj;
$proto175["m_alias"] = "";
$proto177=array();
$proto177["m_sql"] = "";
$proto177["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto177["m_column"]=$obj;
$proto177["m_contained"] = array();
$proto177["m_strCase"] = "";
$proto177["m_havingmode"] = "0";
$proto177["m_inBrackets"] = "0";
$proto177["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto177);

$proto175["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto175);

$proto0["m_fromlist"][]=$obj;
												$proto179=array();
$proto179["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN address_types ON address.AddressTypeId = address_types.AddressTypeId"
));

$proto179["m_table"] = $obj;
$proto179["m_alias"] = "";
$proto181=array();
$proto181["m_sql"] = "";
$proto181["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto181["m_column"]=$obj;
$proto181["m_contained"] = array();
$proto181["m_strCase"] = "";
$proto181["m_havingmode"] = "0";
$proto181["m_inBrackets"] = "0";
$proto181["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto181);

$proto179["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto179);

$proto0["m_fromlist"][]=$obj;
												$proto183=array();
$proto183["m_link"] = "SQLL_MAIN";
$obj = new SQLNonParsed(array(
	"m_sql" => "LEFT OUTER JOIN company ON occupational.CurrentCompnayId = company.CompanyId"
));

$proto183["m_table"] = $obj;
$proto183["m_alias"] = "";
$proto185=array();
$proto185["m_sql"] = "";
$proto185["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto185["m_column"]=$obj;
$proto185["m_contained"] = array();
$proto185["m_strCase"] = "";
$proto185["m_havingmode"] = "0";
$proto185["m_inBrackets"] = "0";
$proto185["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto185);

$proto183["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto183);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_vw_Devotee_full = createSqlQuery_vw_Devotee_full();
																	 $queryData_vw_Devotee_full->m_fieldlist[14]->m_isEncrypted = true;
																																																								$tdatavw_Devotee_full[".sqlquery"] = $queryData_vw_Devotee_full;
	
if(isset($tdatavw_Devotee_full["field2"])){
	$tdatavw_Devotee_full["field2"]["LookupTable"] = "carscars_view";
	$tdatavw_Devotee_full["field2"]["LookupOrderBy"] = "name";
	$tdatavw_Devotee_full["field2"]["LookupType"] = 4;
	$tdatavw_Devotee_full["field2"]["LinkField"] = "email";
	$tdatavw_Devotee_full["field2"]["DisplayField"] = "name";
	$tdatavw_Devotee_full[".hasCustomViewField"] = true;
}

include_once(getabspath("include/vw_Devotee_full_events.php"));
$tableEvents["vw_Devotee_full"] = new eventclass_vw_Devotee_full;
$tdatavw_Devotee_full[".hasEvents"] = true;

$cipherer = new RunnerCipherer("vw_Devotee_full");

?>