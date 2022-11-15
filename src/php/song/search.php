<?php

include '../../config/config.php';

$query = "SELECT * FROM song";
// where
if (isset($_GET['searchTerm'])) {
  if ($_GET['searchTerm'] != "") {
    $searchTerm = $_GET['searchTerm'];
    if (isset($_GET['searchBy'])) {
      $searchBy = $_GET['searchBy'];
      if ($searchBy == "judul" && $searchTerm != "") {
        $query .= " WHERE Judul LIKE '%" . $searchTerm . "%'";
      } else if ($searchBy == "penyanyi") {
        $query .= " WHERE Penyanyi LIKE '%" . $searchTerm . "%'";
      } else if ($searchBy == "tahun") {
        $query .= " WHERE YEAR(Tanggal_terbit) = " . "'" . $searchTerm . "'";
      } else if ($searchBy == "all") {
        $query .= " WHERE Judul LIKE '%" . $searchTerm . "%' OR Penyanyi LIKE '%" . $searchTerm . "%' OR YEAR(Tanggal_terbit) = " . "'" . $searchTerm . "'";
      } // searchBy = "" then do nothing
      if (isset($_GET['filterGenre'])) {
        $filterGenre = $_GET['filterGenre'];
        if ($filterGenre != "") {
          $query .= " AND Genre = '" . $filterGenre . "'";
        }
      }
    } else { // searchBy not set
      $query .= " WHERE (Judul LIKE '%" . $searchTerm . "%' OR Penyanyi LIKE '%" . $searchTerm . "%' OR YEAR(Tanggal_terbit) = " . "'" . $searchTerm . "'" . ")";
      if (isset($_GET['filterGenre'])) {
        $filterGenre = $_GET['filterGenre'];
        if ($filterGenre != "") {
          $query .= " AND Genre = '" . $filterGenre . "'";
        }
      }
    }
  } else { // searchTerm = ""
    if (isset($_GET['filterGenre'])) {
      $filterGenre = $_GET['filterGenre'];
      if ($filterGenre != "") {
        $query .= " WHERE Genre = '" . $filterGenre . "'";
      }
    }
  }
} else { // searchTerm not set
  if (isset($_GET['filterGenre'])) {
    $filterGenre = $_GET['filterGenre'];
    if ($filterGenre != "") {
      $query .= " WHERE Genre = '" . $filterGenre . "'";
    }
  }
}

// order by
if (isset($_GET['sortJudul'])) {
  $sortJudul = $_GET['sortJudul'];
  if ($sortJudul == "asc") {
    $query .= " ORDER BY Judul ASC";
  } else if ($sortJudul == "desc") {
    $query .= " ORDER BY Judul DESC";
  }
  if (isset($_GET['sortDate'])) {
    $sortDate = $_GET['sortDate'];
    if ($sortDate == "newest") {
      $query .= ", Tanggal_terbit DESC";
    } else if ($sortDate == "oldest") {
      $query .= ", Tanggal_terbit ASC";
    }
  }
} else { // sortJudul not set
  if (isset($_GET['sortDate'])) {
    $sortDate = $_GET['sortDate'];
    if ($sortDate == "newest") {
      $query .= " ORDER BY Tanggal_terbit DESC";
    } else if ($sortDate == "oldest") {
      $query .= " ORDER BY Tanggal_terbit ASC";
    }
  } else { // default sort by Judul a-z
    $query .= " ORDER BY Judul ASC";
  }
}

// pagination
$batas = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page_awal = ($page > 1) ? ($page * $batas) - $batas : 0;

$previous = $page - 1;
$next = $page + 1;

$data = mysqli_query($conn, $query);
$jumlah_data = mysqli_num_rows($data);
$total_page = ceil($jumlah_data / $batas);

$query_limit = $query . " LIMIT $page_awal, $batas";
$nomor = $page_awal + 1;

$data_limit = mysqli_query($conn, $query_limit);
$rows = [];
while ($row = mysqli_fetch_assoc($data_limit)) {
  $rows[] = $row;
}
if ($data_limit) {
  echo json_encode(array("data" => $rows, "total_page" => $total_page, "no" => $nomor));
} else {
  echo mysqli_error($conn);
}
