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
			$idpedagog1 = mysqli_real_escape_string($con, $_POST['pedagog1']);
	    $idpedagog2 = mysqli_real_escape_string($con, $_POST['pedagog2']);
	    $idpedagog3 = mysqli_real_escape_string($con, $_POST['pedagog3']);
	    $komision = mysqli_real_escape_string($con, $_POST['Komision']);
			if($idpedagog1 != $idpedagog2 && $idpedagog2 != $idpedagog3 && $idpedagog1 != $idpedagog3 ){
		    $query3 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog1'";
		    $result3 = mysqli_query($con, $query3);
				if(mysqli_num_rows($result3) > 0){
		        while($row = mysqli_fetch_assoc($result3)){
		          $pedagog1 = $row['em_pedagogu'];
		        }
		    }
		    $query4 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog2'";
		    $result4 = mysqli_query($con, $query4);
				if(mysqli_num_rows($result4) > 0){
		        while($row = mysqli_fetch_assoc($result4)){
		          $pedagog2 = $row['em_pedagogu'];
		        }
		    }
		    $query5 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog3'";
		    $result5 = mysqli_query($con, $query5);
				if(mysqli_num_rows($result5) > 0){
		        while($row = mysqli_fetch_assoc($result5)){
		          $pedagog3 = $row['em_pedagogu'];
		        }
		    }
		    $query2 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog1'";
		    $result2 = mysqli_query($con, $query2);
				if(mysqli_num_rows($result2) > 0){
		        while($row = mysqli_fetch_assoc($result2)){
		          $pedagog1 = $row['em_pedagogu'];
		        }
		    }
				$query1 = "INSERT INTO Komisioni (Emri_Komisioni, Pedagog1, Pozicion1, Pedagog2, Pozicion2, Pedagog3, Pozicion3) VALUES ('$komision','$pedagog1', 'Kryetar', '$pedagog2','Anetar1', '$pedagog3','Anetar2')";
				$result1 = mysqli_query($con, $query1);
				if(mysqli_num_rows($result1) == 0){
					if ($result1 ) {
						?>
						<script type="text/javascript">
							alert("U shtuan me sukses");
						  setTimeout(function(){window.location.assign("index.php"); }, 10);
						</script>
						<?php
					}
					else {
						echo "Error: " . $query1 . $con->error;
					}
			}else{
				?>
				<script type="text/javascript">
					alert("Ky komision eshte i regjistruar!");
					setTimeout(function(){window.location.assign("index.php"); }, 300);
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert("Duhet qe fushat e komisionit te pedagogut te jene te ndryshme!");
				setTimeout(function(){window.location.assign("index.php"); }, 300);
			</script>
			<?php
		}
	}
}?>
