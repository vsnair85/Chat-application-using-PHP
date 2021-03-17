<div class="profile_section" id="my_profile_avatar">
	<div id="avatar">
		<img class="profile_avatar" src="<?php echo $avatar_path; ?>"/>
	</div>
	<div class="details_first">
		<p class="change_avatar"><span class="sub_color"><?php echo $upchangeavatar; ?></span></p>
		<form id="myForm" action="system/file.php" method="post">
			<input type="file" name="file" id="file">
			<button class="button_half sub_button hover_element" type="submit"  id="submit_avatar"/><?php echo $submitavatar; ?></button>
		</form>
		<div class="panel_error"><p class="error"> </p></div>
	</div>
</div>