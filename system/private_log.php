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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_id, users.user_theme, users.user_access';
require_once("config1.php");

if ($data["user_access"] == 4){
	$mysqli->query("UPDATE `users` SET `first_check` = '1',`join_chat` = '1' WHERE `user_id` = '{$data["user_id"]}'");
	echo 1;
}
else{
	echo 22;
}

?>