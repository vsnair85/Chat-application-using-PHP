$(document).ready(function(){

	var audioElement = document.createElement('audio');
	audioElement.setAttribute('src', 'sounds/pmsound.mp3');
	audioElement.setAttribute('stop', 'stop');
	
	var audioElement3 = document.createElement('audio');
	audioElement3.setAttribute('src', 'sounds/whistle.mp3');
	audioElement3.setAttribute('stop', 'stop');
	
	
	// check if there are bet availaible
	
	reload_data = function()
	{
			$.ajax({
				url: "system/data_update.php",
				dataType: 'json',
				cache: false,
				success: function(response){

					var myPrivate = response.bet4;
					var checkSound = response.bet3;
					var iconPrivate = response.bet12;
					var checkGsound = response.bet13;
					var iconSet = response.bet14;
					var sfSound = response.bet15;
					var sesCompare = response.bet20;
					var upUsername = response.bet21;
					var getPcount = response.bet22;
					
					if(upUsername !== my_username){
						my_username = upUsername;
						updateCred();
					}
					
					uSd = checkSound;
					fSd = sfSound;
					
					if(sesCompare != sesid){
						overWrite();
					}
					if(checkGsound !== whistle){
						whistle = checkGsound;
						audioElement3.play();
					}
					if(getPcount !== pCount && checkSound > 0){
							audioElement.play();
							pCount = getPcount;
					}
					else {
						pCount = getPcount;
					}
					if(iconPrivate != 0){
						$("#private_count p").text(iconPrivate);
						$('#private_count').show();
						$('.icon_new_private').addClass("new_incoming");
					}
					else {
						$('#private_count').hide();
						$('.icon_new_private').removeClass("new_incoming");
					}
				},
			});
	}	

});