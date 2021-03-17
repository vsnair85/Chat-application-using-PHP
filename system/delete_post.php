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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name,
users.user_theme, users.user_rank, users.user_access, users.user_roomid';
require_once("config1.php");

// delete a specific post in the database
if(isset($_POST['del_post']) && $data['user_rank'] >= 3 && $data['user_access'] == 4){

	 $post = $mysqli->real_escape_string(trim($_POST['del_post']));
	 $findpost = $mysqli->query("SELECT `post_id` FROM `chat` WHERE `post_id` = '$post'");
	 $room = $data['user_roomid'];
	 
	 if($findpost->num_rows > 0 ){
		$post_time = date("H:i", $time);
		$log_notice = "$post_notice " . $data['user_name'];
		$mysqli->query("DELETE FROM `chat` WHERE `post_id` = '$post'");
		$mysqli->query("UPDATE users SET count = count + 1 WHERE user_roomid = '$room'");
	}
	 else{
		die();
	 }
}
else{
	die();
}
?>