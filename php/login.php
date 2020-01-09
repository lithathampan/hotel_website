<?php
    include("session.php");
    include("commonsections.php");
    $activepage = "Login";
    $error = "";
    $successmessage ="";
    function verifyentry($string) {
        // function to verify only alphanumeric , _ and @ characters are allowed in username and password
        if(preg_match('/[^a-zA-Z_\-0-9\@]/i', $string)) 
        {
            throw new Exception("Invalid characters in input");
        }
    }
  try{
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = $_POST['username'];
        $mypassword = $_POST['password']; 
        verifyentry($myusername);
        verifyentry($mypassword);
        $md5password = md5($mypassword);
        if ($md5password == "59a2f7614d25280af0af0b2d9eb92871" && $myusername == "lithathampan" ) {
            $_SESSION['login_role'] = 'Admin';
            $_SESSION['login_user'] = $myusername;
            header("location: index.php");
        }
        else {
            throw new Exception("Invalid credentials");
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
    <form method="POST" action="" style="margin-top:30px;">
        <div class="row">
            <div class="small-8">

                <div class="row">
                    <div class="small-4 columns">
                    <label for="right-label" class="right inline">Username</label>
                    </div>
                    <div class="small-8 columns">
                    <input type="text" id="right-label" placeholder="myusername" name="username">
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 columns">
                    <label for="right-label" class="right inline">Password</label>
                    </div>
                    <div class="small-8 columns">
                    <input type="password" id="right-label" name="password">
                    </div>
                </div>

                <div class="row">
                    <div class="small-4 columns">
                    </div>
                    <div class="small-8 columns">
                    <input type="submit" id="right-label" value="Login" class="labelbutton" >
                    <input type="reset" id="right-label" value="Reset" class="labelbutton">
                </div>
             
        </div>
        </form>
    <?php
        trailersection($activepage,$error,$successmessage );
        ?>
  </body>
</html>