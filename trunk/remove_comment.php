<?php
/*******************************************************************
remove_comment.php
Allows moderators to remove comments from projects
********************************************************************/

session_start ();

require("connect_db.php");
require("priviledge.php");

// if project id and user id are given and the user is a moderator
if(isset($_REQUEST['project_id'])&&isset($_REQUEST['user_id'])&&getPriviledge()<2)
{
	// make variables string secure
	$project_id=htmlspecialchars($_REQUEST['project_id']);
	$user=htmlspecialchars($_REQUEST['user_id']);

	// check if the comment exists
	$query_comment="SELECT 1 FROM comments WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".mysql_real_escape_string($project_id);
	$query_comment_res=mysql_query($query_comment);

	if (!$query_comment_res) 
	{
		//echo mysql_error();
		echo "Sorry, we can't query your request";
		exit;
	}

	$num_of_comment = mysql_numrows($query_comment_res);
	
	// if comment exists, remove comment
	if($num_of_comment>0)
	{
		$delete_comment="DELETE FROM comments WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".mysql_real_escape_string($project_id);
		$delete_comment_res=mysql_query($delete_comment);
		
		if (!$delete_comment_res) 
		{
			//echo mysql_error();
			echo "Sorry, we can't query your request";
			exit;
		}
		
		$_SESSION['message']="<p>Comment Deleted</p>";
	}
	else
	{
		$_SESSION['message']= "<p>No such comment</p>";
	}
	
}
else
{
$_SESSION['message']="<p>Your comment fails</p>";
}
header("location:show_project.php?show_project_id=".$_REQUEST['project_id']);

?>
