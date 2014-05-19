<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

add_nocache_headers();
include("include/devotee_variables.php");
include('include/xtempl.php');
include('classes/addpage.php');

global $globalEvents;

//	check if logged in
if(@$_SESSION["UserID"] && IsAdmin() && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{
	echo "<p>"."You don't have permissions to access this table"."<br>Proceed to <a href=\"admin.php\">Admin Area</a> to set up user permissions</p>";
	return;
}
if(!isLogged() || CheckPermissionsEvent($strTableName, 'A') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	
	header("Location: login.php?message=expired"); 
	return;
}

if ((sizeof($_POST)==0) && (postvalue('ferror'))){
	if (postvalue("inline")){
		$returnJSON['success'] = false;
		$returnJSON['message'] = "Error occurred";
		$returnJSON['fatalError'] = true;
		echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
		exit();
	}
	else if (postvalue("fly")){
		echo -1;
		exit();
	}
	else {
		$_SESSION["message_add"] = "<< "."Error occurred"." >>";
	}
}

$layout = new TLayout("add2","RoundedAqua1","MobileAqua1");
$layout->blocks["top"] = array();
$layout->containers["add"] = array();

$layout->containers["add"][] = array("name"=>"addheader","block"=>"","substyle"=>2);


$layout->containers["add"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->containers["add"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"addfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"legend","block"=>"legend","substyle"=>3);


$layout->containers["fields"][] = array("name"=>"addbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["add"] = "1";
$layout->blocks["top"][] = "add";
$layout->containers["details"] = array();

$layout->containers["details"][] = array("name"=>"adddetails","block"=>"detail_tables","substyle"=>1);


$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["devotee_add"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Primary_Info1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Phone1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Address1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Marital_Status1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Extra_Info1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Work_Experience1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Spiritual_Life1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Family_Members1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Devotee_Donation1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Language1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Organization1"] = $layout;

$layout = new TLayout("tab","RoundedAqua1","MobileAqua1");
$layout->blocks["bare"] = array();
$layout->containers["1"] = array();

$layout->containers["1"][] = array("name"=>"addtabfield","block"=>"","substyle"=>1);


$layout->skins["1"] = "fields";
$layout->blocks["bare"][] = "1";$page_layouts["devotee_add_Login_Access1"] = $layout;


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


$filename = "";
$status = "";
$message = "";
$mesClass = "";
$usermessage = "";
$error_happened = false;
$readavalues = false;

$keys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
$popUpSave = false;

$sessionPrefix = $strTableName;

$onFly = false;
if(postvalue("onFly"))
	$onFly = true;

if(@$_REQUEST["editType"]=="inline")
	$inlineadd = ADD_INLINE;
elseif(@$_REQUEST["editType"]==ADD_POPUP)
{
	$inlineadd = ADD_POPUP;
	if(@$_POST["a"]=="added" && postvalue("field")=="" && postvalue("category")=="")
		$popUpSave = true;	
}
elseif(@$_REQUEST["editType"]==ADD_MASTER)
	$inlineadd = ADD_MASTER;
elseif($onFly)
{
	$inlineadd = ADD_ONTHEFLY;
	$sessionPrefix = $strTableName."_add";
}
else
	$inlineadd = ADD_SIMPLE;

if($inlineadd == ADD_INLINE)
	$templatefile = "devotee_inline_add.htm";
else
	$templatefile = "devotee_add.htm";

$id = postvalue("id");
if(intval($id)==0)
	$id = 1;

//If undefined session value for mastet table, but exist post value master table, than take second
//It may be happen only when use dpInline mode on page add
if(!@$_SESSION[$sessionPrefix."_mastertable"] && postvalue("mastertable"))
	$_SESSION[$sessionPrefix."_mastertable"] = postvalue("mastertable");
	
$xt = new Xtempl();
	
// assign an id
$xt->assign("id",$id);
	
$auditObj = GetAuditObject($strTableName);

//array of params for classes
$params = array("pageType" => PAGE_ADD,"id" => $id,"mode" => $inlineadd);


$params['xt'] = &$xt;
$params['tName'] = $strTableName;
$params['includes_js'] = $includes_js;
$params['locale_info'] = $locale_info;
$params['includes_css'] = $includes_css;
$params['useTabsOnAdd'] = $gSettings->useTabsOnAdd();
$params['templatefile'] = $templatefile;
$params['includes_jsreq'] = $includes_jsreq;
$params['pageAddLikeInline'] = ($inlineadd==ADD_INLINE);
$params['needSearchClauseObj'] = false;
$params['strOriginalTableName'] = $strOriginalTableName;

if($params['useTabsOnAdd'])
	$params['arrAddTabs'] = $gSettings->getAddTabs();
	
$pageObject = new AddPage($params);

if(isset($_REQUEST['afteradd'])){
		header('Location: devotee_add.php');
	if($eventObj->exists("AfterAdd") && isset($_SESSION['after_add_data'][$_REQUEST['afteradd']])){
	
		$data = $_SESSION['after_add_data'][$_REQUEST['afteradd']];
		$eventObj->AfterAdd($data['avalues'], $data['keys'],$data['inlineadd'], $pageObject);
	
	}
	unset($_SESSION['after_add_data'][$_REQUEST['afteradd']]);
	
	foreach (is_array($_SESSION['after_add_data']) ? $_SESSION['after_add_data'] : array() as $k=>$v){
		if (!is_array($v) or !array_key_exists('time',$v)) {
			unset($_SESSION['after_add_data'][$k]);
			continue;
		}
		if ($v['time'] < time() - 3600){
			unset($_SESSION['after_add_data'][$k]);
		}
	}
		exit;
}

//Get detail table keys	
$detailKeys = $pageObject->detailKeysByM;

//Array of fields, which appear on add page
$addFields = $pageObject->getFieldsByPageType();

// add button events if exist
if ($inlineadd==ADD_SIMPLE)
	$pageObject->addButtonHandlers();

$url_page=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

//For show detail tables on master page add
if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{
	$dpParams = array();
	if($pageObject->isShowDetailTables  && !isMobile())
	{
		$ids = $id;
		$countDetailsIsShow = 0;
			$dpPermis = $pageObject->getPermissions("devotee_address");
		if ($dpPermis['add']){
			$countDetailsIsShow ++;
			$mKeys["devotee_address"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_address");
			$dpParams['strTableNames'][] = "devotee_address";
			$dpParams['ids'][] = ++$ids;
		}
			$dpPermis = $pageObject->getPermissions("devotee_donation");
		if ($dpPermis['add']){
			$countDetailsIsShow ++;
			$mKeys["devotee_donation"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_donation");
			$dpParams['strTableNames'][] = "devotee_donation";
			$dpParams['ids'][] = ++$ids;
		}
			$dpPermis = $pageObject->getPermissions("devotee_language");
		if ($dpPermis['add']){
			$countDetailsIsShow ++;
			$mKeys["devotee_language"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_language");
			$dpParams['strTableNames'][] = "devotee_language";
			$dpParams['ids'][] = ++$ids;
		}
			$dpPermis = $pageObject->getPermissions("devotee_org");
		if ($dpPermis['add']){
			$countDetailsIsShow ++;
			$mKeys["devotee_org"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_org");
			$dpParams['strTableNames'][] = "devotee_org";
			$dpParams['ids'][] = ++$ids;
		}
			$dpPermis = $pageObject->getPermissions("devotee_family_member");
		if ($dpPermis['add']){
			$countDetailsIsShow ++;
			$mKeys["devotee_family_member"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_family_member");
			$dpParams['strTableNames'][] = "devotee_family_member";
			$dpParams['ids'][] = ++$ids;
		}
			$dpPermis = $pageObject->getPermissions("devotee_company");
		if ($dpPermis['add']){
			$countDetailsIsShow ++;
			$mKeys["devotee_company"] = $pageObject->pSet->getMasterKeysByDetailTable("devotee_company");
			$dpParams['strTableNames'][] = "devotee_company";
			$dpParams['ids'][] = ++$ids;
		}
			$pageObject->jsSettings['tableSettings'][$strTableName]['isShowDetails'] = $countDetailsIsShow > 0 ? true : false;
		$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
	}
}

//	Before Process event
if($eventObj->exists("BeforeProcessAdd"))
	$eventObj->BeforeProcessAdd($conn, $pageObject);

// proccess captcha
if ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
	if($pageObject->captchaExists())
		$pageObject->doCaptchaCode();
	
// insert new record if we have to
if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$blobfields=array();
//	processing Photo - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Photo = $pageObject->getControl("Photo", $id);
		$control_Photo->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Photo - end
//	processing TitleId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_TitleId = $pageObject->getControl("TitleId", $id);
		$control_TitleId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing TitleId - end
//	processing FirstName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_FirstName = $pageObject->getControl("FirstName", $id);
		$control_FirstName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing FirstName - end
//	processing LastName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_LastName = $pageObject->getControl("LastName", $id);
		$control_LastName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing LastName - end
//	processing MiddleName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_MiddleName = $pageObject->getControl("MiddleName", $id);
		$control_MiddleName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing MiddleName - end
//	processing InitiatedName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_InitiatedName = $pageObject->getControl("InitiatedName", $id);
		$control_InitiatedName->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing InitiatedName - end
//	processing DateOfBirth - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DateOfBirth = $pageObject->getControl("DateOfBirth", $id);
		$control_DateOfBirth->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DateOfBirth - end
//	processing Gender - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Gender = $pageObject->getControl("Gender", $id);
		$control_Gender->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Gender - end
//	processing CounsellorDevoteeID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_CounsellorDevoteeID = $pageObject->getControl("CounsellorDevoteeID", $id);
		$control_CounsellorDevoteeID->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing CounsellorDevoteeID - end
//	processing EmailPrimary - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_EmailPrimary = $pageObject->getControl("EmailPrimary", $id);
		$control_EmailPrimary->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing EmailPrimary - end
//	processing EmailSecondary - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_EmailSecondary = $pageObject->getControl("EmailSecondary", $id);
		$control_EmailSecondary->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing EmailSecondary - end
//	processing MobilePhone - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_MobilePhone = $pageObject->getControl("MobilePhone", $id);
		$control_MobilePhone->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing MobilePhone - end
//	processing WorkPhone - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_WorkPhone = $pageObject->getControl("WorkPhone", $id);
		$control_WorkPhone->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing WorkPhone - end
//	processing MaritalStatusId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_MaritalStatusId = $pageObject->getControl("MaritalStatusId", $id);
		$control_MaritalStatusId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing MaritalStatusId - end
//	processing DateofMarriage - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DateofMarriage = $pageObject->getControl("DateofMarriage", $id);
		$control_DateofMarriage->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DateofMarriage - end
//	processing SpouseDevoteeId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_SpouseDevoteeId = $pageObject->getControl("SpouseDevoteeId", $id);
		$control_SpouseDevoteeId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing SpouseDevoteeId - end
//	processing NativeCity - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_NativeCity = $pageObject->getControl("NativeCity", $id);
		$control_NativeCity->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing NativeCity - end
//	processing NativeState - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_NativeState = $pageObject->getControl("NativeState", $id);
		$control_NativeState->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing NativeState - end
//	processing BloodGroup - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_BloodGroup = $pageObject->getControl("BloodGroup", $id);
		$control_BloodGroup->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing BloodGroup - end
//	processing YearOfIntroduction - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_YearOfIntroduction = $pageObject->getControl("YearOfIntroduction", $id);
		$control_YearOfIntroduction->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing YearOfIntroduction - end
//	processing IntroducedBy - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_IntroducedBy = $pageObject->getControl("IntroducedBy", $id);
		$control_IntroducedBy->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing IntroducedBy - end
//	processing IntroducedInCenter - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_IntroducedInCenter = $pageObject->getControl("IntroducedInCenter", $id);
		$control_IntroducedInCenter->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing IntroducedInCenter - end
//	processing Chanting16RoundsSince - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Chanting16RoundsSince = $pageObject->getControl("Chanting16RoundsSince", $id);
		$control_Chanting16RoundsSince->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Chanting16RoundsSince - end
//	processing SpiritualMasterId - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_SpiritualMasterId = $pageObject->getControl("SpiritualMasterId", $id);
		$control_SpiritualMasterId->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing SpiritualMasterId - end
//	processing DateOfHarinamInitiation - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DateOfHarinamInitiation = $pageObject->getControl("DateOfHarinamInitiation", $id);
		$control_DateOfHarinamInitiation->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DateOfHarinamInitiation - end
//	processing DateOfBrahmanInitiation - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_DateOfBrahmanInitiation = $pageObject->getControl("DateOfBrahmanInitiation", $id);
		$control_DateOfBrahmanInitiation->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing DateOfBrahmanInitiation - end
//	processing PreviousReligion - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_PreviousReligion = $pageObject->getControl("PreviousReligion", $id);
		$control_PreviousReligion->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing PreviousReligion - end
//	processing PreferedServices - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_PreferedServices = $pageObject->getControl("PreferedServices", $id);
		$control_PreferedServices->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing PreferedServices - end
//	processing ServicesRendered - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_ServicesRendered = $pageObject->getControl("ServicesRendered", $id);
		$control_ServicesRendered->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing ServicesRendered - end
//	processing active - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_active = $pageObject->getControl("active", $id);
		$control_active->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing active - end
//	processing Password - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$control_Password = $pageObject->getControl("Password", $id);
		$control_Password->readWebValue($avalues, $blobfields, "", false, $afilename_values);
	}
//	processing Password - end




	$failed_inline_add=false;
//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
	
//	before Add event
	$retval = true;
	if($eventObj->exists("BeforeAdd"))
		$retval = $eventObj->BeforeAdd($avalues,$usermessage,(bool)$inlineadd, $pageObject);
	if($retval && $pageObject->isCaptchaOk)
	{
		//add or set updated lat-lng values for all map fileds with 'UpdateLatLng' ticked
		setUpdatedLatLng($avalues, $pageObject->cipherer->pSet);
		
		$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
		if(DoInsertRecord($strOriginalTableName,$avalues,$blobfields,$id,$pageObject, $pageObject->cipherer))
		{
			$IsSaved=true;
//	after edit event
			if($auditObj || $eventObj->exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
			}
			
			if($auditObj)
				$auditObj->LogAdd($strTableName,$avalues,$keys);
				
// Give possibility to all edit controls to clean their data				
//	processing Photo - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Photo->afterSuccessfulSave();
			}
//	processing Photo - end
//	processing TitleId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_TitleId->afterSuccessfulSave();
			}
//	processing TitleId - end
//	processing FirstName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_FirstName->afterSuccessfulSave();
			}
//	processing FirstName - end
//	processing LastName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_LastName->afterSuccessfulSave();
			}
//	processing LastName - end
//	processing MiddleName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_MiddleName->afterSuccessfulSave();
			}
//	processing MiddleName - end
//	processing InitiatedName - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_InitiatedName->afterSuccessfulSave();
			}
//	processing InitiatedName - end
//	processing DateOfBirth - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DateOfBirth->afterSuccessfulSave();
			}
//	processing DateOfBirth - end
//	processing Gender - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Gender->afterSuccessfulSave();
			}
//	processing Gender - end
//	processing CounsellorDevoteeID - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_CounsellorDevoteeID->afterSuccessfulSave();
			}
//	processing CounsellorDevoteeID - end
//	processing EmailPrimary - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_EmailPrimary->afterSuccessfulSave();
			}
//	processing EmailPrimary - end
//	processing EmailSecondary - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_EmailSecondary->afterSuccessfulSave();
			}
