<?php
if(isset($_SESSION["username"])){
$user =$_SESSION["username"];
 echo "the person in session is $user ";
} else {
	echo "the person in session is guest ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width"> -->
	<title>My Blog</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f5f5f5;
		}

		.container {
			/* move the page into the middle */
			width: 80%;
			margin: 50px auto;
			text-align: center;
		}

		.btn {
			/* change the style of the buttons */
			display: inline-block;
			padding: 10px 20px;
			background-color: #007bff;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
			margin: 10px;
		}

		.btn:hover {
			background-color: #0056b3;
		}
	</style>
</head>

<body>
	<div class="container">
		<h1>Welcome to Our Blog</h1>
		<p>Explore interesting articles and share your thoughts!</p>
		<a href="registration.php" class="btn">Sign Up</a>
		<a href="login.php" class="btn">Login</a>
		<a href="logout.php" class="btn">Logout</a>
		
	</div>
</body>

</html>