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
require_once("content_process.php");


if ($data["user_access"] == 4){



	$target = $mysqli->real_escape_string(trim($_GET['target']));
	$hunter = $data["user_name"];
	
	$log = $mysqli->query("SELECT * FROM ( SELECT * FROM `private` WHERE  `hunter` = '$hunter' AND `target` = '$target'  OR `hunter` = '$target' AND `target` = '$hunter' ORDER BY `id` DESC LIMIT 20) AS log ORDER BY `time` ASC");
	$mysqli->query("UPDATE `private` SET `status` = 1 WHERE `hunter` = '$target' AND `target` = '$hunter'");
	
	if ($log->num_rows > 0){
		while ($chat = $log->fetch_assoc()){
		
		$message = emoprocess($chat['message']);
		$ptime = date("m/j G:i", $chat['time']);
			$message = emoticon(linking($message, $icon_set));
			if($chat['hunter'] == $data['user_name']){
				echo "<li class=\"hunter_private\"><p>$message</p><p class=\"ptime\">$ptime</p></li>\n";
			}
			else {
				echo "<li class=\"target_private\"><p>$message</p><p class=\"ptime2\">$ptime</p></li>\n";
			}
		}
	}
	else {
		echo "<li>$emptyprivate</li>";
	}
}
else{
	echo "<li>$lang_error</li>";
}

?>