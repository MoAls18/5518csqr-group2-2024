<?php

require_once "../app/services/user_service.php";
require_once "../data/models/user_model.php";


class UserController{

    
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    
    public function createUser($email, $username, $password, $repeat): void {
        $this->userService->addUser($email, $username, $password, $repeat);
    }

    public function getUser($username): User {
        return $this->userService->getUserByUsername($username);
    }

    public function getUserHavingToken($token): User {
        return $this->userService->getUserByTokenNumber($token);
    }

    public function resetPassword($email){
        $this->userService->setNewUserTokenAndSendResetEmail($email);
    }

    public function updateUserPassword($username, $password, $confirm_password): bool{
        return $this->userService->updateUserPassword($username, $password, $confirm_password);
    }

    public function updateProfile($userId, $username, $email) {
        return $this->userService->updateProfile($userId, $username, $email);
    }
}