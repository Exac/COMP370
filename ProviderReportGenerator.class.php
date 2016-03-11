<?php
/**
 * ProviderReportGenerator
 * 
 * @date 10-3-2016
 * @desc 
 */
class ProviderReportGenerator
{
	private report;
	
	function __construct ()
	{
		$this->report = new ProviderReport();
	}
	
	public function getReport ()
	{
		return $this->report;
	}
}