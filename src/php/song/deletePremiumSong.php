<?php
    header('Access-Control-Allow-Origin: http://localhost:3000');
    ini_set('display_errors', 1); error_reporting(1);

    if (isset($_POST['filename'])){
      $status=unlink("../../assets/PremiumSong/".$_POST['filename']);    
      if($status){  
      echo "File deleted successfully";    
      }else{  
      echo "Sorry!";
    
    }
  }
?>
