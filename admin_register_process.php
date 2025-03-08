<?php
// Include database connection file
include_once "db_connections.php";

// Get form data
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into admin table
$insert_admin_query = "INSERT INTO admin (AdminID) VALUES ('$name')";
mysqli_query($conn, $insert_admin_query);

// Get the auto-generated AdminID
$admin_id = mysqli_insert_id($conn);

// Insert into adminlogin table
$insert_admin_login_query = "INSERT INTO adminlogin (Password, AdminID) VALUES ('$hashed_password', '$admin_id')";
mysqli_query($conn, $insert_admin_login_query);

// Close database connection
mysqli_close($conn);

// Redirect
header("Location: admin_dashboard.php");
exit();
?>
