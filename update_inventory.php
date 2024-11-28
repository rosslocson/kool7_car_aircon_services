<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory Item</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Update Inventory Item</h2>
            <form action="update_inventory.php" method="POST">
                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <!-- Add input fields for updating inventory item -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" placeholder="Enter new category" value="<?php echo isset($_POST['category']) ? $_POST['category'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="tool_name" class="form-label">Tool Name</label>
                    <input type="text" class="form-control" id="tool_name" name="tool_name" placeholder="Enter new tool name" value="<?php echo isset($_POST['tool_name']) ? $_POST['tool_name'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="available_size" class="form-label">Available Size</label>
                    <input type="text" class="form-control" id="available_size" name="available_size" placeholder="Enter new available size" value="<?php echo isset($_POST['available_size']) ? $_POST['available_size'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" placeholder="Enter new status" value="<?php echo isset($_POST['status']) ? $_POST['status'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter new quantity" value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : ''; ?>">
                </div>
                <!-- Add other input fields as needed -->
                <button type="submit" class="btn btn-primary">Update Item</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $tool_name = $_POST['tool_name'];
    $available_size = $_POST['available_size'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    // Handle the update operation and redirect back to inventory.php or show success/error message
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kool7_car_aircon_specialist";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Your update operation code here
    $sql = "UPDATE inventory SET category='$category', tool_name='$tool_name', available_size='$available_size', status='$status', quantity='$quantity' WHERE tool_id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Inventory item updated successfully');</script>";
    } else {
        echo "Error updating inventory item: " . $conn->error;
    }

    $conn->close();
}
?>
