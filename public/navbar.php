<!-- navbar.php -->
<html>
    <head>
        <style>
            /* styles.css */
.navbar {
    background-color: #333;
    overflow: hidden;
}

.navbar a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.navbar a:hover {
    background-color: #ddd;
    color: black;
}

    </style>

</head>
<body>
<!-- navbar.php -->
<div class="navbar">
    <a href="index.php">Home</a>
    <?php
    // Check if the user is logged in
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        // Show links for logged-in users
        echo '<a href="profile.php">Profile</a>';
        echo '<a href="create_post.php">Create Post</a>';
        echo '<a href="my_posts.php">My Posts</a>';
        echo '<a href="logout.php">Logout</a>';
    } else {
        // Show links for non-logged-in users
        echo '<a href="registration.php">Sign Up</a>';
        echo '<a href="login.php">Login</a>';
    }
    ?>
</div>

</body>
</html>