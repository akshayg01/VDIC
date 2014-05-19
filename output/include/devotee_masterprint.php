<?php
include_once(getabspath("include/devotee_settings.php"));

function DisplayMasterTableInfo_devotee($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="devotee";

//$strSQL = "SELECT  devotee.DevoteeId,  devotee.TitleId,  devotee.Photo,  devotee.FirstName,  devotee.LastName,  devotee.MiddleName,  devotee.Gender,  devotee.DateOfBirth,  devotee.MaritalStatusId,  devotee.DateofMarriage,  devotee.SpouseDevoteeId,  devotee.MobilePhone,  devotee.WorkPhone,  devotee.EmailPrimary,  devotee.EmailSecondary,  devotee.Password,  devotee.active,  devotee.CounsellorDevoteeID,  devotee.IsCounsellor,  devotee.NativeCity,  devotee.NativeState,  devotee.BloodGroup,  devotee.DateOfHarinamInitiation,  devotee.DateOfBrahmanInitiation,  devotee.SpiritualMasterId,  devotee.PreviousReligion,  devotee.Chanting16RoundsSince,  devotee.IntroducedBy,  devotee.YearOfIntroduction,  devotee.IntroducedInCenter,  devotee.PreferedServices,  devotee.ServicesRendered,  devotee.InitiatedName,  trim(concat(salutations.Salutation,' ',devotee.FirstName,' ',devotee.MiddleName,' ',devotee.LastName)) AS FullName  FROM devotee  LEFT OUTER JOIN lu_salutations AS salutations ON devotee.TitleId = salutations.SalutationId  ";

	$cipherer = new RunnerCipherer($strTableName);
	$settings = new ProjectSettings($strTableName, PAGE_PRINT);
	
	$masterQuery = $settings->getSQLQuery();
	$viewControls = new ViewControlsContainer($settings, PAGE_PRINT);

$where="";

global $pageObject, $page_styles, $page_layouts, $page_layout_names, $container_styles;
$layout = new TLayout("masterprint","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["0"] = array();

$layout->containers["0"][] = array("name"=>"masterprintheader","block"=>"","substyle"=>1);


$layout->skins["0"] = "empty";
$layout->blocks["bare"][] = "0";
$layout->containers["mastergrid"] = array();

$layout->containers["mastergrid"][] = array("name"=>"masterprintfields","block"=>"","substyle"=>1);


$layout->skins["mastergrid"] = "grid";
$layout->blocks["bare"][] = "mastergrid";$page_layouts["devotee_masterprint"] = $layout;


$showKeys = "";
if($detailtable=="devotee_address")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="devotee_donation")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="devotee_language")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="devotee_org")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="devotee_family_member")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="devotee_company")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="counsellor_counsellee")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if(!$where)
{
	$strTableName=$oldTableName;
	return;
}
	$str = SecuritySQL("Export");
	if(strlen($str))
		$where.=" and ".$str;
	
	$strWhere = whereAdd($masterQuery->m_where->toSql($masterQuery),$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	$strSQL = $masterQuery->HeadToSql().' '.$masterQuery->FromToSql().$strWhere.$masterQuery->TailToSql();

//	$strSQL=AddWhere($strSQL,$where);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$data = $cipherer->DecryptFetchedArray($rs);
	if(!$data)
	{
		$strTableName=$oldTableName;
		return;
	}
	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));
	

//	MobilePhone - 
			$xt->assign("MobilePhone_mastervalue", $viewControls->showDBValue("MobilePhone", $data, $keylink));

//	EmailPrimary - 
			$xt->assign("EmailPrimary_mastervalue", $viewControls->showDBValue("EmailPrimary", $data, $keylink));

//	InitiatedName - 
			$xt->assign("InitiatedName_mastervalue", $viewControls->showDBValue("InitiatedName", $data, $keylink));

//	FullName - 
			$xt->assign("FullName_mastervalue", $viewControls->showDBValue("FullName", $data, $keylink));
	$xt->display("devotee_masterprint.htm");
	$strTableName=$oldTableName;

}

?>