<!-- delete_post.php -->
<?php
require_once "../app/controllers/post_controller.php";
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$userId = $_SESSION['userId']; // Make sure to sanitize and validate this value


if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $postController = new PostController();
    // Check if the logged-in user is the author of the post
    $post = $postController->getPostById($post_id);
    if ($post && $post->getAuthorId() == $userId) {
        // Delete the post
        $success = $postController->deletePost($post);
        if ($success) {
            // Post deleted successfully, redirect to My Posts page
            header("Location: my_posts.php");
            exit();
        } else {
            // Error occurred during deletion
            echo "Error deleting post.";
        }
    } else {
        // User is not authorized to delete this post
        echo "You are not authorized to delete this post.";
    }
} else {
    // Post ID not provided
    echo "Post ID not provided.";
}
?>
