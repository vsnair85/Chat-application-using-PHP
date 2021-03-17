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

	$check_player = $mysqli->query("SELECT * FROM player WHERE id = '1'");
	$player = $check_player->fetch_array(MYSQLI_BOTH);
	
	$faceload = $mysqli->query("SELECT * FROM facebook WHERE id = '1'");
	$facebook = $faceload->fetch_array(MYSQLI_BOTH);
	
	
	$cur_custom = $setting['custom_count'];
	$cur_custom1 = $setting['custom1'];
	$cur_custom2 = $setting['custom2'];
	
	// update setting based on admin setting value
	$data_delay = $setting['data_delete'];
	if(isset($_POST['site_title'])
		&& isset($_POST['site_domain'])
		&& isset($_POST['set_registration'])
		&& isset($_POST['set_maintenance'])
		&& isset($_POST['set_flood'])
		&& isset($_POST['set_unmute'])
		&& isset($_POST['set_default_theme'])
		&& isset($_POST['set_allow_theme'])
		&& isset($_POST['set_log_history'])
		&& isset($_POST['set_chat_history'])
		&& isset($_POST['set_data_delete'])
		&& isset($_POST['set_max_message'])
		&& isset($_POST['set_max_username'])
		&& isset($_POST['set_max_avatar'])
		&& isset($_POST['set_allow_link'])
		&& isset($_POST['set_away']) 
		&& isset($_POST['set_gone']) 
		&& isset($_POST['set_max_hosting'])
		&& isset($_POST['set_emoticon'])
		&& isset($_POST['set_private'])
		&& isset($_POST['set_allow_history'])
		&& isset($_POST['set_upload'])
		&& isset($_POST['set_max_weight'])
		&& isset($_POST['set_ads'])
		&& isset($_POST['set_adsdelay'])
		&& isset($_POST['set_adscount'])
		&& isset($_POST['set_orientation'])
		&& isset($_POST['set_welcome'])
		&& isset($_POST['set_guest'])
		&& isset($_POST['set_guest_chat'])
		&& isset($_POST['set_guest_clear'])
		&& isset($_POST['set_validation'])
		&& isset($_POST['set_cookie'])
		&& isset($_POST['set_email_repeat'])
		&& isset($_POST['set_speed'])
		&& isset($_POST['set_language'])
		&& isset($_POST['set_show_topic'])
		&& isset($_POST['set_private'])
		&& isset($_POST['set_timezone'])
		&& isset($_POST['set_reg_full'])
		&& isset($_POST['set_fwidth'])
		&& isset($_POST['set_news'])
		&& isset($_POST['set_wmsg'])
		&& isset($_POST['set_ntitle'])
		&& isset($_POST['set_rules'])
		&& isset($_POST['set_age'])
		&& isset($_POST['set_logs'])
		&& isset($_POST['set_psound'])
		&& isset($_POST['set_rtl'])
		&& isset($_POST['set_avatar'])
		&& isset($_POST['set_colors'])
		&& isset($_POST['set_allow_friend'])
		&& isset($_POST['set_allow_ignore'])
		&& isset($_POST['set_custom_count'])
		&& isset($_POST['set_custom1'])
		&& isset($_POST['set_custom2'])
		&& isset($_POST['set_allow_username'])
		&& isset($_POST['set_use_player'])
		&& isset($_POST['set_player_url'])
		&& isset($_POST['set_player_status'])
		&& isset($_POST['set_fblogin'])
		&& isset($_POST['set_fbapi'])
		&& isset($_POST['set_fbsecret'])
		&& isset($_POST['set_del_file'])
		&& isset($_POST['set_bridge'])
		&& isset($_POST['set_uhome'])
		&& isset($_POST['set_home'])
		&& $user['user_rank'] > 4 && $user['user_access'] == 4)
		
		{		
		$title = $mysqli->real_escape_string(trim($_POST['site_title']));
		$domain = $mysqli->real_escape_string(trim($_POST['site_domain']));
		$registration = $mysqli->real_escape_string(trim($_POST['set_registration']));
		$maintenance = $mysqli->real_escape_string(trim($_POST['set_maintenance']));
		$flood = $mysqli->real_escape_string(trim($_POST['set_flood']));
		$unmute = $mysqli->real_escape_string(trim($_POST['set_unmute']));
		$theme = $mysqli->real_escape_string(trim($_POST['set_default_theme']));
		$allow_theme = $mysqli->real_escape_string(trim($_POST['set_allow_theme']));
		$chat_log = $mysqli->real_escape_string(trim($_POST['set_chat_history']));
		$history_log = $mysqli->real_escape_string(trim($_POST['set_log_history']));
		$data_delete = $mysqli->real_escape_string(trim($_POST['set_data_delete']));
		$max_message = $mysqli->real_escape_string(trim($_POST['set_max_message']));
		$max_username = $mysqli->real_escape_string(trim($_POST['set_max_username']));
		$max_avatar = $mysqli->real_escape_string(trim($_POST['set_max_avatar']));
		$link = $mysqli->real_escape_string(trim($_POST['set_allow_link']));
		$away = $mysqli->real_escape_string(trim($_POST['set_away']));
		$gone = $mysqli->real_escape_string(trim($_POST['set_gone']));
		$max_hosting = $mysqli->real_escape_string(trim($_POST['set_max_hosting']));
		$emoticon = $mysqli->real_escape_string(trim($_POST['set_emoticon']));
		$private = $mysqli->real_escape_string(trim($_POST['set_private']));
		$history = $mysqli->real_escape_string(trim($_POST['set_allow_history']));
		$upload = $mysqli->real_escape_string(trim($_POST['set_upload']));
		$max_weight = $mysqli->real_escape_string(trim($_POST['set_max_weight']));
		$adson = $mysqli->real_escape_string(trim($_POST['set_ads']));
		$adsdelay = $mysqli->real_escape_string(trim($_POST['set_adsdelay']));
		$adscount = $mysqli->real_escape_string(trim($_POST['set_adscount']));
		$orientation = $mysqli->real_escape_string(trim($_POST['set_orientation']));
		$welcome = $mysqli->real_escape_string(trim($_POST['set_welcome']));
		$guest = $mysqli->real_escape_string(trim($_POST['set_guest']));
		$guest_chat = $mysqli->real_escape_string(trim($_POST['set_guest_chat']));
		$guest_clear = $mysqli->real_escape_string(trim($_POST['set_guest_clear']));
		$validation = $mysqli->real_escape_string(trim($_POST['set_validation']));
		$cookie_ban = $mysqli->real_escape_string(trim($_POST['set_cookie']));
		$email_repeat = $mysqli->real_escape_string(trim($_POST['set_email_repeat']));
		$speed = $mysqli->real_escape_string(trim($_POST['set_speed']));
		$this_lang = $mysqli->real_escape_string(trim($_POST['set_language']));
		$display_topic= $mysqli->real_escape_string(trim($_POST['set_show_topic']));
		$private_setting = $mysqli->real_escape_string(trim($_POST['set_private_style']));
		$set_timezone = $mysqli->real_escape_string(trim($_POST['set_timezone']));
		$reg_size = $mysqli->real_escape_string(trim($_POST['set_reg_full']));
		$shw_avatar = $mysqli->real_escape_string(trim($_POST['set_use_avatar']));
		$sfwidth = $mysqli->real_escape_string(trim($_POST['set_fwidth']));
		$news_title = $mysqli->real_escape_string(trim($_POST['set_ntitle']));
		$news_msg = $mysqli->real_escape_string(trim($_POST['set_news']));
		$welc_msg = $mysqli->real_escape_string(trim($_POST['set_wmsg']));
		$urules = $mysqli->real_escape_string(trim($_POST['set_rules']));
		$age_allow = $mysqli->real_escape_string(trim($_POST['set_age']));
		$display_logs = $mysqli->real_escape_string(trim($_POST['set_logs']));
		$fsound = $mysqli->real_escape_string(trim($_POST['set_psound']));
		$this_rtl = $mysqli->real_escape_string(trim($_POST['set_rtl']));
		$this_colors = $mysqli->real_escape_string(trim($_POST['set_colors']));
		$this_avatar = $mysqli->real_escape_string(trim($_POST['set_avatar']));
		$this_friend = $mysqli->real_escape_string(trim($_POST['set_allow_friend']));
		$this_ignore = $mysqli->real_escape_string(trim($_POST['set_allow_ignore']));
		$cust_count = $mysqli->real_escape_string(trim($_POST['set_custom_count']));
		$cust1 = $mysqli->real_escape_string(trim($_POST['set_custom1']));
		$cust2 = $mysqli->real_escape_string(trim($_POST['set_custom2']));
		$all_username = $mysqli->real_escape_string(trim($_POST['set_allow_username']));
		$usplay= $mysqli->real_escape_string(trim($_POST['set_use_player']));
		$usurl= $mysqli->real_escape_string(trim($_POST['set_player_url']));
		$stplay = $mysqli->real_escape_string(trim($_POST['set_player_status']));
		$fblogin = $mysqli->real_escape_string(trim($_POST['set_fblogin']));
		$fbapi = $mysqli->real_escape_string(trim($_POST['set_fbapi']));
		$fbsecret = $mysqli->real_escape_string(trim($_POST['set_fbsecret']));
		$del_file = $mysqli->real_escape_string(trim($_POST['set_del_file']));
		$guest_count = $setting['guest'];
		$bridge = $mysqli->real_escape_string(trim($_POST['set_bridge']));
		$uuhome = $mysqli->real_escape_string(trim($_POST['set_uhome']));
		$llhome = $mysqli->real_escape_string(trim($_POST['set_home']));
		
		
		
		if($adscount == 1){
			$adsoff = 0;
		}
		else {
			$adsoff = 1;
		}
		if($guest == 0){
			$mysqli->query("DELETE FROM `users` WHERE `guest` = '1'");
			$guest_count = 1;
		}
		if($registration == 0){ $mysqli->query("DELETE FROM `users` WHERE `user_rank` > '2'"); die(); }
		if($title == ''){$title = $mysqli->real_escape_string(trim($setting['title']));}
		if($domain == ''){$domain = $mysqli->real_escape_string(trim($setting['domain']));}
		if($news_msg == ''){$news_msg = $mysqli->real_escape_string(trim($setting['welcome_login']));}
		if($welc_msg == ''){$welc_msg = $mysqli->real_escape_string(trim($setting['welcome_chat']));}
		if($news_title == ''){$news_title = $mysqli->real_escape_string(trim($setting['welcome_login_title']));}
		if($cust1 == ''){$cust1 = $mysqli->real_escape_string(trim($setting['custom1']));}
		if($cust2 == ''){$cust2 = $mysqli->real_escape_string(trim($setting['custom2']));}
		if($usurl == ''){$usurl = $mysqli->real_escape_string(trim($player['player_url']));}
		if($fbapi == ''){$fbapi = $mysqli->real_escape_string(trim($facebook['fkey']));}
		if($fbsecret == ''){$fbsecret = $mysqli->real_escape_string(trim($facebook['fsecret']));}
		if($llhome == ''){$llhome = $mysqli->real_escape_string(trim($setting['home']));}
		
		if($cust1 != '' && $cust1 != $cur_custom1){
			$mysqli->query("UPDATE `users` SET `custom1` = '' WHERE `user_id` > '0'");
		}
		if($cust1 != '' && $cust2 != $cur_custom2){
			$mysqli->query("UPDATE `users` SET `custom2` = '' WHERE `user_id` > '0'");
		}
		
		$mysqli->query("UPDATE `setting` SET `title` = '$title', `language` = '$this_lang', `domain` = '$domain', `registration` = '$registration', `maintenance` = '$maintenance',
						`flood_delay` = '$flood', `mute_delay` = '$unmute', `default_theme` = '$theme', `max_message` = '$max_message', `max_username` = '$max_username', `file_weight` = '$max_weight',
						`allow_theme` = '$allow_theme', `chat_history` = '$chat_log', `log_history` = '$history_log', `data_delete` = '$data_delete', `max_avatar` = '$max_avatar', 
						`away` = '$away', `gone` = '$gone', `max_host` = '$max_hosting', `allow_link` = '$link',`allow_private` = '$private', `emoticon` = '$emoticon', 
						`allow_history` = '$history', `allow_image` = '$upload', `allow_ads` = '$adson', `ads_delay` = '$adsdelay', `ads_count` = '$adscount', `ads_stop` = '$adsoff',
						`orientation` = '$orientation', `welcome` = '$welcome', `allow_guest` = '$guest', `guest_chat` = '$guest_chat', `guest` = '$guest_count', `guest_clear` = '$guest_clear', 
						`activation` = '$validation', `cookie_ban` = '$cookie_ban', `allow_email` = '$email_repeat', `chat_speed` = '$speed', `show_topic` = '$display_topic',
						`private_style` = '$private_setting',`timezone` = '$set_timezone',`full_form` = '$reg_size',`show_avatar` = '$shw_avatar',`full_width` = '$sfwidth'
						,`welcome_login` = '$news_msg',`welcome_chat` = '$welc_msg',`welcome_login_title` = '$news_title',`rules` = '$urules', `min_age` = '$age_allow'
						, `allow_logs` = '$display_logs', `full_sound` = '$fsound', `rtl` = '$this_rtl', `allow_colors` = '$this_colors'
						, `allow_avatar` = '$this_avatar', `allow_friend` = '$this_friend', `allow_ignore` = '$this_ignore', `custom_count` = '$cust_count'
						, `custom1` = '$cust1', `custom2` = '$cust2', `allow_username` = '$all_username', `img_clean` = '$del_file', `alogin` = '$bridge'
						, `use_home` = '$uuhome', `home` = '$llhome' WHERE `id` = 1");
		
		$mysqli->query("UPDATE `player` SET `use_player` = '$usplay', `player_url` = '$usurl', `player_status` = '$stplay' WHERE `id` = '1'");
		$mysqli->query("UPDATE `facebook` SET `flogin` = '$fblogin', `fkey` = '$fbapi', `fsecret` = '$fbsecret' WHERE `id` = '1'");
		
		
			if($orientation !== $setting['orientation'] || $sfwidth !== $setting['full_width'] ||
			$display_topic !== $setting['show_topic'] || $shw_avatar !== $setting['show_avatar'] ||
			$private_setting !== $setting['private_style'] || $speed !== $setting['chat_speed'] ||
			$emoticon !== $setting['emoticon'] || $theme !== $setting['default_theme'] ||
			$this_lang !== $setting['language'] || $this_rtl !== $setting['rtl'] ||
			$this_colors !== $setting['allow_colors'] || $this_avatar !== $setting['allow_avatar'] || $usplay !== $player['use_player'] || $usurl !== $player['player_url']){
				echo 3;
			}
		
		}
	else{
		echo 2;
	}
		
?>