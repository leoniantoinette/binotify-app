<?php

include '../../config/config.php';

$postData = json_decode($_POST["data"], true);
$userID = $postData["userID"];
$penyanyiID = $postData["penyanyiID"];

$query = "INSERT INTO subscription (creator_id, subscriber_id)
VALUES (" . $penyanyiID . ", " . $userID . ")";
$result = mysqli_query($conn, $query);

if ($result) {
  echo true;
} else {
  echo false;
}
