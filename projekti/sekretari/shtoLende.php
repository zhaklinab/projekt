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
			$em_lenda = mysqli_real_escape_string($con, $_POST['em_lenda']);
			$id_komisioni = mysqli_real_escape_string($con, $_POST['komisioni']);
			$nr_leksionesh = mysqli_real_escape_string($con, $_POST['nr_leksione']);
			$nr_seminaresh = mysqli_real_escape_string($con, $_POST['nr_seminare']);
			$nr_laboratore = mysqli_real_escape_string($con, $_POST['nr_laboratore']);
			$nr_projekte = mysqli_real_escape_string($con, $_POST['nr_projekte']);

			$query1 = "INSERT INTO lenda (em_lenda,id_komisioni,nr_leksionesh,nr_seminaresh,nr_laboratore,nr_projekte) VALUES ('$em_lenda', '$id_komisioni','$nr_leksionesh','$nr_seminaresh','$nr_laboratore','$nr_projekte')";
	 		$query3 = "SELECT em_lenda FROM lenda WHERE em_lenda='$em_lenda'";
			$result = mysqli_query($con, $query3);
			if(mysqli_num_rows($result) == 0){
				if (mysqli_query($con, $query1)) {
					header("Location: index.php");
				}else{
					echo "Error: " . $query1."<br/>" . $con->error;
				}
			}else{
				?>
				<script type="text/javascript">
					alert("Kjo lende eshte e regjistruar!");
				</script>
				<?php
			}
		}
}
