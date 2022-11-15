<?php

include '../../config/config.php';

$songData = json_decode($_POST["dataSong"], true);

$query = "UPDATE song SET album_id = NULL WHERE song_id = " . $songData["songId"];
  $result = mysqli_query($conn, $query);
  if ($result) {
    echo json_encode(array("status" => true));
  } else {
    echo json_encode(array("status" => false));
  }

