<?php	
/**
* Boomchat
*
* @package Boomchat
* @author www.myboomchat.com
* @copyright 2015
* @terms any use of this script without a legal license is prohibited
* all the content of Boomchat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_theme, users.user_rank';
require_once("config1.php");

$myrank = $data['user_rank'];
$me = $data['user_name'];

if($myrank < 4){
	die();
}
?>
			<div class="bottom_separator" id="top_setting_option">
				<button class="button_half view_user_button sub_button  button_left" value="view_admin"><?php echo $rkadmin; ?></button>
				<button class="button_half view_user_button sub_button button_right" value="view_modo"><?php echo $rkmodo; ?></button>
				<button class="button_half view_user_button sub_button button_left" value="view_muted"><?php echo $rkmuted; ?></button>
				<button class="button_half view_user_button sub_button button_right" value="view_banned"><?php echo $rkbanned; ?></button>
				<button class="button_half view_user_button sub_button button_left" value="view_vip"><?php echo $rkvip; ?></button>
				<div class="clear"></div>
			</div>
<?php
	// show admin, moderator, muted, banned list in the admin user panel
	if ($myrank > 4){
		echo "<div id=\"container_user_admin\" class=\"top_separator\">";
		echo "<div class=\"user_quart view_admin\">
			<div class=\"title_user_quart\">
				$tadmin
			</div>";
					$admin = $mysqli->query("SELECT * FROM `users` WHERE `user_rank` =  4");
					if ($admin->num_rows > 0)
					{
							while ($admins = $admin->fetch_assoc())
							{
								echo "<div class=\"container_element sub_element hover_element\"><div class=\"wrap_element\"><div class=\"element_name\"><p>{$admins['user_name']}</p></div><div class=\"delete_element delete_admin\"><button value=\"{$admins['user_name']}\" type=\"button\"><i class=\"remove_element close_room remove_private fa fa-2x fa-close\"></i></button></div></div></div>";
							}
					}
					else {
						echo "<div class=\"admin_user_empty empty_element\"><p>$noadmin</p></div>";
					}
		echo "</div>";	
		echo "<div class=\"user_quart view_modo\">
			<div class=\"title_user_quart\">
				$tmodo
			</div>";
					$modo = $mysqli->query("SELECT * FROM `users` WHERE `user_rank` =  3");
					if ($modo->num_rows > 0)
					{
							while ($modos = $modo->fetch_assoc())
							{
								echo "<div class=\"container_element sub_element hover_element\"><div class=\"wrap_element\"><div class=\"element_name\"><p>{$modos['user_name']}</p></div><div class=\"delete_element delete_modo\"><button value=\"{$modos['user_name']}\" type=\"button\"><i class=\"remove_element close_room remove_private fa fa-2x fa-close\"></i></button></div></div></div>";
							}
					}
					else {
						echo "<div class=\"admin_user_empty empty_element\"><p>$nomodo</p></div>";
					}				
		echo "</div>";
		echo "<div class=\"user_quart view_vip\">
			<div class=\"title_user_quart\">
				$tvips
			</div>";
					$vips = $mysqli->query("SELECT * FROM `users` WHERE `user_rank` =  2");
					if ($vips->num_rows > 0)
					{
							while ($my_vips = $vips->fetch_assoc())
							{
								echo "<div class=\"container_element sub_element hover_element\"><div class=\"wrap_element\"><div class=\"element_name\"><p>{$my_vips['user_name']}</p></div><div class=\"delete_element delete_vip\"><button value=\"{$my_vips['user_name']}\" type=\"button\"><i class=\"remove_element close_room remove_private fa fa-2x fa-close\"></i></button></div></div></div>";
							}
					}
					else {
						echo "<div class=\"admin_user_empty empty_element\"><p>$novips</p></div>";
					}
		echo "</div>";	
		echo "<div class=\"user_quart view_muted\">
			<div class=\"title_user_quart\">
				$tmuted
			</div>";
					if($myrank >= 4){
						$muted = $mysqli->query("SELECT * FROM `users` WHERE `user_access` =  1");
					}
					else{
						$muted = $mysqli->query("SELECT * FROM `users` WHERE `user_access` =  1 AND `user_mute` = '$me'");
					}
					if ($muted->num_rows > 0)
					{
							while ($muteds = $muted->fetch_assoc())
							{
								echo "<div class=\"container_element sub_element hover_element\"><div class=\"wrap_element\"><div class=\"element_name\"><p>{$muteds['user_name']}</p></div><div class=\"delete_element delete_muted\"><button value=\"{$muteds['user_name']}\" type=\"button\"><i class=\"remove_element close_room remove_private fa fa-2x fa-close\"></i></button></div></div></div>";
							}
					}
					else {
						echo "<div class=\"admin_user_empty empty_element\"><p>$nomuted</p></div>";
					}
		echo "</div>";
	echo "<div class=\"user_quart view_banned\">
		<div class=\"title_user_quart\">
			$tbanned
		</div>";
				$banned = $mysqli->query("SELECT * FROM `users` WHERE `user_access` =  0");
				if ($banned->num_rows > 0)
				{
						while ($banneds = $banned->fetch_assoc())
						{
							echo "<div class=\"container_element sub_element hover_element\"><div class=\"wrap_element\"><div class=\"element_name\"><p>{$banneds['user_name']}</p></div><div class=\"delete_element delete_banned\"><button value=\"{$banneds['user_name']}\" type=\"button\"><i class=\"remove_element close_room remove_private fa fa-2x fa-close\"></i></button></div></div></div>";
						}
				}
				else {
					echo "<div class=\"admin_user_empty empty_element\"><p>$nobanned</p></div>";
				}
	echo "</div></div>";
	
}
?>