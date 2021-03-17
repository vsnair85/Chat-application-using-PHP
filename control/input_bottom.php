<div id="top_chat_container">
	<div id="container_input">
		<?php if($setting['emoticon'] == 1){
			echo "<div id=\"main_emoticon\">";
					include('control/emoticon.php');
			echo "</div>";
			}
		?>
		<form id="main_input" name="chat_data" action="" method="post">
			<input id="main_chat_type" type="hidden" name="main_chat_type" value="1" />
			<input id="this_target" type="hidden" name="this_target" value="none" />
			<input id="user_name" type="hidden" name="user_name" value="<?php echo $user["user_name"]; ?>" />
			<input id="user_room" type="hidden" name="user_room" value="<?php echo $user["user_roomid"]; ?>" />
			<?php include('control/input.php'); ?>			
		</form>
	</div>
</div>