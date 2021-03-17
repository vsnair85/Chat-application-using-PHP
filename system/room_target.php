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
$load_data = 'setting.allow_theme, setting.default_theme, setting.language, setting.timezone, users.user_theme, users.user_id, users.user_rank, users.user_roomid';
require_once("config1.php");

// set user account to new room id
if (isset($_POST["room_target"])){

	$roomtarget = $_POST["room_target"];
	$roomfinal = trim(str_replace('room', '', $roomtarget));
	$access = $mysqli->query("SELECT * FROM `rooms` WHERE `room_id` = '$roomfinal'");
	$check = $access->fetch_array(MYSQLI_BOTH);
	
	if($check['access'] <= $data['user_rank']){
		if($data['user_roomid'] != $roomfinal){
			$mysqli->query("UPDATE `users` SET `user_roomid` = '$roomfinal' WHERE `user_id` = '{$data["user_id"]}'");
		}
		else {
			echo 1;
		}
	}
	else {
		echo 2;
	}
}
else {
	echo "$lang_error";
}



?>