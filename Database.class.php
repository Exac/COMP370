<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/17/16
 * Time: 23:02
 */

/**
 * Class Database
 *
 * The Database class connects to the database and is the only object that interacts with the
 * database. It should be used via a DatabaseController class. An example of a Database singleton:
 * echo (new Database())->select("select * from member where member_number = 0");
 *
 * Password is set on server so GitHub can host code.
 * On linux machines, add go to /etc/environment and add
 * CDP=ThisIsMyPassword
 * On Windows machines running WAMP, go to C:\wamp\bin\apache\Apache2.4.4\conf and add
 * SetEnv CDP ThisIsMyPassword
 *
 */
class Database
{
	//public $host = "COMP370.db.10405771.hostedresource.com";
	//public $host = "127.0.0.1";
	//public $host = "caxe.thomasmclennan.ca";#works on server
	public $host = "S0106c8fb267823ad.vf.shawcable.net";
	public $user = "COMP370"; //Also name of database.
	public $password;

	protected static $connection;

	function __construct()
	{
		$this->detectDeveloperMode();
		$this->password = getenv("CDP");
	}

	/**
	 * Connect to the database
	 * #SERVER:
	 * mysql> grant all privileges on COMP370.* to  'COMP370'@'S0106c8fb267823ad.vf.shawcable.net' identified by 'Database Password' with grant option;
	 * mysql> flush privilegess
	 * #PHPSTORM:
	 *    Run configuration:
	 *        Directory -> \COMP370\tests
	 *        Environmental Variables -> CDP:'Database Password'
	 *    Settings:
	 *        Languages & Frameworks -> PHP -> PHPUnit -> Path to PHPUnit -> \COMP370\phpunit-5.2.12.phar
	 * 
	 * @return bool|mysqli False on Failure, mysqli object when it works.
	 */
	public function connect()
	{
		if (!isset(self::$connection)) //only connect if not already connected.
		{
			self::$connection = new mysqli($this->host, $this->user, $this->password, $this->user);
		}
		if (self::$connection === false) //error
		{
			echo "Database::connect() connection failed";

			return false;
		}

		return self::$connection;
	}

	/**
	 * Query the database
	 *
	 * @param $query string MySQL query.
	 * @return bool|mysqli_result mysqli::query() result.
	 */
	public function query($query)
	{
		$connection = $this->connect(); //connect to db
		$result = $connection->query($query);

		return $result;
	}

	/**
	 * Select query (get rows) from database
	 *
	 * @param $query string MySQL query
	 * @return array|bool Array of database rows.
	 */
	public function select($query)
	{
		$rows = array();
		$result = $this->query($query);

		if ($result === false)
		{
			die("<br><pre>" . $this->connect()->error . "</pre>" . "Query attempted: <pre>${query}</pre>");
		}

		while ($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}

		return $rows;
	}

	/**
	 * Clean up value (so someone does not just enter SQL into inputs).
	 *
	 * @param $value String to be escaped.
	 * @return string Clean string for use in database.
	 */
	public function escape($value)
	{
		$connection = $this->connect();

		return "'" . $connection->real_escape_string($value) . "'";
	}

	/**
	 * The server has a MySQL running; however, for development we have been using a cloud-hosted
	 * MySQL server. Unfortunately it takes 0.25 seconds to connect to it and run queries, so this
	 * method uses the development server when it is run on a developer computer.
	 */
	private function detectDeveloperMode()
	{
		$localhostAddresses = array('127.0.0.1', '::1');

		if (in_array(gethostbyname(gethostname()), $localhostAddresses))
		{
			$this->host = "127.0.0.1";
		}
	}

}
