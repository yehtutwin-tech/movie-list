<?php
include_once('dbConnection.php');

$keyword = 'thor';
 
// From URL to get webpage contents.
$url = "https://www.omdbapi.com/?apikey=[apiKey]&s=$keyword";
 
// Initialize a CURL session.
$ch = curl_init();

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);
 
$result = curl_exec($ch);

$data = json_decode($result);

$movies = $data->Search;

foreach($movies as $movie) {
  $title = $movie->Title;
  $year = $movie->Year;
  $type = $movie->Type;
  $poster = $movie->Poster;

  $type_search = "SELECT * FROM types WHERE name='$type'";
  $type_result = $conn->query($type_search);
  if ($type_result->num_rows) {
    $type_row = $type_result->fetch_assoc();
    $type_id = $type_row['id'];
  } else {
    $type_sql = "INSERT INTO types (`name`, `created_at`, `updated_at`) VALUES ('$type', now(), now())";
    $type_result = $conn->query($type_sql);
    $type_id = $conn->insert_id;
  }

  $sql = "INSERT INTO movies (`title`, `year`, `type_id`, `poster`, `created_at`, `updated_at`) VALUES ('$title', '$year', '$type_id', '$poster', now(), now())";

  $result = $conn->query($sql);

  if (!$result) {
    die('query failed: ' . $conn->error);
  }
}
 
?>