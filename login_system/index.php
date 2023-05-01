<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="rss/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
	<title>Login Page</title>
</head>
<body>
	<section>
		<form id="loginForm" action="php/action_login.php" method="post">
			<div class="img_container">
				<img id= "avatar_img" src="rss/ninja_avatar.png" alt="Avatar" class="avatar">
			</div>

			<h1>Hello, Ninja!</h1>
			<div class="input_container">
				<input type="text" placeholder="Username" name="username" id="username">

				<input type="password" placeholder="Password" name="psw" id="psw">

				<i class="fas fa-eye" id="showPassword"></i>

				<i class="fas fa-eye-slash" id="hidePassword"></i>

				<label>
					<input type="checkbox" checked="checked" name="remember">Remember me
				</label>

				<button id="loginButton" type="submit">Login</button>
			</div>

			<div id="form_message"></div>

			<div class="innertext">
				<span>Or login with:</span>
			</div>

			<div class="socials_login">
    			<a href="#" class="fb btn">
          			<i class="fab fa-facebook-f"></i><span> Facebook</span>
        		</a>
        		<a href="#" class="twitter btn">
          			<i class="fab fa-twitter"></i><span> Twitter</span>
        		</a>
        		<a href="#" class="google btn">
          			<i class="fab fa-google"></i><span> Google+</span>
        		</a>
        	</div>	

			<div class="links_container">
				<p class="forgot_psw"><a href="forgot_pw.php">Forgot password?</a></p>
				<p class="signup">Don't have an account? <a href="signup.php">Register Here</a>.</p>
			</div>
		</form>
	</section>
</body>
</html>