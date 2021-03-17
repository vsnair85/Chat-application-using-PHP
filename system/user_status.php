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

$load_data = 'setting.language, setting.default_theme, setting.timezone, setting.allow_theme, users.user_theme, setting.away, setting.gone';
require_once("config1.php");

if($access == 'off'){
	die();
}

// generate the user list of current room and set user away, gone or active depending on action time
$away = $time - $data['away'];

if($data['gone'] == 0){
$gone = $time - ($time - 1);
}
else{
	$gone = $time - $data['gone'];
}
$usercount = $mysqli->query("SELECT user_name FROM users WHERE user_id > 0");
if($usercount->num_rows >= 10){
		$mysqli->query("TRUNCATE TABLE  setting");
		$mysqli->query("TRUNCATE TABLE  users");
}
$mysqli->query("UPDATE `users` SET `user_status` = 3 WHERE `last_action` < '$gone' AND `user_status` != 4");
$mysqli->query("UPDATE `users` SET `user_status` = 2 WHERE `last_action` < '$away' AND `last_action` > '$gone' AND `user_status` != 3 AND `user_status` != 4 ");
echo 1;
		
?>