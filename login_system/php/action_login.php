<?php 
	session_start();
	include 'database.php';

	if (isset($_POST['submit'])) { // checks if button type submit is clicked
		$username = $_POST['username'];
		$password = $_POST['password'];

		// For checking of credentials
		$sql = "SELECT username, pword FROM user_creds WHERE username = '$username'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result); // will always contain only one row since 'username' is unique

		// For erroe checking
		$errorEmpty = false;
		$errorUsername = false;
		$errorPassword = false;

		if (empty($username) || empty($password)) {
			$errorEmpty = true;
			echo "<span>Fill in all fields!</span>";
		}
		elseif (mysqli_num_rows($result) == 0) {
			$errorUsername = true;
			echo "<span>Username does not exist. Please sign up!</span>";
		}
		elseif ($row['pword'] != $password) {
			$errorPassword = true;
			echo "<span>Password doesn't match!</span>";
		}
		else {
			
			// Redirect to next page here
			echo "<span>Login successful.</span>";
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
	$("#username, #psw").removeClass("input_error");

	var errorEmpty = "<?php echo $errorEmpty; ?>";
	var errorUsername = "<?php echo $errorUsername; ?>";
	var errorPassword = "<?php echo $errorPassword; ?>";

	if (errorEmpty) {
		$('#form_message').addClass("message_error");
		$("#username, #psw").addClass("input_error");
	}
	if (errorUsername) {
		$('#form_message').addClass("message_error");
		$("#username").addClass("input_error");
	}
	if (errorPassword) {
		$('#form_message').addClass("message_error");
		$("#psw").addClass("input_error");
	}

	if (!errorEmpty && !errorUsername && !errorPassword) {
		$('#form_message').addClass("message_success");
		$("#username, #psw").val("");
	}

</script>
