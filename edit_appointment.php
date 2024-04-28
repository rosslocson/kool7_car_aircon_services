<?php
session_start(); // Start session

// Check if user is logged in
if(!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include database connection
include 'conn.php';

// Check if appointment ID is provided
if(isset($_GET['id'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch appointment details
    $sql = "SELECT * FROM appointments WHERE id='$appointment_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $appointment = mysqli_fetch_assoc($result);
    } else {
        echo "Appointment not found.";
        exit();
    }
} else {
    echo "Appointment ID not provided.";
    exit();
}

// Update appointment details
if(isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $car_model = mysqli_real_escape_string($conn, $_POST['car_model']);
    $year_model = mysqli_real_escape_string($conn, $_POST['year_model']);
    $preferred_service = mysqli_real_escape_string($conn, $_POST['preferred_service']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $additional_message = mysqli_real_escape_string($conn, $_POST['additional_message']);

    $update_query = "UPDATE appointments SET name='$name', email='$email', contact_number='$contact_number', car_model='$car_model', 
                     year_model='$year_model', preferred_service='$preferred_service', date='$date', time='$time', 
                     additional_message='$additional_message' WHERE id='$appointment_id'";

    if(mysqli_query($conn, $update_query)) {
        header("Location: client_view.php?id=$appointment_id");
        exit();
    } else {
        echo "Error updating appointment: " . mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CSS -->
  <title>Edit Appointment</title>
</head>
<body>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Appointment</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $appointment['name']; ?>">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $appointment['email']; ?>">
              </div>
              <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $appointment['contact_number']; ?>">
              </div>
              <div class="mb-3">
                <label for="car_model" class="form-label">Car Model</label>
                <input type="text" class="form-control" id="car_model" name="car_model" value="<?php echo $appointment['car_model']; ?>">
              </div>
              <div class="mb-3">
                <label for="year_model" class="form-label">Year Model</label>
                <input type="text" class="form-control" id="year_model" name="year_model" value="<?php echo $appointment['year_model']; ?>">
              </div>
              <div class="mb-3">
                <label for="preferred_service" class="form-label">Preferred Service</label>
                <input type="text" class="form-control" id="preferred_service" name="preferred_service" value="<?php echo $appointment['preferred_service']; ?>">
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $appointment['date']; ?>">
              </div>
              <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input type="time" class="form-control" id="time" name="time" value="<?php echo $appointment['time']; ?>">
              </div>
              <div class="mb-3">
                <label for="additional_message" class="form-label">Additional Message</label>
                <textarea class="form-control" id="additional_message" name="additional_message"><?php echo $appointment['additional_message']; ?></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="update">Update</button>
              <a href="client_view.php?id=<?php echo $appointment['id']; ?>" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
