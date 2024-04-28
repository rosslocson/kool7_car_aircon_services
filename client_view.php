<?php
// Include database connection
include 'conn.php';

// Check if client ID is provided in the URL
if (isset($_GET['id'])) {
    $client_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch client data from the database
    $query = "SELECT * FROM appointments WHERE id='$client_id'";
    $result = mysqli_query($conn, $query);

    // Check if client data is found
    if ($result && mysqli_num_rows($result) > 0) {
        $client = mysqli_fetch_assoc($result); // Assign client data to $client variable
    } else {
        // Handle case where client data is not found
        echo "Client not found.";
        exit; // Stop further execution
    }
} else {
    // Handle case where client ID is not provided
    echo "No client ID provided.";
    exit; // Stop further execution
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['client_id'])) {
  // Sanitize and retrieve form data
$client_id = mysqli_real_escape_string($conn, $_POST['client_id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
$car_model = mysqli_real_escape_string($conn, $_POST['car_model']);
$year_model = mysqli_real_escape_string($conn, $_POST['year_model']); // Dagdag na field
$preferred_service = mysqli_real_escape_string($conn, $_POST['preferred_service']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$time = mysqli_real_escape_string($conn, $_POST['time']);
$additional_message = mysqli_real_escape_string($conn, $_POST['additional_message']);

// Perform update query
$update_query = "UPDATE appointments SET name='$name', email='$email', contact_number='$contact_number', car_model='$car_model', year_model='$year_model', additional_message='$additional_message' WHERE id='$client_id'";
$update_result = mysqli_query($conn, $update_query);


    // Check if update was successful
    if ($update_result) {
        echo '<script>alert("Client details updated successfully!");</script>';
        // Update $client variable with the new data
        $client['name'] = $name;
        $client['email'] = $email;
        $client['contact_number'] = $contact_number;
        $client['car_model'] = $car_model;
        $client['year_model'] = $year_model;
        $client['preferred_service'] = $preferred_service;
        $client['date'] = $date;
        $client['time'] = $time;
        $client['additional_message'] = $additional_message;
    } else {
        echo '<script>alert("Failed to update client details.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Client Details 
                        <button class="btn btn-primary float-end me-2" onclick="editClient()">Edit</button>
                        <button class="btn btn-success float-end" onclick="submitForm()">Save</button>
                    </h4>
                </div>
                <div class="card-body">  
                </div>
                <div class="card-body">
                    <form id="edit-form" method="POST">
                        <input type="hidden" name="client_id" value="<?= $client['id']; ?>">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $client['name']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $client['email']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= $client['contact_number']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="car_model">Car Model</label>
                            <input type="text" class="form-control" id="car_model" name="car_model" value="<?= $client['car_model']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="year_model">Year Model</label>
                            <input type="text" class="form-control" id="year_model" name="year_model" value="<?= $client['year_model']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="preferred_service">Preferred Service</label>
                            <input type="text" class="form-control" id="preferred_service" name="preferred_service" value="<?= $client['preferred_service']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?= $client['date']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time" value="<?= $client['time']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="additional_message">Additional Message</label>
                            <input type="text" class="form-control" id="additional_message" name="additional_message" value="<?= $client['additional_message']; ?>" readonly>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function editClient() {
            // Enable editing of input fields
            document.getElementById("name").readOnly = false;
            document.getElementById("email").readOnly = false;
            document.getElementById("contact_number").readOnly = false;
            document.getElementById("car_model").readOnly = false;
            document.getElementById("year_model").readOnly = false;
            document.getElementById("preferred_service").readOnly = false;
            document.getElementById("date").readOnly = false;
            document.getElementById("time").readOnly = false;
            document.getElementById("additional_message").readOnly = false;
        }

        function submitForm() {
            // Submit the form
            document.getElementById("edit-form").submit();
        }
    </script>
    
</body>
</html>