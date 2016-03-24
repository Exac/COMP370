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
			$this->ui->add("<span id='validator' class='invalid'>Invalid Member Number</span>");
			$this->ui->add('<form id="provider_invalid" method="post" action="">' . '<input name="provider_theProvider" id="provider_theProvider" value="' . $_POST["provider_theProvider"] . '" type="hidden"></form>');
		} else
		{
			$member = new Member($memberID);
			if ($member->getStatus() === "SUSPENDED")
			{
				//Suspended Member
				$this->ui->add("<span id='validator' class='invalid'>Member Suspended. <small>Did you pay your fees this month?</small></span>");
				$this->ui->add('<form id="provider_invalid" method="post" action="">' . '<input name="provider_theProvider" id="provider_theProvider" value="' . $_POST["provider_theProvider"] . '" type="hidden"></form>');
			} else
			{
				//Validated
				$this->ui->add($this->providerBar($_POST["provider_theProvider"]));
				$this->ui->add("<span id='validator' class='valid'>Valid Member Number</span>");
				$this->ui->add("<p><strong>`Bill ChocAn for a Service` dataflow:</strong></p>");
				$this->ui->add("<p>Enter date[MM-DD-YYY] of service.-> <br>" . "Use the Provider Directory to find the 6-digit service code, entered or selected... [SERVICE CODE] <br>->" . " display name of service and code [VERIFY] | 'Error:bad code' <br>->" . " Enter information about the service provided: " . "[comments] (other informatino displayed on screen)" . "<br>-> display fee && display verification form pre-filled-out</p>");
				$this->ui->add("<p><strong>`Lookup Provider Directory` dataflow:</strong></p>");
				$this->ui->add("<p>[Lookup Provider Directory] on each page, accessable at any time" . "alphabetically ordered list of service names &amp; codes &amp; fees; (display on screen, but ChocAn sends directory as email attachment...)</p>");
				$this->ui->add('<input name="provider_theProvider" id="provider_theProvider" value="' . $_POST["provider_theProvider"] . '" type="hidden">');
				$this->ui->add('<input name="provider_theMember" id="provider_theMember" value="' . $member->getNumber() . '" type="hidden">');
			}
		}

	}

	public function logon()
	{
		$this->ui->add('<form id="providerinterface" action="" method="post">');
		$this->ui->add('<fieldset>');
		$this->ui->add('<legend>Provider Login</legend>');
		$this->ui->body .= (new Input("text", "provider_password", array("Enter your provider #", " autofocus ")));
		$this->ui->add('<br>');
		$this->ui->add('<button id="provider_password_submit" name="provider_password_submit"  type="submit"/>Login</button>');
		$this->ui->add('</fieldset>');
		$this->ui->add('</form>');
	}

	public function verifyMember()
	{
//		$p = new Provider("000000000");
//		echo $p->getNumber();
//		echo $p->getName();
		$provider = new Provider($_POST["provider_password"]);
		$this->ui->add($this->providerBar($_POST["provider_password"]));
		$this->ui->add('<form id="providerinterface" action="" method="post">');
		$this->ui->add('<fieldset>');
		$this->ui->add('<legend>Verify your current Member</legend>');
		$this->ui->add("<p id='cardreader'>Enter the member's number, <br>or have them swipe the card-reader.</p>");
		$this->ui->body .= (new Input("text", "provider_verify_member", array("Member #", " autofocus ")));
		$this->ui->add('<br><button id="provider_verify_member_submit" name="provider_verify_member_submit" type="submit"/>Verify Member</button>');
		$this->ui->add('</fieldset>');
		$this->ui->add('<input type="hidden" name="provider_theProvider" id="provider_theProvider" value="' . $provider->getNumber() . '"/>');
		$this->ui->add('</form>');
	}

	public function receiveDirectory()
	{

	}

	private function error($message)
	{
		$em_ui = new UserInterface();
		$em_ui->add("<div id='invalid errorScreen'><span class='message'>${message}</span></div>");
		$em_ui->inlineJS .= "function relo () {location.reload();};window.setTimeout(relo, 2500);";

		echo($em_ui);
		die();
	}

	private function providerBar($provider_number)
	{
		$provider = new Provider($provider_number);

		return '<div id="providerID"><span class="name">' . $provider->getName() . '</span>' . '<br><span class="city">' . $provider->getCity() . '</span>, ' . '<span class="province">' . $provider->getProvince() . '</span>' . '<a class="small" id="lookup_provider_directory">◄ Provider Directory</a>' . '</div>';
	}

	public function main()
	{

		$this->ui->body .= Utils::getNavigationMenu();

		echo $this->ui;
	}
} 