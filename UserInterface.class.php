<?php

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
/**
 * UserInterface
 *
 * @date 10-3-2016
 *
 */
class UserInterface
 {
	public $in = "";
	public $out = "";

	const dateFormatter = null;
	const currencyFormatter = null;
	const DATE_FORMAT = "YYYY-MM-DD"; //YYYY-MM-DD

	public function  __construct()
	{

	}
	
	public function menu()
	{
		
	}
	
	public function errorMessage()
	{
		
	}
	
	public function message()
	{
		
	}
	
	public function promptForString()
	{
		
	}
	
	public function promtForLong()
	{
		
	}
	
	public function promptForDate()
	{
		
	}
	
	public function promptForDouble()
	{
		
	}
	
	public function formatAsCurrency()
	{
		
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