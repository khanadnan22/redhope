<?php
require 'db.php';

// Handle form submission
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $blood_group = trim($_POST['blood_group']);
    $city = trim($_POST['city']);

    if(!$name || !$email || !$phone || !$blood_group || !$city){
        die('Please fill all fields.');
    }

    $stmt = $conn->prepare("INSERT INTO donors (name,email,phone,blood_group,city) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssss',$name,$email,$phone,$blood_group,$city);
    if($stmt->execute()){
        echo "<div class='container mt-5'><div class='alert alert-success'>Registration successful. <a href='index.php'>Back</a></div></div>";
    } else {
        echo "<div class='container mt-5'><div class='alert alert-danger'>Error: ".$stmt->error."</div></div>";
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Donor Registration</h2>
    <form method="post">
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="phone" placeholder="Phone" required>
        </div>
        <div class="mb-3">
            <select class="form-select" name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option>A+</option><option>A-</option>
                <option>B+</option><option>B-</option>
                <option>O+</option><option>O-</option>
                <option>AB+</option><option>AB-</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="city" placeholder="City" required>
        </div>
        <div class="text-center">
            <button class="btn btn-danger w-50">Register</button>
        </div>
    </form>
</div>
</body>
</html>
