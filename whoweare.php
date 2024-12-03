<?php
// Assuming you have already established a database connection
// Replace the placeholders with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kool7_car_aircon_specialist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the 'about_us' table in the database
$sql = "SELECT * FROM about_us";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h2 class='section__header'>" . $row["title"] . "</h2>";
        echo "<p class='section__description'>" . $row["description"] . "</p>";
        echo "<a href='appointment-form.php' class='btn btn--responsive'>Book Now</a>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
