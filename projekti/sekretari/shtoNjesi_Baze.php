<?php
session_start();
include "../connect.php";

	  if (isset($_POST['submit'] )) {
		$em_njesia_baze = mysqli_real_escape_string($con, $_POST['em_njesia_baze']);
		$adresa = mysqli_real_escape_string($con, $_POST['adresa']);
    $www = mysqli_real_escape_string($con, $_POST['www']);
    $id_njesia_kryesore = mysqli_real_escape_string($con, $_POST['njesia_kryesore']);

		$query1 = "INSERT INTO njesia_baze(em_njesia_baze,adresa,www,id_njesia_kryesore) VALUES ('$em_njesia_baze', '$adresa','$www','$id_njesia_kryesore')";
 		$query3 = "SELECT em_njesia_baze FROM njesia_baze WHERE em_njesia_baze='$em_njesia_baze'";
		$result = mysqli_query($con, $query3);
		if(mysqli_num_rows($result) == 0){
			if (mysqli_query($con, $query1)) {
				header("Location: index_sekretari.php");
			}
			else {
				echo "Error: " . $query1."<br/>" . $con->error;
			}
	}else{
		?>
		<script type="text/javascript">
			alert("Kjo njesi baze ekziston!");
		</script>
		<?php
	}
}else {

	}
