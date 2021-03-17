	
$(document).ready(function(){
	
	
	
	
	
	$(document).on('click', '#update_button', function() {
		
		var passU = $('#password').val();
		var userU = $('#username').val();

		
		$.post('data/data.php', { 
			password: passU,
			username: userU
			
			}, function(response) {
				if(response == 1){
					$('#login_error_inside').text('Problem connecting to your database');
				}
				else if(response == 2){
					$('#login_error_inside').text('You didnt have provide username or password');
				}
				else if(response == 3){
					$('#login_error_inside').text('This user do not exist');
				}
				else{
					$('#container_login').animate({height:"220px"},100);
					$('#content_login').html(response);
				}
		});
		
		return false;
		
	});
	
});