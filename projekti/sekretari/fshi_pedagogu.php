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
if($row['role'] != 1){
  echo "Error 505!";
}else{

	if (isset($_GET['submit'] )) {
		$id = $_GET['id_pedagogu'];

	  $query1 = "DELETE FROM Pedagogu WHERE id_Pedagogu = '$id'";
		$result1 = mysqli_query($con, $query1);

		$query2 = "DELETE FROM user WHERE id_pedadog = '$id'";
		$result2 = mysqli_query($con, $query2);

		$query = "SELECT * FROM Pedagogu";
		$res = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($res);
		$emriped = $row['Em_Pedagogu'];

		$query3 = "DELETE FROM 	Komisioni WHERE Pedagog1='$emriped' OR Pedagog2='$emriped' OR Pedagog3='$emriped'";
		$result3 = mysqli_query($con, $query3);
    if($result3){
      ?>
      <script type="text/javascript">
        alert("Fshirja u be me sukses!");
        setTimeout(function(){window.location.assign("index.php"); }, 300);
      </script>
      <?php
    }else {
      echo "Error ne fshirje!";
    }
	}
}
