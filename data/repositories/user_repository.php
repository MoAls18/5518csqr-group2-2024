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

    /**
     * Gets user by id.
     *
     * This function accesses the database to fetch data of a user by their id.
     *
     * @param  int $id id of the user
     * @return User
     **/
    public function getUserById(int $id): User
    {

        $query = "SELECT id, username, email, created_at, updated_at FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $user_data = $result->fetch_assoc();

        $user = new User(
            id: $user_data['id'],
            username: $user_data['username'],
            email: $user_data['email'],
            password: null, // password is set to null as retrieving the password in plaintext is a security risk
            created_at:$user_data['created_at'],
            updated_at: $user_data['updated_at']
        );

        return $user;
    }
  
    /**
     * Gets User by username
     *
     * Retrieves data of User from username
     *
     * @param  string $username username of site user
     * @return User
     **/
    public function getUserByUsername(string $username): User
    {
        $query = "SELECT id, username, email, created_at, updated_at FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $user_data = $result->fetch_assoc();

        $user = new User(
            id: $user_data['id'],
            username: $user_data['username'],
            email: $user_data['email'],
            password: null, // password is set to null as retrieving the password in plaintext is a security risk
            created_at:$user_data['created_at'],
            updated_at: $user_data['updated_at']
        );

        return $user;
    }
    
    /**
     * Deletes User from Database
     *
     * Deletes the user from the database based on their id.
     *
     * @param  int $id id of the User
     * @return void
     **/
    public function deleteUserById(int $id): void
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    public function deleteUserByUsername(string $username): void
    {
        $query = "DELETE FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $username);
        $stmt->execute();
    }

    public function updateUserPassword(User $user, string $password): void
    {
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $password, $user->getId());
        $stmt->execute();
    }
}

?>
