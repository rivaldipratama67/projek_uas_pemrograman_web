<?php 
  session_start();
  include("connection.php");
  
  $id = $_SESSION["id_user"];
  $email = $_SESSION["email"];

    if (!isset($_SESSION["email"])) {
       header("Location: login.php"); 
    }

    if (isset($_POST["submit"])) {
      $tname = $_POST["nama_task"];
      $tdesk = $_POST["deskripsi"];
      $category = htmlentities(strip_tags(trim($_POST["category"])));

      $error_message="";

      if (empty($tname)) {
        $error_message .= "- Nama belum diisi <br>";
      }

      if ($error_message === "") {
        $tname = mysqli_real_escape_string($connection, $tname);
        $tdesk = mysqli_real_escape_string($connection, $tdesk);
        $category = mysqli_real_escape_string($connection, $category);

        $query = "INSERT INTO task VALUES ";
        $query .= "(null, '$id','$tname', '$tdesk', '$category')";

        $result = mysqli_query($connection, $query);

        if($result) {
          header("Location: task.php");
        }
        else {
          die ("Query gagal dijalankan: ".mysqli_errno($connection). " - ".mysqli_error($connection));
        }
      }
    } 
    else {
      $error_message = "";
      $tname = "";
      $tdesk = "";
      $category = "";
    }

    $query ="SELECT id_category, nama_category FROM category WHERE email = '$email'";
    $result = $connection->query($query);
  
    if($result->num_rows> 0){
        $optionid= mysqli_fetch_all($result, MYSQLI_ASSOC);
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
          <div class="list-item">
            <a href="category.php">
            <img src="assets/img/category.svg" alt="" class="icon">
              <span class="description">Category</span>
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
              <a href="profile.php">Profile</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="topper">
            <h1 style="font-weight: 300;">Add New Task</h1><br>
            <hr>
        </div>

        <div class="form-content">
            <form action="add_task.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Task Name</label>
                    </div>
                    <div class="col-75">
                        <input value="<?php echo $tname ?>" type="text" id="tname" name="nama_task" placeholder="Task Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Description</label>
                    </div>
                    <div class="col-75">
                        <textarea id="subject" name="deskripsi" placeholder="Write something.." style="height:200px;"><?php echo $tdesk ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Category</label>
                    </div>
                    <div class="col-75">
                        <select name="category" id="category">
                          <option value="">Add Category</option>
                          <?php 
                          foreach ($optionid as $optid){
                            ?>
                              <option value="<?php echo $optid['id_category']; ?>"><?php echo $optid['nama_category']; ?></option>
                            <?php 
                            }
                          ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" name="submit" value="Add Task">
                </div>
            </form>
        </div>
    </div>

  </div>
</body>

<!-- Script -->
<script src="assets/script/script.js"></script>
</html>