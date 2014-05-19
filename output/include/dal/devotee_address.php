<?php
$dalTabledevotee_address = array();
$dalTabledevotee_address["AddressId"] = array("type"=>3,"varname"=>"AddressId");
$dalTabledevotee_address["AddressLine1"] = array("type"=>200,"varname"=>"AddressLine1");
$dalTabledevotee_address["AddressLine2"] = array("type"=>200,"varname"=>"AddressLine2");
$dalTabledevotee_address["City"] = array("type"=>200,"varname"=>"City");
$dalTabledevotee_address["State"] = array("type"=>200,"varname"=>"State");
$dalTabledevotee_address["Country"] = array("type"=>200,"varname"=>"Country");
$dalTabledevotee_address["Pincode"] = array("type"=>200,"varname"=>"Pincode");
$dalTabledevotee_address["IsVerified"] = array("type"=>200,"varname"=>"IsVerified");
$dalTabledevotee_address["IsWrong"] = array("type"=>200,"varname"=>"IsWrong");
$dalTabledevotee_address["AddressTypeId"] = array("type"=>3,"varname"=>"AddressTypeId");
$dalTabledevotee_address["DevoteeId"] = array("type"=>3,"varname"=>"DevoteeId");
	$dalTabledevotee_address["AddressId"]["key"]=true;
$dal_info["devotee_address"]=&$dalTabledevotee_address;

?>