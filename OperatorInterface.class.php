<?php
/**
 * OperatorInterface
 * 
 * @date 10-3-2016
 * @desc 
 */

class OperatorInterface
{
	private $ui;

	function __construct()
	{
		//process input on members
		$this->ui = new UserInterface();

	}
	
	public function main ()
	{
		$this->ui->body .= $_POST["name"] . " " . $_POST["street_address"];

		$this->ui->bodyId = "operatorinterface";
		$this->ui->body .= Utils::getNavigationMenu();

		$this->ui->body .= "<form method='post' action=''>";
		//$this->ui->body .= (new Button("test button", "This is the test button"));
		$this->ui->body .= "</form>";
		echo $this->ui;
	}
}