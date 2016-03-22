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

	public function __construct()
	{
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
	 * Get all the members in database.
	 */
	public function getAll()
	{
		$databaseMembers = DatabaseController::selectProviders();

		$size = count($databaseMembers);

		for ($i = 0; $i < $size; $i++)
		{
			$databaseProvider = $databaseMembers[$i];

			$provider = new Member($databaseProvider[DatabaseController::PROVIDER_NUMBER]);

			$provider->setName($databaseProvider[DatabaseController::MEMBER_NAME]);
			$provider->setStreet($databaseProvider[DatabaseController::MEMBER_STREET]);
			$provider->setCity($databaseProvider[DatabaseController::MEMBER_CITY]);
			$provider->setProvince($databaseProvider[DatabaseController::MEMBER_PROVINCE]);
			$provider->setPostalCode($databaseProvider[DatabaseController::MEMBER_POSTAL]);
			$provider->setEmail($databaseProvider[DatabaseController::MEMBER_EMAIL]);
			$provider->setStatus($databaseProvider[DatabaseController::MEMBER_STATUS]);

			$this->members->attach($provider);

			$this->size++;
		}

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->members;
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

		$this->members->rewind();
		while ($this->members->valid())
		{
			$member = $this->members->current();

			$result .= "<tr><td>" . $member->getNumber()  . "</td><td>" . $member->getName()
				. "</td><td>" . $member->getStreet()  . "</td><td>" . $member->getCity()
				. "</td><td>" . $member->getProvince(). "</td><td>" . $member->getPostalCode()
				. "</td><td>" . $member->getEmail()   . "</td><td>" . $member->getType()
				. "</td></tr>";

			$this->members->next();
		}
		$result .= "</Table>";

		return $result;
	}
}