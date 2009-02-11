<?php
session_start ();
require ("upper_header.php");
echo "Main Page";
require ("lower_header.php");
require ("menu.php");
echo "<center>\n<h1>Welcome to RPI Project Hosting";

if (isset ($_SESSION["displayname"]))
{
  $displayName = $_SESSION["displayname"];
  echo ", $displayName";
}
elseif (isset ($_SESSION["usrname"]))
{
  $usrname = $_SESSION["usrname"];
  echo ", $usrname";
}

echo "!</h1>\n</center>";
require ("footer.php");
?>