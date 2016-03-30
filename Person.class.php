<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * Class Person
 * 
 * @date 10-3-2016
 *
 * A Person consists of either a Member or a Provider. A person has following attributes:
 * 		Number				Max length is 9
 * 		Name				Max length is 25
 * 		Street				Max length is 25
 * 		City				Max length is 14
 * 		Province			Max length is 2
 * 		Postal code			Max length is 6
 * 		Email				Can be of any length
 * Each of the above attributes can be accessed using getter methods and edited using setter methods.
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

	//const nextNumber       = 0;#TODO CHANGE. This can't be const
	const NUMBER_LENGTH      = 9;
	const NAME_LENGTH        = 25;
	const STREET_LENGTH      = 25;
	const CITY_LENGTH        = 14;
	const PROVINCE_LENGTH    = 2;
	const POSTAL_CODE_LENGTH = 7;

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
	 * @param $number number Person
	 */
	public function setNumber($number)
	{
		// Make sure the number is an integer and is not empty.
		// We MUST use is_numeric instead of is_int because they are stored in the database like
		// "000000001". is_int(000000001) fails, is_numeric(000000001) passes.
		if (!is_numeric($number) || !isset($number))
		{
			echo "ERROR: Please make sure the number is an integer and is not empty (${number}).\n";
			return;
		}

		//Make sure number is not 0.
		try
		{
			if ($number === 0)
			{
				throw new Exception("Error: Zero is an invalid member number.");
			}
		} catch (Exception $e)
		{
			echo $e->getMessage(), "\n";
			$number = 1;
		}

		// Make sure the length is equal to NUMBER_LENGTH.
		if (!($this->getLength($number) === self::NUMBER_LENGTH))
		{
			//ERROR: Length of number must be equal to " . self::NUMBER_LENGTH
			$this->number = $this->pad($number);
		} else
		{
			$this->number = $number;
		}
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
	 * @param $name string Person
	 */
	public function setName($name)
	{
		// Make sure the name is not empty.
		if (empty($name))
		{
			echo "ERROR: The name can not be empty.\n";
			return;
		}

		// Make sure the length of the name is less than NAME_LENGTH.
		if ($this->getLength($name) > self::NAME_LENGTH)
		{
			echo "Length of name must not be greater than " . self::NAME_LENGTH . "\n";
			return;
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
	 * @param $street string Person
	 */
	public function setStreet($street)
	{
		// Make sure the street is not empty.
		if (empty($street))
		{
			echo "ERROR: The street can not be empty.\n";
			return;
		}

		// Make sure the length of the street is less than STREET_LENGTH.
		if ($this->getLength($street) > self::STREET_LENGTH)
		{
			echo "Length of street name must not be greater than " . self::STREET_LENGTH . "\n";
			return;
		}

		$this->street = $street;
	}

	/**
	 * Gets the city name for this person.
	 * @return mixed string $city City name of this person.
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * Adds the city for this person.
	 * City has a maximum length of CITY_LENGTH.
	 * @param $city string Person
	 */
	public function setCity($city)
	{
		// Make sure the city is not empty.
		if (empty($city))
		{
			echo "ERROR: The city can not be empty.\n";
			return;
		}

		// Make sure the length of the city is less than CITY_LENGTH.
		if ($this->getLength($city) > self::CITY_LENGTH)
		{
			echo "Length of city name must not be greater than " . self::CITY_LENGTH . "\n";
			//return;
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
	 * @param $province string Person
	 */
	public function setProvince($province)
	{
		// Make sure the province is not empty.
		if (empty($province))
		{
			echo "ERROR: The province can not be empty.\n";
			return;
		}

		// Make sure the length of the province is less than PROVINCE_LENGTH.
		if ($this->getLength($province) > self::PROVINCE_LENGTH)
		{
			$province = strtoupper($province);

			if ($province[0] === "A")
			{
				$province = "AB";
			}
			if ($province[0] === "B")
			{
				$province = "BC";
			}
			if ($province[0] === "C")
			{
				$province = "BC";
			}
			if ($province[0] === "M")
			{
				$province = "MB";
			}
			if ($province[0] === "N" && strpos($province, 'B' !== false))
			{
				$province = "NB";
			}
			if ($province[0] === "N" && strpos($province, 'L' !== false))
			{
				$province = "NL";
			}
			if ($province[0] === "N" && strpos($province, 'U') !== false)
			{
				$province = "NU";
			}
			if ($province[0] === "N" && $this->getLength($province) > self::PROVINCE_LENGTH)
			{
				$province = "NS";
			}
			if ($province[0] === "N" && strpos($province, 'T' !== false))
			{
				$province = "NT";
			}
			if ($province[0] === "O")
			{
				$province = "ON";
			}
			if ($province[0] === "C")
			{
				$province = "QC";
			}
			if ($province[0] === "S")
			{
				$province = "SK";
			}
			if ($province[0] === "Y")
			{
				$province = "YT";
			}

			//echo "Length of province must not be greater than " . self::PROVINCE_LENGTH . "\n";
			//return;
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
	 * @param $postalCode string Person
	 */
	public function setPostalCode($postalCode)
	{
		// Make sure the postal code is not empty.
		// We must use isset instead of empty because $x=123456;empty($x);//false
		if (!isset($postalCode))
		{
			echo "ERROR: The postal code can not be empty (${postalCode}).\n";
			return;
		}

		// Make sure the length of the postal code is not greater than POSTAL_CODE_LENGTH.
		if ($this->getLength($postalCode) > self::POSTAL_CODE_LENGTH)
		{
			echo "Length of postal code must not be greater than " . self::POSTAL_CODE_LENGTH . "(" . $postalCode . ")";
			return;
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
	 * @param $email Person
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * An internal function to get the length of a string or an integer.
	 * @param $object
	 * @return int    The length of the object.
	 */
	private function getLength($object)
	{
		return strlen((string)$object);
	}

	/**
	 * Pad a number with leading 0's. pad(5,9,0) -> 000000005
	 *
	 * @param $nu string
	 * @param $width int
	 * @param $z string
	 * @return string
	 */
	public function pad($nu, $width = 9, $z = '0')
	{
		return str_pad($nu, $width, $z, STR_PAD_LEFT);
	}
}
