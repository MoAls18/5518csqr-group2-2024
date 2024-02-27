<?php
require_once "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_new_password($get_email,$token){
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
        $mail->Username   = 'k.alemadi.01@gmail.com';                     //SMTP username
        $mail->Password   = 'iaipizurizxmrnjp';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('k.alemadi.01@gmail.com', 'khalid');
        $mail->addAddress($get_email, 'Joe User');     //Add a recipient  //Name is optional
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
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

if (isset($_POST['email'])) {
    $token = md5(rand());
    $email = $_POST['email'];
    $sel_query = "SELECT * FROM `users` WHERE email='" . $email . "'";
    $results = mysqli_query($conn, $sel_query);
    $row = mysqli_num_rows($results);
    if ($row == 0) {
        echo  "No user is registered with this email address!";
    } else {
        echo "Found user!";
        // you can send an email here to recover the password '=
        echo "<br>";
        $row = mysqli_fetch_array($results);
        $get_email = $row['email'];
        //u
        $new_token = "UPDATE users SET token_number = '$token' where email = '$get_email' LIMIT 1";
        $token_run = mysqli_query($conn,$new_token);

        if($token_run )
        {
            send_new_password($get_email,$token);
        }
    }
}


?>
<html>

<head>

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="login-container">
        <form action="forget_password.php" method="POST">
            <h4>Forgot your password? Please enter your email to recover it</h2>
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit">
                </div>
        </form>
    </div>
</body>

</html>