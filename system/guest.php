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

echo "<div id=\"login_error\"><div class=\"error\" id=\"login_error_inside\"></div></div>
		<form class=\"login_form\" autocomplete=\"off\">
			<input style=\"display:none\">
			<input type=\"password\" style=\"display:none\">
			<p class=\"login_label\">$lang_guest_name</p>
			<input id=\"guest_username\" class=\"input_data background_box\" type=\"text\" maxlength=\"{$setting['max_username']}\" name=\"username\">
			<div class=\"sub_button hover_element\" id=\"guest_ok\"><p>$activate_ok</p></div>
			<div id=\"login_guest\"><p>$back_login</p></div>
			</form>";

?>