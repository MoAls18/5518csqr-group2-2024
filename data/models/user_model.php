<?php

/**
 * User Class
 *
 * This class represents a model of a record of a user from the users table in 
 * the database.
 */
class User
{
  
    private $id;
    private $username;
    private $token_number;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;

    /**
     * @param int    $id
     * @param string $username
     * @param string $token_number
     * @param string $email
     * @param string $password
     * @param string $created_at
     * @param string $updated_at
     */
    public function __construct($id, $username ,$token_number, $email, $password, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->username = $username;
        $this->token_number = $token_number;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    

    /**
     * Gets Id of the user.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * Gets the username of the User
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Gets the password reset token associated with the user.
     */
    public function getTokenNumber(): string
    {
        return $this->token_number;
    }

    /**
     * Gets the hashed password of the User
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Gets the email of the User
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets the time the User was created.
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Gets the time the User information was updated.
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
  
}

?>
