<?php
require_once(getabspath("classes/cipherer.php"));
$tdatavw_all_devotee = array();
	$tdatavw_all_devotee[".NumberOfChars"] = 80; 
	$tdatavw_all_devotee[".ShortName"] = "vw_all_devotee";
	$tdatavw_all_devotee[".OwnerID"] = "DevoteeId";
	$tdatavw_all_devotee[".OriginalTable"] = "devotee";

//	field labels
$fieldLabelsvw_all_devotee = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_all_devotee["English"] = array();
	$fieldToolTipsvw_all_devotee["English"] = array();
	$fieldLabelsvw_all_devotee["English"]["Photo"] = "Photo";
	$fieldToolTipsvw_all_devotee["English"]["Photo"] = "";
	$fieldLabelsvw_all_devotee["English"]["Gender"] = "Gender";
	$fieldToolTipsvw_all_devotee["English"]["Gender"] = "";
	$fieldLabelsvw_all_devotee["English"]["DevoteeId"] = "Devotee Id";
	$fieldToolTipsvw_all_devotee["English"]["DevoteeId"] = "";
	$fieldLabelsvw_all_devotee["English"]["FirstName"] = "First Name";
	$fieldToolTipsvw_all_devotee["English"]["FirstName"] = "";
	$fieldLabelsvw_all_devotee["English"]["LastName"] = "Last Name";
	$fieldToolTipsvw_all_devotee["English"]["LastName"] = "";
	$fieldLabelsvw_all_devotee["English"]["MiddleName"] = "Middle Name";
	$fieldToolTipsvw_all_devotee["English"]["MiddleName"] = "";
	$fieldLabelsvw_all_devotee["English"]["DateOfBirth"] = "Date Of Birth";
	$fieldToolTipsvw_all_devotee["English"]["DateOfBirth"] = "";
	$fieldLabelsvw_all_devotee["English"]["MaritalStatusId"] = "Marital Status Id";
	$fieldToolTipsvw_all_devotee["English"]["MaritalStatusId"] = "";
	$fieldLabelsvw_all_devotee["English"]["DateofMarriage"] = "Dateof Marriage";
	$fieldToolTipsvw_all_devotee["English"]["DateofMarriage"] = "";
	$fieldLabelsvw_all_devotee["English"]["SpouseDevoteeId"] = "Spouse Devotee Id";
	$fieldToolTipsvw_all_devotee["English"]["SpouseDevoteeId"] = "";
	$fieldLabelsvw_all_devotee["English"]["MobilePhone"] = "Mobile Phone";
	$fieldToolTipsvw_all_devotee["English"]["MobilePhone"] = "";
	$fieldLabelsvw_all_devotee["English"]["WorkPhone"] = "Work Phone";
	$fieldToolTipsvw_all_devotee["English"]["WorkPhone"] = "";
	$fieldLabelsvw_all_devotee["English"]["EmailPrimary"] = "Email Primary";
	$fieldToolTipsvw_all_devotee["English"]["EmailPrimary"] = "";
	$fieldLabelsvw_all_devotee["English"]["EmailSecondary"] = "Email Secondary";
	$fieldToolTipsvw_all_devotee["English"]["EmailSecondary"] = "";
	$fieldLabelsvw_all_devotee["English"]["Password"] = "Password";
	$fieldToolTipsvw_all_devotee["English"]["Password"] = "";
	$fieldLabelsvw_all_devotee["English"]["active"] = "Active";
	$fieldToolTipsvw_all_devotee["English"]["active"] = "";
	$fieldLabelsvw_all_devotee["English"]["CounsellorID"] = "Counsellor ID";
	$fieldToolTipsvw_all_devotee["English"]["CounsellorID"] = "";
	$fieldLabelsvw_all_devotee["English"]["HeorSheIsACounsellor"] = "Heor She Is ACounsellor";
	$fieldToolTipsvw_all_devotee["English"]["HeorSheIsACounsellor"] = "";
	$fieldLabelsvw_all_devotee["English"]["TitleId"] = "Title Id";
	$fieldToolTipsvw_all_devotee["English"]["TitleId"] = "";
	$fieldLabelsvw_all_devotee["English"]["Name"] = "Name";
	$fieldToolTipsvw_all_devotee["English"]["Name"] = "";
	$fieldLabelsvw_all_devotee["English"]["Counsellor"] = "Counsellor";
	$fieldToolTipsvw_all_devotee["English"]["Counsellor"] = "";
	if (count($fieldToolTipsvw_all_devotee["English"]))
		$tdatavw_all_devotee[".isUseToolTips"] = true;
}
	
	
	$tdatavw_all_devotee[".NCSearch"] = true;



