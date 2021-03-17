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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_email, users.user_description, users.user_theme, users.user_id';
require_once("config1.php");

if($access == 'off'){
	die();
}

if(isset($_POST['set_age']) && isset($_POST['set_gender']) && isset($_POST['set_description']) && isset($_POST['set_country']) && isset($_POST['set_region']) && isset($_POST['custom1']) && isset($_POST['custom2'])){

	$me = $data['user_name'];
	$my_age = $mysqli->real_escape_string(trim($_POST['set_age']));
	$my_gender = $mysqli->real_escape_string(trim($_POST['set_gender']));
	$my_description = $mysqli->real_escape_string(trim($_POST['set_description']));
	$my_sound = $mysqli->real_escape_string(trim($_POST['set_sound']));
	$my_country = $mysqli->real_escape_string(trim($_POST['set_country']));
	$my_region = $mysqli->real_escape_string(trim($_POST['set_region']));
	$mycust1 = $mysqli->real_escape_string(trim($_POST['custom1']));
	$mycust2 = $mysqli->real_escape_string(trim($_POST['custom2']));
	$my_age = htmlspecialchars($my_age);
	$my_gender = htmlspecialchars($my_gender);
	$my_sound = htmlspecialchars($my_sound);
	$my_description = htmlspecialchars($my_description);
	$my_country2 = str_replace(" ","_",$my_country);
	$mycust1 = htmlspecialchars($mycust1);
	$mycust2 = htmlspecialchars($mycust2);
	
	if($mycust1 == "clear"){
		$mycust1 = "";
	}
	if($mycust2 == "clear"){
		$mycust2 = "";
	}
	
	
	if(!empty( $_POST["set_description"] )){
		$my_description = $my_description;
	}
	else {
		$my_description = $data['user_description'];
	}
	if($my_country == $uphidden || $my_region == $uphidden){
		$mysqli->query("UPDATE `users` SET `user_age` = '$my_age', `user_sex` = '$my_gender', `user_description` = '$my_description'
		, `user_sound` = $my_sound, `country` = '', `region` = '', `custom1` = '$mycust1', `custom2` = '$mycust2' WHERE `user_name` = '$me'");
		echo 1;
		die();
	}
	else {
		if( strpos(file_get_contents("location/country_list.txt"),$my_country) !== false && $my_country != "" &&  strpos(file_get_contents("location/regions/" . $my_country2 . ".php"), $my_region) !== false && $my_region != "") {
			$mysqli->query("UPDATE `users` SET `user_age` = '$my_age', `user_sex` = '$my_gender', `user_description` = '$my_description'
			, `user_sound` = $my_sound, `country` = '$my_country', `region` = '$my_region', `custom1` = '$mycust1', `custom2` = '$mycust2' WHERE `user_name` = '$me'");
			echo 1;
			die();
		}
		else {
			echo 2;
			die();
		}
	}
}
else{
	echo 2;
	die();
}
?>