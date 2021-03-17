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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.allow_ignore, users.user_theme, users.user_ignore, users.user_access, users.user_rank';
require_once("config1.php");

// show rooms list
if($data['user_rank'] < $data['allow_ignore']){
	echo '<p class="sub_color centered_element">' . $feature_block . '</p><br/>';
}
if($data["user_access"] >= 1){
	$list = trim($data['user_ignore']);
	if($list !== ""){
		$ignore = explode(' ',trim($data['user_ignore']));
		foreach($ignore as $result) {
			echo "<div class=\"container_element sub_element hover_element\"><div class=\"wrap_element\"><div class=\"element_name\"><p>$result</p></div><div class=\"delete_element delete_ignore\"><button value=\"$result\" type=\"button\"><i class=\"remove_element remove_private fa fa-2x fa-close\"></i></button></div></div></div>";
		}
	}
	else {
		echo '<p class="centered_element">' . $ignore_empty . '</p>';
	}
}
else {
	echo '<p class="centered_element">' . $lang_error . '</p>';
}
?>