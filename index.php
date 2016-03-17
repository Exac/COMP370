<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Interface Selection | Chocoholics Anonymous</title>
    <meta name="description" content="Chocoholics Anonymous">
    <meta name="author" content="Chocoholics Anonymous interface selection.">
	<link rel="stylesheet" href="/cdn/css/interface.css">
</head>

<body id="interfacepicker">
	<h1 class="logo" onclick="document.location = '/'">Chocoholics Anonymous</h1>
	<ul class="flex-container">
		<li class="flex-item"><a href="/manager/">Manager</a></li>
		<li class="flex-item"><a href="/operator/">Operator</a></li>
		<li class="flex-item"><a href="/provider/">Provider</a></li>
		<li class="flex-item"><a href="/scheduler/">Scheduler</a></li>
	</ul>
	<p id="footer">&copy;
		<script>document.write(new Date().getFullYear().toString());</script>
		Farzin Dhanji, Navi Gill &amp; Thomas McLennan
	</p>
</body>
</html>
<?php/*

//require_once(dirname(dirname(__FILE__)) . '/ChocAnSystem.class.php');
include "ChocAnSystem.class.php";

new ChocAnSystem("index");