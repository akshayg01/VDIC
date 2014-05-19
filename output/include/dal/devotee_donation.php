<?php
$dalTabledevotee_donation = array();
$dalTabledevotee_donation["DonationId"] = array("type"=>3,"varname"=>"DonationId");
$dalTabledevotee_donation["DevoteeId"] = array("type"=>3,"varname"=>"DevoteeId");
$dalTabledevotee_donation["DonationDate"] = array("type"=>7,"varname"=>"DonationDate");
$dalTabledevotee_donation["DonationOnName"] = array("type"=>200,"varname"=>"DonationOnName");
$dalTabledevotee_donation["DonationOnNamePanNumber"] = array("type"=>3,"varname"=>"DonationOnNamePanNumber");
$dalTabledevotee_donation["DonationPurposeId"] = array("type"=>3,"varname"=>"DonationPurposeId");
$dalTabledevotee_donation["Amount"] = array("type"=>3,"varname"=>"Amount");
$dalTabledevotee_donation["ReceiptNumber"] = array("type"=>200,"varname"=>"ReceiptNumber");
$dalTabledevotee_donation["DonationMode"] = array("type"=>3,"varname"=>"DonationMode");
$dalTabledevotee_donation["CheckNumber"] = array("type"=>200,"varname"=>"CheckNumber");
$dalTabledevotee_donation["CheckBank"] = array("type"=>200,"varname"=>"CheckBank");
$dalTabledevotee_donation["CheckBranch"] = array("type"=>200,"varname"=>"CheckBranch");
$dalTabledevotee_donation["CheckCleared"] = array("type"=>200,"varname"=>"CheckCleared");
$dalTabledevotee_donation["CheckClearedDate"] = array("type"=>7,"varname"=>"CheckClearedDate");
	$dalTabledevotee_donation["DonationId"]["key"]=true;
$dal_info["devotee_donation"]=&$dalTabledevotee_donation;

?>