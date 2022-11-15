<!-- only admin -->
<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Users</title>
  <link rel="stylesheet" href="styles/user_list.css" />
  <link rel="stylesheet" href="styles/public.css" />
  <link rel="stylesheet" href="styles/sidenav.css" />
  <link rel="stylesheet" href="styles/topnav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <?php include "./components/sidenav.php" ?>
  <div class="userlist-container">
    <?php include "./components/topnav.php" ?>
    <div class="userlist-title">
      <h1>List of Users</h1>
    </div>
    <table>
      <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
        </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>
  </div>
  <script src="script/user_list.js" type="module"></script>
</body>

</html>