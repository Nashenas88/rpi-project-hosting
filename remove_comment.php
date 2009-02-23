<?php

session_start ();

require("connect_db.php");


if(isset($_REQUEST['project_id'])&&isset($_REQUEST['user_id']))
{

	$project_id=$_REQUEST['project_id'];
	$user=$_REQUEST['user_id'];

	
	$query_comment="SELECT 1 FROM comments WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".$project_id;
	$query_comment_res=mysql_query($query_comment);

	if (!$query_comment_res) 
	{
		echo mysql_error();
		exit;
	}

	$num_of_comment = mysql_numrows($query_comment_res);
	
	if($num_of_comment>0)
	{
		$delete_comment="DELETE FROM comments WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".$project_id;
		$delete_comment_res=mysql_query($delete_comment);
		
		if (!$delete_comment_res) 
		{
			echo mysql_error();
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
