<?php

session_start ();

require("connect_db.php");

require ("upper_header.php");
echo "Search";
require ("lower_header.php");
require ("menu.php");

/*
* display any message generated
*/
if(isset($_SESSION['message']))
{
	echo $_SESSION['message'];
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

	$query_user="SELECT * FROM users WHERE rcsid='".mysql_real_escape_string("asdasd")."'";
	$query_user_res=mysql_query($query_user);
	
	if (!$query_rate_res||!$query_project_res||!$query_comment_res||!$query_user_res) 
	{
		//echo mysql_error();
		echo "Sorry, we can't query your request";
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
			
	$current_rate=$sum/$rating_num;

	
	/*
	*display project information
	*/
	echo "<h2>Project Details</h2><table>\n";
	for ($i=0;$i<$project_num;$i++) 
	{
		echo "<tr>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'title') . "</td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'description') . "</td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'uploader') . "</td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'downloads'). "</td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'size'). "</td>\n";
		echo "  <td><a href='" . mysql_result($query_project_res,$i,'project_location'). "'>Download Link</a></td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'class'). "</td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'major'). "</td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'school'). "</td>\n";
		echo "  <td>" . mysql_result($query_project_res,$i,'date'). "</td>\n";
		echo "  <td>".$rating_num." users rate this project: " . $current_rate. "</td>\n";
		echo "<td><form name='rate' method='POST' action='rate.php'><input type='text' name='rate' size=2/><input type='hidden' name='project_id' value='".mysql_result($query_project_res,$i,'id')."'/><input type='submit' value='Rate' /></form></td>";
		echo "</tr>\n";
	}
	
	echo "</table>\n";
	
	/*
	*display comments
	*/
	echo "<h2>Comments</h2>";
	for ($k=0;$k<$comment_num;$k++)
	{
		echo "<h3>Comment By: ".mysql_result($query_comment_res,$k,'user_id')."</h3>";

		echo "<table><tr><td><form name='flag_comment' method='POST' action='flag_comment.php'><input type='hidden' name='project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Flag Comment' /></form></td>";

		/*
		*if current user is moderator or admin, display remove comment and remove flag option
		*/
		if(mysql_result($query_user_res,0,'priviledge')<2)
		{		
		echo "<td><form name='rm_comment' method='POST' action='remove_comment.php'><input type='hidden' name='project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Remove Comment' /></form></td>";
			
		echo "<td><form name='rm_flag' method='POST' action='rm_flag.php'><input type='hidden' name='project_id' value='$id' /><input type='hidden' name='user_id' value='".mysql_result($query_comment_res,$k,'user_id')."' /><input type='submit' value='Remove Flag' /></form></td>";		
		}
		
		echo "</tr></table>";
		
		echo "<p>".mysql_result($query_comment_res,$k,'comment')."</p>";	
	}
	echo "<h2>Add Comments:</h2>";
	echo "<form name='comment' method='POST' action='comment.php'><textarea name='commenting' rows=10 cols=40 ></textarea><br /><input type='hidden' name='project_id' value='$id' /><input type='submit' value='Add Comment' /></form>";
}
else
{


}

require ("footer.php");

?>