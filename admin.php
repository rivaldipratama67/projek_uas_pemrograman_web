<?php
  session_start();
  include("connection.php");

$level = $_SESSION["level"];
$email = $_SESSION["email"];
$query = "SELECT * FROM user WHERE email = '$email';";
$sql = mysqli_query($connection, $query);

$result = mysqli_fetch_assoc($sql);
$level = $result['level'];

  if ( $level != '1') {
     header("Location: login.php"); 
  }

  $result = "SELECT COUNT(*) AS NUMBER FROM user WHERE level = '0'";
  $sql = mysqli_query($connection, $result);

  $result = mysqli_fetch_assoc($sql);

  if ($result != null ){
    $user = $result['NUMBER'];
  }else{
    $user = '0';
  }
     
  $query = "SELECT * FROM user ORDER BY email ASC";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- Style -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
    <script src="https://kit.fontawesome.com/cc41ff3053.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin</title>
</head>
<body>
<div class="container">

<div class="sidebar">
  <div class="header">
    <div class="list-item">
      <a href="#">
        <img style="height: 18px;" src="assets/img/logo.svg" alt="" class="icon">
        <span class="desc-header">Si TODO</span>
      </a>
    </div>

    <div class="illust">
      <img src="assets/img/illust.png" alt="">
    </div>

    
    <div class="side-main">
      <div class="list-item active">
        <a href="#">
          <img src="assets/img/dashboard.svg" alt="" class="icon">
          <span class="description">Dashboard</span>
        </a>
      </div>
      <div class="list-item">
        <a href="user.php">
          <img src="assets/img/team.svg" alt="" class="icon">
          <span class="description">User</span>
        </a>
      </div>
    </div>

  </div>
</div>

<div class="main">
  <!-- Top -->
  <div class="header">
    <div id="menu-button">
      <input type="checkbox" id="menu-checkbox">
      <label for="menu-checkbox" id="menu-label">
        <img src="assets/img/hamburger-sidebar.svg" alt="">
      </label>
    </div>

    <div class="text">
      <h3 style="margin-left: 34px;">Admin Dashboard</h3>
    </div>

    <div class="user">
    <div class="dropdown">
        <button class="dropbtn">Admin</button>
        <div class="dropdown-content">
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="topper">
    <h1 style="font-weight: 300;">Main</h1>
    <div class="welcome">
      <h4>Welcome <?= $email?></h4>
    </div>
    <hr>
  </div>

  <div class="dashboard">
    <div class="left">
      <h2 style="margin-bottom: 20px; font-size: 22px;">Recent User</h2>
      <table>
        <thead>
          <tr>
            <th>User</th>
            <th>Email</th>
            <th>Created At</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php
            $query = "SELECT * FROM user WHERE level = '0' ORDER BY id_user ASC";
              $result = mysqli_query($connection, $query);
              if(!$result) {
                  die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
              } 
            
              while($data = mysqli_fetch_assoc($result)) { 
                echo "<tr>";
                echo "<td>$data[username]</td>";
                echo "<td>$data[email]</td>";
                echo "<td>$data[created]</td>";
                echo "<td><a href=''><i class='fa-regular fa-folder-open'></i></a></td>";
                echo "</tr>";
              }
              
              mysqli_free_result($result);
              
              mysqli_close($connection);
          ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="right">
      <div class="count">
        <i class='bx bxs-group'></i>
        <span>
          <h1><?= $user?></h1>
          <h4>USER</h4>
        </span>
      </div>
      <div class="todos">
        <img src="assets/img/dev.svg" alt="">
      </div>
    </div>
  </div>
</div>
</body>

<script src="assets/script/script.js"></script>
</html>