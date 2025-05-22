<?php
session_start();
require 'db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
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
      <h3>Manage Bookings</h3>
      <div class="table-responsive">

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Booking ID</th>
                    <th>Guest Name</th>
                    <th>Email</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Room Type</th>
                    <th># Guests</th>
                    <th># Nights</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $sql = "SELECT * FROM bookings ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['guest_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['checkin_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['checkout_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['room_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['number_guests']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nights']) . "</td>";
                    echo "<td>₱" . number_format($row['total_amount'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($row['payment_method']) . "</td>";
                    echo "<td><span class='badge bg-" . ($row['status'] === 'Confirmed' ? 'success' : 'secondary') . "'>" . htmlspecialchars($row['status']) . "</span></td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "<td>
                            <a href='edit-booking.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Edit</a>
                            <a href='delete-booking.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this booking?');\">Delete</a>
                            </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13' class='text-center'>No bookings found.</td></tr>";
            }
            ?>
            </tbody>

        </table>
        <a href="add-booking.php" class="btn btn-success">Add Booking</a>
      </div>
    </section>

    <hr />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
