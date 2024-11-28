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
if(isset($_POST['archive_client_btn'])) {
    $id = $_POST['archive_client']; // Get the ID of the client to be archived
    
    // Update the status of the appointment to "Archived" in the database
    $sql_archive = "UPDATE appointments SET status = 'Archived' WHERE id = $id";
    mysqli_query($conn, $sql_archive);
}

// Fetch all archived client records from the database
$sql_archived = "SELECT * FROM appointments WHERE status = 'Archived'";
$result_archived = mysqli_query($conn, $sql_archived);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Appointments</title>
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
        <input type="text" id="searchInput" placeholder="Search..." style="margin-right: 10px;" onkeyup="searchTable()">
        <select id="sortOptions" onchange="sortTable()">
            <option value="">Sort in...</option>
            <option value="asc">Ascending order (A-Z)</option>
            <option value="desc">Descending order (Z-A)</option>
        </select>
    </div>
</div>

    <div class="main-container">
        <!-- Main content -->
        <div class="main">
            <!-- Archived Appointments -->
            <div class="report-container">
                <!-- Report header -->
                <div class="report-header">
                    <h1 class="recent-Articles">Archived Appointments</h1>
                </div>

                <!-- Report body -->
                <div class="report-body">
                    <div class="client-table-wrapper">
                        <table class="client-table" id="appointmentsTable">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(mysqli_num_rows($result_archived) > 0) {
                                        while($row = mysqli_fetch_assoc($result_archived)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>'; // Display ID
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['email'] . '</td>';
                                            echo '<td>' . $row['contact_number'] . '</td>';
                                            echo '<td>' . $row['car_model'] . '</td>';
                                            echo '<td>' . $row['year_model'] . '</td>';
                                            echo '<td>' . $row['preferred_service'] . '</td>';
                                            echo '<td>' . $row['date'] . '</td>';
                                            echo '<td>' . $row['time'] . '</td>';
                                            echo '<td>' . $row['additional_message'] . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No archived appointments found.</td></tr>";
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
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("appointmentsTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Assuming the name column is the second column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("appointmentsTable");
        switching = true;
        // Set the default direction to ascending
        var dir = "asc";
        // Determine the sorting direction based on the selected option
        if (document.getElementById("sortOptions").value === "desc") {
            dir = "desc";
        }
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[1]; // Assuming the name column is the second column
                y = rows[i + 1].getElementsByTagName("td")[1];
                if (dir === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>


</body>
</html>
