<?php
	include("include/engine.php");
	
	$db = db_connect();	
	$err = array();
	
	if (isset($_POST['submit'])) {
		$email = quote($_POST['email']);
		$password = quote($_POST['password']);
		$repassword = quote($_POST['repassword']);
		$name = quote($_POST['name']);
		$date_of_birth = quote($_POST['date_of_birth']);
		$passport = quote($_POST['passport']);
		$sex = quote($_POST['sex']);
		
		if (empty($email) || empty($password) || empty($name) 
			|| empty($date_of_birth) || empty($passport) || empty($sex)) {
			$err[] = "please fill all the fields.";
		}
		
		if (!preg_match("/[-a-zA-Z0-9_]{3,20}@[-a-zA-Z0-9]{2,64}\.[a-zA-Z\.]{2,9}/", $email)) {
			$err[] = "bad e-mail";
		}
		
		if ($password != $repassword) {
			$err[] = "passwords do not match.";
		}
		
		if (!empty($email)) {
			$query = mysql_query("SELECT COUNT(`id`) FROM `client` WHERE `email`='$email'", $db);
			if(mysql_result($query, 0) > 0) {
				$err[] = "your e-mail already exist.";
			}
		}
		
		if (empty($err)) {
			$password = md5($password);
			
			$query = "INSERT INTO `client`(`id`,`email`,`password`,`admin`,`name`,`date_of_birth`,`passport`, `sex`) VALUES (NULL,'$email','$password',FALSE,'$name','$date_of_birth','$passport','$sex')";
			if (mysql_query($query, $db) == FALSE) {
				$err[] = "mysql error";
			} else {
				header("Location: login.php");
			}
		}
	}
	
	include("templates/register.html");	
	db_close($db);
?>
