<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php
$array    = array('Admin','Dosen');
require "database.php";
// echo $_GET['email'];
if (isset($_GET['email'])) {
  $email = $_GET['email'];
  $sql = "SELECT * from user WHERE email = '$email'";
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

// define variables and set to empty values
$nameErr = $descriptionErr = $priceErr = $photoErr = $stockErr= "";
$name = $password = $email = $role = "";
$name_ok = $password_ok = $price_ok = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  require 'database.php';
  
  if (isset($_POST['Upload'])) {
    $email = $_POST['email'];
    if (empty($_POST["name"])) {
      $nameErr = "Masukan nama produk";
    } else {
      //proses sanitasi data
      $name = test_input($_POST["name"]);
      $name_ok = true;
    }
    
    if (empty($_POST["password"])) {
      $descriptionErr = "Masukan password";
    } else {
      $password = test_input($_POST["password"]);
      $password_ok = true;
    }
    $role = $_POST['role'];
    if($name_ok && $password_ok){
    $sql = "UPDATE user SET 
                              name = '$name',
                              password = '$password',
                              role = '$role',
                              date_modified = current_timestamp()
                              where email = '$email'";
      if ($conn->query($sql) === TRUE) {
        echo "email: $email, name: $name, pw: $password, role: $role";
        // echo "New record created succesfully";
        header('Location:tables_users.php');
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
      // header("Location: tables_products.php");
    }

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
    <div class="col-md-8 offset-md-2">
      <div class="card mt-5">
        <div class="card-title text-center">
            <h2>Edit Profile </h2>
        </div>
        <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <p>Email:<span class="error">*<?php echo $nameErr;?></span><br></p>
              <input class="form-control" type="text" name="email" readonly value="<?=$row['email']?>"> 
              <br>
            </div>
            <div class="form-group">
              <p>Name:<span class="error">*<?php echo $nameErr;?></span><br></p>
              <input class="form-control" type="text" name="name" value="<?=$row['name']?>" required> 
              <br>
            </div>
            <div class="form-group">
              <p>Password: <span class="error">*<?php echo $descriptionErr;?></span></p>
              <input class="form-control" type="text" name="password" value="<?=$row['password']?>" required> 
              <br>
            </div>
            <div class="form-group">
              <p >Role:<span class="error">*</span></p>
              <select class="form-control" name="role" id="idrole" required>
              <?php
                foreach ($array as $j){
                    echo "<option value='$j' ";
                    echo $row['role']==$j?'selected="selected"':'';
                    echo ">$j</option>";
                }
                ?>
              </select>
            </div>
            <!-- <div class="form-group">
              <p>Role:<span class="error">*<?php echo $priceErr;?></span></p>
              <input class="form-control" type="text" name="role" min=0 value="<?=$row['role']?>">
              <br>
            </div> -->
            <br>
              <input type="submit" class="btn btn-primary col-md-3 offset-md-2" name="Upload" value="Save">
              <a href="tables_users.php"><input class='btn btn-primary col-md-3 offset-md-2' value="Cancel" action=select.php></a> 
          </form>
</body>
</html>