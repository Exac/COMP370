<?php
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