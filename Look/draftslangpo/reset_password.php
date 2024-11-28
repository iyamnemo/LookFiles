<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate token
    $sql = "SELECT id FROM users WHERE reset_token = '$token' AND token_expiry > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        if ($new_password === $confirm_password && strlen($new_password) >= 8) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            // Update password and clear token
            $sql = "UPDATE users SET password = '$hashed_password', reset_token = NULL, token_expiry = NULL WHERE reset_token = '$token'";
            if ($conn->query($sql)) {
                echo "<p style='color: green;'>Password has been reset successfully.</p>";
            } else {
                echo "<p style='color: red;'>Failed to reset password. Please try again later.</p>";
            }
        } else {
            echo "<p style='color: red;'>Passwords do not match or are less than 8 characters.</p>";
        }
    } else {
        echo "<p style='color: red;'>Invalid or expired token.</p>";
    }
} elseif (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    die('Invalid request.');
}
?>

<form method="POST" action="">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="password" name="password" placeholder="New Password (min. 8 characters)" required>
    <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
    <button type="submit">Reset Password</button>
</form>
