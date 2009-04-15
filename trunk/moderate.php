<?php
/****************************************************
moderate.php
Allows moderator to ban and unban a user, and also to
change the priviledge of a user
*****************************************************/

session_start ();

require ("feater.php");
head ('Moderate');

if (empty ($_SESSION['username']))
{
	?><br /><center>You must be loggin in to view this page!</center><br /><?php
	foot ();
	exit;
}


/*******************************************************************
Allows moderators and admin to change the priviledge level of a user
********************************************************************/
function changePriviledge()
{
   if(getPriviledge() != 0)
   {
      return;
   }
?>

<p>Change user's priviledge:<br /></p>
<form name='changePriviledge' method='POST' action='moderate.php'>
Username:    <input name='username' id='input' type='text'\>
Action:    <select name='priviledge'>
<option value='2'>RPI User</option>
<option value='1'>Moderator</option>
<option value='0'>Admin</option>
</select>
<input type='submit' value='Update'\>
</form>

<?php
       
  // make sure the form was filled in
  if (isset ($_REQUEST['username']) && $_REQUEST['username'] != "" && isset ($_REQUEST['priviledge']))
  {
	 // sanitize form input
	 $username=htmlspecialchars ($_REQUEST['username']);
	 $priviledge=htmlspecialchars($_REQUEST['priviledge']);
	
	 // check to make sure user exists
	 $self=$_SESSION['username'];
	 $user_exists = mysql_query("SELECT * FROM users WHERE rcsid='" . mysql_real_escape_string ($username) . "'");
	
	 if (!$user_exists)
	 {
      echo mysql_error ();
	 }
	 else if (mysql_numrows ($user_exists) > 0 && mysql_result($user_exists,0,'rcsid') == $username)
	 {
      //you cannot change your own priviledge
      if($self != $username)
      {
        $update_priviledge = "UPDATE users SET priviledge=" . mysql_real_escape_string ($priviledge) . " WHERE rcsid='" . $username . "'";
        $update_privildge_res = mysql_query ($update_priviledge);
       
        if(!$update_privildge_res)
        {
          echo mysql_error ();
          exit;
        }
        else
        {
          echo "User '" . $username . "' has had his privilege level changed from " .
			 mysql_result ($user_exists, 0, 'priviledge') . " to " . $priviledge;
        }
      }
      else
      {
        echo "You can't change your own privilege";
      }
	 }
	 else
	 {
      echo "User '" . $username . "' does not exist";
	 }
  }
}

/************************************************************************
For banning and Unbanning users
*************************************************************************/
function banUnban()
{
   if(getPriviledge() > 1)
   {
      return;
   }
?>

Ban an user: <br />
<form name='ban' method='POST' action='moderate.php'>
Username:    <input name='username' id='input' type='text' />
Action:    <select name='ban_unban'>
<option value="ban">Ban</option>
<option value="unban">Unban</option>
</select>
<input type='submit' value='Update' />
</form>

<?php
  //make sure the form was filled in
  if (isset ($_REQUEST['username']) && isset ($_REQUEST['ban_unban']))
  {
          // sanitize from input
          $username = htmlspecialchars ($_REQUEST['username']);
          $ban_unban = $_REQUEST['ban_unban'];

          //check to make sure user exists
          $self = $_SESSION['username'];
          $user_exists = mysql_query ("SELECT rcsid FROM users WHERE rcsid='".mysql_real_escape_string($username)."'");
          $user_exists = mysql_fetch_array ($user_exists);
          if ($user_exists[0] == $username)
          {
                  //you cannot ban yourself
                  if ($self != $username)
                  {
                          //you cannot ban a user with higher priviledge than you
                          if (getPriviledge ($self) >= getPriviledge ($username))
                          {
                                  //if want to ban user
                                  if($_REQUEST['ban_unban'] == ban)
                                  {
                                          //check to make sure user is not already banned
                                          $user_banned= mysql_query ("SELECT user_id FROM moderateusers WHERE user_id='" . mysql_real_escape_string ($username) . "'");
                                          $user_banned = mysql_fetch_array ($user_banned);
                                          if ($user_banned[0] == $username)
                                          {
                                                  echo "User '" . $username . "' is already banned";
                                          }
                                          else
                                          {
                                                  mysql_query ("INSERT INTO moderateusers(user_id) VALUES ('" . mysql_real_escape_string ($username) . "')");
                                                  echo "User '" . $username . "' has been banned";
                                          }
                                  }
                                  //if want to unban user
                                  else
                                  {
                                          //check to make sure user is already banned
                                          $user_banned = mysql_query ("SELECT user_id FROM moderateusers WHERE user_id='" . mysql_real_escape_string ($username) . "'");
                                          $user_banned = mysql_fetch_array ($user_banned);
                                          if ($user_banned[0] == $username)
                                          {
                                                  mysql_query ("DELETE FROM moderateusers WHERE user_id='" . mysql_real_escape_string ($username) . "'");
                                                  echo "User '" . $username . "' is no longer banned";
                                          }
                                          else
                                          {
                                                  echo "User '" . $username . "' was not previously banned";
                                          }
                                  }
                          }
                          else
                          {
                                  echo "hah '" . $username . "' dominates you";
                          }
                  }
                  else
                  {
                          echo "Your attempted suicide was aborted";
                  }
          }
          else
          {
                  echo "User '" . $username . "' does not exist";
          }
  }
}


