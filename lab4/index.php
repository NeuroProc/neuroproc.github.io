<?php
	include("include/engine.php");

	$db = db_connect();
	
	
	if (isset($_SESSION['uid'])) {
		if ($_SESSION['admin'] == TRUE) {	
			$clients = mysql_query("SELECT * FROM `client`", $db);
			$orders = mysql_query("SELECT * FROM `order`", $db);
		} else {
			$query = "SELECT `order`.`id`,`client`.`name` AS 'client',`order`.`apartment`,`order`.`date`,`order`.`day_count`,`order_status`.`status` AS 'order_status' FROM `order` JOIN `client` ON `order`.`client`=`client`.`id` JOIN `order_status` ON `order`.`order_status`=`order_status`.`id` WHERE `client`=".$_SESSION['uid'];
			$orders = mysql_query($query, $db);
		}
	}
	
	include("templates/main.html");
	db_close($db);
?>

