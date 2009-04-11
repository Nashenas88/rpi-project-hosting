<?php

session_start ();

require("connect_db.php");

echo "hhh";
if(isset($_REQUEST['project_id'])&&getPriviledge()<2)
{
	
	//$project_id=htmlspecialchars($_REQUEST['project_id']);
	/*
	*check if project need to be removed exist
	*/
	
	//$query_project="SELECT 1 FROM projects WHERE id=".mysql_real_escape_string($project_id);
	//$query_project_res=mysql_query($query_comment);
	//echo $project_id;
/*
	if (!$query_project_res) 
	{
		//echo mysql_error();
		echo "Sorry, we can't query your request";
		exit;
	}

	$num_of_project = mysql_numrows($query_project_res);
	*/
	//echo $query_project;
	/*
	*if project exist, remove project
	*/
	/*
	if($num_of_project>0)
	{
		$delete_project="DELETE FROM projects WHERE id=".mysql_real_escape_string($project_id);
		$delete_project_res=mysql_query($delete_project);
		
		if (!$delete_project_res) 
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
	*/
}
else
{
$_SESSION['message']="<p>Your remove project fails</p>";
}
header("location:search.php");

?>
