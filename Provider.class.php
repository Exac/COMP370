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


	public function __construct()
	{
		$this->PROVIDER_TYPES = ['DIETITIAN', 'INTERNIST', 'EXERCISE_EXPERT'];
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
	 * @param $type Provider
	 */
	public function setType($type)
	{
		// Check if the value of 'type' is valid.
		if (!in_array($type, $this->PROVIDER_TYPES))
		{
			echo self::PROVIDER_TYPE_HELP;
			return;
		}

		$this->type = $type;
	}
}
	
