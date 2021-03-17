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
require_once('database.php');
$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if(isset($_POST['country'])){
	$lcountry = $mysqli->real_escape_string(trim($_POST["country"]));
	$lcountry2 = str_replace(" ", "_", $lcountry);
    if( strpos(file_get_contents("location/country_list.txt"),$lcountry) !== false) {
		$fcountry = fopen("location/regions/" . $lcountry2. ".php", "r");
		if ($fcountry) {
			while (($line = fgets($fcountry)) !== false) {
				echo "<option>$line</option>";
			}
			fclose($fcountry);
		}
	}
	else {
		echo "<option>$lcountry</option>";
	}
}
else {
	echo 0;
}
?>
