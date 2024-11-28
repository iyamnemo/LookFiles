<?php
include 'includes/db.php';
include 'mailer.php'; // Include the custom mailer script

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour

        // Save token and expiry in the database
        $sql = "UPDATE users SET reset_token = '$token', token_expiry = '$expiry' WHERE email = '$email'";
        if ($conn->query($sql)) {
            // Send email using PHPMailer
            $reset_link = "http://localhost/TRIAL/reset_password.php?token=$token";
            $subject = "Password Reset Request";
            $body = "
                <p>Click the link below to reset your password:</p>
                <p><a href='$reset_link'>$reset_link</a></p>
                <p>This link will expire in 1 hour.</p>
            ";

            $mail_result = sendMail($email, $subject, $body);
            if ($mail_result === true) {
                echo "<p style='color: green;'>Password reset link has been sent to your email address.</p>";
            } else {
                echo "<p style='color: red;'>Failed to send email: $mail_result</p>";
            }
        } else {
            echo "<p style='color: red;'>Failed to generate reset link. Please try again later.</p>";
        }
    } else {
        echo "<p style='color: red;'>Email address not found.</p>";
    }
}
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Enter your registered email" required>
    <button type="submit">Send Reset Link</button>
</form>
