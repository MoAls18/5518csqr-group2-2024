<?php


require_once "config.php";

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeat'])) {
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$repeat = $_POST['repeat'];

	if (strlen($email) < 1 || strlen($email) > 100) {
		if (strlen($email) < 1)
			echo "email length too short";
		else
			echo "email length too long";
		exit();
	} else if (strpos($email, '@') == false) {
		echo "email syntax invalid";
		exit();
	} else if (strlen($password) < 8) {
		echo "password length too short";
		exit();
	} else if ($password !== $repeat) {
		echo "your passwords dont mathch";
		exit();
	}

	$hashing = password_hash($password, PASSWORD_DEFAULT);

	if ($stmt = $conn->prepare("INSERT INTO users(email,username, password) VALUES (?,?,?)")) {

		$stmt->bind_param("sss", $email, $username, $hashing);
		$stmt->execute();

		if ($stmt->insert_id == 0) {
			echo "data error";
			exit();
		}
		$stmt->close();
		echo "user registered successfully! ";
	}
}
?>
<DOCTYPE html>
	<html>

	<head>
		<link rel="stylesheet" href="./css/style.css">
	</head>

	<body>
		<div class="login-container">
			<h2>Sign Up</h2>
			<form action="registration.php" method="POST" style="border:1px solid #ccc">
				<div class="container">
					<p>Please fill in this form to create an account.</p>
					<hr>
					<div class="form-group">
						<label for="username"><b>Username</b></label>
						<input type="text" placeholder="Enter Username" name="username" required>
					</div>

					<div class="form-group">
						<label for="email"><b>Email</b></label>
						<input type="text" placeholder="Enter Email" name="email" required>
					</div>

					<div class="form-group">
						<label for="password"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" name="password" required>
					</div>

					<div class="form-group">
						<label for="repeat"><b>Repeat Password</b></label>
						<input type="password" placeholder="repeat Password" name="repeat" required>
					</div>
					<div class="form-group">
						<input type="submit" value="Sign up">
					</div>
					<div class="form-group">
						Already have an account?
					</div>
					<div class="form-group">
						<a href="login.php">
							<input type="button" value="Sign in" />
						</a>
					</div>
			</form>
		</div>
	</body>

	</html>