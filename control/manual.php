<?php 
	include('system/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/Default/manual.css" />
</head>
<body>
	<h1>BoomChat manual</h1>
	<h2>Table of content</h2>
	<ul>
		<li><a href="#part1">Commands</a></li>
		<li><a href="#part2">ranking</a></li>
		<li><a href="#part3">Private chat</a></li>
		<li><a href="#part4">Rooms</a></li>
		<li><a href="#part5">Avatar system</a></li>
	</ul>
	<ul>
		<li><a href="#part7">History</a></li>
		<li><a href="#part8">Themes</a></li>
		<li><a href="#part9">Linking</a></li>
		<li><a href="#part10">Flood</a></li>
		<li><a href="#part11">Settings</a></li>
	</ul>
	<ul>
		<li><a href="#part12">Emoticons</a></li>
		<li><a href="#part13">Hidden options</a></li>
		<li><a href="#part6">Private notification</a></li>
		<li><a href="#part7">User profile</a></li>		
		<li><a href="#part14">Delete a post</a></li>
	</ul>
	<ul>
		<li><a href="#part15">Credits</a></li>
		<li><a href="#part16">Copyright</a></li>
	</ul>
	<div class="clear"></div>
	<a name="part1"></a>
	<h2>List of commands available on the chat</h2>
	<p>Note : higher rank can use commands of lower rank.
	<div id="command">
		<h3>User commands</h3>
			<table>
				<tr><td class="title">/me</td><td class="description">Send a special message on the chat. The message will appear in a different color to the normal post</td></tr>
				<tr><td class="title">/msg </td><td class="description">Send a private message directly to the cat. Private message you send or receive can not be viewed by other users, only you and target can view these messages <span class="note">Example of use : /msg Melissa how are you ?</span></td></tr>
				<tr><td class="title">/seen</td><td class="description">Lets you know the time and date on which a user has been seen on the chat for the last time. Must be followed by a valid username.</td></tr>
				<tr><td class="title">/away </td><td class="description">Change the status of your account to away</td></tr>
				<tr><td class="title">/manual</td><td class="description"> Show the chat manual</li>
			</table>
		<h3>Moderator commands</h3>
			<table>
				<tr><td class="title">/clear</td><td class="description">use the /clear command to clear the current room chat history</td></tr>
				<tr><td class="title">/kick</td><td class="description">Kick a user out of the chat forcing him/her to relog to be able to chat again. Must be followed by a valid username. <span class="note">Example of use : /kick melissa</span></td></tr>
				<tr><td class="title">/mute</td><td class="description">Block user from writing in both private and main chat but will alow him/her to see main chat. <span class="note">Example of use : /mute Melissa</span></td></tr>
				<tr><td class="title">/unmute</td><td class="description">Gives back writing previleges to a user. Moderator can only unban their own muted user. <span class="note">Example of use : /unmute melissa</span></td></tr>
				<tr><td class="title">/topic</td><td class="description">Change the current room topic. Example of use : /topic this is my new topic.</li>
			</table>
		<h3>Administrator commands</h3>
			<table>
				<tr><td class="title">/clear all</td><td class="description">use the "/clear all" command to clear all rooms log at the same time.</td></tr>
				<tr><td class="title">/ban</td><td class="description">Banish the user from the chat and the user can not reconnect. Example of use : /kick melissa</td></tr>
				<tr><td class="title">/rename</td><td class="description">Change the name of the current room. The room name must contain less than 14 caracters to be valid. <span class="note">Example of use : /rename room 1</span></td></tr>
				<tr><td class="title">/global</td><td class="description">Send a message to all rooms at the same time. Admin & Superadmin only.<span class="note">Example of use : /global my message<span></td></tr>
				<tr><td class="title">/setuser</td><td class="description">Demote a user to the user rank. Must be followed by a valid username. <span class="note">Ex: /setuser melissa</span></td></tr>
				<tr><td class="title">/setmod</td><td class="description">Gives moderator previleges to specified user. Must be followed by a valid username. <span class="note">Example of use : /setmod melissa</span></td></tr>
			</table>
		<h3>SuperAdmin commands</h3>
			<table>
				<tr><td class="title">/setadmin</td><td class="description">Gives Admin previleges to specified user. Must be followed by a valid username. <span class="note">Example of use : /setadmin melissa</span></td></tr>
			</table>
	</div>
	<div id="ranking">
	<a name="part2"></a>
		<h2>Users ranking</h2>
			<table>
				<tr><td class="title user">User</td><td class="description">Rank given to all new members, cannot kick, mute or ban.</td></tr>
				<tr><td class="title moderator">Moderator</td><td class="description">Rank level 3, moderators can mute and kick. Note : Moderator can only unmute users they have muted.</td></tr>
				<tr><td class="title admin">Admin</td><td class="description">Rank level 4. Can do almost everything exept changing site settings and cannot set user to admin. This rank cannot be kick, ban, mute by lower or equal rank.</td></tr>
				<tr><td class="title sadmin">SuperAdmin</td><td class="description">Rank level 5, cannot be ban, kick, or mute and is not affected by any of chat settings. This rank have the ultimate access to everything and the power to demote any of other rank user.</td></tr>
			</table>
	</div>
	<a name="part3"></a>
	<h2>Private chat</h2>
	<h3>Private message in main chat</h3>
	<p>With the command <span class="note">/msg</span> followed by a valid username you can send a private message directly to the main chat window. Private message sent in the main chat window cannot be viewed by other users.</p><br />
	<h3>Private chat window</h3>
	<p>To open a private chat with a user, click on a username in the user list.</p>
	
	
	<a name="part4"></a>
	<h2>Managing rooms</h2>
	<h3>Add room</h3>
	<p>Go to the <span class="note">Rooms</span> tab from the option panel then add room by entering new room informations in text box then press add room. <span class="note">Room name must be under 14 caracters.<span></p>
	<h3>Delete a room</h3>
	<p>Go to the <span class="note">Rooms</span> tab from the option panel then click on the X of the room you want to delete from your chat. <span class="note">main room cannot be deleted from the chat it can only be rename</span></p>
	<h3>Rename room</h3>
	<p>To remove a room type <span class="note">/rename (your new room name)</span> in the main input to change the current room name. <span class="note">Room name must be under 14 caracters.<span></p>
	
	
	<a name="part5"></a>
	<h2>Avatar system</h2>
	<p>BoomChat come with a build in avatar system that allow user to set their own avatar. You can set the maximum size of allowed avatar by going in <span class="note">Settings</span> panel then select the maximum size from the select menu then press update settings button. When updating
	new avatar to your account the old avatar is automatically replaced by the new one, In that way only 1 file stay on your host per user.</p>
	
	
	
	<a name="part6"></a>
	<h2>Private notification</h2>
	<h3>Receive a new message</h3>
	<p>When you receive a new private message, you will receive a notification. Unread messages will automatically be on top and have a different color.</p>
	<h3>Send a private notification</h3>
	<p>When you send a private message intended user will receive an alert automatically.</p>
	<h3>Delete a private notification</h3>
	<p>Pour fermer une notification privé vous devez cliquer on the x situé a droite de la notification que vous désirer fermer <span class="note">You can not close a notification if the private chat  with the selected user is still open.</span></p>
	
	
	<a name="part7"></a>
	<h2>User profile</h2>
	<h3>View a profile</h3>
	<p>For viewing the profile of a member click <span class="note">info</span> button located to the right of its name in the user list.</p>
	<h3>Edit your profile</h3>
	<p>To edit your profile go in <span class="note">option panel / my account</span> and fill up your information and select your own avatar. If you dont want to select an avatar you will be attribued the default avatar.</p>
	
	
	<a name="part7"></a>
	<h2>Chat History</h2>
	<h3>Chat history lenght</h3>
	<p>You can change the length of the chat history by going to the <span class="note">settings</span> tab from the option panel. <span class="note">Note that lower history lenght reduce bandwidth and increase performances.</span> </p>
	<h3>History lenght</h3>
	<p>To read the chat history click on the history Boutton at the bottom left of the main window. You can adjust the lenght of this history in the <span class="note">settins</span> tab from the option panel.</p>
	
	
	<a name="part8"></a>
	<h2>Themes</h2>
	<h3>settings your default theme</h3>
	<p>you can set default theme of your choice by going  to  <span class="note">settings</span> tab from the option panel and select default theme from the select menu then click on update settings. <span class="note">By default users cannot toggle theme</span></p>
	<h3>Allow theme toggle</h3>
	<p>You can turn on/off theme toggle in the <span class="note">settings</span> if you turn it on users will be able to switch theme as they wish. <span class="note"> When user switch them that will not affect other users</span></p>
	
	
	<a name="part9"></a>
	<h2>Enable/disable link</h2>
	<h3>Youtube / images</h3>
	<p>BoomChat include a nice feature that let you show images and youtube video by pasting a link to the main chat window. These picture/video will show up as small icon and when a user click on that will automatically open the media.</p>
	<h3>Disable link</h3>
	<p>You can disable linking in your <span class="note">settings</span> tab from the option panel by selecting <span class="note">no</span>. This will have for effect to disable all link and make them not clickable.
	<h3>Enable link</h3>
	<p>To enable link simply go to <span class="note">settings</span> tab from the option panel and set yes. Now link are no longer clickable.
	
	
	<a name="part10"></a>
	<h2>Flood protection</h2>
	<p>Boomchat have an integrated  flood detector. When a user type 5 or more lines within a preset given time the system will automatically mute user for a specific time that you can setup in <span class="note">settings</span> tab from the option panel.
	
	
	<a name="part11"></a>
	<h2>Settings / chat settings panel options</h2>
	<h3>settings panel</h3>
	<table>
		<tr><td class="title">Site title</td><td class="description">Change your site title.</td></tr>
		<tr><td class="title">Registration</td><td class="description">Can be turned <span class="note">on/off</span> this will allow new users to create account or not if disabled.</td></tr>
		<tr><td class="title">Maintenance</td><td class="description">Can be turned <span class="note">on/off</span> this option will let only moderator/admin/superadmin enter the chat other will see a maintenance message.</td></tr>
		<tr><td class="title">Flood mute time</td><td class="description">Allow you to decide for how long a user will be muted after a flood attempt.</td></tr>
		<tr><td class="title">Unmute delay</td><td class="description">Select a <span class="note">specific time or never</span> then the system will auto unmute users that have been muted after they reach the specific time. <span class="note">Note that will not affect flood mute.</span></p></li>
		<tr><td class="title">Database clean</td><td class="description">the system will delete all records that are older than the specified date.<span class="note">Lower that value to keep a clean and fast database responding time</span></td></tr>
		<tr><td class="title">Default theme</td><td class="description">Choose from the select menu the default theme you want for your chat.</td></tr>
		<tr><td class="title">Toggle theme</td><td class="description">Allow user to toggle theme, if turned off user will not be able to toggole theme.</td></tr>
		<tr><td class="title">History lenght</td><td class="description">Set the amount of lines that will be display in the history.</td></tr>
		<tr><td class="title">Chat history lenght</td><td class="description">Set the amount of lines that are display in the main chat window <span class="note">lower number of line increase performances and lower bandwidth.</span></p></li>
		<tr><td class="title">Max message</td><td class="description">Set the maximum message lenght that a user can write by post.</td></tr>
		<tr><td class="title">Max username</td><td class="description">Set the max caracters that you want for new username registration.</td></tr>
		<tr><td class="title">Max avatar</td><td class="description">Set the maximum avatar size allowed for upload.</p></li>
	</table>
	<h3>settings panel</h3>
	<table>
		<tr><td class="title">Allow link</td><td class="description">Can be turned on/off to allow or not clickable link in the chat.</td></tr>
		<tr><td class="title">Away time</td><td class="description">Users will be automatically set to away after the given time.</td></tr>
		<tr><td class="title">Gone time</td><td class="description">Users will be automatically set to offline after the given time.</td></tr>
		<tr><td class="title">Mute</td><td class="description">Mute a user by selecting  username from the select menu. You can only see users in your current room.</p></li>
		<tr><td class="title">Kick</td><td class="description">Kick a user by selecting  username from the select menu. You can only see users in your current room.</td></tr>
		<tr><td class="title">ban</td><td class="description">ban a user by selecting username from the select menu. You can only see user in your current room.</td></tr>
		<tr><td class="title">Word filter</td><td class="description">Add a badword to the filter engine. Word added will show up as **** on the main chat. To remove a badword simply click on the X on specified word box.</p></li>
	</table>
	<a name="part12"></a>
	<h2>Add your own emoticons</h2>
	<p>BoomChat comes with 30 emoticons that we have created for you. You can add your own emoticons simply by putting them in the Emoticon folder. <span class="note">Emoticon need to be in Gif format to work other than that will not show on chat.</span></p>
	<p><span class="note">All emoticon included in this script cannot be used in other product and cannot be sold all rights are reserved to Robert Barnabé.</span></p>
	<a name="part14"></a>
	<h2>Delete a post</h2>
	<p>SuperAdmin and admin can see a little <span class="note">X</span> on side of every post. Clicking the X will remove permanently the line from the database.</p>
	<a name="part13"></a>
	<h2>Hidden options</h2>
	<h3>Clickable name</h3>
	<p>You can click on username in the main chat window that will write it for you in the input field.</p>
	<h3>Clickable commands</h3>
	<p>You can click on commands in the <span class="note">Help</span> tab that will write it for you in the input field.</p>
	<h3>Highlight</h3>
	<p>When someone write your username it will apear yellow highlighted.</p>
	<h3>Bold text</h3>
	<p>You can type bold text using [b]example[/b] tag</p>
	<h3>Underlined text</h3>
	<p>You can underlined text using [u]example[/u] tag</p>
	<h3>Italic text</h3>
	<p>You can write italic text using [i]example[/i] tag</p>
	<a name="part15"></a>
	<h2>Credits</h2>
	<h3>Coding</h3>
	<p>Javascript:<span class="note"> Robert Barnabé - jni_viens</span></p>
	<p>Php:<span class="note"> Robert Barnabé - jni_viens</span></p>
	<p>Css:<span class="note"> Robert Barnabé</span></p>
	<p>Html:<span class="note"> Robert Barnabé</span></p>
	<p>Designer:<span class="note"> Robert Barnabé</span></p>
	<h3>Specials thanks</h3>
	<p>Thank to <span class="note">jni_viens</span> who have solve some php and javascript bug and improved some of the functionality of the script</p>
	<p>Thank to our tester that have use the chat and found bug <span class="note">Komb, Foxgirl, jni_viens, Raoul, DiGG, gareauson</span> and all  others that have participate to the good working of the script</p>
	<a name="part16"></a>
	<h2>Copyright</h2>
	<p>This script cannot be distribued without BoomCoding approbation, This product may be used only once per license. All content of BoomChat is the property of BoomCoding and cannot be copied or redistribued in any way. Graphic, Emoticon are also the
	property of BoomCoding and cannot be used in other product.</p>
	
</body>
</html>