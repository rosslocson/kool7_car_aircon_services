<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Client 
                            <a href="#" class="btn btn-danger float-end" onclick="submitForm()">Submit</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="edit-form" action="update_client.php" method="POST">
                            <input type="hidden" name="client_id" value="<?= isset($client['client_id']) ? $client['client_id'] : '' ?>">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?= isset($client['name']) ? $client['name'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= isset($client['email']) ? $client['email'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="number" name="contact_number" class="form-control" value="<?= isset($client['contact_number']) ? $client['contact_number'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label>Car Model</label>
                                <input type="text" name="car_model" class="form-control" value="<?= isset($client['car_model']) ? $client['car_model'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label>Year Model</label>
                                <input type="text" name="year_model" class="form-control" value="<?= isset($client['year_model']) ? $client['year_model'] : '' ?>">
                            </div>
                            <div class="form__group">
                                <label for="service">Preferred Service:</label>
                                <select id="service" name="preferred_service" class="form-control">
                                    <option value="">-- Select a Service --</option>
                                    <option value="general" <?= isset($client['preferred_service']) && $client['preferred_service'] == 'general' ? 'selected' : '' ?>>GENERAL SERVICES</option>
                                    <option value="diagnostics" <?= isset($client['preferred_service']) && $client['preferred_service'] == 'diagnostics' ? 'selected' : '' ?>>CAR AIRCON DIAGNOSTICS SERVICES</option>
                                    <option value="cleaning" <?= isset($client['preferred_service']) && $client['preferred_service'] == 'cleaning' ? 'selected' : '' ?>>CAR AIRCON CLEANING SERVICES</option>
                                    <option value="replacement" <?= isset($client['preferred_service']) && $client['preferred_service'] == 'replacement' ? 'selected' : '' ?>>CAR AIRCON REPLACEMENT SERVICES</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" value="<?= isset($client['date']) ? $client['date'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label>Time</label>
                                <input type="time" name="time" class="form-control" value="<?= isset($client['time']) ? $client['time'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label>Additional Message</label>
                                <input type="text" name="additional_message" class="form-control" value="<?= isset($client['additional_message']) ? $client['additional_message'] : '' ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            // Submit the form asynchronously
            fetch('update_client.php', {
                method: 'POST',
                body: new FormData(document.getElementById('edit-form'))
            })
            .then(response => {
                if (response.ok) {
                    // Display pop-up message
                    alert("Book Successfully!");
                    // Redirect to index.php after successful submission
                    window.location.href = 'index.php';
                } else {
                    console.error('Failed to update client.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>