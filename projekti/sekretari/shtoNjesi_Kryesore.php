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
		$em_njesia_kryesore = mysqli_real_escape_string($con, $_POST['em_njesia_kryesore']);
		$adresa = mysqli_real_escape_string($con, $_POST['adresa']);
    $www = mysqli_real_escape_string($con, $_POST['www']);
    $id_ial = mysqli_real_escape_string($con, $_POST['ial']);

		$query1 = "INSERT INTO njesia_kryesore (em_njesia_kryesore,adresa,www,id_ial) VALUES ('$em_njesia_kryesore', '$adresa','$www','$id_ial')";
 		$query3 = "SELECT em_njesia_kryesore FROM njesia_kryesore WHERE em_njesia_kryesore='$em_njesia_kryesore'";
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
				alert("Kjo njesi kryesore ekziston!");
			</script>
			<?php
		}
	}
}
