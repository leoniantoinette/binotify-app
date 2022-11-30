<?php

include '../../config/config.php';
session_start();

$listPenyanyi = file_get_contents('http://localhost:3001/api/list-penyanyi');
$listPenyanyi = json_decode($listPenyanyi);

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

if ($resultGetPenyanyiID) {
  echo json_encode(array("listPenyanyi" => $listPenyanyi, "penyanyiID" => $rowsPenyanyiID, "userID" => $userID));
}
