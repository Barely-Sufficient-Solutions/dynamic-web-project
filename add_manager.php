<?php
// Run this once to insert a manager with a hashed password
require_once 'settings.php';
$conn = mysqli_connect($host, $username, $password, $database);

$username = 'admin';
$password_hash = password_hash('admin123', PASSWORD_DEFAULT);

$query = "INSERT INTO managers (username, password) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ss', $username, $password_hash);
mysqli_stmt_execute($stmt);

echo mysqli_stmt_affected_rows($stmt) > 0 ? "Manager added." : "Error.";
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
