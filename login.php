<?php
session_start();

$servername = "localhost";
$username = "root";
$dbname = "book recom";

$conn = new mysqli($servername, $username, '', $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE user_id='$user_id' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $Name = $row['Name'];
  $_SESSION['username'] = $Name;
  header('Location: welcome.php'); // Redirect to a welcome page
} else {
  echo "Invalid user_id or password";
}

?>
