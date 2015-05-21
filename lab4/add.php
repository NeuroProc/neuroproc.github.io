<?php
	include("include/engine.php");
	
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
		
		mysql_query("INSERT INTO `client`(`id`, `name`, `date_of_birth`, `passport`, `sex`) VALUES (NULL,'".mysql_real_escape_string($_POST['name'])."','".mysql_real_escape_string($_POST['date_of_birth'])."','".mysql_real_escape_string($_POST['passport'])."','".mysql_real_escape_string($_POST['sex'])."')", $db);
		
		echo "<h1>SUCCESS</h1>";
		echo "<h6>user '".$_POST['name']."' added.</h6>";
	}
	
	if (isset($_POST['add_order'])) {
		if (empty($_POST['client']) || empty($_POST['apartment']) || empty($_POST['date']) || empty($_POST['day_count']) || empty($_POST['order_status'])) {
			die("Bad input.");
		}
		
		mysql_query("INSERT INTO `order`(`id`, `client`, `apartment`, `date`, `day_count`, `order_status`) VALUES (NULL,".$_POST['client'].",".$_POST['apartment'].",'".$_POST['date']."',".$_POST['day_count'].",".$_POST['order_status'].")", $db);
		
		echo "<h1>SUCCESS</h1>";
		echo "<h6>order added.</h6>";
	}
	
	include("templates/add.html");
	
	db_close($db);
?>
