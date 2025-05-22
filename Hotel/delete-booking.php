<?php
session_start();
require 'db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validate booking ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid booking ID.";
    exit;
}

$booking_id = intval($_GET['id']);

// Prepare and execute delete query
$query = $conn->prepare("DELETE FROM bookings WHERE id = ?");
$query->bind_param("i", $booking_id);

if ($query->execute()) {
    // Optionally, set a flash message here before redirecting
    header("Location: dashboard.php");
    exit;
} else {
    echo "Error deleting booking: " . $conn->error;
}

$query->close();
?>