//	processing EmailSecondary - end
//	processing MobilePhone - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_MobilePhone->afterSuccessfulSave();
			}
//	processing MobilePhone - end
//	processing WorkPhone - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_WorkPhone->afterSuccessfulSave();
			}
//	processing WorkPhone - end
//	processing MaritalStatusId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_MaritalStatusId->afterSuccessfulSave();
			}
//	processing MaritalStatusId - end
//	processing DateofMarriage - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DateofMarriage->afterSuccessfulSave();
			}
//	processing DateofMarriage - end
//	processing SpouseDevoteeId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_SpouseDevoteeId->afterSuccessfulSave();
			}
//	processing SpouseDevoteeId - end
//	processing NativeCity - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_NativeCity->afterSuccessfulSave();
			}
//	processing NativeCity - end
//	processing NativeState - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_NativeState->afterSuccessfulSave();
			}
//	processing NativeState - end
//	processing BloodGroup - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_BloodGroup->afterSuccessfulSave();
			}
//	processing BloodGroup - end
//	processing YearOfIntroduction - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_YearOfIntroduction->afterSuccessfulSave();
			}
//	processing YearOfIntroduction - end
//	processing IntroducedBy - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_IntroducedBy->afterSuccessfulSave();
			}
//	processing IntroducedBy - end
//	processing IntroducedInCenter - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_IntroducedInCenter->afterSuccessfulSave();
			}
