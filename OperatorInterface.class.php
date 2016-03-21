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

?>
<!--
<form id="memberControls" action="../OperatorInterface.class.php" method="POST">

	<fieldset style="width: 600px;">
		<legend>View Members</legend>
		<label>click_to_view_members</label>
		<input type="submit" name="view_members" value="view_members">
	</fieldset><br>

	<fieldset style="width: 600px;">
		<legend>New Person</legend>

		<input type="radio" name="person" value="member">Member
		<input type="radio" name="person" value="provider">Provider<br><br>

		Name:           <br><input type="text"  name="name"><br>
		Street address: <br><input type="text"  name="street_address"><br>
		City:           <br><input type="text"  name="city"><br>
		Province:       <br><input type="text"  name="province"><br>
		Postal code:    <br><input type="text"  name="postal_code"><br>
		E-mail:         <br><input type="email" name="email"><br><br>

		<fieldset style="width: 550px;"><legend>Fill only for member</legend>

			Member Status:  <br><input type="radio" name="status" value="ACTIVE"> Active
			<br><input type="radio" name="status" value="SUSPENDED"> Suspended
			<br><br>
		</fieldset><br>

		<fieldset style="width: 550px;"><legend>Fill only for provider</legend>
			Provider Type:  <br><input type="radio" name="type" value="DIETITIAN"> Dietitian
			<br><input type="radio" name="type" value="INTERNIST"> Internist
			<br><input type="radio" name="type" value="EXERCISE_EXPERT"> Exercise expert
			<br><br>
		</fieldset><br>

		<input type="submit" name="add_person" value="add_person">
	</fieldset>

</form>
EOT;-->
<form method="get" action="">

</form>