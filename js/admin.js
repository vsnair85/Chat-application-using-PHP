$(document).ready(function(){

	$("#ad_setting").click(function(){
		admin_setting_reload();
	});
	$("#ad_room").click(function(){
		admin_room_reload();
	});
	$("#ad_user").click(function(){
		admin_user_reload();
	});
	$("#ad_word").click(function(){
		wordFilter();
	});
	$("#search_user").click(function(){
		searchUser();
	});

	// add a new room to room list
	$('#main_option').on('click', '#add_room_button', function(){
		
		var name = $('#add_room_name').val();
		var type = $('#room_access option:selected').attr('value');
		
		$.post('system/data_process.php', { name: name, type: type}, function(response) {
			
			if (response == 1){
				$('#room_error p').text(system.errorRoomexist);
			}
			else if (response == 2){
				$('#room_error p').text(system.errorName);
			}
			else {
				$('#add_room_name').val('');
				admin_room_reload();
			}
		});
	});
	
	// updating the setting in database when super admin
	
	$(document).on('click', '#main_option #setting_button', function() {
		
		var site_title = $('#my_title').val();
		var site_domain = $('#my_domain').val();
		var set_registration = $( "#set_registration option:selected" ).val();
		var set_maintenance = $( "#set_maintenance option:selected" ).val();
		var set_flood = $( "#set_flood option:selected" ).val();
		var set_unmute = $( "#set_unmute option:selected" ).val();
		var set_default_theme = $( "#set_default_theme option:selected" ).val();
		var set_allow_theme = $( "#set_allow_theme option:selected" ).val();
		var set_chat_history = $( "#set_chat_history option:selected" ).val();
		var set_log_history = $( "#set_history option:selected" ).val();
		var set_data_delete = $( "#set_data_delete option:selected" ).val();
		var set_max_avatar = $( "#set_max_avatar option:selected" ).val();
		var set_max_message = $( "#set_max_message option:selected" ).val();
		var set_max_username = $( "#set_max_username option:selected" ).val();
		var set_max_hosting = $( "#set_max_host option:selected" ).val();
		var set_allow_link = $( "#set_allow_link option:selected" ).val();
		var set_away = $( "#set_away option:selected" ).val();
		var set_gone = $( "#set_gone option:selected" ).val();
		var set_emoticon = $( "#set_emoticon option:selected" ).val();
		var set_private = $( "#set_private option:selected" ).val();
		var set_upload = $( "#set_upload option:selected" ).val();
		var set_allow_history = $( "#set_allow_history option:selected" ).val();
		var set_max_weight = $( "#set_max_weight option:selected" ).val();
		var set_ads = $( "#set_ads option:selected" ).val();
		var set_ads_delay = $( "#set_adsdelay option:selected" ).val();
		var set_ads_count = $( "#set_adscount option:selected" ).val();
		var orientation = $( "#set_orientation option:selected" ).val();
		var welcome = $( "#set_welcome option:selected" ).val();
		var guestOk = $( "#set_guest option:selected" ).val();
		var guestChat = $( "#set_guest_chat option:selected" ).val();
		var guestClear = $( "#set_guest_clear option:selected" ).val();
		var validation = $( "#set_validation option:selected" ).val();
		var set_cookie = $( "#set_cookie option:selected" ).val();
		var set_repeat = $( "#set_email_repeat option:selected" ).val();
		var set_speed = $( "#set_speed option:selected" ).val();
		var set_language = $( "#set_language option:selected" ).val();
		var set_show_topic = $( "#set_show_topic option:selected" ).val();
		var set_private_style = $( "#set_private_style option:selected" ).val();
		var set_timezone = $( "#set_timezone option:selected" ).val();
		var set_reg_full = $( "#set_reg_full option:selected" ).val();
		var set_use_avatar = $( "#set_use_avatar option:selected" ).val();
		var set_fwidth = $( "#set_fwidth" ).val();
		var set_wnews = $( "#set_welcome_news" ).val();
		var set_news_title = $( "#set_news_title" ).val();
		var set_wmessage = $( "#set_welcome_msg" ).val();
		var set_rules = $( "#set_rules" ).val();
		var set_age = $( "#set_min_age" ).val();
		var set_logs = $( "#set_msglog" ).val();
		var set_psound = $( "#set_psound" ).val();
		var set_rtl = $( "#set_rtl" ).val();
		var set_colors = $( "#set_allow_color" ).val();
		var set_avatar = $( "#set_allow_avatar" ).val();
		var set_allow_friend = $( "#set_allow_friend" ).val();
		var set_allow_ignore = $( "#set_allow_ignore" ).val();
		var set_custom_count = $( "#set_custom_count option:selected" ).val();
		var set_custom1 = $( "#set_custom1" ).val();
		var set_custom2 = $( "#set_custom2" ).val();
		var set_allow_username = $( "#set_allow_username option:selected" ).val();
		var set_use_player = $( "#set_use_player option:selected" ).val();
		var set_player_url = $( "#set_player_url" ).val();
		var set_player_status = $( "#set_player_status option:selected" ).val();
		var set_fblogin = $( "#set_fblogin option:selected" ).val();
		var set_fbapi = $( "#set_fbapi" ).val();
		var set_fbsecret = $( "#set_fbsecret" ).val();
		var set_del_file = $( "#set_del_file option:selected" ).val();
		var set_bridge = $( "#set_bridge option:selected" ).val();
		var set_uhome = $( "#set_uhome option:selected" ).val();
		var set_home = $( "#set_home" ).val();
		
		$.post('system/setting_process.php', { 
			site_title: site_title,
			site_domain: site_domain,
			set_registration: set_registration,
			set_maintenance: set_maintenance,
			set_flood: set_flood,
			set_unmute: set_unmute,
			set_default_theme: set_default_theme,
			set_allow_theme: set_allow_theme,
			set_chat_history: set_chat_history,
			set_log_history: set_log_history,
			set_data_delete: set_data_delete,
			set_max_message: set_max_message,
			set_max_avatar: set_max_avatar,
			set_allow_link: set_allow_link,
			set_away: set_away,
			set_gone: set_gone,
			set_max_hosting: set_max_hosting,
			set_emoticon: set_emoticon,
			set_allow_history: set_allow_history,
			set_private: set_private,
			set_upload: set_upload,
			set_max_weight: set_max_weight,
			set_max_username: set_max_username,
			set_ads: set_ads,
			set_adsdelay: set_ads_delay,
			set_orientation: orientation,
			set_adscount: set_ads_count,
			set_guest: guestOk,
			set_guest_chat: guestChat,
			set_guest_clear: guestClear,
			set_validation: validation,
			set_cookie: set_cookie,
			set_email_repeat: set_repeat,
			set_speed: set_speed,
			set_language: set_language,
			set_show_topic: set_show_topic,
			set_private_style: set_private_style,
			set_timezone: set_timezone,
			set_reg_full: set_reg_full,
			set_use_avatar: set_use_avatar,
			set_fwidth: set_fwidth,
			set_wmsg: set_wmessage,
			set_ntitle: set_news_title,
			set_news: set_wnews,
			set_rules: set_rules,
			set_age: set_age,
			set_logs: set_logs,
			set_psound: set_psound,
			set_rtl: set_rtl,
			set_welcome: welcome,
			set_avatar: set_avatar,
			set_allow_friend: set_allow_friend,
			set_allow_ignore: set_allow_ignore,
			set_colors: set_colors,
			set_custom_count: set_custom_count,
			set_custom1: set_custom1,
			set_custom2: set_custom2,
			set_allow_username: set_allow_username,
			set_use_player: set_use_player,
			set_player_url: set_player_url,
			set_fblogin: set_fblogin,
			set_fbapi: set_fbapi,
			set_fbsecret: set_fbsecret,
			set_player_status: set_player_status,
			set_del_file: set_del_file,
			set_bridge: set_bridge,
			set_uhome: set_uhome,
			set_home: set_home
			
			}, function(response) {
				if(response == 2){
					return false;
				}
				else if (response == 3){
					location.reload();
				}
				else {
					$("#main_option #setting_button").html("<span class=\"success\">"+system.updateSuccess+"</span>").delay(3000).queue(function(n) {$(this).html(system.updateButton);
						n();
					});
				}
		});
		
		return false;
		
	});
	
	// delete a room from room list
	$(document).on('click', '#main_option .delete_room button', function() {

		var delete_room = $(this).val();
		$.post('system/data_process.php', { delete_room: delete_room }, function(response) {
			
			if (response == 1){
				$('#room_error p').text(system.errorMain);
			}
			else {
			admin_room_reload();
			showRooms();
			}
		});
		return false;
		
	});
	
	// delete admin from panel list
	$(document).on('click', '#main_option .delete_admin button', function() {
	
		var delete_admin = $(this).val();
		
		$.post('system/admin_user_process.php', { delete_admin: delete_admin }, function(response) {
			admin_user_reload();
			
		});		
		return false;
	});
	
	// delete banned from panel list
	$(document).on('click', '#main_option .delete_banned button', function() {
	
		var delete_banned = $(this).val();
		
		$.post('system/admin_user_process.php', { delete_banned: delete_banned }, function(response) {
			admin_user_reload();	
		});		
		return false;
	});	
	
	// delete modo from panel list
	$(document).on('click', '#main_option .delete_modo button', function() {
	
		var delete_modo = $(this).val();
		
		$.post('system/admin_user_process.php', { delete_modo: delete_modo }, function(response) {
			admin_user_reload();
			
		});		
		return false;
	});	
	
	// delete muted from panel list
	$(document).on('click', '#main_option .delete_muted button', function() {
	
		var delete_muted = $(this).val();
		
		$.post('system/admin_user_process.php', { delete_muted: delete_muted }, function(response) {
			admin_user_reload();
			
		});		
		return false;
	});
	
	// delete vip from panel list
	$(document).on('click', '#main_option .delete_vip button', function() {
	
		var delete_vip = $(this).val();
		
		$.post('system/admin_user_process.php', { delete_vip: delete_vip }, function(response) {
			admin_user_reload();
			
		});		
		return false;
	});
	
	// add word to filter list 
	
	$("#main_option").on('click', '#add_filter #add_word', function() {
	
		var word = $('#bad_word').val();
		if(word != ''){
			$.post('system/word_process.php', { word: word }, function() {
				wordFilter();
			});
		}
		return false;
	});
	
	// delete word from filter list
	$("#main_option").on('click', '#filter_list .delete_word button', function() {
	
		var del_word = $(this).val();
			$.post('system/word_process.php', { delete_word: del_word }, function() {
				wordFilter();
			});
		return false;
	});
	
	// get user information 
	$('#search_user_info').change(function(){
		var info_user = $("#search_user_info option:selected").val();
			$.post('system/user_info_process.php', {info_user: info_user}, function(html) {
				$('#search_details').html(html);
			});
		return false;
	});
	

	// show options section in admin panel
	
	$("#main_option").on('click', '.setting_option_button', function() {
		var viewOptions = $(this).attr('value');
		if(viewOptions == 'setting_update'){
			$('#setting_button').hide();
		}
		else {
			$('#setting_button').show();
		}
		$( ".setting_part" ).each(function() {
			$(this).hide();
		});
		$( ".setting_option_button" ).each(function() {
			$(this).removeClass('selected_element');
		});
		$('#'+viewOptions).show();
		$(this).addClass('selected_element');
	});
	
	
	// show room by access
	
	$("#main_option").on('click', '.room_select_button', function() {
		var viewRooms = $(this).attr('value');
		$( ".all_room" ).each(function() {
			$(this).hide();
		});
		$( ".room_select_button" ).each(function() {
			$(this).removeClass('selected_element');
		});
		$('.'+viewRooms).show();
		$(this).addClass('selected_element');
	});
	
	// show users in admin panel by selected rank
	
	$("#main_option").on('click', '.view_user_button', function() {
		var viewUsers = $(this).attr('value');
		$( ".user_quart" ).each(function() {
			$(this).hide();
		});
		$( ".view_user_button" ).each(function() {
			$(this).removeClass('selected_element');
		});
		$('.'+viewUsers).show();
		$(this).addClass('selected_element');
	});
			
	//Auto muted processor
	imgClean = function()
	{
		clearInterval(clearingImg);
		$.ajax({
			url: "system/img_clean.php",
			cache: false,
			success: function(response){},
		});
	}				
	
   var database_clean = setInterval(clean_database, 600000);
   var clearing_mute = setInterval(mute_process, 120000);
   var clearingImg = setInterval(imgClean, 60000);
   
});