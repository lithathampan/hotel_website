<?php
   //if user is not admin , redirect to home page
   if(isset($_SESSION['login_user'])=== FALSE || $_SESSION['login_role'] !== 'Admin'){
      header("location: login.php");
   }
?>