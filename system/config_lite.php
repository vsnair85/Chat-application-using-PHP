<?php
	$time = ceil(time());
	$access = 'on';
	require_once("database.php");
	
	$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	if (mysqli_connect_errno() || $check_install != 1) 
	{
		if($check_install != 1){
			$chat_install = 2;
		}
		else{
			$chat_install = 3;
		}
	}
	else{
		$chat_install = 1;
		$setting = mysqli_fetch_array($mysqli->query("SELECT $load_setting FROM `setting` WHERE `id` = 1"));
		if (!isset($_COOKIE["username"]) || !isset($_COOKIE["password"])){
			$access = 'off';
		}
		else
		{
			$cookiepass = $mysqli->real_escape_string(trim($_COOKIE["password"]));
			$cookieuser = $mysqli->real_escape_string(trim($_COOKIE["username"]));
			$exist = $mysqli->query("SELECT $load_user FROM `users` WHERE `user_password` = '{$cookiepass}' AND `user_name` = '{$cookieuser}' OR `old_name` = '{$cookieuser}' AND `user_password` = '{$cookiepass}' AND `old_name` != 'e'");
			if($exist->num_rows > 0){
				$user = $exist->fetch_array(MYSQLI_BOTH);
			}
			else{
				$access = 'off';
				setcookie("username","",time()-100000);
				setcookie("password","",time()-100000);
			}
			
		}
		if($setting['allow_theme'] == 1 && $access == 'on'){
			$icon_set =  $user['user_theme']; 
		} 
		else { 
			$icon_set = $setting['default_theme'];
		}
		$icon_path = "css/themes/$icon_set/icon";
		require_once("language/" . $setting['language'] . "/language.php");
	}
	if($chat_install == 1){
		date_default_timezone_set("{$setting['timezone']}");
	}
	else {
		date_default_timezone_set("America/Montreal");
	}
?>