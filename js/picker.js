$(document).ready(function(){

	var pickSelect = "";
	
	$(".picker").click(function() {
		var pickPos = $(this).position();
		var pickHeight = $(this).height();
		var pickWidth = $(this).width();
		var pickBox = $("#picker_box").outerHeight();
		pickSelect = $(this).attr('value');
		
		if ($('#picker_box:visible').length){
			$("#picker_box").hide();
		}
		else {
			if(boxZone == 1){
				$("#picker_box").css({
					position: "absolute",
					top: pickPos.top + pickHeight + "px",
					left: pickPos.left + "px"
				}).show();
			}
			else{
				$("#picker_box").css({
					position: "absolute",
					top: pickPos.top - pickBox + "px",
					left: pickPos.left + "px"
				}).show();
			}
		}
	});
	
	$(".pick_color").click(function() {
		var color = $(this).attr('value');
		$('#'+ pickSelect).css("background",color)
		$('#'+ pickSelect).css("background-size","100% 100%")
		$("#picker_box").hide();
	});
	
	$(".text_item").click(function() {
		var checkItem = $(this).attr('value');
		if(checkItem == 0){
			$(this).addClass('sel_item');
			$(this).attr('value','1');
		}
		else {
			$(this).removeClass('sel_item');
			$(this).attr('value','0');
		}
	});
	
	resetEmo = function(){
		$("#list_emoticon").css({
			width: "235px",
			height:"auto",
		}).hide();
		$("#smile_content, #emo_list").css({
			height:"240px",
			width:"100%",
		});		
	}
	
	
	$("#emo_item").click(function() {
		var emoPos = $(this).position();
		var emoHeight = $(this).height();
		var emoWidth = $(this).width();
		var smback = $("#smile_content").css("backgroundColor");
		var smHeader = $(".panels").css("backgroundColor");
		var emoBox = $("#list_emoticon").outerHeight();
		var emoLoc = emoPos.top - emoBox;
		var emoLeft = emoPos.left + 10;
		if(boxZone == 1){
			emoLoc = emoPos.top + emoHeight;
		}
		if(srtl == 1){
			emoLeft = emoPos.left - 215;
		}
		if ($('#list_emoticon:visible').length){
			if($('#lock_status').attr("value") == 0){
				resetEmo();
			}
		}
		else {
			$("#picker_box").hide();
			$("#smile_header").css("background", smHeader);
			$("#list_emoticon").css({
				position: "absolute",
				top: emoLoc + "px",
				left: emoLeft + "px",
				width: "235px",
				height: "auto",
				background: smback,
			}).show();
			$("#smile_content, #emo_list").css({
				border:"none",
				height:"240px",
				width:"100%",
			});
		}
	});

	// hide the emoticon box ...
	
	$('#list_emoticon').on('click', '.closesmilies', function(){
		if($('#lock_status').attr("value") == 0){
			$('#list_emoticon').hide();
		}
	});

	$('#list_emoticon').on('click', '.close_smile', function(){
		$("#lock_status").attr("value", 0);
		$('.lock_smile').removeClass("fa-lock");
		$('.lock_smile').addClass("fa-unlock");
		resetEmo();
	});	
	
	
	// keep smile box open options

	$('#list_emoticon').on('click', '.lock_smile', function(){
		
		var checkLock = $('#lock_status').attr("value");
		
		if(checkLock == 0){
			$("#lock_status").attr("value", 1);
			$('.lock_smile').removeClass("fa-unlock");
			$('.lock_smile').addClass("fa-lock");
		}
		else {
			$("#lock_status").attr("value", 0);
			$('.lock_smile').removeClass("fa-lock");
			$('.lock_smile').addClass("fa-unlock");			
		}
		
	});	
	
	
	
	// close smilie and picker if click somwhere else on the page 	

	$(document).mouseup(function (e)
	{
		var clicked = $("#list_emoticon");
		var clicked2 = $("#picker_box");
		var clicked3 = $("#text_pick");
		var clicked4 = $("#high_pick");
		var clicked5 = $("#zoom_emo");
		var clicked6 = $(".opt_open");
		var clicked7 = $("#wrap_options");
		var clicked8 = $(".option_add");
		

		if (!clicked.is(e.target) && !clicked2.is(e.target) && !clicked3.is(e.target) 
		&& !clicked4.is(e.target) && !clicked5.is(e.target) && !clicked6.is(e.target) && !clicked7.is(e.target))
		{
			clicked2.hide();
		}
	});

	$("#content, #submit_button").click(function() {
		if($('#lock_status').attr("value") == 0){
			resetEmo();
			$("#list_emoticon").hide();
		}
	});	
	
	
	$("#open_option").click(function() {
		if ($('#wrap_options:visible').length){
			$("#wrap_options").fadeOut(100);
		}
		else {
			$("#wrap_options").fadeIn(200);
		}
		$(".menu_drop").fadeOut(100);
	});

	$(".addon_options").click(function() {
		$("#wrap_options").fadeOut(100);
	});
	
	
	$("#addon_container img").hover(function() {
		var addonSelected = $(this).attr('value');
		$("#option_title p").text(addonSelected);
	});
	$("#addon_container .addon_options").mouseout(function() {
		$("#option_title p").text("");
	});
	
	
	$(function() {
		$( "#list_emoticon" ).draggable({
			handle: "#smile_header",
			containment: "document",
		});
	});
	$(function() {
		$( "#container_player" ).draggable({
			containment: "document",
		});
	});
	
	// display and hide music player 
	
	$("#open_player").click(function() {
		if ($('#container_player:visible').length){
			$("#container_player").fadeOut(100);
		}
		else {
			$("#container_player").fadeIn(200);
		}
		$(".menu_drop").fadeOut(100);
		$("#wrap_options").fadeOut(100);
	});
	$(".close_player").click(function() {
			$("#container_player").fadeOut(100);
	});
	
	
	// resizable module emoticon 
	
	$(function() {
		$( "#list_emoticon" ).resizable({
			minWidth:200,
			maxWidth:600,
			maxHeight:1100,
			alsoResize: "#emo_list",
		});
	});
});

// displaying emoticon in the chat room
function emoticon(target, data){

var countEmo = $("#content").val();
var count = ((countEmo.match(/:/g)||[]).length + 2);

	if(count < 42){
		if (document.selection) {
			sel.text = data;
			target.focus();
			sel = document.selection.createRange();
		} 
		else if (target.selectionStart || target.selectionStart == '0') {
			var start = target.selectionStart;
			var end = target.selectionEnd;
			target.value = target.value.substring(0, start) + data + target.value.substring(end, target.value.length);
		} 
		else {
			target.value += data;
		}
	   setTimeout(function() { $(target).focus(); }, 0);
	}
	else {
		setTimeout(function() { $(target).focus(); }, 0);
	}
};

