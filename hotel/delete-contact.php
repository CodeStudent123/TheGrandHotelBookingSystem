<?php
session_start();
require 'db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Validate contact ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid contact ID.";
    exit;
}

$contact_id = intval($_GET['id']);

// Prepare and execute delete query
$query = $conn->prepare("DELETE FROM contacts WHERE id = ?");
$query->bind_param("i", $contact_id);

if ($query->execute()) {
    // Optionally, set a flash message here before redirecting
    header("Location: manage-contacts.php");
    exit;
} else {
    echo "Error deleting contact: " . $conn->error;
}

$query->close();
?>
