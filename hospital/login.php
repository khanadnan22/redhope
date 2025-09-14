<?php
session_start();
require '../db.php';

// Redirect if logged in
if(isset($_SESSION['hospital'])){
    header("Location: dashboard.php");
    exit;
}

// Handle login
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM hospitals WHERE email=? AND password=?");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows === 1){
        $_SESSION['hospital'] = $email;
        header("Location: dashboard.php");
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
    <title>Hospital Login | RedHope ❤️</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff5f5;
        }
        .navbar-brand {
            font-weight: bold;
            color: #d9534f !important;
        }
        footer {
            background: #f8d7da;
            padding: 15px 0;
            margin-top: 50px;
        }
        .footer-links a {
            color: #a94442;
            margin: 0 10px;
            text-decoration: none;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .login-box {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="../index.php">RedHope ❤️</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="../contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="../donate.php">Donate</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Login Section -->
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="login-box col-md-6 col-lg-4">
        <h2 class="text-center text-danger mb-4">Hospital Login</h2>
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
        <div class="text-center mt-3">
            <a href="register.php">Don't have an account? Register here</a>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p class="mb-1">&copy; <?php echo date("Y"); ?> RedHope ❤️ - Hope through blood donation.</p>
        <div class="footer-links">
            <a href="mailto:contact@redhope.org">Email</a> |
            <a href="https://facebook.com" target="_blank">Facebook</a> |
            <a href="https://twitter.com" target="_blank">Twitter</a> |
            <a href="https://instagram.com" target="_blank">Instagram</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
