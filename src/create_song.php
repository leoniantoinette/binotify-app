<!-- only admin -->
<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("location: login.php");
}
if (isset($_SESSION['isAdmin'])) {
  if ($_SESSION['isAdmin'] == 0) {
    header("location: homepageUser.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Song</title>
  <link rel="stylesheet" href="styles/create.css" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/topnav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <?php include "./components/sidenav.php" ?>
  <div class="create-container">
    <?php include "./components/topnav.php" ?>
    <div class="create-title">
      <h1>Add Song</h1>
    </div>
    <div class="alert error">
      <span class="close-btn">&times;</span>
      <strong id="error-text"></strong>
    </div>
    <div class="alert success">
      <span class="close-btn">&times;</span>
      <strong id="success-text"></strong>
    </div>
    <div class="form-container">
      <div class="form-container-input">
        <div class="form-input-img">
          <p class="form-label">Cover Lagu</p>
          <div class="img-container">
            <img src="assets/songdefault.jpeg" alt="album" id="img-preview">
          </div>
          <input type="file" class="input-img" accept="image/jpg, image/png, image/jpeg" name="cover" id="cover">
        </div>
        <div class="form-input-data">
          <div class="row">
            <p class="form-label">Judul Lagu</p>
            <input type="text" class="form-input" id="judul">
          </div>
          <div class="row">
            <p class="form-label">Penyanyi</p>
            <input type="text" class="form-input" id="penyanyi">
          </div>
          <div class="row">
            <p class="form-label">Tanggal Terbit</p>
            <input type="date" class="form-input" id="tanggal-terbit">
          </div>
          <div class="row">
            <p class="form-label">Genre</p>
            <select class="form-input" id="genre">
              <option disabled selected value>Select Genre</option>
              <option value="Pop">Pop</option>
              <option value="Rock">Rock</option>
              <option value="Hiphop">Hip Hop</option>
              <option value="Country">Country</option>
              <option value="Rnb">Rythm and Blues (RnB)</option>
              <option value="Jazz">Jazz</option>
              <option value="Edm">Electronic Dance Music</option>
              <option value="Classical">Classical</option>
              <option value="Indie">Indie</option>
              <option value="Dangdut">Dangdut</option>
            </select>
          </div>
          <div class="row">
            <p class="form-label">Audio</p>
            <input type="file" class="form-input input-audio" accept="audio/mp3" name="audio" id="audio">
          </div>
          <div class="button">
            <button id="create-btn">CREATE</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="script/create_song.js"></script>
</body>

</html>