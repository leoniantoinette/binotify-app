<?php

include '../../config/config.php';

$songData = json_decode($_POST["dataSong"], true);

$target_dir_cover = "../../assets/CoverImages/";
$coverfile_name_comp = basename($_FILES['cover']['name']);

$target_dir_audio = "../../assets/Song/";
$audiofile_name_comp = basename($_FILES['audio']['name']);

function checkFile($file_name_comp, $target_dir)
{
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

  return $file_name_comp;
}

$coverfile_name_comp = checkFile($coverfile_name_comp, $target_dir_cover);
$audiofile_name_comp = checkFile($audiofile_name_comp, $target_dir_audio);
$target_coverfile = $target_dir_cover . $coverfile_name_comp;
$target_audiofile = $target_dir_audio . $audiofile_name_comp;
$relative_path_cover = "assets/CoverImages/" . $coverfile_name_comp;
$relative_path_audio = "assets/Song/" . $audiofile_name_comp;

// upload file
$isCoverUploaded = move_uploaded_file($_FILES["cover"]["tmp_name"], $target_coverfile);
$isAudioUploaded = move_uploaded_file($_FILES["audio"]["tmp_name"], $target_audiofile);
if (!$isCoverUploaded or !$isAudioUploaded) {
  echo json_encode(array("status" => false));
} else {
  $query = "INSERT INTO song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path) 
  VALUES ('" . $songData["judul"] . "', '" . $songData["penyanyi"] . "', '" . $songData["tanggalTerbit"] . "', '" . $songData["genre"] . "', '" . $songData["duration"] . "', '" . $relative_path_audio . "', '" . $relative_path_cover . "')";
  $result = mysqli_query($conn, $query);
  // get id of the song
  $qgetID = "SELECT song_id FROM song ORDER BY song_id DESC LIMIT 1";
  $resultID = mysqli_query($conn, $qgetID);
  $songID = mysqli_fetch_assoc($resultID);
  if ($result and $resultID) {
    echo json_encode(array("status" => true, "id" => $songID["song_id"]));
  } else {
    echo json_encode(array("status" => false));
  }
}
