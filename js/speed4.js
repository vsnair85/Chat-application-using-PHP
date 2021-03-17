$(document).ready(function(){

	// reload room data
	topic_reload();
	user_reload();
	statusReload();
	chat_reload();
	adjustHeight();
	reload_data();
	showAds();
	
	
	//determine elapse time between room data refresh
	
	var aReload = setInterval(showAds, 15000);
	var reload_topic = setInterval(topic_reload, 300000);
	var userlist = setInterval(user_reload, 15000);
	var privateLog = setInterval(privateReload, 4000);
	var privateList = setInterval(privateOpen, 5000);
	var reloadStatus = setInterval(statusReload, 60000);
	var chatLog = setInterval(chat_reload, 1500);
	var reloadAds = setInterval(adsMargin, 15000);
	var dataReload = setInterval(reload_data, 5000);
	var friendlis = setInterval(reloadFriends, 30000);
   
   
   
});