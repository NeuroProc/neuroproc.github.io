<?php
	include("include/engine.php");

	if ((!isset($_GET['table']) || !isset($_GET['id'])) && (!isset($_POST['add_client']) && !isset($_POST['add_order']))) {
		die("Bad input.");
	}	
	
	$db = db_connect();
		
	$raw = mysql_query("SELECT `id` FROM `client`", $db);
	$clients = [];
	while ($client = mysql_fetch_array($raw)) {
		array_push($clients, $client['id']);
	}
	
	$raw = mysql_query("SELECT `id` FROM `apartment`", $db);
	$apartments = [];
	while ($apartment = mysql_fetch_array($raw)) {
		array_push($apartments, $apartment['id']);
	}
	
	$raw = mysql_query("SELECT `id` FROM `order_status`", $db);
	$statuses = [];
	while ($status = mysql_fetch_array($raw)) {
		array_push($statuses, $status['id']);
	}
	
	if (isset($_POST['add_client'])) {
		if (empty($_POST['name']) || empty($_POST['date_of_birth']) || empty($_POST['passport']) || empty($_POST['sex'])) {
			die("Bad input.");
		}
		
		mysql_query("UPDATE `client` SET `name`='".mysql_real_escape_string($_POST['name'])."', `date_of_birth`='".mysql_real_escape_string($_POST['date_of_birth'])."', `passport`='".mysql_real_escape_string($_POST['passport'])."', `sex`='".mysql_real_escape_string($_POST['sex'])."' WHERE `id`=".mysql_real_escape_string($_POST['id']), $db);
		
		echo "<h1>SUCCESS</h1>";
		echo "<h6>user '".$_POST['name']."' updated.</h6>";
	}
	
	if (isset($_POST['add_order'])) {
		if (empty($_POST['client']) || empty($_POST['apartment']) || empty($_POST['date']) || empty($_POST['day_count']) || empty($_POST['order_status'])) {
			die("Bad input.");
		}
		
		mysql_query("UPDATE `order` SET `client`=".mysql_real_escape_string($_POST['client']).", `apartment`=".mysql_real_escape_string($_POST['apartment']).", `date`='".mysql_real_escape_string($_POST['date'])."', `day_count`=".mysql_real_escape_string($_POST['day_count']).", `order_status`=".mysql_real_escape_string($_POST['order_status'])." WHERE `id`=".mysql_real_escape_string($_POST['id']), $db);
		
		echo "<h1>SUCCESS</h1>";
		echo "<h6>order updated.</h6>";
	}
	
	include("templates/edit.html");
	
	db_close($db);
?>
    

