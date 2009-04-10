<?php
/***
changePriviedge.php
allows moderators and admin to change the priviledge level of a user
***/

session_start ();
require ("upper_header.php");
echo "Change Privilege";
require ("lower_header.php");
require ("menu.php");

if (isModerator () == true )
{
	echo "You are a moderator";
	require ("changePriviledgeForm.php");
	
	//make sure the form was filled in
	if(isset($_REQUEST['username'])&&isset($_REQUEST['priviledge']))
	{
		$username=$_REQUEST['username'];
		$priviledge=$_REQUEST['priviledge'];
		
		//sanitize form input
		$username=htmlspecialchars($username);

		//check to make sure user exists
		$self=$_SESSION['username'];
		$user_exists= mysql_query("SELECT rcsid FROM users WHERE rcsid='".mysql_real_escape_string($username)."'");
		$user_exists= mysql_fetch_array($user_exists);
		if($user_exists[0] == $username)
		{
			//you cannot change your own priviledge
			if($self != $username)
			{
				//you cannot change priviledge of a user with higher priviledge than you
				if(getPriviledge($self) >= getPriviledge($username))
				{
					
					mysql_query("INSERT INTO priviledgeusers(user_id) VALUES ('".mysql_real_escape_string($username)."')");
					echo "User " . $username . " has had privilege changed from " . getPriviledge($username) . " to " . $privildge;
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
