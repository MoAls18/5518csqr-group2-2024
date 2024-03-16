<?php
require_once "../data/models/user_model.php";
require_once "../data/repositories/user_repository.php";
require_once "../data/config/config.php";
require_once "../app/validators/user_validator.php";
require "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "../vendor/phpmailer/phpmailer/src/SMTP.php";
require "../vendor/phpmailer/phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;


class UserService
{
    private $userRepository;
    private $userValidator;

    public function __construct()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if ($conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $this->userRepository = new UserRepository($conn);
        $this->userValidator = new UserValidator();
    }
    
    public function addUser($email, $username, $password, $repeat): bool
    {
        $userExists = $this->userRepository->userExists($username, $email);
        if($userExists) {
            echo "Error: username or email already exists try another one";
            return false;
        }else{
            $this->userValidator->verifyUserCreation($email, $username, $password, $repeat);
            $current_timestamp = date(format: "Y-m-d H:i:s");
            $user = new User(rand(), $username, $email, $password, $current_timestamp, $current_timestamp);
            return $this->userRepository->addUser($user);
        }

    }

    public function getUserByUsername($username)
    {
        return $this->userRepository->getUserByUsername($username);
    }

    public function getUserByTokenNumber($token)
    {
        return $this->userRepository->getUserByTokenNumber($token);
    }
    
    public function setNewUserTokenAndSendResetEmail($email)
    {
        
        $user = $this->userRepository->getUserByEmail($email);
        if($user) {
            $token = md5(rand());
            $isUpdated = $this->userRepository->updateUserToken($user, $token);
            if($isUpdated) {
                $this->sendResetPasswordEmail($user->getEmail(), $token);
            }else{
                echo "Failed to set new token";
            }
        }else{
            echo "No user is registered with this email address!";
        }
    }

    public function updateUserPassword($username, $password, $confirm_password): bool
    {
        if($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            return $this->userRepository->updateUserPassword($username, $hashed_password);
        }else{
            echo "Error: passwords don't match try again!";
            return 0;
        }
    }

    public function updateProfile($userId, $username, $email)
    {
        return $this->userRepository->updateProfile($userId, $username, $email);
    }

    public function sendResetPasswordEmail($email,$token)
    {
        //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function

    
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
    
        //iaip izur izxm rnjp
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'coursework047@gmail.com';                     //SMTP username
            $mail->Password   = 'xgwmxhpoxwidwjxb';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $mail->setFrom('k.alemadi.01@gmail.com', 'khalid');
            $mail->addAddress($email, 'Joe User');     //Add a recipient  //Name is optional
    
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = "you can reset your password by clicking this link: http://localhost/5518csqr-group2-2024/public/reset_password.php?token=$token";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}
