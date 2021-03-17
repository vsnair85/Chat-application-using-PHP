$(document).ready(function(){

	// search user feature
	
	$('#main_option').on('click', '#search_button', function() {
		var findTarget = $('#find_user').val();
			$.post('system/user_details.php', {get_user: findTarget}, function(response) {
				$("#main_option #search_result").html(response);
				$('#find_user').val("");
			});
		return false;
	});
	
	
	$('#main_option').on('click', '#edit_password', function(){
	
		var effect = $(this).attr("value");
		var target = $("#edit_target").attr("name");
		var targetId = $("#edit_target").attr("value");
		var newPass = $("#edit_new_password").val();
			
		$.post('system/edit_user.php', {
		
		effect: effect,
		target: target,
		newpass: newPass,
		targetid: targetId
		
		}, function(response) {	
			if(response == 1){
				$('#error_pass').html("<span class=\"success\">"+system.updateSuccess+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#edit_new_password').val("");
			}
			else {
				$('#error_pass').html("<span class=\"error\">"+system.errorOccur+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#edit_new_password').val("");
			}
		});
	});
	
	
	$('#main_option').on('click', '#edit_email', function(){
	
		var effect = $(this).attr("value");
		var target = $("#edit_target").attr("name");
		var targetId = $("#edit_target").attr("value");
		var newEmail = $("#new_email").val();
			
		$.post('system/edit_user.php', {
		
		effect: effect,
		target: target,
		newmail: newEmail,
		targetid: targetId
		
		}, function(response) {	
			if(response == 1){
				$('#error_email').html("<span class=\"success\">"+system.updateSuccess+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#new_email').val("");
				$('#new_email').attr("placeholder", "");
			}
			else {
				$('#error_email').html("<span class=\"error\">"+system.errorOccur+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#new_email').val("");
			}
		});
	});
	
	$('#main_option').on('click', '#edit_name', function(){
	
		var effect = $(this).attr("value");
		var target = $("#edit_target").attr("name");
		var targetId = $("#edit_target").attr("value");
		var newMname = $("#new_member_name").val();
			
		$.post('system/edit_user.php', {
		
		effect: effect,
		target: target,
		newMname: newMname,
		targetid: targetId
		
		}, function(response) {	
			if(response.indexOf("ok1000") > 0){
				var setName = response;
				setName = response.replace("ok1000", "");
				setName = setName.trim();
				
				$('#error_mname').html("<span class=\"success\">"+system.updateSuccess+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#new_member_name').val("");
				$('#new_member_name').attr("placeholder", setName);
				$('#edit_target').attr("name", setName);
				$('#this_user_name').html(setName);
			}
			else if (response == 9){
				$('#error_mname').html("<span class=\"error\">"+system.log5+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#new_member_name').val("");			
			}
			else if (response == 8){
				$('#error_mname').html("<span class=\"error\">"+system.log8+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#new_member_name').val("");	
			}
			else {
				$('#error_mname').html("<span class=\"error\">"+system.errorOccur+"</span>").hide().fadeIn(300).delay(3000).fadeOut();
				$('#new_member_name').val("");
			}
		});
	});

	
	$('#main_option').on('click', '.edit_button', function(){
	
		var effect = $(this).attr("value");
		var target = $("#edit_target").attr("name");
		var targetId = $("#edit_target").attr("value");
		var eAvatar = $("#eavatar").attr("value");
			
		$.post('system/edit_user.php', {
		
		effect: effect,
		target: target,
		targetid: targetId
		
		}, function(response) {	
			if(response == 1){
				$("#eavatar").attr("src", eAvatar);
			}
			else {
				return false;
			}
		});
	});

});