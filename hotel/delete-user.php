<?php
session_start();
require 'db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validate user ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid user ID.";
    exit;
}

$user_id = intval($_GET['id']);

// Prepare and execute delete query
$query = $conn->prepare("DELETE FROM users WHERE id = ?");
$query->bind_param("i", $user_id);

if ($query->execute()) {
    // Optionally, set a flash message here before redirecting
    header("Location: manage-users.php");
    exit;
} else {
    echo "Error deleting user: " . $conn->error;
}

$query->close();
?>
