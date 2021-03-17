<?php
require_once("system/config.php");

if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])){

	$me = $user['user_name'];
	$old_password = $mysqli->real_escape_string(trim($_POST['old_password']));
	$new_password = $mysqli->real_escape_string(trim($_POST['new_password']));
	$confirm_password = $mysqli->real_escape_string(trim($_POST['confirm_password']));

	$compare_password = sha1(str_rot13($old_password . $encryption));
	$password_set = sha1(str_rot13($new_password . $encryption));

	if(!empty( $old_password ) && !empty( $new_password ) && !empty( $confirm_password )){
		if($compare_password == $user['user_password']){
			if($new_password == $confirm_password){
				if(strlen($new_password) > 5){
					// password change process 
					setcookie("password","$password_set", time()+ (1000 * 1000));
					$mysqli->query("UPDATE `users` SET `user_password` = '$password_set' WHERE `user_name` = '$me'");
					echo 1;
				}
				else{
					// pass too short
					echo 6;
				}
			}
			else {
				// new pass confirm not matching
				echo 4;
			}
		}
		else {
			// old password not matching
			echo 2;
		}
	}
	else {
		// pass field empty
		echo 3;
	}
}
else{
	// problem occur while submitting
	echo 5;
}
?>