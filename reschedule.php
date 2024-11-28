<?php

include 'conn.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_COOKIE['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Include database connection
include 'conn.php';

// Check if the form was submitted
if(isset($_POST['reschedule_client_btn'])) {
    $id = $_POST['reschedule_client']; // Get the ID of the client to be rescheduled
    
    // Update the status of the appointment to "Rescheduled" in the database
    $sql_reschedule = "UPDATE appointments SET status = 'Rescheduled' WHERE id = $id";
    mysqli_query($conn, $sql_reschedule);
}

// Check if the form for updating date and time was submitted
if(isset($_POST['update_datetime'])) {
    $id = $_POST['id'];
    $new_date = $_POST['new_date'];
    $new_time = $_POST['new_time'];
    
    // Update the date and time in the database
    $sql_update_datetime = "UPDATE appointments SET date = '$new_date', time = '$new_time' WHERE id = $id";
    mysqli_query($conn, $sql_update_datetime);
}

// Fetch all rescheduled client records from the database
$sql_rescheduled = "SELECT * FROM appointments WHERE status = 'Rescheduled'";
$result_rescheduled = mysqli_query($conn, $sql_rescheduled);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rescheduled Appointments</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .logo {
            font-size: 24px;
        }
        .main-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .report-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-header h1 {
            font-size: 28px;
            margin: 0;
        }
        .client-table-wrapper {
            overflow-x: auto;
        }
        .client-table {
            width: 100%;
            border-collapse: collapse;
        }
        .client-table th, .client-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .client-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .client-table td {
            background-color: #fff;
        }
        .client-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        .no-records {
            text-align: center;
            font-style: italic;
            color: #999;
        }
    </style>
    <script>
        // Function to show confirmation popup and update form fields
        function showConfirmation(id) {
            if (confirm("Are you sure you want to save the changes?")) {
                var newDate = document.getElementById('date_' + id).value;
                var newTime = document.getElementById('time_' + id).value;
                
                // Update hidden form fields with new date and time values
                document.getElementById('new_date_' + id).value = newDate;
                document.getElementById('new_time_' + id).value = newTime;

                // Submit the form
                document.getElementById('form_' + id).submit();
            }
        }
    </script>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logosec">
            <div class="logo">KOOL 7 CAR AIRCON SPECIALIST</div>
        </div>
    </header>

    <div class="main" style="display: flex; justify-content: center;">
    <!-- Search bar -->
    <div class="searchbar" style="text-align: center; margin-top: 50px;">
        <input type="text" id="searchInput" placeholder="Search..." style="margin-right: 10px;">
        <select id="sortOptions">
            <option value="">Sort in...</option>
            <option value="asc">Ascending order (A-Z)</option>
            <option value="desc">Descending order (Z-A)</option>
        </select>
    </div>
</div>

    <div class="main-container">
        <!-- Main content -->
        <div class="main">
            <!-- Rescheduled Appointments -->
            <div class="report-container">
                <!-- Report header -->
                <div class="report-header">
                    <h1 class="recent-Articles">Rescheduled Appointments</h1>
                </div>

                <div class="report-body">
                    <div class="client-table-wrapper">
                        <table class="client-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Car Model</th>
                                    <th>Year Model</th>
                                    <th>Preferred Service</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Additional Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(mysqli_num_rows($result_rescheduled) > 0) {
                                        while($row = mysqli_fetch_assoc($result_rescheduled)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>'; // Display ID
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['email'] . '</td>';
                                            echo '<td>' . $row['contact_number'] . '</td>';
                                            echo '<td>' . $row['car_model'] . '</td>';
                                            echo '<td>' . $row['year_model'] . '</td>';
                                            echo '<td>' . $row['preferred_service'] . '</td>';
                                            // Editable date input field
                                            echo '<td><input type="date" id="date_' . $row['id'] . '" value="' . $row['date'] . '"></td>';
                                            // Editable time input field
                                            echo '<td><input type="time" id="time_' . $row['id'] . '" value="' . $row['time'] . '"></td>';
                                            echo '<td>' . $row['additional_message'] . '</td>';
                                            // Save button with onclick event calling showConfirmation() function
                                            echo '<td><button onclick="showConfirmation(' . $row['id'] . ')" class="save-btn">Save</button></td>';
                                            echo '</tr>';
                                            // Hidden form for updating date and time
                                            echo '<form id="form_' . $row['id'] . '" action="" method="POST" style="display: none;">';
                                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                                            echo '<input type="hidden" id="new_date_' . $row['id'] . '" name="new_date" value="">'; // Will be filled by JavaScript
                                            echo '<input type="hidden" id="new_time_' . $row['id'] . '" name="new_time" value="">'; // Will be filled by JavaScript
                                            echo '<input type="hidden" name="update_datetime" value="1">';
                                            echo '</form>';
                                        }
                                    } else {
                                        echo "<tr><td colspan='11'>No rescheduled appointments found.</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Below the table -->
<div style="text-align: center; margin-top: 20px;">
    <a href="dashboard.php" style="display: inline-block; padding: 10px 20px; background-color: #a10808; color: white; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
        Return to Dashboard
    </a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to handle search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            var searchText = this.value.toLowerCase();
            var rows = document.querySelectorAll('.client-table tbody tr');

            rows.forEach(function(row) {
                var name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                var email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                var contactNumber = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                var carModel = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                var yearModel = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
                var preferredService = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
                
                if (name.includes(searchText) || email.includes(searchText) || contactNumber.includes(searchText) || carModel.includes(searchText) || yearModel.includes(searchText) || preferredService.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Function to handle sorting functionality
        document.getElementById('sortOptions').addEventListener('change', function() {
            var sortOrder = this.value;
            var rows = document.querySelectorAll('.client-table tbody tr');
            var sortedRows = Array.from(rows).sort(function(a, b) {
                var textA = a.querySelector('td:nth-child(2)').textContent.toLowerCase();
                var textB = b.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (sortOrder === 'asc') {
                    return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
                } else if (sortOrder === 'desc') {
                    return (textA > textB) ? -1 : (textA < textB) ? 1 : 0;
                }
            });

            var tbody = document.querySelector('.client-table tbody');
            tbody.innerHTML = '';
            sortedRows.forEach(function(row) {
                tbody.appendChild(row);
            });
        });
    });
</script>


</body>
</html>
