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
			$em_ial = mysqli_real_escape_string($con, $_POST['em_ial']);
			$adresa = mysqli_real_escape_string($con, $_POST['adresa']);

			$query1 = "INSERT INTO ial (em_ial,adresa) VALUES ('$em_ial', '$adresa')";
	 		$query3 = "SELECT em_ial FROM ial WHERE em_ial='$em_ial'";
			$result = mysqli_query($con, $query3);
			if(mysqli_num_rows($result) == 0){
				if (mysqli_query($con, $query1)) {
					header("Location: index.php");
				}
				else {
					echo "Error: " . $query1."<br/>" . $con->error;
				}
			}else{
				?>
				<script type="text/javascript">
					alert("Ky institucion ekziston!");
				</script>
				<?php
			}
		}
}
