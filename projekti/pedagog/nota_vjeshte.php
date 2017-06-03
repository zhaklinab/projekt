<?php
session_start();
include "../connect.php";
if(isset($_SESSION['id']) == ""){
  header("Location: ../index.php");
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id_user = '$id'";
$resultu = mysqli_query($con, $sql);
$rowu = mysqli_fetch_assoc($resultu);
if($rowu['role'] != 2){
  echo "Error 505!";
}else{
    if(isset($_POST['submit'])){
      $id_lenda = mysqli_real_escape_string($con, $_POST['lenda']);
      $id_viti_akademik = mysqli_real_escape_string($con, $_POST['viti_akademik']);

      $query5= "SELECT id_viti_akademik, viti_akademik FROM viti_akademik WHERE id_viti_akademik='$id_viti_akademik'";
      $result = mysqli_query($con, $query5);
      while ($row = mysqli_fetch_assoc($result)) {
        $em_viti = $row['viti_akademik'];
      }

      $query6= "SELECT id_lenda, em_lenda FROM lenda WHERE id_lenda='$id_lenda'";
      $result = mysqli_query($con, $query6);
      while ($row = mysqli_fetch_assoc($result)) {
         $em_lenda=$row['em_lenda'];
      }
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
                <li><a href="index.php" style="color:white;"> <?php echo $rowu['username']; ?></a></li>
                <li><a href="../logout.php" style="color:white;" >Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>
            <div class = "container" >
              <center>
                  <div class='form-group'>
                  <h2> Notat e Provimit</h2>
                  </div>
                  </br>
              </center>

            <form  class="form-inline" method="post" action="shtonote_vjeshte.php">
              <center>
                <?php
                $query = "SELECT  id_ial, em_ial FROM  ial ";
                $result1 = mysqli_query($con, $query);

                echo "<div class='form-group'>";
                echo "<label>IAL:</label> ";
                echo "<select class = 'form-control' name='ial'>";

                while ($row = mysqli_fetch_assoc($result1)) {
                   $id_ial = $row['id_ial'];
                   $em_ial = $row['em_ial'];
                   echo '<option value="'.$id_ial.'">'.$em_ial.'</option>';
                }
                    echo "</select>";
                    echo "</div>&nbsp&nbsp&nbsp";

                $query = "SELECT  id_njesia_kryesore,em_njesia_kryesore FROM  njesia_kryesore ";
                $result1 = mysqli_query($con, $query);

                echo "<div class='form-group'>";
                echo "<label>Njesia kryesore:</label> ";
                echo "<select class = 'form-control' name='njesia_kryesore'>";

                while ($row = mysqli_fetch_assoc($result1)) {
                   $id_njesia_kryesore = $row['id_njesia_kryesore'];
                   $em_njesia_kryesore = $row['em_njesia_kryesore'];
                   echo '<option value="'.$id_njesia_kryesore.'">'.$em_njesia_kryesore.'</option>';
                }
                    echo "</select>";
                    echo "</div>&nbsp&nbsp&nbsp";

                    $query = "SELECT  id_njesia_baze,em_njesia_baze FROM  njesia_baze ";
                    $result1 = mysqli_query($con, $query);

                    echo "<div class='form-group'>";
                    echo "<label>Njesia:</label> ";
                    echo "<select class = 'form-control' name='njesia_baze'>";

                    while ($row = mysqli_fetch_assoc($result1)) {
                       $id_njesia_baze = $row['id_njesia_baze'];
                       $em_njesia_baze = $row['em_njesia_baze'];
                       echo '<option value="'.$id_njesia_baze.'">'.$em_njesia_baze.'</option>';
                    }
                        echo "</select>";
                        echo "</div>&nbsp&nbsp&nbsp<br/></br>";


                    echo "<div class='form-group'>";
                    echo "<label>Viti:</label> " .$em_viti;
                    echo "</div>&nbsp&nbsp&nbsp";

                    $query = "SELECT  id_lenda,em_lenda FROM  lenda ";
                    $result1 = mysqli_query($con, $query);

                    echo "<div class='form-group'>";
                    echo "<label>Lenda:</label> ".$em_lenda;
                    echo "</div>&nbsp&nbsp&nbsp";
                  ?>
                </br>
              </center>
            </br></br>
            <?php
                $query2 = "SELECT s.em_Studenti,s.id_Studenti, p.id_Provimi
                          from studenti s
                          join provimi p
                          on s.id_Studenti = p.id_Studenti
                          join flete_provimi fp
                          on p.id_Studenti = fp.id_Studenti
                          Where p.id_Lenda = '$id_lenda' AND fp.Nota <= 4 AND fp.id_viti_akademik = '$id_viti_akademik'";

                $result = mysqli_query($con, $query2);
                if($result){
              ?>
                     <table class="table table-hover">
                       <thead>
                         <th>Emri</th>
                         <th>Nota</th>
                       </thead>
                       <tbody>
                        <?php
                         if (mysqli_num_rows($result) >0) {
                          while($row = mysqli_fetch_assoc($result)) {
                          $id_studenti = $row ["id_Studenti"];
                          $id_provimi = $row["id_Provimi"];

                          $query = "SELECT  id_nota, nota FROM  nota ";
                          $result1 = mysqli_query($con, $query);
                            echo "<tr><td>".$row["em_Studenti"]."</td><td>";
                            echo "<select class = 'form-control' name='nota[]' >";
                            while ($row = mysqli_fetch_assoc($result1)) {
                               $id_nota = $row['id_nota'];
                               $nota = $row['nota'];
                               echo '<option value="'.$nota.'">'.$nota.'</option>';
                            }
                            echo "</select>";
                            "</td>";
                            ?>
                            <input type="hidden" name="id_Studenti[]" value="<?php echo $id_studenti;?>">
                            <input type="hidden" name="id_Provimi" value="<?php echo $id_provimi;?>">
                            </tr>
                        <?php
                          }
                        }else{echo "0 results";}
                        ?>
                     </tbody>
                   </table>
            <?php
          }else{
            echo $con->error;
          }
          ?>
          <center></br>
            <input type="submit" class="btn btn-success" name="submit" value="Ruaj Notat"/>
          </center>
        </form>
     </div>
  </body>
  <?php
   }
}
?>
</html>
