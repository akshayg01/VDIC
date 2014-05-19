<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
add_nocache_headers();

include("include/vw_Devotee_full_variables.php");
include("classes/searchcontrol.php");
include("classes/advancedsearchcontrol.php");
include("classes/panelsearchcontrol.php");
include("classes/searchclause.php");

$sessionPrefix = $strTableName;

//Basic includes js files
$includes="";
// predefined fields num
$predefFieldNum = 0;

$chrt_array=array();
$rpt_array=array();

//	check if logged in
if( (!isLogged() || CheckPermissionsEvent($strTableName, 'S') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && !@$chrt_array['status'] && !@$rpt_array['status'])
|| (@$rpt_array['status'] == "private" && @$rpt_array['owner'] != @$_SESSION["UserID"])
|| (@$chrt_array['status'] == "private" && @$chrt_array['owner'] != @$_SESSION["UserID"]) )
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$layout = new TLayout("search2","RoundedAqua1","MobileAqua1");
$layout->blocks["top"] = array();
$layout->containers["search"] = array();

$layout->containers["search"][] = array("name"=>"srchheader","block"=>"","substyle"=>2);


$layout->containers["search"][] = array("name"=>"srchconditions","block"=>"conditions_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"srchfields","block"=>"","substyle"=>1);


$layout->skins["fields"] = "fields";

$layout->containers["search"][] = array("name"=>"srchbuttons","block"=>"","substyle"=>2);


$layout->skins["search"] = "1";
$layout->blocks["top"][] = "search";$page_layouts["vw_Devotee_full_search"] = $layout;


include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

// id that used to add to controls names
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;
	
// for usual page show proccess
$mode = SEARCH_SIMPLE;
$templatefile = "vw_Devotee_full_search.htm";

// for ajax query, used when page buffers new control
if(postvalue("mode")=="inlineLoadCtrl"){
	$mode = SEARCH_LOAD_CONTROL;
}	

$timepicker = false;

$params = array();
$params["id"] = $id;
$params["mode"] = $mode;
$params["timepicker"] = $timepicker;
$params['xt'] = &$xt;
$params['templatefile'] = $templatefile;
$params['shortTableName'] = 'vw_Devotee_full';
$params['origTName'] = $strOriginalTableName;
$params['sessionPrefix'] = $sessionPrefix;
$params['tName'] = $strTableName;
$params['includes_js'] = $includes_js;
$params['includes_jsreq'] = $includes_jsreq;
$params['includes_css'] = $includes_css;
$params['locale_info'] = $locale_info;
$params['pageType'] = PAGE_SEARCH;

$pageObject = new RunnerPage($params);

// create reusable searchControl builder instance
$searchControllerId = (postvalue('searchControllerId') ? postvalue('searchControllerId') : $pageObject->id);

//	Before Process event
if($eventObj->exists("BeforeProcessSearch"))
	$eventObj->BeforeProcessSearch($conn, $pageObject);

// add constants and files for simple view
if ($mode==SEARCH_SIMPLE)
{
	$searchControlBuilder = new AdvancedSearchControl($searchControllerId, $strTableName, $pageObject->searchClauseObj, $pageObject);

	// add button events if exist
	$pageObject->addButtonHandlers();

	$includes .="<script language=\"JavaScript\" src=\"include/loadfirst.js\"></script>\r\n";
	//$includes.="<script language=\"JavaScript\" src=\"include/customlabels.js\"></script>\r\n";
		$includes.="<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";	

	// if not simple, this div already exist on page
	if (!isMobile())
		$includes.="<div id=\"search_suggest\" class=\"search_suggest\"></div>";

	// search panel radio button assign
	$searchRadio = $searchControlBuilder->getSearchRadio();
	$xt->assign_section("all_checkbox_label", $searchRadio['all_checkbox_label'][0], $searchRadio['all_checkbox_label'][1]);
	$xt->assign_section("any_checkbox_label", $searchRadio['any_checkbox_label'][0], $searchRadio['any_checkbox_label'][1]);
	$xt->assignbyref("all_checkbox",$searchRadio['all_checkbox']);
	$xt->assignbyref("any_checkbox",$searchRadio['any_checkbox']);
	
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("DevoteeId"));
	
	$pageObject->fillFieldToolTips("DevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DevoteeId_label","<label for=\"".GetInputElementId("DevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DevoteeId_label", true);
	
	$xt->assign("DevoteeId_fieldblock", true);
	$xt->assignbyref("DevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Gender"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Gender")] = GetTableURL($pageObject->pSet->getLookupTable("Gender"));
	
	$pageObject->fillFieldToolTips("Gender");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Gender");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Gender";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Gender_label","<label for=\"".GetInputElementId("Gender", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Gender_label", true);
	
	$xt->assign("Gender_fieldblock", true);
	$xt->assignbyref("Gender_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Gender_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Gender_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Gender", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Gender");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Gender", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Gender", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("TitleId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("TitleId")] = GetTableURL($pageObject->pSet->getLookupTable("TitleId"));
	
	$pageObject->fillFieldToolTips("TitleId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("TitleId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "TitleId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("TitleId_label","<label for=\"".GetInputElementId("TitleId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("TitleId_label", true);
	
	$xt->assign("TitleId_fieldblock", true);
	$xt->assignbyref("TitleId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("TitleId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("TitleId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_TitleId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("TitleId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"TitleId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"TitleId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("FirstName"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("FirstName")] = GetTableURL($pageObject->pSet->getLookupTable("FirstName"));
	
	$pageObject->fillFieldToolTips("FirstName");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("FirstName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "FirstName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("FirstName_label","<label for=\"".GetInputElementId("FirstName", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("FirstName_label", true);
	
	$xt->assign("FirstName_fieldblock", true);
	$xt->assignbyref("FirstName_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("FirstName_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("FirstName_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_FirstName", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("FirstName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"FirstName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"FirstName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("LastName"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("LastName")] = GetTableURL($pageObject->pSet->getLookupTable("LastName"));
	
	$pageObject->fillFieldToolTips("LastName");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("LastName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "LastName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("LastName_label","<label for=\"".GetInputElementId("LastName", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("LastName_label", true);
	
	$xt->assign("LastName_fieldblock", true);
	$xt->assignbyref("LastName_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("LastName_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("LastName_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_LastName", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("LastName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"LastName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"LastName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("MiddleName"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("MiddleName")] = GetTableURL($pageObject->pSet->getLookupTable("MiddleName"));
	
	$pageObject->fillFieldToolTips("MiddleName");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("MiddleName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "MiddleName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("MiddleName_label","<label for=\"".GetInputElementId("MiddleName", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("MiddleName_label", true);
	
	$xt->assign("MiddleName_fieldblock", true);
	$xt->assignbyref("MiddleName_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("MiddleName_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("MiddleName_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_MiddleName", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("MiddleName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"MiddleName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"MiddleName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DateOfBirth"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DateOfBirth")] = GetTableURL($pageObject->pSet->getLookupTable("DateOfBirth"));
	
	$pageObject->fillFieldToolTips("DateOfBirth");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DateOfBirth");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DateOfBirth";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DateOfBirth_label","<label for=\"".GetInputElementId("DateOfBirth", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DateOfBirth_label", true);
	
	$xt->assign("DateOfBirth_fieldblock", true);
	$xt->assignbyref("DateOfBirth_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DateOfBirth_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DateOfBirth_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DateOfBirth", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DateOfBirth");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DateOfBirth", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DateOfBirth", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("MaritalStatusId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("MaritalStatusId")] = GetTableURL($pageObject->pSet->getLookupTable("MaritalStatusId"));
	
	$pageObject->fillFieldToolTips("MaritalStatusId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("MaritalStatusId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "MaritalStatusId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("MaritalStatusId_label","<label for=\"".GetInputElementId("MaritalStatusId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("MaritalStatusId_label", true);
	
	$xt->assign("MaritalStatusId_fieldblock", true);
	$xt->assignbyref("MaritalStatusId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("MaritalStatusId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("MaritalStatusId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_MaritalStatusId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("MaritalStatusId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"MaritalStatusId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"MaritalStatusId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DateofMarriage"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DateofMarriage")] = GetTableURL($pageObject->pSet->getLookupTable("DateofMarriage"));
	
	$pageObject->fillFieldToolTips("DateofMarriage");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DateofMarriage");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DateofMarriage";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DateofMarriage_label","<label for=\"".GetInputElementId("DateofMarriage", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DateofMarriage_label", true);
	
	$xt->assign("DateofMarriage_fieldblock", true);
	$xt->assignbyref("DateofMarriage_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DateofMarriage_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DateofMarriage_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DateofMarriage", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DateofMarriage");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DateofMarriage", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DateofMarriage", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("SpouseDevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("SpouseDevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("SpouseDevoteeId"));
	
	$pageObject->fillFieldToolTips("SpouseDevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("SpouseDevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "SpouseDevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("SpouseDevoteeId_label","<label for=\"".GetInputElementId("SpouseDevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("SpouseDevoteeId_label", true);
	
	$xt->assign("SpouseDevoteeId_fieldblock", true);
	$xt->assignbyref("SpouseDevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("SpouseDevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("SpouseDevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_SpouseDevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("SpouseDevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpouseDevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpouseDevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("MobilePhone"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("MobilePhone")] = GetTableURL($pageObject->pSet->getLookupTable("MobilePhone"));
	
	$pageObject->fillFieldToolTips("MobilePhone");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("MobilePhone");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "MobilePhone";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("MobilePhone_label","<label for=\"".GetInputElementId("MobilePhone", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("MobilePhone_label", true);
	
	$xt->assign("MobilePhone_fieldblock", true);
	$xt->assignbyref("MobilePhone_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("MobilePhone_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("MobilePhone_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_MobilePhone", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("MobilePhone");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"MobilePhone", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"MobilePhone", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("WorkPhone"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("WorkPhone")] = GetTableURL($pageObject->pSet->getLookupTable("WorkPhone"));
	
	$pageObject->fillFieldToolTips("WorkPhone");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("WorkPhone");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "WorkPhone";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("WorkPhone_label","<label for=\"".GetInputElementId("WorkPhone", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("WorkPhone_label", true);
	
	$xt->assign("WorkPhone_fieldblock", true);
	$xt->assignbyref("WorkPhone_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("WorkPhone_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("WorkPhone_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_WorkPhone", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("WorkPhone");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"WorkPhone", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"WorkPhone", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("EmailPrimary"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("EmailPrimary")] = GetTableURL($pageObject->pSet->getLookupTable("EmailPrimary"));
	
	$pageObject->fillFieldToolTips("EmailPrimary");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("EmailPrimary");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "EmailPrimary";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("EmailPrimary_label","<label for=\"".GetInputElementId("EmailPrimary", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("EmailPrimary_label", true);
	
	$xt->assign("EmailPrimary_fieldblock", true);
	$xt->assignbyref("EmailPrimary_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("EmailPrimary_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("EmailPrimary_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_EmailPrimary", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("EmailPrimary");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"EmailPrimary", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"EmailPrimary", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("EmailSecondary"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("EmailSecondary")] = GetTableURL($pageObject->pSet->getLookupTable("EmailSecondary"));
	
	$pageObject->fillFieldToolTips("EmailSecondary");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("EmailSecondary");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "EmailSecondary";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("EmailSecondary_label","<label for=\"".GetInputElementId("EmailSecondary", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("EmailSecondary_label", true);
	
	$xt->assign("EmailSecondary_fieldblock", true);
	$xt->assignbyref("EmailSecondary_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("EmailSecondary_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("EmailSecondary_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_EmailSecondary", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("EmailSecondary");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"EmailSecondary", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"EmailSecondary", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Password"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Password")] = GetTableURL($pageObject->pSet->getLookupTable("Password"));
	
	$pageObject->fillFieldToolTips("Password");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Password");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Password";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Password_label","<label for=\"".GetInputElementId("Password", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Password_label", true);
	
	$xt->assign("Password_fieldblock", true);
	$xt->assignbyref("Password_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Password_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Password_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Password", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Password");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Password", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Password", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Address_AddressId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Address_AddressId")] = GetTableURL($pageObject->pSet->getLookupTable("Address_AddressId"));
	
	$pageObject->fillFieldToolTips("Address_AddressId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Address_AddressId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Address_AddressId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Address_AddressId_label","<label for=\"".GetInputElementId("Address_AddressId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Address_AddressId_label", true);
	
	$xt->assign("Address_AddressId_fieldblock", true);
	$xt->assignbyref("Address_AddressId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Address_AddressId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Address_AddressId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Address_AddressId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Address_AddressId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Address_AddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Address_AddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_AddressLine1"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_AddressLine1")] = GetTableURL($pageObject->pSet->getLookupTable("address_AddressLine1"));
	
	$pageObject->fillFieldToolTips("address_AddressLine1");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_AddressLine1");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_AddressLine1";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_AddressLine1_label","<label for=\"".GetInputElementId("address_AddressLine1", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_AddressLine1_label", true);
	
	$xt->assign("address_AddressLine1_fieldblock", true);
	$xt->assignbyref("address_AddressLine1_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_AddressLine1_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_AddressLine1_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_AddressLine1", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_AddressLine1");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_AddressLine1", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_AddressLine1", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_AddressLine2"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_AddressLine2")] = GetTableURL($pageObject->pSet->getLookupTable("address_AddressLine2"));
	
	$pageObject->fillFieldToolTips("address_AddressLine2");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_AddressLine2");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_AddressLine2";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_AddressLine2_label","<label for=\"".GetInputElementId("address_AddressLine2", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_AddressLine2_label", true);
	
	$xt->assign("address_AddressLine2_fieldblock", true);
	$xt->assignbyref("address_AddressLine2_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_AddressLine2_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_AddressLine2_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_AddressLine2", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_AddressLine2");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_AddressLine2", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_AddressLine2", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_City"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_City")] = GetTableURL($pageObject->pSet->getLookupTable("address_City"));
	
	$pageObject->fillFieldToolTips("address_City");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_City");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_City";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_City_label","<label for=\"".GetInputElementId("address_City", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_City_label", true);
	
	$xt->assign("address_City_fieldblock", true);
	$xt->assignbyref("address_City_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_City_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_City_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_City", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_City");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_City", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_City", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_State"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_State")] = GetTableURL($pageObject->pSet->getLookupTable("address_State"));
	
	$pageObject->fillFieldToolTips("address_State");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_State");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_State";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_State_label","<label for=\"".GetInputElementId("address_State", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_State_label", true);
	
	$xt->assign("address_State_fieldblock", true);
	$xt->assignbyref("address_State_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_State_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_State_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_State", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_State");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_State", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_State", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_Pincode"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_Pincode")] = GetTableURL($pageObject->pSet->getLookupTable("address_Pincode"));
	
	$pageObject->fillFieldToolTips("address_Pincode");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_Pincode");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_Pincode";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_Pincode_label","<label for=\"".GetInputElementId("address_Pincode", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_Pincode_label", true);
	
	$xt->assign("address_Pincode_fieldblock", true);
	$xt->assignbyref("address_Pincode_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_Pincode_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_Pincode_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_Pincode", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_Pincode");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_Pincode", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_Pincode", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_Country"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_Country")] = GetTableURL($pageObject->pSet->getLookupTable("address_Country"));
	
	$pageObject->fillFieldToolTips("address_Country");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_Country");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_Country";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_Country_label","<label for=\"".GetInputElementId("address_Country", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_Country_label", true);
	
	$xt->assign("address_Country_fieldblock", true);
	$xt->assignbyref("address_Country_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_Country_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_Country_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_Country", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_Country");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_Country", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_Country", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_IsVerified"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_IsVerified")] = GetTableURL($pageObject->pSet->getLookupTable("address_IsVerified"));
	
	$pageObject->fillFieldToolTips("address_IsVerified");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_IsVerified");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_IsVerified";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_IsVerified_label","<label for=\"".GetInputElementId("address_IsVerified", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_IsVerified_label", true);
	
	$xt->assign("address_IsVerified_fieldblock", true);
	$xt->assignbyref("address_IsVerified_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_IsVerified_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_IsVerified_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_IsVerified", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_IsVerified");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_IsVerified", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_IsVerified", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_IsWrong"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_IsWrong")] = GetTableURL($pageObject->pSet->getLookupTable("address_IsWrong"));
	
	$pageObject->fillFieldToolTips("address_IsWrong");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_IsWrong");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_IsWrong";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_IsWrong_label","<label for=\"".GetInputElementId("address_IsWrong", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_IsWrong_label", true);
	
	$xt->assign("address_IsWrong_fieldblock", true);
	$xt->assignbyref("address_IsWrong_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_IsWrong_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_IsWrong_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_IsWrong", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_IsWrong");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_IsWrong", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_IsWrong", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("address_AddressTypeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("address_AddressTypeId")] = GetTableURL($pageObject->pSet->getLookupTable("address_AddressTypeId"));
	
	$pageObject->fillFieldToolTips("address_AddressTypeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("address_AddressTypeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "address_AddressTypeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("address_AddressTypeId_label","<label for=\"".GetInputElementId("address_AddressTypeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("address_AddressTypeId_label", true);
	
	$xt->assign("address_AddressTypeId_fieldblock", true);
	$xt->assignbyref("address_AddressTypeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("address_AddressTypeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("address_AddressTypeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_address_AddressTypeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("address_AddressTypeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_AddressTypeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"address_AddressTypeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("organization_OrgName"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("organization_OrgName")] = GetTableURL($pageObject->pSet->getLookupTable("organization_OrgName"));
	
	$pageObject->fillFieldToolTips("organization_OrgName");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("organization_OrgName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "organization_OrgName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("organization_OrgName_label","<label for=\"".GetInputElementId("organization_OrgName", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("organization_OrgName_label", true);
	
	$xt->assign("organization_OrgName_fieldblock", true);
	$xt->assignbyref("organization_OrgName_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("organization_OrgName_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("organization_OrgName_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_organization_OrgName", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("organization_OrgName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("organization_OrgId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("organization_OrgId")] = GetTableURL($pageObject->pSet->getLookupTable("organization_OrgId"));
	
	$pageObject->fillFieldToolTips("organization_OrgId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("organization_OrgId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "organization_OrgId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("organization_OrgId_label","<label for=\"".GetInputElementId("organization_OrgId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("organization_OrgId_label", true);
	
	$xt->assign("organization_OrgId_fieldblock", true);
	$xt->assignbyref("organization_OrgId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("organization_OrgId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("organization_OrgId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_organization_OrgId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("organization_OrgId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("organization_OrgLeaderId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("organization_OrgLeaderId")] = GetTableURL($pageObject->pSet->getLookupTable("organization_OrgLeaderId"));
	
	$pageObject->fillFieldToolTips("organization_OrgLeaderId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("organization_OrgLeaderId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "organization_OrgLeaderId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("organization_OrgLeaderId_label","<label for=\"".GetInputElementId("organization_OrgLeaderId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("organization_OrgLeaderId_label", true);
	
	$xt->assign("organization_OrgLeaderId_fieldblock", true);
	$xt->assignbyref("organization_OrgLeaderId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("organization_OrgLeaderId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("organization_OrgLeaderId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_organization_OrgLeaderId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("organization_OrgLeaderId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgLeaderId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgLeaderId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("organization_OrgOwnerId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("organization_OrgOwnerId")] = GetTableURL($pageObject->pSet->getLookupTable("organization_OrgOwnerId"));
	
	$pageObject->fillFieldToolTips("organization_OrgOwnerId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("organization_OrgOwnerId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "organization_OrgOwnerId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("organization_OrgOwnerId_label","<label for=\"".GetInputElementId("organization_OrgOwnerId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("organization_OrgOwnerId_label", true);
	
	$xt->assign("organization_OrgOwnerId_fieldblock", true);
	$xt->assignbyref("organization_OrgOwnerId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("organization_OrgOwnerId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("organization_OrgOwnerId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_organization_OrgOwnerId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("organization_OrgOwnerId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgOwnerId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_OrgOwnerId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("organization_Location"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("organization_Location")] = GetTableURL($pageObject->pSet->getLookupTable("organization_Location"));
	
	$pageObject->fillFieldToolTips("organization_Location");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("organization_Location");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "organization_Location";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("organization_Location_label","<label for=\"".GetInputElementId("organization_Location", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("organization_Location_label", true);
	
	$xt->assign("organization_Location_fieldblock", true);
	$xt->assignbyref("organization_Location_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("organization_Location_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("organization_Location_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_organization_Location", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("organization_Location");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_Location", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"organization_Location", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_SericesRendered"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_SericesRendered")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_SericesRendered"));
	
	$pageObject->fillFieldToolTips("spirituallife_SericesRendered");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_SericesRendered");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_SericesRendered";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_SericesRendered_label","<label for=\"".GetInputElementId("spirituallife_SericesRendered", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_SericesRendered_label", true);
	
	$xt->assign("spirituallife_SericesRendered_fieldblock", true);
	$xt->assignbyref("spirituallife_SericesRendered_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_SericesRendered_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_SericesRendered_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_SericesRendered", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_SericesRendered");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_SericesRendered", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_SericesRendered", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("SpiritualLife_DevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("SpiritualLife_DevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("SpiritualLife_DevoteeId"));
	
	$pageObject->fillFieldToolTips("SpiritualLife_DevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("SpiritualLife_DevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "SpiritualLife_DevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("SpiritualLife_DevoteeId_label","<label for=\"".GetInputElementId("SpiritualLife_DevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("SpiritualLife_DevoteeId_label", true);
	
	$xt->assign("SpiritualLife_DevoteeId_fieldblock", true);
	$xt->assignbyref("SpiritualLife_DevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("SpiritualLife_DevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("SpiritualLife_DevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_SpiritualLife_DevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("SpiritualLife_DevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpiritualLife_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpiritualLife_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_PreferedServices"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_PreferedServices")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_PreferedServices"));
	
	$pageObject->fillFieldToolTips("spirituallife_PreferedServices");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_PreferedServices");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_PreferedServices";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_PreferedServices_label","<label for=\"".GetInputElementId("spirituallife_PreferedServices", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_PreferedServices_label", true);
	
	$xt->assign("spirituallife_PreferedServices_fieldblock", true);
	$xt->assignbyref("spirituallife_PreferedServices_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_PreferedServices_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_PreferedServices_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_PreferedServices", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_PreferedServices");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_PreferedServices", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_PreferedServices", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_Chanting16RoundsSince"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_Chanting16RoundsSince")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_Chanting16RoundsSince"));
	
	$pageObject->fillFieldToolTips("spirituallife_Chanting16RoundsSince");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_Chanting16RoundsSince");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_Chanting16RoundsSince";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_Chanting16RoundsSince_label","<label for=\"".GetInputElementId("spirituallife_Chanting16RoundsSince", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_Chanting16RoundsSince_label", true);
	
	$xt->assign("spirituallife_Chanting16RoundsSince_fieldblock", true);
	$xt->assignbyref("spirituallife_Chanting16RoundsSince_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_Chanting16RoundsSince_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_Chanting16RoundsSince_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_Chanting16RoundsSince", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_Chanting16RoundsSince");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_Chanting16RoundsSince", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_Chanting16RoundsSince", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_IntroducedInCenter"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_IntroducedInCenter")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_IntroducedInCenter"));
	
	$pageObject->fillFieldToolTips("spirituallife_IntroducedInCenter");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_IntroducedInCenter");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_IntroducedInCenter";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_IntroducedInCenter_label","<label for=\"".GetInputElementId("spirituallife_IntroducedInCenter", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_IntroducedInCenter_label", true);
	
	$xt->assign("spirituallife_IntroducedInCenter_fieldblock", true);
	$xt->assignbyref("spirituallife_IntroducedInCenter_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_IntroducedInCenter_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_IntroducedInCenter_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_IntroducedInCenter", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_IntroducedInCenter");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_IntroducedInCenter", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_IntroducedInCenter", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_YearOfIntroduction"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_YearOfIntroduction")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_YearOfIntroduction"));
	
	$pageObject->fillFieldToolTips("spirituallife_YearOfIntroduction");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_YearOfIntroduction");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_YearOfIntroduction";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_YearOfIntroduction_label","<label for=\"".GetInputElementId("spirituallife_YearOfIntroduction", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_YearOfIntroduction_label", true);
	
	$xt->assign("spirituallife_YearOfIntroduction_fieldblock", true);
	$xt->assignbyref("spirituallife_YearOfIntroduction_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_YearOfIntroduction_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_YearOfIntroduction_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_YearOfIntroduction", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_YearOfIntroduction");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_YearOfIntroduction", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_YearOfIntroduction", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_PreviousReligion"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_PreviousReligion")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_PreviousReligion"));
	
	$pageObject->fillFieldToolTips("spirituallife_PreviousReligion");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_PreviousReligion");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_PreviousReligion";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_PreviousReligion_label","<label for=\"".GetInputElementId("spirituallife_PreviousReligion", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_PreviousReligion_label", true);
	
	$xt->assign("spirituallife_PreviousReligion_fieldblock", true);
	$xt->assignbyref("spirituallife_PreviousReligion_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_PreviousReligion_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_PreviousReligion_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_PreviousReligion", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_PreviousReligion");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_PreviousReligion", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_PreviousReligion", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_SpiritualMasterDevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_SpiritualMasterDevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_SpiritualMasterDevoteeId"));
	
	$pageObject->fillFieldToolTips("spirituallife_SpiritualMasterDevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_SpiritualMasterDevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_SpiritualMasterDevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_SpiritualMasterDevoteeId_label","<label for=\"".GetInputElementId("spirituallife_SpiritualMasterDevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_SpiritualMasterDevoteeId_label", true);
	
	$xt->assign("spirituallife_SpiritualMasterDevoteeId_fieldblock", true);
	$xt->assignbyref("spirituallife_SpiritualMasterDevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_SpiritualMasterDevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_SpiritualMasterDevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_SpiritualMasterDevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_SpiritualMasterDevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_SpiritualMasterDevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_SpiritualMasterDevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_DateOfBrahmanInitiation"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_DateOfBrahmanInitiation")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_DateOfBrahmanInitiation"));
	
	$pageObject->fillFieldToolTips("spirituallife_DateOfBrahmanInitiation");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_DateOfBrahmanInitiation");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_DateOfBrahmanInitiation";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_DateOfBrahmanInitiation_label","<label for=\"".GetInputElementId("spirituallife_DateOfBrahmanInitiation", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_DateOfBrahmanInitiation_label", true);
	
	$xt->assign("spirituallife_DateOfBrahmanInitiation_fieldblock", true);
	$xt->assignbyref("spirituallife_DateOfBrahmanInitiation_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_DateOfBrahmanInitiation_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_DateOfBrahmanInitiation_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_DateOfBrahmanInitiation", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_DateOfBrahmanInitiation");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_DateOfBrahmanInitiation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_DateOfBrahmanInitiation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_DateOfHarinamInitiation"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_DateOfHarinamInitiation")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_DateOfHarinamInitiation"));
	
	$pageObject->fillFieldToolTips("spirituallife_DateOfHarinamInitiation");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_DateOfHarinamInitiation");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_DateOfHarinamInitiation";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_DateOfHarinamInitiation_label","<label for=\"".GetInputElementId("spirituallife_DateOfHarinamInitiation", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_DateOfHarinamInitiation_label", true);
	
	$xt->assign("spirituallife_DateOfHarinamInitiation_fieldblock", true);
	$xt->assignbyref("spirituallife_DateOfHarinamInitiation_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_DateOfHarinamInitiation_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_DateOfHarinamInitiation_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_DateOfHarinamInitiation", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_DateOfHarinamInitiation");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_DateOfHarinamInitiation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_DateOfHarinamInitiation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_SpiritulLifeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_SpiritulLifeId")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_SpiritulLifeId"));
	
	$pageObject->fillFieldToolTips("spirituallife_SpiritulLifeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_SpiritulLifeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_SpiritulLifeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_SpiritulLifeId_label","<label for=\"".GetInputElementId("spirituallife_SpiritulLifeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_SpiritulLifeId_label", true);
	
	$xt->assign("spirituallife_SpiritulLifeId_fieldblock", true);
	$xt->assignbyref("spirituallife_SpiritulLifeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_SpiritulLifeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_SpiritulLifeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_SpiritulLifeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_SpiritulLifeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_SpiritulLifeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_SpiritulLifeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("spirituallife_IntroducedBy"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("spirituallife_IntroducedBy")] = GetTableURL($pageObject->pSet->getLookupTable("spirituallife_IntroducedBy"));
	
	$pageObject->fillFieldToolTips("spirituallife_IntroducedBy");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("spirituallife_IntroducedBy");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "spirituallife_IntroducedBy";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("spirituallife_IntroducedBy_label","<label for=\"".GetInputElementId("spirituallife_IntroducedBy", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("spirituallife_IntroducedBy_label", true);
	
	$xt->assign("spirituallife_IntroducedBy_fieldblock", true);
	$xt->assignbyref("spirituallife_IntroducedBy_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("spirituallife_IntroducedBy_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("spirituallife_IntroducedBy_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_spirituallife_IntroducedBy", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("spirituallife_IntroducedBy");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_IntroducedBy", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"spirituallife_IntroducedBy", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("company_CompanyId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("company_CompanyId")] = GetTableURL($pageObject->pSet->getLookupTable("company_CompanyId"));
	
	$pageObject->fillFieldToolTips("company_CompanyId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("company_CompanyId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "company_CompanyId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("company_CompanyId_label","<label for=\"".GetInputElementId("company_CompanyId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("company_CompanyId_label", true);
	
	$xt->assign("company_CompanyId_fieldblock", true);
	$xt->assignbyref("company_CompanyId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("company_CompanyId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("company_CompanyId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_company_CompanyId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("company_CompanyId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_CompanyId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_CompanyId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("company_CompanyName"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("company_CompanyName")] = GetTableURL($pageObject->pSet->getLookupTable("company_CompanyName"));
	
	$pageObject->fillFieldToolTips("company_CompanyName");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("company_CompanyName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "company_CompanyName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("company_CompanyName_label","<label for=\"".GetInputElementId("company_CompanyName", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("company_CompanyName_label", true);
	
	$xt->assign("company_CompanyName_fieldblock", true);
	$xt->assignbyref("company_CompanyName_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("company_CompanyName_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("company_CompanyName_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_company_CompanyName", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("company_CompanyName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_CompanyName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_CompanyName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("company_AddressId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("company_AddressId")] = GetTableURL($pageObject->pSet->getLookupTable("company_AddressId"));
	
	$pageObject->fillFieldToolTips("company_AddressId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("company_AddressId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "company_AddressId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("company_AddressId_label","<label for=\"".GetInputElementId("company_AddressId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("company_AddressId_label", true);
	
	$xt->assign("company_AddressId_fieldblock", true);
	$xt->assignbyref("company_AddressId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("company_AddressId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("company_AddressId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_company_AddressId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("company_AddressId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_AddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_AddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("company_Remark"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("company_Remark")] = GetTableURL($pageObject->pSet->getLookupTable("company_Remark"));
	
	$pageObject->fillFieldToolTips("company_Remark");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("company_Remark");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "company_Remark";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("company_Remark_label","<label for=\"".GetInputElementId("company_Remark", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("company_Remark_label", true);
	
	$xt->assign("company_Remark_fieldblock", true);
	$xt->assignbyref("company_Remark_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("company_Remark_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("company_Remark_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_company_Remark", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("company_Remark");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_Remark", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"company_Remark", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteelang_DevoteeLanguageId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteelang_DevoteeLanguageId")] = GetTableURL($pageObject->pSet->getLookupTable("devoteelang_DevoteeLanguageId"));
	
	$pageObject->fillFieldToolTips("devoteelang_DevoteeLanguageId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteelang_DevoteeLanguageId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteelang_DevoteeLanguageId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteelang_DevoteeLanguageId_label","<label for=\"".GetInputElementId("devoteelang_DevoteeLanguageId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteelang_DevoteeLanguageId_label", true);
	
	$xt->assign("devoteelang_DevoteeLanguageId_fieldblock", true);
	$xt->assignbyref("devoteelang_DevoteeLanguageId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteelang_DevoteeLanguageId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteelang_DevoteeLanguageId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteelang_DevoteeLanguageId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteelang_DevoteeLanguageId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_DevoteeLanguageId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_DevoteeLanguageId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteelang_WritingLevel"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteelang_WritingLevel")] = GetTableURL($pageObject->pSet->getLookupTable("devoteelang_WritingLevel"));
	
	$pageObject->fillFieldToolTips("devoteelang_WritingLevel");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteelang_WritingLevel");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteelang_WritingLevel";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteelang_WritingLevel_label","<label for=\"".GetInputElementId("devoteelang_WritingLevel", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteelang_WritingLevel_label", true);
	
	$xt->assign("devoteelang_WritingLevel_fieldblock", true);
	$xt->assignbyref("devoteelang_WritingLevel_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteelang_WritingLevel_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteelang_WritingLevel_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteelang_WritingLevel", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteelang_WritingLevel");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_WritingLevel", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_WritingLevel", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteelang_DevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteelang_DevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("devoteelang_DevoteeId"));
	
	$pageObject->fillFieldToolTips("devoteelang_DevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteelang_DevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteelang_DevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteelang_DevoteeId_label","<label for=\"".GetInputElementId("devoteelang_DevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteelang_DevoteeId_label", true);
	
	$xt->assign("devoteelang_DevoteeId_fieldblock", true);
	$xt->assignbyref("devoteelang_DevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteelang_DevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteelang_DevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteelang_DevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteelang_DevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteelang_LanguageId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteelang_LanguageId")] = GetTableURL($pageObject->pSet->getLookupTable("devoteelang_LanguageId"));
	
	$pageObject->fillFieldToolTips("devoteelang_LanguageId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteelang_LanguageId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteelang_LanguageId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteelang_LanguageId_label","<label for=\"".GetInputElementId("devoteelang_LanguageId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteelang_LanguageId_label", true);
	
	$xt->assign("devoteelang_LanguageId_fieldblock", true);
	$xt->assignbyref("devoteelang_LanguageId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteelang_LanguageId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteelang_LanguageId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteelang_LanguageId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteelang_LanguageId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_LanguageId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_LanguageId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteelang_SpeakingLevel"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteelang_SpeakingLevel")] = GetTableURL($pageObject->pSet->getLookupTable("devoteelang_SpeakingLevel"));
	
	$pageObject->fillFieldToolTips("devoteelang_SpeakingLevel");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteelang_SpeakingLevel");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteelang_SpeakingLevel";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteelang_SpeakingLevel_label","<label for=\"".GetInputElementId("devoteelang_SpeakingLevel", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteelang_SpeakingLevel_label", true);
	
	$xt->assign("devoteelang_SpeakingLevel_fieldblock", true);
	$xt->assignbyref("devoteelang_SpeakingLevel_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteelang_SpeakingLevel_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteelang_SpeakingLevel_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteelang_SpeakingLevel", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteelang_SpeakingLevel");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_SpeakingLevel", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_SpeakingLevel", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteelang_ReadingLevel"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteelang_ReadingLevel")] = GetTableURL($pageObject->pSet->getLookupTable("devoteelang_ReadingLevel"));
	
	$pageObject->fillFieldToolTips("devoteelang_ReadingLevel");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteelang_ReadingLevel");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteelang_ReadingLevel";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteelang_ReadingLevel_label","<label for=\"".GetInputElementId("devoteelang_ReadingLevel", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteelang_ReadingLevel_label", true);
	
	$xt->assign("devoteelang_ReadingLevel_fieldblock", true);
	$xt->assignbyref("devoteelang_ReadingLevel_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteelang_ReadingLevel_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteelang_ReadingLevel_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteelang_ReadingLevel", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteelang_ReadingLevel");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_ReadingLevel", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteelang_ReadingLevel", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("occupational_DevoteeOccupationalId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("occupational_DevoteeOccupationalId")] = GetTableURL($pageObject->pSet->getLookupTable("occupational_DevoteeOccupationalId"));
	
	$pageObject->fillFieldToolTips("occupational_DevoteeOccupationalId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("occupational_DevoteeOccupationalId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "occupational_DevoteeOccupationalId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("occupational_DevoteeOccupationalId_label","<label for=\"".GetInputElementId("occupational_DevoteeOccupationalId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("occupational_DevoteeOccupationalId_label", true);
	
	$xt->assign("occupational_DevoteeOccupationalId_fieldblock", true);
	$xt->assignbyref("occupational_DevoteeOccupationalId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("occupational_DevoteeOccupationalId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("occupational_DevoteeOccupationalId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_occupational_DevoteeOccupationalId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("occupational_DevoteeOccupationalId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"occupational_DevoteeOccupationalId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"occupational_DevoteeOccupationalId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Occupational_DevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Occupational_DevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("Occupational_DevoteeId"));
	
	$pageObject->fillFieldToolTips("Occupational_DevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Occupational_DevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Occupational_DevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Occupational_DevoteeId_label","<label for=\"".GetInputElementId("Occupational_DevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Occupational_DevoteeId_label", true);
	
	$xt->assign("Occupational_DevoteeId_fieldblock", true);
	$xt->assignbyref("Occupational_DevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Occupational_DevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Occupational_DevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Occupational_DevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Occupational_DevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Occupational_Education"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Occupational_Education")] = GetTableURL($pageObject->pSet->getLookupTable("Occupational_Education"));
	
	$pageObject->fillFieldToolTips("Occupational_Education");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Occupational_Education");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Occupational_Education";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Occupational_Education_label","<label for=\"".GetInputElementId("Occupational_Education", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Occupational_Education_label", true);
	
	$xt->assign("Occupational_Education_fieldblock", true);
	$xt->assignbyref("Occupational_Education_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Occupational_Education_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Occupational_Education_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Occupational_Education", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Occupational_Education");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_Education", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_Education", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Occupational_Occupation"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Occupational_Occupation")] = GetTableURL($pageObject->pSet->getLookupTable("Occupational_Occupation"));
	
	$pageObject->fillFieldToolTips("Occupational_Occupation");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Occupational_Occupation");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Occupational_Occupation";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Occupational_Occupation_label","<label for=\"".GetInputElementId("Occupational_Occupation", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Occupational_Occupation_label", true);
	
	$xt->assign("Occupational_Occupation_fieldblock", true);
	$xt->assignbyref("Occupational_Occupation_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Occupational_Occupation_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Occupational_Occupation_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Occupational_Occupation", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Occupational_Occupation");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_Occupation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_Occupation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Occupational_Designation"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Occupational_Designation")] = GetTableURL($pageObject->pSet->getLookupTable("Occupational_Designation"));
	
	$pageObject->fillFieldToolTips("Occupational_Designation");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Occupational_Designation");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Occupational_Designation";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Occupational_Designation_label","<label for=\"".GetInputElementId("Occupational_Designation", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Occupational_Designation_label", true);
	
	$xt->assign("Occupational_Designation_fieldblock", true);
	$xt->assignbyref("Occupational_Designation_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Occupational_Designation_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Occupational_Designation_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Occupational_Designation", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Occupational_Designation");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_Designation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_Designation", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("Occupational_AwardsOrMerits"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("Occupational_AwardsOrMerits")] = GetTableURL($pageObject->pSet->getLookupTable("Occupational_AwardsOrMerits"));
	
	$pageObject->fillFieldToolTips("Occupational_AwardsOrMerits");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Occupational_AwardsOrMerits");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Occupational_AwardsOrMerits";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Occupational_AwardsOrMerits_label","<label for=\"".GetInputElementId("Occupational_AwardsOrMerits", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("Occupational_AwardsOrMerits_label", true);
	
	$xt->assign("Occupational_AwardsOrMerits_fieldblock", true);
	$xt->assignbyref("Occupational_AwardsOrMerits_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("Occupational_AwardsOrMerits_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("Occupational_AwardsOrMerits_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_Occupational_AwardsOrMerits", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Occupational_AwardsOrMerits");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_AwardsOrMerits", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Occupational_AwardsOrMerits", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("occupational_SkillsOrExperiences"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("occupational_SkillsOrExperiences")] = GetTableURL($pageObject->pSet->getLookupTable("occupational_SkillsOrExperiences"));
	
	$pageObject->fillFieldToolTips("occupational_SkillsOrExperiences");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("occupational_SkillsOrExperiences");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "occupational_SkillsOrExperiences";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("occupational_SkillsOrExperiences_label","<label for=\"".GetInputElementId("occupational_SkillsOrExperiences", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("occupational_SkillsOrExperiences_label", true);
	
	$xt->assign("occupational_SkillsOrExperiences_fieldblock", true);
	$xt->assignbyref("occupational_SkillsOrExperiences_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("occupational_SkillsOrExperiences_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("occupational_SkillsOrExperiences_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_occupational_SkillsOrExperiences", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("occupational_SkillsOrExperiences");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"occupational_SkillsOrExperiences", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"occupational_SkillsOrExperiences", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("occupational_CurrentCompanyId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("occupational_CurrentCompanyId")] = GetTableURL($pageObject->pSet->getLookupTable("occupational_CurrentCompanyId"));
	
	$pageObject->fillFieldToolTips("occupational_CurrentCompanyId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("occupational_CurrentCompanyId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "occupational_CurrentCompanyId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("occupational_CurrentCompanyId_label","<label for=\"".GetInputElementId("occupational_CurrentCompanyId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("occupational_CurrentCompanyId_label", true);
	
	$xt->assign("occupational_CurrentCompanyId_fieldblock", true);
	$xt->assignbyref("occupational_CurrentCompanyId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("occupational_CurrentCompanyId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("occupational_CurrentCompanyId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_occupational_CurrentCompanyId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("occupational_CurrentCompanyId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"occupational_CurrentCompanyId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"occupational_CurrentCompanyId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("addresstypes_AddressType"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("addresstypes_AddressType")] = GetTableURL($pageObject->pSet->getLookupTable("addresstypes_AddressType"));
	
	$pageObject->fillFieldToolTips("addresstypes_AddressType");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("addresstypes_AddressType");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "addresstypes_AddressType";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("addresstypes_AddressType_label","<label for=\"".GetInputElementId("addresstypes_AddressType", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("addresstypes_AddressType_label", true);
	
	$xt->assign("addresstypes_AddressType_fieldblock", true);
	$xt->assignbyref("addresstypes_AddressType_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("addresstypes_AddressType_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("addresstypes_AddressType_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_addresstypes_AddressType", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("addresstypes_AddressType");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"addresstypes_AddressType", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"addresstypes_AddressType", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("addresstypes_AddressTypeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("addresstypes_AddressTypeId")] = GetTableURL($pageObject->pSet->getLookupTable("addresstypes_AddressTypeId"));
	
	$pageObject->fillFieldToolTips("addresstypes_AddressTypeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("addresstypes_AddressTypeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "addresstypes_AddressTypeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("addresstypes_AddressTypeId_label","<label for=\"".GetInputElementId("addresstypes_AddressTypeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("addresstypes_AddressTypeId_label", true);
	
	$xt->assign("addresstypes_AddressTypeId_fieldblock", true);
	$xt->assignbyref("addresstypes_AddressTypeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("addresstypes_AddressTypeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("addresstypes_AddressTypeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_addresstypes_AddressTypeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("addresstypes_AddressTypeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"addresstypes_AddressTypeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"addresstypes_AddressTypeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DevoteeOrg_DevoteeOrgId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DevoteeOrg_DevoteeOrgId")] = GetTableURL($pageObject->pSet->getLookupTable("DevoteeOrg_DevoteeOrgId"));
	
	$pageObject->fillFieldToolTips("DevoteeOrg_DevoteeOrgId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DevoteeOrg_DevoteeOrgId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DevoteeOrg_DevoteeOrgId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_DevoteeOrgId_label","<label for=\"".GetInputElementId("DevoteeOrg_DevoteeOrgId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DevoteeOrg_DevoteeOrgId_label", true);
	
	$xt->assign("DevoteeOrg_DevoteeOrgId_fieldblock", true);
	$xt->assignbyref("DevoteeOrg_DevoteeOrgId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DevoteeOrg_DevoteeOrgId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DevoteeOrg_DevoteeOrgId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DevoteeOrg_DevoteeOrgId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DevoteeOrg_DevoteeOrgId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_DevoteeOrgId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_DevoteeOrgId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DevoteeOrg_DevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DevoteeOrg_DevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("DevoteeOrg_DevoteeId"));
	
	$pageObject->fillFieldToolTips("DevoteeOrg_DevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DevoteeOrg_DevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DevoteeOrg_DevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_DevoteeId_label","<label for=\"".GetInputElementId("DevoteeOrg_DevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DevoteeOrg_DevoteeId_label", true);
	
	$xt->assign("DevoteeOrg_DevoteeId_fieldblock", true);
	$xt->assignbyref("DevoteeOrg_DevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DevoteeOrg_DevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DevoteeOrg_DevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DevoteeOrg_DevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DevoteeOrg_DevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DevoteeOrg_FromDate"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DevoteeOrg_FromDate")] = GetTableURL($pageObject->pSet->getLookupTable("DevoteeOrg_FromDate"));
	
	$pageObject->fillFieldToolTips("DevoteeOrg_FromDate");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DevoteeOrg_FromDate");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DevoteeOrg_FromDate";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_FromDate_label","<label for=\"".GetInputElementId("DevoteeOrg_FromDate", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DevoteeOrg_FromDate_label", true);
	
	$xt->assign("DevoteeOrg_FromDate_fieldblock", true);
	$xt->assignbyref("DevoteeOrg_FromDate_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DevoteeOrg_FromDate_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DevoteeOrg_FromDate_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DevoteeOrg_FromDate", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DevoteeOrg_FromDate");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_FromDate", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_FromDate", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DevoteeOrg_ToDate"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DevoteeOrg_ToDate")] = GetTableURL($pageObject->pSet->getLookupTable("DevoteeOrg_ToDate"));
	
	$pageObject->fillFieldToolTips("DevoteeOrg_ToDate");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DevoteeOrg_ToDate");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DevoteeOrg_ToDate";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_ToDate_label","<label for=\"".GetInputElementId("DevoteeOrg_ToDate", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DevoteeOrg_ToDate_label", true);
	
	$xt->assign("DevoteeOrg_ToDate_fieldblock", true);
	$xt->assignbyref("DevoteeOrg_ToDate_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DevoteeOrg_ToDate_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DevoteeOrg_ToDate_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DevoteeOrg_ToDate", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DevoteeOrg_ToDate");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_ToDate", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_ToDate", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("DevoteeOrg_OrgId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("DevoteeOrg_OrgId")] = GetTableURL($pageObject->pSet->getLookupTable("DevoteeOrg_OrgId"));
	
	$pageObject->fillFieldToolTips("DevoteeOrg_OrgId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DevoteeOrg_OrgId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DevoteeOrg_OrgId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DevoteeOrg_OrgId_label","<label for=\"".GetInputElementId("DevoteeOrg_OrgId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("DevoteeOrg_OrgId_label", true);
	
	$xt->assign("DevoteeOrg_OrgId_fieldblock", true);
	$xt->assignbyref("DevoteeOrg_OrgId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("DevoteeOrg_OrgId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("DevoteeOrg_OrgId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_DevoteeOrg_OrgId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DevoteeOrg_OrgId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_OrgId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DevoteeOrg_OrgId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteeaddress_devoteeaddressId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteeaddress_devoteeaddressId")] = GetTableURL($pageObject->pSet->getLookupTable("devoteeaddress_devoteeaddressId"));
	
	$pageObject->fillFieldToolTips("devoteeaddress_devoteeaddressId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteeaddress_devoteeaddressId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteeaddress_devoteeaddressId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_devoteeaddressId_label","<label for=\"".GetInputElementId("devoteeaddress_devoteeaddressId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteeaddress_devoteeaddressId_label", true);
	
	$xt->assign("devoteeaddress_devoteeaddressId_fieldblock", true);
	$xt->assignbyref("devoteeaddress_devoteeaddressId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteeaddress_devoteeaddressId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteeaddress_devoteeaddressId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteeaddress_devoteeaddressId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteeaddress_devoteeaddressId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteeaddress_devoteeaddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteeaddress_devoteeaddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteeaddress_AddressId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteeaddress_AddressId")] = GetTableURL($pageObject->pSet->getLookupTable("devoteeaddress_AddressId"));
	
	$pageObject->fillFieldToolTips("devoteeaddress_AddressId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteeaddress_AddressId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteeaddress_AddressId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_AddressId_label","<label for=\"".GetInputElementId("devoteeaddress_AddressId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteeaddress_AddressId_label", true);
	
	$xt->assign("devoteeaddress_AddressId_fieldblock", true);
	$xt->assignbyref("devoteeaddress_AddressId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteeaddress_AddressId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteeaddress_AddressId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteeaddress_AddressId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteeaddress_AddressId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteeaddress_AddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteeaddress_AddressId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if($pageObject->pSet->getLookupTable("devoteeaddress_DevoteeId"))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][$pageObject->pSet->getLookupTable("devoteeaddress_DevoteeId")] = GetTableURL($pageObject->pSet->getLookupTable("devoteeaddress_DevoteeId"));
	
	$pageObject->fillFieldToolTips("devoteeaddress_DevoteeId");	
	
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("devoteeaddress_DevoteeId");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "devoteeaddress_DevoteeId";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("devoteeaddress_DevoteeId_label","<label for=\"".GetInputElementId("devoteeaddress_DevoteeId", $id, PAGE_SEARCH)."\">","</label>");
	else 
		$xt->assign("devoteeaddress_DevoteeId_label", true);
	
	$xt->assign("devoteeaddress_DevoteeId_fieldblock", true);
	$xt->assignbyref("devoteeaddress_DevoteeId_editcontrol", $ctrlBlockArr['searchcontrol']);
	$xt->assign("devoteeaddress_DevoteeId_notbox", $ctrlBlockArr['notbox']);
	// create second control, if need it
	$xt->assignbyref("devoteeaddress_DevoteeId_editcontrol1", $ctrlBlockArr['searchcontrol1']);
	// create search type select
	$xt->assign("searchtype_devoteeaddress_DevoteeId", $ctrlBlockArr['searchtype']);
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("devoteeaddress_DevoteeId");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl)
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteeaddress_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"devoteeaddress_DevoteeId", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	
	//--------------------------------------------------------
	
	$pageObject->body["begin"] .= $includes;
	
	$pageObject->addCommonJs();
	
	$xt->assignbyref("body",$pageObject->body);
	
	$xt->assign("contents_block", true);
	
	$xt->assign("conditions_block",true);
	$xt->assign("search_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("back_button",true);
	
	
	$xt->assign("searchbutton_attrs","id=\"searchButton".$id."\"");
	$xt->assign("resetbutton_attrs","id=\"resetButton".$id."\"");
	$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
	

	// for crosse report 
	
	if (postvalue('axis_x')!=''){
		$xtCrosseElem = "<input type=\"hidden\" id=\"select_group_x\" value=\"".postvalue('axis_x')."\">
						<input type=\"hidden\" id=\"select_group_y\" value=\"".postvalue('axis_y')."\">
						<input type=\"hidden\" id=\"select_data\" value=\"".postvalue('field')."\">
						<input type=\"hidden\" id=\"group_func_hidden\" value=\"".postvalue('group_func')."\">
						";
		$xt->assign("CrossElem",$xtCrosseElem);
	}
	// for crosse report
	if($eventObj->exists("BeforeShowSearch"))
		$eventObj->BeforeShowSearch($xt,$templatefile, $pageObject);
	// load controls for first page loading	
	
	
	$pageObject->fillSetCntrlMaps();
	
	$pageObject->body['end'] .= '<script>';
	$pageObject->body['end'] .= "window.controlsMap = ".my_json_encode($pageObject->controlsHTMLMap).";";
	$pageObject->body['end'] .= "window.viewControlsMap = ".my_json_encode($pageObject->viewControlsHTMLMap).";";
	$pageObject->body['end'] .= "window.settings = ".my_json_encode($pageObject->jsSettings).";";
	$pageObject->body['end'] .= '</script>';
		$pageObject->body['end'] .= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerAll.js\"></script>\r\n";
	$pageObject->body["end"] .= "<script>".$pageObject->PrepareJs()."</script>";
	
	$xt->assignbyref("body",$pageObject->body);
	$xt->display($templatefile);
	exit();	
}
else if($mode==SEARCH_LOAD_CONTROL)
{

	$searchControlBuilder = new PanelSearchControl($searchControllerId, $strTableName, $pageObject->searchClauseObj, $pageObject);
	$ctrlField = postvalue('ctrlField');
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $ctrlField, 0, '', false, true, '', '');	
	
	// build array for encode
	$resArr = array();
	$resArr['control1'] = trim($xt->call_func($ctrlBlockArr['searchcontrol']));
	$resArr['control2'] = trim($xt->call_func($ctrlBlockArr['searchcontrol1']));
	$resArr['comboHtml'] = trim($ctrlBlockArr['searchtype']);
	$resArr['delButt'] = trim($ctrlBlockArr['delCtrlButt']);
	$resArr['delButtId'] =  trim($searchControlBuilder->getDelButtonId($ctrlField, $id));
	$resArr['divInd'] = trim($id);	
	$resArr['fLabel'] = GetFieldLabel(GoodFieldName($strTableName),GoodFieldName($ctrlField));
	$resArr['ctrlMap'] = $pageObject->controlsMap['controls'];
	
	if (postvalue('isNeedSettings') == 'true')
	{
		$pageObject->fillSettings();
		$resArr['settings'] = $pageObject->jsSettings;
	}
	
	// return JSON
	echo my_json_encode($resArr);
	exit();
}

?>
