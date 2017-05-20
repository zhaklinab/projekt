<?php
session_start();
include "../connect.php";

	  if (isset($_POST['submit'] )) {
		$em_student= mysqli_real_escape_string($con, $_POST['em_student']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
		$datelindja=$_POST['datelindja'];

	  $id_grupi =$_POST['grupi'];

		$query1 = "INSERT INTO studenti (em_studenti,datelindje,email, Grupi_id_grupi) VALUES ('$em_student','$datelindja', '$email','$id_grupi')";
 		$query3 = "SELECT * FROM studenti WHERE em_studenti='$em_student'AND email='$email' " ;
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
			alert("Ky student eshte i regjistruar!");
		</script>
		<?php
	}
}else {

	}
