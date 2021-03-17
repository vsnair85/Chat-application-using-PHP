
$(document).ready(function(){

		
	$("#intro_installer").on('click', '#start_install', function() {
		$.ajax({
			url: "builder/permission.php",
			cache: false,
			success: function(response){

				if(response == 1){
					$.ajax({
						url: "builder/table.php",
						cache: false,
						success: function(response){
							$('#content_installer').html(response);
						
						},
					});
				}
				else {
					$('#content_installer').html(response);
				}			
			
			
			},
		});
	});
	$("#content_installer").on('click', '#permission_button', function() {
		$.ajax({
			url: "builder/permission.php",
			cache: false,
			success: function(response){
				if(response == 1){
					$.ajax({
						url: "builder/table.php",
						cache: false,
						success: function(response){
							$('#content_installer').html(response);
						},
					});
				}
				else {
					$('#content_installer').html(response);
				}
			},
		});
	});

	var waitInstall = 0;
	$("#content_installer").on('click', '#install_component', function() {
		var host = $( "#host" ).val();
		var name = $( "#name" ).val();
		var user = $( "#user" ).val();
		var password = $( "#password" ).val();
		if(waitInstall == 0){
			waitInstall = 1;
			$.post('builder/component.php', {
			
			host: host,
			name: name,
			user: user,
			password: password
			
			}, function(response) {
				if(response == 2){
					$('#install_error').html('error connecting to your database check data').hide().fadeIn(300).delay(3000).fadeOut();
				}
				else if (response == 3){
					$('#install_error').html('Only password field can be empty other must be filled').hide().fadeIn(300).delay(3000).fadeOut();
				}
				else {
						$.ajax({
							url: "builder/account.php",
							cache: false,
							success: function(response){
								$('#content_installer').html(response);
							},
						});
				}
				waitInstall = 0;
			});
		}
		else {
			return false;
		}
	});
	
	var waitAccount = 0;
	
	$("#content_installer").on('click', '#create_account', function() {
		var username = $( "#user_name" ).val();
		var email = $( "#user_email" ).val();
		var password = $( "#user_password" ).val();
		var confirm = $( "#confirm_password" ).val();
		if(waitAccount == 0){
			waitAccount = 1;
			$.post('builder/create_account.php', {
			
			username: username,
			email: email,
			password: password,
			confirm: confirm
			
			}, function(response) {
				if(response == 6){
					$('#install_error').html('Please fill up all fields').hide().fadeIn(300).delay(3000).fadeOut();
				}
				else if (response == 5){
					$('#install_error').html('username must only contain a-z 0-9 max 16 caracters').hide().fadeIn(300).delay(3000).fadeOut();
				}
				else if (response == 4){
					$('#install_error').html('please enter a valid email').hide().fadeIn(300).delay(3000).fadeOut();
				}
				else if (response == 3){
					$('#install_error').html('password and confirm password do not match').hide().fadeIn(300).delay(3000).fadeOut();
				}
				else {
					location.reload();
				}
				waitAccount = 0;
			});
		}
		else {
			return false;
		}
	});

});