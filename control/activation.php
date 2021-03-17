<div class="background_login" id="container_kicked">
	<div class="bottom_separator" id="header_login">
	</div>
	<div class="top_separator" id="content_kicked">
		<div id="top_activation">
			<h2><?php echo $activate_title; ?></h2>
			<p><?php echo $activate_text; ?></p>
		</div>
		<h3 class="sub_color email_verification"><?php echo $user['user_email']; ?></h3>
		<div class="sub_button hover_element" id="activate_button"><p><?php echo $activate_ok; ?></p></div>
		<div class="sub_button hover_element" id="resend_button"><p><?php echo $activate_button; ?></p></div>	
	</div>
</div>
<script type="text/javascript" src="js/activation.js"></script>