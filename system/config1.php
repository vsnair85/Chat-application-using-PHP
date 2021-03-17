<?php
	if (!isset($_COOKIE["username"]) || !isset($_COOKIE["password"])){
		die();
	}
	$time = ceil(time());
	$access = 'on';
	require_once("database.php");
	date_default_timezone_set("America/Montreal");
	
	$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	if (mysqli_connect_errno()) { 
		die();
	}
	else{
		$cookiep = $mysqli->real_escape_string(trim($_COOKIE["password"]));
		$cookieu = $mysqli->real_escape_string(trim($_COOKIE["username"]));
		
		$get_data = $mysqli->query("SELECT $load_data FROM users, setting WHERE users.user_name = '$cookieu' AND users.user_password = '$cookiep' AND setting.id = '1'");
		
		if($get_data->num_rows > 0){
			$data = $get_data->fetch_array(MYSQLI_BOTH);
			if($data['allow_theme'] == 1){
				$icon_set =  $data['user_theme']; 
			} 
			else { 
				$icon_set = $data['default_theme'];
			}
			$icon_path = "css/themes/$icon_set/icon";
			require_once("language/" . $data['language'] . "/language.php");
			date_default_timezone_set("{$data['timezone']}");
		}
		else {
			$access = 'off';
		}
	}
?>