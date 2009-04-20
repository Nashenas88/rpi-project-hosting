<?php
/*******************************************************************
rm_project.php
Allows moderator to remove a project from the database
********************************************************************/

session_start ();

require ("priviledge.php");
require ("connect_db.php");

$_SESSION['message'] = "";

if (empty ($_SESSION['username']))
{
	$_SESSION['message'] = "You cannoy access that feature unless you are logged in";
	header ("Location: search.php");
	exit;
}

$project_id = htmlentities ($_REQUEST['project_id']);
$query_project = "SELECT * FROM projects WHERE id='" . mysql_real_escape_string ($project_id) . "';";
$query_project_res = mysql_query ($query_project);

// if the user id is given and the user is a moderator
if ($query_project_res && ((isset ($_REQUEST['project_id']) && getPriviledge () < 2) ||
   $_SESSION['username'] == mysql_result ($query_project_res, 0, 'uploader')))
{
	$num_of_project = mysql_numrows ($query_project_res);
	
	//echo $query_project;

	// if project exists, remove project along with all related comments and ratings
	//echo $num_of_project;
	if ($num_of_project > 0)
	{
		$get_info = sprintf ("SELECT title, uploader FROM projects WHERE id='%s';", mysql_real_escape_string ($project_id));
		$get_info_res = mysql_query ($get_info);
		
		if ($get_info_res)
		{
			if (mysql_numrows ($get_info_res) > 0)
			{
				$row = mysql_fetch_assoc ($get_info_res);
				$username = $row['uploader'];
				$path = "uploads/" . $username . "/" . $row['title'];
				
				foreach (scandir ($path) as $file)
				{
				    if ($file != "." && $file != "..")
				    {
				        unlink ("$path/$file");
				    }
				}
				rmdir ($path);
			}
			else
			{
				$_SESSION['message'] .= "Sorry, a project with id = '" . $project_id . "' does not exist";
				exit;
			}
		}
		else
		{
			$_SESSION['message'] = mysql_error ();
			exit;
		}
		
		
		$delete_related_comment = "DELETE FROM comments WHERE project_id=" . mysql_real_escape_string ($project_id);
		$delete_related_comment_res = mysql_query ($delete_related_comment);
		
		$delete_related_rating = "DELETE FROM ratings WHERE project_id=" . mysql_real_escape_string ($project_id);
		$delete_related_rating_res = mysql_query ($delete_related_rating);
		
		$delete_project = "DELETE FROM projects WHERE id=" . mysql_real_escape_string ($project_id);
		$delete_project_res = mysql_query ($delete_project);
		
		if (!$delete_project_res || !$delete_related_comment_res || !$delete_related_rating_res) 
		{
			//echo mysql_error ();
			$_SESSION['message'] .= mysql_error (); //"Sorry, we can't query your request";
			exit;
		}
		
		$_SESSION['message'] .= "<p>Project Deleted</p>";
	}
	else
	{
		$_SESSION['message'] .= "<p>No such project</p>";
	}
	
}
else
{
	$_SESSION['message'] = "<p>Could not remove project</p>";
}
header ("location:search.php");

?>
