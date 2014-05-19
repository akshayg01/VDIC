<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/vw_counsellee_temp_variables.php");
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
$layout->blocks["top"][] = "details";$page_layouts["vw_counsellee_temp_view"] = $layout;




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
	header("Location: vw_counsellee_temp_list.php?a=return");
	exit();
}

$out = "";
$first = true;
$fieldsArr = array();
$arr = array();
$arr['fName'] = "DevoteeId1";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DevoteeId1");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfHarinamInitiation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfHarinamInitiation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "TitleId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("TitleId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Photo";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Photo");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "FirstName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("FirstName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "LastName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("LastName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "MiddleName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("MiddleName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Gender";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Gender");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfBirth";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfBirth");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "MaritalStatusId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("MaritalStatusId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateofMarriage";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateofMarriage");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "SpouseDevoteeId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("SpouseDevoteeId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "MobilePhone";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("MobilePhone");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "WorkPhone";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("WorkPhone");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "EmailPrimary";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("EmailPrimary");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "EmailSecondary";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("EmailSecondary");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "CounsellorDevoteeID";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CounsellorDevoteeID");
$fieldsArr[] = $arr;

$mainTableOwnerID = $pageObject->pSet->getTableOwnerIdField();
$ownerIdValue="";

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("DevoteeId", $data)));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));

////////////////////////////////////////////
//DevoteeId1 - 
	
	$value = $pageObject->showDBValue("DevoteeId1", $data, $keylink);
	if($mainTableOwnerID=="DevoteeId1")
		$ownerIdValue=$value;
	$xt->assign("DevoteeId1_value",$value);
	if(!$pageObject->isAppearOnTabs("DevoteeId1"))
		$xt->assign("DevoteeId1_fieldblock",true);
	else
		$xt->assign("DevoteeId1_tabfieldblock",true);
////////////////////////////////////////////
//DateOfHarinamInitiation - Short Date
	
	$value = $pageObject->showDBValue("DateOfHarinamInitiation", $data, $keylink);
	if($mainTableOwnerID=="DateOfHarinamInitiation")
		$ownerIdValue=$value;
	$xt->assign("DateOfHarinamInitiation_value",$value);
	if(!$pageObject->isAppearOnTabs("DateOfHarinamInitiation"))
		$xt->assign("DateOfHarinamInitiation_fieldblock",true);
	else
		$xt->assign("DateOfHarinamInitiation_tabfieldblock",true);
////////////////////////////////////////////
//TitleId - 
	
	$value = $pageObject->showDBValue("TitleId", $data, $keylink);
	if($mainTableOwnerID=="TitleId")
		$ownerIdValue=$value;
	$xt->assign("TitleId_value",$value);
	if(!$pageObject->isAppearOnTabs("TitleId"))
		$xt->assign("TitleId_fieldblock",true);
	else
		$xt->assign("TitleId_tabfieldblock",true);
////////////////////////////////////////////
//Photo - Database Image
	
	$value = $pageObject->showDBValue("Photo", $data, $keylink);
	if($mainTableOwnerID=="Photo")
		$ownerIdValue=$value;
	$xt->assign("Photo_value",$value);
	if(!$pageObject->isAppearOnTabs("Photo"))
		$xt->assign("Photo_fieldblock",true);
	else
		$xt->assign("Photo_tabfieldblock",true);
////////////////////////////////////////////
//FirstName - 
	
	$value = $pageObject->showDBValue("FirstName", $data, $keylink);
	if($mainTableOwnerID=="FirstName")
		$ownerIdValue=$value;
	$xt->assign("FirstName_value",$value);
	if(!$pageObject->isAppearOnTabs("FirstName"))
		$xt->assign("FirstName_fieldblock",true);
	else
		$xt->assign("FirstName_tabfieldblock",true);
////////////////////////////////////////////
//LastName - 
	
	$value = $pageObject->showDBValue("LastName", $data, $keylink);
	if($mainTableOwnerID=="LastName")
		$ownerIdValue=$value;
	$xt->assign("LastName_value",$value);
	if(!$pageObject->isAppearOnTabs("LastName"))
		$xt->assign("LastName_fieldblock",true);
	else
		$xt->assign("LastName_tabfieldblock",true);
////////////////////////////////////////////
//MiddleName - 
	
	$value = $pageObject->showDBValue("MiddleName", $data, $keylink);
	if($mainTableOwnerID=="MiddleName")
		$ownerIdValue=$value;
	$xt->assign("MiddleName_value",$value);
	if(!$pageObject->isAppearOnTabs("MiddleName"))
		$xt->assign("MiddleName_fieldblock",true);
	else
		$xt->assign("MiddleName_tabfieldblock",true);
////////////////////////////////////////////
//Gender - 
	
	$value = $pageObject->showDBValue("Gender", $data, $keylink);
	if($mainTableOwnerID=="Gender")
		$ownerIdValue=$value;
	$xt->assign("Gender_value",$value);
	if(!$pageObject->isAppearOnTabs("Gender"))
		$xt->assign("Gender_fieldblock",true);
	else
		$xt->assign("Gender_tabfieldblock",true);
////////////////////////////////////////////
//DateOfBirth - Short Date
	
	$value = $pageObject->showDBValue("DateOfBirth", $data, $keylink);
	if($mainTableOwnerID=="DateOfBirth")
		$ownerIdValue=$value;
	$xt->assign("DateOfBirth_value",$value);
	if(!$pageObject->isAppearOnTabs("DateOfBirth"))
		$xt->assign("DateOfBirth_fieldblock",true);
	else
		$xt->assign("DateOfBirth_tabfieldblock",true);
////////////////////////////////////////////
//MaritalStatusId - 
	
	$value = $pageObject->showDBValue("MaritalStatusId", $data, $keylink);
	if($mainTableOwnerID=="MaritalStatusId")
		$ownerIdValue=$value;
	$xt->assign("MaritalStatusId_value",$value);
	if(!$pageObject->isAppearOnTabs("MaritalStatusId"))
		$xt->assign("MaritalStatusId_fieldblock",true);
	else
		$xt->assign("MaritalStatusId_tabfieldblock",true);
////////////////////////////////////////////
//DateofMarriage - Short Date
	
	$value = $pageObject->showDBValue("DateofMarriage", $data, $keylink);
	if($mainTableOwnerID=="DateofMarriage")
		$ownerIdValue=$value;
	$xt->assign("DateofMarriage_value",$value);
	if(!$pageObject->isAppearOnTabs("DateofMarriage"))
		$xt->assign("DateofMarriage_fieldblock",true);
	else
		$xt->assign("DateofMarriage_tabfieldblock",true);
////////////////////////////////////////////
//SpouseDevoteeId - 
	
	$value = $pageObject->showDBValue("SpouseDevoteeId", $data, $keylink);
	if($mainTableOwnerID=="SpouseDevoteeId")
		$ownerIdValue=$value;
	$xt->assign("SpouseDevoteeId_value",$value);
	if(!$pageObject->isAppearOnTabs("SpouseDevoteeId"))
		$xt->assign("SpouseDevoteeId_fieldblock",true);
	else
		$xt->assign("SpouseDevoteeId_tabfieldblock",true);
////////////////////////////////////////////
//MobilePhone - 
	
	$value = $pageObject->showDBValue("MobilePhone", $data, $keylink);
	if($mainTableOwnerID=="MobilePhone")
		$ownerIdValue=$value;
	$xt->assign("MobilePhone_value",$value);
	if(!$pageObject->isAppearOnTabs("MobilePhone"))
		$xt->assign("MobilePhone_fieldblock",true);
	else
		$xt->assign("MobilePhone_tabfieldblock",true);
////////////////////////////////////////////
//WorkPhone - 
	
	$value = $pageObject->showDBValue("WorkPhone", $data, $keylink);
	if($mainTableOwnerID=="WorkPhone")
		$ownerIdValue=$value;
	$xt->assign("WorkPhone_value",$value);
	if(!$pageObject->isAppearOnTabs("WorkPhone"))
		$xt->assign("WorkPhone_fieldblock",true);
	else
		$xt->assign("WorkPhone_tabfieldblock",true);
////////////////////////////////////////////
//EmailPrimary - 
	
	$value = $pageObject->showDBValue("EmailPrimary", $data, $keylink);
	if($mainTableOwnerID=="EmailPrimary")
		$ownerIdValue=$value;
	$xt->assign("EmailPrimary_value",$value);
	if(!$pageObject->isAppearOnTabs("EmailPrimary"))
		$xt->assign("EmailPrimary_fieldblock",true);
	else
		$xt->assign("EmailPrimary_tabfieldblock",true);
////////////////////////////////////////////
//EmailSecondary - 
	
	$value = $pageObject->showDBValue("EmailSecondary", $data, $keylink);
	if($mainTableOwnerID=="EmailSecondary")
		$ownerIdValue=$value;
	$xt->assign("EmailSecondary_value",$value);
	if(!$pageObject->isAppearOnTabs("EmailSecondary"))
		$xt->assign("EmailSecondary_fieldblock",true);
	else
		$xt->assign("EmailSecondary_tabfieldblock",true);
////////////////////////////////////////////
//CounsellorDevoteeID - 
	
	$value = $pageObject->showDBValue("CounsellorDevoteeID", $data, $keylink);
	if($mainTableOwnerID=="CounsellorDevoteeID")
		$ownerIdValue=$value;
	$xt->assign("CounsellorDevoteeID_value",$value);
	if(!$pageObject->isAppearOnTabs("CounsellorDevoteeID"))
		$xt->assign("CounsellorDevoteeID_fieldblock",true);
	else
		$xt->assign("CounsellorDevoteeID_tabfieldblock",true);

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
		$options['masterTable'] = "vw_counsellee_temp";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "vw_counsellee_temp";
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
	$strTableName = "vw_counsellee_temp";
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
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='vw_counsellee_temp_edit.php?".$editlink."'\"");

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
