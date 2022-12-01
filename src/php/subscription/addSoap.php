<?php

include '../../config/config.php';

$postData = json_decode($_POST["data"], true);
$userID = $postData["userID"];
$penyanyiID = $postData["penyanyiID"];

// soap
$webservice_url = "http://localhost:8081/service/subscription";
$ip = $_SERVER['SERVER_ADDR'];
$endpoint = "/service/subscription";

$request_param = '<?xml version="1.0" encoding="utf-8"?>
  <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
      <Body>
          <addSubscription xmlns="http://services.binotify/">
              <arg0 xmlns="">' . $ip . '</arg0>
              <arg1 xmlns="">' . $endpoint . '</arg1>
              <arg2 xmlns="">' . $penyanyiID .  '</arg2>
              <arg3 xmlns="">' . $userID . '</arg3>
          </addSubscription>
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

echo $data;
