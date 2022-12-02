<?php

include '../../config/config.php';
include '../../environtment.php';
session_start();

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
      <arg2 xmlns="">' . $API_KEY . '</arg2>

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
