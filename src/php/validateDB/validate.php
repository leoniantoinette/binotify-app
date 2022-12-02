<?php

include "../../config/config.php";

function findSubscriptionStatus($creatorID, $subscriberID, $array)
{
  foreach ($array as $element) {
    if ($creatorID == $element["creator_id"] && $subscriberID == $element["subscriber_id"]) {
      return $element["status"];
    }
  }
  return false;
}

function removeSubscription($creatorID, $subscriberID, $array)
{
  foreach ($array as $key => $element) {
    if ($creatorID == $element["creator_id"] && $subscriberID == $element["subscriber_id"]) {
      unset($array[$key]);
    }
  }
  return $array;
}

$listSubscription = $_POST["listSubscription"];
$listSubscription = json_decode($listSubscription, true);

$query = "SELECT * FROM subscription";
$result = mysqli_query($conn, $query);
$listSubscriptionApp = [];
while ($row = mysqli_fetch_assoc($result)) {
  $listSubscriptionApp[] = $row;
}

foreach ($listSubscription as $subscription) {
  $creatorID = $subscription["creator_id"];
  $subscriberID = $subscription["subscriber_id"];
  $status = $subscription["status"];
  $statusApp = findSubscriptionStatus($creatorID, $subscriberID, $listSubscriptionApp);
  if ($statusApp == false) {
    $query = "INSERT INTO subscription (creator_id, subscriber_id, status)
    VALUES (" . $creatorID . ", " . $subscriberID . ", '" . $status . "')";
    $result = mysqli_query($conn, $query);
  } else if ($statusApp != $status) {
    $query = "UPDATE subscription SET status = '" . $status . "' WHERE creator_id = " . $creatorID . " AND subscriber_id = " . $subscriberID;
    $result = mysqli_query($conn, $query);
    $listSubscriptionApp = removeSubscription($creatorID, $subscriberID, $listSubscriptionApp);
  } else {
    $listSubscriptionApp = removeSubscription($creatorID, $subscriberID, $listSubscriptionApp);
  }
}

// check if list is empty
if (empty($listSubscriptionApp)) {
  echo true;
} else {
  foreach ($listSubscriptionApp as $subscription) {
    $creatorID = $subscription["creator_id"];
    $subscriberID = $subscription["subscriber_id"];
    $query = "DELETE FROM subscription WHERE creator_id = " . $creatorID . " AND subscriber_id = " . $subscriberID;
    $result = mysqli_query($conn, $query);
  }
  echo true;
}
