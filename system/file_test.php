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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.file_weight, setting.max_host, setting.domain,
users.user_name, users.user_theme, users.user_access, users.upload_access, users.upload_count, users.user_id, users.user_roomid, users.user_color, users.user_tumb, users.guest';

require_once("config1.php");

if($data['upload_access'] != 1 || $data['guest'] == 1){ die(); }
?>
<?php

$picturepath = "../upload/";
define('IMAGEPATH', $picturepath);
$messageerreur = "";
$max = $data['file_weight'];

$name = $data['user_name'];
$room = $data['user_roomid'];
$data_id = $data["user_id"];
$post_time = date("H:i", $time);
$color = $data["user_color"];
$avatar = $data['user_tumb'];

if (isset($_FILES["file"])){
	$temp = str_replace(" ", "", $_FILES["file"]["name"]);
	$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "x-png", "pjpeg");
	$temp = explode(".", $temp);
	$extension = end($temp);
	$size = round((($_FILES["file"]["size"] / 1024) / 1024), 2);

	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "image/JPG"))
	&& in_array($extension, $allowedExts)){
		
		if ($_FILES["file"]["error"] > 0){
					echo 6;
		}
		else{
			$tempname = $_FILES["file"]["tmp_name"];
			$imginfo = getimagesize($tempname);
			
			if ($imginfo !== false) {
				if (file_exists("../upload/" . str_replace(str_split('\\/:*?"<>_$-@&%|'), '' , preg_replace('/\s+/', '', $_FILES["file"]["name"])))){
					echo 4; 
				}						  
				else if ((($_FILES["file"]["size"] / 1024)/1024) > $max){
					echo 2;
				}
				else{
					$ext = explode('.',$_FILES['file']['name']);
					$extension = end($ext);
					if($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'pjpeg' || $extension == 'x-png'){
						$extension = $extension;
					}
					else {
						echo 1;
						die();
					}
					$upfile1 = rand(111111,999999);
					$upfile2 = $data['user_name'] . $data['user_id'];
					$upfile = md5($upfile1 . $upfile2);
					$finalup = $upfile . "." . $extension;
					$file_name = str_replace(str_split('\\/:*?"<>_$-@&%|'), '' , preg_replace('/\s+/', '', $finalup));
					$file_name = str_replace('php', '',$file_name);
					move_uploaded_file(preg_replace('/\s+/', '', $_FILES["file"]["tmp_name"]),
					"../upload/" . $file_name);
					$myimage = $data['domain'] . "/upload/" . $file_name;
					$mysqli->query("UPDATE `users` SET `upload_count` = `upload_count` + 1 WHERE `user_name` = '{$data["user_name"]}'");
					if(isset($_GET['target'])){
						$target = $mysqli->real_escape_string(trim($_GET['target']));
						
						$finduser = $mysqli->query("SELECT `user_color`, `guest`, `user_ignore` FROM `users` WHERE `user_name` = '$target'");
						
						if ($finduser->num_rows > 0){
							$targetfound = $finduser->fetch_array(MYSQLI_BOTH);
							
							$target_color = $targetfound["user_color"];
							$guest_post = $targetfound["guest"];
							
							if($guest_post == 1 || $data['guest'] == 1){
								$gupost = 1;
							}
							else {
								$gupost = 0;
							}
							if(!strpos(strtolower($targetfound['user_ignore']), strtolower($name))){
								$mysqli->query("INSERT INTO `private` (time, target, hunter, message, target_color, hunter_color, hunter_guest, avatar, file) VALUES ('$time', '$target', '$name', '$myimage', '$target_color', '$color', '$gupost', '$avatar', '$time')");
								$mysqli->query("INSERT INTO `images` (file_name, user_name, date_sent) VALUES ('$file_name', '$name', '$time')");
								echo 5;
								die();
							}
							else {
								echo 99;
								die();
							}
						}
						else {
							echo 99;
							die();
						}
					}
					else {
						$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar, file) VALUES ('$time', '$post_time', '$data_id', '$name', '$myimage', $room, '$color', 'public', '$avatar', '$time')");
						$mysqli->query("INSERT INTO `images` (file_name, user_name, date_sent) VALUES ('$file_name', '$name', '$time')");
						echo 5;
						die();
					}
				}
			}
			else {
				echo 290347850;
				die();
			}
			
		}
	}
	else{
		echo 1;
	}
}






?> 