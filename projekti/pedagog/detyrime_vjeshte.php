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


    if(isset($_POST['submit'])){

      $id_lenda =$_POST['lenda'];
      $id_viti_akademik =$_POST['viti_akademik'];
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
              <li><a href="index_pedagog.php">  <?php echo $row['username']; ?></a></li>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
    </nav>
        <div class = "container">
          <form method="post" action="hyrjeneprovim.php">
          <?php
          $query5= "SELECT id_lenda, em_lenda FROM lenda WHERE id_lenda='$id_lenda'";
          $result = mysqli_query($con, $query5);
          while ($row = mysqli_fetch_assoc($result)) {
            echo"<center><h4><b>Me poshte afishohen detyrimet e studenteve per lenden:  ".$row['em_lenda']."</b></h4>";
          }
          $query3 = "SELECT id_lenda, id_lloji_i_ores, nr_oreve_akademike FROM lenda_lloji WHERE id_lenda='$id_lenda'";
          $result = mysqli_query($con, $query3);
          if(!mysqli_num_rows($result) == 0){
            while ($row = mysqli_fetch_assoc($result)) {
              if( $row['id_lloji_i_ores'] == 2)
              {
                echo "<div class= 'form-group'>Numri i Seminareve:".$row['nr_oreve_akademike']."</br>";
                $frekuentimi= (int)(0.7*$row['nr_oreve_akademike']);
                echo "Prezenca e detyruar:".$frekuentimi."</br>";
              }

              else if( $row['id_lloji_i_ores'] == 3)
              {
                echo "Numri Laboratoreve:".$row['nr_oreve_akademike']."<br/></div></center>";
              }
              else if( $row['id_lloji_i_ores'] == 1)
              {
                echo "Numri Leksioneve:".$row['nr_oreve_akademike']."<br/>";
              }else if( $row['id_lloji_i_ores'] == 5){
                echo "Detyre Kursi: ".$row['nr_oreve_akademike']."<br/></br>";
              }

            }
        }

          $query10 = "SELECT s.em_studenti, s.id_studenti
                      from studenti s
                      join prezenca_student ps
                      on s.id_Studenti = ps.id_Studenti
                      join prezenca p
                      on ps.id_Prezenca = p.id_Prezenca
                      join lenda l
                      on p.id_Lenda = l.id_Lenda
                      WHERE l.id_Lenda = '$id_lenda' AND p.id_viti_akademik ='$id_viti_akademik'
                      GROUP BY s.em_studenti";


          $res = mysqli_query($con, $query10);
          if($res){
            ?>
            <table class="table table-hover">
              <thead>
                <th>Emri</th>
                <th>Prezenca Seminar</th>
                <th>Prezenca Laborator</th>
                <th>Detyre Kursi</th>
                <th>Hyn ne provim</th>
              </thead>

              <tbody>
               <?php if (mysqli_num_rows($res) > 0 ) {
                 while($row = mysqli_fetch_assoc($res)) {

                   echo "<tr><td>".$row["em_studenti"]."</td>";
                   $idd_studenti = $row['id_studenti'];
                   $query = "SELECT  COUNT(ps.prezenca) as counting
                   FROM prezenca_student ps
                   Join studenti s on s.id_Studenti = ps.id_Studenti
                   Join prezenca p on ps.id_prezenca = p.id_prezenca
                   WHERE s.id_Studenti ='$idd_studenti' AND p.id_lloji_i_ores = 2 AND p.id_viti_akademik='$id_viti_akademik'";
                   $result = mysqli_query($con, $query);
                   if($result){

                   }else{
                     echo $con->error;
                   }
                   while($row1 = mysqli_fetch_assoc($result)){
                     echo "<td>".$row1['counting']."</td>";
                   }
                   $query1 = "SELECT  COUNT(ps.prezenca) as counting
                   FROM prezenca_student ps
                   Join studenti s on s.id_Studenti = ps.id_Studenti
                   Join prezenca p on ps.id_prezenca = p.id_prezenca
                   WHERE s.id_Studenti ='$idd_studenti' AND p.id_lloji_i_ores = 3 AND p.id_viti_akademik='$id_viti_akademik'";
                   $result1 = mysqli_query($con, $query1);
                   if($result1){

                   }else{
                     echo $con->error;
                   }
                   while($row2 = mysqli_fetch_assoc($result1)){
                     echo "<td>".$row2['counting']."</td>";
                   }
                   $query2 = "SELECT  COUNT(ps.prezenca) as counting
                   FROM prezenca_student ps
                   Join studenti s on s.id_Studenti = ps.id_Studenti
                   Join prezenca p on ps.id_prezenca = p.id_prezenca
                   WHERE s.id_Studenti ='$idd_studenti' AND p.id_lloji_i_ores = 5 AND p.id_viti_akademik='$id_viti_akademik'";
                   $result2 = mysqli_query($con, $query2);
                   if($result2){

                   }else{
                     echo $con->error;
                   }
                   while($row3 = mysqli_fetch_assoc($result2)){
                     echo "<td>".$row3['counting']."</td>";
                   }

               ?>

                   <td>
                     <div class="checkbox">
                       <label>
                          <input type='checkbox' value='<?php echo $row['id_studenti'];?>' name='provim[]' />
                          <input type="hidden" name="idlenda" value="<?php echo $id_lenda;?>">
                          <input type="hidden" name="id_viti_akademik" value="<?php echo $id_viti_akademik;?>">
                       </label>
                     </div>
                   </td>
                   </tr>
               <?php
                 }
               } else {
                   echo "0 results";
               }
               ?>
            </tbody>
          </table>
          <input type="submit" class="btn btn-success" name="shtocheck" value="Shto"/>
        </form>
          <?php
          }
          else {
            echo $con->error;
          }
          }
          ?>
        </div>
   </body>
</html>
