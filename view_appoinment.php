<?php
session_start(); // Start the session if it's not already started

include 'conn.php';

// Function to sanitize user inputs
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Sanitize and validate user inputs
$name = sanitize_input($_POST['name']);
$email = sanitize_input($_POST['email']);
$contact_number = sanitize_input($_POST['number']);
$car_model = sanitize_input($_POST['carModel']);
$year_model = sanitize_input($_POST['yearModel']);
$preferred_service = sanitize_input($_POST['service']);
$date = sanitize_input($_POST['date']);
$time = sanitize_input($_POST['time']);
$additional_message = sanitize_input($_POST['message']);

// Prepare the SQL statement with placeholders
$sql = "INSERT INTO appointments (name, email, contact_number, car_model, year_model, preferred_service, date, time, additional_message)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters to the prepared statement
    $stmt->bind_param("ssissssss", $name, $email, $contact_number, $car_model, $year_model, $preferred_service, $date, $time, $additional_message);

    // Execute the prepared statement
    if ($stmt->execute()) {
        $appointment_id = $stmt->insert_id; // Get the ID of the newly inserted appointment
        $_SESSION['message'] = "Appointment booked successfully."; // Set session message
        $stmt->close(); // Close the statement
        $conn->close(); // Close the connection
        header("Location: client_view.php?id=$appointment_id"); // Redirect to view page with appointment ID
        exit();
    } else {
        $_SESSION['message'] = "Error: Unable to book appointment.";
        $stmt->close(); // Close the statement
        $conn->close(); // Close the connection
        header("Location: appointment-form.php"); // Redirect to appointment-form.php on error
        exit();
    }
} else {
    $_SESSION['message'] = "Error: Failed to prepare statement.";
    $conn->close(); // Close the connection
    header("Location: appointment-form.php"); // Redirect to appointment-form.php on error
    exit();
}
?>
