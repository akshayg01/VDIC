<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/devotee_donation_variables.php");
include('include/xtempl.php');
include('classes/viewpage.php');
include("classes/searchclause.php");

add_nocache_headers();

//	check if logged in
if(!isLogged() || CheckPermissionsEvent($strTableName, 'S') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$layout = new TLayout("view2","RoundedAqua1","MobileAqua1");
$layout->blocks["top"] = array();
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";
$layout->containers["view"] = array();

$layout->containers["view"][] = array("name"=>"viewheader","block"=>"","substyle"=>2);


$layout->containers["view"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"viewfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"viewbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["view"] = "1";
$layout->blocks["top"][] = "view";
$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["devotee_donation_view"] = $layout;




//$cipherer = new RunnerCipherer($strTableName);
	
$xt = new Xtempl();

$query = $gQuery->Copy();

$filename = "";	
$message = "";
$key = array();
$next = array();
$prev = array();
$all = postvalue("all");
$pdf = postvalue("pdf");
$mypage = 1;

//Show view page as popUp or not
$inlineview = (postvalue("onFly") ? true : false);

//If show view as popUp, get parent Id
if($inlineview)
	$parId = postvalue("parId");
else
	$parId = 0;

//Set page id	
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;

//$isNeedSettings = true;//($inlineview && postvalue("isNeedSettings") == 'true') || (!$inlineview);	
	
// assign an id
$xt->assign("id",$id);

//array of params for classes
$params = array("pageType" => PAGE_VIEW, "id" => $id, "tName" => $strTableName);
$params["xt"] = &$xt;
$params["all"] = $all;

//Get array of tabs for edit page
$params['useTabsOnView'] = $gSettings->useTabsOnView();
if($params['useTabsOnView'])
	$params['arrViewTabs'] = $gSettings->getViewTabs();
$pageObject = new ViewPage($params);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

// proccess big google maps

// add button events if exist
$pageObject->addButtonHandlers();

//For show detail tables on master page view
$dpParams = array();
if($pageObject->isShowDetailTables && !isMobile())
{
	$ids = $id;
	$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array();
}

//	Before Process event
if($eventObj->exists("BeforeProcessView"))
	$eventObj->BeforeProcessView($conn, $pageObject);
	
//	read current values from the database
$data = $pageObject->getCurrentRecordInternal();

if (!sizeof($data)) {
	header("Location: devotee_donation_list.php?a=return");
	exit();
}

$out = "";
$first = true;
$fieldsArr = array();
$arr = array();
$arr['fName'] = "DevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DonationDate";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DonationDate");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DonationOnName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DonationOnName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DonationOnNamePanNumber";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DonationOnNamePanNumber");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DonationPurposeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DonationPurposeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Amount";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Amount");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "ReceiptNumber";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("ReceiptNumber");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DonationMode";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DonationMode");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "CheckNumber";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CheckNumber");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "CheckBank";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CheckBank");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "CheckBranch";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CheckBranch");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "CheckCleared";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CheckCleared");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "CheckClearedDate";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CheckClearedDate");
$fieldsArr[] = $arr;

$mainTableOwnerID = $pageObject->pSet->getTableOwnerIdField();
$ownerIdValue="";

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("DonationId", $data)));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DonationId"]));

////////////////////////////////////////////
//DevoteeId - 
	
	$value = $pageObject->showDBValue("DevoteeId", $data, $keylink);
	if($mainTableOwnerID=="DevoteeId")
		$ownerIdValue=$value;
	$xt->assign("DevoteeId_value",$value);
	if(!$pageObject->isAppearOnTabs("DevoteeId"))
		$xt->assign("DevoteeId_fieldblock",true);
	else
		$xt->assign("DevoteeId_tabfieldblock",true);
////////////////////////////////////////////
//DonationDate - Short Date
	
	$value = $pageObject->showDBValue("DonationDate", $data, $keylink);
	if($mainTableOwnerID=="DonationDate")
		$ownerIdValue=$value;
	$xt->assign("DonationDate_value",$value);
	if(!$pageObject->isAppearOnTabs("DonationDate"))
		$xt->assign("DonationDate_fieldblock",true);
	else
		$xt->assign("DonationDate_tabfieldblock",true);
////////////////////////////////////////////
//DonationOnName - 
	
	$value = $pageObject->showDBValue("DonationOnName", $data, $keylink);
	if($mainTableOwnerID=="DonationOnName")
		$ownerIdValue=$value;
	$xt->assign("DonationOnName_value",$value);
	if(!$pageObject->isAppearOnTabs("DonationOnName"))
		$xt->assign("DonationOnName_fieldblock",true);
	else
		$xt->assign("DonationOnName_tabfieldblock",true);
