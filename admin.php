<?php

// Potentially tainted input, cannot use without any form of sanitation, simply assigning it to a variable not enough:
//$username = $_POST['username'];

//Before doing anything else, we must check that a session was started or else start it now:
if (!isset($_SESSION)) { session_start(); }
// Now that we know session was started, we can move on:

// Replace line below with the line after, since syntax not correct:
// if(!isset($_SESSION['session']["logged_in"])) { 
if (!isset($_SESSION['loggedin'])) {

// we first need to give him a chance to use his credentials, if submitted, so cannot send him back to login just yet...
// We need to: a) check that login form submitted, 

if (!isset($_SESSION['UnkUname']))
  { // Login form not submitted
   $_SESSION['errormsg'] = "You are not logged in, please log in first!";
   header("Location: login.php");
   return; 
  }
else { // login form was submitted, need to check the credentials in it
// b) connect to database, and verify that we were successful
   $con=mysqli_connect("localhost", "admusr","admpwd","Somedb");

   if (mysqli_connect_error())
     {
      // $_SESSION['errormsg'] = "Connection failed: ".mysqli_connect_error(); 
      $_SESSION['errormsg']="We seem to have a problem on our side, please try again later";
      header("Location: login.php");
      return; 
     }

// c) check if credentials OK 
// If OK, set  

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
      mysqli_close($con);
      enterSecuredArea();
     }

} // end of checking if login form filled out

} // end of checking if already logged in

else { // since logged in, OK to proceed to the secured area
enterSecuredArea(); }

// $_GET refers to 'username' embedded with the URL in the querystring - not secure
// $_POST refers to a username coming in from a form submission using the post method - more secure
// This segment appears to be sanitizing the input from the login form, which is needed, but...
// we already sent the user back to the login page, if he was not already logged in (see above)
// No need to check if $_GET['username'] was set, if we are not going to use it
// Do need to check if $_POST['username'] was set, since we will try to use it
// Also, missing ending paren:
// if (isset($_GET['username'])
if (isset($_POST['username']))
{
  $username = filterinput($_POST['username']);
}

/*
include("http://242.32.23.4/inc/admin.inc.php");
if (isset($_GET['page_id'])) {
  include('inc/inc' . $_GET['page_id'] . '.php');
  include('inc/inc-base.php');
}
*/
// Unwise and less flexible to hard code a fully qualified URL, instead of relative path: include("inc/admin.inc.php");
// If the code is reused for a new client, the old client could complain about the extra number of hits on their site
// Assumes that this page coming up with http://example.com/admin.php?page_id=something to result in
// inclusion of a page named inc/incsomething.php
// risky, since the querystring is so easy to manipulate into, say 'officersalaries.php' or 'upcomingprojects.php' 

function filterinput($variable)
{
   $variable = str_replace("'", "\'", $variable);
// Line below has a syntax error, fixed by replacing the enclosing double quotes with single quotes:
// $variable = str_replace(""", "\"", $variable);
   $variable = str_replace('"', '\"', $variable);

// But this only escapes embedded single and double quotes, what we really need is this:
   $variable = mysql_real_escape_string( $variable ); 

   return $variable;
}

// We don't want to make an extra trip to the database for this - we already picked this up once above:
function getUserContent($username)
{
    $con=mysqli_connect("locahost","dbuser","abc123","my_db");
//  Error: host should be localhost, not locahost:   
    $con=mysqli_connect("localhost","dbuser","abc123","my_db");

    $result = mysqli_query($con,"SELECT user_content FROM users where username = ". $username);
//  Error: missing single quotes around username in query, should be:
    $result = mysqli_query($con,"SELECT user_content FROM users where username = '". $username."'");

    $row = mysqli_fetch_array($result);
//  Missing second parm "MYSQLI_ASSOC" on mysqli_fetch_array and hard to troubleshoot because not displaying errors:
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC) or die("Trouble: ".mysqli_error($con));

    return $row['user_content'];

//  Useless attempt to close the connection after a return statement, move it to before return:
    mysqli_close($con);
}

function enterSecuredArea() {

//echo "<h1>Welcome, ". $username ."</h1>";
echo "<h1>Welcome, ". $_SESSION['username'] ."</h1>";

//echo getUserContent($username);
echo $_SESSION['usercontent'];

}

?>
