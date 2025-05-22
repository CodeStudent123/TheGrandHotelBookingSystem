<?php
session_start();
require 'db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

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

    $query = "INSERT INTO bookings
        (guest_name, email, checkin_date, checkout_date, room_type, number_guests, nights, total_amount, payment_method, status, created_at)
        VALUES ('$guest_name', '$email', '$checkin_date', '$checkout_date', '$room_type', $number_guests, $nights, $total_amount, '$payment_method', '$status', NOW())";

    if ($conn->query($query)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}

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
      <h3>Add Booking</h3>
      <div class="table-responsive">

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label>Guest Name</label>
                <input type="text" name="guest_name" id="guest_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Check-in Date</label>
                <input type="date" name="checkin_date" id="checkin_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Check-out Date</label>
                <input type="date" name="checkout_date" id="checkout_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Room Type</label>
                <select name="room_type" id="room_type" class="form-select" required>
                    <option>Single Room (₱3,000.00/night)</option>
                    <option>Double Room (₱4,000.00/night)</option>
                    <option>Suite Room (₱5,000.00/night)</option>
                </select>
                <input type="hidden" name="room_rate" id="room_rate" value="0.00">
            </div>
            <div class="col-md-6">
                <label>Number of Guests</label>
                <input type="number" name="number_guests" id="number_guests" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Nights</label>
                <input type="number" name="nights" id="nights" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Total Amount (₱)</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-select" required>
                    <option>COD</option>
                    <option>Credit Card</option>
                    <option>Gcash</option>
                    <option>Paypal</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option>Pending</option>
                    <option>Confirmed</option>
                    <option>Cancelled</option>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  $(document).ready(function () {

    function getRoomRate() {
        const roomType = $('#room_type').val();
        let rate = 0;

        switch (roomType) {
            case 'Single Room (₱3,000.00/night)':
                rate = 3000;
                break;
            case 'Double Room (₱4,000.00/night)':
                rate = 4000;
                break;
            case 'Suite Room (₱5,000.00/night)':
                rate = 5000;
                break;
            default:
                rate = 0;
        }

        $('#room_rate').val(rate);
    }


    function calculateTotal() {
        getRoomRate();
        const roomRate = parseInt($('#room_rate').val()) || 0;
        const guestCount = parseInt($('#number_guests').val()) || 0;
        const dateFrom = new Date($('#checkin_date').val());
        const dateTo = new Date($('#checkout_date').val());

        let nights = 0;
        if (!isNaN(dateFrom) && !isNaN(dateTo) && dateTo > dateFrom) {
            const diffTime = Math.abs(dateTo - dateFrom);
            nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        }

        const total = roomRate * nights;
        $('#nights').val(nights);
        $('#total_amount').val(total);
    }

    $('#room_type, #number_guests, #checkin_date, #checkout_date').on('change', calculateTotal);

  });
</script>

</body>
</html>
