/****************************************************
about.php
Creates a page called 'About' with the html provided.
****************************************************/
<?php
session_start (); 

require ("feater.php");

<!---------------------------------------------------------------
Create a string of html that displays the about page information. 
This is very ugly, but it works for now...
---------------------------------------------------------------->
$output = "<br />";
$output .= "<img src=\"images/RPH.png\" width='10%' height='10%'>";
$output .= "<br>";
$output .= "<br>";
$output .= "RPH is a project hosting site for RPI students. Students are able to log in to the website using their RCS IDs and Passwords.";
$output .= "<br>";
$output .= "Once logged in, students will be able to post their completed projects for everyone to see.";
$output .= "<br>";
$output .= "Projects may include anything from a CS1 class homework to a video game to a photograph.";
$output .= "<br>";
$output .= "<br>";
$output .= "RPH was started as a project for the Software Design and Documentation class.";
$output .= "<br>";
$output .= "<br>";
$output .= "Admins and Contributors:";
$output .= "<br>";
$output .= "Alex Mattern";
$output .= "<br>";
$output .= "Jin Guang Zheng";
$output .= "<br>";
$output .= "Dan Meretzky";
$output .= "<br>";
$output .= "Paul Faria";

make_page ("About", $output);
?>
