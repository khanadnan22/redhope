<?php
require '../db.php';

// Handle registration
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // simple password
    $city = trim($_POST['city']);

    if(!$name || !$email || !$password || !$city){
        $error = "Please fill all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO hospitals (name,email,password,city) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$name,$email,$password,$city);
        if($stmt->execute()){
            $success = "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            $error = "Error: ".$stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Hospital Registration</h2>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="post" class="mx-auto" style="max-width:400px;">
        <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="Hospital Name" required></div>
        <div class="mb-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
        <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
        <div class="mb-3"><input type="text" name="city" class="form-control" placeholder="City" required></div>
        <div class="text-center"><button class="btn btn-danger w-100">Register</button></div>
    </form>
</div>
</body>
</html>
