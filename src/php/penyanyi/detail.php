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

// revalidate database
$webservice_url = "http://localhost:8081/service/subscription";
$ip = $_SERVER['SERVER_ADDR'];
$endpoint = "/service/subscription";

$request_param = '<?xml version="1.0" encoding="utf-8"?>
  <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
  <Body>
    <validateDatabase xmlns="http://services.binotify/">
      <arg0 xmlns="">' . $ip . '</arg0>
      <arg1 xmlns="">' . $endpoint . '</arg1>
    </validateDatabase>
  </Body>
</Envelope>';

$headers = array(
  'Content-Type: text/xml; charset=utf-8',
);

$ch = curl_init($webservice_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$data = curl_exec($ch);

$result = $data;

if ($result === FALSE) {
  printf(
    "CURL error (#%d): %s<br>\n",
    curl_errno($ch),
    htmlspecialchars(curl_error($ch))
  );
}

curl_close($ch);

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
