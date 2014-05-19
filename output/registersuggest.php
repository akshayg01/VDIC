<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("include/devotee_variables.php");
require_once(getabspath("classes/cipherer.php"));
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");

$result = array(); 
$cipherer = new RunnerCipherer("devotee");
$t_captcha="";
$email="";
$password="";
$userName="";
$field = postvalue('field');
$val = postvalue('val');
if($field == "EmailPrimary")
	$userName = $val;
else if($field == "Password")
	$password = $val;
else if($field == "EmailPrimary")
	$email = $val;
else if($field == 'captcha')
	$t_captcha = $val;


if($cipherer->isFieldEncrypted("EmailPrimary"))
	$sUsername = $cipherer->MakeDBValue("EmailPrimary",$userName);	
else 
	$sUsername = add_db_quotes("EmailPrimary",$userName);

if($cipherer->isFieldEncrypted("EmailPrimary"))
	$sEmail = $cipherer->MakeDBValue("EmailPrimary",$email);	
else 
	$sEmail = add_db_quotes("EmailPrimary",$email);	
	

//	check if entered username already exists
if(strlen($userName))
{
	$strSQL="select count(*) from `devotee` where ".GetFullFieldName("`EmailPrimary`",$strTableName,false)."=".$sUsername;
   	$rs=db_query($strSQL,$conn);
	$data=db_fetch_numarray($rs);
	if($data[0]>0)
		$result[] = "Username"." <i>".$userName."</i> "."already exists. Choose another username.";
}

//	check if entered email already exists
if(strlen($email))
{
	$strSQL="select count(*) from `devotee` where ".GetFullFieldName("`EmailPrimary`",$strTableName,false)."=".$sEmail;
   	$rs=db_query($strSQL,$conn);
	$data=db_fetch_numarray($rs);
	if($data[0]>0)
		$result[] = "Email"." <i>".$email."</i> "."already registered. If you forgot your username or password use the password reminder form.";
}


echo "<textarea>".htmlspecialchars(my_json_encode(array('success' => count($result) > 0 ? false : true
	, 'errors' => implode('. ', $result))))."</textarea>";
?>