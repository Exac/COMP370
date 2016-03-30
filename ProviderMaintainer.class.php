<?php

class ProviderMaintainer extends PersonMaintainer
{
	private $ui;
	private $provider;
	public $message;

	public function __construct()
	{
		if (array_key_exists("new_provider", $_POST))
		{
			$this->addProviderPost();
		}
		if (array_key_exists("delete_provider", $_POST))
		{
			$this->deleteProvider($_POST["provider_number"]);
		}
		if (array_key_exists("update_provider", $_POST))
		{
			$this->updateProviderPost();
		}
	}

	private function updateProviderPost()
	{
		DatabaseController::updateProvider($_POST["provider_number"], $_POST["provider_name"], $_POST["provider_street_address"], $_POST["provider_city"], $_POST["provider_province"], $_POST["provider_postal_code"], $_POST["provider_email_address"], $_POST["provider_type"]);

		$this->message = $_POST["provider_name"] . " updated.";
	}

//	private function updateProvider ($number, $name, $street, $city, $province, $postal, $email, $type)
//	{
//
//	}

	private function addProviderPost()
	{
		$this->addProvider($_POST["provider_name"], $_POST["provider_street_address"], $_POST["provider_city"], $_POST["provider_province"], $_POST["provider_postal_code"], $_POST["provider_email_address"], $_POST["provider_type"]);

		$this->message = $_POST["provider_name"] . " added to the provider database.";
	}

	public function addProvider($name, $street, $city, $province, $postal, $email, $type)
	{
		$this->provider = new Provider();

		$this->provider->setName($name);
		$this->provider->setStreet($street);
		$this->provider->setCity($city);
		$this->provider->setProvince($province);
		$this->provider->setPostalCode($postal);
		$this->provider->setEmail($email);
		$this->provider->setType($type);

		$this->provider->toDatabase();
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
		DatabaseController::deleteProvider($number);

		$this->message = $_POST["provider_name"] . " removed from the provider database.";
	}
	
	public function main()
	{
		
	}
}


