<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * AccountsPayableReportGenerator
 * 
 * @date 10-3-2016
 * @desc 
 */
class AccountsPayableReportGenerator
{
	private $report;
	
	function __construct ()
	{
		$this->report = new AccountsPayableReport();
	}
	
	public function getReport ()
	{
		return $this->report;
	}
}