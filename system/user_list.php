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
$rank_ico  = 1;
$sex_ico = 1;

function ico($r, $o){
		if($o == 1){
			if($r == 2 ){ return '<i class="v_ico fa fa-plus"></i>'; }
			else if($r == 3){ return '<i class="m_ico fa fa-shield"></i>'; }
			else if($r == 4){ return '<i class="a_ico fa fa-star"></i>'; }
			else if($r == 5){ return '<i class="sa_ico fa fa-star"></i>'; }
			else { return ''; }
		}
		else {
			return '';
		}
}
function sex($s, $g){
	if($g == 1){
		if($s == 1){ return "<i class=\"fa fa-mars boy\"></i>"; }
		else if ($s == 2){ return "<i class=\"fa fa-venus girl\"></i>"; }
		else { return ''; }
	}
	else {
		return '';
	}
}

$load_data = 'setting.allow_avatar, setting.allow_private, setting.allow_theme, setting.default_theme, setting.language,
 setting.timezone, setting.allow_ignore, setting.allow_friend, users.user_access, users.user_rank, users.user_roomid,
 users.user_name, users.user_theme, users.guest';
 
require_once("config1.php");


if($data["user_access"] >= 1 && $access == 'on'){
	$data_list = $mysqli->query("SELECT user_name, user_color, user_rank, alt_name, user_tumb, user_status, user_access, user_sex FROM `users` WHERE `user_roomid` = {$data["user_roomid"]}  AND `user_status` <= 2 AND `user_access` != 2 AND `user_access` != 0 ORDER BY `user_status` ASC, `user_rank` DESC, `user_name` ASC ");
	if ($data_list->num_rows > 0)
	{
		echo "<div id=\"container_user\">";
		echo "<ul>";
		while ($list = $data_list->fetch_assoc())
		{
			if($list["alt_name"] == ""){
				$alt = "$notsetyet";
			}
			else{
			
				$alt = $list["alt_name"];
			}
			$uavatar = $list['user_tumb'];
			if($uavatar == "default_avatar_tumb.png" || $list['user_rank'] < $data['allow_avatar']){
				$avatar_path = "$icon_path";
				$uavatar = "default_avatar_tumb.png";
			}
			else {
				$avatar_path = "avatar";
			}
			$avatar = "<img class=\"avatar_userlist\" src=\"$avatar_path/$uavatar\"/>";
			if($list['user_status'] == 1){
				$away = $list['user_color'];
			}
			else {
				$away = "away";
			}
				if($list['user_access'] == 1){
					echo "<li class=\"users_option\">
							<div class=\"open_user  hover_element sub_element\">
								$avatar<p title=\"$alt\" class=\"$away usertarget\" id=\"{$list["user_name"]}\"><s>{$list["user_name"]}</s></p>
							</div>
							<div class=\"option_list\">
								<ul class=\"user_option_list\" value=\"{$list["user_name"]}\">";
									echo "<li class=\"user_option_separator get_info\" value=\"get_info\">$usinfo</li>";
									if($list['user_name'] !== $data['user_name']){ 
										if($data['user_rank'] >= 3){
											echo "<li class=\"user_option_separator get_unmute\" value=\"get_unmute\">$usunmute</li>";
										}
										if($data['user_rank'] > 4){
											echo "<li class=\"user_option_separator get_kill\" value=\"get_kill\">$usdelete</li>";
										}
									}
								echo "</ul>
							</div>
						</li>";	
				}
				else {
					echo "<li class=\"users_option\">
							<div class=\"open_user  hover_element sub_element\">
								$avatar<p title=\"$alt\" class=\"$away usertarget\" id=\"{$list["user_name"]}\">{$list["user_name"]} " . ico($list['user_rank'], $rank_ico) . sex($list['user_sex'], $sex_ico) . "</p> 
							</div>
							<div class=\"option_list\">
								<ul class=\"user_option_list\" value=\"{$list["user_name"]}\">";
									echo "<li class=\"user_option_separator get_info\" value=\"get_info\">$usinfo</li>";
									if($list['user_name'] !== $data['user_name']){ 
										if($list['user_rank'] >= $data['allow_private'] && $data['user_rank'] >= $data['allow_private']){ 
											echo "<li class=\"user_option_separator send_private\" value=\"{$list['user_name']}\">$usprivate</li>"; 
										}
										if( $list['user_rank'] < 3 && $data['guest'] != 1 && $data['user_rank'] >= $data['allow_ignore']){
											echo "<li class=\"user_option_separator get_ignore\" value=\"get_ignore\">$usignore</li>";
										}
										if( $data['guest'] != 1 && $data['user_rank'] >= $data['allow_friend']){
											echo "<li class=\"user_option_separator get_friends\" value=\"get_friends\">$usfriends</li>";
										}
										if($data['user_rank'] >= 3){
											echo "<li class=\"user_option_separator get_mute\" value=\"get_mute\">$usmute</li>";
											echo "<li class=\"user_option_separator get_kick\" value=\"get_kick\">$uskick</li>";
										}
										if($data['user_rank'] > 3){
											echo "<li class=\"user_option_separator get_ban\" value=\"get_ban\">$usban</li>";
										}
										if($data['user_rank'] > 4){
											echo "<li class=\"user_option_separator get_kill\" value=\"get_kill\">$usdelete</li>";
										}
									}
								echo "</ul>
							</div>
						</li>";						
				}
		}	
		echo "</ul><div class=\"clear\"></div></div>";
	}
}
else {
	echo "<ul>
			<li>Room empty</li>
		</ul>";
}


?>