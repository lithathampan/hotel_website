<?php
function headersection($activepage)
{
   echo'<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>'.$activepage.' || Hotel Litha</title>

        <link rel="stylesheet" href="css/w3.css">
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/app.css" />  
        <link rel="stylesheet" href="css/foundation-icons.css" />
        <link rel="stylesheet" href="css/foundation-datepicker.css" />
        <script src="js/vendor/modernizr.js"></script>      
   </head>';
}
function topbar($activepage)
{
    echo '<nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php"><i class="fi-home large"></i> Hotel Litha</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right"> ';
        
            echo '<li class="has-dropdown"><a href="#">Admin</a>';
            echo '<ul class="dropdown">';
            echo '<li><label>Level One</label></li>';
            if (isset($_SESSION['login_user']) and $_SESSION['login_role'] === 'Admin'){
            echo '<li><a href="logout.php">Admin Logout</a></li>';
            echo '<li><a href="manageroomtype.php">Manage RoomType</a></li>';
            echo '<li><a href="managebooking.php">Manage Booking</a></li>';
          }
          else{            
            echo '<li><a href="login.php">Admin Login</a></li>';
          }
            echo '</ul>';
            echo '</li>';
         
        echo '<li class="divider"></li>';
      
            echo '<li'.($activepage == 'Amenities' ? ' class="active"' : '').'><a href="amenities.php">Amenities</a></li>';
            echo '<li'.($activepage == 'Attractions' ? ' class="active"' : '').'><a href="attractions.php">Local Attractions</a></li>';
            echo '<li'.($activepage == 'ShopDine' ? ' class="active"' : '').'><a href="shopdine.php">Shopping And Dining</a></li>';

       echo' </ul>
      </section>
    </nav>';
        }

function trailersection($activepage,$error,$successmessage )
{
    if($successmessage != ""){
    echo'
          <div class="row">
          <div class="small-4 columns">

          </div>
          <div class="small-8 columns">
          <div data-alert class="alert-box success radius">
          '.$successmessage.'
            <a href="#" class="close">&times;</a>
          </div>
          </div>

      </div>';
    }
    if($error != ""){
      echo'
      <div class="row">
          <div class="small-4 columns">

          </div>
          <div class="small-8 columns">
          <div data-alert class="alert-box alert round">
          '.$error.'
          <a href="#" class="close">&times;</a>
          </div>
          </div>

      </div>';
    }
      echo '
    <div class="row" style="margin-top:10px;">
        <div class="small-12">

            <footer>
            <p style="text-align:center; font-size:0.8em;">&copy; Hotel Litha. All Rights Reserved.</p>
            </footer>

        </div>
        </div>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/foundation-datepicker.js"></script>
        <script>
        $(document).foundation();
        </script>';
}
?>