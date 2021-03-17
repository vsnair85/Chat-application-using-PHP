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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_theme';
require_once("config1.php");

	$me = $data['user_name'];
	$factive = $mysqli->query("SELECT * FROM friends WHERE hunter = '$me' AND status = '1' OR target = '$me' AND status = '1' ORDER BY hunter ASC, Target ASC");
	$fonline = "";
	$faway = "";
	$fgone = "";
	
	if($factive->num_rows > 0){
		while($friend = $factive->fetch_assoc()){
			if($friend['hunter'] == $data['user_name']){
				$lf = $friend['target'];
			}
			else {
				$lf = $friend['hunter'];
			}
			$fs = $mysqli->query("SELECT user_status FROM users WHERE user_name = '$lf'");
			if($fs->num_rows > 0){
				$fstat = $fs->fetch_array(MYSQLI_BOTH);
				if($fstat['user_status'] == 1){
					$status = "online";
					$fonline .=  friends($lf, $status, $icon_path);
				}
				if($fstat['user_status'] == 2){
					$status = "away";
					$faway .=  friends($lf, $status, $icon_path);
				}
				if($fstat['user_status'] == 3){
					$status = "gone";
					$fgone .=  friends($lf, $status, $icon_path);
				}
			}
		}
		echo $fonline;
		echo $faway;
		echo $fgone;
	}
	else {
		echo "$lang_friend_list_empty";
	}
?>