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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_theme, users.user_access, users.user_avatar';
require_once("config1.php");

// show and reload user avatar
if($data['user_access'] == 4 && $access == 'on'){

	echo "<img class=\"profile_avatar\" src=\"avatar/" . $data['user_avatar'] . "\"/>";
}
else {
	die();
}
?>