<?php

require_once "config.php";
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $query = "SELECT username FROM users WHERE token_number = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    echo $username;
    if(!$username){
        echo "invalid";
    }else{
        $_SESSION['username'] = $username; 
    }
}

if(isset($_POST['password']) && isset($_POST['confirm_password'])){
    $password = $_POST['password'];
    $confirm_password = $_POST['password'];

    if($password === $confirm_password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $username =  $_SESSION['username'];
        $query = "UPDATE users SET password = '$hashed_password' where username = '$username' LIMIT 1";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "Password changed successfully!";
        }else{
            echo $result;
        }

    }else{
        echo "Passwords don't match try again!";
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
        <h2>Reset password</h2>
        <form method="post" action="reset_password.php">
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
            <div class="form-group
            ">
                Back to  <a href="login.php"> login? </a>

            </div>
        </form>
    </div>
</body>

</html>