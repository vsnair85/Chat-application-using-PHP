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

if($setting['full_form'] == 0){
	$count_online = $mysqli->query("SELECT user_id FROM users WHERE user_status < '3'");
	$online_count = $count_online->num_rows;
}
$facebook = mysqli_fetch_array($mysqli->query("SELECT * FROM `facebook` WHERE `id` = '1'"));

if($setting['registration'] == 1 ){
echo "<div id=\"login_error\"><div class=\"error\" id=\"login_error_inside\"></div></div>";
echo "<div id=\"content_login_left\">
<form class=\"login_form\" autocomplete=\"off\">
	<input style=\"display:none\">
	<input type=\"password\" style=\"display:none\">
	<p class=\"login_label\">$lang_username</p>
	<input id=\"reg_username\" class=\"input_data background_box\" type=\"text\" maxlength=\"{$setting['max_username']}\">
	<p class=\"login_label\">$lang_password</p>
	<input id=\"reg_password\" class=\"input_data background_box\" maxlength=\"30\" type=\"password\">
	<p class=\"login_label\">$lang_email</p>
	<input id=\"reg_email\" class=\"input_data background_box\" maxlength=\"80\" type=\"text\">";
	if($setting['full_form'] != 1){
		if($setting['rules'] == 1){
			echo "<input id=\"user_agree\" class=\"agree_rules agree_normal\" type=\"checkbox\"/><p class=\"rules_p rules_p_normal\">$lang_chat <a class=\"sub_color rules_link\" value=\"rules_panel\">$lang_agree</a></p>";
		}
		else {
			echo "<input id=\"user_agree\" type=\"hidden\" checked=\"checked\"/>";
		}
		echo "<div id=\"login_control\">
			<div class=\"sub_button hover_element selected_element\" id=\"register_button\"><p>$lang_register</p></div>
			<div class=\"sub_button hover_element\" id=\"login_login\"><p>$lang_login</p></div>
		</div>";
	}
	echo "</form>";
	echo "<div class=\"clear\"></div>";
echo "</div>";
if($setting['full_form'] == 1){
	echo "<div id=\"content_login_right\">
	<form class=\"login_form\" autocomplete=\"off\">
		<p class=\"login_label\">$lang_country</p>
			<select id=\"login_select_country\" class=\"login_select\">";
				echo "<option>$lang_select_country</option>";
				$fcountry = fopen("location/country_list.txt", "r");
				if ($fcountry) {
					while (($line = fgets($fcountry)) !== false) {
						echo "<option>$line</option>";
					}

					fclose($fcountry);
				}
			echo "</select>
		<p class=\"login_label\">$lang_region</p>
			<select id=\"login_select_region\" class=\"login_select\">
			</select>
		<div id=\"login_gage\">
			<div id=\"login_sexe\">
				<p class=\"login_label\">$lang_sex</p>
				<select id=\"login_select_gender\" class=\"login_select\">
					<option value=\"1\">$lang_male</option>
					<option value=\"2\">$lang_female</option>
				</select>
			</div>
			<div id=\"login_age\">
				<p class=\"login_label\">$lang_age</p>
				<select size=\"1\" id=\"login_select_age\" class=\"login_select\">";
					for($value = $setting['min_age']; $value <= 99; $value++){
								echo "<option value=\"$value\">$value</option>";
					}	
				echo "</select>
			</div>
		</div>
	</form>
	<div class=\"clear\"></div>";
	echo "</div>";
echo "<div id=\"full_form_submit\">
		<div id=\"fsubmit_rules\">";
		if($setting['rules'] == 1){
			echo "<input id=\"user_agree\" class=\"agree_rules\" type=\"checkbox\"/><p class=\"rules_p\">$lang_chat <a class=\"sub_color rules_link\" value=\"rules_panel\">$lang_agree</a></p>";
		}
		else {
			echo "<input id=\"user_agree\" type=\"hidden\" checked=\"checked\"/>";
		}
		echo "<div class=\"clear\"></div>
		</div>
		<div id=\"fsubmit_control\">
			<div id=\"login_control\">
				<div class=\"sub_button hover_element selected_element\" id=\"register_button\"><p>$lang_register</p></div>
				<div class=\"sub_button hover_element\" id=\"login_login\"><p>$lang_login</p></div>
				<div class=\"clear\"></div>
			</div>
		</div>
		<div class=\"clear\"></div>
	</div>";
}
else {
	echo "<div id=\"content_login_right\">";
	if($facebook['flogin'] == 1){
		if($embed == 1){
			echo "<button class=\"fbl_button\" onclick=\"window.location.href='facebook_login.php?embed=1'\"><i class=\"fa fa-facebook-square ficon_login\"></i>$lang_fblogin</button>";
		}
		else {
			echo "<button class=\"fbl_button\" onclick=\"window.location.href='facebook_login.php'\"><i class=\"fa fa-facebook-square ficon_login\"></i>$lang_fblogin</button>";
		}
	}
	if( $setting['allow_guest'] == 1 ){
		if( $facebook['flogin'] == 1 ){
			echo "<div class=\"sub_button hover_element\" id=\"guest_button\"><p>$guest_button</p></div>";
		}
		else {
			echo "<div class=\"sub_button hover_element nofb\" id=\"guest_button\"><p>$guest_button</p></div>";
		}
	}
	if( $setting['alogin'] == 2 ){
		if($facebook['flogin'] == 1 || $setting['allow_guest'] == 1){
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
}
}
else {
	echo 1;
}

?>