<?php
session_start();
include "../connect.php";
if(isset($_SESSION['id']) == ""){
  header("Location: ../index.php");
}

if(isset($_POST['submit'])){
  $id_ial =$_POST['ial'];
  $id_njesia_kryesore =$_POST['njesia_kryesore'];
  $id_njesia_baze =$_POST['njesia_baze'];
  $id_Student = $_POST['id_Studenti'];
  $id_Provimi = $_POST['id_Provimi'];
  $values = array();
  $i = 0;
  foreach ($_POST['nota'] as $nota){
   array_push($values, $nota);
  }
  foreach ($id_Student as $studentii  ) {
      $query = "UPDATE  flete_provimi SET Nota='$values[$i]', id_tipi_p=2 WHERE id_Studenti='$studentii' ";
      $results = mysqli_query($con, $query);
      if ($results){
        echo "hey";
        header("Location:index_pedagog.php");
      }
      else
      echo $con->error;
      $i++;
    }
}
?>
