<?php
$action = date('m/d/Y H:i:s', $user['last_action']);

$display_avatar = $user['user_avatar'];

if($display_avatar == 'default_avatar.png'){
	$avatar_path = "$icon_path/$display_avatar";
}
else {
	$avatar_path = "avatar/$display_avatar";
}
?>
<div class="panels top_panels panelone"  id="tools_panel">
	<div class="top_option bottom_separator">
		<div class="close_option">
			<i value="tools_panel" class="fa fa-2x fa-close top_icon_close close_panel"></i>
		</div>
		<div class="inner_top_option">
		</div>
	</div>
	<div class="panel_element top_separator">
		<div id="profile_menu">
				<button class="profile_button  button_half sub_button button_left selected_element" value="profile_personal"><?php echo $btn_personal; ?></button>
				<button class="profile_button  button_half sub_button button_right" value="profile_data"><?php echo $btn_logpass; ?></button>
				<button class="profile_button full_button sub_button button_right" value="profile_social"><?php echo $btn_social; ?></button>
				<div class="clear"></div>
		</div> 
		<div class="profile_info">
			
			<div id="profile_personal" class="profile_zone">
				<?php 
					if($user['user_rank'] >= $setting['allow_avatar']){
						include('avatar_upload.php');
					}
				?>
				<div class="profile_section" id="my_profile_details">
					<div id="pro_details">
					</div>
				</div>
				<button class="sub_button hover_element full_button" id="account_button"><?php echo $upupdate; ?></button><br /><br />
			</div>
			<div id="profile_data" class="profile_zone">
				<div class="profile_section" id="my_profile_password">
					<div class="details change_password">
					
						<?php
						if($user['user_rank'] >= $setting['allow_username']){
						echo '<div class="profile_error"><div id="error_info"></div></div>
							<p class="change_avatar"><span class="sub_color">' . $change_name . '</span></p>
							<label>' . $select_new_name . '</label></br>
							<input placeholder="' . $user['user_name'] . '" class="input_password background_box" id="new_name"/><br/>
							<button class="full_button sub_button hover_element"  id="update_name">' . $update_name . '</button><br/>';
						}
						?>
						<div class="profile_error"><div id="error_info2"></div></div>
						<p class="change_avatar"><span class="sub_color"><?php echo $change_email; ?></span></p>
						<label><?php echo $select_new_email; ?></label></br>
						<input placeholder="<?php echo $user['user_email']; ?>" class="input_password background_box" id="new_email"/><br/>
						<button class="full_button sub_button hover_element"  id="update_email"><?php echo $update_email; ?></button><br/>
						
						
						
						<?php 
						if($user['fb_id'] == ""){
							echo '<div class="profile_error"><div id="error_info3"></div></div>
							<p class="change_avatar"><span class="sub_color">' . $upchangepass . '</span></p>
							<label>' . $upchangepass2 . '</label></br>
							<input class="input_password background_box" id="old_password" type="password"/></br>
							<label>' . $upchangepass3 . '</label></br>
							<input class="input_password background_box" id="new_password" type="password"/></br>
							<label>' . $upchangepass4 . '</label></br>
							<input class="input_password background_box" id="confirm_password" type="password"/></br>
							<button class="full_button sub_button hover_element"  id="update_password">' . $upchangepass5 . '</button><br/>';
						}
						?>
					</div>
				</div>
			</div>
			<div id="profile_social" class="profile_zone">
				<div class="details_last">
					<div class="custom_element_title">
						<p><a href="#"><i class="fa fa-lg fa-facebook-square"></i></a> Facebook</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_facebook" value="<?php echo $user['facebook']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><i class="fa fa-lg fa-twitter-square"></i> Twitter</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_twitter" value="<?php echo $user['twitter']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><i class="fa fa-lg fa-pinterest-square"></i> Pinterest</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_pinterest" value="<?php echo $user['pinterest']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><i class="fa fa-lg fa-google-plus-square"></i> Google+</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_google" value="<?php echo $user['google']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><i class="fa fa-lg fa-youtube-square"></i> youtube</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_youtube" value="<?php echo $user['youtube']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><i class="fa fa-lg fa-instagram"></i> Instagram</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_instagram" value="<?php echo $user['instagram']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><a href="#"><i class="fa fa-lg fa-linkedin-square"></i></a> Linked in</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_linked_in" value="<?php echo $user['linkedin']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><i class="fa fa-lg fa-tumblr-square"></i> Tumblr.</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_tumblr" value="<?php echo $user['tumblr']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="details_last">
					<div class="custom_element_title">
						<p><i class="fa fa-lg fa-flickr"></i> flikr</p>
					</div>
					<div class="custom_element_select">
						<input class="background_box profile_input_social" id="bc_flickr" value="<?php echo $user['flickr']; ?>"></input>
					</div>
					<div class="clear"></div>
				</div>
				<p id="social_error"></p>
				<button class=" full_button sub_button hover_element"  id="update_social"><?php echo $upupdate; ?></button>
			</div>
		</div>
	</div>
	<div class="clear_panel">
	</div>
</div>