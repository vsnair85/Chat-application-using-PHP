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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.allow_private, users.user_name, users.user_theme, users.user_rank';
require_once("config1.php");
require_once("content_process.php");
	
$me = $data['user_name'];
$factive = $mysqli->query("SELECT DISTINCT hunter, target, user_status, user_name, user_tumb FROM friends, users WHERE friends.target = users.user_name AND friends.hunter = '$me' AND friends.status = '1' OR friends.target = '$me' AND friends.hunter = users.user_name AND friends.status = '1' ORDER BY hunter ASC, Target ASC");


$fpending = $mysqli->query("SELECT hunter FROM friends WHERE target = '$me' AND status = '0'");
$fonline = "";
$faway = "";
$fgone = "";
$friend_count = $fpending->num_rows;

// check if pending friend to display friend count 
if($friend_count > 0){
	$f_count = '<span class="friend_span">' . $friend_count . '</span>';
}
else {
	$f_count = '';
}

// section active friends menu
echo '<div id="menu_friend">
		<button class="button_half friend_button selected_element sub_button button_left" value="active_friend">' . $friend_act . '</button>
		<button class="button_half friend_button sub_button button_right" value="pending_friend">' . $friend_pend . ' ' . $f_count . '</button>
		<div class="clear"></div>
	</div>';
	
echo '<div id="friend_container">';
if($factive->num_rows > 0){
	while($friend = $factive->fetch_assoc()){
		
		$lf = $friend['user_name'];
		$tumb = $friend['user_tumb'];
		
		if($friend['user_status'] == 1){
			$status = "online";
			$fonline .=  friends($lf, $status, $icon_path, $tumb, $usinfo, $usprivate, $remv_friend, $data['user_rank'], $data['allow_private']);
		}
		if($friend['user_status'] == 2){
			$status = "away";
			$faway .=  friends($lf, $status, $icon_path, $tumb, $usinfo, $usprivate, $remv_friend, $data['user_rank'], $data['allow_private']);
		}
		if($friend['user_status'] == 3){
			$status = "gone";
			$fgone .=  friends($lf, $status, $icon_path, $tumb, $usinfo, $usprivate, $remv_friend, $data['user_rank'], $data['allow_private']);
		}
	}
	echo '<ul>' . $fonline . $faway . $fgone . '</ul>';
}
else {
	echo '<p class="centered_element">' . $lang_friend_list_empty . '</p>';
}
echo '</div>';
?>