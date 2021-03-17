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
require_once("config.php");
$embed = 0;
if(isset($_GET['embed'])){
	if($_GET['embed'] == 1){
		$embed = 1;
	}
}
$count_online = $mysqli->query("SELECT user_id FROM users WHERE user_status < '3'");
$online_count = $count_online->num_rows;

$facebook = mysqli_fetch_array($mysqli->query("SELECT * FROM `facebook` WHERE `id` = '1'"));


echo "<div id=\"login_error\"><div class=\"error\" id=\"login_error_inside\"></div></div>";
echo "<div id=\"content_login_left\">";
echo "<form class=\"login_form\" autocomplete=\"off\">
			<input style=\"display:none\">
			<input type=\"password\" style=\"display:none\">
			<p class=\"login_label\">$lang_username</p>
			<input id=\"user_username\" class=\"input_data background_box\" type=\"text\" maxlength=\"50\" name=\"username\">
			<p class=\"login_label\">$lang_password</p>
			<input id=\"user_password\" class=\"input_data background_box\" maxlength=\"30\" type=\"password\" name=\"password\"><br />
			<p class=\"login_label sub_color forgot_password\">$lang_forgot</p>
			<div id=\"login_button\" class=\"sub_button hover_element selected_element\"><p>$lang_login</p></div>";
			
			if($setting['registration'] == 1)
			{
				echo "<div class=\"sub_button hover_element\" id=\"login_register\"><p>$lang_register</p></div>";
			}
			echo "<div class=\"clear\"></div>";
			echo "</form>";
echo "</div>";
echo "<div id=\"content_login_right\">";
if($facebook['flogin'] == 1 && $embed == 0){
	echo "<button class=\"fbl_button\" onclick=\"window.location.href='facebook_login.php'\"><i class=\"fa fa-facebook-square ficon_login\"></i>" . $lang_fblogin . "</button>";
}
if($setting['allow_guest'] == 1){
	if($facebook['flogin'] == 1 && $embed == 0){
		echo "<div class=\"sub_button hover_element\" id=\"guest_button\"><p>$guest_button</p></div>";
	}
	else {
		echo "<div class=\"sub_button hover_element nofb\" id=\"guest_button\"><p>$guest_button</p></div>";
	}
}
if($setting['alogin'] == 2){
	if($facebook['flogin'] == 1 && $embed == 0 || $setting['allow_guest'] == 1){
		echo '<div class="bridge_button sub_button hover_element" id="bridge_login"><p>' . $lang_blogin . '</p></div>';	
	}
	else {
		echo '<div class="bridge_button2 sub_button hover_element" id="bridge_login"><p>' . $lang_blogin . '</p></div>';	
	}
}
echo "<div id=\"login_welcome\">
				<h3 class=\"sub_color\">" . $setting['welcome_login_title'] . "</h3>
				<p>" . $setting['welcome_login'] . "</p>
			</div>";
echo "</div>";

?>