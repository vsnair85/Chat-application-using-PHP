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
$load_data = 'setting.language, setting.default_theme, setting.timezone, setting.allow_theme, users.user_theme, users.user_name';
require_once("config1.php");

$me = $data['user_name'];

if(isset($_POST['accept'])){
	
	$target = $mysqli->real_escape_string(trim($_POST['accept']));
	$mysqli->query("UPDATE friends SET status = '1' WHERE target = '$me' AND hunter = '$target' OR target = '$target' AND hunter = '$me'");
	echo 1;
}
else if(isset($_POST['decline'])){
	$target = $mysqli->real_escape_string(trim($_POST['decline']));
	$mysqli->query("DELETE FROM friends WHERE hunter = '$me' AND target = '$target' OR hunter = '$target' AND target = '$me'");
	echo 1;
}
else {
	echo 2;
	die();
}
?>