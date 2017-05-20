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
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="">Flete Provimi</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav navbar-right nav-menu">
                <li><a href="index_pedagog.php">  <?php echo $row['username']; ?></a></li>
                <li><a href="../logout.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>

      <div class = "container">
        <div class="row">

              <ul id="mytabs" class="nav nav-pills col-md-2 " >
                <li role="presentation" class="active"><a href="#seanca" aria-controls="seanca" role="tab" data-toggle="tab" >Seanca Mesimore</a></li>
                <li role="presentation"><a href="#detyrimet" aria-controls="detyrimet" role="tab" data-toggle="tab" >Detyrimet e Studenteve</a></li>
                <li role="presentation"><a href="#notat" aria-controls="notat" role="tab" data-toggle="tab">Notat e Provimi</a></li>
                <li role="presentation"><a href="#detyrimet_vjeshte" aria-controls="formulari" role="tab" data-toggle="tab" >Detyrimet Vjeshte</a></li>
                <li role="presentation"><a href="#vjeshta" aria-controls="vjeshta" role="tab" data-toggle="tab">Nota Vjeshte</a></li>
              </ul>

          <div class="tab-content col-md-4">

            <div role="tabpanel" class="tab-pane fade in active" id="seanca">
              <form id="form1" method="post" action="shtoseance.php">
                <?php
                      $query = "SELECT  id_lenda, em_lenda FROM  lenda ";
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
                          echo "</div>";

                      $query = "SELECT  id_grupi,em_grupi FROM  grupi ";
                      $result1 = mysqli_query($con, $query);

                      echo "<div class='form-group'>";
                      echo "<label>Grupi</label>";
                      echo "<select class = 'form-control' name='grupi'>";

                      while ($row = mysqli_fetch_assoc($result1)) {
                         $id_grupi = $row['id_grupi'];
                         $em_grupi = $row['em_grupi'];
                         echo '<option value="'.$id_grupi.'">'.$em_grupi.'</option>';
                      }
                          echo "</select>";
                          echo "</div>";

                      $query = "SELECT  id_lloji_i_ores, lloji_i_ores FROM  lloji_i_ores ";
                      $result1 = mysqli_query($con, $query);

                      echo "<div class='form-group'>";
                      echo "<label>Lloji i Ores</label>";
                      echo "<select class = 'form-control' name='lloji_i_ores'>";

                      while ($row = mysqli_fetch_assoc($result1)) {
                         $id_lloji_i_ores = $row['id_lloji_i_ores'];
                         $lloji_i_ores = $row['lloji_i_ores'];
                         echo '<option value="'.$id_lloji_i_ores.'">'.$lloji_i_ores.'</option>';
                      }
                          echo "</select>";
                          echo "</div>";

                  $query = "SELECT  id_viti_akademik,viti_akademik FROM  viti_akademik ";
                  $result1 = mysqli_query($con, $query);

                  echo "<div class='form-group'>";
                  echo "<label>Viti Akademik</label>";
                  echo "<select class = 'form-control' name='viti_akademik'>";

                  while ($row = mysqli_fetch_assoc($result1)) {
                         $id_viti_akademik = $row['id_viti_akademik'];
                         $viti_akademik = $row['viti_akademik'];
                         echo '<option value="'.$id_viti_akademik.'">'.$viti_akademik.'</option>';
                  }
                  echo "</select>";
                  echo "</div>";
                ?>

                <div class="form-group">
                    <label>Data</label>
                    <input type="date" class="form-control" name="data" required/>
                </div>
                <input type="submit" class="btn btn-default" name="submit1" value="Shto Seancë"/>
                <!-- <button type="submit" class="btn btn-default" name="submit2" value="submit2">Shto Prezenca </button> -->
            </form>

         </div>

            <div role="tabpanel" class="tab-pane fade " id="detyrimet">
                <form method="post" action="detyrim.php">
                  <?php
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
                            echo "</div>";

                        $query = "SELECT  id_viti_akademik,viti_akademik FROM  viti_akademik ";
                        $result1 = mysqli_query($con, $query);

                        echo "<div class='form-group'>";
                        echo "<label>Viti Akademik</label>";
                        echo "<select class = 'form-control' name='viti_akademik'>";

                        while ($row = mysqli_fetch_assoc($result1)) {
                           $id_viti_akademik = $row['id_viti_akademik'];
                           $viti_akademik = $row['viti_akademik'];
                           echo '<option value="'.$id_viti_akademik.'">'.$viti_akademik.'</option>';
                        }
                            echo "</select>";
                            echo "</div>";
                  ?>
                  <button type="submit" class="btn btn-default" name="submit" value="Submit">Afisho Detyrimet </button>

                </form>
            </div>


            <div role="tabpanel" class="tab-pane fade " id="notat">

              <form method="post" action="nota.php">
                <?php
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
                          echo "</div>";

                      $query = "SELECT  id_viti_akademik,viti_akademik FROM  viti_akademik ";
                      $result1 = mysqli_query($con, $query);

                      echo "<div class='form-group'>";
                      echo "<label>Viti Akademik</label>";
                      echo "<select class = 'form-control' name='viti_akademik'>";

                      while ($row = mysqli_fetch_assoc($result1)) {
                         $id_viti_akademik = $row['id_viti_akademik'];
                         $viti_akademik = $row['viti_akademik'];
                         echo '<option value="'.$id_viti_akademik.'">'.$viti_akademik.'</option>';
                      }
                          echo "</select>";
                          echo "</div>";
                ?>
                <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto Notat </button>

              </form>

            </div>

            <div role="tabpanel" class="tab-pane fade " id="detyrimet_vjeshte">
              <form method="post" action="detyrime_vjeshte.php">
                <?php
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
                          echo "</div>";

                          $query = "SELECT  id_viti_akademik,viti_akademik FROM  viti_akademik ";
                          $result1 = mysqli_query($con, $query);

                          echo "<div class='form-group'>";
                          echo "<label>Viti Akademik</label>";
                          echo "<select class = 'form-control' name='viti_akademik'>";

                          while ($row = mysqli_fetch_assoc($result1)) {
                             $id_viti_akademik = $row['id_viti_akademik'];
                             $viti_akademik = $row['viti_akademik'];
                             echo '<option value="'.$id_viti_akademik.'">'.$viti_akademik.'</option>';
                          }
                              echo "</select>";
                              echo "</div>";
                ?>
                <button type="submit" class="btn btn-default" name="submit" value="Submit">Afisho Detyrimet </button>

              </form>

            </div>
            <div role="tabpanel" class="tab-pane fade " id="vjeshta">
              <form method="post" action="nota_vjeshte.php">
                <?php
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
                          echo "</div>";

                          $query = "SELECT  id_viti_akademik,viti_akademik FROM  viti_akademik ";
                          $result1 = mysqli_query($con, $query);

                          echo "<div class='form-group'>";
                          echo "<label>Viti Akademik</label>";
                          echo "<select class = 'form-control' name='viti_akademik'>";

                          while ($row = mysqli_fetch_assoc($result1)) {
                             $id_viti_akademik = $row['id_viti_akademik'];
                             $viti_akademik = $row['viti_akademik'];
                             echo '<option value="'.$id_viti_akademik.'">'.$viti_akademik.'</option>';
                          }
                              echo "</select>";
                              echo "</div>";
                ?>
                <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto Notat </button>

              </form>

            </div>

          </div>

        </div>
  </body>

</html>
