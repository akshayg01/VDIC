<?php 
class eventclass_devotee  extends eventsBase
{ 
	function eventclass_devotee()
	{
	// fill list of events
		$this->events["BeforeQueryList"]=true;

		$this->events["BeforeShowEdit"]=true;

		$this->events["BeforeShowView"]=true;

		$this->events["BeforeShowPrint"]=true;


//	onscreen events


	}
// Captchas functions	

//	handlers

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				// List page: Before SQL query
function BeforeQueryList(&$strSQL,&$strWhereClause,&$strOrderBy,&$pageObject)
{

		
//$loginDevoteeID = $_SESSION["LoggedinDevoteeID"];
//echo "login DevoteeID =". $_SESSION["LoggedinDevoteeID"];
//echo "logined user Group id= ". $_SESSION["GroupID"];

$rstmp = CustomQuery("select GroupID from access1_ugmembers where UserName='".$_SESSION["UserID"]."'"); 
$datatmp = db_fetch_array($rstmp); 
$_SESSION["CustomGroupID"] = $datatmp["GroupID"];

//$EditRecordDevoteeID = $_GET['editid1'];

//echo "CounsellorDevoteeID = ". $values["CounsellorDevoteeID"];
//echo "SELECT COUNT(*) as details_number FROM devotee WHERE DevoteeId = ". $EditRecordDevoteeID.  "  And CounsellorDevoteeID = ". $loginDevoteeID ;

// -1 is group id for admin and 2 is group id for donation collector
if($_SESSION["CustomGroupID"] <> -1 and $_SESSION["CustomGroupID"] <> 2)
{
			$strWhereClause = "CounsellorDevoteeID = " . $_SESSION["LoggedinDevoteeID"] . " or devoteeid = " . $_SESSION["LoggedinDevoteeID"];
}
//echo $strWhereClause;


;		
} // function BeforeQueryList

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				// Before display
function BeforeShowEdit(&$xt,&$templatefile,$values,&$pageObject)
{

		
/*
$xt->assign("Horsepower_tabfieldblock", false);
$xt->assign("Horsepower_fieldblock",$_SESSION["AccessLevel"]==  ACCESS_LEVEL_ADMINGROUP);
$xt->assign("Horsepower_fieldblock",$_SESSION["UserID"]=="admin");
*/
/*
echo "edit id". $_GET['editid1'];
echo  $_SESSION["user_id"];
echo $_SESSION["AccessLevel"];
*/
$loginDevoteeID = $_SESSION["LoggedinDevoteeID"];
$EditRecordDevoteeID = $_GET['editid1'];

//echo "CounsellorDevoteeID = ". $values["CounsellorDevoteeID"];
//echo "SELECT COUNT(*) as details_number FROM devotee WHERE DevoteeId = ". $EditRecordDevoteeID.  "  And CounsellorDevoteeID = ". $loginDevoteeID ;

if($loginDevoteeID <>1)
{
if($loginDevoteeID <> $EditRecordDevoteeID  )
{

	$rs = CustomQuery("SELECT COUNT(*) as details_number FROM devotee WHERE DevoteeId = ". $EditRecordDevoteeID.  "  And CounsellorDevoteeID = ". $loginDevoteeID);
	$record = db_fetch_array($rs);

	if($record['details_number'] == 0)
	{

			  $xt->assign("EmailPrimary_tabfieldblock",false);
				$xt->assign("EmailSecondary_tabfieldblock",false);
				$xt->assign("MobilePhone_tabfieldblock",false);
				$xt->assign("WorkPhone_tabfieldblock",false);

	}

}
}


;		
} // function BeforeShowEdit

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				// Before display
function BeforeShowView(&$xt,&$templatefile,&$values,&$pageObject)
{

		


/*
$xt->assign("Horsepower_tabfieldblock", false);
$xt->assign("Horsepower_fieldblock",$_SESSION["AccessLevel"]==  ACCESS_LEVEL_ADMINGROUP);
$xt->assign("Horsepower_fieldblock",$_SESSION["UserID"]=="admin");
*/
/*
echo "edit id". $_GET['editid1'];
echo  $_SESSION["user_id"];
echo $_SESSION["AccessLevel"];
*/
$loginDevoteeID = $_SESSION["user_id"];
$EditRecordDevoteeID = $_GET['editid1'];

//echo "SELECT COUNT(*) as details_number FROM devotee WHERE DevoteeId = ". $EditRecordDevoteeID.  "  And CounsellorDevoteeID = ". $loginDevoteeID ;

if($loginDevoteeID <>1)
{
if($loginDevoteeID <> $EditRecordDevoteeID  )
{
	$rs = CustomQuery("SELECT COUNT(*) as details_number FROM devotee WHERE DevoteeId = ". $EditRecordDevoteeID.  "  And CounsellorDevoteeID = ". $loginDevoteeID);
	
	$record = db_fetch_array($rs);

	if($record['details_number'] == 0)
	{

			  $xt->assign("EmailPrimary_tabfieldblock",false);
				$xt->assign("EmailSecondary_tabfieldblock",false);
				$xt->assign("MobilePhone_tabfieldblock",false);
				$xt->assign("WorkPhone_tabfieldblock",false);

	}

}
}


;		
} // function BeforeShowView

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				// Before display
function BeforeShowPrint(&$xt,&$templatefile,&$pageObject)
{

		


/*
$xt->assign("Horsepower_tabfieldblock", false);
$xt->assign("Horsepower_fieldblock",$_SESSION["AccessLevel"]==  ACCESS_LEVEL_ADMINGROUP);
$xt->assign("Horsepower_fieldblock",$_SESSION["UserID"]=="admin");
*/
/*
echo "edit id". $_GET['editid1'];
echo  $_SESSION["user_id"];
echo $_SESSION["AccessLevel"];
*/
$loginDevoteeID = $_SESSION["user_id"];
$EditRecordDevoteeID = $_GET['editid1'];

//echo "SELECT COUNT(*) as details_number FROM devotee WHERE DevoteeId = ". $EditRecordDevoteeID.  "  And CounsellorDevoteeID = ". $loginDevoteeID ;

if($loginDevoteeID <>1)
{
if($loginDevoteeID <> $EditRecordDevoteeID  )
{
	$rs = CustomQuery("SELECT COUNT(*) as details_number FROM devotee WHERE DevoteeId = ". $EditRecordDevoteeID.  "  And CounsellorDevoteeID = ". $loginDevoteeID);
	
	$record = db_fetch_array($rs);

	if($record['details_number'] == 0)
	{

			  $xt->assign("EmailPrimary_tabfieldblock",false);
				$xt->assign("EmailSecondary_tabfieldblock",false);
				$xt->assign("MobilePhone_tabfieldblock",false);
				$xt->assign("WorkPhone_tabfieldblock",false);

	}

}
}


;		
} // function BeforeShowPrint

		
		
		
		
		
		
		
		
		
		
		
		
		
		
//	onscreen events

} 
?>
