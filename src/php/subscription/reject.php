<?php

include '../../config/config.php';

$creatorID = $_POST["creatorID"];
$subscriberID = $_POST["subscriberID"];

$query = "UPDATE subscription SET status = 'REJECTED' WHERE creator_id = " . $creatorID . " AND subscriber_id = " . $subscriberID;
$result = mysqli_query($conn, $query);

if ($result) {
  echo true;
} else {
  echo false;
}
