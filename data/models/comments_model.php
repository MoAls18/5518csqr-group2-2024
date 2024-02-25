<?php

/**
 * Comment Class
 * This class holds information for the comments records in the database and is
 * used to interact with the BLL.
 * The class doesn't contain any setters for security reasons as all updates are
 * handled by the repository classes.
 */
class Comment
{
    private $id;
    private $content;
    private $user_id;
    private $post_id;
    private $created_at;
    private $updated_at;
  
    /** 
     * Comment constructor
     */
    public function __construct(int $id, string $content, int $user_id, int $post_id, string $created_at, string $updated_at)
    {
        $this->id = $id;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * Get the id of the comment.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the content of the comment.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Gets the id of the User that posted the comment.
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Gets the id of the Post that posted the comment.
     *
     * @return int
     */
    public function getPostId(): int
    {
        return $this->post_id;
    }
  
    /**
     * Gets the time stamp the comment was created at.
     *
     * @return int
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Gets the time stamp the comment was updated at.
     *
     * @return int
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
