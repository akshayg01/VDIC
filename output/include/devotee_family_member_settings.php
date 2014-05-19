<?php
require_once(getabspath("classes/cipherer.php"));
$tdatadevotee_family_member = array();
	$tdatadevotee_family_member[".NumberOfChars"] = 80; 
	$tdatadevotee_family_member[".ShortName"] = "devotee_family_member";
	$tdatadevotee_family_member[".OwnerID"] = "";
	$tdatadevotee_family_member[".OriginalTable"] = "devotee_family_member";

//	field labels
$fieldLabelsdevotee_family_member = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsdevotee_family_member["English"] = array();
	$fieldToolTipsdevotee_family_member["English"] = array();
	$fieldLabelsdevotee_family_member["English"]["Remark"] = "Remark";
	$fieldToolTipsdevotee_family_member["English"]["Remark"] = "";
	$fieldLabelsdevotee_family_member["English"]["FamilyMemberId"] = "Family Member Id";
	$fieldToolTipsdevotee_family_member["English"]["FamilyMemberId"] = "";
	$fieldLabelsdevotee_family_member["English"]["MemberName"] = "Member Name";
	$fieldToolTipsdevotee_family_member["English"]["MemberName"] = "";
	$fieldLabelsdevotee_family_member["English"]["MemberRelationshipId"] = "Relationship";
	$fieldToolTipsdevotee_family_member["English"]["MemberRelationshipId"] = "";
	$fieldLabelsdevotee_family_member["English"]["DateofBirth"] = "Date of Birth";
	$fieldToolTipsdevotee_family_member["English"]["DateofBirth"] = "";
	$fieldLabelsdevotee_family_member["English"]["DevoteeIdFamilyOwner"] = "Devotee Id Family Owner";
	$fieldToolTipsdevotee_family_member["English"]["DevoteeIdFamilyOwner"] = "";
	$fieldLabelsdevotee_family_member["English"]["DeovteeIdFamilyMember"] = "Family Member's Deovtee Id";
	$fieldToolTipsdevotee_family_member["English"]["DeovteeIdFamilyMember"] = "";
	if (count($fieldToolTipsdevotee_family_member["English"]))
		$tdatadevotee_family_member[".isUseToolTips"] = true;
}
	
	
	$tdatadevotee_family_member[".NCSearch"] = true;



$tdatadevotee_family_member[".shortTableName"] = "devotee_family_member";
$tdatadevotee_family_member[".nSecOptions"] = 0;
$tdatadevotee_family_member[".recsPerRowList"] = 1;
$tdatadevotee_family_member[".mainTableOwnerID"] = "";
$tdatadevotee_family_member[".moveNext"] = 1;
$tdatadevotee_family_member[".nType"] = 0;

$tdatadevotee_family_member[".strOriginalTableName"] = "devotee_family_member";




$tdatadevotee_family_member[".showAddInPopup"] = true;

$tdatadevotee_family_member[".showEditInPopup"] = true;

$tdatadevotee_family_member[".showViewInPopup"] = true;

$tdatadevotee_family_member[".fieldsForRegister"] = array();
	
if (!isMobile())
	$tdatadevotee_family_member[".listAjax"] = true;
else 
	$tdatadevotee_family_member[".listAjax"] = false;

	$tdatadevotee_family_member[".audit"] = true;

	$tdatadevotee_family_member[".locking"] = false;

$tdatadevotee_family_member[".listIcons"] = true;
$tdatadevotee_family_member[".edit"] = true;
$tdatadevotee_family_member[".inlineEdit"] = true;
$tdatadevotee_family_member[".inlineAdd"] = true;
$tdatadevotee_family_member[".copy"] = true;
$tdatadevotee_family_member[".view"] = true;

$tdatadevotee_family_member[".exportTo"] = true;

$tdatadevotee_family_member[".printFriendly"] = true;

$tdatadevotee_family_member[".delete"] = true;

$tdatadevotee_family_member[".showSimpleSearchOptions"] = true;

$tdatadevotee_family_member[".showSearchPanel"] = true;

if (isMobile())
	$tdatadevotee_family_member[".isUseAjaxSuggest"] = false;
else 
	$tdatadevotee_family_member[".isUseAjaxSuggest"] = true;

