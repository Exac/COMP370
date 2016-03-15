<!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8">

	<title>Manager | Chocoholics Anonymous</title>
	<meta name="description" content="Chocoholics Anonymous">
	<meta name="author" content="Chocoholics Anonymous Manager's interface.">
	<link rel="stylesheet"
		  href="/cdn/css/interface.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
</head>

<body id="manager" class="interface">
<form id="managerinterface" action="/ManagerInterface.class.php">
	<fieldset>
		<legend>Request Member Report</legend>
		<button type="button" id="generate_Member_report">generate_Member_report</button>
		<label for="generate_Member_report">send member_Report_request</label>
	</fieldset>
	<hr>
	<fieldset>
		<legend>Member Report</legend>
		<p>View Member Report [generate_Member_report]</p>
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

new ChocAnSystem("manager");
