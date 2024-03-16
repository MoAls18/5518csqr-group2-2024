<?php
require_once "../app/helpers/util_functions.php";
require_once "../app/controllers/post_controller.php";
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$utilFunctions = new UtilFunctions();
$quotes = $utilFunctions->getNewQuoteFromApi();

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
            width: 80%;
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
        <h1>Welcome to Our Blog</h1>
        <p>Explore interesting articles and share your thoughts!</p>

    </div>
    <div class="container">
        <h4>Refresh to get a new quote below! </h4>
    <?php foreach ($quotes as $quote): ?>

                <div>
                    <p><?php echo $quote->getQuote(); ?></p>
                    <footer><?php echo $quote->getAuthor(); ?></footer>
                </div>

    <?php endforeach; ?>
</div>

        <div class="container">
        <hr>
            <?php 
            $postController = new PostController();

            $posts = $postController->getAllPosts();
                // Loop through the sample posts array to display posts
            if($posts) {
                foreach ($posts as $post) {
                    echo "<div class='card'>";
                    echo "<h2>" . $post->getTitle(). "</h2>";
                    echo "<p>" . $post->getContent() . "</p>";
                    echo "<p>Published on: " . $post->getCreatedAt(). "</p>";
                    echo "<a href='view_post.php?id=" . $post->getID() . "' class='read-more'>Read More</a>";
                    echo "</div>";
                }
            }else{
                echo "<h2>No posts yet.</h2>";

            }
            ?>
    </div>
</body>

</html>
