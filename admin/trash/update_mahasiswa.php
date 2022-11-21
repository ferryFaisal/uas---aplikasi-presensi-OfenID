<!DOCTYPE HTML>  
<?php 
session_start();
if (isset($_SESSION['role'])) {//jika sudah login
    if ($_SESSION['role'] == 'Admin') {
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
?>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<link href="/uas---aplikasi-presensi-OfenID/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="/uas---aplikasi-presensi-OfenID/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<link href="/uas---aplikasi-presensi-OfenID/admin/css/sb-admin.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php
$array    = array('5A','5B');
require 'database.php';
// echo $_GET['email'];
echo "tst ";
if (isset($_GET['nim'])) {
  echo "tst ";
  $nim = $_GET['nim'];
  $sql = "SELECT * from mahasiswa WHERE nim = '$nim'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
  }else {
      echo "0 results";
  }
} else {
  // $row ="";
}
echo $row['nama'];
// define variables and set to empty values
// $nama = $nim = $kelas = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require 'database.php';
  if (isset($_POST['Upload'])) {
    $nim = test_input($_POST['nim']);
    $nama= test_input($_POST["nama"]);
    $kelas = test_input($_POST['kelas']);
    $sql = "UPDATE mahasiswa SET 
                              nama = '$nama',
                              kelas= '$kelas'
                              where nim = '$nim'";
      if ($conn->query($sql) === TRUE) {
        echo "email: $email, name: $name, pw: $password, role: $role";
        // echo "New record created succesfully";
        header('Location:tables_mahasiswa.php');
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
      // header("Location: tables_products.php");
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class = "container" style='margin-bottom: 50px;'>
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <div class="card mt-5">
        <div class="card-title text-center">
            <h2>Edit Profile </h2>
        </div>
        <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="nim" name="nim" class="form-control" readonly placeholder="NIM" value="<?=$row['nim']?>" required autofocus>
              <label for="nim">NIM</label>
            </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
          <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" value="<?=$row['nama']?>" required>
          <label for="nama">Nama</label>
        </div>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Kelas</label>
        </div>
        <select class="custom-select" id="inputGroupSelect01" name="kelas" required>
        <?php
                foreach ($array as $j){
                    echo "<option value='$j' ";
                    echo $row['kelas']==$j?'selected="selected"':'';
                    echo ">$j</option>";
                }
                ?>
        </select>
      </div>
      <div class="form-row">
        </div>
          <input type="submit" class="btn btn-primary col-md-3 offset-md-2" name="Upload" value="Ubah">
          <!-- <a href="select.php"><input class='btn btn-primary col-md-3 offset-md-2' value="Cancel" action=tables_products.php></a>  -->
          <button type="button" class="btn btn-secondary col-md-3 offset-md-2" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>  
</body>
</html>