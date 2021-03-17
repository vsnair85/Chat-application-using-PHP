	<?php include_once('control/header.php'); ?>
	<div class="background_chat" id="container_chat">
		<div id="wrap_chat">
			<?php if($setting['orientation'] == 2) {include('topic.php');} ?>
			<?php if($setting['orientation'] == 1){ include('input_top.php'); } ?>
			<div id="warp_show_chat">
				<div id="container_show_chat">
					<div id="chat_error">
						<p class="error"></p> 
					</div>
					<div id="inside_wrap_chat">
						<ul class="background_box" id="show_chat">
							<ul>
							</ul>
						</ul>
					</div>
					<?php include('ads.php'); ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php if($setting['orientation'] == 2){ include('input_bottom.php'); } ?>
			<?php if($setting['orientation'] == 1){ include('topic.php'); } ?>
			<div class="clear">
			</div>
		</div>
	</div>
	<div id="wrap_footer">
		<div class="background_menu_footer" id="menu_container">
			<div id="menu_container_inside">
					<?php		
					include('bottom_option.php');
				?>
			</div>
		</div>
	</div>
	<?php include('main_option.php'); ?>
	<?php include('users_options.php'); ?>
	<?php include('chat_panel.php'); ?>
	<?php include('tools_panel.php'); ?>
	<?php include('help_panel.php'); ?>
	<?php include('profile_panel.php'); ?>
	<?php include('addon_panel.php'); ?>
	<?php include('addon_panel_full.php'); ?>
	<?php if($setting['allow_theme'] == 1){include('theme_panel.php'); } ?>
	<?php if($setting['allow_history'] == 1) { include('history_panel.php'); } ?>
	<?php if($user['user_rank'] >= $setting['allow_private'] && $user['user_access'] == 4){ include('private_panel.php'); }?>
	<?php include('color_picker.php'); ?>
	<?php include('emoticons.php'); ?>
	<?php include('logout_box.php'); ?>
	<?php if($player['use_player'] == 1){ include('player.php'); } ?>
	<?php if($user['user_rank'] >= $setting['allow_image'] && $user['upload_access'] == 1 && $user['guest'] != 1){ include('upload_box.php'); } ?>

<?php 
	
	if($user['user_rank'] > 2){
		echo "<script type=\"text/javascript\" src=\"js/admin.js\"></script>";
	}
	if($user['user_rank'] > 3){
		echo "<script type=\"text/javascript\" src=\"js/edit_user.js\"></script>";
	}
	if($user['user_access'] == 4){
		if($user['guest'] == 0 || $user['guest'] == 1 && $setting['guest_chat'] == 1){
			echo "<script type=\"text/javascript\" src=\"js/main.js\"></script>";
			echo "<script type=\"text/javascript\" src=\"js/full.js\"></script>";
			echo "<script type=\"text/javascript\" src=\"js/sound.js\"></script>";
		}
		else {
			echo "<script type=\"text/javascript\" src=\"js/main.js\"></script>";
			echo "<script type=\"text/javascript\" src=\"js/sound_muted.js\"></script>";	
		}
	}
	if($user['user_access'] == 1){
		echo "<script type=\"text/javascript\" src=\"js/main.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/sound_muted.js\"></script>";
	}
	echo "<script type=\"text/javascript\" src=\"js/function.js\"></script>";
	echo "<script type=\"text/javascript\" src=\"js/upload.js\"></script>";
	echo "<script type=\"text/javascript\" src=\"js/picker.js\"></script>";
	echo "<script type=\"text/javascript\" src=\"js/speed" . $setting['chat_speed'] . ".js\"></script>";
	if($player['use_player'] == 1){
		echo "<script type=\"text/javascript\" src=\"js/player.js\"></script>";
	}
?>
<?php 
	$load_js = $mysqli->query("SELECT `name` FROM `addons` WHERE `id` > 0");
	if($load_js->num_rows > 0){
		while ($list_jquery = $load_js->fetch_assoc()){
			include('addons/' . $list_jquery['name'] . '/data/js.php');
		}
	}
?>