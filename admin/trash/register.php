<!DOCTYPE html>
<html lang="en">
<?php
  $passErr = "";
  $emailErr = "";
  function cek($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = cek($_POST['name']);
    $email = cek($_POST['inputEmail']);
    $role = cek($_POST['role']);
    require 'database.php';
    $password = cek($_POST['inputPassword']);
    $cpassword = cek($_POST['confirmPassword']);

    $sql = "SELECT email from user WHERE email = '$email'";
    $result = $conn->query($sql);
    //cek email terdaftar
    if ($result->num_rows == 0) {
      //cek pw sama
      // echo "pw1 : ".cek($password).", pw2 : ".$cpassword."<br>";
      if (cek($password)==cek($cpassword)) {
        // echo "masuk";
        $sql = "INSERT INTO user (email, name, password, role, date_create, date_modified) 
        VALUES 
        ('$email','$name','$password','$role',current_timestamp(),current_timestamp())";
        if ($conn->query($sql) === TRUE) {
          echo "New record created succesfully";
          header("Location:login.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      } else{
        $passErr="Password tidak sama";
      }
    } else {
      $emailErr = "Email sudah terdaftar";
      // echo $emailErr;
    }
    $conn->close();
    //insert in mysql?
    // echo "email: $email, name: $name, pw: $password, role: $role";
  }
  ?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <?php
session_start();
//pemeriksaan session
if (isset($_SESSION['name'])) {//jika sudah login
    //menampilkan isi session
    // echo "<h1>Selamat Datang ".$_SESSION['name']."</h1>";
    // echo "<h2>Halaman ini hanya bisa diakses jika Anda sudah login</h2>";
    // echo "<h2>Klik <a href='logout.php'>di sini (logout.php)</a>
    // untuk LOGOUT</h2>";
    // header("Location:index.php");
} else {
    //session belum ada artinya belum login
    // die("Anda belum login! Anda tidak berhak masuk ke halaman ini. Silahkan login
    // <a href='login.php'>di sini</a>");
}?>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <!-- <div class="form-row"> -->
              <!-- <div class="col-md-6"> -->
                <div class="form-label-group">
                  <input type="text" id="firstName" name="name" class="form-control" placeholder="First name" required autofocus>
                  <label for="firstName">Full name</label>
                </div>
              <!-- </div> -->
              <!-- <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" class="form-control" placeholder="Last name">
                  <label for="lastName">Last name</label>
                </div>
              </div> -->
            <!-- </div> -->
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Format email salah">
              <label for="inputEmail">Email address</label>
            </div>
            <?php echo "<a style='color:red;'> $emailErr</a>" ?>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Role</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" name="role" required>
              <option value="" selected>->Select here<-</option>
              <option value="Admin">Admin</option>
              <option value="Author">Dosen</option>
              <!-- <option value="Editor">Customer</option> -->
            </select>
          </div>
        <!-- <div class="form-group"> -->
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required minlength=8 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" required minlength=8 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <p style="text-align:center;color:red;"><?php echo $passErr?></p>
        <!-- </div> -->
          <input class="btn btn-primary btn-block" type="submit" name="submit" href="login.php" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  
</body>

</html>
