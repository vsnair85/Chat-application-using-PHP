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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_theme, users.user_id, users.user_ignore, users.user_access';
require_once("config1.php");
		
if(isset($_POST['delete_ignore']) && $data['user_access'] == 4){
	$remove = $mysqli->real_escape_string(trim($_POST['delete_ignore']));
	$me = $data['user_id'];
	$list = $data['user_ignore'];
	$new_list = str_replace(" $remove ", " ", $list);
	$mysqli->query("UPDATE `users` SET `user_ignore` = '$new_list', `first_check` = '1' WHERE `user_id` = '$me'");
	echo 1;
}
else{
	echo 2;
	die();
}
?>