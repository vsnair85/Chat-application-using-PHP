<?php
	require_once("../system/config.php");
	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["confirm"]))
	{
		$user_ip = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
		$user_name = $mysqli->real_escape_string(trim($_POST["username"]));
		$user_password = $mysqli->real_escape_string(trim($_POST["password"]));
		$user_email = $mysqli->real_escape_string(trim($_POST["email"]));
		$confirm_password = $mysqli->real_escape_string(trim($_POST["confirm"]));
			
			if (preg_match("/^[a-zA-Z0-9]+$/", $user_name) && strlen($user_name) < $setting['max_username'])
			{
						if (filter_var($user_email, FILTER_VALIDATE_EMAIL))
						{
							if( $confirm_password == $user_password){
								$action = time();
								$user_password = sha1(str_rot13($user_password . $encryption));
								
								$mysqli->query("INSERT INTO `users` (user_name, user_password, user_ip, user_email, last_action, user_roomid, user_rank, user_color, user_join) VALUES ('$user_name', '$user_password', '$user_ip', '$user_email', '$action', '1', '5', 'sadmin', '$action')") or die($mysqli->error);
								$mysqli->query("INSERT INTO `private` (time, target, hunter, message, target_color, hunter_color, avatar) VALUES ('$time', '$user_name', '$lang_system', '$boomwelcome', 'user', 'system', 'default_system_tumb.png')");
								setcookie("username","$user_name",time()+ (1000 * 1000));
								setcookie("password","$user_password",time()+ (1000 * 1000));
								$dirname = $user_name;
								$filename = "../upload/" . $dirname . "/";
								if(!file_exists($filename)){
									$oldmask = umask(0);
									mkdir("../upload/" . $dirname, 0777);
									umask($oldmask); 
								}
								echo 1;
							}
							else {
								echo 3;
							}
							
						}
						else {
							echo 4;
						}
			}
			else
			{
				echo 5;
			}
	}
	else{
		echo 6;
	}
?>