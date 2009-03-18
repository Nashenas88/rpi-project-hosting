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
    if (!$priviledge_query)
    {
        echo mysql_error ();
        exit;
    }
    if (mysql_numrows ($priviledge_query) > 0)
    {
        #$result = mysql_fetch_array($priviledge_query);
        #mysql_result($priviledge_query, 0, 'priviledge')
        
        if(mysql_result($priviledge_query, 0, 'priviledge') < 2)
        {
    	    return true;
        }
        else
        {
         return false;
        }
    }
    else
    {
  	    echo "No users... somethings not right";
    }
}
?>
