
$(document).ready(function(){

	bcCookie = function(){
		var checkCookie = navigator.cookieEnabled;
		if(checkCookie == false){
			alert("you need to enable cookie for the site to be able to log in");
		}
	}
	var waitReply = 0;
	
	$(document).keypress(function(e) {
		if(e.which == 13) {
			var upass = $('#user_password').val();
			var uuser = $('#user_username').val();

			
			if(upass == '' || uuser == ''){
				$('#login_error_inside').text(system.log1);
				return false;
			}
			else if (/^\s+$/.test($('#user_password').val())){
				$('#login_error_inside').text(system.log2);
				$('#user_password').val("");
				return false;
			}
			else if (/^\s+$/.test($('#user_username').val())){
				$('#login_error_inside').text(system.log2);
				$('#user_username').val("");
				return false;
			}
			else {
				if(waitReply == 0){
					waitReply = 1;
					$.post('login.php', {password: upass, username: uuser}, function(response) {
							
							if(response == 1){
								$('#login_error_inside').text(system.log3);
								$('#user_password').val("");
							}
							else if (response == 2){
								$('#login_error_inside').text(system.log3);
								$('#user_password').val("");
							}
							else if (response == 3){
								location.reload();
							}
							else if (response == 4){
								$('#login_error_inside').text(system.log10);
								$('#user_password').val("");	
							}
							waitReply = 0;
					});
				}
				else{
					return false;
				}
			}
		}
	});
	// login form
	$(document).on('click', '#login_button', function() {
	
		var upass = $('#user_password').val();
		var uuser = $('#user_username').val();

		
		if(upass == '' || uuser == ''){
			$('#login_error_inside').text(system.log1);
			return false;
		}
		else if (/^\s+$/.test($('#user_password').val())){
			$('#login_error_inside').text(system.log2);
			$('#user_password').val("");
			return false;
		}
		else if (/^\s+$/.test($('#user_username').val())){
			$('#login_error_inside').text(system.log2);
			$('#user_username').val("");
			return false;
		}
		else {
			if(waitReply == 0){
				waitReply = 1;
				$.post('login.php', {password: upass, username: uuser}, function(response) {
						if(response == 1){
							$('#login_error_inside').text(system.log3);
							$('#user_password').val("");
						}
						else if (response == 2){
							$('#login_error_inside').text(system.log3);
							$('#user_password').val("");
						}
						else if (response == 3){
							location.reload();
						}
						else if (response == 4){
							$('#login_error_inside').text(system.log10);
							$('#user_password').val("");	
						}
					waitReply = 0;
				});
			}
			else {
				return false;
			}
		}
	});
	
	
	// registration form 
	
	$(document).on('click', '#register_button', function() {
	
		var upass = $('#reg_password').val();
		var uuser = $('#reg_username').val();
		var uemail = $('#reg_email').val();
		var uagree = $('#user_agree').prop('checked');
		
		if(fullForm == 1){
			var ugender = $('#login_select_gender').val();
			var uage = $('#login_select_age').val();
			var ucountry = $('#login_select_country').val();
			var uregion = $('#login_select_region').val();
		}
		else {
			var ugender = 0;
			var uage = 0;
			var ucountry = 0;
			var uregion = 0;
		}
		if(explorerAgree == 0){
			uagree = "true";
		}

		if(upass == '' || uuser == '' || uemail == ''){
			$('#login_error_inside').text(system.log1);
			return false;
		}
		else if (/^\s+$/.test($('#reg_password').val())){
			$('#login_error_inside').text(system.log2);
			$('#user_password').val("");
			return false;
		}
		else if (/^\s+$/.test($('#reg_password').val())){
			$('#login_error_inside').text(system.log2);
			$('#reg_password').val("");
			return false;
		}
		else if (/^\s+$/.test($('#reg_email').val())){
			$('#login_error_inside').text(system.log2);
			$('#reg_email').val("");
			return false;
		}
		else {
			if(waitReply == 0){
				waitReply = 1;
				$.post('registration.php', {password: upass, username: uuser, email: uemail, age: uage, gender: ugender, country: ucountry, region: uregion, uagree: uagree}, function(response) {
						if(response == 2){
							$('#login_error_inside').text(system.errorOccur);
							$('#reg_password').val("");
							$('#reg_username').val("");
							$('#reg_email').val("");	
						}
						else if (response == 3){
							$('#login_error_inside').text(system.errorOccur);
							$('#reg_password').val("");
							$('#reg_username').val("");
							$('#reg_email').val("");
						}
						else if (response == 4){
							$('#login_error_inside').text(system.log4);
							$('#reg_username').val("");
						}
						else if (response == 5){
							$('#login_error_inside').text(system.log5);
							$('#reg_username').val("");
						}
						else if (response == 6){
							$('#login_error_inside').text(system.log6);
							$('#reg_email').val("");
						}
						else if (response == 7){
							$('#login_error_inside').text(system.log8);
							$('#reg_username').val("");
						}
						else if (response == 9){
							$('#login_error_inside').text(system.log7);
							$('#reg_username').val("");
						}
						else if (response == 10){
							$('#login_error_inside').text(system.log11);
							$('#reg_email').val("");
						}
						else if (response == 11 || response == 12){
							$('#login_error_inside').text(system2.selCountry);
						}
						else if (response == 13 || response == 14){
							$('#login_error_inside').text(system.errorOccur);
						}
						else if (response == 15){
							$('#login_error_inside').text(system2.agreement);
						}
						else if (response == 1){
							location.reload();
						}
						else {
							return false;
							waitReply = 0;
						}
						waitReply = 0;
				});
			}
			else{
				return false;
			}
		}
	});
	
	
	// password recovery request 
	
	$(document).on('click', '#recovery_button', function() {
	
		var rUser = $('#recovery_username').val();
		var rEmail = $('#recovery_email').val();

		
		if(rUser == '' || rEmail == ''){
			$('#login_error_inside').text(system.log1);
			return false;
		}
		else if (/^\s+$/.test($('#recovery_username').val())){
			$('#login_error_inside').text(system.log2);
			$('#recovery_username').val("");
			return false;
		}
		else if (/^\s+$/.test($('#recovery_email').val())){
			$('#login_error_inside').text(system.log2);
			$('#recovery_email').val("");
			return false;
		}
		else {
			if(waitReply == 0){
				waitReply = 1;
				$.post('system/recovery_process.php', {ruser: rUser, remail: rEmail}, function(response) {
						if (response == 1){
							$('#login_error_inside').text(system.log9);
							$('#recovery_username').val("");
							$('#recovery_email').val("");
						}
						else if (response == 2){
							successForm();
						}
						else if (response == 3){
							$('#login_error_inside').text(system.errorOccur);
							$('#recovery_username').val("");
							$('#recovery_email').val("");
						}
						waitReply = 0;
				});
			}
			else {
				return false;
			}
		}
	});
	
	
	// login as guest request 
	
	$(document).on('click', '#guest_ok', function() {
	
		var upass = 'guest';
		var uuser = $('#guest_username').val();
		var uemail = 'guest@boomguest.com';
		var ugender = 0;
		var uage = 0;
		var ucountry = 0;
		var uregion = 0;
		var uagree = "true";
		
		if(uuser == ''){
			$('#login_error_inside').text(system.log1);
			return false;
		}
		else if (/^\s+$/.test($('#guest_username').val())){
			$('#login_error_inside').text(system.log2);
			$('#guest_username').val("");
			return false;
		}
		else {
			if(waitReply == 0){
				waitReply = 1;
				$.post('registration.php', {password: upass, username: uuser, email: uemail, age: uage, gender: ugender, country: ucountry, region: uregion, uagree: uagree}, function(response) {
						if(response == 2){
							$('#login_error_inside').text(system.errorOccur);
							$('#guest_username').val("");
						}
						else if (response == 3){
							$('#login_error_inside').text(system.errorOccur);
							$('#guest_username').val("");
						}
						else if (response == 4){
							$('#login_error_inside').text(system.log4);
							$('#guest_username').val("");
						}
						else if (response == 5){
							$('#login_error_inside').text(system.log5);
							$('#guest_username').val("");
						}
						else if (response == 6){
							$('#login_error_inside').text(system.log6);
							$('#guest_username').val("");
						}
						else if (response == 7){
							$('#login_error_inside').text(system.log8);
							$('#guest_username').val("");
						}
						else if (response == 9){
							$('#login_error_inside').text(system.log7);
							$('#guest_username').val("");
						}
						else if (response == 10){
							$('#login_error_inside').text(system.log11);
							$('#guest_username').val("");
						}
						else if (response == 1){
							location.reload();
						}
						else {
							return false;
							waitReply = 0;
						}
						waitReply = 0;
				});
			}
			else {
				return false;
			}
		}
	});
	

	$(document).on('change', '#login_select_country', function() {
		var CountryTarget = $(this).val();
			$.post('system/load_region.php', {country: CountryTarget}, function(response) {	
					if(response != 0){
						$("#login_select_region").html(response);
					}
					else {
						$("#login_select_region").html("");
					}
			});
	});
	
	// open the rules panel
	
	$(document).on('click', '.rules_link', function() {
	
			var panelTarget = $(this).attr('value');
			var optionSize = $('#'+panelTarget).css('width');
			var marginCheck = parseInt($('#'+panelTarget).css('right'));
			
			if (marginCheck >= 1) {
				$('#'+panelTarget).animate({right:"-="+optionSize},200);
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
			}
		
	});
	$(".close_panel").click(function(){
	
		var panelTarget = $(this).attr('value');
		var optionSize = $('#'+panelTarget).css('width');
		var marginCheck = parseInt($('#'+panelTarget).css('right'));
		
		if (marginCheck >= 1) {
			$('#'+panelTarget).animate({right:"-="+optionSize},200);
		}
		
	});
	
	// bridge login 
	
	bridgeForm = function(){
		$.ajax({
			url: "bridge_login.php",
			cache: false,
			success: function(response){
				if(response == 1){
					location.reload();
				}
				else if(response == 2){
					$('#login_error_inside').text(bridge.error2);
				}
				else if(response == 3){
					$('#login_error_inside').text(bridge.error3);
				}
				else {
					$('#login_error_inside').text(bridge.error4);
				}
				
			},
		});
	}
	
	// login form bridge button click event
	
	$(document).on('click', '#bridge_login', function() {
		bridgeForm();
	});
	
	
	// adjust rules panel on resize
	
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
	$( window ).resize(function() {
		panelMargin();
	});

	$(document).on('click', '#guest_button', function() {
		guestForm();
	});
	
	
	$(document).on('click', '#login_register p', function() {
		registerForm();

	});
	$(document).on('click', '#login_login p', function() {
		loginForm();

	});
	$(document).on('click', '#login_guest p', function() {
		loginForm();

	});
	$(document).on('click', '.forgot_password', function() {
		recoveryForm();

	});
	$(document).on('click', '#back_login', function() {
		loginForm();

	});
	
	registerForm = function(){
		var checkEmbed = $("#external_wrap").attr("value");
		$.ajax({
			url: "system/registration.php?embed="+checkEmbed,
			cache: false,
			success: function(html){
				$('#content_login').html(html);
			},
		});
	}
	loginForm = function(){
		var checkEmbed2 = $("#external_wrap").attr("value");
		$.ajax({
			url: "system/login.php?embed="+checkEmbed2,
			cache: false,
			success: function(html){
				$('#content_login').html(html);
			},
		});
	}
	recoveryForm = function(){
		$.ajax({
			url: "system/pass_recovery.php",
			cache: false,
			success: function(html){
				$('#content_login').html(html);
			},
		});
	}
	guestForm = function(){
		$.ajax({
			url: "system/guest.php",
			cache: false,
			success: function(html){
				$('#content_login').html(html);
			},
		});
	}
	successForm = function(){
		$.ajax({
			url: "system/recovery_success.php",
			cache: false,
			success: function(html){
				$('#content_login').html(html);
			},
		});
	}
	
	bcCookie();
	
});