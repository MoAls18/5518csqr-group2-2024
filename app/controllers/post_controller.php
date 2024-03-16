<?php

require_once "../app/services/post_service.php";
require_once "../data/models/post_model.php";


class PostController{

    
    private $postService;

    public function __construct()
    {
        $this->postService = new PostService();
    }
    
    public function getAllPosts() {
        return $this->postService->getAllPosts();
    }


    public function createPost($title, $content, $author_id){
        return $this->postService->createPost($title, $content, $author_id);
    }

    public function updatePost($post, $title, $content){
        return $this->postService->updatePost($post, $title, $content);
    }
    public function getPostsByUserId($userId){
        return $this->postService->getPostsByUserId($userId);
    }

    public function getPostById($id){
        return $this->postService->getPostById($id);
    }

    public function deletePost($post){
        return $this->postService->deletePost($post);
    }
    
}