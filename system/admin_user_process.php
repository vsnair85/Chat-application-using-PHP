<?php
/**
* Boomchat
*
* @package Boomchat
* @author www.myboomchat.com
* @copyright 2015
* @terms any use of this script without a legal license is prohibited
* all the content of Boomchat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_theme, users.user_rank';
require_once("config1.php");

if($access == 'off'){
	die();
}

// demote moderator an rerank to user status
if (isset($_POST['delete_modo']) && $data['user_rank'] > 3){


	$target = $mysqli->real_escape_string(trim($_POST['delete_modo']));
	$findtarget = $mysqli->query("SELECT `user_rank` FROM `users` WHERE `user_name` = '$target'");

	if ($findtarget->num_rows > 0){
			$mysqli->query("UPDATE `users` SET `user_rank` = 1, `user_color` = 'user' WHERE `user_name` = '$target'");
	}
	else {
		exit();
	}
}

// demote admin and rerank to user status
elseif (isset($_POST['delete_admin']) && $data['user_rank'] > 4){


	$target = $mysqli->real_escape_string(trim($_POST['delete_admin']));
	$findtarget = $mysqli->query("SELECT `user_rank` FROM `users` WHERE `user_name` = '$target'");

	if ($findtarget->num_rows > 0){
			$mysqli->query("UPDATE `users` SET `user_rank` = 1, `user_color` = 'user' WHERE `user_name` = '$target'");
	}
	else {
		exit();
	}
}

// demote admin and rerank to user status
elseif (isset($_POST['delete_vip']) && $data['user_rank'] > 4){


	$target = $mysqli->real_escape_string(trim($_POST['delete_vip']));
	$findtarget = $mysqli->query("SELECT `user_rank` FROM `users` WHERE `user_name` = '$target'");

	if ($findtarget->num_rows > 0){
			$mysqli->query("UPDATE `users` SET `user_rank` = 1, `user_color` = 'user' WHERE `user_name` = '$target'");
	}
	else {
		exit();
	}
}



// remove a user from the banned list and set access to 4
elseif (isset($_POST['delete_banned']) && $data['user_rank'] > 3){


	$target = $mysqli->real_escape_string(trim($_POST['delete_banned']));
	$findtarget = $mysqli->query("SELECT `user_rank`, `user_ip` FROM `users` WHERE `user_name` = '$target'");
	
	if ($findtarget->num_rows > 0){
			$finaltarget = $findtarget->fetch_array(MYSQLI_BOTH);
			$target_ip = $finaltarget['user_ip'];
			$mysqli->query("UPDATE `users` SET `user_access` = 4 WHERE `user_name` = '$target'");
			$mysqli->query("DELETE FROM `banned` WHERE `ip` = '$target_ip'");
	}
	else {
		exit();
	}
}



// remove a user from muted list and set access to 4
elseif (isset($_POST['delete_muted']) && $data['user_rank'] > 2){


	$target = $mysqli->real_escape_string(trim($_POST['delete_muted']));
	$findtarget = $mysqli->query("SELECT `user_rank` FROM `users` WHERE `user_name` = '$target'");

	if ($findtarget->num_rows > 0){
			$mysqli->query("UPDATE `users` SET `user_access` = 4, `user_mute` = '', `mute_time` = '' WHERE `user_name` = '$target'");
	}
	else {
		exit();
	}
}

else{
	exit();
}
?>