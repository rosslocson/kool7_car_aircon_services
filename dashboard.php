<?php

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_COOKIE['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logosec">
            <div class="logo">KOOL 7 CAR AIRCON SPECIALIST</div>
        </div>

        <div class="message">
            <div class="circle"></div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt="">
            <div class="dp">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                    class="dpicn" alt="dp">
            </div>
        </div>
    </header>

    <div class="main-container">
        <!-- Navigation -->
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png"
                            class="nav-img" alt="dashboard">
                        <h3> Dashboard</h3>
                    </div>
                    <div class="option2 nav-option">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png"
                            class="nav-img" alt="articles">
                        <h3> Inventory</h3>
                    </div>

                    <div class="nav-option logout">
                        <a href="logout.php" class="logout-link">
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png" class="nav-img" alt="logout">
                            <h3 class="logout-text">Logout</h3>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main content -->
        <div class="main">
            <!-- Search bar -->
            <div class="searchbar">
                <input type="text" id="searchInput" placeholder="Search...">
                <select id="sortOptions">
                    <option value="">Sort in...</option>
                    <option value="asc">Ascending order (A-Z)</option>
                    <option value="desc">Descending order (Z-A)</option>
                </select>
            </div>

            <!-- Client Records -->
            <div class="report-container">
                <!-- Report header -->
                <div class="report-header">
                    <h1 class="recent-Articles">Client Records</h1>
                    <form action="exit.php">
                        <button type="submit" class="view">View All</button>
                    </form>
                </div>

                <!-- Report body -->
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
                                    // Include database connection
                                    include 'conn.php';
                                    // Fetch all client records from the database
                                    $sql = "SELECT * FROM appointments";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
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
                                            echo '<td>
                                                    <a href="dashboard_client_edit.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">Edit<i class="fas fa-edit"></i></a>
                                                    <a href="dashboard_client_view.php?id=' . $row['id'] . '" class="btn btn-info btn-sm">View<i class="fas fa-eye"></i></a>
                                                    <form action="delete_client.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="delete_client" value="' . $row['id'] . '">
                                                        <button type="submit" name="delete_client_btn" class="btn btn-danger btn-sm">Delete<i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                  </td>'; // Buttons for edit, view, and delete
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo "<tr><td colspan='11'>No client records found.</td></tr>"; // colspan updated to 11 for ID column
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code for search functionality
        const searchInput = document.getElementById('searchInput');
        const sortOptions = document.getElementById('sortOptions');
        const rows = document.querySelectorAll('.client-table tbody tr');

        searchInput.addEventListener('input', function(event) {
            const searchTerm = event.target.value.toLowerCase();
            const selectedOption = sortOptions.value;

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                    }
                });
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            if (selectedOption) {
                sortRows(selectedOption === 'asc');
            }
        });

        sortOptions.addEventListener('change', function(event) {
            const selectedOption = event.target.value;
            if (selectedOption) {
                sortRows(selectedOption === 'asc');
            }
        });

        function sortRows(ascending) {
            const rowsArray = Array.from(rows);
            const sortedRows = rowsArray.sort((rowA, rowB) => {
                const textA = rowA.cells[1].textContent.toLowerCase().trim();
                const textB = rowB.cells[1].textContent.toLowerCase().trim();
                return ascending ? textA.localeCompare(textB) : textB.localeCompare(textA);
            });

            sortedRows.forEach(row => {
                row.parentNode.appendChild(row); // Re-append sorted rows
            });
        }
    </script>
</body>
</html>
