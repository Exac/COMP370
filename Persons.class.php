<?php
/**
 * Class Persons
 * @date 10-3-2016
 *
 * Persons include the members and the providers. This class uses 'DatabaseController' class to
 * query the database. Following functions are supported:
 * 	findByNumber($number)			Finds a person by ID number.
 * 	findByName($name)				Finds a person by name.
 * 	findByCity($city)				Finds a person by city.
 * 	findByProvince($province)		Finds a person by province.
 * 	getAll()						Gets all the people.
 * 	add($person, $type)				Adds a member or a person.
 *	update($person, $type)			Updates a member or a person.
 *	delete($person, $type)			Deletes a member or a person.
 *	getSize()						Number of people.
 *	isEmpty() 						True if no elements exist, false otherwise.
 */
class Persons
{
	private $persons;
	private $size = 0;		// Size of members and providers combined.

	const MEMBER   = "Member";
	const PROVIDER = "Provider";

	// Displayed if there is no record.
	const NOT_FOUND_MESSAGE = "ERROR: No person found<br>";

	public function __construct()
	{
		$this->persons = new SplObjectStorage();
	}

	/**
	 * Finds a member or a provider with a specific number.
	 * @param $number
	 * @return SplObjectStorage|string
	 */
	public function findByNumber($number)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->persons->rewind();
		while ($this->persons->valid())
		{
			$person = $this->persons->current();

			if ($person->getNumber() == $number)
			{
				$temp->attach($person);
				$this->size++;
			}

			$this->persons->next();
		}

		$this->persons = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	/**
	 * Finds a member or a provider with a specific name.
	 * @param $name
	 * @return SplObjectStorage|string
	 */
	public function findByName($name)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->persons->rewind();
		while ($this->persons->valid())
		{
			$person = $this->persons->current();

			if ($person->getName() == $name)
			{
				$temp->attach($person);
				$this->size++;
			}

			$this->persons->next();
		}

		$this->persons = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	/**
	 * Finds all members or a providers in a specific city.
	 * @param $city
	 * @return SplObjectStorage|string
	 */
	public function findByCity($city)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->persons->rewind();
		while ($this->persons->valid())
		{
			$person = $this->persons->current();

			if ($person->getCity() == $city)
			{
				$temp->attach($person);
				$this->size++;
			}

			$this->persons->next();
		}

		$this->persons = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	/**
	 * Finds all member or a provider in a specific province.
	 * @param $province
	 * @return SplObjectStorage|string
	 */
	public function findByProvince($province)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->persons->rewind();
		while ($this->persons->valid())
		{
			$person = $this->persons->current();

			if ($person->getProvince() == $province)
			{
				$temp->attach($person);
				$this->size++;
			}

			$this->persons->next();
		}

		$this->persons = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	/**
	 * Gets all the members and providers.
	 */
	public function getAll()
	{
		$databaseProviders = DatabaseController::selectProviders();
		$databaseMembers   = DatabaseController::selectMembers();

		$providerSize = count($databaseProviders);
		$memberSize = count($databaseMembers);

		for ($i = 0; $i < $providerSize; $i++)
		{
			$databaseProvider = $databaseProviders[$i];

			$provider = new Provider($databaseProvider[DatabaseController::PROVIDER_NUMBER]);

			$provider->setName($databaseProvider[DatabaseController::PROVIDER_NAME]);
			$provider->setStreet($databaseProvider[DatabaseController::PROVIDER_STREET]);
			$provider->setCity($databaseProvider[DatabaseController::PROVIDER_CITY]);
			$provider->setProvince($databaseProvider[DatabaseController::PROVIDER_PROVINCE]);
			$provider->setPostalCode($databaseProvider[DatabaseController::PROVIDER_POSTAL]);
			$provider->setEmail($databaseProvider[DatabaseController::PROVIDER_EMAIL]);

			$this->persons->attach($provider);

			$this->size++;
		}

		for ($i = 0; $i < $memberSize; $i++)
		{
			$databaseProvider = $databaseMembers[$i];

			$provider = new Member($databaseProvider[DatabaseController::PROVIDER_NUMBER]);

			$provider->setName($databaseProvider[DatabaseController::MEMBER_NAME]);
			$provider->setStreet($databaseProvider[DatabaseController::MEMBER_STREET]);
			$provider->setCity($databaseProvider[DatabaseController::MEMBER_CITY]);
			$provider->setProvince($databaseProvider[DatabaseController::MEMBER_PROVINCE]);
			$provider->setPostalCode($databaseProvider[DatabaseController::MEMBER_POSTAL]);
			$provider->setEmail($databaseProvider[DatabaseController::MEMBER_EMAIL]);

			$this->persons->attach($provider);

			$this->size++;
		}

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	public function add($person, $type)
	{
		#TODO: Add functionality to DatabaseController first
	}

	public function update($person, $type)
	{
		#TODO: Add functionality to Database controller first
	}

	public function delete()
	{
		#TODO: Add functionality to Database controller first
	}

	/**
	 * Gets the size of members and providers combined.
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * True if no members or providers exist.
	 * @return bool
	 */
	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	/**
	 * Returns a table of all the elements in member and provider array.
	 * @return string
	 */
	public function __toString()
	{
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$result = "<Table border=\"1\"><tr><th>Number</th><th>Name</th><th>Street</th><th>City</th>"
			. "<th>Province</th><th>Postal Code</th><th>Email</th></tr>";

		$this->persons->rewind();
		while ($this->persons->valid())
		{
			$person = $this->persons->current();

			$result .= "<tr><td>" . $person->getNumber()  . "</td><td>" . $person->getName()
				. "</td><td>" . $person->getStreet()  . "</td><td>" . $person->getCity()
				. "</td><td>" . $person->getProvince(). "</td><td>" . $person->getPostalCode()
				. "</td><td>" . $person->getEmail()   . "</td></tr>";

			$this->persons->next();
		}
		$result .= "</Table>";

		return $result;
	}
}