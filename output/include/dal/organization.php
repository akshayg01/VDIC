<?php
$dalTableorganization = array();
$dalTableorganization["OrgId"] = array("type"=>3,"varname"=>"OrgId");
$dalTableorganization["OrgName"] = array("type"=>200,"varname"=>"OrgName");
$dalTableorganization["OrgOwnerId"] = array("type"=>3,"varname"=>"OrgOwnerId");
$dalTableorganization["Location"] = array("type"=>200,"varname"=>"Location");
	$dalTableorganization["OrgId"]["key"]=true;
$dal_info["organization"]=&$dalTableorganization;

?>