<?php
  session_start();
  include("connection.php");

  $id = $_SESSION["id_user"];
  $email = $_SESSION["email"];
  if (!isset($_SESSION["email"])) {
     header("Location: login.php"); 
  }


  $idtask = '';
  $tname = '';
  $category = '';

  if (isset($_GET["view"])) {
    $idtask = $_GET["view"];
    $query = "SELECT * FROM task WHERE id_task = '$idtask';";
    $sql = mysqli_query($connection, $query);
  
    $result = mysqli_fetch_assoc($sql);
  
    $idtask = $result['id_task'];
    $tname = $result['nama_task'];
    $tdesk = $result['deskripsi'];
    $category = $result['id_category'];
  }
  if (isset($_POST["updatesub"])) {
    $idtask = $_GET["updatesub"];
    $query = "SELECT * FROM task WHERE id_subtask = '$idtask';";
    $sql = mysqli_query($connection, $query);
  
    $result = mysqli_fetch_assoc($sql);
  
    $idtask = $result['id_task'];
    $tname = $result['nama_task'];
    $tdesk = $result['deskripsi'];
  }

  $nama_category = "SELECT * FROM category WHERE id_category = '$category';";
  $sql = mysqli_query($connection, $nama_category);
  $hasil = mysqli_fetch_row($sql);

  $nama = $hasil;
  if ($hasil) {
    $nama = $hasil[1];
  }
  else if ($nama === null ){
    $nama = 'None';
    $nama = null;
  }
  
  if (isset($_POST["up_task"])) {
    $tname = $_POST['tname'];
    $desk = $_POST['desk'];
    $categ = htmlentities(strip_tags(trim($_POST["category"])));
    
    if ($categ === ''){
        $categ = null;
    }

    $query = "UPDATE task SET nama_task = '$tname', deskripsi = '$desk', id_category = $categ WHERE id_task = '$idtask';";
    $sql = mysqli_query($connection, $query);

    if($sql) {
        header("location: task.php");
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
  <script src="https://kit.fontawesome.com/cc41ff3053.js" crossorigin="anonymous"></script>


  <style>
    table td:nth-child(6), td:nth-child(7){
      text-align: center;
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

    <div style="overflow-x: auto;" class="main">
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
            <h1 style="font-weight: 300;">View Task</h1><br>
            <hr>
        </div>

        <div style="margin-bottom: 30px; padding-bottom: 60px;" class="view-prj">
          <div class="start">
            <form action="" method="post">
              <h2>Task</h2>
              <input type="text" value="<?php echo $tname ?>" name="tname">
              <br>
              <h2>Description</h2>
              <textarea name="desk" id="desk" style="height:100px"><?php echo $tdesk ?></textarea>
              <br>
              <h2>Category</h2>
              <select name="category" id="category">
                <option value=""><?php echo $nama ?></option>
                <option value=null>None</option>
                <?php 
                    $query ="SELECT id_category, nama_category FROM category WHERE email = '$email'";
                    $result = $connection->query($query);
                  
                    if($result->num_rows> 0){
                        $optionid= mysqli_fetch_all($result, MYSQLI_ASSOC);
                    }
                    foreach ($optionid as $optid){
                      ?>
                      <option value="<?php echo $optid['id_category']; ?>"><?php echo $optid['nama_category']; ?></option>
                      <?php 
                    }
                ?>
              </select>
              <input style="margin-top: 10px" type="submit" id="up_task" name="up_task" value="Update Task">
            </form>
          </div>
        </div>

        <a class="add-new" href='add_subTask.php?update=<?php echo $idtask ?>'>Add new Sub-Task</a>
        <div style="margin-top: 20px; overflow-x: auto;" class="view-tsk">
            <table id="task-list" width="100%">
                <thead>
                    <tr>
                      <th width="30%">Sub-Task</th>
                      <th>Date Started</th>
                      <th>Due Date</th>
                      <th>Status</th>
                      <th style="text-align: center;" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <?php
                      $query = "SELECT * FROM subtask WHERE id_task='$idtask' ORDER BY id_subtask ASC";
                        $result = mysqli_query($connection, $query);
                        if(!$result) {
                            die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
                        }
                      
                        while($data = mysqli_fetch_assoc($result)){ 
                          echo "<tr>";
                          echo "<td>$data[nama_subtask]</td>";
                          echo "<td>$data[date_mulai]</td>";
                          echo "<td>$data[date_selesai]</td>";   
                          echo "<td>$data[stat]</td>"; 
                          echo "<td><a href='sub_update.php?updatesub=$data[id_subtask]'><i class='fa-solid fa-pen-to-square'></i></i></a></td>";  
                          echo "<td><a href='sub_delete.php?deletesub=$data[id_subtask]' onClick=\"return confirm('Yakin Ingin Menghapus Subtask?');\"><i class='fa-solid fa-delete-left'></i></i></a></td>";  
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
</body>

<!-- Script -->
<script src="assets/script/script.js"></script>
</html>