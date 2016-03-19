<?php

class ProviderMaintainer extends PersonMaintainer
{
	private $ui;
	private $provider;
	
	public function _construct()
	{
		
	}
	
	public function addProvider($name, $streetAddress, $city, $province, $postalCode, $email, $type)
	{
		$this->provider = new Provider();

		$this->provider->setName($name);
		$this->provider->setStreet($streetAddress);
		$this->provider->setCity($city);
		$this->provider->setProvince($province);
		$this->provider->setPostalCode($postalCode);
		$this->provider->setEmail($email);
		$this->provider->setType($type);

	}
	
	public function editProvider()
	{
		
	}
	
	public function getValidType()
	{
		
	}
	
	public function deleteProvider()
	{
		
	}
	
	public function main()
	{
		
	}
}


