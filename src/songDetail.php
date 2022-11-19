<?php
ini_set('display_errors', 0);
error_reporting(-1);

require_once("./config/config.php");
session_start();
// check if user is logged in
if (isset($_SESSION['login'])) {
  unset($_SESSION['play_limit']);
  $play_limit = -1;
} else {
  $play_limit = $_SESSION['play_limit'];
  if (time() - $_SESSION["guest_time_stamp"] > 86400) {
    session_unset();
    session_destroy();
    header("Location:components/login.php");
  }
}


$id = $_GET['id'];
$sql = "SELECT * FROM song WHERE song_id = $id";
$data = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($data);

// get album title
$album_id = $result['album_id'];
$sql = "SELECT * FROM album WHERE album_id = $album_id";
$data = mysqli_query($conn, $sql);
$album = mysqli_fetch_assoc($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/songDetail.css" />
  <link rel="stylesheet" href="styles/create.css" />
  <link rel="stylesheet" href="styles/topnav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Song title</title>
  <script>
    function test_limit() {
      var play_limit = <?php print($play_limit); ?>;
      if (play_limit !== -1) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var limit = this.responseText;
            console.log(limit);
            // var playlimit = document.getElementById("playlimit");
            // playlimit.innerHTML = limit;
            if (limit == 0) {
              var audio = document.getElementById("music");
              audio.style.display = 'none';
              audio.pause();
              audio.currentTime = 0;
              alert("You have reached the limit of 3 audio files");
              // disable playing audio


              window.location.href = "./homepageUser.php";
            } else {}
          }
        };
        xmlhttp.open("GET", "./php/test_limit.php", true);
        xmlhttp.send();
      }
    }

    function check_limit() {
      var play_limit = <?php print($play_limit); ?>;

      if (play_limit !== -1) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var limit = this.responseText;
            console.log(limit);
            // var playlimit = document.getElementById("playlimit");
            // playlimit.innerHTML = limit;
            if (limit == 0) {
              var audio = document.getElementById("music");
              audio.style.display = 'none';
              audio.pause();
              audio.currentTime = 0;
              alert("You have reached the limit of 3 audio files");
              // disable playing audio



              window.location.href = "./homepageUser.php";
            } else {}
          }
        };
        xmlhttp.open("GET", "./php/check_limit.php", true);
        xmlhttp.send();
      }

    }
  </script>
</head>

<body>
  <div class="songDetail">
    <?php include "./components/sidenav.php" ?>

    <div class="song-section">
      <?php include "./components/topnav.php" ?>
      <div class="song-player">
        <img src="<?php echo $result["Image_path"] ?>" alt="" />
        <div class="song-desc">
          <div>
            <p><?= $result['Penyanyi'] ?></p>
            <h1><?= $result['Judul'] ?></h1>
            <p><?= date('Y', strtotime($result['Tanggal_terbit'])) ?></p>
            <p><?= $result['Genre'] ?></p>
            <p><a href="albumDetail.php?id=<?= $result['album_id'] ?>"><?= $album['Judul'] ?></a> </p>

          </div>

          <div class="audio">
            <audio id="music" controls onended="test_limit()" onplay="check_limit()">
              <source src="<?= $result['Audio_path'] ?>" type="audio/mp3" />

            </audio>
          </div>
        </div>
      </div>

      <?php
      if (isset($_SESSION['login']) && isset($_SESSION['isAdmin'])) {
        if ($_SESSION['isAdmin'] == 1) {
      ?>
          <div class="song-edit">
            <h3>Edit song</h3>
            <div class="alert error">
              <span class="close-btn">&times;</span>
              <strong id="error-text"></strong>
            </div>
            <div class="alert success">
              <span class="close-btn">&times;</span>
              <strong id="success-text"></strong>
            </div>
            <div class="song-edit-form">
              <div class="song-edit-img">
                <img src="<?php echo $result["Image_path"] ?>" alt="" />
                <h4>Upload a different cover photo</h4>
                <input type="file" name="song_image" id="song-image" enctype="multipart/form-data" value="<?= $result['Image_path'] ?>" />

                <h4>Upload audio file</h4>
                <input type="file" name="song_file" id="song-file" enctype="multipart/form-data" value="<?= $result['Audio_path'] ?>" />
              </div>
              <div class="song-edit-desc">
                <div class="song-edit-desc-input">
                  <label for="song-title">Song title</label>
                  <input type="text" id="song-title" name="song_title" value="<?= $result['Judul'] ?>" />
                </div>
                <div class="song-edit-desc-input">
                  <label for="song-album">Release Date</label>
                  <input type="date" id="song-release" name="song_release" value="<?= $result['Tanggal_terbit'] ?>" />
                </div>
                <div class="song-edit-desc-input">
                  <label for="song-genre">Genre</label>
                  <select class="form-input" name="song_genre" id="song-genre">
                    <option disabled value>Select Genre</option>
                    <option value="Pop" <?php if ($result['Genre'] == "Pop") echo 'selected="selected"'; ?>>Pop</option>
                    <option value="Rock" <?php if ($result['Genre'] == "Rock") echo 'selected="selected"'; ?>>Rock</option>
                    <option value="Hiphop" <?php if ($result['Genre'] == "Hiphop") echo 'selected="selected"'; ?>>Hip Hop</option>
                    <option value="Country" <?php if ($result['Genre'] == "Country") echo 'selected="selected"'; ?>>Country</option>
                    <option value="Rnb" <?php if ($result['Genre'] == "Rnb") echo 'selected="selected"'; ?>>Rythm and Blues (RnB)</option>
                    <option value="Jazz" <?php if ($result['Genre'] == "Jazz") echo 'selected="selected"'; ?>>Jazz</option>
                    <option value="Edm" <?php if ($result['Genre'] == "Edm") echo 'selected="selected"'; ?>>Electronic Dance Music</option>
                    <option value="Classical" <?php if ($result['Genre'] == "Classical") echo 'selected="selected"'; ?>>Classical</option>
                    <option value="Indie" <?php if ($result['Genre'] == "Indie") echo 'selected="selected"'; ?>>Indie</option>
                    <option value="Dangdut" <?php if ($result['Genre'] == "Dangdut") echo 'selected="selected"'; ?>>Dangdut</option>
                  </select>

                </div>
                <input type="hidden" id="song-id" name="p1" value="<?= $id ?>">
              </div>
            </div>
            <div class="song-submit-form">
              <button name="submit" id="create-btn">Save</button>
              <button id="delete-btn" class="btn-delete-song" name="delete">Delete Song</button>
            </div>
          </div>
      <?php }
      } ?>

    </div>
  </div>

  <script src="script/edit_song.js"></script>

</body>

</html>