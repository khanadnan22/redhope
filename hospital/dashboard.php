<?php
session_start();
require '../db.php';

// Check login
if(!isset($_SESSION['hospital'])){
    header("Location: login.php");
    exit;
}

// Fetch hospital info
$email = $_SESSION['hospital'];
$hospital = $conn->query("SELECT * FROM hospitals WHERE email='$email'")->fetch_assoc();

// Count requests posted
$total_requests = $conn->query("SELECT COUNT(*) as total FROM blood_requests WHERE hospital_id=".$hospital['id'])->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Welcome, <?= htmlspecialchars($hospital['name']) ?></h2>
    <div class="text-end mb-3">
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
    <div class="row text-center">
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Blood Requests</h5>
                    <p class="card-text fs-3"><?= $total_requests ?></p>
                    <a href="post_request.php" class="btn btn-light">Post Request</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Search Donors</h5>
                    <p class="card-text fs-5">Find available donors by blood group and city</p>
                    <a href="../search.php" class="btn btn-light">Search Donors</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
