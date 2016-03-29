<?php

/**
 * Claims Class
 *
 * @date 10-3-2016
 *
 * Claims are associated with a provider and a member. Claims class handles database operations.
 * It stores information being accessed into an array. And adds a new claim, deletes an existing claim.
 * Following operations are possible:
 *    findByProvider()    finds a claim by provider
 *    findByMember()        finds a claim by member.
 *    add()                adds a new claim.
 *    getAll()            gets all the claims in the database.
 *    getSize()            gets the size of the claims array.
 *    isEmpty()            checks if the claims array is empty.
 *
 */
class Claims
{
	// Claims attributes.
	private $claims;
	private $size;

	const NOT_FOUND_MESSAGE = "No claim found<br>";
	const ADD_SUCCESSFUL = "Claim added<br>";
	const ADD_FAIL = "Claim can not be added<br>";

	/**
	 * Claims constructor.
	 * Creates a new SplObjectStorage.
	 */
	private function __construct()
	{
		$this->claims = new SplObjectStorage();
		$this->size = 0;
	}

	/**
	 * Finds all the claims of a particular provider.
	 * @param $providerNumber
	 * @return SplObjectStorage|string
	 */
	public function findByProvider($providerNumber)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->claims->rewind();
		while ($this->claims->valid()) {
			$claim = $this->claims->current();

			if ($claim->getProviderNumber() == $providerNumber) {
				$temp->attach($claim);
				$this->size++;
			}

			$this->claims->next();
		}
		$this->claims = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->claims;
	}

	/**
	 * Finds all the claims of a particular member.
	 * @param $memberNumber
	 * @return SplObjectStorage|string
	 */
	public function findByMember($memberNumber)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;

		$temp = new SplObjectStorage();

		$this->claims->rewind();
		while ($this->claims->valid()) {
			$claim = $this->claims->current();

			if ($claim->getMemberNumber() == $memberNumber) {
				$temp->attach($claim);
				$this->size++;
			}

			$this->claims->next();
		}
		$this->claims = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->claims;
	}

	/**
	 * Adds a new claim to the database.
	 * @param Claim $claim
	 * @return string
	 */
	public function add(Claim $claim)
	{
		$result = DatabaseController::addClaim(
			$claim->getSubmissionDateTime(),
			$claim->getServiceDate(),
			$claim->getProviderNumber(),
			$claim->getMemberNumber(),
			$claim->getServiceCode(),
			$claim->getComments());

		return ($result == true) ? self::ADD_SUCCESSFUL : self::ADD_FAIL;
	}

	/**
	 * Returns the size of the claims array.
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Gets all the claims in the database.
	 * @return SplObjectStorage|string
	 */
	public function getAll()
	{
		$this->claims = new SplObjectStorage();
		$databaseClaims = DatabaseController::getAllClaims();

		$size = count($databaseClaims);

		for ($i = 0; $i < $size; $i++) {
			$databaseClaim = $databaseClaims[$i];
			$claim = new Claim($databaseClaim[DatabaseController::PROVIDER_NUMBER],
				$databaseClaim[DatabaseController::MEMBER_NUMBER]);

			$claim->setServiceCode($databaseClaim[DatabaseController::SERVICE_CODE]);
			$claim->setServiceDate($databaseClaim[DatabaseController::SERVICE_DATE]);
			$claim->setSubmissionDateTime($databaseClaim[DatabaseController::SUBMISSION_DATE_TIME]);
			$claim->setComments($databaseClaim[DatabaseController::COMMENTS]);

			$this->claims->attach($claim);
			$this->size++;
		}

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->claims;
	}

	/**
	 * Checks if the claims array is empty.
	 * @return bool
	 */
	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	/**
	 * Builds a table string off all the claims.
	 * @return string
	 */
	public function __toString()
	{
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$result = "<Table border=\"1\"><tr><th>Submission Date</th><th>Service Date</th>"
			. "<th>Provider</th><th>Member</th><th>Service</th><th>Comments</th></tr>";


		$this->claims->rewind();
		while ($this->claims->valid()) {
			$claim = $this->claims->current();

			$result .= "<tr><td>" . $claim->getSubmissionDateTime() . "</td><td>" . $claim->getServiceDate()
				. "</td><td>" . $claim->getProviderNumber() . "</td><td>" . $claim->getMemberNumber()
				. "</td><td>" . $claim->getServiceCode() . "</td><td>" . $claim->getComments()
				. "</td></tr>";

			$this->claims->next();
		}
		$result .= "</Table>";

		return $result;
	}
}