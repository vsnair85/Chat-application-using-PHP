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
$load_data = 'setting.language, setting.default_theme, setting.timezone, setting.allow_theme, users.user_theme';
require_once("config1.php");

?>

<div id="title_filter">
	<?php echo $wordtitle; ?>
</div>
<div class="bottom_separator" id="add_filter">
	<input type="text" id="bad_word"/>
	<button type="button" class="sub_button" id="add_word"><?php echo $addaword; ?></button>
	<div class="clear"></div>
</div>
<div class="top_separator" id="filter_list">
	<?php 
		$words = $mysqli->query("SELECT `word` FROM `filter` WHERE `id` > 0");
		if($words->num_rows > 0){
			while($word = $words->fetch_assoc()){
				echo "<div class=\"container_element sub_element hover_element\"><div class=\"wrap_element\"><div class=\"element_name\"><p>{$word['word']}</p></div><div class=\"delete_element delete_word\"><button type=\"button\" value=\"{$word['word']}\"><i class=\"remove_element remove_word fa fa-2x fa-close\"></i></button></div></div></div>";
			}       
		}
		else{
		
			echo "<div id=\"empty_word\"><p>$nowordin</p></div>";
		}
	?>
</div>