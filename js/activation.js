$(document).ready(function(){

	$(document).on('click', '#activate_button', function() {
		$.ajax({
			url: "logout.php",
			cache: false,
			success: function(html){
				location.reload();
			},
		});
	});
	
	$(document).on('click', '#resend_button', function() {
		$.ajax({
			url: "system/resend_activation.php",
			cache: false,
			success: function(response){
				if(response == 1){
					$("#top_activation h2").text(system.activeOk);
					$("#top_activation p").text("");
				}
				if(response == 2){
					$("#content_kicked").html("<h2>"+system.activeBad+"</h2>");
				}
				if(response == 3){
					$("#content_kicked").html("<h2>"+system.activeError+"</h2>");
				}
				if(response == 100){
					$("#content_kicked").html("<h2>"+system.abuseMail+"</h2>");
				}
			},
		});
	});

});