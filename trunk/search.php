<?php
/*******************************************************************
search.php
Allows user to search for a project based on a projects attributes
********************************************************************/

session_start ();

// for clickable sort by headers
echo "<script src=\"sorttable.js\"></script>";

require ("feater.php");
require ("connect_db.php");
head("Search");

// Display message generate by another file
if(isset($_SESSION['message']))
{
	echo $_SESSION['message'];
	unset ($_SESSION['message']);
}

echo '<h2>Search projects</h2>';


// add sort form to sort searched projects
// it should have your last used search text in the text field
$search_request='';

if (isset ($_REQUEST['searchInput']) && isset ($_REQUEST['searchType']) && isset ($_REQUEST['orderedBy']))
{
	$search_request = htmlentities($_REQUEST['searchInput']);
	$search_type = htmlentities($_REQUEST['searchType']);
	$sort = htmlentities($_REQUEST['orderedBy']);

}
echo "<form name='searchByClass' method='GET' action='search.php'>";
//echo "Search:&nbsp;&nbsp;&nbsp;&nbsp;<input name='searchInput' id='input2' type='text' value='".addslashes($search_request)."'/>";
echo "Search:&nbsp;&nbsp;&nbsp;&nbsp;<input name='searchInput' id='input2' type='text' value=\"".$search_request."\"/>";
echo "By:&nbsp;&nbsp;&nbsp;&nbsp;<select name='searchType'>";
echo '<option value="title">Title</option>';
echo '<option value="class">Class</option>';
echo '<option value="school">School</option>';
echo '<option value="major">Major</option>';
echo '<option value="date">Date</option>';
echo '<option value="description">Description</option>';
echo '</select>';
echo 'Ordered By:&nbsp;&nbsp;&nbsp;&nbsp;<select name="orderedBy">';
echo '<option value="descDownloads">Downloads Descending</option>';
echo '<option value="asceTitle">Title Ascending</option>';
echo '<option value="descTitle">Title Descending</option>';
echo '<option value="asceDate">Date Ascending</option>';
echo '<option value="descDate">Date Descending</option>';
echo '</select>';
echo "&nbsp;&nbsp;<input type='submit' value='Search' \>";
echo '</form>';

// execute query and display results
if(isset($_REQUEST['searchInput'])&&isset($_REQUEST['searchType'])&&isset($_REQUEST['orderedBy']))
{
	$search_request=htmlspecialchars($_REQUEST['searchInput']);
	$search_type=htmlspecialchars($_REQUEST['searchType']);
	$sort=htmlspecialchars($_REQUEST['orderedBy']);

	if($search_request==""||$search_type==""||$sort=="")
	{
		$output.="Please enter a valid search.";
	}
	else{
	// generate queries for each sortable option
	if($search_type=="date")
	{
		$project_query="SELECT * FROM projects WHERE ".mysql_real_escape_string($search_type).">'".mysql_real_escape_string($search_request)."'";
	}
	else
	{
		$project_query="SELECT * FROM projects WHERE ".mysql_real_escape_string($search_type)." REGEXP '".mysql_real_escape_string($search_request)."'";
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

	// find out how many database records we have
	$project_num = mysql_numrows($project_res);

	echo "<h3>Your Search Returned ".$project_num." Results</h3>\n";

	if($project_num>0)
	{
		echo '<table CLASS="sortable" ID="table0" BORDER=5 BGCOLOR="#99CCFF">';
		echo '<tr>';
		echo '	<th>Project</th>';
		echo '	<th>Description</th>';
		echo '   <th>Uploader</th>';
		echo '	<th>Downloads</th>';
		echo '	<th>Size</th>';
		echo '	<th>Project Location</th>';
		echo '	<th>Class</th>';
		echo '	<th>Major</th>';
		echo '	<th>School</th>';
		echo '	<th>Date Uploaded</th>';
		echo '	<th>Current Rate</th>';
		if(isset($_SESSION['username']))
		echo '	<th>Rate This Project</th>';
		echo '	</tr>';
	}
	// display project info
	for ($i=0;$i<$project_num;$i++) 
	{
		echo "<tr>";
		echo "  <td><a href='show_project.php?show_project_id=".mysql_result($project_res,$i,'id')."'>" . mysql_result($project_res,$i,'title') . "</a></td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'description') . "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'uploader') . "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'downloads'). "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'size'). "</td>\n";
		echo "  <td><a href='" . mysql_result($project_res,$i,'project_location'). "'>Download Link</a></td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'class'). "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'major'). "</td>\n";
		echo "  <td>" . mysql_result($project_res,$i,'school'). "</td>\n";

		list ($yearly, $daily) = split (' ', mysql_result ($project_res,$i,'date'));
                list ($year, $month, $day) = split ('-', $yearly);
                list ($hour, $minute, $second) = split (':', $daily);
                echo "  <td>" . date ('l, F j, Y, g:i a', mktime ($hour, $minute, $second, $month, $day, $year)), "</td>\n";
		
		// Display current rate and a form to rate such file
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
		
		//if logged in, give user the option to rate project
		if(isset($_SESSION['username']))
		{
		echo "<td><form name='rate' method='POST' action='rate.php'><select name='rate'><option value=1>1</option>";
		echo "<option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
		echo "<input type='hidden' name='project_id' value='".mysql_result($project_res,$i,'id')."'/><input type='hidden' name='searchInput' value='".$_REQUEST['searchInput']."'/><input type='hidden' name='searchType' value='".$_REQUEST['searchType']."'/><input type='hidden' name='orderedBy' value='".$_REQUEST['orderedBy']."'/><input type='submit' value='Rate' /></form></td>";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
	}
}
else
{
	echo "<p>Enter text for search!</p>";
}
$_SESSION['back'] = $_SERVER['REQUEST_URI'];
foot();

?>
