<?php

include '../../config/config.php';

$songData = json_decode($_POST["dataSong"], true);

$query = "DELETE FROM song WHERE song_id = " . $songData["songId"];


  $result = mysqli_query($conn, $query);
  if ($result) {
    echo json_encode(array("status" => true));
  } else {
    echo json_encode(array("status" => false));
  }