//	processing IntroducedInCenter - end
//	processing Chanting16RoundsSince - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Chanting16RoundsSince->afterSuccessfulSave();
			}
//	processing Chanting16RoundsSince - end
//	processing SpiritualMasterId - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_SpiritualMasterId->afterSuccessfulSave();
			}
//	processing SpiritualMasterId - end
//	processing DateOfHarinamInitiation - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DateOfHarinamInitiation->afterSuccessfulSave();
			}
//	processing DateOfHarinamInitiation - end
//	processing DateOfBrahmanInitiation - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_DateOfBrahmanInitiation->afterSuccessfulSave();
			}
//	processing DateOfBrahmanInitiation - end
//	processing PreviousReligion - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_PreviousReligion->afterSuccessfulSave();
			}
//	processing PreviousReligion - end
//	processing PreferedServices - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_PreferedServices->afterSuccessfulSave();
			}
//	processing PreferedServices - end
//	processing ServicesRendered - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_ServicesRendered->afterSuccessfulSave();
			}
//	processing ServicesRendered - end
//	processing active - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_active->afterSuccessfulSave();
			}
//	processing active - end
//	processing Password - start
			$inlineAddOption = true;
			$inlineAddOption = $inlineadd!=ADD_INLINE;
			if($inlineAddOption)
			{
				$control_Password->afterSuccessfulSave();
			}
//	processing Password - end

			$afterAdd_id = '';	
			if($eventObj->exists("AfterAdd") && $inlineadd!=ADD_MASTER){
				$eventObj->AfterAdd($avalues,$keys,(bool)$inlineadd, $pageObject);
			} else if ($eventObj->exists("AfterAdd") && $inlineadd==ADD_MASTER){
				if($onFly)
					$eventObj->AfterAdd($avalues,$keys,(bool)$inlineadd, $pageObject);
				else{
					$afterAdd_id = generatePassword(20);	
				
					$_SESSION['after_add_data'][$afterAdd_id] = array(
						'avalues'=>$avalues,
						'keys'=>$keys,
						'inlineadd'=>(bool)$inlineadd,
						'time' => time()
					);	
				}
			}
				
			if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
			{
				$permis = array();
				$keylink = "";$k = 0;
				foreach($keys as $idx=>$val)
				{
					if($k!=0)
						$keylink .="&";
					$keylink .="editid".(++$k)."=".htmlspecialchars(rawurlencode(@$val));
				}
				$permis = $pageObject->getPermissions();				
				if (count($keys))
				{
					$message .="</br>";
					if($pageObject->pSet->hasEditPage() && $permis['edit'])
						$message .='&nbsp;<a href=\'devotee_edit.php?'.$keylink.'\'>'."Edit".'</a>&nbsp;';
					if($pageObject->pSet->hasViewPage() && $permis['search'])
						$message .='&nbsp;<a href=\'devotee_view.php?'.$keylink.'\'>'."View".'</a>&nbsp;';
				}
				$mesClass = "mes_ok";	
			}
		}
		elseif($inlineadd!=ADD_INLINE)
			$mesClass = "mes_not";	
	}
	else
	{
		$message = $usermessage;
		$status = "DECLINED";
		$readavalues = true;
	}
}
if($message)
	$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if (no_output_done() && $inlineadd==ADD_SIMPLE && $IsSaved)
{
	// saving message
	$_SESSION["message_add"] = ($message ? $message : "");
	// redirect
	header("Location: devotee_".$pageObject->getPageType().".php");
	// turned on output buffering, so we need to stop script
	exit();
}

if($inlineadd==ADD_MASTER && $IsSaved)
	$_SESSION["message_add"] = ($message ? $message : "");
	
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if($inlineadd==ADD_SIMPLE && isset($_SESSION["message_add"]))
{
	$message = $_SESSION["message_add"];
	unset($_SESSION["message_add"]);
}

$defvalues=array();

