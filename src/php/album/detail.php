<?php

include '../../config/config.php';

$albumData = json_decode($_POST["dataAlbum"], true);

if (isset($_FILES['cover'])) {
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
    $query = "UPDATE album SET Judul = '" . $albumData["judul"] . "', Tanggal_terbit = '" . $albumData["tanggalTerbit"] . "', Genre = '" . $albumData["genre"] . "', Image_path = '" . $relative_path . "' WHERE album_id = " . $albumData["albumId"];
    $result = mysqli_query($conn, $query);
    if ($result) {
      echo json_encode(array("status" => true));
    } else {
      echo json_encode(array("status" => false));
    }
  }
} else {
  $query = "UPDATE album SET Judul = '" . $albumData["judul"] . "', Tanggal_terbit = '" . $albumData["tanggalTerbit"] . "', Genre = '" . $albumData["genre"] . "' WHERE album_id = " . $albumData["albumId"];
  $result = mysqli_query($conn, $query);
  if ($result) {
    echo json_encode(array("status" => true));
  } else {
    echo json_encode(array("status" => false));
  }
}
