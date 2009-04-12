<?php
session_start ();
require ("feater.php");
require("connect_db.php");

$output="";
if(isset($_SESSION['username']))
{

	$output.="<h2>My Uploaded Projects</h2><br/>";
	$user=htmlspecialchars($_SESSION['username']);
	$query_my_project="SELECT * FROM projects WHERE uploader='".mysql_real_escape_string($user)."'";
	$query_my_project_res=mysql_query($query_my_project);
	if(!$query_my_project_res)
	{
		$output .= "Sorry, we can't query your request";
		//echo mysql_error();
		exit;
	}
	$my_project_return_num=mysql_numrows($query_my_project_res);
	if($my_project_return_num>0)
	{
		$output .= '<table CLASS="sortable" ID="table0" BORDER=5 BGCOLOR="#99CCFF">';
		$output .= '<tr>';
		$output .= '	<th>Project</th>';
		$output .= '	<th>Description</th>';
		$output .= '   	<th>Authors</th>';
		$output .= '	<th>Downloads</th>';
		$output .= '	<th>Project Location</th>';
		$output .= '	<th>Class</th>';
		$output .= '	<th>Major</th>';
		$output .= '	<th>School</th>';
		$output .= '	<th>Date Uploaded</th>';
		$output .= '	<th>Current Rate</th>';
		$output .= '	</tr>';
	
	for ($i=0;$i<$my_project_return_num;$i++) 
	{
		$output .= "<tr>\n";
		$output .= "  <td><a href='show_project.php?show_project_id=".mysql_result($query_my_project_res,$i,'id')."'>" . mysql_result($query_my_project_res,$i,'title') . "</a></td>\n";
		$output .= "  <td>" . mysql_result($query_my_project_res,$i,'description') . "</td>\n";
		$output .= "  <td>" . mysql_result($query_my_project_res,$i,'authors') . "</td>\n";
		$output .= "  <td>" . mysql_result($query_my_project_res,$i,'downloads'). "</td>\n";
		$output .= "  <td><a href='" . mysql_result($query_my_project_res,$i,'project_location'). "'>Download Link</a></td>\n";
		$output .= "  <td>" . mysql_result($query_my_project_res,$i,'class'). "</td>\n";
		$output .= "  <td>" . mysql_result($query_my_project_res,$i,'major'). "</td>\n";
		$output .= "  <td>" . mysql_result($query_my_project_res,$i,'school'). "</td>\n";
		
		list ($yearly, $daily) = split (' ', mysql_result ($query_my_project_res,$i,'date'));
	     	list ($year, $month, $day) = split ('-', $yearly);
	        list ($hour, $minute, $second) = split (':', $daily);
                $output .= "  <td>" . date ('l, F j, Y, g:i a', mktime ($hour, $minute, $second, $month, $day, $year)) . "</td>\n";

		$rating_query="SELECT rate FROM ratings WHERE project_id=".mysql_result($query_my_project_res,$i,'id');
		
		$rating_res=mysql_query($rating_query);

		if (!$rating_res) 
		{
			$output .= "Sorry, we can't query your request";
			//echo mysql_error();
			exit;
		}
		
		$rating_num=mysql_numrows($rating_res);
		$sum=0;
		
		for($j=0;$j<$rating_num;$j++)
		{
			$sum=$sum+mysql_result($rating_res,$j,'rate');
		}
		
		if($rating_num==0)
		{
			$current_rate=$rating_num;
		}
		else
		{
			$current_rate=$sum/$rating_num;
		}
		$output .= "<td>". $current_rate."</td>\n";
		$output .= "</tr>\n";
		}
		$output .= "</table>\n";
	}
}

$output.="<br/><h2>Most Recently Uploaded Projects</h2><br/>";
$project_num=5;
$project_query="SELECT * FROM projects ORDER BY date desc LIMIT 0, $project_num";

$project_res=mysql_query($project_query);

if (!$project_res) 
{
	$output .= "Sorry, we can't query your request";
	//echo mysql_error();
	exit;
}

