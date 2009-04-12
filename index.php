<?php
/*******************************************************************
index.php
Creates RPH homepage
********************************************************************/

session_start ();

require ("feater.php");

$output =  "<center>\n<h1>Welcome to RPI Project Hosting";

if (isset ($_SESSION["displayname"]))
{
  $displayName = $_SESSION["displayname"];
  $output .= ", $displayName";
}
elseif (isset ($_SESSION["usrname"]))
{
  $usrname = $_SESSION["usrname"];
  $output .= ", $usrname";
}

$output .= "!</h1>\n</center>";

make_page ("Main Page", $output);
?>
