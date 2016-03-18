<?php
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

	const MEMBER_STATUS_VALUES = array("SUSPENDED", "ACTIVE");
	const MEMBER_STATUS_HELP   = "The status has one of following values:\n
	 							  \tACTIVE\n
	 							  \tSUSPENDED";

	/**
	 * Gets the status of the member.
	 * @return mixed $status Status of member.
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Sets the status of the member to either "ACTIVE" or "SUSPENDED".
	 * @param $status Member
	 */
	public function setStatus($status)
	{
		// Make sure the value of status is valid.
		if (!in_array($status, self::MEMBER_STATUS_VALUES))
		{
			echo self::MEMBER_STATUS_HELP;
			return;
		}

		$this->status = $status;
	}
}