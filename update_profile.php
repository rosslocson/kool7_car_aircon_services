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
    header("Location: userlogin.html");
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];

    // Validate input to prevent SQL injection
    $name = $mysqli->real_escape_string($name);
    $username = $mysqli->real_escape_string($username);
    $age = intval($age);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone_number = $mysqli->real_escape_string($phone_number);
    $gender = $mysqli->real_escape_string($gender);

    // Update query
    $query = "UPDATE users SET 
        name='$name',
        username='$username',
        age='$age',
        address='$address',
        email='$email',
        phone_number='$phone_number',
        gender='$gender'
        WHERE id='$id'";

    if ($mysqli->query($query)) {
        echo "Profile updated successfully.";
        header("Location: userdashboard.php");
    } else {
        echo "Error updating profile: " . $mysqli->error;
    }
}
?>

