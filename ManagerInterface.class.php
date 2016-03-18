<?php
/**
 * ManagerInterface
 * 
 * @date 10-3-2016
 * @desc I don't know.
 */
class ManagerInterface
{
	public $ui;
	
	function __construct ()
	{
		$this->ui = new UserInterface();

		//Check if $_POST request for any reports.
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
		$this->ui->body .= Utils::getNavigationMenu();
		echo $this->ui;
	}
}