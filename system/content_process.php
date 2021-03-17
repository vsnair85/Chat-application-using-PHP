<?php
	
	// list all addons in the addons section
	
	function listAddons(){
		$directory = "addons/";
		$files = glob($directory . "*");
		foreach($files as $file)
		{
		 if(is_dir($file))
			{
				$addons = str_replace($directory,'',$file);
				echo "<div  id=\"$addons\" value=\"addon_panel\" class=\"addon_options other_panels\">
						<img  value=\"" . str_replace("_"," ",$addons) . "\"src=\"addons/$addons/images/$addons.png\"/>
				</div>";
			}
		}
	}
	
	
	// list emoticon in the chat 
	
	function listSmilies()
	{
		$files = scandir('emoticon');
			foreach ($files as $file) 
			{
				if ($file != "." && $file != "..")
				{
						$smile = preg_replace('/\.[^.]*$/', '', $file);
						if(strpos($file, '.png')){
							echo "<div  class=\"emoticon closesmilies\"><img  src='emoticon/{$smile}.png' title=':{$smile}:' onclick=\"emoticon(document.chat_data.content, ':{$smile}:')\" class=\"chat_emoticon\"'></div>\n";
						}
						if(strpos($file, '.gif')){
							echo "<div  class=\"emoticon closesmilies\"><img  src='emoticon/{$smile}.gif' title=':{$smile}:' onclick=\"emoticon(document.chat_data.content, ':{$smile}:')\" class=\"chat_emoticon\"'></div>\n";
						}
				}
			}
	}
	
	
	// function to convert user typing to smilies
	function emoticon($emoticon)
	{
		if ($dir = opendir('../emoticon')) 
		{
			while (false !== ($file = readdir($dir)))
			{
				if ($file != "." && $file != "..")
				{
						$select = preg_replace('/\.[^.]*$/', '', $file);
						if(strpos($file, '.png')){
							$emoticon = str_replace(':' . $select . ':', '<img  class="emo_chat" src="emoticon/' . $select . '.png" title=":' . $select . ':"  > ', $emoticon);
						}
						if(strpos($file, '.gif')){
							$emoticon = str_replace(':' . $select . ':', '<img  class="emo_chat" src="emoticon/' . $select . '.gif" title=":' . $select . ':"  > ', $emoticon);
						}
				}
			}
			
			closedir($dir);
		}
		
		return $emoticon;
	}
	// link, youtube, and picture management regex
	function topiclink($source){

	$text = preg_replace('/(^|[^"])(((f|ht){1}tp:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="\\2" target="_blank">\\2</a>', $source);
	return $text;
	}

	function linking($source, $use_icon) {
	  $source = str_replace('youtu.be/','youtube.com/watch?v=',$source);
	  $render = preg_replace('@https?:\/\/([-\w\.]+[-\w])+(:\d+)?\/[\w\/_~\%\+\.-]+\.(png|gif|jpg|jpeg)((\?\S+)?[^\.\s])?@i', ' <a href="$0" class="fancybox"><img src="media_icon/photolink.gif"/></a> ', $source);
	  if(preg_last_error()) {
		$render = $source;
	  }
	  $render = preg_replace('@https?:\/\/(www\.)?youtube.com/watch\?v=[\w_-]*@i', ' <a href="$0" class="fancybox-video"><img src="media_icon/youtube.gif"/></a> ', $render);
	  $render = preg_replace('@https?:\/\/(www\.)?vimeo.com/[0-9]*@i', ' <a href="$0" class="fancybox-vimeo"><img src="media_icon/vimeo.gif"/></a> ', $render);
	  $render = preg_replace('@([^=][^"])(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.\%\+#-]*(\?\S+)?[^\.\s])?)?)@', '$1<a href="$2" target="_blank">$2</a>', $render);
	  return preg_replace('@^(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.~\%\+#-=]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $render);
	}
	
	function prolink($source) {
	  $render = preg_replace('@([^=][^"])(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.\%\+#-]*(\?\S+)?[^\.\s])?)?)@', '$1<a href="$2" target="_blank">$2</a>', $source);
	  return preg_replace('@^(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.~\%\+#-=]*(\?\S+)?[^\.\s])?)?)@', '<a class="link_pro" href="$1" target="_blank">$0</a>', $source);
	}
	
	
	function excluded($n_exclude, $c_entry) 
	{
		foreach ($n_exclude as $u_exclude) {
			if (stripos(strtolower($c_entry),strtolower($u_exclude)) !== FALSE) {
				return true;
			}
		}
	}
	
function createThumbnail($pathToImage, $thumbWidth = 80) {
    $result = 1;
    if (is_file($pathToImage)) {
        $info = pathinfo($pathToImage);

        $extension = strtolower($info['extension']);
        if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {

            switch ($extension) {
                case 'jpg':
                    $img = imagecreatefromjpeg("{$pathToImage}");
                    break;
                case 'jpeg':
                    $img = imagecreatefromjpeg("{$pathToImage}");
                    break;
                case 'png':
                    $img = imagecreatefrompng("{$pathToImage}");
                    break;
                case 'gif':
                    $img = imagecreatefromgif("{$pathToImage}");
                    break;
                default:
                    $img = imagecreatefromjpeg("{$pathToImage}");
            }
            // load image and get image size

            $width = imagesx($img);
            $height = imagesy($img);

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = 80;

            // create a new temporary image
            $tmp_img = imagecreatetruecolor($new_width, $new_height);

            // copy and resize old image into new image
            imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                $pathToImage = str_replace(array('.jpg','.JPG','.jpeg','.png','.gif'),"",$pathToImage) . '_tumb.' . $extension;
            // save thumbnail into a file
            imagejpeg($tmp_img, "{$pathToImage}");
            $result = 0;
        } else {
            $result = 1;
        }
    } else {
        $result = 1;
    }
    return $result;
}

// converting text with users text tools selection

function styling($high, $bold, $italic, $color, $underline, $source) {
	
	$rbold = "";
	$runder = "";
	$ritalic = "";
	$rcolor = "";
	$rhigh = "";
	if($bold == 1){
		$rbold = " font-weight:bold;";
	}
	if($underline == 1){
		$runder = " text-decoration:underline;";
	}
	if($italic == 1){
		$ritalic = " font-style:italic;";
	}
	if($color != 'transparent' && $color != "rgba(0, 0, 0, 0)"){
		$rcolor = " color:$color;";
	}
	if($high != 'transparent' && $high != "rgba(0, 0, 0, 0)"){
		$rhigh = " background:$high; padding:1px 4px;";
	}
	$check_styling = trim($rbold.$runder.$ritalic.$rcolor.$rhigh);
	if($check_styling == ""){
		$new_content = "$source";
	}
	else {
		$new_content = "<span style=\"$rbold$runder$ritalic$rcolor$rhigh\">$source</span>";
	}
	
    return $new_content;
}
function emoprocess($string) {

	$string = str_replace(array(':)',':P',':D',':(',';)',':-O',';P'),array(':smile:',':tongue:',':bigsmile:',':sad:',':blink:',':omg:', ':tongue:'), $string);
	return $string;
}
// emoticon and username process 

function uprocess($me, $me2, $string) {

	if (preg_match('/http/',$string)){
		$string = $string;
	}
	else {
		$string = str_replace(array(" $me"," $me2", "$me ", "$me2 "),array("<span class=\"my_notice\">$me</span>","<span class=\"my_notice\">$me</span>","<span class=\"my_notice\">$me</span>","<span class=\"my_notice\">$me</span>"), $string);
	}
	return $string;
}


// delete user content when kill account

function delete_files($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
	 if (!$dir_handle)
	      return false;
	 while($file = readdir($dir_handle)) {
	       if ($file != "." && $file != "..") {
	            if (!is_dir($dirname."/".$file))
	                 unlink($dirname."/".$file);
	            else
	                 delete_files($dirname.'/'.$file);
	       }
	 }
	 closedir($dir_handle);
	 rmdir($dirname);
	 return true;
}
	
function friends($name, $status, $path, $av, $tx1, $tx2, $tx3, $st, $rst)
{
	$cst = '';
	$dficon = $path;
	if($av != 'default_avatar_tumb.png'){
		$path = 'avatar';
	}
	else {
		$path = $path;
	}
	if($st >= $rst){
		$cst = '<li class="user_option_separator send_private" value="' . $name . '">' . $tx2 . '</li>';
	}
	return '<li class="users_option">
				<div class="open_user  hover_element">
					<img class="avatar_userlist" src="' . $path . '/' . $av . '"/><p class="usertarget" id="' . $name . '">' . $name . '<span class="friend_status"><img src="' . $dficon . '/' . $status . '.png"/></span></p>
				</div>
				<div class="option_list">
					<ul class="user_option_list" value="' . $name . '">
						<li class="user_option_separator get_info" value="get_info">' . $tx1 . '</li>
						' . $cst . '
						<li class="user_option_separator delete_friend" value="delete_friend">' . $tx3 . '</li>
					</ul>
				</div>
			</li>';	
}
function friends_pending($name, $path, $tx1, $tx2, $cfr, $afr)
{
	$okfr = '';
	$frmar = ' friend_no_allow';
	if($cfr >= $afr){
		$okfr = '<div class="friend_bottom">
					<button class="selected_element sub_button hover_element button_half friend_menu_button button_left friend_accept" value="' . $name . '">' . $tx1 . '</button>
					<button class="selected_element sub_button hover_element  button_half friend_menu_button button_right friend_decline" value="' . $name . '">' . $tx2 . '</button>
				</div>';
		$frmar = '';
	}
	return '<div class="container_friend sub_element">
				<div class="friend_top' . $frmar . '">
					<div class="friend_info">
						<button class="friend_ginfo" value="' . $name . '" type="button"><i class="fa fa-2x fa-user"></i></button>
					</div>
					<div class="friend_name">
						<p>' . $name . '</p>
					</div>
					<div class="clear"></div>
				</div>
				' . $okfr . '
				<div class="clear"></div>
			</div>';
}

// validate username 

function validate_name($name, $name_limit, $name_system){
	if(preg_match("/^[a-zA-Z0-9]{1,}[_-]?[a-zA-Z0-9]{1,}[_-]?[a-zA-Z0-9]{1,}$/", $name) && strlen($name) <= $name_limit && !ctype_digit($name) && $name !== $name_system && strlen($name) >= 4){
		$valid_name = 1;
	}
	else {
		$valid_name = 0;
	}
	return $valid_name;
}
?>
