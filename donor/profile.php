<?php
session_start();
require '../db.php';

if(!isset($_SESSION['donor'])){
    header("Location: login.php");
    exit;
}

// Fetch donor info
$email = $_SESSION['donor'];
$donor = $conn->query("SELECT * FROM donors WHERE email='$email'")->fetch_assoc();

// Handle profile update
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    $stmt = $conn->prepare("UPDATE donors SET name=?, phone=?, city=? WHERE email=?");
    $stmt->bind_param("ssss",$name,$phone,$city,$email);
    if($stmt->execute()){
        $success = "Profile updated successfully!";
        $donor = $conn->query("SELECT * FROM donors WHERE email='$email'")->fetch_assoc();
    } else {
        $error = "Error: ".$stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Donor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Donor Profile</h2>
    <div class="text-end mb-3">
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>

    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="post" class="mx-auto" style="max-width:500px;">
        <div class="mb-3"><input type="text" name="name" class="form-control" value="<?= htmlspecialchars($donor['name']) ?>" required></div>
        <div class="mb-3"><input type="email" class="form-control" value="<?= htmlspecialchars($donor['email']) ?>" disabled></div>
        <div class="mb-3"><input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($donor['phone']) ?>" required></div>
        <div class="mb-3">
            <select class="form-select" name="blood_group" disabled>
                <option><?= $donor['blood_group'] ?></option>
            </select>
        </div>
        <div class="mb-3"><input type="text" name="city" class="form-control" value="<?= htmlspecialchars($donor['city']) ?>" required></div>
        <div class="text-center"><button class="btn btn-danger w-100">Update Profile</button></div>
    </form>
</div>
</body>
</html>
