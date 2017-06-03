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
    if (isset($_POST['submit'] )) {
  		$em_grupi = mysqli_real_escape_string($con, $_POST['em_grupi']);
  		$em_cikli = mysqli_real_escape_string($con, $_POST['em_cikli']);
      $id_viti_akademik = mysqli_real_escape_string($con, $_POST['viti_akademik']);

  		$query1 = "INSERT INTO grupi (em_grupi, em_cikli, id_viti_akademik) VALUES('$em_grupi','$em_cikli','$id_viti_akademik')";
      $query2 = "SELECT em_grupi FROM grupi WHERE em_grupi='$em_grupi' ";
      $result = mysqli_query($con,$query2);

      if(mysqli_num_rows($result) == 0){
        if (mysqli_query($con, $query1)) {
    			header("Location: index.php");
    		}else{
    			echo "Error: " . $query1 . "<br/>" . $con->error;
    		}
    		$con->close();
  	  }else{
      ?>
      <script type="text/javascript">
        alert("Ky grup ekziston!");
      </script>
      <?php
      }
    }
  }
}
?>
