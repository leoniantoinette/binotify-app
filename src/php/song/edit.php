<?php
ini_set('display_errors', 1); error_reporting(-1);
include '../../config/config.php';

$songData = json_decode($_POST["dataSong"], true);

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
  
    return $target_dir . $file_name_comp;
  }

if(isset($_FILES['cover']) && isset($_FILES['audio'])){
  $target_dir_cover = "../../assets/CoverImages/";
  $path_dir_cover ="assets/CoverImages/";
  $coverfile_name_comp = basename($_FILES['cover']['name']);
  
  $target_dir_audio = "../../assets/Song/";
  $path_dir_audio ="assets/Song/";
  $audiofile_name_comp = basename($_FILES['audio']['name']);
  
  $target_coverfile = checkFile($coverfile_name_comp, $target_dir_cover);
  $target_audiofile = checkFile($audiofile_name_comp, $target_dir_audio);
  $path_coverfile = checkFile($coverfile_name_comp, $path_dir_cover);
  $path_audiofile = checkFile($audiofile_name_comp, $path_dir_audio);
  
  // upload file
  $isCoverUploaded = move_uploaded_file($_FILES["cover"]["tmp_name"], $target_coverfile);
  $isAudioUploaded = move_uploaded_file($_FILES["audio"]["tmp_name"], $target_audiofile);
  if (!$isCoverUploaded or !$isAudioUploaded) {
    echo json_encode(array("status" => false));
  } else {
    $query = "UPDATE song SET Judul = '" . $songData["judul"] . "', Tanggal_terbit = '" . $songData["tanggalTerbit"] . "', Genre = '" . $songData["genre"] . "', Duration = '" . $songData["duration"] . "', Audio_path = '" . $path_audiofile . "', Image_path = '" . $path_coverfile . "' WHERE song_id = " . $songData["songId"];
  
    $result = mysqli_query($conn, $query);
    if ($result) {
      echo json_encode(array("status" => true));
    } else {
      echo json_encode(array("status" => false));
    }
  }
  
} 
else if (!isset($_FILES['cover']) && isset($_FILES['audio'])){
  $target_dir_audio = "../../assets/Song/";
  $path_dir_audio ="assets/Song/";
  $audiofile_name_comp = basename($_FILES['audio']['name']);

  $target_audiofile = checkFile($audiofile_name_comp, $target_dir_audio);
  $path_audiofile = checkFile($audiofile_name_comp, $path_dir_audio);
  
  // upload file
  $isAudioUploaded = move_uploaded_file($_FILES["audio"]["tmp_name"], $target_audiofile);
  if (!$isAudioUploaded) {
    echo json_encode(array("status" => false));
  } else {
    $query = "UPDATE song SET Judul = '" . $songData["judul"] . "', Tanggal_terbit = '" . $songData["tanggalTerbit"] . "', Genre = '" . $songData["genre"] . "', Audio_path = '" . $path_audiofile . "' WHERE song_id = " . $songData["songId"];
  
    $result = mysqli_query($conn, $query);
    if ($result) {
      echo json_encode(array("status" => true));
    } else {
      echo json_encode(array("status" => false));
    }
  }
}
else if (isset($_FILES['cover']) && !isset($_FILES['audio'])){
  $target_dir_cover = "../../assets/CoverImages/";
  $path_dir_cover ="assets/CoverImages/";
  $coverfile_name_comp = basename($_FILES['cover']['name']);
  
  $target_coverfile = checkFile($coverfile_name_comp, $target_dir_cover);
  $path_coverfile = checkFile($coverfile_name_comp, $path_dir_cover);
  
  // upload file
  $isCoverUploaded = move_uploaded_file($_FILES["cover"]["tmp_name"], $target_coverfile);
  if (!$isCoverUploaded) {
    echo json_encode(array("status" => false));
  } else {
    $query = "UPDATE song SET Judul = '" . $songData["judul"] . "', Tanggal_terbit = '" . $songData["tanggalTerbit"] . "', Genre = '" . $songData["genre"] . "', Image_path = '" . $path_coverfile . "' WHERE song_id = " . $songData["songId"];
  
    $result = mysqli_query($conn, $query);
    if ($result) {
      echo json_encode(array("status" => true));
    } else {
      echo json_encode(array("status" => false));
    }
  }
  
}
else {
  $query = "UPDATE song SET Judul = '" . $songData["judul"] . "', Tanggal_terbit = '" . $songData["tanggalTerbit"] . "', Genre = '" . $songData["genre"] . "' WHERE song_id = " . $songData["songId"];
  
  $result = mysqli_query($conn, $query);
  if ($result) {
    echo json_encode(array("status" => true));
  } else {
    echo json_encode(array("status" => false));
  }
}


