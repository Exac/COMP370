<?php
class SchedulerInterface
{
	public function __construct()
	{

	}
	
	public function main()
	{
		echo Utils::getNavigationMenu();
		var_dump($_POST);
	}
}