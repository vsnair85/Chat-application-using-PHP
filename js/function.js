	
	var audioElement2 = document.createElement('audio');
	audioElement2.setAttribute('src', 'sounds/username.mp3');
	audioElement2.setAttribute('stop', 'stop');
	
	var dataControl = "";
	var privateControl = "0";
	var firstLoad = "1";
	var rFriend = 1;
	$('#content').val('').focus();
	
	var width = $(window).width(); 
	var height = $(window).height();
	var optionSize = $('#chat_panel').css('width');
	
	// reload the user list in room 
	
	user_reload = function()
	{
		if(firstLoad == 1 && width > 1024){
			$('#chat_panel').animate({right:"+="+optionSize},400);
			dataControl = "1";
			$.ajax({
				url: "system/user_list.php",
				cache: false,
				success: function(html){
					$("#chat_panel .panel_element").html(html);
				},
			});	
			firstLoad = "0";
		}
		else if (dataControl != 1){
			return false;
		}
		else if ($('.option_list:visible').length){
			return false;
		}
			$.ajax({
				url: "system/user_list.php",
				cache: false,
				success: function(html){
					$("#chat_panel .panel_element").html(html);
				},
			});
	}
	
	// logout from chat
	
	logOut = function(){
		$.ajax({
			url: "logout.php",
			cache: false,
			success: function(response){
				location.reload();
			},
		});
	}
	
	// unlog users on multiple device connection
	
	overWrite = function(){
		$.ajax({
			url: "overwrite.php",
			cache: false,
			success: function(response){
				location.reload();
			},
		});
	}
	
	// reload user status on chat 
	
	statusReload = function(){
		$.ajax({
			url: "system/user_status.php",
			cache: false,
			success: function(response){
			},
		});
	}
	
	
	// reload the chat history ...
	
	historyReload = function(){
		$.ajax({
			url: "system/history.php",
			cache: false,
			success: function(response){
				$("#history_panel .panel_element #history_container").html(response);
			},
		});
	}
	
	// open new private on click 
	
	privateOpen = function(){
		if (dataControl != 4){
			return false;
		}
		$.ajax({
			url: "system/private_notify.php",
			cache: false,
			success: function(response){
				$("#chat_panel .panel_element").html(response);
			},
		});
	}
	
	// reload user highlight history 
	
	userHistory = function(){
		var thisHistory = $("#search_history").val();
		if(thisHistory == ''){
			return false;
		}
		else if (/^\s+$/.test($('#search_history').val())){
			return false;
		}
		else {
			$.ajax({
				url: "system/user_history.php?data="+thisHistory,
				cache: false,
				success: function(response){
					$("#history_panel .panel_element #history_container").html(response);
					$("#search_history").val("");
				},
			});
		}
	}
	
	// Reload room and adjust arrow
	
	showRooms = function(){
		if (dataControl != 2){
			return false;
		}
		$.ajax({
			url: "system/room_list.php",
			cache: false,
			success: function(html){
				$("#chat_panel .panel_element").html(html);
			},
		});
	}
	
	searchUser = function(){
		$.ajax({
			url: "system/search_user.php",
			cache: false,
			success: function(html){
				$("#main_option .panel_element").html(html);
			},
		});
	}
	
	showIgnore = function(){
		$.ajax({
			url: "system/ignore_list.php",
			cache: false,
			success: function(html){
				$("#chat_panel .panel_element").html(html);
			},
		});
	}
	
	showMyprofile = function(){
		$.ajax({
			url: "system/my_profile.php",
			cache: false,
			success: function(html){
				$("#tools_panel #pro_details").html(html);
			},
		});
	}
	
	// Reload ignore list
	
	reloadFriends = function(){
		if(dataControl != 5){
			return false;
		}
		if(rFriend == 1){
			$.ajax({
				url: "system/friend_list.php",
				cache: false,
				success: function(html){
					$("#chat_panel .panel_element").html(html);
				},
			});
		}
		else if (rFriend == 2){
			$.ajax({
				url: "system/pending_friend.php",
				cache: false,
				success: function(html){
					$("#chat_panel #friend_container").html(html);
				},
			});
		}
		else {
			return false;
		}
	}
	
	//reload the topic for room
	
	topic_reload = function()
	{
		if(showTopic == 1 && $('#room_topic:visible').length){
			$.ajax({
				url: "system/topic.php",
				cache: false,
				success: function(html){
					$("#room_topic").html(html);
					adjustTopic();
				},
			});
		}
		else {
			return false;
		}
	}
	
	// private reload
	
	var privScroll = 0;
	var privCompare = 0;
	
	privateReload = function()
	{
		if(privateStyle == 1){
		
			if(privScroll !== 0){
				privCompare = $('#private_chat ul').scrollTop() + 100;
			}
			
			
			if(privCompare >= privScroll){
			
				if (privateControl != 1){
					return false;
				}
				var target = $('#private_content').attr('name');
				$.ajax({
					url: "system/private_log2.php?target="+ target,
					cache: false,
					success: function(response)
					{
						$("#show_private").html(response);
						$("#private_chat ul").scrollTop($("#private_chat ul")[0].scrollHeight);
						privScroll = $('#private_chat ul').scrollTop();
					},
				});
			
			
			}
			else {
				return false;
			}
			
			
			
			
		}
		else {
			return false;
		}
	}
	privateReload2 = function()
	{
		if(privateStyle == 2){
			chat_reload();
		}
		else {
			return false;
		}
	}
	// readjust the chat box height depending on topic height 
	
	adjustTopic = function()
	{
		adjustHeight();
	}
	
	// reload theme in theme panel 
	
	themeReload = function()
	{
		$.ajax({
			url: "system/theme.php",
			cache: false,
			success: function(html){
				$("#theme_panel .panel_element").html(html);
			},
		});
	}
	
	// reload chat log in room	
	
	var nPost = document.createElement('audio');
	nPost.setAttribute('src', 'sounds/newpost.mp3');
	nPost.setAttribute('stop', 'stop');
	
	var sss = 0;
	
	chat_reload = function()
	{
			var checkType = $('#main_chat_type').attr('value');
			var loadTarget = $('#this_target').attr('value');
			
			if(checkType == '1'){
				postTo = 'chat_log';
			}
			else if (checkType == '2'){
				postTo = 'chat_log_private';
			}
			else {
				return false;
			}
			if(checkScroll !== 0){
				scrollCompare = $('#show_chat ul').scrollTop() + 200;
			}
			if(scrollCompare >= checkScroll){
			$.ajax({
				url: "system/"+ postTo + ".php?rank="+ user_rank + "&access="+ user_access+"&room="+ user_room+"&bottom="+ boxZone+"&target="+loadTarget+"&rlc="+rlc+"&clogs="+clogs+"&chr="+chr+"&count="+cnt,
				cache: false,
				dataType: 'json',
				success: function(response)
				{
					var log1 = response.log1;
					var log2 = response.log2;
					var log3 = response.log3;
					var log4 = response.log4;
					var log5 = response.log5;
					var log6 = response.log6;
					var log7 = response.log7;
					
					if(clogs !== log2){
						sss = 1;
					}
					else {
						sss = 0;
					}
					
					rlc = log5;
					clogs = log2;
					chr = log3;
					cnt = log7;
					
					if (log1 == 1){
						location.reload();
					}
					else if (log1 == 2){
						user_room = 1;
						$('#user_room').val(user_room);
						checkScroll = 0;
						scrollCompare = 0;
					}
					else if (log1 == 4){
						location.reload();
					}
					else if (log1 == 1000){
						location.reload();
					}
					else if (log1 == 99){
							if(boxZone == 2){
								if(scrollStart == 0){
									$("#show_chat ul").scrollTop($("#show_chat ul")[0].scrollHeight);
									checkScroll = $('#show_chat ul').scrollTop();
								}
								else {
									$("#show_chat ul").scrollTop($("#show_chat ul")[0].scrollHeight);
								}
							}
					}
					else {
						$("#show_chat ul").html(log1);
							if(boxZone == 2){
								if(scrollStart == 0){
									$("#show_chat ul").scrollTop($("#show_chat ul")[0].scrollHeight);
									checkScroll = $('#show_chat ul').scrollTop();
								}
								else {
									$("#show_chat ul").scrollTop($("#show_chat ul")[0].scrollHeight);
								}
							}
							if( chr > 2 && fSd == 1 && uSd > 1 && log1.indexOf("zzzTTmmm") < 1 && log6 == 1 && sss == 1){
								nPost.play();
							}
							if (log4 > 0 && fSd == 1){
								audioElement2.play();
							}
					}	
				},
			});
			}
			else {
				return false;
			}
	}
	
	// reload avatar after upload 
	
	reload_avatar = function()
	{
		$.ajax({
			url: "system/avatar.php",
			cache: false,
			success: function(html){
				$('#tools_panel #avatar').html(html);	
			},
		});
	}
	
	// reload uploaded file list after uploading a file
	
	uploadReload = function()
	{
		$.ajax({
			url: "system/show_upload.php",
			cache: false,
			success: function(response){
				$('#image_panel #upload_bottom').html(response);
			},
		});
	}
	
	adjustFull = function()
	{
		var newWidth = $(window).width();
		var panelWidth = $('#chat_panel').width();
		var newChat = newWidth - panelWidth - 36;
		if(newWidth > 1024){
			$('#container_chat').css({
			"width": newChat,
			"float": "left",
			"margin-left": "10px",
			});
			$('#menu_container_inside, #inner_header').css({
			"width": newChat + 20,
			"float": "left",
			"margin-left": "10px",
			});
			$('#menu_container_inside').css({
			"padding-left": "0px",
			"padding-right": "0px",
			});
			$('#container_chat').css({
			"padding": "8px",
			});
		}
		else {
			$('#container_chat, #menu_container_inside').css({
			"width": "98%",
			"margin": "0 auto",
			"padding-left": "1%",
			"padding-right": "1%"
			});	
			$('#inner_header').css({
				"width": "95%",
				"margin-left": "10px",
			});
		}
	}

	// readjust height of chat after screen resize 
	adjustHeight = function()
	{
			var newHeight = $(window).height();
			var footerHeight = $('#wrap_footer').height();
			var topChat = $('#top_chat_container').height();
			
			if($('#wrap_topic:visible').length){
				var heightTopic = $('#wrap_topic').height();
			}
			else {
				heightTopic = 0;
			}
			if ($('#header:visible').length){
				var headerHeight = $('#header').outerHeight();
				var contentHeight = (newHeight - footerHeight - headerHeight - 26);
				var chatBox = (contentHeight - topChat - heightTopic);
			}
			else {
				var contentHeight = (newHeight - footerHeight - 5);
				var chatBox = (contentHeight - topChat - heightTopic - 10);
			}
			
			$("#container_chat").css({"height": contentHeight});
			$("#warp_show_chat").css({"height": chatBox});
			if(fw == 1){
				adjustFull();
			}
	}
	
	// ajusting panel side margin when resizing the screen 
	
	panelMargin = function()
	{
		$( ".panels" ).each(function() {
			var marginLook = parseInt($(this).css('right'));
			var otherPanels = $(this).css('width');
			if(marginLook >= 1){
				$(this).css({"right": otherPanels});
			}
		});
	}
	
	// ajusting ads margin after load of chat 
	
	adsMargin = function()
	{
		var adsHeight = parseInt($('#show_chat_ads').css('height'));
	}
	
	// reload the setting panel
	
	admin_setting_reload = function()
	{
		$.ajax({
			url: "system/admin_setting.php",
			cache: false,
			success: function(html)
			{
				$("#main_option .panel_element").html(html);
			},
		});
	}
	// reload the room in admin panel
	admin_room_reload = function()
	{
		$.ajax({
			url: "system/admin_room.php",
			cache: false,
			success: function(html){
				$("#main_option .panel_element").html(html);
			},
		});
	}
	
	wordFilter = function()
	{
		$.ajax({
			url: "system/word_filter.php",
			cache: false,
			success: function(html)
			{
				$("#main_option .panel_element").html(html);
			},
		});
	}
	
	// reload users in admin panel
	
	admin_user_reload = function()
	{
		$.ajax({
			url: "system/admin_user.php",
			cache: false,
			success: function(html)
			{
				$("#main_option .panel_element").html(html);
			},
		});
	}
	
	//clean database data to prevent overloading it
	clean_database = function()
	{
		$.ajax({
			url: "system/clean_database.php",
			cache: false,
			success: function(response){
				return false;
			},
		});
	}
	
	//Auto muted processor
	mute_process = function()
	{
		$.ajax({
			url: "system/mute_process.php",
			cache: false,
			success: function(response){},
		});
	}
	
	// close emoticon && picker box 
	
	closeEmo = function()
	{
		$.ajax({
			url: "system/mute_process.php",
			cache: false,
			success: function(response){},
		});
	}

	// update_cred
	updateCred = function(){
		$.ajax({
			url: "update_cred.php",
			cache: false,
			success: function(html){
				return false;
			},
		});
	}
	function showLogout (){
		$("#logout_box").fadeIn(200).effect( "bounce", 500);
	}
	
	$(function() {
		$( "#private_panel" ).draggable({
			handle: ".private_drag",
			containment: "document",
		});
	});
	
	showAds = function(){
		
		if(aAllow == 1){
			if(aSelect == 0){
				
				aSelect = 1;
				aCurrent = Math.floor(Date.now() / 1000);
				$("#show_chat_ads").show();
				$(".ads1").fadeIn(1000);	

			}
			else {
				if(aCount > 1){
					
					var timeCompare = Math.floor(Date.now() / 1000);
					
					if( timeCompare >= (aCurrent + aDelay)){
						
						aCurrent = Math.floor(Date.now() / 1000);
						aSelect = aSelect + 1;
						if(aSelect > aCount){
							aSelect = 1;
							$( ".myads" ).each(function() {
								$(this).hide();
							});
							$(".ads1").fadeIn(1000);
						}
						else {
							$( ".myads" ).each(function() {
								$(this).hide();
							});
							$(".ads" + aSelect + "").fadeIn(1000);
						}
					}
					else {
						return false;
					}
				}
				else {
					return false;
				}
			}
		}
		else {
			return false;
		}
	}
