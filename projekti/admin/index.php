<?php
session_start();
include "../connect.php";
if(isset($_SESSION['id']) == ""){
  header("Location: ../index.php");
}
/*$query = "SELECT * FROM Pedagogu";
$result = mysqli_query($query);
while($row == mysqli_fetch_assoc($result)){
  $id = $row['id'];
  $name = $row[''];

}*/

 ?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
      <link rel="stylesheet" href="../projekti.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta charset="utf-8">
    <title>Flete Provimi</title>
  </head>

  <body>
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="">Flete Provimi</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav navbar-right nav-menu">
                <!-- <li><a href="../index.php">Login</a></li> -->
                <li><a href="../index.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>

    <div class = "container">
      <div class="row">
          <h1>Admin</h1><br/><br/>


            <ul id="mytabs" class="nav nav-pills col-md-2 " >

              <li role="presentation" class="active"><a href="#pedagog" aria-controls="pedagog" role="tab" data-toggle="tab" >Shto Pedagog</a></li>
              <li role="presentation"><a href="#sekretar" aria-controls="sekretar" role="tab" data-toggle="tab" >Shto Sekretar</a></li>
              <li role="presentation"><a href="#komision" aria-controls="komision" role="tab" data-toggle="tab" >Shto Komision</a></li>
              <li role="presentation"><a href="#grup" aria-controls="grup" role="tab" data-toggle="tab">Shto Grup</a></li>

            </ul>

            <div class="tab-content col-md-4">
               <div role="tabpanel" class="tab-pane fade in active" id="pedagog">
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

                         <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto </button>

                   </form>
               </div>

               <div role="tabpanel" class="tab-pane fade" id="sekretar">

                 <form method="post" action="shtosekretari.php">

                     <div class="form-group">
                         <label for="exampleInputEmail1">E-mail</label>
                         <input type="email" class="form-control" id="exampleInputEmail1" name="email" required/>
                     </div>

                     <div class="form-group">
                         <label>Password</label>
                         <input type="password" class="form-control" name="password" required/>
                     </div>

                     <input type="hidden" class="form-control" name="role" value=1 />


                    <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto </button>
                 </form>
               </div>

               <div role="tabpanel" class="tab-pane fade" id="komision">

                 <form method="post" action="shtokomision.php">

                   <div class="form-inline">
                         <label>Pedagog 1

                           <?php
                             $query = "SELECT  id_pedagogu,em_pedagogu FROM  pedagogu  ";
                             $result = $con->query($query);

                             echo "<select class = 'form-control' name='pedagog1'>";
                             while ($row = $result->fetch_assoc()) {

                               unset($id, $name);
                               $id_pedagogu1 = $row['id_pedagogu'];
                               $em_pedagogu1 = $row['em_pedagogu'];
                               echo '<option value="'.$id_pedagogu1.'">'.$em_pedagogu1.'</option>';

                             }
                             echo "</select>";
                           ?>
                         </label>
                   </div>
                   <div class="form-inline">
                       <label>Pozicion 1
                         <?php

                         $query2 = "SELECT  id_pozicioni,lloji_pozicionit FROM  pozicioni  ";
                         $result = $con->query($query2);

                           echo "<select  class = 'form-control' name='pozicion1'>";
                           while ($row = $result->fetch_assoc()) {

                             unset($id, $name);
                             $id_pozicioni1 = $row['id_pozicioni'];
                             $lloji_pozicionit1 = $row['lloji_pozicionit'];
                             echo '<option value="'.$id_pozicioni1.'">'.$lloji_pozicionit1.'</option>';

                           }
                           echo "</select>";

                         ?>
                       </label>
                   </div>
                   <div class="form-inline">
                       <label>Pedagog 2
                         <?php

                           $query = "SELECT  id_pedagogu,em_pedagogu FROM  pedagogu  ";
                           $result = $con->query($query);

                           echo "<select class = 'form-control' name='pedagog2'>";
                           while ($row = $result->fetch_assoc()) {

                             unset($id, $name);
                             $id_pedagogu2 = $row['id_pedagogu'];
                             $em_pedagogu2 = $row['em_pedagogu'];
                             echo '<option value="'.$id_pedagogu2.'">'.$em_pedagogu2.'</option>';

                           }
                           echo "</select>";

                         ?>
                       </label>
                   </div>

                   <div class="form-inline">
                         <label>Pozicion 2
                           <?php


                           $query2 = "SELECT  id_pozicioni,lloji_pozicionit FROM  pozicioni  ";
                             $result = $con->query($query2);

                             echo "<select class = 'form-control' name='pozicion2'>";
                             while ($row = $result->fetch_assoc()) {

                               unset($id, $name);
                               $id_pozicioni2 = $row['id_pozicioni'];
                               $lloji_pozicionit2 = $row['lloji_pozicionit'];
                               echo '<option value="'.$id_pozicioni2.'">'.$lloji_pozicionit2.'</option>';

                             }
                             echo "</select>";
                           ?>
                         </label>
                 </div>

                 <div class="form-inline">
                       <label>Pedagog 3
                       <?php

                         $query = "SELECT  id_pedagogu,em_pedagogu FROM  pedagogu  ";
                           $result = $con->query($query);

                           echo "<select class = 'form-control' name='pedagog3'>";
                           while ($row = $result->fetch_assoc()) {

                             unset($id, $name);
                             $id_pedagogu3 = $row['id_pedagogu'];
                             $em_pedagogu3 = $row['em_pedagogu'];
                             echo '<option value="'.$id_pedagogu3.'">'.$em_pedagogu3.'</option>';

                           }
                           echo "</select>";
                       ?>
                       </label>

                 </div>

                 <div class="form-inline">
                     <label>Pozicion 3
                       <?php


                       $query2 = "SELECT  id_pozicioni,lloji_pozicionit FROM  pozicioni  ";
                         $result = $con->query($query2);

                         echo "<select class = 'form-control' name='pozicion3'>";
                         while ($row = $result->fetch_assoc()) {

                           unset($id, $name);
                           $id_pozicioni3 = $row['id_pozicioni'];
                           $lloji_pozicionit3 = $row['lloji_pozicionit'];
                           echo '<option value="'.$id_pozicioni3.'">'.$lloji_pozicionit3.'</option>';

                         }
                         echo "</select>";
                       ?>
                     </label>
                 </div>

                 <div class="form-inline">
                   <label><button type="submit" class="btn btn-default" name="submit" value="Submit">Shto</button></label>
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

                     <button type="submit" class="btn btn-default" name="submit" value="Submit">Shto </button>
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
