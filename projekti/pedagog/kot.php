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
    $idaktuale = $_POST['idaktuale'];
    if(isset($_POST['checkbox'])){
      if( !empty($_POST['checkbox'])){
        foreach($_POST['checkbox'] as $studenti){
          $query = "INSERT INTO prezenca_student (id_Studenti, id_Prezenca, Prezenca ) VALUES ('$studenti', '$idaktuale','1')";
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
          echo "Ups... I did again, I played with your heart!";
        }
      }
    }
  }
}?>
