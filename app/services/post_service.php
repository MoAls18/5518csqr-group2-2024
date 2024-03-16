<?php
require_once "../data/models/post_model.php";
require_once "../data/repositories/post_repository.php";
require_once "../data/config/config.php";

class PostService{
    private $postRepository;
    public function __construct()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if ($conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $this->postRepository = new PostRepository($conn);
    }

    public function getAllPosts() {
        return $this->postRepository->getAllPosts();
    }

    public function createPost($title , $content, $author_id): bool {
        $current_timestamp = date(format: "Y-m-d H:i:s");
        $post = new Post(
            title: $title,
            content: $content, 
            author_id: $author_id,
            created_at: $current_timestamp, 
            updated_at: $current_timestamp
        );
        return $this->postRepository->addPost($post);
    }

    public function updatePost($post, $title , $content): bool {
        
        return $this->postRepository->updatePost($post,$title , $content);
    }

    public function getPostsByUserId($userId){
        return $this->postRepository->getPostsByUserId($userId);
    }

    public function getPostById($id){
        return $this->postRepository->getPostById($id);
    }

    public function deletePost($post){
        return $this->postRepository->deletePost($post);
    }
}
?>