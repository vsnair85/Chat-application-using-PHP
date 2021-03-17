<div id="wrap_login">
	<div id="container_login" class="background_login">
		<div id="header_login" class="bottom_separator">
		</div>
		<div id="content_login" class="top_separator">
			<div id="login_error"><div class="error" id="login_error_inside"></div></div>
			<div id="content_login_left">
				<form class="login_form" autocomplete="off">
					<input style="display:none">
					<input type="password" style="display:none">
					<p class="login_label"><?php echo $lang_username; ?></p>
					<input id="user_username" class="input_data background_box" type="text" maxlength="50" name="username">
					<p class="login_label"><?php echo $lang_password; ?></p>
					<input id="user_password" class="input_data background_box" maxlength="30" type="password" name="password"><br />
					<p class="login_label sub_color forgot_password"><?php echo $lang_forgot; ?></p>
					<div id="login_control">
						<div class="sub_button hover_element selected_element" id="login_button"><p><?php echo $lang_login; ?></p></div>
						<?php if($setting['registration'] == 1){
						echo "<div  class=\"sub_button hover_element\" id=\"login_register\"><p>$lang_register</p></div>";
						}
						echo "<div class=\"clear\"></div>";
						?>
					</div>
				</form>
			</div>
			<div id="content_login_right">
				<?php
				if($facebook['flogin'] == 1){
					if($embed == 1){
						echo "<button class=\"fbl_button\" onclick=\"window.location.href='facebook_login.php?embed=1'\"><i class=\"fa fa-facebook-square ficon_login\"></i>$lang_fblogin</button>";
					}
					else {
						echo "<button class=\"fbl_button\" onclick=\"window.location.href='facebook_login.php'\"><i class=\"fa fa-facebook-square ficon_login\"></i>$lang_fblogin</button>";
					}
				}
				if($setting['allow_guest'] == 1){
					if($facebook['flogin'] == 1){
						echo "<div class=\"sub_button hover_element\" id=\"guest_button\"><p>$guest_button</p></div>";
					}
					else {
						echo "<div class=\"sub_button hover_element nofb\" id=\"guest_button\"><p>$guest_button</p></div>";
					}
				}
				if($setting['alogin'] == 2 ){
					if($facebook['flogin'] == 1 || $setting['allow_guest'] == 1){
						echo '<div class="bridge_button sub_button hover_element" id="bridge_login"><p>' . $lang_blogin . '</p></div>';	
					}
					else {
						echo '<div class="bridge_button2 sub_button hover_element" id="bridge_login"><p>' . $lang_blogin . '</p></div>';	
					}
				}
				?>				
				<div id="login_welcome">
					<h3 class="sub_color"><?php echo $setting['welcome_login_title']; ?></h3>
					<p><?php echo $setting['welcome_login']; ?></p>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<?php 
	if($setting['rules'] == 1){
		include('rules_panel.php'); 
	}
	?>
</div>
<script type="text/javascript" src="js/login.js"></script>
<?php if(file_exists('bridge_login.php')){
	echo '<script type="text/javascript" src="bridge/language/language.js"></script>';
}
?>