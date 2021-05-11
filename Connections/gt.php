<?php
	$hostname_gt = "localhost";
	$database_gt = "gt";
	$username_gt = "root";
	$password_gt = "";
	try {
		$pdo = new PDO("mysql:host=$hostname_gt; dbname=$database_gt", $username_gt, $password_gt);
	} catch (PDOException $error) {
		print_r($error->getMessage());
	}
// $gt = mysql_pconnect($hostname_gt, $username_gt, $password_gt) or trigger_error(mysql_error(),E_USER_ERROR); 
?>