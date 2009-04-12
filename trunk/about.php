<?php
/****************************************************
about.php
Creates a page called 'About' with the html provided.
****************************************************/
session_start (); 

require ("feater.php");
head("About");

// Create a string of html 
// This is very ugly, but it works for now...
echo "<br />";
echo "<img src=\"images/RPH.png\" width='10%' height='10%'>";
echo "<br>";
echo "<br>";
echo "RPH is a project hosting site for RPI students. Students are able to log in to the website using their RCS IDs and Passwords.";
echo "<br>";
echo "Once logged in, students will be able to post their completed projects for everyone to see.";
echo "<br>";
echo "Projects may include anything from a CS1 class homework to a video game to a photograph.";
echo "<br>";
echo "<br>";
echo "RPH was started as a project for the Software Design and Documentation class.";
echo "<br>";
echo "<br>";
echo "Admins and Contributors:";
echo "<br>";
echo "Alex Mattern";
echo "<br>";
echo "Jin Guang Zheng";
echo "<br>";
echo "Dan Meretzky";
echo "<br>";
echo "Paul Faria";

foot();

?>
