<?php
require_once("system/database.php");

$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if(isset($_GET['embed'])){
	echo "<script" . " type='text/javascript'" . ">top.location.href = 'facebook_login2.php';</script>";
	die();
}
$user_ip = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
$action = time();
$post_time = date("H:i", $time);

$setting = mysqli_fetch_array($mysqli->query("SELECT allow_logs, default_theme, language, domain FROM `setting` WHERE `id` = '1'"));
$facebook = mysqli_fetch_array($mysqli->query("SELECT * FROM `facebook` WHERE `id` = '1'"));
$current_theme = $setting['default_theme'];

require_once("system/language/" . $setting['language'] . "/language.php");

// define domain

$domain = $setting['domain'];
$fapi = $facebook['fkey'];
$fsecret = $facebook['fsecret'];

session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( "$fapi", "$fsecret" );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper("$domain/facebook_login.php" );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?fields=first_name,email,gender' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id'); //Facebook ID
 	    $fbfullname = $graphObject->getProperty('first_name'); // full name
	    $femail = $graphObject->getProperty('email');    // email
	    $fgender = $graphObject->getProperty('gender');    // gender
		
		if($fgender == 'male'){
			$fgender = 1;
		}
		else if($fgender == 'female'){
			$fgender = 2;
		}
		else {
			$fgender = 0;
		}
		
		$fbfullname = trim($fbfullname);
		if(strlen($fbfullname) > 25){
			$fbfullname = substr($fbfullname, 0, 25);
		}
		if($fbfullname == ""){
			$fbfullname = "Facebook";
		}
		
		if(trim($femail) == ""){
			$femail = "facebook@facebook.com";
		}
		
		$fbfullname = str_replace(array(" " , "."), "", $fbfullname);
		
		// check if user exist 
		
		$fbexist = $mysqli->query("SELECT * FROM `users` WHERE `fb_id` = '$fbid'");
		
		if($fbexist->num_rows > 0 && $fbexist->num_rows < 2){
			$fbuser = $fbexist->fetch_array(MYSQLI_BOTH);
			$fbpass = $fbuser['user_password'];
			$fbusername = $fbuser['user_name'];
			
			setcookie("username","$fbusername",time()+ (1000 * 1000 * 100));
			setcookie("password","$fbpass",time()+ (1000 * 1000 * 100));
			if($setting['allow_logs'] == 1){
				$join_chat = "$fbusername $join_notice";
				$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$action', '$post_time', '999999', '$lang_system', '$join_chat', {$fbuser['user_roomid']}, 'bold', 'system', 'default_system_tumb.png')");
			}
		}
		else {
			$part1 = rand(111111, 999999);
			$part2 = rand(111111, 999999);
			$part3 = $fbusername;
			
			$finalpass = $part1 . $part3 . $part2;
			$user_password = sha1(str_rot13($finalpass . $encryption));
			
			$fbok = 0;
			$fbcount = 0;
			$try = $fbfullname;
			
			while($fbok == 0){
				$fbdouble = $mysqli->query("SELECT * FROM `users` WHERE `user_name` = '$try'");
				if($fbdouble->num_rows > 0){
					$fbcount++;
					$try = $fbfullname . $fbcount;
					$fbok = 0;
				}
				else{
					$fbfullname = $try;
					$fbok = 1;
				}
			}
			
			$mysqli->query("INSERT INTO `users` (user_name, user_password, user_ip, user_email, last_action, user_roomid, user_theme, user_join, guest, user_color, fb_id, user_sex) VALUES ('$fbfullname', '$user_password', '$user_ip', '$femail', '$action', '1', '$current_theme', '$action', '0', 'user', '$fbid', '$fgender')") or die($mysqli->error);
			setcookie("username","$fbfullname",time()+ (1000 * 1000 * 100));
			setcookie("password","$user_password",time()+ (1000 * 1000 * 100));
			if($setting['allow_logs'] == 1){
				$join_chat = "$fbfullname $join_notice";
				$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$action', '$post_time', '999999', '$lang_system', '$join_chat', 1, 'bold', 'system', 'default_system_tumb.png')");
			}
		}

	header("Location: index.php");
} 
else {
	$loginUrl = $helper->getLoginUrl(array('email'));
	header("Location: ".$loginUrl);
}
?>