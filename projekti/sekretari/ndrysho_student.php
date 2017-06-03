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
    $id = $_GET['id_studenti'];
    $query = "SELECT * FROM Studenti WHERE id_Studenti = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $emri = $row['Em_Studenti'];
    $datelindje = $row['Datelindje'];
    $email= $row['Email'];

    if(isset($_POST['submit1'])){
      $emri_s = mysqli_escape_string($con, $_POST['emri_s']);
      $datelindje_s = mysqli_escape_string($con, $_POST['datelindje_s']);
      $email_s = mysqli_escape_string($con, $_POST['email_s']);

      $update = "UPDATE Studenti SET Em_Studenti = '$emri_s' ,datelindje_s = '$datelindje_s',email_s = '$email_s' WHERE id_Studenti = '$id'";
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
                  <label style="font-align:left;">Emri i Studentit:</label>
                  <input type="text" class="form-control" name="emri_p" value="<?php echo $emri;?>"/><br/><br/>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Datelindje:</label>
                <input class="form-control" type="date" name="datelindje_p" value="<?php echo $datelindje;?>"/><br/><br/></label>
              </div>
              <div class="form-group ">
                <label style="font-align:left;">Email:</label>
                <input class="form-control" type="email" name="email_p" value="<?php echo $email;?>"/><br/><br/></label>
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
