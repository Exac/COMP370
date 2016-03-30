<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * Claims
 *
 * @date 10-3-2016
 *
 */
class Claims
{
	private $claims;
	private $size;

	const NOT_FOUND_MESSAGE = "No claim found<br>";
	const ADD_SUCCESSFUL = "Claim added<br>";
	const ADD_FAIL = "Claim can not be added<br>";

	private function __construct()
	{
		$this->claims = new SplObjectStorage();
		$this->size = 0;
	}

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

	public function getSize()
	{
		return $this->size;
	}

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

	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

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