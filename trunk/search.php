<?php
session_start ();

/***
use this session for testing logged in user
assume login use admin account (for rating)
***/
$_SESSION['usrname']="admin";



require("connect_db.php");
require ("upper_header.php");
echo "Search";
require ("lower_header.php");
require ("menu.php");

/***
Display message generate by another file
***/
if(isset($_SESSION['message']))
{
	echo $_SESSION['message'];
	unset ($_SESSION['message']);
}

require ("search_form.php");



/***
Execute query and display results
***/
if(isset($_REQUEST['searchInput'])&&isset($_REQUEST['searchType']))
{
	$search_request=$_REQUEST['searchInput'];
	$search_type=$_REQUEST['searchType'];

	$project_query="SELECT * FROM projects WHERE ".mysql_real_escape_string($search_type)."='".mysql_real_escape_string($search_request)."' ORDER BY downloads";
	
	$project_res=mysql_query($project_query);

	if (!$project_res) 
	{
		echo mysql_error();
		exit;
	}

	// find out how many records we got
	$project_num = mysql_numrows($project_res);

	echo "<h3>Your Search Resturns ".$project_num." Results</h3>\n";

	if($project_num>0)
	{
?>
		<table border=1>
		<tr>
			<th>Project</th>
			<th>Description</th>
		    <th>Uploader</th>
			<th>Downloads</th>
			<th>Size</th>
			<th>Project Location</th>
			<th>Class</th>
			<th>Major</th>
			<th>School</th>
			<th>Date Uploaded</th>
			<th>Current Rate</th>
			<th>Rate This Project</th>
		</tr>
<?php
	}
	for ($i=0;$i<$project_num;$i++) 
	{
		echo "<tr>\n";
		echo "  <td>" . mysql_result($project_res,$i,'title') . "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'description') . "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'uploader') . "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'downloads'). "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'size'). "</td>\n";
		echo "  <td><a href='" . mysql_result($project_res,$i,'project_location'). "'>Download Link</a></td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'class'). "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'major'). "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'school'). "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'date'). "</td>\n";
		
		
		/***
		Below codes are rating
		Display current rate and a form to rate such file
		***/
		$rating_query="SELECT rate FROM ratings WHERE project_id=".mysql_result($project_res,$i,'id');
		
		$rating_res=mysql_query($rating_query);

		if (!$rating_res) 
		{
			echo mysql_error();
			exit;
		}
		
		$rating_num=mysql_numrows($rating_res);
		$sum=0;
		
		for($j=0;$j<$rating_num;$j++)
		{
			$sum=$sum+mysql_result($rating_res,$j,'rate');
		}
				
		$current_rate=$sum/$rating_num;
		echo "  <td>".$rating_num." users rate this project: " . $current_rate. "</td>\n";
		echo "<td><form name='rate' method='POST' action='rate.php'><input type='text' name='rate' size=2/><input type='hidden' name='project_id' value='".mysql_result($project_res,$i,'id')."'/><input type='submit' value='Rate' /></form></td>";
		echo "</tr>\n";
	}
	echo "</table>\n";
}
else
{
	echo "<p>Enter text for search!</p>";
}
require ("footer.php");
?>
