<?php 
	include 'database.php';

	if (isset($_POST['submit'])) { // Checks if button type submit is clicked
		// Gets the passed variable from the js file
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		// For checking if email and username already exist
		$sql = "SELECT * FROM user_creds WHERE username = '$username'";
		$resultUsername = mysqli_query($conn, $sql);

		$sql = "SELECT * FROM user_creds WHERE email = '$email'";
		$resultEmail = mysqli_query($conn, $sql);

		// For error checking
		$errorEmpty = false;
		$errorEmail = false;
		$errorPassword = false;
		$errorUsername = false;

		// For Error Checking
		if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password)) {
			$errorEmpty = true;
			echo "<span>Fill in all fields!</span>";
		}
		
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorEmail = true;
			echo "<span>Enter valid e-mail address!</span>";
		}
		
		elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
			$errorPassword = true;
			echo "<span>Password should be at least 8 characters in length and should include at least one uppercase letter, one lowercase letter, one number, and one special character!</span>";
		}
		elseif (strlen($username) < 5) {
			$errorUsername = true;
			echo "<span>Username should be at least 5 characters in length!</span>";
		}
		
		// For checking if email and username already exist
		elseif (mysqli_num_rows($resultUsername) > 0) {
			$errorUsername = true;
			echo "<span>Username already exist!</span>";
		}

		elseif (mysqli_num_rows($resultEmail) > 0) {
			$errorEmail = true;
			echo "<span>Email already registered!</span>";
		}

		// If no error
		else { 
			// Inserts data into user_creds table
			$sql = "INSERT INTO user_creds (firstname, lastname, username, email, pword)
			VALUES ('$firstname','$lastname','$username','$email','$password')";

			// Variable 'conn' is from databas.php
			// mysqli_query() function performs a query against a database
			if (mysqli_query($conn, $sql)) { 
				echo "<span>Sign up successful. You are now a ninja!</span>";
			}
			else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		//Closes connection
		mysqli_close($conn);
	}
	else {
		echo "There was an error!";
	}

?>

<script>
	$('#form_message').removeClass("message_error");
	$("#firstname, #lastname, #uname, #email, #psw").removeClass("input_error");

	var errorEmpty = "<?php echo $errorEmpty; ?>";
	var errorEmail = "<?php echo $errorEmail; ?>";
	var errorPassword = "<?php echo $errorPassword; ?>";
	var errorUsername = "<?php echo $errorUsername; ?>";

	if (errorEmpty) {
		$('#form_message').addClass("message_error");
		$("#firstname, #lastname, #uname, #email, #psw").addClass("input_error");
	}
	if (errorEmail) {
		$('#form_message').addClass("message_error");
		$("#email").addClass("input_error");
	}
	if (errorPassword) {
		$('#form_message').addClass("message_error");
		$("#psw").addClass("input_error");
	}
	if (errorUsername) {
		$('#form_message').addClass("message_error");
		$("#uname").addClass("input_error");
	}
	if (!errorEmpty && !errorEmail && !errorPassword && !errorUsername){
		$('#form_message').addClass("message_success");
		$("#firstname, #lastname, #uname, #email, #psw").val("");
	}

</script>