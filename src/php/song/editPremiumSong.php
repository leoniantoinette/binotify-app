<?php
    header('Access-Control-Allow-Origin: http://localhost:3000');
    ini_set('display_errors', 1); error_reporting(1);
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

    if (isset($_FILES['audiofile'])){
        $target_dir_audio = "../../assets/PremiumSong/";
        $path_dir_audio ="assets/PremiumSong/";
        $audiofile_name_comp = basename($_FILES['audiofile']['name']);

        $target_audiofile = checkFile($audiofile_name_comp, $target_dir_audio);
        $path_audiofile = checkFile($audiofile_name_comp, $path_dir_audio);

        $isAudioUploaded = move_uploaded_file($_FILES["audiofile"]["tmp_name"], $target_audiofile);
        echo "audio is uploaded";


    }
?>
