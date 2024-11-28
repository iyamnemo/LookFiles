<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
        } else {
            $error_message = "Incorrect Password.";
        }
    } else {
        $error_message = "User not found.";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Body and background image */
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    height: 100%;
                    background-image: url('images/qcity.avif'); /* Replace with your image */
                    background-size: cover;
                    background-position: center;
                    color: #fff;
                }

                /* Navigation Bar */
                .navbar {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    background-color: rgba(0, 0, 0, 0.7); /* Transparent black */
                    padding: 15px 20px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    z-index: 100;
                }

                .navbar {
                    height: 60px; /* Adjust logo size */
                }

                .logo img{
                    max-width: 100%;
                    height: 200px;

                }

                .navbar .navbar-text {
                    font-size: 12px;
                    color: #fff;
                    font-weight: bold;
                    margin-right: 100px;
                }

                /* Login Form */
                .background-image {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    position: relative;
                }

                input::placeholder {
                    color: whitesmoke; /* You can choose any color you want */
                    opacity: 1; /* Ensures the placeholder is fully visible */
                }

                .login-container {
                    background: rgba(0, 0, 0, 0.5); /* Transparent black */
                    padding: 30px;
                    border-radius: 8px;
                    width: 400px;
                    text-align: center;
                    backdrop-filter: blur(10px); /* Blurry effect */
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
                }

                .login-container h2 {
                    margin-bottom: 20px;
                    font-size: 24px;
                    color: #fff;
                }

                input {
                    width: 100%;
                    padding: 10px;
                    margin: 10px 0;
                    border-radius: 4px;
                    border: 1px solid #ccc;
                    background-color: rgba(255, 255, 255, 0.2); /* Transparent input */
                    color: #fff;
                }

                button {
                    width: 100%;
                    padding: 10px;
                    margin: 10px 0;
                    border-radius: 4px;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    font-size: 16px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                button:hover {
                    background-color: rgb(30, 30, 141);
                    transition: 0.3s;
                }

                .error-message {
                    color: red;
                    font-size: 14px;
                    margin-bottom: 15px;
                }

                footer {
                    position: fixed;
                    bottom: 0;
                    width: 100%;
                    text-align: center;
                    background-color: rgba(0, 0, 0, 0.7);
                    padding: 10px 0;
                    color: #fff;
                }

                footer p {
                    margin: 0;
                    font-size: 14px;
                }

                /* Responsive */
                @media (max-width: 600px) {
                    .navbar .navbar-text {
                        font-size: 14px;
                    }
                    .login-container {
                        width: 90%;
                    }
                }

        </style>
    </head>
    <body>
        <div class="navbar">
            <div class="logo">
                <img src="images/logoreal.png" alt="Logo"> <!-- Add your logo image here -->
            </div>
            <div class="navbar-text">
                Exclusive for Quezon City University Students
            </div>
        </div>

        <div class="background-image">
            <div class="login-container">
                <form method="POST" action="">
                    <h2>Login</h2>
                    <?php if (isset($error_message)): ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                </form>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Quezon City University. All Rights Reserved.</p>
        </div>
    </body>
</html>
