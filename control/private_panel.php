<div class="private_panels panelthree panels"  id="private_panel">
	<div class="top_option bottom_separator private_drag">
		<div class="close_option">
			<i value="private_panel" class="close_private fa fa-2x fa-close close_panel"></i>
		</div>
		<div class="inner_top_option">
			<p class="private_target sub_color private_friend"></p>
			<?php if($user['guest'] != 1 && $user['user_rank'] >= $setting['allow_friend']){
				echo '<i value="" class="add_friend_button fa fa-2x fa-user-plus"></i>';
				}
			?>
		</div>
	</div>
	<div class="panel_element top_separator">
		<div id="private_chat">
			<ul class="background_box" id="show_private">
			</ul>
		</div>
		<div id="private_input_wrap">
			<form id="private_input" name="private_data" action="" method="post">
				<input type="hidden" id="pv_target" name="pv_target" value="" />
				<input type="hidden"  id="pv_hunter" name="pv_hunter" value="<?php echo $user["user_name"]; ?>" />
				<?php if($setting['rtl'] == 1){?>
					<table id="input_private">
						<td id="private_right">
							<button type="submit" class="sub_button" id="submit_private"><i class="fa fa-paper-plane"></i></button>
						</td>
						<td id="private_left">
							<table id="priv_inside">
								<td id="p_input">
									<input class="background_box" type="text" name="" id="private_content" maxlength="<?php echo $setting['max_message']; ?>" autocomplete="off"/>
								</td>
								<?php if($user['user_rank'] >= $setting['allow_image'] && $user['upload_access'] == 1 && $user['guest'] != 1){
									echo '<td id="p_image" class="background_box log2">
										<i class="fa fa-file-image-o"></i>
									</td>';
								}
								?>
							</table>
						</td>
					</table>
				<?php }
				else {
				?>
					<table id="input_private">
						<td id="private_left">
							<table id="priv_inside">
								<?php if($user['user_rank'] >= $setting['allow_image'] && $user['upload_access'] == 1 && $user['guest'] != 1){
									echo '<td id="p_image" class="background_box log2">
										<i class="fa fa-file-image-o"></i>
									</td>';
								}
								?>
								<td id="p_input">
									<input class="background_box" type="text" name="" id="private_content" maxlength="<?php echo $setting['max_message']; ?>" autocomplete="off"/>
								</td>
							</table>
						</td>
						<td id="private_right">
							<button type="submit" class="sub_button" id="submit_private"><i class="fa fa-paper-plane"></i></button>
						</td>
					</table>
				<?php 
				}
				?>
			</form>
		</div>
	</div>
</div>