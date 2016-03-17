<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/10/16
 * Time: 1:43
 */

/**
 * Class Utils
 *
 * Use this class for functions that don't fit inside classes (yet).
 * This is bad practice and we are aware.
 */
class Utils {
	public static function getNavigationMenu() {
		return '<ul>'.
				'<li><a href="/manager">manager</a></li>'.
				'<li><a href="/operator">operator</a></li>'.
				'<li><a href="/provider">provider</a></li>'.
		'<li><a href="/scheduler">scheduler</a></li>' .
				'</ul>';
	}

	public function testDB()
	{
		$d = new Database();
		$a = $d->select("SELECT * FROM `member` ORDER BY `member_number`");
		foreach ($a as $row) {
			echo $row["member_number"];
			echo $row["member_name"];
			echo $row["member_email_address"];
		}
	}
}

class Database
{
	public $host = "COMP370.db.10405771.hostedresource.com";
	public $user = "COMP370"; //Also name of database.
	public $password;

	protected static $connection;

	/*
	 * Password is set on server so GitHub can host code.
	 * On linux machines, add go to /etc/environment and add
	 * CDP=ThisIsMyPassword
	 *
	 * On Windows machines running WAMP, go to C:\wamp\bin\apache\Apache2.4.4\conf and add
	 * SetEnv CDP ThisIsMyPassword
	 */
	function __construct()
	{
		$this->password = getenv("CDP");
	}

	/**
	 * Connect to the database
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
		if ($result === false) {
			return false;
		}
		while ($row = $result->fetch_assoc()) {
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
	public function secure($value)
	{
		$connection = $this->connect();

		return "'" . $connection->real_escape_string($value) . "'";
	}

}

class Button
{
	public $name = null;
	public $label = null;

	public function __construct($_name, $_label)
	{
		$this->name = $_name;
		$this->label = $_label;
	}

	public function __toString()
	{
		$o = '<button type="button" id="' . $this->cleanName($this->name) . '">' . $this->name . '</button>';
		$o .= '<label for="' . $this->cleanName($this->name) . '">' . $this->label . '</label>';

		return $o;
	}

	/**
	 * Creates a html-id-safe name for variable. "nice Button" becomes "nice_Button"
	 *
	 * @param $_name string value to be cleaned.
	 * @return string name
	 */
	private function cleanName($_name)
	{
		return str_replace(" ", "_", $_name);
	}

}

class Input
{
	public $name = null;
	public $label = null;
	public $type = null;
	public $radio_group = "default";

	/**
	 * @param $_type string (button|checkbox|radio|text|password)
	 * @param $_name string
	 * @param $_label string
	 */
	public function __construct($_type, $_name, $_label)
	{
		$this->type = $_type;
		$this->name = $_name;
		$this->label = $_label;

		//If an optional 4th parameter is passed, use it to determine a radio button's group.
		if (func_num_args() === 4) {
			$this->radio_group = func_get_args()[3];
		}
	}

	public function __toString()
	{
		if ($this->type === "button" || $this->type === "submit") {
			$o = '<button type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="'
				. $this->getId($this->name) . '">' . $this->name . '</button>';
		} else if ($this->radio_group !== "radio") {
			$o = '<input type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="'
				. $this->radio_group . '"/>';
		} else {
			$o = '<input type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="'
				. $this->getId($this->name) . '"/>';
		}

		$o .= '<label for="' . $this->getId($this->name) . '">' . $this->label . '</label>';

		return $o;
	}

	public function br()
	{
		return $this->__toString() . "<br>";
	}

	/**
	 * Creates a html-id-safe name for variable. "nice Button" becomes "nice_Button"
	 *
	 * @param $_name
	 * @return string ID
	 */
	public function getId($_name)
	{
		return str_replace(" ", "_", $_name);
	}

}


