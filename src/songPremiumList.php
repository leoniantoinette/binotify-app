<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location: components/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/songPremium.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/topnav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>List Premium Song</title>
</head>

<body>
  <?php include "./components/sidenav.php" ?>
  <div class="songPremium-container">
    <?php include './components/topnav.php'  ?>
    <div class="header">
      <img class="header-img" src="assets/CoverImages/likedLogo.png" alt="" />
      <div class="header-desc">
        <p class="header-desc-p">PLAYLIST</p>
        <h1 class="header-title">Premium Songs</h1>
      </div>
    </div>
    <div class="songlist">
      <table class="songlist-table">
        <thead>
          <tr class="th-row">
            <th class="th-audio"></th>
            <th class="th-title">TITLE</th>
          </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
      </table>
    </div>
  </div>
  <script src="script/songPremiumList.js"></script>
</body>

</html>