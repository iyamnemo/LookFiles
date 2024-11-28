<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $student_number = $_POST['student_number'];

    // Validate student number format (00-0000)
    if (!preg_match('/^\d{2}-\d{4}$/', $student_number)) {
        $error_message = "Invalid student number format. It must be in the format 00-0000.";
    } elseif (strlen($password) < 8) {
        // Validate password length
        $error_message = "Password must have at least 8 characters or numbers.";
    } elseif ($password !== $confirm_password) {
        // Validate matching passwords
        $error_message = "Passwords do not match.";
    } else {
        // Check if the email, username, or student number is already registered
        $check_query = "SELECT * FROM users WHERE email = '$email' OR username = '$username' OR student_number = '$student_number'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['email'] == $email) {
                    $error_message = "Email address is already registered to an existing account.";
                }
                if ($row['username'] == $username) {
                    $error_message = "Username is already in use. Please choose another.";
                }
                if ($row['student_number'] == $student_number) {
                    $error_message = "Student number is already registered.";
                }
            }
        } else {
            // Insert user data into the database
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (first_name, last_name, email, username, password, student_number)
                    VALUES ('$first_name', '$last_name', '$email', '$username', '$hashed_password', '$student_number')";

            if ($conn->query($sql)) {
                header('Location: index.php');
            } else {
                $error_message = "Error: " . $conn->error;
            }
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles2.css">
        <style>
            /* Body */
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    height: 100%;
                    background-image: url('images/qcity.avif'); 
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
                    background-color: rgba(0, 0, 0, 0.7); 
                    padding: 15px 20px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    z-index: 100;
                }

                .navbar {
                    height: 60px; 
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


                /* Sign Up Form */
                .background-image {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    position: relative;
                }

                .signup-container {
                    background: rgba(0, 0, 0, 0.5); 
                    padding: 30px;
                    border-radius: 8px;
                    width: 500px; 
                    text-align: center;
                    backdrop-filter: blur(10px); 
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
                }

                .signup-container h2 {
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
                    background-color: rgba(255, 255, 255, 0.2);
                    color: #fff;
                }

                input::placeholder {
                    color: lightcyan; 
                    opacity: 1; 
                }


                input[name="last_name"] {
                    margin-bottom: 40px; 
                }

                input[name="confirm_password"] {
                    margin-bottom: 40px;
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
                    transition: background-color 0.3s ease;
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
                    .signup-container {
                        width: 90%;
                    }
                }

        </style>

    </head>
    <body>
        <div class="navbar">
            <div class="logo">
                <img src="images/logoreal.png" alt="Logo"> 
            </div>
            <div class="navbar-text">
                Exclusive for Quezon City University Students
            </div>
        </div>

        <div class="background-image">
            <div class="signup-container">
                <form method="POST" action="">
                    <h2>Sign Up</h2>
                    <?php if (isset($error_message)): ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password (min. 8 characters)" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <input type="text" name="student_number" placeholder="QCU Student Number (00-0000)" required>
                    <button type="submit">Sign Up</button>
                    <p>Already have an account? <a href="index.php">Sign In</a></p>
                </form>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Quezon City University. All Rights Reserved.</p>
        </div>
    </body>
</html>
