<?php
include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Handle Profile Update Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contact = $_POST['contact_details'];
    $address = $_POST['home_address'];

    // Handle Profile Picture Upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = $_FILES['profile_picture']['name'];
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], "upload/$profile_picture");
        $sql = "UPDATE users SET contact_details='$contact', home_address='$address', profile_picture='$profile_picture' WHERE id=$user_id";
    } else {
        $sql = "UPDATE users SET contact_details='$contact', home_address='$address' WHERE id=$user_id";
    }

    // Execute Query and Refresh Page
    $conn->query($sql);
    header('Location: dashboard.php'); // Refresh page after update
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Saira+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">    
    <title>User Dashboard</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
            background-size: 400% 400%;
            animation: gradientMove 10s infinite;
            color: #333;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: auto;

        }
        @keyframes gradientMove {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

        section{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 90%;
            max-width: 900px;
            animation: fadeIn 1s ease-in-out;
        }

        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .profile-picture:hover {
            transform: scale(1.1);
        }

        h1, h2 {
            color: black;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
        }

        /* Info Section Styles */
        .info {
            color: black;
            margin: 15px 0;
        }

        .info p {
            font-size: 16px;
            margin: 5px 0;
            font-family: 'Saira Condensed', sans-serif;
        }

        .info strong {
            font-weight: bold;
        }

        /* Button Styles */
        .btn {
            background-color: rgba(0, 123, 255, 0.8);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: rgba(0, 123, 255, 1);
            transform: translateY(-3px);
        }

        /* Logout Button Styles */
        .logout-form {
            text-align: center;
            margin-top: 20px;
        }

        /* Side Panel Styles */
        .side-panel {
            position: fixed;
            top: 0;
            right: -450px;
            width: 400px;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: -4px 0 8px rgba(0, 0, 0, 0.4);
            transition: right 0.3s ease;
            padding: 20px;
            z-index: 9999;
            font-family: 'Saira Condensed', sans-serif;
        }

        .side-panel.open {
            right: 0;
        }

        .side-panel h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .side-panel form {
            display: flex;
            flex-direction: column;
        }

        .side-panel input, .side-panel textarea {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'Saira Condensed', sans-serif;
        }

        .side-panel button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .side-panel button:hover {
            background-color: #0056b3;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #ccc;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-btn:hover {
            background-color: #999;
        }

                /* Navigation Bar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px 20px;
            color: white;
            position: fixed;
            top: 0;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .navbar {
            height: 60px;
            object-fit: contain;
            font-family: 'Saira Condensed', sans-serif;
        }

        .logo img {
            max-width: 100%;
            height: 200px;
        }

        .navbar .nav-links {
            display: flex;
            gap: 20px;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            position: relative;
        }

        .navbar .nav-links a.active::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: white;
            bottom: -5px;
            left: 0;
        }

        .navbar .dropdown {
            margin-right: 100px;
        }

        .navbar .dropdown button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 10px;
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            right: 80px;
            top: 60px;
            background-color: white;
            color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 999;
        }

        .navbar .dropdown-content a {
            display: block;
            padding: 15px 40px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1;
        }


        .container {
            margin-top: 10%; /* Adjust for fixed navbar */
            margin-bottom: 5%;
        }
        

        /* FOOTER SECTION */
.footerlook{
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-top: 50px;
    background-color: rgba(0, 0, 0, 0.7);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding-bottom: 15px;
    width: 100%;
    bottom: 0;
    height: 200px;
    
  }
  
  /* Motto */
  .p-foot{
    color: white;
    font-family: 'Saira Condensed', sans-serif;
    font-weight: bolder;
    font-size: 40px;
    line-height: 1;
    padding-bottom: 25px;
    margin-left: 20px;
  }
  
  /* gmail */
  .gmail-look{
    padding:0;
    color: #ffffff;
    font-weight: 100;
    position: relative;
    margin-left: 20px;
    font-family: 'Saira Condensed', sans-serif;
  }
  
  /* right-contents */
  .right-contents{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-end;
  }

  /* contents inside */
.footer-contents{
    justify-content: flex-end;
    color: #ffffff;
    font-weight: 100;
    top: auto;
    margin-left: auto;
    margin-right: 10px;
    font-family: 'Saira Condensed', sans-serif;
  }

  /* soc-med, parent container for soc-icons */
