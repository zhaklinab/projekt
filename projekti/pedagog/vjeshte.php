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

if($row['role'] != 2){
  echo "Error 505!";
}else{
   $id_user = $row['username'];
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Flete Provimi</title>
  </head>
  <body>
    <nav class="navbar" style="background-color:#337ab7;">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php" style="color:white;">Flete Provimi</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav navbar-right nav-menu">
                <li><a href="index.php" style="color:white;"> <?php echo $id_user ?></a></li>
                <li><a href="../index.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class = "container" >
          <center>
              <div class='form-group'>
              <h2> Notat e Provimit</h2>
              </div>
              </br></br>
          </center>
        <form  class="form-inline" method="post" action="nota.php">
             <table class="table table-hover">
               <thead>
                 <th>Emri</th>
                 <th>Nota</th>
               </thead>
               <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<tr><td>".$row["Em_Studenti"]."</td><td>"."</td>";
                    ?></tr>
                    <?php
                    }
                }else{
                    echo "0 results";
                }
                ?>
             </tbody>
           </table>
           <center>
            </br>
              <button type="submit" class="btn btn-default" name="submit" value="Submit">Ruaj</button>
          </center>
       </form>
     </div>
  </body>
</html>
