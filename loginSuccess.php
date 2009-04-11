<?php
session_start ();
require ("feater.php");

$output = "<br />\n<center>\n";
$output .= "You have successfully logged in to RPI Project Hosting!\n";
$output .= "<br />\n";
$output .= "Click <a href=\"index.php\">here</a> to return to the main page.\n";
$output .= "</center>";

make_page ("Login Successful", $output);
?>