<?php
/***
changePriviedge.php
allows moderators and admin to change the priviledge level of a user
***/

session_start ();


if (getPriviledge () == 0 )
{
	require ("changePriviledgeForm.php");
	
	//make sure the form was filled in
	if(isset($_REQUEST['username'])&&isset($_REQUEST['priviledge']))
	{
		$username=$_REQUEST['username'];
		$priviledge=htmlspecialchars($_REQUEST['priviledge']);
		
		//sanitize form input
		$username=htmlspecialchars($username);

		//check to make sure user exists
		$self=$_SESSION['username'];
		$user_exists= mysql_query("SELECT * FROM users WHERE rcsid='".mysql_real_escape_string($username)."'");

		
		if (!$user_exists)
		{
			echo "User ".$username." does not exist";		
		}
		else if(mysql_result($user_exists,0,'rcsid') == $username)
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
					echo "User " . $username . " has had privilege changed from " . mysql_result($user_exists,0,'priviledge') . " to " . $priviledge;
				}
				
				
			}
			else
			{
				echo "Your can't change your own priviledge";
			}
			
			
			
		}
		else
		{
			echo "Unknown Error";
		}
		
	}
	
}
else
{
	echo "You need to be a moderator";
}

require ("footer.php");

?>
