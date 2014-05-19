<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 


if(!isLogged())
{ 
	return;
}
if(!IsAdmin())
{
	return;
}
$nonAdminTablesArr = array();
$nonAdminTablesArr[] = "devotee_address";
$nonAdminTablesArr[] = "company";
$nonAdminTablesArr[] = "devotee";
$nonAdminTablesArr[] = "devotee_donation";
$nonAdminTablesArr[] = "devotee_language";
$nonAdminTablesArr[] = "devotee_org";
$nonAdminTablesArr[] = "devotee_family_member";
$nonAdminTablesArr[] = "lu_family_relationship";
$nonAdminTablesArr[] = "lu_banks";
$nonAdminTablesArr[] = "lu_departments";
$nonAdminTablesArr[] = "lu_initiating_gurus";
$nonAdminTablesArr[] = "lu_languages";
$nonAdminTablesArr[] = "lu_life_membership_status";
$nonAdminTablesArr[] = "lu_marital_status";
$nonAdminTablesArr[] = "lu_message_types";
$nonAdminTablesArr[] = "lu_request_types";
$nonAdminTablesArr[] = "lu_salutations";
$nonAdminTablesArr[] = "organization";
$nonAdminTablesArr[] = "devotee_company";
$nonAdminTablesArr[] = "lu_donation_purpose";
$nonAdminTablesArr[] = "lu_payment_modes";
$nonAdminTablesArr[] = "counsellor_counsellee";
$nonAdminTablesArr[] = "vw_counsellee";
$nonAdminTablesArr[] = "vw_OwnProfile";
$nonAdminTablesArr[] = "vw_all_devotee";
$nonAdminTablesArr[] = "vw_Devotee_full";
$nonAdminTablesArr[] = "vw_counsellee_temp";
$nonAdminTablesArr[] = "vw_counsellors";
$nonAdminTablesArr[] = "spiritualmaster";
$nonAdminTablesArr[] = "lu_iscounsellor";
$nonAdminTablesArr[] = "lu_pin_city_state";

$cbxNames = array('add' => array('mask' => 'A', 'rightName' => 'add')
	, 'edt' => array('mask' => 'E', 'rightName' => 'edit')
	, 'del' => array('mask' => 'D', 'rightName' => 'delete')
	, 'lst' => array('mask' => 'S', 'rightName' => 'list')
	, 'exp' => array('mask' => 'P', 'rightName' => 'export')
	, 'imp' => array('mask' => 'I', 'rightName' => 'import')
	, 'adm' => array('mask' => 'M'));
	
