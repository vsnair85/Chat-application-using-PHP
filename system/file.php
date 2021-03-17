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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.max_avatar,
users.user_name, users.user_theme, users.user_access, users.user_avatar, users.user_id';

require_once("config1.php");
require_once("content_process.php");

$dataname = $data['user_id'];

// upload new avatar and delete old avatar to the server
if($access == 'on' && $data['user_access'] == 4){
	$picturepath = "avatar/";
	define('IMAGEPATH', $picturepath);

	if (isset($_FILES["file"])){
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/png"))
		|| ($_FILES["file"]["type"] == "image/JPG")
		&& ($_FILES["file"]["size"] < 1024 )
		&& in_array($extension, $allowedExts)){
			if ($_FILES["file"]["error"] > 0){
				echo 2;
			}
			else{					  
				if (($_FILES["file"]["size"] / 1024) > $data['max_avatar']){
					echo $data['max_avatar'];										
				}
				else{
				$tempname = $_FILES["file"]["tmp_name"];
				$imginfo = getimagesize($tempname);
				if ($imginfo !== false) {
				 $images_user =  str_replace(str_split('\\/:*?"<>-@&%|'), '' , preg_replace('/\s+/', '', $_FILES["file"]["name"]));
				 $unlinklink = "../avatar/{$data["user_avatar"]}";
				 $tumbname = str_replace(array('.jpg','.JPG','.jpeg','.png','.gif'),array('_tumb.jpg','_tumb.JPG','_tumb.jpeg','_tumb.png','_tumb.gif'),$data['user_avatar']);
				 $unlinktumb = "../avatar/$tumbname";
					if (file_exists($unlinklink) && $unlinklink != '../avatar/default_avatar.png'){
						unlink($unlinklink);
					}
					if (file_exists($unlinktumb) && $unlinktumb != '../avatar/default_avatar_tumb.png'){
						unlink($unlinktumb);
					}
				$ext = explode('.',$_FILES['file']['name']);
				$extension = $ext[1];
				if($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'pjpeg' || $extension == 'x-png'){
					$extension = $extension;
				}
				else {
					echo 1;
					die();
				}
				$tid = $data['user_id'];
				$count = rand(0,99999999);
				$file_name = "user" . $tid  . "_" . $count . "." . $extension;
				$file_name = str_replace('php', '',$file_name);
				 move_uploaded_file(preg_replace('/\s+/', '', $_FILES["file"]["tmp_name"]),
				 "../avatar/" . "$file_name");
				 $path = "../avatar/$file_name";
				 createThumbnail($path);
				 $tumb_new = str_replace(array('.jpg','.JPG','.jpeg','.png','.gif', '.php'),array('_tumb.jpg','_tumb.JPG','_tumb.jpeg','_tumb.png','_tumb.gif', ' '),$file_name);
				 
				$filename = "../avatar/$tumb_new";
				if (file_exists($filename)) {
					$tumb_new = $mysqli->real_escape_string($tumb_new);
				}
				else {
					$tumb_new = "default_avatar_tumb.png";
				}
				 $mysqli->query("UPDATE `users` SET `user_avatar` = '$file_name', `user_tumb` = '$tumb_new'  WHERE `user_id` = '{$data["user_id"]}'");
				 $mysqli->query("UPDATE `chat` SET `avatar` = '$tumb_new'  WHERE `post_user` = '{$data["user_name"]}'");
				 $mysqli->query("UPDATE `private` SET `avatar` = '$tumb_new'  WHERE `hunter` = '{$data["user_name"]}'");
				 echo 5;
				 }
				 else {
					echo 2909457;
				}
				}
			} 
		}
		else{
			echo 4;
		}
	}
	else {
		echo 3;
	}
}
else {
	echo 1;
}





?>