////////////////////////////////////////////
//DonationOnNamePanNumber - 
	
	$value = $pageObject->showDBValue("DonationOnNamePanNumber", $data, $keylink);
	if($mainTableOwnerID=="DonationOnNamePanNumber")
		$ownerIdValue=$value;
	$xt->assign("DonationOnNamePanNumber_value",$value);
	if(!$pageObject->isAppearOnTabs("DonationOnNamePanNumber"))
		$xt->assign("DonationOnNamePanNumber_fieldblock",true);
	else
		$xt->assign("DonationOnNamePanNumber_tabfieldblock",true);
////////////////////////////////////////////
//DonationPurposeId - 
	
	$value = $pageObject->showDBValue("DonationPurposeId", $data, $keylink);
	if($mainTableOwnerID=="DonationPurposeId")
		$ownerIdValue=$value;
	$xt->assign("DonationPurposeId_value",$value);
	if(!$pageObject->isAppearOnTabs("DonationPurposeId"))
		$xt->assign("DonationPurposeId_fieldblock",true);
	else
		$xt->assign("DonationPurposeId_tabfieldblock",true);
////////////////////////////////////////////
//Amount - 
	
	$value = $pageObject->showDBValue("Amount", $data, $keylink);
	if($mainTableOwnerID=="Amount")
		$ownerIdValue=$value;
	$xt->assign("Amount_value",$value);
	if(!$pageObject->isAppearOnTabs("Amount"))
		$xt->assign("Amount_fieldblock",true);
	else
		$xt->assign("Amount_tabfieldblock",true);
////////////////////////////////////////////
//ReceiptNumber - 
	
	$value = $pageObject->showDBValue("ReceiptNumber", $data, $keylink);
	if($mainTableOwnerID=="ReceiptNumber")
		$ownerIdValue=$value;
	$xt->assign("ReceiptNumber_value",$value);
	if(!$pageObject->isAppearOnTabs("ReceiptNumber"))
		$xt->assign("ReceiptNumber_fieldblock",true);
	else
		$xt->assign("ReceiptNumber_tabfieldblock",true);
////////////////////////////////////////////
//DonationMode - 
	
	$value = $pageObject->showDBValue("DonationMode", $data, $keylink);
	if($mainTableOwnerID=="DonationMode")
		$ownerIdValue=$value;
	$xt->assign("DonationMode_value",$value);
	if(!$pageObject->isAppearOnTabs("DonationMode"))
		$xt->assign("DonationMode_fieldblock",true);
	else
		$xt->assign("DonationMode_tabfieldblock",true);
////////////////////////////////////////////
//CheckNumber - 
	
	$value = $pageObject->showDBValue("CheckNumber", $data, $keylink);
	if($mainTableOwnerID=="CheckNumber")
		$ownerIdValue=$value;
	$xt->assign("CheckNumber_value",$value);
	if(!$pageObject->isAppearOnTabs("CheckNumber"))
		$xt->assign("CheckNumber_fieldblock",true);
	else
		$xt->assign("CheckNumber_tabfieldblock",true);
////////////////////////////////////////////
//CheckBank - 
	
	$value = $pageObject->showDBValue("CheckBank", $data, $keylink);
	if($mainTableOwnerID=="CheckBank")
		$ownerIdValue=$value;
	$xt->assign("CheckBank_value",$value);
	if(!$pageObject->isAppearOnTabs("CheckBank"))
		$xt->assign("CheckBank_fieldblock",true);
	else
		$xt->assign("CheckBank_tabfieldblock",true);
////////////////////////////////////////////
//CheckBranch - 
	
	$value = $pageObject->showDBValue("CheckBranch", $data, $keylink);
	if($mainTableOwnerID=="CheckBranch")
		$ownerIdValue=$value;
	$xt->assign("CheckBranch_value",$value);
	if(!$pageObject->isAppearOnTabs("CheckBranch"))
		$xt->assign("CheckBranch_fieldblock",true);
	else
		$xt->assign("CheckBranch_tabfieldblock",true);
////////////////////////////////////////////
//CheckCleared - 
	
	$value = $pageObject->showDBValue("CheckCleared", $data, $keylink);
	if($mainTableOwnerID=="CheckCleared")
		$ownerIdValue=$value;
	$xt->assign("CheckCleared_value",$value);
	if(!$pageObject->isAppearOnTabs("CheckCleared"))
		$xt->assign("CheckCleared_fieldblock",true);
	else
		$xt->assign("CheckCleared_tabfieldblock",true);
