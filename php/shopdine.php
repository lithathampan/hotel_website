<?php
    include("session.php");
    include("commonsections.php");
    $activepage = "ShopDine";
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
            <h2> Shopping and Dining <h2>
          </div>
        </div>
<div class="row">
        <div class="small-12 columns" align="center">

            <img src="images/indoordining.jpg" alt="Hotel Dining" title="Hotel Dining" class="mySlides" />
            <img src="images/angelswithbagpipe.jpg" alt="Angels with Bagpipe" title="Angels with Bagpipe" class="mySlides" />
            <img src="images/lakerush.jpg" alt="Lake Rush" title="Lake Rush" class="mySlides" />
            <img src="images/galleria.jpg"  alt="Galleria Mall" title="Galleria Mall White Plains" class="mySlides" />
            <img src="images/thewestchester.jpg" alt="The Westchester Mall	" title="The Westchester Mall	" class="mySlides" />
            <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
        </div>
</div>
<div class="row">
        <div class="small-6 columns">          
            <h5>Dining</h5>
            <ul>	
              <li>  		
                Hotel Dining				 
              </li>	  
              <li>  		
                Angels with Bagpipe (Italian Restaurant)				 
              </li>
			      	<li>  		
                 Lake Rush (On the Lake Restauant)				 
              </li>		  
            </ul>
        </div>
        <div class="small-6 columns">          
            <h5>Shopping</h5>
            <ul>	 
              <li>  		
                Galleria Mall White Plains			 
              </li>
			      	<li>  		
                 The Westchester Mall			 
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