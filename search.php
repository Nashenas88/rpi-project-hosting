<?php
session_start ();

/***
for clickable sort by headers
***/
echo "<script src=\"sorttable.js\"></script>";

/***
use this session for testing logged in user
assume login use admin account (for rating)
***/


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
if(isset($_REQUEST['searchInput'])&&isset($_REQUEST['searchType'])&&isset($_REQUEST['orderedBy']))
{
	$search_request=htmlspecialchars($_REQUEST['searchInput']);
	$search_type=htmlspecialchars($_REQUEST['searchType']);
	$sort=htmlspecialchars($_REQUEST['orderedBy']);
	/*
	*generate queries
	*/
	if($search_type=="date")
	{
		$project_query="SELECT * FROM projects WHERE ".mysql_real_escape_string($search_type).">'".mysql_real_escape_string($search_request)."'";
	}
	else
	{
		$project_query="SELECT * FROM projects WHERE ".mysql_real_escape_string($search_type)."='".mysql_real_escape_string($search_request)."'";
	}
		
	if ($sort=='asceTitle')
	{
		$project_query.=" ORDER BY title, downloads DESC";
	}
	else if ($sort=='descTitle')
	{
		$project_query.=" ORDER BY title DESC, downloads DESC";
	}
	else if ($sort=='asceDate')
	{
		$project_query.=" ORDER BY date, title";
	}
	else if ($sort=='descDate')
	{
		$project_query.=" ORDER BY date DESC, title";
	}
	else if ($sort=='asceSize')
	{
		$project_query.=" ORDER BY size, title";
	}
	else if ($sort=='descSize')
	{
		$project_query.=" ORDER BY size DESC, title";
	}
	else if ($sort=='asceClass')
	{
		$project_query.=" ORDER BY class, title";
	}
	else if ($sort=='descClass')
	{
		$project_query.=" ORDER BY class DESC, title";
	}
	else		
	{
		$project_query.=" ORDER BY downloads DESC, title";
	}
	
	$project_res=mysql_query($project_query);

	if (!$project_res) 
	{
		echo "Sorry, we can't query your request";
		//echo mysql_error();
		exit;
	}

	// find out how many records we got
	$project_num = mysql_numrows($project_res);

	echo "<h3>Your Search Resturned ".$project_num." Results</h3>\n";

	if($project_num>0)
	{
?>
		<table CLASS="sortable" ID="table0" BORDER=5 BGCOLOR="#99CCFF">
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
			<?php
			if(isset($_SESSION['username']))
			echo "<th>Rate This Project</th>"
			?>
		</tr>
<?php
	}
	/*
	*display project info
	*/
	for ($i=0;$i<$project_num;$i++) 
	{
		echo "<tr>\n";
		echo "  <td><a href='show_project.php?show_project_id=".mysql_result($project_res,$i,'id')."'>" . mysql_result($project_res,$i,'title') . "</a></td>\n";
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
			echo "Sorry, we can't query your request";
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
		echo "<td>". $current_rate."</td>\n";
		
		//if logged in, show rate option
		if(isset($_SESSION['username']))
		{
		echo "<td><form name='rate' method='POST' action='rate.php'><select name='rate'><option value='1'>1</option><option value=1>1</option>";
		echo "<option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
		echo "<input type='hidden' name='project_id' value='".mysql_result($project_res,$i,'id')."'/><input type='hidden' name='searchInput' value='".$_REQUEST['searchInput']."'/><input type='hidden' name='searchType' value='".$_REQUEST['searchType']."'/><input type='hidden' name='orderedBy' value='".$_REQUEST['orderedBy']."'/><input type='submit' value='Rate' /></form></td>";
		}
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
