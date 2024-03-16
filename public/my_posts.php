<?php
require_once "../app/controllers/post_controller.php";
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    echo '<script>alert("Please log in before accessing this page!")
    window.location.href="index.php";
    </script>'; 
}
$userId = $_SESSION['userId']; 

$postController = new PostController();
$posts = $postController->getPostsByUserId($userId);

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
            width: 50%;
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
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h2 {
            margin-top: 0;
        }
        .card p {
            margin-bottom: 10px;
        }
        .read-more {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
<?php require 'navbar.php'; ?> <!-- Include the navbar here -->
<div class="container">
<h2>My Posts</h2>
    <?php
    // Display posts
    if($posts) {
        foreach ($posts as $post) {
            echo "<div class='card'>";
            echo "<h2>" . $post->getTitle() . "</h2>";
            echo "<p>" . $post->getContent() . "</p>";
            echo "<p>Published on: " . $post->getCreatedAt() . "</p>";
            echo "<a class= 'btn' href='edit_post.php?id=" . $post->getId() . "' >Edit</a>";
            echo "<a class= 'btn' href='delete_post.php?id=" . $post->getId() . "' >Delete</a>";
            echo "</div>";
        }
    }
    else{
        echo "<h2>you don't have any posts yet.</h2>";
    }
    ?>
</div>
</body>
</html>