//	copy record
if(array_key_exists("copyid1",$_REQUEST) || array_key_exists("editid1",$_REQUEST))
{
	$copykeys=array();
	if(array_key_exists("copyid1",$_REQUEST))
	{
		$copykeys["DevoteeId"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["DevoteeId"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = $gQuery->gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs = db_query($strSQL,$conn);
	$defvalues = $pageObject->cipherer->DecryptFetchedArray($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["DevoteeId"]="";
//call CopyOnLoad event
	if($eventObj->exists("CopyOnLoad"))
		$eventObj->CopyOnLoad($defvalues,$strWhere, $pageObject);
}
else
{
	$defvalues["active"] = 0;
}



if($readavalues)
{
	$defvalues["TitleId"]=@$avalues["TitleId"];
	$defvalues["FirstName"]=@$avalues["FirstName"];
	$defvalues["LastName"]=@$avalues["LastName"];
	$defvalues["MiddleName"]=@$avalues["MiddleName"];
	$defvalues["Gender"]=@$avalues["Gender"];
	$defvalues["DateOfBirth"]=@$avalues["DateOfBirth"];
	$defvalues["MaritalStatusId"]=@$avalues["MaritalStatusId"];
	$defvalues["DateofMarriage"]=@$avalues["DateofMarriage"];
	$defvalues["SpouseDevoteeId"]=@$avalues["SpouseDevoteeId"];
	$defvalues["MobilePhone"]=@$avalues["MobilePhone"];
	$defvalues["WorkPhone"]=@$avalues["WorkPhone"];
	$defvalues["EmailPrimary"]=@$avalues["EmailPrimary"];
	$defvalues["EmailSecondary"]=@$avalues["EmailSecondary"];
	$defvalues["Password"]=@$avalues["Password"];
	$defvalues["active"]=@$avalues["active"];
	$defvalues["CounsellorDevoteeID"]=@$avalues["CounsellorDevoteeID"];
	$defvalues["NativeCity"]=@$avalues["NativeCity"];
	$defvalues["NativeState"]=@$avalues["NativeState"];
	$defvalues["BloodGroup"]=@$avalues["BloodGroup"];
	$defvalues["DateOfHarinamInitiation"]=@$avalues["DateOfHarinamInitiation"];
	$defvalues["DateOfBrahmanInitiation"]=@$avalues["DateOfBrahmanInitiation"];
	$defvalues["SpiritualMasterId"]=@$avalues["SpiritualMasterId"];
	$defvalues["PreviousReligion"]=@$avalues["PreviousReligion"];
	$defvalues["Chanting16RoundsSince"]=@$avalues["Chanting16RoundsSince"];
	$defvalues["IntroducedBy"]=@$avalues["IntroducedBy"];
	$defvalues["YearOfIntroduction"]=@$avalues["YearOfIntroduction"];
	$defvalues["IntroducedInCenter"]=@$avalues["IntroducedInCenter"];
	$defvalues["PreferedServices"]=@$avalues["PreferedServices"];
	$defvalues["ServicesRendered"]=@$avalues["ServicesRendered"];
	$defvalues["InitiatedName"]=@$avalues["InitiatedName"];
}

if($eventObj->exists("ProcessValuesAdd"))
	$eventObj->ProcessValuesAdd($defvalues, $pageObject);


//for basic files
$includes="";

if($inlineadd!=ADD_INLINE)
{
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$includes .="<script language=\"JavaScript\" src=\"include/loadfirst.js\"></script>\r\n";
				$includes.="<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";
		if (!isMobile())
			$includes.="<div id=\"search_suggest\"></div>\r\n";
	}
	
	if(!$pageObject->isAppearOnTabs("TitleId"))
		$xt->assign("TitleId_fieldblock",true);
	else
		$xt->assign("TitleId_tabfieldblock",true);
	$xt->assign("TitleId_label",true);
	if(isEnableSection508())
		$xt->assign_section("TitleId_label","<label for=\"".GetInputElementId("TitleId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Photo"))
		$xt->assign("Photo_fieldblock",true);
	else
		$xt->assign("Photo_tabfieldblock",true);
	$xt->assign("Photo_label",true);
	if(isEnableSection508())
		$xt->assign_section("Photo_label","<label for=\"".GetInputElementId("Photo", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("FirstName"))
		$xt->assign("FirstName_fieldblock",true);
	else
		$xt->assign("FirstName_tabfieldblock",true);
	$xt->assign("FirstName_label",true);
	if(isEnableSection508())
		$xt->assign_section("FirstName_label","<label for=\"".GetInputElementId("FirstName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("LastName"))
		$xt->assign("LastName_fieldblock",true);
	else
		$xt->assign("LastName_tabfieldblock",true);
	$xt->assign("LastName_label",true);
	if(isEnableSection508())
		$xt->assign_section("LastName_label","<label for=\"".GetInputElementId("LastName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("MiddleName"))
		$xt->assign("MiddleName_fieldblock",true);
	else
		$xt->assign("MiddleName_tabfieldblock",true);
	$xt->assign("MiddleName_label",true);
	if(isEnableSection508())
		$xt->assign_section("MiddleName_label","<label for=\"".GetInputElementId("MiddleName", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Gender"))
		$xt->assign("Gender_fieldblock",true);
	else
		$xt->assign("Gender_tabfieldblock",true);
	$xt->assign("Gender_label",true);
	if(isEnableSection508())
		$xt->assign_section("Gender_label","<label for=\"".GetInputElementId("Gender", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DateOfBirth"))
		$xt->assign("DateOfBirth_fieldblock",true);
	else
		$xt->assign("DateOfBirth_tabfieldblock",true);
	$xt->assign("DateOfBirth_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateOfBirth_label","<label for=\"".GetInputElementId("DateOfBirth", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("MaritalStatusId"))
		$xt->assign("MaritalStatusId_fieldblock",true);
	else
		$xt->assign("MaritalStatusId_tabfieldblock",true);
	$xt->assign("MaritalStatusId_label",true);
	if(isEnableSection508())
		$xt->assign_section("MaritalStatusId_label","<label for=\"".GetInputElementId("MaritalStatusId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DateofMarriage"))
		$xt->assign("DateofMarriage_fieldblock",true);
	else
		$xt->assign("DateofMarriage_tabfieldblock",true);
	$xt->assign("DateofMarriage_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateofMarriage_label","<label for=\"".GetInputElementId("DateofMarriage", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("SpouseDevoteeId"))
		$xt->assign("SpouseDevoteeId_fieldblock",true);
	else
		$xt->assign("SpouseDevoteeId_tabfieldblock",true);
	$xt->assign("SpouseDevoteeId_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpouseDevoteeId_label","<label for=\"".GetInputElementId("SpouseDevoteeId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("MobilePhone"))
		$xt->assign("MobilePhone_fieldblock",true);
	else
		$xt->assign("MobilePhone_tabfieldblock",true);
	$xt->assign("MobilePhone_label",true);
	if(isEnableSection508())
		$xt->assign_section("MobilePhone_label","<label for=\"".GetInputElementId("MobilePhone", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("WorkPhone"))
		$xt->assign("WorkPhone_fieldblock",true);
	else
		$xt->assign("WorkPhone_tabfieldblock",true);
	$xt->assign("WorkPhone_label",true);
	if(isEnableSection508())
		$xt->assign_section("WorkPhone_label","<label for=\"".GetInputElementId("WorkPhone", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("EmailPrimary"))
		$xt->assign("EmailPrimary_fieldblock",true);
	else
		$xt->assign("EmailPrimary_tabfieldblock",true);
	$xt->assign("EmailPrimary_label",true);
	if(isEnableSection508())
		$xt->assign_section("EmailPrimary_label","<label for=\"".GetInputElementId("EmailPrimary", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("EmailSecondary"))
		$xt->assign("EmailSecondary_fieldblock",true);
	else
		$xt->assign("EmailSecondary_tabfieldblock",true);
	$xt->assign("EmailSecondary_label",true);
	if(isEnableSection508())
		$xt->assign_section("EmailSecondary_label","<label for=\"".GetInputElementId("EmailSecondary", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Password"))
		$xt->assign("Password_fieldblock",true);
	else
		$xt->assign("Password_tabfieldblock",true);
	$xt->assign("Password_label",true);
	if(isEnableSection508())
		$xt->assign_section("Password_label","<label for=\"".GetInputElementId("Password", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("active"))
		$xt->assign("active_fieldblock",true);
	else
		$xt->assign("active_tabfieldblock",true);
	$xt->assign("active_label",true);
	if(isEnableSection508())
		$xt->assign_section("active_label","<label for=\"".GetInputElementId("active", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("CounsellorDevoteeID"))
		$xt->assign("CounsellorDevoteeID_fieldblock",true);
	else
		$xt->assign("CounsellorDevoteeID_tabfieldblock",true);
	$xt->assign("CounsellorDevoteeID_label",true);
	if(isEnableSection508())
		$xt->assign_section("CounsellorDevoteeID_label","<label for=\"".GetInputElementId("CounsellorDevoteeID", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("NativeCity"))
		$xt->assign("NativeCity_fieldblock",true);
	else
		$xt->assign("NativeCity_tabfieldblock",true);
	$xt->assign("NativeCity_label",true);
	if(isEnableSection508())
		$xt->assign_section("NativeCity_label","<label for=\"".GetInputElementId("NativeCity", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("NativeState"))
		$xt->assign("NativeState_fieldblock",true);
	else
		$xt->assign("NativeState_tabfieldblock",true);
	$xt->assign("NativeState_label",true);
	if(isEnableSection508())
		$xt->assign_section("NativeState_label","<label for=\"".GetInputElementId("NativeState", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("BloodGroup"))
		$xt->assign("BloodGroup_fieldblock",true);
	else
		$xt->assign("BloodGroup_tabfieldblock",true);
	$xt->assign("BloodGroup_label",true);
	if(isEnableSection508())
		$xt->assign_section("BloodGroup_label","<label for=\"".GetInputElementId("BloodGroup", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DateOfHarinamInitiation"))
		$xt->assign("DateOfHarinamInitiation_fieldblock",true);
	else
		$xt->assign("DateOfHarinamInitiation_tabfieldblock",true);
	$xt->assign("DateOfHarinamInitiation_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateOfHarinamInitiation_label","<label for=\"".GetInputElementId("DateOfHarinamInitiation", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DateOfBrahmanInitiation"))
		$xt->assign("DateOfBrahmanInitiation_fieldblock",true);
	else
		$xt->assign("DateOfBrahmanInitiation_tabfieldblock",true);
	$xt->assign("DateOfBrahmanInitiation_label",true);
	if(isEnableSection508())
		$xt->assign_section("DateOfBrahmanInitiation_label","<label for=\"".GetInputElementId("DateOfBrahmanInitiation", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("SpiritualMasterId"))
		$xt->assign("SpiritualMasterId_fieldblock",true);
	else
		$xt->assign("SpiritualMasterId_tabfieldblock",true);
	$xt->assign("SpiritualMasterId_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpiritualMasterId_label","<label for=\"".GetInputElementId("SpiritualMasterId", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("PreviousReligion"))
		$xt->assign("PreviousReligion_fieldblock",true);
	else
		$xt->assign("PreviousReligion_tabfieldblock",true);
	$xt->assign("PreviousReligion_label",true);
	if(isEnableSection508())
		$xt->assign_section("PreviousReligion_label","<label for=\"".GetInputElementId("PreviousReligion", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Chanting16RoundsSince"))
		$xt->assign("Chanting16RoundsSince_fieldblock",true);
	else
		$xt->assign("Chanting16RoundsSince_tabfieldblock",true);
	$xt->assign("Chanting16RoundsSince_label",true);
	if(isEnableSection508())
		$xt->assign_section("Chanting16RoundsSince_label","<label for=\"".GetInputElementId("Chanting16RoundsSince", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("IntroducedBy"))
		$xt->assign("IntroducedBy_fieldblock",true);
	else
		$xt->assign("IntroducedBy_tabfieldblock",true);
	$xt->assign("IntroducedBy_label",true);
	if(isEnableSection508())
		$xt->assign_section("IntroducedBy_label","<label for=\"".GetInputElementId("IntroducedBy", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("YearOfIntroduction"))
		$xt->assign("YearOfIntroduction_fieldblock",true);
	else
		$xt->assign("YearOfIntroduction_tabfieldblock",true);
	$xt->assign("YearOfIntroduction_label",true);
	if(isEnableSection508())
		$xt->assign_section("YearOfIntroduction_label","<label for=\"".GetInputElementId("YearOfIntroduction", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("IntroducedInCenter"))
		$xt->assign("IntroducedInCenter_fieldblock",true);
	else
		$xt->assign("IntroducedInCenter_tabfieldblock",true);
	$xt->assign("IntroducedInCenter_label",true);
	if(isEnableSection508())
		$xt->assign_section("IntroducedInCenter_label","<label for=\"".GetInputElementId("IntroducedInCenter", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("PreferedServices"))
		$xt->assign("PreferedServices_fieldblock",true);
	else
		$xt->assign("PreferedServices_tabfieldblock",true);
	$xt->assign("PreferedServices_label",true);
	if(isEnableSection508())
		$xt->assign_section("PreferedServices_label","<label for=\"".GetInputElementId("PreferedServices", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("ServicesRendered"))
		$xt->assign("ServicesRendered_fieldblock",true);
	else
		$xt->assign("ServicesRendered_tabfieldblock",true);
	$xt->assign("ServicesRendered_label",true);
	if(isEnableSection508())
		$xt->assign_section("ServicesRendered_label","<label for=\"".GetInputElementId("ServicesRendered", $id, PAGE_ADD)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("InitiatedName"))
		$xt->assign("InitiatedName_fieldblock",true);
	else
		$xt->assign("InitiatedName_tabfieldblock",true);
	$xt->assign("InitiatedName_label",true);
	if(isEnableSection508())
		$xt->assign_section("InitiatedName_label","<label for=\"".GetInputElementId("InitiatedName", $id, PAGE_ADD)."\">","</label>");
	
	
	
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$pageObject->body["begin"] .= $includes;
				$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
		$xt->assign("back_button",true);
	}
	else
	{		
		$xt->assign("cancelbutton_attrs", "id=\"cancelButton".$id."\"");
		$xt->assign("cancel_button",true);
		$xt->assign("header","");
	}
	$xt->assign("save_button",true);
}
$xt->assign("savebutton_attrs","id=\"saveButton".$id."\"");
$xt->assign("message_block",true);
$xt->assign("message",$message);
if(!strlen($message))
{
	$xt->displayBrickHidden("message");
}

//	show readonly fields
$linkdata="";

$i = 0;
$jsKeys = array();
$keyFields = array();
foreach($keys as $field=>$value)
{
	$keyFields[$i] = $field;
	$jsKeys[$i++] = $value;
}

if(@$_POST["a"]=="added" && $inlineadd==ADD_ONTHEFLY)
{
	if( !$error_happened && $status!="DECLINED")
	{
		$addedData = GetAddedDataLookupQuery($pageObject, $keys, false);
		$data =& $addedData[0];	
		
		if($data)
		{
			$respData = array($addedData[1]["linkField"] => @$data[$addedData[1]["linkFieldIndex"]], $addedData[1]["displayField"] => @$data[$addedData[1]["displayFieldIndex"]]);
		}
		else
		{
			$respData = array($addedData[1]["linkField"] => @$avalues[$addedData[1]["linkField"]], $addedData[1]["displayField"] => @$avalues[$addedData[1]["displayField"]]);
		}		
		$returnJSON['success'] = true;
		$returnJSON['keys'] = $jsKeys;
		$returnJSON['keyFields'] = $keyFields;
		$returnJSON['vals'] = $respData;
		$returnJSON['fields'] = $showFields;
	}
	else
	{
		$returnJSON['success'] = false;
		$returnJSON['message'] = $message;
	}
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
}

if(@$_POST["a"]=="added" && ($inlineadd == ADD_INLINE || $inlineadd == ADD_MASTER || $inlineadd==ADD_POPUP)) 
{
	//Preparation   view values
	//	get current values and show edit controls
	$dispFieldAlias = "";
	$data=0;
	$linkAndDispVals = array();
	if(count($keys))
	{
		$where=KeyWhere($keys);
			
		$forLookup = postvalue('forLookup');
		if ($forLookup)
		{
			$addedData = GetAddedDataLookupQuery($pageObject, $keys, true);
			$data =& $addedData[0];
			$linkAndDispVals = array('linkField' => $addedData[0][$addedData[1]["linkField"]], 'displayField' => $addedData[0][$addedData[1]["displayField"]]);
		}
		else
		{
			$strSQL = $gQuery->gSQLWhere_having_fromQuery('', $where, '');		
		
			LogInfo($strSQL);
			$rs=db_query($strSQL,$conn);
			$data = $pageObject->cipherer->DecryptFetchedArray($rs);
		}
	}
	if(!$data)
	{
		$data=$avalues;
		$HaveData=false;
	}
	//check if correct values added
	$showDetailKeys["devotee_address"]["masterkey1"] = $data["DevoteeId"];	
	$showDetailKeys["devotee_donation"]["masterkey1"] = $data["DevoteeId"];	
	$showDetailKeys["devotee_language"]["masterkey1"] = $data["DevoteeId"];	
	$showDetailKeys["devotee_org"]["masterkey1"] = $data["DevoteeId"];	
	$showDetailKeys["devotee_family_member"]["masterkey1"] = $data["DevoteeId"];	
	$showDetailKeys["devotee_company"]["masterkey1"] = $data["DevoteeId"];	
	$showDetailKeys["counsellor_counsellee"]["masterkey1"] = $data["DevoteeId"];	

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["DevoteeId"]));
	
////////////////////////////////////////////
//	TitleId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("TitleId", $data, $keylink);
		$showValues["TitleId"] = $value;
		$showFields[] = "TitleId";
	}	
//	Photo
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Photo", $data, $keylink);
		$showValues["Photo"] = $value;
		$showFields[] = "Photo";
	}	
//	FirstName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("FirstName", $data, $keylink);
		$showValues["FirstName"] = $value;
		$showFields[] = "FirstName";
	}	
//	LastName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("LastName", $data, $keylink);
		$showValues["LastName"] = $value;
		$showFields[] = "LastName";
	}	
//	MiddleName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("MiddleName", $data, $keylink);
		$showValues["MiddleName"] = $value;
		$showFields[] = "MiddleName";
	}	
//	Gender
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Gender", $data, $keylink);
		$showValues["Gender"] = $value;
		$showFields[] = "Gender";
	}	
//	DateOfBirth
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DateOfBirth", $data, $keylink);
		$showValues["DateOfBirth"] = $value;
		$showFields[] = "DateOfBirth";
	}	
//	MaritalStatusId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("MaritalStatusId", $data, $keylink);
		$showValues["MaritalStatusId"] = $value;
		$showFields[] = "MaritalStatusId";
	}	
//	DateofMarriage
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DateofMarriage", $data, $keylink);
		$showValues["DateofMarriage"] = $value;
		$showFields[] = "DateofMarriage";
	}	
//	SpouseDevoteeId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("SpouseDevoteeId", $data, $keylink);
		$showValues["SpouseDevoteeId"] = $value;
		$showFields[] = "SpouseDevoteeId";
	}	
//	MobilePhone
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("MobilePhone", $data, $keylink);
		$showValues["MobilePhone"] = $value;
		$showFields[] = "MobilePhone";
	}	
//	WorkPhone
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("WorkPhone", $data, $keylink);
		$showValues["WorkPhone"] = $value;
		$showFields[] = "WorkPhone";
	}	
//	EmailPrimary
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("EmailPrimary", $data, $keylink);
		$showValues["EmailPrimary"] = $value;
		$showFields[] = "EmailPrimary";
	}	
//	EmailSecondary
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("EmailSecondary", $data, $keylink);
		$showValues["EmailSecondary"] = $value;
		$showFields[] = "EmailSecondary";
	}	
//	Password
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Password", $data, $keylink);
		$showValues["Password"] = $value;
		$showFields[] = "Password";
	}	
//	active
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("active", $data, $keylink);
		$showValues["active"] = $value;
		$showFields[] = "active";
	}	
//	CounsellorDevoteeID
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("CounsellorDevoteeID", $data, $keylink);
		$showValues["CounsellorDevoteeID"] = $value;
		$showFields[] = "CounsellorDevoteeID";
	}	
//	NativeCity
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("NativeCity", $data, $keylink);
		$showValues["NativeCity"] = $value;
		$showFields[] = "NativeCity";
	}	
//	NativeState
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("NativeState", $data, $keylink);
		$showValues["NativeState"] = $value;
		$showFields[] = "NativeState";
	}	
//	BloodGroup
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("BloodGroup", $data, $keylink);
		$showValues["BloodGroup"] = $value;
		$showFields[] = "BloodGroup";
	}	
//	DateOfHarinamInitiation
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DateOfHarinamInitiation", $data, $keylink);
		$showValues["DateOfHarinamInitiation"] = $value;
		$showFields[] = "DateOfHarinamInitiation";
	}	
//	DateOfBrahmanInitiation
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("DateOfBrahmanInitiation", $data, $keylink);
		$showValues["DateOfBrahmanInitiation"] = $value;
		$showFields[] = "DateOfBrahmanInitiation";
	}	
//	SpiritualMasterId
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("SpiritualMasterId", $data, $keylink);
		$showValues["SpiritualMasterId"] = $value;
		$showFields[] = "SpiritualMasterId";
	}	
//	PreviousReligion
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("PreviousReligion", $data, $keylink);
		$showValues["PreviousReligion"] = $value;
		$showFields[] = "PreviousReligion";
	}	
//	Chanting16RoundsSince
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("Chanting16RoundsSince", $data, $keylink);
		$showValues["Chanting16RoundsSince"] = $value;
		$showFields[] = "Chanting16RoundsSince";
	}	
//	IntroducedBy
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("IntroducedBy", $data, $keylink);
		$showValues["IntroducedBy"] = $value;
		$showFields[] = "IntroducedBy";
	}	
//	YearOfIntroduction
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("YearOfIntroduction", $data, $keylink);
		$showValues["YearOfIntroduction"] = $value;
		$showFields[] = "YearOfIntroduction";
	}	
//	IntroducedInCenter
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("IntroducedInCenter", $data, $keylink);
		$showValues["IntroducedInCenter"] = $value;
		$showFields[] = "IntroducedInCenter";
	}	
//	PreferedServices
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("PreferedServices", $data, $keylink);
		$showValues["PreferedServices"] = $value;
		$showFields[] = "PreferedServices";
	}	
//	ServicesRendered
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("ServicesRendered", $data, $keylink);
		$showValues["ServicesRendered"] = $value;
		$showFields[] = "ServicesRendered";
	}	
//	InitiatedName
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("InitiatedName", $data, $keylink);
		$showValues["InitiatedName"] = $value;
		$showFields[] = "InitiatedName";
	}	
//	FullName
	$display = false;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value = $pageObject->showDBValue("FullName", $data, $keylink);
		$showValues["FullName"] = $value;
		$showFields[] = "FullName";
	}	
		$showRawValues["DevoteeId"] = substr($data["DevoteeId"],0,100);
		$showRawValues["TitleId"] = substr($data["TitleId"],0,100);
		$showRawValues["Photo"] = "";
		$showRawValues["FirstName"] = substr($data["FirstName"],0,100);
		$showRawValues["LastName"] = substr($data["LastName"],0,100);
		$showRawValues["MiddleName"] = substr($data["MiddleName"],0,100);
		$showRawValues["Gender"] = substr($data["Gender"],0,100);
		$showRawValues["DateOfBirth"] = substr($data["DateOfBirth"],0,100);
		$showRawValues["MaritalStatusId"] = substr($data["MaritalStatusId"],0,100);
		$showRawValues["DateofMarriage"] = substr($data["DateofMarriage"],0,100);
		$showRawValues["SpouseDevoteeId"] = substr($data["SpouseDevoteeId"],0,100);
		$showRawValues["MobilePhone"] = substr($data["MobilePhone"],0,100);
		$showRawValues["WorkPhone"] = substr($data["WorkPhone"],0,100);
		$showRawValues["EmailPrimary"] = substr($data["EmailPrimary"],0,100);
		$showRawValues["EmailSecondary"] = substr($data["EmailSecondary"],0,100);
		$showRawValues["Password"] = substr($data["Password"],0,100);
		$showRawValues["active"] = substr($data["active"],0,100);
		$showRawValues["CounsellorDevoteeID"] = substr($data["CounsellorDevoteeID"],0,100);
		$showRawValues["IsCounsellor"] = substr($data["IsCounsellor"],0,100);
		$showRawValues["NativeCity"] = substr($data["NativeCity"],0,100);
		$showRawValues["NativeState"] = substr($data["NativeState"],0,100);
		$showRawValues["BloodGroup"] = substr($data["BloodGroup"],0,100);
		$showRawValues["DateOfHarinamInitiation"] = substr($data["DateOfHarinamInitiation"],0,100);
		$showRawValues["DateOfBrahmanInitiation"] = substr($data["DateOfBrahmanInitiation"],0,100);
		$showRawValues["SpiritualMasterId"] = substr($data["SpiritualMasterId"],0,100);
		$showRawValues["PreviousReligion"] = substr($data["PreviousReligion"],0,100);
		$showRawValues["Chanting16RoundsSince"] = substr($data["Chanting16RoundsSince"],0,100);
		$showRawValues["IntroducedBy"] = substr($data["IntroducedBy"],0,100);
		$showRawValues["YearOfIntroduction"] = substr($data["YearOfIntroduction"],0,100);
		$showRawValues["IntroducedInCenter"] = substr($data["IntroducedInCenter"],0,100);
		$showRawValues["PreferedServices"] = substr($data["PreferedServices"],0,100);
		$showRawValues["ServicesRendered"] = substr($data["ServicesRendered"],0,100);
		$showRawValues["InitiatedName"] = substr($data["InitiatedName"],0,100);
		$showRawValues["FullName"] = substr($data["FullName"],0,100);
	
	// for custom expression for display field
	if ($dispFieldAlias)
	{
		$showValues[] = $data[$dispFieldAlias];	
		$showFields[] = $dispFieldAlias;
		$showRawValues[] = substr($data[$dispFieldAlias],0,100);
	}
	
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_POPUP)
	{	
		if($IsSaved && count($showValues))
		{
			$returnJSON['success'] = true;
			if($HaveData){
				$returnJSON['noKeys'] = false;
			}else{
				$returnJSON['noKeys'] = true;
			}
			
			$returnJSON['keys'] = $jsKeys;
			$returnJSON['keyFields'] = $keyFields;
			$returnJSON['vals'] = $showValues;
			$returnJSON['fields'] = $showFields;
			$returnJSON['rawVals'] = $showRawValues;
			$returnJSON['detKeys'] = $showDetailKeys;
			$returnJSON['userMess'] = $usermessage;
			$returnJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
			// add link and display value if list page is lookup with search
			if(array_key_exists('linkField', $linkAndDispVals))
			{
				$returnJSON['linkValue'] = $linkAndDispVals['linkField'];
				$returnJSON['displayValue'] = $linkAndDispVals['displayField'];
			}
			if($globalEvents->exists("IsRecordEditable", $strTableName))
			{ 
				if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
					$returnJSON['nonEditable'] = true;
			}
			
			if($inlineadd==ADD_POPUP && isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
				$returnJSON['hideCaptcha'] = true;
		}
		else
		{
			$returnJSON['success'] = false;
			$returnJSON['message'] = $message;
			if(!$pageObject->isCaptchaOk)
				$returnJSON['captcha'] = false;
		}
		echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
		exit();
	}
} 

/////////////////////////////////////////////////////////////
if($inlineadd==ADD_MASTER)
{
	$respJSON = array();
	if(($_POST["a"]=="added" && $IsSaved))
	{
		$respJSON['afterAddId'] = $afterAdd_id;
		$respJSON['success'] = true;
		$respJSON['fields'] = $showFields;
		$respJSON['vals'] = $showValues;
		if($onFly){
			if($HaveData)
				$respJSON['noKeys'] = false;
			else
				$respJSON['noKeys'] = true;
			$respJSON['keys'] = $jsKeys;
			$respJSON['keyFields'] = $keyFields;
			$respJSON['rawVals'] = $showRawValues;
			$respJSON['detKeys'] = $showDetailKeys;
			$respJSON['userMess'] = $usermessage;
			$respJSON['hrefs'] = $pageObject->buildDetailGridLinks($showDetailKeys);
			if($globalEvents->exists("IsRecordEditable", $strTableName))
			{
				if(!$globalEvents->IsRecordEditable($showRawValues, true, $strTableName))
					$respJSON['nonEditable'] = true;
			}
		}
		$respJSON['mKeys'] = array();
		for($i=0;$i<count($dpParams['ids']);$i++)
		{
			$data=0;
			if(count($keys))
			{
				$where=KeyWhere($keys);
							$strSQL = $gQuery->gSQLWhere($where);
				LogInfo($strSQL);
				$rs = db_query($strSQL,$conn);
				$data = $pageObject->cipherer->DecryptFetchedArray($rs);
			}
			if(!$data)
				$data=$avalues;
			
			$mKeyId = 1;
			foreach($mKeys[$dpParams['strTableNames'][$i]] as $mk)
			{
				if($data[$mk])
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = $data[$mk];
				else
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = '';
			}
		}
		if(isset($_SESSION[$strTableName."_count_captcha"]) || $_SESSION[$strTableName."_count_captcha"]>0 || $_SESSION[$strTableName."_count_captcha"]<5)
			$respJSON['hidecaptcha'] = true;
	}
	else{
			$respJSON['success'] = false;
			if(!$pageObject->isCaptchaOk)
				$respJSON['captcha'] = false;
			else
				$respJSON['error'] = $message;
			if($onFly)
				$respJSON['message'] = $message;
		}
	echo "<textarea>".htmlspecialchars(my_json_encode($respJSON))."</textarea>";
	exit();
}

/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////

//	validation stuff
$regex='';
$regexmessage='';
$regextype = '';
$control = array();

foreach($addFields as $fName)
{
	$gfName = GoodFieldName($fName);
	$controls = array('controls'=>array());
	if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))
	{
		$control[$gfName] = array();
		$control[$gfName]["func"] = "xt_buildeditcontrol";
		$control[$gfName]["params"] = array();
		$control[$gfName]["params"]["id"] = $id;
		$control[$gfName]["params"]["ptype"] = PAGE_ADD;
		$control[$gfName]["params"]["field"] = $fName;
		$control[$gfName]["params"]["value"] = @$defvalues[$fName];
		$control[$gfName]["params"]["pageObj"] = $pageObject;
		if($pageObject->pSet->isUseRTE($fName))
			$_SESSION[$strTableName."_".$fName."_rte"] = @$defvalues[$fName];
		
		//	Begin Add validation
		$arrValidate = $pageObject->pSet->getValidation($fName);
		$control[$gfName]["params"]["validate"] = $arrValidate;
		//	End Add validation
	}
	$controls["controls"]['ctrlInd'] = 0;
	$controls["controls"]['id'] = $id;
	$controls["controls"]['fieldName'] = $fName;
	//if richEditor for field
	if($pageObject->pSet->isUseRTE($fName))
	{
		if(!$detailKeys || !in_array($fName, $detailKeys))
			$control[$gfName]["params"]["mode"]="add";
		$controls["controls"]['mode'] = "add";
	}
	else
	{
		if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="inline_add";
			$controls["controls"]['mode'] = "inline_add";
		}
		else
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="add";
			$controls["controls"]['mode'] = "add";
		}
	}
	
	if(!$detailKeys || !in_array($fName, $detailKeys))
		$xt->assignbyref($gfName."_editcontrol",$control[$gfName]);
	elseif($detailKeys && in_array($fName, $detailKeys))
		$controls["controls"]['value'] = @$defvalues[$fName];
	
	// category control field
	$strCategoryControl = $pageObject->isDependOnField($fName);
	
	if($strCategoryControl!==false && in_array($strCategoryControl, $addFields))
		$vals = array($fName => @$defvalues[$fName], $strCategoryControl => @$defvalues[$strCategoryControl]);
	else
		$vals = array($fName => @$defvalues[$fName]);
	
	$preload = $pageObject->fillPreload($fName, $vals);
	if($preload!==false)
	{
		$controls["controls"]['preloadData'] = $preload;
		if(!@$defvalues[$fName] && count($preload["vals"])>0)
			$defvalues[$fName] = $preload["vals"][0];
	}
	$pageObject->fillControlsMap($controls);
	
	//fill field tool tips
	$pageObject->fillFieldToolTips($fName);
	
	// fill special settings for timepicker
	if($pageObject->pSet->getEditFormat($fName) == 'Time')
		$pageObject->fillTimePickSettings($fName, @$defvalues[$fName]);
	
	if((($detailKeys && in_array($fName, $detailKeys)) || $fName == postvalue("category")) && array_key_exists($fName, $defvalues))
	{
		$value = $pageObject->showDBValue($fName, $defvalues);
		
		$xt->assign($gfName."_editcontrol", $value);
	}
}

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_POPUP) && !isMobile())
{
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
		include("classes/searchclause.php");
	}
	
	$dControlsMap = array();
	$dViewControlsMap = array();
		
	$flyId = $ids+1;
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$options = array();
		//array of params for classes
		$options["mode"] = LIST_DETAILS;
		$options["pageType"] = PAGE_LIST;
		$options["masterPageType"] = PAGE_ADD;
		$options["mainMasterPageType"] = PAGE_ADD;
		$options['masterTable'] = "devotee";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		
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
		$options['flyId'] = $flyId++;
		$mkr = 1;
		
		foreach($mKeys[$strTableName] as $mk)
		{
			if($defvalues[$mk])
				$options['masterKeysReq'][$mkr++] = $defvalues[$mk];
			else
				$options['masterKeysReq'][$mkr++] = '';
		}
		$listPageObject = ListPage::createListPage($strTableName,$options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		$flyId = $listPageObject->recId+1;
		
		//set page events
		foreach($listPageObject->eventsObject->events as $event => $name)
			$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
		
		//add detail settings to master settings
		$listPageObject->addControlsJSAndCSS();
		$listPageObject->fillSetCntrlMaps();
		$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];

		$dControlsMap[$strTableName] = $listPageObject->controlsMap;
		$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
		
		foreach($listPageObject->jsSettings["global"]["shortTNames"] as $tName => $shortTName){
			$pageObject->settingsMap["globalSettings"]["shortTNames"][$tName] = $shortTName;
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
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap;
	$strTableName = "devotee";
}
/////////////////////////////////////////////////////////////
//fill jsSettings and ControlsHTMLMap
$pageObject->fillSetCntrlMaps();

