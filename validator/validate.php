<?php 
	require_once("../system/config.php");
	
	if(isset($_GET['val']) && !empty($_GET['val']) && isset($_GET['us']) && !empty($_GET['us'])){
		$key_check = $mysqli->real_escape_string(trim($_GET['val']));
		$user_key = $mysqli->real_escape_string(trim($_GET['us']));
		$ifvalid = $mysqli->query("SELECT `verified` FROM `users` WHERE `valid_key` = '$key_check' AND `user_name` = '$user_key' ");
		if($ifvalid->num_rows > 0){
			$found = $ifvalid->fetch_array(MYSQLI_BOTH);
			if($found['verified'] == 1){
				$val_result = 2;
			}
			else {
				$val_result = 1;
				$mysqli->query("UPDATE `users` SET `verified` = '1' WHERE `valid_key` = '$key_check'");
			}
		}
		else {
			$val_result = 0;
		}
	}
	else {
		$val_result = 0;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title>Account validation</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="data/style.css" />
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
</head>
<body>
	<div id="external_wrap">
<div id="container_login" class="background_login">
	<div id="header_login" class="bottom_separator">
		<img src="../css/themes/<?php echo $icon_set; ?>/logo/<?php echo $icon_set; ?>.png"/>
	</div>
	<div id="content_login" class="top_separator">
	<?php 
		if($val_result == 1){
		echo "<h3>$pass_validate</h3>";
		echo "<button id=\"chat_button\">$val_chat</button>";
		}
		else if ($val_result == 2){
			echo "<h3>$val_already</h3>";
			echo "<button id=\"chat_button\">$val_chat</button>";
		}
		else {
			echo "<h3>$valid_error</h3>";
		}
	?>
	</div>
</div>
	</div>
</div>
<script type="text/javascript" src="data/valid.js"></script>
</body>
</html>
