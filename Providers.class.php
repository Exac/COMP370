<?php
/**
 * Providers
 * 
 * @date 10-3-2016
 * @desc Providers, extends Persons. An array of Providers.
 */
class Providers
{

	private $providers;	// Array of providers.
	private $size;		// Size of providers array.


	// Displayed when a provider is not found.
	const NOT_FOUND_MESSAGE = "ERROR: No providers found<br>";

	public function findByNumber($number)
	{
		$this->providers = DatabaseController::selectProvider($number);

		$this->setSize();

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	public function findByName($name)
	{
		$this->providers = DatabaseController::findProvider($name);

		$this->setSize();

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	public function findByCity($city)
	{
		$this->providers = DatabaseController::findProvider($city);

		$this->setSize();

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	public function findByType($type)
	{
		$this->providers = DatabaseController::findProvider($type);

		$this->setSize();

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	public function findByProvince($province)
	{
		$this->providers = DatabaseController::findProvider($province);

		$this->setSize();

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	public function getAll()
	{
		$this->providers = DatabaseController::selectProviders();

		$this->setSize();

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->providers;
	}

	public function add($provider)
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
		$this->size = count($this->providers);
	}

	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	public function __toString()
	{
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
					. "</tr>";
		}
		$result .= "</Table>";

		return $result;
	}
}