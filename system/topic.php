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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language,
setting.allow_avatar, users.user_theme, users.user_rank, users.user_access, users.user_roomid';

require_once("config1.php");
if($access == 'off'){ die();}

// show the topic for current room
$myroom = $data['user_roomid'];
if($data["user_access"] >= 1){
	$room_topic = $mysqli->query("SELECT `room_name`, `topic` FROM `rooms` WHERE `room_id` = '$myroom'");
	if ($room_topic->num_rows > 0)
	{
		$topic = $room_topic->fetch_array(MYSQLI_BOTH);
		if ($topic['topic'] != ''){
			$finaltopic = $topic['topic'];
			$finalroom = $topic['room_name'];
			echo "<span class=\"topic sub_color\">$topicname</span> : $finaltopic";
		}
		else {
			echo "<span class=\"topic sub_color\">$topicname</span> : $msgtopic";
		}
	}
}
else {
	echo "<span class=\"topic sub_color\">$topicname</span> : $msgtopic";
}
?>