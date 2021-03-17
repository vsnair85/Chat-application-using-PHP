<?php 
	if($setting['allow_colors'] != 1){
		$hide_colors = 'style="display:none;"';
	}
	else {
		$hide_colors = "";
	}
?>
<div <?php echo $hide_colors; ?> class="bar_options">
	<div class="bar_options_item">
		<i class="backpen icon_bar fa fa-pencil-square"></i>
	</div>
	<div class="wrap_picker">
		<div id="high_pick" value="high_pick" class="picker">
		</div>
	</div>
</div>
<div <?php echo $hide_colors; ?> class="bar_options">
	<div class="bar_options_item">
		<i class="frontpen icon_bar fa fa-pencil-square-o"></i>
	</div>
	<div class="wrap_picker">
		<div id="text_pick" value="text_pick" class="picker">
		</div>
	</div>
</div>
<div class="bar_options">
	<div id="bold_item" value="0" class="text_item bar_options_item">
		<i class="icon_bar fa fa-bold"></i>
	</div>
</div>
<div class="bar_options">
	<div id="italic_item" value="0" class="text_item bar_options_item">
		<i class="icon_bar fa fa-italic"></i>
	</div>
</div>
<div class="bar_options">
	<div id="underline_item" value="0" class="text_item bar_options_item">
		<i class="icon_bar fa fa-underline"></i>
	</div>
</div>