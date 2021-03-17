<div  class="panels panelone" id="chat_panel">
	<div class="top_option bottom_separator">
		<div class="close_option">
			<i value="chat_panel" class="fa fa-2x fa-close top_icon_close close_panel"></i>
		</div>
		<div class="inner_top_option">
			<i title="<?php echo $tipuser; ?>" class="fa fa-2x ic_user fa-user top_icon" id="chat_user"></i>
			<i title="<?php echo $tiprooms; ?>"class="fa fa-2x ic_room fa-home top_icon" id="chat_room"></i>
			<?php if($user['user_rank'] >= $setting['allow_private'] && $user['user_access'] == 4){
					if($user['guest'] == 0 || $user['guest'] == 1 && $setting['guest_chat'] == 1){
						echo '<i title="' . $tipprivate . '" class="icon_new_private ic_private fa fa-2x fa-comments top_icon" id="chat_private"></i>'; 
					}
				}
				if($user['user_access'] == 4 && $user['guest'] != 1){
					echo '<i title="' . $tipfriends . '" class="fa fa-2x fa-user-plus ic_friend top_icon" id="chat_friends"></i>';
				}
				if($user['guest'] !== 1 && $user['user_access'] == 4){
					echo '<i title="' . $icoignore . '" class="fa fa-2x fa-ban ic_ban top_icon" id="chat_ignore"></i>';
				}
			?>
		</div>
	</div>
	<div class="panel_element top_separator">
		<div id="room_wrap">
		</div>
		<div id="user_wrap">
		</div>
	</div>
	<div class="clear_panel">
	</div>
</div>