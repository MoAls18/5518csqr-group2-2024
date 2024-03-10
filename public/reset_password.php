<?php
session_start();
require_once "../app/controllers/user_controller.php";
$userController = new UserController();

if(isset($_GET['token'])){
    $token = $_GET['token'];
	$username = $userController->getUserHavingToken($token)->getUsername();
    if(!$username){
        echo "invalid";
    }else{
        $_SESSION['username'] = $username; 
    }
}

if(isset($_POST['password']) && isset($_POST['confirm_password'])){
    $password = $_POST['password'];
    $confirm_password = $_POST['password'];
    $username =  $_SESSION['username'];
    $result = $userController->updateUserPassword($username, $password, $confirm_password);
    if($result){
        echo '<script>alert("Your password is changed successfully you can now login!")
        window.location.href="login.php";
        </script>'; 
    }else{
        echo "failed to updated password";
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