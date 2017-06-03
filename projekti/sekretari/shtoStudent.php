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
		$em_student= mysqli_real_escape_string($con, $_POST['em_student']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
		$datelindja=mysqli_real_escape_string($con, $_POST['datelindja']);
		$password = mysqli_real_escape_string($con, password_hash($_POST['password'], PASSWORD_BCRYPT));
	  $id_grupi = mysqli_real_escape_string($con, $_POST['grupi']);

		$query1 = "INSERT INTO studenti (em_studenti, datelindje, email, Grupi_id_grupi) VALUES ('$em_student','$datelindja', '$email','$id_grupi')";
		$query4 = "SELECT Email FROM studenti WHERE Email='$email'";
		$result4 = mysqli_query($con, $query4);
		if(mysqli_num_rows($result4) == 0){
			$result1 = mysqli_query($con, $query1);
			$query = "SELECT MAX(id_Studenti) As max FROM studenti";
			$res = mysqli_query($con, $query);
			if (!$res) {
			  echo "Error";
			}
			while($row = mysqli_fetch_assoc($res)) {
				$ids = $row['max'];
			}
			$query2 = "INSERT INTO user (username, password, role) VALUES('$email', '$password', '3')";
			$query3 = "SELECT username FROM user WHERE username='$email'";
			$result3 = mysqli_query($con, $query3);
			if(mysqli_num_rows($result3) == 0){
				$result2 = mysqli_query($con, $query2);
				if($result2){
          ?>
          <script type="text/javascript">
            alert("Studenti u regjistrua me sukses!");
            setTimeout(function(){
              window.location.assign("index.php");
            ,300});
          </script>
          <?php
				}else{
					echo $con->error;
				}
			}else{
				?>
				<script type="text/javascript">
					alert("Ky perdorues eshte tashme i regjistruar!");
					setTimeout(function(){
						window.location.assign("index.php");
					,300});
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert("Ky student eshte tashme i regjistruar!");
				setTimeout(function(){
					window.location.assign("index.php");
				,300});
			</script>
			<?php
		}
	}
}
