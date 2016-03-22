<?php

class ProviderMaintainer extends PersonMaintainer
{
	private $ui;
	private $provider;

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
	
	public function editProvider($number)
	{
		$providers = new Providers();

		$providers->find($number);

	}
	
	public function getValidType()
	{
		
	}
	
	public function deleteProvider($number)
	{
		
	}
	
	public function main()
	{
		
	}
}


