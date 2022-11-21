<?php
// Mysqli Object Oriented
// used to connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "absensi";
//connected
$conn = mysqli_connect($servername, $username, $password);
//check connection
if (!$conn) {
  die('Connection failed: '.mysqli_connect_error());
}
// Create database
$sql = "CREATE DATABASE IF NOT EXISTS absensi";
if ($conn->query($sql) === TRUE) {
//   echo "Database created successfully";
  $conn = mysqli_connect($servername, $username, $password,$dbName);
} else {
  echo "Error creating database: " . $conn->error."<br><br>";
}
?>