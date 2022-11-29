<?php

include '../../config/config.php';
session_start();

// get user ID
$username = $_SESSION['username'];
$queryGetUserID = "SELECT user_id FROM user WHERE username = '$username'";
$resultGetUserID = mysqli_query($conn, $queryGetUserID);
$rowUserID = mysqli_fetch_assoc($resultGetUserID);
$userID = $rowUserID['user_id'];

// get penyanyi ID that user subscribed
$queryGetPenyanyiID = "SELECT creator_id FROM subscription WHERE subscriber_id = '$userID' AND status = 'ACCEPTED'";
$resultGetPenyanyiID = mysqli_query($conn, $queryGetPenyanyiID);
$rowsPenyanyiID = [];
while ($row = mysqli_fetch_assoc($resultGetPenyanyiID)) {
  $rowsPenyanyiID[] = $row;
}
$penyanyiID = array_column($rowsPenyanyiID, 'creator_id');

// get all song list
$songList = [];

foreach ($penyanyiID as $id) {
  $songs = file_get_contents("http://localhost:3001/api/list-lagu/user/{$userID}/penyanyi/{$id}");
  $songs = json_decode($songs);
  if ($songs != "") {
    $songList = array_merge((array)$songList, (array)$songs);
  }
}

// get list penyanyi
$listPenyanyi = file_get_contents('http://localhost:3001/api/list-penyanyi');
$listPenyanyi = json_decode($listPenyanyi);

echo json_encode(array("songList" => $songList, "listPenyanyi" => $listPenyanyi));
