<?php
include 'db.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $now = date("Y-m-d H:i:s");

    // Insert into bookings table
    $query = $conn->prepare("INSERT INTO contacts (name, email, phone, message, created_at) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("sssss", $name, $email, $phone, $message, $now);
    $query->execute();
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="text-center p-5 bg-white shadow rounded">
    <h1 class="text-success mb-3">Contact Us!</h1>
    <p class="lead">Thank you for contacting us</p>
    <p class="lead">We will contact you shortly</p>
    <p class="lead">
        Name: <strong><?php echo $name; ?></strong><br>
        Email: <strong><?php echo $email; ?></strong><br>
        Phone: <strong><?php echo $phone; ?></strong><br>
        Message: <strong><?php echo $message; ?></strong><br>
        Date: <strong><?php echo $now; ?></strong><br>
    </p>

    <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
  </div>
</body>
</html>
