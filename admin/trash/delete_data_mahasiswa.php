<?php
session_start();
if (isset($_SESSION['role'])) {//jika sudah login
    if ($_SESSION == 'Admin') {
      # code...
    } else {
      header("Location:login.php");
    }
  } else {
    //session belum ada artinya belum login
    header("Location:admin/trash/login.php");
    // die("Anda belum login! Anda tidak berhak masuk ke halaman ini. Silahkan login
    // <a href='login.php'>di sini</a>");
  }
include 'database.php';
// menyimpan data id kedalam variabel
$nim   = $_GET['nim'];
// query SQL untuk insert data
$sql="DELETE from mahasiswa where nim='$nim'";
if ($conn->query($sql) === TRUE) {
    echo "<br>Delete succesfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// mengalihkan ke halaman index.php
header("location:../trash/tables_mahasiswa.php");
?>