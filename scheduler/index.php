<!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8">

	<title>Provider | Chocoholics Anonymous</title>
	<meta name="description" content="Chocoholics Anonymous">
	<meta name="author" content="Chocoholics Anonymous Provider's interface.">
	<link rel="stylesheet"
		  href="/cdn/css/interface.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
</head>

<body id="scheduler" class="interface">
<form id="schedulerinterface" action="/SchedulerInterface.class.php">
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
<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/4/16
 * Time: 15:00
 */

require_once(dirname(dirname(__FILE__)) . '/ChocAnSystem.class.php');

new ChocAnSystem("scheduler");
