<?php
include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
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
    

                /* LAMAN */
  section{
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden; 

        }

        .container {
            max-width: 1800px;
            margin: 20px 0px;
            padding: 0 20px;
            
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        #searchBar {
        margin-top: 20%;
        padding: 15px 20px;
        width: 1040px; 
        border: 1px solid #ddd; 
        border-radius: 25px; 
        font-size: 1.1rem; 
        outline: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4); 
        background: #f9f9f9; 
        transition: all 0.3s ease; 
        }

        #searchBar:hover {
            background: #ffffff; 
            border-color: #fad0c4; 
        }

        #searchBar:focus {
            background: #ffffff;
            border: 2px solid #fad0c4; 
            box-shadow: 0 6px 10px rgba(0, 123, 255, 0.3); 
        }


        main {
            display: flex;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 10px;
            gap: 30px;
            white-space: nowrap; 
            width: 100%; 
            height: 480px; 
            box-sizing: border-box;
            margin-right: 40px;
            margin-bottom: 100px;
        }

        main::-webkit-scrollbar {
            height: 20px;

        }

        main::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.7);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .job-card {
            flex: 0 0 auto;
            width: 250px;
            height: 400px;
            perspective: 1000px;
            cursor: pointer;
            position: relative;
        }

        .job-card:hover .card-front {
            transform: rotateY(180deg);
        }

        .job-card:hover .card-back {
            transform: rotateY(0deg);
        }

        .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            transition: transform 0.6s;
        }

        .card-front {
            background-color: rgba(0, 0, 0, 0.7);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            color: #fff;
            transform: rotateY(0deg);
            white-space: normal; 
            word-wrap: break-word; 
        }

        .card-front img {
            max-width: 240px; 
            height: 240px;
            margin-bottom: 10px;
            border-radius: 50%;
        }

        .card-back {
            background: #fff;
            color: #333;
            border: 1px solid #ccc;
            transform: rotateY(180deg);
            white-space: normal; 
            word-wrap: break-word; 
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
                    
                    <a href="jobsearch.php" class="active">Job Search</a>
                    <a href="events.php">Events</a>
                    <a href="dashboard.php" >Dashboard</a>
                </div>
                <div class="dropdown">
                    <button style="font-family: 'Saira Condensed', sans-serif;"></strong> <?php echo $user['username']; ?> &nbsp;<svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg></svg></button>
                    <div class="dropdown-content">
                        <a href="dashboard.php" onclick="openSidePanel()">Go to Profile</a>
                        <a href="logout.php">Logout</a>
                        
                    </div>
                </div>
            </div>

                            <!-- LAMAN -->
    <header>
        <input type="text" id="searchBar" placeholder="Search for jobs..." />
    </header>
   
    <section>
        <div class="container">
            <main id="jobList">
                <div class="job-card" onclick="window.location.href='companies/google.php'">
                    <div class="card-front">
                        <img src="images/ggllogo.webp" alt="Job Icon">
                        <h2>Google</h2>
                    </div>
                    <div class="card-back">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="job-card" onclick="window.location.href='companies/sample_layout.php'">
                    <div class="card-front">
                        <img src="images/qcity.avif" alt="Job Icon">
                        <h2> Input </h2>
                    </div>
                    <div class="card-back">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="job-card" onclick="window.location.href='companies/sample_layout.php'">
                    <div class="card-front">
                        <img src="images/qcity.avif" alt="Job Icon">
                        <h2> Company </h2>
                    </div>
                    <div class="card-back">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="job-card" onclick="window.location.href='companies/sample_layout.php'">
                    <div class="card-front">
                        <img src="images/qcity.avif" alt="Job Icon">
                        <h2> Name </h2>
                    </div>
                    <div class="card-back">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="job-card" onclick="window.location.href='companies/sample_layout.php'">
                    <div class="card-front">
                        <img src="images/qcity.avif" alt="Job Icon">
                        <h2> Here </h2>
                    </div>
                    <div class="card-back">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>

                  <!-- DAGDAG MORE JOBES -->


            </main>
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
          const searchBar = document.getElementById('searchBar');
        const jobCards = document.querySelectorAll('.job-card');

        searchBar.addEventListener('input', (e) => {
            const searchValue = e.target.value.toLowerCase();
            jobCards.forEach(card => {
                const title = card.querySelector('.card-front h2').innerText.toLowerCase();
                if (title.includes(searchValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        function redirectToJob(url) {
            window.location.href = url;
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

