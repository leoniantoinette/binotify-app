<?php

include '../../config/config.php';

$songData = json_decode($_POST["data"], true);

$songID = $songData["songID"];
$albumID = $songData["albumID"];
$isError = false;

for ($i = 0; $i < count($songID); $i++) {
  $query = "UPDATE song SET album_id = " . $albumID . " WHERE song_id = " . $songID[$i];
  $result = mysqli_query($conn, $query);
  if (!$result) {
    $isError = true;
    break;
  }
}

if ($isError) {
  echo json_encode(array("status" => false));
} else {
  echo json_encode(array("status" => true));
}
