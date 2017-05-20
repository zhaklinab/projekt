<?php
session_start();
include "../connect.php";

	  if (isset($_POST['submit'] )) {
		$em_lenda= mysqli_real_escape_string($con, $_POST['em_lenda']);
		$id_komisioni=$_POST['komisioni'];

		$query1 = "INSERT INTO lenda (em_lenda,id_komisioni) VALUES ('$em_lenda', '$id_komisioni')";
 		$query3 = "SELECT em_lenda FROM lenda WHERE em_lenda='$em_lenda'";
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
			alert("Kjo lende eshte e regjistruar!");
		</script>
		<?php
	}
}else {

	}
