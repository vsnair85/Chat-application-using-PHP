<div id="wrap_options" class="option_add background_chat">
	<div id="option_title">
		<p></p>
	</div>
	<div id="addon_container" class="top_separator">
		<?php
			if($setting['version'] >= 4){
				while ($list_icon = $ificon->fetch_assoc()){
					include("addons/" . $list_icon['name'] . "/data/icon.php");
				}	
			}
		?>
		<div class="clear">
		</div>
	</div>
	<div class="clear">
	</div>
</div>