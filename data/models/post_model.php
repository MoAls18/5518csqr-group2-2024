<?php 
class Post
{

    private $id;
    private $title;
    private $content;
    private $author_id;
    private $created_at;
    private $updated_at;

    public function __construct(string $title, string $content, int $author_id, string $created_at, string $updated_at)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author_id = $author_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * Gets the ID of the Post object.
     *
     * @return int
     */
    public function getID(): int
    {
        return $this->id;
    }

    /**
     * Gets the title of the Post object.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Gets the content of the Post object.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Gets the author id of the Post object.
     *
     * @return int
     */
    public function getAuthorID(): int
    {
        return $this->author_id;
    }

    /**
     * Gets the time the post was created at. 
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Gets the time the post was updated at. 
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setID($id): void
    {
        $this->id = $id;
    }
    
}
