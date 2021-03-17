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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.allow_private,
users.user_name, users.user_theme, users.user_access, users.user_ignore, users.user_color, users.guest, users.user_id, users.user_tumb, users.user_rank';

require_once("config1.php");
require_once("content_process.php");

if($data['user_rank'] < $data['allow_private']){
	die();
}
if (isset($_POST['target']) && isset($_POST['content']) && isset($_POST['bold']) 
	&& isset($_POST['italic']) && isset($_POST['underline']) 
	&& isset($_POST['color']) && isset($_POST['high'])){
	
	$bold = $mysqli->real_escape_string(trim($_POST['bold']));
	$italic = $mysqli->real_escape_string(trim($_POST['italic']));
	$underline = $mysqli->real_escape_string(trim($_POST['underline']));
	$chigh = $mysqli->real_escape_string(trim($_POST['high']));
	$ccolor = $mysqli->real_escape_string(trim($_POST['color']));
	
	$target = $mysqli->real_escape_string(trim($_POST['target']));
	$content = $mysqli->real_escape_string(trim($_POST['content']));
	$content2 = $mysqli->real_escape_string(trim(htmlspecialchars($_POST['content'])));
	$content = htmlspecialchars($content);
	$content = "$content ";

	$finduser = $mysqli->query("SELECT `user_color`, `guest`, `user_ignore` FROM `users` WHERE `user_name` = '$target'");
	if ($finduser->num_rows > 0){
	
			$targetfound = $finduser->fetch_array(MYSQLI_BOTH);
			if(!strpos(strtolower($targetfound['user_ignore']), strtolower($data['user_name']))){
				$mycolor = $data["user_color"];
				$target_color = $targetfound["user_color"];
				$guest_post = $targetfound["guest"];
				$hunterid = $data["user_id"];
				$hunter = $data["user_name"];
				$avatar = $data['user_tumb'];
				if($guest_post == 1 || $data['guest'] == 1){
					$gupost = 1;
				}
				else {
					$gupost = 0;
				}
				if($content2 == '/clear'){
					$mysqli->query("DELETE FROM private WHERE hunter = '$hunter' AND target = '$target' OR hunter = '$target' AND target = '$hunter'");
				}
				else {
					$content = styling($chigh, $bold, $italic, $ccolor, $underline, $content);
					$mysqli->query("INSERT INTO `private` (time, target, hunter, message, target_color, hunter_color, hunter_guest, avatar) VALUES ('$time', '$target', '$hunter', '$content', '$target_color', '$mycolor', '$gupost', '$avatar')");
					if($target !== $data['user_name']){
						$mysqli->query("UPDATE users SET pcount = pcount + 1 WHERE user_name = '$target'");
					}
				}
			}
			else {
				die();
			}
	}
	else{
		echo 2;
	}
}
else {
	echo 4;
}



?>