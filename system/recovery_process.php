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
require_once("config.php");
	
	if (isset($_POST["ruser"]) && isset($_POST["remail"]))
	{
		$user_name = $mysqli->real_escape_string(trim($_POST["ruser"]));
		$user_email = $mysqli->real_escape_string(trim($_POST["remail"]));
		$user_info = $mysqli->query("SELECT * FROM `users` WHERE `user_name` = '{$user_name}' AND `user_email` = '{$user_email}'");
		$user_detail = $user_info->fetch_array(MYSQLI_BOTH);
		
		if ($user_info->num_rows > 0)
		{
			$temp1 = rand(10,99);
			$temp2 = rand(10,99);
			$temp3 = substr(str_shuffle($user_name), 0, 4);
			$temp4 = $encryptcode;
			$final = str_shuffle($temp4.$temp1.$temp3.$temp2);
			$team = $setting['title'];

		   $to = $user_email;
		   $subject = "$subject";
		 		
			$message = "
			<html>
			<head>
			</head>
			<body>
			<div>
				$emailintro
			</div>
			<div>
				<br/>
			</div>
			<div>
				$emailpart1
			</div>
			<div>
				<br/>
			</div>
			<div>
				$emailpart2
			</div>
			<div>
				<br/>
			</div>
			<div>
				$reccheck : $final
			</div>
			<div>
				<br/>
			</div>
			<div>
				$team $emailteam
			</div>
			</body>
			</html>
			";						
						
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$headers .= $siteemail . "\r\n";
		   
		   $tempmail = mail($to,$subject,$message,$headers);
		   if($tempmail == true){
				$mysqli->query("UPDATE `users` SET `temp_pass` = '$final', `temp_time` = '$time' WHERE `user_name` = '$user_name'");
				echo 2;
		   }
		   else{
				echo 3;
			}
		}
		else {
			echo 1;
		}
	}
	else {
		die();
	}
?>