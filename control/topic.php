<div id="wrap_topic">
	<?php if($setting['show_topic'] == 1){ 
		echo "<div id=\"room_topic\">
		</div>";
		}
	?>
	<div id="menu_private">
		<div id="menu_private_target">
			<p class="private_target private_friend2 private_friend"><span class="sub_color2 span_private_target"></span> <span class="hide_private_title"><?php echo $tipprivate; ?></span></p>
		</div>
		<div id="menu_private_options">
			<i id="private_close" class="icon_priv fa fa-2x fa-close"></i>
			<?php if($user['guest'] != 1){
				echo '<i class="fa fa-2x icon_priv fa-user-plus add_friend_button"></i>';
				}
			?>
		</div>
	</div>
</div>