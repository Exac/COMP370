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
	private $members;		// Members array.
	private $providers;		// Providers array.
	private $size = 0;		// Size of members and providers combined.

	const MEMBER   = "Member";
	const PROVIDER = "Provider";

	// Displayed if there is no record.
	const NOT_FOUND_MESSAGE = "ERROR: No person found<br>";

	/**
	 * Finds a member or a provider with a specific number.
	 * @param $number
	 */
	public function findByNumber($number)
	{
		$this->providers = DatabaseController::selectProvider($number);
		$this->members   = DatabaseController::selectMember($number);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

	/**
	 * Finds a member or a provider with a specific name.
	 * @param $name
	 */
	public function findByName($name)
	{
		$this->providers = DatabaseController::findProvider($name);
		$this->members   = DatabaseController::findMember($name);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

	/**
	 * Finds all members or a providers in a specific city.
	 * @param $city
	 */
	public function findByCity($city)
	{
		$this->providers = DatabaseController::findProvider($city);
		$this->members   = DatabaseController::findMember($city);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

	/**
	 * Finds all member or a provider in a specific province.
	 * @param $province
	 */
	public function findByProvince($province)
	{
		$this->providers = DatabaseController::findProvider($province);
		$this->members   = DatabaseController::findMember($province);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

	/**
	 * Gets all the members and providers.
	 */
	public function getAll()
	{
		$this->providers = DatabaseController::selectProviders();
		$this->members   = DatabaseController::selectMembers();

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
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
	 * An internal function to set the size of members and providers combined.
	 */
	private function setSize()
	{
		$this->size = count($this->providers) + count($this->providers);
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
	 * An internal function to flag the type of person.
	 * addProviderLabel() labels all the providers with a 'Provider' label.
	 * @param $type
	 * @param $size
	 */
	private function addProviderLabel($type, $size)
	{
		if ($size == 0) return;
		for ($i = 0; $i < $size; $i++) array_push($this->providers[$i], $type);
	}

	/**
	 * An internal function used to flag the type of person.
	 * addMemberLabel() labels all the members with a 'Member' label.
	 * @param $type
	 * @param $size
	 */
	private function addMemberLabel($type, $size)
	{
		if ($size == 0) return;
		for ($i = 0; $i < $size; $i++) array_push($this->members[$i], $type);
	}

	/**
	 * Returns a table of all the elements in member and provider array.
	 * @return string
	 */
	public function __toString()
	{
		// If no person exists, return.
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$result = "<Table border=\"1\"><tr><th>Number</th><th>Name</th><th>Street</th><th>City</th>"
				. "<th>Province</th><th>Postal Code</th><th>Email</th><th>Type</th></tr>";
		for ($i = 0; $i < count($this->providers); $i++)
		{
			$provider = $this->providers[$i];
			$result .= "<tr><td>" . $provider[DatabaseController::PROVIDER_NUMBER]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_NAME]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_STREET]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_CITY]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_PROVINCE]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_POSTAL]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_EMAIL]
					. "</td><td>" . $provider[0] . "</td></tr>";
		}

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
					. "</td><td>" . $member[0] . "</td></tr>";
		}
		$result .= "</Table>";

		return $result;
	}
}