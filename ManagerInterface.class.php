<?php
/**
 * ManagerInterface
 * 
 * @date 10-3-2016
 * @desc I don't know.
 */
class ManagerInterface
{
	public $ui = "UserInterface";
	
	function __construct ()
	{
		
	}
	
	public function providerReport ()
	{
		
	}
	
	public function memberReport ()
	{
		
	}
	
	public function accountsPayableReport ()
	{
		
	}
	
	public function main ()
	{
		echo Utils::getNavigationMenu();
	}
}