/*******************************************************************************
If there is a flagged comment, list them and options of remove flag, 
remove comment, and the project this comment is commenting on
********************************************************************************/
function flags()
{
   if(getPriviledge() > 1)
   {
      return;
   }
        $query_flag_comments = "SELECT * FROM comments where flag=1";
        $query_flag_comments_res = mysql_query($query_flag_comments);
        if (!$query_flag_comments_res)
        {
                echo mysql_error();
                //echo "Sorry, we can't query your request";
                exit;
        }
        $query_flag_comments_num = mysql_numrows ($query_flag_comments_res);
       
       
        echo "<table>";
        for ($i = 0; $i < $query_flag_comments_num; $i++)
        {
                echo "<tr><td><form name='rm_comment' method='POST' action='comment.php'><input type='hidden' name='rm_comment_project_id' value='".mysql_result($query_flag_comments_res,$i,'project_id')."' /><input type='hidden' name='user_id' value='".mysql_result($query_flag_comments_res,$i,'user_id')."' /><input type='submit' value='Remove Comment' /></form></td>";
                       
                echo "<td><form name='rm_flag' method='POST' action='comment.php'><input type='hidden' name='rm_flag_project_id' value='".mysql_result($query_flag_comments_res,$i,'project_id')."' /><input type='hidden' name='user_id' value='".mysql_result($query_flag_comments_res,$i,'user_id')."' /><input type='submit' value='Remove Flag' /></form></td>";          
               
                echo "<td><form name='show_project' method='GET' action='show_project.php'><input type='hidden' name='show_project_id' value='".mysql_result($query_flag_comments_res,$i,'project_id')."' /><input type='submit' value='show project' /></form></td></tr>";
               
                echo "</tr><td colspan='2'><p>".mysql_result($query_flag_comments_res,$i,'comment')."</p></td></tr>";  
       
        }
        echo "</table>";
}

//only show if user is a moderator or admin
$priviledgeLevel = getPriviledge();

if ($priviledgeLevel <= 1)
{
	//if user is moderate show ban user option and flagged comments 
    if ($priviledgeLevel == 1)
    {
      echo "<p>You are a moderator<br /></p>";
      banUnban();
      echo "<br /><br />";
      flags();
    }
	//if user is an admin show change user priviledge option too
    else if ($priviledgeLevel == 0)
    {
      echo "<p>You are an Admin<br /></p>";
      banUnban();
      echo "<br /><br />";
      changePriviledge();
      echo "<br /><br /><br />";
      flags();
    }
    else
    {
      echo "<p>You are Superman eating Kryptonite<br /></p>";
    }
}
else
{
    echo "<p>You need to be a moderator or an admin in order to view this page<br /></p>";
}
$_SESSION['back'] = $_SERVER['REQUEST_URI'];
foot();

?>
