/*******************************************************************
login.php
Allows user to login using their RPI username and password
********************************************************************/
<?php

// phpCAS simple client
/*******************************************
Edit the CAS.php file to get rid of warnings. 
Replace "/tmp" and "/tmp/" with a relative path like "./"
*******************************************/

// import phpCAS lib
include_once('CAS-1.0.1/CAS.php');

phpCAS::setDebug();

// initialize phpCAS
phpCAS::client(CAS_VERSION_2_0,'login.rpi.edu',443,'/cas');

// no SSL validation for the CAS server
phpCAS::setNoCasServerValidation();

// force CAS authentication
phpCAS::forceAuthentication();

// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

// logout if desired
if (isset($_REQUEST['logout'])) {
    session_start ();
    session_destroy ();
   phpCAS::logout();
}

// get the username 
$username = phpCAS::getUser ();

require ("connect_db.php");

$query = sprintf ("SELECT 1 FROM moderateusers WHERE user_id='%s'", mysql_real_escape_string ($username));
$result = mysql_query ($query);
if (!$result)
{
  echo mysql_error ();
  exit;
}

// check if user is banned
$matches = mysql_numrows ($result);
if ($matches > 0)
{
  require ("feater.php");
  make_page ("Error", "<br />\n<center>\nYou are currently banned and may not log in.\n</center>\n<br />");
  exit;
}

$loggedIn = 1;

session_register ("username");
session_register ("loggedIn");

$query = sprintf ("SELECT 1 FROM users WHERE rcsid='%s'", mysql_real_escape_string ($username));
$result = mysql_query ($query);
if (!$result)
{
  require ("feater.php");
  make_page ("Error", mysql_error ());
  exit;
}

// check the user does not exist in the database, add the user to the database
$matches = mysql_numrows ($result);
if ($matches == 0)
{
    $query = sprintf ("INSERT INTO users VALUES('%s', 'crap', 2)", mysql_real_escape_string ($username));
    if (!mysql_query ($query))
    {
        require ("feater.php");
		  make_page ("Error", mysql_error ());
        exit;
    }
}

header ("location:index.php");
?>

