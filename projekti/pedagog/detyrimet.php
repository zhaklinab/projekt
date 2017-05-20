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

    }
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
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="">Flete Provimi</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav navbar-right nav-menu">
                <li><a href="index_sekretari.php">  <?php echo $row['username']; ?></a></li>
                <li><a href="../index.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class = "container">
          <form  method="post" action="formular_provimi.php">
          <?php

          $query5= "SELECT id_lenda, em_lenda FROM lenda WHERE id_lenda='$id_lenda'";
          $result = mysqli_query($con, $query5);
          while ($row = mysqli_fetch_assoc($result)) {
            echo"<center><h4> Me poshte afishohen detyrimet e studenteve per lenden:  ".$row['em_lenda']."</h4>";
          }

          $query3 = "SELECT id_lenda, id_lloji_i_ores, nr_oreve_akademike FROM lenda_lloji WHERE id_lenda='$id_lenda'";
          $result = mysqli_query($con, $query3);

          // if (mysqli_query($con, $query3) ) {
          //   /*??*/
          // }
          // else {
          //   echo "Error: " . $query4 . $con->error;
          // }

          if(!mysqli_num_rows($result) == 0){
            while ($row = mysqli_fetch_assoc($result)) {
              if( $row['id_lloji_i_ores'] == 2)
              {
                echo "<div class= 'form-group'>Nr Seminareve:".$row['nr_oreve_akademike']."</br>";
                $frekuentimi= (0.03*$row['nr_oreve_akademike']);
                echo "Numrit total i mungesave te lejuara:".ceil($frekuentimi)."</br>";
              }

              if( $row['id_lloji_i_ores'] == 3)
              {
                echo "Nr Laboratoreve:".$row['nr_oreve_akademike']."</div></center>";
              }
            }
        }

        $query11="  SELECT  l.nr_oreve_akademike
                    from lenda_lloji l
                    left outer join prezenca p
                        on l.id_lenda=p.id_lenda
                    left outer join prezenca_student ps
                        on p.id_prezenca= ps.id_prezenca
                    left outer join studenti s
                        on ps.id_studenti=s.id_studenti
                    where p.id_lenda='$id_lenda'
                    AND p.id_lloji_i_ores= '2'
                    AND ps.prezenca = '1'";

          $result = mysqli_query($con, $query11);
          if (mysqli_query($con, $query11) ) {
            echo "ok sem";
          }
          else {
            echo "error". $con->error;
          }
          if(mysqli_num_rows($result) == 0){
          echo "empty";
          }
          else{}

  $query10 = "  SELECT s.em_studenti, l.nr_oreve_akademike
              from studenti s
              left outer join prezenca_student ps
                  on s.id_studenti=ps.id_studenti
              left outer join prezenca p
                  on ps.id_prezenca= p.id_prezenca
              left outer join lenda_lloji l
                  on p.id_lenda=l.nr_oreve_akademike
              where p.id_lenda='$id_lenda' ";

    $result = mysqli_query($con, $query10);
    if (mysqli_query($con, $query10) ) {
      echo "ok";
    }
    else {
      echo "error". $con->error;
    }
    if(mysqli_num_rows($result) == 0){
    echo "empty";
    }
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        //ruaj mungesat e seminareve lab dhe detyrat e kursit
      }}

         else{
// $query6= "SELECT id_prezenca FROM prezenca WHERE id_lenda='$id_lenda'";
// $result = mysqli_query($con, $query6);
// if (mysqli_query($con, $query3) ) {
//   echo "ok";
// }
// if(!mysqli_num_rows($result) == 0){
//   while ($row = mysqli_fetch_assoc($result)) {
//     $id_prezenca= $row['id_prezenca'];
//     echo $id_prezenca;
//     $query7 = "SELECT id_studenti,id_prezenca FROM prezenca_student WHERE id_prezenca='$id_prezenca'";
//     $result7 = mysqli_query($con, $query7);
//
//     if(!mysqli_num_rows($result7) == 0){
//       while ($row = mysqli_fetch_assoc($result7)) {
//         $id_studenti=$row['id_studenti'];
//         $query8 = "SELECT em_studenti,id_studenti FROM studenti WHERE id_studenti='$id_studenti'";
//         $result8 = mysqli_query($con, $query8);
//         if(!mysqli_num_rows($result8) == 0){
//           while ($row = mysqli_fetch_assoc($result8)) {
//             $em_studenti=$row['em_studenti'];
//             echo $em_studenti."</br>";
//           }
//         }
//       }
//     }
//
// }
// }
            //  $query1 =" SELECT Em_Studenti FROM studenti ";
            //  $result = mysqli_query($con, $query1);
             //
            //  if(mysqli_num_rows($result) == 0){
            //    $id_studenti= $row["id_studenti"];
            //      echo "Error: ";
            //    }


           ?>
             <table class="table table-hover">
               <thead>
                 <th>Emri</th>
                 <th>Mungesa Seminar</th>
                 <th>Mungesa Laborator</th>
                 <th>Detyre Kursi</th>
                 <th>Hyn ne provim</th>
               </thead>

               <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row["em_studenti"]."</td><td>".$row["nr_oreve_akademike"]."</td><td> "."</td><td>"."</td>";
                ?>
                    <td>

                      <div class="checkbox">
                        <label>
                          <?php
                            echo "<input type='checkbox' value='' name='provim[]' />";
                          ?>
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
       <center>
           <button type="submit" class="btn btn-default" name="submit" value="Submit">Hyjne ne Provim</button>
       </form>
       </center>
     </div>
  </body>
  <?php
  } ?>
</html>
