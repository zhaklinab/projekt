<?php
session_start();
include "../connect.php";

    if (isset($_POST['submit'] )) {
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, password_hash($_POST['password'], PASSWORD_BCRYPT));

		$query1 = "INSERT INTO user (username, password, role) VALUES('$email','$password','1')";
    $query2 = "SELECT username FROM user WHERE username='$email'";
    $result = mysqli_query($con, $query2);
    if(mysqli_num_rows( $result)==0) {
      if (mysqli_query($con, $query1)) {
  				header("Location: index.php");
  		}
  		else {
  			echo "Error: " . $query1 . "<br/>".$query2."<br/>" . $con->error;
  		}
    }else{
      ?>
      <script type="text/javascript">
        alert("Kjo sekretare ekziston tashme!");
      </script>
      <?php
    }
		$con->close();
	}else {
		?>
		<!DOCTYPE html>
		<html>
			<head>
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
