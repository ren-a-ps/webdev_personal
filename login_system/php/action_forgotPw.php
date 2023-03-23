<?php 
	session_start();
	include 'database.php';

	if (isset($_POST['submit'])) { // checks if button type submit is clicked
		$username = $_POST['username'];
		$email = $_POST['email'];

		// For checking of credentials
		$sql = "SELECT username, email FROM user_creds WHERE username = '$username'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result); // will always contain only one row since 'username' is unique

		// For error checking
		$errorEmpty = false;
		$errorUsername = false;
		$errorEmail = false;

		// Diretory to next page
		$nextDir = '';

		// For error checking
		if (empty($username) || empty($email)) {
			$errorEmpty = true;
			echo "<span>Fill in all fields!</span>";
		}
		elseif (mysqli_num_rows($result) == 0) {
			$errorUsername = true;
			echo "<span>Username does not exist. Please sign up!</span>";
		}
		elseif ($row['email'] != $email) {
			$errorEmail = true;
			echo "<span>Registered e-mail does not match!</span>";
		}
		else {	
			// posible imporvement: send temp password to email
			$nextDir = 'change_pw.php';
			$_SESSION['username'] = $username; // saves username to session
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
	$("#username, #email").removeClass("input_error");

	var errorEmpty = "<?php echo $errorEmpty; ?>";
	var errorUsername = "<?php echo $errorUsername; ?>";
	var errorEmail = "<?php echo $errorEmail; ?>";

	var nextDir = "<?php echo $nextDir; ?>";

	if (errorEmpty) {
		$('#form_message').addClass("message_error");
		$("#username, #email").addClass("input_error");
	}
	if (errorUsername) {
		$('#form_message').addClass("message_error");
		$("#username").addClass("input_error");
	}
	if (errorEmail) {
		$('#form_message').addClass("message_error");
		$("#email").addClass("input_error");
	}
	if (!errorEmpty && !errorUsername && !errorEmail) {
		$("#username, #email").val("");
		window.location.href = nextDir;
	}

</script>
