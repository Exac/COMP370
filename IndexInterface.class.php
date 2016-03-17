<?php

/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/17/16
 * Time: 2:14
 */
class IndexInterface
{
	private $ui;

	public function __construct()
	{
		$this->ui = new UserInterface();
	}

	public function main()
	{
		$this->ui->bodyId = "interfacepicker";
		$this->ui->body .= "<h1 class='logo' onclick='document.location = \'/\''>Chocoholics Anonymous</h1>";
		$this->ui->body .= '<ul class="flex-container">'
			. '<li class="flex-item"><a href="/manager/">Manager</a></li>'
			. '<li class="flex-item"><a href="/operator/">Operator</a></li>'
			. '<li class="flex-item"><a href="/provider/">Provider</a></li>'
			. '<li class="flex-item"><a href="/scheduler/">Scheduler</a></li>' . '</ul>';

		echo $this->ui;
	}
}