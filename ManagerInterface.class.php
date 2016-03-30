<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

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
		return new ProviderReport();
	}
	
	public function memberReport ()
	{
		return new MemberReport();
	}
	
	public function accountsPayableReport ()
	{
		return new AccountsPayableReport();
	}

	private function listReportButtons()
	{
		$lrp = '<form id="managerinterface" action="" method="post">';
		$lrp .= "<fieldset>\n\t<legend>Select Report</legend>" . "<input type='submit' class='button' name='generate_Member_report' id='generate_Member_report' value='Member Report'><br>" . "<input type='submit' class='button' name='generate_Provider_report' id='generate_Provider_report' value='Provider Report'/><br>" . "<input disabled type='submit' class='button' name='generate_AccountsPayable_report' id='generate_AccountsPayable_report' value='Accounts Payable report'/><br>" . '</fieldset>';

		return $lrp . '</form>';
	}
	
	public function main ()
	{
		//change headers to ISO format for mysql data.
		header("Content-Type: text/html; charset=ISO-8859-1");
		
		$this->ui->body .= Utils::getNavigationMenu();
		array_push($this->ui->stylesheets, "cdn/css/manager.css");
		$this->ui->bodyId = "manager";

		if (isset($_POST["generate_Member_report"]))
		{
			$this->ui->add("<h1>Member Report</h1>" . $this->memberReport());
		}
		if (isset($_POST["generate_Provider_report"]))
		{
			$this->ui->add("<h1>Provider Report</h1>" . $this->providerReport());
		}
		if (isset($_POST["generate_AccountsPayable_report"]))
		{
			$this->ui->add("<h1>Accounts Payable Report</h1>" . $this->accountsPayableReport());
		}
		if (!empty($_POST))
		{
			$this->ui->add("<a href='/manager/' class='button'>Back</a>");
		} else
		{
			$this->ui->add($this->listReportButtons());
		}

		echo $this->ui;
	}
}