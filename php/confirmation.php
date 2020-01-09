<?php
    include("session.php");
    include("commonsections.php");
    $activepage = "Confirmation";
    $error = "";
    $successmessage ="";
    function verifyemail($string) {
      // function to verify only alphanumeric , _ and @ characters are allowed in username and password
      if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
          throw new Exception("Invalid Email Address Provided");
      }
  }
  try{
    $custinfostyle=''; 
    $printbuttonstyle = 'style="display:none;"';
    $numadult = $_SESSION['numadult'];
    $numchild = $_SESSION['numchild'];
    $numrooms = $_SESSION['numrooms'];
    $startdate = $_SESSION['startdate'];
    $enddate = $_SESSION['enddate'];
    $roomtypeid= $_GET['roomtypeid'];
    $sql = "CALL `lithathampandatabase`.`sp_get_roomdetails`($numrooms,'$startdate','$enddate',$roomtypeid);";
    $result = $db->query($sql); 
    $obj = $result->fetch(PDO::FETCH_OBJ) ;
    $roomtypename = $obj->roomtypename;
    $totalprice = $obj->totalprice;
    $result->closeCursor();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $fname = $_POST['fname']; 
      $lname = $_POST['lname']; 
      $street = $_POST['street']; 
      $aptno = $_POST['aptno']; 
      $city = $_POST['city']; 
      $state = $_POST['state']; 
      $zip = $_POST['zip']; 
      $phone = $_POST['phone'];
      $custemail = $_POST['custemail']; 
      $comments = $_POST['comments']; 
      verifyemail($custemail);
      $name = $fname.' '.$lname;
      $address = $street.','.($aptno == '' ? '' : 'Apt:'.$aptno.',').$city.','.$state.','.$zip;
      $sql = "CALL `lithathampandatabase`.`sp_book_room`($roomtypeid,$numrooms,'$startdate','$enddate','$comments', $numadult,$numchild,'$name','$address','$phone','$custemail');";
          $result = $db->query($sql); 
          $row =  $result->fetch(PDO::FETCH_OBJ);
          $successmessage = "Thank you for the business. Your Booking ID is :".$row->v_bookingid;
          $custinfostyle = 'style="display:none;"';
          $printbuttonstyle = '';    
             
          $result->closeCursor(); 
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
<div class="row" align="center">
    <div class="small-12 columns">
    <h3> Room Information</h3>
    <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Adults : </label>
            </div>
            <div class="small-8 columns">
              <label for="right-label" class="right inline"><?php echo $numadult?></label>
            </div>
    </div>
    <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Children : </label>
            </div>
            <div class="small-8 columns">
              <label for="right-label" class="right inline"><?php echo $numchild?></label>
            </div>
    </div>
    <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Number Of Rooms : </label>
            </div>
            <div class="small-8 columns">
              <label for="right-label" class="right inline"><?php echo $numrooms?></label>
            </div>
    </div>
    <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Check In : </label>
            </div>
            <div class="small-8 columns">
              <label for="right-label" class="right inline"><?php echo $startdate?></label>
            </div>
    </div>
    <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Check Out : </label>
            </div>
            <div class="small-8 columns">
              <label for="right-label" class="right inline"><?php echo $enddate?></label>
            </div>
    </div>
    <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Type of Room: </label>
            </div>
            <div class="small-8 columns">
              <label for="right-label" class="right inline"><?php echo $roomtypename?></label>
              
            </div>
    </div>
    <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Total Price: </label>
            </div>
            <div class="small-8 columns">
              <label for="right-label" class="right inline"><?php echo $totalprice?></label>
              
            </div>
    </div>
    </div>
</div>
<div class="row" align="center" <?php echo $printbuttonstyle ?>>
<button class="labelbutton" onclick="printFunction()">Print this page</button>
</div>
<div class="row" align="center" <?php echo $custinfostyle?>>
    <div class="small-12 columns">
    <h3> Customer Information</h3>
    <form method="POST" action="" style="margin-top:30px;">
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">First Name</label>
            </div>
            <div class="small-8 columns">
            <input type="text" id="right-label" placeholder="YourFirstName" name="fname" value ="<?php if($error <> ""){ echo $_POST['fname'];}?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Last Name</label>
            </div>
            <div class="small-8 columns">
            <input type="text" id="right-label" placeholder="YourLastName" name="lname" value ="<?php if($error <> ""){ echo $_POST['lname'];}?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Street Address</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="Street Address" name="street" value ="<?php if($error <> ""){ echo $_POST['street'];}?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Apt No</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="right-label" placeholder="Apt No (Optional)" name="aptno" value ="<?php if($error <> ""){ echo $_POST['aptno'];}?>" >
            </div>
          </div>
           <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">City</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="City" name="city" value ="<?php if($error <> ""){ echo $_POST['city'];}?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">State</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="State" name="state" value ="<?php if($error <> ""){ echo $_POST['state'];}?>" required> 
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Zip Code</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="Zip Code" name="zip" title="Five digit zip code" pattern="[0-9]{5}" value ="<?php if($error <> ""){ echo $_POST['zip'];}?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Contact Number</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="888-888-8888" name="phone" title="888-888-8888" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value ="<?php if($error <> ""){ echo $_POST['phone'];}?>" required>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">E-Mail</label>
            </div>
            <div class="small-8 columns">
              <input type="email" id="right-label" placeholder="youremail@domain.com" name="custemail" value ="<?php if($error <> ""){ echo $_POST['custemail'];}?>">
            </div>
          </div>
          <div class="row">
          <div class="small-4 columns">
              <label for="right-label" class="right inline">Additional Comments</label>
            </div>
            <div class="small-8 columns">
               <textarea name="comments" maxlength=1000 placeholder="Enter any additional comments"></textarea>
            </div>
           
          </div>
          <div class="row">
            <div class="small-4 columns">
           
            </div>
            <div class="small-8 columns">
            <input type="submit" name= "submit" value="Confirm Booking" class="labelbutton">
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
<script>
function printFunction() {
  window.print();
}
</script>