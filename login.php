<?php

function sanitize($whatever) { $whatever = mysql_real_escape_string( $whatever ); return $whatever; }

if (!isset($_SESSION)) { session_start(); }

if ( isset($_POST['submit']) && isset($_POST['Uname']) && $_POST['Uname'] != "" 
  && isset($_POST['Pword']) && $_POST['Pword'] != "")
  { 
   $username = sanitize($username);
   $username = $_POST['Uname'];
   $_SESSION['UnkUname'] = $username;

   $password = sanitize($_POST['Pword']);
   $password = $_POST['Pword'];
   $pwdmd5 = md5($password);
   $_SESSION['UnkPword'] = $pwdmd5;

   header("Location: admin.php"); 
  } 

else {


if (isset($_SESSION['errormsg']) && $_SESSION['errormsg'] != "")
  { 
   echo $_SESSION['errormsg'];
   $_SESSION['errormsg'] = "";
  }


?>

<h1>Please enter credentials (cookies must be enabled):</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Username: <input type="text" name="Uname" size="20"> <br>
Password: <input type="password" name="Pword" size="20"> <br>
<input type="submit" name="submit" value="Next"> </form>
</form> <!-- End of form -->

<?php
}
