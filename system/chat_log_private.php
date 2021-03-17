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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.orientation,
 setting.maintenance, setting.chat_history, setting.allow_link, users.user_name, users.user_theme, users.user_rank,
 users.user_access, users.first_check, users.join_chat, users.count';
require_once("config1.php");
require_once("content_process.php");
	
	$newlog = 0;
	if ($access == 'off'){
		echo 4;
		die();
	}
	if($access == 'on' && $data['allow_theme'] == 1){
		$use_theme =  $data['user_theme']; 
	} 
	else { 
		$use_theme = $data['default_theme'];
	} 
	// check for information sent by user
	if(isset($_GET['rank']) && isset($_GET['access']) && isset($_GET['room']) && isset($_GET['bottom']) && isset($_GET['target']) && isset($_GET['clogs']) && isset($_GET['chr'])){
		if($data['orientation'] !== $_GET['bottom']){
			echo 1000;
			die();
		}
		$clogs = "";
		$room = htmlspecialchars($_GET['room']);
		$target = htmlspecialchars($_GET['target']);
		$rank = htmlspecialchars($_GET['rank']);
		$access = htmlspecialchars($_GET['access']);
		$clog = $mysqli->real_escape_string(trim($_GET['clogs']));
		$fload = htmlspecialchars($_GET['chr']);
		
		if($data['user_rank'] == $rank && $data['user_access'] == $access && $data['maintenance'] == 1 && $data['user_access'] > 0 || $data['user_rank'] == $rank && $data['user_access'] == $access && $data['user_rank'] >= 3 && $data['user_access'] > 0){

			$data_check = $data['first_check'];
			$new_logs = $mysqli->query("SELECT * FROM `private` WHERE  `id` > '$clog'");
			if($new_logs->num_rows > 0 || $fload < 2){
					
					$fload++;
					$newlog = 1;
					
					$history_chat = $data['chat_history'];
					$join = $data['join_chat'] + 1;
					$me = $data['user_name'];
					$me2 = strtolower($me);
					$mysqli->query("UPDATE `private` SET `status` = 1 WHERE `hunter` = '$target' AND `target` = '$me'");
					$logs = 1;
					
						if($data['orientation'] == 1){		
							$log = $mysqli->query("SELECT * FROM `private` WHERE `hunter` = '$me' AND `target` = '$target' OR `target` = '$me' AND `hunter` = '$target' ORDER BY `id` DESC LIMIT $history_chat");
						}
						else {
							$log = $mysqli->query("SELECT * FROM ( SELECT * FROM `private` WHERE `hunter` = '$me' AND `target` = '$target' OR `target` = '$me' AND `hunter` = '$target' ORDER BY `id` DESC LIMIT $history_chat) AS log ORDER BY `time` ASC");
						}
						
						if ($log->num_rows > 0){

							while ($chat = $log->fetch_assoc()){
								
								if($data['orientation'] == 1){
									if($cc == 0){
										$clog = $chat['id'];
										$cc++;
									}
								}
								else {
									$clog = $chat['id'];
								}
								
								if($logs == 1){
									$lcolor = 'log1';
								}
								else {
									$lcolor = 'log2';
								}
								$uavatar = $chat['avatar'];
								if($chat['hunter_color'] == 'system'){
									$avatar_path = "$icon_path";
									$uavatar = 'default_system_tumb.png';
								}
								else{
									$avatar_path = 'avatar';
								}
								if($uavatar == '' || $uavatar == 'default_avatar_tumb.png'){
									$uavatar = 'default_avatar_tumb.png';
									$avatar_path = "$icon_path";
								}
								$avatar = "<img class=\"avatar_chat\" src=\"$avatar_path/$uavatar\"/>";
								$message = emoprocess(uprocess($me,$me2,$chat['message']));									
								if($data['allow_link'] == 1){
									$message = emoticon(linking($message, $use_theme));
								}
								else{
									$message = emoticon($message);
								}
								$clogs .= "<li class=\"ch_logs $lcolor\"><div class=\"my_avatar chat_avatar_wrap2\">$avatar</div><div class=\"my_text\"><p><span class=\"username " . $chat['hunter_color'] . "\">" . $chat['hunter'] . "</span> : $message<span class=\"logs_date\">" . date("M j G:i", $chat['time']) . "</span></p></div><div class=\"clear\"></div></li>\n";								

								if($logs == 1){
									$logs = 2;
								}
								else {
									$logs = 1;
								}
							}
							
						}
						else {
							$clogs = "<li class=\"ch_logs system\"><div class=\"my_avatar chat_avatar_wrap2\"><img class=\"avatar_chat\" src=\"$icon_path/default_system_tumb.png\"/></div><div class=\"my_text\"><p><span class=\"username csystem\">$lang_system</span> : $emptyprivate<span class=\"logs_date\">" . date("M j G:i", $time) . "</span></p></div><div class=\"clear\"></div></li>\n";
						}
			}
			else{
				$clogs = 99;
			}
		}
		else {
			$clogs = 1;
		}
	}
	else{
		$clogs = "$lang_error";
	}
	$lastlog = $clog;
	$found = 0;
	$rlc = 0;
	$clearlog = $data['count'];
	
	echo json_encode( array("log1" => $clogs, "log2" => $lastlog, "log3"=> $fload, "log4"=> $found, "log5"=> $rlc, "log6"=> $newlog, "log7"=> $clearlog));
?>