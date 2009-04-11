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

require ("feater.php");
$output = "";

/***
Display message generate by another file
***/
if(isset($_SESSION['message']))
{
	$output .= $_SESSION['message'];
	unset ($_SESSION['message']);
}

$output .= '<h2>Search projects</h2>';
/***
It should have your last used search text in the text field.
***/
$search_request='';

if(isset($_REQUEST['searchInput'])&&isset($_REQUEST['searchType'])&&isset($_REQUEST['orderedBy']))
{
	$search_request=$_REQUEST['searchInput'];
	$search_type=$_REQUEST['searchType'];
	$sort=$_REQUEST['orderedBy'];
}
$output .= "<form name='searchByClass' method='POST' action='search.php'>";
$output .= "Search:&nbsp;&nbsp;&nbsp;&nbsp;<input name='searchInput' id='input2' type='text' value='".$search_request."'/>";
$output .= "By:&nbsp;&nbsp;&nbsp;&nbsp;<select name='searchType'>";
$output .= '<option value="title">Title</option>';
$output .= '<option value="class">Class</option>';
$output .= '<option value="school">School</option>';
$output .= '<option value="major">Major</option>';
$output .= '<option value="date">Date</option>';
$output .= '</select>';
$output .= 'Ordered By:&nbsp;&nbsp;&nbsp;&nbsp;<select name="orderedBy">';
$output .= '<option value="descDownloads">Downloads Descending</option>';
$output .= '<option value="asceTitle">Title Ascending</option>';
$output .= '<option value="descTitle">Title Descending</option>';
$output .= '<option value="asceDate">Date Ascending</option>';
$output .= '<option value="descDate">Date Descending</option>';
$output .= '<option value="asceSize">Size Ascending</option>';
$output .= '<option value="descSize">Size Descending</option>';
$output .= '<option value="asceClass">Class Ascending</option>';
$output .= '<option value="descClass">Class Descending</option>';
$output .= '</select>';
$output .= "&nbsp;&nbsp;<input type='submit' value='Search' \>";
$output .= '</form>';

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
		$output .= "Sorry, we can't query your request";
		//echo mysql_error();
		exit;
	}

	// find out how many records we got
	$project_num = mysql_numrows($project_res);

	$output .= "<h3>Your Search Resturned ".$project_num." Results</h3>\n";

	if($project_num>0)
	{
		$output .= '<table CLASS="sortable" ID="table0" BORDER=5 BGCOLOR="#99CCFF">\n';
		$output .= '<tr>\n';
		$output .= '	<th>Project</th>\n';
		$output .= '	<th>Description</th>\n';
		$output .= '   <th>Uploader</th>\n';
		$output .= '	<th>Downloads</th>\n';
		$output .= '	<th>Size</th>\n';
		$output .= '	<th>Project Location</th>\n';
		$output .= '	<th>Class</th>\n';
		$output .= '	<th>Major</th>\n';
		$output .= '	<th>School</th>\n';
		$output .= '	<th>Date Uploaded</th>\n';
		$output .= '	<th>Current Rate</th>\n';
		$output .= '	if(isset($_SESSION[\'username\']))\n';
		$output .= '	<th>Rate This Project</th>\n';
		$output .= '	</tr>\n';
	}
	/*
	*display project info
	*/
	for ($i=0;$i<$project_num;$i++) 
	{
		$output .= "<tr>\n";
		$output .= "  <td><a href='show_project.php?show_project_id=".mysql_result($project_res,$i,'id')."'>" . mysql_result($project_res,$i,'title') . "</a></td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'description') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'uploader') . "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'downloads'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'size'). "</td>\n";
		$output .= "  <td><a href='" . mysql_result($project_res,$i,'project_location'). "'>Download Link</a></td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'class'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'major'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'school'). "</td>\n";
		$output .= "  <td>" . mysql_result($project_res,$i,'date'). "</td>\n";
		
		
		/***
		Below codes are rating
		Display current rate and a form to rate such file
		***/
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
		
		//if logged in, show rate option
		if(isset($_SESSION['username']))
		{
		$output .= "<td><form name='rate' method='POST' action='rate.php'><select name='rate'><option value='1'>1</option><option value=1>1</option>";
		$output .= "<option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
		$output .= "<input type='hidden' name='project_id' value='".mysql_result($project_res,$i,'id')."'/><input type='hidden' name='searchInput' value='".$_REQUEST['searchInput']."'/><input type='hidden' name='searchType' value='".$_REQUEST['searchType']."'/><input type='hidden' name='orderedBy' value='".$_REQUEST['orderedBy']."'/><input type='submit' value='Rate' /></form></td>";
		}
		$output .= "</tr>\n";
	}
	$output .= "</table>\n";
}
else
{
	$output .= "<p>Enter text for search!</p>";
}

make_page ("Search", $output);

?>
