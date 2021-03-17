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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language,
setting.allow_avatar, setting.domain, users.user_name, users.user_theme, users.user_rank';

require_once("config1.php");
if($access == 'off'){ die();}
require_once("content_process.php");


if(isset($_POST['get_user'])){
	$locate = $mysqli->real_escape_string(trim($_POST['get_user']));
	$find_user = $mysqli->query("SELECT * FROM users WHERE user_name =  '$locate'");
	if ($find_user->num_rows > 0){
	$info = $find_user->fetch_array(MYSQLI_BOTH);
	
	
		if($data['user_rank'] > $info['user_rank']){
		
		$age = $info['user_age'];
		
		if($info['user_age'] == 0){
			$my_age = $lang_hidden;
		}
		else {
			$my_age = $info['user_age'] . " years old";
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
			$description = $info['user_name'] . " $lang_description";
		}
		elseif($info['user_description'] == 'you dont have set a description'){
			$description = $info['user_name'] . " $lang_description";
		}
		else{
			$description = htmlspecialchars($info['user_description']);
		}
		$my_gender = $info['user_sex'];
		$my_sound = $info['user_sound'];
		$avatar = $info['user_avatar'];
		
		if($avatar == 'default_avatar.png'){
			$avatar_path = "$icon_path";
		}
		else {
			$avatar_path = 'avatar';
		}
		$rank = $info['user_rank'];
		if($rank == 1){
			$rank = $lang_user;
		}
		elseif($rank == 2){
			$rank = $lang_vip;
		}
		elseif($rank == 3){
			$rank = $lang_mod;
		}
		elseif($rank == 4){
			$rank = $lang_admin;
		}
		elseif($rank == 5){
			$rank = $lang_sadmin;
		}
		if($info['guest'] == 1){
			$rank = $lang_guest;
		}
		
		?>
		<div id="edit_target" name="<?php echo $info['user_name']; ?>" value="<?php echo $info['user_id']; ?>"></div>
		<div class="edit_section">
			<h2 id="this_user_name" class="centered_element"><?php echo $info['user_name']; ?></h2>
			<h3 class="sub_color centered_element profile_rank"><?php echo $rank; ?></h3>
			<div id="avatar" class="avatar_edit">
				<?php echo '<img  id="eavatar" value="' . $data['domain'] . '/' . $icon_path . '/default_avatar.png" class="profile_avatar"  src="' . $data['domain'] . '/' . $avatar_path . '/' . $avatar . '"/>'; ?>
			</div>
			<button class="sub_button hover_element full_button edit_button"  value="avatar" id="edit_avatar"><?php echo $remove_avatar; ?></button><br/>
			<div class="clear"></div>
		</div>
		<div class="edit_section">
		<?php
		// display personal info
		
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
		
		$action = date('n/d/y H:i', $info['last_action']);
		
		// display last action 
		
			echo '<h3 class="centered_element sub_color">' . $lang_action . '</h3>
				<p class="centered_element">' . $action . '</p>';
				
		// display user ip 
		
		$ip = $info['user_ip'];
		$email = $info['user_email'];
		
		if($data['user_rank'] > 3){
			echo '<h3 class="centered_element sub_color">' . $lang_ip . '</h3>
			<p class="centered_element">' . $ip . '</p>';
		}
		
		?>
		</div>
		<div class="edit_section">
			<button class="edit_action_button hover_element sub_button button_left button_half edit_button" value="kick"><?php echo $uskick; ?></button>
			<button class="edit_action_button hover_element sub_button button_right button_half edit_button" value="mute"><?php echo $usmute; ?></button>
			<button class="edit_action_button hover_element sub_button button_left button_half edit_button" value="ban"><?php echo $usban; ?></button>
			<button class="edit_action_button hover_element sub_button button_right button_half edit_button" value="delete"><?php echo $usdelete; ?></button>
			<div class="clear"></div>
		</div>
		<div class="edit_section">
			<p id="error_mname"></p>
			<input placeholder="<?php echo $info['user_name']; ?>" class="input_password background_box" id="new_member_name"/><br/>
			<button class="sub_button hover_element full_button" value="name" id="edit_name"><?php echo $update_name; ?></button><br/>
			<div class="clear"></div>
		</div>
		<div class="edit_section">
			<p id="error_email"></p>
			<input placeholder="<?php echo $info['user_email']; ?>" class="input_password background_box" id="new_email"/><br/>
			<button class="sub_button hover_element full_button" value="email" id="edit_email"><?php echo $update_email; ?></button><br/>
			<div class="clear"></div>
		</div>
		<div class="edit_section">
			<p id="error_pass"></p>
			<label><?php echo $upchangepass3; ?></label></br>
			<input class="input_password background_box" id="edit_new_password" type="password"/></br>
			<button class="sub_button hover_element full_button" value="password" id="edit_password"><?php echo $upchangepass5; ?></button><br/>
			<div class="clear"></div>
		</div>
			
<?php

}
else {
	echo '<h2 class="centered_element">' . $no_edit . '</h2>';
}	
	}
	else {
		echo '<h2 class="centered_element">' . $no_edit_found . '</h2>';
	}
}
else {
	echo 10;
	die();
}
?>