$project_return_num=mysql_numrows($project_res);
	if($project_return_num>0)
	{
		$output .= '<table CLASS="sortable" ID="table0" BORDER=5 BGCOLOR="#99CCFF">';
		$output .= '<tr>';
		$output .= '	<th>Project</th>';
		$output .= '	<th>Description</th>';
		$output .= '   	<th>Uploader</th>';
		$output .= '	<th>Authors</th>';
		$output .= '	<th>Downloads</th>';
		$output .= '	<th>Project Location</th>';
		$output .= '	<th>Class</th>';
		$output .= '	<th>Major</th>';
		$output .= '	<th>School</th>';
		$output .= '	<th>Date Uploaded</th>';
		$output .= '	<th>Current Rate</th>';
		if(isset($_SESSION['username']))
		$output .= '	<th>Rate This Project</th>';
		$output .= '	</tr>';
	
	for ($i=0;$i<$project_return_num;$i++) 
	{
		$output .= "<tr>\n";
		$output .= "  <td><a href='show_project.php?show_project_id=".mysql_result($project_res,$i,'id')."'>" . mysql_result($project_res,$i,'title') . "</a></td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'description') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'uploader') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'authors') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'downloads'). "</td>\n";
		$output .= "  <td><a href='" . mysql_result($project_res,$i,'project_location'). "'>Download Link</a></td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'class'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'major'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'school'). "</td>\n";
		
		list ($yearly, $daily) = split (' ', mysql_result ($project_res,$i,'date'));
		list ($year, $month, $day) = split ('-', $yearly);
		list ($hour, $minute, $second) = split (':', $daily);
		$output .= "  <td>" . date ('l, F j, Y, g:i a', mktime ($hour, $minute, $second, $month, $day, $year)) . "</td>\n";
		
		$rating_query="SELECT rate FROM ratings WHERE project_id=".mysql_result($project_res,$i,'id');
		
		$rating_res=mysql_query($rating_query);

		if (!$rating_res) 
		{
			$output .= "Sorry, we can't query your request";
			//echo mysql_error();
			exit;
		}
		
		$rating_num=mysql_numrows($rating_res);
		$sum=0;
		
		for($j=0;$j<$rating_num;$j++)
		{
			$sum=$sum+mysql_result($rating_res,$j,'rate');
		}
		
		if($rating_num==0)
		{
			$current_rate=$rating_num;
		}
		else
		{
			$current_rate=$sum/$rating_num;
		}
		$output .= "<td>". $current_rate."</td>\n";
		if(isset($_SESSION['username']))
		{
		$output .= "<td><form name='rate' method='POST' action='rate.php'><select name='rate'><option value=1>1</option>";
		$output .= "<option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
		$output .= "<input type='hidden' name='project_id' value='".mysql_result($project_res,$i,'id')."'/><input type='hidden' name='searchInput' value='".$_REQUEST['searchInput']."'/><input type='hidden' name='searchType' value='".$_REQUEST['searchType']."'/><input type='hidden' name='orderedBy' value='".$_REQUEST['orderedBy']."'/><input type='submit' value='Rate' /></form></td>";
		}
		$output .= "</tr>\n";
		
	}
	$output .= "</table>\n";
	}

$output.="<br/><h2>Most Downloaded Projects</h2><br/>";
$project_num=5;
$project_query="SELECT * FROM projects ORDER BY downloads desc LIMIT 0, $project_num";

$project_res=mysql_query($project_query);

if (!$project_res) 
{
	$output .= "Sorry, we can't query your request";
	//echo mysql_error();
	exit;
}

$project_return_num=mysql_numrows($project_res);
	if($project_return_num>0)
	{
		$output .= '<table CLASS="sortable" ID="table0" BORDER=5 BGCOLOR="#99CCFF">';
		$output .= '<tr>';
		$output .= '	<th>Project</th>';
		$output .= '	<th>Description</th>';
		$output .= '   	<th>Uploader</th>';
		$output .= '	<th>Authors</th>';
		$output .= '	<th>Downloads</th>';
		$output .= '	<th>Project Location</th>';
		$output .= '	<th>Class</th>';
		$output .= '	<th>Major</th>';
		$output .= '	<th>School</th>';
		$output .= '	<th>Date Uploaded</th>';
		$output .= '	<th>Current Rate</th>';
		if(isset($_SESSION['username']))
		$output .= '	<th>Rate This Project</th>';
		$output .= '	</tr>';
	
	for ($i=0;$i<$project_return_num;$i++) 
	{
		$output .= "<tr>\n";
		$output .= "  <td><a href='show_project.php?show_project_id=".mysql_result($project_res,$i,'id')."'>" . mysql_result($project_res,$i,'title') . "</a></td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'description') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'uploader') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'authors') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'downloads'). "</td>\n";
		$output .= "  <td><a href='" . mysql_result($project_res,$i,'project_location'). "'>Download Link</a></td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'class'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'major'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'school'). "</td>\n";
		
		list ($yearly, $daily) = split (' ', mysql_result ($project_res,$i,'date'));
		list ($year, $month, $day) = split ('-', $yearly);
		list ($hour, $minute, $second) = split (':', $daily);
		$output .= "  <td>" . date ('l, F j, Y, g:i a', mktime ($hour, $minute, $second, $month, $day, $year)) . "</td>\n";
		
		$rating_query="SELECT rate FROM ratings WHERE project_id=".mysql_result($project_res,$i,'id');
		
		$rating_res=mysql_query($rating_query);

		if (!$rating_res) 
		{
			$output .= "Sorry, we can't query your request";
			//echo mysql_error();
			exit;
		}
		
		$rating_num=mysql_numrows($rating_res);
		$sum=0;
		
		for($j=0;$j<$rating_num;$j++)
		{
			$sum=$sum+mysql_result($rating_res,$j,'rate');
		}
		
		if($rating_num==0)
		{
			$current_rate=$rating_num;
		}
		else
		{
			$current_rate=$sum/$rating_num;
		}
		$output .= "<td>". $current_rate."</td>\n";
		if(isset($_SESSION['username']))
		{
		$output .= "<td><form name='rate' method='POST' action='rate.php'><select name='rate'><option value=1>1</option>";
		$output .= "<option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
		$output .= "<input type='hidden' name='project_id' value='".mysql_result($project_res,$i,'id')."'/><input type='hidden' name='searchInput' value='".$_REQUEST['searchInput']."'/><input type='hidden' name='searchType' value='".$_REQUEST['searchType']."'/><input type='hidden' name='orderedBy' value='".$_REQUEST['orderedBy']."'/><input type='submit' value='Rate' /></form></td>";
		}
		$output .= "</tr>\n";
		
	}
	$output .= "</table>\n";
	}
	
make_page ("Projects", $output);
	
?>
