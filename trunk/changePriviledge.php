<?php
/***
changePriviedge.php
allows moderators and admin to change the priviledge level of a user
***/

if (getPriviledge () == 0 )
{
	$output = "<form name='changePriviledge' method='POST' action='changePriviledge.php'>";
	$output .= "Username:&nbsp;&nbsp;&nbsp;&nbsp;<input name='username' id='input' type='text'\>";
	$output .= "By:&nbsp;&nbsp;&nbsp;&nbsp;<select name='priviledge'>";
	$output .= "<option value='3'>Non-RPI User</option>";
	$output .= "<option value='2'>RPI User</option>";
	$output .= "<option value='1'>Moderator</option>";
	$output .= "<option value='0'>Admin</option>";
	$output .= "</select>";
	$output .= "&nbsp;&nbsp;<input type='submit' value='Update'\>";
	$output .= "</form>";
	
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
			$output .= "User ".$username." does not exist";		
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
					$output .= "update error";
					exit;
				}
				else
				{
					$output .= "User " . $username . " has had privilege changed from " . mysql_result($user_exists,0,'priviledge') . " to " . $priviledge;
				}
				
				
			}
			else
			{
				$output .= "Your can't change your own priviledge";
			}
			
			
			
		}
		else
		{
			$output .= "Unknown Error";
		}
		
	}
	
}
else
{
	$output .= "You need to be a moderator";
}

?>
