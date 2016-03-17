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

<body id="provider" class="interface">
<form id="providerinterface" action="" method="post">
	<fieldset>
		<legend>Provider Report</legend>
		<p>View Provider Report [generate_Provider_report]</p>
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

new ChocAnSystem("provider");
