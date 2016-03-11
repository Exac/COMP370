<?php
/**
 * MemberReportGenerator
 * 
 * @date 10-3-2016
 * @desc 
 */
class MemberReportGenerator
{
	private $report;
	
	function __construct ()
	{
		$this->report = new MemberReport();
	}
	
	public function getReport ()
	{
		return $this->report;
	}
}