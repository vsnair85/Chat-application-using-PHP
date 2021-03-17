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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_rank, users.user_name, users.user_theme';
require_once("config1.php");

if($data['user_rank'] < 4){
	die();
}

	echo "<div id=\"room_error\"><p class=\"error\"></p></div>";
	echo "<div id=\"container_room\">";
	echo "<div id='add_room' class=\"bottom_separator\">
		<p class=\"label_panel\">$lang_add_room</p>
		<div class=\"option_setting\">
			<input class=\"background_box\" id=\"add_room_name\" type=\"text\" maxlength=\"30\" placeholder=\"$lang_room\"/>
			<select id=\"room_access\">
				<option value=\"1\">$opublic</option>
				<option value=\"2\">$ovip</option>
				<option value=\"3\">$ostaff</option>
				<option value=\"4\">$oadmin</option>
			</select>
		</div>
		<button class=\"sub_button hover_element\" type=\"button\" id=\"add_room_button\">$lang_room2</button>
		<div class=\"clear\"></div>
	</div>
	<div id=\"room_all\" class=\"top_separator\">
		<div id=\"top_setting_option\">
			<button id=\"access1\" class=\"button_half room_select_button sub_button button_left\" value=\"access1\">$opublic $oroom</button>
			<button id=\"access2\" class=\"button_half room_select_button sub_button button_right\" value=\"access2\">$ovip $oroom</button>
			<button id=\"access3\" class=\"button_half room_select_button sub_button button_left\" value=\"access3\">$ostaff $oroom</button>
			<button id=\"access4\" class=\"button_half room_select_button sub_button button_right\" value=\"access4\">$oadmin $oroom</button>
			<div class=\"clear\"></div>
		</div>";
	$rooms = $mysqli->query("SELECT * FROM `rooms` WHERE `room_id` >=  1");
	if ($rooms->num_rows > 0)
	{
			while ($room = $rooms->fetch_assoc())
			{
				echo "<div class=\"all_room container_element sub_element hover_element access{$room['access']}\"><div class=\"wrap_element\"><div class=\"element_name\"><p>{$room['room_name']}</p></div><div class=\"delete_element delete_room\"><button type=\"button\" value=\"{$room['room_id']}\"><i class=\"remove_element close_room remove_private fa fa-2x fa-close\"></i></button></div></div></div>";
			}
	}
	echo "<div class=\"clear\"></div></div>";
	echo "</div>";
?>