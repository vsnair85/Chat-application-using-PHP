		<div id="container_help">
			<h3 class="sub_color2 title_command"><?php echo $htstatus; ?></h3>
			<div value="/away" class="wrap_command sub_element hover_element"><div class="command_copy "><p class="sub_color">/away</p></div><div class="effect"><p><?php echo $daway; ?><br /><?php echo $example; ?> /away</p></div><div class="clear"></div></div>			
			
			<h3 class="sub_color2 title_command"><?php echo $htspecial; ?></h3>
			<div value="/me" class="wrap_command sub_element hover_element"><div class="command_copy "><p class="sub_color">/me</p></div><div class="effect"><p><?php echo $dme; ?><br /><?php echo $example; ?> /me <?php echo $htext; ?></p></div><div class="clear"></div></div>
			<div value="/seen" class="wrap_command sub_element hover_element"><div class="command_copy "><p class="sub_color">/seen</p></div><div class="effect"><p><?php echo $dseen; ?><br /><?php echo $example; ?> /seen <?php echo $huser; ?></p></div><div class="clear"></div></div>
			<?php if ($user['user_rank'] >= $setting['allow_private'] && $user['guest'] !== 1){
						echo "<div value=\"/msg\"  class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/msg</p></div><div class=\"effect\"><p>$dmsg<br />$example /msg $huser $htext</p></div><div class=\"clear\"></div></div>";
					}
			?>	
			<?php if ($user['guest'] !== 1 && $user['user_rank'] >= $setting['allow_friend']){
						echo "<div value=\"/friend\"  class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/friend</p></div><div class=\"effect\"><p>$dfriend<br />$example /friend $huser</p></div><div class=\"clear\"></div></div>";
					}
			?>
			<?php if ($user['user_rank'] > 3){
						echo "<div value=\"/global\"  class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/global</p></div><div class=\"effect\"><p>$dglobal<br />$example /global $htext</p></div><div class=\"clear\"></div></div>";
					}
			?>
			
			<?php if ($user['user_rank'] > 2){
					echo "<h3 class=\"sub_color2 title_command\">$htrooms</h3>";
					echo "<div value=\"/topic\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/topic</p></div><div class=\"effect\"><p>$dtopic<br />$example /topic $htopic</p></div><div class=\"clear\"></div></div>
					<div value=\"/clear\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/clear</p></div><div class=\"effect\"><p>$dclear<br />$example /clear</p></div><div class=\"clear\"></div></div>";
					}
			?>
			<?php if ($user['user_rank'] >= $setting['allow_private'] && $user['guest'] !== 1){
					echo "<h3 class=\"sub_color2 title_command\">$htprivate</h3>
					<div value=\"/clear\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/clear</p></div><div class=\"effect\"><p>$dclearp<br />$example /clear</p></div><div class=\"clear\"></div></div>";
					}
			?>	
			<?php if ($user['user_rank'] > 2){
				echo "<h3 class=\"sub_color2 title_command\">$htcontrol</h3>";
				echo "<div value=\"/mute\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/mute</p></div><div class=\"effect\"><p>$dmute<br />$example /mute $huser</p></div><div class=\"clear\"></div></div>
					<div value=\"/kick\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/kick</p></div><div class=\"effect\"><p>$dkick<br />$example /kick $huser</p></div><div class=\"clear\"></div></div>
					<div value=\"/unmute\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/unmute</p></div><div class=\"effect\"><p>$dunmute<br />$example /unmute $huser</p></div><div class=\"clear\"></div></div>
					<div value=\"/upon\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/upon</p></div><div class=\"effect\"><p>$dupon<br />$example /upon $huser</p></div><div class=\"clear\"></div></div>
					<div value=\"/upoff\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/upoff</p></div><div class=\"effect\"><p>$dupoff<br />$example /upoff $huser</p></div><div class=\"clear\"></div></div>";
				}
				if($user['user_rank'] >= $setting['allow_ignore']){
					echo "<div value=\"/ignore\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/ignore</p></div><div class=\"effect\"><p>$ignset<br />$example /ignore $huser</p></div><div class=\"clear\"></div></div>";
					echo "<div value=\"/ignoreclear\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/ignoreclear</p></div><div class=\"effect\"><p>$ignclear<br />$example /ignoreclear</p></div><div class=\"clear\"></div></div>";
				}
			?>
			<?php if ($user['user_rank'] > 3){
				echo "<div value=\"/ban\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/ban</p></div><div class=\"effect\"><p>$dban<br />$example /ban $huser</p></div><div class=\"clear\"></div></div>
					<div value=\"/setuser\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/setuser</p></div><div class=\"effect\"><p>$dsetuser<br />$example /setuser $huser</p></div><div class=\"clear\"></div></div>
					<div value=\"/setmod\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/setmod</p></div><div class=\"effect\"><p>$dsetmod<br />$example /setmod $huser</p></div><div class=\"clear\"></div></div>
					<div value=\"/invisible\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/invisible</p></div><div class=\"effect\"><p>$dinvisible<br />$example /invisible</p></div><div class=\"clear\"></div></div>
					<div value=\"/visible\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/visible</p></div><div class=\"effect\"><p>$dvisible<br />$example /visible</p></div><div class=\"clear\"></div></div>";
					}
			?>
			<?php if ($user['user_rank'] >= 3){
				echo "<div value=\"/setvip\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/setvip</p></div><div class=\"effect\"><p>$dsetvip<br />$example /setvip $huser</p></div><div class=\"clear\"></div></div>";
					}
			?>
			<?php if ($user['user_rank'] > 4){
				echo "<div value=\"/setadmin\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/setadmin</p></div><div class=\"effect\"><p>$dsetadmin<br />$example /setadmin $huser</p></div><div class=\"clear\"></div></div>";
				echo "<div value=\"/silent\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/silent</p></div><div class=\"effect\"><p>$dsilent<br />$example /silent $hsilent</p></div><div class=\"clear\"></div></div>";
				echo "<div value=\"/gsound\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/gsound</p></div><div class=\"effect\"><p>$dgsound<br />$example /gsound</p></div><div class=\"clear\"></div></div>";
					}
			?>
		
			<?php if ($user['user_rank'] > 4){
				echo "<h3 class=\"sub_color2 title_command\">$httheme</h3>";
				echo "<div value=\"/addtheme\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/addtheme</p></div><div class=\"effect\"><p>$daddtheme<br />$example /addtheme $htheme</p></div><div class=\"clear\"></div></div>
					<div value=\"/deltheme\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/deltheme</p></div><div class=\"effect\"><p>$ddeltheme<br />$example /deltheme $htheme</p></div><div class=\"clear\"></div></div>";
					}
			?>
			<?php if ($user['user_rank'] >= 3){
				echo "<h3 class=\"sub_color2 title_command\">$htdocu</h3>";
				echo "<div value=\"/manual\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/manual</p></div><div class=\"effect\"><p>$dmanual<br />$example /manual</p></div><div class=\"clear\"></div></div>";
					}
			?>
			<?php
				if($user['user_rank'] > 4){
				echo "<h3 class=\"sub_color2 title_command\">$htadmin</h3>";
				echo "<div value=\"/install\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/install</p></div><div class=\"effect\"><p>$dinstall<br />$example /install $haddons</p></div><div class=\"clear\"></div></div>";
				echo "<div value=\"/uninstall\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/uninstall</p></div><div class=\"effect\"><p>$duninstall<br />$example /uninstall $haddons</p></div><div class=\"clear\"></div></div>";
				echo "<div value=\"/update\" class=\"wrap_command sub_element hover_element\"><div class=\"command_copy \"><p class=\"sub_color\">/update</p></div><div class=\"effect\"><p>$dupdate<br />$example /update</p></div><div class=\"clear\"></div></div>";
				}
			?>
		</div>