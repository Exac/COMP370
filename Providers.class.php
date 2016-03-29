<?php
/**
 * Class Providers
 * @date 10-3-2016
 *
 * Providers class uses 'DatabaseController' class to query the database.
 * Following functions are supported:
 * 	findByNumber($number)			Finds a provider by ID number.
 * 	findByName($name)				Finds providers by name.
 * 	findByCity($city)				Finds all providers in a city.
 * 	findByProvince($province)		Finds all providers in a province.
 * 	getAll()						Gets all the providers.
 * 	add($person, $type)				Adds a new provider.
 *	update($person, $type)			Updates an existing provider.
 *	delete($person, $type)			Deletes an existing provider.
 *	getSize()						Number of providers.
 *	isEmpty() 						True if no elements exist, false otherwise.
 */
class Providers extends Persons
{
	private $providers;	// Array of providers.

	// Displayed after use.
	const NOT_FOUND_MESSAGE = "ERROR: No provider found<br>";
	const ADD_SUCCESSFUL = "Provider added, number is";
	const UPDATE_SUCCESSFUL = "Provider updated<br>";
	const ADD_FAIL          = "Provider can not be added<br>";
	const UPDATE_FAIL       = "Provider can not be updated<br>";

	/**
	 * Providers constructor.
	 * Creates a new SplObjectStorage().
	 */
	public function __construct()
	{
		parent::__construct();
		$this->providers = new SplObjectStorage();
	}

	/**
	 * Finds a member by a particular number.
	 * @param $number
	 * @return Provider|string
	 */
	public function findByNumber($number)
	{
		$databaseProvider = DatabaseController::selectProvider($number);
		if (count($databaseProvider) == 0) return self::NOT_FOUND_MESSAGE;

		$provider = $this->newProvider($databaseProvider[0]);
		$this->providers->attach($provider);
		return $provider;
	}

	/**
	 * Get all the provider in a specific city.
	 * @param $name
	 * @return string
	 * @internal param $city
	 */
	public function findByName($name)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();
			if ($provider->getName() == $name) $temp->attach($provider);
			$this->providers->next();
		}
		$this->providers = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Get all the provider in a specific city.
	 * @param $city
	 * @return string
	 */
	public function findByCity($city)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();
			if ($provider->getCity() == $city) $temp->attach($provider);
			$this->providers->next();
		}
		$this->providers = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Find providers with their speciality.
	 * @param $type
	 * @return string
	 */
	public function findByType($type)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();
			if ($provider->getType() == $type) $temp->attach($provider);
			$this->providers->next();
		}
		$this->providers = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Find all providers in a specific province.
	 * @param $province
	 * @return string
	 */
	public function findByProvince($province)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;
		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();
			if ($provider->getProvince() == $province) $temp->attach($provider);
			$this->providers->next();
		}
		$this->providers = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Get all the providers and store them in '$this->providers' SplObjectStorage.
	 * Call 'Person.class' functions on the returned object to get all the fields.
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
		$this->providers = new SplObjectStorage();
		$databaseProviders = DatabaseController::selectProviders();

		foreach ($databaseProviders as $databaseProvider)
		{
			$this->providers->attach($this->newProvider($databaseProvider));
		}
		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Adds a new provider to the database. Uses addProvider method of DatabaseController
	 * @param Provider $provider
	 * @return bool|string
	 */
	public function add(Provider $provider)
	{
		$result = DatabaseController::addProvider($provider->getName(),
		$provider->getStreet(),   $provider->getCity(),
		$provider->getProvince(), $provider->getPostalCode(),
		$provider->getEmail(),    $provider->getType());

		return ($result == false) ? self::ADD_FAIL : $result;
	}

	/**
	 * Updates existing provider in the database. Uses updateProvider method of DatabaseController.
	 * @param Provider $provider with new values.
	 * @return string
	 */
	public function update(Provider $provider)
	{
		// Check if the provider exists in the database first.
		if (!$this->providerExists($provider->getNumber())) return self::NOT_FOUND_MESSAGE;

		$result = DatabaseController::updateProvider(
			$provider->getNumber(),   $provider->getName(),
			$provider->getStreet(),   $provider->getCity(),
			$provider->getProvince(), $provider->getPostalCode(),
			$provider->getEmail(),    $provider->getType());

		return ($result == true) ? self::UPDATE_SUCCESSFUL : self::UPDATE_FAIL;
	}

	/**
	 * Deletes a provider with a particular number
	 * @param $providerNumber
	 * @return string
	 */
	public function delete($providerNumber)
	{
		// Check if the provider exists in the database first.
		if (!$this->providerExists($providerNumber)) return self::NOT_FOUND_MESSAGE;

		$result = DatabaseController::deleteProvider($providerNumber);

		return ($result == true) ? self::UPDATE_SUCCESSFUL : self::UPDATE_FAIL;
	}

	/**
	 * Check if providers array is empty.
	 * @return bool
	 */
	public function isEmpty()
	{
		return (count($this->providers) == 0) ? true : false;
	}

	/**
	 * Return true if a provider exists, false otherwise.
	 * @param $providerNumber
	 * @return bool
	 */
	public function providerExists($providerNumber)
	{
		return DatabaseController::providerExists($providerNumber);
	}

	/**
	 * Builds a new provider object from the passed in array.
	 * @param $databaseProvider
	 * @return Provider
	 */
	private function newProvider($databaseProvider)
	{
		$provider = new Provider();
		$provider->setNumber($databaseProvider[DatabaseController::PROVIDER_NUMBER]);
		$provider->setName($databaseProvider[DatabaseController::PROVIDER_NAME]);
		$provider->setStreet($databaseProvider[DatabaseController::PROVIDER_STREET]);
		$provider->setCity($databaseProvider[DatabaseController::PROVIDER_CITY]);
		$provider->setProvince($databaseProvider[DatabaseController::PROVIDER_PROVINCE]);
		$provider->setPostalCode($databaseProvider[DatabaseController::PROVIDER_POSTAL]);
		$provider->setEmail($databaseProvider[DatabaseController::PROVIDER_EMAIL]);
		$provider->setType($databaseProvider[DatabaseController::PROVIDER_TYPE]);
		return $provider;
	}

	/**
	 * Returns a table for all the providers.
	 * @return string
	 */
	public function __toString()
	{
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$result = "<Table border=\"1\"><tr><th>Number</th><th>Name</th><th>Street</th><th>City</th>"
			. "<th>Province</th><th>Postal Code</th><th>Email</th><th>Type</th></tr>";


		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();

			$result .= "<tr><td>" . $provider->getNumber()  . "</td><td>" . $provider->getName()
				. "</td><td>" . $provider->getStreet()  . "</td><td>" . $provider->getCity()
				. "</td><td>" . $provider->getProvince(). "</td><td>" . $provider->getPostalCode()
				. "</td><td>" . $provider->getEmail()   . "</td><td>" . $provider->getType()
				. "</td></tr>";

			$this->providers->next();
		}
		$result .= "</Table>";

		return $result;
	}
}