//////////////////////////////////////
// remove_project.php
// dan meretzky
// deletes project from the database
//////////////////////////////////////

<?php

session_start ();

require("connect_db.php");


if(isset($_REQUEST['project_id'])&&isset($_REQUEST['user_id']))
{

	$project_id=$_REQUEST['project_id'];
	$user=$_REQUEST['user_id'];

	
	$query_project="SELECT 1 FROM projects WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".$project_id;
	$query_project_res=mysql_query($query_project);

	if (!$query_project_res) 
	{
		echo mysql_error();
		exit;
	}

	$num_of_project = mysql_numrows($query_project_res);
	
	if($num_of_project>0)
	{
		$delete_project="DELETE FROM projects WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".$project_id;
		$delete_project_res=mysql_query($delete_project);
		
		if (!$delete_project_res) 
		{
			echo mysql_error();
			exit;
		}
		
		$_SESSION['message']="<p>Project Deleted</p>";
	}
	else
	{
		$_SESSION['message']= "<p>No such project</p>";
	}
	
}
else
{
$_SESSION['message']="<p>Your project fails</p>";
}
header("location:show_project.php?show_project_id=".$_REQUEST['project_id']);

?>
