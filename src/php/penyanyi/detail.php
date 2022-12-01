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

// get subscription list
$queryGetSubscription = "SELECT creator_id, status FROM subscription WHERE subscriber_id = $userID";
$resultGetSubscription = mysqli_query($conn, $queryGetSubscription);
$subscriptionList = [];
while ($rowSubscription = mysqli_fetch_assoc($resultGetSubscription)) {
  $subscriptionList[] = $rowSubscription;
}

if ($resultGetSubscription) {
  echo json_encode(array("listPenyanyi" => $listPenyanyi, "subscriptionList" => $subscriptionList, "userID" => $userID));
}
