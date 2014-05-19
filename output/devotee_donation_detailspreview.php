<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/devotee_donation_variables.php");

$mode = postvalue("mode");

if(!isLogged())
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}

$cipherer = new RunnerCipherer($strTableName);


include('include/xtempl.php');
$xt = new Xtempl();

$layout = new TLayout("detailspreview","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["dcount"] = array();

$layout->containers["dcount"][] = array("name"=>"detailspreviewheader","block"=>"","substyle"=>1);


$layout->containers["dcount"][] = array("name"=>"detailspreviewdetailsfount","block"=>"","substyle"=>1);


$layout->containers["dcount"][] = array("name"=>"detailspreviewdispfirst","block"=>"display_first","substyle"=>1);


$layout->skins["dcount"] = "empty";
$layout->blocks["bare"][] = "dcount";
$layout->containers["detailspreviewgrid"] = array();

$layout->containers["detailspreviewgrid"][] = array("name"=>"detailspreviewfields","block"=>"details_data","substyle"=>1);


$layout->skins["detailspreviewgrid"] = "grid";
$layout->blocks["bare"][] = "detailspreviewgrid";$page_layouts["devotee_donation_detailspreview"] = $layout;


$recordsCounter = 0;

//	process masterkey value
$mastertable = postvalue("mastertable");
$masterKeys = my_json_decode(postvalue("masterKeys"));
if($mastertable != "")
{
	$_SESSION[$strTableName."_mastertable"]=$mastertable;
//	copy keys to session
	$i = 1;
	if(is_array($masterKeys) && count($masterKeys) > 0)
	{
		while(array_key_exists ("masterkey".$i, $masterKeys))
		{
			$_SESSION[$strTableName."_masterkey".$i] = $masterKeys["masterkey".$i];
			$i++;
		}
	}
	if(isset($_SESSION[$strTableName."_masterkey".$i]))
		unset($_SESSION[$strTableName."_masterkey".$i]);
}
else
	$mastertable = $_SESSION[$strTableName."_mastertable"];

//$strSQL = $gstrSQL;

if($mastertable == "devotee")
{
	$where = "";
		$where .= GetFullFieldName("DevoteeId", $strTableName, false)."=".make_db_value("DevoteeId",$_SESSION[$strTableName."_masterkey1"]);
}

$str = SecuritySQL("Search");
if(strlen($str))
	$where.=" and ".$str;
$strSQL = $gQuery->gSQLWhere($where);

$strSQL.=" ".$gstrOrderBy;

$rowcount = $gQuery->gSQLRowCount($where);

$xt->assign("row_count",$rowcount);
if($rowcount) {
	$xt->assign("details_data",true);
	$rs = db_query($strSQL,$conn);

	$display_count = 10;
	if($mode == "inline")
		$display_count*=2;
	if($rowcount>$display_count+2)
	{
		$xt->assign("display_first",true);
		$xt->assign("display_count",$display_count);
	}
	else
		$display_count = $rowcount;

	$rowinfo = array();
	
	$data = $cipherer->DecryptFetchedArray($rs);
	require_once getabspath('classes/controls/ViewControlsContainer.php');
	$pSet = new ProjectSettings($strTableName, PAGE_LIST);
	$viewContainer = new ViewControlsContainer($pSet, PAGE_LIST);
	while($data && $recordsCounter<$display_count) {
		$recordsCounter++;
		$row = array();
		$keylink = "";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DonationId"]));

	
	//	DevoteeId - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("DevoteeId", $data, $keylink);
			$row["DevoteeId_value"] = $value;
	//	DonationDate - Short Date
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("DonationDate", $data, $keylink);
			$row["DonationDate_value"] = $value;
	//	DonationOnName - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("DonationOnName", $data, $keylink);
			$row["DonationOnName_value"] = $value;
	//	DonationOnNamePanNumber - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("DonationOnNamePanNumber", $data, $keylink);
			$row["DonationOnNamePanNumber_value"] = $value;
	//	DonationPurposeId - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("DonationPurposeId", $data, $keylink);
			$row["DonationPurposeId_value"] = $value;
	//	Amount - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("Amount", $data, $keylink);
			$row["Amount_value"] = $value;
	//	ReceiptNumber - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("ReceiptNumber", $data, $keylink);
			$row["ReceiptNumber_value"] = $value;
	//	DonationMode - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("DonationMode", $data, $keylink);
			$row["DonationMode_value"] = $value;
	//	CheckNumber - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("CheckNumber", $data, $keylink);
			$row["CheckNumber_value"] = $value;
	//	CheckBank - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("CheckBank", $data, $keylink);
			$row["CheckBank_value"] = $value;
	//	CheckBranch - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("CheckBranch", $data, $keylink);
			$row["CheckBranch_value"] = $value;
	//	CheckCleared - 
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("CheckCleared", $data, $keylink);
			$row["CheckCleared_value"] = $value;
	//	CheckClearedDate - Short Date
			$viewContainer->recId = $recordsCounter;
		    $value = $viewContainer->showDBValue("CheckClearedDate", $data, $keylink);
			$row["CheckClearedDate_value"] = $value;
		$rowinfo[] = $row;
		$data = $cipherer->DecryptFetchedArray($rs);
	}
	$xt->assign_loopsection("details_row",$rowinfo);
}
$returnJSON = array("success" => true);
$xt->load_template("devotee_donation_detailspreview.htm");
$returnJSON["body"] = $xt->fetch_loaded();

if($mode!="inline"){
	$returnJSON["counter"] = postvalue("counter");
	$layout = GetPageLayout(GoodFieldName($strTableName), 'detailspreview');
	if($layout)
	{
		$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
		$returnJSON["style"] = "styles/".$layout->style."/style".$rtl.".css";
		$returnJSON["pageStyle"] = "pagestyles/".$layout->name.$rtl.".css";
		$returnJSON["layout"] = $layout->style." page-".$layout->name.".css";
	}	
}	

echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
?>