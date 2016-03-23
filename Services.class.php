<?php

/**************************  ********************************* *************************
 **************************  USE THIS CLASS TO GET TO DATABASE *************************
 **************************  ********************************* *************************
 * Services
 *
 * @date 10-3-2016
 *
 */
class Services
{
	private $services;
	private $size;

	const NOT_FOUND_MESSAGE = "ERROR: No services found<br>";
	const ADD_SUCCESSFUL    = "Service added<br>";
	const DELETE_SUCCESSFUL = "Service removed<br>";
	const ADD_FAIL          = "Service can not be remover<br>";
	const DELETE_FAIL       = "Service can not be deleted<br>";

	public function __construct()
	{
		$this->services = new SplObjectStorage();
		$this->size= 0;
	}

	public function findByCode($serviceCode)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;
		$temp = new SplObjectStorage();

		$this->services->rewind();
		while ($this->services->valid())
		{
			$service = $this->services->current()->getCode();
			if ($service == $serviceCode)
			{
				$temp->attach($service);
				$this->size++;
			}

			$this->services->next();
		}
		$this->services = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->services;
	}

	public function findByName($serviceName)
	{
		$this->getAll();
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$this->size = 0;
		$temp = new SplObjectStorage();

		$this->services->rewind();
		while ($this->services->valid())
		{
			$service = $this->services->current()->getName();
			if ($service == $serviceName)
			{
				$temp->attach($service);
				$this->size++;
			}

			$this->services->next();
		}
		$this->services = $temp;

		return ($this->isEmpty()) ? self::NOT_FOUND_MESSAGE : $this->services;
	}
	
	public function add(Service $service)
	{
		$result = DatabaseController::addService($service->getCode(),
			$service->getName(), $service->getFee());

		return ($result == true) ? self::ADD_SUCCESSFUL : self::ADD_FAIL;
	}
	
	public function delete($serviceCode)
	{
		$result = DatabaseController::deleteService($serviceCode);
		return ($result == true) ? self::DELETE_SUCCESSFUL : self::DELETE_FAIL;
	}
	
	public function getAll()
	{
		$this->services = new SplObjectStorage();
		$databaseServices = databaseController::getAllServices();

		$size = count($databaseServices);

		for ($i = 0; $i < $size; $i++)
		{
			$service = new Service(
				$databaseServices[databaseController::SERVICE_CODE],
				$databaseServices[databaseController::SERVICE_NAME],
				$databaseServices[databaseController::SERVICE_FEE]);
			$this->services->attach($service);
			$this->size++;
		}
	}

	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	public function getSize()
	{
		return $this->getSize();
	}

	public function __toString()
	{
		if ($this->isEmpty()) return self::NOT_FOUND_MESSAGE;

		$result = "<Table border=\"1\"><tr><th>Code</th><th>Name</th><th>Fee</th></tr>";

		$this->services->rewind();
		while ($this->services->valid())
		{
			$service = $this->services->current();

			$result .= "<tr><td>" . $service->getCode() . "</td><td>" . $service->getName()
					. "</td><td>" . $service->getFee()  . "</td></tr>";

			$this->services->next();
		}
		$result .= "</Table>";

		return $result;
	}

}