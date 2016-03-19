<?php
/**
 * OperatorInterface
 * 
 * @date 10-3-2016
 * @desc 
 */

if (isset($_POST["view_members"]))
{
	echo "view_members selected";
}

if (isset($_POST["add_person"]))
{
	echo "add_person pressed";

	$person = $_POST["person"];

	/*
	$name     = $_POST["name"];
	$street   = $_POST["street_address"];
	$city     = $_POST["city"];
	$province = $_POST["province"];
	$postal   = $_POST["postal_code"];
	$email    = $_POST["email"];

	$status = $_POST["status"];

	$type = $_POST["type"]; */

	if ($person == "member")
	{
		echo "member selected";
		$member = new MemberMaintainer();
		$member->addMember($_POST["name"], $_POST["street_address"], $_POST["city"],
			$_POST["province"], $_POST["postal_code"], $_POST["email"], $_POST["status"]);
	}

	else if ($person == "provider")
	{
		echo "provider selected";
		$provider = new ProviderMaintainer();
		$provider->addProvider($_POST["name"], $_POST["street_address"], $_POST["city"],
			$_POST["province"], $_POST["postal_code"], $_POST["email"], $_POST["type"]);
	}
}
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
		$this->ui->bodyId = "operatorinterface";
		$this->ui->body .= Utils::getNavigationMenu();

		$this->ui->body .= "<form method='post' action=''>";
		//$this->ui->body .= (new Button("test button", "This is the test button"));
		$this->ui->body .= "</form>";
		echo $this->ui;
	}
}