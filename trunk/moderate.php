<?php
/***
moderate.php
implements ban and unban ability of moderator priveledged
***/

session_start ();

require ("feater.php");
head ('Moderate');


/*******************************************************************
Allows moderators and admin to change the priviledge level of a user
********************************************************************/
function changePriviledge()
{
	echo "<form name='changePriviledge' method='POST' action='moderate.php'>";
	echo "Username:&nbsp;&nbsp;&nbsp;&nbsp;<input name='username' id='input' type='text'\>";
	echo "By:&nbsp;&nbsp;&nbsp;&nbsp;<select name='priviledge'>";
	echo "<option value='3'>Non-RPI User</option>";
	echo "<option value='2'>RPI User</option>";
	echo "<option value='1'>Moderator</option>";
	echo "<option value='0'>Admin</option>";
	echo "</select>";
	echo "&nbsp;&nbsp;<input type='submit' value='Update'\>";
	echo "</form>";
	
	// make sure the form was filled in
	if(isset($_REQUEST['username'])&&isset($_REQUEST['priviledge']))
	{
		$username=$_REQUEST['username'];
		$priviledge=htmlspecialchars($_REQUEST['priviledge']);
		
		// sanitize form input
		$username=htmlspecialchars($username);

		// check to make sure user exists
		$self=$_SESSION['username'];
		$user_exists= mysql_query("SELECT * FROM users WHERE rcsid='".mysql_real_escape_string($username)."'");

		if (!$user_exists)
		{
			echo "User ".$username." does not exist";		
		}
		else if( mysql_numrows ($user_exists) > 0 && mysql_result($user_exists,0,'rcsid') == $username)
		{
			//you cannot change your own priviledge
			if($self != $username)
			{
				$update_priviledge="UPDATE users SET priviledge=".mysql_real_escape_string($priviledge)." WHERE rcsid='".$username."'";
				$update_privildge_res=mysql_query($update_priviledge);
				
				if(!$update_privildge_res)
				{
					echo "update error";
					exit;
				}
				else
				{
					echo "User " . $username . " has had privilege changed from " . 
							mysql_result($user_exists,0,'priviledge') . " to " . $priviledge;
				}
			}
			else
			{
				echo "Your can't change your own priviledge";
			}
		}
		else
		{
			echo "Username does not match up";
		}
	}
}

//only show if user is a moderator
if (getPriviledge() <= 1)
{
	echo "<p>You are a moderator<br /></p>";
	echo "Ban an user: <br>";
	echo "<form name='ban' method='POST' action='moderate.php'>";
	echo "Username:&nbsp;&nbsp;&nbsp;&nbsp;<input name='username' id='input' type='text'\>";
	echo "By:&nbsp;&nbsp;&nbsp;&nbsp;<select name='ban_unban'>";
	echo "<option value=\"ban\">Ban</option>";
	echo "<option value=\"unban\">Unban</option>";
	echo "</select>";
	echo "&nbsp;&nbsp;<input type='submit' value='Update'\>";
	echo "</form>";
	echo "<br>";
	
	echo "<p>Change user's priviledge:</p>";
	changePriviledge();
	echo "<br><br>";
	
	
	//make sure the form was filled in
	if(isset($_REQUEST['username'])&&isset($_REQUEST['ban_unban']))
	{
		$username=$_REQUEST['username'];
		$ban_unban=$_REQUEST['ban_unban'];
		
		//sanitize form input
		$username=htmlspecialchars($username);

		//check to make sure user exists
		$self=$_SESSION['username'];
		$user_exists= mysql_query("SELECT rcsid FROM users WHERE rcsid='".mysql_real_escape_string($username)."'");
		$user_exists= mysql_fetch_array($user_exists);
		if($user_exists[0] == $username)
		{
			//you cannot ban yourself
			if($self != $username)
			{
				//you cannot ban a user with higher priviledge than you
				if(getPriviledge($self) >= getPriviledge($username))
				{
					//if want to unban user
					if($_REQUEST['ban_unban'] == ban)
					{
						//check to make sure user is not already banned
						$user_banned= mysql_query("SELECT user_id FROM moderateusers WHERE user_id='".mysql_real_escape_string($username)."'");
						$user_banned = mysql_fetch_array($user_banned);
						if($user_banned[0] == $username)
						{
							echo "User ".$username." is already banned";
						}
						else
						{
							mysql_query("INSERT INTO moderateusers(user_id) VALUES ('".mysql_real_escape_string($username)."')");
							echo "User ".$username." has been banned";
						}
					}
					//if want to ban user
					else
					{
						//check to make sure user is already banned
						$user_banned= mysql_query("SELECT user_id FROM moderateusers WHERE user_id='".mysql_real_escape_string($username)."'");
						$user_banned= mysql_fetch_array($user_banned);
						if($user_banned[0] == $username)
						{
							mysql_query("DELETE FROM moderateusers WHERE user_id='".mysql_real_escape_string($username)."'");
							echo "User ".$username." is no longer banned";
						}
						else
						{
							echo "User ".$username." is was not previously banned";
						}
					}
				}
				else
				{
					echo "hah".$username." dominates you";
				}
			}
			else
			{
				echo "Your attempted suicide was aborted";
			}
		}
		else
		{
			echo "User ".$username." does not exist";
		}
	}
	
	

	/*
	If there is a flagged comment, list them and options of remove flag, remove comment, and the project this comment is commenting on
	*/
	$query_flag_comments="SELECT * FROM comments where flag=1";
	$query_flag_comments_res=mysql_query($query_flag_comments);
	if (!$query_flag_comments_res) 
	{
		//echo mysql_error();
		echo "Sorry, we can't query your request";
		exit;
	}
	$query_flag_comments_num=mysql_numrows($query_flag_comments_res);
	
	
	echo "<table>";
	for($i=0;$i<$query_flag_comments_num;$i++)
	{
		echo "<tr><td><form name='rm_comment' method='POST' action='remove_comment.php'><input type='hidden' name='project_id' value='".mysql_result($query_flag_comments_res,$i,'project_id')."' /><input type='hidden' name='user_id' value='".mysql_result($query_flag_comments_res,$i,'user_id')."' /><input type='submit' value='Remove Comment' /></form></td>";
			
		echo "<td><form name='rm_flag' method='POST' action='rm_flag.php'><input type='hidden' name='project_id' value='".mysql_result($query_flag_comments_res,$i,'project_id')."' /><input type='hidden' name='user_id' value='".mysql_result($query_flag_comments_res,$i,'user_id')."' /><input type='submit' value='Remove Flag' /></form></td>";		
		
		echo "<td><form name='show_project' method='GET' action='show_project.php'><input type='hidden' name='show_project_id' value='".mysql_result($query_flag_comments_res,$i,'project_id')."' /><input type='submit' value='show project' /></form></td></tr>";
		
		echo "</tr><td colspan='2'><p>".mysql_result($query_flag_comments_res,$i,'comment')."</p></td></tr>";	
	
	}
	echo "</table>";


		
}
else
{
	"You need to be a moderator";
}

foot();

?>
