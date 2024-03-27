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
  $count = 0; // Counter to track displayed works
  foreach ($subjectData['works'] as $work) {
    if ($count < 5) { // Only display up to 5 works
      echo "<div class='book'>";

      $authorName = isset($work['authors'][0]['name']) ? $work['authors'][0]['name'] : 'Unknown Author';
      echo "<p class='books-title'>$work[title]</p>";
      echo "<p class='books-author'>$authorName</p>";

      if (isset($work['cover_id'])) {
        $coverUrl = "http://covers.openlibrary.org/b/id/$work[cover_id].jpg";
        echo "<br><img src='$coverUrl' alt='Book Cover Not Available'>";
      }
      echo "</div>";
      $count++;
    }
  }
  echo "</div>";

} else {
  echo "No related works found for this subject.";
}
?>

</body>
</html>
