<?php
include_once(getabspath("classes/runnerpage.php"));
class RegisterPage extends RunnerPage
{
	
	function RegisterPage(&$params)
	{
		parent::RunnerPage($params);
	}
	
	/**
	 * Assign body end
	 */	
	function assignBodyEnd(&$params) 
	{
		parent::assignBodyEnd($params);
			}
}
?>