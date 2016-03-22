<?php
include_once('Persons.class.php');
/**
 * Members
 * @date 10-3-2016
 *
 * Members class uses 'DatabaseController' class to query the database.
 * Following functions are supported:
 * 	findByNumber($number)			Finds a member by ID number.
 * 	findByName($name)				Finds members by name.
 * 	findByCity($city)				Finds all members in a city.
 * 	findByProvince($province)		Finds all members in a province.
 * 	getAll()						Gets all the members.
 * 	add($person, $type)				Adds a new member.
 *	update($person, $type)			Updates an existing member.
 *	delete($person, $type)			Deletes an existing member.
 *	getSize()						Number of members.
 *	isEmpty() 						True if no elements exist, false otherwise.
 */
class Members extends Persons 
{
	private $members;	// Members array
	private $size = 0;	// Size of members array.

	// Displayed when a provider is not found.
	const NOT_FOUND_MESSAGE = "ERROR: No member found<br>";

	/**
	 * Find member by member number.
	 * @param $number
	 */
	public function findByNumber($number)
	{
		$this->members = DatabaseController::selectMember($number);
		$this->setSize();
	}

	/**
	 * Find member by name.
	 * @param $memberName
	 */
	public function findByName($memberName)
	{
		$this->members = DatabaseController::findMember($memberName);
		$this->setSize();
	}

	/**
	 * Find members in a city.
	 * @param $city
	 */
	public function findByCity($city)
	{
		$this->members = DatabaseController::findMember($city);
		$this->setSize();
	}

	/**
	 * Find members by their status.
	 * @param $status
	 */
	public function findByStatus($status)
	{
		$this->members = DatabaseController::findMember($status);
		$this->setSize();
	}

	/**
	 * Find members in a province.
	 * @param $province
	 */
	public function findByProvince($province)
	{
		$this->members = DatabaseController::findMember($province);
		$this->setSize();

	}

	/**
	 * Get all the members in database.
	 */
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

	/**
	 * Size of members array.
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Sets the size of members array.
	 */
	private function setSize()
	{
		$this->size = count($this->members);
	}

	/**
	 * Checks if members array is empty.
	 * @return bool
	 */
	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	/**
	 * Returns a table of members
	 * @return string
	 */
	public function __toString()
	{
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$result = "<Table border=\"1\"><tr><th>Number</th><th>Name</th><th>Street</th><th>City</th>"
				. "<th>Province</th><th>Postal Code</th><th>Email</th><th>Status</th></tr>";
		for ($i = 0; $i < $this->size; $i++)
		{
			$member = $this->members[$i];
			$result .= "<tr><td>" . $member[DatabaseController::MEMBER_NUMBER]
					. "</td><td>" . $member[DatabaseController::MEMBER_NAME]
					. "</td><td>" . $member[DatabaseController::MEMBER_STREET]
					. "</td><td>" . $member[DatabaseController::MEMBER_CITY]
					. "</td><td>" . $member[DatabaseController::MEMBER_PROVINCE]
					. "</td><td>" . $member[DatabaseController::MEMBER_POSTAL]
					. "</td><td>" . $member[DatabaseController::MEMBER_EMAIL]
					. "</td><td>" . $member[DatabaseController::MEMBER_STATUS]
					. "</td></tr>";
		}
		$result .= "</Table>";

		return $result;
	}
}