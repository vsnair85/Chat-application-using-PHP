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
$faceload = $mysqli->query("SELECT * FROM facebook WHERE id = '1'");

$player = $check_player->fetch_array(MYSQLI_BOTH);
$facebook = $faceload->fetch_array(MYSQLI_BOTH);


if($user['user_rank'] < 4){
	die();
}
	
	$chat_historyselect = $setting['chat_history'];
	$historyselect = $setting['log_history'];
	$toggleselect = $setting['allow_theme'];
	$maintselect = $setting['maintenance'];
	$regselect = $setting['registration'];
	$themesel = $setting['default_theme'];
	$floodselect = $setting['flood_delay'];
	$muteselect = $setting['mute_delay'];
	$dataselect	= $setting['data_delete'];
	$max_message = $setting['max_message'];
	$max_username = $setting['max_username'];
	$max_avatar = $setting['max_avatar'];
	$linkselect = $setting['allow_link'];
	$awayselect = $setting['away'];
	$offselect = $setting['gone'];
	$max_host = $setting['max_host'];
	$emoticon = $setting['emoticon'];
	$private = $setting['allow_private'];
	$history = $setting['allow_history'];
	$upload = $setting['allow_image'];
	$max_weight = $setting['file_weight'];
	$adsdelay = $setting['ads_delay'];
	$adscount = $setting['ads_count'];
	$adsallow = $setting['allow_ads'];
	$orientation = $setting['orientation'];
	$welcome = $setting['welcome'];
	$guest_on = $setting['allow_guest'];
	$guest_chat = $setting['guest_chat'];
	$guest_erase = $setting['guest_clear'];
	$validation = $setting['activation'];
	$cookie_ban = $setting['cookie_ban'];
	$double_email = $setting['allow_email'];
	$chat_speed = $setting['chat_speed'];
	$lang_sel = $setting['language'];
	$show_topic = $setting['show_topic'];
	$private_style = $setting['private_style'];
	$timezone = $setting['timezone'];
	$full_form = $setting['full_form'];
	$use_avatar = $setting['show_avatar'];
	$use_fwidth = $setting['full_width'];
	$wlogin = htmlspecialchars($setting['welcome_login']);
	$wtitle = htmlspecialchars($setting['welcome_login_title']);
	$welchat = htmlspecialchars($setting['welcome_chat']);
	$rules_on = $setting['rules'];
	$min_age = $setting['min_age'];
	$allow_logs = $setting['allow_logs'];
	$post_sound = $setting['full_sound'];
	$use_rtl = $setting['rtl'];
	$allow_colors = $setting['allow_colors'];
	$allow_avatar = $setting['allow_avatar'];
	$allow_friend = $setting['allow_friend'];
	$allow_ignore = $setting['allow_ignore'];
	$ucustom1 = htmlspecialchars($setting['custom1']);
	$ucustom2 = htmlspecialchars($setting['custom2']);
	$c_custom = $setting['custom_count'];
	$uname_change = $setting['allow_username'];
	$u_player = $player['use_player'];
	$url_player = $player['player_url'];
	$pl_status = $player['player_status'];
	$fb_login = $facebook['flogin'];
	$fb_key = $facebook['fkey'];
	$fb_secret = $facebook['fsecret'];
	$del_pic = $setting['img_clean'];
	$alogin = $setting['alogin'];
	$uhome = $setting['use_home'];
	$home_link = $setting['home'];

	
	$theme = $mysqli->query("SELECT * FROM `theme` WHERE `id` >=  1");
	
