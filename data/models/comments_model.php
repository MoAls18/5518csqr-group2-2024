<?php

class Comment
{
    private $id;
    private $content;
    private $user_id;
    private $post_id;
    private $created_at;
    private $updated_at;
  
    public function __construct(int $id, string $content, int $user_id, int $post_id, string $created_at, string $updated_at)
    {
        $this->id = $id;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
