$(document).ready(function(){

	// open private window  
	
	$(document).on('click', '.panel_element .send_private, .private_view, .chat_avatar_wrap, .friend_private', function(){
		if(privateStyle == 2 && user_rank >= pxn){
			var profileTarget = $(this).attr("value");		
			$('.option_list').slideUp(300);
			$('.add_friend_button').attr('value',profileTarget);
			$('#this_target').attr('value', profileTarget);
			$('#main_chat_type').attr('value', '2');
			$('.private_friend .span_private_target').text(profileTarget);
			$('#room_topic').addClass('hide_this');
			$('#menu_private').show();
			var checkMobile = $(window).width();
			if(checkMobile < 1025){
				var marginCheck = parseInt($('#chat_panel').css('right'));
				if(marginCheck >= 1){
					var optionSize = $('#chat_panel').css('width');
					$('#chat_panel').animate({right:"-="+optionSize},200);
				}
			}
			chr = 0;
			clogs = 0;
			adjustTopic();
			privateReload2();
		}
		else if(privateStyle == 1 && user_rank >= pxn){
			$('.option_list').slideUp(300);
			var profileTarget = $(this).attr("value");
			var panelTarget = "private_panel";
			
			if ($('#private_panel:visible').length) {				
				privateControl = "1";
				$('#show_private').html("");
				$('.private_target').html(profileTarget);
				$('.add_friend_button').attr('value',profileTarget);
				$('#private_content').attr('name', profileTarget);
				privScroll = 0;
				privateReload();
			}
			else{
				privateControl = "1";
				$('#'+panelTarget).slideDown(200);
				$('#show_private').html("");
				$('.private_target').html(profileTarget);
				$('.add_friend_button').attr('value',profileTarget);
				$('#private_content').attr('name', profileTarget);
				privScroll = 0;
				privateReload();
			}
		}
		else {
			return false;
		}
	});
	
	$(document).on('click', '#private_close', function(){		
		$('.add_friend_button').attr('value','none');
		$('#this_target').attr('value', 'none');
		$('#main_chat_type').attr('value', '1');
		$('.private_friend .span_private_target').text('none');
		$('#room_topic').removeClass('hide_this');
		$('#menu_private').hide();
		chr = 0;
		clogs = 0;
		privateReload2();
		adjustTopic();
		acSd = 0;
	});
	
	// add a friend to friend list on button click
	
	$("#wrap_topic").on('click', '.add_friend_button', function() {
		var target = $(this).attr('value');
			$.post('system/add_friend.php', {friend: target}, function(response) {	
				if(response == 2){
					$('#chat_error').html("<span class=\"error\">"+system.type2+"</span>").hide().fadeIn(300).delay(5000).fadeOut();
				}
				else if(response == 3){
					$('#chat_error').html("<span class=\"error\">"+system.type3+"</span>").hide().fadeIn(300).delay(5000).fadeOut();			
				}
				else if(response == 203){
					$('#chat_error').html("<span class=\"error\">"+system.friend1+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				}
				else if(response == 204){
					$('#chat_error').html("<span class=\"success\">"+system.friend2+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				}
				else {
					return false;
				}
			});
	});
	$("#private_panel").on('click', '.add_friend_button', function() {
		var target = $(this).attr('value');
			$.post('system/add_friend.php', {friend: target}, function(response) {	
				if(response == 2){
					$('#chat_error').html("<span class=\"error\">"+system.type2+"</span>").hide().fadeIn(300).delay(5000).fadeOut();
				}
				else if(response == 3){
					$('#chat_error').html("<span class=\"error\">"+system.type3+"</span>").hide().fadeIn(300).delay(5000).fadeOut();			
				}
				else if(response == 203){
					$('#chat_error').html("<span class=\"error\">"+system.friend1+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				}
				else if(response == 204){
					$('#chat_error').html("<span class=\"success\">"+system.friend2+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				}
				else {
					return false;
				}
			});
	});
	
	// open user options in user list
	
	$('#chat_panel').on('click', '.panel_element .users_option .open_user', function() {
		if($(this).next('.option_list').css('display') == 'none'){
				$('.option_list').slideUp(100);
				$(this).next().slideDown(100);
		}
		else {
			$(this).next('.option_list').slideUp(100);
		}
	});

	// paste link of image when clicking on scisor icon 
	
	$("#image_panel").on('click', '.copy_link', function(){
		var commandInput = $(this).attr('value');
		emoticon($('#content')[0], commandInput + " ");
		var optionSize = $('#image_panel').css('width');
		$('#image_panel').animate({right:"-="+optionSize},400);
	});
	
	// Paste 'user' in main input when username is clicked in main chat window
	
	$('#container_show_chat').on('click', '#show_chat .username', function() {
        emoticon($('#content')[0], $(this).text() + ' ');
   });
   
	// Paste reply to input box when reply is clicked
	
	$('#container_show_chat').on('click', '#show_chat .private_reply', function() {
			var private_target = $(this).attr('value');
			$('#content').val('').focus();
        emoticon($('#content')[0], "/msg"+' '+private_target + ' ');
   });
	
	// paste command to main input
	
	$(document).on('click', '#help_panel .wrap_command', function(){
		var commandInput = $(this).attr('value');
		var commandPaste = commandInput;
		var optionSize = $('#main_option').css('width');
		$('#help_panel').animate({right:"-="+optionSize},400);
		$('#content').val('').focus().val(commandPaste+' ');
		
	});
	
	
	// send a private message 
	var pWait = 0;
	$('#private_input').submit(function(event){
		var target = $('#private_content').attr('name');
		var message = $('#private_content').val();
		var bold = '0';
		var italic = '0';
		var underline = '0';
		var high = 'transparent';
		var color = 'transparent';
		if(message == ''){
			pWait = 0;
			event.preventDefault();
		}
		else if (/^\s+$/.test($('#content').val())){
			pWait = 0;
			event.preventDefault();
			$('#private_content').val('');
			$('#private_content').focus();
		}
		else{
			if(pWait == 0){
				pWait = 1;
				$.post('system/private_process.php', {target: target, content: message, bold: bold, italic: italic, underline: underline, high: high, color: color}, function(response) {
					$('#private_content').val('');
					$('#private_content').focus();
					privateReload();
					pWait = 0;
				});
			}
			else {
				event.preventDefault();
			}
		}
		return false;
	});
	
	
	// Send a global message or a private message in the main chat window
	var waitReply = 0;
	$('#main_input').submit(function(event){
		var message = $('#content').val();
		var bold = $('#bold_item').attr('value');
		var italic = $('#italic_item').attr('value');
		var underline = $('#underline_item').attr('value');
		var high = $('#high_pick').css('backgroundColor');
		var color = $('#text_pick').css('backgroundColor');
		var chatTarget = $('#this_target').attr('value');
		var chatType = $('#main_chat_type').attr('value');
		var postTarget = '1';
		
		if(chatType == '1'){
			postTarget = 'chat_process';
		}
		else if(chatType == '2'){
			postTarget = 'private_process';
		}
		else {
			event.preventDefault();
			return false;
		}
		if(emOn != 1){
			high = 'transparent';
			color = 'transparent';
			bold = '0';
			italic = '0';
			underline = '0';
		}
		if(message == ''){
			event.preventDefault();
		}
		else if (/^\s+$/.test($('#content').val())){
			event.preventDefault();
			$('#content').val('').focus();
		}
		else{
			$('#content').val('').focus();
			if(waitReply == 0){
				waitReply = 1;
				$.post('system/'+ postTarget +'.php', {content: message, bold: bold, italic: italic, underline: underline, high: high, color: color, target:chatTarget}, function(response) {
					if (response == 1){
						$('#chat_error').html("<span class=\"error\">"+ system.type1 +"</span>").hide().fadeIn(100).delay(5000).fadeOut();
					}
					else if (response == 2){
						$('#chat_error').html("<span class=\"error\">"+system.type2+"</span>").hide().fadeIn(300).delay(5000).fadeOut();				}
					else if (response == 3){
						$('#chat_error').html("<span class=\"error\">"+system.type3+"</span>").hide().fadeIn(300).delay(5000).fadeOut();					
					}
					else if (response == 4){					
					}
					else if (response == 5){
						$('#chat_error').html("<span class=\"error\">"+system.type4+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 6){
						$('#chat_error').html("<span class=\"error\">"+system.type5+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 7){
						$('#chat_error').html("<span class=\"success\">"+system.type6+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 8){
						$('#chat_error').html("<span class=\"error\">"+system.type7+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 9){
						$('#chat_error').html("<span class=\"error\">"+system.type8+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 10){
						$('#chat_error').html("<span class=\"error\">"+system.type9+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 11){
						topic_reload();
					}
					else if (response == 12){
						$('#chat_error').html("<span class=\"error\">"+system.type10+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 13){
						$('#chat_error').html("<span class=\"error\">"+system.type11+"</span>").hide().fadeIn(300).delay(5000).fadeOut();					
					}
					else if (response == 14){
						$('#chat_error').html("<span class=\"error\">"+system.type12+"</span>").hide().fadeIn(300).delay(5000).fadeOut();					
					}
					else if (response == 15){
						$('#chat_error').html("<span class=\"success\">"+system.type13+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 16){
						$('#chat_error').html("<span class=\"error\">"+system.type14+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}		
					else if (response == 17){
						$('#chat_error').html("<span class=\"error\">"+system.type17+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 18){
						$('#chat_error').html("<span class=\"success\">"+system.type18+"</span>").hide().fadeIn(300).delay(3000).fadeOut();	
					}
					else if (response == 19){
						$('#chat_error').html("<span class=\"error\">"+system.type19+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 20){
						$('#chat_error').html("<span class=\"success\">"+system.type20+"</span>").hide().fadeIn(300).delay(3000).fadeOut();	
					}
					else if (response == 21){
						$('#chat_error').html("<span class=\"error\">"+system.type21+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 22){
						$('#chat_error').html("<span class=\"error\">"+system.type22+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 23){
						$('#chat_error').html("<span class=\"success\">"+system.type23+"</span>").hide().fadeIn(300).delay(3000).fadeOut();	
					}
					else if (response == 24){
						$('#chat_error').html("<span class=\"success\">"+system.type24+"</span>").hide().fadeIn(300).delay(3000).fadeOut();	
					}
					else if (response == 25){
						$('#chat_error').html("<span class=\"error\">"+system.type25+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 26){
						$('#chat_error').html("<span class=\"error\">"+system.type26+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 27){
						$('#chat_error').html("<span class=\"error\">"+system.type27+"</span>").hide().fadeIn(300).delay(3000).fadeOut();					
					}
					else if (response == 28){
						$('#chat_error').html("<span class=\"success\">"+system.type28+"</span>").hide().fadeIn(300).delay(3000).fadeOut();	
					}
					else if (response == 99){
						openUsermanual();
					}
					else if (response == 200){
						$('#chat_error').html("<span class=\"error\">"+system.ing1+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
					else if (response == 201){
						$('#chat_error').html("<span class=\"success\">"+system.ing2+"</span>").hide().fadeIn(300).delay(3000).fadeOut();	
					}
					else if (response == 202){
						$('#chat_error').html("<span class=\"error\">"+system.type15+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
					else if (response == 203){
						$('#chat_error').html("<span class=\"error\">"+system.friend1+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
					else if (response == 204){
						$('#chat_error').html("<span class=\"success\">"+system.friend2+"</span>").hide().fadeIn(300).delay(3000).fadeOut();	
					}
					else if (response == 404){
						$('#chat_error').html("<span class=\"error\">"+system.errorOccur+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
					}
					else if(response == 999){
						location.reload();
					}
					else{
					$('#name').val('');
					rlc = 1;
					chat_reload();
					}
					waitReply = 0;
				});
			}
			else {
				event.preventDefault();
			}
		}
		return false;
	});
	
});