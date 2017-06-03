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
    $id = $_GET['id_njesia_kryesore'];
    $query = "SELECT * FROM Njesia_Kryesore WHERE id_Njesia_Kryesore = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $emertimi = $row['Em_Njesia_Kryesore'];
    $adresa = $row['Adresa'];
    $adresa_web = $row['www'];

    if(isset($_POST['submit1'])){
      $emnjesi_kryesore = mysqli_escape_string($con, $_POST['emnjesi_kryesore']);
      $adresanjesi_kryesore = mysqli_escape_string($con, $_POST['adresanjesi_kryesore']);
      $adresa_web_njesi_kryesore = mysqli_escape_string($con, $_POST['adresa_web_njesi_kryesore']);
      $update = "UPDATE Njesia_Kryesore SET Em_Njesia_Kryesore = '$emnjesi_kryesore' , adresa = '$adresanjesi_kryesore', www = '$adresa_web_njesi_kryesore' WHERE id_Njesia_Kryesore = '$id'";
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
                  <input type="text" class="form-control" name="emnjesi_kryesore" value="<?php echo $emertimi;?>"/><br/><br/>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Adresa:</label>
                <input class="form-control" type="text" name="adresanjesi_kryesore" value="<?php echo $adresa;?>"/><br/><br/></label>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Adresa Web:</label>
                <input class="form-control" type="text" name="adresa_web_njesi_kryesore" value="<?php echo $adresa_web;?>"/><br/><br/></label>
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
