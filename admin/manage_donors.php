<?php
session_start();
require '../db.php';

// Check login
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

// Handle delete
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM donors WHERE id=$id");
    header("Location: manage_donors.php");
    exit;
}

// Fetch all donors
$result = $conn->query("SELECT * FROM donors ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Manage Donors</h2>
    <div class="text-end mb-3">
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Blood Group</th><th>City</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=$result->fetch_assoc()){ ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= $row['blood_group'] ?></td>
                <td><?= htmlspecialchars($row['city']) ?></td>
                <td>
                    <a href="manage_donors.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
