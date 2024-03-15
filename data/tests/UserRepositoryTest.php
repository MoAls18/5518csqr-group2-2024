<?php

use PHPUnit\Framework\TestCase;
require __DIR__ . "/../repositories/user_repository.php";
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'blog');

class UserRepositoryTest extends TestCase
{
    // this function adds a test user to the database to test UserRepository functions.
    protected function setUp(): void
    {
        // establishing database connection
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);

        // test user data
        $current_timestamp = date(format: "Y-m-d H:i:s");
        $testUsername = "username";
        $testPass = "password";
        $testEmail = "e@email.com";
        $testToken = "12345";
        $testId = 1;
    

        $testUser = new User(id: $testId, username: $testUsername, password: $testPass, token_number: $testToken, email: $testEmail, created_at: $current_timestamp, updated_at: $current_timestamp);
        $userRepository->addUser(user: $testUser);
    }
    // this function deletes the test user created and resets the database 
    // tables AUTO_INCREMENT value.
    protected function tearDown(): void
    {
    
        // establishing database connection
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);

        $query = "DELETE FROM users";
        mysqli_query($conn, $query);
        $query = "ALTER TABLE users AUTO_INCREMENT = 1";
        mysqli_query($conn, $query);
    }

    public function testAddUser(): void
    {

        // establishing database connection
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);

        // test user data
        $current_timestamp = date(format: "Y-m-d H:i:s");
        $testUsername = "username2";
        $testPass = "password";
        $testEmail = "e@email.com";
        $testToken = "123456";
        $testId = null;
    
        $testUser = new User(id: $testId, username: $testUsername, password: $testPass, token_number: $testToken, email: $testEmail, created_at: $current_timestamp, updated_at: $current_timestamp);
        $result = $userRepository->addUser(user: $testUser);
        $this->assertTrue($result);
        
    }
    
    public function testGetUserById(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);

        // test user data
        $current_timestamp = date(format: "Y-m-d H:i:s");
        $testUsername = "username";
        $testEmail = "e@email.com";
        $testId = 1;

        $result = $userRepository->getUserById(id: $testId);

        $resultUserTest = new User(id: $testId, username: $testUsername, password: "password", token_number: "12345", email: $testEmail, created_at: $current_timestamp, updated_at: $current_timestamp);

        $this->assertEqualsCanonicalizing($resultUserTest, $result, "FAILED: USERS DID NOT MATCH.");
    }
    
    public function testGetUserByUsername(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);

        // test user data
        $current_timestamp = date(format: "Y-m-d H:i:s");
        $testUsername = "username";
        $testEmail = "e@email.com";
        $testId = 1;

        $result = $userRepository->getUserByUsername(username: $testUsername);
        $expected = new User(id: $testId, username: $testUsername, password: "password", token_number: "12345", email: $testEmail, created_at: $current_timestamp, updated_at: $current_timestamp);
    
        $this->assertEqualsCanonicalizing($expected, $result, "FAILED: USERS DID NOT MATCH.");
    }

    public function testDeleteUserById(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);
        
        $testId = 1;
        $result = $userRepository->deleteUserById($testId);
        $this->assertTrue($result);
    }
    public function testDeleteUserByUsername(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);
        
        $testUsername = "username";
        $result = $userRepository->deleteUserByUsername($testUsername);
        $this->assertTrue($result);
    }

    public function testUpdateUserPassword(): void
    {

        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);

        
        $testusername = "username";
        $newPassword = "newpassword";
        
        $result = $userRepository->updateUserPassword($testusername, $newPassword);
        $this->assertTrue($result);
    }

    public function testUserExists(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);
        
        $testuser = "username";
        $testemail = "e@email.com";
        $result = $userRepository->userExists($testuser, $testemail);
        $this->assertTrue($result);
      
    }
    public function testUpdateProfile(): void
    {
        $conn = new mysqli(hostname: DB_HOST, username: DB_USER, password: DB_PASS, database: DB_NAME);
        $userRepository = new UserRepository(conn: $conn);

        $newusername = "newuser";
        $newemail = "newemail@email.com";

        $result = $userRepository->updateProfile(1, $newusername, $newemail);
        $testUserUsername = $userRepository->getUserById(1)->getUsername();
        $testUserEmail = $userRepository->getUserById(1)->getEmail();
        $resultlist = [$result, $testUserUsername, $testUserEmail];
        $this->assertEqualsCanonicalizing([true, $newusername, $newemail], $resultlist);
    }
}
