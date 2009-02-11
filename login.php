<?php
session_start ();
require ("upper_header.php");
echo "Login";
require ("lower_header.php");
require ("menu.php");
echo "<align=\"left\">\n<br />\n";
require ("loginForm.php");
echo "</align>";
require ("footer.php");
?>