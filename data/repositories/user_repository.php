<?php
require_once "../models/user_model.php";

class UserRepository
{
    private $conn;

    /**
     * @param mysqli $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Adds User to blog database.
     *
     * This function takes a User class created through forms in the PL and BLL and adds it into the database.
     *
     * @param  User $user A variable of type User 
     * @return bool
     **/
    public function addUser(User $user): bool
    {
        $query = "INSERT INTO users(username, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $user->getUsername(), $user->getEmail(), $user->getPassword(), $user->getCreatedAt(), $user->getUpdatedAt());
        return $stmt->execute();
    }
}

?>
