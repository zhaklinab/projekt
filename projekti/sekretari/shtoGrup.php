<?php
session_start();
include "../connect.php";

    if (isset($_POST['submit'] )) {
		$em_grupi = mysqli_real_escape_string($con, $_POST['em_grupi']);
		$em_cikli = mysqli_real_escape_string($con, $_POST['em_cikli']);
    $id_viti_akademik = mysqli_real_escape_string($con, $_POST['viti_akademik']);

		$query1 = "INSERT INTO grupi (em_grupi, em_cikli, id_viti_akademik) VALUES('$em_grupi','$em_cikli','$id_viti_akademik')";
    $query2 = "SELECT em_grupi FROM grupi WHERE em_grupi='$em_grupi' ";
    $result = mysqli_query($con,$query2);

    if(mysqli_num_rows($result) == 0){

    if (mysqli_query($con, $query1)) {
			header("Location: index_sekretari.php");
		}
		else {
			echo "Error: " . $query1 . "<br/>" . $con->error;
		}

		$con->close();
	}else{
    ?>
    <script type="text/javascript">
      alert("Ky grup ekziston!");
    </script>
    <?php
  }
}else {
		?>
		<!DOCTYPE html>
		<html>
			<head>
        <link rel="stylesheet" href="background.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
				<meta charset="utf-8">
				<title>Flete Provimi</title>
			</head>

      <body>
			</body>
		</html>
		<?php
	}
?>
