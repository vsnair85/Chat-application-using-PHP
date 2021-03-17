<?php if($chat_install > 1){

	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\">
	<head>
	<title>Boomchat installer</title>
	<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
	<script type=\"text/javascript\" src=\"js/jquery-1.9.0.min.js\"></script>
	<script type=\"text/javascript\" src=\"builder/install.js\"></script>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"builder/install.css\" />

	</head>
	<body>
	<div id=\"external_wrap\">";
		if($chat_install == 2){
			echo "<div id=\"installer_box\">";
				include('builder/header.php');
			echo "<div id=\"content_installer\">
					<div id=\"intro_installer\">
						<h2>Welcome to boomchat installer</h2>
						<p>Are your ready to install boomchat on your server ?</p>
						<button class=\"install_button\" id=\"start_install\">Yes i am</button>
					</div>
				</div>
				</div>";
		}
		else {
			echo "<div id=\"connection_box\">";
				include('builder/header.php');
			echo "<div id=\"content_connection\">
					<h2>Problem connecting to your database</h2>
					<p>Boomchat seem to be installed on your server but an error occur while trying to access your database if you have installed Boomchat manually please verify database information provided then refresh this page</p>
				</div>
				</div>";
		}
	echo "</div>
	</body>
	</html>";
}
else { die(); }