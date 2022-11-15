<?php

include '../config/config.php';

$query = "SELECT email, username, isAdmin FROM user";
$result = mysqli_query($conn, $query);
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

if ($result) {
  $response = $rows;
  echo json_encode($response);
}
