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
    $id = $_GET['id_njesia_baze'];

    $query = "SELECT * FROM Njesia_Baze WHERE id_Njesia_Baze= '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $emertimi = $row['Em_Njesia_Baze'];
    $adresa = $row['Adresa'];
    $adresa_web = $row['www'];

    if(isset($_POST['submit1'])){
      $emnjesi_baze= mysqli_escape_string($con, $_POST['emnjesi_baze']);
      $adresanjesi_baze = mysqli_escape_string($con, $_POST['adresanjesi_baze']);
      $adresa_web_njesi_baze = mysqli_escape_string($con, $_POST['adresa_web_njesi_baze']);
      $update = "UPDATE Njesia_Baze SET Em_Njesia_Baze= '$emnjesi_baze' , adresa = '$adresanjesi_baze', www = '$adresa_web_njesi_baze' WHERE id_Njesia_Baze = '$id'";
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
                  <input type="text" class="form-control" name="emnjesi_baze" value="<?php echo $emertimi;?>"/><br/><br/>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Adresa:</label>
                <input class="form-control" type="text" name="adresanjesi_baze" value="<?php echo $adresa;?>"/><br/><br/></label>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Adresa Web:</label>
                <input class="form-control" type="text" name="adresa_web_njesi_baze" value="<?php echo $adresa_web;?>"/><br/><br/></label>
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
