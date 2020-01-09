<?php
    include("session.php");
    include("commonsections.php");
    $activepage = "Home";
    $error = "";
    $successmessage ="";
  function counterdropdown($startnumber,$endnumber){
    for($i=$startnumber;$i<=$endnumber;$i++){
      echo '<option value="'.$i.'">'.$i.'</option>';
    }
  }
  function validdate($test_date){
      $test_arr  = explode('-', $test_date);
      if (count($test_arr) == 3) {
          if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
              return true;
          } else {
            throw new Exception("Not valid dates. Use Date control");
          }
      } else {
        throw new Exception("Empty Date. Please fill dates");
      }
  }
  function verifydates($startdate, $enddate) {
  
    if(validdate($startdate) && validdate($enddate) && strtotime($enddate)>strtotime($startdate)){
      
    }
    else {
      throw new Exception("End Date should be greater than Start Date");
    }  
 }
  try{
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $numadult = $_POST['numadult'];
      $numchild = $_POST['numchild']; 
      $numrooms = $_POST['numrooms']; 
      $startdate = $_POST['startdate'];
      $enddate = $_POST['enddate']; 
      verifydates($startdate,$enddate);
      $_SESSION['numadult'] = $numadult;
      $_SESSION['numchild'] = $numchild;
      $_SESSION['numrooms'] = $numrooms;
      $_SESSION['startdate'] = $startdate;
      $_SESSION['enddate'] = $enddate;
      header("location: booking.php");
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
<div class="row" align="center">
          <div class="small-12 columns">
            <h2> Affordable Luxury at White Plains<h2>
          </div>
        </div>
<div class="row">
        <div class="small-12 columns">
            <img src="images/homeimage.jpg" alt="Hotel Litha" class="billboard" />
        </div>
</div>
<div class="row">
        <div class="small-6 columns"> 
        <div class="row">           
            <h5>Welcome</h5>
            <p>Keep your mind balanced, sharp and inspired at Hotel Litha. Your stay begins virtually the moment your plane lands, thanks to our complimentary shuttles to and from Westchester Airport. We also are at walkable distance to Beeline Bus Services and Metro North Train which gets you to New York City within 40 minutes.
            </p>
            <p>Additionally, our location on Lake Street provides prime access to many of the area's notable locales such as the Pace Univeristy at White Plains and multiple malls. If exploring the city isn't on your agenda, take a moment to unwind in our modern accommodations complete with pillowtop mattresses, flat-panel TVs and 24-hour room service. When hunger strikes, stop by one of our two on-site restaurants for expertly prepared Thai, American and Continental cuisine. If you're looking for a venue to host a business or social gathering, look no further than our 19 elegant event spaces featuring stylish designs, versatile AV equipment and high-speed Wi-Fi access to ensure your night is a success. Whatever the reason for your trip, Hotel Litha offers the professional service and refined amenities necessary for a successful stay. 
            </p>
        </div>
        <div class="row">           
            <h5>Contact Us</h5>
            <ul>
              <li>
                Phone : 914-914-9149
              </li>
              <li>
                email :  <a href="mailto:helpdesk@hotellitha.com">helpdesk@hotellitha.com</a> 
              </li>
            <ul>
        </div>
        </div>
        <div class="small-5 columns">   
  
          <form method="POST" action="" style="margin-top:30px;">
        <div class="row">
            <div class="small-6 columns">
              <label for="right-label" class="right inline">Adults</label>
            </div>
            <div class="small-6 columns">
            <select id="right-label" name='numadult'>
                <?php counterdropdown(1,8) ?>
            </select>
            </div>
        </div>
        <div class="row">
            <div class="small-6 columns">
              <label for="right-label" class="right inline">Children</label>
            </div>
            <div class="small-6 columns">
            <select id="right-label" name='numchild'>
                <?php counterdropdown(0,8) ?>
            </select>
            </div>
        </div>
        <div class="row">
            <div class="small-6 columns">
              <label for="right-label" class="right inline">Number of Rooms</label>
            </div>
            <div class="small-6 columns">
            <select id="right-label" name='numrooms'>
                <?php counterdropdown(1,10) ?>
            </select>
            </div>
        </div>
         <div class="row">
            <div class="small-6 columns">
              <label for="right-label" class="right inline">Check In</label>
            </div>
            <div class="small-6 columns">
            <input type="text" class="span2" placeholder ="YYYY-MM-DD" id="dpt1" name="startdate" required>
            </div>
        </div>
        <div class="row">
            <div class="small-6 columns">
              <label for="right-label" class="right inline">Check Out</label>
            </div>
            <div class="small-6 columns">
            <input type="text" class="span2" placeholder ="YYYY-MM-DD" id="dpt2" name="enddate" required> 
            </div>
        </div>
        <div class="row">
        <div class="small-6 columns">
           
            </div>
            <div class="small-6 columns">
            <input type="submit" name= "submit" value="Book" class="labelbutton">
              <input type="reset" value="Clear" class="labelbutton">
            </div>
        </div>
        </form>
        <div class="row">       
            <h5>Location</h5>
          <h6 class="left inline">1 Lake Street, </h6>
          <h6 class="left inline">White Plain, </h6>
          <h6 class="left inline">NY, USA</h6>
          <br>
          </div>
          <div class="row">       
          <h5>Directions</h5>
            <p>Taking I-287 E, take Exit-6 and turn right to N Broadway. For  I-287 W , take Exit 8 and take Westchester Ave towards Lake St. Take Main St towards East from Metro north station. Take Lake St directly from Westchester Airport
            </p>
            </div>
       </div>
    </div>

    <?php
        trailersection($activepage,$error,$successmessage );
        ?>
  </body>
</html>
<script>
$(function(){
                    var nowTemp = new Date();
                    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                    var checkin = $('#dpt1').fdatepicker({
                    startDate: now,
                    format: 'yyyy-mm-dd',
                    disableDblClickSelection: true,
                    language: 'vi',
                    pickTime: false,
                    leftArrow:'<<',
                    rightArrow:'>>',
                    closeIcon:'X',
                    closeButton: true
                });                  
var checkout = $('#dpt2').fdatepicker({
                    startDate: now,
                    format: 'yyyy-mm-dd',
                    disableDblClickSelection: true,
                    language: 'vi',
                    pickTime: false,
                    leftArrow:'<<',
                    rightArrow:'>>',
                    closeIcon:'X',
                    closeButton: true
                });

});
</script>