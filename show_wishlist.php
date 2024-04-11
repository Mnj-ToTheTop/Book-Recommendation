<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Book Recommender</title>
</head>
<body>

<?php
session_start();

$servername = "localhost";
$username = "root";
$dbname = "book recom";

$conn = new mysqli($servername, $username, '', $dbname);

if (isset($_SESSION['username'])) {
  $loggedInUsername = $_SESSION['username'];
}

$sql = "SELECT * FROM users WHERE Name='$loggedInUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $user_id = $row['user_id'];
}



echo "<h1> YOUR READ LIST </h1>";

$sql = "SELECT title, author, coverURL FROM booklist WHERE user_id = '$user_id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<div id='books'>";
  foreach($result as $list)
  {
        echo "<div class='book'>";
        echo "<p class='books-title'>". $list['title'] ."</p>";
        echo "<p class='books-author'>". $list['author'] ."</p>";
        $url = $list['coverURL'];
        echo "<br><img src='$url' alt='Book Cover Not Available'>";
        echo "</div>";
  }
  echo "</div>";
}
?>
</body>
</html>
