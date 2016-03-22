<?php
/**
 * Class Provider
 *
 * @date 17-3-2016
 *
 * A Provider is part of the Person class. It has all the attributes of a Person.
 * In addition, a Provider has a "type" attribute.
 */
class Provider extends Person
{
	private $type;

	public $PROVIDER_TYPES = null;
	const PROVIDER_TYPE_HELP = "A provider belongs to one of the following types <br>DIETITIAN <br>INTERNIST <br>EXERCISE_EXPERT";


	public function __construct($provider_number)
	{
		$this->PROVIDER_TYPES = ['DIETITIAN', 'INTERNIST', 'EXERCISE_EXPERT'];

		$this->setNumber($provider_number);
		//$this->fromDatabase($this->getNumber());
	}

	/**
	 * Gets the type for this provider.
	 * @return mixed $type Type of provider.
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Sets the type for this provider.
	 * The type must be one of "DIETITIAN", "INTERNIST" or "EXERCISE_EXPERT".
	 * @param string $type Provider
	 */
	public function setType($type)
	{
		// Check if the value of 'type' is valid.
		/*if (!in_array($type, $this->PROVIDER_TYPES))
		{
			echo self::PROVIDER_TYPE_HELP;
			return;
		}*/


		$this->type = $type;
	}

	public function fromDatabase($provider_number)
	{
		$md = DatabaseController::selectProvider($provider_number);

		$this->setNumber($md["provider_number"]);
		$this->setName($md["provider_name"]);
		$this->setStreet($md["provider_street_address"]);
		$this->setCity($md["provider_city"]);
		$this->setProvince($md["provider_province"]);
		$this->setPostalCode($md["provider_postal_code"]);
		$this->setEmail($md["provider_email_address"]);
		$this->setType($this->convertTypeLong($md["provider_type"]));
	}

	private function convertTypeLong($type)
	{
		if (strtolower($type[0]) === "d")
		{
			return "DIETITIAN";
		}
		if (strtolower($type[0]) === "i")
		{
			return "INTERNIST";
		}
		if (strtolower($type[0]) === "e")
		{
			return "EXERCISE_EXPERT";
		}

		return false;
	}

	private function convertTypeShort($type)
	{
		if (strtolower($type[0]) === "d")
		{
			return "D";
		}
		if (strtolower($type[0]) === "i")
		{
			return "I";
		}
		if (strtolower($type[0]) === "e")
		{
			return "E";
		}

		return false;
	}

	public function fromArray($arr)
	{
		$this->setNumber($arr["provider_number"]);
		$this->setName($arr["provider_name"]);
		$this->setStreet($arr["provider_street_address"]);
		$this->setCity($arr["provider_city"]);
		$this->setProvince($arr["provider_province"]);
		$this->setPostalCode($arr["provider_postal_code"]);
		$this->setEmail($arr["provider_email_address"]);
		$this->setType($arr["provider_type"]);
	}

	public function toJSON()
	{
		return $this->__toString();
	}

	public function __toString()
	{
		$f = '{"provider_number":' . $this->getNumber() . ', ' . '"provider_name":"' . $this->getName() . '", ' . '"provider_street_address":"' . $this->getStreet() . '", ' . '"provider_city":"' . $this->getCity() . '", ' . '"provider_province":"' . $this->getProvince() . '", ' . '"provider_postal_code":"' . $this->getPostalCode() . '", ' . '"provider_email_address":"' . $this->getEmail() . '", ' . '"provider_type":"' . $this->convertTypeShort($this->getType()) . '"';
		$f .= '}';

		return $f;
	}

	public function fromJSON($json)
	{
		$this->fromString($json);
	}

	public function fromString($json)
	{
		echo $json;

		$d = json_decode($json, true);
		var_dump($d);

		$this->setNumber($d["provider_number"]);
		$this->setName($d["provider_name"]);
		$this->setStreet($d["provider_street_address"]);
		$this->setCity($d["provider_city"]);
		$this->setProvince(($d["provider_province"]));
		$this->setPostalCode($d["provider_postal_code"]);
		$this->setEmail($d["provider_email_address"]);
		$this->setType($d["provider_type"]);
	}
}
	
