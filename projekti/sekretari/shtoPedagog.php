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
		$emri = mysqli_real_escape_string($con, $_POST['emri']);
		$titulli = mysqli_real_escape_string($con, $_POST['titulli']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, password_hash($_POST['password'], PASSWORD_BCRYPT));
		$id_njesia_baze = mysqli_real_escape_string($con, $_POST['njesia_baze']);
		$query1 = "INSERT INTO Pedagogu (em_pedagogu, titulli, email, id_njesia_baze) VALUES ('$emri', '$titulli', '$email','$id_njesia_baze')";
		$query4 = "SELECT Email FROM Pedagogu WHERE Email='$email'";
		$result4 = mysqli_query($con, $query4);
		if(mysqli_num_rows($result4) == 0){
			$result1 = mysqli_query($con, $query1);
			$query = "SELECT MAX(id_Pedagogu) As max FROM Pedagogu";
			$res = mysqli_query($con, $query);
			if (!$res) {
			  echo "Error";
			}
			while($row = mysqli_fetch_assoc($res)){
				$idp = $row['max'];
			}
			$query2 = "INSERT INTO user (username, password, role, id_pedagog) VALUES('$email','$password','2','$idp')";
	 		$query3 = "SELECT username FROM user WHERE username='$email'";
			$result3 = mysqli_query($con, $query3);
			if(mysqli_num_rows($result3) == 0){
				$result2 = mysqli_query($con, $query2);
				if ($result1 && $result) {
					header("Location: index.php");
				}
				else {
					echo "Error: " . $query1 . "<br/>".$query2."<br/>" . $con->error;
				}
			}else{
				?>
				<script type="text/javascript">
					alert("Ky perdorues eshte tashme i regjistruar si user!");
					setTimeout(function(){
						window.location.assign("index.php");
					,300});
				</script>
				<?php
			}
		}else{
		?>
		<script type="text/javascript">
			alert("Ky pedagog eshte tashme i regjistruar si pedagog!");
	    setTimeout(function(){window.location.assign("index.php"); }, 1000);
		</script>
		<?php
		}
	}
}
?>
