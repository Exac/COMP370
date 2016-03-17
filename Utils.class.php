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

}

class Database {
	public $db_host = "COMP370.db.10405771.hostedresource.com";
	public $db_user = "COMP370";
	public $db_password;

	function __construct() {
		$this->db_password = $_ENV["CDP"]; // Password is set on server so GitHub can host code.
		echo $this->db_password;
	}
}

class Html
{
	public $title = "Chocoholics Anonymous";
	public $description = null;
	public $author = "Farzin, Navi and Thomas";
	public $stylesheets = array("cdn/css/interface.css");
	public $bodyId = null;
	public $bodyClasses = array("interface");
	public $body = "";
	public $scripts = array("/cdn/js/scripts.js");
	public $foot = "\n</body>\n</html>";

	public function __toString()
	{
		$o = "<!doctype html>\n\n<html lang='en'>\n\n<head>\n\t<meta charset='utf-8'>\n" .
			"\t<title>" . $this->title . "</title>";
		if (isset($this->description)) {
			$o .= "\n\t<meta name='description' content='" . $this->description . "'>";
		}
		$o .= "\n\t<meta name='author' content='" . $this->author . "'>";
		foreach ($this->stylesheets as &$css) {
			$o .= "\n\t<link rel='stylesheet' href='" . $css . "'>";
		}
		$o .= "\n</head>\n<body id='" . $this->bodyId . "' class='";
		foreach ($this->bodyClasses as &$bClass) {
			$o .= $bClass . " ";
		}
		$o .= "'>";

		$o .= "\n" . str_replace("\n", "\n\t", $this->body); //add body, indent all lines once.

		foreach ($this->scripts as &$script) {
			$o .= "\n\t<script src='" . $script . "' defer></script>";
		}
		$o .= $this->foot;


		return $o;
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
	 * @desc creates a html-id-safe name for variable. "nice Button" becomes "nice_Button"
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
	public $radiogroup = "default";

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
			$this->radiogroup = func_get_args()[3];
		}
	}

	public function __toString()
	{
		if ($this->type === "button" || $this->type === "submit") {
			$o = '<button type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="'
				. $this->getId($this->name) . '">' . $this->name . '</button>';
		} else if ($this->radiogroup !== "radio") {
			$o = '<input type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="'
				. $this->radiogroup . '"/>';
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
	 * @desc creates a html-id-safe name for variable. "nice Button" becomes "nice_Button"
	 */
	public function getId($_name)
	{
		return str_replace(" ", "_", $_name);
	}

}

/*
 * Form Example
 */
/*
$h = new Html();
$h->body .= "<form action='' method='get'>";
$h->body .= (new Input("button", "lad", "Click for lad"))->br();
$h->body .= (new Input("text", "wew", "Enter name lad"))->br();
$h->body .= (new Input("checkbox", "amaze", "amaze wew"))->br();
$h->body .= (new Input("radio", "so", "doge amaze", "ohvey"))->br();
$h->body .= (new Input("radio", "doge", "wow", "ohvey"))->br();
$h->body .= (new Input("submit", "oh", "vey"))->br();
$h->body .= "</form>";
new Input("radio", "test", "this is a test", "wew");
echo $h;*/

