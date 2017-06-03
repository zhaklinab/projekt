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
if($row['role'] != 2){
  echo "Error 505!";
}else{

?>
<!DOCTYPE html>
  <html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../projekti.css" >
      <meta charset="utf-8">
      <title>Flete Provimi</title>
    </head>
    <body>
      <nav class="navbar" style="background-color:#337ab7;">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php" style="color:white;">Flete Provimi</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav navbar-right nav-menu">
                <li><a href="index.php" style="color:white;"> <?php echo $row['username'];  ?></a></li>
                <li><a href="../logout.php" style="color:white;" >Logout</a></li>
              </ul>
            </div>
          </div>
      </nav>
    <div class = "container">
  <center>
          <form action="prezenca_provim.php" method="post">
            <?php
                  $query5 = "SELECT  id_Komisioni, Emri_Komisioni FROM  Komisioni ";
                  $result1 = mysqli_query($con, $query5);

                  echo "<div class='form-inline'>";
                  echo "<label>Komisioni:</label>&nbsp";
                  echo "<select class = 'form-control' name='komisioni'>";

                  while ($row = mysqli_fetch_assoc($result1)) {
                     $id_Komisioni= $row['id_Komisioni'];
                     $em_komisioni = $row['Emri_Komisioni'];?>

                     <option value=" <?php echo $id_Komisioni;?> "> <?php echo $em_komisioni; ?></option>
                     <?php
                  }
                      echo "</select>&nbsp&nbsp";
              ?>

                <label>Data:</label>&nbsp
                <input type="date" class="form-control"  name="data" required/>
              </div><br/><br/>

      <table class="table table-hover">
        <thead>
          <th>Emri</th>
          <th>Prezent/Jo prezent</th>
        </thead>
        <tbody>
        <?php
        if(isset($_POST['shtocheck'])){
          $idlenda = $_POST['idlenda'];
          $id_viti_akademik = $_POST['id_viti_akademik'];
          $array = array();
          $i = 0;
          if(isset($_POST['provim'])){
            if( !empty($_POST['provim'])){
            foreach($_POST['provim'] as $studenti){
              array_push($array, $studenti);
              $query2 = "INSERT INTO hyn_provim (id_Studenti, id_lenda, hyn_provim, id_va) VALUES ('$studenti','$idlenda','1','$id_viti_akademik')";
              $result1 =mysqli_query($con,$query2);

              $query = "SELECT * FROM studenti WHERE id_studenti='$studenti'";
              $results = mysqli_query($con, $query);
              while($row = mysqli_fetch_assoc($results)){
                ?>
                  <tr><td><?php echo $row['Em_Studenti'];?></td>

                      <td> <input type="checkbox" name="prezentprovim[]" value="<?php echo $row['id_Studenti'];?>"/></td>
                       <input type="hidden" name="student_on_page[]" value="<?php echo $row['id_Studenti'];?>"/>
                      <input type="hidden" name="idlenda" value="<?php echo $idlenda;?>"/>
                      <input type="hidden" name="id_viti_akademik" value="<?php echo $id_viti_akademik;?>"/>
                    </tr>

                  <?php
              }
              $i++;
            }
                ?> </tbody>
                </table>
                <input type="submit" class="btn btn-success" name="provim" value="Ruaj"/>
              </center>
            </form>
            <?php
          }
          }

        }}?>
      </div>
</body>
</html>
