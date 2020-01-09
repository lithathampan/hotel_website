<?php
    include("session.php");
    include("commonsections.php");
    $activepage = "Booking";
    $error = "";
    $successmessage ="";
?>
<!doctype html>
<html class="no-js" lang="en">
  
  <?php
        headersection($activepage );
    ?>
  <body >

    <?php
        topbar($activepage );
    ?>

<div class="row">
          <div class="small-12 columns">
      <table style="table-layout: fixed;overflow:scroll;">
        <?php
        try{
          $numadult = $_SESSION['numadult'];
          $numchild = $_SESSION['numchild'];
          $numrooms = $_SESSION['numrooms'];
          $startdate = $_SESSION['startdate'];
          $enddate = $_SESSION['enddate'];
          $sql = "CALL `lithathampandatabase`.`sp_get_roomdetails`($numrooms,'$startdate','$enddate',-1);";
          $result = $db->query($sql);
          if($result){
            $i =0;
            while($obj = $result->fetch(PDO::FETCH_OBJ)) {
              if($i%2 == 0){
                echo "<tr>";
              }
              echo '<td>';
              echo '<p><h3>'.$obj->roomtypename.'</h3></p>';
              echo '<img src="images/'.$obj->roomimage.'"/>';
              echo '<p><strong>Features</strong>: '.$obj->features.'</p>';
              echo '<p><strong>Price (Per Night)</strong>: '.$obj->listprice.'</p>';
              echo '<p><strong>Units Available</strong>: '.$obj->availablerooms.'</p>';
              echo '<p><strong>Total Price</strong>: '.$currency.$obj->totalprice.'</p>';
              if($obj->availablerooms > 0){
                echo '<p><a href="confirmation.php?roomtypeid='.$obj->roomtypeid.'"><input type="submit" value="Select" class="labelbutton" /></a></p>';
              }
              else {
                echo '<p>Room Unavailable!</p>';
              }
              if($i%2 == 1) {
                echo "</tr>"; 
              }
              $i++;
            }

          }

          echo '</table>';
        }
        catch(Exception $e)
        {
        $error = $e->getMessage();
        }
      ?>
     <?php
        trailersection($activepage,$error,$successmessage );
     ?>
  </body>
</html>
