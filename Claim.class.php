<?php
/**
 * Claim
 * 
 * @date 10-3-2016
 * This is a test class.
 */
class Claim 
{
	private $submissionDate;
	private $serviceCode;
	private $providerNumber;
	private $memberNumber;
	private $serviceDate; #YYYY-MM-DD
	
	const $CODE_LENGTH = 9;
	const $DATE_FORMAT = "YYY-MM-DD";
	const $DATE_TIME_FOTMAT = "YYYY-MM-DD HH:MM:SS";
	const $SEPARATOR = '-';
	
	public $dateFormatter; #TODO implement this.
	
	function __construct() 
	{
		#overloaded twice
	}
	
	public function getSubmissionDate(){
		return $this->submissionDate;
	}

	public function setSubmissionDate($submissionDate){
		$this->submissionDate = $submissionDate;
	}

	public function getServiceCode(){
		return $this->serviceCode;
	}

	public function setServiceCode($serviceCode){
		$this->serviceCode = $serviceCode;
	}

	public function getProviderNumber(){
		return $this->providerNumber;
	}

	public function setProviderNumber($providerNumber){
		$this->providerNumber = $providerNumber;
	}

	public function getMemberNumber(){
		return $this->memberNumber;
	}

	public function setMemberNumber($memberNumber){
		$this->memberNumber = $memberNumber;
	}

	public function getServiceDate(){
		return $this->serviceDate;
	}

	public function setServiceDate($serviceDate){
		$this->serviceDate = $serviceDate;
	}
	
	public function __toString()
	{
	
	}
	
	public function fromString()
	{
		
	}
}

