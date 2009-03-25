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
  // connect to database
  require("connect_db.php");
  $username=$_SESSION['username'];

  $query = sprintf ("SELECT priviledge FROM users WHERE rcsid='%s'", mysql_real_escape_string($username));
  $result = mysql_query ($query);
    
    if (!$result)
    {
        echo mysql_error ();
        exit;
    }
    if (mysql_numrows ($result) > 0)
    {
        #$result = mysql_fetch_array($priviledge_query);
        #mysql_result($priviledge_query, 0, 'priviledge')
        
        if(mysql_result($result, 0, 'priviledge') < 2)
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
  	    echo "No Users... wtf";
    }
}
?>
