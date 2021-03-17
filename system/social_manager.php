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

$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_theme, users.user_id,
users.user_access, users.facebook, users.pinterest, users.google, users.instagram, users.flickr, users.tumblr, users.youtube,
 users.twitter, users.linkedin';
 
require_once("config1.php");
if($access == 'off'){ die(); }


$soerror = 0;
$me = $data['user_id'];
if( isset($_POST['set_facebook']) && isset($_POST['set_twitter']) 
&& isset($_POST['set_pinterest']) && isset($_POST['set_google']) 
&& isset($_POST['set_youtube']) && isset($_POST['set_linkedin']) 
&& isset($_POST['set_tumblr']) && isset($_POST['set_instagram']) 
&& isset($_POST['set_flickr'])){


	$facebook = $mysqli->real_escape_string(trim($_POST['set_facebook']));
	$twitter = $mysqli->real_escape_string(trim($_POST['set_twitter']));
	$google = $mysqli->real_escape_string(trim($_POST['set_google']));
	$instagram = $mysqli->real_escape_string(trim($_POST['set_instagram']));
	$youtube = $mysqli->real_escape_string(trim($_POST['set_youtube']));
	$tumblr = $mysqli->real_escape_string(trim($_POST['set_tumblr']));
	$flickr = $mysqli->real_escape_string(trim($_POST['set_flickr']));
	$linkedin = $mysqli->real_escape_string(trim($_POST['set_linkedin']));
	$pinterest = $mysqli->real_escape_string(trim($_POST['set_pinterest']));
	
	if($facebook == $data['facebook'] && $twitter == $data['twitter'] && $google == $data['google'] && $instagram == $data['instagram'] 
	&& $youtube == $data['youtube'] && $tumblr == $data['tumblr'] && $flickr == $data['flickr'] && $linkedin == $data['linkedin'] && $pinterest == $data['pinterest']){
		echo 99;
		die();
	}
	
	function validLink($tsocial, $sotype) {
		switch ($sotype) {
			case 'facebook': $socheck= 'facebook.com'; break;
			case 'twitter': $socheck= 'twitter.com'; break;
			case 'youtube': $socheck= 'youtube.com'; break;
			case 'instagram': $socheck= 'instagram.com'; break;
			case 'google': $socheck= 'plus.google.com'; break;
			case 'flickr': $socheck= 'flickr.com'; break;
			case 'tumblr': $socheck= 'tumblr.com'; break;
			case 'pinterest': $socheck= 'pinterest.com'; break;
			case 'linkedin': $socheck= 'linkedin.com'; break;
		}
		if($tsocial !== ''){
			if( strpos(' ' .  $tsocial, 'http://' . $socheck) || strpos(' ' .  $tsocial, 'https://' . $socheck) || strpos(' ' .  $tsocial, 'http://www.' . $socheck) || strpos(' ' .  $tsocial, 'https://www.' . $socheck)){
				return $tsocial;
			}
			else {
				return 'bad';
			}
		}
		else {
			return '';
		}
	}
	$facebook = validLink($facebook, 'facebook');
	$youtube = validLink($youtube, 'youtube');
	$linkedin = validLink($linkedin, 'linkedin');
	$google = validLink($google, 'google');
	$instagram = validLink($instagram, 'instagram');
	$flickr = validLink($flickr, 'flickr');
	$tumblr = validLink($tumblr, 'tumblr');
	$pinterest = validLink($pinterest, 'pinterest');
	$twitter = validLink($twitter, 'twitter');
	
	if($facebook == 'bad' || $youtube == 'bad' || $linkedin == 'bad' || $google == 'bad' || $instagram == 'bad' || $flickr == 'bad' || $tumblr == 'bad' || $pinterest == 'bad' || $twitter == 'bad'){
		$soerror = 1;
	}
	if($soerror < 1){
		$mysqli->query("UPDATE users SET facebook = '$facebook', youtube = '$youtube', linkedin = '$linkedin'
		, google = '$google', instagram = '$instagram', flickr = '$flickr', tumblr = '$tumblr', pinterest = '$pinterest', twitter = '$twitter' WHERE user_id = '$me'");
		echo 1;
	}
	else {
		echo 2;
	}
}

?>