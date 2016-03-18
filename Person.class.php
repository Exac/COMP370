<?php
/**
 * Person
 * 
 * @date 10-3-2016
 * This is a Person class that can be 
 * extended by Provider & Member.
 */
class Person
{
	// Person attributes.
	private $number;
	private $name;
	private $street;
	private $city;
	private $province;
	private $postalCode;
	private $email;

	const nextNumber = 0;#TODO CHANGE. This can't be const
	const NUMBER_LENGTH = 6;
	const SEPARATOR = '-';
	const NAME_LENGTH = 25;
	const STREET_LENGTH = 25;
	const CITY_LENGTH = 14;
	const PROVINCE_LENGTH = 2;
	const POSTAL_CODE_LENGTH = 6;

	function __construct()
	{
		
	}

	/**
	 * Gets the number for this person.
	 * @return mixed $number the number of this person.
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * Adds a number for this person.
	 * Number is an integer and a maximum length of NUMBER_LENGTH.
	 * @param $number Number to be added for this person.
	 */
	public function setNumber($number)
	{
		// Make sure the number is an integer.
		if (!is_int($number)) {
			echo "ERROR: Please make sure the number is an integer.";
		}

		// Make sure the length is equal to NUMBER_LENGTH.
		if ($this->getLength($number) != self::NUMBER_LENGTH) {
			echo "ERROR: Please enter a 6 digit number.";
		}

		$this->number = $number;
	}

	/**
	 * gets the name of this person.
	 * @return mixed $name The name of this person.
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Adds the name of this person.
	 * Name has a maximum length of NAME_LENGTH.
	 * @param $name Name to be added for this person.
	 */
	public function setName($name)
	{
		// Make sure the length of the name is less than NAME_LENGTH.
		if ($this->getLength($name) > self::NAME_LENGTH) {
			echo "Please make sure the length of the name is less than 25 characters.";
		}

		$this->name = $name;
	}

	/**
	 * Gets the street name for this person.
	 * @return mixed $street The street of this person.
	 */
	public function getStreet()
	{
		return $this->street;
	}

	/**
	 * Adds the street name for this person.
	 * Street has maximum length of STREET_LENGTH.
	 * @param $street Street name to be added for this person.
	 */
	public function setStreet($street)
	{
		// Make sure the length of the street is less than STREET_LENGTH.
		if ($this->getLength($street) > self::STREET_LENGTH) {
			echo "Please make sure the length of the name is not greater than 25 characters.";
		}

		$this->street = $street;
	}

	/**
	 * Gets the city name for this person.
	 * @return mixed $city City name of this person.
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * Adds the city for this person.
	 * City has a maximum length of CITY_LENGTH.
	 * @param $city
	 */
	public function setCity($city)
	{
		// Make sure the length of the city is less than CITY_LENGTH.
		if ($this->getLength($city) > self::CITY_LENGTH) {
			echo "Please make sure the length of the city is not greater than 14 characters.";
		}

		$this->city = $city;
	}

	/**
	 * Gets the province name of this person.
	 * @return mixed $province Province pf this person.
	 */
	public function getProvince()
	{
		return $this->province;
	}

	/**
	 * Adds the province for this person.
	 * Province has a maximum length of PROVINCE_LENGTH.
	 * Province is added as an abbreviation.
	 * @param $province
	 */
	public function setProvince($province)
	{
		// Make sure the length of the province is less than PROVINCE_LENGTH.
		if ($this->getLength($province) > self::PROVINCE_LENGTH) {
			echo "Please make sure the length of the province is not greater than 2 characters.";
		}

		$this->province = $province;
	}

	/**
	 * Gets the postal code for this person.
	 * @return mixed $postalCode Postal code for this person.
	 */
	public function getPostalCode()
	{
		return $this->postalCode;
	}

	/**
	 * Adds the postal code for this person.
	 * Postal code has a maximum length of POSTAL_CODE_LENGTH.
	 * @param $postalCode
	 */
	public function setPostalCode($postalCode)
	{
		// Make sure the length of the postal code is not greater than than POSTAL_CODE_LENGTH.
		if ($this->getLength($postalCode) > self::POSTAL_CODE_LENGTH) {
			echo "Please make sure the length of the postal code is not greater than 2 characters.";
		}

		$this->postalCode = $postalCode;
	}

	/**
	 * Gets the email for this person.
	 * @return mixed $email Email of this person.
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Adds the email for this person.
	 * Email has a maximum length of EMAIL_LENGTH.
	 * @param $email
	 */
	public function setEmail($email)
	{
		// Make sure the length of the email is not greater than than EMAIL_LENGTH.
		if ($this->getLength($email) > self::EMAIL_LENGTH) {
			echo "Please make sure the length of the email is not greater than 2 characters.";
		}

		$this->email = $email;
	}

	/**
	 * An internal function to get the length of a string or an integer.
	 * @param $object The object for which the length is required.
	 * @return int    The length of the object.
	 */
	private function getLength($object)
	{
		return strlen((string)$object);
	}
}