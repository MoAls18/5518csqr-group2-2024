<?php

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//we use the rquire once to move the functions fron the config file to this file //
require_once "../app/controllers/user_controller.php";

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeat'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat = $_POST['repeat'];
    $userController = new UserController();
    $userController->createUser($email, $username, $password, $repeat);
    
}
?>
<DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="./css/style.css"> 
    </head>
<!-- class login-container is a function that i built to use the css code into this block of the code -->
    <body>
    <?php require 'navbar.php'; ?> <!-- Include the navbar here -->
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
                        <a href="login.php">log in</a> here
                    </div>
            </form>
        </div>
    </body>

    </html>
