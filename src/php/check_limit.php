<?php
session_start();
//set audio play limit


$_GET['play_limit'] = $_SESSION['play_limit'];
  echo $_SESSION['play_limit'];
?>