$pageObject->addCommonJs();

//For mobile version in apple device

if($inlineadd == ADD_SIMPLE)
{
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	$xt->assign("body", $pageObject->body);
	$xt->assign("flybody",true);
}

if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{ 
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("flybody", $pageObject->body);
	$xt->assign("body",true);
}	

$xt->assign("style_block",true);
$pageObject->xt->assign("legend", true);

if($eventObj->exists("BeforeShowAdd"))
	$eventObj->BeforeShowAdd($xt, $templatefile, $pageObject);
	
if($inlineadd != ADD_SIMPLE)
{
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;	
}

if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
{
	$xt->load_template($templatefile);
	$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
	if(count($pageObject->includes_css))
		$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
	if(count($pageObject->includes_cssIE))
		$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON['idStartFrom'] = $id+1;	
	echo (my_json_encode($returnJSON)); 
}
elseif ($inlineadd == ADD_INLINE)
{
	$xt->load_template($templatefile);
	$returnJSON["html"] = array();
	foreach($addFields as $fName)
	{
		$returnJSON["html"][$fName] = $xt->fetchVar(GoodFieldName($fName)."_editcontrol");	
	}	
	$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
	$returnJSON["additionalCSS"] = $pageObject->grabAllCSSFiles();
	echo (my_json_encode($returnJSON)); 
}
else
	$xt->display($templatefile);

