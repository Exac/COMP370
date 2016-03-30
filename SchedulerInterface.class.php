<?php

/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

class SchedulerInterface
{
	public $ui;

	public function __construct()
	{
		$this->ui = new UserInterface();
	}
	
	public function main()
	{
		$this->ui->bodyId = "scheduler";
		$this->ui->title .= "Scheduler | ";

		$this->ui->body .= '<form id="schedulerinterface" action="" method="post">';
		$this->ui->body .= '<fieldset>' . '<legend>Time: Midnight Fridays</legend>' . '<ul>' . '<li>' . '<input type="checkbox" id="generate_ETF_data" name="generate_ETF_data" checked="checked"/>' . '<label for="generate_ETF_data">generate_ETF_data</label>' . '</li>' . '<li>' . '<input type="checkbox" id="generate_Member_report" name="generate_Member_report" checked="checked"/>' . '<label for="generate_Member_report">generate_Member_report</label>' . '</li>' . '<li>' . '<input type="checkbox" id="generate_Provider_report" name="generate_Provider_report" checked="checked"/>' . '<label for="generate_Provider_report">generate_Provider_report</label>' . '</li>' . '</ul>' . '<button type="submit">Generate Forms</button>' . '</fieldset>';
		$this->ui->body .= '</form>';

		$this->ui->body .= "<pre><span class='disabled'>#Run once to have Scheduler run every Saturday at 2am:</span>" . "<br>crontab -l COMP370.cron" . "<br>echo \"0 2 * * 6 /var/www/html/scheduler.class.php\" >> COMP370.cron<br>crontab COMP370.cron" . "<br>rm COMP370.cron" . "</pre>";
		$this->ui->body .= Utils::getNavigationMenu();

		echo $this->ui;
	}
}
/*
 <!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8">

	<title>Scheduler | Chocoholics Anonymous</title>
	<meta name="description" content="Chocoholics Anonymous">
	<meta name="author" content="Chocoholics Anonymous Provider's interface.">
	<link rel="stylesheet"
		  href="/cdn/css/interface.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
</head>

<body id="scheduler" class="interface">
<form id="schedulerinterface" action="" method="post">
	<fieldset>
		<legend>Time: Midnight Fridays</legend>
		<ul>
			<li>
				<input type="checkbox" id="generate_ETF_data" name="generate_ETF_data"
					   checked="checked"/>
				<label for="generate_ETF_data">generate_ETF_data</label>
			</li>
			<li>
				<input type="checkbox" id="generate_Member_report" name="generate_Member_report"
					   checked="checked"/>
				<label for="generate_Member_report">generate_Member_report</label>
			</li>
			<li>
				<input type="checkbox" id="generate_Provider_report" name="generate_Provider_report"
					   checked="checked"/>
				<label for="generate_Provider_report">generate_Provider_report</label>
			</li>
		</ul>
		<button type="submit">Generate Forms</button>
	</fieldset>
</form>


<script src="/cdn/js/scripts.js" defer></script>
</body>
</html>
 */