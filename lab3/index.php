<?php
	include("include/engine.php");

	$db = db_connect();
	
	$clients = mysql_query("SELECT * FROM `client`", $db);
	$orders = mysql_query("SELECT * FROM `order`", $db);
	
	include("templates/main.html");
	
	db_close($db);
?>

