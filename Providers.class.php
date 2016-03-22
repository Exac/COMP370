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

	/**
	 * Find a provider by number.
	 * @param $number
	 */
	public function findByNumber($number)
	{
		$this->providers = DatabaseController::selectProvider($number);
		$this->setSize();
	}

	/**
	 * Find providers with their name.
	 * @param $name
	 */
	public function findByName($name)
	{
		$this->providers = DatabaseController::findProvider($name);
		$this->setSize();
	}

	/**
	 * Get all the provider in a specific city.
	 * @param $city
	 */
	public function findByCity($city)
	{
		$this->providers = DatabaseController::findProvider($city);
		$this->setSize();
	}

	/**
	 * Find providers with their speciality.
	 * @param $type
	 */
	public function findByType($type)
	{
		$this->providers = DatabaseController::findProvider($type);
		$this->setSize();
	}

	/**
	 * Find all providers in a specific province.
	 * @param $province
	 */
	public function findByProvince($province)
	{
		$this->providers = DatabaseController::findProvider($province);
		$this->setSize();
	}

	/**
	 * Get all the providers.
	 */
	public function getAll()
	{
		$this->providers = DatabaseController::selectProviders();
		$this->setSize();
	}

	/**
	 * Add a new provider.
	 * @param $provider
	 */
	public function add($provider)
	{
		#TODO: Add functionality to DatabaseController first
	}

	/**
	 * Update an existing provider.
	 */
	public function update()
	{
		#TODO: Add functionality to Database controller first
	}

	/**
	 * Delete an existing provider.
	 */
	public function delete()
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
		for ($i = 0; $i < $this->size; $i++)
		{
			$provider = $this->providers[$i];
			$result .= "<tr><td>" . $provider[DatabaseController::PROVIDER_NUMBER]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_NAME]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_STREET]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_CITY]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_PROVINCE]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_POSTAL]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_EMAIL]
					. "</td><td>" . $provider[DatabaseController::PROVIDER_TYPE]
					. "</td></tr>";
		}
		$result .= "</Table>";

		return $result;
	}
}