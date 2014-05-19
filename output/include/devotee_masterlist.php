<?php
include_once(getabspath("include/devotee_settings.php"));

function DisplayMasterTableInfo_devotee($params)
{
	$detailtable = $params["detailtable"];
	$keys = $params["keys"];
	$detailPageObj = $params["detailPageObj"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	$oldTableName = $strTableName;
	$strTableName = "devotee";
	
	$settings = new ProjectSettings($strTableName, PAGE_LIST);
	$cipherer = new RunnerCipherer($strTableName);
	
	$masterQuery = $settings->getSQLQuery();
	
	$viewControls = new ViewControlsContainer($settings, PAGE_LIST);

$where = "";
$mKeys = array();
$showKeys = "";

global $page_styles, $page_layouts, $page_layout_names, $container_styles;

$layout = new TLayout("masterlist","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["0"] = array();

$layout->containers["0"][] = array("name"=>"masterlistheader","block"=>"","substyle"=>1);


$layout->skins["0"] = "empty";
$layout->blocks["bare"][] = "0";
$layout->containers["mastergrid"] = array();

$layout->containers["mastergrid"][] = array("name"=>"masterlistfields","block"=>"","substyle"=>1);


$layout->skins["mastergrid"] = "grid";
$layout->blocks["bare"][] = "mastergrid";$page_layouts["devotee_masterlist"] = $layout;


if($detailtable == "devotee_address")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "devotee_donation")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "devotee_language")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "devotee_org")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "devotee_family_member")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "devotee_company")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable == "counsellor_counsellee")
{
		$where.= GetFullFieldName("DevoteeId", "", false)."=".$cipherer->MakeDBValue("DevoteeId",$keys[1-1], "", "", true);
	$showKeys .= " "."Devotee Id".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
	if(!$where)
	{
		$strTableName = $oldTableName;
		return;
	}
	$str = SecuritySQL("Search");
	if(strlen($str))
		$where.= " and ".$str;

	$strWhere = whereAdd($masterQuery->WhereToSql(),$where);
	if(strlen($strWhere))
		$strWhere = " where ".$strWhere." ";
	$strSQL = $masterQuery->HeadToSql().' '.$masterQuery->FromToSql().$strWhere.$masterQuery->TailToSql();

//	$strSQL = AddWhere($strSQL,$where);
	LogInfo($strSQL);
	$rs = db_query($strSQL,$conn);
	$data = $cipherer->DecryptFetchedArray($rs);
	if(!$data)
	{
		$strTableName = $oldTableName;
		return;
	}
	$keylink = "";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));
	

//	MobilePhone - 
			$value="";

					$xt->assign("MobilePhone_mastervalue", $viewControls->showDBValue("MobilePhone", $data, $keylink));

//	EmailPrimary - 
			$value="";

					$xt->assign("EmailPrimary_mastervalue", $viewControls->showDBValue("EmailPrimary", $data, $keylink));

//	InitiatedName - 
			$value="";

					$xt->assign("InitiatedName_mastervalue", $viewControls->showDBValue("InitiatedName", $data, $keylink));

//	FullName - 
			$value="";

					$xt->assign("FullName_mastervalue", $viewControls->showDBValue("FullName", $data, $keylink));

	$viewControls->addControlsJSAndCSS();
	$detailPageObj->viewControlsMap['mViewControlsMap'] = $viewControls->viewControlsMap;

	$layout = GetPageLayout("devotee", 'masterlist');
	if($layout)
		$xt->assign("pageattrs", 'class="'.$layout->style." page-".$layout->name.'"');
	
	$xt->display("devotee_masterlist.htm");
	
	$strTableName=$oldTableName;
}

?>