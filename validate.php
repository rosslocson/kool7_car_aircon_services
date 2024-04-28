<?php
// Include database connection
include_once('connection.php');

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT * FROM adminlogin WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Check if user exists and password matches
    if ($user && password_verify($password, $user['password'])) {
        // Start session and set user as authenticated
        session_start();
        $_SESSION['username'] = $user['username'];
        // Redirect to admin page
        header("location: login.php");
        exit(); // Make sure to exit after redirection
    } else {
        // Display error message
        echo "<script language='javascript'>";
        echo "alert('Incorrect username or password')";
        echo "</script>";
    }
}
?>