.soc-med-icons{
    margin-right: 60px;
  }
  
  /* Social media icons */
  .soc-icons{
    width: 20px;
    height: auto;
    padding-bottom: 30px;
  }
  
  /* transitions for soc-icons */
  .soc-icons:hover{
    opacity: 0.4;
  }

  .footer-contents{
    text-decoration: none;
    padding-left: 30px;
  }
        
        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            .profile-picture {
                width: 120px;
                height: 120px;
            }
        }

    </style>
</head>
<body>
        <section>
            <!-- Navigation Bar -->
            <div class="navbar">
                <div class="logo">
                    <a href="dashboard.php"><img src="images/logoreal.png" alt="Logo"></a>
                </div>
                <div class="nav-links">
                    
                    <a href="jobsearch.php">Job Search</a>
                    <a href="events.php">Events</a>
                    <a href="dashboard.php" class="active">Dashboard</a>
                </div>
                <div class="dropdown">
                    <button style="font-family: 'Saira Condensed', sans-serif;"></strong> <?php echo $user['username']; ?> &nbsp;<svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg></svg></button>
                    <div class="dropdown-content">
                        <a href="javascript:void(0);" onclick="openSidePanel()">Edit Profile</a>
                        <a href="logout.php">Logout</a>
                        
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="header">
                    <h1 style="font-family: 'Saira Condensed', sans-serif;">Look Personal Card</h1>
                    <img src="upload/<?php echo $user['profile_picture'] ?: 'default.png'; ?>" alt="Profile Picture" class="profile-picture">
                    <h2><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></h2>
                </div>

                <div class="info">
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Student Number:</strong> <?php echo $user['student_number']; ?></p>
                    <p><strong>Contact:</strong> <?php echo $user['contact_details'] ?: 'Not set'; ?></p>
                    <p><strong>Address:</strong> <?php echo $user['home_address'] ?: 'Not set'; ?></p>
                </div>


                </div>
            </div>

                <!-- Side Panel for Edit Profile -->
                <div class="side-panel" id="editProfilePanel">
                    <button class="close-btn" onclick="closeSidePanel()">X</button>
                    <h2>Edit Profile</h2>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <input type="file" name="profile_picture">
                        <input type="text" name="contact_details" value="<?php echo $user['contact_details']; ?>" placeholder="Contact Details">
                        <textarea name="home_address" placeholder="Home Address"><?php echo $user['home_address']; ?></textarea>
                        <button type="submit">Save Changes</button>
                    </form>
                </div>
        </section>

            <!-- FOOTER -->
            <footer class="footerlook">
                <div class="left-contents">
                    <p class="p-foot">
                        FIND YOUR<br><span style="color: #0056b3;">BEST</span> INTEREST!
                    </p>
                        <!-- look gmail -->
                        <a href="#" class="gmail-look">
                            ✉ look.official.sender@gmail.com
                        </a>
                </div>
                    <div class="right-contents">
                        <!-- soc-med -->
                        <div class="soc-med">
                            <!-- fb icon -->
                            <a href="#" class="soc-med-icons">
                            <img src="images/facebook-app-round-white-icon.png" class="soc-icons" alt="fb">
                            </a>
                                <!-- ig icon -->
                                <a href="#" class="soc-med-icons">
                                <img src="images/icons8-instagram-50.png" class="soc-icons" alt="ig">
                                </a>
                                    <!-- x icon -->
                                    <a href="#" class="soc-med-icons">
                                    <img src="images/x-social-media-white-icon.png" class="soc-icons" alt="x">
                                    </a>
                                        <!-- whatsapp icon -->
                                        <a href="#" class="soc-med-icons">
                                        <img src="images/whatsapp-white-icon.png" class="soc-icons" alt="wa">
                                        </a>
                        </div>
                            <div class="navi-below">
                                <a href="#" class="footer-contents">About us</a>
                                <a href="#" class="footer-contents">Terms and conditions</a>
                                <a href="#" class="footer-contents">Privacy policy</a>
                            </div>
                    </div>
            </footer>
    
    <script>
        function openSidePanel() {
            document.getElementById("editProfilePanel").classList.add("open");
        }

        function closeSidePanel() {
            document.getElementById("editProfilePanel").classList.remove("open");
        }

         // Toggle the dropdown menu on click
    document.querySelector('.navbar .dropdown button').addEventListener('click', function() {
        const dropdownContent = document.querySelector('.navbar .dropdown-content');
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
    });

    // Optional: Close the dropdown if clicked outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelector('.navbar .dropdown-content').style.display = 'none';
        }
    });
    </script>

</body>

</html>

