<?php 
class eventclass_vw_counsellee_temp  extends eventsBase
{ 
	function eventclass_vw_counsellee_temp()
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

		
// **********  Send simple email  ************
$email="akshayg01@gmail.com";
$from="akshayg01@gmail.com";
$msg="Hello there\nBest regards";
$subject="Sample subject";
$attachments = array();
// Attachments description. The 'path' is required. Others parameters are optional. 
// $attachments =  array(
//		array('path' => getabspath('files/1.jpg')),
//		array('path' => getabspath('files/2.jpg'), 'name' => 'image.jpg', 'encoding' => 'base64', 'type' => 'application/octet-stream')) ;

$ret=runner_mail(array('to' => $email, 'subject' => $subject, 'body' => $msg, 'from'=>$from, 'attachments' => $attachments));
// You can manually overwrite SMTP settings
// $ret=runner_mail(array('to' => $email, 'subject' => $subject, 'body' => $msg, 'from'=>$from, 'attachments' => $attachments, 
//     'host' => 'somehost', 'port' => 25, 'username' => 'smtpUserName', 'password' => 'password'));
$ret["message"];




// Place event code here.
// Use "Add Action" button to add code snippets.

return true;
;		
} // function BeforeAdd

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
//	onscreen events

} 
?>
