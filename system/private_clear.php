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
?>

<?php 
	if ($data["user_access"] == 4){
		$target = $mysqli->real_escape_string(trim($_POST['target']));
		$me = $data["user_name"];
		$mysqli->query("UPDATE `private` SET `status` = 3, `view` = 1  WHERE `hunter` = '$target' AND `target` = '$me'");
		echo 1;
	}
	else {
		die();
	}

?>