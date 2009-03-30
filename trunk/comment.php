<?php

session_start ();

require("connect_db.php");


if(isset($_REQUEST['project_id'])&&isset($_REQUEST['commenting']))
{

	$comment=$_REQUEST['commenting'];
	$project_id=$_REQUEST['project_id'];
	$user=$_SESSION['username'];


	if( strlen($comment) > 500 )
	{
		$_SESSION['message']="Your comment may not exceed 500 characters.<br />";
	}
	else{
	/*
	*check if user already comments this project
	*/
	$query_comment="SELECT 1 FROM comments WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".mysql_real_escape_string($project_id);
	$query_comment_res=mysql_query($query_comment);

	if (!$query_comment_res) 
	{
		//echo mysql_error();
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

		/*
		*if not comment on this project yet, insert comment
		*/
		$insert_comment="INSERT INTO comments(user_id,comment,project_id,flag) VALUES ('".mysql_real_escape_string($user)."','".mysql_real_escape_string($comment)."',".mysql_real_escape_string($project_id).",0)";
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
	$_SESSION['message']="<p>Your comment fails</p>";
}
header("location:show_project.php?show_project_id=".$_REQUEST['project_id']);

?>
