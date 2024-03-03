<?php

require_once "config.php";

if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header('location: index.php');
}
$new_username = '';
$new_email = '';
$new_password = '';
$confirm_password = '';

$query = "UPDATE users SET";

if (isset($_POST['username'])) {
    $new_username = $_POST['username'];
    $query = $query . " username= '$new_username'";
    $_SESSION['username'] = $new_username;
}
if (isset($_POST['email'])) {
    $new_email = $_POST['email'];
    $query = $query . ", email= '$new_email'";
    $_SESSION['email'] = $new_email;
}
$should_update_password = false;
if (isset($_POST['password']) && isset($_POST['password'])) {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($new_password !== '' && $confirm_password !== '') {
        if ($new_password === $confirm_password) {
            $should_update_password = true;
            $hashing = password_hash($new_password, PASSWORD_DEFAULT);
            $query = $query . ", password='$hashing'";
        } else {
            echo "Error: password don't match try again !";
        }
    }
}
if ($new_username !== '' || $new_email !== '' || $should_update_password) {
    if ($conn->query($query) === TRUE) {
        echo "Profile information updated!";
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

<body>
    <div class="profile-container">
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
                <label>New Password</label>
                <input type="password" name="password" placeholder="***************">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" placeholder="***************">
            </div>
            <!-- <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control-file">
            </div> -->
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