?>
			<div class="bottom_separator" id="top_setting_option">
				<button class="setting_option_button button_half sub_button selected_element button_left" value="setting_site"><?php echo $section_site; ?></button>
				<button class="setting_option_button button_half sub_button button_right" value="setting_account"><?php echo $section_account; ?></button>
				<button class="setting_option_button button_half sub_button button_left" value="setting_chat"><?php echo $section_chat; ?></button>
				<button class="setting_option_button button_half sub_button button_right" value="setting_upload"><?php echo $section_upload; ?></button>
				<button class="setting_option_button button_half sub_button button_left" value="setting_limit"><?php echo $section_limit; ?></button>
				<button class="setting_option_button button_half sub_button button_right" value="setting_user"><?php echo $section_users; ?></button>
				<button class="setting_option_button button_half sub_button button_left" value="setting_ads"><?php echo $section_ads; ?></button>
				<button class="setting_option_button button_half sub_button button_right" value="setting_advance"><?php echo $section_advance; ?></button>
				<div class="clear"></div>
			</div>
			<div class="top_separator" id="container_setting">
				<div class="setting_part load_part" id="setting_site">
					<h3 class="sub_color"><?php echo $section_site; ?></h3>
					<div id="site_title">
						<div id="site_title_left">
							<p><?php echo $lang_site; ?></p>
						</div>
						<div id="site_title_right">
							<input type="text" placeholder="<?php echo $setting['title']; ?>" id="my_title"/>
						</div>
					</div>
					<div id="site_domain" class="bottom_separator">
						<div id="site_domain_left">
							<p><?php echo $lang_index; ?></p>
						</div>
						<div id="site_domain_right">
							<input type="text" placeholder="<?php echo $setting['domain']; ?>" id="my_domain"/>
							<p class="small_text">ex: http://yourdomain.com/mychat</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label class="time_zone_lable"><?php echo $lang_zone; ?></label>
							<select id="set_timezone" class="time_zone_select">
							
							<?php $timeRead = fopen("timezone.php", "r");
								if ($timeRead) {
									while (($line = fgets($timeRead)) !== false) {
										$line = trim($line);
										if($line == $setting['timezone']){
											echo '<option value="' . $line . '" selected="selected">' . $line . '</option>';
										}
										else {
											echo '<option value="' . $line . '">' . $line . '</option>';
										}
									}
									fclose($timeRead);
								} 
								else {
								} 
							?>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_off2; ?></label>
							<select id="set_maintenance">
								<option value="0" <?= $maintselect == 0 ? 'selected="selected"' : '' ?>><?php echo $sson; ?></option>
								<option value="1" <?= $maintselect == 1 ? 'selected="selected"' : '' ?>><?php echo $ssoff; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_off; ?></label>
							<select id="set_registration">
								<option value="1" <?= $regselect == 1 ? 'selected="selected"' : '' ?>><?php echo $sson; ?></option>
								<option value="0" <?= $regselect == 0 ? 'selected="selected"' : '' ?>><?php echo $ssoff; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_uhome; ?></label>
							<select id="set_uhome">
								<option value="1" <?= $uhome == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $uhome == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator">
							<label><?php echo $lang_lhome; ?></label><br />
							<input id="set_home" placeholder="<?php echo $home_link; ?>" class="news_title_zone"/>
							<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator">
							<label><?php echo $lang_newst; ?></label><br />
							<input id="set_news_title" placeholder="<?php echo $wtitle; ?>" class="news_title_zone"/>
							<div class="clear"></div>
					</div>
					<div class="setting_message_zone">
						<label><?php echo $lang_newsm; ?></label><br/>
						<textarea placeholder="<?php echo $wlogin; ?>" type="text" class="setting_msg" id="set_welcome_news"/>
						<div class="clear"></div>
					</div>	
				</div>
				
				<div class="setting_part" id="setting_chat">
					<h3 class="sub_color"><?php echo $section_chat; ?></h3>
					<div class="option_setting bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_flood; ?></label>
							<select id="set_flood">
								<option value="60" <?= $floodselect == 60 ? 'selected="selected"' : '' ?>>1 <?php echo $smin; ?></option>
								<option value="300" <?= $floodselect == 300 ? 'selected="selected"' : '' ?>>5 <?php echo $smin; ?></option>
								<option value="900" <?= $floodselect == 900 ? 'selected="selected"' : '' ?>>15 <?php echo $smin; ?></option>
								<option value="1800" <?= $floodselect == 1800 ? 'selected="selected"' : '' ?>>30 <?php echo $smin; ?></option>
								<option value="3600" <?= $floodselect == 3600 ? 'selected="selected"' : '' ?>>1 <?php echo $shour; ?></option>
								<option value="10800" <?= $floodselect == 10800 ? 'selected="selected"' : '' ?>>3 <?php echo $shours; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_mute; ?></label>
							<select id="set_unmute">
								<option value="1800" <?= $muteselect == 1800 ? 'selected="selected"' : '' ?>>30 min</option>
								<option value="3600" <?= $muteselect == 3600 ? 'selected="selected"' : '' ?>>1 <?php echo $shour; ?></option>
								<option value="10800" <?= $muteselect == 10800 ? 'selected="selected"' : '' ?>>3 <?php echo $shours; ?></option>
								<option value="86400" <?= $muteselect == 86400 ? 'selected="selected"' : '' ?>>1 <?php echo $sday; ?></option>
								<option value="259200" <?= $muteselect == 259200 ? 'selected="selected"' : '' ?>>3 <?php echo $sdays; ?></option>
								<option value="0" <?= $muteselect == 0 ? 'selected="selected"' : '' ?>><?php echo $snever; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_mmess; ?></label>
							<select id="set_max_message">
								<option value="100" <?= $max_message == 100 ? 'selected="selected"' : '' ?>>100</option>
								<option value="150" <?= $max_message == 150 ? 'selected="selected"' : '' ?>>150</option>
								<option value="200" <?= $max_message == 200 ? 'selected="selected"' : '' ?>>200</option>
								<option value="250" <?= $max_message == 250 ? 'selected="selected"' : '' ?>>250</option>
								<option value="300" <?= $max_message == 300 ? 'selected="selected"' : '' ?>>300</option>
								<option value="350" <?= $max_message == 350 ? 'selected="selected"' : '' ?>>350</option>
								<option value="400" <?= $max_message == 400 ? 'selected="selected"' : '' ?>>400</option>
								<option value="600" <?= $max_message == 600 ? 'selected="selected"' : '' ?>>600</option>
								<option value="800" <?= $max_message == 800 ? 'selected="selected"' : '' ?>>800</option>
								<option value="999" <?= $max_message == 999 ? 'selected="selected"' : '' ?>>1000</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_emo; ?></label>
							<select id="set_emoticon">
								<option value="1" <?= $emoticon == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $emoticon == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_avdisplay; ?></label>
							<select id="set_use_avatar">
								<option value="1" <?= $use_avatar == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $use_avatar == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_stopic; ?></label>
							<select id="set_show_topic">
								<option value="1" <?= $show_topic == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $show_topic == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  bottom_separator top_separator ">
						<div class="option_left">
							<label><?php echo $lang_link; ?></label>
							<select id="set_allow_link">
								<option value="1" <?= $linkselect == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $linkselect == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_allow_colors; ?></label>
							<select id="set_allow_color">
								<option value="1" <?= $allow_colors == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $allow_colors == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting bottom_separator top_separator ">
						<div class="option_left">
							<label><?php echo $lang_psound; ?></label>
							<select id="set_psound">
								<option value="1" <?= $post_sound == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $post_sound == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>	
					<div class="option_setting bottom_separator top_separator ">
						<div class="option_left">
							<label><?php echo $lang_logs; ?></label>
							<select id="set_msglog">
								<option value="1" <?= $allow_logs == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $allow_logs == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>	
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_chhis; ?></label>
							<select id="set_chat_history">
								<option value="20" <?= $chat_historyselect == 20 ? 'selected="selected"' : '' ?>>20</option>
								<option value="30" <?= $chat_historyselect == 30 ? 'selected="selected"' : '' ?>>30</option>
								<option value="40" <?= $chat_historyselect == 40 ? 'selected="selected"' : '' ?>>40</option>
								<option value="60" <?= $chat_historyselect == 60 ? 'selected="selected"' : '' ?>>60</option>
								<option value="80" <?= $chat_historyselect == 80 ? 'selected="selected"' : '' ?>>80</option>
								<option value="100" <?= $chat_historyselect == 100 ? 'selected="selected"' : '' ?>>100</option>
								<option value="160" <?= $chat_historyselect == 160 ? 'selected="selected"' : '' ?>>150</option>
								<option value="200" <?= $chat_historyselect == 200 ? 'selected="selected"' : '' ?>>200</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_his; ?></label>
							<select id="set_allow_history">
								<option value="1" <?= $history == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $history == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>	
					<div class="option_setting top_separator">
						<div class="option_left">
							<label><?php echo $lang_mhis; ?></label>
							<select id="set_history">
								<option value="100" <?= $historyselect == 100 ? 'selected="selected"' : '' ?>>100</option>
								<option value="200" <?= $historyselect == 200 ? 'selected="selected"' : '' ?>>200</option>
								<option value="300" <?= $historyselect == 300 ? 'selected="selected"' : '' ?>>300</option>
								<option value="400" <?= $historyselect == 400 ? 'selected="selected"' : '' ?>>400</option>
								<option value="500" <?= $historyselect == 500 ? 'selected="selected"' : '' ?>>500</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				
				
				
				
				<div class="setting_part" id="setting_upload">
					<h3 class="sub_color"><?php echo $section_upload; ?></h3>
					<div class="option_setting bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_mhost; ?></label>
							<select id="set_max_host">
								<option value="5" <?= $max_host == 5 ? 'selected="selected"' : '' ?>>5</option>
								<option value="10" <?= $max_host == 10 ? 'selected="selected"' : '' ?>>10</option>
								<option value="20" <?= $max_host == 20 ? 'selected="selected"' : '' ?>>20</option>
								<option value="30" <?= $max_host == 30 ? 'selected="selected"' : '' ?>>30</option>
								<option value="40" <?= $max_host == 40 ? 'selected="selected"' : '' ?>>40</option>
								<option value="50" <?= $max_host == 50 ? 'selected="selected"' : '' ?>>50</option>
								<option value="100" <?= $max_host == 100 ? 'selected="selected"' : '' ?>>100</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting bottom_separator top_separator ">
						<div class="option_left">
							<label><?php echo $lang_mup; ?></label>
							<select id="set_max_weight">
								<option value="1" <?= $max_weight == 1 ? 'selected="selected"' : '' ?>>1 mb</option>
								<option value="2" <?= $max_weight == 2 ? 'selected="selected"' : '' ?>>2 mb</option>
								<option value="3" <?= $max_weight == 3 ? 'selected="selected"' : '' ?>>3 mb</option>
								<option value="4" <?= $max_weight == 4 ? 'selected="selected"' : '' ?>>4 mb</option>
								<option value="5" <?= $max_weight == 5 ? 'selected="selected"' : '' ?>>5 mb</option>
								<option value="6" <?= $max_weight == 6 ? 'selected="selected"' : '' ?>>6 mb</option>
								<option value="7" <?= $max_weight == 7 ? 'selected="selected"' : '' ?>>7 mb</option>
								<option value="8" <?= $max_weight == 8 ? 'selected="selected"' : '' ?>>8 mb</option>
								<option value="9" <?= $max_weight == 9 ? 'selected="selected"' : '' ?>>9 mb</option>
								<option value="10" <?= $max_weight == 10 ? 'selected="selected"' : '' ?>>10 mb</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_mav; ?></label>
							<select id="set_max_avatar">
								<option value="100" <?= $max_avatar == 100 ? 'selected="selected"' : '' ?>>100 kb</option>
								<option value="200" <?= $max_avatar == 200 ? 'selected="selected"' : '' ?>>200 kb</option>
								<option value="300" <?= $max_avatar == 300 ? 'selected="selected"' : '' ?>>300 kb</option>
								<option value="400" <?= $max_avatar == 400 ? 'selected="selected"' : '' ?>>400 kb</option>
								<option value="500" <?= $max_avatar == 500 ? 'selected="selected"' : '' ?>>500 kb</option>
								<option value="600" <?= $max_avatar == 600 ? 'selected="selected"' : '' ?>>600 kb</option>
								<option value="700" <?= $max_avatar == 700 ? 'selected="selected"' : '' ?>>700 kb</option>
								<option value="800" <?= $max_avatar == 800 ? 'selected="selected"' : '' ?>>800 kb</option>
								<option value="900" <?= $max_avatar == 900 ? 'selected="selected"' : '' ?>>900 kb</option>
								<option value="1024" <?= $max_avatar == 1024 ? 'selected="selected"' : '' ?>>1 mb</option>
								<option value="2048" <?= $max_avatar == 2048 ? 'selected="selected"' : '' ?>>2 mb</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  top_separator ">
						<div class="option_left">
							<label><?php echo $del_imgs; ?></label>
							<select id="set_del_file">
								<option value="86400" <?= $del_pic == 86400 ? 'selected="selected"' : '' ?>>1 <?php echo $sday; ?></option>
								<option value="269200" <?= $del_pic == 269200 ? 'selected="selected"' : '' ?>>3 <?php echo $sdays; ?></option>
								<option value="604800" <?= $del_pic == 604800 ? 'selected="selected"' : '' ?>>1 <?php echo $sweek; ?></option>
								<option value="2419200" <?= $del_pic == 2419200 ? 'selected="selected"' : '' ?>>1 <?php echo $smonth; ?></option>
								<option value="0" <?= $del_pic == 0 ? 'selected="selected"' : '' ?>><?php echo $snever; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
				</div>	
				
				<div class="setting_part" id="setting_user">
					<h3 class="sub_color"><?php echo $section_users; ?></h3>
					<div class="option_setting bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_muser; ?></label>
							<select id="set_max_username">
								<option value="7" <?= $max_username == 7 ? 'selected="selected"' : '' ?>>7</option>
								<option value="8" <?= $max_username == 8 ? 'selected="selected"' : '' ?>>8</option>
								<option value="9" <?= $max_username == 9 ? 'selected="selected"' : '' ?>>9</option>
								<option value="10" <?= $max_username == 10 ? 'selected="selected"' : '' ?>>10</option>
								<option value="11" <?= $max_username == 11 ? 'selected="selected"' : '' ?>>11</option>
								<option value="12" <?= $max_username == 12 ? 'selected="selected"' : '' ?>>12</option>
								<option value="13" <?= $max_username == 13 ? 'selected="selected"' : '' ?>>13</option>
								<option value="14" <?= $max_username == 14 ? 'selected="selected"' : '' ?>>14</option>
								<option value="15" <?= $max_username == 15 ? 'selected="selected"' : '' ?>>15</option>
								<option value="16" <?= $max_username == 16 ? 'selected="selected"' : '' ?>>16</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_away; ?></label>
							<select id="set_away">
								<option value="300" <?= $awayselect == 300 ? 'selected="selected"' : '' ?>>5 <?php echo $smin; ?></option>
								<option value="600" <?= $awayselect == 600 ? 'selected="selected"' : '' ?>>10 <?php echo $smin; ?></option>
								<option value="900" <?= $awayselect == 900 ? 'selected="selected"' : '' ?>>15 <?php echo $smin; ?></option>
								<option value="1800" <?= $awayselect == 1800 ? 'selected="selected"' : '' ?>>30 <?php echo $smin; ?></option>
								<option value="3600" <?= $awayselect == 3600 ? 'selected="selected"' : '' ?>>1 <?php echo $shour; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  top_separator ">
						<div class="option_left">
							<label><?php echo $lang_gone; ?></label>
							<select id="set_gone">
								<option value="600" <?= $offselect == 600 ? 'selected="selected"' : '' ?>>10 <?php echo $smin; ?></option>
								<option value="900" <?= $offselect == 900 ? 'selected="selected"' : '' ?>>15 <?php echo $smin; ?></option>
								<option value="1800" <?= $offselect == 1800 ? 'selected="selected"' : '' ?>>30 <?php echo $smin; ?></option>
								<option value="3600" <?= $offselect == 3600 ? 'selected="selected"' : '' ?>>1 <?php echo $shour; ?></option>
								<option value="10800" <?= $offselect == 10800 ? 'selected="selected"' : '' ?>>3 <?php echo $shours; ?></option>
								<option value="86400" <?= $offselect == 86400 ? 'selected="selected"' : '' ?>>1 <?php echo $sday; ?></option>
								<option value="269200" <?= $offselect == 269200 ? 'selected="selected"' : '' ?>>3 <?php echo $sdays; ?></option>
								<option value="604800" <?= $offselect == 604800 ? 'selected="selected"' : '' ?>>1 <?php echo $sweek; ?></option>
								<option value="2419200" <?= $offselect == 2419200 ? 'selected="selected"' : '' ?>>1 <?php echo $smonth; ?></option>
								<option value="0" <?= $offselect == 0 ? 'selected="selected"' : '' ?>><?php echo $snever; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<h3 class="sub_color"><?php echo $section_guest; ?></h3>
					<div class="option_setting  bottom_separator">
						<div class="option_left">
							<label><?php echo $guest_ok; ?></label>
							<select id="set_guest">
								<option value="1" <?= $guest_on == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $guest_on == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $guest_talk; ?></label>
							<select id="set_guest_chat">
								<option value="1" <?= $guest_chat == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $guest_chat == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="option_setting top_separator ">
						<div class="option_left">
							<label><?php echo $guest_clear; ?></label>
							<select id="set_guest_clear">
								<option value="1800" <?= $guest_erase == 1800 ? 'selected="selected"' : '' ?>>30 <?php echo $smin; ?></option>
								<option value="3600" <?= $guest_erase == 3600 ? 'selected="selected"' : '' ?>>1 <?php echo $shour; ?></option>
								<option value="7200" <?= $guest_erase == 7200 ? 'selected="selected"' : '' ?>>2 <?php echo $shours; ?></option>
								<option value="14400" <?= $guest_erase == 14400 ? 'selected="selected"' : '' ?>>4 <?php echo $shours; ?></option>
								<option value="43200" <?= $guest_erase == 43200 ? 'selected="selected"' : '' ?>>12 <?php echo $shours; ?></option>
								<option value="86400" <?= $guest_erase == 86400 ? 'selected="selected"' : '' ?>>1 <?php echo $sday; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<h3 class="sub_color"><?php echo $section_custom; ?></h3>
					<div class="option_setting bottom_separator">
						<div class="option_left">
							<label><?php echo $use_custom; ?></label>
							<select id="set_custom_count">
								<option value="0" <?= $c_custom == 0 ? 'selected="selected"' : '' ?>>0</option>
								<option value="1" <?= $c_custom == 1 ? 'selected="selected"' : '' ?>>1</option>
								<option value="2" <?= $c_custom == 2 ? 'selected="selected"' : '' ?>>2</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator bottom_separator">
							<label><?php echo $custom_field1; ?></label><br />
							<input id="set_custom1" placeholder="<?php echo $ucustom1; ?>" class="news_title_zone"/>
							<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator">
							<label><?php echo $custom_field2; ?></label><br />
							<input id="set_custom2" placeholder="<?php echo $ucustom2; ?>" class="news_title_zone"/>
							<div class="clear"></div>
					</div>
				</div>
				<div class="setting_part" id="setting_ads">
					<h3 class="sub_color"><?php echo $section_ads; ?></h3>
					<div class="option_setting  bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_adsactive; ?></label>
							<select id="set_ads">
								<option value="1" <?= $adsallow == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $adsallow == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_ads_count; ?></label>
							<select id="set_adscount">
								<option value="1" <?= $adscount == 1 ? 'selected="selected"' : '' ?>>1</option>
								<option value="2" <?= $adscount == 2 ? 'selected="selected"' : '' ?>>2</option>
								<option value="3" <?= $adscount == 3 ? 'selected="selected"' : '' ?>>3</option>
								<option value="4" <?= $adscount == 4 ? 'selected="selected"' : '' ?>>4</option>
								<option value="5" <?= $adscount == 5 ? 'selected="selected"' : '' ?>>5</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator last_setting">
						<div class="option_left">
							<label><?php echo $lang_adsdelay; ?></label>
							<select id="set_adsdelay">
								<option value="15" <?= $adsdelay == 15 ? 'selected="selected"' : '' ?>>15</option>
								<option value="30" <?= $adsdelay == 30 ? 'selected="selected"' : '' ?>>30</option>
								<option value="45" <?= $adsdelay == 45 ? 'selected="selected"' : '' ?>>45</option>
								<option value="60" <?= $adsdelay == 60 ? 'selected="selected"' : '' ?>>60</option>
								<option value="90" <?= $adsdelay == 90 ? 'selected="selected"' : '' ?>>90</option>
								<option value="120" <?= $adsdelay == 120 ? 'selected="selected"' : '' ?>>120</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				
				<div class="setting_part" id="setting_advance">
					<h3 class="sub_color"><?php echo $section_advance; ?></h3>
					<div class="option_setting bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_orientation; ?></label>
							<select id="set_orientation">
								<option value="1" <?= $orientation == 1 ? 'selected="selected"' : '' ?>><?php echo $otop; ?></option>
								<option value="2" <?= $orientation == 2 ? 'selected="selected"' : '' ?>><?php echo $obottom; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_private_style; ?></label>
							<select id="set_private_style">
								<option value="1" <?= $private_style == 1 ? 'selected="selected"' : '' ?>><?php echo "$sboxed"; ?></option>
								<option value="2" <?= $private_style == 2 ? 'selected="selected"' : '' ?>><?php echo "$sfull"; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_usefw; ?></label>
							<select id="set_fwidth">
								<option value="1" <?= $use_fwidth == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $use_fwidth == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_language; ?></label>
							<select id="set_language">
								<option value="Arabic" <?= $lang_sel == 'Arabic' ? 'selected="selected"' : '' ?>>Arabic</option>
								<option value="Chineese" <?= $lang_sel == 'Chineese' ? 'selected="selected"' : '' ?>>Chineese</option>
								<option value="Dutch" <?= $lang_sel == 'Dutch' ? 'selected="selected"' : '' ?>>Dutch</option>
								<option value="English" <?= $lang_sel == 'English' ? 'selected="selected"' : '' ?>>English</option>
								<option value="Francais" <?= $lang_sel == 'Francais' ? 'selected="selected"' : '' ?>>Francais</option>
								<option value="German" <?= $lang_sel == 'German' ? 'selected="selected"' : '' ?>>German</option>
								<option value="Italian" <?= $lang_sel == 'Italian' ? 'selected="selected"' : '' ?>>Italian</option>
								<option value="Persian" <?= $lang_sel == 'Persian' ? 'selected="selected"' : '' ?>>Persian</option>
								<option value="Russian" <?= $lang_sel == 'Russian' ? 'selected="selected"' : '' ?>>Russian</option>
								<option value="Spanish" <?= $lang_sel == 'Spanish' ? 'selected="selected"' : '' ?>>Spanish</option>
								<option value="Turkish" <?= $lang_sel == 'Turkish' ? 'selected="selected"' : '' ?>>Turkish</option>
								<option value="Custom" <?= $lang_sel == 'Custom' ? 'selected="selected"' : '' ?>>Custom</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_rtl; ?></label>
							<select id="set_rtl">
								<option value="1" <?= $use_rtl == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $use_rtl == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_clean; ?></label>
							<select id="set_data_delete">
								<option value="60" <?= $dataselect == 60 ? 'selected="selected"' : '' ?>>1 <?php echo $shour; ?></option>
								<option value="1" <?= $dataselect == 1 ? 'selected="selected"' : '' ?>>1 <?php echo $sweek; ?></option>
								<option value="2" <?= $dataselect == 2 ? 'selected="selected"' : '' ?>>2 <?php echo $sweeks; ?></option>
								<option value="3" <?= $dataselect == 3 ? 'selected="selected"' : '' ?>>3 <?php echo $sweeks; ?></option>
								<option value="4" <?= $dataselect == 4 ? 'selected="selected"' : '' ?>>1 <?php echo $smonth; ?></option>
								<option value="8" <?= $dataselect == 8 ? 'selected="selected"' : '' ?>>2 <?php echo $smonths; ?></option>
								<option value="12" <?= $dataselect == 12 ? 'selected="selected"' : '' ?>>3 <?php echo $smonths; ?></option>
								<option value="27" <?= $dataselect == 27 ? 'selected="selected"' : '' ?>>6 <?php echo $smonths; ?></option>
								<option value="52" <?= $dataselect == 52 ? 'selected="selected"' : '' ?>>1 <?php echo $syear; ?></option>
								<option value="52" <?= $dataselect == 520 ? 'selected="selected"' : '' ?>>10 <?php echo $syears; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_cookie; ?></label>
							<select id="set_cookie">
								<option value="1" <?= $cookie_ban == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $cookie_ban == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_speed; ?></label>
							<select id="set_speed">
								<option value="1" <?= $chat_speed == 1 ? 'selected="selected"' : '' ?>><?php echo $speed_slow ?></option>
								<option value="2" <?= $chat_speed == 2 ? 'selected="selected"' : '' ?>><?php echo $speed_normal; ?></option>
								<option value="3" <?= $chat_speed == 3 ? 'selected="selected"' : '' ?>><?php echo $speed_fast; ?></option>
								<option value="4" <?= $chat_speed == 4 ? 'selected="selected"' : '' ?>><?php echo $speed_max; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_th; ?></label>
							<select id="set_allow_theme">
								<option value="1" <?= $toggleselect == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $toggleselect == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>	
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_dth; ?></label>
							<select id="set_default_theme">
							<?php
								if ($theme->num_rows > 0)
								{
										while ($themes = $theme->fetch_assoc())
										{
											$tname = $themes['name'];
											if($tname == $themesel){
												echo "<option value=\"$tname\" selected=\"selected\">$tname</option>";
											}
											else {
												echo "<option value=\"$tname\">$tname</option>";
											}
										}
								}
							?>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $use_player; ?></label>
							<select id="set_use_player">
								<option value="1" <?= $u_player == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $u_player == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $start_player; ?></label>
							<select id="set_player_status">
								<option value="1" <?= $pl_status == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $pl_status == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator">
							<label><?php echo $player_url; ?></label><br />
							<input id="set_player_url" placeholder="<?php echo $url_player; ?>" class="news_title_zone"/>
							<div class="clear"></div>
					</div>
				</div>
				<div class="setting_part" id="setting_limit">
				<h3 class="sub_color"><?php echo $section_limit; ?></h3>
				<iframe id="update_iframe" src="http://www.myboomchat.com/update/index.php"></iframe>
				<div class="option_setting bottom_separator">
					<div class="option_left">
						<label><?php echo $lang_priv; ?></label>
						<select id="set_private">
							<option value="1" <?= $private == 1 ? 'selected="selected"' : '' ?>><?php echo $opublic; ?></option>
							<option value="2" <?= $private == 2 ? 'selected="selected"' : '' ?>><?php echo $ovip; ?></option>
							<option value="3" <?= $private == 3 ? 'selected="selected"' : '' ?>><?php echo $ostaff; ?></option>
							<option value="4" <?= $private == 4 ? 'selected="selected"' : '' ?>><?php echo $oadmin; ?></option>
						</select>
					</div>
					<div class="clear"></div>
				</div>	
				<div class="option_setting top_separator bottom_separator">
					<div class="option_left">
						<label><?php echo $lang_uname_change; ?></label>
						<select id="set_allow_username">
							<option value="1" <?= $uname_change == 1 ? 'selected="selected"' : '' ?>><?php echo $opublic; ?></option>
							<option value="2" <?= $uname_change == 2 ? 'selected="selected"' : '' ?>><?php echo $ovip; ?></option>
							<option value="3" <?= $uname_change == 3 ? 'selected="selected"' : '' ?>><?php echo $ostaff; ?></option>
							<option value="4" <?= $uname_change == 4 ? 'selected="selected"' : '' ?>><?php echo $oadmin; ?></option>
						</select>
					</div>
					<div class="clear"></div>
				</div>					
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_allow_avatar; ?></label>
							<select id="set_allow_avatar">
								<option value="1" <?= $allow_avatar == 1 ? 'selected="selected"' : '' ?>><?php echo $opublic; ?></option>
								<option value="2" <?= $allow_avatar == 2 ? 'selected="selected"' : '' ?>><?php echo $ovip; ?></option>
								<option value="3" <?= $allow_avatar == 3 ? 'selected="selected"' : '' ?>><?php echo $ostaff; ?></option>
								<option value="4" <?= $allow_avatar == 4 ? 'selected="selected"' : '' ?>><?php echo $oadmin; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>					
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_up; ?></label>
							<select id="set_upload">
								<option value="1" <?= $upload == 1 ? 'selected="selected"' : '' ?>><?php echo $opublic; ?></option>
								<option value="2" <?= $upload == 2 ? 'selected="selected"' : '' ?>><?php echo $ovip; ?></option>
								<option value="3" <?= $upload == 3 ? 'selected="selected"' : '' ?>><?php echo $ostaff; ?></option>
								<option value="4" <?= $upload == 4 ? 'selected="selected"' : '' ?>><?php echo $oadmin; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_add_friend; ?></label>
							<select id="set_allow_friend">
								<option value="1" <?= $allow_friend == 1 ? 'selected="selected"' : '' ?>><?php echo $opublic; ?></option>
								<option value="2" <?= $allow_friend == 2 ? 'selected="selected"' : '' ?>><?php echo $ovip; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator">
						<div class="option_left">
							<label><?php echo $lang_add_ignore; ?></label>
							<select id="set_allow_ignore">
								<option value="1" <?= $allow_ignore == 1 ? 'selected="selected"' : '' ?>><?php echo $opublic; ?></option>
								<option value="2" <?= $allow_ignore == 2 ? 'selected="selected"' : '' ?>><?php echo $ovip; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>						
				</div>
				
				
				
				
				
				
				
				<div class="setting_part" id="setting_account">
				<h3 class="sub_color"><?php echo $section_account; ?></h3>
					<div class="option_setting  bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_usebridge; ?></label>
							<select id="set_bridge">
								<option value="0" <?= $alogin == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
								<?php if(file_exists('../bridge_login.php')){ ?>
									<option value="2" <?= $alogin == 2 ? 'selected="selected"' : '' ?>><?php echo $lang_addbridge; ?></option>
									<option value="1" <?= $alogin == 1 ? 'selected="selected"' : '' ?>><?php echo $lang_onlbridge; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_mage; ?></label>
							<select id="set_min_age">
								<?php
									for($value = 10; $value <= 99; $value++){
										if($value == $min_age){
											echo "<option value=\"$value\" selected=\"selected\">$value</option>";
										}
										else {
											echo "<option value=\"$value\">$value</option>";
										}
								}	
								?>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_fullf; ?></label>
							<select id="set_reg_full">
								<option value="1" <?= $full_form == 1 ? 'selected="selected"' : '' ?>><?php echo $sson; ?></option>
								<option value="0" <?= $full_form == 0 ? 'selected="selected"' : '' ?>><?php echo $ssoff; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_showr; ?></label>
							<select id="set_rules">
								<option value="1" <?= $rules_on == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $rules_on == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $lang_validate; ?></label>
							<select id="set_validation">
								<option value="1" <?= $validation == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $validation == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting  bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_double; ?></label>
							<select id="set_email_repeat">
								<option value="1" <?= $double_email == 1 ? 'selected="selected"' : '' ?>><?php echo $syes; ?></option>
								<option value="0" <?= $double_email == 0 ? 'selected="selected"' : '' ?>><?php echo $sno; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="option_setting top_separator bottom_separator">
						<div class="option_left">
							<label><?php echo $use_facebook; ?></label>
							<select id="set_fblogin">
								<option value="1" <?= $fb_login == 1 ? 'selected="selected"' : '' ?>><?php echo $sson; ?></option>
								<option value="0" <?= $fb_login == 0 ? 'selected="selected"' : '' ?>><?php echo $ssoff; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator bottom_separator">
							<label><?php echo $lang_fbida; ?></label><br />
							<input id="set_fbapi" placeholder="<?php echo $fb_key; ?>" class="news_title_zone"/>
							<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator bottom_separator">
							<label><?php echo $lang_fbseca; ?></label><br />
							<input id="set_fbsecret" placeholder="<?php echo $fb_secret; ?>" class="news_title_zone"/>
							<div class="clear"></div>
					</div>
					<div class="option_setting bottom_separator top_separator">
						<div class="option_left">
							<label><?php echo $lang_welcome; ?></label>
							<select id="set_welcome">
								<option value="1" <?= $welcome == 1 ? 'selected="selected"' : '' ?>><?php echo $sson; ?></option>
								<option value="0" <?= $welcome == 0 ? 'selected="selected"' : '' ?>><?php echo $ssoff; ?></option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="setting_message_zone top_separator">
						<label><?php echo $lang_welmsg; ?></label><br/>
						<textarea placeholder="<?php echo $welchat; ?>" type="text" class="setting_msg" id="set_welcome_msg"/>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<button id="setting_button"  class="full_button sub_button hover_element" type="button"><?php echo $lang_upset; ?></button> 
			</div>