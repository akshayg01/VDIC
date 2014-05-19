<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/company_variables.php");



$field = postvalue('field');
$value = postvalue('value');
$pageType = postvalue('pageType');

	if(!isLogged()) { return;	}
	if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) { return;	}

	

$mode = intval(postvalue('mode'));

// if no parent
if (postvalue('isExistParent') === '0')
{
	if ($mode == MODE_SEARCH || $mode == MODE_INLINE_ADD || $mode == MODE_ADD){
		$output = loadSelectContent($pageType, $field, '', false, '', false); 
	}elseif ($mode == MODE_EDIT || $mode == MODE_INLINE_EDIT)
		$output = loadSelectContent($pageType, $field, '', false, '', false);
	else 
		$output = loadSelectContent($pageType, $field, $value, true, '', false);
}
// if exist parent
else if(postvalue('isExistParent') === '1' && $value==='')
{
	if ($mode == MODE_SEARCH)
		$output = loadSelectContent($pageType, $field, '', false, '', false);
	elseif ($mode == MODE_EDIT || $mode == MODE_INLINE_EDIT || $mode == MODE_INLINE_ADD || $mode == MODE_ADD)
	{
		echo "<textarea>".htmlspecialchars(my_json_encode(array('success'=>true, 'data'=>'')))."</textarea>";
		exit();
	}
	else 
		$output = loadSelectContent($pageType, $field, $value, true, '', false);	
}
// in any other way
else
{
	$output = loadSelectContent($pageType, $field, $value, true, '', false);	
}


$respObj = array('success'=>true, 'data'=>$output);
echo "<textarea>".htmlspecialchars(my_json_encode($respObj))."</textarea>";
?>