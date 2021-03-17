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
$load_data = 'setting.allow_theme, setting.default_theme, setting.language, setting.timezone, users.user_theme, users.user_access, users.user_roomid,
users.user_name, users.valid_key, users.user_email, users.email_count, users.verified, setting.domain, users.user_id';
require_once("config1.php");

	if($data['verified'] == 0){
		if($data['email_count'] <= 3){
			$count = $data['email_count'] + 1;
			$mysqli->query("UPDATE `users` SET `email_count` = $count WHERE `user_id` = '{$data['user_id']}'");
			$who = $data['user_name'];
			$key = $data['valid_key'];
			$email = $data['user_email'];
			$link = $data['domain'] . "/validator/validate.php?us=$who&val=$key";
			
			$to = "$email";
			$subject = "$active_subject";

			$message = "
			<html>
			<head>
			</head>
			<body>
			<div>
				$act_mail_part1 $who
			</div>
			<div>
				<br/>
			</div>
			<div>
				$act_mail_part2
			</div>
			<div>
				<br/>
			</div>
			<div>
				$act_mail_part3 : $link
			</div>
			<div>
				<br/>
			</div>
			<div>
				$act_mail_part4
			</div>
			</body>
			</html>
			";
			
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			$headers .= $siteemail . "\r\n";

			$send_val = mail($to,$subject,$message,$headers);
			if($send_val == false){
				echo 3;
				die();
			}
			echo 1;
		}
		else {
			echo 100;
		}
	}
	else {
		echo 2;
	}

?>