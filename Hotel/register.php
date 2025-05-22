<?php
session_start();
require 'db.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if username already exists
    $query = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $query->bind_param("ss", $username, $email);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $error = "Username or email is already registered.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $now = date("Y-m-d H:i:s");
        $query = $conn->prepare("INSERT INTO users (name, username, email, password, created_at) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("sssss", $name, $username, $email, $hashedPassword, $now);

        if ($query->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Registration failed. Try again.";
        }
    }

    $query->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - CHARLES HOTEL APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #121212;
      color: #ffffff;
    }
    .register-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      background-color: #1f1f1f;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.6);
    }
    .form-control {
      background-color: #2c2c2c;
      border: 1px solid #444;
      color: #fff;
    }
    .form-control::placeholder {
      color: #aaa;
    }
    .btn-primary {
      background-color: #0066cc;
      border: none;
    }
    .btn-primary:hover {
      background-color: #005bb5;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>CHARLES HOTEL APP</h2>
    <h4 class="text-center mb-4">Register</h4>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?=$name ? $name : '' ?>" placeholder="Enter Name" required />
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?=$username ? $username : '' ?>" placeholder="Enter Username" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email" value="<?=$email ? $email : '' ?>" placeholder="Enter Email" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required />
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    <div class="mt-3 text-center">
        <a href="login.php" class="text-light text-decoration-none">Back to Login</a> | <a href="index.php" class="text-light text-decoration-none">Home</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
