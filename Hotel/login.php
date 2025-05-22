<?php
session_start();
require 'db.php';

$error = '';
$username = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $query->store_result();

    if ($query->num_rows === 1) {
        $query->bind_result($userId, $hashedPassword);
        $query->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that username/email.";
    }

    $query->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - CHARLES HOTEL APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #121212;
      color: #ffffff;
    }
    .login-container {
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
    <div class="login-container">
    <h2>CHARLES HOTEL APP</h2>
    <h4 class="text-center mb-4">Login</h4>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?=$username ? $username : '' ?>" placeholder="Enter Username" required />
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required />
        </div>
        <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe" />
        <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="mt-3 text-center">
        <a href="#" class="text-light text-decoration-none">Forgot Password?</a> | <a href="register.php" class="text-light text-decoration-none">Register</a> | <a href="index.php" class="text-light text-decoration-none">Home</a>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
