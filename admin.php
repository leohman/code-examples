<?php

if (!isset($_SESSION)) { session_start(); }

if (!isset($_SESSION['UnkUname']))
  { // Login form not submitted
   $_SESSION['errormsg'] = "You are not logged in, please log in first!";
   header("Location: login.php");
   return; 
  }

if (!isset($_SESSION['loggedin'])) 
  { // Check connection first and handle error
   $con=mysqli_connect("localhost", "admusr","admpwd","test");
   if (mysqli_connect_error())
     {
      // $_SESSION['errormsg'] = "Connection failed: ".mysqli_connect_error(); 
      $_SESSION['errormsg']="We seem to have a problem on our side, please try again later";
      header("Location: login.php"); 
     }
else {
   $qry = "SELECT username, password, usercontent FROM test.J5LI where ";
   $qry .= "username = '". $_SESSION['UnkUname']."' and password = '". $_SESSION['UnkPword']."'";
   $result = mysqli_query($con,$qry);

   if (!$result || mysqli_num_rows($result) <= 0)
     {
      $_SESSION['errormsg']="No match";
      header("Location: login.php"); 
     }
   else 
     {
      $_SESSION['errormsg']="";
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC) or die("We had a problem with the lookup.");
      $_SESSION['username'] = $row['username'];
      $_SESSION['usercontent'] = $row['usercontent'];
      $_SESSION['loggedin'] = true;
     }
  mysqli_close($con);
 } // end of if no error
}  // end of if not logged in

echo "<h1>Welcome, ". $_SESSION['username'] ."</h1>";

echo "Your usercontent is: ".$_SESSION['usercontent'].", ".$_SESSION['username'];
