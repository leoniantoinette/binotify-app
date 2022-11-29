<?php

include '../../config/config.php';
session_start();

// get user ID
$username = $_SESSION['username'];
$queryGetUserID = "SELECT user_id FROM user WHERE username = '$username'";
$resultGetUserID = mysqli_query($conn, $queryGetUserID);
$rowUserID = mysqli_fetch_assoc($resultGetUserID);
$userID = $rowUserID['user_id'];

// get penyanyi ID
$penyanyiID = $_GET['penyanyiID'];

$songList = file_get_contents("http://localhost:3001/api/list-lagu/user/{$userID}/penyanyi/{$penyanyiID}");
$songList = json_decode($songList);

echo json_encode($songList);
