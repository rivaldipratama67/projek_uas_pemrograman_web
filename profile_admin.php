<?php 
  session_start();
  include("connection.php");
  
  $id = $_SESSION["id_user"];
  $email = $_SESSION["email"];

    if (!isset($_SESSION["email"])) {
       header("Location: login.php"); 
    }

    $username = '';
    $password = '';

    if (isset($_GET['updateuser'])){
        $id_user = $_GET['updateuser'];
        $query = "SELECT * FROM user WHERE id_user = '$id_user';";
        $sql = mysqli_query($connection, $query);
    
        $result = mysqli_fetch_assoc($sql);
        $username = $result['username'];
        $email = $result['email'];
    }

    if (isset($_POST['submit'])){
      $username = $_POST["username"];
      $password = htmlentities(strip_tags(trim($_POST["password"])));

      $error_message = '';

      if ($error_message === ''){
        $email = mysqli_real_escape_string($connection, $email );
        $username = mysqli_real_escape_string($connection, $username );
        $password = mysqli_real_escape_string($connection, $password );

        $password = sha1($password);
        $query = "UPDATE user SET email = '$email', username = '$username', password = '$password' WHERE id_user = '$id_user';";
        $sql = mysqli_query($connection, $query);

        if ($sql) {
          header("location: user.php");
        } else {
          die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }
      }
    } else {
      $error_message = "";
      $password = '';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Style -->
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://kit.fontawesome.com/cc41ff3053.js" crossorigin="anonymous"></script>


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
          <div class="list-item">
            <a href="admin.php">
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
          <div class="toggle">
            <div id="menu-button">
              <input type="checkbox" id="menu-checkbox">
              <label for="menu-checkbox" id="menu-label">
                <img src="assets/img/hamburger-sidebar.svg" alt="">
              </label>
            </div>
          </div>

          <div class="dropdown">
            <button class="dropbtn">User</button>
            <div class="dropdown-content">
              <a href="home.php">Home</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="topper">
            <h1 style="font-weight: 300;">Edit Account</h1><br>
            <hr>
        </div>

        <div class="form-content">
            <form action="" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Username</label>
                    </div>
                    <div class="col-75">
                        <input value="<?php echo $username ?>" type="text" id="username" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Email</label>
                    </div>
                    <div class="col-75">
                    <input value="<?php echo $email ?>" type="text" id="email" name="email" placeholder="Email" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Password</label>
                    </div>
                    <div class="col-75">
                    <input value="<?php echo $password ?>" type="password" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="row">
                    <input style="margin-top: 20px;" type="submit" name="submit" value="Update">
                </div>
            </form>
        </div>
    </div>

  </div>
</body>

<!-- Script -->
<script src="assets/script/script.js"></script>
</html>