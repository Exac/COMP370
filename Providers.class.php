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
class Providers
{
	private $providers;	// Array of providers.
	private $size = 0;	// Size of providers array.

	// Displayed when a provider is not found.
	const NOT_FOUND_MESSAGE = "ERROR: No provider found<br>";

	public function __construct()
	{
		$this->providers = new SplObjectStorage();
	}

	/**
	 * Find a provider by number.
	 * @param $number
	 * @return string
	 */
	public function findByNumber($number)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();

			if ($provider->getNumber() == $number)
			{
				$temp->attach($provider);
				$this->size++;
			}

			$this->providers->next();
		}

		$this->providers = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Find providers with their name.
	 * @param $name
	 * @return string
	 */
	public function findByName($name)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();

			if ($provider->getName() == $name)
			{
				$temp->attach($provider);
				$this->size++;
			}

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

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();

			if ($provider->getCity() == $city)
			{
				$temp->attach($provider);
				$this->size++;
			}

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

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();

			if ($provider->getType() == $type)
			{
				$temp->attach($provider);
				$this->size++;
			}

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

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->providers->rewind();
		while ($this->providers->valid())
		{
			$provider = $this->providers->current();

			if ($provider->getProvince() == $province)
			{
				$temp->attach($provider);
				$this->size++;
			}

			$this->providers->next();
		}

		$this->providers = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Get all the providers and store them in '$this->providers' SplObjectStorage.
	 */
	public function getAll()
	{
		$databaseProviders = DatabaseController::selectProviders();

		$size = count($databaseProviders);

		for ($i = 0; $i < $size; $i++)
		{
			$databaseProvider = $databaseProviders[$i];

			$provider = new Provider($databaseProvider[DatabaseController::PROVIDER_NUMBER]);

			$provider->setName($databaseProvider[DatabaseController::PROVIDER_NAME]);
			$provider->setStreet($databaseProvider[DatabaseController::PROVIDER_STREET]);
			$provider->setCity($databaseProvider[DatabaseController::PROVIDER_CITY]);
			$provider->setProvince($databaseProvider[DatabaseController::PROVIDER_PROVINCE]);
			$provider->setPostalCode($databaseProvider[DatabaseController::PROVIDER_POSTAL]);
			$provider->setEmail($databaseProvider[DatabaseController::PROVIDER_EMAIL]);
			$provider->setType($databaseProvider[DatabaseController::PROVIDER_TYPE]);

			$this->providers->attach($provider);

			$this->size++;
		}

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	/**
	 * Add a new provider.
	 * @param $provider
	 */
	public function add(Provider $provider)
	{
		#TODO: Add functionality to DatabaseController first
	}

	/**
	 * Update an existing provider.
	 * @param $provider
	 */
	public function update(Provider $provider)
	{
		#TODO: Add functionality to Database controller first
	}

	/**
	 * Delete an existing provider.
	 * @param $provider
	 */
	public function delete(Provider $provider)
	{
		#TODO: Add functionality to Database controller first
	}

	/**
	 * The size of providers array.
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Set the size of providers array.
	 */
	private function setSize()
	{
		$this->size = count($this->providers);
	}

	/**
	 * Check if providers array is empty.
	 * @return bool
	 */
	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
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