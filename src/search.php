<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search, Sort, and Filter</title>
  <link rel="stylesheet" href="styles/search.css" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/topnav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <?php include "./components/sidenav.php" ?>
  <div class="search-container">
    <?php include "./components/topnav.php" ?>
    <div class="search">
      <input type="text" class="search-input" id="search-term" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>">
      <?php
      if (isset($_GET['search'])) {
        unset($_GET['search']);
      }
      ?>
      <p>by</p>
      <select class="search-input" id="search-by">
        <option value="all">All</option>
        <option value="judul">Judul</option>
        <option value="penyanyi">Penyanyi</option>
        <option value="tahun">Tahun Terbit</option>
      </select>
    </div>
    <div class="sort-filter">
      <select class="search-input" id="sort-judul">
        <option disabled selected value>Sort by Judul</option>
        <option value="asc">Ascending (A to Z)</option>
        <option value="desc">Descending (Z to A)</option>
      </select>
      <select class="search-input" id="sort-date">
        <option disabled selected value>Sort by Tahun Terbit</option>
        <option value="newest">Sort by Newest</option>
        <option value="oldest">Sort by Oldest</option>
      </select>
      <select class="search-input" id="filter-genre">
        <option disabled selected value>Filter by Genre</option>
        <option value="pop">Pop</option>
        <option value="rock">Rock</option>
        <option value="hiphop">Hip Hop</option>
        <option value="country">Country</option>
        <option value="rnb">Rythm and Blues (RnB)</option>
        <option value="jazz">Jazz</option>
        <option value="edm">Electronic Dance Music</option>
        <option value="classical">Classical</option>
        <option value="indie">Indie</option>
        <option value="dangdut">Dangdut</option>
      </select>
    </div>
    <div class="buttons">
      <button class="btn" id="search-btn">Search</button>
      <button class="btn" id="reset-btn">Reset</button>
    </div>
    <div class="songlist">
      <table class="songlist-table">
        <thead>
          <tr class="th-row">
            <th class="th-number">#</th>
            <th class="th-title">TITLE</th>
            <th class="th-genre">GENRE</th>
            <th class="th-year">YEAR</th>
          </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
      </table>
    </div>
    <div id="nav">

    </div>
  </div>
  <script src="script/search.js"></script>
</body>

</html>