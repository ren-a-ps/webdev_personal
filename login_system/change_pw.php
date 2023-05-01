<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="rss/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/styles_extras.css">
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
	<title>Forgot Password</title>
</head>
<body>
	<section>
		<form id = "changePasswordForm" action="action_changePw.php" method="post">
			<h1>Forgot Password?</h1>

			<p class = "form_text">Please fill in the fields to change you password.</p>

			<div class="input_container">
				<input type="password" placeholder="Temporary Password" name="temp_psw" id="temp_psw">

				<input type="password" placeholder="Password" name="psw" id="psw">

				<input type="password" placeholder="Re-enter Password" name="re_psw" id="re_psw">

				<label>
					<input type="checkbox" name="showPsw" id="checkboxShowPsw">Show Password
				</label>

				<button id="changePasswordButton" type="submit">Change Password</button>
			</div>

			<div id="form_message"></div>

			<div class="links_container">
				<p class="login_page">Return to <a href="index.php">login page</a>.</p>
			</div>
		</form>
	</section>
</body>
</html>