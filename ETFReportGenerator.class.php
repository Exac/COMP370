<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * ETFReportGenerator
 * 
 * @date 10-3-2016
 * @desc 
 */
class ETFReportGenerator
{
	private $report;
	
	function __construct ()
	{
		$this->report = new ETFReport();
	}
	
	public function getReport ()
	{
		return $this->report;
	}
}