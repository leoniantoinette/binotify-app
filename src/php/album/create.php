<?php

include '../../config/config.php';

$albumData = json_decode($_POST["dataAlbum"], true);

$target_dir = "../../assets/CoverImages/";
$file_name_comp = basename($_FILES['cover']['name']);

$extension = pathinfo($file_name_comp, PATHINFO_EXTENSION);
$file_name = pathinfo($file_name_comp, PATHINFO_FILENAME);
$file_name_ori = $file_name;

// Check if file already exists
$num = 1;
while (file_exists($target_dir . $file_name . "." . $extension)) {
  $file_name = (string) $file_name_ori . $num;
  $file_name_comp = $file_name . "." . $extension;
  $num++;
}

$target_file = $target_dir . $file_name_comp;
$relative_path = "assets/CoverImages/" . $file_name_comp;

// upload file
$isUploaded = move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);
if (!$isUploaded) {
  echo json_encode(array("status" => false));
} else {
  $query = "INSERT INTO album (Judul, Penyanyi, Total_duration, Image_path, Tanggal_terbit, Genre) 
  VALUES ('" . $albumData["judul"] . "', '" . $albumData["penyanyi"] . "', 0, '" . $relative_path . "', '" . $albumData["tanggalTerbit"] . "', '" . $albumData["genre"] . "')";
  $result = mysqli_query($conn, $query);
  // get id of the album
  $qgetID = "SELECT album_id FROM album ORDER BY album_id DESC LIMIT 1";
  $resultID = mysqli_query($conn, $qgetID);
  $albumID = mysqli_fetch_assoc($resultID);
  if ($result and $resultID) {
    echo json_encode(array("status" => true, "id" => $albumID["album_id"]));
  } else {
    echo json_encode(array("status" => false));
  }
}
