<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/admin_rights_variables.php");


$gsqlHead="select `EmailPrimary` ";
$gsqlFrom="from `devotee`";
$gsqlWhereExpr="";
$gsqlTail="";
// $gstrSQL = "SELECT TableName,   GroupID,   AccessMask  FROM access1_ugrights ";
$gstrSQL = $gQuery->gSQLWhere("");


if(!isLogged())
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(!IsAdmin())
{
	echo "<p>"."You don't have permissions to access this table"." <a href=\"login.php\">"."Back to login page"."</a></p>";
	return;
}



$layout = new TLayout("ug_rights","RoundedAqua1","MobileAqua1");
$layout->blocks["center"] = array();
$layout->containers["ugcontrols"] = array();

$layout->containers["ugcontrols"][] = array("name"=>"ugbuttons","block"=>"savebuttons_block","substyle"=>1);


$layout->skins["ugcontrols"] = "1";
$layout->blocks["center"][] = "ugcontrols";
$layout->containers["message"] = array();

$layout->containers["message"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->skins["message"] = "1";
$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"ugrightsblock","block"=>"rights_block","substyle"=>1);


$layout->skins["grid"] = "grid";
$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();

$layout->containers["pagination"][] = array("name"=>"pagination","block"=>"pagination_block","substyle"=>1);


$layout->skins["pagination"] = "2";
$layout->blocks["center"][] = "pagination";$layout->blocks["left"] = array();
$layout->containers["left"] = array();


$layout->containers["left"][] = array("name"=>"loggedas","block"=>"security_block","substyle"=>1);


$layout->containers["left"][] = array("name"=>"vmenu","block"=>"menu_block","substyle"=>1);


$layout->skins["left"] = "menu";
$layout->blocks["left"][] = "left";
$layout->containers["uggroup"] = array();

$layout->containers["uggroup"][] = array("name"=>"ugrightsgroup","block"=>"","substyle"=>1);


$layout->skins["uggroup"] = "1";
$layout->blocks["left"][] = "uggroup";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->skins["toplinks"] = "2";
$layout->blocks["top"][] = "toplinks";
$layout->containers["search"] = array();


