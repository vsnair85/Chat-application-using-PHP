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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_theme, users.user_rank, users.user_access, users.user_ignore, users.user_roomid, users.user_id';
require_once("config1.php");
require_once("content_process.php");
	
	$name = $data['user_name'];
	$room = $data['user_roomid'];
	$data_id = $data["user_id"];
	$post_time = date("H:i", $time);
	$set_ignore = $mysqli->real_escape_string(trim($_GET['option']));
	
	if($data['user_rank'] >= 3 && $data['user_access'] > 3 &&  $set_ignore !== "get_ignore" && $set_ignore !== "get_friends"){
	
		if(isset($_GET['option']) && isset($_GET['target'])){
		
			$option = $mysqli->real_escape_string(trim($_GET['option']));
			$data_target = $mysqli->real_escape_string(trim($_GET['target']));
			
			$findtarget = $mysqli->query("SELECT `user_rank`, `user_mute`, `user_ip`, `user_tumb`, `user_avatar`, `user_id` FROM `users` WHERE `user_name` = '$data_target'");
			
			if ($findtarget->num_rows > 0){
				
				$target = $findtarget->fetch_array(MYSQLI_BOTH);
				$target_rank = $target['user_rank'];
				$target_mute = $target['user_mute'];
				$target_ip = $target['user_ip'];
				$target_id = $target['user_id'];
				
			
				if($option == "get_mute"){
				
						if($data['user_rank'] > $target_rank){
						
							if ($target_mute == ''){
							
								$mutenotice = "$data_target $msgmute $name";
								$mysqli->query("UPDATE `users` SET `user_access` = 1, `user_mute` = '$name', `mute_time` = '$time' WHERE `user_name` = '$data_target'");
								$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$mutenotice', $room, 'bold', 'system', 'default_system_tumb.png')");
								echo 1;
							}
							else{
								echo 1;
							}
						}
						else{
							echo 1;
						}	
				}
				
				
				if($option == "get_unmute"){
					
					if($name == $target_mute || $target_mute == "" || $target_mute == 'flood' || $data['user_rank'] > 3){
						$unmutenotice = "$data_target $msgunmute $name";
						$mysqli->query("UPDATE `users` SET `user_access` = 4, `mute_time` = '', `user_mute` = '', `user_flood` = '0' WHERE `user_name` = '$data_target'");
						$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$unmutenotice', $room, 'bold', 'system', 'default_system_tumb.png')");

						echo 1;
					}
					else{
						echo 1;
					}
				}
				elseif($option == "get_ban"){
				
					if ($data['user_rank'] > $target_rank){
						$bannotice = "$data_target $msgban $name";
						$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$bannotice', $room, 'bold', 'system', 'default_system_tumb.png')");
						$mysqli->query("UPDATE `users` SET `user_access` = 0 WHERE `user_name` = '$data_target'");
						$mysqli->query("INSERT INTO `banned` (ip) VALUES ('$target_ip')");
						echo 1;
					}
					else{
						echo 1;
					}
				}
				elseif($option == "get_kick"){
				
					if ($data['user_rank'] > $target_rank){
					
						$displaykick = $quickkick;
								
							$kicknotice = "$data_target $msgkick " . $name . " ( $displaykick )";
							$mysqli->query("UPDATE `users` SET `user_access` = 2, `user_kick` = '$displaykick', `user_status` = '3' WHERE `user_name` = '$data_target'");
							$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$kicknotice', $room, 'csystem', 'system', 'default_system_tumb.png')");
							echo 1;
					}
				}
				elseif($option == "get_kill"){
				
						if($data['user_rank'] > $target_rank && $data['user_rank'] > 4 && $data_target !== $name){
								$kill_notice = "$data_target $msgkill $name";
								$mysqli->query("DELETE FROM `users` WHERE `user_name` = '$data_target' AND `user_ip` = '$target_ip'");
								$mysqli->query("DELETE FROM `chat` WHERE `post_user` = '$data_target'");
								$mysqli->query("DELETE FROM `private` WHERE `hunter` = '$data_target'");
								$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$kill_notice', $room, 'bold', 'system', 'default_system_tumb.png')");
								$path_user_file = "../upload/user" . $target_id;
								if (file_exists($path_user_file)) {
									$clean_user = delete_files($path_user_file);
								}
								
								$tumb = '../avatar/' . $target['user_tumb'];
								$avt = '../avatar/' . $target['user_avatar'];
								if($target['user_avatar'] !== 'default_avatar.png' && file_exists($avt)){
									unlink($avt);
								}
								if($target['user_tumb'] !== 'default_avatar_tumb.png' && file_exists($tumb)){
									unlink($tumb);
								}
								
								echo 1;
						}
						else{
							echo 1;
						}	
				}
				else {
					die();
				}
			}
			else {
				die();
			}
		}
		else {
			echo "error";
		}
		
	}
	elseif ($data['user_rank'] >= 1 && $data['user_access'] == 4 && $set_ignore == "get_ignore"){
	
				$data_target = $mysqli->real_escape_string(trim($_GET['target']));
				$findignore = $mysqli->query("SELECT `user_name`, `user_rank`  FROM `users` WHERE `user_name` = '$data_target'");
				if ($findignore->num_rows > 0){
					$ignored = $findignore->fetch_array(MYSQLI_BOTH);
					if($ignored['user_rank'] < 3){
						$ignore = $data['user_ignore'];
						if(!strpos(strtolower($data['user_ignore']), strtolower(" $data_target "))){
							$ignore = trim($ignore);
							$ignore = " $ignore $data_target ";
							$mysqli->query("UPDATE `users` SET `user_ignore` = '$ignore', `first_check` = '1' WHERE `user_name` = '$name'");
							echo 102;
						}
						else {
							echo 103;
						}
					}
					else {
						echo 1;
					}
				}
				else {
					echo 1;
				}
	
	}	
	elseif ($data['user_rank'] >= 1 && $data['user_access'] == 4 && $set_ignore == "get_friends"){
	
				$data_target = $mysqli->real_escape_string(trim($_GET['target']));
				$ff = $mysqli->query("SELECT user_name, guest  FROM users WHERE user_name = '$data_target'");
				if ($ff->num_rows > 0){
					$tf = $ff->fetch_array(MYSQLI_BOTH);
					$fn = $tf['user_name'];
					if($tf['guest'] !== 1){
					$cf = $mysqli->query("SELECT * FROM friends WHERE target = '$fn' AND hunter = '$name' OR target = '$name' AND hunter = '$fn'");
						if($cf->num_rows < 1){
							$mysqli->query("INSERT INTO friends (hunter, target, status) VALUES ('$name', '$fn', '0')");
							echo 105;
						}
						else {
							echo 104;
						}
					}
					else {
						echo 1;
					}
				}
				else {
					echo 1;
				}
	
	}
	else {
		die();
	}
	
?>