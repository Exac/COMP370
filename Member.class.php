
<?php

/**
 * Services
 *
 * @date 10-3-2016
 *
 */
class Member
{
	private $status;

	const MEMBER_STATUS_VALUES = "STATUSX";
	const MEMBER_STATUS_HELP = "STATUSY";
	
	public function __construct()
	{
		
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function fromString()
	{
		
	}
	
	public function toString()
	{
		
	}
	
	public function toFormattedString()
	{
		
	}
}