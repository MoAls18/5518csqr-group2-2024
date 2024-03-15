<?php
class UserValidator
{
    public function __construct(){

    }

    public function verifyUserCreation($email, $username, $password, $repeat){
        if (strlen($email) < 1 || strlen($email) > 100) {
            if (strlen($email) < 1)
                echo "email length too short";
            else
                echo "email length too long";
            exit();
        } else if (strpos($email, '@') == false) {
            echo "email syntax invalid";
            exit();
        } else if (strlen($password) < 8) {
            echo "password length too short";
            exit();
        } else if ($password !== $repeat) {
            echo "your passwords dont mathch";
            exit();
        }
    }
}

?>
