<?php
ini_set('display_errors', 1);
error_reporting(-1);
session_start();

require_once("./config/config.php"); // kita memerlukan $db untuk exec quer
$sql = "SELECT * FROM album ORDER BY album.Judul ASC;";
$data = mysqli_query($conn, $sql);
$result = [];
while ($row = mysqli_fetch_assoc($data)) {
  $result[] = $row;
}
// count num of row
$num = mysqli_num_rows($data);
$counter = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/albumList.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/topnav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Your Album</title>
</head>

<body>
  <div class="homepage-user">
    <?php include "./components/sidenav.php" ?>

    <div class="home-section">
      <?php include './components/topnav.php'  ?>
      <div class="header">
        <img class="header-img" src="assets/CoverImages/likedLogo.png" alt="" />
        <div class="header-desc">
          <p class="header-desc-p">PLAYLIST</p>
          <h1 class="header-title">Your Album</h1>
          <p>Gilang. <?= $num ?> Albums</p>
        </div>
      </div>
      <div class="songlist">
        <?php
        $batas = 10;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

        $previous = $halaman - 1;
        $next = $halaman + 1;

        $data = mysqli_query($conn, "SELECT * FROM album ORDER BY album.Judul ASC");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);

        $data_album = mysqli_query($conn, "SELECT * FROM album ORDER BY album.Judul ASC limit $halaman_awal, $batas");
        $nomor = $halaman_awal + 1;
        ?>
        <table class="songlist-table">
          <tr class="th-row">
            <th class="th-number">#</th>
            <th class="th-title">TITLE</th>
            <th class="th-genre">GENRE</th>
            <th class="th-year">YEAR</th>
          </tr>

          <?php
          while ($d = mysqli_fetch_array($data_album)) { ?>
            <tr class="songrow">
              <td><?php echo $nomor++;  ?></td>
              <td>
                <div class="songtitle">
                  <img class="songtitle-img" src="<?php echo $d["Image_path"] ?>" alt="" />
                  <div class="songtitle-desc">
                    <p class="songtitle-title">
                      <a href="albumDetail.php?id=<?= $d['album_id'] ?>"><?= $d['Judul'] ?></a>
                    </p>
                    <p class="songtitle-artist"><?= $d['Penyanyi'] ?></p>
                  </div>
                </div>
              </td>
              <td><?= $d['Genre'] ?></td>
              <td><?= date('Y', strtotime($d['Tanggal_terbit'])) ?></td>
            </tr>
          <?php } ?>

        </table>

        <nav>
          <ul class="pagination justify-content-center">
            <?php
            for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
              <li class="page-item"><a class="page-link <?php echo ($x == $_GET['halaman']) ? "page-active" : "" ?>" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
            }
            ?>

          </ul>
        </nav>

      </div>
    </div>
  </div>
</body>

</html>