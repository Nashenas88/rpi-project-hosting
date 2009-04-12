<?php
/*******************************************************************
priviledge.php
Uses the getPriviledge() function to return the privilege of a user
********************************************************************/

function loggedIn ()
{
  return $_SESSION["loggedIn"];
}


// returns priviledge level of specified user
// 0=admin, 1=moderator, 2=RPIuser, 3=unknown

function getPriviledge ()
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
        return mysql_result($result, 0, 'priviledge');
    }
    else
    {
  	    echo "No Users... wtf";
  	    return 3;
    }
}

/***
0=admin, 1=moderator, 2=RPIuser
It should return true if user has moderator priveleges and false otherwise.
***
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
}*/
?>
