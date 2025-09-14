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

// Handle search form
$donors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];

    $stmt = $conn->prepare("SELECT * FROM donors WHERE blood_group=? AND city=?");
    $stmt->bind_param("ss",$blood_group,$city);
    $stmt->execute();
    $donors = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">View Donors</h2>
    <div class="text-end mb-3">
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <form method="post" class="row g-3 mb-4">
        <div class="col-md-4">
            <select class="form-select" name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option>A+</option><option>A-</option>
                <option>B+</option><option>B-</option>
                <option>O+</option><option>O-</option>
                <option>AB+</option><option>AB-</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" name="city" class="form-control" placeholder="City" required>
        </div>
        <div class="col-md-4">
            <button class="btn btn-danger w-100">Search Donors</button>
        </div>
    </form>

    <?php if(count($donors) > 0){ ?>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Blood Group</th><th>City</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($donors as $donor){ ?>
            <tr>
                <td><?= $donor['id'] ?></td>
                <td><?= htmlspecialchars($donor['name']) ?></td>
                <td><?= htmlspecialchars($donor['email']) ?></td>
                <td><?= htmlspecialchars($donor['phone']) ?></td>
                <td><?= $donor['blood_group'] ?></td>
                <td><?= htmlspecialchars($donor['city']) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } elseif($_SERVER['REQUEST_METHOD'] === 'POST'){ ?>
        <div class="alert alert-warning">No donors found for selected blood group and city.</div>
    <?php } ?>
</div>
</body>
</html>
