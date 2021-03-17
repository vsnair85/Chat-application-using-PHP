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
 ?>

<?php 
	// create a room from the admin panel 
	if (isset($_POST["name"]) && isset($_POST['type']) && $data['user_rank'] > 3){
		$name = $mysqli->real_escape_string(trim($_POST['name']));
		$access = $mysqli->real_escape_string(trim($_POST['type']));
		if ($name != ''){	
			$checkroom = $mysqli->query("SELECT `room_name` FROM `rooms` WHERE `room_name` = '$name'");
			
			if ($checkroom->num_rows < 1){
				if (strlen($name) < 30){
					$update = $mysqli->query("INSERT INTO `rooms` (room_name, access) VALUES ('$name', '$access')");
				}
				else{
					echo 2;
				}
			}
			else{
				echo 1;
			}
		}
		else {
			echo 3;
		}
	}
	// delete room from the admin panel
	if (isset($_POST['delete_room']) && $data['user_rank'] > 3){
	
		$delete = $mysqli->real_escape_string(trim($_POST['delete_room']));
		$room_name = $mysqli->query("SELECT `room_name` FROM `rooms` WHERE `room_id` = '$delete'");
		$room_name = $room_name->fetch_array(MYSQLI_BOTH);
		$room_name = $room_name['room_name'];
		
		if ($delete != '1'){
		
			$message = "$room_name $lang_room_close " . $data['user_name'];
			$room = '1';
			
			$mysqli->query("DELETE FROM `rooms` WHERE `room_id` = '$delete'");
			$mysqli->query("DELETE FROM `chat` WHERE `post_roomid` = '$delete'");
			$mysqli->query("UPDATE `users` SET `user_roomid` = '1' WHERE `user_roomid` = '$delete'");
			$mysqli->query("INSERT INTO `chat` (post_time, user_id, post_user, post_message, post_roomid, post_color, type, post_date, avatar) VALUES ('$post_time', '999999', '$lang_system', '$message', '$room', 'bold', 'system', '$time', 'default_system_tumb.png')");		
		}
		else {
			echo 1;
		}
	}
	
?>