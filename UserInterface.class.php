<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

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
	public $inlineJS = "\n";

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

	public static function errorMessage($message)
	{
		$em_ui = new UserInterface();
		//array_push($em_ui->scripts, "/cdn/js/provider.js");
		$em_ui->add("<div id='errorScreen'><span class='invalid message'>${message}</span></div>");
		$em_ui->inlineJS .= ("console.log('UserInterface->errorMessage()');window.setTimeout(reload, 2500);");

		echo $em_ui;
		die();
	}

	//non-fatal message
	public function message($message)
	{
		$ec = ""; //error-code to be prepended to body.

		if ($message)
		{
			$ec .= "<div id='message'><span class='valid message'>${message}</span></div>";
			//$this->inlineJS .= "<script defer>console.log('UserInterface->message()');window.setTimeout(reload, 1500);</script>";
		}

		$this->body = $ec . $this->body;//prepend
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
		$o = "<!doctype html>\n\n<html lang='en'>\n\n<head>" .
			"\t<title>" . $this->title . "</title>";
		$o .= "\n\t<meta charset='utf-8'>\n";
		//$o .= "<meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"iso-8859-1\">";

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

		foreach ($this->scripts as &$script)
		{ //have external scripts load before inline scripts.
			$o .= "\n\t<script src='" . $script . "'></script>";
		}

		$o .= "\n\t<script defer>" . $this->inlineJS . "</script>"; //load inline scripts last

		$o .= $this->foot;

		return $o;
	}
}
