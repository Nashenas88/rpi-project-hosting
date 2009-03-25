<?php
session_start ();

require ("connect_db.php");
$id = mysql_real_escape_string ($_GET["id"]);

$query = sprintf ("SELECT title, description, uploader, downloads,"
		  . " size, project_location, authors, class, "
		  . " major, school, date FROM projects WHERE id='%s';", $id);
$result = mysql_query ($query);

session_start ();
require ("upper_header.php");

if ($result)
{
  if (mysql_numrows ($result) > 0)
  {
    $row = mysql_fetch_assoc ($result);
    echo $row['title'];
    require ("lower_header.php");
    require ("menu.php");
    
    echo "<br/><center><h1>" . htmlspecialchars ($row['title']) . "</h1></center><br />\n";
    
    $username = htmlspecialchars ($_SESSION['username']);
    $path = $username . "/" . htmlspecialchars ($row['title']);
    
  }
  else
  {
    echo "Error";
    require ("lower_header.php");
    require ("menu.php");
    
    echo "<br/><center>Project not found</center>";
  }
}
else
{
  echo "Error";
  require ("lower_header.php");
  require ("menu.php");
  
  echo mysql_error($result);
}



?>