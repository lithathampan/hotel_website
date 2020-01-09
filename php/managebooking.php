<?php
    include("session.php");
    include("admincheck.php");
    include("commonsections.php");
    $activepage = "ManageBooking";
    $error = "";
    $successmessage ="";

    try{
      if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["action"])){
          $action = $_POST["action"];
          $bookingid = $_POST["bookingid"];
          if ($action == "Cancel"){
            $sql = "CALL `lithathampandatabase`.`sp_cancel_booking`($bookingid);";
            $result = $db->query($sql);           
            $result->execute();                      
            $result->closeCursor(); 
          }
        }
      }
    }
    catch(Exception $e)
    {
    $error = $e->getMessage();
    }
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
<div class="row" >
  <div class="small-8 columns" align="center">

  </div>

</div>
<div class="row">
        <div class="small-12 columns" align="center">

        <table style="table-layout: fixed;display: block;overflow:scroll;">
  <?php
  try{
    $sql = "CALL `lithathampandatabase`.`sp_get_bookings`(-1);";
    $result = $db->query($sql);
    echo"
    <thead><tr>
    <th>Booking ID</th>
    <th>Customer Name</th>
    <th>Check In</th>
    <th>Check Out</th>
    <th>Room Type Name</th>
    <th>Action</th>
    </tr></thead><tbody>";
    if($result){
        while($obj = $result->fetch(PDO::FETCH_OBJ)) {
            echo '<tr><form action="" method="post">';
            echo "<td>". $obj->bookingid."</td>";
            echo "<td>". $obj->customername."</td>";
            echo "<td>". $obj->startdate."</td>";
            echo "<td>". $obj->enddate."</td>";
            echo "<td>". $obj->roomtypename."</td>";
            echo "<td><input type='hidden' name='bookingid' value='".$obj->bookingid."' />";
            echo '<input type="submit" name="action" value="Cancel" class="labelbutton" /></td>';
            echo"</form></tr>";
        }
    }    
    echo "</tbody></table>";
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
