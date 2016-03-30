<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * ProviderReport
 * 
 * @date 10-3-2016
 * @desc Extends DateRangeReport.
 */
class ProviderReport extends DateRangeReport
{
	private $detailCount = 0;
	private $table = "<table class='report'>";

	function __construct()
	{
		$this->table .= "<tr><th>Provider Number</th><th>Name</th><th>Address</th><th>Email</th><th>Status</th></tr>";
		$providers = DatabaseController::getAllProviders();
		foreach ($providers as $m)
		{
			$this->table .= "\n\t<tr><td>${m['provider_number']}</td>";
			$this->table .= "\n\t<td>${m['provider_name']}</td>";
			$this->table .= "\n\t<td>${m['provider_street_address']}, ${m['provider_city']}, ${m['provider_province']}, ${m['provider_postal_code']}</td>";
			$this->table .= "\n\t<td>${m['provider_email_address']}</td>";
			$this->table .= "\n\t<td>${m['provider_type']}</td></tr>";
		}
	}
	
	public function addSummary ()
	{
		
	}
	
	public function getDetailCount ()
	{
		
	}

	public function __toString()
	{
		return $this->table . "</table>";
	}
}