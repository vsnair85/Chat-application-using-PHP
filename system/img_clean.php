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
$load_data = 'setting.language, setting.default_theme, setting.timezone, setting.img_clean, setting.allow_theme, users.user_theme';
require_once("config1.php");

if($data['img_clean'] == '0'){
	die();
}
if($user['user_rank'] > 3){

	$img_expire = $time - $data['img_clean'];
	
	$clear_image = $mysqli->query("SELECT * FROM images WHERE date_sent < '$img_expire'");
	if($clear_image->num_rows > 0){
		while ($imglink = $clear_image->fetch_assoc())
		{
			unlink('../upload/' . $imglink['file_name'] );
		}
		$mysqli->query("DELETE FROM images WHERE date_sent < '$img_expire'");
		$mysqli->query("DELETE FROM chat WHERE file < '$img_expire' AND file != '0'");
		$mysqli->query("DELETE FROM private WHERE file < '$img_expire' AND file != '0'");
	}
	else{
		die();
	}
	
}
else {
	die();
}
?>