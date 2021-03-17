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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_theme, users.user_access, users.user_rank';
require_once("config1.php");

// add bad word to the database 
if(isset($_POST['word']) && $data['user_rank'] >= 4 && $data['user_access'] > 3){
	
	$word = $mysqli->real_escape_string(trim($_POST['word']));
	$mysqli->query("INSERT INTO `filter` (word) VALUES ('$word')");

}
// delete badword from the database
if(isset($_POST['delete_word']) && $data['user_rank'] >= 4){
	
	$word = $mysqli->real_escape_string(trim($_POST['delete_word']));
	$mysqli->query("DELETE FROM `filter` WHERE `word` = '$word'");

}


?>