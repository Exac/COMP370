<?php

/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/11/16
 * Time: 4:13
 */

class ProviderInterface
{
	private $theProvider;#Provider
	private $theMember;#Member
	private $ui;#UserInterface

	function __construct()
	{
		//$this->theProvider = new Provider(1);
		//$this->theMember = new Member(1);
		$this->ui = new UserInterface();
		$this->ui->bodyId = "provider";
		array_push($this->ui->stylesheets, "cdn/css/provider.css");
		$this->ui->add('<script src="/cdn/js/provider.js" defer="defer"></script>');

		if (sizeof($_POST) === 0)
		{
			//display login screen
			$this->logon();
		}
		if (isset($_POST["provider_password"]))
		{
			//provider has logged in, time to verify the user
			$this->verifyMember();
		}
		if (isset($_POST["provider_verify_member"]))
		{
			$this->manipulate($_POST["provider_verify_member"]);
		}
	}

	/**
	 * Call after provider and member have been selected
	 */
	public function manipulate($memberID)
	{
		//check if good or bad login
		//query database with member number.
		$member_exists = DatabaseController::memberExists($memberID);
		if (!$member_exists)
		{
			//Invalid Number
			$this->ui->add("<span id='provider_member_validator' class='invalid'>Invalid Member Number</span>");
		} else
		{
			$member = new Member($memberID);
			if ($member->getStatus() === "SUSPENDED")
			{
				//Suspended Member
				$this->ui->add("<span id='provider_member_validator' class='invalid'>Invalid Member Number</span>");
				$this->ui->add("<span id='provider_member_validator'>Invalid Member Number</span>");
			} else
			{
				//Validated
				echo "VALIDATED";
				$this->ui->add('<input name="provider_theProvider" value="' . $_POST["provider_theProvider"] . '" type="hidden">');
				$this->ui->add('<input name="provider_theMember" value="' . $member->getNumber() . '" type="hidden">');
			}
		}

	}

	public function logon()
	{
		$this->ui->add('<form id="providerinterface" action="" method="post">');
		$this->ui->add('<fieldset>');
		$this->ui->add('<legend>Provider Login</legend>');
		$this->ui->body .= (new Input("text", "provider_password", "Enter your provider #"));
		$this->ui->add('<br>');
		$this->ui->add('<button id="provider_password_submit" name="provider_password_submit" type="submit"/>Login</button>');
		$this->ui->add('</fieldset>');
		$this->ui->add('</form>');
	}

	public function verifyMember()
	{
		$provider = new Provider($_POST["provider_password"]);
		$this->ui->body .= '<div id="providerID"><span class="name">' . $provider->getName() . '</span>' . '<br><span class="city">' . $provider->getCity() . '</span>, <span class="province">' . $provider->getProvince() . '</span></div>';
		$this->ui->add('<form id="providerinterface" action="" method="post">');
		$this->ui->add('<fieldset>');
		$this->ui->add('<legend>Verify your current Member</legend>');
		$this->ui->add("<p id='cardreader'>Enter the member's number, <br>or have them swipe the card-reader.</p>");
		$this->ui->body .= (new Input("text", "provider_verify_member", "Member #"));
		$this->ui->add('<br><button id="provider_verify_member_submit" name="provider_verify_member_submit" type="submit"/>Verify Member</button>');
		$this->ui->add('</fieldset>');
		$this->ui->add('<input type="hidden" name="provider_theProvider" value="' . $provider->getNumber() . '"/>');
		$this->ui->add('</form>');
	}

	public function receiveDirectory()
	{

	}

	private function error($message)
	{
		$this->ui->add("<div id='errorScreen'><span class='message'>${message}</span></div>");
		$this->ui->body . add("<script defer>function relo () {location.reload();};window.setTimeout(relo, 2500);</script>");
	}

	public function main()
	{

		$this->ui->body .= Utils::getNavigationMenu();

		echo $this->ui;
	}
} 