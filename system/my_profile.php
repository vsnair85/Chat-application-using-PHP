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

$action = date('m/d/Y H:i:s', $user['last_action']);

if($user['user_age'] == 0){
	$my_age = $lang_hidden;
}
else {
	$my_age = $user['user_age'] . " years old";
}
if($user['user_sex'] == 0){
	$sex = $lang_hidden;
}
else{
	if($user['user_sex'] == 1){
		$sex = $lang_male;
	}
	elseif ($user['user_sex'] == 2){
		$sex = $lang_female;
	}
}
if($user['user_description'] == ''){
	$description = $user['user_name'] . " $lang_description";
}
elseif($user['user_description'] == 'you dont have set a description'){
	$description = $user['user_name'] . " $lang_description";
}
else{
	$description = htmlspecialchars($user['user_description']);
}
$my_gender = $user['user_sex'];
$my_sound = $user['user_sound'];
?>

<div class="details bottom_separator details_select">
	<div class="account_element_title">
		<p><?php echo $lang_country; ?></p>
	</div>
	<div class="account_element_select">
		<select class="background_box select_account" id="select_country">
		<option><?php echo $uphidden; ?></option>
			<?php
				$fcountry = fopen("location/country_list.txt", "r");
				if ($fcountry) {
					while (($line = fgets($fcountry)) !== false) {
						if(trim($line) == trim($user['country'])){
						echo "<option selected=\"selected\">$line</option>";
						}
						else {
							echo "<option>$line</option>";
						}
					}
					fclose($fcountry);
				}
			?>
		</select>
	</div>
	<div class="clear"></div>
</div>
<div class="details top_separator bottom_separator details_select">
	<div class="account_element_title">
		<p><?php echo $lang_region; ?></p>
	</div>
	<div class="account_element_select">
		<select class="background_box select_account" id="select_region">
		<option><?php echo $uphidden; ?></option>
			<?php
				if($user['country'] != ""){
					$lcountry = str_replace(" ", "_", trim($user['country']));
					$fregion = fopen("location/regions/" . $lcountry. ".php", "r");
					if ($fregion) {
						while (($lineregion = fgets($fregion)) !== false) {
							if(trim($lineregion) == trim($user['region'])){
								echo "<option selected=\"selected\">" . trim($lineregion) . "</option>";
							}
							else {
								echo "<option>" . trim($lineregion) . "</option>";
							}
						}
						fclose($fregion);
					}
				}
			?>
		</select>
	</div>
	<div class="clear"></div>
</div>
<div class="details top_separator bottom_separator details_select">
	<div class="account_element_title">
		<p><?php echo $lang_age; ?></p>
	</div>
	<div class="account_element_select">
		<select class="background_box select_account" id="select_age">
			<?php
				for($value = $setting['min_age']; $value <= 99; $value++){
						if($value == $my_age){
							echo "<option value=\"$value\" selected=\"selected\">$value</option>";
						}
						else{
							echo "<option value=\"$value\">$value</option>";
						}
				}				
			?>	
			<option value="0" <?= $my_age == 0 ? 'selected="selected"' : '' ?>><?php echo $uphidden; ?></option>				
		</select>
	</div>
	<div class="clear"></div>
</div>
<div class="details top_separator bottom_separator details_select">
	<div class="account_element_title">
		<p><?php echo $lang_sex; ?></p>
	</div>
	<div class="account_element_select">
		<select class="background_box select_account" id="select_gender">
			<option value="0" <?= $my_gender == 0 ? 'selected="selected"' : '' ?>><?php echo $uphidden; ?></option>
			<option value="1" <?= $my_gender == 1 ? 'selected="selected"' : '' ?>><?php echo $lang_male; ?></option>
			<option value="2" <?= $my_gender == 2 ? 'selected="selected"' : '' ?>><?php echo $lang_female; ?></option>
		</select>
	</div>
	<div class="clear"></div>
</div>
<div class="details top_separator details_select">
	<div class="account_element_title">
		<p><?php echo $upsound; ?></p>
	</div>
	<div class="account_element_select">
		<select class="background_box select_account" id="select_sound">
			<option value="2" <?= $my_sound == 2 ? 'selected="selected"' : '' ?>><?php echo $sfull_sound; ?></option>
			<option value="1" <?= $my_sound == 1 ? 'selected="selected"' : '' ?>><?php echo $sprivate_only; ?></option>
			<option value="0" <?= $my_sound == 0 ? 'selected="selected"' : '' ?>><?php echo $no_sound; ?></option>
		</select>
	</div>
	<div class="clear"></div>
</div>
<?php 
	$adsep = '';
	$adsep2 = '';
	if($setting['custom_count'] >= 1){
		$adsep = 'bottom_separator ';
	}
	if($setting['custom_count'] > 1){
		$adsep2 = 'bottom_separator ';
	}
?>
<?php
	$usercustom1 = htmlspecialchars($user['custom1']);
	$usercustom2 = htmlspecialchars($user['custom2']);
	if($setting['custom_count'] >= 1){
	echo '<div class="details_last ' . $adsep2 . '">
			<div class="custom_element_title">
				<p>' . $setting['custom1'] . '</p>
			</div>
			<div class="custom_element_select">
				<input class="background_box" id="custom1" value="' . $usercustom1 . '"></input>
			</div>
			<div class="clear"></div>
		</div>';
	}
	if($setting['custom_count'] == 2){
	echo '<div class="details_last top_separator">
			<div class="custom_element_title">
				<p>' . $setting['custom2'] . '</p>
			</div>
			<div class="custom_element_select">
				<input class="background_box" id="custom2" value="' . $usercustom2 . '"></input>
			</div>
			<div class="clear"></div>
		</div>';
	}
?>
<div class="profile_description_wrap">
	<p class="about_left"><?php echo $lang_about; ?></p>
	<textarea class="background_box" id="my_description" placeholder="<?php echo $description; ?>" maxlength="500" value=""></textarea>
</div>