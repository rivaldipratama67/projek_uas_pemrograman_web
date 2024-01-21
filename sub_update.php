<?php 
    session_start();
    include("connection.php");

    $id = $_SESSION["id_user"];
    $email = $_SESSION["email"];
    if (!isset($_SESSION["email"])) {
      header("Location: login.php"); 
    }

$stname = '';
$sdate = '';
$edate = '';
$status = '';


if (isset($_GET['updatesub'])){
    $id_subtask = $_GET['updatesub'];
    $query = "SELECT * FROM subtask WHERE id_subtask = '$id_subtask';";
    $sql = mysqli_query($connection, $query);

    $result = mysqli_fetch_assoc($sql);

    $id_subtask = $result['id_subtask'];
    $id_task = $result['id_task'];
    $stname = $result['nama_subtask'];
    $sdate = $result['date_mulai'];
    $edate = $result['date_selesai'];
    $status = $result['stat'];
}

if (isset($_POST["updatesub"])) {
    $id_subtask = $_POST['id_subtask'];
    $id_task = $_POST['id_task'];
    $stname = htmlentities(strip_tags(trim($_POST["nama_subtask"])));
    $sdate = date('y-m-d', strtotime($_POST['date_mulai']));
    $edate = date('y-m-d', strtotime($_POST['date_selesai']));
    $status = htmlentities(strip_tags(trim($_POST["status"])));

    $query = "UPDATE subtask SET nama_subtask = '$stname', date_mulai = '$sdate', date_selesai= '$edate', stat= '$status' WHERE id_subtask = '$id_subtask'";
    $sql = mysqli_query($connection, $query);

    if($sql) {
        header("location: view_task.php?view=".$id_task);
      }
      else {
        die ("Query gagal dijalankan: ".mysqli_errno($connection). " - ".mysqli_error($connection));
      }  
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

          <div class="tes">
          <button class="w3-button" onclick="myFunction()"> User <i class="fa fa-caret-down"></i></button>
            <div id="demo" class="w3-dropdown-content w3-bar-block w3-card">
              <a href="#" class="w3-bar-item w3-button">Logout</a>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="topper">
            <h1 style="font-weight: 300;">Update SubTask</h1><br>
            <hr>
        </div>

        <div class="form-content">
            <form action="sub_update.php" method="post">
            <input type="text" value="<?php echo $id_subtask ?>" name="id_subtask" id="">
            <input type="hidden" name="id_task" value="<?php echo $id_task ?>" id="">
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
                        <option <?php if ($status == 'Pending'){echo 'selected';}?> value="Pending">Pending</option>
                        <option <?php if ($status == 'onprogres'){echo 'selected';}?> value="onprogres">onprogres</option>
                        <option <?php if ($status == 'done'){echo 'selected';}?> value="done">done</option>
                      </select>
                    </div>
                </div>
                <div class="btn-sub">
                    <div class="row">
                        <input type="button" value="Back" onclick="javascript:history.go(-1)">
                    </div>
                    <div style="margin-left: 20px;" class="row">
                        <input type="submit" name="updatesub" value="Update">
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