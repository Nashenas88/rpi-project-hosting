<?php
/*******************************************************************
comment.php
Allows user to add comment to a project, flag a comment
And allow moderator to remove comment, or remove flag from a comment
********************************************************************/

session_start ();

require("connect_db.php");
require("priviledge.php");

/*
* Base on the request parameter received, process different command
*/
if(isset($_REQUEST['project_id'])&&isset($_REQUEST['commenting']))
{
	echo "comment";
	comment();
}
else if(isset($_REQUEST['rm_flag_project_id'])&&isset($_REQUEST['user_id']))
{
	echo "rm flag";
	if(getPriviledge()<2)
	{
		rm_flag();
	}
	else
	{
		echo "<p>You need to be a moderator to process this command</p>";
	}
}
else if(isset($_REQUEST['flag_comment_project_id'])&&isset($_REQUEST['user_id']))
{
	echo "flag comment";
	flag_comment();
	
}
else if(isset($_REQUEST['rm_comment_project_id'])&&isset($_REQUEST['user_id']))
{
	echo "remove comment";
	if(getPriviledge()<2)
	{
		remove_comment();
	}
	else
	{
		echo "<p>You need to be a moderator to process this command</p>";
	}	
}
else{
	$_SESSION['message']="<p>Can't process your request</p>";
}
/*
* function process the user comment request
*/

function comment()
{
	// get the user id and comment string
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

header("location:show_project.php?show_project_id=".$_REQUEST['project_id']);

}
/*
* function process the request of removing flag from a comment 
*/

function rm_flag()
{
	$project_id=htmlspecialchars($_REQUEST['rm_flag_project_id']);
	$user=htmlspecialchars($_REQUEST['user_id']);

	/*
	*check if comment need to remove flag exist
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
	
	/*
	*if there is such a comment, update flag attribute
	*/
	if($num_of_comment>0)
	{
		$flag_comment="UPDATE comments SET flag=0 WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".mysql_real_escape_string($project_id);
		$flag_comment_res=mysql_query($flag_comment);
		
		if (!$flag_comment_res) 
		{
			//echo mysql_error();
			echo "Sorry, we can't query your request";
			exit;
		}
		
		$_SESSION['message']="<p>Remove Flag</p>";
	}
	else
	{
		$_SESSION['message']= "<p>No such comment</p>";
	}
	
header("location:show_project.php?show_project_id=".$_REQUEST['rm_flag_project_id']);

}

/*
* function process the flag comment request
*/
function flag_comment()
{
	// make variable text secure
	$project_id=htmlspecialchars($_REQUEST['flag_comment_project_id']);
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
			echo "Sorry, we can't query your request";
			exit;
		}
		
		$_SESSION['message']="<p>Comment Flag</p>";
	}
	else
	{
		$_SESSION['message']= "<p>No such comment</p>";
	}


header("location:show_project.php?show_project_id=".$_REQUEST['flag_comment_project_id']);

}

/*
* function process the remove comment request
*/
function remove_comment()
{
	$project_id=htmlspecialchars($_REQUEST['rm_comment_project_id']);
	$user=htmlspecialchars($_REQUEST['user_id']);

	/*
	*check if comment need to be removed exist
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
	
	/*
	*if comment exist, remove comment
	*/
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

header("location:show_project.php?show_project_id=".$_REQUEST['rm_comment_project_id']);
}


?>
