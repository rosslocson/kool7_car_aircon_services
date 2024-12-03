<?php
// Database connection
$servername = "localhost"; // Update with your database server name
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$database = "kool7_car_aircon_specialist"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Get form data
    $username = $conn->real_escape_string($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $phone_number = $conn->real_escape_string($_POST["phone_number"]);
    $age = (int)$_POST["age"];
    $gender = $conn->real_escape_string($_POST["gender"]);

    // Insert into database
    $sql = "INSERT INTO users (username, password, name, email, address, phone_number, age, gender) 
            VALUES ('$username', '$password', '$name', '$email', '$address', '$phone_number', $age, '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "<br/><br/>User Registered successfully.<br>";
    echo '<a href="userlogin.php">Click here to log in.</a>';

} else {
    echo "Registration error. Please try again." . mysqli_error($mysqli);
}

}

// Close the connection
$conn->close();
?>
