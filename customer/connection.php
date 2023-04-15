<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db= "project";
$default_rc_no="admin";
$default_password="admin";
// Create connection
$conn = mysqli_connect($servername, $db_username, $db_password, $db);

// Check connection
if (!$conn) { 
  die("Connection failed: " . mysqli_connect_error());
  echo "<br>";
} 
?>