<?php
  session_start();
  include "connect.php";

  if(isset($_SESSION['id'])){
    $id= $_SESSION['id'];
    $select = "SELECT * FROM user WHERE id_user = '$id'";
    $query = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($query);
      if($row['role'] == 0){
        header("Location: admin/index.php");
      }
      if($row['role'] == 2){
        header("Location: pedagog/index.php");
      }
      if($row['role'] == 1){
        header("Location: sekretari/index.php");
      }
      if($row['role'] == 3){
        header("Location: student/index.php");
      }
  }else{
    if(isset($_POST['submit'])){
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $select = "SELECT * FROM user WHERE username = '$email'";
      $query = mysqli_query($con, $select);
      $row = mysqli_fetch_assoc($query);
      if(password_verify($password, $row['password'])){
        $_SESSION['id'] = $row['id_user'];
        if($row['role'] == 0){
          header("Location: admin/index.php");
          echo "Admin";
        }
        elseif($row['role'] == 1){
          header("Location: sekretari/index.php");
          echo "Sekretare";
        }
        elseif($row['role'] == 2){
          header("Location: pedagog/index.php");
          echo "Pedagog";
        }
        elseif($row['role'] == 3){
          header("Location: student/index.php");
          echo "Student";
        }
      }else{
        echo "Wrong details";
      }
    }
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <link rel="stylesheet" href="projekti.css" >
        <meta charset="utf-8">
        <title>Flete Provimi</title>
      </head>
      <body>
        <div class = "container-fluid">
        	<div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4"><br><br>
                <div class="panel panel-default">
                  <div class="panel-heading">
                  </div>
                <div class="panel-body">
                  <form class="" action="index.php" method="post">
                    <div class="form-group">
                      <label><h1> Login</h1></label>
                    </div>
                    <div class="form-group">
                      <input type="email"  class="form-control" name="email" placeholder="E-mail"/>
                    </div>
                    <div class="form-group">
                      <input type="password"  class="form-control" name="password" placeholder="Password"/>
                    </div>
                    <div class=" col-md-12 form-group">
                      <button type="submit" class="btn btn-lg btn-block btn-primary" name="submit" value="Submit">Login </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
            <div class="col-md-4"></div>
         </div>
       </div>
      </body>
    </html>
<?php
  }
  ?>
