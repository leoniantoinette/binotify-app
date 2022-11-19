<?php

ini_set('display_errors', 1);
error_reporting(-1);
session_start();

require_once("config/config.php"); // kita memerlukan $db untuk exec quer
// get id from url 
$id = $_GET['id'];
$sql = "SELECT * FROM song where song.album_id = " . "$id" . " ORDER BY song.tanggal_terbit;";
$data = mysqli_query($conn, $sql);
$result = [];
while ($row = mysqli_fetch_assoc($data)) {
  $result[] = $row;
}
//print result 
$counter = 1;

$sql1 = "SELECT * FROM song where song.album_id is NULL ORDER BY song.tanggal_terbit;";
$data1 = mysqli_query($conn, $sql1);
$result1 = [];
while ($row1 = mysqli_fetch_assoc($data1)) {
  $result1[] = $row1;
}
//print result 
$counter1 = 1;

$sql2 = "SELECT * FROM album WHERE album_id = " . "$id" . ";";
$data2 = mysqli_query($conn, $sql2);
$result2 = mysqli_fetch_assoc($data2);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/albumDetail.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/create.css" />
  <link rel="stylesheet" href="styles/topnav.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Detail Album</title>
</head>

<body>
  <div class="homepage-user">
    <?php include "./components/sidenav.php" ?>
    <div class="home-section">
      <?php include "./components/topnav.php" ?>
      <div class="header">
        <img class="header-img" src="<?= $result2['Image_path'] ?>" alt="" />
        <div class="header-desc">
          <p class="header-desc-p">PLAYLIST</p>
          <h1 class="header-title"><?= $result2['Judul'] ?></h1>
          <p><?= $result2['Penyanyi'] ?></p>
          <p><?= $result2['Total_duration'] ?></p>
        </div>
      </div>
      <div class="songlist">
        <table class="songlist-table">
          <tr class="th-row">
            <th class="th-number">#</th>
            <th class="th-title">TITLE</th>
            <th class="th-duration">DURATION</th>
            <th class="th-genre">GENRE</th>
            <th class="th-year">YEAR</th>
            <?php
            if (isset($_SESSION['login']) && isset($_SESSION['isAdmin'])) {
              if ($_SESSION['isAdmin'] == 1) {
            ?>
                <th class="th-delete">DELETE</th>
            <?php }
            } ?>
          </tr>
          <?php foreach ($result as $row) : ?>
            <tr class="songrow">
              <td><?php echo $counter;
                  $counter++ ?></td>
              <td>
                <div class="songtitle">
                  <img class="songtitle-img" src="<?= $row['Image_path'] ?>" alt="" />
                  <div class="songtitle-desc">
                    <p class="songtitle-title">
                      <a href="songDetail.html"><?= $row['Judul'] ?></a>
                    </p>

                  </div>
                </div>
              </td>
              <td><?= $row['Duration'] ?></td>
              <td><?= $row['Genre'] ?></td>
              <td><?= date('Y', strtotime($row['Tanggal_terbit'])) ?></td>
              <?php
              if (isset($_SESSION['login']) && isset($_SESSION['isAdmin'])) {
                if ($_SESSION['isAdmin'] == 1) {
              ?>
                  <td>
                    <button title="delete2-btn" id='delete2-btn' value="<?php echo $row['song_id'] ?>"><img class="songtitle-img2" src="assets/CoverImages/delete.png" alt="" /></button>
                  </td>
              <?php }
              } ?>

            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <?php
      if (isset($_SESSION['login']) && isset($_SESSION['isAdmin'])) {
        if ($_SESSION['isAdmin'] == 1) {
      ?>
          <div class="song-edit">
            <h3>Edit Album</h3>
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
                  <p class="form-label">Cover Album</p>
                  <div class="img-container">
                    <img src="assets/songdefault.jpeg" alt="album" id="img-preview">
                  </div>
                  <input type="file" class="input-img" accept="image/jpg, image/png, image/jpeg" name="cover" id="cover">
                </div>
                <div class="form-input-data">
                  <div class="row">
                    <p class="form-label">Judul Album</p>
                    <input type="text" class="form-input" id="judul" value="<?= $result2['Judul'] ?>">
                  </div>

                  <div class="row">
                    <p class="form-label">Tanggal Terbit</p>
                    <input type="date" class="form-input" id="tanggal-terbit" value="<?= $result2['Tanggal_terbit'] ?>">
                  </div>
                  <div class="row">
                    <p class="form-label">Genre</p>
                    <select class="form-input" id="genre">
                      <option disabled value>Select Genre</option>
                      <option value="Pop" <?php if ($result2['Genre'] == "Pop") echo 'selected="selected"'; ?>>Pop</option>
                      <option value="Rock" <?php if ($result2['Genre'] == "Rock") echo 'selected="selected"'; ?>>Rock</option>
                      <option value="Hiphop" <?php if ($result2['Genre'] == "Hiphop") echo 'selected="selected"'; ?>>Hip Hop</option>
                      <option value="Country" <?php if ($result2['Genre'] == "Country") echo 'selected="selected"'; ?>>Country</option>
                      <option value="Rnb" <?php if ($result2['Genre'] == "Rnb") echo 'selected="selected"'; ?>>Rythm and Blues (RnB)</option>
                      <option value="Jazz" <?php if ($result2['Genre'] == "Jazz") echo 'selected="selected"'; ?>>Jazz</option>
                      <option value="Edm" <?php if ($result2['Genre'] == "Edm") echo 'selected="selected"'; ?>>Electronic Dance Music</option>
                      <option value="Classical" <?php if ($result2['Genre'] == "Classical") echo 'selected="selected"'; ?>>Classical</option>
                      <option value="Indie" <?php if ($result2['Genre'] == "Indie") echo 'selected="selected"'; ?>>Indie</option>
                      <option value="Dangdut" <?php if ($result2['Genre'] == "Dangdut") echo 'selected="selected"'; ?>>Dangdut</option>
                    </select>

                  </div>
                  <input type="hidden" id="album-id" value="<?= $id ?>">
                  <div class="button">
                    <button id="create-btn">Save</button>
                    <button id="delete-btn" name="delete">Delete</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="selectsong-container">
              <div class="selectsong-title">
                <h3 id="selectsong-title">Select Song for Album</h3>
              </div>
              <div class="songlist">
                <table class="songlist-table">
                  <tr class="th-row">
                    <th class="th-number">#</th>
                    <th class="th-title">TITLE</th>
                    <th class="th-duration">DURATION</th>
                    <th class="th-genre">GENRE</th>
                    <th class="th-year">YEAR</th>

                  </tr>
                  <?php foreach ($result1 as $row1) : ?>
                    <tr class="songrow">
                      <td><input type='checkbox' class="checkbox" value="<?php echo $row1['song_id'] ?>"></td>
                      <td>
                        <div class="songtitle">
                          <img class="songtitle-img" src="assets/CoverImages/likedLogo.png" alt="" />
                          <div class="songtitle-desc">
                            <p class="songtitle-title">
                              <a href="songDetail.html"><?= $row1['Judul'] ?></a>
                            </p>

                          </div>
                        </div>
                      </td>
                      <td><?= $row1['Duration'] ?></td>
                      <td><?= $row1['Genre'] ?></td>
                      <td><?= date('Y', strtotime($row1['Tanggal_terbit'])) ?></td>


                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
              <div class="song-submit-form2 button">
                <button id="save2-btn">Save</button>
              </div>
            </div>

          </div>
      <?php }
      } ?>
      <script src="script/detailAlbum.js"></script>
</body>

</html>