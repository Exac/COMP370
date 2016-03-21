<?php

/**
 * UserInterface
 *
 * @date 10-3-2016
 *
 */
class UserInterface
 {
	public $in; //[..]
	public $out; //new Html();

	const dateFormatter = null;
	const currencyFormatter = null;
	const DATE_FORMAT = "YYYY-MM-DD"; //YYYY-MM-DD

	public $title = "Chocoholics Anonymous";
	public $description = null;
	public $author = "Farzin, Navi and Thomas";
	public $stylesheets = array("cdn/css/interface.css");
	public $bodyId = null;
	public $bodyClasses = array("interface");
	public $body = "";
	public $scripts = array("/cdn/js/scripts.js");
	public $foot = "\n</body>\n</html>";

	public function  __construct()
	{
		echo "UserInterface::__construct();";
		$this->in = $_POST;
		$this->menu();
	}
	
	public function menu()
	{
		$this->body .= Utils::getNavigationMenu();
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

	public function promptForLong()
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

	public function add($string)
	{
		$this->body .= "\n" . $string;
	}

	public function __toString()
	{
		$o = "<!doctype html>\n\n<html lang='en'>\n\n<head>\n\t<meta charset='utf-8'>\n" .
			"\t<title>" . $this->title . "</title>";
		if (isset($this->description)) {
			$o .= "\n\t<meta name='description' content='" . $this->description . "'>";
		}
		$o .= "\n\t<meta name='author' content='" . $this->author . "'>";
		foreach ($this->stylesheets as &$css) {
			$o .= "\n\t<link rel='stylesheet' href='/" . $css . "'>";
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
