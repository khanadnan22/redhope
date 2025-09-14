<?php
session_start();
require '../db.php';

// Check login
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

// Stats
$total_donors = $conn->query("SELECT COUNT(*) as total FROM donors")->fetch_assoc()['total'];
$total_requests = 0; // Placeholder for future requests table
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Admin Dashboard</h2>
    <div class="text-end mb-3">
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>

    <div class="row text-center">
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Donors</h5>
                    <p class="card-text fs-3"><?= $total_donors ?></p>
                    <a href="manage_donors.php" class="btn btn-light">Manage Donors</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Requests</h5>
                    <p class="card-text fs-3"><?= $total_requests ?></p>
                    <a href="request_status.php" class="btn btn-light">Manage Requests</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
