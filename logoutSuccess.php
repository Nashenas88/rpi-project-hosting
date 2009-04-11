<?php
session_start ();
require ("feater.php");
 	
$output .= "<br /><center>";
$output .= "You have successfully logged out of RPI Project Hosting!";
$output .= "<br />";
$output .= "Click <a href=\"index.php\">here</a> to return to the main page.";
$output .= "</center>";
 	
make_page ("Logout Success", $output);
?>