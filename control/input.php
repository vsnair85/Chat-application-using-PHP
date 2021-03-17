<?php
	if($user['user_access'] == 4 && $user['guest'] != 1 || $user['guest'] == 1 && $setting['allow_guest'] == 1 && $setting['guest_chat'] == 1 && $user['user_access'] == 4 || $user['guest'] != 1 && $user['verified'] == 1 && $user['user_access'] == 4){
		$disabled = "";

	}
	else {
		$disabled = "disabled";
	}
?>
<?php
if($setting['rtl'] == 1){
?>
<table id="input_table">
	<tr>
		<td id="inputt_right">
			<button type="submit" class="sub_button" id="submit_button" <?php echo $disabled; ?>><i class="fa fa-paper-plane"></i></button>
		</td>
		<td id="inputt_left">
			<table id="inside_group">
				<tr id="td_group">
					<?php if($user['user_rank'] >= $setting['allow_image'] && $user['upload_access'] == 1 && $user['guest'] != 1){
					echo '<td class="background_box log2" id="send_image">
							<i class="fa fa-file-image-o"></i>
						</td>';
					}
					?>
					<td id="td_input">
						<input class="background_box" type="text" name="content" maxlength="<?php echo $setting['max_message']; ?>" id="content" autocomplete="off" <?php echo $disabled; ?>/>
					</td>	
					<td class="background_box log2" id="emo_item">
						<i class="fa fa-smile-o"></i>
					</td>					
				</tr>
			</table>
		</td>	
	</tr>
</table>
<?php
}
else {
?>
<table id="input_table">
	<tr>
		<td id="inputt_left">
			<table id="inside_group">
				<tr id="td_group">
					<td class="background_box log2" id="emo_item">
						<i class="fa fa-smile-o"></i>
					</td>	
					<td id="td_input">
						<input class="background_box" type="text" name="content" maxlength="<?php echo $setting['max_message']; ?>" id="content" autocomplete="off" <?php echo $disabled; ?>/>
					</td>
					<?php if($user['user_rank'] >= $setting['allow_image'] && $user['upload_access'] == 1 && $user['guest'] != 1){
						echo '<td class="background_box log2" id="send_image">
							<i class="fa fa-file-image-o"></i>
						</td>';
					}
					?>
				</tr>
			</table>
		</td>	
		<td id="inputt_right">
			<button type="submit" class="sub_button" id="submit_button" <?php echo $disabled; ?>><i class="fa fa-paper-plane"></i></button>
		</td>
	</tr>
</table>
<?php
}
?>