<?php
session_start ();
require ("upper_header.php");
echo "Logout Successful";
require ("lower_header.php");
require ("menu.php");

$loggedIn = $_SESSION["loggedIn"];
echo "<br />$loggedIn\n<center>\n";
echo "You have successfully logged out of RPI Project Hosting!\n";
echo "<br />";
echo "Click <a href=\"index.php\">here</a> to return to the main page.\n";
echo "</center>";

require ("footer.php");
?>