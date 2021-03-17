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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, setting.domain, setting.allow_avatar,
 setting.custom1, setting.custom2, setting.custom_count, users.user_name, users.user_theme, users.user_rank, users.user_access';
require_once("config1.php");
require_once("content_process.php");


// get user profile
if(isset($_GET['profile_target']) && $data['user_access'] = 4){

	$target_name = $mysqli->real_escape_string(trim($_GET['profile_target']));
	$findtarget = $mysqli->query("SELECT * FROM `users` WHERE `user_name` = '$target_name'");
	if($findtarget->num_rows > 0){
		$info = $findtarget->fetch_array(MYSQLI_BOTH);
		$name = $info['user_name'];
		$avatar = $info['user_avatar'];
		$age = $info['user_age'];
		$rank = $info['user_rank'];
		$flag = str_replace(" ", "_", trim($info['country']));
		$ip = $info['user_ip'];
		$email = $info['user_email'];
		$theme = $info['user_theme'];
		$us_region = $info['region'];
		$us_country = $info['country'];
		$action = date('n/d/y H:i', $info['last_action']);
		
		$ufacebook = $info['facebook'];
		$utwitter = $info['twitter'];
		$uinstagram = $info['instagram'];
		$uflickr = $info['flickr'];
		$utumblr = $info['tumblr'];
		$ugoogle = $info['google'];
		$upinterest = $info['pinterest'];
		$uyoutube = $info['youtube'];
		$ulinkedin = $info['linkedin'];
		
		
		$action = date('n/d/y H:i', $info['last_action']);
		if($avatar == 'default_avatar.png'){
			$avatar_path = "$icon_path";
		}
		else {
			$avatar_path = 'avatar';
		}
		if($info['user_age'] == 0){
			$age = $lang_hidden;
		}
		else {
			$age = $age . " $lang_old";
		}
		if($info['user_sex'] == 0){
			$sex = $lang_hidden;
		}
		else{
			if($info['user_sex'] == 1){
				$sex = $lang_male;
			}
			elseif ($info['user_sex'] == 2){
				$sex = $lang_female;
			}
		}
		if($info['user_description'] == ''){
			$description = $name . " $lang_description";
		}
		elseif($info['user_description'] == 'you dont have set a description'){
			$description = $name . " $lang_description";
		}
		else{
			$description = $info['user_description'];
		}
		if($rank == 1){
			$rank = $lang_user;
			$pcolor = 'user';
		}
		elseif($rank == 2){
			$rank = $lang_vip;
			$pcolor = 'vip';
		}
		elseif($rank == 3){
			$rank = $lang_mod;
			$pcolor = 'modo';
		}
		elseif($rank == 4){
			$rank = $lang_admin;
			$pcolor = 'admin';
		}
		elseif($rank == 5){
			$rank = $lang_sadmin;
			$pcolor = 'sadmin';
		}
		if($info['guest'] == 1){
			$rank = $lang_guest;
			$pcolor = 'guest';
		}
		echo '<h2 class="centered_element profile_name">' . $name . '</h2>
			<h3 class="sub_color centered_element profile_rank">' . $rank . '</h3>';
			if($data['user_rank'] >= $data['allow_avatar']){
				echo "<div id=\"avatar\">
				<img class=\"profile_avatar fancybox\" href=\"" . $data['domain'] . "/$avatar_path/$avatar\" src=\"$avatar_path/$avatar\"/>
				</div>";
			}
		
		// display personal info
		echo '<div id="details_profile">';
		if($age !== $lang_hidden && $sex !== $lang_hidden){
		echo '<h3 class="details_personal">' . $age . ', ' . $sex . '</h3>';
		}
		
		// display location
		if($us_region != '' && $us_country != '' && $us_country != $uphidden && $us_region != $uphidden){
			echo "<img class=\"profile_flag\" src=\"system/location/flags/" . $flag . ".png\"/>
			<p>$us_region - $us_country</p>";
		}
		
		// display custom field 
		
		if($data['custom_count'] > 0 && $info['custom1'] !== ''){
			echo '<h3 class="sub_color">' . $data['custom1'] . '</h3>
				<p>' . prolink($info['custom1']) . '</p>';
		}
		if($data['custom_count'] > 1 && $info['custom2'] !== ''){
			echo '<h3 class="sub_color">' . $data['custom2'] . '</h3>
				<p>' . prolink($info['custom2']) . '</p>';
		}
		
		// display last action 
			echo '<h3 class="sub_color">' . $lang_action . '</h3>
				<p>' . $action . '</p>';
				
		// display description 
		
		echo '<h3 class="sub_color">' . $lang_about . '</h3>
		<div class="profile_description">
			<p>' . $description . '</p>
		</div>';

		// display social link
		if($ufacebook != '' || $utwitter != '' || $uinstagram != '' || $uflickr != '' || $uyoutube != '' || $ugoogle != '' || $utumblr != '' || $ulinkedin != '' || $upinterest != ''){
			echo '<div class="social_zone">
				<div class="social_container">
					<h3 class="sub_color">' . $lang_social . '</h3>';
					if($ufacebook != ''){ echo '<a target="_BLANK" href="' . $ufacebook . '"><i class="pro_sicon fa fa-lg fa-facebook-square"></i></a>'; }
					if($utwitter != ''){ echo '<a target="_BLANK" href="' . $utwitter . '"><i class="pro_sicon fa fa-lg fa-twitter-square"></i></a>'; }
					if($upinterest != ''){ echo '<a target="_BLANK" href="' . $upinterest . '"><i class="pro_sicon fa fa-lg fa-pinterest-square"></i></a>'; }
					if($ugoogle != ''){ echo '<a target="_BLANK" href="' . $ugoogle . '"><i class="pro_sicon fa fa-lg fa-google-plus-square"></i></a>'; }
					if($uyoutube != ''){ echo '<a target="_BLANK" href="' . $uyoutube . '"><i class="pro_sicon fa fa-lg fa-youtube-square"></i></a>'; }
					if($uinstagram != ''){ echo '<a target="_BLANK" href="' . $uinstagram . '"><i class="pro_sicon fa fa-lg fa-instagram"></i></a>'; }
					if($ulinkedin != ''){ echo '<a target="_BLANK" href="' . $ulinkedin . '"><i class="pro_sicon fa fa-lg fa-linkedin-square"></i></a>'; }
					if($utumblr != ''){ echo '<a target="_BLANK" href="' . $utumblr . '"><i class="pro_sicon fa fa-lg fa-tumblr-square"></i></a>'; }
					if($uflickr != ''){ echo '<a target="_BLANK" href="' . $uflickr . '"><i class="pro_sicon fa fa-lg fa-flickr"></i></a>'; }
				echo '</div>
			
			</div>';
		}
		
		// display for admin info 
		
		if($data['user_rank'] > 3){
			echo '<h3 class="sub_color">' . $lang_ip . '</h3>
			<p>' . $ip . '</p>
			<h3 class="sub_color">' . $lang_email . '</h3>
			<p>' . $email . '</p>';
		}
		echo '</div>';
	}
	else{
		echo "$lang_error";
	}
}
else{
	echo "$lang_error";
}
?>