<?php 
if(isset($_POST['host']) && $_POST['host'] != null && isset($_POST['name']) && $_POST['name'] != null && isset($_POST['user']) && $_POST['user'] != null  && isset($_POST['password']))
{		
	$DB_HOST = $_POST['host'];
	$DB_NAME = $_POST['name'];
	$DB_USER = $_POST['user'];
	$DB_PASS = $_POST['password'];
}
else {
	echo 3;
	die();
}
$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
	echo 2;
	die();
}
else {

	$time = time();
	$encryption1 = rand(1000000,9999999);
	$encryption2 = rand(1000000,9999999);
	$final_encryption = "vmbtrvw" . "$encryption1" . "$encryption2" . "**#3738s**A";


				$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
			
				$mysqli->query("CREATE TABLE IF NOT EXISTS `users` (
				  `user_id` int(10) NOT NULL AUTO_INCREMENT,
				  `user_name` varchar(50) NOT NULL,
				  `old_name` varchar(30) NOT NULL DEFAULT 'e',
				  `user_password` varchar(60) NOT NULL,
				  `user_email` varchar(80) NOT NULL,
				  `user_ip` varchar(30) NOT NULL,
				  `user_join` int(12) NOT NULL,
				  `last_action` int(10) NOT NULL,
				  `last_message` varchar(500) NOT NULL,
				  `user_status` int(1) NOT NULL DEFAULT '1',
				  `user_action` int(1) NOT NULL DEFAULT '1',
				  `user_color` varchar(10) NOT NULL DEFAULT 'user',
				  `user_rank` int(1) NOT NULL DEFAULT '1',
				  `user_access` int(1) NOT NULL DEFAULT '4',
				  `user_roomid` int(6) NOT NULL DEFAULT '1',
				  `user_kick` text NOT NULL,
				  `user_mute` varchar(16) NOT NULL,
				  `mute_time` int(12) NOT NULL,
				  `user_flood` int(1) NOT NULL,
				  `user_theme` varchar(16) NOT NULL DEFAULT 'Gray',
				  `user_sex` int(1) NOT NULL DEFAULT '0',
				  `user_age` int(2) NOT NULL DEFAULT '0',
				  `user_description` text NOT NULL,
				  `user_avatar` varchar(50) NOT NULL DEFAULT 'default_avatar.png',
				  `alt_name` varchar(100) NOT NULL,
				  `upload_count` int(11) NOT NULL DEFAULT '0',
				  `upload_access` int(11) NOT NULL DEFAULT '1',
				  `user_sound` int(1) NOT NULL DEFAULT '2',
				  `temp_pass` varchar(40) NOT NULL DEFAULT '0',
				  `temp_time` int(10) NOT NULL DEFAULT '0',
				  `user_tumb` varchar(100) NOT NULL DEFAULT 'default_avatar_tumb.png',
				  `guest` int(1) NOT NULL DEFAULT '0',
				  `verified` int(1) NOT NULL DEFAULT '1',
				  `valid_key` varchar(64) NOT NULL,
				  `user_ignore` text NOT NULL,
				  `first_check` int(10) NOT NULL DEFAULT '0',
				  `join_chat` int(10) NOT NULL DEFAULT '0',
				  `email_count` int(1) NOT NULL DEFAULT '0',
				  `user_friends` text NOT NULL,
				  `country` varchar(100) NOT NULL,
				  `region` varchar(100) NOT NULL,
				  `city` varchar(100) NOT NULL,
				  `count` int(10) NOT NULL DEFAULT '0',
				  `custom1` varchar(250) NOT NULL DEFAULT '',
				  `custom2` varchar(250) NOT NULL DEFAULT '',
				  `session_id` int(10) NOT NULL DEFAULT '1',
				  `facebook` varchar(120) NOT NULL DEFAULT '',
				  `twitter` varchar(120) NOT NULL DEFAULT '',
				  `pinterest` varchar(120) NOT NULL DEFAULT '',
				  `google` varchar(120) NOT NULL DEFAULT '',
				  `youtube` varchar(120) NOT NULL DEFAULT '',
				  `instagram` varchar(120) NOT NULL DEFAULT '',
				  `linkedin` varchar(120) NOT NULL DEFAULT '',
				  `tumblr` varchar(120) NOT NULL DEFAULT '',
				  `flickr` varchar(120) NOT NULL DEFAULT '',
				  `bridge` varchar(20) NOT NULL DEFAULT '',
				  `fb_id` varchar(30) NOT NULL DEFAULT '',
				  `pcount` int(10) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`user_id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `setting` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `title` varchar(200) NOT NULL DEFAULT 'Boomchat',
				  `registration` int(1) NOT NULL DEFAULT '1',
				  `maintenance` int(1) NOT NULL DEFAULT '1',
				  `flood_delay` int(4) NOT NULL DEFAULT '300',
				  `mute_delay` int(10) NOT NULL DEFAULT '86400',
				  `away` int(6) NOT NULL DEFAULT '900',
				  `gone` int(10) NOT NULL DEFAULT '86400',
				  `default_theme` varchar(15) NOT NULL DEFAULT 'Gray',
				  `allow_theme` int(1) NOT NULL DEFAULT '0',
				  `allow_link` int(1) NOT NULL DEFAULT '0',
				  `chat_history` int(3) NOT NULL DEFAULT '20',
				  `log_history` int(4) NOT NULL DEFAULT '100',
				  `data_delete` int(2) NOT NULL DEFAULT '1',
				  `max_password` int(2) NOT NULL DEFAULT '30',
				  `max_username` int(2) NOT NULL DEFAULT '16',
				  `max_message` int(3) NOT NULL DEFAULT '300',
				  `max_avatar` int(4) NOT NULL DEFAULT '200',
				  `hosting` int(1) NOT NULL DEFAULT '1',
				  `max_host` int(11) NOT NULL DEFAULT '5',
				  `file_weight` int(5) NOT NULL DEFAULT '2',
				  `domain` varchar(100) NOT NULL DEFAULT 'yourdomainhere.net',
				  `emoticon` int(1) NOT NULL DEFAULT '1',
				  `allow_private` int(1) NOT NULL DEFAULT '1',
				  `allow_history` int(1) NOT NULL DEFAULT '1',
				  `allow_image` int(1) NOT NULL DEFAULT '4',
				  `version` int(1) NOT NULL DEFAULT '70',
				  `language` varchar(20) NOT NULL DEFAULT 'English',
				  `ads_delay` int(3) NOT NULL DEFAULT '30',
				  `ads_time` int(10) NOT NULL DEFAULT '0',
				  `ads_count` int(1) NOT NULL DEFAULT '1',
				  `ads_stop` int(1) NOT NULL DEFAULT '0',
				  `allow_ads` int(1) NOT NULL DEFAULT '0',
				  `ads_select` int(1) NOT NULL DEFAULT '1',
				  `orientation` int(1) NOT NULL DEFAULT '1',
				  `welcome` int(1) NOT NULL DEFAULT '0',
				  `guest` int(8) NOT NULL DEFAULT '1',
				  `allow_guest` int(1) NOT NULL DEFAULT '0',
				  `guest_chat` int(1) NOT NULL DEFAULT '0',
				  `guest_clear` int(8) NOT NULL DEFAULT '3600',
				  `activation` int(1) NOT NULL DEFAULT '0',
				  `cookie_ban` int(1) NOT NULL DEFAULT '0',
				  `allow_email` int(1) NOT NULL DEFAULT '1',
				  `chat_speed` int(1) NOT NULL DEFAULT '2',
				  `global_sound` int(1) NOT NULL DEFAULT '1',
				  `silent_mode` int(1) NOT NULL DEFAULT '0',
				  `show_topic` int(1) NOT NULL DEFAULT '1',
				  `private_style` int(1) NOT NULL DEFAULT '1',
				  `welcome_login_title` varchar(40) NOT NULL DEFAULT 'Chat news',
				  `timezone` varchar(60) NOT NULL DEFAULT 'America/Montreal',
				  `welcome_login` varchar(300) NOT NULL DEFAULT 'Welcome to Boomchat you can change this message in your setting panel.',
				  `welcome_chat` varchar(500) NOT NULL DEFAULT 'Welcome new member please be respectfull with other users and keep conversation clean enjoy your chat.',
				  `min_age` int(2) NOT NULL DEFAULT '14',
				  `full_width` int(1) NOT NULL DEFAULT '0',
				  `show_avatar` int(1) NOT NULL DEFAULT '1',
				  `full_form` int(1) NOT NULL DEFAULT '0',
				  `rules` int(1) NOT NULL DEFAULT '0',
				  `allow_logs` int(1) NOT NULL DEFAULT '1',
				  `full_sound` int(1) NOT NULL DEFAULT '0',
				  `rtl` int(1) NOT NULL DEFAULT '0',
				  `allow_colors` int(1) NOT NULL DEFAULT '1',
				  `allow_avatar` int(1) NOT NULL DEFAULT '1',
				  `allow_friend` int(1) NOT NULL DEFAULT '1',
				  `allow_ignore` int(1) NOT NULL DEFAULT '1',
				  `allow_username` int(1) NOT NULL DEFAULT '2',
				  `custom_count` int(1) NOT NULL DEFAULT '0',
				  `custom1` varchar(100) NOT NULL DEFAULT 'Custom1',
				  `custom2` varchar(100) NOT NULL DEFAULT 'Custom2',
				  `img_clean` int(10) NOT NULL DEFAULT '604800',
				  `alogin` int(1) NOT NULL DEFAULT '0',
				  `use_home` int(1) NOT NULL DEFAULT '0',
				  `home` varchar(150) NOT NULL DEFAULT '',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	

				$mysqli->query("CREATE TABLE IF NOT EXISTS `rooms` (
				  `room_id` int(10) NOT NULL AUTO_INCREMENT,
				  `room_name` varchar(40) NOT NULL,
				  `topic` text NOT NULL,
				  `access` int(1) NOT NULL DEFAULT '1',
				  PRIMARY KEY (`room_id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	

				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `private` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `time` int(13) NOT NULL,
				  `message` text NOT NULL,
				  `hunter` varchar(20) NOT NULL,
				  `target` varchar(20) NOT NULL,
				  `status` int(1) NOT NULL,
				  `target_color` varchar(20) NOT NULL,
				  `hunter_color` varchar(20) NOT NULL,
				  `view` int(1) NOT NULL DEFAULT 0,
				  `avatar` varchar(40) NOT NULL,
				  `hunter_guest` int(1) NOT NULL DEFAULT 0,
				  `file` int(10) NOT NULL DEFAULT 0,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `filter` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `word` varchar(20) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `addons` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `name` varchar(50) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `chat` (
				  `post_id` int(10) NOT NULL AUTO_INCREMENT,
				  `user_id` int(5) NOT NULL,
				  `post_date` int(10) NOT NULL,
				  `post_time` varchar(6) NOT NULL,
				  `post_user` varchar(16) NOT NULL,
				  `post_message` text NOT NULL,
				  `post_color` varchar(12) NOT NULL,
				  `post_roomid` int(6) NOT NULL,
				  `type` varchar(10) NOT NULL,
				  `post_target` varchar(16) NOT NULL,
				  `avatar` varchar(40) NOT NULL,
				  `file` int(10) NOT NULL DEFAULT 0,
				  PRIMARY KEY (`post_id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	
				
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `banned` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `ip` varchar(30) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");		
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `theme` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `name` varchar(20) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `friends` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `hunter` varchar(50) NOT NULL,
				  `target` varchar(50) NOT NULL,
				  `status` int(1) NOT NULL DEFAULT 1,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");	
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `player` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `use_player` int(1) NOT NULL DEFAULT '0',
				  `player_status` int(1) NOT NULL DEFAULT '1',
				  `player_url` varchar(200) NOT NULL DEFAULT '',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");
				
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `images` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `file_name` varchar(300) NOT NULL DEFAULT '',
				  `date_sent` int(10) NOT NULL DEFAULT '0',
				  `user_name` varchar(50) NOT NULL DEFAULT '',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");
				
				$mysqli->query("CREATE TABLE IF NOT EXISTS `facebook` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `flogin` int(1) NOT NULL DEFAULT '0',
				  `fkey` varchar(30) NOT NULL DEFAULT '',
				  `fsecret` varchar(40) NOT NULL DEFAULT '',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");


					$database_write = '<?php
// you can edit these lines to configure new setting for your chat
$DB_HOST = "' . $DB_HOST . '";
$DB_USER = "' . $DB_USER . '";
$DB_PASS = "' . $DB_PASS . '";
$DB_NAME = "' . $DB_NAME . '";

// Please do not modify this line post installation
$encryption = "' . $final_encryption . '";
$check_install = 1;
?>';
		
					$database_file = fopen("../system/database.php", "w+");
					fwrite($database_file, $database_write);
					fclose($database_file);
					$mysqli->query("INSERT INTO `rooms` (room_name, topic) VALUES ('Main', 'You can view user manual by typing /manual or change that topic by typing /topic')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `setting` (title, default_theme) VALUES ('Boomchat', 'Gray')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Blue')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Corporate')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Default')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Dark')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Fancy_gold')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Gray')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Lite')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Lite_blue')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Midnight_cherry')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Pinky_winky')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `theme` (name) VALUES ('Red')") or die($mysqli->error);
					$mysqli->query("INSERT INTO `facebook` (id) VALUES ('1')");
					$mysqli->query("INSERT INTO `player` (id) VALUES ('1')");
					echo 1;

}
?>	