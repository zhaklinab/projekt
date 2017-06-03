<?php
session_start();
include "../connect.php";
if(!isset($_SESSION['id'])){
  header("Location: ../index.php");
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id_user='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if($row['role'] != 3){
  echo "Error 505!";
}else{
  $username = $row['username'];
  $query = "SELECT s.em_Studenti,s.email,s.id_Studenti, p.id_Lenda,l.Em_lenda,fp.Nota FROM studenti as s
            JOIN provimi as p ON s.id_Studenti = p.id_Studenti
            JOIN flete_provimi as fp ON p.id_provimi = fp.id_provimi
            JOIN lenda as l ON p.id_lenda = l.id_lenda
            Where s.email = '$username' GROUP BY l.Em_lenda";

  $results = mysqli_query($con, $query);
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="../projekti.css" >
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
        <center>
          <h2>Notat e Studentit</h2>
        </center>
         </br>
           <div class="row">
             <div class="col-md-4"></div>
             <div class="col-md-4">
               <?php
               if(mysqli_num_rows($results) >0){
                 ?>
                 <table class="table table-hover">
                   <thead>
                     <th>Emertimi i Lendes</th>
                     <th>Nota</th>
                   </thead>
                   <tbody>
                   <?php
                   while($row = mysqli_fetch_assoc($results)){
                     ?>
                       <tr>
                         <td><?php echo $row['Em_lenda'];?></td>
                         <td><?php echo $row['Nota'];?></td>
                      </tr>
                      <?php
                    }
               }else{
                 echo "Te dhenat tuaja nuk jane shtuar akoma";
               }
              ?>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </body>
  </html>
<?php
}
?>
