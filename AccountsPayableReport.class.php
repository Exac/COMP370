<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

include_once('DateRangeReport.class.php');

/**
 * AccountsPayableReport
 * 
 * @date 10-3-2016
 * @desc Extends DateRangeReport.
 */
class AccountsPayableReport extends DateRangeReport
{
	private $table = "<table class='report'>";

	function __construct()
	{
		$this->table .= "<tr><th>AccountsPayable Number</th><th>Name</th><th>Address</th><th>Email</th><th>Status</th></tr>";
		$accountsPayables = DatabaseController::getAllAccountsPayables();
		foreach ($accountsPayables as $m)
		{
			$this->table .= "\n\t<tr><td>${m['accountsPayable_number']}</td>";
			$this->table .= "\n\t<td>${m['accountsPayable_name']}</td>";
			$this->table .= "\n\t<td>${m['accountsPayable_street_address']}, ${m['accountsPayable_city']}, ${m['accountsPayable_province']}, ${m['accountsPayable_postal_code']}</td>";
			$this->table .= "\n\t<td>${m['accountsPayable_email_address']}</td>";
			$this->table .= "\n\t<td>${m['accountsPayable_status']}</td></tr>";
		}
	}
	
	public function addDetail ()
	{
		
	}
	
	public function addSummary ()
	{
		
	}

	public function __toString()
	{
		return $this->table . "</table>";
	}
}