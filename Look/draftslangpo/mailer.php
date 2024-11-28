<?php
// Manually include the necessary PHPMailer files
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $body) {
    $mail = new PHPMailer(true); // Enable exceptions for error handling

    try {
        // Server settings
        $mail->isSMTP();                                      // Use SMTP
        $mail->Host       = 'smtp.gmail.com';               // Set your SMTP server (e.g., Gmail: smtp.gmail.com)
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'look.official.sender@gmail.com';         // Your email
        $mail->Password   = 'rpkztjqwkjbbsczr';            // Your email password (use an app password if necessary)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption
        $mail->Port       = 587;                              // TCP port for TLS

        // Recipients
        $mail->setFrom('your-email@example.com', 'Your Website Name'); // Sender's email and name
        $mail->addAddress($to);                                // Add recipient

        // Content
        $mail->isHTML(true);                                   // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
