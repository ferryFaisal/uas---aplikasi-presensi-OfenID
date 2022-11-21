<!DOCTYPE html>
<html lang="en">
  
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Tables</title>

  <!-- Custom fonts for this template-->
  <link href="/uas---aplikasi-presensi-OfenID/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="/uas---aplikasi-presensi-OfenID/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/uas---aplikasi-presensi-OfenID/admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
session_start();
if (isset($_SESSION['role'])) {//jika sudah login
    if ($_SESSION['role'] == 'Admin') {
      # code...
    } else {
      header("Location:/uas---aplikasi-presensi-OfenID/index.php.php");
    }
  } else {
    //session belum ada artinya belum login
    header("Location:login.php");
    // die("Anda belum login! Anda tidak berhak masuk ke halaman ini. Silahkan login
    // <a href='login.php'>di sini</a>");
  }
  function cek($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (isset($_POST['Upload'])) {
    $nim = cek($_POST['nim']);
    $nama = cek($_POST['nama']);
    $kelas = cek($_POST['kelas']);
    require 'database.php';
    $sql = "SELECT nim from mahasiswa WHERE nim = '$nim'";
    $result = $conn->query($sql);
    //cek nim terdaftar
    if ($result->num_rows == 0) {
        // echo "masuk";
        $sql = "INSERT INTO mahasiswa (nim, nama, kelas) 
        VALUES 
        ('$nim','$nama','$kelas')";
        if ($conn->query($sql) === TRUE) {
          echo '<script>alert("Mahasiswa baru telah ditambahkan")</script>';
          // echo "New record created succesfully";
          // header("Location:login.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
      echo '<script>alert("NIM sudah terdaftar")</script>';
    }
    $conn->close();
    //insert in mysql?
    // echo "email: $email, name: $name, pw: $password, role: $role";
  }
  ?>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Start Bootstrap</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class='nav-item'>
          <a class='nav-link' href='tables_users.php'>
            <i class='fas fa-fw fa-table'></i>
            <span>Tables Users</span></a>
        </li>
      <li class="nav-item active">
        <a class="nav-link" href="tables_mahasiswa.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables Mahasiswa</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables_presensi.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables Presensi</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tables Mahasiswa</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Mahasiswa</div>
          <div class="card-body">
            <div class="table-responsive">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              Tambah Mahasiswa
            </button>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php
                require 'database.php';
                  $sql = "SELECT * FROM mahasiswa ORDER BY nim ASC";
                  $result = $conn->query($sql);
                  foreach($result as $row)
                  {
                    ?>
                    <tr>
                      <td><?=$row['nim']?></td>
                      <td><?=$row['nama']?></td>
                      <td><?=$row['kelas']?></td>
                      <?php echo
                          "<td><a class='btn btn-success' href='update_mahasiswa.php?nim=$row[nim]'>Ubah</a> | 
                          <a class='btn btn-danger' href='delete_data_mahasiswa.php?nim=$row[nim]' onClick=\"return confirm('Anda yakin akan menghapus record ini?')\">Hapus</a></td>"
                          ?>
        </tr>
      <?php
      }
			?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" required autofocus minlength=10 maxlength=10>
              <label for="nim">NIM</label>
            </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
          <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required title="Format email salah">
          <label for="nama">Nama</label>
        </div>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Kelas</label>
        </div>
        <select class="custom-select" id="inputGroupSelect01" name="kelas" required>
          <option value="" selected>->Pilih Kelas<-</option>
          <option value="5A">5A</option>
          <option value="5B">5B</option>
        </select>
      </div>
      <div class="form-row">
        </div>
          <input type="submit" class="btn btn-primary col-md-3 offset-md-2" name="Upload" value="Tambah">
          <!-- <a href="select.php"><input class='btn btn-primary col-md-3 offset-md-2' value="Cancel" action=tables_products.php></a>  -->
          <button type="button" class="btn btn-secondary col-md-3 offset-md-2" data-dismiss="modal">Close</button>
      </form>       
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

  <!-- Bootstrap core JavaScript-->
  <script src="/uas---aplikasi-presensi-OfenID/admin/vendor/jquery/jquery.min.js"></script>
  <script src="/uas---aplikasi-presensi-OfenID/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/uas---aplikasi-presensi-OfenID/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="/uas---aplikasi-presensi-OfenID/admin/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/uas---aplikasi-presensi-OfenID/admin/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/uas---aplikasi-presensi-OfenID/admin/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="/uas---aplikasi-presensi-OfenID/admin/js/demo/datatables-demo.js"></script>

</body>

</html>
