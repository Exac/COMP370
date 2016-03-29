<?php

//include_once('PersonMaintainer.class.php');

class MemberMaintainer extends PersonMaintainer
{
//	private $ui;
	private $member;
	public $message;

	public function __construct()
	{
		if (array_key_exists("new_member", $_POST))
		{
			$this->addMemberPost();
		}
		if (array_key_exists("delete_member", $_POST))
		{
			$this->deleteMember($_POST["member_number"]);
		}
		if (array_key_exists("update_member", $_POST))
		{
			$this->updateMemberPost();
		}
	}

	private function updateMemberPost()
	{
		DatabaseController::updateMember($_POST["member_number"], $_POST["member_name"], $_POST["member_street_address"], $_POST["member_city"], $_POST["member_province"], $_POST["member_postal_code"], $_POST["member_email_address"], $_POST["member_status"]);

		$this->message = $_POST["member_name"] . " updated.";
	}

//	public function updateMember($number, $name, $street, $city, $province, $postal, $email, $status)
//	{
//
//	}
	
	private function addMemberPost()
	{
		$this->addMember($_POST["member_name"], $_POST["member_street_address"], $_POST["member_city"], $_POST["member_province"], $_POST["member_postal_code"], $_POST["member_email_address"], $_POST["member_status"]);

		$this->message = $_POST["member_name"] . " added to the member database.";
	}

	public function addMember($name, $street, $city, $province, $postal, $email, $status)
	{

		$this->member = new Member(DatabaseController::getNextIndex('provider'));

		$this->member->setName($name);
		$this->member->setStreet($street);
		$this->member->setCity($city);
		$this->member->setProvince($province);
		$this->member->setPostalCode($postal);
		$this->member->setEmail($email);
		$this->member->setStatus($status);

		$this->member->toDatabase();
	}
	
	public function editMember()
	{
		
	}

	public function deleteMember($number)
	{
		DatabaseController::deleteMember($number);

		$this->message = $_POST["member_name"] . " removed from the member database.";
	}
	
	public function main()
	{
		
	}

	public function getMessage()
	{

	}
}