switch(postvalue("a"))
{
	case "add":
		$sql ="insert into `access1_uggroups` (`Label`) values (".db_prepare_string(postvalue("name")).")";
		db_exec($sql,$conn);
		$sql = "select max(`GroupID`) from `access1_uggroups`";
		$rs = db_query($sql,$conn);
		$data = db_fetch_numarray($rs);
		echo "<textarea>".htmlspecialchars(my_json_encode(array('success' => true, 'id' => $data[0])))."</textarea>";
		break;
	case "del":
		$sql ="delete from `access1_uggroups` where `GroupID`=".(postvalue("id")+0);
		db_exec($sql,$conn);
		$sql ="delete from `access1_ugrights` where `GroupID`=".(postvalue("id")+0);
		db_exec($sql,$conn);
		$sql ="delete from `access1_ugmembers` where `GroupID`=".(postvalue("id")+0);
		db_exec($sql,$conn);
		echo "<textarea>".htmlspecialchars(my_json_encode(array('success' => true)))."</textarea>";
		break;
	case "rename":
		$sql ="update `access1_uggroups` set `Label`=".db_prepare_string(postvalue("name"))." where `GroupID`=".(postvalue("id")+0);
		db_exec($sql,$conn);
		echo "<textarea>".htmlspecialchars(my_json_encode(array('success' => true)))."</textarea>";
		break;
	case 'saveRights':
		$error = '';
		if(postvalue('state'))
		{
			$allRights = array();
			$rs = db_query("select `GroupID`, `TableName`, `AccessMask` from `access1_ugrights`", $conn);
			// don't use db_fetch_array! because of ORACLE and PostgreSQL
			while($data = db_fetch_numarray($rs))
			{
				$allRights[] = $data;
			}
			
			$delGroupId = 0;
			$state = my_json_decode(postvalue('state'));
			// delete all extra permissions from db
			foreach($allRights as $i => $data)
			{
				$groupIDInt = (int) $data[0];
				
				if($groupIDInt == $delGroupId)
					continue;
					
				//delete all extra permissions for group
				if(!array_key_exists($groupIDInt, $state))
					db_exec("delete from `access1_ugrights` where `GroupID`=".$groupIDInt, $conn);
				//delete all extra permissions for table in group
				else if(!array_key_exists(GetTableId($data[1]), $state[$groupIDInt]))
					db_exec("delete from `access1_ugrights` where `GroupID`=".$groupIDInt." and `TableName`=".db_prepare_string(html_special_decode($data[1])), $conn);
			}
			
			$realTables = GetRealValues();
			foreach ($state as $groupId => $groupRights)
			{
				foreach ($groupRights as $table => $mask)
				{
					if(!array_key_exists($table, $realTables))
						continue;
					
					$ins = true;
					foreach($allRights as $i => $data)
					{	
						if($data[0] == $groupId && $data[1] == $realTables[$table])	
						{
							$ins = false;
							if($data[2]!= $mask)
								db_exec("update `access1_ugrights` set `AccessMask`=".db_prepare_string($mask)." where `GroupID`=".$groupId." and `TableName`=".db_prepare_string(html_special_decode($realTables[$table])), $conn);
						}
					}
					if($ins)
					{
						db_exec(mysprintf("insert into `access1_ugrights` (`TableName`, `GroupID`, `AccessMask`) values (%s, %d, %s)", 
							array(db_prepare_string(html_special_decode($realTables[$table])), $groupId, db_prepare_string($mask))), $conn);
					}
					
					if(db_error($conn) != '')
						$error .= ($error == '' ? '' : ' ').db_error($conn);
				}
			}
		}
		getJSONResult($error);
		break;
	case 'saveMembership':
		$error = '';
		$groupId = postvalue('group');
		$realUsers = GetRealValues();
		
		for($i=0;$i<count($realUsers);$i++)
		{
			if($realUsers[$i] != $_SESSION["UserID"])
				$sql = "delete from `access1_ugmembers` where `UserName`=%s";
			else
				$sql = "delete from `access1_ugmembers` where `UserName`=%s and `GroupID`<>-1";
			
			db_exec(mysprintf($sql, array(db_prepare_string(html_special_decode($realUsers[$i])))), $conn);	
		}
		
		if(postvalue('state'))
		{
			$state = my_json_decode(postvalue('state'));
			foreach ($state as $group => $users)
				foreach ($users as $user)
				{
					if(!array_key_exists($user, $realUsers))
						continue;
					
					db_exec(mysprintf("insert into `access1_ugmembers` (`UserName`, `GroupID`) values (%s, %d)"
						, array(db_prepare_string(html_special_decode($realUsers[$user])), $group)), $conn);
					
					if(db_error($conn) != '')
						$error .= db_error($conn);
				}
		}
		getJSONResult($error);
		break;
}

function GetTableId($name)
{
	$tbls = GetRealValues();
	for($i = 0;$i < count($tbls); $i++)
	{
		if($tbls[$i] == $name)
			return $i;
	}
	return -1;
}

/**
 * GetRealValues
 * Form array with real users or tables names
 * @return {array} array of reaf names
 */
function GetRealValues()
{
	$result = array();
	if(postvalue('realValues'))
		$realValues = my_json_decode(postvalue('realValues'));
		foreach ($realValues as $key =>$value)
			$result[$key] = $value;
	return $result;
}

/**
 * getJSONResult
 * Form result as a JSON object according of errors
 * @param {string} list of errors
 */
function getJSONResult($error)
{
	$result['success'] = $error == '';
	$result['error'] = $error;	
	echo "<textarea>".htmlspecialchars(my_json_encode($result))."</textarea>";
}