<?php
    include("session.php");
    include("commonsections.php");
    $activepage = "Amenities";
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
<div class="row" align="center">
          <div class="small-12 columns">
            <h2> Amenities and Services<h2>
          </div>
        </div>
<div class="row" align="center">
        <div class="small-12 columns">
            <img src="images/laundry.jpg" alt="Laundry" title="Laundry Room" class="mySlides" />
            <img src="images/pool.jpg" alt="Pool" title="Swimming Pool" class="mySlides" />
            <img src="images/fitness.jpg" alt="Fitness" title="Fitness Center" class="mySlides" />
            <img src="images/lounge.jpg" alt="Lounge" title="VIP Lounge" class="mySlides" />
            <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
        </div>
</div>
<div class="row">
        <div class="small-6 columns">          
            <h5>Amenities and Services</h5>
            <ul>			  
				<li>  		
				  			Automated Teller (ATM)				 
                  </li>
                  <li>  		
				  			Swimming Pool				 
                  </li>
                  <li>  		
				  			Laundry Room				 
                   </li>
                   <li>  		
				  			Fitness Center			 
			  	</li>
                <li>  		
				  			Valet Parking				 
			  	</li>
                  <li>  		
				  			VIP Lounge
                </li>
            </ul>
        </div>
       
    </div>
    
    <?php
        trailersection($activepage,$error,$successmessage );
        ?>
  </body>
</html>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  x[slideIndex-1].style.display = "block"; 
}
</script>