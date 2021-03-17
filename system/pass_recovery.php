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
	
	<p class=\"login_label\">$user_recover</p>
	<input id=\"recovery_username\" class=\"input_data background_box\" type=\"text\" maxlength=\"{$setting['max_username']}\">

	<p class=\"login_label\">$lang_email</p>
	<input id=\"recovery_email\" class=\"input_data background_box\" maxlength=\"80\" type=\"text\">
	<div class=\"sub_button hover_element\" id=\"recovery_button\"><p>$recovery</p></div>
	<div id=\"login_login\"><p>$lang_login</p></div>
</form>";


?>