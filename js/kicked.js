$(document).ready(function(){

	$(document).on('click', '#kicked_button', function() {
		$.ajax({
			url: "logout.php",
			cache: false,
			success: function(html){
				location.reload();
			},
		});
	});
});