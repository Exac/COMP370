<?php
/**
 * Person
 * 
 * @date 10-3-2016
 * This is a Person class that can be 
 * extended by Provider & Member.
 */
class Person
{
	private $number;
	private $name;
	private $street;
	private $city;
	private $state;
	private $zip;
	private $email;
	
	const $nextNumber = 0;#TODO CHANGE. This can't be const
	const $SEPARATOR = '-';
	const $NAME_LENGTH = 25;
	const $STREET_LENGTH = 25;
	const $CITY_LENGTH = 14;
	const $STATE_LENGTH = 2;
	const $ZIP_LENGTH = 5;
	
	function __construct ()
	{
		
	}
	
	public function getNumber(){
		return $this->number;
	}

	public function setNumber($number){
		$this->number = $number;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getStreet(){
		return $this->street;
	}

	public function setStreet($street){
		$this->street = $street;
	}

	public function getCity(){
		return $this->city;
	}

	public function setCity($city){
		$this->city = $city;
	}

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function getZip(){
		return $this->zip;
	}

	public function setZip($zip){
		$this->zip = $zip;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	
	
}