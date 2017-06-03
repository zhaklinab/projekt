<?php
session_start();
include "../connect.php";
if(isset($_SESSION['id']) == ""){
  header("Location: ../index.php");
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id_user='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if($row['role'] != 0){
  echo "Error 505!";
}else{

  if(isset($_GET['submit'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id_user = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];

    if(isset($_POST['submit1'])){
      $usernameu = mysqli_escape_string($con, $_POST['usernameu']);
      $passwordu = mysqli_escape_string($con, password_hash($_POST['passwordu'] , PASSWORD_BCRYPT));
      $update = "UPDATE user SET username = '$usernameu' , password = '$passwordu' WHERE id_user = '$id'";
      $res = mysqli_query($con, $update);
      if($res){
        ?>
        <script type="text/javascript">
        alert("Te dhenat u ndryshuan me sukses!");
        setTimeout(function(){window.location.assign("index.php"); }, 300);
        </script>
        <?php
      }else{
        echo "Ups... I did again, I played with your heart!";
      }
    }
     ?>
     <!DOCTYPE html>
     <html>
       <head>
         <meta charset="utf-8">
         <title>Flete Provimi</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
         <link rel="stylesheet" href="../projekti.css" >
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       </head>
       <body>
         <nav class="navbar" style="background-color:#337ab7;">
           <div class="container-fluid">
             <div class="navbar-header">
               <a class="navbar-brand" href="index.php" style="color:white;">Flete Provimi</a>
             </div>
             <div class="collapse navbar-collapse" id="navbar">
               <ul class="nav navbar-nav navbar-right nav-menu">
                 <li><a href="index.php"><?php echo $row['username']; ?></a></li>
                 <li><a href="../logout.php" style="color:white;" >Logout</a></li>
               </ul>
             </div>
           </div>
         </nav>
         <div class="container">
           <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <h2>Ndryshim te dhenash te sekretarise</h2><br/><br/>
            <form  action="" method="post" ><br/><br/>
              <div class="form-group">
                  <label style="font-align:left;">E-mail</label>
                  <input type="email" class="form-control" name="usernameu" value="<?php echo $username;?>"/><br/><br/>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Password:</label>
                <input class="form-control" type="password" name="passwordu" /><br/><br/></label>
              </div>
              <input class="btn btn-success" type="submit" name="submit1" value="Ndrysho">
            </form>
          </div>
           </div>
         </div>
       </body>
     </html>
    <?php }}?>
