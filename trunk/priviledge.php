<?php
/***
priviledge.php
loggedIn()
isModerator()
Contains the priveledge reckoning functions
***/

function loggedIn ()
{
  return $_SESSION["loggedIn"];
}

/***
0=admin, 1=moderator, 2=RPIuser
It should return true if user has moderator priveleges and false otherwise.
***/
function isModerator ()
{
  require("connect_db.php");
  $username=$_SESSION['usrname'];

  $priviledge_query= mysql_query("SELECT priviledge FROM users WHERE rcsid='".mysql_real_escape_string($username)."'");
  $result = mysql_fetch_array($priviledge_query);

  if($result[0] < 2)
  {
  	 return true;
  }
  else
  {
  	 return false;
  }
}
?>