$tdatavw_all_devotee[".shortTableName"] = "vw_all_devotee";
$tdatavw_all_devotee[".nSecOptions"] = 2;
$tdatavw_all_devotee[".recsPerRowList"] = 1;
$tdatavw_all_devotee[".mainTableOwnerID"] = "DevoteeId";
$tdatavw_all_devotee[".moveNext"] = 1;
$tdatavw_all_devotee[".nType"] = 1;

$tdatavw_all_devotee[".strOriginalTableName"] = "devotee";

$tdatavw_all_devotee[".hasEncryptedFields"] = true;



$tdatavw_all_devotee[".showAddInPopup"] = true;

$tdatavw_all_devotee[".showEditInPopup"] = true;

$tdatavw_all_devotee[".showViewInPopup"] = true;

$tdatavw_all_devotee[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatavw_all_devotee[".listAjax"] = true;
else 
	$tdatavw_all_devotee[".listAjax"] = false;

	$tdatavw_all_devotee[".audit"] = true;

	$tdatavw_all_devotee[".locking"] = false;

$tdatavw_all_devotee[".listIcons"] = true;
$tdatavw_all_devotee[".view"] = true;




$tdatavw_all_devotee[".showSimpleSearchOptions"] = true;

$tdatavw_all_devotee[".showSearchPanel"] = true;

if (isMobile())
	$tdatavw_all_devotee[".isUseAjaxSuggest"] = false;
else 
	$tdatavw_all_devotee[".isUseAjaxSuggest"] = true;

$tdatavw_all_devotee[".rowHighlite"] = true;

// button handlers file names

$tdatavw_all_devotee[".addPageEvents"] = false;

// use timepicker for search panel
$tdatavw_all_devotee[".isUseTimeForSearch"] = false;




$tdatavw_all_devotee[".allSearchFields"] = array();

$tdatavw_all_devotee[".allSearchFields"][] = "DevoteeId";
$tdatavw_all_devotee[".allSearchFields"][] = "FirstName";
$tdatavw_all_devotee[".allSearchFields"][] = "LastName";
$tdatavw_all_devotee[".allSearchFields"][] = "MiddleName";
$tdatavw_all_devotee[".allSearchFields"][] = "Gender";
$tdatavw_all_devotee[".allSearchFields"][] = "DateOfBirth";
$tdatavw_all_devotee[".allSearchFields"][] = "DateofMarriage";
$tdatavw_all_devotee[".allSearchFields"][] = "SpouseDevoteeId";
$tdatavw_all_devotee[".allSearchFields"][] = "MobilePhone";
$tdatavw_all_devotee[".allSearchFields"][] = "WorkPhone";
$tdatavw_all_devotee[".allSearchFields"][] = "EmailPrimary";
$tdatavw_all_devotee[".allSearchFields"][] = "EmailSecondary";
$tdatavw_all_devotee[".allSearchFields"][] = "CounsellorID";
$tdatavw_all_devotee[".allSearchFields"][] = "Name";
$tdatavw_all_devotee[".allSearchFields"][] = "Counsellor";
$tdatavw_all_devotee[".allSearchFields"][] = "TitleId";

$tdatavw_all_devotee[".googleLikeFields"][] = "DevoteeId";
$tdatavw_all_devotee[".googleLikeFields"][] = "FirstName";
$tdatavw_all_devotee[".googleLikeFields"][] = "LastName";
$tdatavw_all_devotee[".googleLikeFields"][] = "MiddleName";
$tdatavw_all_devotee[".googleLikeFields"][] = "Gender";
$tdatavw_all_devotee[".googleLikeFields"][] = "DateOfBirth";
$tdatavw_all_devotee[".googleLikeFields"][] = "MaritalStatusId";
$tdatavw_all_devotee[".googleLikeFields"][] = "DateofMarriage";
$tdatavw_all_devotee[".googleLikeFields"][] = "SpouseDevoteeId";
$tdatavw_all_devotee[".googleLikeFields"][] = "MobilePhone";
$tdatavw_all_devotee[".googleLikeFields"][] = "WorkPhone";
$tdatavw_all_devotee[".googleLikeFields"][] = "EmailPrimary";
$tdatavw_all_devotee[".googleLikeFields"][] = "EmailSecondary";
$tdatavw_all_devotee[".googleLikeFields"][] = "Password";
$tdatavw_all_devotee[".googleLikeFields"][] = "active";
$tdatavw_all_devotee[".googleLikeFields"][] = "CounsellorID";
$tdatavw_all_devotee[".googleLikeFields"][] = "HeorSheIsACounsellor";
$tdatavw_all_devotee[".googleLikeFields"][] = "Name";
$tdatavw_all_devotee[".googleLikeFields"][] = "Counsellor";
$tdatavw_all_devotee[".googleLikeFields"][] = "TitleId";


$tdatavw_all_devotee[".advSearchFields"][] = "DevoteeId";
$tdatavw_all_devotee[".advSearchFields"][] = "FirstName";
$tdatavw_all_devotee[".advSearchFields"][] = "LastName";
$tdatavw_all_devotee[".advSearchFields"][] = "MiddleName";
$tdatavw_all_devotee[".advSearchFields"][] = "Gender";
$tdatavw_all_devotee[".advSearchFields"][] = "DateOfBirth";
$tdatavw_all_devotee[".advSearchFields"][] = "DateofMarriage";
$tdatavw_all_devotee[".advSearchFields"][] = "SpouseDevoteeId";
$tdatavw_all_devotee[".advSearchFields"][] = "MobilePhone";
$tdatavw_all_devotee[".advSearchFields"][] = "WorkPhone";
$tdatavw_all_devotee[".advSearchFields"][] = "EmailPrimary";
$tdatavw_all_devotee[".advSearchFields"][] = "EmailSecondary";
$tdatavw_all_devotee[".advSearchFields"][] = "CounsellorID";
$tdatavw_all_devotee[".advSearchFields"][] = "Name";
$tdatavw_all_devotee[".advSearchFields"][] = "Counsellor";
$tdatavw_all_devotee[".advSearchFields"][] = "TitleId";

$tdatavw_all_devotee[".isTableType"] = "list";

	



// Access doesn't support subqueries from the same table as main


$tdatavw_all_devotee[".totalsFields"][] = array(
	"fName" => "DevoteeId", 
	"numRows" => 0,
	"totalsType" => "COUNT",
	"viewFormat" => '');

$tdatavw_all_devotee[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatavw_all_devotee[".strOrderBy"] = $tstrOrderBy;

$tdatavw_all_devotee[".orderindexes"] = array();

$tdatavw_all_devotee[".sqlHead"] = "SELECT devotee.DevoteeId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID AS CounsellorID,  devotee.IsCounsellor AS HeOrSheIsACounsellor,  Trim(concat(Salutations.Salutation, ' ',devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName)) AS Name,  TRIM(Concat(CounsellorSalutation.Salutation,' ',Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName)) AS Counsellor,  Counsellor.TitleId";
$tdatavw_all_devotee[".sqlFrom"] = "FROM devotee  LEFT OUTER JOIN devotee AS Counsellor ON devotee.CounsellorDevoteeID = Counsellor.DevoteeId  LEFT OUTER JOIN lu_salutations AS Salutations ON devotee.TitleId = Salutations.SalutationId  LEFT OUTER JOIN lu_salutations AS CounsellorSalutation ON Counsellor.TitleId = CounsellorSalutation.SalutationId";
$tdatavw_all_devotee[".sqlWhereExpr"] = "";
$tdatavw_all_devotee[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_all_devotee[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_all_devotee[".arrGroupsPerPage"] = $arrGPP;

$tableKeysvw_all_devotee = array();
$tableKeysvw_all_devotee[] = "DevoteeId";
$tdatavw_all_devotee[".Keys"] = $tableKeysvw_all_devotee;

$tdatavw_all_devotee[".listFields"] = array();
$tdatavw_all_devotee[".listFields"][] = "DevoteeId";
$tdatavw_all_devotee[".listFields"][] = "Name";
$tdatavw_all_devotee[".listFields"][] = "Counsellor";
$tdatavw_all_devotee[".listFields"][] = "MobilePhone";
$tdatavw_all_devotee[".listFields"][] = "WorkPhone";
$tdatavw_all_devotee[".listFields"][] = "EmailPrimary";
$tdatavw_all_devotee[".listFields"][] = "EmailSecondary";

$tdatavw_all_devotee[".viewFields"] = array();
$tdatavw_all_devotee[".viewFields"][] = "Photo";
$tdatavw_all_devotee[".viewFields"][] = "Name";
$tdatavw_all_devotee[".viewFields"][] = "Counsellor";
$tdatavw_all_devotee[".viewFields"][] = "DateOfBirth";
$tdatavw_all_devotee[".viewFields"][] = "MaritalStatusId";
$tdatavw_all_devotee[".viewFields"][] = "DateofMarriage";
$tdatavw_all_devotee[".viewFields"][] = "SpouseDevoteeId";
$tdatavw_all_devotee[".viewFields"][] = "MobilePhone";
$tdatavw_all_devotee[".viewFields"][] = "WorkPhone";
$tdatavw_all_devotee[".viewFields"][] = "EmailPrimary";
$tdatavw_all_devotee[".viewFields"][] = "EmailSecondary";

$tdatavw_all_devotee[".addFields"] = array();

$tdatavw_all_devotee[".inlineAddFields"] = array();

$tdatavw_all_devotee[".editFields"] = array();

$tdatavw_all_devotee[".inlineEditFields"] = array();

$tdatavw_all_devotee[".exportFields"] = array();

$tdatavw_all_devotee[".printFields"] = array();

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
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["DevoteeId"] = $fdata;
//	Photo
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Photo";
	$fdata["GoodName"] = "Photo";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Photo"; 
	$fdata["FieldType"] = 128;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		
		
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
	
		
		
	$tdatavw_all_devotee["Photo"] = $fdata;
//	FirstName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "FirstName";
	$fdata["GoodName"] = "FirstName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "First Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["FirstName"] = $fdata;
//	LastName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "LastName";
	$fdata["GoodName"] = "LastName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Last Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["LastName"] = $fdata;
//	MiddleName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "MiddleName";
	$fdata["GoodName"] = "MiddleName";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Middle Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["MiddleName"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Gender"; 
	$fdata["FieldType"] = 200;
	
		
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["Gender"] = $fdata;
//	DateOfBirth
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "DateOfBirth";
	$fdata["GoodName"] = "DateOfBirth";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Date Of Birth"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["DateOfBirth"] = $fdata;
//	MaritalStatusId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "MaritalStatusId";
	$fdata["GoodName"] = "MaritalStatusId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Marital Status Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		
		
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
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatavw_all_devotee["MaritalStatusId"] = $fdata;
//	DateofMarriage
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "DateofMarriage";
	$fdata["GoodName"] = "DateofMarriage";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Dateof Marriage"; 
	$fdata["FieldType"] = 7;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["DateofMarriage"] = $fdata;
//	SpouseDevoteeId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "SpouseDevoteeId";
	$fdata["GoodName"] = "SpouseDevoteeId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Spouse Devotee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
				if(strpos(GetUserPermissions("vw_all_devotee"), 'S') !== false)
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
	
		
		
	$tdatavw_all_devotee["SpouseDevoteeId"] = $fdata;
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
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["MobilePhone"] = $fdata;
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
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["WorkPhone"] = $fdata;
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
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["EmailPrimary"] = $fdata;
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
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["EmailSecondary"] = $fdata;
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
	
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "Password"; 
		$fdata["FullName"] = "devotee.Password";
	
		
		
				
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
	
		
		
	$tdatavw_all_devotee["Password"] = $fdata;
//	active
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "active";
	$fdata["GoodName"] = "active";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Active"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "active"; 
		$fdata["FullName"] = "devotee.active";
	
		
		
				
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
	
		
		
	$tdatavw_all_devotee["active"] = $fdata;
//	CounsellorID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "CounsellorID";
	$fdata["GoodName"] = "CounsellorID";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Counsellor ID"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdatavw_all_devotee["CounsellorID"] = $fdata;
//	HeorSheIsACounsellor
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "HeorSheIsACounsellor";
	$fdata["GoodName"] = "HeorSheIsACounsellor";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Heor She Is ACounsellor"; 
	$fdata["FieldType"] = 16;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "IsCounsellor"; 
		$fdata["FullName"] = "devotee.IsCounsellor";
	
		
		
				
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
	
		
		
	$tdatavw_all_devotee["HeorSheIsACounsellor"] = $fdata;
//	Name
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "Name";
	$fdata["GoodName"] = "Name";
	$fdata["ownerTable"] = "";
	$fdata["Label"] = "Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Name"; 
		$fdata["FullName"] = "Trim(concat(Salutations.Salutation, ' ',devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName))";
	
		
		
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
	
		
		
	$tdatavw_all_devotee["Name"] = $fdata;
//	Counsellor
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "Counsellor";
	$fdata["GoodName"] = "Counsellor";
	$fdata["ownerTable"] = "";
	$fdata["Label"] = "Counsellor"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Counsellor"; 
		$fdata["FullName"] = "TRIM(Concat(CounsellorSalutation.Salutation,' ',Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName))";
	
		
		
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
	
		
		
	$tdatavw_all_devotee["Counsellor"] = $fdata;
//	TitleId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "TitleId";
	$fdata["GoodName"] = "TitleId";
	$fdata["ownerTable"] = "devotee";
	$fdata["Label"] = "Title Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "TitleId"; 
		$fdata["FullName"] = "Counsellor.TitleId";
	
		
		
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
	
		
		
	$tdatavw_all_devotee["TitleId"] = $fdata;

	
$tables_data["vw_all_devotee"]=&$tdatavw_all_devotee;
$field_labels["vw_all_devotee"] = &$fieldLabelsvw_all_devotee;
$fieldToolTips["vw_all_devotee"] = &$fieldToolTipsvw_all_devotee;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_all_devotee"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["vw_all_devotee"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_vw_all_devotee()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "devotee.DevoteeId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID AS CounsellorID,  devotee.IsCounsellor AS HeOrSheIsACounsellor,  Trim(concat(Salutations.Salutation, ' ',devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName)) AS Name,  TRIM(Concat(CounsellorSalutation.Salutation,' ',Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName)) AS Counsellor,  Counsellor.TitleId";
$proto0["m_strFrom"] = "FROM devotee  LEFT OUTER JOIN devotee AS Counsellor ON devotee.CounsellorDevoteeID = Counsellor.DevoteeId  LEFT OUTER JOIN lu_salutations AS Salutations ON devotee.TitleId = Salutations.SalutationId  LEFT OUTER JOIN lu_salutations AS CounsellorSalutation ON Counsellor.TitleId = CounsellorSalutation.SalutationId";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = new RunnerCipherer("vw_all_devotee");
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
	"m_strName" => "Photo",
	"m_strTable" => "devotee"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "FirstName",
	"m_strTable" => "devotee"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "LastName",
	"m_strTable" => "devotee"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "MiddleName",
	"m_strTable" => "devotee"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Gender",
	"m_strTable" => "devotee"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "DateOfBirth",
	"m_strTable" => "devotee"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "MaritalStatusId",
	"m_strTable" => "devotee"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "DateofMarriage",
	"m_strTable" => "devotee"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "SpouseDevoteeId",
	"m_strTable" => "devotee"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "MobilePhone",
	"m_strTable" => "devotee"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "WorkPhone",
	"m_strTable" => "devotee"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailPrimary",
	"m_strTable" => "devotee"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "EmailSecondary",
	"m_strTable" => "devotee"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "Password",
	"m_strTable" => "devotee"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "active",
	"m_strTable" => "devotee"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
			$obj = new SQLField(array(
	"m_strName" => "CounsellorDevoteeID",
	"m_strTable" => "devotee"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "CounsellorID";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
			$obj = new SQLField(array(
	"m_strName" => "IsCounsellor",
	"m_strTable" => "devotee"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "HeOrSheIsACounsellor";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
						$proto41=array();
			$proto42=array();
$proto42["m_functiontype"] = "SQLF_CUSTOM";
$proto42["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "concat(Salutations.Salutation, ' ',devotee.FirstName, ' ' , devotee.MiddleName , ' ', devotee.LastName)"
));

$proto42["m_arguments"][]=$obj;
$proto42["m_strFunctionName"] = "Trim";
$obj = new SQLFunctionCall($proto42);

$proto41["m_expr"]=$obj;
$proto41["m_alias"] = "Name";
$obj = new SQLFieldListItem($proto41);

$proto0["m_fieldlist"][]=$obj;
						$proto44=array();
			$proto45=array();
$proto45["m_functiontype"] = "SQLF_CUSTOM";
$proto45["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "Concat(CounsellorSalutation.Salutation,' ',Counsellor.FirstName, ' ', Counsellor.MiddleName, ' ' ,Counsellor.LastName)"
));

$proto45["m_arguments"][]=$obj;
$proto45["m_strFunctionName"] = "TRIM";
$obj = new SQLFunctionCall($proto45);

$proto44["m_expr"]=$obj;
$proto44["m_alias"] = "Counsellor";
$obj = new SQLFieldListItem($proto44);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
			$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "Counsellor"
));

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto49=array();
$proto49["m_link"] = "SQLL_MAIN";
			$proto50=array();
$proto50["m_strName"] = "devotee";
$proto50["m_columns"] = array();
$proto50["m_columns"][] = "DevoteeId";
$proto50["m_columns"][] = "TitleId";
$proto50["m_columns"][] = "Photo";
$proto50["m_columns"][] = "FirstName";
$proto50["m_columns"][] = "LastName";
$proto50["m_columns"][] = "MiddleName";
$proto50["m_columns"][] = "Gender";
$proto50["m_columns"][] = "DateOfBirth";
$proto50["m_columns"][] = "MaritalStatusId";
$proto50["m_columns"][] = "DateofMarriage";
$proto50["m_columns"][] = "SpouseDevoteeId";
$proto50["m_columns"][] = "MobilePhone";
$proto50["m_columns"][] = "WorkPhone";
$proto50["m_columns"][] = "EmailPrimary";
$proto50["m_columns"][] = "EmailSecondary";
$proto50["m_columns"][] = "Password";
$proto50["m_columns"][] = "active";
$proto50["m_columns"][] = "CounsellorDevoteeID";
$proto50["m_columns"][] = "IsCounsellor";
$proto50["m_columns"][] = "NativeCity";
$proto50["m_columns"][] = "NativeState";
$proto50["m_columns"][] = "BloodGroup";
$proto50["m_columns"][] = "DateOfHarinamInitiation";
$proto50["m_columns"][] = "DateOfBrahmanInitiation";
$proto50["m_columns"][] = "SpiritualMasterId";
$proto50["m_columns"][] = "PreviousReligion";
$proto50["m_columns"][] = "Chanting16RoundsSince";
$proto50["m_columns"][] = "IntroducedBy";
$proto50["m_columns"][] = "YearOfIntroduction";
$proto50["m_columns"][] = "IntroducedInCenter";
$proto50["m_columns"][] = "PreferedServices";
$proto50["m_columns"][] = "ServicesRendered";
$proto50["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto50);

$proto49["m_table"] = $obj;
$proto49["m_alias"] = "";
$proto51=array();
$proto51["m_sql"] = "";
$proto51["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto51["m_column"]=$obj;
$proto51["m_contained"] = array();
$proto51["m_strCase"] = "";
$proto51["m_havingmode"] = "0";
$proto51["m_inBrackets"] = "0";
$proto51["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto51);

$proto49["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto49);

$proto0["m_fromlist"][]=$obj;
												$proto53=array();
$proto53["m_link"] = "SQLL_LEFTJOIN";
			$proto54=array();
$proto54["m_strName"] = "devotee";
$proto54["m_columns"] = array();
$proto54["m_columns"][] = "DevoteeId";
$proto54["m_columns"][] = "TitleId";
$proto54["m_columns"][] = "Photo";
$proto54["m_columns"][] = "FirstName";
$proto54["m_columns"][] = "LastName";
$proto54["m_columns"][] = "MiddleName";
$proto54["m_columns"][] = "Gender";
$proto54["m_columns"][] = "DateOfBirth";
$proto54["m_columns"][] = "MaritalStatusId";
$proto54["m_columns"][] = "DateofMarriage";
$proto54["m_columns"][] = "SpouseDevoteeId";
$proto54["m_columns"][] = "MobilePhone";
$proto54["m_columns"][] = "WorkPhone";
$proto54["m_columns"][] = "EmailPrimary";
$proto54["m_columns"][] = "EmailSecondary";
$proto54["m_columns"][] = "Password";
$proto54["m_columns"][] = "active";
$proto54["m_columns"][] = "CounsellorDevoteeID";
$proto54["m_columns"][] = "IsCounsellor";
$proto54["m_columns"][] = "NativeCity";
$proto54["m_columns"][] = "NativeState";
$proto54["m_columns"][] = "BloodGroup";
$proto54["m_columns"][] = "DateOfHarinamInitiation";
$proto54["m_columns"][] = "DateOfBrahmanInitiation";
$proto54["m_columns"][] = "SpiritualMasterId";
$proto54["m_columns"][] = "PreviousReligion";
$proto54["m_columns"][] = "Chanting16RoundsSince";
$proto54["m_columns"][] = "IntroducedBy";
$proto54["m_columns"][] = "YearOfIntroduction";
$proto54["m_columns"][] = "IntroducedInCenter";
$proto54["m_columns"][] = "PreferedServices";
$proto54["m_columns"][] = "ServicesRendered";
$proto54["m_columns"][] = "InitiatedName";
$obj = new SQLTable($proto54);

$proto53["m_table"] = $obj;
$proto53["m_alias"] = "Counsellor";
$proto55=array();
$proto55["m_sql"] = "devotee.CounsellorDevoteeID = Counsellor.DevoteeId";
$proto55["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "CounsellorDevoteeID",
	"m_strTable" => "devotee"
));

$proto55["m_column"]=$obj;
$proto55["m_contained"] = array();
$proto55["m_strCase"] = "= Counsellor.DevoteeId";
$proto55["m_havingmode"] = "0";
$proto55["m_inBrackets"] = "0";
$proto55["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto55);

$proto53["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto53);

$proto0["m_fromlist"][]=$obj;
												$proto57=array();
$proto57["m_link"] = "SQLL_LEFTJOIN";
			$proto58=array();
$proto58["m_strName"] = "lu_salutations";
$proto58["m_columns"] = array();
$proto58["m_columns"][] = "SalutationId";
$proto58["m_columns"][] = "Salutation";
$proto58["m_columns"][] = "Gender";
$obj = new SQLTable($proto58);

$proto57["m_table"] = $obj;
$proto57["m_alias"] = "Salutations";
$proto59=array();
$proto59["m_sql"] = "devotee.TitleId = Salutations.SalutationId";
$proto59["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "devotee"
));

$proto59["m_column"]=$obj;
$proto59["m_contained"] = array();
$proto59["m_strCase"] = "= Salutations.SalutationId";
$proto59["m_havingmode"] = "0";
$proto59["m_inBrackets"] = "0";
$proto59["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto59);

$proto57["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto57);

$proto0["m_fromlist"][]=$obj;
												$proto61=array();
$proto61["m_link"] = "SQLL_LEFTJOIN";
			$proto62=array();
$proto62["m_strName"] = "lu_salutations";
$proto62["m_columns"] = array();
$proto62["m_columns"][] = "SalutationId";
$proto62["m_columns"][] = "Salutation";
$proto62["m_columns"][] = "Gender";
$obj = new SQLTable($proto62);

$proto61["m_table"] = $obj;
$proto61["m_alias"] = "CounsellorSalutation";
$proto63=array();
$proto63["m_sql"] = "Counsellor.TitleId = CounsellorSalutation.SalutationId";
$proto63["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "TitleId",
	"m_strTable" => "Counsellor"
));

$proto63["m_column"]=$obj;
$proto63["m_contained"] = array();
$proto63["m_strCase"] = "= CounsellorSalutation.SalutationId";
$proto63["m_havingmode"] = "0";
$proto63["m_inBrackets"] = "0";
$proto63["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto63);

$proto61["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto61);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_vw_all_devotee = createSqlQuery_vw_all_devotee();
																	 $queryData_vw_all_devotee->m_fieldlist[14]->m_isEncrypted = true;
						$tdatavw_all_devotee[".sqlquery"] = $queryData_vw_all_devotee;
	
if(isset($tdatavw_all_devotee["field2"])){
	$tdatavw_all_devotee["field2"]["LookupTable"] = "carscars_view";
	$tdatavw_all_devotee["field2"]["LookupOrderBy"] = "name";
	$tdatavw_all_devotee["field2"]["LookupType"] = 4;
	$tdatavw_all_devotee["field2"]["LinkField"] = "email";
	$tdatavw_all_devotee["field2"]["DisplayField"] = "name";
	$tdatavw_all_devotee[".hasCustomViewField"] = true;
}

$tableEvents["vw_all_devotee"] = new eventsBase;
$tdatavw_all_devotee[".hasEvents"] = false;

$cipherer = new RunnerCipherer("vw_all_devotee");

?>