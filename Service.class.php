<?php

/**
 * Class Service
 *
 * @date 18-03-2016
 *
 * A service is provided by the provider and received by the member. It has following attributes:
 * 	code    Fixed length of 6 digits
 * 	name    Max length of 20
 * 	fee     Max value of 999999
 * Each of the attributes has a getter and setter associated with them.
 */
 
class Service
{
	// Service attributes.
	public $code;
	public $name;
	public $fee;

	const CODE_LENGTH = 6;
	const NAME_LENGTH = 20;
	const MAX_FEE     = 999999;
	const SEPARATOR   = '.';

	/**
	 * Gets the code for this service.
	 * @return mixed Service
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * Gets the name for this Service.
	 * @return mixed Service
	 */
	public function getName() 
	{
		return $this->name;
	}

	/**
	 * Gets the fee for this service in decimal form (two places).
	 * @return mixed Service
	 */
	public function getFee()
	{
		return $this->fee;
	}

	/**
	 * Adds a 6 digit integer code for this service.
	 * @param $code Service
	 */
	public function setCode($code)
	{
		// Make sure the code is not empty and is an integer.
		if (empty($code) || !is_int($code))
		{
			echo "ERROR: Code must be an integer and not empty.";
			return;
		}

		// Make sure the length of code is no greater than CODE_LENGTH.
		if ($this->getLength($code) != self::CODE_LENGTH)
		{
			echo "ERROR: Code length must be 6 digit long.";
			return;
		}

		$this->code = $code;
	}

	/**
	 * Adds a name for this service.
	 * The name must not be greater than NAME_LENGTH
	 * @param $name Service
	 */
	public function setName($name)
	{
		// Make sure the name is not empty.
		if (empty($name))
		{
			echo "ERROR: Service name can not be empty.";
			return;
		}

		// Make sure the length of name is not greater than NAME_LENGTH.
		if ($this->getLength($name) > self::NAME_LENGTH)
		{
			echo "ERROR: Length of service name can not be greater than 20 characters.";
			return;
		}

		$this->name = $name;
	}

	/**
	 * Adds the fee for this service.
	 * The fee must be a numeric value no greater than MAX_FEE.
	 * @param $fee Service
	 */
	public function setFee($fee)
	{
		// Make sure the fee is not empty and is numeric.
		if (empty($fee) || !is_numeric($fee))
		{
			echo "ERROR: Fee value can not be empty and must be numeric";
			return;
		}

		// Format fee to two decimal places. eg. '3232.12'
		$fee = number_format($fee, 2, self::SEPARATOR, '');

		// Make sure the value of fee is no greater than MAX_FEE.
		if ($fee > self::MAX_FEE)
		{
			echo "ERROR: Fee can not be greater than 999999.";
			return;
		}

		$this->fee = $fee;
	}

	/**
	 * An inner method to find the length of an integer or string.
	 * @param $object
	 * @return int
	 */
	private function getLength($object)
	{
		return strlen((string) $object);
	}
}