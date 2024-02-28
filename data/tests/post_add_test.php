<?php

require_once "../config/config.php";
require_once "../models/post_model.php";
require_once "../repositories/post_repository.php";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$current_timestamp = date(format: "Y-m-d H:i:s");

$post = new Post(
    id: 2,
    title: "POST TITLE 2",
    content:"Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint consectetur cupidatat.", 
    author_id: 2,
    created_at: $current_timestamp, 
    updated_at: $current_timestamp
);

$postRepository = new PostRepository(conn: $conn);

$postRepository->addPost($post);

