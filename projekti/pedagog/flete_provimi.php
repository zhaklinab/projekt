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
if($row['role'] != 2){
  echo "Error 505!";
}else{
  if(isset($_POST['submit'])){

    $id_lenda = mysqli_escape_string($con, $_POST['lenda']);
    $id_va = mysqli_escape_string($con, $_POST['viti_akademik']);
    $tipi_p = mysqli_escape_string($con, $_POST['tipi_p']);

    $query = "SELECT s.Em_Studenti, fp.nota, nk.Em_njesia_kryesore, nb.Em_Njesia_Baze, g.Em_Grupi,k.Pedagog2, va.viti_akademik, i.Em_IAL, i.Adresa, tp.Tipi_P FROM studenti as s
              JOIN flete_provimi as fp on fp.id_Studenti = s.id_Studenti
              JOIN grupi as g on s.Grupi_id_Grupi = g.id_Grupi
              JOIN ial as i on i.id_IAL = fp.id_IAL
              JOIN njesia_baze as nb on nb.id_Njesia_baze = fp.id_Njesia_baze
              JOIN njesia_kryesore as nk on nk.id_Njesia_kryesore = fp.id_Njesia_kryesore
              JOIN viti_akademik as va on va.id_viti_akademik = fp.id_viti_akademik
              JOIN tipi_p as tp on tp.id_tipi_p = fp.id_tipi_p
              JOIN provimi as p on p.id_provimi = fp.id_provimi
              JOIN komisioni as k on k.id_Komisioni = p.id_Komisioni
              WHERE p.id_lenda = '$id_lenda' AND va.id_viti_akademik = '$id_va'
              GROUP BY Em_Studenti ";

    $res = mysqli_query($con, $query);
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
        <div class="col-md-3"></div>
          <div class="col-md-6">
            <?php
            if(mysqli_num_rows($res) > 0){
              $row = mysqli_fetch_assoc($res);
               echo "<center><h3>".$row['Em_IAL']."</h3>";
               echo "<h4>".$row['Em_njesia_kryesore']."</h4>";
               echo "<h5>".$row['Adresa']."<h5>";
               echo "<h5><strong>Viti Akademik: ".$row['viti_akademik']."</strong></h5>";
               echo "<h5><strong>Tipi Sezonit: ".$row['Tipi_P']."</strong></h5></center><br><br>";
                ?>

                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td> Pedagogu: <?php echo $username;  ?></td>
                      <td> Anetar1: <?php echo $row['Pedagog2'];  ?></td>
                    </tr>
                    <tr>
                      <td> Grupi: <?php echo $row['Em_Grupi'];  ?></td>
                      <td>  <?php echo $row['Em_Njesia_Baze'];  ?></td>
                    </tr>
                </tbody>
              </table>
                <table class="table table-hover">
                  <thead>
                    <th>Emer Mbiemer</th>
                    <th>Nota</th>
                  </thead>
                  <tbody>
                      <?php
                     while($row = mysqli_fetch_assoc($res)){
                        $em_student = $row['Em_Studenti'];
                        $nota = $row['nota'];
                        echo "<tr> <td>". $em_student . "</td><td>". $nota . "</td> </tr>";
                     }
                    }else{
                      echo "<center><h3>Nuk ka rezultate per kete zgjedhje!</h3></center>";
                    }
                    ?>
              </tbody>
            </table>
          </div>
      </body>
    </html>
    <?php
  }
}
?>
