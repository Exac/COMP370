<?php

/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/11/16
 * Time: 4:13
 */

//echo $_POST["name"] . " " . $_POST["street_address"];
echo "ProviderInterface: var_dump(\$_POST): ";
var_dump($_POST);

class ProviderInterface
{
	private $theProvider;#Provider
	private $theMember;#Member
	private $ui;#UserInterface

	function __construct()
	{
		$this->theProvider = new Provider();
		$this->theMember = new Member();
		$this->ui = new UserInterface();
	}

	public function logon()
	{

	}

	public function verifyMember()
	{

	}

	public function receiveDirectory()
	{

	}

	public function main()
	{
		$this->
		$this->ui->body .= Utils::getNavigationMenu();

		echo $this->ui;
	}
} 