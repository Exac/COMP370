<?php

echo "In provider maintainer";


class ProviderMaintainer extends PersonMaintainer
{
	private $ui;
	private $provider;
	
	public function _construct()
	{
		
	}
	
	public function addProvider($name, $street, $city, $province, $postal, $email, $type)
	{
		echo "in addProvider()";

		$this->provider = new Provider();

		$this->provider->setName($name);
		$this->provider->setStreet($street);
		$this->provider->setCity($city);
		$this->provider->setProvince($province);
		$this->provider->setPostalCode($postal);
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


