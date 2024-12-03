<?php
session_start();

$servername = "localhost"; // or your server name
$username = "root"; // database username
$password = ""; // database password
$database = "kool7_car_aircon_specialist"; // your database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location: user_login.php");
    exit;
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Query to fetch user data
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email'");
if (!$result) {
    die("Query failed: " . $mysqli->error);
}

$user = mysqli_fetch_assoc($result);


// Check if user exists
if (!$user) {
    echo "User not found.";
    exit;
}

// Extract user data
$id = $user['id'];
$name = $user['name'];
$age = $user['age'];
$address = $user['address'];
$username = $user['username'];
$email = $user['email'];
$address = $user['address'];
$phone_number = $user['phone_number'];
$age = $user['age'];
$gender = $user['gender'];


// Fetch bookings for the logged-in user
$bookingsQuery = "SELECT * FROM appointments WHERE email='$email'";
// Adjust table and column names as per your schema
$bookingsResult = mysqli_query($mysqli, $bookingsQuery);
if (!$bookingsResult) {
    die("Query failed: " . $mysqli->error);
}

// Store bookings in an array
$bookings = [];
while ($booking = mysqli_fetch_assoc($bookingsResult)) {
    $bookings[] = $booking;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Kool 7 Car Aircon Specialist</title>

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            background-color: white;
        }


        /* General Header Styling */
        .header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* Ensure space between left and right sections */
        }

        /* Navbar Styling */
        .nav__bar {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0 20px;
        }

        /* Logo Section */
        .nav__logo {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Space between logo and text */
        }

        .nav__logo img {
            height: 50px;
        }

        /* Navbar Right Section */
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: 180px;

        }

        /* Navigation Links */
        .navbar-right ul {
            display: flex;
            list-style: none;
            gap: 20px;
            /* Space between links */
            margin: 0;
            padding: 0;


        }

        .navbar-right li a {
            text-decoration: none;
            color: white;
            font-size: 16px;


        }

        .navbar-right li a:hover {
            color: #c00427;
            /* Hover effect */
        }

        .profile-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            width: 90%;
            /* Adjust width as needed for responsiveness */
            max-width: 600px;
            text-align: left;
        }

        .profile-container img {
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile-container ul {
            list-style: none;
            padding: 0;
        }

        .profile-container ul li {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .btn {
            padding: 10px;
            background: #c00427;
            color: #fff;
            font-size: 14px;
            font-weight: bolder;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            background: #AB4459;
            border-color: black;
        }

        .btn_ {
            margin-left: 20px;
        }

        .bookings-section {
            padding: 20px;
            background-color: #f9f9f9;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .booking-card {
            background: white;
            border: 1px double black;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;

        }

        .booking-card h5 {
            margin: 0;
            color: #333;
        }

        .booking-card p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="nav__bar">

            <div class="logo nav__logo">
                <a href="index.html"><img src="logo 2.png" alt="logo" height="50px"></a>



                <h4> Kool 7 Car Aircon Specialist</h4>
            </div>
            <div class="navbar-right">
                <ul>
                    <li><a href="userdashboard.php#bookings">Booked Appointments</a></li>
                    <li><a href="user_profile.php">My Profile</a></li>
                    <li><a href="feedback.php">Leave a Feedback</a></li>

                    <li><a href="userlogin.php"><i class="fa fa-logout" style="color:white"></i> Log Out</i></a></li>
                </ul>
            </div>
            <div class="btn_">
                <a href="appointment-form.php">
                    <button type="submit" name="book" class="btn"><i class="fa fa-calendar" style="color:white"></i>
                        Book an Appointment</button>
                </a>
            </div>
        </nav>
    </header>

    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">




        <!-- Container (Profile Section) -->

        <section id="profile" class="container-fluid bg-grey">
            <div>
                <h2 style="color: #c00427">My Profile</h2>
            </div>
            <div class="booking-card">

                <ul>
                    <li><strong>Name: </strong><?php echo htmlspecialchars($name); ?></li>
                    <li><strong>Username: </strong><?php echo htmlspecialchars($username); ?></li>
                    <li><strong>Age: </strong><?php echo htmlspecialchars($age); ?></li>
                    <li><strong>Address: </strong><?php echo htmlspecialchars($address); ?></li>
                    <li><strong>Email Address: </strong><?php echo htmlspecialchars($email); ?></li>
                    <li><strong>Phone Number: </strong><?php echo htmlspecialchars($phone_number); ?></li>
                    <li><strong>Gender: </strong><?php echo htmlspecialchars($gender); ?></li>
                </ul>

                <button id="editbutton" onclick="toggleEditForm()">Edit Profile</button>

                <form id="editProfileForm" action="update_profile.php" method="POST" style="display:none;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <ul>
                        <br>
                        <li><strong>Name: </strong>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                        </li>
                        <li><strong>Username: </strong>
                            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
                        </li>
                        <li><strong>Age: </strong>
                            <input type="number" name="age" value="<?php echo htmlspecialchars($age); ?>">
                        </li>
                        <li><strong>Address: </strong>
                            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                        </li>
                        <li><strong>Email Address: </strong>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        </li>
                        <li><strong>Phone Number: </strong>
                            <input type="tel" name="phone_number"
                                value="<?php echo htmlspecialchars($phone_number); ?>">
                        </li>
                        <li><strong>Gender:</strong>
                            <select name="gender">
                                <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male
                                </option>
                                <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>
                                    Female</option>
                                <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Other
                                </option>
                            </select>
                        </li>
                    </ul>
                    <br>
                    <button id="updatebutton" class="btn btn-default" type="submit">Update Profile</button>
                </form>

            </div>
        </section>




        <script>
            function toggleEditForm() {
                const form = document.getElementById("editProfileForm");
                const button = document.getElementById("editbutton");
                if (form.style.display === "none" || form.style.display === "") {
                    form.style.display = "block";
                    button.style.display = "none";
                } else {
                    form.style.display = "none";
                    button.style.display = "block";
                }
            }
        </script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </body>

</html>