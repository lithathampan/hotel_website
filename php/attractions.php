<?php
    include("session.php");
    include("commonsections.php");
    $activepage = "Attractions";
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
            <h2> Local Attractions <h2>
          </div>
        </div>
<div class="row">
        <div class="small-12 columns" align="center">

            <img src="images/battleofwhiteplains.jpg"  alt="Battle of White Plains" title="Battle of White Plains Memorial" class="mySlides" />
            <img src="images/ww1memorial.jpg" alt="World War 1 Memorial" title="World War 1 Memorial (Tibbets Park)" class="mySlides" />
            <img src="images/turnurepark.jpg" alt="Turnure Park" title="Turnure Park" class="mySlides" />
            <img src="images/kensicodam.jpg" alt="Kensico Dam" title="Kensico Dam" class="mySlides" />
            <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
        </div>
</div>
<div class="row">
        <div class="small-6 columns">          
            <h5>Nearby Attractions</h5>
            <ul>		  

              <li>  		
                Battle of White Plains Memorial				 
              </li>
			      	<li>  		
                 World War 1 Memorial (Tibbets Park)				 
              </li>		  
			      	<li>  		
				  			Turnure Park				 
              </li>
              <li>  		
				  			Kensico Dam				 
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