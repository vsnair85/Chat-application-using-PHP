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
		
if(isset($_POST['delete_friend']) && $data['user_access'] == 4){
	$remove = $mysqli->real_escape_string(trim($_POST['delete_friend']));
	$me = $data['user_name'];
	$mysqli->query("DELETE FROM friends WHERE hunter = '$me' AND target = '$remove' OR hunter = '$remove' AND target = '$me'");
	echo 1;
}
else{
	echo 2;
	die();
}
?>