////////////////////////////////////////////
//CheckClearedDate - Short Date
	
	$value = $pageObject->showDBValue("CheckClearedDate", $data, $keylink);
	if($mainTableOwnerID=="CheckClearedDate")
		$ownerIdValue=$value;
	$xt->assign("CheckClearedDate_value",$value);
	if(!$pageObject->isAppearOnTabs("CheckClearedDate"))
		$xt->assign("CheckClearedDate_fieldblock",true);
	else
		$xt->assign("CheckClearedDate_tabfieldblock",true);

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && !isMobile())
{
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
	}
	
	$dControlsMap = array();
	$dViewControlsMap = array();
	
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$options = array();
		//array of params for classes
		$options["mode"] = LIST_DETAILS;
		$options["pageType"] = PAGE_LIST;
		$options["masterPageType"] = PAGE_VIEW;
		$options["mainMasterPageType"] = PAGE_VIEW;
		$options['masterTable'] = "devotee_donation";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "devotee_donation";
			continue;
		}
		
		$layout = GetPageLayout(GoodFieldName($strTableName), PAGE_LIST);
		if($layout)
		{
			$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
			$xt->cssFiles[] = array("stylepath" => "styles/".$layout->style.'/style'.$rtl.".css"
				, "pagestylepath" => "pagestyles/".$layout->name.$rtl.".css");
			$xt->IEcssFiles[] = array("stylepathIE" => "styles/".$layout->style.'/styleIE'.".css");
		}
		
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $pageObject->genId()+1;
		$mkr = 1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		
		// show page
		if($listPageObject->permis[$strTableName]['search'] && $listPageObject->rowsFound)
		{
			//set page events
			foreach($listPageObject->eventsObject->events as $event => $name)
				$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
			
			//add detail settings to master settings
			$listPageObject->addControlsJSAndCSS();
			$listPageObject->fillSetCntrlMaps();
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];
			$dControlsMap[$strTableName] = $listPageObject->controlsMap;
			$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
			foreach($listPageObject->jsSettings['global']['shortTNames'] as $keySet=>$val)
			{
				if(!array_key_exists($keySet,$pageObject->settingsMap["globalSettings"]['shortTNames']))
					$pageObject->settingsMap["globalSettings"]['shortTNames'][$keySet] = $val;
			}
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
		
			$xtParams = array("method"=>'showPage', "params"=> false);
			$xtParams['object'] = $listPageObject;
			$xt->assign("displayDetailTable_".GoodFieldName($listPageObject->tName), $xtParams);
		
			$pageObject->controlsMap['dpTablesParams'][] = array('tName'=>$strTableName, 'id'=>$options['id']);
		}
	}
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap; 
	$strTableName = "devotee_donation";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin prepare for Next Prev button
if(!@$_SESSION[$strTableName."_noNextPrev"] && !$inlineview && !$pdf)
{
	$pageObject->getNextPrevRecordKeys($data,"Search",$next,$prev);
}
//End prepare for Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ($pageObject->googleMapCfg['isUseGoogleMap'])
{
	$pageObject->initGmaps();
}

$pageObject->addCommonJs();

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

if(!$inlineview)
{
	$pageObject->body["begin"].="<script type=\"text/javascript\" src=\"include/loadfirst.js\"></script>\r\n";
		$pageObject->body["begin"].= "<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";		
	
	$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $pageObject->jsKeys;
	$pageObject->jsSettings['tableSettings'][$strTableName]['keyFields'] = $pageObject->keyFields;
	$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
	$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
	
	// assign body end
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	
	$xt->assign("body",$pageObject->body);
	$xt->assign("flybody",true);
}
else
{
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
	$xt->assign("pdflink_block",false);
	
	$pageObject->fillSetCntrlMaps();
	
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;
}
$xt->assign("style_block",true);
$xt->assign("stylefiles_block",true);

$editlink="";
$editkeys=array();
	$editkeys["editid1"]=postvalue("editid1");
foreach($editkeys as $key=>$val)
{
	if($editlink)
		$editlink.="&";
	$editlink.=$key."=".$val;
}
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='devotee_donation_edit.php?".$editlink."'\"");

$strPerm = GetUserPermissions($strTableName);
if(CheckSecurity($ownerIdValue,"Edit") && !$inlineview && strpos($strPerm, "E")!==false)
	$xt->assign("edit_button",true);
else
	$xt->assign("edit_button",false);

if(!$pdf && !$all && !$inlineview)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin show Next Prev button
	$nextlink=$prevlink="";
	if(count($next))
	{
		$xt->assign("next_button",true);
	 		$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1-1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\"");
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
			$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1-1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\"");
	}
	else 
		$xt->assign("prev_button",false);
//End show Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$xt->assign("back_button",true);
	$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
}

$oldtemplatefile = $pageObject->templatefile;

if(!$all)
{
	if($eventObj->exists("BeforeShowView"))
	{
		$templatefile = $pageObject->templatefile;
		$eventObj->BeforeShowView($xt,$templatefile,$data, $pageObject);
		$pageObject->templatefile = $templatefile;
	}
	if(!$pdf)
	{
		if(!$inlineview)
			$xt->display($pageObject->templatefile);
		else{
				$xt->load_template($pageObject->templatefile);
				$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
				if(count($pageObject->includes_css))
					$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
				if(count($pageObject->includes_cssIE))
					$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);				
				$returnJSON['idStartFrom'] = $id+1;
				$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
				echo (my_json_encode($returnJSON)); 
			}
	}
	break;
}
}


?>
