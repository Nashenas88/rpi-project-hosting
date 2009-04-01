<?php
/***
moderate.php
implements ban and unban ability of moderator priveledged
***/

session_start ();
require ("upper_header.php");
echo "Moderate";
require ("lower_header.php");
require ("menu.php");

if (isModerator () == true)
{
	echo "You are a moderator";
	require ("ban_form.php");
	
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
	
}
else
{
	echo "You need to be a moderator";
}

require ("footer.php");

?>