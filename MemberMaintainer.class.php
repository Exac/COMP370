<?php
include_once('PersonMaintainer.class.php');

class MemberMaintainer extends PersonMaintainer
{
	private $ui;
	private $member;

	public function __construct()
	{
		$this->ui = new UserInterface();
	}

	public function addMember($name, $street, $city, $province, $postal, $email, $status)
	{
		echo "In addMember()";

		$this->member = new Member(DatabaseController::getNextIndex('provider'));

		$this->member->setName($name);
		$this->member->setStreet($street);
		$this->member->setCity($city);
		$this->member->setProvince($province);
		$this->member->setPostalCode($postal);
		$this->member->setEmail($email);
		$this->member->setStatus($status);
	}
	
	public function editMember()
	{
		
	}
	
	public function deleteMember()
	{
		
	}
	
	public function main()
	{
		
	}
}