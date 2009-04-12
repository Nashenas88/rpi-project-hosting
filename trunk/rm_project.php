<?php
/*******************************************************************
rm_project.php
Allows moderator to remove a project from the database
********************************************************************/

session_start ();

require("priviledge.php");
require("connect_db.php");

// if the user id is given and the user is a moderator
if(isset($_REQUEST['project_id'])&&getPriviledge()<2)
{
	
	$project_id=htmlspecialchars($_REQUEST['project_id']);

	// check if this project exists
	$query_project="SELECT 1 FROM projects WHERE id=".mysql_real_escape_string($project_id);
	$query_project_res=mysql_query($query_project);


	if (!$query_project_res) 
	{
		//echo mysql_error();
		echo "Sorry, we can't query your request";
		exit;
	}

	$num_of_project = mysql_numrows($query_project_res);
	
	//echo $query_project;

	// if project exists, remove project along with all related comments and ratings
	echo $num_of_project;
	if($num_of_project>0)
	{
		$delete_related_comment="DELETE FROM comments WHERE project_id=".mysql_real_escape_string($project_id);
		$delete_related_comment_res=mysql_query($delete_related_comment);
		
		$delete_related_rating="DELETE FROM ratings WHERE project_id=".mysql_real_escape_string($project_id);
		$delete_related_comment_res=mysql_query($delete_related_rating);
		
		$delete_project="DELETE FROM projects WHERE id=".mysql_real_escape_string($project_id);		
		$delete_project_res=mysql_query($delete_project);
		
		if (!$delete_project_res||!$delete_project_res||!$delete_project_res) 
		{
			//echo mysql_error();
			echo "Sorry, we can't query your request";
			exit;
		}

		$_SESSION['message']="<p>project Deleted</p>";
	}
	else
	{
		$_SESSION['message']= "<p>No such project</p>";
	}
	
}
else
{
$_SESSION['message']="<p>Your remove project fails</p>";
}
header("location:search.php");

?>