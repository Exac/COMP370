<?php
/**
 * Persons
 * 
 * @date 10-3-2016
 * Array of Persons
 */
class Persons
{
	private $persons;
	private $size;

	const MEMBER = "Member";
	const PROVIDER = "Provider";

	const NOT_FOUND_MESSAGE = "ERROR: No person found<br>";

	public function findByNumber($number)
	{
		$this->persons = DatabaseController::selectProvider($number);
		$this->setSize();
		$this->addType(self::PROVIDER, $this->size);

		$this->persons .= DatabaseController::selectMember($number);
		$this->setSize();
		$this->addType(self::MEMBER, $this->size);

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	public function findByName($name)
	{
		$this->persons = DatabaseController::findProvider($name);
		$this->setSize();
		$this->addType(self::PROVIDER, $this->size);

		$this->persons .= DatabaseController::findMember($name);
		$this->setSize();
		$this->addType(self::MEMBER, $this->size);

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	public function findByCity($city)
	{
		$this->persons = DatabaseController::findProvider($city);
		$this->setSize();
		$this->addType(self::PROVIDER, $this->size);

		$this->persons .= DatabaseController::findMember($city);
		$this->setSize();
		$this->addType(self::MEMBER, $this->size);

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	public function findByProvince($province)
	{
		$this->persons = DatabaseController::findProvider($province);
		$this->setSize();
		$this->addType(self::PROVIDER, $this->size);

		$this->persons .= DatabaseController::findMember($province);
		$this->setSize();
		$this->addType(self::MEMBER, $this->size);

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->persons;
	}

	public function getAll()
	{
		$this->persons = DatabaseController::selectProviders();
		$this->setSize();
		$this->addType(self::PROVIDER, $this->size);

		$this->persons .= DatabaseController::selectMembers();
		$this->setSize();
		$this->addType(self::MEMBER, $this->size);

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

	public function getSize()
	{
		return $this->size;
	}

	private function setSize()
	{
		$this->size = count($this->persons);
	}

	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	private function addType($type, $size)
	{
		if ($this->isEmpty()) return;

		for ($i = 0; $i < $size; $i++) array_push($this->persons[$i], $type);
	}

	public function __toString()
	{
		$result = "<Table border=\"1\"><tr><th>Number</th><th>Name</th><th>Street</th><th>City</th>"
				. "<th>Province</th><th>Postal Code</th><th>Email</th><th>Type</th></tr>";
		for ($i = 0; $i < $this->size; $i++)
		{
			$person = $this->persons[$i];
			$type   = $this->persons[$i][0];

			$result .= "<tr><td>" . ($type == "member") ? $person[DatabaseController::MEMBER_NUMBER]   : $person[DatabaseController::PROVIDER_NUMBER]
					. "</td><td>" . ($type == "member") ? $person[DatabaseController::MEMBER_NAME]     : $person[DatabaseController::PROVIDER_NAME]
					. "</td><td>" . ($type == "member") ? $person[DatabaseController::MEMBER_STREET]   : $person[DatabaseController::PROVIDER_STREET]
					. "</td><td>" . ($type == "member") ? $person[DatabaseController::MEMBER_CITY]     : $person[DatabaseController::PROVIDER_CITY]
					. "</td><td>" . ($type == "member") ? $person[DatabaseController::MEMBER_PROVINCE] : $person[DatabaseController::PROVIDER_PROVINCE]
					. "</td><td>" . ($type == "member") ? $person[DatabaseController::MEMBER_POSTAL]   : $person[DatabaseController::PROVIDER_POSTAL]
					. "</td><td>" . ($type == "member") ? $person[DatabaseController::MEMBER_EMAIL]    : $person[DatabaseController::PROVIDER_EMAIL]
					. "</td><td>" . $person[0] . "</tr>";
		}
		$result .= "</Table>";

		return $result;
	}
}