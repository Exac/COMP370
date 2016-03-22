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

	private $members;	// Members array
	private $size = 0;	// Size of members array.

	// Displayed when a provider is not found.
	const NOT_FOUND_MESSAGE = "ERROR: No member found<br>";

	public function findByNumber($number)
	{
		$this->members = DatabaseController::selectMember($number);
		$this->setSize();
	}

	public function findByName($memberName)
	{
		$this->members = DatabaseController::findMember($memberName);
		$this->setSize();
	}

	public function findByCity($city)
	{
		$this->members = DatabaseController::findMember($city);
		$this->setSize();
	}

	public function findByType($status)
	{
		$this->members = DatabaseController::findMember($status);
		$this->setSize();
	}

	public function findByProvince($province)
	{
		$this->members = DatabaseController::findMember($province);
		$this->setSize();

	}

	public function getAll()
	{
		$this->members = DatabaseController::selectMembers();
		$this->setSize();

	}

	public function add($member)
	{
		#TODO: Add functionality to DatabaseController first
	}

	public function update()
	{
		#TODO: Add functionality to Database controller first
	}

	public function delete()
	{
		#TODO: Add functionality to Database controller first
	}

	public function getSize()
	{
		return $this->size;
	}

	private function setSize()
	{
		$this->size = count($this->members);
	}

	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	public function __toString()
	{
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$result = "<Table border=\"1\"><tr><th>Number</th><th>Name</th><th>Street</th><th>City</th>"
				. "<th>Province</th><th>Postal Code</th><th>Email</th><th>Type</th></tr>";
		for ($i = 0; $i < $this->size; $i++)
		{
			$provider = $this->members[$i];
			$result .= "<tr><td>" . $provider[DatabaseController::MEMBER_NUMBER]
					. "</td><td>" . $provider[DatabaseController::MEMBER_NAME]
					. "</td><td>" . $provider[DatabaseController::MEMBER_STREET]
					. "</td><td>" . $provider[DatabaseController::MEMBER_CITY]
					. "</td><td>" . $provider[DatabaseController::MEMBER_PROVINCE]
					. "</td><td>" . $provider[DatabaseController::MEMBER_POSTAL]
					. "</td><td>" . $provider[DatabaseController::MEMBER_EMAIL]
					. "</td><td>" . $provider[DatabaseController::MEMBER_STATUS]
					. "</tr>";
		}
		$result .= "</Table>";

		return $result;
	}
}