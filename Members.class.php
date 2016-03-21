<?php
include_once('Persons.class.php');
/**
 * Members
 * 
 * @date 10-3-2016
 * @desc Members, extends Persons. An array of Members.
 */
class Members extends Persons 
{
	public function __construct ()
	{
		
	}

	public function find($string)
	{
		$ms = DatabaseController::findMember($string);
		$member_array = array();

		foreach ($ms as &$m)
		{
			$mem = new Member(1);
			$mem->fromArray($m);
			array_push($member_array, $mem);
		}

		return $member_array;
	}
	
	public function open ()
	{
		
	}
	
	public function close ()
	{
		
	}
}