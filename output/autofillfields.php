<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 


$mainTable = postvalue('mainTable');
$fullMainTable = GetTableByShort($mainTable);
$pageType = postvalue('pageType');

if (!checkTableName($mainTable))
	exit(0);
include("include/".$mainTable."_variables.php");

$gSettings = new ProjectSettings($fullMainTable, $pageType);

$mainField = postvalue('mainField');
$linkFieldName = postvalue('linkField');

$strDataSourceTable = $gSettings->getOriginalTableName();
$strLoginTable = "devotee";
if ($strDataSourceTable != $strLoginTable)
{
	if(!isLogged()) { 
		return;	
	}
	if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) { return;	}
}
else 
{
	$checkResult = true;
	if($mainField=="EmailPrimary")
		$checkResult=false;

	if($mainField=="")
		$checkResult=false;

	if($mainField=="Password")
		$checkResult=false;

	if($mainField=="FirstName")
		$checkResult=false;

	if($mainField=="LastName")
		$checkResult=false;

	if($checkResult)
	{
		if(!isLogged()) { return;}
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) { return;	}
	}
}
$autoCompleteFields = array();

if($strTableName == "devotee_family_member" && $mainField == "MemberName"){
	$autoCompleteFields[] = array('masterF'=>"DateofBirth", 'lookupF'=>"DateOfBirth");
	$autoCompleteFields[] = array('masterF'=>"DeovteeIdFamilyMember", 'lookupF'=>"DevoteeId");
$lookupTable = "devotee";	
}
if($strTableName == "devotee_company" && $mainField == "CompanyId"){
	$autoCompleteFields[] = array('masterF'=>"Location", 'lookupF'=>"CompanyLocation");
$lookupTable = "company";	
}
if($strTableName == "vw_counsellee" && $mainField == "TitleId"){
	$autoCompleteFields[] = array('masterF'=>"Gender", 'lookupF'=>"Gender");
$lookupTable = "lu_salutations";	
}
if($strTableName == "vw_OwnProfile" && $mainField == "TitleId"){
	$autoCompleteFields[] = array('masterF'=>"Gender", 'lookupF'=>"Gender");
$lookupTable = "lu_salutations";	
}
if($strTableName == "vw_Devotee_full" && $mainField == "TitleId"){
	$autoCompleteFields[] = array('masterF'=>"Gender", 'lookupF'=>"Gender");
$lookupTable = "lu_salutations";	
}
if($strTableName == "vw_counsellee_temp" && $mainField == "TitleId"){
	$autoCompleteFields[] = array('masterF'=>"Gender", 'lookupF'=>"Gender");
$lookupTable = "lu_salutations";	
}

$nLookupType = $gSettings->getLookupType($mainField);
$cipherer = new RunnerCipherer($nLookupType == LT_QUERY ? $lookupTable : $fullMainTable);
$linkFieldVal = postvalue('linkFieldVal');
$linkFieldVal = $cipherer->MakeDBValue($nLookupType == LT_QUERY ? $linkFieldName : $mainField, $linkFieldVal, "", "", true);
$strLookupWhere = GetLWWhere($mainField, $pageType, $strTableName);
if($nLookupType == LT_QUERY)
{
	$lookupSettings = new ProjectSettings($lookupTable, $pageType);
	$lookupQueryObj = $lookupSettings->getSQLQuery();
	$lookupQueryObj->ReplaceFieldsWithDummies($lookupSettings->getBinaryFieldsIndices());
	$strWhere = whereAdd($lookupQueryObj->m_where->toSql($lookupQueryObj), 
		GetFullFieldName($linkFieldName, $lookupTable, false).'='.$linkFieldVal);
	$strWhere = whereAdd($strWhere, $strLookupWhere);
	$strSQL = $lookupQueryObj->toSql(whereAdd($lookupQueryObj->m_where->toSql($lookupQueryObj), $strWhere));
}else{
	$strSQL = 'SELECT ';
	for($i=0; $i<count($autoCompleteFields); $i++){
		$strSQL .= AddFieldWrappers($autoCompleteFields[$i]['lookupF']).', ';
	}
	$strSQL = substr($strSQL, 0, strlen($strSQL)-2);
	
	$strSQL .= " FROM ".AddTableWrappers($lookupTable);
	$linkFieldName = $cipherer->GetLookupFieldName(AddFieldWrappers($linkFieldName), $strTableName, $mainField);
	$strWhere = $linkFieldName.'='.$linkFieldVal;
	$strWhere = whereAdd($strWhere, $strLookupWhere);
	$strSQL .= " WHERE ".$strWhere;
}

$rs = db_query($strSQL, $conn);	
if($nLookupType == LT_QUERY)
	$row =  $cipherer->DecryptFetchedArray($rs);
else 
	$row = db_fetch_array($rs);
db_close($conn);
if(is_null($row))
	$row = array($mainField=>'');
	
echo "<textarea>".htmlspecialchars(my_json_encode(array('success'=>true, 'data'=>$row)))."</textarea>";
?>