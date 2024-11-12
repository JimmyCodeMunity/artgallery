<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include the PHPMailer library

function sendVerificationEmail($email,$otp,$username) {
    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings (your existing settings)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'dev.jimin02@gmail.com';
        $mail->Password = 'bkyewxhfvizpihlk ';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipient
        $mail->setFrom('dev.jimin02@gmail.com', 'Art Gallery');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true); // Set to true to send HTML content
        $mail->Subject = 'Thanks for creating an account with us ' .$username;

        // HTML email template
        $emailTemplate = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    h2 {
                        color: #333;
                    }
                    p {
                        color: #555;
                    }
                    .otp-code {
                        font-size: 24px;
                        color: #2d79f3;
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Thanks for creating an account with us, {$username}!</h2>
                    <p>Your verification code is:</p>
                    <p class='otp-code'>{$otp}</p>
                    <p>Please use this code to complete your registration.</p>
                    <p>The code is only valid for 3 minutes.</p>
                </div>
            </body>
            </html>
        ";

        $mail->msgHTML($emailTemplate);

        $mail->send();
        // echo '<script>alert("Verification code resent successfully")</script>';
        $error[] = 'Email resent successfully';
        
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>