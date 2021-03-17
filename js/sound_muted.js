$(document).ready(function(){

	
	var audioElement2 = document.createElement('audio');
	audioElement2.setAttribute('src', 'sounds/username.mp3');
	audioElement2.setAttribute('stop', 'stop');
	
	
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
					
					if(upUsername !== my_username){
						my_username = upUsername;
						updateCred();
					}
					
					uSd = checkSound;
					fSd = sfSound;
					
					if(sesCompare != sesid){
						overWrite();
					}
				},
			});
	}	
});