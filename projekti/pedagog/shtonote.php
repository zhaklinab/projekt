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
  if(isset($_POST['submit'])){
    $id_ial = mysqli_escape_string($con, $_POST['ial']);
    $id_njesia_kryesore = mysqli_escape_string($con, $_POST['njesia_kryesore']);
    $id_njesia_baze = mysqli_escape_string($con, $_POST['njesia_baze']);
    $id_Student = $_POST['id_Studenti'];
    $id_Provimi = mysqli_escape_string($con, $_POST['id_Provimi']);
    $id_viti_akademik = mysqli_escape_string($con, $_POST['id_va']);
    $values = array();
    $i = 0;
    foreach ($_POST['nota'] as $nota){
     array_push($values, $nota);
    }
    foreach ($id_Student as $studentii  ) {
      $query = "INSERT INTO  flete_provimi (id_Studenti, id_Provimi, Nota, id_ial, id_njesia_kryesore, id_njesia_baze, id_viti_akademik,id_tipi_p) VALUES ('$studentii','$id_Provimi','$values[$i]','$id_ial','$id_njesia_kryesore','$id_njesia_baze','$id_viti_akademik','1') ";
      $results = mysqli_query($con, $query);
      if ($results){
        header("Location:index.php");
      }
      $i++;
    }
  }
}
  ?>
