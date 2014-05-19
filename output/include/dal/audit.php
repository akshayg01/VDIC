<?php
$dalTableaudit = array();
$dalTableaudit["id"] = array("type"=>3,"varname"=>"id");
$dalTableaudit["datetime"] = array("type"=>135,"varname"=>"datetime");
$dalTableaudit["ip"] = array("type"=>200,"varname"=>"ip");
$dalTableaudit["user"] = array("type"=>200,"varname"=>"user");
$dalTableaudit["table"] = array("type"=>200,"varname"=>"table");
$dalTableaudit["action"] = array("type"=>200,"varname"=>"action");
$dalTableaudit["description"] = array("type"=>201,"varname"=>"description");
	$dalTableaudit["id"]["key"]=true;
$dal_info["audit"]=&$dalTableaudit;

?>