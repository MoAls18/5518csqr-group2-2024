<?php


// Check if user is already logged in, redirect to home page if true
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    //what is the use of header
    header("location: index.php");
    exit;
}

require_once "config.php";


if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the hashed password from the database
    $query = "SELECT password, email FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the password
    echo $hashed_password;
    if (password_verify($password, $hashed_password)) {
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;

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