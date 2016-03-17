<?php
/**
 * OperatorInterface
 * 
 * @date 10-3-2016
 * @desc 
 */
class OperatorInterface
{
public ui;
	function __construct()
	{
		//process input on members
		$this->ui = new UserInterface();

	}
	
	public function main ()
	{
		$this->ui->body .= Utils::getNavigationMenu();

		echo $this->ui;
	}
}