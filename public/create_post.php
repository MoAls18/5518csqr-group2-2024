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

$postController = new PostController();
if (isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_SESSION['userId'];
    $isCreated = $postController->createPost($title, $content, $author_id);
    if($isCreated) {
        echo "Created!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width"> -->
    <title>My Blog</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php require 'navbar.php'; ?> <!-- Include the navbar here -->
<div class="login-container">
        <h2>Create Post</h2>
        <form action="create_post.php" method="post">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" >
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" rows="10" cols="55" ></textarea>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Create">
            </div>
            <div class="form-group">
                <a href="index.php" class="btn">Go Back</a>
            </div>

        </form>
    </div>
</body>

</html>
