<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/devotee_variables.php");
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
$layout->containers["details"] = array();

$layout->containers["details"][] = array("name"=>"viewdetails","block"=>"detail_tables","substyle"=>1);


$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["devotee_view"] = $layout;


$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Primary_Info1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Phone1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Address1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Marital_Status1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Extra_Info1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Work_Experience1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Spiritual_Life1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Family_Members1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Devotee_Donation1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Language1"] = $layout;

$layout = new TLayout("viewtab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"viewtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_view_Organization1"] = $layout;


$layout = new TLayout("list2","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["recordcontrols"] = array();

$layout->containers["recordcontrols"][] = array("name"=>"recordcontrols_new","block"=>"newrecord_controls_block","substyle"=>1);


$layout->containers["recordcontrols"][] = array("name"=>"recordcontrol","block"=>"record_controls_block","substyle"=>1);


$layout->skins["recordcontrols"] = "1";
$layout->blocks["center"][] = "recordcontrols";
$layout->containers["message"] = array();

$layout->containers["message"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->skins["message"] = "2";
$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"grid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "grid";
$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();

$layout->containers["pagination"][] = array("name"=>"pagination","block"=>"pagination_block","substyle"=>1);


$layout->skins["pagination"] = "2";
$layout->blocks["center"][] = "pagination";$layout->blocks["left"] = array();
$layout->skins["lang"] = "menu";
$layout->blocks["left"][] = "lang";
$layout->containers["logg"] = array();

$layout->containers["logg"][] = array("name"=>"loggedas","block"=>"security_block","substyle"=>1);


$layout->skins["logg"] = "menu";
$layout->blocks["left"][] = "logg";
$layout->containers["left"] = array();

$layout->containers["left"][] = array("name"=>"searchpanel","block"=>"searchPanel","substyle"=>1);


$layout->containers["left"][] = array("name"=>"vmenu","block"=>"menu_block","substyle"=>1);


$layout->skins["left"] = "menu";
$layout->blocks["left"][] = "left";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->containers["toplinks"] = array();

$layout->containers["toplinks"][] = array("name"=>"toplinks_print","block"=>"prints_block","substyle"=>1);


$layout->containers["toplinks"][] = array("name"=>"toplinks_advsearch","block"=>"asearch_link","substyle"=>1);





$layout->skins["toplinks"] = "empty";
$layout->blocks["top"][] = "toplinks";
$layout->containers["search"] = array();

$layout->containers["search"][] = array("name"=>"search","block"=>"searchform_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"search_buttons","block"=>"searchformbuttons_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"details_found","block"=>"details_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"page_of","block"=>"pages_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"recsperpage","block"=>"recordspp_block","substyle"=>1);


$layout->skins["search"] = "2";
$layout->blocks["top"][] = "search";$page_layouts["devotee_address_list"] = $layout;

$layout = new TLayout("list2","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["recordcontrols"] = array();

$layout->containers["recordcontrols"][] = array("name"=>"recordcontrols_new","block"=>"newrecord_controls_block","substyle"=>1);


$layout->containers["recordcontrols"][] = array("name"=>"recordcontrol","block"=>"record_controls_block","substyle"=>1);


$layout->skins["recordcontrols"] = "1";
$layout->blocks["center"][] = "recordcontrols";
$layout->containers["message"] = array();

$layout->containers["message"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->skins["message"] = "2";
$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"grid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "grid";
$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();

$layout->containers["pagination"][] = array("name"=>"pagination","block"=>"pagination_block","substyle"=>1);


$layout->skins["pagination"] = "2";
$layout->blocks["center"][] = "pagination";$layout->blocks["left"] = array();
$layout->skins["lang"] = "menu";
$layout->blocks["left"][] = "lang";
$layout->containers["logg"] = array();

$layout->containers["logg"][] = array("name"=>"loggedas","block"=>"security_block","substyle"=>1);


$layout->skins["logg"] = "menu";
$layout->blocks["left"][] = "logg";
$layout->containers["left"] = array();

$layout->containers["left"][] = array("name"=>"searchpanel","block"=>"searchPanel","substyle"=>1);


$layout->containers["left"][] = array("name"=>"vmenu","block"=>"menu_block","substyle"=>1);


$layout->skins["left"] = "menu";
$layout->blocks["left"][] = "left";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->containers["toplinks"] = array();

$layout->containers["toplinks"][] = array("name"=>"toplinks_print","block"=>"prints_block","substyle"=>1);


$layout->containers["toplinks"][] = array("name"=>"toplinks_advsearch","block"=>"asearch_link","substyle"=>1);





$layout->skins["toplinks"] = "empty";
$layout->blocks["top"][] = "toplinks";
$layout->containers["search"] = array();

$layout->containers["search"][] = array("name"=>"search","block"=>"searchform_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"search_buttons","block"=>"searchformbuttons_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"details_found","block"=>"details_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"page_of","block"=>"pages_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"recsperpage","block"=>"recordspp_block","substyle"=>1);


$layout->skins["search"] = "2";
$layout->blocks["top"][] = "search";$page_layouts["devotee_donation_list"] = $layout;

$layout = new TLayout("list2","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["recordcontrols"] = array();

$layout->containers["recordcontrols"][] = array("name"=>"recordcontrols_new","block"=>"newrecord_controls_block","substyle"=>1);


$layout->containers["recordcontrols"][] = array("name"=>"recordcontrol","block"=>"record_controls_block","substyle"=>1);


$layout->skins["recordcontrols"] = "1";
$layout->blocks["center"][] = "recordcontrols";
$layout->containers["message"] = array();

$layout->containers["message"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->skins["message"] = "2";
$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"grid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "grid";
$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();

$layout->containers["pagination"][] = array("name"=>"pagination","block"=>"pagination_block","substyle"=>1);


$layout->skins["pagination"] = "2";
$layout->blocks["center"][] = "pagination";$layout->blocks["left"] = array();
$layout->skins["lang"] = "menu";
$layout->blocks["left"][] = "lang";
$layout->containers["logg"] = array();

$layout->containers["logg"][] = array("name"=>"loggedas","block"=>"security_block","substyle"=>1);


$layout->skins["logg"] = "menu";
$layout->blocks["left"][] = "logg";
$layout->containers["left"] = array();

$layout->containers["left"][] = array("name"=>"searchpanel","block"=>"searchPanel","substyle"=>1);


$layout->containers["left"][] = array("name"=>"vmenu","block"=>"menu_block","substyle"=>1);


$layout->skins["left"] = "menu";
$layout->blocks["left"][] = "left";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->containers["toplinks"] = array();

$layout->containers["toplinks"][] = array("name"=>"toplinks_print","block"=>"prints_block","substyle"=>1);


$layout->containers["toplinks"][] = array("name"=>"toplinks_advsearch","block"=>"asearch_link","substyle"=>1);





$layout->skins["toplinks"] = "empty";
$layout->blocks["top"][] = "toplinks";
$layout->containers["search"] = array();

$layout->containers["search"][] = array("name"=>"search","block"=>"searchform_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"search_buttons","block"=>"searchformbuttons_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"details_found","block"=>"details_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"page_of","block"=>"pages_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"recsperpage","block"=>"recordspp_block","substyle"=>1);


$layout->skins["search"] = "2";
$layout->blocks["top"][] = "search";$page_layouts["devotee_language_list"] = $layout;

$layout = new TLayout("list2","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["recordcontrols"] = array();

$layout->containers["recordcontrols"][] = array("name"=>"recordcontrols_new","block"=>"newrecord_controls_block","substyle"=>1);


$layout->containers["recordcontrols"][] = array("name"=>"recordcontrol","block"=>"record_controls_block","substyle"=>1);


$layout->skins["recordcontrols"] = "1";
$layout->blocks["center"][] = "recordcontrols";
$layout->containers["message"] = array();

$layout->containers["message"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->skins["message"] = "2";
$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"grid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "grid";
$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();

$layout->containers["pagination"][] = array("name"=>"pagination","block"=>"pagination_block","substyle"=>1);


$layout->skins["pagination"] = "2";
$layout->blocks["center"][] = "pagination";$layout->blocks["left"] = array();
$layout->skins["lang"] = "menu";
$layout->blocks["left"][] = "lang";
$layout->containers["logg"] = array();

$layout->containers["logg"][] = array("name"=>"loggedas","block"=>"security_block","substyle"=>1);


$layout->skins["logg"] = "menu";
$layout->blocks["left"][] = "logg";
$layout->containers["left"] = array();

$layout->containers["left"][] = array("name"=>"searchpanel","block"=>"searchPanel","substyle"=>1);


$layout->containers["left"][] = array("name"=>"vmenu","block"=>"menu_block","substyle"=>1);


$layout->skins["left"] = "menu";
$layout->blocks["left"][] = "left";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->containers["toplinks"] = array();

$layout->containers["toplinks"][] = array("name"=>"toplinks_print","block"=>"prints_block","substyle"=>1);


$layout->containers["toplinks"][] = array("name"=>"toplinks_advsearch","block"=>"asearch_link","substyle"=>1);





$layout->skins["toplinks"] = "empty";
$layout->blocks["top"][] = "toplinks";
$layout->containers["search"] = array();

$layout->containers["search"][] = array("name"=>"search","block"=>"searchform_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"search_buttons","block"=>"searchformbuttons_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"details_found","block"=>"details_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"page_of","block"=>"pages_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"recsperpage","block"=>"recordspp_block","substyle"=>1);


$layout->skins["search"] = "2";
$layout->blocks["top"][] = "search";$page_layouts["devotee_org_list"] = $layout;

$layout = new TLayout("list2","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["recordcontrols"] = array();

$layout->containers["recordcontrols"][] = array("name"=>"recordcontrols_new","block"=>"newrecord_controls_block","substyle"=>1);


$layout->containers["recordcontrols"][] = array("name"=>"recordcontrol","block"=>"record_controls_block","substyle"=>1);


$layout->skins["recordcontrols"] = "1";
$layout->blocks["center"][] = "recordcontrols";
$layout->containers["message"] = array();

$layout->containers["message"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->skins["message"] = "2";
$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"grid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "grid";
$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();

$layout->containers["pagination"][] = array("name"=>"pagination","block"=>"pagination_block","substyle"=>1);


$layout->skins["pagination"] = "2";
$layout->blocks["center"][] = "pagination";$layout->blocks["left"] = array();
$layout->skins["lang"] = "menu";
$layout->blocks["left"][] = "lang";
$layout->containers["logg"] = array();

$layout->containers["logg"][] = array("name"=>"loggedas","block"=>"security_block","substyle"=>1);


$layout->skins["logg"] = "menu";
$layout->blocks["left"][] = "logg";
$layout->containers["left"] = array();

$layout->containers["left"][] = array("name"=>"searchpanel","block"=>"searchPanel","substyle"=>1);


$layout->containers["left"][] = array("name"=>"vmenu","block"=>"menu_block","substyle"=>1);


$layout->skins["left"] = "menu";
$layout->blocks["left"][] = "left";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->containers["toplinks"] = array();

$layout->containers["toplinks"][] = array("name"=>"toplinks_print","block"=>"prints_block","substyle"=>1);


$layout->containers["toplinks"][] = array("name"=>"toplinks_advsearch","block"=>"asearch_link","substyle"=>1);





$layout->skins["toplinks"] = "empty";
$layout->blocks["top"][] = "toplinks";
$layout->containers["search"] = array();

$layout->containers["search"][] = array("name"=>"search","block"=>"searchform_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"search_buttons","block"=>"searchformbuttons_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"details_found","block"=>"details_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"page_of","block"=>"pages_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"recsperpage","block"=>"recordspp_block","substyle"=>1);


$layout->skins["search"] = "2";
$layout->blocks["top"][] = "search";$page_layouts["devotee_family_member_list"] = $layout;

$layout = new TLayout("list2","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["recordcontrols"] = array();

$layout->containers["recordcontrols"][] = array("name"=>"recordcontrols_new","block"=>"newrecord_controls_block","substyle"=>1);


$layout->containers["recordcontrols"][] = array("name"=>"recordcontrol","block"=>"record_controls_block","substyle"=>1);


$layout->skins["recordcontrols"] = "1";
$layout->blocks["center"][] = "recordcontrols";
$layout->containers["message"] = array();

$layout->containers["message"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->skins["message"] = "2";
$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"grid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "grid";
$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();

$layout->containers["pagination"][] = array("name"=>"pagination","block"=>"pagination_block","substyle"=>1);


$layout->skins["pagination"] = "2";
$layout->blocks["center"][] = "pagination";$layout->blocks["left"] = array();
$layout->skins["lang"] = "menu";
$layout->blocks["left"][] = "lang";
$layout->containers["logg"] = array();

$layout->containers["logg"][] = array("name"=>"loggedas","block"=>"security_block","substyle"=>1);


$layout->skins["logg"] = "menu";
$layout->blocks["left"][] = "logg";
$layout->containers["left"] = array();

$layout->containers["left"][] = array("name"=>"searchpanel","block"=>"searchPanel","substyle"=>1);


$layout->containers["left"][] = array("name"=>"vmenu","block"=>"menu_block","substyle"=>1);


$layout->skins["left"] = "menu";
$layout->blocks["left"][] = "left";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->containers["toplinks"] = array();

$layout->containers["toplinks"][] = array("name"=>"toplinks_print","block"=>"prints_block","substyle"=>1);


$layout->containers["toplinks"][] = array("name"=>"toplinks_advsearch","block"=>"asearch_link","substyle"=>1);





$layout->skins["toplinks"] = "empty";
$layout->blocks["top"][] = "toplinks";
$layout->containers["search"] = array();

$layout->containers["search"][] = array("name"=>"search","block"=>"searchform_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"search_buttons","block"=>"searchformbuttons_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"details_found","block"=>"details_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"page_of","block"=>"pages_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"recsperpage","block"=>"recordspp_block","substyle"=>1);


$layout->skins["search"] = "2";
$layout->blocks["top"][] = "search";$page_layouts["devotee_company_list"] = $layout;


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
	$dpPermis = $pageObject->getPermissions("devotee_address");
	if ($dpPermis['search']){
		$mKeys["devotee_address"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_address");
		$dpParams['strTableNames'][] = "devotee_address";
		$dpParams['ids'][] = ++$ids;
	}
	$dpPermis = $pageObject->getPermissions("devotee_donation");
	if ($dpPermis['search']){
		$mKeys["devotee_donation"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_donation");
		$dpParams['strTableNames'][] = "devotee_donation";
		$dpParams['ids'][] = ++$ids;
	}
	$dpPermis = $pageObject->getPermissions("devotee_language");
	if ($dpPermis['search']){
		$mKeys["devotee_language"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_language");
		$dpParams['strTableNames'][] = "devotee_language";
		$dpParams['ids'][] = ++$ids;
	}
	$dpPermis = $pageObject->getPermissions("devotee_org");
	if ($dpPermis['search']){
		$mKeys["devotee_org"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_org");
		$dpParams['strTableNames'][] = "devotee_org";
		$dpParams['ids'][] = ++$ids;
	}
	$dpPermis = $pageObject->getPermissions("devotee_family_member");
	if ($dpPermis['search']){
		$mKeys["devotee_family_member"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_family_member");
		$dpParams['strTableNames'][] = "devotee_family_member";
		$dpParams['ids'][] = ++$ids;
	}
	$dpPermis = $pageObject->getPermissions("devotee_company");
	if ($dpPermis['search']){
		$mKeys["devotee_company"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_company");
		$dpParams['strTableNames'][] = "devotee_company";
		$dpParams['ids'][] = ++$ids;
	}
	$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array();
}

//	Before Process event
if($eventObj->exists("BeforeProcessView"))
	$eventObj->BeforeProcessView($conn, $pageObject);
	
//	read current values from the database
$data = $pageObject->getCurrentRecordInternal();

if (!sizeof($data)) {
	header("Location: devotee_list.php?a=return");
	exit();
}

$out = "";
$first = true;
$fieldsArr = array();
$arr = array();
$arr['fName'] = "FullName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("FullName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Photo";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Photo");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "TitleId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("TitleId");
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
$arr['fName'] = "InitiatedName";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("InitiatedName");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfBirth";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfBirth");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Gender";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Gender");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "CounsellorDevoteeID";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("CounsellorDevoteeID");
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
$arr['fName'] = "MobilePhone";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("MobilePhone");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "WorkPhone";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("WorkPhone");
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
$arr['fName'] = "NativeCity";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("NativeCity");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "NativeState";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("NativeState");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "BloodGroup";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("BloodGroup");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "YearOfIntroduction";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("YearOfIntroduction");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "IntroducedBy";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("IntroducedBy");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "IntroducedInCenter";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("IntroducedInCenter");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Chanting16RoundsSince";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Chanting16RoundsSince");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "SpiritualMasterId";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("SpiritualMasterId");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfHarinamInitiation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfHarinamInitiation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DateOfBrahmanInitiation";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("DateOfBrahmanInitiation");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "PreviousReligion";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("PreviousReligion");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "PreferedServices";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("PreferedServices");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "ServicesRendered";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("ServicesRendered");
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
//FullName - 
	
	$value = $pageObject->showDBValue("FullName", $data, $keylink);
	if($mainTableOwnerID=="FullName")
		$ownerIdValue=$value;
	$xt->assign("FullName_value",$value);
	if(!$pageObject->isAppearOnTabs("FullName"))
		$xt->assign("FullName_fieldblock",true);
	else
		$xt->assign("FullName_tabfieldblock",true);
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
//InitiatedName - 
	
	$value = $pageObject->showDBValue("InitiatedName", $data, $keylink);
	if($mainTableOwnerID=="InitiatedName")
		$ownerIdValue=$value;
	$xt->assign("InitiatedName_value",$value);
	if(!$pageObject->isAppearOnTabs("InitiatedName"))
		$xt->assign("InitiatedName_fieldblock",true);
	else
		$xt->assign("InitiatedName_tabfieldblock",true);
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
//Gender - Checkbox
	
	$value = $pageObject->showDBValue("Gender", $data, $keylink);
	if($mainTableOwnerID=="Gender")
		$ownerIdValue=$value;
	$xt->assign("Gender_value",$value);
	if(!$pageObject->isAppearOnTabs("Gender"))
		$xt->assign("Gender_fieldblock",true);
	else
		$xt->assign("Gender_tabfieldblock",true);
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
//NativeCity - 
	
	$value = $pageObject->showDBValue("NativeCity", $data, $keylink);
	if($mainTableOwnerID=="NativeCity")
		$ownerIdValue=$value;
	$xt->assign("NativeCity_value",$value);
	if(!$pageObject->isAppearOnTabs("NativeCity"))
		$xt->assign("NativeCity_fieldblock",true);
	else
		$xt->assign("NativeCity_tabfieldblock",true);
////////////////////////////////////////////
//NativeState - 
	
	$value = $pageObject->showDBValue("NativeState", $data, $keylink);
	if($mainTableOwnerID=="NativeState")
		$ownerIdValue=$value;
	$xt->assign("NativeState_value",$value);
	if(!$pageObject->isAppearOnTabs("NativeState"))
		$xt->assign("NativeState_fieldblock",true);
	else
		$xt->assign("NativeState_tabfieldblock",true);
////////////////////////////////////////////
//BloodGroup - 
	
	$value = $pageObject->showDBValue("BloodGroup", $data, $keylink);
	if($mainTableOwnerID=="BloodGroup")
		$ownerIdValue=$value;
	$xt->assign("BloodGroup_value",$value);
	if(!$pageObject->isAppearOnTabs("BloodGroup"))
		$xt->assign("BloodGroup_fieldblock",true);
	else
		$xt->assign("BloodGroup_tabfieldblock",true);
////////////////////////////////////////////
//YearOfIntroduction - 
	
	$value = $pageObject->showDBValue("YearOfIntroduction", $data, $keylink);
	if($mainTableOwnerID=="YearOfIntroduction")
		$ownerIdValue=$value;
	$xt->assign("YearOfIntroduction_value",$value);
	if(!$pageObject->isAppearOnTabs("YearOfIntroduction"))
		$xt->assign("YearOfIntroduction_fieldblock",true);
	else
		$xt->assign("YearOfIntroduction_tabfieldblock",true);
////////////////////////////////////////////
//IntroducedBy - 
	
	$value = $pageObject->showDBValue("IntroducedBy", $data, $keylink);
	if($mainTableOwnerID=="IntroducedBy")
		$ownerIdValue=$value;
	$xt->assign("IntroducedBy_value",$value);
	if(!$pageObject->isAppearOnTabs("IntroducedBy"))
		$xt->assign("IntroducedBy_fieldblock",true);
	else
		$xt->assign("IntroducedBy_tabfieldblock",true);
////////////////////////////////////////////
//IntroducedInCenter - 
	
	$value = $pageObject->showDBValue("IntroducedInCenter", $data, $keylink);
	if($mainTableOwnerID=="IntroducedInCenter")
		$ownerIdValue=$value;
	$xt->assign("IntroducedInCenter_value",$value);
	if(!$pageObject->isAppearOnTabs("IntroducedInCenter"))
		$xt->assign("IntroducedInCenter_fieldblock",true);
	else
		$xt->assign("IntroducedInCenter_tabfieldblock",true);
////////////////////////////////////////////
//Chanting16RoundsSince - Short Date
	
	$value = $pageObject->showDBValue("Chanting16RoundsSince", $data, $keylink);
	if($mainTableOwnerID=="Chanting16RoundsSince")
		$ownerIdValue=$value;
	$xt->assign("Chanting16RoundsSince_value",$value);
	if(!$pageObject->isAppearOnTabs("Chanting16RoundsSince"))
		$xt->assign("Chanting16RoundsSince_fieldblock",true);
	else
		$xt->assign("Chanting16RoundsSince_tabfieldblock",true);
////////////////////////////////////////////
//SpiritualMasterId - 
	
	$value = $pageObject->showDBValue("SpiritualMasterId", $data, $keylink);
	if($mainTableOwnerID=="SpiritualMasterId")
		$ownerIdValue=$value;
	$xt->assign("SpiritualMasterId_value",$value);
	if(!$pageObject->isAppearOnTabs("SpiritualMasterId"))
		$xt->assign("SpiritualMasterId_fieldblock",true);
	else
		$xt->assign("SpiritualMasterId_tabfieldblock",true);
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
//DateOfBrahmanInitiation - Short Date
	
	$value = $pageObject->showDBValue("DateOfBrahmanInitiation", $data, $keylink);
	if($mainTableOwnerID=="DateOfBrahmanInitiation")
		$ownerIdValue=$value;
	$xt->assign("DateOfBrahmanInitiation_value",$value);
	if(!$pageObject->isAppearOnTabs("DateOfBrahmanInitiation"))
		$xt->assign("DateOfBrahmanInitiation_fieldblock",true);
	else
		$xt->assign("DateOfBrahmanInitiation_tabfieldblock",true);
////////////////////////////////////////////
//PreviousReligion - 
	
	$value = $pageObject->showDBValue("PreviousReligion", $data, $keylink);
	if($mainTableOwnerID=="PreviousReligion")
		$ownerIdValue=$value;
	$xt->assign("PreviousReligion_value",$value);
	if(!$pageObject->isAppearOnTabs("PreviousReligion"))
		$xt->assign("PreviousReligion_fieldblock",true);
	else
		$xt->assign("PreviousReligion_tabfieldblock",true);
////////////////////////////////////////////
//PreferedServices - 
	
	$value = $pageObject->showDBValue("PreferedServices", $data, $keylink);
	if($mainTableOwnerID=="PreferedServices")
		$ownerIdValue=$value;
	$xt->assign("PreferedServices_value",$value);
	if(!$pageObject->isAppearOnTabs("PreferedServices"))
		$xt->assign("PreferedServices_fieldblock",true);
	else
		$xt->assign("PreferedServices_tabfieldblock",true);
////////////////////////////////////////////
//ServicesRendered - 
	
	$value = $pageObject->showDBValue("ServicesRendered", $data, $keylink);
	if($mainTableOwnerID=="ServicesRendered")
		$ownerIdValue=$value;
	$xt->assign("ServicesRendered_value",$value);
	if(!$pageObject->isAppearOnTabs("ServicesRendered"))
		$xt->assign("ServicesRendered_fieldblock",true);
	else
		$xt->assign("ServicesRendered_tabfieldblock",true);

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
		$options['masterTable'] = "devotee";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "devotee";
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
	$strTableName = "devotee";
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
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='devotee_edit.php?".$editlink."'\"");

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
