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
    echo "Invalid contact ID.";
    exit;
}

$contact_id = intval($_GET['id']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $query = "
        UPDATE contacts
        SET name='$name',
            email='$email',
            phone='$phone',
            message='$message'
        WHERE id=$contact_id
    ";

    if ($conn->query($query)) {
        header("Location: manage-contacts.php");
        exit;
    } else {
        echo "Error updating contact: " . $conn->error;
    }
}

// Fetch current contact
$query = "SELECT * FROM contacts WHERE id = $contact_id";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    echo "Contact not found.";
    exit;
}

$contact = $result->fetch_assoc();
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
    <!-- Manage contacts -->
    <section id="contacts">
      <div>&nbsp;</div>
      <div>&nbsp;</div>
      <h3>Edit Contact #<?php echo str_pad($contact['id'], 3, '0', STR_PAD_LEFT); ?></h3>
      <div class="table-responsive">

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $contact['name']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $contact['email']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $contact['phone']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Message</label>
                <input type="text" name="message" class="form-control" value="<?php echo $contact['message']; ?>" required>
            </div>
            <div class="col-12 text-end">
                <a href="manage-contacts.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>

      </div>
    </section>

    <hr />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
