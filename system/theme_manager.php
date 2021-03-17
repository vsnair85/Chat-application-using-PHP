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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_theme, users.user_id, users.user_access';
require_once("config1.php");
if($access == 'off'){ die(); }

// set user account to theme selected
if (isset($_POST['theme']) && $data['user_access'] == 4 && $data['allow_theme'] == 1){
	
	$target = $data['user_id'];
	$theme= $mysqli->real_escape_string(trim($_POST['theme']));
	$mysqli->query("UPDATE `users` SET `user_theme` = '$theme' WHERE `user_id` = $target");
}
else{
	echo 1;
}

?>