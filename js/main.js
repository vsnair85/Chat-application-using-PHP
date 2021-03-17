
$(document).ready(function(){

	$(function() {
		var widthCheck = $(window).width(); 
		if(widthCheck > 1024){
			$("#menu").tooltip();
			$(".top_option").tooltip();
		}
	});
	
	$('#chat_panel').on('mouseover', '.user_option_list li', function(){
		$(this).addClass("hover_element");
	});
	$('#chat_panel').on('mouseout', '.user_option_list li', function(){
		$(this).removeClass("hover_element");
	});
		
	// processing the moderator and admin option from user list ... 
	
	$('#chat_panel').on('click', '.get_kick , .get_ban, .get_mute, .get_unmute, .get_kill, .get_ignore, .get_friends', function(){
		
		var optionTarget = $(this).parent().attr('value');
		var optionEffect = $(this).attr('value');
		
			$.ajax({
				url: "system/option_process.php?target="+ optionTarget +"&option="+ optionEffect,
				cache: false,
				success: function(response)
				{
					if(response == 1){
						$('.option_list').slideUp(100);
						chat_reload();
						user_reload();
					}
					if(response == 103){
						$('.option_list').slideUp(100);
						$('#chat_error').html("<span class=\"error\">"+system.ing1+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
					if(response == 102){
						$('.option_list').slideUp(100);
						$('#chat_error').html("<span class=\"success\">"+system.ing2+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
					if(response == 104){
						$('.option_list').slideUp(100);
						$('#chat_error').html("<span class=\"error\">"+system.friend1+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
					if(response == 105){
						$('.option_list').slideUp(100);
						$('#chat_error').html("<span class=\"success\">"+system.friend2+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
				},
			});		
	});

	$('#chat_panel').on('click', '.get_info, .friend_ginfo', function(){
		
		$('.option_list').slideUp(300);
		var profileTarget = $(this).parent().attr("value");
		var panelTarget = "profile_panel";
		var optionSize = $('#'+panelTarget).css('width');
		
		$('#'+panelTarget).animate({right:"+="+optionSize},200);
	
		$.ajax({
			url: "system/get_profile.php?profile_target="+ profileTarget,
			cache: false,
			success: function(response)
			{
					$("#profile_panel .panel_element").html(response);
			},
		});
		
	});
	
	// accept friend function 
	
	$('#chat_panel').on('click', '.friend_accept', function(){
		var tFriend = $(this).attr("value");
			$.post('system/friend_process.php', {accept: tFriend}, function(response) {	
				if(response == 1){
					reloadFriends();
				}
				else {
					return false;
				}
			});
	});
	
	// friend declined 
	
	$('#chat_panel').on('click', '.friend_decline', function(){
		var tFriend = $(this).attr("value");
		$.post('system/friend_process.php', {decline: tFriend}, function(response) {	
			if(response == 1){
				reloadFriends();
			}
			else {
				return false;
			}
		});
	});
	
	// delete friend from friends list
	
	$(document).on('click', '#chat_panel .delete_friend', function() {
	
		var delete_friend = $(this).parent().attr("value");
		
		$.post('system/remove_friend.php', { delete_friend: delete_friend }, function(response) {
			reloadFriends();
		});		
		return false;
	});

	// display menubar
	$(document).on('click', '.menu_header', function() {
		if ($('.menu_drop:visible').length){
			$(".menu_drop").fadeOut(100);
		}
		else {
			$(".menu_drop").fadeIn(200);
		}
		$("#wrap_options").fadeOut(100);
	});
	
	$(document).on('click', '.other_panels, .addon_button, .head_li, #content', function(){
		$(".menu_drop, #wrap_options").fadeOut(100);
	});
	
	$(document).on('click', '.other_panels, .menu_panels', function(){
		
		var panelTarget = $(this).attr('value');
		var panelSize = $('#'+panelTarget).css('width');
		var panelContent = $(this).attr('id');
		var marginCheck = parseInt($('#'+panelTarget).css('right'));
		
		if(panelTarget == "addon_panel" && marginCheck >= 1){
			$.ajax({
				url: "addons/" + panelContent + "/" + panelContent + ".php",
				cache: false,
				success: function(response){
					$("#addon_panel .panel_element").html(response);
				},
			});
		}
		else if(panelTarget == "addon_panel_full" && marginCheck >= 1){
			$.ajax({
				url: "addons/" + panelContent + "/" + panelContent + ".php",
				cache: false,
				success: function(response){
					$("#addon_panel_full .panel_element").html(response);
				},
			});
		}
		else {
			if (marginCheck >= 1) {
				$('#'+panelTarget).animate({right:"-="+panelSize},200);
			}
			else {
				$( ".top_panels" ).each(function() {
					var marginLook = parseInt($(this).css('right'));
					var otherPanels = $(this).css('width');
					if(marginLook >= 1){
						$(this).animate({right:"-="+otherPanels},200);
					}
				});
				$('#'+panelTarget).animate({right:"+="+panelSize},200);
					if (panelTarget == "history_panel"){
							historyReload();
					}
					if (panelTarget == "image_panel"){
							uploadReload();
					}
					if(panelTarget == "main_option"){
						admin_setting_reload();
					}
					if (panelTarget == "theme_panel"){
						themeReload();	
					}
					if(panelTarget == "tools_panel"){
						showMyprofile();
					}
					if(panelTarget == "addon_panel"){
						$.ajax({
							url: "addons/" + panelContent + "/" + panelContent + ".php",
							cache: false,
							success: function(response){
								$("#addon_panel .panel_element").html(response);
							},
						});
					}
					if(panelTarget == "addon_panel_full"){
						$.ajax({
							url: "addons/" + panelContent + "/" + panelContent + ".php",
							cache: false,
							success: function(response){
								$("#addon_panel_full .panel_element").html(response);
							},
						});
					}
			}
		
		}
		
		
	});
	
	// show and hide panels
	
	$(".addon_button").click(function(){
	
		var panelTarget = $(this).attr('value');
		var optionSize = $('#'+panelTarget).css('width');
		var marginCheck = parseInt($('#'+panelTarget).css('right'));
		
		if (marginCheck >= 1) {
			if(panelTarget == "chat_panel"){
				if ($('#chat_panel:visible').length && $('#private_count:visible').length){
					dataControl = "4";
					privateOpen();
				}
				else {
					dataControl = "1";
					user_reload();	
				}
			}
			else {
				$('#'+panelTarget).animate({right:"-="+optionSize},200);
			}
		}
		else {
			$( ".panels" ).each(function() {
				var marginLook = parseInt($(this).css('right'));
				var otherPanels = $(this).css('width');
				if(marginLook >= 1){
					$(this).animate({right:"-="+otherPanels},200);
				}
			});
			$('#'+panelTarget).animate({right:"+="+optionSize},200);
			
			if (panelTarget == "chat_panel"){
				if ($('#private_count:visible').length){
					dataControl = "4";
					privateOpen();
				}
				else {
					dataControl = "1";
					user_reload();	
				}
			}
		}
		
	});
	
	// close options panels ...
	
	$(".close_panel").click(function(){
	
		var panelTarget = $(this).attr('value');
		var optionSize = $('#'+panelTarget).css('width');
		var marginCheck = parseInt($('#'+panelTarget).css('right'));
		
		if (marginCheck >= 1) {
			$('#'+panelTarget).animate({right:"-="+optionSize},200);
			
			if (panelTarget == "chat_panel"){
				dataControl = "0";	
			}
			if(panelTarget == "profile_panel"){
				$("#profile_panel .panel_element").html("");
			}
			if(panelTarget == "history_panel"){
				$("#history_container").html("");
			}
		}
		
	});
	
	// close private window 
	
	$(".close_private").click(function(){
		var panelTarget = $(this).attr('value');
		$('#'+panelTarget).fadeOut(200);
		privateControl = "0";
		
	});
	
	$("#image_panel").on('click', '.remove_image', function() {
		var imgTarget = $(this).attr('value');
			$.post('system/image_delete.php', {del_image: imgTarget}, function(response) {	
				if(response == 1){
					uploadReload();
				}
			});
	});
	
	$("#chat_panel").on('click', '.clear_private', function() {
		var Target = $(this).attr('value');
			$.post('system/private_clear.php', {target: Target}, function(response) {	
				if(response == 1){
					privateOpen();
				}
			});
	});
	
	// log out user from the chat on click
	
	$(".logout_button").click(function(){
		showLogout();
		$(".menu_drop").fadeOut(100);
	});
	
	$(".close_logout, #cancel_logout").click(function(){
		$("#logout_box").fadeOut(300);
	});
	
	$("#confirm_logout").click(function(){
		logOut();
	});
	
	$("#chat_room").click(function(){
		dataControl = "2";
		showRooms();
	});
	$("#chat_user").click(function(){
		dataControl = "1";
		user_reload();
	});
	$("#chat_friends").click(function(){
		dataControl = "5";
		rFriend = 1;
		reloadFriends();
	});
	$("#chat_private").click(function(){
		dataControl = "4";
		privateOpen();
	});
	$("#chat_ignore").click(function(){
		dataControl = "6";
		showIgnore();
	});
	$("#my_history").click(function(){
		userHistory();
	});
	$("#chat_history").click(function(){
		historyReload();
	});
	
	// update user information when clicking on update account button 
	
	$('#tools_panel').on('click', '#account_button', function() {
		var set_age = $( "#select_age option:selected" ).val();
		var set_gender = $( "#select_gender option:selected" ).val();
		var set_description = $( "#my_description" ).val();
		var set_sound = $( "#select_sound option:selected" ).val();
		var set_country = $( "#select_country option:selected" ).val();
		var set_region = $( "#select_region option:selected" ).val();
		var myEmail = $( "#my_email" ).val();
		if($("#custom1").val()){
			var custom1 = $("#custom1").val();
		}
		else {
			var custom1 = "clear";
		}
		if($("#custom2").val()){
			var custom2 = $("#custom2").val();
		}
		else {
			var custom2 = "clear";
		}
		$.post('system/account_data.php', {
		
		set_age: set_age,
		set_gender: set_gender,
		set_description: set_description,
		set_sound: set_sound,
		set_country: set_country,
		set_region: set_region,
		set_email: myEmail,
		custom1: custom1,
		custom2: custom2
		
		}, function(response) {
			if(response == 1){
				$("#account_button").html("<span class=\"success\">"+system.updateSuccess+"</span>").delay(3000).queue(function(n) {$(this).html(system.updateInfo);
					n();
				});
			}
			else {
				$("#account_button").html("<span class=\"error_message\">"+system.errorOccur+"</span>").delay(3000).queue(function(n) {$(this).html(system.updateInfo);
					n();
				});				
			}
		});
		return false;
		
	});
	
	// change user password 

	$('#tools_panel').on('click', '#update_password', function() {
		var old_password = $( "#old_password" ).val();
		var new_password = $( "#new_password" ).val();
		var confirm_password = $( "#confirm_password" ).val();
		$.post('pass_change.php', {
		
		old_password: old_password,
		new_password: new_password,
		confirm_password: confirm_password
		
		}, function(response) {
			if(response == 6){
				$( "#new_password" ).val("");
				$( "#confirm_password" ).val("");
				$('#error_info3').html("<span class=\"error\">"+system.pass5+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
			}
			else if (response == 5){
				$( "#old_password" ).val("");
				$( "#confirm_password" ).val("");
				$( "#new_password" ).val("");
				$('#error_info3').html("<span class=\"error\">"+system.errorOccur+"</span>").hide().fadeIn(300).delay(7000).fadeOut();			
			}
			else if (response == 4){
				$( "#new_password" ).val("");
				$( "#confirm_password" ).val("");
				$('#error_info3').html("<span class=\"error\">"+system.pass4+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
			}
			else if (response == 3){
				$('#error_info3').html("<span class=\"error\">"+system.pass3+"</span>").hide().fadeIn(300).delay(7000).fadeOut();
			}
			else if (response == 2){
				$( "#old_password" ).val("");
				$('#error_info3').html("<span class=\"error\">"+system.pass3+"</span>").hide().fadeIn(300).delay(7000).fadeOut();			
			}
			else if (response == 1){
				$( "#confirm_password" ).val("");
				$( "#old_password" ).val("");
				$( "#new_password" ).val("");
				$('#error_info3').html("<span class=\"success\">"+system.updateSuccess+"</span>").hide().fadeIn(300).delay(7000).fadeOut();			
			}
			else {
				return false;
			}
		});
		return false;
		
	});
	

	
	// updating user_name 
	
	$('#tools_panel').on('click', '#update_name', function() {
		var new_name = $( "#new_name" ).val();
		var ucomplete = $("#upname_value").attr("value");
		
		
		if(new_name == ''){
			return false;
		}
		else if (/^\s+$/.test($('#new_name').val())){
			$('#new_name').val("");
			return false;
		}
		else{
			$.post('name_change.php', {
			
			new_name: new_name,
			
			}, function(response) {
				if(response == 1){
					$( "#new_name" ).val("");
					$('#error_info').html("<span class=\"error\">"+system.errorOccur+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
				}
				if(response == 2){
					$( "#new_name" ).val("");
					$('#error_info').html("<span class=\"error\">"+system.log5+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
				}
				if(response == 3){
					$( "#new_name" ).val("");
					$('#error_info').html("<span class=\"error\">"+system.log4+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
				}
				else if (response == 4){
					var newHname= $("#new_name").val();
					$("#new_name").attr("placeholder", newHname);
					$( "#new_name" ).val("");
					$('#error_info').html("<span class=\"success\">"+system.updateSuccess+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
				}
				else {
					return false;
				}
			});
			return false;
		}
	});
	
	
	// change email
	
	
	$('#tools_panel').on('click', '#update_email', function() {
		var new_email = $( "#new_email" ).val();
		
		if(new_email == ''){
			return false;
		}
		else if (/^\s+$/.test($('#new_email').val())){
			$('#new_email').val("");
			return false;
		}
		else{
			$.post('system/email_change.php', {
			
			new_email: new_email,
			
			}, function(response) {
				if(response == 1){
					$( "#new_email" ).val("");
					$('#error_info2').html("<span class=\"error\">"+system.log6+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
				}
				else if (response == 2){
					var newHold = $("#new_email").val();
					$("#new_email").attr("placeholder", newHold);
					$("#new_email").val("");					
					$('#error_info2').html("<span class=\"success\">"+system.updateSuccess+"</span>").hide().fadeIn(300).delay(7000).fadeOut();		
				}
				else {
					return false;
				}
			});
			return false;
		}
	});
	
	
	// update media social link
	var wChange = 0;
	$('#tools_panel').on('click', '#update_social', function() {
		
		if(wChange < (Math.floor(Date.now() / 1000) - 7)){
			wChange = Math.floor(Date.now() / 1000);
			
			var set_facebook = $( "#bc_facebook" ).val();
			var set_twitter = $( "#bc_twitter" ).val();
			var set_pinterest = $( "#bc_pinterest" ).val();
			var set_google = $( "#bc_google" ).val();
			var set_youtube = $( "#bc_youtube" ).val();
			var set_instagram = $( "#bc_instagram" ).val();
			var set_linkedin = $( "#bc_linked_in" ).val();
			var set_tumblr = $( "#bc_tumblr" ).val();
			var set_flickr = $( "#bc_flickr" ).val();
			
			set_facebook = set_facebook.trim();
			set_twitter = set_twitter.trim();
			set_pinterest = set_pinterest.trim();
			set_google = set_google.trim();
			set_youtube = set_youtube.trim();
			set_instagram = set_instagram.trim();
			set_linkedin = set_linkedin.trim();
			set_tumblr = set_tumblr.trim();
			set_flickr = set_flickr.trim();
			

			$.post('system/social_manager.php', {
			
			set_facebook: set_facebook,
			set_twitter: set_twitter,
			set_pinterest: set_pinterest,
			set_google: set_google,
			set_youtube: set_youtube,
			set_instagram: set_instagram,
			set_linkedin: set_linkedin,
			set_tumblr: set_tumblr,
			set_flickr: set_flickr
			
			}, function(response) {
					if(response == 1){
						$("#social_error").html("<span class=\"success\">"+system.updateSuccess+"</span>").delay(9000).queue(function(n) {$(this).html("");
							n();
						});
					}
					else if (response == 2){
						$("#social_error").html("<span class=\"error\">"+system3.errorSocial+"</span>").delay(9000).queue(function(n) {$(this).html("");
							n();
						});
					}
			});
			return false;
		}
		else {
			return false;
		}
	});
	
	// allow to change the chat theme 
	$('#theme_panel').on('click', '.panel_element .theme_button', function() {
		var theme = $(this).attr('value');
			$.post('system/theme_manager.php', {theme: theme}, function(response) {
				themeReload();
				location.reload();
			});
		return false;
	});
	
	
	// bring the user in selected room and update userlist, chat log
	$(document).on('click', '#chat_panel .roombutton', function() {
		var target = $(this).attr('id');
		var roomtarget = $(this).attr('value');
		$('.roombutton').removeClass('hoverroom');
		$(this).addClass('hoverroom');
		
		$.post('system/room_target.php', { room_target: target }, function(response) {
			if (response == 1){
				$('#chat_error').html("<span class=\"error\">"+system.inRoom+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#this_target').attr('value', 'none');
				$('#main_chat_type').attr('value', '1');
				$('.private_friend .span_private_target').text('none');
				$('#room_topic').removeClass('hide_this');
				$('#menu_private').hide();
				adjustTopic();
				acSd = 0;
				return false;
			}
			if(response == 2){
				$('#chat_error').html("<span class=\"error\">"+system.roomLock+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				return false;
			}
			else {
				clogs = 0;
				chr = 1;
				$('#this_target').attr('value', 'none');
				$('#main_chat_type').attr('value', '1');
				$('.private_friend .span_private_target').text('none');
				$('#room_topic').removeClass('hide_this');
				$('#menu_private').hide();
				adjustTopic();
				dataControl = 1;
				$('#user_room').val(roomtarget);
				$('#content').focus();
				$("#show_chat ul").html("");
				user_room = roomtarget;
				chat_reload();
				topic_reload();
				user_reload();
				checkScroll = 0;
				scrollCompare = 0;
				acSd = 0;
			}
		});
		return false;
	});
		
	// delete a specific log in the chat
	
	$(document).on('click', '#show_chat .delete_log', function() {
		var del_post = $(this).attr('value');
			$.post('system/delete_post.php', {del_post: del_post}, function(response) {	
				chat_reload();		
			});
	});
	
	// ignored from ignore list
	
	$(document).on('click', '#chat_panel .delete_ignore button', function() {
	
		var delete_ignore = $(this).val();
		
		$.post('system/remove_ignore.php', { delete_ignore: delete_ignore }, function(response) {
			showIgnore();
		});		
		return false;
	});
	
	// profile switcher panel
	
	$("#tools_panel").on('click', '.profile_button', function() {
		var vSection = $(this).attr('value');
		$( ".profile_zone" ).each(function() {
			$(this).hide();
		});
		$( ".profile_button" ).each(function() {
			$(this).removeClass('selected_element');
		});
		$('#'+vSection).show();
		$(this).addClass('selected_element');
	});
	
	
	// upload avatar to server
		$('#myForm').ajaxForm(function(response) {
			if(response == 1){
				$('.panel_error p').text(system.upload1).show();
			}
			else if(response == 2){
				$('.panel_error p').text(system.upload2).show();

			}
			else if(response == 3){
				$('.panel_error p').text(system.upload1).show();

			}
			else if(response == 4){
				$('.panel_error p').text(system.upload3).show();

			}
			else if(response > 5){
				$('.panel_error p').text(system.upload4+" "+response+' kb').show();

			}
			else if (response == 5){
					reload_avatar();
			}
			else{
				return false;
			}
		});	
		
		// change regions list when changing country in profile panel
		
		$(document).on('change', '#select_country', function() {
			var CountryTarget = $(this).val();
				$.post('system/load_region.php', {country: CountryTarget}, function(response) {	
						if(response != 0){
							$("#select_region").html(response);
						}
						else {
							$("#select_region").html("");
						}
				});
		});
		
		// friend list button action 
		
	// show options section in admin panel
	
	$("#chat_panel").on('click', '.friend_button', function() {
		var viewOptions = $(this).attr('value');
		if(viewOptions == 'pending_friend'){
			$('.friend_span').hide();
			rFriend = 2;
		}
		if(viewOptions == 'active_friend') {
			rFriend = 1;
		}
		$( ".friend_button" ).each(function() {
			$(this).removeClass('selected_element');
		});
		$(this).addClass('selected_element');
		reloadFriends();
	});
	
	$( window ).resize(function() {
		panelMargin();
		adsMargin();
		adjustHeight();
		checkScroll = 0;
		scrollCompare = 0;
		$("#picker_box").hide();
	});
	
});

function openUsermanual(){
	window.open("documentation/manual.php","_blank","toolbar=no, scrollbars=yes, resizable=no, top=100, left=100, width=800, height=600");
};