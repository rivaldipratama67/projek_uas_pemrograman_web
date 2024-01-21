<?php
  session_start();

  $id = $_SESSION["id_user"];
  $email = $_SESSION["email"];
  if (!isset($_SESSION["email"])) {
     header("Location: login.php"); 
  }
  include("connection.php");


if (isset($_GET["deletetask"])){
    $id_task = $_GET["deletetask"];
    $query = "DELETE FROM task WHERE id_task='$id_task';";
    $result = mysqli_query($connection, $query);

    if($result) {
        header("Location: task.php");
    }
    else {
        echo $query;
    }
}

if (isset($_GET["deletesub"])){
    $id_subtask = $_GET["deletesub"];
    $query = "DELETE FROM subtask WHERE id_subtask='$id_subtask';";
    $result = mysqli_query($connection, $query);

    if($result) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    else {
        echo $query;
    }
}

if (isset($_GET["deletectg"])){
    $id_category = $_GET["deletectg"];
    $query = "DELETE FROM category WHERE id_category='$id_category';";
    $result = mysqli_query($connection, $query);

    if($result) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    else {
        echo $query;
    }
}

if (isset($_GET["deleteuser"])){
    $id_user = $_GET["deleteuser"];
    $query = "DELETE FROM user WHERE id_user='$id_user';";
    $result = mysqli_query($connection, $query);

    if($result) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    else {
        echo $query;
    }
}
?>