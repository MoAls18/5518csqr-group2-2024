<?php

/**
 * CommentRepository
 *
 * This class handles all interactions between the comment models and the database.
 * It performs CRUD operations on the comment to integrate with the database.
 */
class CommentRepository
{
    private $conn;

    /**
     * CommentRepository Constructor
     */
    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Adds Comment to the database.
     *
     * This function takes a comment created in the PL and BLL layers and adds 
     * it to the database.
     *
     * @param  Comment $comment A comment model
     * @return void
     **/
    public function addComment(Comment $comment): void
    {
        $query = "INSERT INTO comments (id, content, user_id, post_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "isiiss", 
            $comment->getId(),
            $comment->getContent(), 
            $comment->getUserId(), 
            $comment->getPostId(), 
            $comment->getCreatedAt(), 
            $comment->getUpdatedAt()
        );

        $stmt->execute();
        
    }

    /**
     * Gets comment by id.
     *
     * This function accesses the database to retrieve the comment by its id value.
     *
     * @param  int $id ID of the comment
     * @return Comment
     **/
    public function getCommentById(int $id): Comment
    {
        // parameterized query to get all data to create a Comment object
        $query = "SELECT id, content, user_id, post_id, created_at, updated_at FROM comments WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result(); // gets the result set of the executed statement

        // returns null if the result set is empty
        if ($result->num_rows == 0) {
            return null;
        }
        
        // Create a Comment object from the result set
        $comment_data = $result->fetch_assoc();
        $comment = new Comment(
            id: $comment_data['id'],
            content: $comment_data['content'],
            user_id: $comment_data['user_id'],
            post_id: $comment_data['post_id'],
            created_at: $comment_data['created_at'],
            updated_at: $comment_data['updated_at']
        );
         return $comment;
        
    }
  
}
