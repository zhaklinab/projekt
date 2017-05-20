<?php
session_start();
include "../connect.php";
if(isset($_SESSION['id']) == ""){
  header("Location: ../index.php");
}

if(isset($_POST['submit'])){
  $idaktuale = $_POST['idaktuale'];
  if(isset($_POST['checkbox'])){
    if( !empty($_POST['checkbox'])){
    foreach($_POST['checkbox'] as $studenti){
      $query = "INSERT INTO prezenca_student (id_Studenti, id_Prezenca, Prezenca ) VALUES ('$studenti', '$idaktuale','1')";
      $results = mysqli_query($con, $query);
    }
      header("Location:index_pedagog.php");
  }
  }

}?>
