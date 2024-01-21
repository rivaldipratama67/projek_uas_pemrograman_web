<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "todo";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connection) {
  die("Koneksi dengan database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}

// $query = "DROP TABLE IF EXISTS user";
// $query_result = mysqli_query($connection, $query);
// if(!$query_result){
//   die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
// }
// else {
//   echo "Tabel <b>'user'</b> berhasil dihapus... <br>";
// }
// $query  = "
//   CREATE TABLE user 
//     ( email VARCHAR(50),
//       username VARCHAR(100),
//       password CHAR(40),
//       PRIMARY KEY (email))";
// $query_result = mysqli_query($connection, $query);
// if(!$query_result){
//     die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
// }
// else {
//   echo "Tabel <b>'student'</b> berhasil dibuat... <br>";
// }
