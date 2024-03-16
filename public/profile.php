<?php

require_once "../app/controllers/user_controller.php";
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    echo '<script>alert("Please log in before accessing this page!")
    window.location.href="index.php";
    </script>'; 
}
$userController = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    $newUsername = $_POST['username'] ?? '';
    $newEmail = $_POST['email'] ?? '';

    $result = $userController->updateProfile($userId, $newUsername, $newEmail);

    if ($result) {
        echo '<script>alert("Profile information updated!")
    </script>'; 
        // Update session data if needed
        $_SESSION['username'] = $newUsername;
        $_SESSION['email'] = $newEmail;
    } else {
        echo "Error updating information";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<?php require 'navbar.php'; ?> <!-- Include the navbar here -->
<body>
    <div class="login-container">
        <h2>User Profile</h2>
        <form action="profile.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
            </div>

            <div class="form-group">
            <a href="forget_password.php">
                <input type="button" value="Change password" />
            </a>
            </div>
            <div class="form-group">
                <input type="submit" value="Update">
            </div>
            <div class="form-group">
                <a href="index.php" class="btn">Go Back</a>

            </div>

        </form>
    </div>
</body>

</html>
