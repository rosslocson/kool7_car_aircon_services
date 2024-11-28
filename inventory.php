<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h2>Inventory</h2>

<a href="add_inventory.php" class="btn btn-primary mb-3">Add New Item</a> <!-- Add New Item button -->

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tool ID</th>
            <th>Category</th>
            <th>Tool Name</th>
            <th>Available Size</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kool7_car_aircon_specialist";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Read operation
        $sql = "SELECT * FROM inventory";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . (isset($row["tool_id"]) ? $row["tool_id"] : "") . "</td>";
                echo "<td>" . (isset($row["category"]) ? $row["category"] : "") . "</td>";
                echo "<td>" . (isset($row["tool_name"]) ? $row["tool_name"] : "") . "</td>";
                echo "<td>" . (isset($row["available_size"]) ? $row["available_size"] : "") . "</td>";
                echo "<td>" . (isset($row["status"]) ? $row["status"] : "") . "</td>";
                echo "<td>" . (isset($row["quantity"]) ? $row["quantity"] : "") . "</td>";
                echo "<td>";
                if (isset($row["tool_id"])) {
                    echo "<a href='update_inventory.php?id=" . $row["tool_id"] . "' class='btn btn-primary'>Update</a> | ";
                    echo "<button onclick='deleteItem(" . $row["tool_id"] . ")' class='btn btn-danger'>Delete</button>"; // Delete button with onclick event
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No items found</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>

<!-- Below the table -->
<div style="text-align: center; margin-top: 20px;">
    <a href="dashboard.php" style="display: inline-block; padding: 10px 20px; background-color: #a10808; color: white; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
        Return to Dashboard
    </a>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to handle deletion -->
<script>
    function deleteItem(itemId) {
        if (confirm("Are you sure you want to delete this item?")) {
            // Perform deletion by redirecting to delete_inventory.php with item ID
            window.location.href = 'delete_inventory.php?id=' + itemId;
        }
    }
</script>

</body>
</html>
