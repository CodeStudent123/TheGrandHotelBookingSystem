<?php
session_start();
require 'db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validate ID
if (!isset($_GET['id'])) {
    echo "Invalid booking ID.";
    exit;
}

$booking_id = intval($_GET['id']);

// Handle form submission
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

    $query = "
        UPDATE bookings
        SET guest_name='$guest_name',
            email='$email',
            checkin_date='$checkin_date',
            checkout_date='$checkout_date',
            room_type='$room_type',
            number_guests=$number_guests,
            nights=$nights,
            total_amount=$total_amount,
            payment_method='$payment_method',
            status='$status'
        WHERE id=$booking_id
    ";

    if ($conn->query($query)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}

// Fetch current booking
$query = "SELECT * FROM bookings WHERE id = $booking_id";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    echo "Booking not found.";
    exit;
}

$booking = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Dashboard - CHARLES HOTEL APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
      background-color: #343a40;
      padding-top: 20px;
    }
    .sidebar a {
      color: #ffffff;
      padding: 15px;
      display: block;
      text-decoration: none;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #495057;
    }
    .main-content {
      margin-left: 240px;
      padding: 20px;
    }
    .navbar {
      position: fixed;
      left: 240px;
      right: 0;
      top: 0;
      background-color: #343a40;
      z-index: 1000;
    }
    .navbar-brand {
      color: #fff;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <?php include 'sidebar.php'; ?>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Manage Bookings -->
    <section id="bookings">
      <div>&nbsp;</div>
      <div>&nbsp;</div>
      <h3>Edit Booking #<?php echo str_pad($booking['id'], 3, '0', STR_PAD_LEFT); ?></h3>
      <div class="table-responsive">

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label>Guest Name</label>
                <input type="text" name="guest_name" class="form-control" value="<?php echo $booking['guest_name']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $booking['email']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Check-in Date</label>
                <input type="date" name="checkin_date" class="form-control" value="<?php echo $booking['checkin_date']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Check-out Date</label>
                <input type="date" name="checkout_date" class="form-control" value="<?php echo $booking['checkout_date']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Room Type</label>
                <select name="room_type" class="form-select" required>
                    <option <?php if ($booking['room_type'] == 'Single Room (₱3,000.00/night)') echo 'selected'; ?>>Single Room (₱3,000.00/night)</option>
                    <option <?php if ($booking['room_type'] == 'Double Room (₱4,000.00/night)') echo 'selected'; ?>>Double Room (₱4,000.00/night)</option>
                    <option <?php if ($booking['room_type'] == 'Suite Room (₱5,000.00/night)') echo 'selected'; ?>>Suite Room (₱5,000.00/night)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Number of Guests</label>
                <input type="number" name="number_guests" class="form-control" value="<?php echo $booking['number_guests']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Nights</label>
                <input type="number" name="nights" class="form-control" value="<?php echo $booking['nights']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Total Amount (₱)</label>
                <input type="number" name="total_amount" class="form-control" value="<?php echo $booking['total_amount']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Payment Method</label>
                <select name="payment_method" class="form-select" required>
                    <option <?php if ($booking['payment_method'] == 'COD') echo 'selected'; ?>>COD</option>
                    <option <?php if ($booking['payment_method'] == 'Credit Card') echo 'selected'; ?>>Credit Card</option>
                    <option <?php if ($booking['payment_method'] == 'Gcash') echo 'selected'; ?>>Gcash</option>
                    <option <?php if ($booking['payment_method'] == 'Paypal') echo 'selected'; ?>>Paypal</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option <?php if ($booking['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option <?php if ($booking['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                    <option <?php if ($booking['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                </select>
            </div>
            <div class="col-12 text-end">
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>

      </div>
    </section>

    <hr />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
