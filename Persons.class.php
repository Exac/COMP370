<?php
/**
 * Persons
 * 
 * @date 10-3-2016
 * Array of Persons
 */
class Persons
{
	private $members;
	private $providers;
	private $size = 0;

	const MEMBER   = "Member";
	const PROVIDER = "Provider";

	const NOT_FOUND_MESSAGE = "ERROR: No person found<br>";

	public function findByNumber($number)
	{
		$this->providers = DatabaseController::selectProvider($number);
		$this->members   = DatabaseController::selectMember($number);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

	public function findByName($name)
	{
		$this->providers = DatabaseController::findProvider($name);
		$this->members   = DatabaseController::findMember($name);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

	public function findByCity($city)
	{
		$this->providers = DatabaseController::findProvider($city);
		$this->members   = DatabaseController::findMember($city);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

	public function findByProvince($province)
	{
		$this->providers = DatabaseController::findProvider($province);
		$this->members   = DatabaseController::findMember($province);

		$this->addProviderLabel(self::PROVIDER, count($this->providers));
		$this->addMemberLabel(self::MEMBER, count($this->members));

		$this->setSize();
	}

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

	public function getSize()
	{
		return $this->size;
	}

	private function setSize()
	{
		$this->size = count($this->providers) + count($this->providers);
	}

	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	private function addProviderLabel($type, $size)
	{
		if ($size == 0) return;

		for ($i = 0; $i < $size; $i++) array_push($this->providers[$i], $type);
	}

	private function addMemberLabel($type, $size)
	{
		if ($size == 0) return;

		for ($i = 0; $i < $size; $i++) array_push($this->members[$i], $type);
	}

	public function __toString()
	{
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
				. "</td><td>" . $provider[0] . "</tr>";
		}

		for ($i = 0; $i < count($this->members); $i++)
		{
			$provider = $this->members[$i];
			$result .= "<tr><td>" . $provider[DatabaseController::MEMBER_NUMBER]
				. "</td><td>" . $provider[DatabaseController::MEMBER_NAME]
				. "</td><td>" . $provider[DatabaseController::MEMBER_STREET]
				. "</td><td>" . $provider[DatabaseController::MEMBER_CITY]
				. "</td><td>" . $provider[DatabaseController::MEMBER_PROVINCE]
				. "</td><td>" . $provider[DatabaseController::MEMBER_POSTAL]
				. "</td><td>" . $provider[DatabaseController::MEMBER_EMAIL]
				. "</td><td>" . $provider[0] . "</tr>";
		}
		$result .= "</Table>";

		return $result;
	}
}