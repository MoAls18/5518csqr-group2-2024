<?php

/**
 * Post Repository
 * 
 * This Post Repository interacts with the database to perform CRUD operations 
 * on the Post table.
 */
class PostRepository
{
    private $conn;

    /** 
     * @param mysqli $conn connection to database.
     */

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Adds Post to database
     *
     * This function takes in a Post created in the PL and BLL and adds it to the database.
     *
     * @param  Post $post A Post object.
     * @return void 
     **/
    public function addPost(Post $post): void
    {
        //TODO: Add error handling for invalid author_id.
        $query = "INSERT INTO posts (title, content, author_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiss", $post->getTitle(), $post->getContent(), $post->getAuthorID(), $post->getCreatedAt(), $post->getUpdatedAt());
        $stmt->execute();
    }

    public function getPostById(int $id): Post
    {
        $query = "SELECT id, title, content, author_id, created_at, updated_at FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }
        $post_data = $result->fetch_assoc();

        $post = new Post(
            id: $post_data['id'],
            title: $post_data['title'],
            content: $post_data['content'],
            author_id: $post_data['author_id'],
            created_at: $post_data['created_at'],
            updated_at: $post_data['updated_at']
        );
        return $post;

    }
    public function getPostByTitle(string $title): Post
    {

        $query = "SELECT id, title, content, author_id, created_at, updated_at FROM posts WHERE title = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }
        $post_data = $result->fetch_assoc();

        $post = new Post(
            id: $post_data['id'],
            title: $post_data['title'],
            content: $post_data['content'],
            author_id: $post_data['author_id'],
            created_at: $post_data['created_at'],
            updated_at: $post_data['updated_at']
        );
        return $post;

    }
    public function getPostByAuthorId(int $author_id): Post
    {
        $query = "SELECT id, title, content, author_id, created_at, updated_at FROM posts WHERE author_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $author_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }
        $post_data = $result->fetch_assoc();

        $post = new Post(
            id: $post_data['id'],
            title: $post_data['title'],
            content: $post_data['content'],
            author_id: $post_data['author_id'],
            created_at: $post_data['created_at'],
            updated_at: $post_data['updated_at']
        );

        return $post;
    }
    public function updateTitle(Post $post, string $title): void
    {
        $query = "UPDATE posts SET title = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $title, $post->getID());
        $stmt->execute();

    }
  
}
