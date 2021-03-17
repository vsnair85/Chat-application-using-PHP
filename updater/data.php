<?php
	$mysqli->query("UPDATE setting SET version = '70' WHERE id = 1");
	$mysqli->query("ALTER TABLE `users` MODIFY user_name varchar(50)");
	
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

	
	$mysqli->query("INSERT INTO `facebook` (id) VALUES ('1')");
	$mysqli->query("ALTER TABLE `chat` ADD file int(10) NOT NULL DEFAULT '0'");
	$mysqli->query("ALTER TABLE `private` ADD file int(10) NOT NULL DEFAULT '0'");
	$mysqli->query("ALTER TABLE `setting` ADD img_clean int(10) NOT NULL DEFAULT '604800'");
	$mysqli->query("ALTER TABLE `setting` ADD alogin int(1) NOT NULL DEFAULT '0'");
	$mysqli->query("ALTER TABLE `setting` ADD use_home int(1) NOT NULL DEFAULT '0'");
	$mysqli->query("ALTER TABLE `setting` ADD home varchar(150) NOT NULL DEFAULT ''");
	$mysqli->query("ALTER TABLE `users` ADD bridge varchar(20) NOT NULL DEFAULT ''");
	$mysqli->query("ALTER TABLE `users` ADD fb_id varchar(30) NOT NULL DEFAULT ''");
	$mysqli->query("ALTER TABLE `users` ADD pcount int(10) NOT NULL DEFAULT '0'");
	$mysqli->query("UPDATE users SET count = 0 WHERE user_id > 0");
	
?>