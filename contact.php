<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Update this path according to your folder structure
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';           // Set the SMTP server to send through
        // $mail->Host       = 'smtp.office365.com'; 
        $mail->SMTPAuth   = true;

        // $mail->Username   = 'abhinandkrishna.a@outlook.com';     // SMTP username
        // $mail->Password   = 'jemtqbrqqwclmdmp'; 
        // Enable SMTP authentication
        $mail->Username   = 'am.abhinandkrishna@gmail.com';     // SMTP username
        $mail->Password   = 'pdua hkzr kzck rvjf';        // SMTP password (use App Password if 2FA enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption
        $mail->Port       = 587;                        // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);                  // Sender's email and name
        $mail->addAddress('abhinandkrishna.a@outlook.com',);
        $mail->addAddress('info@millenniumancillary.com', 'Info'); // Add recipient

        // Content
        $mail->isHTML(true);                            // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = nl2br("You have received a new message from Visiter form.<br><br>
        Name: $name<br>
        Email: $email<br>
        Subject: $subject<br>
        Message:<br>$message");

        // Send the email
        $mail->send();
        echo  "<script>Swal.fire({
        title: 'Thank you for contacting US!',
        text: 'We will reach out to you via email/phone at the earliest and do the needful.',
          icon: 'OK',
            confirmButtonText: 'Close'
            });

         </script>";
         echo"<script>alert('Thank you for contacting US!'); window.location.href='index.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href='index.php';</script>";
    }
}

