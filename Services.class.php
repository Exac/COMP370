<?php

/**
 * Services Class
 *
 * @date 10-3-2016
 *
 * A service is provided by the provider. This class maintains all the services.
 * It can do the following:
 *    findByCode()    Finds the service by service code.
 *    findByName()    Finds a service by name.
 *    add()            Adds a new service.
 *    delete()        Deletes an existing service.
 *    getAll()        Gets all the services in the database.
 *    isEmpty()        Checks if the services array is empty.
 *
 */
class Services
{
	// Service attributes.
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

	/**
	 * Finds a service by service code.
	 * @param $serviceCode
	 * @return SplObjectStorage|string
	 */
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

	/**
	 * Finds a service by its name.
	 * @param $serviceName
	 * @return SplObjectStorage|string
	 */
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

	/**
	 * Adds a new service.
	 * @param Service $service
	 * @return string
	 */
	public function add(Service $service)
	{
		$result = DatabaseController::addService($service->getCode(),
			$service->getName(), $service->getFee());

		return ($result == true) ? self::ADD_SUCCESSFUL : self::ADD_FAIL;
	}

	/**
	 * Deletes an existing service.
	 * @param $serviceCode
	 * @return string
	 */
	public function delete($serviceCode)
	{
		$result = DatabaseController::deleteService($serviceCode);
		return ($result == true) ? self::DELETE_SUCCESSFUL : self::DELETE_FAIL;
	}

	/**
	 * Gets all the services in the database.
	 */
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

	/**
	 * Checks if the services array is empty.
	 * @return bool
	 */
	public function isEmpty()
	{
		return ($this->size == 0) ? true : false;
	}

	/**
	 * Gets the size of the services array.
	 * @return mixed
	 */
	public function getSize()
	{
		return $this->getSize();
	}

	/**
	 * Builds a table string for the services in the services array.
	 * @return string
	 */
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