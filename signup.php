<?php
session_start();

// Database connection details (replace with your credentials)
$servername = "localhost";
$username = "root";
$dbname = "book recom";

$conn = new mysqli($servername, $username, '', $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$newUsername = $_POST['new-username'];
$newPassword = $_POST['new-password'];
$userNewId = $_POST['new-user_id'];

// Improve validation to check for existing usernames etc. (replace with more robust checks)
if (empty($newUsername) || empty($newPassword) || empty($userNewId)) {
  echo "Please fill in all fields.";
  exit();
}

$sql = "INSERT INTO users (user_id, Name, Password) VALUES ('$userNewId', '$newUsername', '$newPassword')";

if ($conn->query($sql) === TRUE) {
  $_SESSION['user_id'] = $userNewId;
  header('Location: welcome.php'); // Redirect to a welcome page
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
