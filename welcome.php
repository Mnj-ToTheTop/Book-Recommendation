<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Book Recommender</title>
</head>
<body>
  <script>
    function validateInput()
    {
        const userInput = document.getElementById("subject").value.trim();
        const messageDiv = document.getElementById('message');

        if(userInput.includes(" "))
        {
            messageDiv.textContent = "Please enter only one word.";
        }

        else
        {
            messageDiv.textContent = "";
        }
    }
  </script>
  <h1>Book Recommender</h1>
  <?php
    session_start();
    if (isset($_SESSION['username'])) {
      $loggedInUsername = $_SESSION['username'];
    }
    echo "<h2>Welcome, ". $loggedInUsername ."!</h2>";
  ?>
  <form id="forms" action="api_php.php" method="get" > <label for="subject">Enter a genre: </label><br>
    <input type="text" id="subject" name="subject" oninput="validateInput()" required>
    <div id='message'></div>
    <br>
    <button type="submit" class="center">Search</button>
  </form>
  <form id="forms2" action="show_wishlist.php">
    <button type="submit" class="center">See Read List</button>
  </form>
</body>
</html>