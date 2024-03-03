<?php
if (isset($_SESSION["username"])) {
	$user = $_SESSION["username"];
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
		<a href="profile.php" class="btn">Profile</a>
		<a href="registration.php" class="btn">Sign Up</a>
		<a href="login.php" class="btn">Login</a>
		<a href="logout.php" class="btn">Logout</a>

	</div>
	<div class="container">
		<h4>Refresh to get a new quote below! </h4>
    <?php
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://andruxnet-random-famous-quotes.p.rapidapi.com/?cat=famous&count=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: andruxnet-random-famous-quotes.p.rapidapi.com",
            "X-RapidAPI-Key: 1df49caa24msh5688e2ac5f1fdd7p117ddejsn193c1f37d620"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $quotes = json_decode($response, true);
        foreach ($quotes as $quote) {
            echo "<p>{$quote['quote']}</p>";
        }
    }
    ?>
</div>
</body>

</html>