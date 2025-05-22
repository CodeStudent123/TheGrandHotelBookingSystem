<?php
include 'db.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $guest_name = $_POST['guest_name'];
    $email = $_POST['email'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $room_type = $_POST['room_type'];
    $number_guests = (int) $_POST['number_guests'];
    $nights = (int) $_POST['nights'];
    $status = $_POST['status'];
    $total_amount = (float) $_POST['total_amount'];
    $payment_method = $_POST['payment_method'];
    $now = date("Y-m-d H:i:s");

    // Insert into bookings table
    $query = $conn->prepare("INSERT INTO bookings (guest_name, email, checkin_date, checkout_date, room_type, number_guests, nights, status, total_amount, payment_method, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("sssssiisdss", $guest_name, $email, $checkin_date, $checkout_date, $room_type, $number_guests, $nights, $status, $total_amount, $payment_method, $now);
    $query->execute();
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Booking Confirmation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="text-center p-5 bg-white shadow rounded">
    <h1 class="text-success mb-3">Thank You!</h1>
    <p class="lead">Thank you for your booking</p>
    <p class="lead">Here's your booking details:</p>
    <p class="lead">
        Booking ID: <strong><?php echo $conn->insert_id; ?></strong><br>
        Guest Name: <strong><?php echo $guest_name; ?></strong><br>
        Email: <strong><?php echo $email; ?></strong><br>
        Check-in Date: <strong><?php echo $checkin_date; ?></strong><br>
        Check-out Date: <strong><?php echo $checkout_date; ?></strong><br>
        Room Type: <strong><?php echo $room_type; ?></strong><br>
        Number of Guests: <strong><?php echo $number_guests; ?></strong><br>
        Number of Nights: <strong><?php echo $nights; ?></strong><br>
        Total Amount: <strong>₱<?php echo $total_amount; ?></strong><br>
        Payment Method: <strong><?php echo $payment_method; ?></strong><br>
        Status: <strong><?php echo $status; ?></strong><br>
    </p>

    <p class="lead">If you have any concerns, please don't hesitate to <a href="index.php#contact">contact us</a></p>
    <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
  </div>
</body>
</html>
