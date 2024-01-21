<?php
  session_start();

  $id = $_SESSION["id_user"];
  $email = $_SESSION["email"];
  if (!isset($_SESSION["email"])) {
     header("Location: login.php"); 
  }

  include("connection.php");

  $query = "SELECT * FROM user ORDER BY email ASC";

  if (isset($_POST["addctg"])) {
    $category = htmlentities(strip_tags(trim($_POST["category"])));
  
    $error_message = '';

    if ($category === ''){
      $error_message = 'tidak boleh kosong'; 
    }
  
    if ($error_message === '') {
      $category = mysqli_real_escape_string($connection, $category);

      $add = "INSERT INTO category VALUES";
      $add .= "(null,'$category','$email')";
      
      $result = mysqli_query($connection, $add);
      if($result) {
        header("Location: category.php");
      }
      else {
        die ("Query gagal dijalankan: ".mysqli_errno($connection). " - ".mysqli_error($connection));
      }
    }
    
  }
  else{
    $error_message = '';
    $category = '';
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
            <a href="home.php">
              <img src="assets/img/dashboard.svg" alt="" class="icon">
              <span class="description">Dashboard</span>
            </a>
          </div>
          <div class="list-item">
            <a href="task.php">
              <img src="assets/img/data.svg" alt="" class="icon">
              <span class="description">Task</span>
            </a>
          </div>
          <div class="list-item active">
            <a href="#">
            <img src="assets/img/category.svg" alt="" class="icon">
              <span class="description">Category</span>
            </a>
          </div>
        </div>
        
      </div>
    </div>

    <div style="overflow-x:auto;" class="main">
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
              <a href="profile.php">Profile</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
      </div>

        <!-- Main Content -->
        <div class="topper">
            <h1 style="font-weight: 300;">Category</h1><br>
            <hr>
        </div>

        <div class="category">
        <form action="category.php" method="post">
                    <div class="input-field">
                        <input type="text" name="category" placeholder="Add New Category" value="<?php echo $category ?>">
                    </div>
                    <div style="margin-left: 10px;" class="input-field button">
                        <input name="addctg" type="submit" value="Add">
                    </div>
        </form>
        <hr>
          <div class="list-ctg">
            <table style="overflow-x: auto;" id="category-list">
                <thead>
                    <tr>
                      <th>Category</th>
                      <th colspan="2" width="20%">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <?php
                        $ctg = "SELECT * FROM category WHERE email = '$email' ORDER BY id_category ASC";
                          $result = mysqli_query($connection, $ctg);
                          if(!$result) {
                              die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
                          }
                        
                          while($data = mysqli_fetch_assoc($result)){ 
                            echo "<tr>";
                            echo "<td>$data[nama_category]</td>";
                            // echo "<td><a href='add_category.php?view=$data[id_category]'><i class='fa-regular fa-folder-open'></i></a></td>";
                            echo "<td><a href='sub_delete.php?deletectg=$data[id_category]'><i class='fa-solid fa-delete-left'></i></i></a></td>";
                            echo "</tr>";
                          }
                          
                          mysqli_free_result($result);
                          
                          mysqli_close($connection);
                      ?> 
                    </tr>
                </tbody>
            </table>
          </div>
        </div>


    </div>

  </div>
</body>

<!-- Script -->
<script src="assets/script/script.js"></script>
</html>