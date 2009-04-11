<?php
//

// phpCAS simple client

//

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



$username = phpCAS::getUser ();

$query = sprintf ("SELECT 1 FROM moderateusers WHERE user_id='%s'", mysql_real_escape_string ($username));
$result = mysql_query ($query);
if (!$result)
{
  echo mysql_error ();
  exit;
}

$matches = mysql_numrows ($result);
if ($matches > 0)
{
  echo "You are currently banned and may not log in.";
  exit;
}

$loggedIn = 1;

session_register ("username");
session_register ("loggedIn");

require ("connect_db.php");

$query = sprintf ("SELECT 1 FROM users WHERE rcsid='%s'", mysql_real_escape_string ($username));
$result = mysql_query ($query);
if (!$result)
{
    echo mysql_error ();
    exit;
}

$matches = mysql_numrows ($result);
if ($matches == 0)
{
    $query = sprintf ("INSERT INTO users VALUES('%s', 'crap', 2)", mysql_real_escape_string ($username));
    if (!mysql_query ($query))
    {
        echo mysql_error ();
        exit;
    }
}

header ("location:index.php");
?>

