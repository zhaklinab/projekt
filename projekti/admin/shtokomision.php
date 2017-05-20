<?php
session_start();
include "../connect.php";


	  if (isset($_POST['submit'] )) {
		$idpedagog1 = mysqli_real_escape_string($con, $_POST['pedagog1']);
    $idpedagog2 = mysqli_real_escape_string($con, $_POST['pedagog2']);
    $idpedagog3 = mysqli_real_escape_string($con, $_POST['pedagog3']);
    $idpozicion1 = mysqli_real_escape_string($con, $_POST['pozicion1']);
    $idpozicion2 = mysqli_real_escape_string($con, $_POST['pozicion2']);
    $idpozicion3 = mysqli_real_escape_string($con, $_POST['pozicion3']);

    $query3 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog1'";
    $result = mysqli_query($con, $query3);
		if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $pedagog1 = $row['em_pedagogu'];
        }
    }
    $query4 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog2'";
    $result = mysqli_query($con, $query4);
		if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $pedagog2 = $row['em_pedagogu'];
        }
    }
    $query5 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog3'";
    $result = mysqli_query($con, $query5);
		if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $pedagog3 = $row['em_pedagogu'];
        }
    }

    $query6 = "SELECT lloji_pozicionit FROM pozicioni WHERE id_pozicioni='$idpozicion1'";
    $result = mysqli_query($con, $query6);
		if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $pozicion1 = $row['lloji_pozicionit'];
        }
    }
    $query7 = "SELECT lloji_pozicionit FROM pozicioni WHERE id_pozicioni='$idpozicion2'";
    $result = mysqli_query($con, $query7);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $pozicion2 = $row['lloji_pozicionit'];
        }
    }
    $query8 = "SELECT lloji_pozicionit FROM pozicioni WHERE id_pozicioni='$idpozicion3'";
    $result = mysqli_query($con, $query8);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $pozicion3 = $row['lloji_pozicionit'];
        }
    }
    $query3 = "SELECT em_pedagogu FROM pedagogu WHERE id_pedagogu='$idpedagog1'";
    $result = mysqli_query($con, $query3);
		if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $pedagog1 = $row['em_pedagogu'];
        }
    }
		$query1 = "INSERT INTO Komisioni (pedagog1,pozicion1,pedagog2,pozicion2,pedagog3,pozicion3) VALUES ('$pedagog1', '$pozicion1', '$pedagog2','$pozicion2', '$pedagog3','$pozicion3')";
		$result = mysqli_query($con, $query1);
		if(mysqli_num_rows($result) == 0){
			if ($result ) {
				header("Location: index.php");
			}
			else {
				echo "Error: " . $query1 . $con->error;
			}
	}else{
		?>
		<script type="text/javascript">
			alert("Ky komision eshte i regjistruar!");
		</script>
		<?php
	}
}


 ?>

<!DOCTYPE HTML>
<html>

      <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Flete_Provimi</title>
      </head>

      <body>
      </body>

</html>
