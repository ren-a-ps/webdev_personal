<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/styles_extras.css">
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
	<title>Sign Up Page</title>
</head>
<body>
	<section>
		<form id = "signUpForm" action="php/action_signup.php" method="post">
			<h1>Create Account</h1>

			<p class = "form_text">It's quick and easy.</p>

			<div class= "input_container">
				<input type="text" placeholder="First Name" name="firstname" id="firstname">

				<input type="text" placeholder="Last Name" name="lastname" id="lastname">

				<input type="text" placeholder="Username" name="username" id="uname">

				<input type="text" placeholder="Email" name="email" id="email">

				<input type="password" placeholder="Password" name="psw" id="psw">

				<i class="fas fa-eye" id="showPassword"></i>

				<i class="fas fa-eye-slash" id="hidePassword"></i>

				<button id="signUpButton" type="submit">Sign Up</button>
			</div>

			<div id="form_message"></div>

			<div class="links_container">
				<p class="login_page">Already have an account? <a href="index.php">Login Here</a>.</p>
			</div>
		</form>
	</section>
</body>
</html>