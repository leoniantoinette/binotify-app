<?php
session_start();

if (!isset($_SESSION["login"])) {
  if (!isset($_SESSION['play_limit'])) {
    $_SESSION['play_limit'] = 3;
    // set timeout to one day
    $_SESSION["guest_time_stamp"] = time();

  }
}
ini_set('display_errors', 1);
error_reporting(-1);

require_once("config/config.php"); // kita memerlukan $db untuk exec quer
$sql = "SELECT * FROM song ORDER BY song.song_id DESC LIMIT 10;";
$data = mysqli_query($conn, $sql);
$result = [];
while ($row = mysqli_fetch_assoc($data)) {
  $result[] = $row;
}
// count number of rows
$numOfSongs = mysqli_num_rows($data);
//print result 
$counter = 1;
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/homepageUser.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/topnav.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Homepage User</title>
</head>

<body>
  <div class="homepage-user">
    <?php include "./components/sidenav.php" ?>
    <div class="home-section">
      <div class="topnav">
        <div class="topnav-search">
          <input type="text" placeholder="Search for songs" id="searchSongs" />
        </div>
        <div class="topnav-btn">
          <?php
          if (isset($_SESSION['login'])) {
            echo "<a href=\"components\logout.php\"'>Logout</a>";
          } else {
            echo "<a href=\"components\login.php\"'>Login</a>";
          }
          ?>
        </div>
        <div class="topnav-profile">
          <div class="topnav-profile-icon">
            <i class="fa fa-user"></i>
          </div>
          <div class="topnav-profile-name">
            <?php
            if (isset($_SESSION['login'])) {
              echo "<h4>" . $_SESSION['username'] . "</h4>";
            } else {
              echo "<h4>Guest</h4>";
            }
            ?>
          </div>
        </div>
      </div>

      <div class="header">
        <img class="header-img" src="assets/CoverImages/likedLogo.png" alt="" />
        <div class="header-desc">
          <p class="header-desc-p">PLAYLIST</p>
          <h1 class="header-title">Your Songs</h1>
        </div>
      </div>
      <div class="songlist">
        <table class="songlist-table">
          <tr class="th-row">
            <th class="th-number">#</th>
            <th class="th-title">TITLE</th>
            <th class="th-genre">GENRE</th>
            <th class="th-year">YEAR</th>
          </tr>
          <?php foreach ($result as $row) : ?>
            <tr class="songrow">
              <td><?php echo $counter;
                  $counter++ ?></td>
              <td>
                <div class="songtitle">
                  <img class="songtitle-img" src="<?php echo $row["Image_path"] ?>" alt="" />
                  <div class="songtitle-desc">
                    <p class="songtitle-title">
                      <a href="songDetail.php?id=<?= $row['song_id'] ?>"><?= $row['Judul'] ?></a>
                    </p>
                    <p class="songtitle-artist"><?= $row['Penyanyi'] ?></p>
                  </div>
                </div>
              </td>
              <td><?= $row['Genre'] ?></td>
              <td><?= date('Y', strtotime($row['Tanggal_terbit'])) ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
  <script>
    const searchSongs = document.getElementById("searchSongs");
    searchSongs.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        window.location.href = `search.php?search=${searchSongs.value}`;
      }
    });
  </script>
</body>

</html>