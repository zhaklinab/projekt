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
if($row['role'] != 0){
  echo "Error 505!";
}else{
	if (isset($_GET['submit'] )) {
		$id = $_GET['id'];

	  $query1 = "DELETE FROM user WHERE id_user = '$id'";
	  $result = mysqli_query($con, $query1);
	    if($result){
	      header("Location: index.php");
	    }
	    else {
	      echo "Error: " . $query1."<br/>" . $con->error;
	    }
	}
}