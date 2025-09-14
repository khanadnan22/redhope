<?php
// db.php - Database connection for blood_portal
$DB_HOST = 'localhost';
$DB_USER = 'root';      // Default XAMPP user
$DB_PASS = '';          // Default XAMPP password
$DB_NAME = 'blood_portal';

// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
