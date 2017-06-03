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
if($row['role'] != 1){
  echo "Error 505!";
}else{

  if(isset($_GET['submit'])){
    $id = $_GET['id_pedagogu'];
    $query = "SELECT * FROM Pedagogu WHERE id_Pedagogu = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $emertimi = $row['Em_Pedagogu'];
    $titulli = $row['Titulli'];
    $email= $row['Email'];

    if(isset($_POST['submit1'])){
      $empedagogu = mysqli_escape_string($con, $_POST['empedagogu']);
      $titulli_p = mysqli_escape_string($con, $_POST['titulli_p']);
      $email_p= mysqli_escape_string($con, $_POST['email_p']);
      $update = "UPDATE Pedagogu SET Em_Pedagogu = '$empedagogu' , titulli = '$titulli_p', email = '$email_p' WHERE id_Pedagogu = '$id'";
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
         <div class="container">
           <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <form  action="" method="post" ><br/><br/>
              <div class="form-group">
                  <label style="font-align:left;">Emertimi</label>
                  <input type="text" class="form-control" name="empedagogu" value="<?php echo $emertimi;?>"/><br/><br/>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Titulli:</label>
                <input class="form-control" type="text" name="titulli_p" value="<?php echo $titulli;?>"/><br/><br/></label>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Email:</label>
                <input class="form-control" type="emaik" name="email_p" value="<?php echo $email;?>"/><br/><br/></label>
              </div>
              <input class="btn btn-success" type="submit" name="submit1" value="Ndrysho">
            </form>
          </div>
           </div>
         </div>
       </body>
     </html>
    <?php
  }
}?>
