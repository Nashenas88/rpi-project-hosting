<?php
session_start ();
require ("upper_header.php");
echo "Login Successful";
require ("lower_header.php");
require ("menu.php");

echo "<br />\n<center>\n";
echo "You have successfully logged in to RPI Project Hosting!\n";
echo "<br />\n";
echo "Click <a href=\"index.php\">here</a> to return to the main page.\n";
echo "</center>";

require ("footer.php");
?>