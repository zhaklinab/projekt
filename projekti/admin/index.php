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
            <li><a href="index.php" style="color:white;">  <?php echo $row['username']; ?></a></li>
            <li><a href="../logout.php" style="color:white;" >Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class = "container">
      <div class="row">
        <center>
          <h3>Ju jeni i loguar si Administrator</h3>
        </center></br></br>
        <ul id="mytabs" class="nav nav-pills nav-stacked col-md-2 " >
          <li role="presentation" class="active"><a href="#shtosekretari" aria-controls="shtosekretari" role="tab" data-toggle="tab" >Shto Sekretari</a></li>
          <li role="presentation"><a href="#listosekretari" aria-controls="listosekretari" role="tab" data-toggle="tab" >Listo Sekretari</a></li>
        </ul>
        <div class="col-md-2"></div>
        <div class="tab-content col-md-4">
        <div role="tabpanel" class="tab-pane fade in active" id="shtosekretari">
        <h4>Shtoni te dhenat per sekretarine:</h4>
         <form method="post" action="shto_sekretari.php">
           <div class="form-group">
               <label>E-mail</label>
               <input type="email" class="form-control" name="email" required/>
           </div>
           <div class="form-group">
               <label>Password</label>
               <input type="password" class="form-control" name="password" required/>
           </div>
           <input type="hidden" class="form-control" name="role" value=1 />
           </br>
           <input type="submit" class="btn btn-success" name="submit1" value="Shto"/>
         </form>
        </div>
        <div role="tabpanel" class="tab-pane fade in " id="listosekretari">
          <?php
            $query1 = "SELECT * FROM user where role='1'";
            $result = mysqli_query($con, $query1);
            if (mysqli_num_rows($result) > 0) {
           ?>
              <table class="table table-hover">
                <thead>
                  <th>Email</th>
                  <th>Password</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                 <?php
                   while($row1 = mysqli_fetch_assoc($result)) {
                     echo "<tr><td>".$row1["username"]."</td><td>**********"."</td><td> "."</td><td>"."</td>";
                 ?>
                     <td>
                        <form action="ndrysho_sekretari.php?id=<?php echo $row1['id_user']; ?>" method="GET">
                          <input type="hidden" name="id" value="<?php echo $row1['id_user']; ?>">
                          <input type="submit" class="btn btn-primary" name="submit" value="UPDATE">
                        </form>
                     </td>
                     <td>
                       <form action='fshi_sekretari.php?id="<?php echo $row1['id_user']; ?>"' method="GET">
                          <input type="hidden" name="id" value="<?php echo $row1['id_user']; ?>">
                           <input type="submit" class="btn btn-danger" name="submit" value="DELETE">
                       </form>
                     </td>
                     </tr>
                 <?php
                   }
                 }else{echo "0 results";}
                 ?>
              </tbody>
            </table>
          </form>
        </div>
       </div>
     </div>
    </div>
  </body>
</html>
<?php } ?>
