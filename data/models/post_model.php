<?php 
class Post
{

    private $id;
    private $title;
    private $content;
    private $author_id;
    private $created_at;
    private $updated_at;

    public function __construct(int $id, string $title, string $content, int $author_id, string $created_at, string $updated_at)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author_id = $author_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function getAuthorID(): int
    {
        return $this->author_id;
    }
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
