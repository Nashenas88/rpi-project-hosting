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
$loggedIn = 1;

session_register ("username");
session_register ("loggedIn");
header ("location:index.php");
?>

