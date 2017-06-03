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
    $id = $_GET['id_lenda'];

    $query = "SELECT * FROM Lenda WHERE id_Lenda = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $emertimi = $row['Em_Lenda'];
    $nr_leksione= $row['nr_leksionesh'];
    $nr_seminareve= $row['nr_seminaresh'];
    $nr_laboratoreve= $row['nr_laboratore'];
    $nr_projekteve= $row['nr_projekte'];

    if(isset($_POST['submit1'])){
      $emlenda = mysqli_escape_string($con, $_POST['emlenda']);
      $nrleks = mysqli_escape_string($con, $_POST['nrleks']);
      $nrsem = mysqli_escape_string($con, $_POST['nrsem']);
      $nrlab = mysqli_escape_string($con, $_POST['nrlab']);
      $nrproj = mysqli_escape_string($con, $_POST['nrproj']);
      $update = "UPDATE Lenda SET Em_Lenda = '$emlenda' ,nr_leksionesh = '$nrleks',nr_seminaresh = '$nrsem',nr_laboratore = '$nrlab',nr_projekte= '$nrproj' WHERE id_Lenda = '$id'";
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
                  <label style="font-align:left;">Emertimi Lenda:</label>
                  <input type="text" class="form-control" name="emlenda" value="<?php echo $emertimi;?>"/><br/><br/>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Numri Leksioneve:</label>
                <input class="form-control" type="text" name="nrleks" value="<?php echo $nr_leksione;?>"/><br/><br/></label>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Numri Seminareve:</label>
                <input class="form-control" type="text" name="nrsem" value="<?php echo $nr_seminareve;?>"/><br/><br/></label>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Numri Laboratoreve:</label>
                <input class="form-control" type="text" name="nrlab" value="<?php echo $nr_laboratoreve;?>"/><br/><br/></label>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Numri Projekte:</label>
                <input class="form-control" type="text" name="nrproj" value="<?php echo $nr_projekteve;?>"/><br/><br/></label>
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
