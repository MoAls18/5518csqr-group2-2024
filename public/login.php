<?php
require_once "../app/controllers/user_controller.php";
//session_start();
// Check if user is already logged in, redirect to home page if true
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    //what is the use of header
    echo '<script>alert("You are already logged in!")
    window.location.href="index.php";
    </script>'; 
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userController = new UserController();
	$user = $userController->getUser($username);
    

    // Verify the password
    if (password_verify($password, $user->getPassword())) {
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["email"] = $user->getEmail();
        $_SESSION["userId"] = $user->getId();
        
        // Redirect user to home page
        header("location: index.php");
    } else {
        echo "Fail"; // Password is incorrect
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
            <div class="form-group
            ">
                Don't have an account? <a href="registration.php"> Sign up </a> here.

            </div>
        </form>
    </div>
</body>

</html>