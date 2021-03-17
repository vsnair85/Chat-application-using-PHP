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
$load_data = 'setting.language, setting.default_theme, setting.timezone, setting.allow_theme, users.user_theme';
require_once("config1.php");

if($access == 'off'){
	die();
}

?>
<div id="search_top">
	<label><?php echo $search_user2; ?></label><br/>
	<input type="text" class="news_title_zone" id="find_user" />
	<button id="search_button"  class="sub_button hover_element full_button" type="button"><?php echo $search_user; ?></button> 
</div>
<div id="search_result">
</div>