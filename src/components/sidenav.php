<div class="sidenav">
  <div class="sidenav-items">
    <div class="sidenav-items-logo">
      <h2>SPOTIPI</h2>
    </div>
    <ul class="sidenav-items-list">
      <li>
        <a href="homepageUser.php">Home</a>
      </li>
      <li><a href="search.php">Search</a></li>
      <li><a href="albumList.php?halaman=1">Album</a></li>
    </ul>

    <!-- if login -->
    <?php
    if (isset($_SESSION['login'])) {
      echo "<ul class=\"sidenav-items-list\">
      <li><a href=\"penyanyiPremium.php\">List Penyanyi Premium</a></li>
      <li><a>List Lagu Premium</a></li>
    </ul>
      ";
    }
    ?>

    <!-- if admin -->
    <?php
    if (isset($_SESSION['login'])) {
      if ($_SESSION['isAdmin'] == 1) {
        echo "<ul class=\"sidenav-admin-list\">
                <li>
                  <a href=\"create_song.php\">Tambah Lagu</a>
                </li>
                <li><a href=\"create_album.php\">Tambah Album</a></li>
                <li><a href=\"user_list.php\">Daftar User</a></li>
              </ul>";
      }
    }
    ?>
  </div>
</div>