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

// Fetch all blood requests by this hospital
$requests = $conn->query("SELECT * FROM blood_requests WHERE hospital_id=".$hospital['id']." ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Request Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Your Blood Requests</h2>
    <div class="text-end mb-3">
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <?php if(count($requests) > 0){ ?>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Blood Group</th>
                <th>Units</th>
                <th>City</th>
                <th>Date Needed</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($requests as $req){ ?>
            <tr>
                <td><?= $req['id'] ?></td>
                <td><?= $req['blood_group'] ?></td>
                <td><?= $req['units'] ?></td>
                <td><?= htmlspecialchars($req['city']) ?></td>
                <td><?= $req['date_needed'] ?></td>
                <td>
                    <?= isset($req['status']) ? htmlspecialchars($req['status']) : 'Pending' ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <div class="alert alert-info">You have not posted any blood requests yet.</div>
    <?php } ?>
</div>
</body>
</html>
