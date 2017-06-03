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
      $id = $_GET['id_grupi'];

      $query = "SELECT * FROM Grupi WHERE id_Grupi = '$id'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);
      $emertimi = $row['Em_Grupi'];
      $em_cikli = $row['Em_Cikli'];

      if(isset($_POST['submit1'])){
        $emgrupi = mysqli_escape_string($con, $_POST['emgrupi']);
        $emcikli = mysqli_escape_string($con, $_POST['emcikli']);
        $update = "UPDATE Grupi SET Em_Grupi = '$emgrupi' , Em_Cikli = '$emcikli' WHERE id_Grupi = '$id'";
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
                    <label style="font-align:left;">Emertimi Grupi:</label>
                    <input type="text" class="form-control" name="emgrupi" value="<?php echo $emertimi;?>"/><br/><br/>
                </div>
                <div class="form-group ">
                  <label style="font-align:left;">Emertimi Cikli:</label>
                  <input class="form-control" type="text" name="emcikli" value="<?php echo $em_cikli;?>"/><br/><br/></label>
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
