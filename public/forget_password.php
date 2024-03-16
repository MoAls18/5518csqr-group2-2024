<?php

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../app/controllers/user_controller.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $userController = new UserController();
    $userController->resetPassword($email);
}
?>
<html>

<head>

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php require 'navbar.php'; ?> <!-- Include the navbar here -->
    <div class="login-container">
        <form action="forget_password.php" method="POST">
            <h4>Forgot your password? Please enter your email to recover it</h2>
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div>
        </form>
    </div>
</body>

</html>
