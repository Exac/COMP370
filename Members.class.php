<?php
include_once('Persons.class.php');
/**
 ************************  USE THIS CLASS TO GET TO DATABASE ************************
 *
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
	private $members; 	// Members array
	private $size = 0;	// Size of members array.

	// Displayed when a provider is not found.
	const NOT_FOUND_MESSAGE = "ERROR: No member found<br>";
	const ADD_SUCCESSFUL    = "Member added<br>";
	const UPDATE_SUCCESSFUL = "Member updated<br>";
	const ADD_FAIL          = "Member can not be added<br>";
	const UPDATE_FAIL       = "Member can not be updated<br>";


	public function __construct()
	{
		parent::__construct();
		$this->members = new SplObjectStorage();
	}

	/**
	 * Find member by member number.
	 * @param $number
	 * @return SplObjectStorage|string|void
	 */
	public function findByNumber($number)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->members->rewind();
		while ($this->members->valid())
		{
			$provider = $this->members->current();

			if ($provider->getNumber() == $number)
			{
				$temp->attach($provider);
				$this->size++;
			}

			$this->members->next();
		}

		$this->members = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->members;
	}

	/**
	 * Find member by name.
	 * @param $memberName
	 * @return SplObjectStorage|string|void
	 */
	public function findByName($memberName)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->members->rewind();
		while ($this->members->valid())
		{
			$provider = $this->members->current();

			if ($provider->getName() == $memberName)
			{
				$temp->attach($provider);
				$this->size++;
			}

			$this->members->next();
		}

		$this->members = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->members;
	}

	/**
	 * Find members in a city.
	 * @param $city
	 * @return SplObjectStorage|string|void
	 */
	public function findByCity($city)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->members->rewind();
		while ($this->members->valid())
		{
			$provider = $this->members->current();

			if ($provider->getCity() == $city)
			{
				$temp->attach($provider);
				$this->size++;
			}

			$this->members->next();
		}

		$this->members = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->members;
	}

	/**
	 * Find members by their status.
	 * @param $status
	 * @return SplObjectStorage|string
	 */
	public function findByStatus($status)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->members->rewind();
		while ($this->members->valid())
		{
			$provider = $this->members->current();

			if ($provider->getStatus() == $status)
			{
				$temp->attach($provider);
				$this->size++;
			}

			$this->members->next();
		}

		$this->members = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->members;
	}

	/**
	 * Find members in a province.
	 * @param $province
	 * @return SplObjectStorage|string|void
	 */
	public function findByProvince($province)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->members->rewind();
		while ($this->members->valid())
		{
			$provider = $this->members->current();

			if ($provider->getProvince() == $province)
			{
				$temp->attach($provider);
				$this->size++;
			}

			$this->members->next();
		}

		$this->members = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->members;

	}

	/**
	 * Get all the members in database. Stores them into a SplObjectStorage.
	 * Call 'Person.class' functions to access all the fields.
	 *
	 * Example 	$persons = new Members();
	 * 			$members = $persons->getAll();
	 *
	 * 			$members->rewind();
	 * 			while ($members->valid())
	 * 			{
	 * 				echo $members->current()->getName();
	 * 				$members->next()
	 * 			}
	 */
	public function getAll()
	{
		$this->members = new SplObjectStorage();
		$databaseMembers = DatabaseController::selectMembers();

		$size = count($databaseMembers);

		for ($i = 0; $i < $size; $i++)
		{
			$databaseMember = $databaseMembers[$i];

			$member = new Member($databaseMember[DatabaseController::MEMBER_NUMBER]);

			$member->setName($databaseMember[DatabaseController::MEMBER_NAME]);
			$member->setStreet($databaseMember[DatabaseController::MEMBER_STREET]);
			$member->setCity($databaseMember[DatabaseController::MEMBER_CITY]);
			$member->setProvince($databaseMember[DatabaseController::MEMBER_PROVINCE]);
			$member->setPostalCode($databaseMember[DatabaseController::MEMBER_POSTAL]);
			$member->setEmail($databaseMember[DatabaseController::MEMBER_EMAIL]);
			$member->setStatus($databaseMember[DatabaseController::MEMBER_STATUS]);

			$this->members->attach($member);

			$this->size++;
		}

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->members;
	}

	public function add(Member $member)
	{
		$result = DatabaseController::addMember(
			$member->getNumber(),   $member->getName(),
			$member->getStreet(),   $member->getCity(),
			$member->getProvince(), $member->getPostalCode(),
			$member->getEmail(),    $member->getStatus());

		return ($result == true) ? self::ADD_SUCCESSFUL : self::ADD_FAIL;

		#TODO: Implement DatabaseController
	}

	public function update(Member $member)
	{
		// Check if the member exists in the database first.
		if (!$this->MemberExists($member->getNumber())) return self::NOT_FOUND_MESSAGE;

		$result = DatabaseController::updateMember(
			$member->getNumber(),   $member->getName(),
			$member->getStreet(),   $member->getCity(),
			$member->getProvince(), $member->getPostalCode(),
			$member->getEmail(),    $member->getStatus());

		return ($result == true) ? self::UPDATE_SUCCESSFUL : self::UPDATE_FAIL;

		#TODO: Implement DatabaseController
	}

	public function delete($memberNumber)
	{
		// Check if the member exists in the database first.
		if (!$this->MemberExists($memberNumber)) return self::NOT_FOUND_MESSAGE;

		$result = DatabaseController::deleteMember($memberNumber);

		return ($result == true) ? self::UPDATE_SUCCESSFUL : self::UPDATE_FAIL;

		#TODO: Implement DatabaseController
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
	 * Checks if members array is empty.
	 * @return bool
	 */
	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	private function memberExists($memberNumber)
	{
		return DatabaseController::memberExists($memberNumber);
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

		$this->members->rewind();
		while ($this->members->valid())
		{
			$member = $this->members->current();

			$result .= "<tr><td>" . $member->getNumber()  . "</td><td>" . $member->getName()
				. "</td><td>" . $member->getStreet()  . "</td><td>" . $member->getCity()
				. "</td><td>" . $member->getProvince(). "</td><td>" . $member->getPostalCode()
				. "</td><td>" . $member->getEmail()   . "</td><td>" . $member->getStatus()
				. "</td></tr>";

			$this->members->next();
		}
		$result .= "</Table>";

		return $result;
	}
}