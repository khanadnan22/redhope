<?php
session_start();
require '../db.php';

// Redirect if already logged in
if(isset($_SESSION['donor'])){
    header("Location: profile.php");
    exit;
}

// Handle login
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM donors WHERE email=? AND password=?");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows === 1){
        $_SESSION['donor'] = $email;
        header("Location: profile.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donor Login | RedHope</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding-bottom: 80px; /* prevent overlap with footer */
    }
    .navbar {
      background-color: #dc3545 !important;
    }
    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: white !important;
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    footer {
      padding: 15px;
      background: #dc3545;
      color: white;
      text-align: center;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
    }
    footer a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
    }
    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<!-- Navbar with links -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="../index.php">
      <img src="../assets/images/logo.png" alt="RedHope Logo" width="40" height="40" class="me-2">
      RedHope
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="../view.php">Donors</a></li>
        <li class="nav-item"><a class="nav-link" href="../hospital/login.php">Hospitals</a></li>
        <li class="nav-item"><a class="nav-link" href="../admin/login.php">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="../#contact">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Login Form -->
<div class="login-box">
  <h2 class="text-center text-danger mb-4">Donor Login</h2>
  <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="post">
    <div class="mb-3">
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="d-grid">
      <button class="btn btn-danger">Login</button>
    </div>
  </form>
  <div class="text-center mt-2">
    <a href="../insert.php">Don't have an account? <b>Register here</b></a>
  </div>
</div>

<!-- Footer -->
<footer>
  <p>© <?= date('Y'); ?> RedHope | Made with ❤️ to save lives</p>
  <p>
    <a href="mailto:contact@redhope.com">Email</a> |
    <a href="#">Facebook</a> |
    <a href="#">Twitter</a> |
    <a href="#">Instagram</a>
  </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
