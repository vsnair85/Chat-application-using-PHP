<?php 
if(is_dir("../avatar/") && is_writable("../avatar/") && is_dir("../system/") && is_writable("../system/database.php") && is_dir("../upload/") && is_writable("../upload/")){
	echo 1;
}
else {
	echo "<div id=\"container_permission\">";
	if(is_dir("../avatar/") && !is_writable("../avatar/")){
		echo "<div class=\"writable\"><span>avatar</span> folder is not writable</div>";
	}
	if(is_dir("../system/") && !is_writable("../system/database.php")){
		echo "<div class=\"writable\"><span>database.php</span> in system folder is not writable</div>";
	}
	if(is_dir("../upload/") && !is_writable("../upload/")){
		echo "<div class=\"writable\"><span>upload</span> folder is not writable</div>";
	}
	echo "<h3>Please set 755 permission to these files and folder<br /> then click continue</h3>";
	echo "<button class=\"install_button permission_button\" id=\"permission_button\">Continue</button>";
	echo "</div>";
}
?>