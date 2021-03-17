<div class="background_chat" id="upload_box">
	<div id="upload_header">
		<i class="fa close_upload fa-times-circle"></i>
	</div>
	<div id="upload_control">
		<div id="formupload">
			<form id="upload_form" action="system/file_test.php" method="post" enctype="multipart/form-data">
				<div class="fileUpload sub_button">
					<span><i class="fa fa-folder-open-o fa-fw"></i></span>
					<input class="upload" type="file" name="file" id="file_image" accept='image/*'>
				</div>
				<button class="submit_image full_button sub_button hover_element" type="submit" name="image_submit"><?php echo $submitimage; ?></button>
			</form>
		</div>
		<div id="display_file"></div>
		<div class="progress_mobile">
			<i class="fa fa-circle-o-notch fa-spin"></i>
		</div>
		<div id="progress">
			<div class="progress">
				<div class="bar">0%</div >
			</div>
		</div>
		<div class="error" id="warnupload"></div>
	</div>
	<div id="upload_content">
	</div>
</div>
