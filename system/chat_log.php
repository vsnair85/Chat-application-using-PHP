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
	$load_data = 'users.user_access, users.user_rank, users.first_check, users.user_roomid, users.join_chat,
	users.user_name, users.user_ignore, users.user_theme, setting.orientation, setting.maintenance,
	setting.chat_history, setting.allow_link, setting.timezone, setting.allow_theme, users.count,
	setting.default_theme, setting.language';
	
	require_once("config1.php");
	require_once("content_process.php");

	if($access == 'off'){
		echo 1;
		die();
	}
	$newlog = 0;
	$flip = 0;
	$clogs = "";
	$log_reload = 0;
	
	// check for information sent by user
	if(isset($_GET['rank']) && isset($_GET['access']) && isset($_GET['room']) && isset($_GET['bottom']) && isset($_GET['clogs']) && isset($_GET['chr']) && isset($_GET['count'])){
		if($data['orientation'] !== $_GET['bottom']){
			$flip = 1;
		}
		$room = htmlspecialchars($_GET['room']);
		$clog = $mysqli->real_escape_string(trim($_GET['clogs']));
		$clog2 = $mysqli->real_escape_string(trim($_GET['clogs']));
		$countlog = $mysqli->real_escape_string(trim($_GET['count']));
		$rank = htmlspecialchars($_GET['rank']);
		$access = htmlspecialchars($_GET['access']);
		$fload = htmlspecialchars($_GET['chr']);
		$me = $data['user_name'];
		
		if($countlog < $data['count']){
			$log_reload = 1;
		}
		
		$cc = 0;
		$found = 0;
		
		if($data['user_rank'] == $rank && $data['user_access'] == $access && $data['maintenance'] == 1 && $data['user_access'] > 0 || $data['user_rank'] == $rank && $data['user_access'] == $access && $data['user_rank'] >= 3 && $data['user_access'] > 0){

			$data_check = $data['first_check'];
			$new_logs = $mysqli->query("SELECT * FROM chat WHERE  post_id > '$clog' AND (( post_roomid = '{$data['user_roomid']}' AND type != 'private' AND type != 'seen') OR ( type = 'private' AND post_target = '$me' ) OR ( type = 'private' AND post_user = '$me' ) OR ( type = 'seen' AND post_target = '$me' AND post_id > 'system' ))");

			if($new_logs->num_rows > 0 || $_GET['rlc'] == 1 || $fload < 2 || $log_reload == 1){
				
				$fload++;

				if($data['user_roomid'] == $_GET['room']){
				
					$history_chat = $data['chat_history'];
					$join = $data['join_chat'] + 1;
					$me = $data['user_name'];
					$me2 = strtolower($me);
					$logs = 1;
					
						if($data['orientation'] == 1){		
							$log = $mysqli->query("SELECT * FROM `chat` WHERE `post_roomid` = '$room' AND (`type` = 'public' OR `type` = 'system' OR  `type` = 'seen' AND `post_target` = '$me' OR `type` = 'private' AND `post_target` = '$me'  OR `type` = 'private' AND `post_user` = '$me' OR `type` = 'me' OR `type` = 'global') ORDER BY `post_id` DESC LIMIT $history_chat");
						}
						else {
							$log = $mysqli->query("SELECT * FROM ( SELECT * FROM `chat` WHERE `post_roomid` = '$room' AND (`type` = 'public' OR `type` = 'system' OR `type` = 'seen' AND `post_target` = '$me' OR `type` = 'private' AND `post_target` = '$me' OR `type` = 'private' AND `post_user` = '$me' OR `type` = 'me' OR  `type` = 'global') ORDER BY `post_id` DESC LIMIT $history_chat) AS log ORDER BY `post_id` ASC");
						}
						
						if ($log->num_rows > 0){
							if($fload > 4){
								$newlog = 1;
							}
							while ($chat = $log->fetch_assoc()){
								
								if($data['orientation'] == 1){
									if($cc == 0){
										$clog = $chat['post_id'];
										$cc++;
									}
								}
								else {
									$clog = $chat['post_id'];
								}
								
								if( strpos($chat['post_message'], $me) !== false && $chat['post_id'] > $clog2 && $fload > 3 && $chat['post_user'] !== $me){
									$found++;
								}
								
								if($logs == 1){
									$lcolor = 'log1';
								}
								else {
									$lcolor = 'log2';
								}
								if($chat['type'] == 'system'){
									$avatar_path = "$icon_path";
								}
								else if( $chat['user_id'] == '999999'){
									$avatar_path = 'addons_icon';
								}
								else if( $chat['post_user'] == $lang_system){
									$avatar_path = "$icon_path";
								}
								else{
									$avatar_path = 'avatar';
								}
								$uavatar = $chat['avatar'];
								if($uavatar == '' || $uavatar == 'default_avatar_tumb.png'){
									$uavatar = 'default_avatar_tumb.png';
									$avatar_path = "$icon_path";
								}
								$avatar = "<img class=\"avatar_chat\" src=\"$avatar_path/$uavatar\"/>";
								$message = emoprocess(uprocess($me,$me2,$chat['post_message']));
								if($data['allow_link'] == 1){
									$message = emoticon(linking($message, $icon_set));
								}
								else{
									$message = emoticon($message);
								}
									$lgc = $chat['post_id'];
									
									if(!strpos(strtolower($data['user_ignore']), strtolower($chat['post_user']))){
										if($data['user_rank'] >= 3){
												if( strtolower($chat['post_target']) == strtolower($data['user_name']) && $chat['post_user'] != "$lang_system"){
													$clogs .= "<li class=\"log$lgc ch_logs $lcolor " . $chat['type'] . "\"><div value=\"" . $chat['post_user'] . "\" class=\"my_avatar chat_avatar_wrap\">$avatar</div><div class=\"my_text\"><p><span class=\"username " . $chat['post_color'] . "\">" . $chat['post_user'] . "</span> : $message<span class=\"private_reply\" value=\"" . $chat['post_user'] . "\">" . $lreply . "</span></p></div><div class=\"clear\"></div></li>\n";								
												}
												else{
													if($chat['type'] == 'me'){
														$clogs .="<li class=\"log$lgc ch_logs $lcolor " . $chat['type'] . "\"><div value=\"" . $chat['post_user'] . "\" class=\"my_avatar chat_avatar_wrap\">$avatar</div><div class=\"my_text\"><p><span class=\"username " . $chat['post_color'] . "\">" . $chat['post_user'] . "</span> $message<span class=\"logs_date\">" . date("M j G:i", $chat['post_date']) . "</span><span class=\"delete_log\" value=\"" . $chat['post_id'] . "\">x</span></p></div><div class=\"clear\"></div></li>\n";								
													}
													else {
														$clogs .= "<li class=\"log$lgc ch_logs $lcolor " . $chat['type'] . "\"><div value=\"" . $chat['post_user'] . "\" class=\"my_avatar chat_avatar_wrap\">$avatar</div><div class=\"my_text\"><p><span class=\"username " . $chat['post_color'] . "\">" . $chat['post_user'] . "</span> : $message<span class=\"logs_date\">" . date("M j G:i", $chat['post_date']) . "</span><span class=\"delete_log\" value=\"" . $chat['post_id'] . "\">x</span></p></div><div class=\"clear\"></div></li>\n";								
													}
												}
										}
										else {
												if( strtolower($chat['post_target']) == strtolower($data['user_name']) && $chat['post_user'] != "$lang_system"){
														$clogs .= "<li class=\"ch_logs $lcolor " . $chat['type'] . "\"><div value=\"" . $chat['post_user'] . "\" class=\"my_avatar chat_avatar_wrap\">$avatar</div><div class=\"my_text\"><p><span class=\"username " . $chat['post_color'] . "\">" . $chat['post_user'] . "</span> : $message<span class=\"private_reply\" value=\"" . $chat['post_user'] . "\">" . $lreply . "</span></p></div><div class=\"clear\"></div></li>\n";								
												}
												else{
													if($chat['type'] == 'me'){
														$clogs .= "<li class=\"ch_logs $lcolor " . $chat['type'] . "\"><div value=\"" . $chat['post_user'] . "\" class=\"my_avatar chat_avatar_wrap\">$avatar</div><div class=\"my_text\"><p><span class=\"username " . $chat['post_color'] . "\">" . $chat['post_user'] . "</span> $message<span class=\"logs_date\">" . date("M j G:i", $chat['post_date']) . "</span></p></div><div class=\"clear\"></div></li>\n";								

													}
													else {
														$clogs .= "<li class=\"ch_logs $lcolor " . $chat['type'] . "\"><div value=\"" . $chat['post_user'] . "\" class=\"my_avatar chat_avatar_wrap\">$avatar</div><div class=\"my_text\"><p><span class=\"username " . $chat['post_color'] . "\">" . $chat['post_user'] . "</span> : $message<span class=\"logs_date\">" . date("M j G:i", $chat['post_date']) . "</span></p></div><div class=\"clear\"></div></li>\n";								
													}
												}
										}
										if($logs == 1){
											$logs = 2;
										}
										else {
											$logs = 1;
										}
									}
							}
							
						}
						else {
							$clogs .= "<li class=\"ch_logs system\"><div class=\"my_avatar chat_avatar_wrap zzzTTmmm \"><img class=\"avatar_chat\" src=\"$icon_path/default_system_tumb.png\"/></div><div class=\"my_text\"><p><span class=\"username csystem\">$lang_system</span> : $notext<span class=\"logs_date\">" . date("M j G:i", $time) . "</span></p></div><div class=\"clear\"></div></li>\n";
						}
				}
				else {
					$clogs = 2;
				}
				$clogs = $clogs;
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
		$clogs =  "$lang_error";
	}
	
	if($flip == 1){ $clogs = 1000; }
	
	$lastlog = $clog;
	$rlc = 0;
	$clearlog = $data['count'];
	
	echo json_encode( array("log1" => $clogs, "log2" => $lastlog, "log3"=> $fload, "log4"=> $found, "log5"=> $rlc, "log6"=> $newlog, "log7"=> $clearlog));
?>