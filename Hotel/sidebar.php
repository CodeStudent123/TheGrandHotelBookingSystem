<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-white text-center"><a href="dashboard.php">CHARLES HOTEL</a></h4>
    <a href="dashboard.php" class="active">Manage Bookings</a>
    <a href="manage-contacts.php" class="active">Manage Contacts</a>
    <a href="manage-users.php" class="active">Manage Users</a>
    <a href="logout.php">Logout</a>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-dark px-4">
    <span class="navbar-brand"><a href="dashboard.php">Dashboard</a> | Welcome <?=$_SESSION['username']?></span>
  </nav>
