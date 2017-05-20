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
$username = $row['username'];
        if(isset($_POST['submit1'])){
          $id_lenda = $_POST['lenda'];
          $id_grupi = $_POST['grupi'];
          $id_lloji_i_ores = $_POST['lloji_i_ores'];
          $data = $_POST['data'];
          $viti_akademik = $_POST['viti_akademik'];

          $query = "SELECT * FROM pedagogu WHERE Email='$username'";
          $res = mysqli_query($con, $query);
          if($row = mysqli_fetch_assoc($res)){
            $idped = $row['id_Pedagogu'];
          }
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
                <nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="">Flete Provimi</a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar">
                      <ul class="nav navbar-nav navbar-right nav-menu">
                          <li><a href="index_pedagogu.php">  <?php echo $username  ; ?></a></li>
                          <li><a href="../logout.php">Logout</a></li>
                      </ul>
                    </div>
                  </div>
                 </nav>
                 <div class = "container" >
                 <center>
                    <div class = "container">
                      <div class='form-group'>
                      <h2> Prezenca</h2>
                      </div>
                  </br></br>
                </center>
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
                      // echo "<h1>".$idaktuale."</h1>";
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
                    }
                    else {
                      echo "Error: " . $query1. $con->error;
                    }
                     ?>
                   </tbody>
                 </table>
                 <center>
                   <input type="submit" class="btn btn-success" name="submit" value="Ruaj"/> </center>
                   </form>
                 <?php
               }
            ?>
          </html>
