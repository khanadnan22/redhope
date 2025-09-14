<?php
session_start();
require '../db.php';

if(!isset($_SESSION['hospital'])){
    header("Location: login.php");
    exit;
}

$email = $_SESSION['hospital'];
$hospital = $conn->query("SELECT * FROM hospitals WHERE email='$email'")->fetch_assoc();

// Handle form submission
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];
    $city = $_POST['city'];
    $date_needed = $_POST['date_needed'];

    $stmt = $conn->prepare("INSERT INTO blood_requests (hospital_id,blood_group,units,city,date_needed) VALUES (?,?,?,?,?)");
    $stmt->bind_param("issss",$hospital['id'],$blood_group,$units,$city,$date_needed);
    
    if($stmt->execute()){
        // Redirect to dashboard after posting request
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Error: ".$stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Post Blood Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-danger mb-4">Post Blood Request</h2>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post" class="mx-auto" style="max-width:500px;">
        <div class="mb-3">
            <select class="form-select" name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option>A+</option><option>A-</option>
                <option>B+</option><option>B-</option>
                <option>O+</option><option>O-</option>
                <option>AB+</option><option>AB-</option>
            </select>
        </div>
        <div class="mb-3"><input type="number" name="units" class="form-control" placeholder="Units Needed" required></div>
        <div class="mb-3"><input type="text" name="city" class="form-control" placeholder="City" value="<?= htmlspecialchars($hospital['city']) ?>" required></div>
        <div class="mb-3"><input type="date" name="date_needed" class="form-control" required></div>
        <div class="text-center"><button class="btn btn-danger w-100">Post Request</button></div>
    </form>
</div>
</body>
</html>
