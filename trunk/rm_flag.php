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
		$flag_comment="UPDATE comments SET flag=0 WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".$project_id;
		$flag_comment_res=mysql_query($flag_comment);
		
		if (!$flag_comment_res) 
		{
			echo mysql_error();
			exit;
		}
		
		$_SESSION['message']="<p>Remove Flag</p>";
	}
	else
	{
		$_SESSION['message']= "<p>No such comment</p>";
	}
	
}
else
{
$_SESSION['message']="<p>Your remove flag fails</p>";
}
header("location:show_project.php?show_project_id=".$_REQUEST['project_id']);

?>
