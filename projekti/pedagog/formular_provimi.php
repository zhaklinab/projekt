<?php
session_start();
include "../connect.php";
if(isset($_SESSION['id']) == ""){
  header("Location: ../index.php");
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id_user='$id'";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result)) {
   $id_user = $row['username'];

}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta charset="utf-8">
    <title>Flete Provimi</title>
  </head>

  <body>
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="">Flete Provimi</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav navbar-right nav-menu">
                <li><a href="index_pedagog.php">  <?php echo $id_user ?></a></li>
                <li><a href="../index.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class = "container" >


          <center>
              <div class='form-group'>
              <h2>  Formulari i Prezences ne Provim</h2>
              </div>
              </br></br>
          </center>

        <form  class="form-inline" method="post" action="formular_provimi.php">
          <center>
            <?php
                $query = "SELECT  id_njesia_baze,em_njesia_baze FROM  njesia_baze ";
                $result1 = mysqli_query($con, $query);

                echo "<div class='form-group'>";
                echo "<label>Njesia:</label>";
                echo "<select class = 'form-control' name='njesia_baze'>";

                while ($row = mysqli_fetch_assoc($result1)) {
                   $id_njesia_baze = $row['id_njesia_baze'];
                   $em_njesia_baze = $row['em_njesia_baze'];
                   echo '<option value="'.$id_njesia_baze.'">'.$em_njesia_baze.'</option>';
                }
                    echo "</select>";
                    echo "</div>&nbsp&nbsp&nbsp";

                $query = "SELECT  id_viti_akademik,viti_akademik FROM  viti_akademik ";
                $result1 = mysqli_query($con, $query);

                echo "<div class='form-group'>";
                echo "<label>Viti:</label>";
                echo "<select class = 'form-control' name='viti_akademik'>";

                while ($row = mysqli_fetch_assoc($result1)) {
                   $id_viti_akademik = $row['id_viti_akademik'];
                   $viti_akademik = $row['viti_akademik'];
                   echo '<option value="'.$id_viti_akademik.'">'.$viti_akademik.'</option>';
                }
                    echo "</select>";
                    echo "</div>&nbsp&nbsp&nbsp";

                $query = "SELECT  id_lenda,em_lenda FROM  lenda ";
                $result1 = mysqli_query($con, $query);

                echo "<div class='form-group'>";
                echo "<label>Lenda</label>";
                echo "<select class = 'form-control' name='lenda'>";

                while ($row = mysqli_fetch_assoc($result1)) {
                   $id_lenda = $row['id_lenda'];
                   $em_lenda = $row['em_lenda'];
                   echo '<option value="'.$id_lenda.'">'.$em_lenda.'</option>';
                }
                    echo "</select>";
                    echo "</div>&nbsp&nbsp&nbsp";
          ?>

          <div class='form-group'>
           <label>Data</label>
           <input type="date" class="form-control" name="data" required/>
         </div>

        </br></br>

         <div class='form-group'>
             <label>Pedagogu:</label><?php echo $id_user;?>
        </div>
      </center>
    </br></br>
<center>
             <table class="table table-hover">
               <thead>

                 <th>Emri</th>
                 <th>Prezent</th>

               </thead>

               <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["Em_Studenti"]."</td><td>"."</td><td> "."</td><td>"."</td>";
                ?>
                    <td>

                      <div class="checkbox">
                        <label>
                          <?php
                            echo "<input type='checkbox' value='' name='provim[]' />";
                          ?>
                        </label>
                      </div>
                    </td>
                    </tr>
                <?php
                  }
                } else {
                    echo "0 results";
                }
                ?>

             </tbody>
           </table>
         </center>
       <center>
            <div class="form-group">
                 <label>
                   Gjithe Grupi Prezent
                 <input name="prezenca_grupi" type="checkbox">
                 </label>
            </div>
            </br>
              <button type="submit" class="btn btn-default" name="submit" value="Submit">Formulari i Provimit</button>

       </form>
       </center>
     </div>


  </body>

</html>
