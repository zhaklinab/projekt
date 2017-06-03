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
    $username = $row['username'];
    if(isset($_POST['submit1'])){
      $id_lenda = mysqli_escape_string($con, $_POST['lenda']);
      $id_grupi = mysqli_escape_string($con, $_POST['grupi']);
      $id_lloji_i_ores = mysqli_escape_string($con, $_POST['lloji_i_ores']);
      $data = mysqli_escape_string($con, $_POST['data']);
      $viti_akademik = mysqli_escape_string($con, $_POST['viti_akademik']);

      $query = "SELECT * FROM Pedagogu WHERE Email='$username'";
      $res = mysqli_query($con, $query);
      $row1 = mysqli_fetch_assoc($res);
      $idped = $row1['id_Pedagogu'];
      $query1 = "INSERT INTO prezenca (id_lenda, id_Pedagogu, id_lloji_i_ores, data, id_grupi, id_viti_akademik)VALUES ('$id_lenda','$idped','$id_lloji_i_ores','$data', '$id_grupi','$viti_akademik')";
      $result = mysqli_query($con, $query1);
      $idaktuale = mysqli_insert_id($con);
      if ($result ) {
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
                        <li><a href="index.php" style="color:white;">  <?php echo $username  ; ?></a></li>
                        <li><a href="../logout.php" style="color:white;" >Logout</a></li>
                    </ul>
                  </div>
                </div>
               </nav>
              <div class = "container">
                <div class="row">
                   <center>
                    <div class='form-group'>
                    <h2> Prezenca</h2>
                    </div>
                  </center>
                  </br></br>
                  <form action="kot.php" method="post">
                  <table class="table table-hover">
                      <thead>
                          <th>Emri</th>
                          <th>Datelindja</th>
                          <th>Email</th>
                          <th>Grupi</th>
                          <th></th>
                      </thead>
                      <tbody>
                      <?php
                      $query = "SELECT * FROM studenti WHERE Grupi_id_grupi='$id_grupi'";
                      $res = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($res)) {
                        echo "<tr><td>".$row["Em_Studenti"]."</td><td>". $row["Datelindje"]."</td><td> ".$row["Email"]."</td><td>".$row["Grupi_id_Grupi"]."</td>";
                        ?>
                        <td>
                          <div class="checkbox">
                            <label>
                              <input type='checkbox' name='checkbox[]' value='<?php echo $row["id_Studenti"];?>'/>
                              <input type="hidden" name="idaktuale" value="<?php echo $idaktuale;?>">
                            </label>
                          </div>
                        </td>
                        </tr>
                    <?php
                      }
                    }else{echo "Error: " . $query1. $con->error;}
                     ?>
                   </tbody>
                 </table>
                 <center>
                   <input type="submit" class="btn btn-success" name="submit" value="Ruaj"/>
                 </center>
                </form>
              </div>
            </div>
          </body>
      </html>
    <?php
       }
     }
    ?>
