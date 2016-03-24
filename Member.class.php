<?php
include_once('Person.class.php');
/**
 * Class Member
 *
 * @date 10-3-2016
 *
 * A Member is part of the Person class. A member has all the attribute of a person.
 * In addition a member has a status which can be either "ACTIVE" or "SUSPENDED".
 */
class Member extends Person
{
	private $status;

	public $MEMBER_STATUS_VALUES = null;
	public $MEMBER_STATUS_HELP = "The status has one of following values:\n
	 							  \tACTIVE\n
	 							  \tSUSPENDED";

	public function __construct($member_number = 1)
	{
		$this->MEMBER_STATUS_VALUES = array("SUSPENDED", "ACTIVE");
		$this->setNumber($member_number);
		$this->fromDatabase($this->getNumber());
	}

	/**
	 * Gets the status of the member.
	 * @return mixed $status Status of member.
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Sets the type for this provider.
	 * Sets the status of the member to either "ACTIVE" or "SUSPENDED".
	 * @param string $status Member
	 */
	public function setStatus($status)
	{
		// Make sure the value of status is valid.
		/*if (!in_array($status, $this->MEMBER_STATUS_VALUES))
		{
			echo $this->MEMBER_STATUS_HELP;
			return;
		}*/

		$this->status = $status;
	}

	public function fromDatabase($member_number)
	{
		if (DatabaseController::providerExists($member_number))
		{
			$md = DatabaseController::selectMember($member_number);
			//$this->setNumber($md["member_number"]); //mysql_real_escape_string strips leading 0's
			$this->setName($md["member_name"]);
			$this->setStreet($md["member_street_address"]);
			$this->setCity($md["member_city"]);
			$this->setProvince($md["member_province"]);
			$this->setPostalCode($md["member_postal_code"]);
			$this->setEmail($md["member_email_address"]);
			$this->setStatus($this->convertStatusLong($md["member_status"]));
		} else
		{
			UserInterface::errorMessage("Fatal Error: There is no member with number " . $member_number);
		}
	}

	private function convertStatusLong($status)
	{
		if (strtolower($status[0]) === "a")
		{
			return "ACTIVE";
		}
		if (strtolower($status[0]) === "s")
		{
			return "SUSPENDED";
		}
	}

	private function convertStatusShort($status)
	{
		if (strtolower($status[0]) === "a")
		{
			return "A";
		}
		if (strtolower($status[0]) === "s")
		{
			return "S";
		}
	}

	public function fromArray($arr)
	{
		$this->setNumber($arr["member_number"]);
		$this->setName($arr["member_name"]);
		$this->setStreet($arr["member_street_address"]);
		$this->setCity($arr["member_city"]);
		$this->setProvince($arr["member_province"]);
		$this->setPostalCode($arr["member_postal_code"]);
		$this->setEmail($arr["member_email_address"]);
		$this->setStatus($arr["member_status"]);
	}

	public function toJSON()
	{
		return $this->__toString();
	}

	public function __toString()
	{
		$f = '{"member_number":"' . $this->getNumber() . '", ' . '"member_name":"' . $this->getName() . '", ' . '"member_street_address":"' . $this->getStreet() . '", ' . '"member_city":"' . $this->getCity() . '", ' . '"member_province":"' . $this->getProvince() . '", ' . '"member_postal_code":"' . $this->getPostalCode() . '", ' . '"member_email_address":"' . $this->getEmail() . '", ' . '"member_status":"' . $this->convertStatusShort($this->getStatus()) . '"';
		$f .= '}';

		return $f;
	}

	public function fromJSON($json)
	{
		$this->fromString($json);
	}

	public function fromString($json)
	{
		$d = json_decode($json, true);
		$this->setNumber($d["member_number"]);
		$this->setName($d["member_name"]);
		$this->setStreet($d["member_street_address"]);
		$this->setCity($d["member_city"]);
		$this->setProvince(($d["member_province"]));
		$this->setPostalCode($d["member_postal_code"]);
		$this->setEmail($d["member_email_address"]);
		$this->setStatus($d["member_status"]);
	}
}