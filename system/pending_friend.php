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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.allow_friend, users.user_name, users.user_theme, users.user_rank';
require_once("config1.php");
require_once("content_process.php");

$me = $data['user_name'];
$fpending = $mysqli->query("SELECT * FROM friends WHERE target = '$me' AND status = '0' ORDER BY hunter ASC, Target ASC");
$fpend = "";
if($data['user_rank'] < $data['allow_friend']){
	echo '<p class="sub_color centered_element">' . $feature_block . '</p><br/>';
}
if($fpending->num_rows > 0){
	while($pendf = $fpending->fetch_assoc()){
		$pf = $pendf['hunter'];
		$fpend .=  friends_pending($pf, $icon_path, $friend_accept, $friend_decline, $data['user_rank'], $data['allow_friend']);
	}
	echo $fpend;
}
else {
	echo '<p class="centered_element">' . $lang_request_empty . '</p>';
}
?>