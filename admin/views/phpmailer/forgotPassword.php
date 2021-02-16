<?php
session_start();
include '../controller/controller.php';
require '../phpmailer/PHPMailerAutoLoad.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
require '../phpMailer/class.phpmailer.php';
require '../phpMailer/class.smtp.php';

if(isset($_POST['btnForgot'])){


    $email= $_POST['email'];

    $mail = SEND_MAIL($email);
    // $OTP = rand(1,10000 );
   
   
    
    $msgBody= "Your OTP is "+$_SESSION['userOtp'];
    $_SESSION['userOtp'] = rand(1000,10000 );
    
    
    if($mail == "success"){
        $_SESSION['emailUser'] = $email;
        // Load Composer's autoloader
        // require 'vendor/autoload.php';
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'cosec37@gmail.com';                     // SMTP username
            $mail->Password   = '';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 25;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($email, 'Credit Society');
            $mail->addAddress($email, 'Joe User');     // Add a recipient
                        // Name is optional
            $mail->addReplyTo('cosec37@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            //  $mail->addAttachment('/var/tmp/file.tar.gz');        Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'OTP';
            $mail->Body    = $msgBody+$_SESSION['userOtp'];
            $mail->AltBody = 'Your One Time Password(OTP) is $OTP ';

            $mail->send();
            echo "<script>location.href='../otpPage.php';</script>";
            } 
            catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            // echo "<script>location.href='../views/forgot_password.html';</script>";
            
    }
    
    else{
        echo "<script> alert('Please enter a valid username')</script>";
    }
}
else{
    echo "<script>Connectivity issue. Check your net connection.</script>";
}
// if(isset($_POST['btnOtp'])){
//     $userOtp = $_POST['otp'];
//     if ($userOtp === $_SESSION["userOtp"]){
//         header("Location: ../views/addFile.html");
        
//     }
//     else{
//         echo "Session is not working";
//     }

// }
// else{
//     echo "illegal";
// }
    
?>