<?php 
	session_start();
	include 'database.php';

	if (isset($_POST['submit'])) { // checks if button type submit is clicked
		$temp_psw = $_POST['temp_psw'];
		$psw = $_POST['psw'];
		$re_psw = $_POST['re_psw'];
		$username = $_SESSION['username']; // gets the saved username from session

		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		// For checking of credentials
		$sql = "UPDATE user_creds SET pword = '$psw' WHERE username = '$username'";
		
		echo "<script>console.log('". $username . "')</script>";

		// For error checking
		$errorEmpty = false;
		$errorPassword = false;

		// For error checking
		if (empty($temp_psw) || empty($psw) || empty($re_psw)) {
			$errorEmpty = true;
			echo "<span>Fill in all fields!</span>";
		}
		elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
			$errorPassword = true;
			echo "<span>Password should be at least 8 characters in length and should include at least one uppercase letter, one lowercase letter, one number, and one special character!</span>";
		}
		elseif ($psw != $re_psw) {
			$errorPassword = true;
			echo "<span>New password doesn't match!</span>";
		}
		else {	
			$result = mysqli_query($conn, $sql);
			echo "<span>Password changed!</span>";
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
	$("#temp_psw, #psw, #re_psw").removeClass("input_error");

	var errorEmpty = "<?php echo $errorEmpty; ?>";
	var errorPassword = "<?php echo $errorPassword; ?>";

	if (errorEmpty) {
		$('#form_message').addClass("message_error");
		$("#temp_psw, #psw, #re_psw").addClass("input_error");
	}
	if (errorPassword) {
		$('#form_message').addClass("message_error");
		$("#psw, #re_psw").addClass("input_error");
	}
	if (!errorEmpty && !errorPassword) {
		$('#form_message').addClass("message_success");
		$("#temp_psw, #psw, #re_psw").val("");
	}

</script>
