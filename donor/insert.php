<?php
require 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $blood_group = $_POST['blood_group'];
    $city = trim($_POST['city']);
    $password = trim($_POST['password']); // simple password

    // Check for empty fields
    if(!$name || !$email || !$phone || !$blood_group || !$city || !$password){
        $error = "Please fill all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO donors (name,email,phone,blood_group,city,password) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$name,$email,$phone,$blood_group,$city,$password);
        if($stmt->execute()){
            $success = "Registration successful. <a href='donor/login.php'>Login here</a>";
        } else {
            $error = "Error: ".$stmt->error;
        }
    }
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
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="post" class="mx-auto" style="max-width:500px;">
        <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="Full Name" required></div>
        <div class="mb-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
        <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="Phone" required></div>
        <div class="mb-3">
            <select class="form-select" name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option>A+</option><option>A-</option>
                <option>B+</option><option>B-</option>
                <option>O+</option><option>O-</option>
                <option>AB+</option><option>AB-</option>
            </select>
        </div>
        <div class="mb-3"><input type="text" name="city" class="form-control" placeholder="City" required></div>
        <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
        <div class="text-center"><button class="btn btn-danger w-100">Register</button></div>
    </form>
</div>
</body>
</html>
