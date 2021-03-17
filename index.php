<?php
/////////// BoomChat v 1.00 /////////////////
// all right reserved to Robert Barnabé
////////////////////////////////////////////
require_once("system/config.php");
$embed = 0;
if(isset($_GET['reload'])){
	header("Location: index.php");
}
if($chat_install != 1){
	include('builder/installer.php');
	die();
}
if(isset($_GET['embed'])){
	$embed = 1;
	$referer = $mysqli->real_escape_string(trim($_SERVER['HTTP_REFERER']));
	setcookie("bctref","$referer",time()+ (100), '/');
}

$user_ip = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
$checkban = $mysqli->query("SELECT `ip` FROM `banned` WHERE `ip` = '$user_ip'");


$check_player = $mysqli->query("SELECT * FROM player WHERE id = '1'");
$player = $check_player->fetch_array(MYSQLI_BOTH);

$faceload = $mysqli->query("SELECT * FROM facebook WHERE id = '1'");
$facebook = $faceload->fetch_array(MYSQLI_BOTH);

if($checkban->num_rows > 0 && $setting['cookie_ban'] == 1 ){
	setcookie("banned","banned",time()+ (1000 * 1000));
}
if (!isset($_COOKIE["banned"])){
	$testcc = 'banok';
}
else {
	$testcc = 'banned';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title><?php echo $setting['title']; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="system/language/<?php echo $setting['language']; ?>/language.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="js/fancybox/javaimage.js"></script>
<script type="text/javascript" src="js/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="js/avatar.js"></script>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="js/jqueryui/jquery-ui.css" />
<?php if($setting['rtl'] == 1){ $rtl = 'rtl/';} else { $rtl = ""; }?>
<link rel="stylesheet" type="text/css" href="css/<?php echo $rtl; ?>main.css" />
<link rel="stylesheet" type="text/css" href="css/<?php echo $rtl; ?>panel.css" />
<link rel="stylesheet" type="text/css" href="css/upload.css" />
<link rel="stylesheet" type="text/css" href="css/color_picker.css" />
<link rel="stylesheet" type="text/css" href="css/addons.css" />
<?php if($access == 'on'){
$load_addons = $mysqli->query("SELECT `name` FROM `addons` WHERE `id` > 0");
	if($load_addons->num_rows > 0){
		while ($list_addons = $load_addons->fetch_assoc()){
			include('addons/' . $list_addons['name'] . '/data/css.php');
		}
	}
}
?>
<link id="active_theme" rel="stylesheet" type="text/css" href="css/themes/<?php echo "$icon_set/$icon_set"; ?>.css" />
<link id="active_icon" rel="stylesheet" type="text/css" href="css/themes/<?php echo "$icon_set/icon"; ?>.css" />
<link rel="stylesheet" type="text/css" href="css/<?php echo $rtl; ?>chat.css" />
<link rel="stylesheet" type="text/css" href="css/<?php if($setting['orientation'] == 1){ echo 'ads.css'; }else { echo 'ads_reverse.css'; } ?>" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<style>
.wrap_picker {
	background-image:url('css/themes/<?php echo $icon_set; ?>/icon/empty.png');
}
.empty_pick {
	background-image:url('css/themes/<?php echo $icon_set; ?>/icon/empty1.png');
}
</style>
<?php if($setting['orientation'] == 2){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/reverse.css\" />"; } ?>
<?php
	if($setting['show_avatar'] == 0){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/" . $rtl . "hide_avatar.css\" />";
	}
?>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript">
	var user_rank = '<?php if ($access == 'on'){echo $user["user_rank"];} ?>';
	var user_access = '<?php if ($access == 'on'){echo $user["user_access"];} ?>';
	var sesid = '<?php if($access == 'on'){ echo $user['session_id'];} else { echo ""; }?>';
	var user_theme = '<?php if($access == 'on'){ echo $user['user_theme'];} else { echo ""; }?>';
	var my_username = '<?php if ($access == 'on'){echo $user["user_name"];} ?>';
	var user_room = '<?php if ($access == 'on'){echo $user["user_roomid"];} ?>';
	var user_private = "";
	var checkUsername = "";
	var boxZone = <?php echo $setting['orientation']; ?>;
	var checkScroll = 0;
	var scrollStart = 0;
	var scrollCompare = 0;
	var privateStyle = <?php if($setting['version'] > 4) { echo $setting['private_style']; } else { echo 1; } ?>;
	var showTopic = <?php if($setting['version'] >= 4) { echo $setting['show_topic']; } else { echo 1; } ?>;
	var emOn = <?php echo $setting['emoticon']; ?>;
	var whistle = '<?php if($setting['version'] >= 4) { echo $setting['global_sound']; } else { echo 1; } ?>';
	var fullForm = '<?php echo $setting['full_form']; ?>';
	var fw = '<?php echo $setting['full_width']; ?>';
	var acSd = 0;
	var fSd = <?php echo $setting['full_sound']; ?>;
	var uSd = 0;
	var rlc = 0;
	var explorerAgree = <?php echo $setting['rules']; ?>;
	var pxn = <?php echo $setting['allow_private']; ?>;
	var source = '<?php echo $player['player_url']; ?>';
	var uplay = '<?php echo $player['use_player']; ?>';
	var stplay = <?php echo $player['player_status']; ?>;
	var srtl = <?php echo $setting['rtl']; ?>;
	var fmw = <?php echo $setting['file_weight']; ?>;
	var clogs = '0';
	var chr = '0';
	var cnt = '<?php if($access == 'on'){ echo $user['count'];} else { echo ""; }?>';
	var aAllow = <?php echo $setting['allow_ads']; ?>;
	var aSelect = 0;
	var aDelay = <?php echo $setting['ads_delay']; ?>;
	var aCount = <?php echo $setting['ads_count']; ?>;
	var aCurrent = Math.floor(Date.now() / 1000);
	var pCount = "<?php if($access == 'on' && $user['user_rank'] >= $setting['allow_private']){ echo $user['pcount']; } else { echo 0; } ?>";
</script>
</head>
<body>
<div id="external_wrap" value="<?php echo $embed; ?>" >
	<?php 
		if($checkban->num_rows < 1 && $testcc != 'banned'){
			if ($access == 'off'){
					$bridge = 'bridge_login.php';
					if (file_exists($bridge) && $setting['alogin'] == 1) {
						include('bridge/bridge.php');
					}
					else {
						include('control/login.php');
					}
			}
			else {
				if($user['user_status'] == 4){
					$mysqli->query("UPDATE `users` SET `last_action` = '$time', `first_check` = '1', `join_chat` = '1' WHERE `user_name` = '{$user['user_name']}'");
				}
				else {
					$mysqli->query("UPDATE `users` SET `last_action` = '$time', `user_status` = '1', `first_check` = '1', `join_chat` = '1' WHERE `user_name` = '{$user['user_name']}'");
				}
				if ($setting['maintenance'] == 1 || $user['user_rank'] > 2){
					if ($user['user_access'] != 4 && $user['user_access'] != 1) {
						if($user['user_access'] == 2){
							include('control/kicked.php');
						}
						elseif ($user['user_access'] == 0 && $user['user_rank'] < 4){
							include('control/banned.php');
						}
					}
					else{
							if($user['verified'] == 0 && $setting['activation'] == 1 && $user['user_rank'] < 2 && $user['guest'] !== 1){
								include('control/activation.php');
							}
							else {
								include('control/full_chat.php');
							}
					}
				}
				else {
					include('control/maintenance.php');
				}
			}
		}
		else{
			if($user['user_rank'] > 3){
				include('control/full_chat.php');
			}
			else {
				include('control/banned.php');
			}
		}
	?>
</div>
</body>
</html>

