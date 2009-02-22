<h2>Search projects</h2>

<?php
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
	echo "<form name='searchByClass' method='POST' action='search.php'>";
	echo "Search:&nbsp;&nbsp;&nbsp;&nbsp;<input name='searchInput' id='input2' type='text' value='".$search_request."'\>";
	echo "By:&nbsp;&nbsp;&nbsp;&nbsp;<select name='searchType'>";
?>

<option value="title">Project's Title</option>
<option value="class">Class</option>
<option value="school">School</option>
<option value="major">Major</option>
</select>
Ordered By:&nbsp;&nbsp;&nbsp;&nbsp;<select name="orderedBy">
<option value="descDownloads">Downloads Descending</option>
<option value="asceTitle">Title Ascending</option>
<option value="descTitle">Title Descending</option>
<option value="asceDate">Date Ascending</option>
<option value="descDate">Date Descending</option>
<option value="asceSize">Size Ascending</option>
<option value="descSize">Size Descending</option>
<option value="asceClass">Class Ascending</option>
<option value="descClass">Class Descending</option>
</select>
&nbsp;&nbsp;<input type='submit' value='Search' \>
</form>
