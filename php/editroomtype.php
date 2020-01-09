<?php
    include("session.php");
    include("admincheck.php");
    include("commonsections.php");
    $activepage = "EditRoomType";
    $error = "";
    $successmessage ="";
   
  try{    
    $roomtypeid= $_GET['roomtypeid'];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $roomtypename = $_POST['roomtypename']; 
      $roomcount = $_POST['roomcount']; 
      $listprice = $_POST['listprice']; 
      $features = $_POST['features']; 
      $roomimage = $_POST['roomimage']; 
      $sql = "CALL `lithathampandatabase`.`sp_set_roomtype`($roomtypeid,$listprice,'$features','$roomtypename',$roomcount,'$roomimage');";
      $result = $db->query($sql); 
      $result->execute();                    
      $result->closeCursor(); 
      $successmessage = "Record Updated Successfully.Redirecting..";
      header( "Refresh:1; manageroomtype.php"); 
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
    <?php
    try{
        $sql = "CALL `lithathampandatabase`.`sp_get_roomtypes`($roomtypeid);";
        $result = $db->query($sql);
        $obj = $result->fetch(PDO::FETCH_OBJ);        
        $result->closeCursor();
    }
    catch(Exception $e)
    {
        $error = $e->getMessage();
    }
    ?>
<div class="row" align="center">
    <div class="small-12 columns">
    <h3> Room Type Information</h3>
    <form method="POST" action="" style="margin-top:30px;">
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Room Type Name</label>
            </div>
            <div class="small-8 columns">
            <input type="text" id="right-label" name="roomtypename" value ="<?php echo $obj->roomtypename ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Room Count</label>
            </div>
            <div class="small-8 columns">
            <input type="number" id="right-label" name="roomcount" value ="<?php echo $obj->roomcount ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">List Price</label>
            </div>
            <div class="small-8 columns">
            <input type="number" step=0.01 id="right-label" name="listprice" value ="<?php echo $obj->listprice ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Features</label>
            </div>
            <div class="small-8 columns">
            <input type="text" id="right-label" name="features" value ="<?php echo $obj->features ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Image File</label>
            </div>
            <div class="small-8 columns">
            <input type="text" id="right-label" name="roomimage" value ="<?php echo $obj->roomimage ?>" required>
            </div>
          </div>
           
          <div class="row">
            <div class="small-4 columns">
           
            </div>
            <div class="small-8 columns">
            <input type="submit" name= "submit" value="Update" class="labelbutton">
            </div>
        </div>
      </form>
    </div>
</div>
        
     <?php
        trailersection($activepage,$error,$successmessage );
        ?>
  </body>
</html>
