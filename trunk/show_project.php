<?php

session_start ();

require("connect_db.php");

require ("feater.php");

$output = "";
/*
* display any message generated
*/
if(isset($_SESSION['message']))
{
	$output .= $_SESSION['message'];
	unset ($_SESSION['message']);
}

if(isset($_REQUEST['show_project_id']))
{
	$id=htmlspecialchars($_REQUEST['show_project_id']);
	$username=htmlspecialchars($_SESSION['username']);
	/*
	*query all neccessary information: rate, comment, project, and current user
	*/
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
		$output .= "Sorry, we can't query your request";
		exit;
	}
	
	/*
	* number of project, coment, rating
	*/
	$rating_num=mysql_numrows($query_rate_res);
	$project_num=mysql_numrows($query_project_res);
	$comment_num=mysql_numrows($query_comment_res);
	
	$sum=0;
	
	/*
	* calculate rate
	*/

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

	
	/*
	*display project information
	*/
	$output .= "<h2>Project Details</h2><table>";
	for ($i=0;$i<$project_num;$i++) 
	{
		$output .= "  <tr><td>Title: </td><td>" . mysql_result($query_project_res,$i,'title') . "</td></tr>";
		$output .= "  <tr><td>Description: </td><td>" . mysql_result($query_project_res,$i,'description') . "</td></tr>";
		$output .= "  <tr><td>Authors: </td><td>" . mysql_result($query_project_res,$i,'authors') . "</td></tr>";
		$output .= "  <tr><td>Downloads: </td><td>" . mysql_result($query_project_res,$i,'downloads'). "</td></tr>";
		$output .= "  <tr><td>Size: </td><td>" . mysql_result($query_project_res,$i,'size'). "</td></tr>";
		$output .= "  <tr><td>Project_location: </td><td><a href='" . mysql_result($query_project_res,$i,'project_location'). "'>Download Link</a></td></tr>";
		$output .= "  <tr><td>Class: </td><td>" . mysql_result($query_project_res,$i,'class'). "</td></tr>";
		$output .= "  <tr><td>Major: </td><td>" . mysql_result($query_project_res,$i,'major'). "</td></tr>";
		$output .= "  <tr><td>School: </td><td>" . mysql_result($query_project_res,$i,'school'). "</td></tr>";
		$output .= "  <tr><td>Date uploaded: </td><td>" . mysql_result($query_project_res,$i,'date'). "</td></tr>";
		$output .= "  <tr><td>Current rating: </td><td>".$rating_num." users rating this project: " . $current_rate. "</td></tr>";
		if(isset($_SESSION['username']))
		{
		$output .= "<tr><td><form name='rate' method='POST' action='rate.php'><select name='rate'><option value='1'>1</option><option value=1>1</option>";
		$output .= "<option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
		$output .= "<input type='hidden' name='project_id' value='".mysql_result($query_project_res,$i,'id')."'/><input type='submit' value='Rate' /></form></td></tr>";
		}
		if(getPriviledge ()<2)
		{
		$output .= "<tr><td><form name='remove_project' method='POST' action='rm_project.php'>";
		$output .= "<input type='hidden' name='project_id' value='".mysql_result($query_project_res,$i,'id')."'/><input type='submit' value='Remove' /></form></td></tr>";
		}
	}
	
	$output .= "</table>\n";
	
	/*
	*display comments
	*/
	$output .= "<h2>Comments</h2>";
	for ($k=0;$k<$comment_num;$k++)
	{
		$output .= "<h3>Comment By: ".mysql_result($query_comment_res,$k,'user_id')."</h3>";

		$output .= "<table><tr><td><form name='flag_comment' method='POST' action='flag_comment.php'><input type='hidden' name='project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Flag Comment' /></form></td>";

		/*
		*if current user is moderator or admin, display remove comment and remove flag option
		*/
		$num_of_user = mysql_numrows($query_user_res);

		if($num_of_user>0&&mysql_result($query_user_res,0,'priviledge')<2)
		{		
		$output .= "<td><form name='rm_comment' method='POST' action='remove_comment.php'><input type='hidden' name='project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Remove Comment' /></form></td>";
		
			if(mysql_result($query_comment_res,$k,'flag')==1){
		$output .= "<td><form name='rm_flag' method='POST' action='rm_flag.php'><input type='hidden' name='project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Remove Flag' /></form></td>";		
		}
		}
		
		$output .= "</tr></table>";
		
		$output .= "<p>".mysql_result($query_comment_res,$k,'comment')."</p>";	
	}
	$output .= "<h2>Add Comments:</h2>";
	$output .= "<form name='comment' method='POST' action='comment.php'><textarea name='commenting' rows=10 cols=40 ></textarea><br /><input type='hidden' name='project_id' value='$id' /><input type='submit' value='Add Comment' /></form>";
}
else
{


}

make_page ("Project", $output);

?>