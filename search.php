<?php
require 'db.php';

$blood = $_GET['blood'] ?? '';
$city = $_GET['city'] ?? '';

$query = "SELECT * FROM donors WHERE 1";
$params = [];
$types = '';

if($blood){ $query .= " AND blood_group=?"; $params[]=$blood; $types.='s'; }
if($city){ $query .= " AND city LIKE ?"; $params[]="%$city%"; $types.='s'; }

$stmt = $conn->prepare($query);
if($params){ $stmt->bind_param($types,...$params); }
$stmt->execute();
$res = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>Search Donors</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h3 class="text-center text-danger">Search Donors</h3>
<form method="get" class="row g-2 mb-3">
<div class="col-md-4">
<select class="form-select" name="blood">
<option value="">Blood Group</option>
<option>A+</option><option>A-</option><option>B+</option><option>B-</option>
<option>O+</option><option>O-</option><option>AB+</option><option>AB-</option>
</select>
</div>
<div class="col-md-6"><input type="text" name="city" class="form-control" placeholder="City (optional)"></div>
<div class="col-md-2"><button class="btn btn-danger w-100">Search</button></div>
</form>
<table class="table table-bordered">
<thead class="table-dark"><tr><th>ID</th><th>Name</th><th>Phone</th><th>Blood</th><th>City</th></tr></thead>
<tbody>
<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= htmlspecialchars($row['name']) ?></td>
<td><?= htmlspecialchars($row['phone']) ?></td>
<td><?= $row['blood_group'] ?></td>
<td><?= htmlspecialchars($row['city']) ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div class="text-center mt-3"><a href="index.php" class="btn btn-secondary">Back</a></div>
</div>
<?php $stmt->close(); $conn->close(); ?>
</body>
</html>
