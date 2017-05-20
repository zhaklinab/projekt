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
                <li><a href="index_sekretari.php">  <?php echo $row['username']; ?></a></li>
                <li><a href="../index.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>

    <div class = "container">
      <div class="row">

            <ul id="mytabs" class="nav nav-pills col-md-2 " >
              <li role="presentation" class="active"><a href="#ial" aria-controls="ial" role="tab" data-toggle="tab" >Institucione (IAL)</a></li>
              <li role="presentation"><a href="#njesi_kryesore" aria-controls="njesi_kryesore" role="tab" data-toggle="tab" >Njesi Kryesore</a></li>
              <li role="presentation"><a href="#njesia_baze" aria-controls="njesia_baze" role="tab" data-toggle="tab" >Njesi Baze</a></li>
              <li role="presentation"><a href="#pedagog" aria-controls="pedagog" role="tab" data-toggle="tab">Pedagog</a></li>
              <li role="presentation"><a href="#grup" aria-controls="grup" role="tab" data-toggle="tab">Grup Mesimor</a></li>
              <li role="presentation"><a href="#lende" aria-controls="lende" role="tab" data-toggle="tab">Lende </a></li>
              <li role="presentation"><a href="#student" aria-controls="student" role="tab" data-toggle="tab">Student</a></li>

            </ul>

            <div class="tab-content col-md-4">
              <div role="tabpanel" class="tab-pane fade in active" id="ial">
                <form method="post" action="shtoIal.php">

                    <div class="form-group">
                        <label>Emertimi i IAL</label>
                        <input type="text" class="form-control" name="em_ial" required/>
                    </div>


                    <div class="form-group">
                        <label>Adresa</label>
                        <input type="text" class="form-control" name="adresa" required/>
                    </div>

                    <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto </button>

                </form>
              </div>

              <div role="tabpanel" class="tab-pane fade" id="njesi_kryesore">
                <form method="post" action="shtoNjesi_Kryesore.php">

                    <div class="form-group">
                        <label>Emertimi i Njesise Kryesore</label>
                        <input type="text" class="form-control" name="em_njesia_kryesore" required/>
                    </div>


                    <div class="form-group">
                        <label>Adresa</label>
                        <input type="text" class="form-control" name="adresa" required/>
                    </div>

                    <div class="form-group">
                        <label>Faqja Web</label>
                        <input type="text" class="form-control" name="www" required/>
                    </div>

                    <?php
                          $query = "SELECT  id_ial,em_ial FROM  ial ";
                          $result1 = mysqli_query($con, $query);

                          echo "<div class='form-group'>";
                          echo "<label>IAL</label>";
                          echo "<select class = 'form-control' name='ial'>";

                          while ($row = mysqli_fetch_assoc($result1)) {
                             $id_ial = $row['id_ial'];
                             $em_ial = $row['em_ial'];
                             echo '<option value="'.$id_ial.'">'.$em_ial.'</option>';
                          }
                              echo "</select>";
                              echo "</div>";
                    ?>

                    <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto </button>

                </form>
              </div>

              <div role="tabpanel" class="tab-pane fade" id="njesia_baze">
                <form method="post" action="shtoNjesi_Baze.php">

                    <div class="form-group">
                        <label>Emertimi i Njesise Baze</label>
                        <input type="text" class="form-control" name="em_njesia_baze" required/>
                    </div>


                    <div class="form-group">
                        <label>Adresa</label>
                        <input type="text" class="form-control" name="adresa" required/>
                    </div>

                    <div class="form-group">
                        <label>Faqja Web</label>
                        <input type="text" class="form-control" name="www" required/>
                    </div>

                    <?php
                          $query = "SELECT  id_njesia_kryesore,em_njesia_kryesore FROM  njesia_kryesore ";
                          $result1 = mysqli_query($con, $query);

                          echo "<div class='form-group'>";
                          echo "<label>Njesia Kryesore</label>";
                          echo "<select class = 'form-control' name='njesia_kryesore'>";

                          while ($row = mysqli_fetch_assoc($result1)) {
                             $id_njesia_kryesore = $row['id_njesia_kryesore'];
                             $em_njesia_kryesore = $row['em_njesia_kryesore'];
                             echo '<option value="'.$id_njesia_kryesore.'">'.$em_njesia_kryesore.'</option>';
                          }
                              echo "</select>";
                              echo "</div>";
                    ?>

                    <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto </button>

                </form>
                </div>

               <div role="tabpanel" class="tab-pane fade" id="pedagog">
                 <form method="post" action="../admin/shtopedagog.php">

                     <div class="form-group">
                         <label>Emri Mbiemri</label>
                         <input type="text" class="form-control" name="emri" required/>
                     </div>

                     <div class="form-group">
                         <label for="exampleInputEmail1">E-mail</label>
                         <input type="email" class="form-control" id="exampleInputEmail1" name="email" required/>
                     </div>

                     <div class="form-group">
                         <label>Password</label>
                         <input type="password" class="form-control" name="password" required/>
                     </div>

                     <div class="form-group">
                         <label>Titulli</label>
                         <input type="text" class="form-control" name="titulli" required/>
                     </div>

                     <input type="hidden" class="form-control" name="role" value=2 />

                       <?php
                             $query = "SELECT  id_njesia_baze,em_njesia_baze FROM  njesia_baze ";
                             $result1 = mysqli_query($con, $query);

                             echo "<div class='form-group'>";
                             echo "<label>Departamenti</label>";
                             echo "<select class = 'form-control' name='njesia_baze'>";

                             while ($row = mysqli_fetch_assoc($result1)) {
                               //  unset($id, $name);
                                $id_njesia_baze = $row['id_njesia_baze'];
                                $em_njesia_baze = $row['em_njesia_baze'];
                                echo '<option value="'.$id_njesia_baze.'">'.$em_njesia_baze.'</option>';
                             }
                                 echo "</select>";
                                 echo "</div>";
                       ?>

                         <button type="submit" class="btn btn-default" name="submit" value="Submit">Submit </button>

                   </form>
               </div>


               <div role="tabpanel" class="tab-pane fade" id="grup">

                 <form method="post" action="shtogrup.php">

                     <div class="form-group">
                            <label>Emri Grupit</label>
                            <input type="name" class="form-control"  name="em_grupi" />
                     </div>

                     <div class="form-group">
                           <label>Cikli</label>
                           <input type="name" class="form-control" name="em_cikli" />
                     </div>

                     <?php
                           $query = "SELECT  id_viti_akademik,viti_akademik FROM viti_akademik";
                           $result = $con->query($query);

                           echo "<div class='form-group'>";
                           echo "<label>Viti Akademik</label>";
                           echo "<select class = 'form-control' name='viti_akademik'>";

                           while ($row = $result->fetch_assoc()) {
                              unset($id, $name);
                              $id_viti_akademik = $row['id_viti_akademik'];
                              $viti_akademik = $row['viti_akademik'];
                              echo '<option value="'.$id_viti_akademik.'">'.$viti_akademik.'</option>';
                           }
                               echo "</select>";
                               echo "</div>";
                     ?>

                     <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto </button>
                   </form>
               </div>

               <div role="tabpanel" class="tab-pane fade" id="lende">
                 <form method="post" action="shtoLende.php">

                     <div class="form-group">
                         <label>Emertimi Lendes</label>
                         <input type="text" class="form-control" name="em_lenda" required/>
                     </div>

                       <?php
                             $query = "SELECT  id_komisioni,pedagog1 FROM  komisioni ";
                             $result1 = mysqli_query($con, $query);

                             echo "<div class='form-group'>";
                             echo "<label>Kryetari Komisionit</label>";
                             echo "<select class = 'form-control' name='komisioni'>";

                             while ($row = mysqli_fetch_assoc($result1)) {
                                $id_komisioni = $row['id_komisioni'];
                                $pedagog1 = $row['pedagog1'];
                                echo '<option value="'.$id_komisioni.'">'.$pedagog1.'</option>';
                             }
                                 echo "</select>";
                                 echo "</div>";
                       ?>

                         <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto</button>

                   </form>
               </div>

               <div role="tabpanel" class="tab-pane fade" id="student">
                 <form method="post" action="shtoStudent.php">

                     <div class="form-group">
                         <label>Emri</label>
                         <input type="text" class="form-control" name="em_student" required/>
                     </div>

                     <div class="form-group">
                         <label>Email</label>
                         <input type="email" class="form-control" name="email" required/>
                     </div>
                     <div class="form-group">
                         <label>Datelindja</label>
                         <input type="date" class="form-control" name="datelindja" required/>
                     </div>

                       <?php
                             $query = "SELECT  id_grupi,em_grupi FROM  grupi ";
                             $result1 = mysqli_query($con, $query);

                             echo "<div class='form-group'>";
                             echo "<label>Grupi Mesimor</label>";
                             echo "<select class = 'form-control' name='grupi'>";

                             while ($row = mysqli_fetch_assoc($result1)) {
                                $id_grupi = $row['id_grupi'];
                                $em_grupi = $row['em_grupi'];
                                echo '<option value="'.$id_grupi.'">'.$em_grupi.'</option>';
                             }
                                 echo "</select>";
                                 echo "</div>";
                       ?>

                         <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto</button>

                   </form>
               </div>


            </div>

      </div>
    </div>

    <script type="text/javascript">
    $('#mytabs a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
    </script>


  </body>
</html>
