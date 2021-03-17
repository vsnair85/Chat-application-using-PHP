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
$load_data = 'setting.timezone, allow_theme, setting.default_theme, setting.language,
 setting.full_sound, setting.global_sound, setting.allow_private,setting.version,
 users.user_name, users.user_theme, users.user_rank, users.user_roomid, users.user_sound, users.session_id, users.pcount';
 
require_once("config1.php");
		
		$me = $data['user_name'];
		$room = $data['user_roomid'];
		
		$sound = $data['user_sound'];
		$sound = $sound - 0;

		$whistle = $data['global_sound'];

		$check_session = $data['session_id'];
		$fsound = $data['full_sound'];
	
		
		// check if there is new private message
		if($data['user_rank'] >= $data['allow_private']){
			$pcount = $data['pcount'];
			$unique_private = $mysqli->query("SELECT DISTINCT `hunter` FROM `private` WHERE `target` = '$me' AND `hunter` != '$me'  AND `status` = '0' ORDER BY `time` ASC LIMIT 99");
			$icon_result = $unique_private->num_rows;
		}
		else {
			$icon_result = 0;
			$pcount = 0;
		}
		
		// return value of data to jquery as a json variable
		echo json_encode(
			array("bet3" => $sound, "bet12" => $icon_result, "bet13" => $whistle, "bet15" => $fsound, "bet20" => $check_session, "bet21" => $me, "bet22"=> $pcount));
?>