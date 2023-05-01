<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="rss/favicon.ico">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/styles_extras.css">
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
	<title>Forgot Password</title>
</head>
<body>
	<section>
		<form id = "forgotPasswordForm" action="action_forgotPw.php" method="post">
			<h1>Forgot Password?</h1>

			<p class = "form_text">Enter your username and email below to reset your password. We'll send a new password to your email.</p>

			<div class="input_container">
				<input type="text" placeholder="Username" name="username" id="username">

				<input type="text" placeholder="Email" name="email" id="email">

				<button id="forgotPasswordButton" type="submit">Send New Password</button>
			</div>

			<div id="form_message"></div>

			<div class="links_container">
				<p class="login_page">Return to <a href="index.php">login page</a>.</p>
			</div>
		</form>
	</section>
</body>
</html>