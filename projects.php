<?php
session_start ();
require ("feater.php");

if (loggedIn () != 1)
{
  make_page ("Error", "<br/><center>You must be logged in to access this page!</center><br/>");
  exit;
}

make_page ("Projects", "<br/><center>Not yet implemented</center><br/>");

?>
