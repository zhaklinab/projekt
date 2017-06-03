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
                <li><a href="index.php" style="color:white;">  <?php echo $row['username']; ?></a></li>
                <li><a href="../logout.php" style="color:white;">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>

    <div class = "container">
      <div class="row">
            <ul id="mytabs" class="nav nav-pills nav-stacked col-md-2 " >
              <li role="presentation" class="active"><a href="#ial" aria-controls="ial" role="tab" data-toggle="tab" >Institucione (IAL)</a></li>
              <li role="presentation"><a href="#njesi_kryesore" aria-controls="njesi_kryesore" role="tab" data-toggle="tab" >Njesi Kryesore</a></li>
              <li role="presentation"><a href="#njesia_baze" aria-controls="njesia_baze" role="tab" data-toggle="tab" >Njesi Baze</a></li>
              <li role="presentation"><a href="#pedagog" aria-controls="pedagog" role="tab" data-toggle="tab">Menaxho   Pedagog</a></li>
              <li role="presentation"><a href="#grup" aria-controls="grup" role="tab" data-toggle="tab">Grup Mesimor</a></li>
              <li role="presentation"><a href="#komision" aria-controls="komision" role="tab" data-toggle="tab">Komision</a></li>
              <li role="presentation"><a href="#lende" aria-controls="lende" role="tab" data-toggle="tab">Menaxho Lende </a></li>
              <li role="presentation"><a href="#student" aria-controls="student" role="tab" data-toggle="tab">Menaxho Student</a></li>
            </ul>
            <div class="col-md-2"></div>
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
                    </div><br/>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto </button>
                    </div>
                    <div class="col-md-6">
                      <a href="shfaqial.php" class="btn btn-block btn-primary"> Shfaq te dhena</a><br/><br/>
                    </div>
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
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto </button>
                    </div>
                    <div class="col-md-6">
                      <a href="shfaq_njesi_kryesore.php" class="btn btn-block btn-primary"> Shfaq te dhena</a><br/><br/>
                    </div>

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
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto </button>
                    </div>
                    <div class="col-md-6">
                      <a href="shfaq_njesi_baze.php" class="btn btn-block btn-primary"> Shfaq te dhena</a><br/><br/>
                    </div>
                </form>
                </div>
               <div role="tabpanel" class="tab-pane fade" id="pedagog">
                 <form method="post" action="shtopedagog.php">
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
                                $id_njesia_baze = $row['id_njesia_baze'];
                                $em_njesia_baze = $row['em_njesia_baze'];
                                echo '<option value="'.$id_njesia_baze.'">'.$em_njesia_baze.'</option>';
                             }
                                 echo "</select>";
                                 echo "</div>";
                       ?>
                       <div class="col-md-6">
                         <button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto </button>
                       </div>
                       <div class="col-md-6">
                         <a href="shfaq_pedagog.php" class="btn btn-block btn-primary"> Shfaq te dhena</a><br/><br/>
                       </div>
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
                     <div class="col-md-6">
                       <button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto </button>
                     </div>
                     <div class="col-md-6">
                       <a href="shfaq_grup.php" class="btn btn-block btn-primary"> Shfaq te dhena</a><br/><br/>
                     </div>
                   </form>
               </div>

               <div role="tabpanel" class="tab-pane fade" id="komision">
                   <form method="post" action="shtokomision.php">
                     <div class="form-inline">
                       <label> Emertimi: &nbsp
                         <input style="width:107%;" type="text" name="Komision" class="form-control" />
                       </label><br><br>
                     </div>
                     <div class="form-inline">
                           <label>Kryetari: &nbsp
                             <?php
                               $query = "SELECT  id_pedagogu,em_pedagogu FROM  pedagogu  ";
                               $result = $con->query($query);
                               echo "<select  id='pedagog1' class='form-control' name='pedagog1'>";
                               while ($row = $result->fetch_assoc()) {
                                 $id_pedagogu1 = $row['id_pedagogu'];
                                 $em_pedagogu1 = $row['em_pedagogu'];
                                 echo '<option value="'.$id_pedagogu1.'">'.$em_pedagogu1.'</option>';
                               }
                               echo "</select>";
                             ?>
                           </label><br><br>
                     </div>
                     <div class="form-inline">
                         <label>Anetar 1: &nbsp
                           <?php
                             $query = "SELECT  id_pedagogu, em_pedagogu FROM  pedagogu  ";
                             $result = $con->query($query);
                             echo "<select id='pedagog2' class='form-control' name='pedagog2'>";
                             while ($row = $result->fetch_assoc()){
                               $id_pedagogu2 = $row['id_pedagogu'];
                               $em_pedagogu2 = $row['em_pedagogu'];
                               echo '<option value="'.$id_pedagogu2.'">'.$em_pedagogu2.'</option>';
                             }
                             echo "</select>";
                           ?>
                         </label>
                     </div><br><br>
                     <div class="form-inline">
                         <label>Anetar 2: &nbsp
                         <?php
                           $query = "SELECT  id_pedagogu,em_pedagogu FROM  pedagogu  ";
                             $result = $con->query($query);
                             echo "<select id='pedagog3' class='form-control' name='pedagog3'>";
                             while ($row = $result->fetch_assoc()) {
                               unset($id, $name);
                               $id_pedagogu3 = $row['id_pedagogu'];
                               $em_pedagogu3 = $row['em_pedagogu'];
                               echo '<option value="'.$id_pedagogu3.'">'.$em_pedagogu3.'</option>';
                             }
                             echo "</select>";
                         ?>
                       </label><br><br>
                   </div>
                   <div class="col-md-12">
                     <label><button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto</button></label>
                   </div>

                   </form>
                 </div>
               <div role="tabpanel" class="tab-pane fade" id="lende">
                 <form method="post" action="shtoLende.php">
                     <div class="form-group">
                         <label>Emertimi Lendes</label>
                         <input type="text" class="form-control" name="em_lenda" required/>
                     </div>
                     <div class="form-group">
                         <label>Nr. Leksioneve</label>
                         <input type="text" class="form-control" name="nr_leksione" required/>
                     </div>
                     <div class="form-group">
                         <label>Nr. Seminareve</label>
                         <input type="text" class="form-control" name="nr_seminare" required/>
                     </div>
                     <div class="form-group">
                         <label>Nr. Laboratoreve</label>
                         <input type="text" class="form-control" name="nr_laboratore" required/>
                     </div>
                     <div class="form-group">
                         <label>Nr. Projekteve</label>
                         <input type="text" class="form-control" name="nr_projekte" required/>
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
                       <div class="col-md-6">
                         <button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto </button>
                       </div>
                       <div class="col-md-6">
                         <a href="shfaq_lende.php" class="btn btn-block btn-primary"> Shfaq te dhena</a><br/><br/>
                       </div>
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
                         <label>Password</label>
                         <input type="password" class="form-control" name="password" required/>
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
                       <div class="col-md-6">
                         <button type="submit" class="btn btn-block btn-primary" name="submit" value="Submit">Shto </button>
                       </div>
                       <div class="col-md-6">
                         <a href="shfaq_student.php" class="btn btn-block btn-primary"> Shfaq te dhena</a><br/><br/>
                       </div>
                   </form>
               </div>
            </div>
      </div>
    </div>
  </body>
</html>
<?php } ?>
