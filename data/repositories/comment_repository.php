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
    public function getCommentById(int $id)
    {
        // code...
    }
  
}
