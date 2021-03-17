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
$load_data = 'setting.timezone, setting.allow_theme, setting.default_theme, setting.language, users.user_name, users.user_theme, users.user_access, users.user_ignore';
require_once("config1.php");


if($data["user_access"] == 4){
	$me = $data['user_name'];
	$private = $mysqli->query("SELECT DISTINCT `status`, `hunter` FROM `private` WHERE `target` = '$me' AND `status` < 3  AND `hunter` != '$me' ORDER BY `status` ASC");
	if ($private->num_rows > 0)
	{
		$pname = "zzzzttt";
			while ($my_private= $private->fetch_assoc())
			{
				
				if(!strpos(strtolower($data['user_ignore']), strtolower($my_private['hunter']))){
					if($my_private['status'] == 0){
						echo "<div value=\"{$my_private['status']}\" class=\"element sub_element selected_element\">
								<div class=\"element_name private_view\" value=\"{$my_private["hunter"]}\">
									<p>{$my_private["hunter"]}</p>
								</div>
								<div class=\"delete_element clear_private\" value=\"{$my_private["hunter"]}\">
									<button type=\"button\"><i class=\"remove_element remove_private fa fa-2x fa-close\"></i></button>
								</div>
							</div>";
					}
					else {
						echo "<div value=\"{$my_private['status']}\" class=\"element sub_element hover_element\">
								<div class=\"element_name private_view\" value=\"{$my_private["hunter"]}\">
									<p>{$my_private["hunter"]}</p>
								</div>
								<div class=\"delete_element clear_private\" value=\"{$my_private["hunter"]}\">
									<button type=\"button\"><i class=\"remove_element remove_private fa fa-2x fa-close\"></i></button>
								</div>
							</div>";						
					}
				}		
				$pname = "$pname {$my_private['hunter']} ";
			}
	}
	else {
		echo '<p class="centered_element">' . $noprivate . '</p>';
	}
}
else {
	exit();
}
?>