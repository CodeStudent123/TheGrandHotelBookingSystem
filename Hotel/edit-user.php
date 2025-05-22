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
    echo "Invalid user ID.";
    exit;
}

$user_id = intval($_GET['id']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $query = "
        UPDATE users
        SET name='$name',
            username='$username',
            email='$email'
        WHERE id=$user_id
    ";

    if ($conn->query($query)) {
        header("Location: manage-users.php");
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

// Fetch current user
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    echo "User not found.";
    exit;
}

$user = $result->fetch_assoc();
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
    <!-- Manage users -->
    <section id="users">
      <div>&nbsp;</div>
      <div>&nbsp;</div>
      <h3>Edit User #<?php echo str_pad($user['id'], 3, '0', STR_PAD_LEFT); ?></h3>
      <div class="table-responsive">

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="col-12 text-end">
                <a href="manage-users.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>

      </div>
    </section>

    <hr />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
