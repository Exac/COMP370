<?php
/**
 * Class Claim
 * 
 * @date 18-03-2016
 *
 * A claim class is associated with both Member and Provider. It has following attributes:
 *  submissionDateTime    Date the claim was submitted.
 *  serviceCode           Code for the service provided.
 *  providerNumber        Provider associated with the service.
 *  memberNumber          Member associated with the service.
 *  serviceDate           Date the service was provided.
 *  Comments              Any comments associated with the claim. Can be empty.
 */
class Claim 
{
    // Attributes
	private $submissionDateTime;    // Current, can be accessed with 'now'.
	private $serviceCode;
	private $providerNumber;
	private $memberNumber;
	private $serviceDate; #YYYY-MM-DD
    private $comments;

    // Attribute constraints
	const CODE_LENGTH      = 6;
    const COMMENT_LENGTH   = 100;
	const DATE_FORMAT      = 'Y-m-d';
	const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * Claim constructor.
     * A Provider and a Member must exist to create a new claim.
     * Sets the 'providerNumber' and 'memberNumber' fields for this class.
     * @param Provider $provider
     * @param Member $member
     */
    public function __construct($provider, $member)
	{
        $this->providerNumber = $provider;
        $this->memberNumber = $member;
	}

    /**
     * Gets the submission date and time for this claim.
     * @return mixed $submissionDateTime Claim
     */
	public function getSubmissionDateTime()
	{
		return $this->submissionDateTime;
	}

    /**
     * Gets the service date for this claim.
     * @return mixed $serviceDate Claim
     */
    public function getServiceDate()
    {
        return $this->serviceDate;
    }

    /**
     * Gets the provider number for this claim.
     * @return mixed $providerNumber Claim
     */
    public function getProviderNumber()
    {
        return $this->providerNumber;
    }

    /**
     * Gets the member number for this claim.
     * @return mixed $memberNumber Claim
     */
    public function getMemberNumber()
    {
        return $this->memberNumber;
    }

    /**
     * Gets the service code for this claim.
     * @return mixed $serviceCode Claim
     */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * Gets the comments associated with this claim.
     * @return mixed Claim
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Sets the submission date and time for this claim.
     * Submission date must not be empty and has a format of DATE_TIME_FORMAT.
     * @param $submissionDateTime
     */
    public function setSubmissionDateTime($submissionDateTime)
    {
        // Make sure the submission date is not empty.
        if (empty($submissionDateTime))
        {
            echo "ERROR: Submission date must not be empty.\n";
            return;
        }

        $this->submissionDateTime = $this->formatDateTime($submissionDateTime);
    }

    /**
     * Sets the service date for this claim.
     * Service date must not be empty and has a format of DATE_FORMAT.
     * @param $serviceDate
     */
    public function setServiceDate($serviceDate)
    {
        // Make sure the service date is not empty.
        if (empty($serviceDate))
        {
            echo "ERROR: Service date must not be empty.\n";
            return;
        }

        $this->serviceDate = $this->formatDate($serviceDate);
    }

    /**
     * Sets the provider number for this claim.
     * Requires a provider that already exists.
     * @param Provider $provider
     */
	public function setProviderNumber(Provider $provider)
    {
        // Make sure the provider field is not empty
        if (empty($provider))
        {
            echo "ERROR: Provider must be provided for this claim.\n";
            return;
        }

		$this->providerNumber = $provider->getNumber();
	}

    /**
     * Sets the member number for this claim.
     * Requires a member that already exists.
     * @param Member $member
     */
	public function setMemberNumber(Member $member)
    {
        // Make sure a provider is provided.
        if (empty($member))
        {
            echo "ERROR: Member must be provided for this claim.\n";
            return;
        }

		$this->memberNumber = $member->getNumber();
	}

    /**
     * Sets the service code for this claim.
     * Service code must be a non-empty integer and must be of CODE_LENGTH.
     * @param $serviceCode
     */
    public function setServiceCode($serviceCode)
    {
        // Service code must not be empty and must be an integer.
        if (empty($serviceCode) || !is_int($serviceCode))
        {
            echo "ERROR: Service code must not be empty and must be an integer.\n";
            return;
        }

        // Length of service code must be of CODE_LENGTH.
        if ($this->getLength($serviceCode) != self::CODE_LENGTH)
        {
            echo "ERROR: Length of service code must be equal to " . self::CODE_LENGTH . "\n";
            return;
        }

        $this->serviceCode = $serviceCode;
    }

    /**
     * Sets the comments for this claim.
     * Comments can be empty, but not more than COMMENT_LENGTH characters.
     * @param $comments
     */
    public function setComments($comments)
    {
        // Catch empty variable.
        if (empty($comments))
        {
            $this->comments = "";
            return;
        }

        // Length of comments must not exceed COMMENT_LENGTH.
        if ($this->getLength($comments) > self::COMMENT_LENGTH)
        {
            echo "ERROR: Length of comments must not exceed " . self::COMMENT_LENGTH . "\n";
            return;
        }

        $this->comments = $comments;
    }

    /**
     * An inner class to format the inputted date.
     * @param $date
     * @return bool|string
     */
    private function formatDate($date)
    {
        return date(self::DATE_FORMAT, strtotime($date));
    }

    /**
     * An inner method to format the inputted date and time.
     * @param $dateTime
     * @return bool|string
     */
    private function formatDateTime($dateTime)
    {
        return date(self::DATE_TIME_FORMAT, strtotime($dateTime));
    }

    /**
     * An inner method to determine the length of an integer or string.
     * @param $object
     * @return int
     */
    private function getLength($object)
    {
        return strlen((string) $object);
    }
}

