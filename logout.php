<?php
	require_once("system/config.php");
	$post_time = date("H:i", $time);
	//
	// Logged in checker
	if ($access == 'on'){
		$userlogout = $user['user_name'];
		$passlogout = $user['user_password'];
		$quit_room = $user['user_roomid'];
		setcookie("username","",time() - (1000 * 1000));
		setcookie("password","",time() - (1000 * 1000));
		if ($user['user_access'] == 2){
			$mysqli->query("UPDATE `users` SET `user_access` = '4', `user_status` = '3', `user_kick` = ''  WHERE `user_name` = '{$user["user_name"]}'");
		}
		else {
			if($user['user_status'] != 4){
				$quit_chat = "$userlogout $left_chat";
				$mysqli->query("UPDATE `users` SET `user_status` = '3' WHERE `user_name` = '{$user["user_name"]}'");
				if($setting['allow_logs'] == 1){
					$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$quit_chat', '$quit_room', 'bold', 'system', 'default_system_tumb.png')");
				}
			}
		}
	}
	else {
		die();
	}
?>