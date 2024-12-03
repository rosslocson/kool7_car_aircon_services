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


// If form submitted, collect email and password from form
if (isset($_POST['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve the hashed password from the database for the given email
        $result = mysqli_query($mysqli, "SELECT password FROM users WHERE email='$email'");

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_hash = $row['password'];

            // Verify the password against the stored hash
            if (password_verify($password, $stored_hash)) {
                // Password is correct, store email in session and redirect
                $_SESSION['email'] = $email;
                header("location: userdashboard.php");
            } else {
                echo "User email or password is not matched";
            }
        } else {
            echo "User email or password is not matched";
        }
    }
}

?>