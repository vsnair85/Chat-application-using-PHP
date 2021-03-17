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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.data_delete,
 setting.guest_clear, users.user_access, users.user_theme, users.user_rank';
require_once("config1.php");

if($data['data_delete'] == 60){
	$clean_time = $time - ($data['data_delete'] * 60);
}
else {
	$clean_time = $time - ($data['data_delete'] * 604800);
}
$clean_guest = $time - ($data['guest_clear'] - 1);

// clean the database based on superadmin setting time
if($data['user_rank'] > 3 && $data['user_access'] == 4){
	$mysqli->query("DELETE FROM `chat` WHERE `post_date` < '$clean_time' ");
	$mysqli->query("DELETE FROM `private` WHERE `time` < '$clean_time' ");
	$mysqli->query("DELETE FROM `users` WHERE `last_action` < '$clean_guest' AND `guest` = '1'");
	$mysqli->query("DELETE FROM `private` WHERE `time` < '$clean_guest' AND `hunter_guest` = '1'");
	echo "success";
}
else{
	die();
}
?>