<?php
  session_start();

$id = $_SESSION["id_user"];
$email = $_SESSION["email"];
  if (!isset($_SESSION["email"])) {
     header("Location: login.php"); 
  }

  include("connection.php");

$result = "SELECT id_user, COUNT(*) AS NUMBER FROM task WHERE id_user = '$id' GROUP BY id_user";
$sql = mysqli_query($connection, $result);

$result = mysqli_fetch_assoc($sql);

if ($result != null ){
  $task = $result['NUMBER'];
}else{
  $task = '0';
}


$result = "SELECT id_user, COUNT(*) AS NUMBER FROM subtask WHERE id_user = '$id'  GROUP BY id_user";
$sql = mysqli_query($connection, $result);

$result = mysqli_fetch_assoc($sql);

if ($result != null ){
  $sub = $result['NUMBER'];
}else{
  $sub = '0';
}


// echo count($result);

$query = "SELECT * FROM user ORDER BY email ASC";
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
  
  <style>
    .table-data{
      display: flex;
      flex-wrap: wrap;
      margin-top: 24px;
      width: 100%;
      color: #342E37;
    }
    .table-data .order{width: 100%;}
    .table-data > div {
      border-radius: 20px;
      background: #F9F9F9;
      padding: 24px;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th {
      padding-bottom: 12px;
      font-size: 13px;
      text-align: left;
      border: none;
      border-bottom: 2px solid #eee !important;
    }
    table td {
      padding: 16px 0;
    }
    table tr td:first-child {
      display: flex;
      align-items: center;
      grid-gap: 12px;
      padding-left: 6px;
    }
  </style>
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

        <div class="user">
          <div class="dropdown">
            <button class="dropbtn">User</button>
            <div class="dropdown-content">
              <a href="profile.php">Profile</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="topper">
        <h1 style="font-weight: 300;">Home</h1>
        <div class="welcome">
          <h4>Welcome <?= $email?></h4>
        </div>
        <hr>
      </div>

      <div class="dashboard">
        <div class="progres">
          <h3>Dashboard</h3><br>
          <hr>

          <div class="table-data">
                <div class="order">
                    <table>
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Category</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM task LEFT JOIN category ON task.id_category = category.id_category WHERE id_user='$id' ORDER BY id_task ASC";
                              $result = mysqli_query($connection, $query);
                              if(!$result) {
                                  die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
                              } 
                            
                              while($data = mysqli_fetch_assoc($result)) { 
                                echo "<tr>";
                                echo "<td>$data[nama_task]</td>";
                                echo "<td>$data[nama_category]</td>";
                                echo "<td><a href='view_task.php?view=$data[id_task]'><i class='fa-regular fa-folder-open'></i></a></td>";
                                echo "</tr>";
                              }
                              
                              mysqli_free_result($result);
                              
                              mysqli_close($connection);
                        ?>
                        </tbody>
                    </table>
                </div>
          </div>
        </div>

        <div style="width: 30%;" class="project">
          <div class="total-project">
            <h2>Task</h2>
            <h1><?php echo $task ?></h1>
          </div>
          <div class="total-task">
            <h2>Sub-Task</h2>
            <h1><?php echo $sub ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<!-- Script -->
<script src="assets/script/script.js" defer></script>
</html>