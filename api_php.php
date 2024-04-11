<?php
$subject = $_GET['subject'];

function fetchData($subject) {
  $url = "https://openlibrary.org/subjects/$subject.json";
  $curl = curl_init($url);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curl);

  if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    curl_close($curl);
    return "Error: $error_msg";
  }

  curl_close($curl);

  $data = json_decode($response, true);

  if (isset($data['error'])) {
    return "Error: " . $data['error']['message'];
  }

  return $data;
}

$subjectData = fetchData($subject);

if (is_string($subjectData)) {
  echo $subjectData;
  exit;
}

$htmlOutput = "";

$htmlOutput .= "<h1>Genre: " . $subjectData['name'] . "</h1>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Recommended</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
echo $htmlOutput;

if (isset($subjectData['works'])) {
  echo "<div id='books'>";
    
    shuffle($subjectData['works']);
  
    $count = 0;
    foreach ($subjectData['works'] as $work) {
      if ($count < 5) {
        $authorName = isset($work['authors'][0]['name']) ? $work['authors'][0]['name'] : 'Unknown Author';
  
        echo "<div class='book'>";
        echo "<p class='books-title'>$work[title]</p>";
        echo "<p class='books-author'>$authorName</p>";
  
        if (isset($work['cover_id'])) {
          $coverUrl = "http://covers.openlibrary.org/b/id/$work[cover_id].jpg";
          echo "<br><img src='$coverUrl' alt='Book Cover Not Available'>";
        }
  
        // Add form to submit book title and author for wishlist
        echo "<form action='add_to_wishlist.php' method='post'>";
        echo "<input type='hidden' name='title' value='$work[title]'>";
        echo "<input type='hidden' name='author' value='$authorName'>";
        echo "<input type='hidden' name='cover' value='$coverUrl'>";
        echo "<button type='submit' onclick='alert('Book Added')'>Add to Read List</button>";
        echo "</form>";
  
        echo "</div>";
        $count++;
      }
    }
    echo "</div>";
  } else {
    echo "No related works found for this subject.";
  }
?>

</br>

<h1> Want to search another genre? </h1></br>
  <form id="forms" action="api_php.php" method="get" > <label for="subject">Enter another genre: </label>
    <input type="text" id="subject" name="subject" oninput="validateInput()" required>
    <div id='message'></div>
    <br>
    <button type="submit">Search</button>
  </form></br>

</body>
</html>
