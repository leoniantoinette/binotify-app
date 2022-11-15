<div class="topnav">
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