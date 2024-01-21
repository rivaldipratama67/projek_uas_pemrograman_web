<?php
  session_start();

  $id = $_SESSION["id_user"];
  $email = $_SESSION["email"];
  if (!isset($_SESSION["email"])) {
     header("Location: login.php"); 
  }

  include("connection.php");

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
          <div class="list-item active">
            <a href="#">
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
            <h1 style="font-weight: 300;">Task</h1><br>
            <hr>
        </div>

        <div class="projects">
            <a href="add_task.php">Add new Task</a>
            <hr>
            <div style="overflow-x:auto;" class="list-prj">
              <table id="project-list" width="100%">
                  <thead>
                      <tr>
                          <th>Task</th>
                          <th>Category</th>
                          <th colspan="2" style="text-align: center;" width="20%">Action</th>
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
                        echo "<tr>
                                <td>$data[nama_task]</td>
                                <td>$data[nama_category]</td>
                                <td><a href='view_task.php?view=$data[id_task]'><i class='fa-regular fa-folder-open'></i></a></td>
                                <td>
                                  <a href='sub_delete.php?deletetask=$data[id_task]' onClick=\"return confirm('Apakah Anda Yakin Ingin Menghapus Task?');\"><i class='fa-solid fa-delete-left'></i></a>
                                </td>
                              </tr>";
                            }
                      
                      mysqli_free_result($result);
                      
                      mysqli_close($connection);
                  ?>
                  </tbody>
              </table>
            </div>
        </div>
    </div>

  </div>
</body>

<!-- Script -->
<script src="assets/script/script.js"></script>
<script>
        function Delete_cuy($id){
            swal({
              title: "Are you sure?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if(willDelete) {
                window.location.href ='task.php?delete='+$id;
              }
            });
        }
        ActiveMenu_user(2,1,1);
    </script>
</html>