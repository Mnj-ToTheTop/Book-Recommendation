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

$htmlOutput .= "<h1>Subject: " . $subjectData['name'] . "</h1>";

echo "<h1>Subject: " . $subjectData['name'] . "</h1>";

if (isset($subjectData['works'])) {
  echo "<h2>Related Works:</h2>";
  echo "<ul>";
  foreach ($subjectData['works'] as $work) {
    echo "<li>";

    $authorName = isset($work['authors'][0]['name']) ? $work['authors'][0]['name'] : 'Unknown Author';
    echo "<p>$work[title] by $authorName</p>";


    if (isset($work['cover_id'])) {
      $coverUrl = "http://covers.openlibrary.org/b/id/$work[cover_id].jpg";
      echo "<br><img src='$coverUrl' alt='Book Cover Not Available'>";
    }
    echo "</li>";
  }
  echo "</ul>";
} else {
  echo "No related works found for this subject.";
}

?>
