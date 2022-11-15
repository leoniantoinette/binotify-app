<?php
session_start();
//set audio play limit


$_GET['play_limit'] = $_SESSION['play_limit'];
  if($_SESSION['play_limit'] == 0){
    echo 0;

  }
  else{
    $_SESSION['play_limit'] -= 1;
    echo $_SESSION['play_limit'];

  }
?>