<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location: components/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Penyanyi Premium</title>
  <link rel="stylesheet" href="styles/penyanyiPremium.css" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/topnav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <?php include "./components/sidenav.php" ?>
  <div class="penyanyi-container">
    <?php include "./components/topnav.php" ?>
    <div class="penyanyi-title">
      <h1>List Penyanyi Premium</h1>
    </div>
    <div id="list-penyanyiPremium">

    </div>
  </div>
  <script src="script/penyanyiPremium.js" type="module"></script>
</body>

</html>