function GetAddedDataLookupQuery($pageObject, $keys, $forLookup)
{
	global $conn, $strTableName, $strOriginalTableName;
	
	$LookupSQL = "";
	$linkfield = "";
	$dispfield = "";
	$noBlobReplace = false;
	$lookupFieldName = "";
	
	if($LookupSQL && $nLookupType != LT_QUERY)
		$LookupSQL.=" from ".AddTableWrappers($strOriginalTableName);
		
	$data = 0;
	$lookupIndexes = array("linkFieldIndex" => 0, "displayFieldIndex" => 0);
	if(count($keys))
	{
		$where = KeyWhere($keys);
		if($nLookupType == LT_QUERY){
			$LookupSQL = $lookupQueryObj->toSql(whereAdd($lookupQueryObj->m_where->toSql($lookupQueryObj), $where));
		}else 
			$LookupSQL.=" where ".$where;
		$lookupIndexes = GetLookupFieldsIndexes($lookupPSet, $lookupFieldName);
		LogInfo($LookupSQL);
		if($forLookup){
			$rs=db_query($LookupSQL,$conn);
			$data = $pageObject->cipherer->DecryptFetchedArray($rs);
		}else if($LookupSQL)
		{
			$rs = db_query($LookupSQL,$conn);
			$data = db_fetch_numarray($rs);
			$data[$lookupIndexes["linkFieldIndex"]] = $pageObject->cipherer->DecryptField($linkFieldName, $data[$lookupIndexes["linkFieldIndex"]]);
			if($nLookupType == LT_QUERY)
				$data[$lookupIndexes["displayFieldIndex"]] = $pageObject->cipherer->DecryptField($dispfield, $data[$lookupIndexes["displayFieldIndex"]]);		
		}
	}

	return array($data, array("linkField" => $linkFieldName, "displayField" => $dispfield
		, "linkFieldIndex" => $lookupIndexes["linkFieldIndex"], "displayFieldIndex" => $lookupIndexes["displayFieldIndex"]));
}	
	
?>
