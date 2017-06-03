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
    $idlenda = mysqli_escape_string($con, $_POST['idlenda']);
    $id_Komisioni = mysqli_escape_string($con, $_POST['komisioni']);
    $data = mysqli_escape_string($con, $_POST['data']);
    $id_viti_akademik = mysqli_escape_string($con, $_POST['id_viti_akademik']);
    if(isset($_POST['prezentprovim'])){
      if( !empty($_POST['prezentprovim'])){
        foreach($_POST['prezentprovim'] as $studenti){
          $query = "INSERT INTO provimi (id_Provimi,id_Studenti, id_Komisioni,id_Lenda, Data,id_va) VALUES ('$id_provimi_aktual','$studenti', '$id_Komisioni','$idlenda','$data','$id_viti_akademik')";
          $res = mysqli_query($con, $query);
        }
        if($res){
          ?>
          <script type="text/javascript">
            alert("Te dhenat u ruajten me sukses!");
            setTimeout(function(){window.location.assign("index.php"); }, 300);
          </script>
          <?php
        }else{
          echo "Ups... I did again, I played with your heart!". $con->error;
        }
      }
    }
  }
}
?>
