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
if(!isset($_GET['data'])){
	die();
}
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language,
setting.log_history, users.user_name, users.user_theme, users.user_access, users.user_roomid';

require_once("config1.php");

if($access == 'off'){
	die();
}
require_once("content_process.php");

$search_history = $mysqli->real_escape_string(trim($_GET['data']));

$me = $data['user_name'];
$history_lenght = $data['log_history'];
echo "<ul id=\"ul_history\" class=\"background_box\">";
	if($data['user_access'] == 1 || $data['user_access'] == 4 ){
		$data_room = $data['user_roomid'];
		$history = $mysqli->query("SELECT * FROM `chat` WHERE `post_message` LIKE '%$search_history%' AND `type` != 'private' OR `post_target` = '$me' 
		AND `type` = 'private' AND `post_message` LIKE '%$search_history%' OR `post_user` = '$me' AND `type` = 'private' AND `post_message` LIKE '%$search_history%'
		ORDER BY `post_id` DESC LIMIT 50");
		
		while ($log = $history->fetch_assoc()){
			$myself = $data['user_name'];
			$myself2 = strtolower($myself);
			$message = emoprocess(uprocess($myself,$myself2,$log['post_message']));
			$message = emoticon(linking($message, $icon_set));
			if ($log['type'] == 'me'){
				echo "<li class=\"{$log["type"]}\"><span class='datechat'>{$log["post_time"]} </span> <span class='username {$log["post_color"]}'>{$log["post_user"]}</span> $message</li>\n";
			}
			else{
				echo "<li class=\"{$log["type"]}\"><span class='datechat'>{$log["post_time"]} </span> <span class='username {$log["post_color"]}'>{$log["post_user"]}</span> : $message</li>\n";
			}
			
		}
	}
	else{
		echo "$lang_error";
	}
echo "</ul>";
?>