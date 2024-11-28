<?php
include '../includes/auth.php';
include '../includes/db.php';

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
    <link rel="stylesheet" href="layout.css">
    <style>
        main{
            margin-top: 6%;
            font-family: 'Saira Condensed', sans-serif;
        }

        .image-card {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .image-card img {
            width: 400px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .image-card img:hover {
            transform: scale(1.05);
        }

    .nav-left {
        display: flex;
        align-items: center;
        /* Changed to center */
        gap: 20px;
        /* Adjusted for smaller screens */
    }

    

    .company-rating {
    display: flex;
    align-items: center; /* Center items vertically */
    justify-content: flex-start; /* Align items to the left */
   }

   img.company-logo.png {
  width: 4px; /* Adjust the width as needed */
  height: auto; /* Maintain aspect ratio */
  }

  .logo-rating {
    display: flex;
    flex-direction: column; /* Stack logo and rating vertically */
    align-items: center; /* Center items horizontally */
    gap: 5px; /* Space between logo and rating */
  }

.see-all-photos:focus {
    outline: none; /* Remove outline on focus */
    box-shadow: 0 0 0 3px rgba(11, 84, 110, 0.5); /* Focus ring for accessibility */
    gap: 5px;
}

.see-all-photos:active {
    transform: translateY(1px); /* Pressed effect */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Reduced shadow when pressed */
}

.see-all-photos i {
    margin-left: 8px; 
    font-size: 20px; 
    vertical-align: middle; 
    transition: transform 0.3s; 
}

.see-all-photos:hover i {
    transform: translateX(2px); 
}

  .rating-container {
    text-align: center; /* Center the rating text */
  }

    
    .nav-links {
        display: flex;
        gap: 20px;
        /* Adjusted for smaller screens */
        list-style: none;
        padding: 0;
        margin-left: 60px;
       
    }
    


    /* Style the button */
    .go-back-btn {
        background-color: rgba(0, 0, 0, 0.4);
        color: white;
        font-size: 15px;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        margin-top: 20px;
        margin-right: 110px;
        margin-left: auto;
        cursor: pointer;
        display: flex;
        align-items: center;
        margin-bottom: 14px;
        transition: 0.6s;
    }

    .go-back-btn:hover {
        background-color: rgba(0, 0, 0, 0.7);
        scale: 1.09;
    }

    .company-section {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin: 20px 50px;
        /* Combined for margin */
    }

    .company-header {
        display: flex;
        align-items: center;
    }

    .company-icon {
        height: 70px;
        width: 70px;
        margin-left: 50px;
    }

    .company-details h2 {
        font-size: 24px;
        margin-bottom: 5px;
        margin-left: 50px;
    }

    .company-rating {
        font-size: 14px;
        color: #666;
        margin-left: 50px;
        display: flex;
    }

    .pencil-icon {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }

    /* Basic styling for the tabs */
    .company-nav {
        display: flex;
        justify-content: center; /* Center the buttons horizontally */
        margin-left: -30px;
    }

    .company-nav a,
    .company-nav button {
    background-color: transparent; /* Remove background color */
    font-weight: normal; /* Set font weight to normal */
    font-size: 25px;
    font-family: 'Saira Condensed', sans-serif;
    color: inherit; /* Inherit text color from parent */
    position: relative; /* Position relative for the underline */
    transition: color 0.3s; /* Smooth transition for text color */
    text-decoration: none;
    }

    .company-nav a.active::after,
    .company-nav button.active::after,
    .company-nav a:hover::after,
    .company-nav button:hover::after {
    content: ""; /* Required for pseudo-element */
    display: block; /* Make it a block element */
    height: 2px; /* Thickness of the underline */
    background-color:#047199; /* Color of the underline */
    position: absolute; /* Position it absolutely */
    left: 0; /* Align to the left */
    right: 0; /* Align to the right */
    bottom: -5px; /* Position it below the text */
    transform: scaleX(1); /* Show the underline */
    transition: transform 0.3s; /* Smooth transition for the underline */
    }

    .company-nav a.active,
    .company-nav button.active,
    .company-nav a:hover,
    .company-nav button:hover {
    color:#047199; /* Change text color on hover or when active */
    }

    .tab-content {
        display: none;
        padding: 20px;
        
    }

    .tab-content.active {
        display: block;
    }

    .tab-link:hover::after,
    .tab-link.active::after {
    transform: scaleX(1); /* Show the underline on hover or when active */
    }

    .tab-link::after {
    content: ""; 
    display: block; 
    height: 4px;
    background-color:#047199; 
    position: absolute;
    left: 0; 
    right: 0; 
    bottom: -5px; 
    transform: scaleX(0); 
    transition: transform 0.3s; 
    }

    .tab-link.active {
        background-color: none; /* Active tab background */
    }

    .tab-link {
    padding: 10px 20px;
    cursor: pointer;
    border: none;
    background-color: #f1f1f1; /* Default background */
    margin: 0 5px; /* Space between buttons */
    position: relative; /* Position relative for the underline */
    transition: background-color 0.3s;
    }

    /* Styling for the jobs section */
    .offered-jobs {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .offered-jobs h2 {
        font-size: 24px;
        font-weight: bold;
        align-items: center;
        text-align: center;
        margin-bottom: 10px;
    }

    .job-listings {
        display: flex;
        /* Change to flexbox */
        flex-wrap: wrap;
        /* Allow items to wrap */
        gap: 20px;
        justify-content: center;
    }

    .job-card {
        flex: 1;
        /* Allow the cards to grow and fill the space equally */
        min-width: 350px;
        /* Minimum width */
        max-width: 350px;
        /* Fixed width to ensure uniformity */
        display: flex;
        /* Make job cards flex containers */
        flex-direction: column;
        /* Stack children vertically */
        justify-content: space-between;
        /* Space items evenly */
        background-color: white;
        align-items: center;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .job-card:hover {
        transform: scale(1.02);
        background-color: whitesmoke;
    }


    .job-card h3 {
        font-size: 18px;
        font-weight: bold;
        text-decoration: underline;
    }

    .job-card p {
        font-size: 14px;
        color: #666;
    }

    .job-card ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .job-card ul li {
        font-size: 14px;
        color: #333;
    }

    .apply-btn {
        position: relative;
        padding: 10px 20px;
        background-color: #047199;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .apply-btn:hover {
        background-color: #0b546e;
    }

    .applicants-count {
        margin-top: 10px;
        font-weight: bold;
    }

    .company-sec {
    position: relative; /* Set position relative to the parent */
    background-image: url('images/googel.avif'); 
    background-repeat: no-repeat; 
    background-size: cover; 
    background-position: center; 
    height: 500px; 
    width: 100%; 
    color: rgb(7, 3, 3); 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
    padding: 20px;
    margin: auto;
    overflow: hidden; /* Hide overflow to prevent video overflow */
    }

    .hover-video {
        position: absolute; /* Position it absolutely within the parent */
        top: 0;
        left: 0;
        width: 100%; /* Make video fill the div */
        height: 100%; /* Make video fill the div */
        object-fit: cover; /* Cover the div while maintaining aspect ratio */
        opacity: 0; /* Start with zero opacity */
        transition: opacity 0.5s ease; /* Smooth transition for opacity */
        pointer-events: none; /* Disable pointer events for the video */
    }

    .company-sec:hover .hover-video {
        opacity: 1; /* Show video on hover */
        pointer-events: auto; /* Enable pointer events when visible */
    }

    .company-sec:hover {
        background-image: none; /* Optionally remove the background image on hover */
    }

    .bodyngcontents {
        margin-left: 30px;
        margin-right: 30px;

    }
    </style>
</head>
<body>
        <section>
            <!-- Navigation Bar -->
            <div class="navbar">
                <div class="logo">
                    <a href="dashboard.php"><img src="../images/logoreal.png" alt="Logo"></a>
                </div>
                <div class="nav-links">
                    
                    <a href="../jobsearch.php"  class="active" >Job Search</a>
                    <a href="../events.php">Events</a>
                    <a href="../dashboard.php" >Dashboard</a>
                </div>
                <div class="dropdown">
                    <button style="font-family: 'Saira Condensed', sans-serif;"></strong> <?php echo $user['username']; ?> &nbsp;<svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg></svg></button>
                    <div class="dropdown-content">
                        <a href="../dashboard.php">Go to Profile</a>
                        <a href="../logout.php">Logout</a>
                        
                    </div>
                </div>
            </div>


        <!-- MAIN CONTENT-->
        <main>

<button class="go-back-btn" onclick="window.location.href='../jobsearch.php';"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-320c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3l0 41.7 0 41.7L459.5 440.6zM256 352l0-96 0-128 0-32c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-64z"/></svg></button>

<div class="company-sec">
<video class="hover-video" autoplay loop muted>
    <source src="images/googleclips.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

</div>

<!-- Display Company Name -->
<h2 id="displayedCompanyName" style="margin-top: 10px;"></h2> 
<div class="company-rating">
    <div class="logo-rating">
        <img src="images/company-logo.png" alt="Google Logo" class="google-logo"> <!-- Replace with the actual logo file -->
        <span id="ratingDisplay">⭐⭐⭐⭐⭐ 4.9 total rating from 80 reviews</span>
    </div>
    
</div>
</div>

        <section class="bodyngcontents">
                <div class="company-nav">
                    <button class="tab-link active" onclick="openTab(event, 'background')">Company Background</button>
                    <button class="tab-link" onclick="openTab(event, 'culture')">Life and Culture</button>
                    <button class="tab-link" onclick="openTab(event, 'jobs')">Offered Jobs</button>
                </div>

                <!-- Section for Company Background -->
                <div id="background" class="tab-content active">
                <h1>Company Background: Google</h1>
                <p>
                    <strong>Founded:</strong> September 4, 1998 <br>
                    <strong>Founders:</strong> Larry Page and Sergey Brin <br>
                    <strong>Headquarters:</strong> Mountain View, California, USA <br>
                    <strong>Industry:</strong> Technology (Search engines, Online advertising, Cloud computing, Software, Hardware) <br>
                </p>


                <p><strong>Google</strong>  began as a search engine project while the founders were PhD students at Stanford University. <br>
                    Today,<strong> Google</strong>  is a subsidiary of Alphabet Inc. and one of the world's largest technology companies,  offering products like<strong> Google Search, <br> YouTube, Gmail, Google Maps, Google Cloud, Android OS,</strong>  and more.</p> <br>

                <h2>Google Photos</h2>

                <div class="image-card">
                    <img src="images/Image1.png" alt="Image 1">
                    <img src="images/Image2.webp" alt="Image 2">
                    <img src="images/Image3.jfif" alt="Image 3">
                    <img src="images/Image4.jpg" alt="Image 4">
                </div>




                </div>

                <!-- Section for Life and Culture -->
                <div id="culture" class="tab-content">
                <h1>Benefits and Contributions</h1>

                <p><strong>Google</strong> is renowned for its employee-centric culture, which has made it one of the most desirable places to work. A few highlights of Google’s work culture include:</p>

                <ul>
                
                <strong>Innovation:</strong> Employees are encouraged to experiment with new ideas and work on side projects (famous “20% time” for personal projects) <br>
                <strong>Diversity & Inclusion:</strong> Google strives to maintain a diverse workforce with programs aimed at promoting equity and inclusion. <br>
                <strong>Work-Life Balance:</strong> Google is known for offering employees flexible hours, the option to work remotely, and generous vacation policies. <br>
                <strong>Perks and Benefits:</strong> Free meals, gym access, healthcare benefits, on-site wellness centers, and extensive career development opportunities are available to Googlers. <br>
                <strong>Collaborative Environment:</strong> Google encourages open communication, teamwork, and brainstorming sessions across departments. <br>
                <br>


                </ul>

                <h2>Gallery</h2>

                <div class="image-card">
                    <img src="images/Google1.jpg" alt="Image 1">
                    <img src="images/Google2.jpg" alt="Image 2">
                    <img src="images/Google3.jpg" alt="Image 3">
                    <img src="images/Google4.jpg" alt="Image 4">
                    <img src="images/Google5.jpg" alt="Image 5">
                    <img src="images/Google6.jpg" alt="Image 6">
                </div>

                </div>

                <!-- Section for offered jobs -->
                <div id="jobs" class="tab-content">

                    <div class="offered-jobs">
                        <h2>8 Jobs Available in Google Company</h2>
                        <div class="job-listings">
                            <!-- Example Job Card -->
                            <div class="job-card" id="job1">
                                <h3>Software Engineer</h3>
                                <p>Mountain View, CA</p>
                                <ul>
                                    <li>Develop scalable, reliable, and efficient software systems.</li>
                                    <li>Design algorithms and improve existing systems.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job1')">Apply</button>
                                <div class="applicants-count" id="job1-count">0 applicants</div>
                            </div>

                            <div class="job-card" id="job2">
                                <h3>Product Manager</h3>
                                <p>Remote/Hybrid</p>
                                <ul>
                                    <li>Define product vision, strategy, and roadmap.</li>
                                    <li>Work with engineers, marketing, and sales teams.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job2')">Apply</button>
                                <div class="applicants-count" id="job2-count">0 applicants</div>
                            </div>
                            <div class="job-card" id="job3">
                                <h3>Data Scientist</h3>
                                <p>New York, NY</p>
                                <ul>
                                    <li>Analyze and interpret complex data to identify trends and inform business decisions.</li>
                                    <li>Build predictive models and develop algorithms.</li>
                                    <li>Present findings to stakeholders using visualizations and reports.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job3')">Apply</button>
                                <div class="applicants-count" id="job3-count">0 applicants</div>
                            </div>
                            <div class="job-card" id="job4">
                                <h3>UX Designer</h3>
                                <p>San Francisco, CA</p>
                                <ul>
                                    <li>Create user-friendly designs for mobile and web applications.</li>
                                    <li>Work with product teams to develop wireframes and prototypes.</li>
                                    <li>Conduct user research and usability testing to improve the overall experience.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job4')">Apply</button>
                                <div class="applicants-count" id="job4-count">0 applicants</div>
                            </div>
                            <div class="job-card" id="job5">
                                <h3>Sales Manager</h3>
                                <p>London, UK</p>
                                <ul>
                                    <li>Lead a team of sales professionals to meet and exceed revenue targets.</li>
                                    <li>Build and maintain strong relationships with clients.</li>
                                    <li>Develop sales strategies and reports for senior management.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job5')">Apply</button>
                                <div class="applicants-count" id="job5-count">0 applicants</div>
                            </div>
                            <div class="job-card" id="job6">
                                <h3>Sales Manager</h3>
                                <p>Remote</p>
                                <ul>
                                    <li>Design, implement, and manage cloud infrastructure solutions for clients.</li>
                                    <li>Work closely with clients to understand business needs.</li>
                                    <li>Provide guidance on cloud security and performance optimization.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job6')">Apply</button>
                                <div class="applicants-count" id="job6-count">0 applicants</div>
                            </div>
                            <div class="job-card" id="job7">
                                <h3>Digital Marketing Specialist</h3>
                                <p>Novaliches</p>
                                <ul>
                                    <li>Develop and execute digital marketing campaigns across platforms like Google Ads, social
                                        media, and email.</li>
                                    <li>Analyze campaign performance data and provide insights to improve future strategies.</li>
                                    <li>Collaborate with product and sales teams to ensure marketing efforts align with overall
                                        company goals.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job7')">Apply</button>
                                <div class="applicants-count" id="job7-count">0 applicants</div>
                            </div>
                            <div class="job-card" id="job8">
                                <h3>Technical Support Engineer</h3>
                                <p>Quezon City Hall</p>
                                <ul>
                                    <li>Provide technical support to clients and customers, troubleshooting and resolving issues.
                                    </li>
                                    <li>Work closely with product and engineering teams to identify, report, and fix technical bugs.
                                    </li>
                                    <li>Offer training and documentation to users on how to use Google products effectively.</li>
                                </ul>
                                <button class="apply-btn" onclick="applyToJob('job8')">Apply</button>
                                <div class="applicants-count" id="job8-count">0 applicants</div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>    

</main>





















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
                            <img src="../images/facebook-app-round-white-icon.png" class="soc-icons" alt="fb">
                            </a>
                                <!-- ig icon -->
                                <a href="#" class="soc-med-icons">
                                <img src="../images/icons8-instagram-50.png" class="soc-icons" alt="ig">
                                </a>
                                    <!-- x icon -->
                                    <a href="#" class="soc-med-icons">
                                    <img src="../images/x-social-media-white-icon.png" class="soc-icons" alt="x">
                                    </a>
                                        <!-- whatsapp icon -->
                                        <a href="#" class="soc-med-icons">
                                        <img src="../images/whatsapp-white-icon.png" class="soc-icons" alt="wa">
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

                   // Function to handle company navigation links
                   function setCompanyActive(event) {
            const companyLinks = document.querySelectorAll('.company-nav a');
            companyLinks.forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');

            // Smooth scrolling to the target section
            const targetSection = event.target.getAttribute('href');
            const section = document.querySelector(targetSection);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Attach event listeners to main nav links
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', setActive);
        });

        function openTab(event, tabName) {
            // Hide all tab content
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));

            // Remove active class from all tab links
            const tabLinks = document.querySelectorAll('.tab-link');
            tabLinks.forEach(link => link.classList.remove('active'));

            // Show the current tab content and set the tab link as active
            document.getElementById(tabName).classList.add('active');
            event.currentTarget.classList.add('active');
        }

        // Dropdown Toggle
        document.querySelector('.dropbtn').addEventListener('click', function () {
            document.querySelector('.dropdown-content').classList.toggle('show');
        });

        // Close Dropdown When Clicking Outside
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn') && !event.target.closest('.dropdown')) {
                var dropdowns = document.getElementsByClassName('dropdown-content');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        document.getElementById('writeReviewBtn').addEventListener('click', function () {
            // Prompt the user for a new review rating (1-5)
            let newRating = prompt("Enter your rating (1-5):");

            // Validate the input
            if (newRating < 1 || newRating > 5 || isNaN(newRating)) {
                alert("Please enter a valid rating between 1 and 5.");
                return; // Exit the function if invalid
            }

            // Get current rating and review count
            const ratingDisplay = document.getElementById('ratingDisplay');
            const currentRating = parseFloat(ratingDisplay.innerText.match(/[\d\.]+/)[0]);
            const currentReviewCount = parseInt(ratingDisplay.innerText.match(/from (\d+) reviews/)[1]);

            // Update the rating calculation
            const totalRating = (currentRating * currentReviewCount + parseFloat(newRating)) / (currentReviewCount + 1);
            const newReviewCount = currentReviewCount + 1;

            // Update the displayed rating and review count
            ratingDisplay.innerText = `${'⭐'.repeat(Math.round(totalRating))} ${totalRating.toFixed(1)} total rating from ${newReviewCount} reviews`;
        });
        // Handle the logo input change event
        document.getElementById('logoInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const deleteLogoBtn = document.getElementById('deleteLogoBtn');
            const logoInput = document.getElementById('logoInput');
            const displayedCompanyName = document.getElementById('displayedCompanyName');
            const companyNameInput = document.getElementById('companyNameInput');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const companyLogo = document.getElementById('companyLogo');
                    companyLogo.src = e.target.result; // Set the image source to the uploaded file
                    companyLogo.style.display = 'block'; // Display the uploaded image
                    deleteLogoBtn.style.display = 'block'; // Show the delete button
                    logoInput.disabled = true; // Disable the file input

                    // Set the company name from the input field
                    displayedCompanyName.textContent = companyNameInput.value || "Company Name"; // Display company name
                }
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });

        // Handle the company name input change event
        document.getElementById('companyNameInput').addEventListener('input', function () {
            const companyName = this.value;
            document.getElementById('displayedCompanyName').textContent = companyName || "Company Name"; // Update displayed name
        });

        // Handle the logo input change event
        document.getElementById('logoInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const deleteLogoBtn = document.getElementById('deleteLogoBtn');
            const logoInput = document.getElementById('logoInput');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const companyLogo = document.getElementById('companyLogo');
                    companyLogo.src = e.target.result; // Set the image source to the uploaded file
                    companyLogo.style.display = 'block'; // Display the uploaded image
                    deleteLogoBtn.style.display = 'block'; // Show the delete button
                    logoInput.disabled = true; // Disable the file input
                }
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });

        // Handle the delete logo button click event
        document.getElementById('deleteLogoBtn').addEventListener('click', function () {
            const companyLogo = document.getElementById('companyLogo');
            const logoInput = document.getElementById('logoInput');
            const deleteLogoBtn = document.getElementById('deleteLogoBtn');

            companyLogo.style.display = 'none'; // Hide the logo
            logoInput.value = ''; // Reset the file input
            logoInput.disabled = false; // Enable the file input again
            deleteLogoBtn.style.display = 'none'; // Hide the delete button
        });
        // Function to track the number of applicants per job
        const applicants = {
            job1: 0,
            job2: 0,
            job3: 0,
            job4: 0,
            job5: 0,
            job6: 0,
            job7: 0,
            job8: 0
        };

        function applyToJob(jobId) {
            // Increment the count for the specific job
            applicants[jobId]++;

            // Display the updated count in the corresponding job card
            document.getElementById(`${jobId}-count`).innerText = `${applicants[jobId]} applicants`;
        }
    </script>

</body>

</html>

