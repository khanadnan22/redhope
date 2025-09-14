<?php
// index.php - Landing page (RedHope)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedHope - Hope through Blood Donation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #dc3545 !important;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }
        .hero {
            position: relative;
            background: url('assets/images/hero-banner.png') no-repeat center center/cover;
            color: white;
            padding: 100px 20px;
            border-radius: 15px;
            margin: 20px 0 40px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            text-align: center;
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5); /* overlay for better text visibility */
            border-radius: 15px;
        }
        .hero h1, .hero p {
            position: relative;
            z-index: 1;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
        }
        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s ease-in-out;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
        footer {
            margin-top: 50px;
            padding: 20px 15px;
            background: #212529;
            color: white;
            text-align: center;
            border-radius: 20px;
        }
        footer a {
            color: #f8f9fa;
            margin: 0 10px;
            font-size: 1.2rem;
        }
        footer a:hover {
            color: #dc3545;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="assets/images/logo.png" alt="RedHope Logo" width="40" height="40" class="me-2">
      RedHope
    </a>
  </div>
</nav>

<div class="container mt-4">

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to RedHope ❤️</h1>
        <p class="lead">Hope through blood donation – Connecting Donors, Hospitals & Communities</p>
    </div>

    <!-- Main Actions -->
    <div class="row g-4">
        <!-- Donor Section -->
        <div class="col-md-4">
            <div class="card card-custom text-center p-4">
                <h4 class="text-danger mb-3">Donors</h4>
                <a href="insert.php" class="btn btn-danger mb-2 w-100">Register as Donor</a>
                <a href="donor/login.php" class="btn btn-primary mb-2 w-100">Donor Login</a>
                <a href="search.php" class="btn btn-success w-100">Search Donors</a>
            </div>
        </div>

        <!-- Hospital Section -->
        <div class="col-md-4">
            <div class="card card-custom text-center p-4">
                <h4 class="text-warning mb-3">Hospitals</h4>
                <a href="hospital/login.php" class="btn btn-warning mb-2 w-100">Hospital Login</a>
                <a href="view.php" class="btn btn-info w-100">View All Donors</a>
            </div>
        </div>

        <!-- Admin Section -->
        <div class="col-md-4">
            <div class="card card-custom text-center p-4">
                <h4 class="text-dark mb-3">Admin</h4>
                <a href="admin/login.php" class="btn btn-dark w-100">Admin Login</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <p>
            <i class="fas fa-envelope"></i> <a href="mailto:contact@redhope.org">contact@redhope.org</a> | 
            <i class="fas fa-phone"></i> <a href="tel:+911234567890">+91 12345 67890</a>
        
        
            <a href="https://facebook.com/redhope" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://instagram.com/redhope" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://twitter.com/redhope" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://linkedin.com/company/redhope" target="_blank"><i class="fab fa-linkedin"></i></a>
        
        </p>
         <p>© <?= date('Y'); ?> RedHope | Made with ❤️ to save lives</p>
    </footer>

</div>
</body>
</html>
