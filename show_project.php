<?php
/*******************************************************
show_projects.php
Diplays the details of a project that the user selects
********************************************************/

session_start ();

require("connect_db.php");
require ("feater.php");
head("Project");

// display error and success message
if(isset($_SESSION['message']))
{
	echo $_SESSION['message'];
	unset ($_SESSION['message']);
}

if(isset($_REQUEST['show_project_id']))
{
	$id=htmlspecialchars($_REQUEST['show_project_id']);
	$username=htmlspecialchars($_SESSION['username']);
	// query all neccessary information: rate, comment, project, and current user
	$query_rate="SELECT rate FROM ratings WHERE project_id=".mysql_real_escape_string($id);
	$query_rate_res=mysql_query($query_rate);

	$query_comment="SELECT * FROM comments WHERE project_id=".mysql_real_escape_string($id);
	$query_comment_res=mysql_query($query_comment);

	$query_project="SELECT * FROM projects WHERE id=".mysql_real_escape_string($id);
	$query_project_res=mysql_query($query_project);

	$query_user="SELECT * FROM users WHERE rcsid='".mysql_real_escape_string($username)."'";
	$query_user_res=mysql_query($query_user);
	
	if (!$query_rate_res||!$query_project_res||!$query_comment_res||!$query_user_res) 
	{
		//echo mysql_error();
		echo "Sorry, we can't query your request";
		exit;
	}
	
	// get the number of the project, comment, and rating
	$rating_num=mysql_numrows($query_rate_res);
	$project_num=mysql_numrows($query_project_res);
	$comment_num=mysql_numrows($query_comment_res);
	
	$sum=0;
	
	// calculate the rating

	for($j=0;$j<$rating_num;$j++)
	{
		$sum=$sum+mysql_result($query_rate_res,$j,'rate');
	}
	if ($rating_num == 0)
	{
		$current_rate = 0;
	}
	else
	{
		$current_rate=$sum/$rating_num;
	}

	// display project information
	if($project_num > 0 )
	{
	echo "<h2>Project Details</h2><table>";
	for ($i=0;$i<$project_num;$i++) 
	{
		echo "  <tr><td>Title: </td><td>" . mysql_result($query_project_res,$i,'title') . "</td></tr>";
		echo "  <tr><td>Description: </td><td>" . mysql_result($query_project_res,$i,'description') . "</td></tr>";
		echo "  <tr><td>Authors: </td><td>" . mysql_result($query_project_res,$i,'authors') . "</td></tr>";
		echo "  <tr><td>Downloads: </td><td>" . mysql_result($query_project_res,$i,'downloads'). "</td></tr>";
		echo "  <tr><td>Size: </td><td>" . mysql_result($query_project_res,$i,'size'). "</td></tr>";
		echo "  <tr><td>Project_location: </td><td><a href='" . mysql_result($query_project_res,$i,'project_location'). "'>Download Link</a></td></tr>";
		echo "  <tr><td>Class: </td><td>" . mysql_result($query_project_res,$i,'class'). "</td></tr>";
		echo "  <tr><td>Major: </td><td>" . mysql_result($query_project_res,$i,'major'). "</td></tr>";
		echo "  <tr><td>School: </td><td>" . mysql_result($query_project_res,$i,'school'). "</td></tr>";
		echo "  <tr><td>Date uploaded: </td><td>" . mysql_result($query_project_res,$i,'date'). "</td></tr>";
		echo "  <tr><td>Current rating: </td><td>" . $current_rate . " number of rates: " . $rating_num . "</td></tr>";
		if(isset($_SESSION['username']))
		{
		echo "<tr><td><form name='rate' method='POST' action='rate.php'><select name='rate'><option value='1'>1</option><option value=1>1</option>";
		echo "<option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
		echo "<input type='hidden' name='project_id' value='".mysql_result($query_project_res,$i,'id')."'/><input type='submit' value='Rate' /></form></td></tr>";
		}
		if(getPriviledge ()<2)
		{
		echo "<tr><td><form name='remove_project' method='POST' action='rm_project.php'>";
		echo "<input type='hidden' name='project_id' value='".mysql_result($query_project_res,$i,'id')."'/><input type='submit' value='Remove' /></form></td></tr>";
		}
	}
	
	echo "</table>\n";
	
	// display comments
	echo "<h2>Comments</h2>";
	for ($k=0;$k<$comment_num;$k++)
	{
		echo "<h3>Comment By: " . mysql_result($query_comment_res,$k,'user_id') . "</h3>";

		echo "<table><tr><td><form name='flag_comment' method='POST' action='comment.php'><input type='hidden' name='flag_comment_project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Flag Comment' /></form></td>";

		// if current user is moderator or admin, display remove comment and remove flag option
		$num_of_user = mysql_numrows($query_user_res);

		if($num_of_user>0&&mysql_result($query_user_res,0,'priviledge')<2)
		{		
		echo "<td><form name='rm_comment' method='POST' action='comment.php'><input type='hidden' name='rm_comment_project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Remove Comment' /></form></td>";
		
			if(mysql_result($query_comment_res,$k,'flag')==1){
		echo "<td><form name='rm_flag' method='POST' action='comment.php'><input type='hidden' name='rm_flag_project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Remove Flag' /></form></td>";		
		}
		}
		
		echo "</tr></table>";
		
		echo "<p>".mysql_result($query_comment_res,$k,'comment')."</p>";	
	}
	echo "<h2>Add Comments:</h2>";
	echo "<form name='comment' method='POST' action='comment.php'><textarea name='commenting' rows=10 cols=40 ></textarea><br /><input type='hidden' name='project_id' value='$id' /><input type='submit' value='Add Comment' /></form>";
	}
	else
	{
		echo "<h2>Project is not found</h2>";
	}
}
else
{
	echo "Project does not exist.</br>";
}
$_SESSION['back'] = $_SERVER['REQUEST_URI'];
foot();

?>
