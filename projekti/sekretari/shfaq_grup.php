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
  $username = $row['username'];

  $query = "SELECT * FROM Grupi";
  $result1 = mysqli_query($con, $query);
  ?>
<!DOCTYPE html>
  <html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
      <link rel="stylesheet" href="../projekti.css" >
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
                <li><a href="index.php" style="color:white;"> <?php echo $username; ?></a></li>
                <li><a href="../logout.php" style="color:white;" >Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>

      <div class="container">
        <div class="row">
          <table class="table table-hover">
            <thead>
              <th>Emertimi Grup</th>
              <th>Emertimi Cikli</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
             <?php
             while($row = mysqli_fetch_assoc($result1)){
               $emertim = $row['Em_Grupi'];
               $cikli = $row['Em_Cikli'];
                 echo "<tr><td>".$emertim."</td><td>".$cikli."</td><td> "."</td><td>"."</td>";
             ?>
                 <td>
                    <form action='ndrysho_grup.php?id="<?php echo $row['id_Grupi']; ?>"' method="GET">
                      <input type="hidden" name="id_grupi" value="<?php echo $row['id_Grupi']; ?>">
                      <input type="submit" class="btn btn-primary" name="submit" value="Update"/>
                    </form>
                 </td>
                 <td>
                   <form action='fshi_grup.php?id="<?php echo $row['id_Grupi']; ?>"' method="GET">
                      <input type="hidden" name="id_grupi" value="<?php echo $row['id_Grupi']; ?>">
                      <input type="submit" class="btn btn-danger" onclick="return confirm('Deshironi te fshini kete rekord? ');" name="submit" value="DELETE">
                   </form>
                 </td>
                 </tr>
                 <?php
                   }
                 ?>
          </tbody>
        </table>
    </body>
  </div>
</div>
</html>
<?php } ?>
