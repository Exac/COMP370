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

	public function  __construct()
	{
		echo "UserInterface::__construct();";
		$this->in = $_POST;
		$this->out = new Html();
		$this->menu();
		$this->out->body .= "wew";
		echo $this->out->__toString();
	}
	
	public function menu()
	{
		$this->out->body .= Utils::getNavigationMenu();
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

}
