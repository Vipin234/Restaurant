<?php
$hostname = 'localhost';
$username = 'root';
$password = 'Goolean@123#';
$database = 'restaurant_db';

$conn = mysqli_connect($hostname,$username,$password,$database);

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>