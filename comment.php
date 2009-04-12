/*******************************************************************
comment.php
Allows user to add comment to a project
********************************************************************/
<?php

session_start ();

require("connect_db.php");

// get the user id and comment string
if(isset($_REQUEST['project_id'])&&isset($_REQUEST['commenting']))
{

	$comment=htmlspecialchars($_REQUEST['commenting']);
	$project_id=htmlspecialchars($_REQUEST['project_id']);
	$user=htmlspecialchars($_SESSION['username']);

	// check if comment string is longer than 500 characters
	if( strlen($comment) > 500 )
	{
		$_SESSION['message']="Your comment may not exceed 500 characters.<br />";
	}
	else{
	// check if user has already commented this project
	$query_comment="SELECT 1 FROM comments WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".mysql_real_escape_string($project_id);
	$query_comment_res=mysql_query($query_comment);

	if (!$query_comment_res) 
	{
		// echo mysql_error();
		echo "Sorry, we can't query your request";
		exit;
	}

		

	$num_of_comment = mysql_numrows($query_comment_res);

	if($num_of_comment>0)
	{
		$_SESSION['message']="<p>You already comment this project!</p>";
	}
	else
	{

		// if not comment on this project yet, insert comment
		$insert_comment="INSERT INTO comments(user_id,comment,project_id,flag) VALUES ('" . mysql_real_escape_string($user) . "','" . 
					mysql_real_escape_string($comment)."',".mysql_real_escape_string($project_id).",0)";
		$insert_comment_res=mysql_query($insert_comment);

		if (!$insert_comment_res) 
		{
			//echo mysql_error();
			echo "Sorry, we can't query your request";
			exit;
		}
	
		$_SESSION['message']= "<p>Your comment added successfully! </p>";
	}
}
	
}
else
{
	$_SESSION['message']="<p>Your comment failed.</p>";
}
header("location:show_project.php?show_project_id=".$_REQUEST['project_id']);

?>