$layout->containers["search"][] = array("name"=>"details_found","block"=>"details_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"page_of","block"=>"pages_block","substyle"=>1);


$layout->containers["search"][] = array("name"=>"recsperpage","block"=>"recordspp_block","substyle"=>1);


$layout->skins["search"] = "2";
$layout->blocks["top"][] = "search";$page_layouts["admin_rights_list"] = $layout;


include('include/xtempl.php');
include('classes/runnerpage.php');
include('classes/listpage.php');
include('classes/rightspage.php');

$xt = new Xtempl();

$options = array();
//array of params for classes
$options["pageType"] = PAGE_LIST;
$options["id"] = postvalue("id") ? postvalue("id") : 1;
$options["mode"] = RIGHTS_PAGE;
$options['xt'] = &$xt;
$nonAdminTablesRightsArr=array();
$nonAdminTablesArr=array();
$pageRights=array();
$nonAdminTablesArr[] = array("devotee_address","Devotee Address");
$nonAdminTablesRightsArr["devotee_address"]=array();
$pageRights["devotee_address"]["add"]=true;
$pageRights["devotee_address"]["edit"]=false;
$pageRights["devotee_address"]["delete"]=false;
$pageRights["devotee_address"]["list"]=true;
$pageRights["devotee_address"]["export"]=true;
$pageRights["devotee_address"]["import"]=true;

$nonAdminTablesArr[] = array("company","Company");
$nonAdminTablesRightsArr["company"]=array();
$pageRights["company"]["add"]=true;
$pageRights["company"]["edit"]=true;
$pageRights["company"]["delete"]=true;
$pageRights["company"]["list"]=true;
$pageRights["company"]["export"]=true;
$pageRights["company"]["import"]=true;

$nonAdminTablesArr[] = array("devotee","Devotee");
$nonAdminTablesRightsArr["devotee"]=array();
$pageRights["devotee"]["add"]=true;
$pageRights["devotee"]["edit"]=true;
$pageRights["devotee"]["delete"]=false;
$pageRights["devotee"]["list"]=true;
$pageRights["devotee"]["export"]=true;
$pageRights["devotee"]["import"]=false;

$nonAdminTablesArr[] = array("devotee_donation","Devotee Donation");
$nonAdminTablesRightsArr["devotee_donation"]=array();
$pageRights["devotee_donation"]["add"]=true;
$pageRights["devotee_donation"]["edit"]=true;
$pageRights["devotee_donation"]["delete"]=true;
$pageRights["devotee_donation"]["list"]=true;
$pageRights["devotee_donation"]["export"]=true;
$pageRights["devotee_donation"]["import"]=true;

$nonAdminTablesArr[] = array("devotee_language","Devotee Language");
$nonAdminTablesRightsArr["devotee_language"]=array();
$pageRights["devotee_language"]["add"]=true;
$pageRights["devotee_language"]["edit"]=true;
$pageRights["devotee_language"]["delete"]=true;
$pageRights["devotee_language"]["list"]=true;
$pageRights["devotee_language"]["export"]=true;
$pageRights["devotee_language"]["import"]=true;

$nonAdminTablesArr[] = array("devotee_org","Devotee Org");
$nonAdminTablesRightsArr["devotee_org"]=array();
$pageRights["devotee_org"]["add"]=true;
$pageRights["devotee_org"]["edit"]=true;
$pageRights["devotee_org"]["delete"]=true;
$pageRights["devotee_org"]["list"]=true;
$pageRights["devotee_org"]["export"]=true;
$pageRights["devotee_org"]["import"]=true;

$nonAdminTablesArr[] = array("devotee_family_member","Devotee Family Member");
$nonAdminTablesRightsArr["devotee_family_member"]=array();
$pageRights["devotee_family_member"]["add"]=true;
$pageRights["devotee_family_member"]["edit"]=true;
$pageRights["devotee_family_member"]["delete"]=true;
$pageRights["devotee_family_member"]["list"]=true;
$pageRights["devotee_family_member"]["export"]=true;
$pageRights["devotee_family_member"]["import"]=true;

$nonAdminTablesArr[] = array("lu_family_relationship","Lu Family Relationship");
$nonAdminTablesRightsArr["lu_family_relationship"]=array();
$pageRights["lu_family_relationship"]["add"]=true;
$pageRights["lu_family_relationship"]["edit"]=true;
$pageRights["lu_family_relationship"]["delete"]=true;
$pageRights["lu_family_relationship"]["list"]=true;
$pageRights["lu_family_relationship"]["export"]=true;
$pageRights["lu_family_relationship"]["import"]=true;

$nonAdminTablesArr[] = array("lu_banks","Lu Banks");
$nonAdminTablesRightsArr["lu_banks"]=array();
$pageRights["lu_banks"]["add"]=true;
$pageRights["lu_banks"]["edit"]=true;
$pageRights["lu_banks"]["delete"]=true;
$pageRights["lu_banks"]["list"]=true;
$pageRights["lu_banks"]["export"]=true;
$pageRights["lu_banks"]["import"]=true;

$nonAdminTablesArr[] = array("lu_departments","Lu Departments");
$nonAdminTablesRightsArr["lu_departments"]=array();
$pageRights["lu_departments"]["add"]=true;
$pageRights["lu_departments"]["edit"]=true;
$pageRights["lu_departments"]["delete"]=true;
$pageRights["lu_departments"]["list"]=true;
$pageRights["lu_departments"]["export"]=true;
$pageRights["lu_departments"]["import"]=true;

$nonAdminTablesArr[] = array("lu_initiating_gurus","Lu Initiating Gurus");
$nonAdminTablesRightsArr["lu_initiating_gurus"]=array();
$pageRights["lu_initiating_gurus"]["add"]=true;
$pageRights["lu_initiating_gurus"]["edit"]=true;
$pageRights["lu_initiating_gurus"]["delete"]=true;
$pageRights["lu_initiating_gurus"]["list"]=true;
$pageRights["lu_initiating_gurus"]["export"]=true;
$pageRights["lu_initiating_gurus"]["import"]=true;

$nonAdminTablesArr[] = array("lu_languages","Lu Languages");
$nonAdminTablesRightsArr["lu_languages"]=array();
$pageRights["lu_languages"]["add"]=true;
$pageRights["lu_languages"]["edit"]=true;
$pageRights["lu_languages"]["delete"]=true;
$pageRights["lu_languages"]["list"]=true;
$pageRights["lu_languages"]["export"]=true;
$pageRights["lu_languages"]["import"]=true;

$nonAdminTablesArr[] = array("lu_life_membership_status","Lu Life Membership Status");
$nonAdminTablesRightsArr["lu_life_membership_status"]=array();
$pageRights["lu_life_membership_status"]["add"]=true;
$pageRights["lu_life_membership_status"]["edit"]=true;
$pageRights["lu_life_membership_status"]["delete"]=true;
$pageRights["lu_life_membership_status"]["list"]=true;
$pageRights["lu_life_membership_status"]["export"]=true;
$pageRights["lu_life_membership_status"]["import"]=true;

$nonAdminTablesArr[] = array("lu_marital_status","Lu Marital Status");
$nonAdminTablesRightsArr["lu_marital_status"]=array();
$pageRights["lu_marital_status"]["add"]=true;
$pageRights["lu_marital_status"]["edit"]=true;
$pageRights["lu_marital_status"]["delete"]=true;
$pageRights["lu_marital_status"]["list"]=true;
$pageRights["lu_marital_status"]["export"]=true;
$pageRights["lu_marital_status"]["import"]=true;

$nonAdminTablesArr[] = array("lu_message_types","Lu Message Types");
$nonAdminTablesRightsArr["lu_message_types"]=array();
$pageRights["lu_message_types"]["add"]=true;
$pageRights["lu_message_types"]["edit"]=true;
$pageRights["lu_message_types"]["delete"]=true;
$pageRights["lu_message_types"]["list"]=true;
$pageRights["lu_message_types"]["export"]=true;
$pageRights["lu_message_types"]["import"]=true;

$nonAdminTablesArr[] = array("lu_request_types","Lu Request Types");
$nonAdminTablesRightsArr["lu_request_types"]=array();
$pageRights["lu_request_types"]["add"]=true;
$pageRights["lu_request_types"]["edit"]=true;
$pageRights["lu_request_types"]["delete"]=true;
$pageRights["lu_request_types"]["list"]=true;
$pageRights["lu_request_types"]["export"]=true;
$pageRights["lu_request_types"]["import"]=true;

$nonAdminTablesArr[] = array("lu_salutations","Lu Salutations");
$nonAdminTablesRightsArr["lu_salutations"]=array();
$pageRights["lu_salutations"]["add"]=true;
$pageRights["lu_salutations"]["edit"]=true;
$pageRights["lu_salutations"]["delete"]=true;
$pageRights["lu_salutations"]["list"]=true;
$pageRights["lu_salutations"]["export"]=true;
$pageRights["lu_salutations"]["import"]=true;

$nonAdminTablesArr[] = array("organization","Organization");
$nonAdminTablesRightsArr["organization"]=array();
$pageRights["organization"]["add"]=true;
$pageRights["organization"]["edit"]=true;
$pageRights["organization"]["delete"]=true;
$pageRights["organization"]["list"]=true;
$pageRights["organization"]["export"]=true;
$pageRights["organization"]["import"]=true;

$nonAdminTablesArr[] = array("devotee_company","Devotee Company");
$nonAdminTablesRightsArr["devotee_company"]=array();
$pageRights["devotee_company"]["add"]=true;
$pageRights["devotee_company"]["edit"]=true;
$pageRights["devotee_company"]["delete"]=true;
$pageRights["devotee_company"]["list"]=true;
$pageRights["devotee_company"]["export"]=true;
$pageRights["devotee_company"]["import"]=true;

$nonAdminTablesArr[] = array("lu_donation_purpose","Lu Donation Purpose");
$nonAdminTablesRightsArr["lu_donation_purpose"]=array();
$pageRights["lu_donation_purpose"]["add"]=true;
$pageRights["lu_donation_purpose"]["edit"]=true;
$pageRights["lu_donation_purpose"]["delete"]=true;
$pageRights["lu_donation_purpose"]["list"]=true;
$pageRights["lu_donation_purpose"]["export"]=true;
$pageRights["lu_donation_purpose"]["import"]=true;

$nonAdminTablesArr[] = array("lu_payment_modes","Lu Payment Modes");
$nonAdminTablesRightsArr["lu_payment_modes"]=array();
$pageRights["lu_payment_modes"]["add"]=true;
$pageRights["lu_payment_modes"]["edit"]=true;
$pageRights["lu_payment_modes"]["delete"]=true;
$pageRights["lu_payment_modes"]["list"]=true;
$pageRights["lu_payment_modes"]["export"]=true;
$pageRights["lu_payment_modes"]["import"]=true;

$nonAdminTablesArr[] = array("counsellor_counsellee","Counsellor Counsellee");
$nonAdminTablesRightsArr["counsellor_counsellee"]=array();
$pageRights["counsellor_counsellee"]["add"]=true;
$pageRights["counsellor_counsellee"]["edit"]=true;
$pageRights["counsellor_counsellee"]["delete"]=true;
$pageRights["counsellor_counsellee"]["list"]=true;
$pageRights["counsellor_counsellee"]["export"]=true;
$pageRights["counsellor_counsellee"]["import"]=true;

$nonAdminTablesArr[] = array("vw_counsellee","Vw Counsellee");
$nonAdminTablesRightsArr["vw_counsellee"]=array();
$pageRights["vw_counsellee"]["add"]=true;
$pageRights["vw_counsellee"]["edit"]=true;
$pageRights["vw_counsellee"]["delete"]=true;
$pageRights["vw_counsellee"]["list"]=true;
$pageRights["vw_counsellee"]["export"]=true;
$pageRights["vw_counsellee"]["import"]=true;

$nonAdminTablesArr[] = array("vw_OwnProfile","Vw OwnProfile");
$nonAdminTablesRightsArr["vw_OwnProfile"]=array();
$pageRights["vw_OwnProfile"]["add"]=true;
$pageRights["vw_OwnProfile"]["edit"]=true;
$pageRights["vw_OwnProfile"]["delete"]=false;
$pageRights["vw_OwnProfile"]["list"]=true;
$pageRights["vw_OwnProfile"]["export"]=true;
$pageRights["vw_OwnProfile"]["import"]=false;

$nonAdminTablesArr[] = array("vw_all_devotee","Vw All Devotee");
$nonAdminTablesRightsArr["vw_all_devotee"]=array();
$pageRights["vw_all_devotee"]["add"]=false;
$pageRights["vw_all_devotee"]["edit"]=false;
$pageRights["vw_all_devotee"]["delete"]=false;
$pageRights["vw_all_devotee"]["list"]=true;
$pageRights["vw_all_devotee"]["export"]=false;
$pageRights["vw_all_devotee"]["import"]=false;

$nonAdminTablesArr[] = array("vw_Devotee_full","Vw Devotee Full");
$nonAdminTablesRightsArr["vw_Devotee_full"]=array();
$pageRights["vw_Devotee_full"]["add"]=true;
$pageRights["vw_Devotee_full"]["edit"]=true;
$pageRights["vw_Devotee_full"]["delete"]=false;
$pageRights["vw_Devotee_full"]["list"]=true;
$pageRights["vw_Devotee_full"]["export"]=true;
$pageRights["vw_Devotee_full"]["import"]=true;

$nonAdminTablesArr[] = array("vw_counsellee_temp","Vw Counsellee Temp");
$nonAdminTablesRightsArr["vw_counsellee_temp"]=array();
$pageRights["vw_counsellee_temp"]["add"]=true;
$pageRights["vw_counsellee_temp"]["edit"]=true;
$pageRights["vw_counsellee_temp"]["delete"]=true;
$pageRights["vw_counsellee_temp"]["list"]=true;
$pageRights["vw_counsellee_temp"]["export"]=true;
$pageRights["vw_counsellee_temp"]["import"]=true;

$nonAdminTablesArr[] = array("vw_counsellors","Vw Counsellors");
$nonAdminTablesRightsArr["vw_counsellors"]=array();
$pageRights["vw_counsellors"]["add"]=false;
$pageRights["vw_counsellors"]["edit"]=false;
$pageRights["vw_counsellors"]["delete"]=false;
$pageRights["vw_counsellors"]["list"]=true;
$pageRights["vw_counsellors"]["export"]=false;
$pageRights["vw_counsellors"]["import"]=false;

$nonAdminTablesArr[] = array("spiritualmaster","Spiritualmaster");
$nonAdminTablesRightsArr["spiritualmaster"]=array();
$pageRights["spiritualmaster"]["add"]=false;
$pageRights["spiritualmaster"]["edit"]=false;
$pageRights["spiritualmaster"]["delete"]=false;
$pageRights["spiritualmaster"]["list"]=true;
$pageRights["spiritualmaster"]["export"]=false;
$pageRights["spiritualmaster"]["import"]=false;

$nonAdminTablesArr[] = array("lu_iscounsellor","Lu Iscounsellor");
$nonAdminTablesRightsArr["lu_iscounsellor"]=array();
$pageRights["lu_iscounsellor"]["add"]=true;
$pageRights["lu_iscounsellor"]["edit"]=true;
$pageRights["lu_iscounsellor"]["delete"]=true;
$pageRights["lu_iscounsellor"]["list"]=true;
$pageRights["lu_iscounsellor"]["export"]=true;
$pageRights["lu_iscounsellor"]["import"]=true;

$nonAdminTablesArr[] = array("lu_pin_city_state","Lu Pin City State");
$nonAdminTablesRightsArr["lu_pin_city_state"]=array();
$pageRights["lu_pin_city_state"]["add"]=true;
$pageRights["lu_pin_city_state"]["edit"]=false;
$pageRights["lu_pin_city_state"]["delete"]=false;
$pageRights["lu_pin_city_state"]["list"]=false;
$pageRights["lu_pin_city_state"]["export"]=false;
$pageRights["lu_pin_city_state"]["import"]=false;


$options["nonAdminTablesArr"] = $nonAdminTablesArr;
$options["nonAdminTablesRightsArr"] = $nonAdminTablesRightsArr;


$pageObject = ListPage::createListPage($strTableName, $options);
 // add button events if exist

// prepare code for build page
$pageObject->prepareForBuildPage();

// show page depends of mode
$pageObject->showPage();
	//$xt->assign_loopsection("grid_row",$rowinfo);
	


?>
