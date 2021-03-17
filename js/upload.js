$(document).ready(function(){

	// upload feature
	
	var mTarget = 0;
	
	// close and open upload window 
	
	$("#send_image, .close_upload").click(function() {
		
		var imgType = $('#main_chat_type').attr('value');
		var imgTarget = $('#this_target').attr('value');
		
		if ($('#upload_box:visible').length){
			$('#upload_box').fadeOut(200);
		}
		else {
			$('#upload_box').fadeIn(200);
		}
		$('#warnupload').text("").hide();
		$("#display_file").text("");
		if(imgType == 2){
			$('#upload_form').attr('action', "system/file_test.php?target="+imgTarget);
			mTarget = 0;
		}
		else {
			$('#upload_form').attr('action', "system/file_test.php");
			mTarget = 0;
		}
	});
	
	$('#p_image').click(function(){
		var imgTarget = $('#private_content').attr('name');
		if ($('#upload_box:visible').length){
			$('#upload_box').fadeOut(200);
		}
		else {
			$('#upload_box').fadeIn(200);
		}
		$('#warnupload').text("").hide();
		$("#display_file").text("");
	   $('#upload_form').attr('action', "system/file_test.php?target="+imgTarget);
	   mTarget = 1;
	});
	
	// hide warning on new select 
	
	$(document).on('click', '.fileUpload', function() {
		$('#warnupload').text("").hide();
	});

	// display selected file
	
    $("#file_image").change(function() {
        var selFiles = $("#file_image").val();
		$("#display_file").text(selFiles);
    });
	
	// upload avatar to server


	var bar = $('.bar');
	var status = $('#status');
	
	if( $(window).width() < 1024){
		$('#formupload').ajaxForm({
			beforeSubmit : function(arr, $form, options){
				if($("#file_image").val() !== ""){
					var filez = $("#file_image")[0].files[0].size;
					filez = (filez / 1024 / 1024).toFixed(2);
					
					if(filez > fmw || filez > 25){
							$(".progress").hide();
							$('#warnupload').text(system.upload6).show();
							$('#warnupload').show();
							return false;
					}
					else {
						return true;
					}
				}
				else {
					return false;
				}
			},
			beforeSend: function() {
				status.empty();
				$(".progress_mobile").show();
				$('#warnupload').text("").hide();
			},
			complete: function(xhr) {
					if(xhr.responseText == 1){
						$(".progress_mobile").hide();
						$('#warnupload').text(system.upload3).show();
						$('#warnupload').show();
					}
					else if(xhr.responseText== 2){
						$(".progress_mobile").hide();
						$('#warnupload').text(system.upload6).show();
						$('#warnupload').show();
					}
					else if(xhr.responseText == 3){
						$(".progress_mobile").hide();
						$('#warnupload').text(system.upload7).show();
						$('#warnupload').show();
					}
					else if (xhr.responseText == 4){
						$(".progress_mobile").hide();
						$('#warnupload').text(system.upload8);
						$('#warnupload').show();
					}
					else if (xhr.responseText == 5){
						$('#warnupload').text("");
						$("#upload_box, .progress_mobile, #warnupload").fadeOut(100);
						if(mTarget == 1){
							pWait = 0;
							privateReload();
						}
						else {
							chat_reload();
						}
					}
					else{
						$(".progress_mobile").hide();
						$('#warnupload').text(system.upload1).show();
						$('#warnupload').show();
					}
					var uploadInput = $('#file_image');
					uploadInput.replaceWith(uploadInput.val('').clone(true));
			}
		});
	}
	else {
		$('#formupload').ajaxForm({
			beforeSubmit : function(arr, $form, options){
				if($("#file_image").val() !== ""){
					var filez = $("#file_image")[0].files[0].size;
					filez = (filez / 1024 / 1024).toFixed(2);
					
					if(filez > fmw || filez > 25){
							$(".progress").hide();
							$('#warnupload').text(system.upload6).show();
							$('#warnupload').show();
							return false;
					}
					else {
						return true;
					}
				}
				else{
					return false;
				}
			},
			beforeSend: function() {
				status.empty();
				var percentVal = '0%';
				bar.css("width", percentVal);
				bar.html(percentVal);
				$(".progress").show();
				$('#warnupload').text("").hide();
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.css("width", percentVal);
				bar.html(percentVal);
			},
			complete: function(xhr) {
					if(xhr.responseText == 1){
						$(".progress").hide();
						$('#warnupload').text(system.upload3).show();
						$('#warnupload').show();
					}
					else if(xhr.responseText== 2){
						$(".progress").hide();
						$('#warnupload').text(system.upload6).show();
						$('#warnupload').show();
					}
					else if(xhr.responseText == 3){
						$(".progress").hide();
						$('#warnupload').text(system.upload7).show();
						$('#warnupload').show();
					}
					else if (xhr.responseText == 4){
						$(".progress").hide();
						$('#warnupload').text(system.upload8);
						$('#warnupload').show();
					}
					else if (xhr.responseText == 5){
						$('#warnupload').text("");
						$("#upload_box, .progress, #warnupload").fadeOut(100);
						if(mTarget == 1){
							pWait = 0;
							privateReload();
						}
						else {
							chat_reload();
						}
					}
					else{
						$(".progress").hide();
						$('#warnupload').text(system.upload1).show();
						$('#warnupload').show();
					}
					var uploadInput = $('#file_image');
					uploadInput.replaceWith(uploadInput.val('').clone(true));
			}
		});
	}
});