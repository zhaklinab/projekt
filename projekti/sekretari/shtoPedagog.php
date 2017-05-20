<?php
session_start();
include "../connect.php";

	  if (isset($_POST['submit'] )) {
		$emri = mysqli_real_escape_string($con, $_POST['emri']);
		$titulli = mysqli_real_escape_string($con, $_POST['titulli']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, password_hash($_POST['password'], PASSWORD_BCRYPT));

		$id_njesia_baze =$_POST['njesia_baze'];
		$query1 = "INSERT INTO Pedagogu (em_pedagogu,titulli,email,id_njesia_baze) VALUES ('$emri', '$titulli', '$email','$id_njesia_baze')";
		$query2 = "INSERT INTO user (username, password,role) VALUES('$email','$password','2')";
 		$query3 = "SELECT username FROM user WHERE username='$email'";
		$result = mysqli_query($con, $query3);
		if(mysqli_num_rows($result) == 0){
			if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
				header("Location: index_sekretari.php");
			}
			else {
				echo "Error: " . $query1 . "<br/>".$query2."<br/>" . $con->error;
			}
	}else{
		?>
		<script type="text/javascript">
			alert("Ky pedagog eshte i regjistruar!");
		</script>
		<?php
	}
}else {

	}

?>
