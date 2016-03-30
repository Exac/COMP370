<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * ServiceReportGenerator
 * 
 * @date 10-3-2016
 * @desc 
 */
class ServiceReportGenerator
{
	private $report;
	private $ui; #UserInterface
	
	function __construct ()
	{
		//$this->report = new ServiceReport();//TODO: Create class ServiceReport
		$this->ui = new UserInterface();#TODO: implement
	}
	
	public function getReport ()
	{
		return $this->report;
	}
}