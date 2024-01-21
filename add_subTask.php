<?php 
    session_start();
    include("connection.php");

    $id = $_SESSION["id_user"];
    $email = $_SESSION["email"];
    if (!isset($_SESSION["email"])) {
      header("Location: login.php"); 
    }


    
    if (isset($_GET["update"])) {
      $idtask = $_GET["update"];
    }
    
    $id_task = $idtask;


    if (isset($_POST["submit"])) {
      $id_task = htmlentities(strip_tags(trim($_POST["id_task"])));
      $stname = htmlentities(strip_tags(trim($_POST["nama_subtask"])));
      $sdate = date('y-m-d', strtotime($_POST['date_mulai']));
      $edate = date('y-m-d', strtotime($_POST['date_selesai']));
      $status = htmlentities(strip_tags(trim($_POST["status"])));

      $error_message="";

      if (empty($stname)) {
        $error_message .= "- Nama belum diisi <br>";
      }

      $select_pending=""; 
      $select_onprogres="";
      $select_done="";

      switch ($status) {
        case 'pending':
          $select_ftib = "selected";
          break;
        case 'onprogres':
          $select_fteic = "selected";
          break;
        case 'done':
          $select_fteic = "selected";
          break;
        }


      if ($error_message === "") {
        $id_task = mysqli_real_escape_string($connection, $id_task);
        $stname = mysqli_real_escape_string($connection, $stname);
        $sdate = mysqli_real_escape_string($connection, $sdate);
        $edate = mysqli_real_escape_string($connection, $edate);
        $status = mysqli_real_escape_string($connection, $status);

        $query = "INSERT INTO subtask VALUES ";
        $query .= "(null, '$id_task','$stname', '$sdate', '$edate', '$status', '$id')";

        $result = mysqli_query($connection, $query);

        if($result) {
          header("Location: view_task.php?view=$id_task");
        }
        else {
          die ("Query gagal dijalankan: ".mysqli_errno($connection). " - ".mysqli_error($connection));
        }
      }
    } 
    else {
      $error_message = "";
      $stname = "";
      $sdate = "";
      $edate = "";
      $select_pending = "selected";
      $select_onprogres = "";
      $select_done = "";
      $select_student = "";
     
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
            <h1 style="font-weight: 300;">Add New SubTask</h1><br>
            <hr>
        </div>

        <div class="form-content">
            <form action="add_subTask.php" method="post">
              <input type="text" value="<?php echo $id_task ?>" name="id_task" id="" hidden>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Sub-Task</label>
                    </div>
                    <div class="col-75">
                        <input value="<?php echo $stname ?>" type="text" id="stname" name="nama_subtask" placeholder="Sub-Task Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Date Started</label>
                    </div>
                    <div class="col-75">
                        <input value="<?php echo $sdate ?>" type="date" name="date_mulai">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Due Date</label>
                    </div>
                    <div class="col-75">
                        <input value="<?php echo $edate ?>" type="date" name="date_selesai">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Status</label>
                    </div>
                    <div class="col-75">
                      <select name='status' id='status'>
                        <option value='pending' <?php echo $select_pending ?>>Pending</option>
                        <option value='onprogres' <?php echo $select_onprogres ?>>On-Progess</option>
                        <option value='done' <?php echo $select_done ?>>Done</option>
                      </select>
                    </div>
                </div>
                <div class="btn-sub">
                    <div class="row">
                        <input type="button" value="Back" onclick="javascript:history.go(-1)">
                    </div>
                    <div style="margin-left: 20px;" class="row">
                        <input type="submit" name="submit" value="Add Sub-Task">
                    </div>
                </div>
            </form>
        </div>
    </div>

  </div>
</body>

<!-- Script -->
<script src="assets/script/script.js"></script>
</html>