<?php
	include("include/engine.php");
	
	$db = db_connect();	
	$err = array();
	
	if (isset($_POST['submit'])) {
		$email = quote($_POST['email']);
		$password = quote($_POST['password']);
		
		
		$query = "SELECT `id`,`name`,`admin` FROM `client` WHERE `email`='$email' AND `password`='".md5($password)."'";
		$res = mysql_query($query, $db);
		$userinfo = mysql_fetch_array($res);
		if (empty($userinfo)) {
			$err[] = "invalid username or password";
		} else {
			$_SESSION['uid'] = $userinfo['id'];
			$_SESSION['uname'] = $userinfo['name'];
			$_SESSION['admin'] = $userinfo['admin'];
			
			header("Location: index.php");
		}
	
	}
	
	include("templates/login.html");
	db_close($db);
?>
