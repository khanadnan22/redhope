<?php
require 'db.php';
$result = $conn->query("SELECT * FROM donors ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Registered Donors</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Blood Group</th><th>City</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= $row['blood_group'] ?></td>
                <td><?= htmlspecialchars($row['city']) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </div>
</div>
<?php $conn->close(); ?>
</body>
</html>
