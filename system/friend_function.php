<?php
	function friends($name, $status, $path, $av, $tx1, $tx2, $tx3, $st, $rst)
	{
		$cst = '';
		$dficon = $path;
		if($av != 'default_avatar_tumb.png'){
			$path = 'avatar';
		}
		else {
			$path = $path;
		}
		if($st >= $rst){
			$cst = '<li class="sel_user user_option_separator hover_element"><p class="send_private" value="' . $name . '">' . $tx2 . '</p></li>';
		}
		return '<li class="users_option">
					<div class="open_user  hover_element">
						<img class="avatar_userlist" src="' . $path . '/' . $av . '"/><p class="usertarget" id="' . $name . '">' . $name . '<span class="friend_status"><img src="' . $dficon . '/' . $status . '.png"/></span></p>
					</div>
					<div class="option_list">
						<ul class="user_option_list">
							<li class="sel_user user_option_separator hover_element"><p class="get_info" value="' . $name . '">' . $tx1 . '</p></li>
							' . $cst . '
							<li class="sel_user user_option_separator hover_element"><p class="delete_friend" value="' . $name . '">' . $tx3 . '</p></li>
						</ul>
					</div>
				</li>';	
	}
	function friends_pending($name, $path, $tx1, $tx2, $cfr, $afr)
	{
		$okfr = '';
		$frmar = ' friend_no_allow';
		if($cfr >= $afr){
			$okfr = '<div class="friend_bottom">
						<button class="selected_element sub_button hover_element friend_menu_button button_left friend_accept" value="' . $name . '">' . $tx1 . '</button>
						<button class="selected_element sub_button hover_element friend_menu_button button_right friend_decline" value="' . $name . '">' . $tx2 . '</button>
					</div>';
			$frmar = '';
		}
		return '<div class="container_friend sub_element">
					<div class="friend_top' . $frmar . '">
						<div class="friend_info">
							<button class="friend_ginfo" value="' . $name . '" type="button"><img src="./' . $path . '/account.png"/></button>
						</div>
						<div class="friend_name">
							<p>' . $name . '</p>
						</div>
						<div class="clear"></div>
					</div>
					' . $okfr . '
					<div class="clear"></div>
				</div>';
	}
?>