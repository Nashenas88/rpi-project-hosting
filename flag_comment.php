<?php
/*******************************************************************
flag_comment.php
Allows user to flag a comment, which sends an alert to a moderator
********************************************************************/

session_start ();

require("connect_db.php");

$_SESSION['comment'] = "";
// test if project id and user id exist
if(isset($_REQUEST['project_id'])&&isset($_REQUEST['user_id']))
{
	// make variable text secure
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
	
	// if comment exists, update flag attribute
	if($num_of_comment>0)
	{
		$flag_comment="UPDATE comments SET flag=1 WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".mysql_real_escape_string($project_id);
		$flag_comment_res=mysql_query($flag_comment);
		
		if (!$flag_comment_res) 
		{
			//echo mysql_error();
			$_SESSION['message'] .= "Sorry, we can't query your request";
			exit;
		}
		
		$_SESSION['message'] .= "<p>The comment was flagged</p>";
	}
	else
	{
		$_SESSION['message'] .= "<p>Cannot flag a comment that doesn't exist</p>";
	}
}
else
{
$_SESSION['message']="<p>Your comment flag fails.</p>";
}
header("location:show_project.php?show_project_id=".$_REQUEST['project_id']);

?>