$tdatadevotee_family_member[".rowHighlite"] = true;

// button handlers file names

$tdatadevotee_family_member[".addPageEvents"] = false;

// use timepicker for search panel
$tdatadevotee_family_member[".isUseTimeForSearch"] = false;




$tdatadevotee_family_member[".allSearchFields"] = array();

$tdatadevotee_family_member[".allSearchFields"][] = "MemberName";
$tdatadevotee_family_member[".allSearchFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".allSearchFields"][] = "DateofBirth";
$tdatadevotee_family_member[".allSearchFields"][] = "Remark";

$tdatadevotee_family_member[".googleLikeFields"][] = "FamilyMemberId";
$tdatadevotee_family_member[".googleLikeFields"][] = "DevoteeIdFamilyOwner";
$tdatadevotee_family_member[".googleLikeFields"][] = "MemberName";
$tdatadevotee_family_member[".googleLikeFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".googleLikeFields"][] = "DateofBirth";
$tdatadevotee_family_member[".googleLikeFields"][] = "DeovteeIdFamilyMember";
$tdatadevotee_family_member[".googleLikeFields"][] = "Remark";

$tdatadevotee_family_member[".panelSearchFields"][] = "FamilyMemberId";
$tdatadevotee_family_member[".panelSearchFields"][] = "MemberName";
$tdatadevotee_family_member[".panelSearchFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".panelSearchFields"][] = "DateofBirth";
$tdatadevotee_family_member[".panelSearchFields"][] = "Remark";

$tdatadevotee_family_member[".advSearchFields"][] = "MemberName";
$tdatadevotee_family_member[".advSearchFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".advSearchFields"][] = "DateofBirth";
$tdatadevotee_family_member[".advSearchFields"][] = "Remark";

$tdatadevotee_family_member[".isTableType"] = "list";

	
$tdatadevotee_family_member[".isVerLayout"] = true;



// Access doesn't support subqueries from the same table as main



$tdatadevotee_family_member[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatadevotee_family_member[".strOrderBy"] = $tstrOrderBy;

$tdatadevotee_family_member[".orderindexes"] = array();

$tdatadevotee_family_member[".sqlHead"] = "SELECT FamilyMemberId,   DevoteeIdFamilyOwner,   MemberName,   MemberRelationshipId,   DateofBirth,   DeovteeIdFamilyMember,   Remark";
$tdatadevotee_family_member[".sqlFrom"] = "FROM devotee_family_member";
$tdatadevotee_family_member[".sqlWhereExpr"] = "";
$tdatadevotee_family_member[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadevotee_family_member[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadevotee_family_member[".arrGroupsPerPage"] = $arrGPP;

$tableKeysdevotee_family_member = array();
$tableKeysdevotee_family_member[] = "FamilyMemberId";
$tdatadevotee_family_member[".Keys"] = $tableKeysdevotee_family_member;

$tdatadevotee_family_member[".listFields"] = array();
$tdatadevotee_family_member[".listFields"][] = "MemberName";
$tdatadevotee_family_member[".listFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".listFields"][] = "DateofBirth";
$tdatadevotee_family_member[".listFields"][] = "Remark";

$tdatadevotee_family_member[".viewFields"] = array();
$tdatadevotee_family_member[".viewFields"][] = "MemberName";
$tdatadevotee_family_member[".viewFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".viewFields"][] = "DateofBirth";
$tdatadevotee_family_member[".viewFields"][] = "Remark";

$tdatadevotee_family_member[".addFields"] = array();
$tdatadevotee_family_member[".addFields"][] = "MemberName";
$tdatadevotee_family_member[".addFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".addFields"][] = "DateofBirth";
$tdatadevotee_family_member[".addFields"][] = "Remark";

$tdatadevotee_family_member[".inlineAddFields"] = array();
$tdatadevotee_family_member[".inlineAddFields"][] = "MemberName";
$tdatadevotee_family_member[".inlineAddFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".inlineAddFields"][] = "DateofBirth";
$tdatadevotee_family_member[".inlineAddFields"][] = "Remark";

$tdatadevotee_family_member[".editFields"] = array();
$tdatadevotee_family_member[".editFields"][] = "MemberName";
$tdatadevotee_family_member[".editFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".editFields"][] = "DateofBirth";
$tdatadevotee_family_member[".editFields"][] = "Remark";

$tdatadevotee_family_member[".inlineEditFields"] = array();
$tdatadevotee_family_member[".inlineEditFields"][] = "MemberName";
$tdatadevotee_family_member[".inlineEditFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".inlineEditFields"][] = "DateofBirth";
$tdatadevotee_family_member[".inlineEditFields"][] = "Remark";

$tdatadevotee_family_member[".exportFields"] = array();
$tdatadevotee_family_member[".exportFields"][] = "MemberName";
$tdatadevotee_family_member[".exportFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".exportFields"][] = "DateofBirth";
$tdatadevotee_family_member[".exportFields"][] = "Remark";

$tdatadevotee_family_member[".printFields"] = array();
$tdatadevotee_family_member[".printFields"][] = "MemberName";
$tdatadevotee_family_member[".printFields"][] = "MemberRelationshipId";
$tdatadevotee_family_member[".printFields"][] = "DateofBirth";
$tdatadevotee_family_member[".printFields"][] = "Remark";

//	FamilyMemberId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "FamilyMemberId";
	$fdata["GoodName"] = "FamilyMemberId";
	$fdata["ownerTable"] = "devotee_family_member";
	$fdata["Label"] = "Family Member Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "FamilyMemberId"; 
		$fdata["FullName"] = "FamilyMemberId";
	
		
		
				
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
	
		
		
	$tdatadevotee_family_member["FamilyMemberId"] = $fdata;
//	DevoteeIdFamilyOwner
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "DevoteeIdFamilyOwner";
	$fdata["GoodName"] = "DevoteeIdFamilyOwner";
	$fdata["ownerTable"] = "devotee_family_member";
	$fdata["Label"] = "Devotee Id Family Owner"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DevoteeIdFamilyOwner"; 
		$fdata["FullName"] = "DevoteeIdFamilyOwner";
	
		
		
				
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
	
		
		
	$tdatadevotee_family_member["DevoteeIdFamilyOwner"] = $fdata;
//	MemberName
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "MemberName";
	$fdata["GoodName"] = "MemberName";
	$fdata["ownerTable"] = "devotee_family_member";
	$fdata["Label"] = "Member Name"; 
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
	
		$fdata["strField"] = "MemberName"; 
		$fdata["FullName"] = "MemberName";
	
		
		
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
	$edata["autoCompleteFields"][] = array('masterF'=>"DateofBirth", 'lookupF'=>"DateOfBirth");
	$edata["autoCompleteFields"][] = array('masterF'=>"DeovteeIdFamilyMember", 'lookupF'=>"DevoteeId");
				if(strpos(GetUserPermissions("devotee_family_member"), 'S') !== false)
		$edata["LCType"] = 2;
	else 
		$edata["LCType"] = 0;
			
		
			
	$edata["LinkField"] = "FullName";
	$edata["LinkFieldType"] = 0;
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
	
		
		
	$tdatadevotee_family_member["MemberName"] = $fdata;
//	MemberRelationshipId
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "MemberRelationshipId";
	$fdata["GoodName"] = "MemberRelationshipId";
	$fdata["ownerTable"] = "devotee_family_member";
	$fdata["Label"] = "Relationship"; 
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
	
		$fdata["strField"] = "MemberRelationshipId"; 
		$fdata["FullName"] = "MemberRelationshipId";
	
		
		
				$fdata["FieldPermissions"] = true;
	
					
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
				
		
			
	$edata["LinkField"] = "RelationshipId";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "RelationshipName";
	
		
	$edata["LookupTable"] = "lu_family_relationship";
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
	
		
		
	$tdatadevotee_family_member["MemberRelationshipId"] = $fdata;
//	DateofBirth
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "DateofBirth";
	$fdata["GoodName"] = "DateofBirth";
	$fdata["ownerTable"] = "devotee_family_member";
	$fdata["Label"] = "Date of Birth"; 
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
	
		$fdata["strField"] = "DateofBirth"; 
		$fdata["FullName"] = "DateofBirth";
	
		
		
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
	
		
		
	$tdatadevotee_family_member["DateofBirth"] = $fdata;
//	DeovteeIdFamilyMember
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "DeovteeIdFamilyMember";
	$fdata["GoodName"] = "DeovteeIdFamilyMember";
	$fdata["ownerTable"] = "devotee_family_member";
	$fdata["Label"] = "Family Member's Deovtee Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		
		
		
		
		
		
		
		
		
		$fdata["strField"] = "DeovteeIdFamilyMember"; 
		$fdata["FullName"] = "DeovteeIdFamilyMember";
	
		
		
				
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

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
			//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatadevotee_family_member["DeovteeIdFamilyMember"] = $fdata;
//	Remark
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Remark";
	$fdata["GoodName"] = "Remark";
	$fdata["ownerTable"] = "devotee_family_member";
	$fdata["Label"] = "Remark"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Remark"; 
		$fdata["FullName"] = "Remark";
	
		
		
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
	
		
		
	$tdatadevotee_family_member["Remark"] = $fdata;

	
$tables_data["devotee_family_member"]=&$tdatadevotee_family_member;
$field_labels["devotee_family_member"] = &$fieldLabelsdevotee_family_member;
$fieldToolTips["devotee_family_member"] = &$fieldToolTipsdevotee_family_member;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["devotee_family_member"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["devotee_family_member"] = array();

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
	$masterTablesData["devotee_family_member"][$mIndex] = $masterParams;	
		$masterTablesData["devotee_family_member"][$mIndex]["masterKeys"][]="DevoteeId";
		$masterTablesData["devotee_family_member"][$mIndex]["detailKeys"][]="DevoteeIdFamilyOwner";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_devotee_family_member()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "FamilyMemberId,   DevoteeIdFamilyOwner,   MemberName,   MemberRelationshipId,   DateofBirth,   DeovteeIdFamilyMember,   Remark";
$proto0["m_strFrom"] = "FROM devotee_family_member";
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
	"m_strName" => "FamilyMemberId",
	"m_strTable" => "devotee_family_member"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "DevoteeIdFamilyOwner",
	"m_strTable" => "devotee_family_member"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "MemberName",
	"m_strTable" => "devotee_family_member"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "MemberRelationshipId",
	"m_strTable" => "devotee_family_member"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "DateofBirth",
	"m_strTable" => "devotee_family_member"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "DeovteeIdFamilyMember",
	"m_strTable" => "devotee_family_member"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Remark",
	"m_strTable" => "devotee_family_member"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto19=array();
$proto19["m_link"] = "SQLL_MAIN";
			$proto20=array();
$proto20["m_strName"] = "devotee_family_member";
$proto20["m_columns"] = array();
$proto20["m_columns"][] = "FamilyMemberId";
$proto20["m_columns"][] = "DevoteeIdFamilyOwner";
$proto20["m_columns"][] = "MemberName";
$proto20["m_columns"][] = "MemberRelationshipId";
$proto20["m_columns"][] = "DateofBirth";
$proto20["m_columns"][] = "DeovteeIdFamilyMember";
$proto20["m_columns"][] = "Remark";
$obj = new SQLTable($proto20);

$proto19["m_table"] = $obj;
$proto19["m_alias"] = "";
$proto21=array();
$proto21["m_sql"] = "";
$proto21["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto21["m_column"]=$obj;
$proto21["m_contained"] = array();
$proto21["m_strCase"] = "";
$proto21["m_havingmode"] = "0";
$proto21["m_inBrackets"] = "0";
$proto21["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto21);

$proto19["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto19);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_devotee_family_member = createSqlQuery_devotee_family_member();
							$tdatadevotee_family_member[".sqlquery"] = $queryData_devotee_family_member;
	
if(isset($tdatadevotee_family_member["field2"])){
	$tdatadevotee_family_member["field2"]["LookupTable"] = "carscars_view";
	$tdatadevotee_family_member["field2"]["LookupOrderBy"] = "name";
	$tdatadevotee_family_member["field2"]["LookupType"] = 4;
	$tdatadevotee_family_member["field2"]["LinkField"] = "email";
	$tdatadevotee_family_member["field2"]["DisplayField"] = "name";
	$tdatadevotee_family_member[".hasCustomViewField"] = true;
}

$tableEvents["devotee_family_member"] = new eventsBase;
$tdatadevotee_family_member[".hasEvents"] = false;

$cipherer = new RunnerCipherer("devotee_family_member");

?>