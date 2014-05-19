<?php 
class eventclass_vw_Devotee_full  extends eventsBase
{ 
	function eventclass_vw_Devotee_full()
	{
	// fill list of events
		$this->events["BeforeAdd"]=true;


//	onscreen events


	}
// Captchas functions	

//	handlers

		
		
		
		
		
		
		
		
		
		
				// Before record added
function BeforeAdd(&$values,&$message,$inline,&$pageObject)
{

		
//**********  Save new data in another table  ************
global $conn,$strTableName;

$strSQLSave = "INSERT INTO AnotherTable (Field1, Field2) values (";

$strSQLSave .=  $values["Field1"].",";
$strSQLSave .=  $values["Field2"];

$strSQLSave .= ")";
db_exec($strSQLSave,$conn);





// Place event code here.
// Use "Add Action" button to add code snippets.

return true;
;		
} // function BeforeAdd

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
//	onscreen events

} 
?>
