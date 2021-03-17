<div id="my_menu">
	<div class="box_menu">
		<i class="menu_header fa fa-bars"></i>
		<ul class="background_chat menu_drop">
			<li class="logout_button hover_element head_li bottom_separator"><i class="fa fa-sign-out fa-fw"></i> <?php echo $tipquit; ?></li>
			<?php
				if($setting['use_home'] == 1){
					if($setting['home'] == ""){
						$link_home = "#";
					}
					else {
						$link_home = $setting['home'];
					}
					echo '<li class="hover_element head_li top_separator bottom_separator"><a href="' . $link_home . '"><i class="fa fa-home fa-fw"></i>' . $hhome . '</a></li>';
				}
			?>
			<li value="help_panel" class="menu_panels hover_element head_li top_separator bottom_separator"><i class="fa fa-question-circle fa-fw"></i> <?php echo $icohelp; ?></li>
			<?php 
				if($setting['allow_history'] == 1){
					echo '<li value="history_panel" class="menu_panels hover_element head_li top_separator bottom_separator"><i class="fa fa-history fa-fw"></i> ' . $icohistory . '</li>';
				}
				if($setting['allow_theme'] == 1){
					if($user['guest'] < 1){ $home_use = "bottom_separator"; }
					else { $home_use = ""; }
					echo '<li value="theme_panel" class="menu_panels hover_element head_li top_separator ' . $home_use . '"><i class="fa fa-paint-brush fa-fw"></i> ' . $icotheme . '</li>';
				}
				if($user['user_rank'] > 4){
					echo '<li value="main_option" class="menu_panels hover_element head_li top_separator bottom_separator"><i class="fa fa-cogs fa-fw"></i> ' . $tipsettings . '</li>';
				}
				if($user['guest'] < 1){
					echo '<li value="tools_panel" class="menu_panels hover_element head_li top_separator"><i class="fa fa-pencil-square fa-fw"></i> ' . $tipprofile . '</li>';
				}
			?>
		</ul>
	</div>
	<div value="chat_panel" class="addon_button box_menu box_menu2">
		<i class="notify_chat fa fa-comments"></i>
		<div id="private_count" style="display: none;"><p style="padding-top:3px;">45</p></div>
	</div>
	<?php 
		if($user['guest'] < 1){
			$ificon = $mysqli->query("SELECT `name` FROM `addons` WHERE `id` > 0");
			if($ificon->num_rows > 0){
				echo '<div value="option_tab" class="box_menu box_menu2">
					<i id="open_option" class="menu_options fa fa-plus-circle"></i>';
					include('option_panel.php');
				echo '</div>';
			}
		}
	?>
	<?php 
		if($player['use_player'] == 1){
			echo '<div id="open_player" class="box_menu box_menu2">
				<i class="menu_options fa fa-play-circle"></i>';
			echo '</div>';
		}
	?>
</div>