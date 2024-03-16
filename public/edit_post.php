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

if(isset($_GET['id'])) {
    $postId = $_GET['id'];
    $post = $postController->getPostById($postId);
    
    if($post && $post->getAuthorId() == $userId) {
        // Initialize form values with post data
        $title = $post->getTitle();
        $content = $post->getContent();
    }else{
        // User is not authorized to edit this post
        echo "You are not authorized to edit this post.";
    }
}
if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['post_id'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $postId = $_POST['post_id']; // Retrieve the post ID from the hidden input field
    $post = $postController->getPostById($postId);
    if ($post && $post->getAuthorId() == $userId) {
        $isUpdated = $postController->updatePost($post, $title, $content);
        if ($isUpdated) {
            echo '<script>alert("Post updated!")
        window.location.href="my_posts.php";
        </script>';
        }
    } else {
        // User is not authorized to edit this post or post does not exist
        echo "You are not authorized to edit this post or the post does not exist.";
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
        <h2>Update Post</h2>
        <form action="edit_post.php" method="post">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" rows="10" cols="55"><?php echo isset($content) ? $content : ''; ?></textarea>
            </div>
        <!-- Add a hidden input field to hold the post ID -->
        <input type="hidden" name="post_id" value="<?php echo isset($postId) ? $postId : ''; ?>">

            
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
