<?php
class User
{
  
    private $id;
    private $username;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;

    /**
     * @param int    $id
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $created_at
     * @param string $updated_at
     */
    public function __construct($id, $username, $email, $password, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getUsername(): string
    {
        return $this->username;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getEmail(): string
    {
        return $this->email;
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

?>
