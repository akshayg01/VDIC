<?php
$dalTablecompany = array();
$dalTablecompany["CompanyId"] = array("type"=>3,"varname"=>"CompanyId");
$dalTablecompany["CompanyName"] = array("type"=>200,"varname"=>"CompanyName");
$dalTablecompany["Address Line1"] = array("type"=>200,"varname"=>"Address_Line1");
$dalTablecompany["Address Line2"] = array("type"=>200,"varname"=>"Address_Line2");
$dalTablecompany["City"] = array("type"=>200,"varname"=>"City");
$dalTablecompany["PIN Code"] = array("type"=>200,"varname"=>"PIN_Code");
$dalTablecompany["State"] = array("type"=>200,"varname"=>"State");
$dalTablecompany["Country"] = array("type"=>200,"varname"=>"Country");
$dalTablecompany["Remark"] = array("type"=>201,"varname"=>"Remark");
	$dalTablecompany["CompanyId"]["key"]=true;
$dal_info["company"]=&$dalTablecompany;

?>