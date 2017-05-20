<?php
session_start();
include "../connect.php";
if(isset($_SESSION['id']) == ""){
  header("Location: ../index.php");
}

$query1 = "SELECT MAX(id_provimi) As max FROM provimi";
$result = mysqli_query($con, $query1);

if (!$result) {
  echo "Error";
}

while($row = mysqli_fetch_assoc($result)) {
$id = $row['max'];
}

$id_provimi_aktual = ($id)+1;

if(isset($_POST['provim'])){
  $idlenda = $_POST['idlenda'];
  $id_Komisioni = $_POST['komisioni'];
  $data = $_POST['data'];
  $id_viti_akademik = $_POST['id_viti_akademik'];
  if(isset($_POST['prezentprovim'])){
    if( !empty($_POST['prezentprovim'])){
    foreach($_POST['prezentprovim'] as $studenti){
      $query = "INSERT INTO provimi (id_Provimi,id_Studenti, id_Komisioni,id_Lenda, Data,id_va) VALUES ('$id_provimi_aktual','$studenti', '$id_Komisioni','$idlenda','$data','$id_viti_akademik')";
      $results = mysqli_query($con, $query);
      if($results){
         header("Location:index_pedagog.php");
      }else{
        echo $con->error;
      }
    }
  }
  }
}



?>
