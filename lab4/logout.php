<?php
	include("include/engine.php");
	
	unset($_SESSION['uid']);
	unset($_SESSION['uname']);
	unset($_SESSION['admin']);
	
	header("Location: index.php");
?>
