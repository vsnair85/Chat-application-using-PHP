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

$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_theme, users.user_access';
require_once("config1.php");
	
	if(isset($_POST['friend']) && $data['user_access'] == 4){
	
		$name = $data['user_name'];
		$target = $mysqli->real_escape_string(trim($_POST['friend']));
		
			$ff = $mysqli->query("SELECT user_name, guest FROM users WHERE `user_name` = '$target'");
			if ($ff->num_rows > 0){
				$tf = $ff->fetch_array(MYSQLI_BOTH);
				$fn = $tf['user_name'];
				if($data['user_name'] !== $tf['user_name'] && $tf['guest'] !== 1){
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
		echo 2;
		die();
	}
?>