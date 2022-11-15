<?php

include '../../config/config.php';

$albumData = json_decode($_POST["dataAlbum"], true);
$query1 = "UPDATE song SET album_id = NULL where album_id = " . $albumData["albumId"];
$result1 = mysqli_query($conn, $query1);
if ($result1) {
  $query = "DELETE FROM album WHERE album_id = " . $albumData["albumId"];

  $result = mysqli_query($conn, $query);
  if ($result) {
    echo json_encode(array("status" => true));
  } else {
    echo json_encode(array("status" => false));
  }
} else {
  echo json_encode(array("status" => false));
}
