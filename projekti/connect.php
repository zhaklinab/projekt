<?php
$host="127.0.0.1";
$port=3308;
$socket="";
$user="root";
$password="11111";
$dbname="flete_provimi2";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
?>
