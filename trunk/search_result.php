<!-- search_result.php -->
<!-- displays the search results in an html table -->

if(isset($_REQUEST['searchInput']))
{
	$search_request=$_REQUEST['searchInput'];
	echo "<br />".$search_request."<br />";

	$query="SELECT * FROM projects WHERE title='".mysql_real_escape_string($search_request)."'";
	$res=mysql_query($query);

<!-- make sure it worked! -->
if (!$res) 
{
  echo mysql_error();
  exit;
}

<!-- find out how many records we got -->
$num = mysql_numrows($res);

echo "<h3>Your Search Resturns ".$num." Results</h3>\n";
?>
<table border=0>
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
  </tr>
<?php

for ($i=0;$i<$num;$i++) 
{
  echo "<tr>\n";
  echo "  <td>" . mysql_result($res,$i,'title') . "</td>\n";
  echo "  <td>" . mysql_result($res,$i,'description') . "</td>\n";
  echo "  <td>" . mysql_result($res,$i,'uploader') . "</td>\n";
  echo "  <td>" . mysql_result($res,$i,'downloads'). "</td>\n";
  echo "  <td>" . mysql_result($res,$i,'size'). "</td>\n";
  echo "  <td><a href='" . mysql_result($res,$i,'project_location'). "'>Download Link</a></td>\n";
  echo "  <td>" . mysql_result($res,$i,'class'). "</td>\n";
  echo "  <td>" . mysql_result($res,$i,'major'). "</td>\n";
  echo "  <td>" . mysql_result($res,$i,'school'). "</td>\n";
  echo "  <td>" . mysql_result($res,$i,'date'). "</td>\n";
  echo "</tr>\n";
}
echo "</table>\n";
}
else
{
echo "<p>Enter text for search!</p>";
}
