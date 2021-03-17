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
$load_data = 'setting.allow_theme, setting.default_theme, setting.language, setting.timezone, users.user_theme, users.user_access, users.user_roomid';
require_once("config1.php");
		
// show rooms list
if($data["user_access"] >= 1){
	$rooms = $mysqli->query("SELECT * FROM `rooms` WHERE `room_id` >=  1 ORDER BY room_name ASC");
	if ($rooms->num_rows > 0)
	{
		echo "<div id=\"container_user_room\">";
			while ($room = $rooms->fetch_assoc())
			{
				$countuser = $mysqli->query("SELECT `user_id` FROM `users` WHERE `user_roomid` = {$room['room_id']} AND `user_status` != '3' AND `user_status` != '4' AND `user_access` != '0' AND `user_access` != '2'");
				$datain = $countuser->num_rows;
				
				$access = $room['access'];
				if($access == 1){
					$type = "   <span class=\"room_type user\">$opublic</span>";
				}
				if($access == 2){
					$type = "   <span class=\"room_type vip\">$ovip</span>";
				}
				if($access == 3){
					$type = "   <span class=\"room_type modo\">$ostaff</span>";
				}
				if($access == 4){
					$type = "  <span class=\"room_type admin\">$oadmin</span>";
				}
				if ($room['room_id'] == $data['user_roomid']){
					echo "<div class=\"roombutton hoverroom  hover_element sub_element selected_element\" id=\"room{$room["room_id"]}\" value=\"{$room["room_id"]}\">
								<div class=\"room_name\"><p>{$room["room_name"]}</p></div><div class=\"room_count\"><p class=\"sub_color\">$type <span class=\"room_userin\">$datain</span></p></div>
						</div>";
				
				}
				else {
					echo "<div class=\"roombutton hover_element sub_element\" id=\"room{$room["room_id"]}\" value=\"{$room["room_id"]}\">
								<div class=\"room_name\"><p>{$room["room_name"]}</p></div><div class=\"room_count\"><p class=\"sub_color\" >$type <span class=\"room_userin\">$datain</span></p></div>
						</div>";
				}
			}
		echo "<div class=\"clear\"></div></div>";
	}
}
else {
	echo "<div>$lang_error</div>";
}
?>