<?php

use PHPUnit\Framework\TestCase;
require __DIR__ . "/../repositories/post_repository.php";
require __DIR__ . "/../repositories/user_repository.php";
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'blog');

class PostRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $postRepository = new PostRepository(conn: $conn);
        $userRepository = new UserRepository(conn: $conn);

        // test author data
        $current_timestamp = date(format: "Y-m-d H:i:s");
        $testUsername = "username";
        $testPass = "password";
        $testEmail = "e@email.com";
        $testToken = "12345";
        $testId = 1;
        $testUser = new User(id: $testId, username: $testUsername, password: $testPass, token_number: $testToken, email: $testEmail, created_at: $current_timestamp, updated_at: $current_timestamp);

        $userRepository->addUser(user: $testUser);
    
        // test post data
        $postId = 1;
        $postTitle = "Title";
        $postContent = "Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.";
        $author_id = 1;

        $post = new Post(id: $postId, title: $postTitle, content: $postContent, author_id: $author_id, created_at: $current_timestamp, updated_at: $current_timestamp);
        $postRepository->addPost($post);
    }
    protected function tearDown(): void
    {
        
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);

        $query = "DELETE FROM posts";
        mysqli_query($conn, $query);
        $query = "DELETE FROM users";
        mysqli_query($conn, $query);
        $query = "ALTER TABLE users AUTO_INCREMENT = 1";
        mysqli_query($conn, $query);
        $query = "ALTER TABLE posts AUTO_INCREMENT = 1";
        mysqli_query($conn, $query);
    } 
    
    public function testAddPost(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $postRepository = new PostRepository(conn: $conn);
        $current_timestamp = date(format: "Y-m-d H:i:s");
    
        // test post data
        $postId = 1;
        $postTitle = "Title";
        $postContent = "Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.";
        $author_id = 1;

        $post = new Post(id: $postId, title: $postTitle, content: $postContent, author_id: $author_id, created_at: $current_timestamp, updated_at: $current_timestamp);
        $result = $postRepository->addPost($post);
        $this->assertTrue($result);
    }
}
