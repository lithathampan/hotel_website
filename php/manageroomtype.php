<?php
    include("session.php");
    include("admincheck.php");
    include("commonsections.php");
    $activepage = "ManageRoomType";
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
<div class="row" >
  <div class="small-8 columns" align="center">

  </div>

</div>
<div class="row">
        <div class="small-12 columns" align="center">

        <table style="table-layout: fixed;display: block;overflow:scroll;">
    <?php
    try{
      $sql = "CALL `lithathampandatabase`.`sp_get_roomtypes`(-1);";
      $result = $db->query($sql);
      echo"
      <thead><tr>
      <th>RoomType Name</th>
      <th>List Price</th>
      <th>Features</th>
      <th>Room Count</th>
      <th>Room Image</th>
      <th>Action</th>
      </tr></thead><tbody>";
      if($result){
          while($obj = $result->fetch(PDO::FETCH_OBJ)) {
              echo '<tr>';
              echo "<td>". $obj->roomtypename."</td>";
              echo "<td>". $obj->listprice."</td>";
              echo "<td>". $obj->features."</td>";
              echo "<td>". $obj->roomcount."</td>";
              echo "<td>". $obj->roomimage."</td>";
              echo "<td><input type='hidden' name='roomtypeid' value='".$obj->roomtypeid."' />";
              echo '<a href="editroomtype.php?roomtypeid='.$obj->roomtypeid.'"><input type="submit" value="Edit" class="labelbutton" /></a></td>';
              echo"</tr>";
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
