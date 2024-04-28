<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Appointment</title>
  <link rel="stylesheet" href="form-style.css">
  <link rel="stylesheet" href="appointment-style.css"> <!-- New CSS file for appointment page -->
</head>
<body>
  
<div class="container">
    <div class="header">
      <h1>Book Your Appointment</h1>
    </div>
    <div class="content">
      <div class="form__container">
        <h2>Schedule Your Car Aircon Service</h2>
        <form id="appointment-form" action="save_appointment.php" method="post" onsubmit="return validateForm()">
          <div class="form__group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
          </div>
          <div class="form__group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form__group">
            <label for="number">Contact Number:</label>
            <input type="number" id="number" name="number" required>
          </div>
          <div class="form__group">
            <label for="carModel">Car Model:</label>
            <input type="text" id="carModel" name="carModel" required>
          </div>
          <div class="form__group">
            <label for="yearModel">Year Model:</label>
            <input type="number" id="yearModel" name="yearModel" required>
          </div>
          <div class="form__group">
            <label for="service">Preferred Service:</label>
            <select id="service" name="service" required>
              <option value="">-- Select a Service --</option>
              <option value="general">GENERAL SERVICES</option>
              <option value="diagnostics">CAR AIRCON DIAGNOSTICS SERVICES</option>
              <option value="cleaning">CAR AIRCON CLEANING SERVICES</option>
              <option value="replacement">CAR AIRCON REPLACEMENT SERVICES</option>
            </select>
          </div>
          <div class="form__group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
          </div>
          <div class="form__group">
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>
          </div>
          <div class="form__group">
            <label for="message">Additional Message (Optional):</label>
            <textarea name="message" id="message" placeholder="Let us know of any specific concerns or requests"></textarea>
          </div>
          <button type="submit">Confirm</button>
          <a href="index.php"><button type="button">Go Back</button></a>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function validateForm() {
      // Add validation logic here
      // For example, check if email format is valid
      return true; // Change this to return false if validation fails
    }
  </script>
  
</body>
</html>
