<?php
/*******************************************************************
logout.php
Allows user to logout of the CAS server
********************************************************************/
session_start ();
session_destroy ();
header ("location:logoutSuccess.php");
?>
